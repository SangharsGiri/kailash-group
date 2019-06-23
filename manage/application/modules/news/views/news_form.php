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

                <form class="tab_form" method="post" action="" enctype="multipart/form-data">
                    <div class="tab-content">

                        <div class="tab-pane fade active in" id="home">

                            <table class="form-table">
                                <tbody>


                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>News Title <span class="asterisk">*</span>
                                        </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <input type="text" name="news_title" data-validation="required"  size="50" data-validation="number required" value="<?php echo (isset($detail['news_title']) && $detail['news_title'] !="") ? $detail['news_title']:""; ?>"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                           
                                    </td>
                                </tr>

                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Featured Image <span class="asterisk">*</span>
                                        </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <?php
                                        $path  =  '../uploads/news/';
                                        if(isset($detail['featured_img']) && file_exists($path.$detail['featured_img']))
                                        {

                                            ?>
                                            <div class="remove_option">

                                                <?php

                                                ?>
                                                <img src="<?php echo $path. $detail['featured_img'];?>" alt="Featured Image" style="max-width: 940px; max-height: 360px;">

                                                <span class="btn btn-info remove_btn" id="btn_remove">Remove</span>
                                            </div>
                                            <input type="hidden" name="pre_featured_img" value="<?php echo $detail['featured_img']; ?>">
                                            <div id="image_input">
                                                <span>Upload Featured Image</span>
                                                <span>(Image Dimension 853*405 px)</span>
                                                <input type="file" name="featured_img" id="featuredimg">
                                                <p id="sig_error1" style="display:none; color:#FF0000;">Image formats should be JPG, JPEG, PNG or GIF.</p>
                                                <p id="sig_error2" style="display:none; color:#FF0000;">Max file size should be 20.</p>
                                            </div>
                                        <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <span>Upload Featured Image</span>
                                            <span>(Image Dimension 853*405 px)</span>
                                            <input type="file" name="featured_img"  id="featuredimg" data-validation="required">
                                            <p id="sig_error1" style="display:none; color:#FF0000;">Image formats should be JPG, JPEG, PNG or GIF.</p>
                                            <p id="sig_error2" style="display:none; color:#FF0000;">Max file size should be 20MB.</p>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                </tr>

                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>News Body <span class="asterisk">*</span>
                                        </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                       <textarea name="news_content" id="news"><?php echo (isset($detail['news_content']) && $detail['news_content'] !="") ? $detail['news_content']:""; ?></textarea>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Meta Description <span class="asterisk">*</span>
                                        </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <textarea name="meta_description" data-validation="required" rows="4" cols="120"><?php echo (isset($detail['meta_description']) && $detail['meta_description'] !="") ? $detail['meta_description']:""; ?></textarea>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Meta Keywords <span class="asterisk">*</span>
                                        </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <textarea name="meta_keywords" data-validation="required" rows="4" cols="120"><?php echo (isset($detail['meta_keywords']) && $detail['meta_keywords'] !="") ? $detail['meta_keywords']:""; ?></textarea>
                                    </td>
                                </tr>
           
                                <tr valign="top">

                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Meta Title <span class="asterisk">*</span>

                                        </label></th>

                                    <td style="background: transparent none repeat scroll 0% 0%;">

                                        <textarea name="meta_title" data-validation="required" rows="4" cols="120"><?php echo (isset($detail['meta_title']) && $detail['meta_title'] !="") ? $detail['meta_title']:""; ?></textarea>

                                    </td>

                                </tr>

                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Status <span class="asterisk">*</span>
                                        </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%; padding-top: 10px;">
                                        <input type="radio" name="publish_status" <?php echo (isset($detail['publish_status']) && $detail['publish_status'] == "1") ?"checked":""; ?> value="1"  data-validation="required" autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">Active
                                        <input type="radio" name="publish_status" <?php echo (isset($detail['publish_status']) && $detail['publish_status'] == "0") ?"checked":""; ?> value="0"  data-validation="required" autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">Inactive
                                    </td>
                                </tr>


                                </tbody>
                            </table>


                        </div>



                        <p class="submit">
                            <input type="hidden" name="news_id" value="<?php echo (isset($detail['news_id']) && $detail['news_id'] !="") ? $detail['news_id']:""; ?>">
                            <input type="submit" name="Setting Btn" id="btn_news" class="button" value="Save">
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
    CKEDITOR.replace( 'news' );
</script>
<script>
    $('#btn_news').click(function(e)
    {


        var b =0;



        var ext2 =  $('#featuredimg').val().split('.').pop().toLowerCase();



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


       if(b != "1")
        {
            alert('Invalid Featured Image');
            e.preventDefault();
        }

        else{

            e.submit;

        }


    });
</script>
