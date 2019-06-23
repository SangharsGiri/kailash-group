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
                <a class="btn btn-info" data-rel="tooltip" href="<?php echo site_url('features_setting/form');?>" title="Add News"><i class="fa fa-plus-square-o"></i> Add Features</a>
            </div>

            <div class="panel-body">

                                <div class="table-responsive">
                                <form id="form" name="form" method="POST" action="">  
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                        <tr>
                                            <th>S.N</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Show In Room</th>
                                            <th>Control </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i = 1;
                                        foreach($features_name as $row)
                                        {
                                                            
                                            ?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $row['features_name']; ?></td>
                                                <td>
                                                    <?php
                                                    echo(isset($row['status']) and $row['status'] == "1") ? "Active" : "Inactive";
                                                    ?>
                                                </td>
                                                <?php $checked = (isset($row['isroom']) && $row['isroom']=="Y")?"checked":"";?>
                                <td><input type="checkbox" id= "isroom" name= "isroom[]" <?php echo $checked;?> value = "<?php echo $row['id']?>" /></td> 

                                                <td>
                                                    <div class="btn-group">
                                                        <a href="<?php echo site_url('features_setting/edit/'. $row['id']);?>" class="btn btn-success" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                                        <a class="btn btn-danger" data-target="#myModal_delete<?php echo $row['id'];?>" data-toggle="modal" title="Delete"><i class="fa fa-trash-o" ></i></a>
                                                    </div>



                                                    <!-- Modal for booking delete -->
                                                    <div id="myModal_delete<?php echo $row['id'];?>" class="modal fade" role="dialog">
                                                        <div class="modal-dialog">

                                                            <!-- Modal content-->
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    <h4 class="modal-title">News Delete Confirmation</h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Are you sure to delete this Information</p>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <input type="hidden" class="hidden_link_delete" value="<?php echo site_url('features_setting/delete/'. $row['id']); ?>">
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
                                     
                    <input type="submit" name="submit" value="Update" class="btn btn-info" data-rel="tooltip">
                </form>
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

</script>

