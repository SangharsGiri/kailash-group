
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <strong>User Logs</strong>
           <a class="btn btn-primary" style="float: right;margin: -7px 0px 0px 0px;" data-target="#myModal_form" data-toggle="modal" title="Search">Search Log</a>
                <div id="myModal_form" class="modal fade" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="exampleModalLabel">Get User Logs</h4>
                            </div>
                            <form method="post" action="<?php echo site_url('log/index');?>">
                                <div class="modal-body">

                                    <div class="row-modal">


                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Start Date:</label>
                                                <input type="text" name="from_date" class="form-control" id="from_date" required="required" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">End Date:</label>
                                                <input type="text"  name="to_date" class="form-control" id="to_date" required="required" value="">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary" id="trip_quote">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel-body">

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                        <tr>
                                            <th>S.N</th>
                                            <th>User</th>
                                            <th>Module Name</th>
                                            <th>Action</th>
                                            <th>Date&Time</th>
                                            <th>IP Address</th>
                                            <th>Control</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i = 1;
                                        foreach($records as $row)
                                        {
                                            ?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php
                                                    $user_id = $row['user_id'];
                                                    $user_detail = $this->crud->get_detail($user_id, 'user_id', 'igc_users');
                                                    echo $user_detail['username'];?></td>
                                                <td><?php echo $row['module_name'];?></td>

                                                <td><?php
                                                    switch ($row['action_id']) {
                                                        case "1":
                                                            echo "Add";
                                                            break;
                                                        case "2":
                                                            echo "Update";
                                                            break;
                                                        case "3":
                                                            echo "Delete";
                                                            break;
                                                        default:
                                                            echo "None";
                                                    }?></td>
                                                <td><?php echo $row['date'];?></td>
                                                <td><?php echo $row['ip_address'];?></td>
                                                <td>
                                                    <div class="btn-group">

                                                        <a class="btn btn-info" data-target="#myModal_info<?php echo $row['log_id'];?>" data-toggle="modal" title="Info"><i class="fa fa-info-circle"></i></a>
                                                    </div>

                                                    <!-- Modal for detail -->
                                                    <div id="myModal_info<?php echo $row['log_id'];?>" class="modal fade" role="dialog">
                                                        <div class="modal-dialog">

                                                            <!-- Modal content-->
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title">Module Title</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p><?php echo $row['module_title'];?></p>
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


<script>
    $(function() {
        $( "#from_date" ).datepicker();
    });
    $(function() {
        $( "#to_date" ).datepicker();
    });
</script>
