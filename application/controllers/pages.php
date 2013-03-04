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
        $data['hero_unit'] = $this->engine_model->display_block(array(
            'id'=>'hero_unit', 
            'type'=>'textarea', 
            'page'=>'home'
        ));
        
        $data['hero_link'] = $this->engine_model->display_block(array(
            'id'=>'hero_link',
            'type'=>'link',
            'page'=>'home'
        ));
        
        $data['promo_box_2'] = $this->engine_model->display_block(array(
            'id'=>'promo_box_2',
            'type'=>'wysiwyg',
            'page'=>'home'
        ));
        
        $data['promo_box_3'] = $this->engine_model->display_block(array(
            'id'=>'promo_box_3',
            'type'=>'wysiwyg',
            'page'=>'home'
        ));
        
        $data['item_header'] = $this->engine_model->display_block(array(
            'id'=>'item_header',
            'type'=>'oneline',
            'page'=>'home'
        ));
        
        $data['item_image_1'] = $this->engine_model->display_block(array(
            'id'=>'item_image_1',
            'type'=>'image',
            'page'=>'home'
        ));
        
        $data['item_image_2'] = $this->engine_model->display_block(array(
            'id'=>'item_image_2',
            'type'=>'image',
            'page'=>'home'
        ));
        
        $data['item_image_3'] = $this->engine_model->display_block(array(
            'id'=>'item_image_3',
            'type'=>'image',
            'page'=>'home'
        ));
        
        $data['item_link_1'] = $this->engine_model->display_block(array(
            'id'=>'item_link_1',
            'type'=>'link',
            'page'=>'home'
        ));
        
        $data['item_link_2'] = $this->engine_model->display_block(array(
            'id'=>'item_link_2',
            'type'=>'link',
            'page'=>'home'
        ));
        
        $data['item_link_3'] = $this->engine_model->display_block(array(
            'id'=>'item_link_3',
            'type'=>'link',
            'page'=>'home'
        ));
        
        $data['item_text_1'] = $this->engine_model->display_block(array(
            'id'=>'item_text_1', 
            'type'=>'textarea', 
            'page'=>'home'
        ));
        
        $data['item_text_2'] = $this->engine_model->display_block(array(
            'id'=>'item_text_2', 
            'type'=>'textarea', 
            'page'=>'home'
        ));
        
        $data['item_text_3'] = $this->engine_model->display_block(array(
            'id'=>'item_text_3', 
            'type'=>'textarea', 
            'page'=>'home'
        ));
        
        
        
        $data['title'] = ucfirst($page);
        $data['site_resources'] = SITE_RESOURCES;
        
        $this->load->view('templates/public_header', $data);
        $this->load->view('templates/public_nav', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/public_footer', $data);
    }
}