<!DOCTYPE html>
<html lang="en">

<head>
  <title><?=lang('admin_panel')?></title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
	<link rel="shortcut icon" href="<?=base_url('inc/img/logo2.png?v='.LOGO_VERSION)?>" type="image/x-icon" />
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?=base_url().'assets/';?>/admin/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?=base_url().'assets/';?>/admin/vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="<?=base_url().'assets/';?>/admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?=base_url().'assets/';?>/admin/css/style.css">
  <!-- endinject -->
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('inc/css/jquery.datetimepicker.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('inc/css/admin_main.css?v=').VERSION ?>">
  
  <script src="<?=base_url().'assets/';?>/admin/js/jquery-3.4.1.min.js"></script>
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">  
          <a class="navbar-brand brand-logo" href=""><?php echo WEBSITE_NAME;?><!--img src="<?=base_url().'assets/';?>/admin/images/logo.svg" alt="logo"/--></a>
          <a class="navbar-brand brand-logo-mini" href=""><?php echo WEBSITE_NAME;?><!--img src="<?=base_url().'assets/';?>/admin/images/logo-mini.svg" alt="logo"/--></a>
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-sort-variant"></span>
          </button>
        </div>  
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
              <span class="nav-profile-name"><?php echo $this->session->userdata('admin_name');?></span>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
			  <li class="nav-item">
				<a class="nav-link" href="<?php echo base_url(ADMINPATH.'/admin'); ?>">
					<i class="mdi mdi-home menu-icon"></i>
					<span class="menu-title"><?=lang('admin')?></span>
				</a>
			  </li>
			  
				<li class="nav-item">
					<a class="nav-link" href="<?php echo base_url(ADMINPATH.'/sales'); ?>">
						<i class="mdi mdi-point-of-sale menu-icon"></i>
						<span class="menu-title"><?=lang('sale_listing')?></span>
					</a>
			 	</li>
		      	<li class="nav-item la" >
		        <?php @$language = $this->session->userdata('language_select') == 1 ? 2 : 1;?>
		          <a class="nav-link" href="<?php echo base_url(ADMINPATH.'/admin/language_select?language_select=' . $language . '&current_url=' . current_url());?>">
		            <i class="mdi mdi-translate menu-icon"></i>
		            <span class="menu-title"><?=lang("language_short_display")?></span>
		          </a>
		       </li>
		      <li class="nav-item l">
		        <a class="nav-link logout" href="<?php echo base_url(ADMINPATH.'/admin/logout'); ?>">
		          <i class="mdi mdi-logout menu-icon"></i>
		          <span class="menu-title"><?=lang('logout')?></span>
		        </a>
		      </li>
      	</ul>
    </nav>

<script type="text/javascript">
  
</script>