
    <div class="slider-section">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <?php
                    $slider_path  = 'uploads/slider/';
                    $j=1;
                    foreach($sliders as $rows)
                    {
                    $active =  (isset($j) && $j=="1") ? "active":"";
                ?>
                    <div class="carousel-item <?php echo $active; ?> ">
                        <img class="ssd-block w-100" src="<?php echo $slider_path.$rows['slider_image']; ?>" alt="<?php echo $rows['slider_title']; ?>">
                    </div>
                <?php
                    $j++;
                    }
                ?>
                <!-- <div class="carousel-item">
                    <img class="d-block w-100" src="image/everest-base-camp-helicopter-tour-1-1920x600.jpg" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="image/gorekshep-and-everest-base-camp-kalapathher99.jpg" alt="Third slide">
                </div> -->
                <div class="overlay">
                <div class="caption">
                        <h1>plan your travel now!</h1>
                        <p>experience the various exciting tour and travel packages, find vacation packages</p>
                        <nav class="navbar navbar-light bg-light">
                            <form action="<?php echo site_url('index.php/all_news/search') ?>" method="post" class="form-inline">
                                <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                            </form>
                        </nav>
                        <div class="container">
                                <div class="row">
                                    <div class="block col-md-12">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="box-block">
                                                    <div class="box">
                                                        <a href="<?php echo site_url("index.php/models");?>"><i class="fas fa-umbrella-beach"></i></a>
                                                       <a href="<?php echo site_url("index.php/models");?>"><h1>tour</h1></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                    <div class="box-block">
                                                       <div class="box">
                                                             <a href="<?php echo site_url("index.php/models/trekking");?>"><i class="fas fa-bed"></i></a>
                                                       <a href="<?php echo site_url("index.php/models/trekking");?>"><h1>trekking</h1></a>
                                                        </div>
                                                    </div>
                                            </div>
                                             <div class="col-md-3">
                                                <div class="box-block">
                                                    <div class="box">
                                                        <a href="<?php echo site_url("index.php/models/activities");?>"><i class="fas fa-hiking"></i></a>
                                                       <a href="<?php echo site_url("index.php/models/activities");?>"><h1>activites</h1></a>
                                                    </div>
                                                </div>
                                   
                                            </div>
                                            <div class="col-md-3">
                                                    <div class="box-block">
                                                        <div class="box">
                                                        <a href="<?php echo site_url("index.php/models/flight");?>"><i class="fas fa-fighter-jet"></i></a>
                                                       <a href="<?php echo site_url("index.php/models/flight");?>"><h1>flight</h1></a>
                                                        </div>
                                                    </div>
                                            </div>   
                                        </div>
                                    </div>
                                </div>
                             </div>
                        </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
            </a>
          
        </div>
    </div>
    <div class="section-vacation">
            <!-- <div class="container"> -->
                <div class="row">
                        <h1>vacation - <span class="vacspan">featured deals</span><a href="#">show all </a></h1>
                        
                    <section class="regular slider">
                       <?php
                       $folder_path  = 'uploads/package/';
                        foreach ($get_featured_package as $row) { 
                        ?> 
                        <div>
                            <img src="<?php echo site_url($folder_path.$row['package_id'].'/'.$row['featuredimg']); ?>">
                            <div class="caption">
                                <h2 class="captionh"><?php echo $row['package_name']; ?></h2>
                                <span>
                                    <?php 
                                    $price =  $row['price'];
                                    $discount_price = $row['discount_price'];
                                    $new_price = $price-$discount_price;
                                    ?>
                                    <?php if (!empty($discount_price)) { ?>
                                         $<?php echo $new_price; ?>

                                    <?php 
                                       }
                                     else{?>
                                        $<?php echo $price; ?>
                                     <?php 
                                       }
                                    ?>

                                     (<?php echo $row['package_duration'];?>)
                                </span>
                            </div>
                        </div>
                        <?php  } ?> 
                    </section>
                </div>
            <!-- </div> -->
    </div>
    <div class="trip-section">
            <!-- <div class="container"> -->
                <div class="row">
                    <div class="col-md-12">
                        <h1>upcoming adventure trips </h1>
                        <h2>check out these amazing adventure trips</h2>
                    </div>
                    <section class="regular-trip slider-trip">
                        <?php
                       $folder_path  = 'uploads/package/';
                        foreach ($get_adventure_trips as $row) { 
                        ?> 
                        <div>
                            <div class="card" >
                                <img class="card-img-top" src="<?php echo site_url($folder_path.$row['package_id'].'/'.$row['featuredimg']); ?>">
                                <div class="card-body">
                                  <a href="<?php echo base_url('index.php/news/detail/'.$row['package_id']) ?>"><h5 class="card-title"><?php echo $row['package_name']; ?></h5></a>
                                  <p class="card-text"><?php echo $row['package_duration'];?></p>


                                  <?php 
                                  $price =  $row['price'];
                                  $discount_price = $row['discount_price'];
                                  $new_price = $price-$discount_price;
                                  if (empty($discount_price)) { ?>

                                         <h2>$<?php echo $price; ?> <span>per persson</span></h2>
                                    <?php 
                                       }
                                     else{?>

                                        <span class="span1"><strike>$<?php echo $price; ?></strike> <span ><?php echo $discount_price; ?>off</span></span>
                                  
                                  <h2>$<?php echo $new_price; ?><span>per persson</span></h2>
                                     <?php 
                                       }
                                    ?>
                                  <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                        <div class="btn-group mr-2 second-group" role="group" aria-label="Second group">
                                             <button type="button" class="btn Second btn-secondary">submit query</button>
                                        </div>
                                        <div class="btn-group third-group " role="group" aria-label="Third group">
                                          <button type="button" class="btn third btn-secondary">book now</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php  } ?>
                        
                    </section>
                </div>
                <!-- </div>  -->
    </div>
    <div class="activie-section">
            <h1>adventure activites</h1>
       <span><i class="far fa-circle"></i></span>
         <!-- <div class="container mt-40"> -->
           <div class="row mt-30">
            <?php
            $path  = 'uploads/activity/';
             foreach ($adventures as $adventure) { 
            ?>
                <div class=" col-md-3" style="">
                    <div class="image-logo">
                        <?php
                         if (!empty($adventure['featured_img'])) { 
                        ?>
                            <img src="<?php echo $path.$adventure['featured_img']; ?>" alt="<?php echo $adventure['activity_name']; ?>" class="image">
                        <?php } 
                          else{
                        ?>
                            <img  src="<?php echo base_url(); ?>uploads/heli2.jpg" alt="<?php echo $adventure['activity_name']; ?>" class="image">
                        <?php    
                          }
                        ?>
                        
                        <a target="_blank" href="<?php echo $path.$adventure['featured_img']; ?>">
                            <div class="zoom-icon">
                               <i class="fas fa-search-plus"></i>
                            </div>
                        </a>
                        <div class="overlay">
                            <div class="text">
                              <h1><?php echo $adventure['activity_name']; ?></h1>
                            </div>
                            <a href="#"><button  class="btn btn-danger">view details</button></a>
                        </div>
                    </div>
               </div>
            <?php } ?>
           </div>
    </div>
    <div class="highlight-section">
        <h1>latest hightlights</h1>
        <span class="forafter"><i class="far fa-circle"></i></span>

        <div class="container" style="padding: 0;">
            <div class="row">
                <?php
                    $highlight_path  = 'uploads/activity/';
                    $j=1;
                    foreach($highlights as $rows)
                        
                    {
                    $active =  (isset($j) && $j=="1") ? "active":"";
                ?>
                    <div class="col-md-4">
                        <div class="card ">
                            <div class="img-card">
                                <?php
                                if (!empty($rows['featured_img'])){ ?>
                                <img class="card-img-top" src="<?php echo $highlight_path.$rows['featured_img']; ?>" alt="Card image cap">
                            <?php }

                            else{ ?>
                                       <img class="card-img-top" src="image/langtang-heli-charter-tour33.jpg" alt="Card image cap">
                            <?php } ?>

                                <div class="overlay"></div>
                            </div>
                                <div class="card-body">
                                  <h5 class="card-title ml-2"><?php echo $rows['content_title']; ?></h5>
                                  <div class="rate">
                                        <h1>rating:<span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="fa fa-star"></span>
                                        <span class="rateday "><?php echo $rows['duration']; ?></span>
                                        
                                    </h1>
                                  </div>
                                </div>
                              </div>
                </div> 
                <?php
                    $j++;
                    }
                ?> 
            </div>
        </div>
    </div>
    <div class="about-section">
        <div class="row">
            <div class="col-md-6 block-one">
                <ul>
                        <li>the destination of your dreams</li>
                        <li class="lijust" style="font-size: 52px;">is just a click away</li>
                        <li><img src="image/icon/flower-icon.png"> </li>
                        <li class="liget" style="font-size: 24px;font-weight:700;">Address :  <?php echo $site_settings['contact_address']; ?></li>
                        <li class="help">help line :  <?php echo $site_settings['contact_number']; ?></li>
                    </ul>
            </div>
            <div class="col-md-6 block-two">
                <h1><small>namaste from top of the world!</small> <br>about kailash group heli service</h1>   
                <h2></h2> 
                <p><?php echo $site_settings['slogan']; ?>
                </p>
            </div>
        </div>
    </div>
    <div class="section-global">
        <!-- <div class="container"> -->
            <div class="row">
            <div class="col-md-12">
                    <span class="global-icon"><i class="fas fa-globe-americas"></i></span>
                    <h1>our global partners</h1>
            </div>
            <section class="regular-global slider-global">
                    <?php
                    $folder_path  = 'uploads/partners/';
                    $j=1;
                    foreach($partners as $rows)
                    {
                    $active =  (isset($j) && $j=="1") ? "active":"";
                ?>
                    <div class="logo-img">
                        <a target="_blank" href="<?php echo $rows['partner_url']; ?>"><img src="<?php echo $folder_path.$rows['featured_img']; ?>" alt="<?php echo $rows['title']; ?>" style="max-width:100%;"></a>
                    </div>
                <?php
                    $j++;
                    }
                ?>
                    
                </section>
                </div>
                
        <!-- </div> -->
    </div>
   