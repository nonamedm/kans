<?
	include_once('./_common.php');

	//화면의 성격
	$user_division = "user";
	$screen_div = "sub"; //main, sub
	$frame_div = "one";  //one, two

	//카테고리/페이지/상세페이지 명칭 & 카테고리 번호
	$cate_num = "3";

	$page_num = "1";


	//현재 활성화 상태
	$gn_btn = "gn_btn".$cate_num;
	$$gn_btn = "current";

	$ln_btn = "ln_btn".$page_num;
	$$ln_btn = "current";


	include_once(G5_THEME_PATH.'/head.php');
?>
<section class="s<?=$cate_num;?> s<?=$cate_num;?>_<?=$page_num;?>">
</section>

<?include("./cal.php");?>
<?php include_once(G5_THEME_PATH.'/tail.php'); ?>