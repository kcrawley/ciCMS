<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- public header -->
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <meta name="description" content="Cumberland Photography - Serving Cumberland County and surrounding areas. Photography services, senior portraits, family portraits, weddings, events and more!">
    <meta name="author" content="Kevin Crawley (kcmastrpc@gmail.com)">

    <!-- Le styles (css)-->
    <link href="<?php echo SITE_RESOURCES; ?>css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo SITE_RESOURCES; ?>css/bootstrap-responsive.css" rel="stylesheet">
    <link href="<?php echo SITE_RESOURCES; ?>css/prettyPhoto.css" rel="stylesheet">
    <link href="<?php echo APP_RESOURCES; ?>javascript/colorbox/colorbox.css" media="screen" rel="stylesheet" type="text/css">
    <link href="<?php echo SITE_RESOURCES; ?>css/style.css" rel="stylesheet">
    <link href="<?php echo SITE_RESOURCES; ?>css/main.css" rel="stylesheet">
    <link href="<?php echo SITE_RESOURCES; ?>css/parallax-slider.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Droid+Sans:400,700">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Droid+Serif">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Boogaloo">
    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Economica:700,400italic">
    <script src="<?php echo SITE_RESOURCES; ?>javascript/jquery-1.8.2.js"></script>
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <?php echo $tek_head//$TEK->head(); ?>

  </head>

  <body class="home<?php echo $tek_body;//$TEK->body_class(); ?><?php //echo $this->get_data('page_class', FALSE); ?>">

  <?php echo $tek_toolbar;//$TEK->toolbar();