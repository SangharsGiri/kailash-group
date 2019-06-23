<div class="row">
    <div class="col-lg-12">
        <h1><?php echo $title; ?> <small>Navigation: <?php echo $navigation['name']; ?></small></h1>
        <?php
        if ($this->session->flashdata('success') != "") {
            ?>
            <div class="alert alert-success alert_box">
                <a href="#" class="close alert_message" data-dismiss="alert" aria-label="close"><i
                        class="fa fa-times"></i></a>
                <strong>Success !</strong> <?php echo $this->session->flashdata('success'); ?>.
            </div>
            <?php
        }
        ?>
        <?php if ($this->session->flashdata('error') != "") {

            ?>
            <div class="alert alert-danger alert_box">
                <a href="#" class="close" data-dismiss="alert" aria-label="close"><i
                        class="fa fa-times"></i></a>
                <strong>Error!</strong>  <?php echo $this->session->flashdata('error'); ?>.
            </div>
            <?php
        }
        ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">

        <div class="span12">

            <?php echo form_open('primary_menu/add/'.$navigation['id'], array('class'=>'form-horizontal')); ?>
            <fieldset>
                <div class="control-group">
                    <label class="control-label" for="name">Name</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" id="name" name="content_page_title" size="38" value="<?php echo set_value('name'); ?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="url">URL</label>
                    <div class="controls">
                        <input type="text" class="input-xlarge" id="url" name="content_url" size="38" value="<?php echo set_value('url'); ?>">
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="parent_id">Parent</label>
                    <div class="controls">
                        <?php echo form_dropdown('parent_id', $dropdown, 'class="form-control"'); ?>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary add_menu_btn">Add item</button>
                    <a class="btn menu_cancel_link" href="<?php echo site_url('primary_menu'); ?>">Cancel</a>
                </div>
            </fieldset>
            <?php echo form_close(); ?>
        </div>

    </div>
</div>
