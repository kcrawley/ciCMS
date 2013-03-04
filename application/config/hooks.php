<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/
/*
 * NavRender hook - builds the primary site navigation from database
 * and loads it into the $data var for use in the view
 */
$hook['post_controller_constructor'][] = array(
    'class' =>  'NavRender',
    'function'  =>  'render_nav',
    'filename'  =>  'Navrender.php',
    'filepath'  =>  'hooks'
);

/*
 * TEK hook - Header Process
 * Builds the custom headers needed to load the CMS toolbar and editing systems
 */
$hook['post_controller_constructor'][] = array(
    'class'     =>  'Tek',
    'function'  =>  'build_headers',
    'filename'  =>  'Tek.php',
    'filepath'  =>  'hooks'
);



/* End of file hooks.php */
/* Location: ./application/config/hooks.php */