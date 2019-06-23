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

                    <div class="tab-pane fade active in" id="home">
                        <div class="panel panel-default">
                            <div class="panel-heading">

                                <a class="btn btn-info" data-rel="tooltip" href="<?php echo site_url('package_category/category');?>" title="Add Package Category"><i class="fa fa-plus-square-o"></i> Add Package Category</a>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover"  id="dataTables-example">
                                        <thead>
                                        <tr>
                                            <th>S.N</th>
                                            <th>Category Name</th>

                                            <th>Created</th>
                                            <th>Status</th>
                                            <th>Show Front</th>
                                            <th>Control</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i = 1;
                                        foreach($categories as $row)
                                        {
                                            ?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $row['category_name'];?></td>


                                                <td><?php echo $row['created'];?></td>
                                                <td><?php echo (isset($row['publish_status']) && $row['publish_status'] =="1")?"Active":"Inactive";?></td>
                                                <td>

                                                    <input type="radio"  <?php echo isset($row['show_front']) && $row['show_front'] == "1" ? "checked":""?> id="<?php echo $row['category_id'];?>" class="cat_active"> Active
                                                    <input type="radio" <?php echo isset($row['show_front']) && $row['show_front'] == "0" ? "checked":""?> id="<?php echo $row['category_id'];?>" class="cat_inactive"> InActive
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="<?php echo site_url('package_category/category/'. $row['category_id']);?>" class="btn btn-success" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                                        <a href="<?php echo site_url('package_category/related_packages/'. $row['category_id']);?>" class="btn btn-primary" title="Related Packages"><i class="fa fa-cogs"></i></a>
                                                        <a class="btn btn-danger" data-target="#myModal_delete<?php echo $row['category_id'];?>" data-toggle="modal" title="Delete"><i class="fa fa-trash-o" ></i></a>
                                                    </div>

                                                    <!-- Modal for booking delete -->
                                                    <div id="myModal_delete<?php echo $row['category_id'];?>" class="modal fade" role="dialog">
                                                        <div class="modal-dialog">

                                                            <!-- Modal content-->
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title">Package Category Information Delete Confirmation</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Are you sure to delete this Information</p>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <input type="hidden" class="hidden_link_delete" value="<?php echo site_url('package_category/delete_category/'. $row['category_id']); ?>">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                                    <button type="button" class="btn btn-default delete">Ok</button>
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

<script>
    $('.cat_active').click(function(){

        var id = $(this).attr("id");


        var postData = {
            'active_id' : id,
            'inactive_id' : ''

        };

        $.ajax({
            type: "POST",
            url: '<?php echo base_url() ?>index.php/package_category/show_front',
            dataType: "html",

            data: postData, // appears as $_GET['id'] @ your backend side
            success: function(data) {

                location.reload();

            }

        });
    });


</script>

<script>
    $('.cat_inactive').click(function(){

        var id = $(this).attr("id");

        var postData = {
            'inactive_id' : id,
            'active_id' : ''

        };

        $.ajax({
            type: "POST",
            url: '<?php echo base_url() ?>index.php/package_category/show_front',
            dataType: "html",

            data: postData, // appears as $_GET['id'] @ your backend side
            success: function(data) {

                location.reload();

            }

        });
    });


</script>