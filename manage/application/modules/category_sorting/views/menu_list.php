

<div class="row mbl">
<div class="col-lg-12">

    <div class="col-md-12">
        <div id="area-chart-spline" style="width: 100%; height: 300px; display: none; padding: 0px; position: relative;">
            <canvas class="flot-base" width="1059" height="300" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 1059px; height: 300px;"></canvas><div class="flot-text" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; font-size: smaller; color: rgb(84, 84, 84);"><div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"><div class="flot-tick-label tickLabel" style="position: absolute; top: 299px; left: 10px;">Jan</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 299px; left: 183px;">Feb</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 299px; left: 356px;">Mar</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 299px; left: 530px;">Apr</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 299px; left: 703px;">May</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 299px; left: 876px;">Jun</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 299px; left: 1049px;">Jul</div></div><div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"><div class="flot-tick-label tickLabel" style="position: absolute; top: 290px; left: 1px;">0</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 250px; left: 1px;">25</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 210px; left: 1px;">50</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 170px; left: 1px;">75</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 130px; left: 1px;">100</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 90px; left: 1px;">125</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 50px; left: 1px;">150</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 10px; left: 1px;">175</div></div></div><canvas class="flot-overlay" width="1059" height="300" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 1059px; height: 300px;"></canvas><div class="legend"><div style="position: absolute; width: 0px; height: 0px; top: 15px; right: 15px; opacity: 0.85; background-color: rgb(255, 255, 255);"> </div><table style="position:absolute;top:15px;right:15px;;font-size:smaller;color:#545454"><tbody><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid #ffce54;overflow:hidden"></div></div></td><td class="legendLabel">Upload</td></tr><tr><td class="legendColorBox"><div style="border:1px solid #ccc;padding:1px"><div style="width:4px;height:0;border:5px solid #01b6ad;overflow:hidden"></div></div></td><td class="legendLabel">Download</td></tr></tbody></table></div></div>
    </div>

</div>

<div class="col-lg-12">

    <div class="page-content">
        <div class="row">
            <?php if ($groups): ?>
                <?php foreach ($groups as $group): ?>
                    <div class="info_wrapper">
                        <div class="info_header">
                            <span class="info_title"><?php echo $group['name']; ?> (<?php echo $group['slug']; ?>)</span>
                          <!--   <a style="float:right;margin-top:-5px;" class="btn btn-danger delete" data-type="group" data-href="<?php echo site_url('al/delete_group/'.$group['id']); ?>" data-name="<?php echo $group['name']; ?>'" href="javascript:;"><i class="icon-trash icon-white"></i> Delete</a>
                            <a style="float:right;margin-top:-5px;margin-right:5px;" class="btn btn-primary" href="<?php echo site_url('al/edit_group/'.$group['id']); ?>"><i class="icon-edit icon-white"></i> Edit</a> -->
<!--                             <a style="float:right;margin-top:-5px;margin-right:5px;" class="btn btn-success" href="--><?php ////echo site_url('category_sorting/add/'.$group['id']); ?><!--"><i class="icon-plus icon-white"></i> Add item to group</a>-->
                        </div>
                        <div class="info_box">
                            <ol class="sortable">
                                <?php echo build_admin_tree($group['items']); ?>
                            </ol>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="hero-unit">
                    <p>There is no navigation groups.</p>
                    <p>
                        <a class="btn btn-success" href="<?php echo site_url('al/add_group'); ?>"><i class="icon-plus icon-white"></i> Add navigation group</a>
                    </p>
                </div>
            <?php endif; ?>

            <div class="modal hide fade" id="confirm-modal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3>Please confirm</h3>
                </div>
                <div class="modal-body">
                    Description...
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>

</div>

</div>



