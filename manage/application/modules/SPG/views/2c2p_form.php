<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo $title;?></div>
            <div class="panel-body">

                <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-body pal">
                        <?php if(validation_errors()) {
                            ?>
                            <div class="alert alert-danger alert_box">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close"><i
                                        class="fa fa-times"></i></a>
                                <?php echo validation_errors() ?>
                            </div>
                            <?php
                        }
                        ?>

                        <div class="form-group">
                            <label for="inputName" class="col-md-3 control-label">
                                Version</label>
                            <div class="col-md-9">
                                <div class="input-icon right">

                                    <input type="text" name="version" id="inputCattitle" placeholder="" data-validation="required" class="form-control"  value="<?php echo (isset($detail['version']) && $detail['version'] !="") ? $detail['version']:set_value('version'); ?>"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputName" class="col-md-3 control-label">
                                Merchant Id</label>
                            <div class="col-md-9">
                                <div class="input-icon right">

                                    <input type="text" name="merchant_id" id="inputCattitle" placeholder="" data-validation="required" class="form-control"  value="<?php echo (isset($detail['merchant_id']) && $detail['merchant_id'] !="") ? $detail['merchant_id']:set_value('merchant_id'); ?>"></div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="inputName" class="col-md-3 control-label">
                                Payment Description</label>
                            <div class="col-md-9">
                                <div class=" mbn">
                                    <input type="text" name="payment_description" class="form-control" placeholder="" data-validation="required" autocomplete="off" value="<?php echo (isset($detail['payment_description']) && $detail['payment_description'] !="") ? $detail['payment_description']:set_value('payment_description'); ?>"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputName" class="col-md-3 control-label">
                                Pay Category Id</label>
                            <div class="col-md-9">
                                <div class=" mbn">
                                    <input type="text" name="pay_category_id" class="form-control" placeholder="Leave Blank"  autocomplete="off" value="<?php echo (isset($detail['pay_category_id']) && $detail['pay_category_id'] !="") ? $detail['pay_category_id']:set_value('pay_category_id'); ?>"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputName" class="col-md-3 control-label">
                                Promotion</label>
                            <div class="col-md-9">
                                <div class=" mbn">
                                    <input type="text" name="promotion" class="form-control" placeholder="Leave Blank"  autocomplete="off" value="<?php echo (isset($detail['promotion']) && $detail['promotion'] !="") ? $detail['promotion']:set_value('promotion'); ?>"></div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="inputName" class="col-md-3 control-label">
                                Client Url</label>
                            <div class="col-md-9">
                                <div class=" mbn">
                                    <input type="text" name="client_url" class="form-control" placeholder="" data-validation="required" autocomplete="off" value="<?php echo (isset($detail['client_url']) && $detail['client_url'] !="") ? $detail['client_url']:set_value('client_url'); ?>"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputName" class="col-md-3 control-label">
                                Merchant URL</label>
                            <div class="col-md-9">
                                <div class=" mbn">
                                    <input type="text" name="merchant_url" class="form-control" placeholder="" data-validation="required" autocomplete="off" value="<?php echo (isset($detail['merchant_url']) && $detail['merchant_url'] !="") ? $detail['merchant_url']:set_value('merchant_url'); ?>"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputName" class="col-md-3 control-label">
                                Secret Key</label>
                            <div class="col-md-9">
                                <div class=" mbn">
                                    <input type="text" name="secret_key" class="form-control" placeholder="" data-validation="required" autocomplete="off" value="<?php echo (isset($detail['secret_key']) && $detail['secret_key'] !="") ? $detail['secret_key']:set_value('secret_key'); ?>"></div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="inputName" class="col-md-3 control-label">
                                Request 3D</label>
                            <div class="col-md-9">

                                <select name="request_3ds" class="form-control">
                                    <option value="Y" <?php echo (isset($detail['request_3ds']) && $detail['request_3ds'] =="Y") ? "selected":"";?>>Yes</option>
                                    <option value="N" <?php echo (isset($detail['request_3ds']) && $detail['request_3ds'] =="N") ? "selected":"";?>>No</option>
                                    <option value="F" <?php echo (isset($detail['request_3ds']) && $detail['request_3ds'] =="F") ? "selected":"";?>>Force</option>
                                </select>



                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputName" class="col-md-3 control-label">
                                Environment</label>
                            <div class="col-md-9">

                                <select name="environment" class="form-control">
                                    <option value="Test" <?php echo (isset($detail['environment']) && $detail['environment'] =="Test") ? "selected":"";?>>Test</option>
                                    <option value="Live" <?php echo (isset($detail['environment']) && $detail['environment'] =="Live") ? "selected":"";?>>Live</option>
                                </select>



                            </div>
                        </div>





                        <div class="form-group">
                            <label for="inputName" class="col-md-3 control-label">
                                Status</label>
                            <div class="col-md-9">

                                <select name="publish_status" class="form-control">
                                    <option value="1" <?php echo (isset($detail['publish_status']) && $detail['publish_status'] =="1") ? "selected":"";?>>Enable</option>
                                    <option value="0" <?php echo (isset($detail['publish_status']) && $detail['publish_status'] =="0") ? "selected":"";?>>Disable</option>
                                </select>



                            </div>
                        </div>

                        
                        <div class="form-group mbn">
                            <div class="col-md-offset-3 col-md-6">
                                <input type="hidden" name="id" value="<?php echo (isset($detail['id']) && $detail['id'] !="") ? $detail['id']:""; ?>">
                                <button type="submit"  class="btn btn-success" id="btn_category">
                                    Continue</button>
                            </div>
                        </div>

                    </div>

                </form>
            </div>
        </div>

    </div>
</div>




<script>
    $.validate();
</script>
