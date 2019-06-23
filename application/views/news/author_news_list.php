<div class="container">
    <div class="page-breadcrumbs">
        <h1 class="section-title"><?php echo $sub_title; ?></h1>
        <div class="world-nav cat-menu">
<!--            <ul class="list-inline">-->
<!--                <li class="active"><a href="#">Movie Time</a></li>-->
<!--                <li><a href="#">Fashion</a></li>-->
<!--                <li><a href="#">Food</a></li>-->
<!--                <li><a href="#">Health</a></li>-->
<!--                <li><a href="#">Travel & Tour</a></li>-->
<!--            </ul>-->
        </div>
    </div>
    <div class="section">
        <div class="row">
            <div class="col-sm-9">
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
                                    <div class="post">
                                        <div class="entry-header">
                                            <div class="entry-thumbnail">
                                                <a href="<?php echo site_url('content/'.$rows['content_url']);?>">
                                                <img class="img-responsive" src="<?php echo $articles_path.$rows['featured_img'];?>"  alt="<?php echo $rows['content_page_title']; ?>" />
                                                </a>
                                            </div>
                                        </div>
                                        <div class="post-content">

                                            <h2 class="entry-title">
                                                <a href="<?php echo site_url('content/'.$rows['content_url']);?>"><?php echo $rows['content_page_title']; ?></a>
                                            </h2>
                                            <div class="entry-content">
                                                <p><?php echo $rows['content_summary']; ?></p>
                                            </div>
                                            <div class="entry-meta">
                                                <ul class="list-inline">
                                                    <li class="publish-date"><a href="<?php echo site_url('content/'.$rows['content_url']);?>"><i class="fa fa-clock-o"></i> <?php echo date_converter($rows['created']);?> </a></li>
                                                    <li class="views">By: <a href="<?php echo site_url('category/author/'.$UserDetail['username']);?>"> <?php echo $UserDetail['full_name']; ?></a></li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div><!--/post-->


                                    <?php
                                    $i++;
                                }
                                ?>

                            </div>


                            <?php
                        } else{
                            ?>

                            <div class="col-sm-9">
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
                            </div>



                            <?php


                        }
                        ?>






                    </div>
                </div><!--/#site-content-->

                <div class="pagination-wrapper">
                    <?php
                    if(! empty($packages))
                    {
                        $total_page = ceil($package_total/$per_page);
                        if($total_page > 1)
                        {
                            ?>
                            <ul class="pagination">

                                    <li><a href="#" aria-label="Previous"><span aria-hidden="true"><i class="fa fa-long-arrow-left"></i> Previous Page</span></a></li>

                                <?php for($i = 1; $i <= $total_page; $i++) { ?>
                                    <li><a href="<?php echo $base_url."/" ?><?php echo $i ?>" class="links <?php echo ($i==$current_page)?"":"in"?>active"><?php echo $i ?></a></li>
                                    <?php
                                }
                                ?>
                                <li><a href="#" aria-label="Next"><span aria-hidden="true">Next Page <i class="fa fa-long-arrow-right"></i></span></a></li>

                            </ul>
                            <?php
                        }
                    }
                    ?>

                </div>
            </div><!--/.col-sm-9 -->

            <div id="sticky" class="col-sm-3">
                <?php
                $settings = $this->site_settings_model->get_site_settings();
                ?>
                <div id="sitebar">


                    <div class="widget follow-us">
                        <h1 class="section-title title">Follow Us</h1>
                        <ul class="list-inline social-icons" style="padding-top: 5%">
                            <li><a href="<?php echo $settings['facebook_link']; ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="<?php echo $settings['twiter_link']; ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="<?php echo $settings['google_plus_link']; ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="<?php echo $settings['linked_in']; ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="<?php echo $settings['youtube_link']; ?>" target="_blank"><i class="fa fa-youtube"></i></a></li>
                        </ul>
                    </div><!--/#widget-->

                    <div class="widget">
                        <h1 class="section-title title">This is Rising!</h1>
                        <ul class="post-list">
                            <?php
                            $NsCat = $this->db->query("SELECT * FROM igc_package_category WHERE publish_status ='1' AND delete_status ='0' AND show_front = '0'");
                            $NsCats = $NsCat->result_array();
                            ?>
                            <?php

                            foreach ($NsCats as $rows) {
                                $pack_path = 'uploads/package_category/';
                                ?>
                                <li>
                                    <div class="post small-post">
                                        <div class="entry-header">
                                            <div class="entry-thumbnail">
                                                <img class="img-responsive" src="<?php echo $pack_path.$rows['featured_img']; ?>" alt="" />
                                            </div>
                                        </div>
                                        <div class="post-content">
                                            <div class="video-catagory"><a href="<?php echo  site_url('category/article/'.$rows['category_url']);?>"><?php echo $rows['category_name']; ?></a></div>
                                            <h2 class="entry-title">
                                                <a href="<?php echo  site_url('category/article/'.$rows['category_url']);?>"><?php echo $rows['description']; ?></a>
                                            </h2>
                                        </div>
                                    </div><!--/post-->
                                </li>

                                <?php

                            }

                            ?>


                        </ul>
                    </div><!--/#widget-->
                </div><!--/#sitebar-->
            </div>
        </div>
    </div><!--/.section-->
</div><!--/.container-->
</div><!--/#main-wrapper-->
	