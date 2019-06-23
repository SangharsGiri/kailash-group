
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
                                    $link= $this->activity->check_album_exist($activity_id, $album_id);
                                    $checked = (isset($link) && (!empty($link)))?"checked":"";
                                    ?>
                                    <input type="checkbox" name="activity_album[]" <?php echo $checked;?> value="<?php echo $album_id;?>">

                                </div>
                            <?php
                            }
                            ?>
                            <div class="col-md-12">
                                <input type="hidden" name="activity_id" value="<?php echo $activity_id ;?>">
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


