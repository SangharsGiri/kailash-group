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

         <strong>Package Booking List</strong>
        </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>S.N</th>
                            <th>Reference No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Booking Date</th>
                            <th>Booking Status</th>
                            <th>Control</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i = 1;
                        foreach($booking as $row)
                        {
                            $id = $row['booking_id'];
                            ?>

                            <tr class="odd gradeX">
                                <td><?php echo $i++;?></td>
                                <td><?php echo $row['reference_no'];?></td>
                                <td><?php echo $row['first_name'];?></td>
                                <td><?php echo $row['email'];?></td>
                                <td><?php echo $row['created'];?></td>
                                <td><?php echo $row['booking_status'];?></td>
                                <td class="center">
                                    <div class="btn-group">
                                        <a class="btn btn-primary"  data-target="#myModal_accept<?php echo $row['booking_id'];?>" data-toggle="modal" title="Accept"><i class="fa fa-check-square-o"></i></a>
                                        <a href="<?php echo site_url('package_booking/edit/'. $row['booking_id']);?>" class="btn btn-success" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                        <a class="btn btn-info" data-target="#modalNew<?php echo $id;?>" data-toggle="modal" title="Detail"><i class="fa fa-info-circle"></i></a>
                                        <a class="btn btn-warning" data-target="#myModal_cancel<?php echo $row['booking_id'];?>" data-toggle="modal" title="Cancel"><i class="fa fa-ban"></i></a>
                                        <a class="btn btn-danger" data-target="#myModal_delete<?php echo $row['booking_id'];?>" data-toggle="modal" title="Delete"><i class="fa fa-trash-o" ></i></a>
                                    </div>
                                </td>
                                <!-- Modal for booking accept -->
                                <div id="myModal_accept<?php echo $row['booking_id'];?>" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Booking Accept Confirmation</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure to accept this Booking</p>
                                            </div>

                                            <div class="modal-footer">
                                                <input type="hidden" class="hidden_link_accept" value="<?php echo site_url('package_booking/accept/'. $row['booking_id']); ?>">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-default accept">Ok</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!--modal-->


                                <!-- Modal for booking cancel -->
                                <div id="myModal_cancel<?php echo $row['booking_id'];?>" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Booking Cancel Confirmation</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure to cancel this Booking</p>
                                            </div>

                                            <div class="modal-footer">
                                                <input type="hidden" class="hidden_link_cancel" value="<?php echo site_url('package_booking/cancel/'. $row['booking_id']); ?>">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-default cancel">Ok</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!--modal-->


                                <!-- Modal for booking delete -->
                                <div id="myModal_delete<?php echo $row['booking_id'];?>" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Booking Delete Confirmation</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure to delete this Booking</p>
                                            </div>

                                            <div class="modal-footer">
                                                <input type="hidden" class="hidden_link_delete" value="<?php echo site_url('package_booking/delete/'. $row['booking_id']); ?>">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                <button type="button" class="btn btn-default delete">Ok</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!--modal-->


                                <?php

                                $package_type = $this->crud->get_detail($id, 'booking_id','igc_package_booking');

                                if($package_type['package_type']=="Normal")
                                {
                                    $detail = $this->package->booking_package_detail($id);
                                }
                                else
                                {
                                    $detail = $this->package->booking_package_fixed_detail($id);
                                }



                                ?>

                                <!-- modal show detail data-->
                                <div class="modal fade" id="modalNew<?php echo $id;?>">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title text-center">Booking Details</h4>
                                </div>
                                <div class="modal-body">
                                    <label class="text-center modText">
                                        Customer Detail
                                    </label>
                                    <div class="box">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Full Name :</label>
                                            </div>
                                            <div class="col-md-8">
                                                <?php echo $detail['first_name'] . " ". $detail['middle_name'] . $detail['last_name']?>
                                            </div>
                                        </div>
                                        <hr class="modal-hr">

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Email :</label>
                                            </div>
                                            <div class="col-md-8">
                                                <?php echo $detail['email'];?>
                                            </div>
                                        </div>
                                        <hr class="modal-hr">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Phone No. :</label>
                                            </div>
                                            <div class="col-md-8">
                                                <?php echo $detail['contact_no'];?>
                                            </div>
                                        </div>
                                        <hr class="modal-hr">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Country :</label>
                                            </div>
                                            <div class="col-md-8">
                                                <?php echo $detail['country'];?>
                                            </div>
                                        </div>
                                        <hr class="modal-hr">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>City :</label>
                                            </div>
                                            <div class="col-md-8">
                                                <?php echo $detail['city'];?>
                                            </div>
                                        </div>
                                        <hr class="modal-hr">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label> Passport No. :</label>
                                            </div>
                                            <div class="col-md-8">
                                                <?php echo $detail['passport_no'];?>
                                            </div>
                                        </div>
                                        <hr class="modal-hr">

                                    </div>
                                    <label class="text-center modText">
                                        Package Detail
                                    </label>

                                    <div class="box">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Package Name :</label>
                                            </div>
                                            <div class="col-md-8">
                                                <?php echo $detail['package_name'];?>
                                            </div>
                                        </div>
                                        <hr class="modal-hr">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Package Type :</label>
                                            </div>
                                            <div class="col-md-8">
                                                <?php echo $detail['package_type'];?>
                                            </div>
                                        </div>
                                        <hr class="modal-hr">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Package Duration :</label>
                                            </div>
                                            <div class="col-md-8">
                                                <?php echo $detail['package_duration'];?>
                                            </div>
                                        </div>
                                        <hr class="modal-hr">
                                        <?php
                                        if(isset($detail['name'])) {
                                            ?>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label>Accommodation :</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <?php echo $detail['name']; ?>
                                                </div>
                                            </div>
                                            <hr class="modal-hr">
                                            <?php
                                        }
                                        ?>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Arrival Date :</label>
                                            </div>
                                            <div class="col-md-8">
                                                <?php echo $detail['arrival_date'];?>
                                            </div>
                                        </div>


                                        <hr class="modal-hr">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Passenger :</label>
                                            </div>
                                            <div class="col-md-8">
                                                <?php echo $detail['no_of_person'];?>
                                            </div>
                                        </div>
                                        <hr class="modal-hr">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Children :</label>
                                            </div>
                                            <div class="col-md-8">
                                                <?php echo $detail['child'];?>
                                            </div>
                                        </div>
                                        <hr class="modal-hr">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Adult :</label>
                                            </div>
                                            <div class="col-md-8">
                                                <?php echo $detail['adult'];?>
                                            </div>
                                        </div>
                                        <hr class="modal-hr">

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Infant :</label>
                                            </div>
                                            <div class="col-md-8">
                                                <?php echo $detail['infant'];?>
                                            </div>
                                        </div>
                                        <hr class="modal-hr">


                                        <div class="row">
                                            <div class="col-md-4">
                                                <label> Referred By :</label>
                                            </div>
                                            <div class="col-md-8">
                                                <?php echo $detail['referedby'];?>
                                            </div>
                                        </div>
                                        <hr class="modal-hr">

                                    </div>
                                    <label class="text-center modText">
                                        Payment Detail
                                    </label>
                                    <div class="box">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Package Amount :</label>
                                            </div>
                                            <div class="col-md-8">
                                                <?php echo $detail['amount']." ". $detail['code'];?>
                                            </div>
                                        </div>
                                        <hr class="modal-hr">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Total Amount :</label>
                                            </div>
                                            <div class="col-md-8">
                                                <?php echo $detail['total_amount']." ". $detail['code'];?>
                                            </div>
                                        </div>
                                        <hr class="modal-hr">





                                    </div>
                                    <p class="modal_note">
                                        <label>Extra Facility  :</label>   <?php echo $detail['extra_facility'];?>
                                    </p>
                                    <p class="modal_note">
                                        <label>Additional Info  :</label>   <?php echo $detail['additional_info'];?>
                                    </p>

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
    $('.accept').click(function(){

        var values = $(this).parent() .find('.hidden_link_accept').val();
        window.location =  values;
    });
    $('.cancel').click(function(){

        var values = $(this).parent() .find('.hidden_link_cancel').val();
        window.location =  values;
    });
    $('.delete').click(function(){

        var values = $(this).parent() .find('.hidden_link_delete').val();
        window.location =  values;
    });
</script>
