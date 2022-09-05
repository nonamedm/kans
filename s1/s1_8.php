<?
	include_once('./_common.php');

	//화면의 성격
	$user_division = "user";	$screen_div = "sub"; //main, sub	$frame_div = "two";  //one, two

	//카테고리/페이지/상세페이지 명칭 & 카테고리 번호
	$cate_num = "1";	$page_num = "8"; 

	//현재 활성화 상태
	$gn_btn = "gn_btn".$cate_num;		$$gn_btn = "current";
	$ln_btn = "ln_btn".$page_num;		$$ln_btn = "current";
	$sln_btn = "sln_btn".$spage_num;		$$sln_btn = "current";

	include_once(G5_THEME_PATH.'/head.php');
?>

<section class="s01 s<?=$cate_num;?>0<?=$page_num;?> clear ct2">
	<article class="arti1 clear">
		<div class="sb_tit_box ct2">
			<h5>CONTACT US</h5>	
			<h3><?=$page_name;?></h3>
		</div>
	</article>

	<article class="arti1 map clear">
		<!-- * 카카오맵 - 지도퍼가기 -->
<!-- 1. 지도 노드 -->
<div id="daumRoughmapContainer1610005108906" class="root_daum_roughmap root_daum_roughmap_landing"></div>

<!--
	2. 설치 스크립트
	* 지도 퍼가기 서비스를 2개 이상 넣을 경우, 설치 스크립트는 하나만 삽입합니다.
-->
<script charset="UTF-8" class="daum_roughmap_loader_script" src="https://ssl.daumcdn.net/dmaps/map_js_init/roughmapLoader.js"></script>

<!-- 3. 실행 스크립트 -->
<script charset="UTF-8">
	new daum.roughmap.Lander({
		"timestamp" : "1610005108906",
		"key" : "23spm",

	}).render();
</script>
	</article>
	<article class="arti2 map_txt">
		<div class="box clear">
			<ol>
				<li><b>주소</b>경기도 시흥시 엠티브이북로121(정왕동)</li>
				<li><span><b>TEL</b> 031-434-5957</span><span><b>FAX</b>031-434-5951</span></li>
			</ol>
			<ul>
				<li><a href="http://kko.to/bf8o0XdYH" target="_blank"><img src="<? echo G5_THEME_URL ?>/images/template/print_1.png" /></a></li>
				<li><a href="#n" onclick="window.open('./s108_popup.php', 'window', 'top=100,left=100, width=1400,height=400')"><img src="<? echo G5_THEME_URL ?>/images/template/print_2.png" /></a></li>
			</ul>
		</div>
	</article>
</section>



<script>





</script>



<?php include_once(G5_THEME_PATH.'/tail.php'); ?>