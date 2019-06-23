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
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>Hotel Features</strong>
            </div>
            <div class="panel-body">
                <form method="post" action="">
                <div class="row">
                        <?php
                         if(! empty($features_name))
                        {
                            $i = 1;
                            foreach($features_name as $row)
                            { 
                                $features_id = $row['id'];

                                $class = "slide".$i;
                                $name = "name".$i;
                                $slide = "chk_".$features_id;
                                $link = $this->hotel->get_hotel_feature($id, $features_id);
                                $check = (isset($link) && (!empty($link)))?"checked":"";
                                
                            ?> 
                               <div class="panel-group" id="<?php echo $name ?>" role="tablist" aria-multiselectable="true"> 
                              <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#<?php echo $name; ?>" href="#<?php echo $class; ?>" aria-expanded="true" aria-controls="<?php echo $class; ?>">
                                <?php echo $row['features_name']; ?>
                            </a>
                            </h4>
                        </div> 
                        <div id="<?php echo $class; ?>" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headingOne" >
                        <div class="panel-body">
                       
                         <span><input id="<?php echo $slide; ?>"  type="checkbox" name="hfid[]" <?php echo $check;?> value="<?php echo $features_id; ?>" /><?php echo $row['features_name']; ?></span>
                        <ul>
                        <?php
                        $child_name = $this->hotel->get_child($features_id);
                        foreach ($child_name as $key) {
                            $child_id = $key['parent_id']."_".$key['id']; 
                            $feature_id = $key['id'];
                            $link = $this->hotel->get_hotel_feature($id, $feature_id);

                           $checked = (isset($link) && (!empty($link)))?"checked":"";
                        ?>
      <li style="padding-left:40px;">
    <input class="chkmain" id="<?php echo $child_id; ?>" type="checkbox" name="hfid[]" <?php echo $checked;?> value="<?php echo $key['id']; ?>" /><?php echo $key['features_name']; ?></li>
      <?php }
 

      ?>
      </ul>
      </div>
    </div>
  </div>
  </div>
                    <?php
                    $i++;
                            }                       
                    }

                        ?>
                        <div class="col-md-12">
                        <input type="hidden" name="id" value="<?php echo $id ;?>">
                        <input type="submit" name="Save Btn" class="button" value="Save">
                        </div>
                    <div class="clearfix"></div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>   
    $(document).ready(function() {
        
        $(".chkmain").click(function(){
            var id = $(this).attr('id');
            var fid = id.split('_');
            if ($(this).is(':checked')) {
                $('#chk_'+fid[0]).attr('checked', true);            
            }
        });
    });
</script> 