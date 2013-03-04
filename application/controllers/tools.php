<?php

class Tools extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }

    function fileupload()
    {
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']	= '500';
        $config['max_width'] = '2048';
        $config['max_height'] = '2048';
        
        $error = "";
        $msg = "";

        $fileElementName = 'fileToUpload';
        if (!empty($_FILES[$fileElementName]['error']))
        {
            switch ($_FILES[$fileElementName]['error'])
            {
                case '1':
                    $error = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
                    break;
                case '2':
                    $error = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
                    break;
                case '3':
                    $error = 'The uploaded file was only partially uploaded';
                    break;
                case '4':
                    $error = 'No file was uploaded.';
                    break;
                case '6':
                    $error = 'Missing a temporary folder';
                    break;
                case '7':
                    $error = 'Failed to write file to disk';
                    break;
                case '8':
                    $error = 'File upload stopped by extension';
                    break;
                case '999':
                default:
                    $error = 'No error code avaiable';
            }
        } 
        elseif (empty($_FILES['fileToUpload']['tmp_name']) || $_FILES['fileToUpload']['tmp_name'] == 'none')
        {
            $error = 'No file was uploaded..';
        }
        else
        {
            switch ($this->uri->rsegment(3))
            {
                case 'cms_image' : $config['upload_path'] = FCCPATH . 'resources/public/images/user/';
                    break;
            }
            $this->load->library('upload', $config);
            $this->upload->do_upload('fileToUpload');
        }
        /** outdated, need to update for use with CI
        elseif (!isset($_GET['gallery_upload']))
        {
            if (isset($_GET['upload_type']))
            {
                $success = move_uploaded_file($_FILES['fileToUpload']['tmp_name'], APP_PATH . 'resources/images/' . $_GET['upload_type'] . '/' . stripslashes($_FILES['fileToUpload']['name']));
            } else
            {
                $success = move_uploaded_file($_FILES['fileToUpload']['tmp_name'], APP_PATH . 'resources/images/user/' . $_FILES['fileToUpload']['name']);
            }
        } else
        {
            // gallery image uploader

            if (isset($_GET['gallery_id']) AND is_numeric($_GET['gallery_id']))
            {
                include(APP_PATH . "settings/models/m_settings.php");
                $Settings = new Settings();

                $gallery_key = $TEK->Gallery->get_gallery_key($_GET['gallery_id']);

                if (empty($gallery_key))
                {
                    $image_path = APP_PATH . 'resources/images/gallery/' . $_GET['gallery_id'] . '/';
                } else
                {
                    $image_path = APP_PATH . 'resources/images/gallery/protected/' . $gallery_key . '/' . $_GET['gallery_id'] . '/';
                }
            } else
            {
                $error = 'Gallery ID must be numeric.';
            }

            if (empty($error) AND !file_exists($image_path))
            {
                if (!$mkdir = mkdir($image_path, 0777, true))
                {
                    $error = 'Directory was not created successfully.';
                }
            }

            if (empty($error))
            {
                if ($success = move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $image_path . $_FILES['fileToUpload']['name']))
                {
                    $TEK->Template->set_data("gallery_id", $_GET['gallery_id']);
                    $TEK->Template->set_data("img_name", $_FILES['fileToUpload']['name']);

                    if ($database_write = $Settings->add_gallery_img())
                    {
                        $msg .= " Database: Write OK, ";
                    } else
                    {
                        $msg .= " Database: Write FAIL, ";
                        $error = "Failed to write database changes.";
                    }
                } else
                {
                    $error = 'There was a problem moving the uploaded file to target.';
                }
            }
        }
        */
        if ($data = $this->upload->data())
        {
            //$filename = $_FILES['fileToUpload']['name'];
            //$msg .= " File Name: " . $_FILES['fileToUpload']['name'] . ", ";
            //$msg .= " File Size: " . @filesize($_FILES['fileToUpload']['tmp_name']);
            //for security reason, we force to remove all uploaded file
            @unlink($_FILES['fileToUpload']);
        }
        echo "{";
        echo "error: '" . $this->upload->display_errors() . "',\n";
        echo "msg: '" . $data['file_size'] . "',\n";
        echo "file: '" . $data['file_name'] . "'\n";
        echo "}";
    }
    
    public function resizeimage()
    {
        if ($img_path = $this->uri->rsegment(3))
            $img_path = str_replace(':', '/', $img_path);
        
        $width = $this->uri->rsegment(4, 0);
        $height = $this->uri->rsegment(5, 0);
        
        if (!$width OR !$height)
        {
            // crzy logic
            $width = ($height) ? $height : $width;
            $height = ($width) ? $width : $height;
        }
        
        if (file_exists(FCCPATH . $img_path))
        {
            $config['image_library'] = 'gd2';
            $config['source_image'] = $img_path;
            $config['dynamic_output'] = TRUE;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = $width;
            $config['height'] = $height;

            $this->load->library('image_lib', $config);

            echo $this->image_lib->resize();
        }
        else
        {
            // we gonna do something else (i think)
        }
    }
}