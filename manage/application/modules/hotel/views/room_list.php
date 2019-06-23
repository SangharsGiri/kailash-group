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

    <a class="btn btn-info" data-rel="tooltip" href="<?php echo site_url('hotel/addroom/'.$hotel_id);?>" title="Add Package"><i class="fa fa-plus-square-o"></i> Add New Room</a>
 

</div>
<div class="panel-body">
<div class="table-responsive">
<form id="form" name="form" method="POST" action="">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
<thead>
<tr>
    <th>S.N</th>
    <th>Name</th>
    <th>PAX</th>
    <th>Price</th>
    <th>Status</th>
    <th>Action</th>
</tr>
</thead>
<tbody>
<?php
$i = 1;
foreach($rooms as $row)
{
  

?>

<tr class="odd gradeX">
    <td><?php echo $i++;?></td>
    
    <td><?php echo substr($row['name'], 0,60);?>...</td>
    <td><?php echo $row['pax'];?></td>

    <td><?php echo $row['price']; ?></td>
    
    <td><?php
       echo(isset($row['publish_status']) and $row['publish_status'] == "1") ? "Active" : "Inactive";
        ?></td>
        <?php $checked = (isset($row['show_front']) && $row['show_front']=="1")?"checked":"";?>
   
    <td class="center">
        <div class="btn-group">

            <a href="<?php echo site_url('hotel/editroom/'. $row['hotelroom_id']);?>" class="btn btn-success" title="Edit"><i class="fa fa-pencil-square-o"></i></a>

            <a class="btn btn-danger" data-target="#myModal_delete<?php echo $row['hotelroom_id'];?>" data-toggle="modal" title="Delete" ><i class="fa fa-trash-o" ></i></a>
        </div>
        <div id="myModal_delete<?php echo $row['hotelroom_id'];?>" class="modal fade" role="dialog">
            <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Room Delete Confirmation</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure to delete this Information</p>
                </div>

                <div class="modal-footer">
                    <input type="hidden" class="hidden_link_delete" value="<?php echo site_url('hotel/delete_room/'.$row['hotelroom_id']); ?>">
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
<!-- <select name ="select" class = "select-down">
<option name="check_front" value="check_front"> Show Front</option>
<option name= "hide_front" value="hide_front"> Hide Front</option>
</select> -->

</form>
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