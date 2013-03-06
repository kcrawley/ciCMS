<?php
print_r('<header><div class="container">' . $nav_header);

foreach ($site_nav['primary'] as $nav_primary):
    $li_active = '';

    // output the header

    if ($nav_primary['type'] == 0)
        print_r('<a class="brand" href="' . $nav_primary['href'] . '">' . $nav_primary['name'] . '</a>
            <div class="nav-collapse collapse"><ul class="nav">');

    if (array_key_exists($nav_primary['id'], $site_nav['sub']))
    {
        $sub_nav = '';

        foreach ($site_nav['sub'][$nav_primary['id']] as $subnav_row)
        {
            //$li_active = (strtolower($location) == strtolower($subnav_row['name'])) ? " class=\"active\"" : "";
            switch ($subnav_row['type'])
            {
                case 1: $sub_nav .= "<li" . $li_active . "><a href=\"" . $subnav_row['href'] . "\">" . $subnav_row['name'] . "</a></li>";
                    break;
                case 2: $sub_nav .= "<li class=\"divider\"></li>";
                    break;
                case 3: $sub_nav .= "<li class=\"nav-header\">" . $subnav_row['name'] . "</li>";
                    break;
            }
        }
        print_r('<li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">' . $nav_primary['name'] . '<b class="caret"></b></a>
                <ul class="dropdown-menu">' . $sub_nav . '</ul></li>');
    } 
    else if ($nav_primary['type'] > 0)
    {
        print_r('<li' . $li_active . '><a href="' . $nav_primary['href'] . '">' . $nav_primary['name'] . '</a></li>');
    }
endforeach;
print_r($nav_footer . '</div></header>');