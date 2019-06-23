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
        <!-- Advanced Tables -->
        <div class="panel panel-info">
            <div class="panel-heading">
                <i class="fa fa-plus-square-o"></i><a href="<?php echo site_url('activity/form');?>"> Add New Activity</a>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>S.N</th>
                            <th>Activity Name</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Show Front</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i = 1;
                        foreach($records as $row)
                        {
                            ?>

                            <tr class="odd gradeX">
                                <td><?php echo $i++;?></td>
                                <td><?php echo $row['activity_name'];?></td>

                                <td><?php echo $row['created'];?></td>
                                <td>

                                  <?php
                                    echo(isset($row['publish_status']) and $row['publish_status'] == "1") ? "Active" : "Inactive";
                                    ?>
                                </td>
                                <td>

                                    <input type="radio"  <?php echo isset($row['show_front']) && $row['show_front'] == "1" ? "checked":""?> id="<?php echo $row['activity_id'];?>" class="show_front"> Active
                                    <input type="radio" <?php echo isset($row['show_front']) && $row['show_front'] == "0" ? "checked":""?> id="<?php echo $row['activity_id'];?>" class="hide_front"> InActive
                                </td>

                                <td class="center">
                                    <div class="btn-group">

                                        <a href="<?php echo site_url('activity/form/'. $row['activity_id']);?>" class="btn btn-success" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                        <a href="<?php echo site_url('activity/gallery/'. $row['activity_id']);?>" class="btn btn-info" title="Add Gallery"><i class="fa fa-picture-o"></i></a>
                                        <a href="<?php echo site_url('activity/related_packages/'. $row['activity_id']);?>" class="btn btn-primary" title="Related Packages"><i class="fa fa-cogs"></i></a>
                                        <a class="btn btn-danger" data-target="#myModal_delete<?php echo $row['activity_id'];?>" data-toggle="modal" title="Delete"><i class="fa fa-trash-o"></i></a>
                                    </div>

                                    <!-- Modal for  delete -->
                                    <div id="myModal_delete<?php echo $row['activity_id'];?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Activity Delete Confirmation</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure to delete this Information</p>
                                                </div>

                                                <div class="modal-footer">
                                                    <input type="hidden" class="hidden_link_delete" value="<?php echo site_url('activity/delete/'. $row['activity_id']); ?>">
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
        <!--End Advanced Tables -->
    </div>
</div>
<!-- /. ROW  -->

<script>
    $('.delete').click(function(){

        var values = $(this).parent() .find('.hidden_link_delete').val();
        window.location =  values;
    });

</script>

<script>
    $('.show_front').click(function(){

        var id = $(this).attr("id");


        var postData = {
            'active_id' : id,
            'inactive_id' : ''

        };

        $.ajax({
            type: "POST",
            url: '<?php echo base_url() ?>index.php/activity/show_front',
            dataType: "html",

            data: postData, // appears as $_GET['id'] @ your backend side
            success: function(data) {

                location.reload();

            }

        });
    });


</script>

<script>
    $('.hide_front').click(function(){

        var id = $(this).attr("id");

        var postData = {
            'inactive_id' : id,
            'active_id' : ''

        };

        $.ajax({
            type: "POST",
            url: '<?php echo base_url() ?>index.php/activity/show_front',
            dataType: "html",

            data: postData, // appears as $_GET['id'] @ your backend side
            success: function(data) {

                location.reload();

            }

        });
    });


</script>

