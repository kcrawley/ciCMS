<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Cms extends CI_Controller
{
    private $block_id;
    private $block_type;
    private $block_cms;
    private $field_override;

    function __construct($field_override = NULL)
    {
        parent::__construct();
        
        if (isset($field_override))
        {
            $this->field_override = $field_override;
        }
        
        $this->load->model('engine_model', '', true);
    }
    
    public function save()
    {
        if (count($this->input->post()) > 0)
        {
            $this->block_id = $this->engine_model->clean_block_id($this->input->post('id'));
            $this->block_type = htmlentities($this->input->post('type'), ENT_QUOTES);
	
            if ($this->block_type == 'image' OR $this->block_type == 'link')
            {
                $content = array();
                $valid_keys = array('field_content', 'field_src', 'field_alt', 'field_class', 'field_style', 'type');
                
                foreach($this->input->post() as $key => $val)
                {
                    if (array_search($key, $valid_keys))
                        $content[str_replace('field_', '', $key)] = $val;
                }
            }
            else
            {
                $content['content'] = $this->input->post('field');
            }
            
            $this->engine_model->update_block($this->block_id, $content, $this->block_type);
	
            // close colorboxand refresh the page
            $this->load->view('cms/cms_saving');
        }
    }
    
    public function edit()
    {
        $this->block_id = $this->engine_model->clean_block_id($this->uri->rsegment(3));
        $this->block_type = htmlentities($this->uri->rsegment(4), ENT_QUOTES);
        $content = $this->engine_model->load_block($this->block_id, $this->block_type);
        $this->block_cms = $this->generate_field($this->block_type, $content);

        $data = array(
            'site_path' => SITE_PATH,
            'app_resources' => APP_RESOURCES,
            'block_type' => $this->block_type,
            'block_id' => $this->block_id,
            'block_cms' => $this->block_cms,
            'tiny_mce' => $this->js_tinymce(),
            'datastring' => $this->js_datastring()
        );
        
        // load view
        $this->load->view('cms/cms_edit', $data);
    }

    /**
     * Returns custom JavaScript code to be passed to the view depending on the content block type
     * @return string
     */
    private function js_datastring()
    {
        switch ($this->block_type)
        {
            case 'image' : $data = "{ id: id, field_class: $('#field_class').val(), field_style: $('#field_style').val(), field_src: $('#field_src').val(), field_alt: $('#field_alt').val(), type: type, ajax: 'true' }";
                break;
            case 'link' : $data = "{ id: id, field_class: $('#field_class').val(), field_style: $('#field_style').val(), field_src: $('#field_src').val(), field_alt: $('#field_alt').val(), type: type, ajax: 'true' }";
                break;
            default : $data = "{ id: id, field: $('#field').val(), type: type, ajax: 'true' }";
        }
        
        $js_data = 'var dataString = ' . $data;
        
        if ($this->block_type == 'wysiwyg')
            return "tinyMCE.triggerSave();\n" . $js_data;
        
        return $js_data;
    }

    private function js_tinymce()
    {
        if ($this->block_type == 'wysiwyg')
        {
            return '<script type="text/javascript">
        tinyMCE.init({
            // General options
            mode : "none",
            theme : "advanced",
            plugins : "style,table,advimage,advlink,inlinepopups,media,contextmenu,paste,fullscreen,noneditable,visualchars,xhtmlxtras",
            width : "700",
            height: "299",

            // Theme options
            theme_advanced_buttons1 : "styleselect,formatselect,fontselect,fontsizeselect,|,forecolor,backcolor,bold,italic,underline,strikethrough",
            theme_advanced_buttons2 : "bullist,numlist,|,outdent,indent,blockquote,|,justifyleft,justifycenter,justifyright,justifyfull,|, cut,copy,paste,undo,redo,|,link,unlink,anchor,image,charmap,|,attribs,code,preview,fullscreen",
            theme_advanced_buttons3 : "",
            theme_advanced_buttons4 : "",
            theme_advanced_toolbar_location : "top",
            theme_advanced_toolbar_align : "left",
            theme_advanced_statusbar_location : "bottom",
            theme_advanced_resizing : true,

            // Skin options
            skin : "o2k7",
            skin_variant : "silver",

            // Example content CSS (should be your site CSS)
            content_css : "<?= SITE_CSS; ?>, <?= APP_RESOURCES; ?>css/tiny_mce_style.css"
        });

        setTimeout(function() {tinyMCE.execCommand("mceAddControl", false, "field");}, 5);
    </script>';
        }
        return '';
    }

    /**
     * Function to display editable fields to the view
     *
     * @access	private
     * @param	string, string, string (comma-seperate option)
     * @return	string
     */
    private function generate_field($type, $content, $mode = array())
    {
        if (count($mode) > 0)
        {
            $mode = (strpost($mode, ',')) ? explode(',', strtolower($mode)) : array(strtolower($mode));
        }

        if ($type == 'wysiwyg' AND count($mode) === 0)
        {
            $field = (!empty($this->field_override)) ? $this->field_override : 'field';

            return '<textarea name="field" id="' . $field . '" class="wysiwyg">' . $content . '</textarea>';
        } 
        else if ($type == 'wysiwyg' AND in_array("blog", $mode))
        {
            $field = (!empty($this->field_override)) ? $this->field_override : 'field_article';

            return '<textarea name="field_article" id="' . $field . '" class="blog_wysiwyg">' . $content . '</textarea>';
        } 
        else if ($type == 'textarea')
        {
            $field = (!empty($this->field_override)) ? $this->field_override : 'field';

            return '<textarea name="field" id="' . $field . '" class="textarea">' . $content . '</textarea>';
        } 
        else if ($type == 'oneline')
        {
            $field = (!empty($this->field_override)) ? $this->field_override : 'field';

            return '<input type="text" name="field" id="' . $field . '" class="oneline" value="' . $content . '">';
        } 
        else if ($type == 'link')
        {
            // set up the content array in case its a new/blank field
            if (empty($content))
            {
                $content = array(
                    'content' => '',
                    'src' => '',
                    'class' => '',
                    'style' => '',
                    'target' => ''
                );
            }

            $input_string = '<div class="controls">';
            $input_string .= '	<div class="span4">';
            $input_string .= '		<label for="field_src"><span>Href (valid url - required):</span></label>';
            $input_string .= '	</div>';
            $input_string .= '	<div class="span2">';
            $input_string .= '		<label for="field_content"><span>Name (Required):</span></label>';
            $input_string .= '	</div>';
            $input_string .= '</div>';
            $input_string .= '<div class="controls controls-row">';

            $check_error = (isset($error_field_src)) ? $error_field_src : '';

            if (!empty($check_error))
            {
                $input_string .= '	<div class="control-group error span4">';
                $input_string .= '		<input type="text" class="span4" name="field_src" id="field_src" class="oneline" value="' . $content['src'] . '">';
                $input_string .= '		<span class="help-inline">' . $check_error . '</span>';

                unset($check_error);
            } 
            else
            {
                $input_string .= '	<div class="span4">';
                $input_string .= '		<input type="text" class="span4" name="field_src" id="field_src" class="oneline" value="' . $content['src'] . '">';
            }

            $input_string .= '	</div>';

            $check_error = (isset($error_field_content)) ? $error_field_content : '';

            if (!empty($check_error))
            {
                $input_string .= '	<div class="control-group error span2">';
                $input_string .= '		<input type="text" class="span2" name="field_content" id="field_content" class="oneline" value="' . $content['content'] . '">';
                $input_string .= '		<span class="help-inline">' . $check_error . '</span>';
            } else
            {
                $input_string .= '	<div class="span2">';
                $input_string .= '		<input type="text" class="span2" name="field_content" id="field_content" class="oneline" value="' . $content['content'] . '">';
            }

            $input_string .= '	</div>';
            $input_string .= '</div>';

            if (!in_array('nostyle', $mode))
            {
                $input_string .= '<div class="controls">';
                $input_string .= '	<div class="span3">';
                $input_string .= '		<label for="field_style"><span>Style (optional):</span></label>';
                $input_string .= '	</div>';
                $input_string .= '	<div class="span3">';
                $input_string .= '		<label for="field_class"><span>Class (optional):</span></label>';
                $input_string .= '	</div>';
                $input_string .= '</div>';

                $input_string .= '<div class="controls controls-row">';
                $input_string .= '	<div class="span3">';
                $input_string .= '		<input type="text" class="span3" name="field_style" id="field_style" class="oneline" value="' . $content['style'] . '">';
                $input_string .= '	</div>';
                $input_string .= '	<div class="span3">';
                $input_string .= '		<input type="text" class="span3" name="field_class" id="field_class" class="oneline" value="' . $content['class'] . '">';
                $input_string .= '	</div>';
                $input_string .= '</div>';
            }

            return $input_string;
        } 
        else if ($type == 'image')
        {
            // check for empty array values, and populate with empty data if found lacking
            $chk_keys = (array('src', 'alt', 'class', 'style'));
            if (!is_array($content))
                    $content = array();
            
            foreach ($chk_keys as $key)
            {
                if (!isset($content[$key]))
                    $content[$key] = '';
            }

            $input_string = '<div class="row"><strong>Image Manager</strong><br /><small>* This will only work in Chrome or Firefox. After choosing image, be sure to click the Upload button, followed by Add / Save.</small></div>';
            $input_string .= '<div id="preview_image">';
            if (!empty($content['src']))
            {
                $input_string .= '<img src="' . SITE_PATH . 'index.php/tools/resizeimage/resources:public:' . str_replace("/", ":", $content["src"]) . '/100/100" />';
            }
            $input_string .= '</div>';
            $input_string .= '<div class="upload_control">';
            $input_string .= '	<input type="hidden" name="MAX_FILE_SIZE" value="2048000" />';
            $input_string .= '	<div class="row"><input name="fileToUpload" type="file" id="fileToUpload" /></div>';
            $input_string .= '	<div class="row"><input type="button" class="btn" id="doUpload" value="Upload File" /></div>';
            $input_string .= '	<div id="loading"></div>';
            $input_string .= '</div>';
            $input_string .= '<hr />';
            if (!in_array('noadv', $mode))
            {
                $input_string .= '<div class="row">Advanced Image Settings</div>';
                $input_string .= '<div class="controls">';
                $input_string .= '	<div class="span4">';
                $input_string .= '		<label for="field_src"><span>Src (valid url or use image manager):</span></label>';
                $input_string .= '	</div>';
                $input_string .= '	<div class="span2">';
                $input_string .= '		<label for="field_alt"><span>Alt (optional):</span></label>';
                $input_string .= '	</div>';
                $input_string .= '</div>';
                $input_string .= '';

                $input_string .= '<div class="controls controls-row">';

                $check_error = (isset($error_field_src)) ? $error_field_src : '';

                if (!empty($check_error))
                {
                    $input_string .= '	<div class="control-group error span4">';
                    $input_string .= '		<input type="text" class="span4" name="field_src" id="field_src" class="oneline" value="' . $content['src'] . '">';
                    $input_string .= '		<span class="help-inline">' . $check_error . '</span>';
                } else
                {
                    $input_string .= '	<div class="span4">';
                    $input_string .= '		<input type="text" class="span4" name="field_src" id="field_src" class="oneline" value="' . $content['src'] . '">';
                }

                $input_string .= '	</div>';
                $input_string .= '	<div class="span2">';
                $input_string .= '		<input type="text" class="span2" name="field_alt" id="field_alt" class="oneline" value="' . $content['alt'] . '">';
                $input_string .= '	</div>';
                $input_string .= '</div>';
            }

            if (!in_array('nostyle', $mode))
            {
                $input_string .= '<div class="controls">';
                $input_string .= '	<div class="span3">';
                $input_string .= '		<label for="field_style"><span>Style (optional):</span></label>';
                $input_string .= '	</div>';
                $input_string .= '	<div class="span3">';
                $input_string .= '		<label for="field_class"><span>Class (optional):</span></label>';
                $input_string .= '	</div>';
                $input_string .= '</div>';

                $input_string .= '<div class="controls controls-row">';
                $input_string .= '	<div class="span3">';
                $input_string .= '		<input type="text" class="span3" name="field_src" id="field_style" class="oneline" value="' . $content['style'] . '">';
                $input_string .= '	</div>';
                $input_string .= '	<div class="span3">';
                $input_string .= '		<input type="text" class="span3" name="field_alt" id="field_class" class="oneline" value="' . $content['class'] . '">';
                $input_string .= '	</div>';
                $input_string .= '</div>';
            }

            return $input_string;
        } else
        {
            $error = '<p>Please edit the block to use a valid content type:</p><ul>';
            foreach ($this->content_types as $content_type)
            {
                $error .= '<li>' . $content_type . '</li>';
            }
            $error .= '</ul>';

            return $error;
        }
    }
}