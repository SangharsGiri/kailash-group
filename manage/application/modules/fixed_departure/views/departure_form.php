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
                    <div class="tab-content">

                        <div class="tab-pane fade active in" id="home">

                            <table class="form-table">
                                <tbody>


                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Price <span class="asterisk">*</span>
                                        </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <?php
                                        $departure_id =  (isset($detail['departure_id']) && $detail['departure_id'] !="") ? $detail['departure_id']:"0";
                                        $currencies =  $this->crud->get_all('igc_currency_setting');
                                        if(! empty($currencies)) {

                                            foreach ($currencies as $currency) {
                                                
                                                $price_detail =  $this->departure->get_departure_price_detail($departure_id, $currency['currency_id']);
                                                $checked =  (isset($price_detail['show_front']) && $price_detail['show_front'] == "Y")?"checked":"";

                                                ?>
                                                <input type="text" name="price[<?php echo $currency['currency_id'];?>]" data-validation="required" size="5" placeholder="<?php echo $currency['code'];?>"
                                                       value="<?php echo (isset($price_detail['price']) && $price_detail['price'] !="")? $price_detail['price']:"";?>" autocomplete="off"
                                                       class="regular-text required valid"
                                                       kl_virtual_keyboard_secure_input="on">
                                                <input type="radio" name="show_front[<?php echo $currency['currency_id'];?>]" <?php echo $checked;?> value="Y"

                                                       autocomplete="off" class="regular-text required valid"
                                                       kl_virtual_keyboard_secure_input="on">
                                                <input type="hidden" name="currency_id[]" value="<?php echo $currency['currency_id'];?>">
                                                <?php
                                            }
                                        }
                                        ?>
                                           
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Available Number <span class="asterisk">*</span>
                                        </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <input type="text" name="available_no" size="50" data-validation="number required" value="<?php echo (isset($detail['available_no']) && $detail['available_no'] !="") ? $detail['available_no']:""; ?>"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">

                                    </td>
                                </tr>



                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Departure Date <span class="asterisk">*</span>
                                        </label></th>
                                    <td>
                                        <?php

                                        $date = (isset($detail['departure_date']) && $detail['departure_date'] !="") ? str_ireplace("-","/",date("m-d-Y", strtotime($detail['departure_date']))):"";


                                            ;?>
                                        <input type="text" name="departure_date" class="regular-text required valid" id="departure_date" size="50" value="<?php echo  $date;?>" data-validation="date" data-validation-format="mm/dd/yyyy">
                                    </td>
                                </tr>

                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Accommodation <span class="asterisk">*</span>
                                        </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%; padding-top: 10px;">

                                         <?php
                                         if(!empty($accommodations)) {
                                         foreach ($accommodations as $row)
                                         {
                                             $selected =  (isset($detail['accommodation_id']) && $detail['accommodation_id'] == $row['accommodation_id'])? "checked":"";
                                         ?>
                                         <input type="radio" name="accommodation_id" value="<?php echo $row['accommodation_id'];?>" <?php echo $selected;?>  data-validation="required"> <?php echo $row['name'];?>
                                             <?php
                                                 }
                                         }
                                         ?>

                                    </td>
                                </tr>

                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Status <span class="asterisk">*</span>
                                        </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%; padding-top: 10px;">
                                        <input type="radio" name="publish_status" <?php echo (isset($detail['publish_status']) && $detail['publish_status'] == "1") ?"checked":""; ?> value="1"  data-validation="required" autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">Active
                                        <input type="radio" name="publish_status" <?php echo (isset($detail['publish_status']) && $detail['publish_status'] == "0") ?"checked":""; ?> value="0"  data-validation="required" autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">Inactive
                                    </td>
                                </tr>


                                </tbody>
                            </table>


                        </div>



                        <p class="submit">
                            <input type="hidden" name="package_id" value="<?php echo $package_id; ?>">
                            <input type="hidden" name="departure_id" value="<?php echo (isset($detail['departure_id']) && $detail['departure_id'] !="") ? $detail['departure_id']:""; ?>">
                            <input type="submit" name="Setting Btn" id="btn_news" class="button" value="Save">
                        </p>



                    </div>
                </form>
            </div>
        </div>


    </div>
</div>
<script>
    $.validate();
</script>
<script>
    var dateToday = new Date();
    $(function() {
        $( "#departure_date" ).datepicker({
            numberOfMonths: 1,
            showButtonPanel: true,
            minDate: dateToday
        });
    });
</script>
