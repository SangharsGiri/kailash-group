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
                <i class="fa fa-commenting-o"></i> <?php echo $page_title;?>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>S.N</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Date</th>
                            <th>Status</th>
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
                                <td><?php echo $row['sender_name'];?></td>
                                <td><?php echo $row['sender_email'];?></td>
                                <td><?php echo $row['comment_date'];?></td>
                                <td>

                                    <input type="radio" <?php echo isset($row['approved_status']) && $row['approved_status'] == "1" ? "checked":""?> id="<?php echo $row['comment_id'];?>" class="cmt_active"> Publish
                                    <input type="radio" <?php echo isset($row['approved_status']) && $row['approved_status'] == "0" ? "checked":""?> id="<?php echo $row['comment_id'];?>" class="cmt_inactive"> UnPublish
                                </td>

                                <td class="center">
                                    <div class="btn-group">

                                        <a class="btn btn-info" data-target="#myModal_detail<?php echo $row['comment_id'];?>" data-toggle="modal"  title="Detail"><i class="fa fa-info-circle"></i></a>
                                        <a class="btn btn-danger" data-target="#myModal_delete<?php echo $row['comment_id'];?>" data-toggle="modal" title="Delete"><i class="fa fa-trash-o"></i></a>
                                    </div>
                                    <!-- Modal for news -->
                                    <div id="myModal_detail<?php echo $row['comment_id'];?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Message</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p><?php echo $row['message'];?></p>
                                                </div>

                                                <div class="modal-footer">

                                                    <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!--modal-->
                                    <!-- Modal for  delete -->
                                    <div id="myModal_delete<?php echo $row['comment_id'];?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Content Delete Confirmation</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure to delete this Information</p>
                                                </div>

                                                <div class="modal-footer">
                                                    <input type="hidden" class="hidden_link_delete" value="<?php echo site_url('content/comment_delete/'. $row['content_id']); ?>">
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
    $('.cmt_active').click(function(){

        var id = $(this).attr("id");


        var postData = {
            'id' : id

        };

        $.ajax({
            type: "POST",
            url: '<?php echo base_url() ?>index.php/content/comment_active',
            dataType: "html",

            data: postData, // appears as $_GET['id'] @ your backend side
            success: function(data) {

                location.reload();

            }

        });
    });


</script>

<script>
    $('.cmt_inactive').click(function(){

        var id = $(this).attr("id");


        var postData = {
            'id' : id

        };

        $.ajax({
            type: "POST",
            url: '<?php echo base_url() ?>index.php/content/comment_inactive',
            dataType: "html",

            data: postData, // appears as $_GET['id'] @ your backend side
            success: function(data) {

                location.reload();

            }

        });
    });


</script>

