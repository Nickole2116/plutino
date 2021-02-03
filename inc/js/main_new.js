$(function(){
	
	onresize();
	$(window).on('load', function(){
		onload();
		onresize();
		$(".loading-page-parent").hide();
	})
	$(window).resize(function(){
		onresize();
	})
	$(window).scroll(function(){
		winscroll();
	})
	$(".overlay-parent,.js-closeoverlay").click(function(){
		$(".overlay-parent,.overlay-close,.overlay-content").stop(true).fadeOut("fast");
	})
    $(".page_blank, .no").click(function(e){
    	$(".loading-parent").show();
	      e.preventDefault();
	      confirmMessageShow(false);
	    
    });
})

function onload(){

	}
	function onresize(){
		winwidth = $(window).innerWidth();
		winheight = window.innerHeight;
		isMob = false;
		$("body").addClass("desktop")
		if($(".visible-xs:not(.visible-sm):visible").length>0){
			isMob = true;
			$("body").removeClass("desktop")
		}
		
		$(".scrollindi-parent").hide();
		$(".table-scrollparent").each(function(){
			if($(this).outerWidth()<$("table",this).outerWidth()){
				$(this).prev().show();
			}
		})
		centerboxFunction();
		

	}
	function winscroll(){
		winTop = $(window).scrollTop();
	}
	
function centerboxFunction(){
	$(".js-centerbox,.confirm_message,.confirm_message_cancel:visible").css({
		left:0,
		top:0,
		marginBottom:0
	})
	$(".js-centerbox,.confirm_message,.confirm_message_cancel:visible").each(function(){
		centerLeft =(winwidth-$(this).outerWidth())/2;
		centerTop =(winheight-$(this).outerHeight())/2;
		if(centerTop<15){
			centerTop = 15;
		}
		$(this).css({
			left:centerLeft,
			top:centerTop,
			marginBottom:centerTop
		})
	
	})
}

function confirmMessageShow(showConfirm = true,dataConfirm=""){
	if(showConfirm){

		if(dataConfirm == ""){
			confirmMsg = $(".confirm_message").not(".js-overlaycontent")
		}else{
			confirmMsg = $(".js-overlaycontent[data-overlay="+dataConfirm+"]");
		}
		console.log(confirmMsg);
		confirmMsg.stop(true).fadeIn(500)
          $(".page_blank").stop(true).animate({opacity: 1}, 500).css("pointer-events","all");
          setTimeout(function(){
	          centerboxFunction()
          },0)
	}else{
		$(".confirm_message").stop(true).fadeOut(500)
      	$(".page_blank").stop(true).animate({
      		opacity: 0
      	}, 500,function(){
      		$(".loading-parent").hide();
      	}).css("pointer-events","none");
  		$(".error_message2").addClass('hidden')

	}
}