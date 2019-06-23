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
                <i class="fa fa-plus-square-o"></i><a href="<?php echo site_url('tour/form');?>"> Add New Tour</a>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>S.N</th>
                            <th>Page Title</th>
                            <th>Tour Title</th>
                            <th>Type</th>
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
                                <td><?php echo $row['tour_page_title'];?></td>
                                <td><?php echo $row['tour_title'];?></td>
                                <td><?php echo $row['tour_type'];?></td>
                                <td><?php
                                    echo(isset($row['publish_status']) and $row['publish_status'] == "1") ? "Active" : "Inactive";
                                    ?></td>

                                <td class="center">
                                    <div class="btn-group">
                                        <a href="<?php echo site_url('tour/form/'. $row['tour_id']);?>" class="btn btn-success" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                        <a href="<?php echo site_url('tour/comment/'. $row['tour_id']);?>" class="btn btn-primary" title="Comments"><i class="fa fa-commenting-o"></i></a>
                                        <a class="btn btn-info" data-target="#myModal_news<?php echo $row['tour_id'];?>" data-toggle="modal"  title="Send"><i class="fa fa-newspaper-o"></i></a>
                                        <a class="btn btn-danger" data-target="#myModal_delete<?php echo $row['tour_id'];?>" data-toggle="modal" title="Delete"><i class="fa fa-trash-o"></i></a>
                                    </div>
                                    <!-- Modal for news -->
                                    <div id="myModal_news<?php echo $row['tour_id'];?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">NewsLetter Confirmation</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure to send this Information</p>
                                                </div>

                                                <div class="modal-footer">
                                                    <input type="hidden" class="hidden_link_news" value="<?php echo site_url('tour/send/'. $row['tour_id']); ?>">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                    <button type="button" class="btn btn-default news_send">Ok</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!--modal-->
                                    <!-- Modal for  delete -->
                                    <div id="myModal_delete<?php echo $row['tour_id'];?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Tour Delete Confirmation</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure to delete this Information</p>
                                                </div>

                                                <div class="modal-footer">
                                                    <input type="hidden" class="hidden_link_delete" value="<?php echo site_url('tour/delete/'. $row['tour_id']); ?>">
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
    $.validate();
</script>
<script>
    $('.delete').click(function(){

        var values = $(this).parent() .find('.hidden_link_delete').val();
        window.location =  values;
    });

</script>

<script>
    $('.news_send').click(function(){

        var values = $(this).parent() .find('.hidden_link_news').val();
        window.location =  values;
    });

</script>