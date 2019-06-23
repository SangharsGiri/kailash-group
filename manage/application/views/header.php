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

    <!-- Font Awesome Icons -->
    <link href="themes/font-awesome-4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <!-- CUSTOM STYLES-->
    <link href="themes/css/custom.css" rel="stylesheet" />
    <!-- STYLES-->
    <link href="themes/css/style.css" rel="stylesheet" />
    <link href="themes/css/select2.css" rel="stylesheet" />
    <link href="themes/css/select2.min.css" rel="stylesheet" />

    <link href="themes/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <link type="text/css" rel="stylesheet" href="themes/css/reset.min.css" />
        


    <script src="themes/js/jquery.min.js"></script>
    <script src="themes/js/jquery-ui.min.js"></script>
    <script src="themes/js/bootstrap.min.js"></script>
    <!-- JQUERY -->


    <!--editor-->

    <script type="text/javascript" src="themes/plugins/ckeditor/ckeditor.js"></script>


    <?php
    if(isset($styles))
    {
        foreach($styles as $style =>$st)
        {
            ?>
            <link href="<?php echo $st;?>.css" rel="stylesheet" media="screen">


        <?php
        }
    }
    ?>
    <script>
        var BASE_URL = "<?php echo base_url(); ?>";
        var LIST_MAX_LEVELS = "<?php echo $this->config->item('max_levels', 'adjacency_list');?>";
    </script>



    <?php
    if(isset($scripts))
    {
        foreach($scripts as $script =>$sc)
        {
            ?>
            <script src="<?php echo $sc;?>.js" type="text/javascript"></script>

        <?php
        }
    }
    ?>


<!--    <script type='text/javascript' src='themes/js/jquery-sortable/jquery-ui.js'></script>-->
<!--    <script>-->
<!--        $(function() {-->
<!--            $( "#sortable" ).sortable();-->
<!--            $( "#sortable" ).disableSelection();-->
<!--        });-->
<!--    </script>-->


</head>
<body>
<div id="wrapper">
    <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><?php echo $this->session->userdata('username');?></a>
        </div>
        <?php
        $user_id= $this->session->userdata('admin_id');
        $this->db->where('user_id', $user_id);
        $detail = $this->db->get('igc_users')->row_array();


        ?>
        <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"> Last access : <?php echo date_converter($detail['last_login']);?> &nbsp;
            <a href="<?php echo site_url('profile');?>" class="btn btn-danger square-btn-adjust">Change Password</a>
            <a href="<?php echo site_url('login/logout');?>" class="btn btn-danger square-btn-adjust">Logout</a> 
             <a href="<?php echo base_url(); ?>../" target="_blank" class="btn btn-success">Visit Site</a>
            </div>
    </nav>
    <!-- /. NAV TOP  -->
    <nav class="navbar-default navbar-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="main-menu">
                <li class="text-center">
                    <a href="<?php echo site_url('dashboard');?>"><img src="themes/img/find_users.png" class="user-image img-responsive" /></a>
                </li>


                <li>
                    <a class="active-menu" href="<?php echo site_url('dashboard');?>"><i class="fa fa-dashboard "></i> Dashboard</a>
                </li>

                <li>
                    <a href="<?php echo site_url('site_settings');?>"><i class="fa fa-qrcode "></i> Site Settings</a>
                </li> 
                <li>
                    <a href="<?php echo site_url('user');?>"><i class="fa fa-user "></i>User</a>
                </li>
                <!-- <li>
                    <a href="<?php echo site_url('primary_menu');?>"><i class="fa fa-bars"></i>Primary Menu</a>
                </li> -->
                <li>
                    <a href="<?php echo site_url('category_sorting');?>"><i class="fa fa-sort-amount-desc "></i>Category Sorting</a>
                </li>

            </ul>

        </div>

    </nav>
    <!-- /. NAV SIDE  -->
    <div id="page-wrapper" >
        <div id="page-inner">