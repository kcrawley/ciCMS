<?php

class Navrender extends CI_Controller
{
    private $CI;
    
    function __construct()
    {
        $this->CI = & get_instance();
        $this->CI->load->model('nav_model', '', true);
    }

    function render_nav()
    {
        $this->CI->load->vars(array(
            'site_nav'      =>  $this->CI->nav_model->get_data(),
            'nav_header'    =>  nav_model::NAV_HEADER,
            'nav_footer'    =>  nav_model::NAV_FOOTER
        ));
    }
}