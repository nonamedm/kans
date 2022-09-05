<?
	//화면의 성격
	$user_division = "user";
	$screen_div = "main";
	$frame_div = "one";

	//카테고리 명칭 & 카테고리 번호
	$cate_name = "";
	$cate_num = "";

	//페이지 명칭 & 페이지 번호
	$page_name = "";
	$page_num = "";

	//현재 활성화 상태
	$gn_btn = "gn_btn".$cate_num;
	$$gn_btn = "current";
	$ln_btn = "ln_btn".$page_num;
	$$ln_btn = "current";

?>
<?
	include_once('./_common.php');
	define("_INDEX_", TRUE);
	include_once(G5_THEME_MSHOP_PATH.'/shop.head.php');
	add_javascript('<script src="'.G5_THEME_JS_URL.'/Ublue-jQueryTabs-1.2.js"></script>', 10);
?>
<script src="<?php echo G5_JS_URL; ?>/shop.mobile.main.js"></script>
	<div id="main_visual_1" class="inbox">
		<script type="text/javascript" src="<?php echo G5_THEME_JS_URL;?>/jquery.bxslider.min.js"></script>
		<link rel="stylesheet" href="<?php echo G5_THEME_CSS_URL;?>/jquery.bxslider.css">
		<ul class="main_visual_box">
			<li class="">dd</li>
			<li class="">dd</li>
			<li class="">dd</li>
			<li class="">dd</li>
		</ul>
		<script type="text/javascript">
			<!--
				var slider = $('.main_visual_box').bxSlider({
					mode:'fade',
					speed:2000,
					auto: true,
					captions: false,
					autoControls: true,
					pager : true,
					touchEnabled : true,
					loop : true,
					onSlideAfter:function(){
						slider.stopAuto();
						slider.startAuto();
					}
				});
			//-->
		</script>
	</div>
	<div id="main_visual_2" class="inbox">
		비쥬얼 2
	</div>
	<div id="main_visual_3" class="inbox">
		비쥬얼 3
	</div>
	<div id="main_visual_4" class="inbox">
		비쥬얼 4
	</div>
	<div id="main_visual_5" class="inbox">
		비쥬얼 5
	</div>
	<div id="main_visual_6" class="inbox">
		비쥬얼 6
	</div>
	<div id="main_visual_7" class="inbox">
		비쥬얼 7
	</div>
	<div id="main_visual_8" class="inbox">
		비쥬얼 8
	</div>
<?include_once(G5_THEME_MSHOP_PATH.'/shop.tail.php');?>