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
                    <li class="active"><a href="#home" data-toggle="tab">Hotel</a>
                    </li>
                    <li><a href="#location" data-toggle="tab">Location</a>
                    </li>
                    <li><a href="#price" data-toggle="tab">Price</a>
                    </li>
                    <li><a href="#meal" data-toggle="tab">Meals</a>
                    </li>
                    <li><a href="#image" data-toggle="tab">Image</a>
                    </li>
                    <li><a href="#meta" data-toggle="tab">Meta</a>
                    </li>
                    <li id="multi_tabs"><a href="#settings" data-toggle="tab">Tabs</a>
                    </li>


                </ul>
                <?php
                    // foreach ($content as $row) {
                    //     $hotel_id = $row['id'];
                    //     $hotel = $this->hotel->get_hotel_detail($hotel_id);
                    //     print_r($hotel);

           
                ?>
                <form class="tab_form" method="post" action="" enctype="multipart/form-data">
                
                    <div class="tab-content">

                        <div class="tab-pane fade active in" id="home">

                            <table class="form-table">
                                <tbody>
                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label for="hotel_name">Hotel Name<span class="asterisk">*</span>
                                        </label></th>
                                        
                                    <td style="background: transparent none repeat scroll 0% 0%;"><input type="text" name="name" id="name" size="50" value="<?php echo (isset($content['name']) && $content['name'] !="") ? $content['name']:""; ?>" data-validation="required" autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on"></td>
                                </tr>

                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label for="slogan">Hotel Code<span class="asterisk">*</span> </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;"><input type="text" name="code" class="regular-text" data-validation="required"  size="50" value="<?php echo (isset($content['code']) && $content['code'] !="") ? $content['code']:""; ?>" autocomplete="off" kl_virtual_keyboard_secure_input="on"></td>
                                </tr>

                                <tr valign="top" id="category_page">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Category</label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%; padding-left: 25px; padding-top: 15px;">
                                        <select name="category" class="category select-height">
                                            <option value="0" <?php echo (isset($content['category']) && $content['category'] == "0")?"selected":"";?>>--Select--</option>
                                            <?php
                                                foreach($categories as $row)
                                                {
                                                    ?>
                                                    <option value="<?php echo $row['id'];?>" <?php echo (isset($content['category']) && $content['category'] == $row['id'])?"selected":"";?>><?php echo $row['name'];?></option>

                                               <?php
                                                }
                                            ?>

                                           </select>


                                    </td>
                                </tr>

                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label for="rating">Rating<span class="asterisk">*</span>
                                        </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;"><input type="text" name="rating" size="50" class="regular-text" value="<?php echo (isset($content['rating']) !="") ? $content['rating']:""; ?>"  data-validation="number" data-validation-allowing="range[1;5]">
                                </td>
                                </tr>

                                <tr valign="top" class="contact_detail">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row">
                                        <label>Description</label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <textarea rows="5" cols="10" name="description" id="content_body" value = "<?php echo (isset($row['description']) && $row['description'] !="") ? $row['description']:""; ?>"><?php echo (isset($content['description']) && $content['description'] !="") ? $content['description']:""; ?></textarea>
                                    </td>
                                </tr>




                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Published<span class="asterisk">*</span> </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%; padding: 6px 0 0 0;">

                                        <input type="radio" name="status" <?php echo (isset($content['status']) && $content['status'] =="1")?"checked":"";?> class="regular-text" data-validation="required" value="1">Active
                                     <input type="radio" name="status" <?php echo (isset($content['status']) && $content['status'] =="0")?"checked":"";?> class="regular-text" data-validation="required" value="0">Inactive
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <?php
                           // }
                            ?>

                        </div>

                        <div class="tab-pane fade" id="location">

                            <table class="form-table">

                                <tbody>
                                <tr valign="top" id="country">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Country</label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%; padding-left: 25px; padding-top: 15px;">
                                        <select name="country_id" class="country select-height">
                                            <option value="0" <?php echo (isset($content['country_id']) && $content['country_id'] == "0")?"selected":"";?>>--Select--</option>
                                            <?php
                                                foreach($country as $row)
                                                {
                                                    ?>
                                                    <option value="<?php echo $row['id'];?>" <?php echo (isset($content['country_id']) && $content['country_id'] == $row['id'])?"selected":"";?>><?php echo $row['name'];?></option>

                                               <?php
                                                }
                                            ?>

                                           </select>


                                    </td>
                                </tr>

                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label for="admin_name">City<span class="asterisk">*</span>
                                        </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;"><input type="text" name="city" id="city" size="50" value="<?php echo (isset($content['city']) && $content['city'] !="") ? $content['city']:""; ?>" data-validation="required" autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on"></td>
                                </tr>

                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label for="admin_name">Latitude<span class="asterisk">*</span>
                                        </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;"><input type="text" name="latitude" id="latitude" size="50" value="<?php echo (isset($content['latitude']) && $content['latitude'] !="") ? $content['latitude']:""; ?>" autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on"></td>
                                </tr>

                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label for="admin_name">Longitude<span class="asterisk">*</span>
                                        </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;"><input type="text" name="longitude" id="longitude" size="50" value="<?php echo (isset($content['longitude']) && $content['longitude'] !="") ? $content['longitude']:""; ?>" autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on"></td>
                                </tr>

                                </tbody>
                            </table>

                        </div>

                        <div class="tab-pane fade" id="price">

                            <table class="form-table">

                                <tbody>
                                <tr valign="top" id="currency">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Currency</label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%; padding-left: 25px; padding-top: 15px;">
                                        <select name="currency_id" class="currency select-height">
                                            <option value="0" <?php echo (isset($content['currency_id']) && $content['currency_id'] == "0")?"selected":"";?>>--Select--</option>
                                            <?php
                                                $currency = $this->hotel->get_currency();            
                                                foreach($currency as $row)
                                                {

                                                    ?>
                                                    <option value="<?php echo $row['currency_id'];?>" <?php echo (isset($content['currency_id']) && $content['currency_id'] == $row['currency_id'])?"selected":"";?>><?php echo $row['cuurency_name'];?></option>

                                               <?php
                                                }
                                            ?>

                                           </select>


                                    </td>
                                </tr>

                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label for="startingprice">Starting Price<span class="asterisk">*</span>
                                        </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;"><input type="text" name="startingprice" id="startingprice" size="50" value="<?php echo (isset($content['startingprice']) && $content['startingprice'] !="") ? $content['startingprice']:""; ?>" data-validation="required" autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on"></td>
                                </tr>
                                </tbody>
                            </table>

                        </div>

                        <div class="tab-pane fade" id="meal">

                            <table class="form-table">

                                <tbody>
                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label for="lunch_price">Lunch Price(USD)<span class="asterisk">*</span>
                                        </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;"><input type="text" name="lunch_price" id="lunch_price" size="50" value="<?php echo (isset($content['lunch_price']) && $content['lunch_price'] !="") ? $content['lunch_price']:""; ?>" data-validation="required" autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on"></td>
                                    </tr>
                                    <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label for="dinner_price">Dinner Price(USD)<span class="asterisk">*</span>
                                        </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;"><input type="text" name="dinner_price" id="dinner_price" size="50" value="<?php echo (isset($content['dinner_price']) && $content['dinner_price'] !="") ? $content['dinner_price']:""; ?>" data-validation="required" autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on"></td>
                                </tr>
                                </tbody>
                            </table>

                        </div>

                        <div class="tab-pane fade" id="image">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <?php
                                        if(isset($content['featuredimg']))
                                        {
                                            ?>
                                            <div class="remove_option">
                                                <?php
                                                $path  =  '../uploads/hotel/';
                                                ?>
                                                <img src="<?php echo $path. $content['featuredimg'];?>" alt="featured_image" style="max-width: 940px; max-height: 360px;">
                                                <span class="btn btn-info remove_btn" id="btn_remove">Remove</span>
                                            </div>
                                            <input type="hidden" name="pre_featuredimg" value="<?php echo $content['featuredimg']; ?>">
                                            <div id="image_input">
                                                <label>Upload Featured Image</label>
                                                <span>(Image Dimension 560*370 px)</span>
                                                <input type="file" name="featuredimg" id="featuredimg">
                                                <p id="sig_error1" style="display:none; color:#FF0000;">Image formats should be JPG, JPEG, PNG or GIF.</p>
                                                <p id="sig_error2" style="display:none; color:#FF0000;">Max file size should be 20.</p>
                                            </div>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <label>Upload Featured Image</label>
                                            <span>(Image Dimension 560*370 px)</span>
                                            <input type="file" name="featuredimg"  id="featuredimg" data-validation="required">
                                            <p id="sig_error1" style="display:none; color:#FF0000;">Image formats should be JPG, JPEG, PNG or GIF.</p>
                                            <p id="sig_error2" style="display:none; color:#FF0000;">Max file size should be 20MB.</p>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <?php
                                        if(isset($content['hotelimg']))
                                        {
                                            ?>
                                            <div class="remove_option1">
                                                <?php
                                                $path  = '../uploads/hotel/';
                                                ?>
                                                <img src="<?php echo $path. $content['hotelimg'];?>" alt="hotel_image" style="max-width: 940px; max-height: 360px;">
                                                <span class="btn btn-info remove_btn" id="btn_remove1">Remove</span>
                                            </div>
                                            <input type="hidden" name="pre_hotelimg" value="<?php echo $content['hotelimg']; ?>">
                                            <div id="image_input1">
                                                <label>Upload hotel Image</label>
                                                <span>(Image Dimension 853*411 px)</span>
                                                <input type="file" name="hotelimg" id="hotelimg">
                                                <p id="pic_error1" style="display:none; color:#FF0000;">Image formats should be JPG, JPEG, PNG or GIF.</p>
                                                <p id="pic_error2" style="display:none; color:#FF0000;">Max file size should be 20MB.</p>
                                            </div>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <label>Upload hotel Image</label>
                                            <span>(Image Dimension 853*411 px)</span>
                                            <input type="file" name="hotelimg" id="hotelimg" data-validation="required">
                                            <p id="pic_error1" style="display:none; color:#FF0000;">Image formats should be JPG, JPEG, PNG or GIF.</p>
                                            <p id="pic_error2" style="display:none; color:#FF0000;">Max file size should be 20MB.</p>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="tab-pane fade" id="meta">

                            <table class="form-table">

                                <tbody>
                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label for="meta_description">Meta Description </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <textarea name="meta_description" id="meta_description" rows="5" cols="100"><?php echo (isset($content['meta_description']) && $content['meta_description'] !="") ? $content['meta_description']:""; ?></textarea><br>

                                    </td>
                                </tr>

                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label for="meta_keywords">Meta Keyword </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <textarea name="meta_keywords" rows="5" cols="100"><?php echo (isset($content['meta_keywords']) && $content['meta_keywords'] !="") ? $content['meta_keywords']:""; ?></textarea><br>

                                    </td>
                                </tr>



                                </tbody>
                            </table>

                        </div>

                        <div class="tab-pane fade" id="settings">

                            <table class="form-table">

                                <tbody>
                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Tab Name</label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <input type="text" name="tab1"  size="28" value="<?php echo (isset($content['tab1']) && $content['tab1'] !="") ? $content['tab1']:""; ?>" autocomplete="off" kl_virtual_keyboard_secure_input="on">

                                    </td>
                                </tr>

                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Description </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <textarea name="description1" id="tab-body" rows="5" cols="100"><?php echo (isset($content['description1']) && $content['description1'] !="") ? $content['description1']:""; ?></textarea><br>

                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Tab Name</label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <input type="text" name="tab2"  size="28" value="<?php echo (isset($content['tab2']) && $content['tab2'] !="") ? $content['tab2']:""; ?>" autocomplete="off" kl_virtual_keyboard_secure_input="on">

                                    </td>
                                </tr>

                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Description </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <textarea name="description2" id="tab-body2" rows="5" cols="100"><?php echo (isset($content['description2']) && $content['description2'] !="") ? $content['description2']:""; ?></textarea><br>

                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Tab Name</label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <input type="text" name="tab3"  size="28" value="<?php echo (isset($content['tab3']) && $content['tab3'] !="") ? $content['tab3']:""; ?>" autocomplete="off" kl_virtual_keyboard_secure_input="on">

                                    </td>
                                </tr>

                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Description </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <textarea name="description3" id="tab-body3" rows="5" cols="100"><?php echo (isset($content['description3']) && $content['description3'] !="") ? $content['description3']:""; ?></textarea><br>

                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Tab Name</label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <input type="text" name="tab4"  size="28" value="<?php echo (isset($content['tab4']) && $content['tab4'] !="") ? $content['tab4']:""; ?>" autocomplete="off" kl_virtual_keyboard_secure_input="on">

                                    </td>
                                </tr>

                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Description </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <textarea name="description4" id="tab-body4" rows="5" cols="100"><?php echo (isset($content['description4']) && $content['description4'] !="") ? $content['description4']:""; ?></textarea><br>

                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Tab Name</label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <input type="text" name="tab5"  size="28" value="<?php echo (isset($content['tab5']) && $content['tab5'] !="") ? $content['tab5']:""; ?>" autocomplete="off" kl_virtual_keyboard_secure_input="on">

                                    </td>
                                </tr>

                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Description </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <textarea name="description5" id="tab-body5" rows="5" cols="100"><?php echo (isset($content['description5']) && $content['description5'] !="") ? $content['description5']:""; ?></textarea><br>

                                    </td>
                                </tr>



                                </tbody>
                            </table>

                        </div>

                        <p class="submit">
                            <input type="hidden" name="content_id" id="content_id" value="<?php echo (isset($content['content_id']) && $content['content_id'] !="") ? $content['content_id']:""; ?>">
                            <input type="submit" name="Setting Btn" class="button" id="save_content" value="Save Settings">
                        </p>



                    </div>
                </form>
            </div>
        </div>


    </div>
</div>
<script>
    CKEDITOR.replace( 'content_body' );
    CKEDITOR.replace( 'tab-body' );
    CKEDITOR.replace( 'tab-body2' );
    CKEDITOR.replace( 'tab-body3' );
    CKEDITOR.replace( 'tab-body4' );
    CKEDITOR.replace( 'tab-body5' );
</script>


<script>
    $.validate();
</script>



<script>

    $('#save_content').click(function(e)
    {
        var a=0;
        var b =0;
        var ext1 =  $('#featuredimg').val().split('.').pop().toLowerCase();
        var ext2 = $('#hotelimg').val().split('.').pop().toLowerCase();
    
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
            alert('Invalid Featured Image');
            e.preventDefault();
        }
        else if(b != "1")
        {
            alert('Invalid Featured Image');
            e.preventDefault();
        }
        else{
            e.submit;
        }

    });
</script>

