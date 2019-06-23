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
<!-- Advanced Tables -->
<div class="panel panel-info">
<div class="panel-heading">

    <a class="btn btn-info" data-rel="tooltip" href="<?php echo site_url('atos_setting/form');?>" title="Add Package"><i class="fa fa-plus-square-o"></i> Add New Atos</a>
</div>
<div class="panel-body">
<div class="table-responsive">

<table class="table table-striped table-bordered table-hover" id="dataTables-example">
<thead>
<tr>
    <th>S.N</th>
    <th>URL</th>
    <th>Merchant_ID</th>
    <th>Type</th>
    <th>Status</th>
    <th>Action</th>
</tr>
</thead>
<tbody>
<?php
$i = 1;
foreach($atos as $row)
{  

?>

<tr class="odd gradeX">
    <td><?php echo $i++;?></td>
    <td><?php echo $row['request_url'];?></td>
    <td><?php echo $row['merchant_id'];?></td>

    <td><?php echo $row['setting_type']; ?></td>
    
    <td><?php
       echo(isset($row['active_status']) and $row['active_status'] == "1") ? "Active" : "Inactive";
        ?></td>
   
    <td class="center">
        <div class="btn-group">
            <a href="<?php echo site_url('atos_setting/edit/'. $row['setting_id']);?>" class="btn btn-success" title="Edit"><i class="fa fa-pencil-square-o"></i></a>

            <a class="btn btn-danger" data-target="#myModal_delete<?php echo $row['setting_id'];?>" data-toggle="modal" title="Delete" ><i class="fa fa-trash-o" ></i></a>
        </div>
        <div id="myModal_delete<?php echo $row['setting_id'];?>" class="modal fade" role="dialog">
            <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Atos Delete Confirmation</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure to delete this Information</p>
                </div>

                <div class="modal-footer">
                    <input type="hidden" class="hidden_link_delete" value="<?php echo site_url('atos_setting/delete/'.$row['setting_id']); ?>">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-default delete">Ok</button>
                </div>
            </div>

        </div>
        </div>
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
<!--End Advanced Tables -->
</div>
</div>
<!-- /. ROW  -->

<script>
    $('.delete').click(function(){

        var values = $(this).parent() .find('.hidden_link_delete').val();
        window.location =  values;
    });


</script>

