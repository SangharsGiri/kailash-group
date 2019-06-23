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

                           <ul class="related_pkg">
                               <?php
                              foreach($packages as $rows)
                               {
                                 $package_id = $rows['package_id'];
                                   $data = $this->category->get_related_packages($category_id, $package_id);

                                   $checked = (isset($data) && !empty($data))?"checked":"";
                               ?>
                               <li><input type="checkbox" name="packages[]" <?php echo $checked;?> class="related_in" value="<?php echo $rows['package_id'];?>">   <?php echo $rows['package_name']."(".$rows['package_duration'].")"?></li>
                               <?php
                               }
                               ?>
                           </ul>


                        </div>



                        <p class="submit" style="padding-left: 5px;">
                            <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
                            <input type="submit" name="Setting Btn" class="button" value="Save">
                        </p>




                </form>

        </div>


    </div>
</div>
