<?php

class Pages extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function view($page = 'home', $extra = NULL)
    {
        $this->output->enable_profiler(TRUE);
        if (!file_exists('application/views/pages/'.$page.'.php'))
        {
            show_404();
        }
        
        $data['extra'] = ($extra) ? $extra : "";        
        $data['title'] = ucfirst($page);
        
        $this->benchmark->mark('header_start');
        $this->load->view('templates/public_header', $data);
        $this->benchmark->mark('header_end');
        
        $this->benchmark->mark('nav_start');
        $this->load->view('templates/public_nav', $data);
        $this->benchmark->mark('nav_end');
        
        $this->benchmark->mark('page_start');
        $this->load->view('pages/'.$page, $data);
        $this->benchmark->mark('page_end');
        
        $this->benchmark->mark('footer_start');
        $this->load->view('templates/public_footer', $data);
        $this->benchmark->mark('footer_end');
    }
    
    
}