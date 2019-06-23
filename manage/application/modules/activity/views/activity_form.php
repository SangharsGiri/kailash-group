<div class="row">
    <div class="col-lg-12">
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
<div class="panel panel-info">
<div class="panel-heading">
    <?php echo (isset($title) && $title !="") ? $title:""; ?>
</div>

<div class="panel-body">
<ul class="nav nav-tabs">
    <li class="active"><a href="#home" data-toggle="tab">General</a>
    </li>
    <li><a href="#meta" data-toggle="tab">Meta</a>
    </li>
</ul>
<form class="tab_form" method="post" action="" enctype="multipart/form-data">
<div class="tab-content">

<div class="tab-pane fade active in" id="home">

    <table class="form-table">
        <tbody>
        <tr valign="top">
            <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label for="admin_name">Activity Name<span class="asterisk">*</span>
                </label></th>
            <td style="background: transparent none repeat scroll 0% 0%;"><input type="text" name="activity_name" id="activity_name" size="50" value="<?php echo (isset($detail['activity_name']) && $detail['activity_name'] !="") ? $detail['activity_name']:""; ?>" data-validation="required" autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on"></td>
        </tr>
        <tr valign="top">
            <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label for="admin_name">Duration<span class="asterisk">*</span>
                </label></th>
            <td style="background: transparent none repeat scroll 0% 0%;"><input type="text" name="duration" id="duration" size="50" value="<?php echo (isset($detail['duration']) && $detail['duration'] !="") ? $detail['duration']:""; ?>" data-validation="required" autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on"></td>
        </tr>

        <?php
        $path  =  '../uploads/activity/';
        ?>
        <tr valign="top" id="featured_img">
            <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Featured Image</label></th>
            <td style="background: transparent none repeat scroll 0% 0%;">
                <?php
                if(isset($detail['featured_img']))
                {

                    ?>
                    <div class="remove_option featured_img">


                        <img src="<?php echo $path. $detail['featured_img'];?>" alt="featured_image" style="max-width: 940px; max-height: 360px;">

                        <span class="btn btn-info remove_btn" id="btn_remove">Remove</span>
                    </div>
                    <input type="hidden" name="pre_featuredimg" value="<?php echo $detail['featured_img']; ?>">
                    <div id="image_input">

                        <span>(Image Dimension 265*200 px)</span>
                        <input type="file" name="featured_img" id="featuredimg">
                        <span id="featured_error"></span>

                    </div>
                <?php
                }
                else
                {
                    ?>

                    <span>(Image Dimension 265*200 px)</span>
                    <input type="file" name="featured_img"  id="featuredimg" data-validation="required">
                    <span id="featured_error"></span>

                <?php
                }
                ?>


            </td>
        </tr>
        <tr valign="top">
            <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Banner Image</label></th>
            <td style="background: transparent none repeat scroll 0% 0%;">
                <?php
                if(isset($detail['banner_img']))
                {

                    ?>
                    <div class="remove_option1 banner_img">
                        <img src="<?php echo $path. $detail['banner_img'];?>" alt="banner_img" style="max-width: 940px; max-height: 360px;">

                        <span class="btn btn-info remove_btn" id="btn_remove1">Remove</span>
                    </div>
                    <input type="hidden" name="pre_bannerimg" value="<?php echo $detail['banner_img']; ?>">
                    <div id="image_input1">

                        <span>(Image Dimension 1140*350 px)</span>
                        <input type="file" name="banner_img" id="bannerimg">
                        <span id="banner_error"></span>

                    </div>
                <?php
                }
                else
                {
                    ?>

                    <span>(Image Dimension 1140*350 px)</span>
                    <input type="file" name="banner_img"  id="bannerimg" data-validation="required">
                    <span id="banner_error"></span>

                <?php
                }
                ?>


            </td>
        </tr>
        <tr valign="top" class="contact_detail">
            <th style="background: transparent none repeat scroll 0% 0%;" scope="row">
                <label>Description</label></th>
            <td style="background: transparent none repeat scroll 0% 0%;">
                <textarea rows="5" cols="10" name="description" id="content_body"><?php echo (isset($detail['description']) && $detail['description'] !="") ? $detail['description']:""; ?></textarea>
            </td>
        </tr>
        <tr valign="top" class="contact_detail">
            <th style="background: transparent none repeat scroll 0% 0%;" scope="row">
                <label>Tab</label></th>
            <td style="background: transparent none repeat scroll 0% 0%;">
                <textarea rows="5" cols="10" name="tab" id="tab-body"><?php echo (isset($detail['tab']) && $detail['tab'] !="") ? $detail['tab']:""; ?></textarea>
            </td>
        </tr>




        <tr valign="top">
            <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Published<span class="asterisk">*</span> </label></th>
            <td style="background: transparent none repeat scroll 0% 0%; padding: 6px 0 0 0;">

                <input type="radio" name="publish_status" <?php echo (isset($detail['publish_status']) && $detail['publish_status'] =="1")?"checked":"";?> class="regular-text" data-validation="required" value="1">Active
                <input type="radio" name="publish_status" <?php echo (isset($detail['publish_status']) && $detail['publish_status'] =="0")?"checked":"";?> class="regular-text" data-validation="required" value="0">Inactive
            </td>
        </tr>




        </tbody>
    </table>


</div>
<div class="tab-pane fade" id="meta">

    <table class="form-table">

        <tbody>
        <tr valign="top">
            <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label for="meta_description">Meta Description </label></th>
            <td style="background: transparent none repeat scroll 0% 0%;">
                <textarea name="meta_description" id="meta_description" rows="5" cols="100" data-validation="required"><?php echo (isset($detail['meta_description']) && $detail['meta_description'] !="") ? $detail['meta_description']:""; ?></textarea><br>

            </td>
        </tr>

        <tr valign="top">
            <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label for="meta_description">Meta Keywords </label></th>
            <td style="background: transparent none repeat scroll 0% 0%;">
                <textarea name="meta_keywords" rows="5" cols="100" data-validation="required"><?php echo (isset($detail['meta_keywords']) && $detail['meta_keywords'] !="") ? $detail['meta_keywords']:""; ?></textarea><br>

            </td>
        </tr>
<tr valign="top">

            <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label for="meta_title">Meta Title</label></th>

            <td style="background: transparent none repeat scroll 0% 0%;">

                <textarea name="meta_title" rows="5" cols="100" data-validation="required"><?php echo (isset($detail['meta_title']) && $detail['meta_title'] !="") ? $detail['meta_title']:""; ?></textarea><br>



            </td>

        </tr>



        </tbody>
    </table>

</div>



<p class="submit">
    <input type="hidden" name="activity_id"  value="<?php echo (isset($detail['activity_id']) && $detail['activity_id'] !="") ? $detail['activity_id']:""; ?>">
    <input type="submit" name="Setting Btn" class="button" id="save_content" value="Save Settings">
</p>



</div>
</form>
</div>
</div>


</div>
</div>
<script>
    $.validate();
 </script>
<script>
    CKEDITOR.replace( 'content_body' );
    CKEDITOR.replace( 'tab-body' );

</script>


<script>

    $('#save_content').click(function(e)
    {

        var a=0;
        var b =0;

        $("#featured_error").text("");
        $("#banner_error").text("");


        var ext1 = $('#bannerimg').val().split('.').pop().toLowerCase();
        var ext2 =  $('#featuredimg').val().split('.').pop().toLowerCase();


        if(ext1 == "")
        {
            a = 1;
        }
        else
        {
            if($.inArray(ext1, ['gif','png','jpg','jpeg']) == -1)
            {
                a = 0
            }
            else
            {

                a = 1;
            }
        }

        if(ext2 == "")
        {
            b = 1;
        }
        else
        {
            if($.inArray(ext2, ['gif','png','jpg','jpeg']) == -1)
            {
                b = 0
            }
            else
            {

                b = 1;
            }
        }


        if(a != "1")
        {

            $("#banner_error").text("Invalid banner Image");
            $("#banner_error").css("color", "red");
            e.preventDefault();
        }
        else if(b != "1")
        {

            $("#featured_error").text("Invalid Featured Image");
            $("#featured_error").css("color", "red");
            e.preventDefault();
        }

        else{

            e.submit;

        }


    });
</script>