
<script type="text/javascript" src="<?= $app_resources; ?>javascript/ajaxfileupload/ajaxfileupload.js"></script>

<script type="text/javascript">
    jQuery(document).ready(function($) {

        $('#doUpload').click(function(e) {
            e.preventDefault();

            ajaxFileUpload();
        });

        $("#start_date").datetimepicker({
            altField: "#start_time",
            timeFormat: "hh:mm tt"
        });
        $("#end_date").datepicker();
        $("#end_time").timepicker({
            timeFormat: "hh:mm tt"
        });

    });
</script>
<div id="tek_wrapper">
    <h1>CMS Settings<div id="tek_close">Close Dashboard</div></h1>
    <div id="tek_content">

        <div class="tek_left">
            <?= $dashboard_nav; ?>
        </div>
        <div class="tek_right">
            <?= $dashboard_tabs; ?>

            <div>
                <?= $alerts; ?>
            </div>


            <?php
            
            if ($nav_mode == 'modify') {
                ?>
                <form action="" method="post" id="edit" class="widelabel">
                
                <?= $image_field ?>
                    
                    <hr />

                    <div class="controls">
                        <div class="span3">
                            <label for="start_date"><span>Start Date (required):</span></label>
                        </div>
                        <div class="span3">
                            <label for="end_date"><span>Start Time (required):</span></label>
                        </div>
                    </div>

                    <div class="controls controls-row">

    <?php $check_error = $error_start_date;

    if (!empty($check_error)) {
        ?>
                            <div class="control-group error span3">
                                <input type="text" class="span3" name="start_date" id="start_date" value="<?php echo set_value('start_date'); ?>" />
                                <span class="help-inline"><?= $check_error ?></span>
                            <?php } else { ?>
                                <div class="span3">
                                    <input type="text" class="span3" name="start_date" id="start_date" value="<?php echo set_value('start_date'); ?>" />
                                <?php } unset($check_error); ?>
                            </div>
                            <?php $check_error = $error_start_time;

                            if (!empty($check_error)) {
                                ?>
                                <div class="control-group error span3">
                                    <input type="text" class="span3" name="start_time" id="start_time" value="<?php echo set_value('start_time'); ?>" />
                                    <span class="help-inline"><?= $check_error ?></span>
                                <?php } else { ?>
                                    <div class="span3">
                                        <input type="text" class="span3" name="start_time" id="start_time" value="<?php echo set_value('start_time'); ?>" />
                                    <?php } unset($check_error); ?>
                                </div>
                            </div>

                            <div class="controls">
                                <div class="span3">
                                    <label for="start_time"><span>End Date (optional):</span></label>
                                </div>
                                <div class="span3">
                                    <label for="end_time"><span>End Time (optional):</span></label>
                                </div>
                            </div>

                            <div class="controls controls-row">
                                <div class="span3">
                                    <input type="text" class="span3" name="end_date" id="end_date" value="<?php echo set_value('end_date'); ?>" />
                                </div>
                                <div class="span3">
                                    <input type="text" class="span3" name="end_time" id="end_time" value="<?php echo set_value('end_time'); ?>" />
                                </div>
                            </div>

                            <div class="controls">
                                <div class="span6">
                                    <label for="event_name"><span>Event Name (required):</span></label>
                                </div>
                            </div>

                            <div class="controls control-row">
                                <?php $check_error = $error_event_name;

                                if (!empty($check_error)) {
                                    ?>
                                    <div class="control-group error span6">
                                        <input type="text" class="span6" name="event_name" id="event_name" value="<?php echo set_value('event_name'); ?>" />
                                        <span class="help-inline"><?= $check_error ?></span>
    <?php } else { ?>
                                        <div class="span6">
                                            <input type="text" class="span6" name="event_name" id="event_name" value="<?php echo set_value('event_name'); ?>" />
    <?php } unset($check_error); ?>
                                    </div>

                                </div>

                                <div class="controls">
                                    <div class="span6">
                                        <label for="event_desc"><span>Event Description (optional):</span></label>
                                    </div>
                                </div>

                                <div class="controls control-row">
                                    <div class="span6">
                                        <textarea rows="2" class="span6" name="event_desc" id="event_desc" /><?php echo set_value('event_desc'); ?></textarea>
                                    </div>
                                </div>

                                <div class="controls">
                                    <div class="span3">
                                        <label for="cat_id"><span>Category (required):</span></label>
                                    </div>
                                    <div class="span3">
                                        <select name="cat_id">
                                            <?php echo $cat_options; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="controls">
                                    <div class="form-actions span6">
    <?php
    if (isset($_REQUEST['modify'])) {
        ?>
                                            <input type="hidden" name="id" value="<?= $id; ?>" />
                                            <input type="submit" name="submit" class="btn btn-primary" value="Save Changes" />
                                        <?php
                                        } else {
                                            ?>
                                            <input type="submit" name="submit" class="btn btn-primary" value="Add Event" />
                                        <?php } ?>
                                    </div>
                                </div>
                                </form>
                                    <?php } ?>

<?php
if ($nav_mode == 'manage') {
    echo $this->TEK->Cms->generate_pagination('tek_events');
    echo $this->TEK->Cms->generate_table('event');
}

if ($nav_mode == 'category') {
    ?>
                                <form action="" method="post" id="edit" class="widelabel">
                                    <div class="controls">
                                        <div class="span3">
                                            <label for="name"><span>Category Name (required):</span></label>
                                        </div>
                                        <div class="span3">
                                            <label for="default"><span>Status: </span></label>
                                        </div>
                                    </div>

                                    <div class="controls controls-row">

    <?php $check_error = $this->TEK->Template->get_data('error_name');

    if (!empty($check_error)) {
        ?>
                                            <div class="control-group error span3">
                                                <input type="text" class="span3" name="name" id="name" value="<?= $this->get_data('name'); ?>" />
                                                <span class="help-inline"><?= $check_error ?></span>
    <?php } else { ?>
                                                <div class="span3">
                                                    <input type="text" class="span3" name="name" id="name" value="<?= $this->get_data('name'); ?>" />
                                            <?php } unset($check_error); ?>
                                            </div>

                                                <?php $checked = ($this->get_data('default')) ? ' checked' : ''; ?>
                                            <div class="span3">
                                                <label class="checkbox">
                                                    <input type="checkbox" name="default" value="1" <?= $checked; ?>/>Default Category
                                                </label>
                                            </div>
                                        </div>
                                        <div class="controls">
                                            <div class="form-actions span6">
    <?php
    if (isset($_REQUEST['modify_cat'])) {
        ?>
                                                    <input type="hidden" name="id" value="<?= $this->get_data('id'); ?>" />
                                                    <input type="submit" name="submit" class="btn btn-primary" value="Save Category Changes" />
                                                <?php
                                                } else {
                                                    ?>
                                                    <input type="submit" name="submit" class="btn btn-primary" value="Add Category" />
                                                <?php } ?>
                                            </div>
                                        </div>
                                </form>

                                <div class="span6">
                                    <hr />
    <?php
    echo $this->TEK->Cms->generate_pagination('tek_events_cat', 5, 'mode=' . $nav_mode);
    echo $this->TEK->Cms->generate_table('event_cat');
}
?>
                            </div>
                        </div>
                    </div>
                </div>