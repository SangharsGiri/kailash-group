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
                    <li class="active"><a href="#home" data-toggle="tab">Room</a>
                    </li>
                    <li><a href="#price" data-toggle="tab">Price</a>
                    </li>
                    <li><a href="#children" data-toggle="tab">Children and Extra Beds</a>
                    </li>
                    <li><a href="#meta" data-toggle="tab">Booking Condition and Free Cancellation</a>
                    </li>
                    <li id="multi_tabs"><a href="#features" data-toggle="tab">Features</a>
                    </li>
                    <li><a href="#image" data-toggle="tab">Image</a>
                    </li>



                </ul>
                
                <form class="tab_form" method="post" action="" enctype="multipart/form-data">
                    <div class="tab-content">

                        <div class="tab-pane fade active in" id="home">
                        
                            <table class="form-table">
                                <tbody>
                                <tr valign="top">

                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label for="hote_name">Room Name<span class="asterisk">*</span>
                                        </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;"><input type="text" name="name" id="name" size="50" value="<?php echo $hotelroom['name']; ?>" data-validation="required" autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on"></td>
                                </tr>

                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label for="slogan">Room size<span class="asterisk">*</span> </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;"><input type="text" name="roomsize" class="regular-text" data-validation="required"  size="50" value="<?php echo $hotelroom['roomsize']; ?>" autocomplete="off" kl_virtual_keyboard_secure_input="on"></td>
                                </tr>

                                 <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label for="slogan">Views<span class="asterisk">*</span> </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;"><input type="text" name="views" class="regular-text" data-validation="required"  size="50" value="<?php echo $hotelroom['views']; ?>" autocomplete="off" kl_virtual_keyboard_secure_input="on"></td>
                                </tr>
                                
                                <tr valign="top" id="room_type">

                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Room Type</label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%; padding-left: 25px; padding-top: 15px;">
                                        <select name="room_id" class="room_id select-height">
                                            <option value="0" <?php echo (isset($room_type['name']) && $room_type['name'] == "0")?"selected":"";?>>--Select--</option>
                                            <?php
                                                foreach($room_type as $row)
                                                {
                                                    ?>
                                                    <option value="<?php echo $hotelroom['room_id'];?>" <?php echo (isset($row['room_id']) && $row['room_id'] == $hotelroom['room_id'])?"selected":"";?>><?php echo $row['room_name'];?></option>

                                               <?php
                                                }
                                            ?>

                                           </select>


                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label for="slogan">Beds<span class="asterisk">*</span> </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;"><input type="text" name="beds" class="regular-text" data-validation="required"  size="50" value="<?php echo $hotelroom['beds']; ?>" autocomplete="off" kl_virtual_keyboard_secure_input="on"></td>
                                </tr>
                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label for="slogan">Pax<span class="asterisk">*</span> </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;"><input type="text" name="pax" class="regular-text" data-validation="required"  size="50" value="<?php echo $hotelroom['pax']; ?>" autocomplete="off" kl_virtual_keyboard_secure_input="on"></td>
                                </tr>

                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label for="slogan">Limited Room? </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;"><input type="checkbox" name="limitedroom" <?php echo (isset($hotelroom['limitedroom']) && $hotelroom['limitedroom'] =="Y")?"checked":"";?> class="regular-text"  value="Y"></td>
                                </tr>

                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label for="hote_name">Available Room<span class="asterisk">*</span></label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;"><input type="text" name="available_room" id="available_room" size="50" value="<?php echo $hotelroom['available_room']; ?>" data-validation="required" data-validation="number" autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on"></td>
                                </tr>

                                <tr valign="top">
                                     <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Room Image <span class="asterisk">*</span>
                                        </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <?php
                                        $path  =  '../uploads/room/';
                                        if(isset($hotelroom['room_image']) && file_exists($path.$hotelroom['room_image']))

                                        {
                                           
                                            ?>
                                            <div class="remove_option">

                                                <?php

                                                ?>
                                                <img src="<?php echo $path.$hotelroom['room_image'];?>" alt="Room Image" style="max-width: 940px; max-height: 360px;">

                                                <span class="btn btn-info remove_btn" id="btn_remove">Remove</span>
                                            </div>
                                            <input type="hidden" name="pre_room_img" value="<?php echo $hotelroom['room_image']; ?>">
                                            <div id="image_input">
                                                <span>Upload Room Image</span>
                                                <span>(Image Dimension 853*405 px)</span>
                                                <input type="file" name="room_image" id="room_image">
                                                <p id="sig_error1" style="display:none; color:#FF0000;">Image formats should be JPG, JPEG, PNG or GIF.</p>
                                                <p id="sig_error2" style="display:none; color:#FF0000;">Max file size should be 20.</p>
                                            </div>
                                        <?php
                                        }
                                        else
                                        {
                                            ?>

                                            <span>Upload Room Image</span>
                                            <span>(Image Dimension 853*405 px)</span>
                                            <input type="file" name="room_image"  id="room_image" data-validation="required">
                                            <p id="sig_error1" style="display:none; color:#FF0000;">Image formats should be JPG, JPEG, PNG or GIF.</p>
                                            <p id="sig_error2" style="display:none; color:#FF0000;">Max file size should be 20MB.</p>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                </tr>

                                <tr valign="top" class="contact_detail">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row">
                                        <label>Description</label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <textarea rows="5" cols="10" name="description" id="content_body"><?php echo (isset($hotelroom['description']) && $hotelroom['description'] !="") ? $hotelroom['description']:""; ?></textarea>
                                    </td>
                                </tr>




                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Published<span class="asterisk">*</span> </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%; padding: 6px 0 0 0;">

                                        <input type="radio" name="publish_status" <?php echo (isset($hotelroom['publish_status']) && $hotelroom['publish_status'] =="1")?"checked":"";?> class="regular-text" data-validation="required" value="1">Active
                                     <input type="radio" name="publish_status" <?php echo (isset($hotelroom['publish_status']) && $hotelroom['publish_status'] =="0")?"checked":"";?> class="regular-text" data-validation="required" value="0">Inactive
                                    </td>
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
                                            <option value="0" <?php echo (isset($hotelroom['currency_id']) && $hotelroom['currency_id'] == "0")?"selected":"";?>>--Select--</option>
                                            <?php
                                                $currency = $this->hotel->get_currency();            
                                                foreach($currency as $row)
                                                {
                                                    ?>
                                                    <option value="<?php echo $row['currency_id'];?>" <?php echo (isset($hotelroom['currency_id']) && $hotelroom['currency_id'] == $row['currency_id'])?"selected":"";?>><?php echo $row['cuurency_name'];?></option>
                                               <?php
                                                }
                                            ?>
                                           </select>
                                    </td>
                                </tr>

                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label for="price">Price<span class="asterisk">*</span>
                                        </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;"><input type="text" name="price" id="price" size="50" value="<?php echo $hotelroom['price']; ?>" data-validation="required" autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on"></td>
                                </tr>


                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Is Discount</label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%; padding: 6px 0 0 0;">

                                        <input type="checkbox" name="isdiscount" <?php echo (isset($hotelroom['isdiscount']) && $hotelroom['isdiscount'] =="Y")?"checked":"";?> class="regular-text" value="Y">
                                    </td>
                                </tr>

                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label for="dprice">Discount Price<span class="asterisk">*</span>
                                        </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;"><input type="text" name="dprice" id="dprice" size="50" value="<?php echo $hotelroom['dprice']; ?>" autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on"></td>
                                </tr>
                                </tbody>
                            </table>

                        </div>

                        <div class="tab-pane fade" id="children">

                            <table class="form-table">

                                <tbody>
                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label for="extra_bed_price">Extra Bed Price(USD)<span class="asterisk">*</span>
                                        </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;"><input type="text" name="extra_bed_price" id="extra_bed_price" size="50" value="<?php echo $hotelroom['extra_bed_price']; ?>" autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on"></td>
                                    </tr>
                                    <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label for="infant">Infant<span class="asterisk">*</span>
                                        </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;"><input type="text" name="infant" id="infant" size="50" value="<?php echo $hotelroom['infant']; ?>" autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on"> 
                                    <input type="text" name="infantdesc" id="infantdescription" size="50" style="height:80px;" value="<?php echo $hotelroom['infantdesc']; ?>" autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on"></td>
                                </tr>
                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label for="children">Children<span class="asterisk">*</span>
                                        </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;"><input type="text" name="child" id="child" size="50" value="<?php echo $hotelroom['child']; ?>" autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on"> 
                                    <input type="text" name="childdesc" id="childdesc" size="50" style="height:80px;" value="<?php echo $hotelroom['childdesc']; ?>" autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on"></td>
                                </tr>
                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Description </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <textarea name="extrabeds" id="tab-body" rows="5" cols="100"><?php echo (isset($hotelroom['extrabeds']) && $hotelroom['extrabeds'] !="") ? $hotelroom['extrabeds']:""; ?></textarea><br>

                                    </td>
                                </tr>


                                </tbody>
                            </table>

                        </div>

                        

                        <div class="tab-pane fade" id="meta">

                            <table class="form-table">

                                <tbody>
                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label for="bookingcondition">Name<span class="asterisk">*</span>
                                        </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;"><input type="text" name="bookingcondition" id="bookingcondition" size="50" value="<?php echo $hotelroom['bookingcondition']; ?>" autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on"></td>
                                    </tr>
                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label for="bookingdescription">Description </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <textarea name="bookingdescription" id="bookingdescription" rows="5" cols="80"><?php echo (isset($hotelroom['bookingdescription']) && $hotelroom['bookingdescription'] !="") ? $hotelroom['bookingdescription']:""; ?></textarea><br>
                                    <td style="background: transparent none repeat scroll 0% 0%;"><input type="checkbox" name="bookingfront" <?php echo (isset($hotelroom['bookingfront']) && $hotelroom['bookingfront'] =="Y")?"checked":"";?> class="regular-text" value="Y"> Show Front? </td>
                              
                                    </td>
                                </tr>

                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label for="freecancellation">Free Cancellation</label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <textarea name="freecancellation" rows="5" cols="80"><?php echo (isset($hotelroom['freecancellation']) && $hotelroom['freecancellation'] !="") ? $hotelroom['freecancellation']:""; ?></textarea><br>
                                    <td style="background: transparent none repeat scroll 0% 0%;"><input type="checkbox" name="freecancelfront" <?php echo (isset($hotelroom['freecancelfront']) && $hotelroom['freecancelfront'] =="Y")?"checked":"";?> class="regular-text" value="Y"> Show Front? </td>
                                
                                    </td>
                                </tr>



                                </tbody>
                            </table>

                        </div>

                        <div class="tab-pane fade" id="features">

                            <table class="form-table">

                                <tbody>
                                <tr valign="top">
                                     <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label for="features">Features </label></th>
                                
                                <td>
                                <ul style="margin-left:30px">
                                <li>
                                <?php 
                                    $hotelroom_id = $hotelroom['hotelroom_id'];
                                   
                                    foreach ($features as $row) {
                                        $feature_name = $row['features_name'];
                                        $feature_id = $row['id'];
                                        $room_features = $this->hotel->get_room_feature($hotelroom_id, $feature_id);

                                ?>
                                <input type="checkbox" name="featureid[]" <?php echo (isset($room_features) && (!empty($room_features)))?"checked":"";?> value="<?php echo $feature_id; ?>" /><?php echo $feature_name; ?>    
                                <ul style="margin-left:30px">
                                <?php
                                    $child_name = $this->hotel->get_child($feature_id);
                                    foreach ($child_name as $key) {  
                                        $child_id = $key['id'];
                                        $room_features = $this->hotel->get_room_feature($hotelroom_id, $child_id);
                                ?>
                                <li>
                                <input type="checkbox" name="featureid[]" <?php echo (isset($room_features) && (!empty($room_features)))?"checked":"";?> value="<?php echo $child_id; ?>" /><?php echo $key['features_name']; ?></br>
                                  <?php
                                }
                                }
                                ?>
                                </li>                                        
                               
                                </ul>

                                </li>

                                </ul>

                                </td>
                                </tr>
                                </tbody>
                            </table>

                        </div>
                        <div class="tab-pane fade" id="image">

                            <div class="row">
    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                Gallery Albums
                <a class="btn btn-info" style="float: right; margin: -7px 4px 0px 0;" data-rel="tooltip" href="<?php echo site_url('album/form');?>" title="Add Album"><i class="fa fa-plus-square-o"></i> Add Album</a>
            </div>

            <div class="panel-body">

                <form method="post" action="">


                <div class="row">


                    <?php
                    if(! empty($records))
                    {
                        foreach($records as $row)
                        {

                            ?>
                            <div class="col-md-3 gal-image">
                                <?php
                                $image_detail = $this->crud->get_detail($row['image_id'], 'image_id', 'igc_image');
                                if((! empty($image_detail)) && file_exists('../uploads/album/'.$row['album_id'].'/'.$image_detail['name']))
                                {
                                    $path = '../uploads/album/'.$row['album_id'].'/'.$image_detail['name'];

                                    ?>

                                    <img class="img-responsive" src="<?php echo $path;?>">
                                <?php
                                }
                                else{
                                    ?>
                                    <img class="img-responsive" src="../img/featuredimage.jpg">
                                <?php
                                }
                                ?>
                                <span><?php echo $row['name'];?> </span>
                                <a href="<?php echo site_url('album/detail/'.$row['album_id']);?>" title="Edit Album"> <span class="album-pic-trash" style="color: #42678E !important;"><i class="fa fa-pencil-square"></i></span></a>
                                <?php
                                $album_id = $row['album_id'];
                                $link= $this->hotel->check_room_album($hotelroom_id, $album_id);

                                $checked = (isset($link) && (!empty($link)))?"checked":"";
                                ?>
                                <input type="checkbox" name="room_album[]" <?php echo $checked; ?> value="<?php echo $album_id;?>">

                            </div>
                        <?php
                        }

                        ?>
                        
                    <?php
                    }


                    else{
                        echo ("<h3 style='padding-left: 10px;'> No Albums</h3>");
                    }

                    ?>

                    <div class="clearfix"></div>






                </div>


                </form>
            
            </div>
        </div>


    </div>


</div>
</div>

   <input type = "hidden" name = "hotel_id" value = "<?php echo $hotelroom['hotel_id'] ;?>"/> 

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

    $('#save_content').click(function(e)
    {
        var a=0;
       
        var ext1 =  $('#room_image').val().split('.').pop().toLowerCase();
        
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
            alert('Invalid Room Image');
            e.preventDefault();
        }
        else{
            e.submit;
        }

    });
</script>

<!-- script to add new tags-->
<script>
    $.validate();
</script>
