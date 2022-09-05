<?
	include_once('./_common.php');

	//화면의 성격
	$user_division = "user";	$screen_div = "sub"; //main, sub	$frame_div = "two";  //one, two

	//카테고리/페이지/상세페이지 명칭 & 카테고리 번호
	$cate_num = "1";		$page_num = "1";		$spage_num = "1";	$sspage_num = "2";  

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
			<h3 class="tit_h3">관련법령</h3>
			<ul class="fiex_box col3">
				<li>
					<h4 class="bg_blue">법률</h4>
					<div class="tbx">
						<p>원자력안전법 제106조</p>
						<a href="https://www.law.go.kr/LSW/lsSideInfoP.do?lsiSeq=204230&joBrNo=00&urlMode=lsScJoRltInfoR&docCls=jo&joNo=0106
" target="blank" class="bg_blue"><img src="<? echo G5_THEME_URL ?>/images/sub/s1111_1.png" /></a>
					</div>
				</li>
				<li>
					<h4 class="bg_sky">시행령</h4>
					<div class="tbx">
						<p>원자력안전법 시행령 제149조</p>
						<a href="https://www.law.go.kr/LSW/lsSideInfoP.do?lsiSeq=207737&urlMode=lsScJoRltInfoR&joNo=0149&joBrNo=00&docCls=jo
" target="blank" class="bg_sky"><img src="<? echo G5_THEME_URL ?>/images/sub/s1111_1.png" /></a>
					</div>
				</li>
				<li>
					<h4 class="bg_green">시행규칙</h4>
					<div class="tbx">
						<p>원자력안전법 시행규칙 제140조</p>
						<a href="https://www.law.go.kr/법령/원자력안전법시행규칙/(20210623,01708,20210623)/제140조" target="blank" class="bg_green"><img src="<? echo G5_THEME_URL ?>/images/sub/s1111_1.png" /></a>
					</div>
				</li>
			</ul>
		</article>
		
		<article class="arti2 clear">
			<h3 class="tit_h3">대상</h3>
			<ul class="dot_ul">
				<li>방사성동위원소취급자 일반면허, 방사성동위원소취급자 특수면허, 방사선취급감독자면허 소지자</li>
				<!-- <li><b>수시출입자</b></li> -->
			</ul>

			<h3 class="tit_h3">내용</h3>
			<ul class="dot_ul">
				<li>원자력관계법령</li> 
				<li>방사선안전취급 및 측정 실무</li>
				<li>방사선안전관리 실무</li>
				<li>사고 사례 분석</li>
				<li>각종 검사 등 규제와 실 사례 고찰</li>
			</ul>

			<h3 class="tit_h3">교육시기</h3>
			<ul class="dot_ul">
				<li>매 3년마다</li>
			</ul>

			<h3 class="tit_h3">교육시간</h3>
			<ul class="dot_ul">
				<li><b>총 12시간 (1일차 : 10:00~17:00, 2일차 10:00~17:00)</b></li>
			</ul>

			<h3 class="tit_h3">교육비용</h3>
			<ul class="dot_ul">
				<li>70,000원</li>
			</ul>

			<div class="color_sky">
				<p class="">※ 교육 참석시 면허수첩 또는 신분증 지참 필수</p>
			
			</div>


			<div class="link_box_ty1"><a href="<?=$s1_2_2_url;?>" class="link_a">교육일정 바로가기 <span><img src="<? echo G5_THEME_URL ?>/images/sub/s1111_2.png" /></span></a></div>
		</article>
	</div>
</section>

<?php include_once(G5_THEME_PATH.'/tail.php'); ?>