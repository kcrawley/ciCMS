<?php

/**
 * Builds the sites primary navigation based upon database entries
 */
class Nav_model extends CI_Model
{
    const NAV_HEADER = '<div class="navbar-wrapper">
		      <div class="nav-bumper">		
		        <div class="navbar">
		          <div class="navbar-inner">
		            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
		              <span class="icon-bar"></span>
		              <span class="icon-bar"></span>
		              <span class="icon-bar"></span>
		            </a>';
    const NAV_FOOTER = '</ul>
		            </div><!--/.nav-collapse -->
		          </div><!-- /.navbar-inner -->
		        </div><!-- /.navbar -->
		      </div> <!-- /.container -->
		    </div><!-- /.navbar-wrapper -->';
    
    /**
     * Fetches navigation information from the database, sorts it intelligently into an array then returns it for the view to sort it out.
     * 
     * params none
     * @return array
     */
    public function get_data()
    {
        $this->benchmark->mark('nav_data_start');
        if ($results = $this->db->query("SELECT * FROM tek_navigator WHERE active = 1"))
        {
            $nav_data = $results->fetchAll();

            foreach ($nav_data as $nav_row)
            {
                if ($nav_row['is_primary'])
                {
                    $nav_array['primary'][$nav_row['sort_key']] = array(
                        'id' => $nav_row['id'],
                        'name' => $nav_row['name'],
                        'href' => $nav_row['href'],
                        'type' => $nav_row['type'],
                        'order' => $nav_row['sort_key']
                    );
                }

                if (!$nav_row['is_primary'])
                {
                    $nav_array['sub'][$nav_row['sub_id']][$nav_row['sort_key']] = array(
                        'sub_id' => $nav_row['sub_id'],
                        'name' => $nav_row['name'],
                        'href' => $nav_row['href'],
                        'type' => $nav_row['type'],
                        'order' => $nav_row['sort_key']
                    );
                }
            }
            
            ksort($nav_array['primary']);
            foreach($nav_array['sub'] as &$sub_array)
            {
                ksort($sub_array);
            }
            $this->benchmark->mark("nav_data_end");
            return $nav_array;
        }
    }
}