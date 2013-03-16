<?php

/**
 * tek_notice.php - revised 03/02/2013
 * Handles error/notice/alert outputting.
 */
if (is_array($alerts))
{
    $alert_data = '';
    foreach ($alerts as $key => $value)
    {
        $alert_data .= '<div class="alert alert-' . $key . '">';
        $alert_data .= '<button type="button" class="close" data-dismiss="alert">&times;</button>';
        $alert_data .= '<span>' . $value . '</span>';
        $alert_data .= '</div>';
    }
    echo $alert_data;
}