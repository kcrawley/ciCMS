<?php

/**
 * Builds tabs used within the CMS dashboard.
 * TODO: Move this to ./app/cms/models/m_cms.php
 *
 * @access	public
 * @param	string, string, string
 * @return	string
 */
class Dashboard_model extends CI_Model {

    function cms_tabs($mode = 'tab', $selected_section = '', $default = 'modify') {
        /*if (empty($selected_section)) {
            $selected_section = $this->get_data($mode . '_mode', false);
        }*/

        $sections = array(
            'modify' => 'inactive',
            'manage' => 'inactive'
        );

        if ($mode == 'event_tab') {
            $sections['category'] = 'inactive';
        }
        if ($mode == 'gallery_tab') {
            $sections['gallery'] = 'inactive';
            $sections['image_edit'] = 'inactive';
        }
        if ($mode == 'shop_tab') {
            $sections['modify_product'] = 'inactive';
            $sections['manage_product'] = 'inactive';
        }
        if (array_key_exists($selected_section, $sections)) {
            $sections[$selected_section] = 'active';
        } else {
            $sections[$default] = 'active';
        }

        $nav = '<ul class="nav nav-tabs">';
        $nav .= '<li class="' . $sections['modify'] . '">';
        $nav .= '<a href="?mode=modify">Create / Modify</a>';
        $nav .= '</li>';
        $nav .= '<li class="' . $sections['manage'] . '">';
        $nav .= '<a href="?mode=manage">Manage / Delete</a>';
        $nav .= '</li>';

        if ($mode == 'shop_tab') {
            $nav = '<ul class="nav nav-tabs">';
            $nav .= '<li class="' . $sections['modify'] . '">';
            $nav .= '<a href="?mode=modify">Add/Modify Category</a>';
            $nav .= '</li>';
            $nav .= '<li class="' . $sections['manage'] . '">';
            $nav .= '<a href="?mode=manage">Manage Categories</a>';
            $nav .= '</li>';
        }

        if (isset($sections['modify_product'])) {
            $nav .= '<li class="' . $sections['modify_product'] . '">';
            $nav .= '<a href="?mode=modify_product">Add/Modify Product</a>';
            $nav .= '</li>';
        }
        if (isset($sections['manage_product'])) {
            $nav .= '<li class="' . $sections['manage_product'] . '">';
            $nav .= '<a href="?mode=manage_product">Manage Products</a>';
            $nav .= '</li>';
        }
        if (isset($sections['category'])) {
            $nav .= '<li class="' . $sections['category'] . '">';
            $nav .= '<a href="?mode=category">Edit Categories</a>';
            $nav .= '</li>';
        }
        if (isset($sections['gallery'])) {
            $nav .= '<li class="' . $sections['gallery'] . '">';
            $nav .= '<a href="?mode=gallery">Manage Images</a>';
            $nav .= '</li>';
        }
        if (isset($sections['image_edit'])) {
            $nav .= '<li class="' . $sections['image_edit'] . '">';
            $nav .= '<a href="?mode=image_edit">Image Edit</a>';
            $nav .= '</li>';
        }
        $nav .= '</ul>';

        return $nav;
    }
    
    function get_dash_nav($selected_section = '', $selected_subsection = '') {
       $sql = "SELECT 
           a.key_name, a.text, a.link, b.key as section_key, 
           b.id as section_id, b.name as section_name
           FROM tek_dash_nav a 
           LEFT JOIN tek_dash_sections b ON a.section = b.id
           ORDER BY section, sort_key";
        
       return ($this->db->query($sql)->result_array());
    }
}