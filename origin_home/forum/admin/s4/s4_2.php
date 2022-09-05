<?
	include_once('./_common.php');

	//화면의 성격
	$user_division = "user";	$screen_div = "sub"; //main, sub	$frame_div = "two";  //one, two

	//카테고리/페이지/상세페이지 명칭 & 카테고리 번호
	$cate_num = "4";	$page_num = "2"; //$spage_num = "1"; 

	//현재 활성화 상태
	$gn_btn = "gn_btn".$cate_num;		$$gn_btn = "current";
	$ln_btn = "ln_btn".$page_num;		$$ln_btn = "current";
	$sln_btn = "sln_btn".$spage_num;		$$sln_btn = "current";

	include_once(G5_THEME_PATH.'/head.php');
?>

<section class="s04 s<?=$cate_num;?>0<?=$page_num;?> s<?=$cate_num;?><?=$page_num;?><?=$spage_num;?><?=$sspage_num;?> clear ct1">
	<div class="cnt_box">
		<article class="arti1">
			<figure><img src="<? echo G5_THEME_URL ?>/images/sub/s402_1.jpg" /></figure>
		</article>
		<article class="arti2">
			<h3 class="tit_h3">회원사</h3>
			<ul class="col4 clear">
				<li><img src="<? echo G5_THEME_URL ?>/images/sub/s402_2.jpg" /><h4> </h4></li>
				<li><img src="<? echo G5_THEME_URL ?>/images/sub/s402_3.jpg" /><h4> </h4></li>
				<li><img src="<? echo G5_THEME_URL ?>/images/sub/s402_4.jpg" /><h4> </h4></li>
				<li><img src="<? echo G5_THEME_URL ?>/images/sub/s402_5.jpg" /><h4> </h4></li>

				<li><img src="<? echo G5_THEME_URL ?>/images/sub/s402_6.jpg" /><h4> </h4></li>
				<li><img src="<? echo G5_THEME_URL ?>/images/sub/s402_7.jpg" /><h4> </h4></li>
				<!-- <li><img src="<? echo G5_THEME_URL ?>/images/sub/s402_8.jpg" /><h4>한국원자력안전재단</h4></li> -->
				<li><img src="<? echo G5_THEME_URL ?>/images/sub/s402_9.jpg" /><h4> </h4></li>

				<!-- <li><li><img src="<? echo G5_THEME_URL ?>/images/sub/s402_10.jpg" /><h4>한전원자력연료(주)</h4></li> -->
				<li><img src="<? echo G5_THEME_URL ?>/images/sub/s402_11.jpg" /><h4> </h4></li>
				<li><img src="<? echo G5_THEME_URL ?>/images/sub/s402_12.jpg" /><h4> </h4></li>
				<li><img src="<? echo G5_THEME_URL ?>/images/sub/s402_13.jpg" /><h4> </h4></li>

				<!-- <li><img src="<? echo G5_THEME_URL ?>/images/sub/s402_14.jpg" /><h4> </h4></li> -->
				<!-- <li><img src="<? echo G5_THEME_URL ?>/images/sub/s402_15.jpg" /><h4>(주)유엠아이</h4></li> -->
				<li><img src="<? echo G5_THEME_URL ?>/images/sub/s402_16.jpg" /><h4> </h4></li>
				<li><img src="<? echo G5_THEME_URL ?>/images/sub/s402_17.jpg" /><h4> </h4></li>
				<li><img src="<? echo G5_THEME_URL ?>/images/sub/s402_18.jpg" /><h4> </h4></li>

				<li><img src="<? echo G5_THEME_URL ?>/images/sub/s402_19.jpg" /><h4> </h4></li>
				<li><img src="<? echo G5_THEME_URL ?>/images/sub/s402_26.jpg" /><h4> </h4></li>
				<li><img src="<? echo G5_THEME_URL ?>/images/sub/s402_20.jpg" /><h4> </h4></li>
				<li><img src="<? echo G5_THEME_URL ?>/images/sub/s402_21.jpg" /><h4> </h4></li>

				<li><img src="<? echo G5_THEME_URL ?>/images/sub/s402_22.jpg" /><h4> </h4></li>
        <li><img src="<? echo G5_THEME_URL ?>/images/sub/s402_23.jpg" /><h4> </h4></li>
        <li><img src="<? echo G5_THEME_URL ?>/images/sub/s402_24.jpg" /><h4> </h4></li>
        <li><img src="<? echo G5_THEME_URL ?>/images/sub/s402_25.jpg" /><h4> </h4></li>

			</ul>
		</article>
	</div>
</section>

<?php include_once(G5_THEME_PATH.'/tail.php'); ?>