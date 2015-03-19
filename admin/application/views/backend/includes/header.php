<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Lyla Loves Admin | <?php echo $title; ?></title>
    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/bootstrap-reset.css'); ?>" rel="stylesheet">
    <!--external css-->
    <link href="<?php echo base_url('assets/assets/font-awesome/css/font-awesome.css'); ?>" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/style-responsive.css'); ?>" rel="stylesheet" />
	<link href="<?php echo base_url('assets/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css'); ?>" rel="stylesheet" type="text/css" media="screen"/>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/owl.carousel.css'); ?>" type="text/css">
	<link href="<?php echo base_url('assets/css/TableTools.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/demo_table.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/css/jquery.dataTables.css'); ?>" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/assets/bootstrap-datepicker/css/datepicker.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/assets/bootstrap-colorpicker/css/colorpicker.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/assets/bootstrap-daterangepicker/daterangepicker.css'); ?>" />
	<link rel="stylesheet" href="<?php echo base_url('assets/css/select2.css'); ?>" type="text/css" />
	<script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/jquery-1.8.3.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.dataTables.js'); ?>"></script>
	 <script src="<?php echo base_url('assets/js/jquery.sparkline.js'); ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js'); ?> "></script>
	 <script src="<?php echo base_url('assets/js/sparkline-chart.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/easy-pie-chart.js'); ?>"></script>
<script>
$(document).ready(function(){
		$('.datetime').datepicker({
		 format: 'yyyy-mm-dd'
	 });
	 $("#select1").select2({
		
		allowClear: true,
		//minimumInputLength: 3,
		
	 });
	 $("#select2").select2({
		
		allowClear: true,
		//minimumInputLength: 3,
		
	 });
	 $("#select3").select2({
		
		allowClear: true,
		//minimumInputLength: 3,
		
	 });
	  $("#select4").select2({
		
		allowClear: true,
		//minimumInputLength: 3,
		
	 });
	 $("#select5").select2({
		
		allowClear: true,
		//minimumInputLength: 3,
		
	 });
});
</script>

</head>
<body>
<section id="container" class="">
      <!--header start-->
      <header class="header white-bg">
            <div class="sidebar-toggle-box">
                <div data-original-title="Toggle Navigation" data-placement="right" class="icon-reorder tooltips"></div>
            </div>
            <!--logo start-->
            <a href="#" class="logo">Lyla Loves</a>
            <!--logo end-->
            <div class="top-nav ">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <li>
                        <input type="text" class="form-control search" placeholder="Search">
                    </li>
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <!--<img alt="" src="img/avatar1_small.jpg">-->
                            <span class="username"><?php echo $this->session->userdata( 'firstname' ); ?></span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li><a href="#"><i class=" icon-suitcase"></i>Profile</a></li>
                            <li><a href="#"><i class="icon-cog"></i> Settings</a></li>
                            <li><a href="#"><i class="icon-bell-alt"></i> Notification</a></li>
                            <li><a href="<?php echo site_url('login/logout'); ?>"><i class="icon-key"></i> Log Out</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!--search & user info end-->
            </div>
        </header>
      <!--header end-->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu">
                  <li class="active">
                      <a class="" href="<?php echo site_url('site/index'); ?>">
                          <i class="icon-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>
                
				  <li >
                      <a href="<?php echo site_url('site/viewusers'); ?>" class="">
                          <i class="icon-user"></i>
                          <span>Users</span>
                          <span class="arrow"></span>
                      </a>
                  </li>
				  <li >
                      <a href="<?php echo site_url('site/viewproduct'); ?>" class="">
                          <i class="icon-book"></i>
                          <span>Products</span>
                          <span class="arrow"></span>
                      </a>
                  </li>
				  <li >
                      <a href="<?php echo site_url('site/viewcategory'); ?>" class="">
                          <i class="icon-book"></i>
                          <span>Category</span>
                          <span class="arrow"></span>
                      </a>
                  </li>
				  <li >
                      <a href="<?php echo site_url('site/viewdiscountcoupon'); ?>" class="">
                          <i class="icon-money"></i>
                          <span>Promotions</span>
                          <span class="arrow"></span>
                      </a>
                  </li>
				 
				 <!-- <li >
                      <a href="<?php echo site_url('site/vieworderproduct'); ?>" class="">
                          <i class="icon-money"></i>
                          <span>Order Products</span>
                          <span class="arrow"></span>
                      </a>
                  </li>-->
				
				  <li class="sub-menu">
					<a href="javascript:;" class="">
						<i class="icon-th"></i>
						<span>CMS</span>
						<span class="arrow"></span>
					 </a>
					 <ul class="sub">
						<li><a href="<?php echo site_url('site/viewnavigation'); ?>">Navigation</a></li>
						<li><a href="<?php echo site_url('site/viewpage'); ?>">Page</a></li>
						<li><a href="<?php echo site_url('site/viewslider'); ?>">Slider</a></li>
						<li><a href="<?php echo site_url('site/viewbanner1'); ?>">Banner1</a></li>
						<li><a href="<?php echo site_url('site/viewbanner2'); ?>">Banner2</a></li>
						<li><a href="<?php echo site_url('site/viewbanner3'); ?>">Banner3</a></li>
						<li><a href="<?php echo site_url('site/viewcelebcorner'); ?>">Celeb corner</a></li>
						<li><a href="<?php echo site_url('site/viewbloggerscorner'); ?>">Bloggers corner</a></li>
					 </ul>
				  </li>
				   <li >
                      <a href="<?php echo site_url('site/viewcurrency'); ?>" class="">
                          <i class="icon-gbp"></i>
                          <span>Currency</span>
                          <span class="arrow"></span>
                      </a>
                  </li>
				   <li >
                      <a href="<?php echo site_url('site/viewpaymentgateway'); ?>" class="">
                          <i class="icon-money"></i>
                          <span>Payment Gateway</span>
                          <span class="arrow"></span>
                      </a>
                  </li>
                  <li >
                      <a href="<?php echo site_url('site/vieworder'); ?>" class="">
                          <i class="icon-money"></i>
                          <span>Orders</span>
                          <span class="arrow"></span>
                      </a>
                  </li>
                  <li >
                      <a href="<?php echo site_url('site/viewpendingorder'); ?>" class="">
                          <i class="icon-money"></i>
                          <span>Pending Orders</span>
                          <span class="arrow"></span>
                      </a>
                  </li>
                  <li >
                      <a href="<?php echo site_url('site/newsletter'); ?>" class="">
                          <i class="icon-money"></i>
                          <span>Newsletter</span>
                          <span class="arrow"></span>
                      </a>
                  </li>
                  <li >
                      <a href="<?php echo site_url('site/limitedstock'); ?>" class="">
                          <i class="icon-money"></i>
                          <span>Limited Offer</span>
                          <span class="arrow"></span>
                      </a>
                  </li>
                  <li >
                      <a href="<?php echo site_url('site/viewcontact'); ?>" class="">
                          <i class="icon-money"></i>
                          <span>Contact Us</span>
                          <span class="arrow"></span>
                      </a>
                  </li>
                <!--  
                  <li >
                      <a href="<?php// echo site_url('site/viewpickofweak'); ?>" class="">
                          <i class="icon-money"></i>
                          <span>Pick Of Week</span>
                          <span class="arrow"></span>
                      </a>
                  </li>
                  -->
                  <li >
                      <a href="<?php echo site_url('site/viewslider'); ?>" class="">
                          <i class="icon-money"></i>
                          <span>Pick Of Week</span>
                          <span class="arrow"></span>
                      </a>
                  </li>
                  <li >
                      <a href="<?php echo site_url('site/viewproductwaiting'); ?>" class="">
                          <i class="icon-money"></i>
                          <span>Product Waiting</span>
                          <span class="arrow"></span>
                      </a>
                  </li>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
<div class="container">
            <?php if(isset($alertsuccess)) { ?>
<div class="alert alert-success"> <?php echo $alertsuccess;	?> </div>
<?php } ?>
<?php if(isset($alerterror)) { ?>
<div class="alert alert-danger"> <?php echo $alerterror;	?> </div>
<?php } ?>
<?php if(isset($alert)) { ?>
<div class="alert"> <?php echo $alert;	?> </div>
<?php } ?>
<?php if(isset($_REQUEST['alertsuccess'])) { ?>
<div class="alert alert-success"> <?php echo $_REQUEST['alertsuccess'];	?> </div>
<?php } ?>
<?php if(isset($_REQUEST['alerterror'])) { ?>
<div class="alert alert-danger"> <?php echo $_REQUEST['alerterror'];	?> </div>
<?php } ?>
<?php if(isset($_REQUEST['alert'])) { ?>
<div class="alert"> <?php echo $_REQUEST['alert'];	?> </div>
<?php } ?>