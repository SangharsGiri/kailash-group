
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
                                    <th style="background: transparent none repeat scroll 0% 0%; width: 100px;" scope="row"><label>API Username<span class="asterisk">*</span>
                                        </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <input type="text" name="api_username" value="<?php echo $paypal['api_username']; ?>" data-validation="required" class="regular-text" style=" width:336px;">      
                                    </td>
                                </tr>

                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%; width: 100px;" scope="row"><label>API Password<span class="asterisk">*</span>
                                        </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <input type="text" name="api_password" value="<?php echo $paypal['api_password']; ?>" data-validation="required" class="regular-text" style=" width:336px;">
                                    </td>   
                                </tr>
                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%; width: 100px;" scope="row"><label>Currency code<span class="asterisk">*</span>
                                        </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <input type="text" name="currency_code" value="<?php echo $paypal['currency_code']; ?>" data-validation="required" class="regular-text" style=" width:336px;">
                                    </td>   
                                </tr>

                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%; width: 100px;" scope="row"><label>API Signature<span class="asterisk">*</span>
                                        </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <input type="text" name="api_signature" value="<?php echo $paypal['api_signature']; ?>" data-validation="required" class="regular-text" style=" width:336px;">
                                    </td>   
                                </tr>
                               
                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%; width: 100px;" scope="row"><label>Paypal Mode(live/sandbox)<span class="asterisk">*</span>
                                        </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <select name ="paypal_mode" style="margin: 7%; width: 93%; height: 53%;">
                                            <option <?php echo (isset($paypal['paypal_mode']) && $paypal['paypal_mode'] =="live")?"selected":"";?> value="live">live</option>
                                            <option <?php echo (isset($paypal['paypal_mode']) && $paypal['paypal_mode'] =="sandbox")?"selected":"";?> value="sandbox">sandbox</option>
                                        </select>
                                        <!-- <input type="text" name="paypal_mode" data-validation="required" data-validation="text" data-validation-allowing="live,sandbox" data-validation-error-msg="You can only enter live or sandbox" class="regular-text"> -->
                                    </td>   
                                </tr>
                                
                            <tr valign="top" id="active-tr">
                                <th scope="row"><label>Is Active? </label></th>                        
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <input type="radio" name="publish_status" class="regular-text" data-validation="required" <?php echo (isset($paypal['publish_status']) && $paypal['publish_status'] =="1")?"checked":"";?> value="1">Yes
                                        <input type="radio" name="publish_status" class="regular-text" data-validation="required" <?php echo (isset($paypal['publish_status']) && $paypal['publish_status'] =="0")?"checked":"";?> value="0">No
                                    </td>
                            </tr>
                           
                                
                </tbody>
            </table>
                        </div>
                        <p class="submit"> 
                            <input type="submit" name="submit" id="submit" class="button" value="Save">
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

</body>
</html>




