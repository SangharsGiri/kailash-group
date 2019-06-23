  <?php
    $path  = base_url("uploads/trekking/");
     foreach ($trekkingss as $trekking) { 
    ?>
 <div class="section-sliderimg">
        <img src="<?php echo $path.$trekking['featured_img']; ?>" alt="">
        <div class="overlay">
            <div class="caption">
                <h1><?php echo $trekking['trekking_title']; ?></h1>
                <p><?php
                   $string = $trekking['trekking_body'];;
                   $string = word_limiter($string, 100);
                   ?></p>
            </div>
        </div>
    </div>
    <?php } ?>
    <div class="cardetail-section">
        <div class="container">
            <div class="row car-detail">
                <?php
                $path  = base_url("uploads/trekking/");
                 foreach ($trekkings as $trekking) { 
                ?>
                <div class="car-blog col-md-12">
                        <div class="row">
                            <div class="col-md-8 ">
                                <h1><?php echo $trekking['trekking_title']; ?><span></span></h1>
                                <!-- <h3>author <span>date: 25th march</span></h3> -->
                                <div class="text-part">
                                    <p><?php
                                   $string = $trekking['trekking_body'];;
                                   $string = word_limiter($string, 100);
                                   ?>
                                    </p>
                                </div>
                                <h2>Interested in this trekking ?</h2>
                                <a href="slider.html"><button class="btn .btn-primary">Get details</button></a>
                                
                            </div>
                            <div class="col-md-4 ">
                                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                                   data-image="image/car/1.jpg"
                                   data-target="#image-gallery">
                                    <img class="img-thumbnail"
                                         src="<?php echo $path.$trekking['featured_img']; ?>"
                                         alt="Another alt text">
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="image-gallery-title"></h4>
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <img id="image-gallery-image" class="img-responsive col-md-12" src="">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary float-left" id="show-previous-image"><i class="fa fa-arrow-left"></i>
                                        </button>
                
                                        <button type="button" id="show-next-image" class="btn btn-secondary float-right"><i class="fa fa-arrow-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                    </div>  
            </div>
        </div>
    </div>