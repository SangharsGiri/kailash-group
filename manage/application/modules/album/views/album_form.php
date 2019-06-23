
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <?php echo (isset($title) && $title != "") ? $title : ""; ?>
            </div>

            <div class="panel-body">

                <form class="tab_form" method="post" action="" enctype="multipart/form-data">
                    <div class="tab-content">

                        <div class="tab-pane fade active in" id="home">

                            <table class="form-table">
                                <tbody>


                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>
                                            Album Name <span class="asterisk">*</span>
                                        </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <input type="text" name="name"
                                               size="50" data-validation="required custom" data-validation-regexp="^([\w\s -]+)$"
                                               value="<?php echo (isset($detail['name']) && $detail['name'] != "") ? $detail['name'] : ""; ?>"
                                               autocomplete="off" class="regular-text"
                                               kl_virtual_keyboard_secure_input="on"></td>
                                </tr>




                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Description

                                        </label></th>
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <textarea name="description" data-validation="custom" data-validation-optional="true"  data-validation-regexp="^([\w\s -]+)$"><?php echo (isset($detail['description']) && $detail['description'] != "") ? $detail['description'] : ""; ?></textarea>
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
                            <input type="hidden" name="album_id"
                                   value="<?php echo (isset($detail['album_id']) && $detail['album_id'] != "") ? $detail['album_id'] : ""; ?>">
                            <input type="submit" name="Setting Btn" class="button" value="Save">
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