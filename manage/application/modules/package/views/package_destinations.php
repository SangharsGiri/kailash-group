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
                 <div class="row">
                     <div class="col-md-2">
                         <label>Package Name</label>
                     </div>
                     <div class="col-md-10">
                         <span style="padding-left: 27px;"> <?php echo $detail['package_name'];?></span>

                     </div>
                 </div>
                    <div class="row" style="padding-top: 10px;">
                    <div class="col-md-2">
                        <label>Destinations</label>
                    </div>
                    <div class="col-md-10">
                    <ul class="related_pkg">
                        <?php
                        foreach($records as $rows)
                        {

                            $data = $this->crud->check_multiple_condition($package_id, 'package_id',$rows['destination_id'], 'destination_id','igc_package_destination');

                            $checked = (isset($data) && !empty($data))?"checked":"";
                            ?>
                            <li><input type="checkbox" name="destinations[]" <?php echo $checked;?> class="related_in" value="<?php echo $rows['destination_id'];?>"> <?php echo $rows['destination'];?></li>
                            <?php
                        }
                        ?>
                    </ul>
                        </div>
                    </div>


                    <div class="row" style="padding-top: 10px;">
                        <div class="col-md-2">
                            <label>Regions</label>
                        </div>
                        <div class="col-md-10">
                            <ul class="related_pkg">
                                <?php
                                foreach($regions as $row)
                                {

                                    $data = $this->crud->check_multiple_condition($package_id, 'package_id',$row['region_id'], 'region_id','igc_package_regions');

                                    $checked = (isset($data) && !empty($data))?"checked":"";
                                    ?>
                                    <li><input type="checkbox" name="regions[]" <?php echo $checked;?> class="related_in" value="<?php echo $row['region_id'];?>"> <?php echo $row['region_name'];?></li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>


            </div>



            <p class="submit" style="padding-left: 5px;">
                <input type="hidden" name="package_id" value="<?php echo $package_id; ?>">
                <input type="submit" name="Setting Btn" class="button" value="Save">
            </p>




            </form>

        </div>


    </div>
</div>
