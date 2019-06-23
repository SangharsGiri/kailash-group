
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
                                <tr>
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label class="forex-form-label" >Currency
                                        </label></th>
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label class="forex-form-label">Code
                                        </label></th>
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label class="forex-form-label">Unit
                                        </label></th>
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label class="forex-form-label">Buying
                                        </label></th>
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label class="forex-form-label">Selling
                                        </label></th>
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label class="forex-form-home">Show On Homepage
                                        </label></th>
                                </tr>
                                
                                </tbody>
                                </table>
                            <?php
                            if(empty($records))
                            {
                            ?>

                            <table class="form-table">

                                <tbody>

                                    <button type="button" class="add-forex" id="add-forex-fields">Add Form</button>


                                </tbody>
                            </table>

                            <?php
                            }
                            else
                            {
                                ?>
                                <table class="form-table">

                                    <tbody>
                                    <?php
                                    foreach($records as $row)
                                    {
                                    ?>
                                   <tr>
                                       <td>
                                           <input type="text" name="currency[<?php echo $row['id'];?>]"  size="10"  value="<?php echo $row['currency'];?>"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="currency_code[<?php echo $row['id'];?>]" size="10"  value="<?php echo $row['currency_code'];?>"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="unit[<?php echo $row['id'];?>]"  size="10"  value="<?php echo $row['unit'];?>"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="buying_rate[<?php echo $row['id'];?>]"  size="10"  value="<?php echo $row['buying_rate'];?>"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="selling_rate[<?php echo $row['id'];?>]"  size="10"  value="<?php echo $row['selling_rate'];?>"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="checkbox" name="publish_status[<?php echo $row['id'];?>]"  size="10"  <?php echo ($row['publish_status']=="1")?"checked":"" ?> value="1"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                   </tr>
                                    <?php
                                    }
                                    ?>



                                    </tbody>
                                </table>
                            <?php
                            }
                            ?>


                        </div>



                        <p class="submit">
                            <input type="hidden" name="forex_id" value="<?php echo $forex_id;?>" >
                            <input type="submit" name="Setting Btn" id="btn_news" class="button" value="Save">
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
<script>
    var dateToday = new Date();
    $(function() {
        $( "#forex_date" ).datepicker({
            numberOfMonths: 1,
            showButtonPanel: true,
            minDate: dateToday
        });
    });
</script>
<script>
    var i= parseInt('<?php echo $last_id?>');
    $('.add-forex').click(function(){

       i = i+1;

      $('.add-forex').before('<tr>'+
         '<td>'+
          '<input type="text" name="currency['+i+']"  size="10"  value=""  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">'+
            '</td>'+
           '<td>' +
       '<input type="text" name="currency_code['+i+']"   size="10"  value=""  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">'+
           '</td>' +
           ' <td>'+
       '<input type="text" name="unit['+i+']" size="10"  value=""  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">'+
          '</td>' +
          ' <td>'+
        '<input type="text" name="buying_rate['+i+']"   size="10"  value=""  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">'+
            '</td>' +
                ' <td>'+
        '<input type="text" name="selling_rate['+i+']"   size="10"  value=""  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">'+
            '</td>' +
                ' <td>'+
        '<input type="checkbox" name="publish_status['+i+']"   size="10"  value="1"  autocomplete="off" class="regular-text required valid forex-checkbox" kl_virtual_keyboard_secure_input="on">'+
            '</td>' +
                ' <td>')
    });
</script>
