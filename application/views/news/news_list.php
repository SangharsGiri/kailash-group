<div class="container">
    <div class="page-breadcrumbs">
     <div id="btnContainer">
  <button class="btn" onclick="listView()"><i class="fa fa-bars"></i> List</button> 
  <button class="btn active" onclick="gridView()"><i class="fa fa-th-large"></i> Grid</button>
</div>
        <h3 class="section-title"><span class="section-title"><a><?php echo $sub_title; ?></a></span></h3>
        <div class="world-nav cat-menu">
<!--            <ul class="list-inline">-->
<!--                <li class="active"><a href="#">Movie Time</a></li>-->
<!--               <li><a href="#">Fashion</a></li>-->
<!--                <li><a href="#">Food</a></li>-->
<!--                <li><a href="#">Health</a></li>-->
<!--                <li><a href="#">Travel & Tour</a></li>-->
<!--            </ul>-->
        </div>
    </div>

    <div class="section">
        <div class="row">
            <div class="col-sm-12">
                <div id="site-content" class="site-content">

                    <div class="section listing-news">
                        <?php
                        if(!empty($articles))
                        {
                            ?>
                            <div id="products" class="row list-group">
                                <?php

                                $i=1;
                                foreach($articles as $rows) {

                                    $UserDetail = $this->crud->get_detail($rows['user_id'], 'user_id', 'igc_users');

                                    $articles_path  = 'uploads/content/';
                                    $actives = (isset($i) && $i == "1") ? "active" : "";
                                    ?>
                                    <div class="item post column">
                                        <div class="thumbnail row">
                                        <div class="col-sm-12">
                                                    <?php
                               if (!empty($rows['youtube_link'])){
                                   ?>

                                   <div class="entry-header">
                                            <div class="entry-thumbnail">
                                                <a href="<?php echo site_url('/news/detail/'.$rows['content_id']);?>">
                                               <iframe width="100%" height="100%" src="https://www.youtube.com/embed/<?php echo base_url('news/detail/'.$row['youtube_link']) ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                </a>
                                            </div>
                                        </div>
                               <?php }
                               elseif (!empty($rows['featured_img'])) {
                                ?>

                                    <div class="entry-header">
                                            <div class="entry-thumbnail">
                                                <a href="<?php echo site_url('/news/detail/'.$rows['content_id']);?>">
                                                <img class="group list-group-image img-responsive" style="width: 100%;" src="<?php echo $rows['featured_img'];?>"  alt="<?php echo $rows['content_title']; ?>" />
                                                </a>
                                            </div>
                                        </div>
                                               
                                
                               
                               <?php }
                               else{
                                   ?>
                                   <div class="entry-header">
                                            <div class="entry-thumbnail">
                                                <a href="<?php echo site_url('/news/detail/'.$rows['content_id']);?>">
                                                <img class="img-responsive" src="<?php echo base_url('uploads/pictures/banner.jpg') ?>"  alt="<?php echo $rows['content_title']; ?>" />
                                                </a>
                                            </div>
                                        </div>
                               <?php } ?>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="post-content">

                                            <h2 class="entry-title">
                                                <a href="<?php echo site_url('/news/detail/'.$rows['content_id']);?>"><?php echo $rows['content_title']; ?></a>
                                            </h2>
                                            <div class="entry-meta">
                                                <div class="row">
                                                <ul class="list-inline">
                                                    <div class="col-sm-6 usevie">
                                                    <li class="views"><a><i class="fa fa-user"></i> <?php echo $rows['by-line']; ?></a></li>
                                                    </div>
                                                    <div class="col-sm-6 pubdat">
                                                    <li class="publish-date"><a><i class="fa fa-clock-o"></i> <?php echo date_converter($rows['created']);?> </a></li>
                                                </div>
                                                </ul>
                                            </div>
                                            <div class="contbod">
                                              <?php
                           $string = $rows['content_body'];
                           $string = word_limiter($string, 20);
                           ?>
                           <?php echo $string;?>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    </div>


                                     <!-- ads -->
                                     <!-- ads -->
                                <!--/post-->


                                    <?php
                                    $i++;
                                }
                                ?>
                                <div class="row">
                                  <div class="col-sm-12">
                                    <ul class="pagination">
                                    <li><?php echo $this->pagination->create_links(); ?></li>  
                                  </ul>
                                  </div>
                                </div>  
                            </div>
                            <!-- single lats ads -->  
                            <?php
                        } else{
                            ?>
                            
                                <style>
                                    .error-template {padding: 40px 15px;text-align: center;}
                                    .error-actions {margin-top:15px;margin-bottom:15px;}
                                    .error-actions .btn { margin-right:10px; }
                                </style>
                                <div class="error-template">
                                    <h1>
                                        Oops!</h1>
                                    <h2>
                                        Product not found</h2>
                                    <div class="error-details">
                                        Sorry, please try again!
                                    </div>
                                    <div class="error-actions">
                                        <a href="<?php echo base_url(); ?>" class="btn btn-danger"><span class="fa fa-home"></span>
                                            Take Me Home </a><a href="<?php echo base_url('content/contact');?>" class="btn btn-default"><span class="fa fa-envelope"></span> Contact Support </a>
                                    </div>
                                </div>
                            



                            <?php


                        }
                        ?>






                    </div>
                </div><!--/#site-content-->


            </div><!--/.col-sm-9 -->

            <div id="sticky" class="col-sm-3">
               <!--  <?php
                $settings = $this->site_settings_model->get_site_settings();
                ?> -->
                    <!-- <div id="sitebar">
                        <div class="ADS">
                            <div class="widget">
                                <h3 class="adsss"><span class="adss">Advertisement space</span></h3>
                                <?php

                   $Ads1 = $this->db->query("SELECT * FROM igc_ads WHERE location = 'category-page' AND status ='Active'");
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
                            </div>
                            <div class="do-space">
                                <a href="" target="_blank"></a>
                            </div>
                        </div>

                        <div class="widget widget_search">
                                <h3><span>More articles</span></h3>
                                <div class="ot-widget-article-list">
                                    <?php foreach($recent_articles as $row) { ?>
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
                                                    <a href="<?php echo base_url('/news/detail/'.$row['content_id']) ?>" class="item-header-image"><img src="<?php echo base_url('/uploads/content/'.$row['featured_img']); ?>" alt=""></a>
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
                    </div> -->
            </div>
        </div>
    </div><!--/.section-->
</div><!--/.container-->
<!--/#main-wrapper-->
    

<script>
// Get the elements with class="column"
var elements = document.getElementsByClassName("column");
var elementss = document.getElementsByClassName("img-responsive");
var elementsss = document.getElementsByClassName("views");
var publishdate = document.getElementsByClassName("publish-date");
var entrytitle = document.getElementsByClassName("entry-title");
var contbod = document.getElementsByTagName("p");
// Declare a loop variable
var i;

// List View
function listView() {
  for (i = 0; i < elements.length; i++) {
    elements[i].style.width = "50%";
    elementss[i].style.width = "100%";
    elementsss[i].style.fontSize = "13px";
    publishdate[i].style.fontSize = "13px";
    entrytitle[i].style.fontSize = "17px";
    contbod[i].style.fontSize = "17px";
    // ptag[i].style.fontSize = "15";

   // elementss[i].style.object-fit = "cover";
  }
}

// Grid View
function gridView() {
  for (i = 0; i < elements.length; i++) {
    elements[i].style.width = "25%";
    elements[i].style.height = "50%";
    elementss[i].style.width = "100%";
    elementss[i].style.height = "auto";
    elementsss[i].style.fontSize = "10px";
    publishdate[i].style.fontSize = "11px";
    entrytitle[i].style.fontSize = "15px";
    entrytitle[i].style.lineHeight = "20px";
    contbod[i].style.fontSize = "12px";
   // ptag[i].style.fontSize = "9";
  }
}

/* Optional: Add active class to the current button (highlight it) */
var container = document.getElementById("btnContainer");
var btns = container.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
  });
}
//$(document).ready(function() {
  //  $('#list').click(function(event){event.preventDefault();$('#products .item').addClass('list-group-item');});
    // $('#grid').click(function(event){event.preventDefault();$('#products .item').removeClass('list-group-item');$('#products .item').addClass('grid-group-item');});  });
</script>
<style>
* {
  box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.column {
  float: left;
  width: 49%;
  padding: 10px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
/* Style the buttons */
.btn {
  border: none;
  outline: none;
  padding: 12px 16px;
  background-color: #f1f1f1;
  cursor: pointer;
}

.btn:hover {
  background-color: #ddd;
}

.btn.active {
  background-color: #666;
  color: white;
}
</style>
                               