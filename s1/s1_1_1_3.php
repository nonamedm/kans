<?
	include_once('./_common.php');

	//화면의 성격
	$user_division = "user";	$screen_div = "sub"; //main, sub	$frame_div = "two";  //one, two

	//카테고리/페이지/상세페이지 명칭 & 카테고리 번호
	$cate_num = "1";		$page_num = "1";		$spage_num = "1";	$sspage_num = "3";  

	//현재 활성화 상태
	$gn_btn = "gn_btn".$cate_num;			$$gn_btn = "current";
	$ln_btn = "ln_btn".$page_num;				$$ln_btn = "current";
	$sln_btn = "sln_btn".$spage_num;			$$sln_btn = "current";
	$ssln_btn = "ssln_btn".$sspage_num;		$$ssln_btn = "current";

	include_once(G5_THEME_PATH.'/head.php');
?>

<section class="s01 s1111 s<?=$cate_num;?>0<?=$page_num;?> s<?=$cate_num;?><?=$page_num;?><?=$spage_num;?><?=$sspage_num;?> clear ct1">
	<!-- <h2 class="tit_bg">방사선작업종사자 직장교육</h2> -->
	<div class="cnt_box">
		<article class="arti1 clear">
			<p class="color_sky">※ 한국원자력안전아카데미는 대한방사선사협회로부터 방사선사 보수교육기관으로 지정받았습니다.</p>
		</article>
		
		<article class="arti2 clear">
			<h3 class="tit_h3">교육시간</h3>
			<ul class="dot_ul">
				<li>3시간 이상(방사선사 보수교육 2시간 인정)</li>
			</ul>

			<h3 class="tit_h3">교육내용</h3>
			<ul class="dot_ul">
				<li>의료 기관 방사선안전관리 및 취급에 관한 사항 등</li>
			</ul>

			<h3 class="tit_h3">교육일정 </h3>
			<ul class="dot_ul">
				<li>아카데미에서 실시하는 모든 방사선작업종사자 직장 교육 및 면허소지자 보수교육 수료시 2시간 인정</li>
			</ul>
			<div class="color_sky">
				<p class="">※ 방사선사 보수교육규정에 따라 외부기관은 보수교육 인정이 연간 2시간으로 제한됨
				<br>- 직장교육과 보수교육 2가지 모두 이수하더라도 1개만 인정</p>
				<p class="">※ 교육신청시 반드시 방사선사 면허번호를 등록해야만 인정 가능</p>
			</div>
		</article>
	</div>
</section>

<?php include_once(G5_THEME_PATH.'/tail.php'); ?>