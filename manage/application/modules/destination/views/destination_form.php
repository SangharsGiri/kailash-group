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
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Region Name <span class="asterisk">*</span>
                                        </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;"><input type="text" name="destination"  size="50" data-validation="required" value="<?php echo (isset($destination['destination']) && $destination['destination'] !="") ? $destination['destination']:""; ?>"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on"></td>
                                </tr>
                                
                                
                                <tr valign="top" id="featured_img">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Featured Image</label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <?php
                                        if(isset($destination['featured_img']))
                                        {

                                            ?>
                                            <div class="remove_option">

                                                <?php
                                                $path  =  '../uploads/destinations/';
                                                ?>
                                                <img src="<?php echo $path. $destination['featured_img'];?>" alt="featured_image" style="max-width: 940px; max-height: 360px;">

                                                <span class="btn btn-info remove_btn" id="btn_remove">Remove</span>
                                            </div>
                                            <input type="hidden" name="pre_featuredimg" value="<?php echo $destination['featured_img']; ?>">
                                            <div id="image_input">

                                                <span>(Image Dimension 853*405 px)</span>
                                                <input type="file" name="featured_img" id="featuredimg">
                                                <span id="type_error"></span>
                                            </div>
                                        <?php
                                        }
                                        else
                                        {
                                            ?>

                                            <span>(Image Dimension 853*405 px)</span>
                                            <input type="file" name="featured_img"  id="featuredimg">
                                            <span id="type_error"></span>
                                        <?php
                                        }
                                        ?>


                                    </td>
                                </tr>
                                
                                <tr valign="top" class="contact_detail">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row">
                                        <label>Destination Details</label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <textarea rows="5" cols="10" name="destination_detail" id="destination_detail"><?php echo (isset($destination['destination_detail']) && $destination['destination_detail'] !="") ? $destination['destination_detail']:""; ?></textarea>
                                    </td>
                                </tr>

                                </tbody>
                            </table>


                        </div>



                        <p class="submit">
                            <input type="hidden" name="destination_id" value="<?php echo (isset($destination['destination_id']) && $destination['destination_id'] !="") ? $destination['destination_id']:""; ?>">
                            <input type="submit" name="Setting Btn" class="button" value="Save">
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
    CKEDITOR.replace( 'destination_detail',{
    filebrowserUploadUrl: "/rp-admin/themes/plugins/ckeditor/imgupload.php/",
    filebrowserWindowWidth  : 800,
    filebrowserWindowHeight : 500
});

</script>
<script>
    $('.add-tag').click(function(){
        var value = $(this).attr("id");
        $('#new_tags').val($('#new_tags').val() + value);
    });
</script>
<!-- script to remove tags-->
<script>
    $('.remtag').click(function(){

        var term = $(this).attr("id");
        var content = $('#content_id').val();

        var postData = {
            'term_id' : term,
            'content_id' : content
        };


        $.ajax({
            type: "POST",
            url: '<?php echo base_url() ?>index.php/content/rmv_content_tag',
            dataType: "html",

            data: postData, // appears as $_GET['id'] @ your backend side
            success: function(data) {

                location.reload();

            }

        });
    });


</script>
<script>
    $(document).ready(function(e){

        var  value = $('.page_type').val();

        if(value == "Page")
        {

            $('#multi_tab').show();

        }

        else
        {

            $('#multi_tab').hide();


        }

        $('.page_type').change(function(){
            var  value = $('.page_type').val();
            if(value == "Page")
            {

                $('#multi_tab').show();

            }
            else
            {

                $('#multi_tab').hide();


            }
        })
    })
</script>

<script>

    $('#save_content').click(function(e)
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


