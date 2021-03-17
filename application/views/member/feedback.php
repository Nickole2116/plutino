<!DOCTYPE html>
<html>
<head>
    <title>Welcome | Plutino's World</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url('inc/css/styles.css')?>?v=1.2">
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
<div style="background-image:url('<?php echo base_url('inc/img/plutinos/BG-01-WB.jpg')?>');background-repeat:no-repeat;background-size:100%;min-height:600px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-xs-12 col-sm-12 col-lg-12">
            <div style="background:rgba(255,255,255,0.4);">
                <p id="demo_mb2" style="color:black;font-family: 'Exo', sans-serif;line-height:1.75;text-align:center;margin:10% 0 10px 0; font-size:20px;letter-spacing:2px;font-weight:300">1,473 miles (2,370 kms)</p>
            </div>
            <br>
            <h1 style="color:white;font-family: 'Exo', sans-serif;text-align:center;text-transform:uppercase;letter-spacing:4px">Plutino's</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-xs-12 col-sm-12 col-lg-12">
            <div style="margin-top:1%;color:#d9d9d9;text-align:center;">
                <form method="post" action="<?= base_url('member/p_feed')?>">
                <small>What do you think about our website</small>
                    <br>
                    <select name="opt_mark" style="width:50%;height:40px;background:rgba(0,0,0,0.5);color:white">
                        <option value="5">Awesome</option>
                        <option value="4">Good</option>
                        <option value="3">Neutral</option>
                        <option value="2">Bad</option>

                    </select>
                    <br><br>
                    <small>Do you think our website helpful?</small>
                    <br>
                    <select name="opt_help" style="width:50%;height:40px;background:rgba(0,0,0,0.5);color:white">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                    <br><br>
                    <small>Write down your throughts.</small>
                    <br>
                    <textarea name="txtcomment" style="width:50%;background:rgba(0,0,0,0.5);color:white"></textarea>
                    <br><br>
                    <button type="submit" style="width:auto;background:rgba(255,255,255,0.8);border:none;border-radius:30px;padding:10px 30px;letter-spacing:1.75px"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-slack" viewBox="0 0 16 16">
  <path d="M3.362 10.11c0 .926-.756 1.681-1.681 1.681S0 11.036 0 10.111C0 9.186.756 8.43 1.68 8.43h1.682v1.68zm.846 0c0-.924.756-1.68 1.681-1.68s1.681.756 1.681 1.68v4.21c0 .924-.756 1.68-1.68 1.68a1.685 1.685 0 0 1-1.682-1.68v-4.21zM5.89 3.362c-.926 0-1.682-.756-1.682-1.681S4.964 0 5.89 0s1.68.756 1.68 1.68v1.682H5.89zm0 .846c.924 0 1.68.756 1.68 1.681S6.814 7.57 5.89 7.57H1.68C.757 7.57 0 6.814 0 5.89c0-.926.756-1.682 1.68-1.682h4.21zm6.749 1.682c0-.926.755-1.682 1.68-1.682.925 0 1.681.756 1.681 1.681s-.756 1.681-1.68 1.681h-1.681V5.89zm-.848 0c0 .924-.755 1.68-1.68 1.68A1.685 1.685 0 0 1 8.43 5.89V1.68C8.43.757 9.186 0 10.11 0c.926 0 1.681.756 1.681 1.68v4.21zm-1.681 6.748c.926 0 1.682.756 1.682 1.681S11.036 16 10.11 16s-1.681-.756-1.681-1.68v-1.682h1.68zm0-.847c-.924 0-1.68-.755-1.68-1.68 0-.925.756-1.681 1.68-1.681h4.21c.924 0 1.68.756 1.68 1.68 0 .926-.756 1.681-1.68 1.681h-4.21z"/>
</svg> &nbsp;Submit</button>

<br><br>
                    <a href="<?=base_url('member')?>" style="color:white"><small>Back to Home</small></a>


                </form>

                <br>


            </div>
            
            </div>

            
        </div>
        
    </div>
</div>
</div>


<!--For Mobile-->
<div class="mob-view">
<div style="background-image:url('<?php echo base_url('inc/img/plutinos/BG-01-MB.jpg')?>');background-repeat:no-repeat;background-size:auto 100%;min-height:700px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-xs-12 col-sm-12 col-lg-12">
            <div style="background:rgba(255,255,255,0.4);">
                <p id="demo_mb2" style="color:white;font-family: 'Exo', sans-serif;line-height:1.75;text-align:center;margin:15% 0 10px 0; font-size:20px;letter-spacing:2px;font-weight:300">1,473 miles (2,370 kms)</p>
            </div>
            <br>
            <h1 style="color:white;font-family: 'Exo', sans-serif;text-align:center;text-transform:uppercase;letter-spacing:4px">Plutino's</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-xs-12 col-sm-12 col-lg-12">
            <div style="margin-top:20%;color:#d9d9d9;text-align:center">
                <form method="post" action="<?= base_url('member/p_feed_mb')?>">
                    <small>What do you think about our website</small>
                    <br>
                    <select name="opt_mark_mb" style="width:100%;height:40px;background:rgba(0,0,0,0.5);color:white">
                        <option value="5">Awesome</option>
                        <option value="4">Good</option>
                        <option value="3">Neutral</option>
                        <option value="2">Bad</option>
                    </select>
                    <br><br>
                    <small>Do you think our website helpful?</small>
                    <br>
                    <select name="opt_help_mb" style="width:100%;height:40px;background:rgba(0,0,0,0.5);color:white">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                    <br><br>
                    <small>Write down your throughts.</small>
                    <br>
                    <textarea name="txtcomment_mb" style="width:100%;background:rgba(0,0,0,0.5);color:white"></textarea>
                    

                    <!--input type="text" name="txtnamer_mb" placeholder="New Username" style="font-size:12px;letter-spacing:0.3em;text-align:center;background: linear-gradient(to bottom, rgba(255, 250, 225, 0.2), rgba(255, 250, 225, 0.2));border:none;width:80%;border-radius:5px;padding:10px 10px;color:white" required>
                    <br><br>
                    <input type="password" name="txtpasswordr_mb" placeholder="New Password" style="font-size:12px;letter-spacing:0.2em;text-align:center;background: linear-gradient(to bottom, rgba(255, 250, 225, 0.2), rgba(255, 250, 225, 0.2));border:none;width:80%;border-radius:5px;padding:10px 10px;color:white" required-->

                    <br><br><br>
                    <button type="submit" style="width:auto;background:rgba(255,255,255,0.8);border:none;border-radius:30px;padding:10px 30px;letter-spacing:1.75px"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-slack" viewBox="0 0 16 16">
  <path d="M3.362 10.11c0 .926-.756 1.681-1.681 1.681S0 11.036 0 10.111C0 9.186.756 8.43 1.68 8.43h1.682v1.68zm.846 0c0-.924.756-1.68 1.681-1.68s1.681.756 1.681 1.68v4.21c0 .924-.756 1.68-1.68 1.68a1.685 1.685 0 0 1-1.682-1.68v-4.21zM5.89 3.362c-.926 0-1.682-.756-1.682-1.681S4.964 0 5.89 0s1.68.756 1.68 1.68v1.682H5.89zm0 .846c.924 0 1.68.756 1.68 1.681S6.814 7.57 5.89 7.57H1.68C.757 7.57 0 6.814 0 5.89c0-.926.756-1.682 1.68-1.682h4.21zm6.749 1.682c0-.926.755-1.682 1.68-1.682.925 0 1.681.756 1.681 1.681s-.756 1.681-1.68 1.681h-1.681V5.89zm-.848 0c0 .924-.755 1.68-1.68 1.68A1.685 1.685 0 0 1 8.43 5.89V1.68C8.43.757 9.186 0 10.11 0c.926 0 1.681.756 1.681 1.68v4.21zm-1.681 6.748c.926 0 1.682.756 1.682 1.681S11.036 16 10.11 16s-1.681-.756-1.681-1.68v-1.682h1.68zm0-.847c-.924 0-1.68-.755-1.68-1.68 0-.925.756-1.681 1.68-1.681h4.21c.924 0 1.68.756 1.68 1.68 0 .926-.756 1.681-1.68 1.681h-4.21z"/>
</svg> &nbsp;Submit</button>
                    <br><br>
                    <a href="<?=base_url('member')?>" style="color:white"><small>Back to Home</small></a>

                </form>
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
var countDownDate = new Date("Mar 16, 2021 00:00:00").getTime();

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
  //document.getElementById("demo").innerHTML = days + "d " + hours + "h "
  //+ minutes + "m " + seconds + "s ";
  
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
</script>


</body>



</html>

