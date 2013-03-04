<?php

/**
 * Engine Model - This handles getting main content from the database
 * for use with the dynamic content management system.
 */
class Engine_model extends CI_Model
{

    private $CI;
    private $content_types = array('wysiwyg', 'textarea', 'oneline', 'image', 'link');
    
    function __construct()
    {
        $this->CI = & get_instance();
    }

    /**
     * Function to display content and edit functions to the controller, the html was kept
     * in the model because this will be used in more than one controller.
     *
     * The $muliple var format determines where and what information to obtain from the database
     * It can accept multiple data types (string/array)
     * 
     * format (basic): foo, (foo) = identifier ($id)
     * format (string): foo_man_chu, (foo) = page name ($page), (man) = block type ($type), (chu) = identifier ($id)
     * format (array): [page] = page name ($page), [type] = block type ($type), [id] = identifier ($id)
     * 
     * @access	public
     * @param	string, string
     * @return	string
     */
    public function display_block($multiple, $page = 'default', $type = 'wysiwyg', $params = FALSE)
    {
        /** Parses $multiple and determines the data format and variables for use within this method. */
        if (is_array($multiple)) {
            foreach($multiple as $key => $var)
            {
                $$key = $var;
                if (is_array($var))
                    foreach($var as $param_key => $param_var)
                        $$param_key = $param_var;
            }
        } elseif (strpos($multiple, '_')) {
            $str_params = explode('_', $multiple);
            if (count($str_params) > 2)
            {
                $page = $str_params[0];
                $type = $str_params[1];
                $id = $str_params[2];
            }
            else
            {
                $id = $multiple;
            }
        } else {
            $id = $multiple;
        }
        // clean id
        $id = $this->clean_block_id($id);

        // check for valid type
        $type = strtolower(htmlentities($type, ENT_QUOTES));
        if (in_array($type, $this->content_types) === FALSE)
        {
            return "<script>alert('Please enter a valid block type for \'" . $id . "\'');</script>";
        }

        // get content
        $content = $this->load_block($id, $type);
        if ($content === FALSE)
        {
            // create content block
            $this->create_block($id, $page);
            $content = '';
        }

        // if type is a link, we have to format it for the view
        if ($type == 'link' AND is_array($content))
        {
            $link_string = "<a href=\"" . $content['src'] . "\"";
            if (!empty($content['class']))
                $link_string .= " class=\"" . $content['class'] . "\"";
            if (!empty($content['style']))
                $link_string .= " style=\"" . $content['style'] . "\"";
            if (!empty($content['target']))
                $link_string .= " style=\"" . $content['target'] . "\"";
            $link_string .= ">" . $content['content'] . "</a>";
            $content = $link_string;
        }

        // if type is of image, we have to do some work on the content array
        if ($type == 'image' AND is_array($content))
        {
            if (!empty($content['src']))
            {
                if (isset($max_width))
                {
                    $src_string = SITE_PATH . 'index.php/tools/resizeimage/' . str_replace('/', ':', 'resources:public:' . $content['src']) . '/' . $max_width;
                } 
                else
                {
                    $src_string = SITE_RESOURCES . $content['src'];
                }

                $image_string = '<img src="' . $src_string . '"';
                if (!empty($content['alt']))
                    $image_string .= ' alt="' . $content['alt'] . '"';
                if (!empty($content['class']))
                    $image_string .= ' class="' . $content['class'] . '"';
                if (!empty($content['style']))
                    $image_string .= ' style="' . $content['style'] . '"';
                $image_string .= ' />';
            }
            else
            {
                $image_string = '';
                if ($this->CI->auth->logged_in())
                {
                    $image_string = '<img style="display: block; width: 140px; height: 140px;" class="img-rounded" data-src="' . SITE_RESOURCES . 'bootstrap/js/holder.js/140x140" width="140" height="140" />';
                }
            }
            $content = $image_string;
        }

        // check login status
        if ($this->CI->auth->check_auth_level('cms_edit'))
        {
            switch ($type)
            {
                case "wysiwyg": $v_type = "WYSIWYG";
                    break;
                case "textarea": $v_type = "Textarea";
                    break;
                case "oneline": $v_type = "One Line";
                    break;
                case "image": $v_type = "Image";
                    break;
                case "link": $v_type = "Link";
            }

            $edit_start = '<div class="tek_edit">';
            $edit_type = '<a class="tek_edit_type" href="' . SITE_PATH . 'index.php/cms/edit/' . $id . '/' . $type . '">' . $v_type . '</a>';
            $edit_link = '<a class="tek_edit_link" href="' . SITE_PATH . 'index.php/cms/edit/' . $id . '/' . $type . '">Edit Block</a>';
            $edit_end = '</div>';

            $conc_edit = $edit_start . $edit_type . $edit_link . $content . $edit_end;

            return $conc_edit;
        } else
        {
            return $content;
        }
    }

    /**
     * Returns a sanitized id field for use with the database object that handles the cms
     *
     * @access	public
     * @param	string
     * @return	string
     */
    function clean_block_id($id)
    {
        $id = str_replace(' ', '_', $id);
        $id = str_replace('-', '_', $id);
        $id = preg_replace("/[^a-zA-Z0-9_]/", "", $id);
        return strtolower($id);
    }

    /**
     * Fetch the contents from the database
     *
     * @access	public
     * @param	int, string
     * @return	string or array or Bool
     */
    function load_block($id, $type = '')
    {
        if ($type == 'image')
        {
            $content = array();
            $this->CI->db->select(array('src', 'alt', 'style', 'class'));
            $query = $this->CI->db->get_where('tek_content', array('id' => $id));

            if ($query->num_rows() > 0)
            {
                return $query->row_array();
            }
            return FALSE;
        }

        if ($type == 'link')
        {
            $content = array();
            
            $this->CI->db->select(array('src', 'content', 'style', 'class', 'target'));
            $query = $this->CI->db->get_where('tek_content', array('id' => $id));

            if ($query->num_rows() > 0)
            {
                return $query->row_array();
            }
            return FALSE;
        }

        $this->CI->db->select('content');
        $query = $this->CI->db->get_where('tek_content', array('id' => $id));
        
        if ($query->num_rows() > 0)
        {
            $row = $query->row_array();
            
            return $row['content'];
        }
        return FALSE;
    }

    /**
     * Creates content block within the database
     *
     * @access	public
     * @param	string
     * @return	
     */
    function create_block($id, $page)
    {
        $this->db->insert('tek_content', array('id' => $id, 'page' => $page));
    }
    
    /**
     * Writes changes to CMS content blocks to the database
     *
     * @access	public
     * @param	string, string or array, string
     * @return	Bool
     */
    function update_block($id, $content, $type = '')
    {
        $content['editor'] = $this->CI->auth->get_current_uid();
        
        $this->CI->db->where('id', $id);
        $this->CI->db->update('tek_content', $content);
    }
}