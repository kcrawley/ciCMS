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
        if (empty($selected_section)) {
            $selected_section = $this->get_data($mode . '_mode', false);
        }

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

    /**
     * Builds nav widget (left side) used within the CMS dashboard
     * 
     * @todo Move the data to a database
     *
     * @access	public
     * @param	string, string
     * @return	string
     */
    function cms_nav($selected_section = '', $selected_subsection = '') {
        $sections = array(
            array(
                'dashboard' => 'inactive'
            ),
            array(
                'users' => 'inactive',
                'manage_users' => 'inactive',
                'create_user' => 'inactive'
            ),
            array(
                'settings' => 'inactive',
                'change_password' => 'inactive',
                'manage_events' => 'inactive',
                'manage_carousel' => 'inactive',
                'manage_blog' => 'inactive',
                'manage_gallery' => 'inactive',
                'manage_shop' => 'inactive'
            )
        );

        foreach ($sections as &$section) {
            if (array_key_exists($selected_section, $section)) {
                $section[$selected_section] = 'active';
            }
            if (array_key_exists($selected_subsection, $section)) {
                $section[$selected_subsection] = 'active';
            }
        }

        $nav = '<ul class="tek_nav">';
        $nav .= '<li class="' . $sections[0]['dashboard'] . '">
					<a href="../dashboard/index.php">Dashboard</a>
				</li>';
        $nav .= '<li class="' . $sections[1]['users'] . '">
					<span>Users</span>
					<ul>
						<li class="' . $sections[1]['manage_users'] . '">
							<a href="#">Manage users</a>
						</li>
						<li class="' . $sections[1]['create_user'] . '">
							<a href="#">Create User</a>
						</li>
					</ul>
				</li>';
        $nav .= '<li class="' . $sections[2]['settings'] . '">
					<span>Settings</span>
					<ul>
						<li class="' . $sections[2]['change_password'] . '">
							<a href="../settings/password.php">Change Password</a>
						</li>
						<li class="' . $sections[2]['manage_events'] . '">
							<a href="../settings/events.php">Manage Events</a>
						</li>
						<li class="' . $sections[2]['manage_carousel'] . '">
							<a href="../settings/carousel.php">Manage Carousel</a>
						</li>
						<li class="' . $sections[2]['manage_blog'] . '">
							<a href="../settings/blog.php">Manage Blog</a>
						</li>
						<li class="' . $sections[2]['manage_gallery'] . '">
							<a href="../settings/gallery.php">Manage Galleries</a>
						</li>
						<li class="' . $sections[2]['manage_shop'] . '">
							<a href="../settings/shop.php">Manage Shop</a>
						</li>
					</ul>
				</li>';
        $nav .= '</ul>';

        return $nav;
    }
}