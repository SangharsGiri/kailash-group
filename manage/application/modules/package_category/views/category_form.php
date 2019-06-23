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

                <form class="tab_form" id="form-a" method="post" action="" enctype="multipart/form-data">
                    <div class="tab-content">



                            <table class="form-table">
                                <tbody>
                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Category Name <span class="asterisk">*</span>
                                        </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;"><input type="text" name="category_name"  size="50" data-validation="required"  value="<?php echo (isset($setting['category_name']) && $setting['category_name'] !="") ? $setting['category_name']:""; ?>"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on"></td>
                                </tr>

                               <!--  <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label for="slogan">Category Code<span class="asterisk">*</span> </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">

                                      <select multiple="multiple" name="category_code" class="pcategory_code" data-validation="required">
                                          <option <?php echo (isset($setting['category_code']) && $setting['category_code'] =="RP") ? "selected":"";?> value="RP">Kailas Group Pra.Li.</option>
                                          <option <?php echo (isset($setting['category_code']) && $setting['category_code'] =="OTH") ? "selected":"";?> value="OTH">Other</option>
                                          <option <?php echo (isset($setting['category_code']) && $setting['category_code'] =="OB") ? "selected":"";?> value="OB">Outbound</option>
                                      </select>

                                    </td>
                                </tr> -->
                                <tr valign="top" id="featured_img">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Featured Image</label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <?php
                                        if(isset($setting['featured_img']))
                                        {

                                            ?>
                                            <div class="remove_option">

                                                <?php
                                                $path  = '../uploads/package_category/';
                                                ?>
                                                <img src="<?php echo $path. $setting['featured_img'];?>" alt="featured_image" style="max-width: 360px; max-height: 180px; margin: 0 0 0 25px;">

                                                <span class="btn btn-info remove_btn" id="btn_remove">Remove</span>
                                            </div>
                                            <input type="hidden" name="pre_featuredimg" value="<?php echo $setting['featured_img']; ?>">
                                            <div id="image_input">


                                                <input type="file" name="featured_img" id="featuredimg">
                                                <span id="type_error"></span>

                                            </div>
                                        <?php
                                        }
                                        else
                                        {
                                            ?>


                                            <input type="file" name="featured_img"  id="featuredimg" data-validation= "required">
                                            <span id="type_error" style="padding-left: 33px;"></span>


                                        <?php
                                        }
                                        ?>


                                    </td>
                                    <td style="padding: 13px 0 0 0;">(Image Dimension 360*180 px)</td>
                                </tr>
                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Description
                                        </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <textarea name="description" id="description"><?php echo (isset($setting['description']) && $setting['description'] !="") ? $setting['description']:""; ?></textarea>
                                    </td>
                                </tr>


                                   <tr valign="top">

                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Meta Keywords

                                        </label></th>

                                    <td style="background: transparent none repeat scroll 0% 0%;">

                                       <textarea name="meta_keywords" style="width: 453px; height: 65px;"><?php echo (isset($setting['meta_keywords']) !="") ? $setting['meta_keywords']:""; ?></textarea>

                                    </td>

                                </tr>

                                   <tr valign="top">

                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Meta Description

                                        </label></th>

                                    <td style="background: transparent none repeat scroll 0% 0%;">

                                        <textarea name="meta_description" style="width: 453px; height: 65px;"><?php echo (isset($setting['meta_description']) !="") ? $setting['meta_description']:""; ?></textarea>

                                    </td>

                                </tr>

                                <tr valign="top">

                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Meta Title

                                        </label></th>

                                    <td style="background: transparent none repeat scroll 0% 0%;">

                                        <textarea name="meta_title" style="width: 453px; height: 65px;" ><?php echo (isset($setting['meta_title']) !="") ? $setting['meta_title']:""; ?></textarea>

                                    </td>

                                </tr>


                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row">
                                        <label>Status</label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%; padding: 6px 0 0 0px;">
                                        <input type="radio" name="publish_status" <?php echo (isset($setting['publish_status']) && $setting['publish_status'] =="1")?"checked":"";?> class="regular-text" data-validation="required" value="1">Active
                                        <input type="radio" name="publish_status" <?php echo (isset($setting['publish_status']) && $setting['publish_status'] =="0")?"checked":"";?> class="regular-text" data-validation="required" value="0">Inactive
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row">
                                        <label>Show On Mobile</label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%; padding: 6px 0 0 0px;">
                                        <input type="radio" name="show_mobile" <?php echo (isset($setting['show_mobile']) && $setting['show_mobile'] =="Y")?"checked":"";?> class="regular-text" data-validation="required" value="Y">Yes
                                        <input type="radio" name="show_mobile" <?php echo (isset($setting['show_mobile']) && $setting['show_mobile'] =="N")?"checked":"";?> class="regular-text" data-validation="required" value="N">No
                                    </td>
                                </tr>


                                </tbody>
                            </table>






                        <p class="submit">
                            <input type="hidden" name="category_id" value="<?php echo (isset($setting['category_id']) && $setting['category_id'] !="") ? $setting['category_id']:""; ?>">
                            <input type="submit" name="Setting Btn" id="btn_category" class="button" value="Save">
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
    CKEDITOR.replace('description');
</script>
<script>

    $('#btn_category').click(function(e)
    {

        $("#type_error").text("");
        var a=0;

        var ext1 =  $('#featuredimg').val().split('.').pop().toLowerCase();


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

        if(a != "1")
        {
            $("#type_error").text("Invalid Featured Image");
            $("#type_error").css("color", "red");

            e.preventDefault();
        }

        else{

            e.submit;

        }


    });
</script>
