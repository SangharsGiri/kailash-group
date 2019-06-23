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


                <div class="tab-content">




                        <div class="panel panel-default">
                            <div class="panel-heading">

                                <a class="btn btn-info" data-rel="tooltip" href="<?php echo site_url('package_category/sub_category_form');?>" title="Add Package Sub Category"><i class="fa fa-plus-square-o"></i> Add Package Sub-Category</a>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover"  id="dataTables-example">
                                        <thead>
                                        <tr>
                                            <th>S.N</th>
                                            <th>Sub-Category Name</th>
                                            <th>Parent Category</th>
                                            <th>Status</th>
                                            <th>Created Date</th>
                                            <th>Control</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $j = 1;
                                        foreach($sub_categories as $rows)
                                        {
                                            ?>
                                            <tr>
                                                <td><?php echo $j++;?></td>
                                                <td><?php echo $rows['sub_category_name'];?></td>
                                                <td><?php echo $rows['category_name'];?></td>
                                                <td><?php echo (isset($rows['publish_status']) && $rows['publish_status'] == "1")?"Active":"Inactive";?></td>
                                                <td><?php echo $rows['created'];?></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="<?php echo site_url('package_category/sub_category_form/'. $rows['sub_category_id']);?>" class="btn btn-success" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                                        <a href="<?php echo site_url('package_category/related_packages/'. $rows['sub_category_id']);?>" class="btn btn-primary" title="Related Packages"><i class="fa fa-cogs"></i></a>
                                                        <a class="btn btn-danger" data-target="#myModals_delete<?php echo $rows['sub_category_id'];?>" data-toggle="modal" title="Delete"><i class="fa fa-trash-o" ></i></a>
                                                    </div>

                                                    <!-- Modal for admin mail delete -->
                                                    <div id="myModals_delete<?php echo $rows['sub_category_id'];?>" class="modal fade" role="dialog">
                                                        <div class="modal-dialog">

                                                            <!-- Modal content-->
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title">Package Sub-Category Information Delete Confirmation</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Are you sure to delete this Information</p>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <input type="hidden" class="hidden_link" value="<?php echo site_url('package_category/delete_subcategory/'. $rows['sub_category_id']);?>">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                                    <button type="button" class="btn btn-default subcategory_delete">Ok</button>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <!--modal-->
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>





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

    $('.subcategory_delete').click(function(){

        var values = $(this).parent() .find('.hidden_link').val();
        window.location =  values;
    });

</script>