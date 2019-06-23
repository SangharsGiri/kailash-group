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

<div class="panel panel-default">
<div class="panel-heading">
    Gallery Album [<?php echo $detail['name'];?>]
</div>

<div class="panel-body">
<form method="post" action="" role="form">
<div class="row">
    <div class="col-md-6">


        <div class="form-group">
            <label>Album Name</label>
            <input name="name" class="form-control" value="<?php echo (isset($detail['name']) && $detail['name'] != "") ? $detail['name'] : ""; ?>" kl_virtual_keyboard_secure_input="on">
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control" rows="3"><?php echo (isset($detail['description']) && $detail['description'] != "") ? $detail['description'] : ""; ?></textarea>
        </div>


        <div class="form-group">
            <label>Published</label>

            <div class="clearfix"></div>

            <input type="radio" name="publish_status" <?php echo (isset($detail['publish_status']) && $detail['publish_status'] == "1") ?"checked":""; ?> value="1"  data-validation="required" autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">Active
            <input type="radio" name="publish_status" <?php echo (isset($detail['publish_status']) && $detail['publish_status'] == "0") ?"checked":""; ?> value="0"  data-validation="required" autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">Inactive

        </div>
        <div class="clearfix"></div>

        <div class="form-group">
            <label>Images</label>

            <div class="clearfix"></div>

        </div>

    </div>

</div>


<div class="row">

    <?php
    foreach($records as $row)
    {
    ?>
<div class="col-md-6">

    <div class="well">

        <div class="col-md-6 gal-image">

            <img class=" img-responsive" src="<?php echo '../uploads/album/'.$detail['album_id'].'/'.$row['name'];?>">

                                            <span class="album-pic-trash delete_image" id="<?php echo $row['image_id'];?>">
                                                <i class="fa fa-trash-o"></i>
                                            </span>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Caption</label>
                <input type="text" name="image_caption[<?php echo $row['image_id'];?>]" value="<?php echo (isset($row['caption']) && $row['caption'] != '') ? $row['caption']:"" ?>" class="form-control" kl_virtual_keyboard_secure_input="on">
            </div>

            <div class="radio">
                <label>
                    <?php $checked = (isset($row['image_id']) && $row['image_id'] == $detail['image_id']) ? "checked":"" ?>

                    <input type="radio" name="album_cover" <?php echo $checked;?>  class="galleryCover" value="<?php echo $row['image_id'];?>">Gallery Cover
                </label>
            </div>

            <label class="checkbox-inline">
                <?php $check = (isset($row['publish_status']) && $row['publish_status'] == "1") ? "checked":"" ?>
                <input type="checkbox" name="image_publish[<?php echo $row['image_id'];?>]" <?php echo $check;?> value="1">
                Show in website
            </label>

        </div>
        <div class="clearfix"></div>

    </div>
    <input type="hidden" name="images[]" value="<?php echo $row['image_id'];?>">

</div>
    <?php
    }
    ?>



</div>

<div class="row">
    <div class="col-md-6">

        <a href="<?php echo site_url('album/add/'.$detail['album_id']);?>"  class="btn btn-info">Add More Image</a>
        <input type="hidden" name="album_id"  id="album_id" value="<?php echo $detail['album_id'];?>">

        <button class="btn btn-success" value="Submit" type="submit">save</button>
    </div>


</div>
</form>

</div>
</div>


</div>


</div>


<script>
    $('.delete_image').click(function(){
        var id = $(this).attr("id");
        var album_id = $('#album_id').val();

        var postData = {
            'id' : id,
            'album_id':album_id

        };

        $.ajax({
            type: "POST",
            url: '<?php echo base_url() ?>index.php/album/image_delete',
            dataType: "html",

            data: postData, // appears as $_GET['id'] @ your backend side
            success: function(data) {

                location.reload();

            }

        });
    });


</script>