<?php if(isset($js)) echo $js; ?>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('#login').submit(function(e){
            e.preventDefault();
			
            var username = $('input#username').val();
            var password = $('input#password').val();
			
            var dataString = 'username=' + username + '&password=' + password;
			
            $.ajax({
                type: "POST",
                url: "<?php echo SITE_PATH; ?>index.php/login",
                data: dataString,
                cache: false,
                success: function(html) {
                    $('#cboxLoadedContent').html(html);
                }
            });
        });
		
        $('#tek_cancel').live('click', function(e){
            e.preventDefault();
            $.colorbox.close();
            var page = window.location.href;
            page = page.substring(0, page.lastIndexOf('index.php'));
            window.location = page;
        });
    });
</script>
<div id="tek_wrapper" style="width: 380px;">
    <h1>wwwTEK CMS</h1>
    <div id="tek_content">
        <?php if (isset($alerts)) {
        echo $alerts;
        } ?>
        <form action="" method="post" id="login">
            <div>
                <div class="row">
                    <label for="username">Username: <?php echo form_error('username'); ?></label>
                    <input type="text" name="username" id="username" value="<?php echo set_value('username'); ?>" class="">
                </div>            
                <div class="row">            
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" value="<?php echo set_value('password'); ?>" class="">
                </div>   
                <div class="row submitrow">
                    <input type="submit" name="submit" class="submit btn" value="Log In">
                    &nbsp;<a href="#" id="tek_cancel">Cancel</a>
                </div>         
            </div>
        </form>
    </div>
</div>