<?php

class Login extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        /*
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('cms/login');
        }
        else
        {
            echo $this->input->post('username');
            echo $this->input->post('password');
            $this->load->view('cms/login_loading');
        }*/
    }
}