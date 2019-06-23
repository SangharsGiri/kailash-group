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

    <a class="btn btn-info" data-rel="tooltip" href="<?php echo site_url('package/form');?>" title="Add Package"><i class="fa fa-plus-square-o"></i> Add New Package</a>
</div>
<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="dataTables-example">
<thead>
<tr>
    <th>S.N</th>
    <th>Package</th>
    <th>Code</th>
    <th>Status</th>
    <th>Show Front</th>
    <th>Action</th>
</tr>
</thead>
<tbody>
<?php
$i = 1;
foreach($records as $row)
{
?>

<tr class="odd gradeX">
    <td><?php echo $i++;?></td>
    <td><?php echo substr($row['package_name'], 0,60);?>...</td>
    <td><?php echo $row['tourcode'];?></td>
    <td><?php
       echo(isset($row['status']) and $row['status'] == "1") ? "Active" : "Inactive";
        ?></td>
    <td>

        <input type="radio"  <?php echo isset($row['show_front']) && $row['show_front'] == "1" ? "checked":""?> id="<?php echo $row['package_id'];?>" class="pkg_active"> YES
        <input type="radio" <?php echo isset($row['show_front']) && $row['show_front'] == "0" ? "checked":""?> id="<?php echo $row['package_id'];?>" class="pkg_inactive"> NO
    </td>
    <td class="center">
        <div class="btn-group">
            <a href="<?php echo site_url('package/form/'. $row['package_id']);?>" class="btn btn-success" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
            <a href="<?php echo site_url('package/gallery/'. $row['package_id']);?>" class="btn btn-info" title="Gallery"><i class="fa fa-picture-o"></i></a>
            <a href="<?php echo site_url('fixed_departure/'. $row['package_id']);?>" class="btn btn-primary" title="Departure"><i class="fa fa-bus"></i></a>
            <a href="<?php echo site_url('package/destination/'. $row['package_id']);?>" class="btn btn-info" title="Destination"><i class="fa fa-map-marker" aria-hidden="true"></i></a>
            <a href="<?php echo site_url('package/delete_package/'. $row['package_id']);?>" class="btn btn-danger" title="Delete"><i class="fa fa-trash-o"></i></a>
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
    $('.pkg_active').click(function(){

        var id = $(this).attr("id");


        var postData = {
            'active_id' : id,
            'inactive_id' : ''

        };

        $.ajax({
            type: "POST",
            url: '<?php echo base_url() ?>index.php/package/show_front',
            dataType: "html",

            data: postData, // appears as $_GET['id'] @ your backend side
            success: function(data) {

                location.reload();

            }

        });
    });


</script>

<script>
    $('.pkg_inactive').click(function(){

        var id = $(this).attr("id");

        var postData = {
            'inactive_id' : id,
            'active_id' : ''

        };

        $.ajax({
            type: "POST",
            url: '<?php echo base_url() ?>index.php/package/show_front',
            dataType: "html",

            data: postData, // appears as $_GET['id'] @ your backend side
            success: function(data) {

                location.reload();

            }

        });
    });


</script>
