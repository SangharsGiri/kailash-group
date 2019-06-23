
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <?php echo (isset($title) && $title != "") ? $title : "";?><?php echo " in Album ". $detail['name'];?>
            </div>

            <div class="panel-body">

                <form class="tab_form" method="post" action="" enctype="multipart/form-data">
                    <div class="tab-content">

                        <div class="tab-pane fade active in" id="home">

                            <table class="form-table">
                                <tbody>

                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>
                                            Images
                                        </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">&nbsp;</td>
                                </tr>

                                <tr valign="top">

                                    <td style="background: transparent none repeat scroll 0% 0%;">

                                        <input type="file" name="image1"  id="image1" >
                                        <p id="sig_error1" style="display:none; color:#FF0000;">Image formats should be JPG, JPEG, PNG or GIF.</p>
                                        <p id="sig_error2" style="display:none; color:#FF0000;">Max file size should be 20MB.</p>

                                    </td>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <input type="text" name="caption1"
                                               size="30"
                                               value=""  placeholder="Caption"
                                               autocomplete="off" class="regular-text required valid"
                                               kl_virtual_keyboard_secure_input="on"></td>
                                    </tr>
                                <tr valign="top">
                                    <td style="background: transparent none repeat scroll 0% 0%;">

                                        <input type="file" name="image2"  id="image2">
                                        <p id="sig_error1" style="display:none; color:#FF0000;">Image formats should be JPG, JPEG, PNG or GIF.</p>
                                        <p id="sig_error2" style="display:none; color:#FF0000;">Max file size should be 20MB.</p>

                                    </td>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <input type="text" name="caption2"
                                               size="30"
                                               value=""  placeholder="Caption"
                                               autocomplete="off" class="regular-text required valid"
                                               kl_virtual_keyboard_secure_input="on"></td>


                                </tr>

                                <tr valign="top">

                                    <td style="background: transparent none repeat scroll 0% 0%;">

                                        <input type="file" name="image3"  id="image3">
                                        <p id="sig_error1" style="display:none; color:#FF0000;">Image formats should be JPG, JPEG, PNG or GIF.</p>
                                        <p id="sig_error2" style="display:none; color:#FF0000;">Max file size should be 20MB.</p>

                                    </td>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <input type="text" name="caption3"
                                               size="30"
                                               value=""  placeholder="Caption"
                                               autocomplete="off" class="regular-text required valid"
                                               kl_virtual_keyboard_secure_input="on"></td>
                                    </tr>
                                <tr valign="top">
                                    <td style="background: transparent none repeat scroll 0% 0%;">

                                        <input type="file" name="image4"  id="image4">
                                        <p id="sig_error1" style="display:none; color:#FF0000;">Image formats should be JPG, JPEG, PNG or GIF.</p>
                                        <p id="sig_error2" style="display:none; color:#FF0000;">Max file size should be 20MB.</p>

                                    </td>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <input type="text" name="caption4"
                                               size="30"
                                               value=""  placeholder="Caption"
                                               autocomplete="off" class="regular-text required valid"
                                               kl_virtual_keyboard_secure_input="on"></td>
                                    </tr>
                                <tr valign="top">
                                    <td style="background: transparent none repeat scroll 0% 0%;">

                                        <input type="file" name="image5"  id="image5">
                                        <p id="sig_error1" style="display:none; color:#FF0000;">Image formats should be JPG, JPEG, PNG or GIF.</p>
                                        <p id="sig_error2" style="display:none; color:#FF0000;">Max file size should be 20MB.</p>

                                    </td>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <input type="text" name="caption5"
                                               size="30"
                                               value=""  placeholder="Caption"
                                               autocomplete="off" class="regular-text required valid"
                                               kl_virtual_keyboard_secure_input="on"></td>
                                    </tr>
                                <tr valign="top">
                                    <td style="background: transparent none repeat scroll 0% 0%;">

                                        <input type="file" name="image6"  id="image6">
                                        <p id="sig_error1" style="display:none; color:#FF0000;">Image formats should be JPG, JPEG, PNG or GIF.</p>
                                        <p id="sig_error2" style="display:none; color:#FF0000;">Max file size should be 20MB.</p>

                                    </td>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <input type="text" name="caption6"
                                               size="30"
                                               value="" placeholder="Caption"
                                               autocomplete="off" class="regular-text required valid"
                                               kl_virtual_keyboard_secure_input="on"></td>

                                </tr>







                                </tbody>
                            </table>


                        </div>


                        <p class="submit">
                            <input type="hidden" name="album_id"
                                   value="<?php echo (isset($detail['album_id']) && $detail['album_id'] != "") ? $detail['album_id'] : ""; ?>">
                            <input type="submit" name="Setting Btn" class="button" id="gallery_img" value="Save">
                        </p>


                    </div>
                </form>
            </div>
        </div>


    </div>
</div>
<script>

    $('#gallery_img').click(function(e)
    {

        var a=0;
        var b =0;
        var c =0
        var d=0;
        var e =0;
        var f =0

        var ext1 = $('#image1').val().split('.').pop().toLowerCase();
        var ext2 =  $('#image2').val().split('.').pop().toLowerCase();
        var ext3 =  $('#image3').val().split('.').pop().toLowerCase();
        var ext4 = $('#image4').val().split('.').pop().toLowerCase();
        var ext5 =  $('#image5').val().split('.').pop().toLowerCase();
        var ext6 =  $('#image6').val().split('.').pop().toLowerCase();


        if(ext1 == "")
        {
            a = 1;
        }
        else
        {
            if($.inArray(ext1, ['png','jpg','jpeg']) == -1)
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
            if($.inArray(ext2, ['png','jpg','jpeg']) == -1)
            {
                b = 0
            }
            else
            {

                b = 1;
            }
        }

        if(ext3 == "")
        {
            c = 1;
        }
        else
        {
            if($.inArray(ext3, ['png','jpg','jpeg']) == -1)
            {
                c = 0
            }
            else
            {

                c = 1;
            }
        }

        if(ext4 == "")
        {
            d = 1;
        }
        else
        {
            if($.inArray(ext4, ['png','jpg','jpeg']) == -1)
            {
                d = 0
            }
            else
            {

                d = 1;
            }
        }

        if(ext5 == "")
        {
            e = 1;
        }
        else
        {
            if($.inArray(ext5, ['png','jpg','jpeg']) == -1)
            {
                e = 0
            }
            else
            {

                e = 1;
            }
        }

        if(ext6 == "")
        {
            f = 1;
        }
        else
        {
            if($.inArray(ext6, ['png','jpg','jpeg']) == -1)
            {
                f = 0
            }
            else
            {

                f = 1;
            }
        }


        if(a != "1")
        {
            alert('Invalid Image1');
            e.preventDefault();
        }
        else if(b != "1")
        {
            alert('Invalid Image2');
            e.preventDefault();
        }
        else if(c != "1")
        {
            alert('Invalid Image3');
            e.preventDefault();
        }
        else if(d != "1")
        {
            alert('Invalid Image4');
            e.preventDefault();
        }
        else if(e != "1")
        {
            alert('Invalid Image5');
            e.preventDefault();
        }
        else if(f != "1")
        {
            alert('Invalid Image5');
            e.preventDefault();
        }
        else{

            e.submit;

        }


    });
</script>