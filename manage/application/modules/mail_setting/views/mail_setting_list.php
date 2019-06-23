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
                    <li class="active"><a href="#home" data-toggle="tab">Mail Server</a>
                    </li>

                    <li class=""><a href="#settings" data-toggle="tab">Admin Emails</a>
                    </li>


                </ul>

                    <div class="tab-content">

                        <div class="tab-pane fade active in" id="home">
                            <div class="panel panel-default">
                                <div class="panel-heading">

                                    <a class="btn btn-info" data-rel="tooltip" href="<?php echo site_url('mail_setting/server_form');?>" title="Add New Server"><i class="fa fa-plus-square-o"></i> Add New Server</a>
                                </div>
                                <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Server Prefix</th>
                                        <th>Host</th>
                                        <th>Port</th>
                                        <th>Username</th>
                                        <th>Status</th>
                                        <th>Created</th>
                                        <th>Control</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 1;
                                    foreach($server_setting as $row)
                                    {
                                    ?>
                                    <tr>
                                        <td><?php echo $i++;?></td>
                                        <td><?php echo $row['server_prefix'];?></td>
                                        <td><?php echo $row['host'];?></td>
                                        <td><?php echo $row['port'];?></td>
                                        <td><?php echo $row['username'];?></td>
                                        <td><?php echo $row['created'];?></td>
                                        <td><?php echo (isset($row['active_status']) && $row['active_status'] =="1")?"Active":"Inactive";?></td>
                                        <td>
                                            <div class="btn-group">
                                            <a href="<?php echo site_url('mail_setting/server_form/'. $row['id']);?>" class="btn btn-success" title="Edit"><i class="fa fa-pencil-square-o"></i></a>

                                                <a class="btn btn-danger" data-target="#myModal_delete<?php echo $row['id'];?>" data-toggle="modal" title="Delete"><i class="fa fa-trash-o" ></i></a>
                                                </div>

                                            <!-- Modal for booking delete -->
                                            <div id="myModal_delete<?php echo $row['id'];?>" class="modal fade" role="dialog">
                                                <div class="modal-dialog">

                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">Mail Server Information Delete Confirmation</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure to delete this Information</p>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <input type="hidden" class="hidden_link_delete" value="<?php echo site_url('mail_setting/delete_mail_server/'. $row['id']); ?>">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                            <button type="button" class="btn btn-default delete">Ok</button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <!--modal-->
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>

                                    </tbody>
                                </table>
                            </div>
                          </div>
                                </div>

                        </div>

                        <div class="tab-pane fade" id="settings">
                            <div class="panel panel-default">
                                <div class="panel-heading">

                                    <a class="btn btn-info" data-rel="tooltip" href="<?php echo site_url('mail_setting/admin_email_form');?>" title="Add New Email"><i class="fa fa-plus-square-o"></i> Add New Email</a>
                                </div>
                                <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Full Name</th>
                                        <th>Email Address</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th>Control</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $j = 1;
                                    foreach($admin_mail as $rows)
                                    {
                                    ?>
                                    <tr>
                                        <td><?php echo $j++;?></td>
                                        <td><?php echo $rows['full_name'];?></td>
                                        <td><?php echo $rows['email'];?></td>
                                        <td><?php echo (isset($rows['active_status']) && $rows['active_status'] == "1")?"Active":"Inactive";?></td>
                                        <td><?php echo $rows['created'];?></td>
                                        <td>
                                            <div class="btn-group">
                                            <a href="<?php echo site_url('mail_setting/admin_email_form/'. $rows['admin_id']);?>" class="btn btn-success" title="Edit"><i class="fa fa-pencil-square-o"></i></a>

                                                <a class="btn btn-danger" data-target="#myModals_delete<?php echo $rows['admin_id'];?>" data-toggle="modal" title="Delete"><i class="fa fa-trash-o" ></i></a>
                                                </div>

                                            <!-- Modal for admin mail delete -->
                                            <div id="myModals_delete<?php echo $rows['admin_id'];?>" class="modal fade" role="dialog">
                                                <div class="modal-dialog">

                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">Admin Mailing Information Delete Confirmation</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure to delete this Information</p>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <input type="hidden" class="hidden_link" value="<?php echo site_url('mail_setting/delete_admin_mail/'. $rows['admin_id']);?>">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                            <button type="button" class="btn btn-default mail_delete">Ok</button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <!--modal-->
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                           </div>
                                </div>
                        </div>




                    </div>

            </div>
        </div>


    </div>
</div>
<script>
    $('.delete').click(function(){

        var values = $(this).parent() .find('.hidden_link_delete').val();
        window.location =  values;
    });

    $('.mail_delete').click(function(){

        var values = $(this).parent() .find('.hidden_link').val();
        window.location =  values;
    });

</script>