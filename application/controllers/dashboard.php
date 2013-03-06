<?php

class Dashboard extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('dashboard_model', '', true);
    }
    
    public function index($mode = 'dashboard')
    {
        $data['app_resources'] = APP_RESOURCES;
        $data['site_resources'] = SITE_RESOURCES;
        $data['dashboard_nav'] = $this->dashboard_model->cms_nav($mode);
        
        $this->load->view('dashboard/templates/dash_head', $data);
        $this->load->view('dashboard/'.$mode, $data);
        $this->load->view('dashboard/templates/dash_footer', $data);
    }
}