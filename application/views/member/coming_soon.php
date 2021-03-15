<!DOCTYPE html>
<html>
<head>
    <title>Welcome | Plutino's World</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url('inc/css/styles.css')?>?v=<?=VERSION?>">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Exo:wght@100;200;500;600&display=swap" rel="stylesheet">
</head>
<body style="background:black">
<!--For Web-->
<div class="web-view">
<div style="background-image:url('inc/img/plutinos/BG-01-WB.jpg');background-repeat:no-repeat;background-size:100%;min-height:600px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-xs-12 col-sm-12 col-lg-12">
            <p id="demo" style="color:white;font-family: 'Exo', sans-serif;line-height:1.75;text-align:center;margin:20% 0 10px 0; font-size:20px;letter-spacing:2px;font-weight:300"></p>
            <br>
            <h1 style="color:white;font-family: 'Exo', sans-serif;text-align:center;text-transform:uppercase;letter-spacing:4px">Plutino's</h1>
            </div>
        </div>
    </div>
</div>
</div>


<!--For Mobile-->
<div class="mob-view">
<div style="background-image:url('inc/img/plutinos/BG-01-MB.jpg');background-repeat:no-repeat;background-size:auto 100%;min-height:700px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-xs-12 col-sm-12 col-lg-12">
            <p id="demo_mb" style="color:white;font-family: 'Exo', sans-serif;line-height:1.75;text-align:center;margin:20% 0 10px 0; font-size:20px;letter-spacing:2px;font-weight:300"></p>
            <br>
            <h1 style="color:white;font-family: 'Exo', sans-serif;text-align:center;text-transform:uppercase;letter-spacing:4px">Plutino's</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-xs-12 col-sm-12 col-lg-12">
            <div style="margin-top:97%;color:#d9d9d9;text-align:center">
                <small>Supported Multi-Social Media Platform </small><br>
                <h6 style="font-family: 'Exo', sans-serif;line-height:2.5"><a href="https://web.facebook.com/Plutinos-103982008432520">Facebook</a>  |  <a style="color:#d8d8d8">Instagram</a></h6>
            </div>
            </div>
        </div>
    </div>
</div>
</div>



<script>

/*$(document).ready(function(){
    alert("hhi");
});*/





// Set the date we're counting down to
var countDownDate = new Date("Mar 17, 2021 00:00:00").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";
  document.getElementById("demo_mb").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
</script>
</body>

</html>