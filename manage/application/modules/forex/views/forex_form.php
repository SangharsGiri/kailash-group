
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
                            <?php
                            if($forex_id == "")
                            {
                            ?>
                            <table class="form-table">

                                <tbody>
                                <tr valign="top">
                                    <th style="background: transparent none repeat scroll 0% 0%;" scope="row"><label>Forex Date <span class="asterisk">*</span>
                                        </label></th>
                                    <td>
                                        <input type="text" name="forex_date" class="form-control" id="forex_date" value="" data-validation="date" data-validation-format="mm/dd/yyyy">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <?php
                            }
                            ?>

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
                                <tr>
                                  <td>
                                           <input type="text" name="currency[0]"  size="10"  value="Indian Rupees"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="currency_code[0]"  size="10"  value="INR"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="unit[0]"  size="10"  value="1"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="buying_rate[0]"  size="10"  value=""  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="selling_rate[0]"  size="10"  value=""  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="checkbox" name="publish_status[0]"  size="10" value="1"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                </tr>
                                <tr>
                                  <td>
                                           <input type="text" name="currency[1]"  size="10"  value="US Dollar"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="currency_code[1]"  size="10"  value="USD"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="unit[1]"  size="10"  value="1"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="buying_rate[1]"  size="10"  value=""  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="selling_rate[1]"  size="10"  value=""  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="checkbox" name="publish_status[1]"  size="10" value="1"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                </tr>

                                <tr>
                                  <td>
                                           <input type="text" name="currency[2]"  size="10"  value="Euro"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="currency_code[2]"  size="10"  value="EUR"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="unit[2]"  size="10"  value="1"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="buying_rate[2]"  size="10"  value=""  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="selling_rate[2]"  size="10"  value=""  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="checkbox" name="publish_status[2]"  size="10" value="1"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                </tr>
                                <tr>
                                  <td>
                                           <input type="text" name="currency[3]"  size="10"  value="Pound Sterling"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="currency_code[3]"  size="10"  value="GBP"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="unit[3]"  size="10"  value="1"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="buying_rate[3]"  size="10"  value=""  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="selling_rate[3]"  size="10"  value=""  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="checkbox" name="publish_status[3]"  size="10" value="1"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                </tr>
                                <tr>
                                  <td>
                                           <input type="text" name="currency[4]"  size="10"  value="Swiss Franc"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="currency_code[4]"  size="10"  value="CHF"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="unit[4]"  size="10"  value="1"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="buying_rate[4]"  size="10"  value=""  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="selling_rate[4]"  size="10"  value=""  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="checkbox" name="publish_status[4]"  size="10" value="1"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                </tr>
                                <tr>
                                  <td>
                                           <input type="text" name="currency[5]"  size="10"  value="Australian Dollar"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="currency_code[5]"  size="10"  value="AUD"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="unit[5]"  size="10"  value="1"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="buying_rate[5]"  size="10"  value=""  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="selling_rate[5]"  size="10"  value=""  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="checkbox" name="publish_status[5]"  size="10" value="1"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                </tr>
                                <tr>
                                  <td>
                                           <input type="text" name="currency[6]"  size="10"  value="Canadian Dollar"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="currency_code[6]"  size="10"  value="CAD"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="unit[6]"  size="10"  value="1"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="buying_rate[6]"  size="10"  value=""  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="selling_rate[6]"  size="10"  value=""  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="checkbox" name="publish_status[6]"  size="10" value="1"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                </tr>

                                <tr>
                                  <td>
                                           <input type="text" name="currency[7]"  size="10"  value="Singapore Dollar"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="currency_code[7]"  size="10"  value="SGD"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="unit[7]"  size="10"  value="1"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="buying_rate[7]"  size="10"  value=""  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="selling_rate[7]"  size="10"  value=""  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="checkbox" name="publish_status[7]"  size="10" value="1"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                </tr>

                                <tr>
                                  <td>
                                           <input type="text" name="currency[8]"  size="10"  value="Japanese Yen"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="currency_code[8]"  size="10"  value="JPY"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="unit[8]"  size="10"  value="1"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="buying_rate[8]"  size="10"  value=""  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="selling_rate[8]"  size="10"  value=""  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="checkbox" name="publish_status[8]"  size="10" value="1"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                </tr>

                                <tr>
                                  <td>
                                        <input type="text" name="currency[9]"  size="10"  value="Chinese Yuan"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="currency_code[9]"  size="10"  value="CNY"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="unit[9]"  size="10"  value="1"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="buying_rate[9]"  size="10"  value=""  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="selling_rate[9]"  size="10"  value=""  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="checkbox" name="publish_status[9]"  size="10" value="1"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                </tr>

                                <tr>
                                  <td>
                                           <input type="text" name="currency[10]"  size="10"  value="Saudi Riyal"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="currency_code[10]"  size="10"  value="SAR"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="unit[10]"  size="10"  value="1"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="buying_rate[10]"  size="10"  value=""  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="selling_rate[10]"  size="10"  value=""  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="checkbox" name="publish_status[10]"  size="10" value="1"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                </tr>

                                <tr>
                                  <td>
                                           <input type="text" name="currency[11]"  size="10"  value="Qatari Riyal"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="currency_code[11]"  size="10"  value="QAR"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="unit[11]"  size="10"  value="1"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="buying_rate[11]"  size="10"  value=""  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="selling_rate[11]"  size="10"  value=""  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="checkbox" name="publish_status[11]"  size="10" value="1"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                </tr>

                                <tr>
                                  <td>
                                           <input type="text" name="currency[12]"  size="10"  value="Thai Baht"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="currency_code[12]"  size="10"  value="THB"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="unit[12]"  size="10"  value="1"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="buying_rate[12]"  size="10"  value=""  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="selling_rate[12]"  size="10"  value=""  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="checkbox" name="publish_status[12]"  size="10" value="1"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                </tr>

                                <tr>
                                  <td>
                                           <input type="text" name="currency[13]"  size="10"  value="UAE Dirham"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="currency_code[13]"  size="10"  value="AED"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="unit[13]"  size="10"  value="1"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="buying_rate[13]"  size="10"  value=""  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="selling_rate[13]"  size="10"  value=""  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="checkbox" name="publish_status[13]"  size="10" value="1"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                </tr>

                                  <tr>
                                  <td>
                                           <input type="text" name="currency[14]"  size="10"  value="Malaysian Ringgit"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="currency_code[14]"  size="10"  value="MYR"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="unit[14]"  size="10"  value="1"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="buying_rate[14]"  size="10"  value=""  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="selling_rate[14]"  size="10"  value=""  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="checkbox" name="publish_status[14]"  size="10" value="1"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                </tr>

                                  <tr>
                                  <td>
                                           <input type="text" name="currency[15]"  size="10"  value="S. Korean Won"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="currency_code[15]"  size="10"  value="KRW"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="unit[15]"  size="10"  value="1"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="buying_rate[15]"  size="10"  value=""  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="text" name="selling_rate[15]"  size="10"  value=""  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
                                       <td>
                                           <input type="checkbox" name="publish_status[15]"  size="10" value="1"  autocomplete="off" class="regular-text required valid" kl_virtual_keyboard_secure_input="on">
                                       </td>
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
