<?php

class Login extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
    }
    
    public function logout()
    {
        $this->load->helper('url');
        $this->auth->log_out();
        redirect(base_url());
    }
    
    public function index()
    {
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
            // validate the user name and password
            if ($this->auth->validate_login($this->input->post('username'), $this->input->post('password')))
            {
                $this->load->view('cms/login_loading');
            }
            else
            {
                $notice['alerts'] = array('error' => 'The system was unable to authenticate you.');
                $data['alerts'] = $this->load->view('templates/tek_notice', $notice, true);
                $data['js'] = '<script type="text/javascript">jQuery.colorbox.resize();</script>';
                $this->load->view('cms/login', $data);
            }
        }
    }
}