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
                Related Hotel
            </div>
            <div class="panel-body">
                <form method="post" action="">
                <div class="row">
                    <?php
                    if(! empty($records))
                    {
                        foreach($records as $row)
                        {
                        	$hotel_name = $row['name'];
                        	$related_id = $row['id'];
                        	

                            ?>
                            <div class="col-md-3 gal-image">

                                <?php
                                $link= $this->hotel->check_related_exist($id, $related_id); 
                                $checked = (isset($link) && (!empty($link)))?"checked":"";
                                ?> 
                               <input type="checkbox" name="hotel_related[]" <?php echo $checked;?> value="<?php echo $related_id;?>">
                               <?php
                             
                               ?>
                                <span><?php echo $row['name'];?> </span>
                              
                            </div>
                        <?php
                       
                    }
                        ?>
                        <div class="col-md-12">
                            <input type="hidden" name="id" value="<?php echo $id ;?>">
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

