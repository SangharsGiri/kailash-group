<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $title;?></title>
    <base href="<?php echo base_url() ?>" />
    <!-- FAVICON -->
    <link rel="icon" href="../favicon.png"/>
    <!-- BOOTSTRAP STYLES-->
    <link href="themes/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="themes/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="themes/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <!--    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />-->
    <!-- Font Awesome Icons -->
    <link href="themes/font-awesome-4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />


</head>
<body style="background-image: url('themes/login_background.jpg')">
<div class="container">
    <div class="row text-center ">
        <div class="col-md-12">
            <br /><br />
            <h2>&nbsp;</h2>
            <br /><br />
        </div>
    </div>

    <div class="row ">

        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
            <?php
            if(validation_errors())
            {
                ?>
                <div class="alert alert-danger">
                    <?php echo validation_errors();?>
                </div>
                <?php
            }
            ?>
            <?php
            if(isset($error))
            {
                ?>
                <div class="alert alert-danger">
                    <?php echo $error;?>
                </div>
                <?php
            }
            ?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong> Enter Login Details </strong>
                </div>
                <div class="panel-body">
                    <form method="post" action="">
                        <br />
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" name="username" value="<?php echo set_value('username');?>" class="form-control" required="required" placeholder="Your Username " />
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                            <input type="password" name="password" value="" class="form-control"  placeholder="Your Password" required="required"  />
                        </div>
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="fa fa-unlock-alt"></i></span>
                            <input type="password" name="passconf" value="" id="retype" class="form-control"  placeholder="ReType Password" required="required"  />
                        </div>
                        <input type="submit" class="btn btn-primary" value="Login Now">

                    </form>
                </div>

            </div>
        </div>


    </div>
</div>


<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
<!-- JQUERY SCRIPTS -->
<script src="themes/js/jquery-1.10.2.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="themes/js/bootstrap.min.js"></script>
<!-- METISMENU SCRIPTS -->
<script src="themes/js/jquery.metisMenu.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="themes/js/custom.js"></script>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-38955291-1', 'auto');
    ga('send', 'pageview');

</script>

<script>
    $('#retype').bind("cut copy paste",function(e) {
        e.preventDefault();
    });
</script>
</body>
</html>
