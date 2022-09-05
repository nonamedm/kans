<?
	include_once('./_common.php');

	//화면의 성격
	$user_division = "user";	$screen_div = "sub"; //main, sub	$frame_div = "two";  //one, two

	//카테고리/페이지/상세페이지 명칭 & 카테고리 번호
	$cate_num = "1";		$page_num = "1";		$spage_num = "1";	$sspage_num = "1";  

	//현재 활성화 상태
	$gn_btn = "gn_btn".$cate_num;			$$gn_btn = "current";
	$ln_btn = "ln_btn".$page_num;				$$ln_btn = "current";
	$sln_btn = "sln_btn".$spage_num;			$$sln_btn = "current";
	$ssln_btn = "ssln_btn".$sspage_num;		$$ssln_btn = "current";

	include_once(G5_THEME_PATH.'/head.php');
?>

<section class="s01 s<?=$cate_num;?>0<?=$page_num;?> s<?=$cate_num;?><?=$page_num;?><?=$spage_num;?><?=$sspage_num;?> clear ct1">
	<!-- <h2 class="tit_bg">방사선작업종사자 직장교육</h2> -->
	<div class="cnt_box">
		<article class="arti1 clear">
			<h3 class="tit_h3">관련법령</h3>
			<ul class="fiex_box col3">
				<li>
					<h4 class="bg_blue">법률</h4>
					<div class="tbx">
						<p>원자력안전법 제106조</p>
						<a href="https://www.law.go.kr/LSW/lsSideInfoP.do?lsiSeq=204230&joBrNo=00&urlMode=lsScJoRltInfoR&docCls=jo&joNo=0106" target="blank" class="bg_blue"><img src="<? echo G5_THEME_URL ?>/images/sub/s1111_1.png" /></a>
					</div>
				</li>
				<li>
					<h4 class="bg_sky">시행령</h4>
					<div class="tbx">
						<p>원자력안전법 시행령 제148조</p>
						<a href="https://www.law.go.kr/LSW/lsSideInfoP.do?lsiSeq=207737&urlMode=lsScJoRltInfoR&joNo=0148&joBrNo=00&docCls=jo
" target="blank" class="bg_sky"><img src="<? echo G5_THEME_URL ?>/images/sub/s1111_1.png" /></a>
					</div>
				</li>
				<li>
					<h4 class="bg_green">시행규칙</h4>
					<div class="tbx">
						<p>원자력안전법 시행규칙 제138조</p>
						<a href="https://www.law.go.kr/LSW/lsSideInfoP.do?lsiSeq=207856&joBrNo=00&urlMode=lsScJoRltInfoR&docCls=jo&joNo=0138
" target="blank" class="bg_green"><img src="<? echo G5_THEME_URL ?>/images/sub/s1111_1.png" /></a>
					</div>
				</li>
			</ul>
		</article>
		
		<article class="arti2 clear">
			<h3 class="tit_h3">대상</h3>
			<ul class="dot_ul">
				<li>일반분야(산업·의료·교육연구) 또는 방사선투과검사분야의 방사선취급업무에 종사하는 <b>방사선작업종사자</b>(방사선안전관리자 제외)</li>
				<li><b>수시출입자</b></li>
			</ul>

			<h3 class="tit_h3">내용</h3>
			<ul class="dot_ul">
				<li>이용 업체의 방사선안전관리규정</li>
				<li>이용 업체의 방사선원 및 방사선 장비의 특성</li>
				<li>그 밖에 이용업체 특성에 따른 교육</li>
			</ul>

			<h3 class="tit_h3">교육방법</h3>
			<ul class="dot_ul">
				<li>일반과 방사선투과검사 분야로 구분</li>
				<li>일반분야 정기 교육은 업종별 맞춤교육(산업, 의료, 교육연구)</li>
				<li>수강 편의를 위해 기본교육(원자력안전재단)과 연계하여 일정 운영 </li>
			</ul>

			<h3 class="tit_h3">교육시간 및 교육비</h3>
			<table class="table_nomal">
				<thead>
				<tr>
					<th rowspan="2">구분</th>
					<th colspan="3">일반</th>
					<th colspan="3">방사선투과검사</th>
				</tr>
				<tr class="bg2">
					<th>신규</th>
					<th>정기</th>
					<th>수시</th>
					<th>신규</th>
					<th>정기</th>
					<th>수시</th>
				</tr>
				</thead>
				<tr>
					<td>교육시간</td>
					<td>종사 전 4시간 이상</td>
					<td>매년 3시간 이상</td>
					<td>매년 3시간 이상</td>
					<td>종사 전 6시간 이상</td>
					<td>매년 5시간 이상</td>
					<td>매년 5시간이상 </td>
				</tr>
				<tr>
					<td>교육비</td>
					<td>30,000</td>
					<td>25,000</td>
					<td>25,000</td>
					<td>47,000</td>
					<td>40,000</td>
					<td>40,000</td>
				</tr>
			</table>
			<p class="color_sky">※ 집합교육 참석시 신분증 지참 필수</p>
		<h3 class="tit_h3">현재는 코로나로 인하여 온라인 교육을 시행하고 있습니다.</h3>
			<div class="link_box_ty1"><a href="https://www.kanselearning.kr"target="_blank"class="link_a">온라인 교육장 바로가기 <span><img src="<? echo G5_THEME_URL ?>/images/sub/s1111_2.png" /></span></a></div>
	</div>
</section>

<?php include_once(G5_THEME_PATH.'/tail.php'); ?>