<div class="signup-page">
    <div class="container">
        <div class="row">
            <!-- user-login -->
            <div class="col-sm-6 col-sm-offset-3">
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
                <?php
                if ($this->session->flashdata('error') != "") {
                    ?>
                    <div class="alert alert-danger alert_box">
                        <a href="#" class="close alert_message" data-dismiss="alert" aria-label="close"><i
                                    class="fa fa-times"></i></a>
                        <strong>Success !</strong> <?php echo $this->session->flashdata('error'); ?>.
                    </div>
                    <?php
                }
                ?>
                <div class="ragister-account account-login">

                    <div class="devider text-center">User Login</div>
                    <form id="registation-form" name="registation-form" action="<?php echo site_url('index.php/login/index');?>" method="post">

                        <div class="form-group">

                            <input type="email" name="email" data-validation="required email"  placeholder="Email" class="form-control" value="<?php echo set_value('email');?>" required="required">
                        </div>
                        <div class="form-group">

                            <input type="password" name="password" data-validation="required confirmation length"  data-validation-length="max50"  class="form-control"  placeholder="Password" value="<?php echo set_value('password');?>">
                        </div>

                        <div class="form-group">

                            <input type="password" name="pass_confirmation" data-validation="required length"  data-validation-length="max50" class="form-control" placeholder="Retype Password" value="<?php echo set_value('pass_confirmation');?>">
                        </div>
                        <!-- checkbox -->
                        <div class="checkbox">
                            <label class="pull-left"><input type="checkbox" name="signing" id="signing"> Keep Me Login </label>
                            <a class="pull-right" data-toggle="modal" data-target="#myModalforget">Forgot Password?</a>

                        </div><!-- checkbox -->
                        <div class="submit-button text-center">
                            <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="btn btn-primary" value="Account Login">

                        </div>
                    </form>
                    <div class="new-user text-center">
                        <p>Don't have an account ? <a href="<?php echo base_url(); ?>index.php/login/register">Register Now</a> </p>
                    </div>
                    <!-- Modal to rest password -->
                    <form method="post" id="password-reset" action="<?php echo site_url('login/password_rest');?>" role="form">
                        <div class="modal fade" id="myModalforget" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Forgot Password</h4>
                                        <p>Enter email address associated with us.</p>
                                    </div>
                                    <div class="modal-body">

                                        <label for="recipient-name" class="control-label">Email:</label>
                                        <div class="form-group">
                                            <input type="text" name="user_email" class="form-control" data-validation="required email">

                                        </div>


                                    </div>
                                    <div class="modal-footer">

                                        <button type="submit"  class="form-control btn-primary btn btn-login">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- user-login -->
        </div><!-- row -->
    </div><!-- container -->
</div><!-- signup-page -->



<script>
    $.validate();
</script>
