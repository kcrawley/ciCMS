<div id="tek_wrapper">
    <h1>CMS Settings<div id="tek_close">Close Dashboard</div></h1>
    <div id="tek_content">
        <div class="tek_left">
            <?php echo $dashboard_nav; ?>
        </div>
        <div class="tek_right">
            <h2>Change Password</h2>
            <form action="" method="post" id="edit" class="form-horizontal">
                <?php echo isset($alerts) ? $alerts : ''; ?>

                <div class="control-group">
                    <label class="control-label" for="old_pass">Current Password <span class="required">*</span>:</label>
                    <div class="controls">
                        <input type="password" name="old_pass" id="old_pass" value="<?php echo set_value('old_pass'); ?>"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="new_pass">New Password <span class="required">*</span>:</label>
                    <div class="controls">
                        <input type="password" name="new_pass" id="new_pass" value="<?php echo set_value('new_pass'); ?>"/>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="new_pass2">Confirm New Password<span class="required">*</span>:</label>
                    <div class="controls">
                        <input type="password" name="new_pass2" id="new_pass2" value="<?php echo set_value('new_pass2'); ?>"/>
                    </div>
                </div>
                <div class="control-group submit_row">
                    <div class="controls">
                        <input type="submit" name="submit" class="submit btn" value="Submit" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>