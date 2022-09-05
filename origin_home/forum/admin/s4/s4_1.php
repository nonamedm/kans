<?
	include_once('./_common.php');

	//화면의 성격
	$user_division = "user";	$screen_div = "sub"; //main, sub	$frame_div = "two";  //one, two

	//카테고리/페이지/상세페이지 명칭 & 카테고리 번호
	$cate_num = "4";	$page_num = "1"; //$spage_num = "1"; 

	//현재 활성화 상태
	$gn_btn = "gn_btn".$cate_num;		$$gn_btn = "current";
	$ln_btn = "ln_btn".$page_num;		$$ln_btn = "current";
	$sln_btn = "sln_btn".$spage_num;		$$sln_btn = "current";

	include_once(G5_THEME_PATH.'/head.php');
?>

<section class="s04 s<?=$cate_num;?>0<?=$page_num;?> s<?=$cate_num;?><?=$page_num;?><?=$spage_num;?><?=$sspage_num;?> clear ct1">
	<div class="cnt_box">
		<article class="arti1">
			<h3 class="tit_h3">한국원자력안전아카데미 정회원 구분</h3>
			<ul class="dot_ul">
				<li>개인회원 : 일반 / 평생</li>
				<li>단체회원 : 원자력관련 연구 , 공공기관, 산업체, 학회, 협회, 교육기관 등</li>
			</ul>
		</article>
		<article class="arti2">
			<h3 class="tit_h3">정회원 가입 안내</h3>
			<ul class="bg_col4 clear">
				<li>회원가입 문의</li>
				<li>신청서 제출</li>
				<li>회비 납부</li>
				<li>가입완료</li>
			</ul>
			<div class="link_box_ty1">
				<a href="<? echo G5_THEME_URL ?>/images/template/kans_down_file1.hwp" target="blank" class="link_a" style="width: 320px; margin-top: 43px;">입회원서
					<span><img src="<? echo G5_THEME_URL ?>/images/sub/s1111_2.png" /></span>
				</a>
			</div>
			<div class="b_box">
				<!-- <div class="link_box_ty1"><a href="" class="s4_link_a">회원 가입 문의</a></div> -->
				<p class="robo" style="margin-top: 50px;">
					<span><b>Tel</b> : 02-554-7330</span>
					<span><b>E-mail</b> : kans2@kans.re.kr </span>
				</p>
			</div>	
		</article>
		<article class="arti3">
			<h3 class="tit_h3">정회원 혜택</h3>
			<ul class="s401_col3 clear">
				<li>
					<div class="cnt">
						<figure><img src="<? echo G5_THEME_URL ?>/images/sub/s401_01.jpg" /></figure>
						<p>각종 세미나 및 간담회 등<br>참여 기회 제공</p>
					</div>	
				</li>
				<li>
					<div class="cnt">
						<figure><img src="<? echo G5_THEME_URL ?>/images/sub/s401_02.jpg" /></figure>
						<p>전문교육 및 행사 참가비<br>10% 할인</p>
					</div>	
				</li>
				<li>
					<div class="cnt">
						<figure><img src="<? echo G5_THEME_URL ?>/images/sub/s401_03.jpg" /></figure>
						<p>정기 간행물 등<br>자료 제공</p>
					</div>	
				</li>
			</ul>
		</article>

		<article class="arti4">
			<h3 class="tit_h3">회비 안내</h3>
			<table class="table_nomal">
				<colgroup>
					<col width="12%"> 
					<col width="12%"> 
					<col width="12%"> 
					<col width="20%"> 
					<col width="*"> 
				</colgroup>
				<thead>
				<tr>
					<th colspan="3">구분</th>
					<th>연회비</th>
					<th>적용기준</th>
				</tr>
				</thead>
				<tr>
					<td rowspan="5">정회원</td>
					<td rowspan="3">단체회원</td>
					<td>1급</td>
					<td>5,000,000원 이상</td>
					<td class="ta_l">
						원자력관련 산업체, 공공기관 등<br>
						원전 운영, 설계, 건설, 기기 제작 업소<br>
						핵연료 제조가공업체<br>
						방사성폐기물처분장 운영기관<br>
						원자력연구기관(정부출연)<br>
						원자력안전규제기관(정부출연)<br>
						원전보수용역 전문업체 <br>
						기타 1급 단체회원 가입 찬동 업체
					</td>
				</tr>
				<tr>
					<td>2급</td>
					<td>1,000,000원 이상</td>
					<td class="ta_l">
						원자력홍보관련단체<br>
						대단위 방사선원 이용 기업체<br>
						기타 2급 단체회원가입 찬동업체
					</td>
				</tr>
				<tr>
					<td>3급</td>
					<td>300,000원 이상</td>
					<td class="ta_l">방사성동위원소 및 방사선 이용기관</td>
				</tr>
				<tr>
					<td rowspan="2">개인회원</td>
					<td>일반</td>
					<td>40,000원</td>
					<td class="ta_l">일반회원</td>
				</tr>
				<tr>
					<td>평생</td>
					<td>400,000원 </td>
					<td class="ta_l">1회 납부로 회비 납무 의무 면제</td>
				</tr>
			</table>
		</article>
		<article class="arti5 mt100">
			<h3 class="tit_h3">입금계좌</h3>
			<div class="bd_box">
				<p><span><img src="<? echo G5_THEME_URL ?>/images/sub/s401_04.jpg" /></span><b>한국씨티은행 :</b> 186-00007-243 (사)한국원자력안전아카데미 </p>
			</div>
		</article>
	</div>
</section>

<?php include_once(G5_THEME_PATH.'/tail.php'); ?>