<?php

class Tek extends CI_Model
{

    private $CI;
    private $fc_path;

    function __construct()
    {
        $this->fc_path = str_replace("\\", "/", FCPATH);
        $this->CI = & get_instance();
    }

    public function build_headers()
    {
        $this->CI->load->vars(array(
            'tek_head' => $this->head(),
            'tek_body' => $this->body(),
            'tek_toolbar' => $this->toolbar()
        ));
    }

    private function head()
    {
        $tek_login = ($this->CI->uri->segment(2) == 'dologin') ? $this->CI->load->view('templates/tek_login.php', '', true) : '';
        return ($this->CI->auth->logged_in()) ? $this->CI->load->view('templates/tek_head.php', '', true) : $tek_login;
    }

    private function body()
    {
        return ($this->CI->auth->check_auth_level('cms_toolbar')) ? ' tek_editing' : '';
    }

    private function toolbar()
    {
        if ($this->CI->auth->check_auth_level('cms_toolbar'))
        {
            $data['site_path'] = SITE_PATH;
            $data['username'] = $this->CI->session->userdata('username');
            return $this->CI->load->view('templates/tek_toolbar.php', $data, true);
        } 
        else
        {
            return '';
        }
    }

}