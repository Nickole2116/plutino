<!DOCTYPE html>
<html>
<head>
	<title>Kryptonion</title>
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>
	<meta name="copyright" content="Gaojin"/>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta http-equiv="Content-Language" content="en"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
	<link rel="icon" href="<?=base_url('inc/img/k26.png')?>">

	<script src="<?= base_url('inc/js/jquery.latest.min.js')?>"></script>
	<script src="<?=base_url('inc/js/plugins.js')?>"></script>
	<!-- <script src="<?=base_url('inc/theme/porto')?>/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script> -->
    <script src="<?php echo base_url('inc/js/jstree.min.js')?>"></script>
	<!-- <script src="<?=base_url('inc/js/main.js?v='.VERSION)?>"></script> -->
	<link rel="stylesheet" href="<?=base_url('inc/css/bootstrap.css?v='.VERSION)?>">
	<link rel="stylesheet" href="<?=base_url('inc/css/swiper.min.css?v='.VERSION)?>">
	<link rel="stylesheet" href="<?=base_url('inc/css/plugins.css?v='.VERSION)?>">
	<link rel="stylesheet" href="<?=base_url('inc/css/default.css?v='.VERSION)?>">
  	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
   	<link href="https://fonts.googleapis.com/css2?family=PT+Sans+Caption&display=swap" rel="stylesheet">
   	<link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="<?=base_url('inc/css/dafault.css')?>">
	<link rel="stylesheet" href="<?=base_url('inc/css/auto-slider-img.css?v='.VERSION)?>">
	<script src="<?=base_url('inc/js/auto-slider-img.js?v='.VERSION)?>"></script>
	<link rel="stylesheet" href="<?=base_url('inc/css/nav-bar-style.css?v='.VERSION)?>">
	<script src="<?=base_url('inc/js/nav-bar-app.js?v='.VERSION)?>"></script>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
	
</head>
<body style="background-color: #f9f9f9" data-domain="<?php echo base_url(); ?>" data-lang="<?=lang("lang") ?>" class="<?=$this->templateStyle?>">
    
<header>



  


  

<div style="background-color: white;width: 100%">
	<div class="container-fluid bg-dark">
	<div class="row">
	<div class="col-xs-3 col-lg-3">
	<div class="burger2" style="padding:15px 10px;cursor:pointer;" onclick="open_nav()">
	     <div class="lines1" style="background-color:black;width:20px;height:2.5px;"></div>
		 <div class="lines2" style="background-color:black;width:15px;height:2.5px;margin-top:5px"></div>
		 <div class="lines3" style="background-color:black;width:22px;height:2.5px;margin-top:5px"></div>
	  </div>
    </div>
		<div class="col-xs-6 col-lg-6">
			<div style="background-color: white">
				<center>
				<h3 style="font-weight:bold;color: black;font-family: 'Poppins', sans-serif;font-size: 20px;letter-spacing:5px;"><span style="color: #000;font-size: 22px;font-weight:bold;">&nbsp;&nbsp;K</span>RYPTONION.&nbsp;&nbsp;</h3>
				<div style="width:15%;height:5px;background-image:linear-gradient(to right, rgba(0,0,0,0.1),rgba(0,0,0,0.15),rgba(0,0,0,0.1))"></div>
			</center>
			</div>
			
		</div>
		<div class="col-xs-3 col-lg-3">
			<div style="width:30px;height:30px;background:white;float:right;margin:10px;border-radius:1000px;text-align:center;padding:4px;box-shadow: 5px 4px 8px 0 rgba(0, 0, 0, 0.12), 0 6px 20px 0 rgba(0, 0, 0, 0.1);cursor:pointer;">☀</div>
	
        </div>
		
	</div>
</div>
</div>

<div id="nav-bar-items" style="height:100%;background-color:white;display:none;">
   <div class="w3-container" style="text-align:center;">
    
	   <div class="w3-animate-opacity" style="padding:10px 0;"><a href="#">Home</a></div>
	   <div class="w3-animate-opacity" style="padding:10px 0;"><a href="#">Supports</a></div>
	   <div class="w3-animate-opacity" style="padding:10px 0;"><a href="#">Helps</a></div>
     
   </div>
</div>

<script>
   function open_nav()
   {
	   var i = document.getElementById('nav-bar-items');
	   if(i.style.display == "none")
	   {
		i.style.display = "block";

	   }
		else{
			i.style.display = "none";

		}
		

   }
</script>
</header>



    