<?php

class Pages extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('engine_model', '', true);
    }
    
    public function view($page = 'home', $extra = NULL)
    {
        $this->output->enable_profiler(TRUE);
        if (!file_exists('application/views/pages/'.$page.'.php'))
        {
            show_404();
        }
        // building initial database stuff
        $data['promo1'] = $this->engine_model->display_block(array(
            'id'=>'promo1', 
            'type'=>'image', 
            'page'=>'home', 
            array(
                'max_width'=>'100'
                )
            )
        );
        
        $data['title'] = ucfirst($page);
        $data['site_resources'] = SITE_RESOURCES;
        
        $this->load->view('templates/public_header', $data);
        $this->load->view('templates/public_nav', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/public_footer', $data);
    }
}