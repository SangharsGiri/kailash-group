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
                </ul>
                <form class="tab_form" method="post" action="" enctype="multipart/form-data">
                    <div class="tab-content">

                        <div class="tab-pane fade active in" id="home">

                            <table class="form-table">
                                <tbody>
                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Sub Category Name <span class="asterisk">*</span>
                                        </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;"><input type="text" name="sub_category_name"  size="50" data-validation="required" value="<?php echo (isset($setting['sub_category_name']) && $setting['sub_category_name'] !="") ? $setting['sub_category_name']:""; ?>"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on"></td>
                                </tr>

                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label for="slogan">Parent Category<span class="asterisk">*</span> </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <?php
                                        $data=array();

                                        foreach($categories as $row)
                                        {

                                            $data[$row['category_id']]= $row['category_name'];

                                        }

                                        $category_id = (isset($setting['category_id']) and $setting['category_id'] !="")? $setting['category_id'] : "";

                                        echo form_dropdown('category_id', $data, $category_id, 'class="parent_category" data-validation="required"');



                                        ?>

                                    </td>
                                </tr>

                                <tr valign="top" id="featured_img">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Featured Image</label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <?php
                                        if(isset($setting['featured_img']))
                                        {

                                            ?>
                                            <div class="remove_option">

                                                <?php
                                                $path  = '../uploads/package_sub_category/';
                                                ?>
                                                <img src="<?php echo $path. $setting['featured_img'];?>" alt="featured_image" style="max-width: 360px; max-height: 180px;margin: 0 0 0 25px;">

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
                                            <span id="type_error"></span>


                                        <?php
                                        }
                                        ?>


                                    </td>
                                    <td style="padding: 13px 0 0 0;">(Image Dimension 360*180 px)</td>
                                </tr>
                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row">
                                        <label>Status</label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%; padding: 6px 0 0 0px;">
                                        <input type="radio" name="publish_status" <?php echo (isset($setting['publish_status']) && $setting['publish_status'] =="1")?"checked":"";?> class="regular-text" data-validation="required" value="1">Active
                                        <input type="radio" name="publish_status" <?php echo (isset($setting['publish_status']) && $setting['publish_status'] =="0")?"checked":"";?> class="regular-text" data-validation="required" value="0">Inactive
                                    </td>
                                </tr>




                                </tbody>
                            </table>


                        </div>



                        <p class="submit">
                            <input type="hidden" name="sub_category_id" value="<?php echo (isset($setting['sub_category_id']) && $setting['sub_category_id'] !="") ? $setting['sub_category_id']:""; ?>">
                            <input type="submit" name="Setting Btn" class="button" id="btn_subcategory" value="Save">
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

    $('#btn_subcategory').click(function(e)
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
