<?php

class Tek extends CI_Model
{
    private $CI;
    
    function __construct()
    {
        $this->CI = & get_instance();
    }
   
    public function build_headers()
    {
        $this->CI->load->vars(array(
            'tek_head'      =>  $this->head(),
            'tek_body'      =>  $this->body(),
            'tek_toolbar'   =>  $this->toolbar()
        ));
    }

    private function head()
    {
        //$fc_path = str_replace("\\", "/", FCPATH);
        
        //$tek_login = ($this->CI->uri->rsegment(4) === 'dologin') ? $this->ob_fetch($fc_path . 'application/views/templates/tek_login.php') : '';
        
        //return ($this->CI->auth->logged_in()) ? $this->ob_fetch($fc_path . 'application/views/templates/tek_head.php') : $tek_login;
        
        return '';
    }
    
    private function body()
    {
        
        //return ($this->CI->auth->check_auth_level('cms_toolbar')) ? ' tek_editing' : '';
        return '';
    }
    
    private function toolbar()
    {
        //return ($this->CI->auth->check_auth_level('cms_toolbar')) ? eval(file_get_contents(BASEPATH . 'application/views/templates/tek_toolbar.php')) : '';
        return '';
    }
    
    private function ob_fetch($file)
    {
        /*ob_start();
        include $file;
        $data = ob_get_contents();
        ob_end_clean();*/
        return $data;
    }
}