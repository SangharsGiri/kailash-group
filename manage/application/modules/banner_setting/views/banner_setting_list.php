
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <?php echo (isset($title) && $title !="") ? $title:""; ?>

            </div>

            <div class="panel-body">


                <div class="tab-content">

                    <div class="tab-pane fade active in" id="home">
                        <div class="panel panel-default">

                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover"  id="dataTables-example">
                                        <thead>
                                        <tr>
                                            <th>S.N</th>
                                            <th>Banner Type</th>
                                            <th>Active Status</th>

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
                                                <td><?php echo $row['banner_type'];?></td>

                                                <td>

                                                    <input type="radio" name="change<?php echo $row['setting_id'];?>"  <?php echo isset($row['active_status']) && $row['active_status'] == "Y" ? "checked":""?> id="<?php echo $row['setting_id'];?>" class="cat_active"> Active
                                                    <input type="radio" name="change<?php echo $row['setting_id'];?>" <?php echo isset($row['active_status']) && $row['active_status'] == "N" ? "checked":""?> id="<?php echo $row['setting_id'];?>" class="cat_inactive"> InActive
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
    $('.cat_active').click(function(){

        var id = $(this).attr("id");


        var postData = {
            'id' : id


        };

        $.ajax({
            type: "POST",
            url: '<?php echo base_url() ?>index.php/banner_setting/active',
            dataType: "html",

            data: postData, // appears as $_GET['id'] @ your backend side
            success: function(data) {

               

                location.reload();

            }

        });
    });


</script>

<script>
    $('.cat_inactive').click(function(){

        var id = $(this).attr("id");

        var postData = {
            'id' : id
        };

        $.ajax({
            type: "POST",
            url: '<?php echo base_url() ?>index.php/banner_setting/in_active',
            dataType: "html",

            data: postData, // appears as $_GET['id'] @ your backend side
            success: function(data) {

                location.reload();

            }

        });
    });


</script>