<!-- signup-page -->
<div class="signup-page">
    <div class="container">
        <div class="row">
            <!-- user-login -->
            <div class="col-sm-12">
                <?php
                if(validation_errors())
                {
                    ?>
                    <div class="alert  alert-danger alert_box">
                        <a href="#" class="close alert_message" data-dismiss="alert" aria-label="close"><i
                                    class="fa fa-times"></i></a>
                        <?php echo validation_errors();?>
                    </div>

                    <?php
                }
                ?>

                <?php if (isset($error)) {


                    ?>
                    <div class="alert alert-danger alert_box">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close"><i
                                    class="fa fa-times"></i></a>
                        <strong>Error!</strong>  <?php echo isset($error)?$error:"" ; ?>.
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="col-sm-6 col-sm-offset-3">
                <div class="col-sm-12">
                    <h1 class="section-title title">Reset Your Password</h1>
                </div>

                <form id="login-form" action="" method="post" role="form" style="display: block;">
                    <div class="col-md-12">

                        <div class="form-group">
                            <label class="string optional">New Password</label>
                            <input type="password" name="password" data-validation="required length" id="password"  data-validation-length="max50" tabindex="2" class="form-control"  placeholder="Password" value="<?php echo set_value('password');?>">
                        </div>
                        <div class="form-group">
                            <label class="string optional">Retype Password</label>
                            <input type="password" name="confirm_password" data-validation="required length"  id="confirm-password" data-validation-length="max50" class="form-control" placeholder="Password" value="<?php echo set_value('confirm_password');?>">
                            <span id="retype_error"></span>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <input type="hidden" name="activation_code" value="<?php echo $activation_code;?>">
                                    <input type="submit" name="login-submit" id="reset-submit" tabindex="4" class="btn btn-primary pull-right" value="Reset">
                                </div>
                            </div>
                        </div>

                    </div>





                </form>
            </div><!-- user-login -->
        </div><!-- row -->
    </div><!-- container -->
</div><!-- signup-page -->
</div><!-- main-wrapper -->





<script>
   $.validate();
</script>
<script type="text/javascript">

    $('#confirm-password').bind("cut copy paste",function(e) {
        e.preventDefault();
    });

</script>
<script>
    $('#reset-submit').click(function (e){

        $('#retype_error').text('');
        var password= $('#password').val();
        var confirmpassword= $('#confirm-password').val();

        if(password == confirmpassword)
        {
            e.submit();
        }
        else {

            $('#retype_error').text("Password Confirmation Can't Match");
            $("#retype_error").css("color","red");
            e.preventDefault();
        }


    });

</script>