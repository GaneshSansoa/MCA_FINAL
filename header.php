<?php 
require_once('config/config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <title>SetMyCitations</title>
    <!-- Bootstrap Core CSS -->
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link href="<?php echo BASE_URL; ?>assets/node_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.16/dist/css/bootstrap-select.min.css">
	    <link href="<?php echo BASE_URL; ?>css/font-awesome.min.css" rel="stylesheet">
			    <link href="<?php echo BASE_URL; ?>css/iconmind.css" rel="stylesheet">
    <!-- This is for the animation CSS -->
    <link href="<?php echo BASE_URL; ?>assets/node_modules/aos/dist/aos.css" rel="stylesheet">
    <!-- This page slider css -->
    <link href="<?php echo BASE_URL; ?>assets/node_modules/bootstrap-touch-slider/bootstrap-touch-slider.css" rel="stylesheet" media="all">
    <link href="<?php echo BASE_URL; ?>assets/node_modules/owl.carousel/dist/assets/owl.theme.green.css" rel="stylesheet">
		    <link href="<?php echo BASE_URL; ?>css/headers11-20.css" rel="stylesheet">
    <!-- This css we made it from our predefine componenet 
    we just copy that css and paste here you can also do that -->
    <link href="<?php echo BASE_URL; ?>css/demo.css" rel="stylesheet">
    <!-- Common style CSS -->
    <link href="<?php echo BASE_URL; ?>css/style.css" rel="stylesheet">
	
    <link href="<?php echo BASE_URL; ?>css/yourstyle.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Loading.....</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="">
        <!-- ============================================================== -->
        <!-- Top header  -->
        <!-- ============================================================== -->
        <div class="topbar">
		<div class="header11 po-relative">
                    <div class="container">
                        <!-- Header 1 code -->
                        <nav class="navbar navbar-expand-lg h11-nav">
                            <a class="navbar-brand" href="<?php echo BASE_URL;?>"><img src="images/logo.svg" style="width:100%;height:50px;" alt="SetMyCitations"></a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#header11" aria-expanded="false" aria-label="Toggle navigation"><span class="ti-menu"></span></button>
                            <div class="collapse navbar-collapse hover-dropdown flex-column" id="header11">
                                <div class="ml-auto h11-topbar">
                                    <ul class="list-inline ">
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                        <li>

											<div class="rounded-button" id="login-logout">
                                            <?php if(isset($_COOKIE['token'])):?>
                                                <?php $_COOKIE['token'];?>
                                                <a href="<?php echo BASE_URL;?>dashboard">Dashboard</a> - OR - <a href='#' style='margin:0px' id='logout'>Logout</a>                                   
                                            <?php else:?>
												<a href="<?php echo BASE_URL;?>login.php">Login</a> - OR - <a href="<?php echo BASE_URL;?>signup.php">Register</a>
                                            <?php endif;?>
											</div>
										</li>
                                    </ul>
                                </div>
                                <ul class="navbar-nav font-13 ml-auto">
                                    <li class="nav-item active"><a class="nav-link" href="<?php echo BASE_URL;?>"">Home</a></li>
                                    <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL;?>about.php">About Me</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Work</a></li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="h11-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Services <i class="fa fa-angle-down m-l-5"></i>
                                        </a>
                                        <ul class="b-none dropdown-menu animated fadeInUp">
                                            <li><a class="dropdown-item" href="#">Action</a></li>
                                            <li><a class="dropdown-item" href="#">Another action</a></li>
                                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                                            <li class="divider" role="separator"></li>
                                            <li class="dropdown-submenu"> <a class="dropdown-toggle dropdown-item" href="#" data-toggle="dropdown">Dropdown <i class="fa fa-angle-right ml-auto"></i></a>
                                                <ul class="dropdown-menu b-none menu-right">
                                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                                    <li class="divider" role="separator"></li>
                                                    <li><a class="dropdown-item" href="#">Separated link</a></li>
                                                    <li class="divider" role="separator"></li>
                                                    <li><a class="dropdown-item" href="#">One more separated link</a></li>
                                                </ul>
                                            </li>
                                            <li><a class="dropdown-item" href="#">Separated link</a></li>
                                            <li class="divider" role="separator"></li>
                                            <li><a class="dropdown-item" href="#">One more separated link</a></li>
                                        </ul>
                                    </li>
                                </ul>
								
                            </div>
							
                        </nav>
                    </div>
                </div>
        </div>
        <!-- ============================================================== -->
        <!-- Top header  -->
        <!-- ============================================================== -->