<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<section>
   <div class="container">
       <div class="row">
           <div class="col-lg-12">
               <div class="tauke">
               </div>
           </div>
       </div>
   </div>
</section>
<section>
   <div class="container">
       <div class="row">
           <div class="col-lg-9">
               <div class="white-page clearfix top-margin">
                <br>
                   <div class="addthis_inline_share_toolbox_5tc2"></div>
                   <article class="single-content">
                    <h1 class="page-title"><?php echo $detail['content_title'] ?></h1>  <!-- 
                    <a href="#" class="fa fa-facebook"></a>
                    <a href="#" class="fa fa-twitter"></a>
                    <a href="#" class="fa fa-google"></a>
                    <a href="#" class="fa fa-linkedin"></a>
                    <a href="#" class="fa fa-youtube"></a>
                    <a href="#" class="fa fa-instagram"></a>
                    <a href="#" class="fa fa-pinterest"></a> -->
                <br><!-- 
                <div class="col-sm-3 vie">
                <div class="views"> <i class="fa fa-user"></i> <?php echo $detail['by-line'];?></div>
                </div>
                <div class="col-sm-3 pub">
                <div class="publish-date"> <i class="material-icons">access_time</i> <?php echo $detail['created'];?></div>
                </div> -->
                    <div class="row">
                    <?php
                               if (!empty($detail['youtube_link'])){
                                   ?>
                                    <iframe width="100%" height="500px%" src="https://www.youtube.com/embed/<?php echo base_url('news/detail/'.$detail['youtube_link']) ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> 

                               <?php }
                               elseif (!empty($detail['server_image'])) {
                                ?>

                                  <div class="col-sm-12">
                                     <img style="width: 100%; height: 100%" src="<?php echo $detail['server_image'];?>"/>
                                  </div>
                                
                               
                               <?php }
                               else{
                                   ?>
                                            <div class="col-sm-12">
                                               <img src="<?php echo base_url('uploads/pictures/banner.jpg') ?>" class="img-responsive"/>
                                            </div>
                               <?php } ?>
                        </div>
                     <div class="row">
                     <div class="col-sm-12">
                      <p><?php echo $detail['content_body'] ?></p>
                     </div>
                     </div>
                
                       <br>
                       <br>
               <!--  <hr class="bottom">   
               <div> <p><?php echo $detail['content_body'] ?></p></div>
               <hr class="bottom"> -->
                    
                   <div class="related_news">
                       <div class="row">
                           <!-- <?php foreach($relateds as $row) {?>
                           <div class="col-md-4 col-sm-4 col-xs-12">
                               <div class="mid-box">
                                   <a href="<?php echo base_url('news/detail/'.$row['content_id']) ?>">
                                       <img src="<?php echo base_url('/uploads/content/'.$row['featured_img']); ?>" class="img-responsive" />
                                   </a>
                                   <div class="overlays">
                                       <a href="<?php echo base_url('news/detail/'.$row['content_id']) ?>" class="sb-ttt"> <?php echo $row['content_title'];?></a>
                                   </div>
                               </div>
                           </div>
                           <?php } ?> -->
                       </div>
                   </div>
               </article>
               
               <div class="clearfix"></div>
               <div class="puchchar">
               </div>
               <div class="clearfix"></div>
           </div>
       </div>
        <!-- <div class="col-lg-3">
          <h1><span>Advertisement space</span></h1>
                <div class="item item-small">
                  <div class="item-header">
              <a href="<?php echo base_url('/news/detail/'.$ads['ads_url']) ?>" class="item-header-image"><img src="<?php echo base_url('/uploads/ads/'.$ads['featured_img']); ?>" alt=""></a>
                </div>
           </div>
       </div> -->
       <div class="col-lg-3">
        <div class="widget">
                                <!-- <div class="widget widget_search">
                                <?php

                   $Ads1 = $this->db->query("SELECT * FROM igc_ads WHERE location = 'Sidebar-Top' AND status ='Active'");
                   $Adss1 = $Ads1->result_array();

                   ?>

                       <?php
                       $path = 'uploads/ads/';
                       foreach ($Adss1 as $key => $value) {
                           ?>

<a href="<?php echo $value['ads_url'] ?>" target="_blank"><img  src="<?php echo $path.$value['featured_img'];?>"  alt="<?php echo $value['ads_name']; ?>" class="img-responsive"/></a>
                           <?php
                       }
?>
                        </div> -->
                            </div>
           <div class="widget widget_search">
                                <h3><span>Related Articles</span></h3>
                                <div class="ot-widget-article-list">
                                    <?php foreach($recents as $row) { ?>
                                            <?php
                               if (!empty($row['youtube_link'])){
                                   ?>
                                     <div class="item item-small pop">
                                                <div class="item-header">
                                                    <a href="<?php echo base_url('/news/detail/'.$row['content_id']) ?>" class="read-later-widget-btn"><i class="material-icons">access_time</i><i class="ot-inline-tooltip">Read more</i></a>
                                                    <iframe width="100%" height="50%" src="https://www.youtube.com/embed/<?php echo base_url('news/detail/'.$row['youtube_link']) ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                </div>
                                                <div class="item-content pop">
                                                    <h5><a href="<?php echo base_url('/news/detail/'.$row['content_id']) ?>"><?php echo $row['content_title']; ?></a></h5>
                                                </div>
                                            </div>

                               <?php }
                               elseif (!empty($row['featured_img'])) {
                                ?>

                                         <div class="item item-small pop">
                                                <div class="item-header">
                                                    <a href="<?php echo base_url('/news/detail/'.$row['content_id']) ?>" class="read-later-widget-btn"><i class="material-icons">access_time</i><i class="ot-inline-tooltip">Read more</i></a>
                                                    <a href="<?php echo base_url('/news/detail/'.$row['content_id']) ?>" class="item-header-image"><img src="<?php echo $row['server_image'];?>" alt=""></a>
                                                </div>
                                                <div class="item-content pop">
                                                    <h5><a href="<?php echo base_url('/news/detail/'.$row['content_id']) ?>"><?php echo $row['content_title']; ?></a></h5>
                                                </div>
                                            </div>
                                
                               
                               <?php }
                               else{
                                   ?>
                                   <div class="item item-small pop">
                                                <div class="item-header">
                                                    <a href="<?php echo base_url('/news/detail/'.$row['content_id']) ?>" class="read-later-widget-btn"><i class="material-icons">access_time</i><i class="ot-inline-tooltip">Read more</i></a>
                                                    <a href="<?php echo base_url('/news/detail/'.$row['content_id']) ?>" class="item-header-image"><img src="<?php echo base_url('uploads/pictures/banner.jpg') ?>" alt=""></a>
                                                </div>
                                                <div class="item-content pop">
                                                    <h5><a href="<?php echo base_url('/news/detail/'.$row['content_id']) ?>"><?php echo $row['content_title']; ?></a></h5>
                                                </div>
                                            </div>
                               <?php } ?>
                                            <?php }  ?> 
                                </div>
                            </div>
       </div>
   </div>
   <div class="row new-type-weg"><!-- 
    <h3><span>Related Articles</span></h3> -->
  <div class="col-md-12 rec-de-box">
    <?php

                                        foreach($recents_new as $row)
                                        {
                                            ?>
                    <?php
                               if (!empty($row['youtube_link'])){
                                   ?>
                                    
                                   <div class="detail-page-recent">
                                        <iframe width="100%" height="100%" src="https://www.youtube.com/embed/<?php echo base_url('news/detail/'.$row['youtube_link']) ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                               <div class="re-bot"><span class="detail-page-rece">
                                                    <strong class="hi"><?php echo $row['content_title'];?></strong>
                                                </span></div>
                                    </div>

                               <?php }
                               elseif (!empty($row['server_image'])) {
                                ?>

                                          <div class="detail-page-recent">
                                        <a href="<?php echo base_url('/news/detail/'.$row['content_id']) ?>" class="item-header-image">
                                          <img src="<?php echo $row['server_image'];?>" alt=""></a>
                                               <div class="re-bot"><span class="detail-page-rece">
                                                    <strong class="hi"><?php echo $row['content_title'];?></strong>
                                                </span></div>
                                    </div>
                                
                               
                               <?php }
                               else{
                                   ?>
                                   <div class="detail-page-recent">
                                                <a href="<?php echo base_url('/news/detail/'.$row['content_id']) ?>" class="item-header-image">
                                                  <img src="<?php echo base_url('uploads/pictures/banner.jpg') ?>" alt=""></a>
                                                       <div class="re-bot"><span class="detail-page-rece">
                                                            <strong class="hi"><?php echo $row['content_title'];?></strong>
                                                        </span></div>
                                            </div>
                               <?php } ?>
                    <?php
                                        }
                                        ?>
  </div>
</div>
</div>

</section>