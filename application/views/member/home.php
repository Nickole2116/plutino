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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script></head>
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600&display=swap" rel="stylesheet">

<body style="background:#000;color:#fff">
<!--For Web-->
<div class="web-view">
<div style="background-image:url('<?php echo base_url('inc/img/plutinos/BG-01-WB.jpg')?>');background-repeat:no-repeat;background-size:100%;min-height:990px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-xs-12 col-sm-12 col-lg-12" style="text-align:center;background:rgba(0,0,0,0.3);">
                <div style="cursor:pointer;float:left;padding-left:1.5em;padding-top:1.5em"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-binoculars-fill" viewBox="0 0 16 16">
                    <path d="M4.5 1A1.5 1.5 0 0 0 3 2.5V3h4v-.5A1.5 1.5 0 0 0 5.5 1h-1zM7 4v1h2V4h4v.882a.5.5 0 0 0 .276.447l.895.447A1.5 1.5 0 0 1 15 7.118V13H9v-1.5a.5.5 0 0 1 .146-.354l.854-.853V9.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v.793l.854.853A.5.5 0 0 1 7 11.5V13H1V7.118a1.5 1.5 0 0 1 .83-1.342l.894-.447A.5.5 0 0 0 3 4.882V4h4zM1 14v.5A1.5 1.5 0 0 0 2.5 16h3A1.5 1.5 0 0 0 7 14.5V14H1zm8 0v.5a1.5 1.5 0 0 0 1.5 1.5h3a1.5 1.5 0 0 0 1.5-1.5V14H9zm4-11H9v-.5A1.5 1.5 0 0 1 10.5 1h1A1.5 1.5 0 0 1 13 2.5V3z"/>
                    </svg>&nbsp; <br><small>Explore</small>
                </div>
                <a href="<?php echo base_url('welcome/logout')?>"><div style="cursor:pointer;float:right;padding-right:1.5em;padding-top:1.5em"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                    </svg>&nbsp; <br><small>Logout</small>
                </div></a>
                <div style="padding:40px 20px;">
                    <span>Hello, <?= $user[0]['members_username']?> ( <b style="color:#ffd171">Ast. #<?= $user[0]['ast_no']?></b> ) </span>
                </div>
                
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-xs-12 col-sm-12 col-lg-12" style="text-align:center;background:rgba(0,0,0,0.3);">

            <a href="<?php echo base_url('member/posts');?>"><div class="navbar" style="cursor:pointer;z-index:100px;overflow: hidden;position: fixed;bottom: 2em;right:2em;background:#f0f3ff;border-radius:30px;padding:15px"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="black" class="bi bi-pen-fill" viewBox="0 0 16 16">
  <path d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
</svg></div></a>
                
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-xs-12 col-sm-3 col-col-lg-3">
                        </div>
                        <div class="col-12 col-xs-12 col-sm-6 col-col-lg-6">
                            <a href="<?php echo base_url('member/posts');?>">
                                <div style="padding:20px 10px;color:white;border:1px solid white;border-radius:10px">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-pen-fill" viewBox="0 0 16 16">
  <path d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
</svg> &nbsp;&nbsp;Write down your story...
                                </div>
                            </a>
                        </div>
                        <div class="col-12 col-xs-12 col-sm-3 col-col-lg-3">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-12 col-xs-12 col-sm-3 col-col-lg-3">
                        </div>
                        <div class="col-12 col-xs-12 col-sm-6 col-col-lg-6">
                                    <?//echo print_r($list[0]['posts_id']);
                                    for($i=0;$i<count($list);$i++)
                                    {
                                        //echo print_r($list[$i]);
                                        ?>

                            <div style="background:rgba(255,255,255,0.8);border-radius:10px;color:#000;font-family: 'Nunito', sans-serif;">
                                <small><?=$list[$i]['posts_created_date']?></small>
                                <div style="background:#d9d9d9;height:1.5px"></div>
                                <div style="font-family: 'Nunito', sans-serif;font-size:14px;padding:15px"><?=$list[$i]['posts_msg']?>
                                <br><br>
                                <div style="font-family: 'Nunito', sans-serif;font-weight:600"><mark style="border-radius:13px;">&nbsp;From Astronaut #<?=$list[$i]['ast_no']?>&nbsp;</mark></div></div>

                                   

                                 <div class="container-fluid">
                                     <div class="row">
                                         <div class="col-12 col-xs-12 col-sm-12 col-lg-12" style="padding-top:20px;padding-bottom:20px;border-top:1px solid rgba(0,0,0,0.2)">
                                            <button id="btn_<?=$list[$i]['posts_id']?>" onclick="like_post(<?=$list[$i]['posts_id']?>,<?=$list[$i]['likes']?>)" style="border:none;background:rgba(0,0,0,0.4);width:100%;border-radius:15px;color:white">I understand you (<span id="likes_count_<?=$list[$i]['posts_id']?>"><?=$list[$i]['likes']?></span>)</button>
                                         </div>
                                     </div>
                                 </div>

                            </div>
                            <br>


                                        <?
                                    }
                                    ?>
                            
                        </div>
                        <div class="col-12 col-xs-12 col-sm-3 col-col-lg-3">
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
</div>


<!--For Mobile-->
<div class="mob-view">
<div style="background-image:url('<?php echo base_url('inc/img/plutinos/BG-01-MB.jpg')?>');background-repeat:no-repeat;background-size:auto 100%;min-height:990px;">
<div class="container-fluid">
        <div class="row">
            <div class="col-12 col-xs-12 col-sm-12 col-lg-12" style="text-align:center;background:rgba(0,0,0,0.3);">
                <div style="cursor:pointer;float:left;padding-left:1.5em;padding-top:1.5em"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-binoculars-fill" viewBox="0 0 16 16">
                    <path d="M4.5 1A1.5 1.5 0 0 0 3 2.5V3h4v-.5A1.5 1.5 0 0 0 5.5 1h-1zM7 4v1h2V4h4v.882a.5.5 0 0 0 .276.447l.895.447A1.5 1.5 0 0 1 15 7.118V13H9v-1.5a.5.5 0 0 1 .146-.354l.854-.853V9.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v.793l.854.853A.5.5 0 0 1 7 11.5V13H1V7.118a1.5 1.5 0 0 1 .83-1.342l.894-.447A.5.5 0 0 0 3 4.882V4h4zM1 14v.5A1.5 1.5 0 0 0 2.5 16h3A1.5 1.5 0 0 0 7 14.5V14H1zm8 0v.5a1.5 1.5 0 0 0 1.5 1.5h3a1.5 1.5 0 0 0 1.5-1.5V14H9zm4-11H9v-.5A1.5 1.5 0 0 1 10.5 1h1A1.5 1.5 0 0 1 13 2.5V3z"/>
                    </svg>&nbsp; <br><small>Explore</small>
                </div>
                <a href="<?php echo base_url('welcome/logout')?>"><div style="cursor:pointer;float:right;padding-right:1.5em;padding-top:1.5em"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                    </svg>&nbsp; <br><small>Logout</small>
                </div></a>
                <div style="padding:30px 20px;">
                    <span style="font-size:14px">Hello, <?= $user[0]['members_username']?>  <br><small>( <b style="color:#ffd171">Ast. #<?= $user[0]['ast_no']?></b> )</small></span>
                </div>
                
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-xs-12 col-sm-12 col-lg-12" style="text-align:center;background:rgba(0,0,0,0.3);">

            <a href="<?php echo base_url('member/posts');?>"><div class="navbar" style="cursor:pointer;overflow: hidden;position: fixed;bottom: 2em;right:2em;background:#f0f3ff;border-radius:30px;padding:15px"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="black" class="bi bi-pen-fill" viewBox="0 0 16 16">
  <path d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
</svg></div></a>
                
                <div class="container-fluid">
                <div class="row">
                        <div class="col-12 col-xs-12 col-sm-3 col-col-lg-3">
                        </div>
                        <div class="col-12 col-xs-12 col-sm-6 col-col-lg-6">
                            <a href="<?php echo base_url('member/posts');?>">
                                <div style="padding:20px 10px;color:white;border:1px solid white;border-radius:10px">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-pen-fill" viewBox="0 0 16 16">
  <path d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
</svg> &nbsp;&nbsp;Write down your story...
                                </div>
                            </a>
                        </div>
                        <div class="col-12 col-xs-12 col-sm-3 col-col-lg-3">
                        </div>
                    </div>
                    <br>



                    <div class="row">
                        <div class="col-12 col-xs-12 col-sm-3 col-col-lg-3">
                        </div>
                        <div class="col-12 col-xs-12 col-sm-6 col-col-lg-6">
                                    <?//echo print_r($list[0]['posts_id']);
                                    for($i=0;$i<count($list);$i++)
                                    {
                                        //echo print_r($list[$i]);
                                        ?>

                            <div style="background:rgba(255,255,255,0.8);border-radius:10px;color:#000;font-family: 'Nunito', sans-serif;">
                                <small><?=$list[$i]['posts_created_date']?></small>
                                <div style="background:#d9d9d9;height:1.5px"></div>
                                <div style="font-family: 'Nunito', sans-serif;font-size:14px;padding:15px"><?=$list[$i]['posts_msg']?>
                                <br><br>
                                <div style="font-family: 'Nunito', sans-serif;font-weight:600"><mark style="border-radius:13px;">&nbsp;From Astronaut #<?=$list[$i]['ast_no']?>&nbsp;</mark></div></div>

                                   

                                 <div class="container-fluid">
                                     <div class="row">
                                         <div class="col-12 col-xs-12 col-sm-12 col-lg-12" style="padding-top:20px;padding-bottom:20px;border-top:1px solid rgba(0,0,0,0.2)">
                                            <button id="sbtn_<?=$list[$i]['posts_id']?>" onclick="like_post(<?=$list[$i]['posts_id']?>,<?=$list[$i]['likes']?>)" style="border:none;background:rgba(0,0,0,0.4);width:100%;border-radius:15px;color:white">I understand you (<span id="slikes_count_<?=$list[$i]['posts_id']?>"><?=$list[$i]['likes']?></span>)</button>
                                         </div>
                                     </div>
                                 </div>

                            </div>
                            <br>


                                        <?
                                    }
                                    ?>
                            
                        </div>
                        <div class="col-12 col-xs-12 col-sm-3 col-col-lg-3">
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
</div>

<script>

    function like_post(id,count)
    {
        var new_count = count + 1;
        $.post('<?= base_url('member/p_likes')?>', { counts: new_count,pid: id }, 
            function(returnedData){
                if(returnedData == "liked")
                {
                    var btnname = "#btn_"+id;
                    var like_count = "#likes_count_"+id;
                    var sbtnname = "#sbtn_"+id;
                    var slike_count = "#slikes_count_"+id;
                    $(btnname).css('background','#ffd171');
                    $(btnname).css('color','#000');
                    $(like_count).html(new_count);

                    $(sbtnname).css('background','#ffd171');
                    $(sbtnname).css('color','#000');
                    $(slike_count).html(new_count);



                }else
                {


                }
        });
        
    }

//likes_count

</script>

</body>

</html>