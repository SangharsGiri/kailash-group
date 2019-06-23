<!DOCTYPE html>
<html >
<head>
    <meta charset="utf-8">
    <meta name="viewport">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Kailash Group</title>
    <link rel="stylesheet" href="<?php echo base_url("assests/css/bootstrap.min.css"); ?>">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="<?php echo base_url("assests/css/customize.min.css"); ?>">

    <link rel="stylesheet" href="<?php echo base_url("assests/slick/slick.css"); ?>">
    <link rel="stylesheet" href="<?php echo base_url("assests/slick/slick-theme.css"); ?>">

    <link rel="stylesheet" href="<?php echo base_url("fontawesome-free-5.8.2-web/css/all.css"); ?>">
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous"> -->
    <!-- font size -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">

</head>
<body>
    <div class="top-menu">
        <div class="container">
            <div class="row rowclass">
                <div class="col-md-5 top-list">
                    <ul>
                        <li class="help"><i class="far fa-question-circle"></i><a href=""></a>help
                            <ul>
                                <li><a href="#">tip tool</a></li>
                            </ul>
                        </li>
                        <li><a href="">|</a></li>
                        <li class="infoli"><?php echo $site_settings['feedback_email']; ?></li>
                    </ul>
                </div>
                <div class="col-md-7 ">
                   <div class="list">
                        <ul>
                            <li>welcome ! Guest</li>
                            <!-- <li class="infoli"><a href="#"></a>sign in | registration!</li> -->
                            <li class="infoli"><a href="<?php echo base_url("index.php/login/"); ?>">sign in</a></li>
                            <li><a href="">|</a></li>
                            <li class="infoli"><a href="<?php echo base_url("index.php/login/register"); ?>">registration!</a></li>
                            <li class="phone"><?php echo $site_settings['contact_number']; ?></li>
                            <li class="infoli"><i class="fab fa-blogger"></i><a href="#">blog</a></li>
                        </ul>
                   </div>

                </div>
            </div>
        </div>
    </div>
    <div class="menu-list">
            <div class="container">
                    <div class="row">
                    </div>
                
                    <nav class="navbar navbar-expand-lg navbar-light bg-warning">
                      <?php $path  = base_url("uploads/logo/"); ?>
                         <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo $path.$logo['logo_image'];?>" alt=""></a>
                         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                             <span class="navbar-toggler-icon"></span>
                         </button>
                 
                         <div class="collapse navbar-collapse" id="navbarSupportedContent">
                             <ul class="navbar-nav ml-auto topnav">
                                 <li class="nav-item active">
                                    <a class="nav-link" href="<?php echo base_url(); ?>">Home</a>
                                 </li>



                                 <?php
                       $parents =  $this->crud->get_parent_category_menu();



                       if(!empty($parents))
                       {
                           $i= 1;


                           foreach ($parents as $parent)
                           {
                               //$md= ($i=="5")?"3":"2";
                               ?>

                       <li class="nav-item">

                           <a class="nav-link" href="<?php echo base_url('index.php/category/article/'.$parent['category_url']); ?>" ><?php echo $parent['category_name']; ?></a>

                           <?php
                           $child_menu =  $this->crud->get_parent_category_sub_menu($parent['category_id']); 
                           if(! empty($child_menu))
                           {
                           ?>

                               <ul class="hoverul">
                               <?php
                               foreach ($child_menu as $child) {

                                   $active = (isset($menu) && $menu == $child['category_url']) ? "active" : "";

                                   ?>

                                   <?php
                                   if ($child['category_name'] == "Home") {
                                       ?>
                                       <li class="nav-item">
                                       <a class="nav-link" href="<?php echo site_url('home'); ?>">
                                           <?php echo $child['category_name']; ?>
                                       </a>
                                       </li>
                                       <?php
                                   } else {
                                       ?>
                                       <li class="nav-item">
                                           <a class="nav-link" href="../uploads/news/">
                                               <?php echo $child['category_name']; ?>
                                           </a>
                                       </li>

                                       <?php
                                   }
                                   }
                                   ?>

                                   </ul>

                               <?php


                           }
                           ?>

                       </li>

                               <?php
                               $i++;
                           }
                       }
                       ?><!-- 





                                 <li class="nav-item">
                                     <a class="nav-link" href="#">flights</a>
                                 </li>
                                 <li class="nav-item">
                                     <a class="nav-link" href="#">hotels</a>
                                 </li>
                                 <li class="nav-item">
                                     <a class="nav-link" href="#">cars</a>
                                 </li>
                                 <li class="nav-item">
                                      <a class="nav-link" href="#">buses</a>
                                  </li>
                                 <li class="nav-item">
                                     <a class="nav-link" href="#">vacation</a>
                                     <ul class="hoverul">
                                         <li class="nav-item">
                                             <a class="nav-link" href="#">travel insurance</a>
                                         </li>
                                         <li class="nav-item">
                                             <a class="nav-link" href="#">travel insurance</a>
                                         </li>
                                         <li class="nav-item">
                                             <a class="nav-link" href="#">cruises</a>
                                         </li>
                                         <li class="nav-item">
                                             <a class="nav-link" href="#">cars</a>
                                         </li>
                                         <li class="nav-item">
                                             <a class="nav-link" href="#">luxury rail</a>
                                         </li>
                                         <li class="nav-item">
                                             <a class="nav-link" href="#">Buses</a>
                                         </li>
                                      </ul>
                                 </li>
                                 <li class="nav-item">
                                     <a class="nav-link" href="#">travel insurance</a>
                                 </li>
                                 <li class="nav-item">
                                      <a class="nav-link" href="#">cruises</a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" href="#">luxury rail</a>
                                  </li> -->
                             </ul>
                         </div>
                     </nav>
                 </div>
    </div>
    <div class="review-button">
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"><img src="image/icon/review.png" alt=""></button>
    </div>
    <div class="getcall-button">
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#getcall"><img src="image/icon/callback.png" alt=""></button>
    </div>