<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /**
     * Function to display editable fields to the view
     *
     * @access	private
     * @param	string, string, string (comma-seperate option)
     * 
     * @return	string
     */
if ( ! function_exists('generate_field'))
{
    function generate_field($type, $content, $mode = array())
    {
        if (count($mode) > 0)
        {
            $mode = (strpos($mode, ',')) ? explode(',', strtolower($mode)) : array(strtolower($mode));
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
            // check for empty array values, and populate with empty data if found lacking
            $chk_keys = (array('content', 'src', 'target', 'class', 'style'));
            if (!is_array($content))
                    $content = array();
            
            foreach ($chk_keys as $key)
            {
                if (!isset($content[$key]))
                    $content[$key] = '';
            }

            $input_string = '<div class="controls">';
            $input_string .= '	<div class="span4">';
            $input_string .= '		<label for="field_src"><span>HREF (valid url - required):</span></label>';
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