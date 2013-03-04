<link href="<?php echo APP_RESOURCES; ?>css/tek_style.less" media="screen" rel="stylesheet" type="text/less">
<script type="text/javascript" src="<?php echo APP_RESOURCES ?>javascript/less.js"></script>
<!-- tiny_mce -->
<script type="text/javascript" src="<?php echo APP_RESOURCES; ?>javascript/tiny_mce/tiny_mce.js"></script>

<script type="text/javascript">
    $(document).ready(function($) {
	
        $('.tek_edit').each(function() {
            var height = $(this).outerHeight();
            if (height < 25) { height = 25; }
            var width = $(this).parent().width();
			
            $(this).height(height).width(width);
            $(this).find('.tek_edit_link').height(height-2).width(width-2);
        });

        $( '#myCarousel' ).bind('slid', function(e) {
            $('.item.active').each(function() {
	
                $('.tek_edit').each(function() {
                    var height = $(this).outerHeight();
                    if (height < 25) { height = 25; }
                    var width = $(this).parent().width();
				
                    $(this).height(height).width(width);
                    $(this).find('.tek_edit_link').height(height-2).width(width-2);
                });
				
            });
        });
		
        $('.tek_edit_type').mouseenter(function() {
            $(this).parent().find('.tek_edit_link').addClass('hover');
        }).mouseleave(function() {
            $(this).parent().find('.tek_edit_link').removeClass('hover');
        });
		
        $('#edit_toggle').click(function(e) {
            e.preventDefault();
			
            if ($(this).text() == 'Preview Page')
            {
                $(this).text('Edit Page');
            }
            else
            {
                $(this).text('Preview Page');
            }
            $('.tek_edit_type').toggle();
            $('.tek_edit_link').toggle();
        });
		
        $('.tek_edit_type, .tek_edit_link').click(function(e) {
            $(this).colorbox({
                transition: 'fade',
                initialWidth: '50px',
                initialHeight: '50px',
                scrolling: false,
                overlayClose: false,
                escKey: false,
                opacity: .6
            });
        });
		
        $('.tek_dashboard, .tek_password').click(function(e) {
            $(this).colorbox({
                transition: 'fade',
                initialWidth: '50px',
                initialHeight: '50px',
                overlayClose: true,
                escKey: true,
                opacity: .6,
                iframe: true,
                top: '28px',
                width: '940px',
                height: '90%'
            });
        });
    });
</script>