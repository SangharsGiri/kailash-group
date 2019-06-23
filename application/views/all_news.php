<div class="container">
    <div class="page-breadcrumbs">
        <h1 class="section-title">Search Result</h1>
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
                        if(!empty($job_result))
                        {
                            ?>
                            <div id="products" class="row list-group">
                                <?php

                                $i=1;
                                foreach($job_result as $rows) {

                                    $UserDetail = $this->crud->get_detail($rows['content_title'], 'content_title', 'igc_content');

                                    $articles_path  = 'uploads/content/';
                                    $actives = (isset($i) && $i == "1") ? "active" : "";
                                    ?>
                                    <div class="post">
                                        <div class="entry-header">
                                            <div class="entry-thumbnail">
                                                <a href="<?php echo site_url('index.php/content/'.$rows['content_url']);?>">
                                                    <img class="img-responsive" src="<?php echo $articles_path.$rows['featured_img'];?>"  alt="<?php echo $rows['content_page_title']; ?>" />
                                                </a>
                                            </div>
                                        </div>
                                        <div class="post-content">

                                            <h2 class="entry-title">
                                                <a href="<?php echo site_url('index.php/content/'.$rows['content_url']);?>"><?php echo $rows['content_page_title']; ?></a>
                                            </h2>
                                            <div class="entry-meta">
                                                <ul class="list-inline">
                                                    <li class="publish-date"><a href="<?php echo site_url('index.php/content/'.$rows['content_url']);?>"><i class="fa fa-clock-o"></i> <?php echo $rows['created'];?> </a></li>
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
                                        Search Result not found</h2>
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


            </div><!--/.col-sm-9 -->

            <div id="sticky" class="col-sm-3">
               <!--  <?php
                $settings = $this->site_settings_model->get_site_settings();
                ?> -->
                <div id="sitebar">


                    
                </div><!--/#sitebar-->

            </div>
        </div>
    </div><!--/.section-->
</div><!--/.container-->
</div><!--/#main-wrapper-->


















