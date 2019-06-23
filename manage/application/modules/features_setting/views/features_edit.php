
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

                <form class="tab_form" method="post" action="" enctype="multipart/form-data">
                    <div class="tab-content">

                        <div class="tab-pane fade active in" id="home">

                            <table class="form-table">
                                <tbody>
                                <tr valign="top">
                                <div class="col-md-6">  <div class="form-group">
                                    <th style="background: transparent none repeat scroll 0% 0%; width: 100px;" scope="row"><label>Name<span class="asterisk">*</span>
                                        </label></th>

                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                    <input type="hidden" name="id" value="<?php echo $features['id']; ?>">
                                        <input type="text" name="features_name" data-validation="required" class="regular-text" value = "<?php echo $features['features_name']; ?>">
                                           
                                    </td>
                                    </div></div>
                                </tr>
                                
                                
                            <tr valign="top" id="active-tr">
                            <div class="col-md-6">  <div class="form-group"> 
                                <th scope="row"><label>Is Active? </label></th>                        
                                    <td style="background: transparent none repeat scroll 0% 0%;">
                                        <input type="radio" name="status" <?php echo (isset($features['status']) && $features['status'] =="1")?"checked":"";?> class="regular-text" data-validation="required" value="1">Yes
                                        <input type="radio" name="status" <?php echo (isset($features['status']) && $features['status'] =="0")?"checked":"";?> class="regular-text" data-validation="required" value="0">No
                                    </td>
                                </div></div>
                            </tr>
                            

                
                    <tr valign="top">
                        <div class="col-md-12">  <div class="form-group">    
                            <th scope="row" style= size><label for="image">Features <span class="asterisk">*</span></label>                        
                            <br/>
                            <span><a href="javascript:;" id="more-feature">Add more</a></span>
                            </th>
                        <td id="more-cname">
                        <?php
                            foreach ($child as $row) {
                               
                                $child_name = $row['features_name'];
                                $child_id = $row['id'];

                                
                        ?>
                       
                            <p style="width: 50%; float:left"> 
                            <input type="hidden" name="child_id[]" value="<?php echo $child_id; ?>"/>       
                            <input type="text" name="child_name[<?php echo $child_id;?>]" class="regular-text" value= "<?php echo $child_name; ?>" /><a href= "javascript:void(0);" class="delete_features" id= "<?php echo $child_id; ?>" title="remove"><i class="fa fa-trash-o" aria-hidden="true"></i></a></p>
                            <?php
                            }
                            ?>
                    </td>

                    </div></div>

                </tr>
                </tbody>
            </table>
                        </div>
                        <p class="submit"> 
                            <input type="submit" name="submit" id="change_pass_submit" class="button" value="Save">
                        </p>



                    </div>
                </form>
            </div>
        </div>


    </div>
</div>
<?php

?>
</body>
</html>
<script>

$(function () {
    $('#more-feature').bind('click',function() {
        $('#more-cname').append('<p style="width:50%;float:left"><input type="text" name="cname[]" class="regular-text"/><a class="delete-features" title="remove"><i class="fa fa-trash-o"></i></a></p>');
    });
    
    $("#more-cname").delegate(".delete-features", "click", function (){
        $(this).parent().remove();  
    });
    
    $('.delete_features').click(function() {
    
        if(confirm('Are you sure to remove this facilities ?')){
            var id = this.id;
            
            var datatosend = 'id='+id;
           
            
            jQuery.ajax({
              
                url     : '<?php echo base_url() ?>index.php/features_setting/rmv_features',
                type    : 'POST',
                data    : datatosend,
                success : function(data){
                  // $('#p_'+id).remove();
                 
                  location.reload();
                }
            });

        }else{
            return false;   
        }        
    }); 
});

</script>



<script>
    $.validate();
</script>
