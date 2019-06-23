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

    <li class=""><a href="#settings" data-toggle="tab">Meta Settings</a>
    </li>
    <li class=""><a href="#home_setting" data-toggle="tab">Messages</a>
    </li>
    <li class=""><a href="#home_service" data-toggle="tab">Home Service</a>
    </li>
    <li class=""><a href="#home_counter" data-toggle="tab">Home Counter</a>
    </li>



</ul>
    <form class="tab_form" method="post" action="<?php echo site_url('site_settings/site_form');?>" enctype="multipart/form-data">
<div class="tab-content">

<div class="tab-pane fade active in" id="home">
        <!-- <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="admin_name">Site Name <span class="asterisk">*</span></label>
                    <input type="text" name="site_name" id="admin_name" value="<?php echo (isset($setting['site_name']) && $setting['site_name'] !="") ? $setting['site_name']:""; ?>" required="required" autocomplete="off" class="form-control required valid" kl_virtual_keyboard_secure_input="on">

                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="slogan">Slogan<span class="asterisk">*</span> </label>
                    <input type="text" name="site_slogan" id="slogan" class="form-control" required="required"   value="<?php echo (isset($setting['site_name']) && $setting['site_slogan'] !="") ? $setting['site_slogan']:""; ?>" autocomplete="off" kl_virtual_keyboard_secure_input="on">
                </div>
            </div>
            <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Featured Image</label>
                                                        <?php
                                                        if(isset($ads['featured_img']))
                                                        {

                                                            ?>
                                                            <div class="remove_option">

                                                                <?php
                                                                $path  =  '../uploads/ads/';
                                                                ?>
                                                                <img src="<?php echo $path. $ads['featured_img'];?>" alt="featured_image" style="width: 50%">

                                                                <span class="btn btn-info remove_btn" id="btn_remove">Remove</span>
                                                            </div>
                                                            <input type="hidden" name="pre_featuredimg" value="<?php echo $ads['featured_img']; ?>">
                                                            <div id="image_input">

                                                                <span>(Image Dimension 853*405 px)</span>
                                                                <input type="file" class="form-control" name="featured_img" id="featuredimg">
                                                                <span id="type_error"></span>
                                                            </div>
                                                            <?php
                                                        }
                                                        else
                                                        {
                                                            ?>

                                                            <span>(Image Dimension 853*405 px)</span>
                                                            <input type="file" name="featured_img" class="form-control"  id="featuredimg">
                                                            <span id="type_error"></span>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                </div>
        </div> -->
   <!--  <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="copyright">Copyrigth Text <span class="asterisk">*</span></label>
                <input type="text" name="copyright" id="copyright" value="<?php echo (isset($setting['copyright']) && $setting['copyright'] !="") ? $setting['copyright']:""; ?>" required="required" autocomplete="off" class="form-control required valid" kl_virtual_keyboard_secure_input="on">

            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="powered_by">Powered by<span class="asterisk">*</span> </label>
                <input type="text" name="powered_by" id="powered_by" class="form-control" required="required"   value="<?php echo (isset($setting['powered_by']) && $setting['powered_by'] !="") ? $setting['powered_by']:""; ?>" autocomplete="off" kl_virtual_keyboard_secure_input="on">
            </div>
        </div>
    </div> -->

    <div class="row">
        <!-- <div class="col-sm-6">
            <div class="form-group">
                <label for="feedback_email">Website Url<span class="asterisk">*</span> </label>
                <input type="text" name="site_url"  value="<?php echo (isset($setting['site_url']) && $setting['site_url'] !="") ? $setting['site_url']:""; ?>" required="required"  autocomplete="off" class="form-control required" kl_virtual_keyboard_secure_input="on">
            </div>
        </div> -->
        <div class="col-sm-6">
            <div class="form-group">
                <label for="contact_number">Contact Number<span class="asterisk">*</span> </label>
                <input type="text" name="contact_number"  value="<?php echo (isset($setting['contact_number']) && $setting['contact_number'] !="") ? $setting['contact_number']:""; ?>" required="required" autocomplete="off" class="form-control required" kl_virtual_keyboard_secure_input="on">
            </div>
        </div>
         <div class="col-sm-6">
            <div class="form-group">
                <label for="contact_address">Address<span class="asterisk">*</span> </label>
                <input type="text" name="contact_address"  value="<?php echo (isset($setting['contact_address']) && $setting['contact_address'] !="") ? $setting['contact_address']:""; ?>" required="required" autocomplete="off" class="form-control required" kl_virtual_keyboard_secure_input="on">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="feedback_email">Feedback Email<span class="asterisk">*</span> </label>
                <input type="text" name="feedback_email" id="feedback_email" value="<?php echo (isset($setting['feedback_email']) && $setting['feedback_email'] !="") ? $setting['feedback_email']:""; ?>" required="required"  autocomplete="off" class="form-control required" kl_virtual_keyboard_secure_input="on">
            </div>
        </div>
   <!--  <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label for="time_hour">Working Hours<span class="asterisk">*</span> </label>
                <input type="text" name="time_hour" id="time_hour" value="<?php echo (isset($setting['time_hour']) && $setting['time_hour'] !="") ? $setting['time_hour']:""; ?>" required="required" autocomplete="off" class="form-control required" kl_virtual_keyboard_secure_input="on">
            </div>
        </div> -->
        <div class="col-sm-6">
            <div class="form-group">
                <label>LinkedIN </label>
                <input type="text" name="linked_in" id="skype_name" class="form-control" value="<?php echo (isset($setting['linked_in']) && $setting['linked_in'] !="") ? $setting['linked_in']:""; ?>" autocomplete="off" kl_virtual_keyboard_secure_input="on">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Facebook URL </label>
                <input type="text" name="facebook_link"  class="form-control"  value="<?php echo (isset($setting['facebook_link']) && $setting['facebook_link'] !="") ? $setting['facebook_link']:""; ?>" autocomplete="off" kl_virtual_keyboard_secure_input="on">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Twitter URL </label>
                <input type="text" name="twiter_link" class="form-control" value="<?php echo (isset($setting['twiter_link']) && $setting['twiter_link'] !="") ? $setting['twiter_link']:""; ?>" autocomplete="off" kl_virtual_keyboard_secure_input="on">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>YouTube URL </label>
                <input type="text" name="youtube_link"  class="form-control" value="<?php echo (isset($setting['youtube_link']) && $setting['youtube_link'] !="") ? $setting['youtube_link']:""; ?>" autocomplete="off" kl_virtual_keyboard_secure_input="on">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Instagram </label>
                <input type="text" name="instagram" class="form-control" value="<?php echo (isset($setting['instagram']) && $setting['instagram'] !="") ? $setting['instagram']:""; ?>" autocomplete="off" kl_virtual_keyboard_secure_input="on">

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Location Map </label>
                <textarea name="location_map" rows="23"  class="form-control"><?php echo (isset($setting['location_map']) && $setting['location_map'] !="") ? $setting['location_map']:""; ?></textarea>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Slogan</label>
                <textarea rows="5" cols="10" name="slogan" id="contact-detail"><?php echo (isset($setting['slogan']) && $setting['slogan'] !="") ? $setting['slogan']:""; ?></textarea>
            </div>
        </div>
    </div>


</div>

<div class="tab-pane fade" id="settings">
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="meta_title">Meta Title</label>
                <input type="text" name="meta_title" id="meta_title" class="form-control" value="<?php echo (isset($setting['meta_title']) && $setting['meta_title'] !="") ? $setting['meta_title']:""; ?>" autocomplete="off" kl_virtual_keyboard_secure_input="on">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="meta_description">Meta Description </label>
                <textarea name="meta_description" id="meta_description" rows="5" class="form-control"><?php echo (isset($setting['meta_description']) && $setting['meta_description'] !="") ? $setting['meta_description']:""; ?></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="meta_keyword">Meta Keyword</label>
                <textarea name="meta_keywords" id="meta_keywords" rows="5" class="form-control"><?php echo (isset($setting['meta_keywords']) && $setting['meta_keywords'] !="") ? $setting['meta_keywords']:""; ?></textarea>

            </div>
        </div>
    </div>
</div>


    <div class="tab-pane fade" id="home_setting">

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="meta_title">Feedback Title</label>
                    <input type="text" name="home_title" id="meta_title" class="form-control" value="<?php echo (isset($setting['home_title']) && $setting['home_title'] !="") ? $setting['home_title']:""; ?>" autocomplete="off" kl_virtual_keyboard_secure_input="on">
                    <label for="home_description">Feedback Message </label>
                    <textarea name="home_description" id="home_description" rows="5" class="form-control"><?php echo (isset($setting['home_description']) && $setting['home_description'] !="") ? $setting['home_description']:""; ?></textarea>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="subscription_title">Subscription Title</label>
                    <input type="text" name="subscription_title" id="subscription_title" class="form-control" value="<?php echo (isset($setting['subscription_title']) && $setting['subscription_title'] !="") ? $setting['subscription_title']:""; ?>" autocomplete="off" kl_virtual_keyboard_secure_input="on">
                    <label for="subscription">Subscription Message </label>
                    <textarea name="subscription" id="subscription" rows="5" class="form-control"><?php echo (isset($setting['subscription']) && $setting['subscription'] !="") ? $setting['subscription']:""; ?></textarea>

                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="login_title">Login Title</label>
                    <input type="text" name="login_title" id="login_title" class="form-control" value="<?php echo (isset($setting['login_title']) && $setting['login_title'] !="") ? $setting['login_title']:""; ?>" autocomplete="off" kl_virtual_keyboard_secure_input="on">
                    <label for="login_message">Login Message </label>
                    <textarea name="login_message" id="login_message" rows="5" class="form-control"><?php echo (isset($setting['login_message']) && $setting['login_message'] !="") ? $setting['login_message']:""; ?></textarea>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="registration_title">Registration Title</label>
                    <input type="text" name="registration_title" id="registration_title" class="form-control" value="<?php echo (isset($setting['registration_title']) && $setting['registration_title'] !="") ? $setting['registration_title']:""; ?>" autocomplete="off" kl_virtual_keyboard_secure_input="on">
                    <label for="registration_message">Registration Message </label>
                    <textarea name="registration_message" id="registration_message" rows="5" class="form-control"><?php echo (isset($setting['registration_message']) && $setting['registration_message'] !="") ? $setting['registration_message']:""; ?></textarea>

                </div>
            </div>
        </div>




    </div>

    <div class="tab-pane fade" id="home_service">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="service_title_one">Tab one</label>
                    <input type="text" name="service_title_one" id="service_title_one" class="form-control" value="<?php echo (isset($setting['service_title_one']) && $setting['service_title_one'] !="") ? $setting['service_title_one']:""; ?>" autocomplete="off" kl_virtual_keyboard_secure_input="on">
                    <label for="home_description">Description </label>
                    <textarea name="service_description_one" id="service_description_one" rows="5" class="form-control"><?php echo (isset($setting['service_description_one']) && $setting['service_description_one'] !="") ? $setting['service_description_one']:""; ?></textarea>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="service_title_two">Tab Two</label>
                    <input type="text" name="service_title_two" id="service_title_two" class="form-control" value="<?php echo (isset($setting['service_title_two']) && $setting['service_title_two'] !="") ? $setting['service_title_two']:""; ?>" autocomplete="off" kl_virtual_keyboard_secure_input="on">
                    <label for="home_description">Description </label>
                    <textarea name="service_description_two" id="service_description_two" rows="5" class="form-control"><?php echo (isset($setting['service_description_two']) && $setting['service_description_two'] !="") ? $setting['service_description_two']:""; ?></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="service_title_three">Tab Three</label>
                    <input type="text" name="service_title_three" id="service_title_three" class="form-control" value="<?php echo (isset($setting['service_title_three']) && $setting['service_title_three'] !="") ? $setting['service_title_three']:""; ?>" autocomplete="off" kl_virtual_keyboard_secure_input="on">
                    <label for="service_description_three">Description </label>
                    <textarea name="service_description_three" id="service_description_three" rows="5" class="form-control"><?php echo (isset($setting['service_description_three']) && $setting['service_description_three'] !="") ? $setting['service_description_three']:""; ?></textarea>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="service_title_five">Tab Four</label>
                    <input type="text" name="service_title_five" id="service_title_five" class="form-control" value="<?php echo (isset($setting['service_title_five']) && $setting['service_title_five'] !="") ? $setting['service_title_five']:""; ?>" autocomplete="off" kl_virtual_keyboard_secure_input="on">
                    <label for="service_description_five">Description </label>
                    <textarea name="service_description_five" id="service_description_five" rows="5" class="form-control"><?php echo (isset($setting['service_description_five']) && $setting['service_description_five'] !="") ? $setting['service_description_five']:""; ?></textarea>
                </div>
            </div>
        </div>

    </div>
    
    
    <div class="tab-pane fade" id="home_counter">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="counter_one">Tab one</label>
                    <input type="text" name="counter_one" id="counter_one" class="form-control" value="<?php echo (isset($setting['counter_one']) && $setting['counter_one'] !="") ? $setting['counter_one']:""; ?>" autocomplete="off" kl_virtual_keyboard_secure_input="on">
                    <label for="counter_one_description">Description </label>
                    <textarea name="counter_one_description" id="counter_one_description" rows="5" class="form-control"><?php echo (isset($setting['counter_one_description']) && $setting['counter_one_description'] !="") ? $setting['counter_one_description']:""; ?></textarea>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="counter_two">Tab Two</label>
                    <input type="text" name="counter_two" id="counter_two" class="form-control" value="<?php echo (isset($setting['counter_two']) && $setting['counter_two'] !="") ? $setting['counter_two']:""; ?>" autocomplete="off" kl_virtual_keyboard_secure_input="on">
                    <label for="home_description">Description </label>
                    <textarea name="counter_two_description" id="counter_two_description" rows="5" class="form-control"><?php echo (isset($setting['counter_two_description']) && $setting['counter_two_description'] !="") ? $setting['counter_two_description']:""; ?></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="counter_three">Tab Three</label>
                    <input type="text" name="counter_three" id="counter_three" class="form-control" value="<?php echo (isset($setting['counter_three']) && $setting['counter_three'] !="") ? $setting['counter_three']:""; ?>" autocomplete="off" kl_virtual_keyboard_secure_input="on">
                    <label for="service_description_three">Description </label>
                    <textarea name="counter_three_description" id="counter_three_description" rows="5" class="form-control"><?php echo (isset($setting['counter_three_description']) && $setting['counter_three_description'] !="") ? $setting['counter_three_description']:""; ?></textarea>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="counter_four">Tab Four</label>
                    <input type="text" name="counter_four" id="counter_four" class="form-control" value="<?php echo (isset($setting['counter_four']) && $setting['counter_four'] !="") ? $setting['counter_four']:""; ?>" autocomplete="off" kl_virtual_keyboard_secure_input="on">
                    <label for="service_description_five">Description </label>
                    <textarea name="counter_four_description" id="counter_four_description" rows="5" class="form-control"><?php echo (isset($setting['counter_four_description']) && $setting['counter_four_description'] !="") ? $setting['counter_four_description']:""; ?></textarea>
                </div>
            </div>
        </div>


    </div>
    
    
    
    


    <p class="submit">
        <input type="hidden" name="id" value="<?php echo (isset($setting['id']) && $setting['id'] !="") ? $setting['id']:""; ?>">
        <input type="submit" name="Setting Btn" class="btn btn-danger" value="Save Settings">
    </p>



</div>
    </form>
</div>
</div>


</div>
</div>
<script>
    CKEDITOR.replace( 'contact-detail'  ,{

        filebrowserBrowseUrl : '/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
        filebrowserUploadUrl : '/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
        filebrowserImageBrowseUrl : '/filemanager/dialog.php?type=1&editor=ckeditor&fldr='


    } );


    KEDITOR.replace( 'contact-detail' );
</script>