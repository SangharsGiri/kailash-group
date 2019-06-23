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
                                $link= $this->package->check_album_exist($package_id, $album_id);
                                $checked = (isset($link) && (!empty($link)))?"checked":"";
                                ?>
                                <input type="checkbox" name="package_album[]" <?php echo $checked;?> value="<?php echo $album_id;?>">

                            </div>
                        <?php
                        }
                        ?>
                        <div class="col-md-12">
                            <input type="hidden" name="package_id" value="<?php echo $package_id ;?>">
                            <input type="submit" name="Save Btn" class="button" value="Save">
                        </div>
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


