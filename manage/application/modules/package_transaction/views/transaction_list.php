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

    <strong>Package Transaction List</strong>
</div>
<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
<thead>
<tr>
    <th>S.N</th>
    <th>Email</th>
  <!--   <th>Transaction Id</th> -->
    <th>Amount</th>
    <th>Transaction Date Time</th>
    <th>Book From</th>
    <th>Payment Status</th>
    <th>Control</th>
</tr>
</thead>
<tbody>
<?php
$i = 1;
foreach($transaction as $row)
{
    $id = $row['booking_id'];
    ?>

    <tr class="odd gradeX">
    <td><?php echo $i++;?></td>
    <td><?php echo $row['email'];?></td>
   <!--  <td><?php echo $row['transaction_id'];?></td> -->
    <td><?php echo $row['trans_amount']." ". $row['code'];?></td>
    <td><?php echo $row['transactionDateTime'];?></td>
    <td><?php echo $row['book_from'];?></td>
    <td><?php echo $row['payment_status'];?></td>
    <td class="center">
        <div class="btn-group">
            <a class="btn btn-info" data-target="#modalNew<?php echo $row['id'];?>" data-toggle="modal" title="Detail"><i class="fa fa-info-circle" ></i></a>
           <!--  <a class="btn btn-warning" data-target="#myModal_cancel<?php echo $row['id'];?>" data-toggle="modal" title="Cancel"><i class="fa fa-ban"></i></a> -->

        </div>
    </td>


    <!-- modal show detail data-->
    <div class="modal fade" id="modalNew<?php echo $row['id'];?>">
    <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title text-center">Transaction Details</h4>
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
                    <?php echo $row['first_name'] . " ". $row['middle_name'] . $row['last_name']?>
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
                    <label>Phone No. :</label>
                </div>
                <div class="col-md-8">
                    <?php echo $row['contact_no'];?>
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
                    <label> Passport No. :</label>
                </div>
                <div class="col-md-8">
                    <?php echo $row['passport_no'];?>
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
                    <?php echo $row['package_name'];?>
                </div>
            </div>
            <hr class="modal-hr">
            <div class="row">
                <div class="col-md-4">
                    <label>Package Duration :</label>
                </div>
                <div class="col-md-8">
                    <?php echo $row['package_duration'];?>
                </div>
            </div>
            <hr class="modal-hr">
            <div class="row">
                <div class="col-md-4">
                    <label>Accommodation :</label>
                </div>
                <div class="col-md-8">
                    <?php echo $row['name'];?>
                </div>
            </div>
            <hr class="modal-hr">
            <div class="row">
                <div class="col-md-4">
                    <label>Arrival Date :</label>
                </div>
                <div class="col-md-8">
                    <?php echo $row['arrival_date'];?>
                </div>
            </div>
            <hr class="modal-hr">

            <!-- <div class="row">
                <div class="col-md-4">
                    <label>Return Date  :</label>
                </div>
                <div class="col-md-8">
                    <?php echo $row['depart_date'];?>
                </div>
            </div> -->
            <hr class="modal-hr">
            <div class="row">
                <div class="col-md-4">
                    <label>Passenger :</label>
                </div>
                <div class="col-md-8">
                    <?php echo $row['no_of_person'];?>
                </div>
            </div>
            <hr class="modal-hr">
            <div class="row">
                <div class="col-md-4">
                    <label>Children :</label>
                </div>
                <div class="col-md-8">
                    <?php echo $row['child'];?>
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
                    <label>Infant :</label>
                </div>
                <div class="col-md-8">
                    <?php echo $row['infant'];?>
                </div>
            </div>
            <hr class="modal-hr">
            <div class="row">
                <div class="col-md-4">
                    <label> Referred By :</label>
                </div>
                <div class="col-md-8">
                    <?php echo $row['referedby'];?>
                </div>
            </div>
            <hr class="modal-hr">
            <div class="row">
                <div class="col-md-4">
                    <label>Booking Date :</label>
                </div>
                <div class="col-md-8">
                    <?php echo $row['created'];?>
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
                    <?php echo $row['amount']." ". $row['code'];?>
                </div>
            </div>
            <hr class="modal-hr">
            <div class="row">
                <div class="col-md-4">
                    <label>Total Amount :</label>
                </div>
                <div class="col-md-8">
                    <?php echo $row['total_amount']." ". $row['code'];?>
                </div>
            </div>
            <hr class="modal-hr">





        </div>
        <p class="modal_note">
            <label>Extra Facility  :</label>   <?php echo $row['extra_facility'];?>
        </p>
        <p class="modal_note">
            <label>Additional Info  :</label>   <?php echo $row['additional_info'];?>
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

    <!-- Modal for booking delete -->
    <div id="myModal_cancel<?php echo $row['id'];?>" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Transaction Cancellation Request</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure to cancel this Transaction</p>
                </div>

                <div class="modal-footer">
                    <input type="hidden" class="hidden_link_delete" value="<?php echo site_url('package_transaction/cancel/'. $row['id']); ?>">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-default delete">Ok</button>
                </div>
            </div>

        </div>
    </div>
    <!--modal-->



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
