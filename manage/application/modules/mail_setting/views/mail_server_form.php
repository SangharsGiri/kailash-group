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
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#home" data-toggle="tab">General</a>
                    </li>
                </ul>
                <form class="tab_form" method="post" action="" enctype="multipart/form-data">
                    <div class="tab-content">

                        <div class="tab-pane fade active in" id="home">

                            <table class="form-table">
                                <tbody>
                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label for="admin_name">Server Prefix <span class="asterisk">*</span>
                                        </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;"><input type="text" name="server_prefix"  size="50" data-validation="required" value="<?php echo (isset($setting['server_prefix']) && $setting['server_prefix'] !="") ? $setting['server_prefix']:""; ?>"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on"></td>
                                </tr>

                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label for="slogan">Host<span class="asterisk">*</span> </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;"><input type="text" name="host" data-validation="required" class="regular-text"   size="50" value="<?php echo (isset($setting['host']) && $setting['host'] !="") ? $setting['host']:""; ?>" autocomplete="off" kl_virtual_keyboard_secure_input="on"></td>
                                </tr>


                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Port<span class="asterisk">*</span> </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;"><input type="text" name="port" id="port" data-validation="required" value="<?php echo (isset($setting['port']) && $setting['port'] !="") ? $setting['port']:""; ?>"  size="50" autocomplete="off" class="regular-text required" kl_virtual_keyboard_secure_input="on"></td>
                                </tr>


                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Username </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <input type="text" name="username" size="50" data-validation="required" value="<?php echo (isset($setting['username']) && $setting['username'] !="") ? $setting['username']:""; ?>" autocomplete="off" kl_virtual_keyboard_secure_input="on">
                                        <small> ( Example- amritsparsha1@gmail.com ) </small>
                                    </td>
                                </tr>

                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Password </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <input type="password" name="password" size="50" data-validation="required" value="<?php echo (isset($setting['password']) && $setting['password'] !="") ? $setting['password']:""; ?>" autocomplete="off" kl_virtual_keyboard_secure_input="on">

                                    </td>
                                </tr>

                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Send From Name </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <input type="text" name="send_from_name"  size="50" data-validation="required" value="<?php echo (isset($setting['send_from_name']) && $setting['send_from_name'] !="") ? $setting['send_from_name']:""; ?>" autocomplete="off" kl_virtual_keyboard_secure_input="on">
                                        <small> ( Example- Rupakot Holidays ) </small>
                                    </td>
                                </tr>

                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Send From Email </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <input type="email" name="send_from_email"  size="50" data-validation="required" value="<?php echo (isset($setting['send_from_email']) && $setting['send_from_email'] !="") ? $setting['send_from_email']:""; ?>" autocomplete="off" kl_virtual_keyboard_secure_input="on">
                                        <small> ( Example- amritsparsha1@gmail.com  ) </small>
                                    </td>
                                </tr>

                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Reply To Name </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <input type="text" name="reply_to_name"  size="50" data-validation="required" value="<?php echo (isset($setting['reply_to_name']) && $setting['reply_to_name'] !="") ? $setting['reply_to_name']:""; ?>" autocomplete="off" kl_virtual_keyboard_secure_input="on">
                                        <small> ( Example- Rupakot Holidays ) </small>
                                    </td>
                                </tr>

                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Reply To Email </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <input type="email" name="reply_to_email" size="50" data-validation="required" value="<?php echo (isset($setting['reply_to_email']) && $setting['reply_to_email'] !="") ? $setting['reply_to_email']:""; ?>" autocomplete="off" kl_virtual_keyboard_secure_input="on">
                                        <small> ( Example- amritsparsha1@gmail.com  ) </small>
                                    </td>
                                </tr>

                                <tr valign="top" class="contact_detail">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row">
                                        <label>SMTP Connect</label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <input type="radio" name="smtp_connect" <?php echo (isset($setting['smtp_connect']) && $setting['smtp_connect'] =="true")?"checked":"";?> class="regular-text" data-validation="required" value="true">True
                                        <input type="radio" name="smtp_connect" <?php echo (isset($setting['smtp_connect']) && $setting['smtp_connect'] =="false")?"checked":"";?> class="regular-text" data-validation="required" value="false">False
                                    </td>
                                </tr>

                                <tr valign="top" class="contact_detail">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row">
                                        <label>Status</label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <input type="radio" name="active_status" <?php echo (isset($setting['active_status']) && $setting['active_status'] =="1")?"checked":"";?> class="regular-text" data-validation="required" value="1">Active
                                        <input type="radio" name="active_status" <?php echo (isset($setting['active_status']) && $setting['active_status'] =="0")?"checked":"";?> class="regular-text" data-validation="required" value="0">Inactive
                                    </td>
                                </tr>


                                </tbody>
                            </table>


                        </div>



                        <p class="submit">
                            <input type="hidden" name="id" value="<?php echo (isset($setting['id']) && $setting['id'] !="") ? $setting['id']:""; ?>">
                            <input type="submit" name="Setting Btn" class="button mail_server" value="Save Settings">
                        </p>



                    </div>
                </form>
            </div>
        </div>


    </div>
</div>

<script type="text/javascript">

jQuery('#port').keyup(function () {
    this.value = this.value.replace(/[^0-9\.]/g,'');
});
</script>
<script>
    $.validate();
</script>