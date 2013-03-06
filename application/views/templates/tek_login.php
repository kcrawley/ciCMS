<link href="<?php echo APP_RESOURCES; ?>css/tek_style.less" media="screen" rel="stylesheet" type="text/less">
<script type="text/javascript" src="<?php echo APP_RESOURCES ?>javascript/less.js"></script>
<script type="text/javascript" src="<?php echo APP_RESOURCES; ?>javascript/colorbox/colorbox.js"></script>
<link href="<?php echo APP_RESOURCES; ?>javascript/colorbox/colorbox.css" media="screen" rel="stylesheet" type="text/css">

<script type="text/javascript">
    $(document).ready(function() {
        $.colorbox({
            transition: 'fade',
            initialWidth: '50px',
            initialHeight: '50px',
            overlayClose: false,
            escKey: false,
            scrolling: false,
            opacity: .6,
            href: '<?php echo SITE_PATH; ?>index.php/login'
        });
    });
</script>