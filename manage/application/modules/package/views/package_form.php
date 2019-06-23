<div class="row">
    <div class="col-lg-12">
        <?php
           if(validation_errors())
           {
               ?>

               <div class="alert  alert-danger alert_box">
                   <a href="#" class="close alert_message" data-dismiss="alert" aria-label="close"><i
                           class="fa fa-times"></i></a>
                   <?php echo validation_errors();?>
               </div>
               <?php
           }
           ?>
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
<!-- Form Elements -->
<div class="panel panel-info">
<div class="panel-heading">
    Add/Edit Packages
</div>
<div class="panel-body">
<div class="row">
<div class="col-md-12">

<form role="form" method="post" id="form-a" action="" enctype="multipart/form-data">
<ul class="nav nav-pills">
    <li class="active"><a data-toggle="pill" href="#home">Package</a></li>
    <li><a data-toggle="pill" href="#menu1">Description</a></li>
    <li><a data-toggle="pill" href="#menu2">Price</a></li>
    <li><a data-toggle="pill" href="#menu3">Images & PDF</a></li>
    <!--            <li><a data-toggle="pill" href="#menu4">Destination & Activities</a></li>-->
<!--    <li><a data-toggle="pill" href="#menu5">Itinerary</a></li>-->
    <li><a data-toggle="pill" href="#menu6">Tabs</a></li>
    <li><a data-toggle="pill" href="#menu7">Meta Tags</a></li>

</ul>

<div class="tab-content package">
<div id="home" class="tab-pane fade in active">
    <div class="row">
        <div class="col-md-3"><label>Tour Code</label></div>
        <div class="col-md-6">
            <div class="form-group">
                <input type="text" name="tourcode" class="form-control" id="tour_code" value="<?php echo (isset($package['tourcode']) !="") ? $package['tourcode']:""; ?>" data-validation="required">

            </div>
        </div>
    </div><!--row-->

    <div class="row">
        <div class="col-md-3"><label>Package Name</label></div>
        <div class="col-md-6">
            <div class="form-group">

                <input type="text" name="package_name" class="form-control" id="package_name" value="<?php echo (isset($package['package_name']) !="") ? $package['package_name']:""; ?>"  data-validation="required">
                <span id="package_name_error"></span>
            </div>
        </div>
    </div><!--row-->


    <div class="row">
        <div class="col-md-3"><label>Package Duration</label></div>
        <div class="col-md-6">
            <div class="form-group">
                <input type="text" name="package_duration" class="form-control" value="<?php echo (isset($package['package_duration']) !="") ? $package['package_duration']:""; ?>" data-validation="required">
            </div>
        </div>
    </div><!--row--><!-- 
     <label> <i class="fa fa-list-alt"></i> <b>Categories</b></label>

                            <select class="form-control select2" multiple="multiple" data-placeholder="Select category" name="category_id[]"
                                    style="width: 100%;">
                                <?php foreach ($get_active_category as $cat) { ?>
                                    <option value="<?php echo $cat['category_id']; ?>"><?php echo $cat['category_name'] ?></option>
                                <?php } ?>

                            </select> -->
    <div class="row">
        <div class="col-md-3"><label>Package Category</label></div>
        <div class="col-md-6">
            <div class="form-group">
                          <select class="r" multiple="multiple" data-placeholder="Select Package category"  name="category_id[]"
                                    style="width: 100%;">
                                <?php foreach ($package_categories as $cat) { ?>
                                    <option value="<?php echo  $cat['category_id'] ?>"
                                    <?php  foreach ($current_categories as $postCat){ ?>
                                    <?php if ($postCat['category_id'] == $cat['category_id']){ ?>
                                    selected
                                    <?php }} ?>
                                    
                                ><?php echo $cat['category_name']; ?></option>
                                <?php } ?>

                            </select>
<script>
   $(document).ready(function() {
    $('.r').select2();
});
</script>
                                
            </div>
        </div>
    </div><!--row-->
    <div class="row">
        <div class="col-md-3"><label>Rating</label></div> 
        <div class="col-md-6">
            <div class="form-group">
                <input type="text" name="rating" class="form-control" value="<?php echo (isset($package['rating']) !="") ? $package['rating']:""; ?>"  data-validation="number" data-validation-allowing="range[1;5]">
            </div>
        </div>
    </div><!--row-->

    <div class="row">
        <div class="col-md-3"><label>Price</label></div>
        <div class="col-md-6">
            <div class="form-group">
                <input type="text" name="price" class="form-control" value="<?php echo (isset($package['price']) !="") ? $package['price']:""; ?>"  data-validation="number">
            </div>
        </div>
    </div><!--row-->

    <div class="row">
        <div class="col-md-3"><label>Discount Price</label></div>
        <div class="col-md-6">
            <div class="form-group">
                <input type="text" name="discount_price" class="form-control" value="<?php echo (isset($package['discount_price']) !="") ? $package['discount_price']:""; ?>">
            </div>
        </div>
    </div><!--row-->


    <div class="row">
        <div class="col-md-3"><label>Is Active</label></div>
        <div class="col-md-6">
            <div class="form-group">

                <div class="col-md-3"><input type="radio" <?php echo(isset($package['status']) and $package['status'] == "1")?"checked":"";?> value="1"  name="is_active"  data-validation="required"><span style="padding-left: 11px;">Yes</span></div>
                <div class="col-md-2"><input type="radio" <?php echo(isset($package['status']) and $package['status'] == "0")?"checked":"";?> value="0" name="is_active"  data-validation="required"><span style="padding-left: 11px;">No</span></div>
            </div>
        </div>
    </div><!--row-->


    <div class="row show_mobile">
        <div class="col-md-3"><label>Show On Mobile</label></div>
        <div class="col-md-6">
            <div class="form-group">

                <div class="col-md-3"><input type="radio" <?php echo(isset($package['show_mobile']) and $package['show_mobile'] == "Y")?"checked":"";?> value="Y"  name="show_mobile"  data-validation="required"><span style="padding-left: 11px;">Yes</span></div>
                <div class="col-md-2"><input type="radio" <?php echo(isset($package['show_mobile']) and $package['show_mobile'] == "N")?"checked":"";?> value="N" name="show_mobile"  data-validation="required"><span style="padding-left: 11px;">No</span></div>
            </div>
        </div>
    </div><!--row-->


    <div class="row">
        <div class="col-md-3"><label>Package Tags</label></div>
        <div class="col-md-6">
            <div class="form-group">
                <div class="tag-category content-tags">
                    <?php
                    $added_tags = $this->package->get_added_tags($package_id);
                    foreach($added_tags as $row)
                    {
                        ?>
                        <span class="tagNameHolder"><?php echo $row['term_name'];?><span class="remtag" id="<?php echo $row['term_id'];?>"></span></span>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div><!--row-->

    <div class="row">
        <div class="col-md-3"><label>Add New Tags</label></div>
        <div class="col-md-6">
            <div class="form-group">

                <input type="text" name="package_tags" class="form-control"  id="new_tags"
                       value="" placeholder="Enter New Tags">

                <label for="exampleInputEmail1">Select From Available Tags</label>
                <div class="tag-category" id="append-tag">
                    <?php
                    $available_tags = $this->package->get_available_tags($package_id);
                    foreach($available_tags as $rows)
                    {
                        ?>
                        <span class="tagNameHolder add-tag" id="<?php echo $rows['term_name'].","?>"><?php echo $rows['term_name'];?><span class="addtag"></span></span>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div><!--row-->


</div>
<div id="menu1" class="tab-pane fade">
    <div class="row">
        <div class="col-md-2"><label>Package Summary</label></div>
        <div class="col-md-8">
            <div class="form-group">

                <textarea rows="3" class="form-control" name="summary" id ="txt-content"><?php echo (isset($package['summary']) !="") ? $package['summary']:""; ?></textarea>
            </div>
        </div>
    </div><!--row-->
    <div class="row">
        <div class="col-md-2"><label>Package Description</label></div>
        <div class="col-md-8">
            <div class="form-group">

                <textarea rows="3" class="form-control" name="description" id ="txt-content1"><?php echo (isset($package['description']) !="") ? $package['description']:""; ?></textarea>
            </div>
        </div>
    </div><!--row-->
</div>
<div id="menu2" class="tab-pane fade">
    <?php
    $accommodation = $this->package->get_accommodations();
    foreach($accommodation as $row)
    {
        ?>
        <div class="row" style="padding-top: 10px;">

            <div class="col-md-1"><label><?php echo $row['name'];?></label></div>

            <div class="col-md-10"><div class="form-group">

                    <?php
                    $currencies  = $this->package->get_currencies();

                    foreach($currencies as $currency)
                    {


                        $package_id = (isset($package['package_id']) !="") ? $package['package_id'] : "0";
                        $data = $this->package->get_each_price($package_id, $row['accommodation_id'], $currency['currency_id']);
//                        print_r($data);
//                        exit;
                        $chk = (isset($data['is_front']) and $data['is_front'] == "Y") ? "checked" : "";

                        ?>
                        <div class="col-md-2">
                            <input type="text" name="pprice[<?php echo $row['accommodation_id'].$currency['currency_id'];?>]" value="<?php echo (isset($data['pprice']) != "") ? $data['pprice']:""; ?>" class="package_price" placeholder="<?php echo $currency['code'];?>" data-validation="number" data-validation-optional="true">
                            <input type="radio" name="is_front"  <?php echo $chk;?> value="<?php echo $row['accommodation_id'].$currency['currency_id'];?>" >
                            <input type="hidden" name="accommodation_id[<?php echo $row['accommodation_id'].$currency['currency_id'];?>]" value="<?php echo $row['accommodation_id'];?>">
                            <input type="hidden" name="currency_id[<?php echo $row['accommodation_id'].$currency['currency_id'];?>]" value="<?php echo $currency['currency_id'];?>">
                        </div>
                    <?php

                    }

                    ?>


                </div></div>

        </div><!--row-->
    <?php
    }
    ?>

</div>
<?php
$path  ='../uploads/package/'.$package_id."/";
?>
<div id="menu3" class="tab-pane fade">
    <div class="row">
        <div class="col-md-10">
            <div class="form-group">
                <?php

                if(! empty($package['featuredimg']))
                {

                    ?>
                    <div class="remove_option">


                        <img src="<?php echo $path. $package['featuredimg'];?>" alt="package_image" style="max-width: 940px; max-height: 360px;">

                        <span class="btn btn-info remove_btn" id="btn_remove">Remove</span>
                    </div>
                    <input type="hidden" name="pre_featuredimg" value="<?php echo $package['featuredimg']; ?>">
                    <div id="image_input">
                        <label>Upload Featured Image</label>
                        <span>(Image Dimension 560*370 px)</span>
                        <input type="file" name="featuredimg" id="featuredimg">
                        <span id="featured_error"></span>
                    </div>
                <?php
                }
                else
                {
                    ?>
                    <label>Upload Featured Image</label>
                    <span>(Image Dimension 560*370 px)</span>
                    <input type="file" name="featuredimg" data-validation= "required" id="featuredimg">
                    <span id="featured_error"></span>

                <?php
                }
                ?>



            </div>
        </div>
        <div class="col-md-10">
            <div class="form-group">
                <?php

                if(! empty($package['packageimg']))
                {

                    ?>
                    <div class="remove_option1">


                        <img src="<?php echo $path. $package['packageimg'];?>" alt="package_image" style="max-width: 940px; max-height: 360px;">

                        <span class="btn btn-info remove_btn" id="btn_remove1">Remove</span>
                    </div>
                    <input type="hidden" name="pre_packageimg" value="<?php echo $package['packageimg']; ?>">
                    <div id="image_input1">
                        <label>Upload Banner Image</label>
                        <span>(Image Dimension 1111*430 px)</span>

                        <input type="file" name="packageimg"  id="bannerimg">
                        <span id="banner_error"></span>
                    </div>
                <?php
                }
                else
                {
                    ?>
                    <label>Upload Banner Image</label>
                    <span>(Image Dimension 1111*430 px)</span>

                    <input type="file" name="packageimg" data-validation= "required" id="bannerimg">
                    <span id="banner_error"></span>
                <?php
                }
                ?>



            </div>
        </div>
        <div class="col-md-10">
            <div class="form-group" style="padding-top: 10px;">
                <?php


                if(! empty($package['pdfup']))
                {

                    ?>
                    <div class="remove_option2">

                        <i class="fa fa-file-pdf-o" style="font-size: 50px;"></i>

                        <span class="btn btn-info remove_btn" id="btn_remove2">Remove</span>
                    </div>
                    <input type="hidden" name="pre_pdfup" value="<?php echo $package['pdfup']; ?>">
                    <div id="pdf_input">
                        <label>Upload PDF</label>
                        <input type="file" name="pdfup" id="pdfup">
                        <span id="pdf_error"></span>


                    </div>
                <?php
                }
                else
                {
                    ?>
                    <label>Upload PDF</label>
                    <input type="file" name="pdfup" id="pdfup">
                    <span id="pdf_error"></span>

                <?php
                }
                ?>



            </div>
        </div>


    </div>
</div>


<!---Tabs-->

<div id="menu6" class="tab-pane fade">
    <div class="row">
        <div class="col-md-2">
            <label>Tab1</label>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <input type="text" name="tab1" value="<?php echo (isset($package['tab1']) !="") ? $package['tab1']:""; ?>" class="form-control">
            </div>
        </div>

    </div><!--row-->

    <div class="row">
        <div class="col-md-2">
            <label>Tab1 Description</label>
        </div>

        <div class="col-md-10">
            <div class="form-group">
                <textarea rows="3" name="description1" class="form-control" id ="tab1"><?php echo (isset($package['description1']) !="") ? $package['description1']:""; ?></textarea>
            </div>
        </div>



    </div><!--row-->
    <div class="row">
        <div class="col-md-2">
            <label>Tab2</label>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <input type="text" name="tab2" value="<?php echo (isset($package['tab2']) !="") ? $package['tab2']:""; ?>" class="form-control">
            </div>
        </div>

    </div><!--row-->

    <div class="row">
        <div class="col-md-2">
            <label>Tab2 Description</label>
        </div>

        <div class="col-md-10">
            <div class="form-group">
                <textarea rows="3" name="description2" class="form-control" id ="tab2"><?php echo (isset($package['description2']) !="") ? $package['description2']:""; ?></textarea>
            </div>

        </div>

    </div><!--row-->

    <div class="row">
        <div class="col-md-2">
            <label>Tab3</label>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <input type="text" name="tab3" value="<?php echo (isset($package['tab3']) !="") ? $package['tab3']:""; ?>" class="form-control">
            </div>
        </div>
    </div><!--row-->


    <div class="row">
        <div class="col-md-2">
            <label>Tab3 Description</label>
        </div>

        <div class="col-md-10">
            <div class="form-group">
                <textarea rows="3" name="description3" class="form-control" id ="tab3"><?php echo (isset($package['description3']) !="") ? $package['description3']:""; ?></textarea>
            </div>

        </div>

    </div><!--row-->

    <div class="row">
        <div class="col-md-2">
            <label>Tab4</label>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <input type="text" name="tab4" value="<?php echo (isset($package['tab4']) !="") ? $package['tab4']:""; ?>" class="form-control">
            </div>
        </div>
    </div><!--row-->


    <div class="row">
        <div class="col-md-2">
            <label>Tab4 Description</label>
        </div>

        <div class="col-md-10">
            <div class="form-group">
                <textarea rows="3" name="description4"  class="form-control" id ="tab4"><?php echo (isset($package['description4']) !="") ? $package['description4']:""; ?></textarea>
            </div>

        </div>

    </div><!--row-->

    <div class="row">
        <div class="col-md-2">
            <label>Tab5</label>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <input type="text" name="tab5" value="<?php echo (isset($package['tab5']) !="") ? $package['tab5']:""; ?>" class="form-control">
            </div>
        </div>
    </div><!--row-->


    <div class="row">
        <div class="col-md-2">
            <label>Tab5 Description</label>
        </div>

        <div class="col-md-10">
            <div class="form-group">
                <textarea rows="3" name="description5" class="form-control" id ="tab5"><?php echo (isset($package['description5']) !="") ? $package['description5']:""; ?></textarea>
            </div>

        </div>

    </div><!--row-->



</div><!--menu6-->

<!---Tabs-->

<div id="menu7" class="tab-pane fade">
    <div class="row">
        <div class="col-md-2">
            <label>Meta description</label>
        </div>

        <div class="col-md-8">
            <div class="form-group">
                <textarea name="meta_description" style="width: 453px; height: 65px;"><?php echo (isset($package['meta_description']) !="") ? $package['meta_description']:""; ?></textarea>
            </div>
        </div>
    </div><!--row-->
    <div class="row">
        <div class="col-md-2">
            <label>Meta keywords</label>
        </div>

        <div class="col-md-8">
            <div class="form-group">

                <textarea name="meta_keywords" style="width: 453px; height: 65px;"><?php echo (isset($package['meta_keywords']) !="") ? $package['meta_keywords']:""; ?></textarea>
            </div>
        </div>
    </div><!--row-->

    <div class="row">

        <div class="col-md-2">

            <label>Meta Title</label>

        </div>



        <div class="col-md-8">

            <div class="form-group">



                <textarea name="meta_title" style="width: 453px; height: 65px;" ><?php echo (isset($package['meta_title']) !="") ? $package['meta_title']:""; ?></textarea>

            </div>

        </div>

    </div><!--row-->

</div>




</div>
<div class="row">

    <div class="col-md-2" style="float: right;">

        <div class="form-group">

            <input type="hidden" name="package_id" id="package_id" value="<?php echo (isset($package['package_id']) && $package['package_id'] !="") ? $package['package_id']:"0"; ?>">

            <button type="submit" class="btn btn-primary btn_package" id="btn_package">Save Package</button>
        </div>
    </div>
</div>
</form>



</div>


</div>
</div>
</div>
<!-- End Form Elements -->
</div>
</div>
<script>
    $.validate();

</script>
<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace( 'txt-content' );
    CKEDITOR.replace( 'txt-content1' );
    CKEDITOR.replace( 'tab1' );
    CKEDITOR.replace( 'tab2' );
    CKEDITOR.replace( 'tab3' );
    CKEDITOR.replace( 'tab4' );
    CKEDITOR.replace( 'tab5' );


</script>

<!-- script to add new tags-->
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
        var package = $('#package_id').val();

        var postData = {
            'term_id' : term,
            'package_id' : package
        };


        $.ajax({
            type: "POST",
            url: '<?php echo base_url() ?>index.php/package/rmv_package_tag',
            dataType: "html",

            data: postData, // appears as $_GET['id'] @ your backend side
            success: function(data) {

                location.reload();

            }

        });
    });


</script>


<script>

    $('#btn_package').click(function(e)
    {

        var a=0;
        var b =0;
        var c =0

        $("#featured_error").text("");
        $("#banner_error").text("");
        $("#pdf_error").text("");

        var ext1 = $('#bannerimg').val().split('.').pop().toLowerCase();
        var ext2 =  $('#featuredimg').val().split('.').pop().toLowerCase();
        var ext3 =  $('#pdfup').val().split('.').pop().toLowerCase();

        var tourcode = $('#tour_code').val();
        var package_id = $('#package_id').val();



<!--        var postData = {-->
<!--            'code' : tourcode,-->
<!--            'package_id' : package_id-->
<!--        };-->
<!---->
<!---->
<!--        $.ajax({-->
<!--            type: "POST",-->
<!--            url: '--><?php //echo base_url() ?><!--index.php/package/check_tour_code',-->
<!--            dataType: "html",-->
<!---->
<!--            data: postData, // appears as $_GET['id'] @ your backend side-->
<!--            success: function(data) {-->
<!---->
<!--                if(data == "1")-->
<!--                {-->
<!--                    alert("1");-->
<!--                }-->
<!--                else-->
<!--                {-->
<!--                    alert("0");-->
<!--                }-->
<!---->
<!--            }-->
<!---->
<!--        });-->

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

        if(ext3 == "")
        {
            c = 1;
        }
        else
        {
            if($.inArray(ext3, ['pdf']) == -1)
            {
                c = 0
            }
            else
            {

                c = 1;
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
        else if(c != "1")
        {

            $("#pdf_error").text("Invalid pdf file");
            $("#pdf_error").css("color", "red");
            e.preventDefault();
        }
        else{

            e.submit;

        }


    });
</script>


