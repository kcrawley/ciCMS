<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>wwwTEK CMS</title>
        <link href="<?php echo $app_resources; ?>css/tek_style.less" media="screen" rel="stylesheet" type="text/less">
        <script type="text/javascript" src="<?= $app_resources ?>javascript/less.js"></script>
        <script type="text/javascript" src="<?= $app_resources ?>javascript/jquery-1.8.3.min.js"></script>
        <script type="text/javascript" src="<?= $app_resources ?>javascript/jquery-ui-1.9.2.custom.min.js"></script>
        <script type="text/javascript" src="<?= $app_resources ?>javascript/jquery-ui-timepicker-addon.js"></script>
        <link href="<?= $app_resources ?>css/humanity/jquery-ui-1.9.2.custom.min.css" rel="stylesheet">
        <link href="<?= $app_resources ?>css/jquery-ui-timepicker.css" rel="stylesheet">
        <link href="<?= $site_resources; ?>bootstrap/css/bootstrap.css" rel="stylesheet">
        <script type="text/javascript">$.noConflict();</script>

        <!-- tiny_mce -->
        <script type="text/javascript" src="<?php echo $app_resources; ?>javascript/tiny_mce/tiny_mce.js"></script>

        <script type="text/javascript">

            jQuery(document).ready(function($) {

                $('#tek_cancel, #tek_close').live('click', function(e) {
                    e.preventDefault();
                    parent.jQuery.colorbox.close();
                });

            });

        </script>
    </head>

    <body class="tek_page">