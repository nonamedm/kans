$(window).load(function(){
	$(".side_ctr li .btn_close_menu").click(function(){
		$(".side_bar").animate({left:'-200'},600,function(){
			$(".side_ctr li:nth-child(1)").hide();
			$(".side_ctr li:nth-child(2)").show();
		});
		$(".cnt_area").animate({marginLeft:'30'},600);
	});

	$(".side_ctr li .btn_open_menu").click(function(){
		$(".side_bar").animate({left:'0'},600,function(){
			$(".side_ctr li:nth-child(1)").show();
			$(".side_ctr li:nth-child(2)").hide();
		});
		$(".cnt_area").animate({marginLeft:'230'},600);
	});
	$(".ln > .sub").bind("click",function(){
		if($(this).children("ul").is(":hidden")==true){
			$(this).addClass("slide_up");
			$(this).children("ul").slideDown();
		}else{
			$(this).removeClass("slide_up");
			$(this).children("ul").slideUp();
		}
	});
});

function iframe_resize(v){
	v.height = v.contentWindow.document.body.scrollHeight;
	if(v.height==150) v.height=700;
	v.width = v.contentWindow.document.body.scrollWidth;
}
function layer(names,src){
	document.getElementById("layer").innerHTML="<iframe src="+src+"  id='layer_frame' onLoad='iframe_resize(this)'  frameborder=0 scrolling=yes></iframe>";
		var w=1382;
		var h=800;
		if(names=="") names="no title";
	$(".layer_popup").dialog({
		resizable : false,
		width : w,
		height : h,
		dialogClass : false,
		modal : false,
		title : "내용관리",
		position : {
			my : "left top",
			at : "left top",
		//	my : "center center",
		//	at : "center center",
			of : window
		},
		open: function(event,ui){
			
		},
		close: function(event,ui){
			//document.getElementById("layer").innerHTML="";
			//location.reload();
		 }
	});
}