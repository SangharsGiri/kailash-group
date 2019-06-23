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
                <strong>Trip Quote List</strong>
            </div>

            <div class="panel-body">

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                        <tr>
                                            <th>S.N</th>
                                            <th>Trip Type</th>
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th>Country</th>

                                            <th>Control</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i = 1;
                                        foreach($records as $row)
                                        {
                                            ?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $row['trip_type'];?></td>
                                                <td><?php echo $row['full_name'];?></td>
                                                <td><?php echo $row['email'];?></td>
                                                <td><?php echo $row['country'];?></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a class="btn btn-info" data-target="#myModal_info<?php echo $row['quote_id'];?>" data-toggle="modal" title="Info"><i class="fa fa-info-circle"></i></a>
                                                        <a class="btn btn-danger" data-target="#myModal_delete<?php echo $row['quote_id'];?>" data-toggle="modal" title="Delete"><i class="fa fa-trash-o" ></i></a>
                                                    </div>

                                                    <!-- modal show detail data-->
                                                    <div class="modal fade" id="myModal_info<?php echo $row['quote_id'];?>">
                                                    <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h4 class="modal-title text-center">Trip Quote Details</h4>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="box">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <label>Trip Type :</label>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <?php echo $row['trip_type'];?>
                                                                </div>
                                                            </div>
                                                            <hr class="modal-hr">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <label>Trip Start Date :</label>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <?php echo $row['start_date'];?>
                                                                </div>
                                                            </div>
                                                            <hr class="modal-hr">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <label>Trip End Date :</label>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <?php echo $row['end_date'];?>
                                                                </div>
                                                            </div>
                                                            <hr class="modal-hr">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <label>Full Name :</label>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <?php echo $row['full_name'];?>
                                                                </div>
                                                            </div>
                                                            <hr class="modal-hr">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <label>Email :</label>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <?php echo $row['email'];?>
                                                                </div>
                                                            </div>
                                                            <hr class="modal-hr">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <label>Country :</label>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <?php echo $row['country'];?>
                                                                </div>
                                                            </div>
                                                            <hr class="modal-hr">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <label>Adult :</label>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <?php echo $row['adult'];?>
                                                                </div>
                                                            </div>
                                                            <hr class="modal-hr">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <label>Child :</label>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <?php echo $row['child'];?>
                                                                </div>
                                                            </div>
                                                            <hr class="modal-hr">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <label>Infant :</label>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <?php echo $row['infant'];?>
                                                                </div>
                                                            </div>
<!--                                                            <hr class="modal-hr">-->
<!--                                                            <div class="row">-->
<!--                                                                <div class="col-md-4">-->
<!--                                                                    <label>Total Pax :</label>-->
<!--                                                                </div>-->
<!--                                                                <div class="col-md-8">-->
<!--                                                                    --><?php //echo $row['total_pax'];?>
<!--                                                                </div>-->
<!--                                                            </div>-->
                                                            <hr class="modal-hr">




                                                        </div>



                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                                    </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                    </div>
                                                    <!--end modal-->

                                                    <!-- Modal for booking delete -->
                                                    <div id="myModal_delete<?php echo $row['quote_id'];?>" class="modal fade" role="dialog">
                                                        <div class="modal-dialog">

                                                            <!-- Modal content-->
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title">Trip Quote Delete Confirmation</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Are you sure to delete this Information</p>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <input type="hidden" class="hidden_link_delete" value="<?php echo site_url('trip_quote/delete/'. $row['quote_id']); ?>">
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
<script>
    $('.delete').click(function(){

        var values = $(this).parent() .find('.hidden_link_delete').val();
        window.location =  values;
    });


</script>