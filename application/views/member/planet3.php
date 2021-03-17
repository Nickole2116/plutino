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
<div style="background-image:url('<?php echo base_url('inc/img/Huya-main.webp')?>');background-repeat:no-repeat;background-size:100%;min-height:990px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6 col-xs-6 col-sm-6 col-lg-6" style="text-align:left;background:rgba(0,0,0,0.3);">

                <div style="padding:40px 20px;">
                    <span>Hello, <?= $user[0]['members_username']?> ( <b style="color:#ffd171">Ast. #<?= $user[0]['ast_no']?></b> ) </span>
                </div>
                
            </div>
            <div class="col-6 col-xs-6 col-sm-6 col-lg-6" style="text-align:right;background:rgba(0,0,0,0.3);">

                <div style="cursor:pointer;padding-left:1.5em;padding-top:1.5em;color:white">
                    <a href="<? echo base_url('member');?>" style="color:white"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cursor" viewBox="0 0 16 16">
                    <path d="M14.082 2.182a.5.5 0 0 1 .103.557L8.528 15.467a.5.5 0 0 1-.917-.007L5.57 10.694.803 8.652a.5.5 0 0 1-.006-.916l12.728-5.657a.5.5 0 0 1 .556.103zM2.25 8.184l3.897 1.67a.5.5 0 0 1 .262.263l1.67 3.897L12.743 3.52 2.25 8.184z"/>
                    </svg>&nbsp;&nbsp; <small>Home</small></a>&nbsp;&nbsp;
                    <a href="<? echo base_url('member/category');?>" style="color:white"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="white" class="bi bi-binoculars-fill" viewBox="0 0 16 16">
                    <path d="M4.5 1A1.5 1.5 0 0 0 3 2.5V3h4v-.5A1.5 1.5 0 0 0 5.5 1h-1zM7 4v1h2V4h4v.882a.5.5 0 0 0 .276.447l.895.447A1.5 1.5 0 0 1 15 7.118V13H9v-1.5a.5.5 0 0 1 .146-.354l.854-.853V9.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v.793l.854.853A.5.5 0 0 1 7 11.5V13H1V7.118a1.5 1.5 0 0 1 .83-1.342l.894-.447A.5.5 0 0 0 3 4.882V4h4zM1 14v.5A1.5 1.5 0 0 0 2.5 16h3A1.5 1.5 0 0 0 7 14.5V14H1zm8 0v.5a1.5 1.5 0 0 0 1.5 1.5h3a1.5 1.5 0 0 0 1.5-1.5V14H9zm4-11H9v-.5A1.5 1.5 0 0 1 10.5 1h1A1.5 1.5 0 0 1 13 2.5V3z"/>
                    </svg>&nbsp;&nbsp; <small>Explore</small></a>&nbsp;&nbsp;
                    <a href="<? echo base_url('member/feedback');?>" style="color:white"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-journal-check" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                    <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
                    <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
                    </svg>&nbsp;&nbsp; <small>Feedbacks</small></a>&nbsp;&nbsp;
                    <a href="<? echo base_url('welcome/logout');?>" style="color:white"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="white" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                    </svg>&nbsp;&nbsp; <small>Logout</small></a>&nbsp;&nbsp;
                   

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
<div style="background-image:url('<?php echo base_url('inc/img/astronuat.jpg')?>');background-position:right;background-repeat:no-repeat;background-size:auto 100%;min-height:990px;">
<div class="container-fluid">
        <div class="row">
            <div class="col-12 col-xs-12 col-sm-12 col-lg-12" style="text-align:center;background:rgba(0,0,0,0.3);">
                <div  id="explore_btn" style="cursor:pointer;float:left;padding-left:1.5em;padding-top:1.5em"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-binoculars-fill" viewBox="0 0 16 16">
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
            <div class="col-12 col-xs-12 col-sm-12 col-lg-12" style="display:none" id="nav_mobile">
                <div class="container-fluid">
                    <div class="row" style="text-align:center">
                        <div class="col-3 col-sm-3 col-xs-3 col-lg-3">
                            <a href="<?=base_url('member/planet1')?>"><div><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-file-earmark-zip-fill" viewBox="0 0 16 16">
                                <path d="M5.5 9.438V8.5h1v.938a1 1 0 0 0 .03.243l.4 1.598-.93.62-.93-.62.4-1.598a1 1 0 0 0 .03-.243z"/>
                                <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zm-4-.5V2h-1V1H6v1h1v1H6v1h1v1H6v1h1v1H5.5V6h-1V5h1V4h-1V3h1zm0 4.5h1a1 1 0 0 1 1 1v.938l.4 1.599a1 1 0 0 1-.416 1.074l-.93.62a1 1 0 0 1-1.109 0l-.93-.62a1 1 0 0 1-.415-1.074l.4-1.599V8.5a1 1 0 0 1 1-1z"/>
                                </svg></div>
                            <small>Working</small></a>
                        </div>
                        <div class="col-3 col-sm-3 col-xs-3 col-lg-3">
                        <a href="<?=base_url('member/planet2')?>"><div><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-book-fill" viewBox="0 0 16 16">
                            <path d="M8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                            </svg></div>
                            <small>Students</small></a>
                        </div>
                        <div class="col-3 col-sm-3 col-xs-3 col-lg-3">
                        <a href="<?=base_url('member/planet3')?>"><div ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-flower2" viewBox="0 0 16 16">
                            <path d="M8 16a4 4 0 0 0 4-4 4 4 0 0 0 0-8 4 4 0 0 0-8 0 4 4 0 1 0 0 8 4 4 0 0 0 4 4zm3-12c0 .073-.01.155-.03.247-.544.241-1.091.638-1.598 1.084A2.987 2.987 0 0 0 8 5c-.494 0-.96.12-1.372.331-.507-.446-1.054-.843-1.597-1.084A1.117 1.117 0 0 1 5 4a3 3 0 0 1 6 0zm-.812 6.052A2.99 2.99 0 0 0 11 8a2.99 2.99 0 0 0-.812-2.052c.215-.18.432-.346.647-.487C11.34 5.131 11.732 5 12 5a3 3 0 1 1 0 6c-.268 0-.66-.13-1.165-.461a6.833 6.833 0 0 1-.647-.487zm-3.56.617a3.001 3.001 0 0 0 2.744 0c.507.446 1.054.842 1.598 1.084.02.091.03.174.03.247a3 3 0 1 1-6 0c0-.073.01-.155.03-.247.544-.242 1.091-.638 1.598-1.084zm-.816-4.721A2.99 2.99 0 0 0 5 8c0 .794.308 1.516.812 2.052a6.83 6.83 0 0 1-.647.487C4.66 10.869 4.268 11 4 11a3 3 0 0 1 0-6c.268 0 .66.13 1.165.461.215.141.432.306.647.487zM8 9a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                            </svg></div>
                            <small>Relationship</small></a>
                        </div>
                        <div class="col-3 col-sm-3 col-xs-3 col-lg-3">
                        <a href="<?=base_url('member/planet4')?>"><div><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-award" viewBox="0 0 16 16">
                            <path d="M9.669.864L8 0 6.331.864l-1.858.282-.842 1.68-1.337 1.32L2.6 6l-.306 1.854 1.337 1.32.842 1.68 1.858.282L8 12l1.669-.864 1.858-.282.842-1.68 1.337-1.32L13.4 6l.306-1.854-1.337-1.32-.842-1.68L9.669.864zm1.196 1.193l.684 1.365 1.086 1.072L12.387 6l.248 1.506-1.086 1.072-.684 1.365-1.51.229L8 10.874l-1.355-.702-1.51-.229-.684-1.365-1.086-1.072L3.614 6l-.25-1.506 1.087-1.072.684-1.365 1.51-.229L8 1.126l1.356.702 1.509.229z"/>
                            <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1 4 11.794z"/>
                            </svg></div>
                            <small>Life</small></a>
                        </div>
                    </div>
                    <br>
                </div>
                
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-xs-12 col-sm-12 col-lg-12" style="text-align:center;background:rgba(0,0,0,0.3);">

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
                            <br>
                            <a href="<?php echo base_url('member/feedback');?>">
                                <div style="padding:5px 5px;color:white;border:1px solid white;border-radius:10px">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-journal-check" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                    <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
                    <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
                    </svg> &nbsp;&nbsp;<small>Rate the Website ?</small>
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

<script>

    $('#explore_btn').on('click',function(){
        $('#nav_mobile').toggle();
    });

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