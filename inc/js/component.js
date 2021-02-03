//default elements
//var total_price=0;
//var total_bv=0;
//$( ".datepicker" ).datepicker({ dateFormat: 'dd M yy' });
$('.datepicker').datetimepicker({format:'d M Y', timepicker:false,});
$(".form-control").focus(function(){
  $(this).parents(".form-group").find(".error_message").text("");
});

$(document).ready(function() {
   // JavaScript Document


});

function isNumber(evt) {
  evt = (evt) ? evt : window.event;
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  if (charCode > 31 && (charCode < 48 || charCode > 57)) {
      return false;
  }
  return true;
}

// JavaScript Document

function nowTimer(){
  myTimer();
  var myVar = setInterval(myTimer, 1000);
}

function myTimer() {
  //var datetime = $("input[name=date_time]").val();
  //alert(datetime);
//   var dt = new Date();
  
//  var d = new Date();
// d.setTime( d.getTime() + d.getTimezoneOffset()*60*1000 );

// //alert(d);

//   //alert(dt);
//   var now = dt.getTime();
//   //var formData = $(this).serialize() + '&time=' + now.toString(); // Timestamp
//   var elementDate = $('.date');

//   var months =["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];

//   elementDate.text(dt.getUTCDate() + "/" + months[(dt.getUTCMonth())]  + "/" + dt.getUTCFullYear() + " " + (addZero(dt.getUTCHours()+8)) + ":" + addZero(dt.getUTCMinutes()));

 
  
  //var formData = $(this).serialize() + '&time=' + now.toString(); // Timestamp
  var d = new Date();
  utc = d.getTime() + (d.getTimezoneOffset() * 60000);
  dt = new Date(utc + (3600000*8));

   var elementDate = $('.date');

  var months =["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];

  elementDate.text(dt.getDate() + "/" + months[(dt.getMonth())]  + "/" + dt.getFullYear() + " " + (addZero(dt.getHours())) + ":" + addZero(dt.getMinutes()));

}


function addZero(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}
nowTimer();




// if ($(window).width() < 767) { 
//     $(".slide_menu").appendTo(".slide_menu_responsive");
//     $(".wallet_menu").appendTo(".wallet_menu_responsive");

// }


function display_info() {
    $(".zoom_info").find(".glyphicon").removeClass("glyphicon-indent-right").addClass("glyphicon-indent-left");
    $(".slide_menu").animate({left: "-500px"}, 500);
    //$(".wallet_menu").animate({height: "0px"}, 500);
    $(".main_menu, .page, .footer").animate({width: "100%"}, 500);
    $(this).one("click", hidden_info);
}

function hidden_info() {
    $(".zoom_info").find(".glyphicon").removeClass("glyphicon-indent-left").addClass("glyphicon-indent-right");
    $(".slide_menu").animate({left: "0px"}, 500);
    //$(".wallet_menu").animate({height: "52px"}, 500);
    if ($(window).width() > 940) { 
      $(".main_menu, .page, .footer").animate({width: "85.333%"}, 500);
    }
    else{
       $(".main_menu, .page, .footer").animate({width: "79.333%"}, 500);
    }

   
    $(this).one("click", display_info);
}
$(".zoom_info").one("click", display_info);


// if ($(window).width() < 423) { 
//   function display_info_responsive() {
//     $(".hidden_user_information").animate({height: "315px"}, 500);
//     $(this).one("click", hidden_info_responsive);
//   }

//   function hidden_info_responsive() {
//       $(".hidden_user_information").animate({height: "0px"}, 500);
//       $(this).one("click", display_info_responsive);
//   }
//   $(".user_information_display").one("click", display_info_responsive);
// }
// else{
//   function display_info_responsive() {
//     $(".hidden_user_information").animate({height: "225px"}, 500);
//     $(this).one("click", hidden_info_responsive);
//   }

//   function hidden_info_responsive() {
//       $(".hidden_user_information").animate({height: "0px"}, 500);
//       $(this).one("click", display_info_responsive);
//   }
//   $(".user_information_display").one("click", display_info_responsive);
// }

