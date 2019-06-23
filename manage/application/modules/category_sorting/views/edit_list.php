<div class="page-content">
    <div id="tab-general">
        <div class="row mbl">
            <div class="col-lg-12">
                <div class="col-md-12">
                    <div id="area-chart-spline" style="width: 100%; height: 300px; display: none; padding: 0px; position: relative;">
                        <canvas class="flot-base" width="1059" height="300" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 1059px; height: 300px;"></canvas><div class="flot-text" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; font-size: smaller; color: rgb(84, 84, 84);"><div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"><div class="flot-tick-label tickLabel" style="position: absolute; top: 299px; left: 10px;">Jan</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 299px; left: 183px;">Feb</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 299px; left: 356px;">Mar</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 299px; left: 530px;">Apr</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 299px; left: 703px;">May</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 299px; left: 876px;">Jun</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 299px; left: 1049px;">Jul</div></div><div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"><div class="flot-tick-label tickLabel" style="position: absolute; top: 290px; left: 1px;">0</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 250px; left: 1px;">25</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 210px; left: 1px;">50</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 170px; left: 1px;">75</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 130px; left: 1px;">100</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 90px; left: 1px;">125</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 50px; left: 1px;">150</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 10px; left: 1px;">175</div></div></div><canvas class="flot-overlay" width="1059" height="300" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 1059px; height: 300px;"></canvas><div class="legend"><div style="position: absolute; width: 0px; height: 0px; top: 15px; right: 15px; opacity: 0.85; background-color: rgb(255, 255, 255);"> </div><table style="position:absolute;top:15px;right:15px;;font-size:smaller;color:#545454"><tbody><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid #ffce54;overflow:hidden"></div></div></td><td class="legendLabel">Upload</td></tr><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid #01b6ad;overflow:hidden"></div></div></td><td class="legendLabel">Download</td></tr></tbody></table></div></div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <?php echo $title;?></div>
                    <div class="panel-body pan">

                        <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                            <div class="form-body pal">
                                <?php if(isset($error)) {


                                    ?>
                                    <div class="alert alert-danger alert_box">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close"><i
                                                class="fa fa-times"></i></a>
                                        <strong>Error!</strong>  <?php echo $error; ?>.
                                    </div>
                                <?php
                                }
                                ?>

                                <div class="form-group">
                                    <label for="inputName" class="col-md-3 control-label">
                                        Category Title</label>
                                    <div class="col-md-9">
                                        <div class="input-icon right">

                                            <input type="text" name="category_name" id="inputCattitle" placeholder="Category Name" data-validation="required" class="form-control"  value="<?php echo (isset($detail['category_name']) && $detail['category_name'] !="") ? $detail['category_name']:""; ?>"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-md-3 control-label">
                                        Category Description</label>
                                    <div class="col-md-9">
                                        <div class=" mbn">
                                            <textarea name="description" class="form-control" id="description" placeholder="Description" rows="5" autocomplete="off"><?php echo (isset($detail['description']) && $detail['description'] !="") ? $detail['description']:""; ?></textarea></div>
                                    </div>
                                </div>
                                <?php
                                $path = "../uploads/category/";
                                if(isset($detail['featured_img']) && $detail['featured_img']!="")
                                {
                                ?>
                                <div class="form-group remove_option">
                                    <label for="inputName" class="col-md-3 control-label">
                                        Featured Image</label>
                                    <div class="col-md-9">
                                        <div class="input-icon featured-img right pull-left">

                                            <img title="" alt="" src="<?php echo $path.$detail['featured_img'];?>">

                                        </div>
                                    <button type="button" class="btn btn-red" id="btn_remove">Remove</button>
                                    </div>
                                    </div>

                                    <input type="hidden" name="pre_featuredimg" value="<?php echo $detail['featured_img']; ?>">
                                    <div class="form-group" id="image_input">
                                        <label for="inputName" class="col-md-3 control-label">
                                            Featured Image </label>
                                        <div class="col-md-9">
                                            <input type="file" name="featured_img" id="featuredimg">
                                            <span id="type_error"></span>
                                        </div>
                                    </div>
                                <?php
                                }
                                else{

                                ?>

                                <div class="form-group">
                                    <label for="inputName" class="col-md-3 control-label">
                                        Featured Image </label>
                                    <div class="col-md-9">
                                        <input type="file" name="featured_img" id="featuredimg">
                                        <span id="type_error"></span>
                                    </div>
                                </div>

                                <?php
                                }
                                ?>


                                <div class="form-group">
                                    <label for="inputName" class="col-md-3 control-label">
                                        Type</label>
                                    <div class="col-md-9">

                                        <select name="category_type" class="form-control">
                                            <option value="Curtain" <?php echo (isset($detail['category_type']) && $detail['publish_status'] =="Curtain") ? "selected":"";?>>Curtain</option>
                                            <option value="Fabric" <?php echo (isset($detail['category_type']) && $detail['publish_status'] =="Fabric") ? "selected":"";?>>Fabric</option>
                                            <option value="Accessories" <?php echo (isset($detail['category_type']) && $detail['publish_status'] =="Accessories") ? "selected":"";?>>Accessories</option>
                                        </select>



                                    </div>
                                </div>




                                <div class="form-group">
                                    <label for="inputName" class="col-md-3 control-label">
                                        Status</label>
                                    <div class="col-md-9">

                                        <select name="publish_status" class="form-control">
                                            <option value="1" <?php echo (isset($detail['publish_status']) && $detail['publish_status'] =="1") ? "selected":"";?>>Enable</option>
                                            <option value="0" <?php echo (isset($detail['publish_status']) && $detail['publish_status'] =="0") ? "selected":"";?>>Disable</option>
                                        </select>



                                    </div>
                                </div>



                                <div class="form-group">
                                    <label for="inputName" class="col-md-3 control-label">
                                        Meta Description</label>
                                    <div class="col-md-9">
                                        <div class=" mbn">
                                            <textarea name="meta_description" class="form-control"  placeholder="Meta Description" rows="5" autocomplete="off"><?php echo (isset($detail['meta_description']) && $detail['meta_description'] !="") ? $detail['meta_description']:""; ?></textarea></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputName" class="col-md-3 control-label">
                                        Meta keywords</label>
                                    <div class="col-md-9">
                                        <div class=" mbn">
                                            <textarea name="meta_keywords" class="form-control" id="description" placeholder="Meta Keywords" rows="5" autocomplete="off"><?php echo (isset($detail['meta_keywords']) && $detail['meta_keywords'] !="") ? $detail['meta_keywords']:""; ?></textarea></div>
                                    </div>
                                </div>
                                <div class="form-group mbn">
                                    <div class="col-md-offset-3 col-md-6">
                                        <input type="hidden" name="category_id" value="<?php echo (isset($detail['category_id']) && $detail['category_id'] !="") ? $detail['category_id']:""; ?>">
                                        <button type="reset" class="btn btn-info">Reset</button>
                                        <button  type="submit"  class="btn btn-primary" id="btn_category">
                                            Continue</button>
                                    </div>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>

            </div>









        </div>
    </div>
</div>

<script>
    CKEDITOR.replace( 'description' );
</script>


<script>
    $.validate();
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
<script type="text/javascript">
    $('#image_input').hide();
    $('#btn_remove').click(function () {

        $('.remove_option').hide();
        $('#image_input').show();

    });
</script>