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
    Gallery Albums
    <a class="btn btn-info" style="float: right; margin: -7px 4px 0px 0;" data-rel="tooltip" href="<?php echo site_url('album/form');?>" title="Add Album"><i class="fa fa-plus-square-o"></i> Add Album</a>
</div>

<div class="panel-body">



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
            <a data-target="#myModal_delete<?php echo $row['album_id'];?>" data-toggle="modal" title="Delete"> <span class="album-pic-trash"><i class="fa fa-trash-o"></i></span></a>
            <!-- Modal for  delete -->
            <div id="myModal_delete<?php echo $row['album_id'];?>" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Album Delete Confirmation</h4>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure to delete this Information</p>
                        </div>

                        <div class="modal-footer">
                            <input type="hidden" class="hidden_link_delete" value="<?php echo site_url('album/album_delete/'. $row['album_id']); ?>">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-default delete">Ok</button>
                        </div>
                    </div>

                </div>
            </div>
            <!--modal-->
        </div>
    <?php
}
}

else{
    echo ("<h3 style='padding-left: 10px;'> No Albums</h3>");
}
    ?>

        <div class="clearfix"></div>






</div>




</div>
</div>


</div>


</div>
<script>
    $('.delete').click(function(){

        var values = $(this).parent() .find('.hidden_link_delete').val();
        window.location =  values;
    });

</script>

