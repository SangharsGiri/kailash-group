<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo $booking['package_name']."..."."(". $booking['package_duration'].")" ;?>
            </div>
            <div class="panel-body">
                <form method="post" name="package_frm" id="package_frm" action="">
                <div class="book_con">
                    <p>
                        <label>Package Type:</label><b><?php echo $booking['package_type'];?></b>
                    </p>
                    <p>
                        <label>Accommodation:</label><b><?php echo (isset($booking['name'])?$booking['name']:"N/A");?></b>
                    </p>
                    <p>
                        <label>Package Amount:</label><b><?php echo $booking['amount']." ".  $booking['code'];?></b>
                    </p>
                    <p>
                        <label>Calculation Type</label><select  name="calculation_type" id="calculation_type">
                            <option value="+" <?php echo (isset($booking['calculation_type']) && $booking['calculation_type'] =="+")?"selected":"";?>>+</option>
                            <option value="-" <?php echo (isset($booking['calculation_type']) && $booking['calculation_type'] =="-")?"selected":"";?>>-</option>
                        </select>
                    </p>
                    <p>
                        <label>(Discount/Extra) Amount</label>
                        <input type="text" name="edited_amount" id="edited_amount" value="<?php echo $booking['edited_amount'];?>"><b style="padding-left: 5px;"><?php echo $booking['code'];?></b>
                    </p>
                    <p>
                        <label>Final Amount:</label><input type="text" name="total_amount" id="total_amount" value="<?php echo $booking['total_amount'];?>"><b style="padding-left: 5px;"><?php echo $booking['code'];?></b>
                    </p>
                    <p>
                        <label>Trip Type:</label><b><?php echo $booking['trip_type'];?></b>
                    </p>
                    <p>
                        <label>Arrival Date:</label><b><?php echo $booking['arrival_date'];?></b>
                    </p>

                    <p>
                        <label>Total Person:</label><b><?php echo $booking['no_of_person'];?></b>
                        <span style="padding-left: 10px;">Adult:<b><?php echo $booking['adult'];?></b></span><span style="padding-left: 10px;">Child:<b><?php echo $booking['child'];?></b></span><span style="padding-left: 10px;">Infant:<b><?php echo $booking['infant'];?></b></span>
                    </p>
                    <p>
                        <label>Extra Facility:</label><b><?php echo $booking['extra_facility'];?></b>
                    </p>
                    <p>
                        <label>First Name:</label><b><?php echo $booking['first_name'];?></b>
                    </p>
                    <p>
                        <label>Middle Name:</label><b><?php echo $booking['middle_name'];?></b>
                    </p>
                    <p>
                        <label>Last Name:</label><b><?php echo $booking['last_name'];?></b>
                    </p>
                    <p>
                        <label>Email:</label><b><?php echo $booking['email'];?></b>
                    </p>
                    <p>
                        <label>Contact No:</label><b><?php echo $booking['contact_no'];?></b>
                    </p>
                    <p>
                        <label>Passport No:</label><b><?php echo $booking['passport_no'];?></b>
                    </p>
                    <p>
                        <label>Country:</label><b><?php echo $booking['country'];?></b>
                    </p>
                    <p>
                        <label>City:</label><b><?php echo $booking['city'];?></b>
                    </p>
                    <p>
                        <label>Additional Info:</label><b><?php echo $booking['additional_info'];?></b>
                    </p>
                    <p>
                        <label>Referred BY:</label><b><?php echo $booking['referedby'];?></b>
                    </p>
                    <p>
                        <label>&nbsp;</label>
                        <input type="hidden" name="package_amount" value="<?php echo $booking['amount'];?>" id="package_amount">
                        <input value="<?php echo $booking['booking_id'];?>" name="booking_id" type="hidden">
                        <input value="<?php echo $booking['customer_id'];?>" name="customer_id" type="hidden">
                        <button type="submit" class="btn btn-danger" id="booking_edit">Submit</button>
                    </p>
                </div>
                    </form>
            </div>

        </div>
    </div>
    <!-- /. ROW  -->
    <hr>
</div>

<script>
    $('#booking_edit').click(function(e){
      var cal_type = $('#calculation_type').val();
      var pkg_amt = parseFloat($('#package_amount').val());
      var total_amt = parseFloat($('#total_amount').val());
      var edited_amt = parseFloat($('#edited_amount').val());

        if(cal_type == "+")
        {
            var cal_total = (pkg_amt + edited_amt);
        }
        else
        {
            var cal_total = (pkg_amt - edited_amt);
        }

        if(total_amt == cal_total)
        {
            e.submit();
        }
        else
        {
           alert('Amount Calculation Error.')
            e.preventDefault();
        }



    })
</script>