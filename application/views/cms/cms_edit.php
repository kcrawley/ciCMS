<script type="text/javascript" src="<?php echo $app_resources; ?>javascript/ajaxfileupload/ajaxfileupload.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
		
        $('#edit').submit(function(e){

            e.preventDefault();
			
            var id = "<?php echo $block_id; ?>";
            var type = $('#type').val();
            <?php echo $datastring; ?>
                
            $.ajax({
                type: "POST",
                url: "<?php echo $site_path; ?>index.php/cms/save",
                data: dataString,
                dataType: "text",
                cache: false,
                success: function(html) {
                    $('#cboxLoadedContent').html(html);
                }
            });
        });
		
        $('#tek_cancel').live('click', function(){
            if (tinyMCE.getInstanceById('field'))
            {
                tinyMCE.execCommand('mceFocus', false, 'field');
                tinyMCE.execCommand('mceRemoveControl', false, 'field');
            }
        });

        $('#doUpload').click(function(e){
            e.preventDefault();	
            ajaxFileUpload();
        });
	
	
        function ajaxFileUpload()
        {
            //starting setting some animation when the ajax starts and completes
            $("#loading")
            .ajaxStart(function(){
                $(this).show();
            })
            .ajaxComplete(function(){
                $(this).hide();
            });
        
            /*
            prepareing ajax file upload
            url: the url of script file handling the uploaded files
                        fileElementId: the file type of input element id and it will be the index of  $_FILES Array()
            dataType: it support json, xml
            secureuri:use secure protocol
            success: call back function when the ajax complete
            error: callback function when the ajax failed
            
             */
            $.ajaxFileUpload({
                url:'<?php echo $site_path; ?>index.php/tools/fileupload/cms_image', 
                secureuri:false,
                fileElementId:'fileToUpload',
                dataType: 'json',
                success: function (data, status)
                {
                    if(typeof(data.error) != 'undefined')
                    {
                        if(data.error != '')
                        {
                            alert(data.error);
                        }else
                        {
                            $('#preview_image').empty();
							
                            var imgUrl = '<?php echo $site_path; ?>' + 'index.php/tools/resizeimage/resources:public:images:user:' + data.file + '/100/75';
                            var img = $('<img />').attr({ 'class': 'preview_img', 'src': imgUrl }).appendTo($('#preview_image'));
                            $('#field_src').val('images/user/' + data.file);
                            alert(data.msg);
                        }
                    }
                },
                error: function (data, status, e)
                {
                    alert(e);
                }
            }
        )
        
            return false;

        } 
    });
</script>
<?php echo $tiny_mce; ?>

<div id="tek_wrapper">
    <h1>wwwTEK CMS - Editor: <i><?php echo $block_id; ?></i></h1>
    <div id="tek_content" style="width: 100%; height: 100%;">
        <form action="" method="post" id="edit">
            <div>
                <div class="row">
                    <label for="field">Content Editor:</label>
                </div>            
                <div class="row">
                    <?php echo $block_cms; ?>
                    <input type="hidden" id="type" value="<?php echo $block_type; ?>">
                </div>   
                <div class="row submitrow">
                    <input type="submit" name="submit" class="submit btn" value="Submit Changes">
                    &nbsp;<a href="#" id="tek_cancel">Cancel</a>
                </div>         
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    jQuery('#tek_wrapper').delay(800).height();
    jQuery(this).delay(2500).colorbox.resize();
</script>