<?php

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('dashboard_model', '', true);
    }

    public function index($sel = 'dashboard', $sub_sel = 'dashboard', $data = array()) {
        $data['app_resources'] = APP_RESOURCES;
        $data['site_resources'] = SITE_RESOURCES;

        $data['dashboard_nav'] = $this->build_nav($sel, $sub_sel);

        $this->load->view('dashboard/templates/dash_head', $data);
        $this->load->view('dashboard/' . $sel, $data);
        $this->load->view('dashboard/templates/dash_footer', $data);
    }

    public function change_password() {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('old_pass', 'Current Password', 'required');
        $this->form_validation->set_rules('new_pass', 'New Password', 'required|matches[new_pass2]');
        $this->form_validation->set_rules('new_pass2', 'Confirm New Password', 'required');

        // checks to see if form validation is valid
        if ($this->form_validation->run() == FALSE) {
            // are there errors, or are we just visiting
            if ($errors = validation_errors()) {
                $notice['alerts'] = array('error' => $errors);
                $data['alerts'] = $this->load->view('templates/tek_notice', $notice, true);
            } else {
                $data = array();
            }
            $this->index('change_password', 'settings', $data);
        } else {
            // we check if the current password is valid
            if ($this->auth->validate_password($this->input->post('old_pass'))) {
                $this->auth->set_password($this->input->post('new_pass'));

                $notice['alerts'] = array('success' => 'Your request has been processed.');
                $data['alerts'] = $this->load->view('templates/tek_notice', $notice, true);

                $this->index('dashboard', 'dashboard', $data);
                // it's not, so we throw a generic error
            } else {
                $notice['alerts'] = array('error' => 'There was a problem processing your request.');
                $data['alerts'] = $this->load->view('templates/tek_notice', $notice, true);

                $this->index('change_password', 'settings', $data);
            }
        }
    }

    public function manage_events($mode = 'modify') {
        $this->load->helper(array('form', 'url', 'field'));
        $this->load->library('form_validation');

        $event_image = array('src' => '', 'alt' => '');
        /*$current_cat_id = $this->get_data('cat_id');

        if ($current_cat_id == '') {
            $current_cat_id = $this->TEK->Event->get_default();
        }

        if ($category_data = $this->TEK->Event->fetch_category()) {
            foreach ($category_data as $row) {
                $selected = ($current_cat_id == $row['id']) ? ' selected' : '';
                echo '<option value="' . $row['id'] . '"' . $selected . '>' . $row['name'] . '</option>';
            }
        } else {
            echo '<option>No categories available.</option>';
        }*/


        $data['dashboard_tabs'] = $this->dashboard_model->cms_tabs('event_tab', $mode);
        $data['nav_mode'] = $mode;
        $data['image_field'] = generate_field('image', $event_image, 'nostyle');

        $this->index('manage_events', 'settings', $data);
    }

    private function build_nav($selected_section, $selected_subsection) {
        $dash_nav = $this->dashboard_model->get_dash_nav();

        foreach ($dash_nav as $dash) {
            foreach ($dash as $dash_key => $dash_val) {
                if (!isset($dash_build[$dash['key_name']]))
                    $dash_build[$dash['key_name']] = array();

                $dash_build[$dash['key_name']] += array($dash_key => $dash_val);
            }

            if (!isset($active_tree[$dash['section_id']]))
                $active_tree[$dash['section_id']] = array();

            $active_tree[$dash['section_id']] += array($dash['key_name'] => 'inactive');

            if (array_key_exists($selected_section, $active_tree[$dash['section_id']]))
                $active_tree[$dash['section_id']][$selected_section] = 'active';

            if (array_key_exists($selected_subsection, $active_tree[$dash['section_id']]))
                $active_tree[$dash['section_id']][$selected_subsection] = 'active';
        }
        unset($dash_nav); // we don't need this anymore.
        $i = 1;
        $nav = '<ul class="tek_nav">';
        foreach ($active_tree as &$tree) {
            $nav .= '<li class="' . current($tree) . '">';

            if ($i > 1)
                $nav .= '<span>' . $dash_build[key($tree)]['text'] . '</span><ul>';

            foreach ($tree as $key => $value) {
                if ($i == 1 OR $key != $dash_build[$key]['section_key']) {
                    if ($i > 1)
                        $nav .= '<li class="' . $value . '">';

                    $nav .= '<a href="' . SITE_PATH . $dash_build[$key]['link'] . '">' . $dash_build[$key]['text'] . '</a>';

                    if ($i > 1)
                        $nav .= '</li>';
                }
            }

            if ($i > 1)
                $nav .= '</ul>';

            $nav .= '</li>';
            $i++;
        }
        $nav .= '</ul>';
        return $nav;
    }

}