<?
	include_once('./_common.php');

	//화면의 성격
	$user_division = "user";	$screen_div = "sub"; //main, sub	$frame_div = "two";  //one, two

	//카테고리/페이지/상세페이지 명칭 & 카테고리 번호
	$cate_num = "1";	$page_num = "2"; $spage_num = "2";

	//현재 활성화 상태
	$gn_btn = "gn_btn".$cate_num;		$$gn_btn = "current";
	$ln_btn = "ln_btn".$page_num;		$$ln_btn = "current";

	include_once(G5_THEME_PATH.'/head.php');
?>

<section class="bd_sec">
				

<script src="http://khfa.inpiad.net/js/viewimageresize.js"></script>
<article id="bo_v" style="width:100%" class="respon_v ct1">
	<header>
		<h1 id="bo_v_title">asd</h1>
	</header>
	<section id="bo_v_info">
		<h2>페이지 정보</h2>
		<ul>
			<li>작성자 : <strong><span class="sv_member"></li>
			<li>작성일 : <strong>2019-08-06</strong></li>
			<li>행사일정날짜 : <strong>2019-08-06</strong></li>
		</ul>
	</section>

	<section id="bo_v_atc">
		<h2 id="bo_v_atc_title">본문</h2>
		<div id="bo_v_img">
		
		</div>
		<div id="bo_v_con">
			asdsadasdadssadsa
		</div>
		<div id="bo_v_act">
			<a href="./scrap_popin.php?bo_table=s2_1&amp;wr_id=2" target="_blank" class="btn_b01" onclick="win_scrap(this.href); return false;">스크랩</a>								
		</div>
		</section>
		<div id="bo_v_top" class="btm_btns clear">
			<div class="sort_l">
				<a href="./board.php?bo_table=s2_1&amp;wr_id=1" class="btn_ty btn_ty02">다음글</a>			
			</div>
			<div class="sort_r">
				<a href="./board.php?bo_table=s2_1&amp;page=" class="btn_ty">목록</a>
			</div>
		</div>
</article>
<!-- 게시글 보기 끝 -->
</section>

<style>
	@import url(cal.css);
</style>


<?php include_once(G5_THEME_PATH.'/tail.php'); ?>