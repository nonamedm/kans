function Size_pc(){
	$('.gnb > ul > li').on("mouseenter", function(){
		$('.header .dep2, .hd_2dep_bg').stop().slideUp();
		$('.header .dep2, .hd_2dep_bg').stop().slideDown();
	}).on("mouseleave", function(){
		$('.header .dep2, .hd_2dep_bg').stop().slideUp();
	}); 	 

	$('.hd_sch figure').click(function(){
		$('.hd_sch .cnt').slideToggle();
	});
}

function Size_mobile(){

}



$(window).load(function(){//사이트 최초 접속 시
   var screen_size = $(window).width();
   if(screen_size > 800){
      Size_pc();
      
   }else{
      Size_mobile();
      
      
   }
});

$(window).resize(function(){//사이즈 리사이징 시
   var screen_size = $(window).width();
   if(screen_size > 800){
      Size_pc();
   }else{
      Size_mobile();
   }

 
});

function goBack(){
   window.history.back();
}
$(document).ready(function(){
   $(".btn_back_script").bind("click",function(){
      goBack();
   });

   $('.tit_wrap').addClass('on');
});

function layerpopup2(names,url){
   var names = names;
   var pop_width = $(window).outerWidth();
   var pop_height = $(window).outerHeight();
   if(pop_width >= 600){
      pop_width = 600;
   }else if(pop_width < 600 && pop_width > 480){
      pop_width = $(window).width() - 50;
   }else if(pop_width <= 480){
      pop_width = $(window).width() - 50;
   }
   if(pop_height >= 600){
      pop_height = 400;
   }else if(pop_height < 600 && pop_height > 300){
      pop_height = $(window).height() - 50;
   }else if(pop_height <= 300){
      pop_height = $(window).height() - 50;
   }
   $(".layer_popup").dialog({
      resizable : false,
      width : pop_width,
      height : pop_height,
      dialogClass : false,
      modal : true,
      title : names,
      position : {
         my : "center center",
         at : "center center",
         of : window
      },
      open : function(event, ui){
         $("html").css({overflow : "hidden"});
         document.getElementById("lay_pop").innerHTML="<iframe src="+url+" id='uni_iframe'></iframe>";
      },
      beforeClose : function(event,ui){
         $("html").css({overflow : "inherit"});
      },
      show : {
         effect : "drop",
         duration : 800,
         direction : "up"
      },
      hide : {
         effect : "drop",
         duration : 800,
         direction : "up"
      }
   });
}


function layerpopup(names){
   var names = names;
   var pop_width = $(window).outerWidth();
   var pop_height = $(window).outerHeight();
   if(pop_width >= 600){
      pop_width = 600;
   }else if(pop_width < 600 && pop_width > 480){
      pop_width = $(window).width() - 50;
   }else if(pop_width <= 480){
      pop_width = $(window).width() - 50;
   }
   if(pop_height >= 600){
      pop_height = 400;
   }else if(pop_height < 600 && pop_height > 300){
      pop_height = $(window).height() - 50;
   }else if(pop_height <= 300){
      pop_height = $(window).height() - 50;
   }
   $(".layer_popup").dialog({
      resizable : false,
      width : pop_width,
      height : pop_height,
      dialogClass : false,
      modal : true,
      title : names,
      position : {
         my : "center center",
         at : "center center",
         of : window
      },
      open : function(event, ui){
         $("html").css({overflow : "hidden"});
      },
      beforeClose : function(event,ui){
         $("html").css({overflow : "inherit"});
      },
      show : {
         effect : "drop",
         duration : 800,
         direction : "up"
      },
      hide : {
         effect : "drop",
         duration : 800,
         direction : "up"
      }
   });
}

$(window).scroll(function(){
   var wh = $(this).scrollTop();
   if (0 < wh){
      $('.header').addClass("sc");
   } else {
		$('.header').removeClass("sc");
	//	$('.top_bt').removeClass("sc");
   }
	
    if (130 < wh){
      $('.top_bt').addClass("sc");
   } else {
		$('.top_bt').removeClass("sc");
   }
});

$(function(){
	$('.top_bt').click(function(){
		$('html, body').animate({scrollTop: 0}, 400);
	});
})

//main
$(document).ready(function(){
	$(".mc1_tab > li").bind("click",function(){
		var count = $(this).index()+1;
		$(".mc1_tab > li").removeClass("on");
		$(this).addClass("on");

		$(".tab_con_box .cnt").hide();
		$(".tab_con_box .cnt"+count).addClass('on');
		$(".tab_con_box .cnt"+count).fadeIn();
	});
});



