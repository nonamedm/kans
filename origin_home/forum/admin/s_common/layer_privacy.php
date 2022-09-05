<?
	include_once('./_common.php');

	//화면의 성격
	$user_division = "user";
	$screen_div = "original"; //main, sub
	$frame_div = "one";  //one, two

	include_once(G5_THEME_PATH.'/head.php');
?>
<section id="" class="layer_box">
	<header>
		<h1 class="">개인정보처리방침</h1>
	</header>
	<article class="layer_cnt">
		<textarea name="" id="" cols="30" rows="28" readonly><?=get_text($config[cf_privacy])?></textarea>
	</article>
</section>
<?php include_once(G5_THEME_PATH.'/tail.php'); ?>