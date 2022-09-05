
function Size_pc(){
	
}
function Size_mobile(){
	$('.section1').addClass('active');
	$('.section2').addClass('active');
	$('.section3').addClass('active');
	$('.section4').addClass('active');
	$('.section1').addClass('active');

	$('.header ').addClass('m');
	$(".btn_mo_menu").click(function(){
		$(this).toggleClass('on');
		if($(this).hasClass('on')){
			$('.gnb').addClass('m');
			$('.gnb').fadeIn();
		}else{
			$('.gnb').removeClass('m');
			$('.gnb').hide();
		};
	});

	$(".gnb > li").click(function(){
		$(this).toggleClass('on');
		if ($(this).hasClass('on')){
			$(this).find(".subm").stop().slideDown();
		} else {
			$(".gnb > li").find(".subm").stop().slideUp();
		};
	});
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
		$(".gnb > li").off("mouseenter");
		
		Size_pc();
	}else{
		$(".btn_mo_menu").off("click");
		$(".gnb > li > a").off("click");
		$('.section1').addClass('active');
		$('.s0104 .section2 ').addClass('active');
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
		$(".header").addClass("sc");
		$('#m_header').addClass("sc");

	} else {
		$(".header").removeClass("sc");
		$('#m_header').removeClass("sc");
	}
});

$(window).scroll(function(){
	var wah = $(this).scrollTop();
	if (300 < wah){
		$(".top_bt").addClass("sc");
	

	} else {
		$(".top_bt").removeClass("sc");

	}
});






