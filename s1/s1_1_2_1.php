<?
	include_once('./_common.php');

	//화면의 성격
	$user_division = "user";	$screen_div = "sub"; //main, sub	$frame_div = "two";  //one, two

	//카테고리/페이지/상세페이지 명칭 & 카테고리 번호
	$cate_num = "1";		$page_num = "1";		$spage_num = "2";	$sspage_num = "1";  

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
			<p class="color_sky">※ 아래 일정 및 교육 내용은 변경될 수 있습니다.</p>		
			<h3 class="tit_h3">방사선안전관리 실무과정</h3>
		</article>
		<article class="arti2 s112_col2 clear">
			<div class="lbx">
				<dl>
					<dt><span>일정</span></dt>
					<dd>
						<ul>
							<li>- 2022.07.14(목) 13:00~18:00</li>
							<li>- 2022.07.15(금) 09:00~12:00</li>
						</ul>
					</dd>
				</dl>
			</div>
			<div class="rbx">
				<dl>
					<dt><span>장소</span></dt>
					<dd><p>KANS 교육장(가락시장역)</p></dd>
				</dl>
			</div>
		</article>
		
		<article class="arti3">
			<ul class="s112_list">
				<li><span>내용</span> 
					정기검사 준비 및 수검, 종사자관리(교육, 건강검진, 피폭관리 등 전 과정), 방사선안전관리규정 작성, 선원 및 장비 관리, 방사성폐기물 관리 등 관련 사항
				</li>
				<li><span>강사</span> 관련 전문가</li>
				<li><span>교육비</span> 200,000원</li>
			</ul>
		</article>
		
		<h3 class="tit_h3 mt100">LSC 측정 실무 및 방사성폐기물 자체처분 과정</h3>
		<article class="arti4 s112_col2 clear">
			<div class="lbx">
				<dl>
					<dt><span>일정</span></dt>
					<dd>
						<ul>
							<li>- 2022.08.18(목) 13:00~18:00</li>
							<li>- 2022.08.19(금) 09:00~12:00</li>
						</ul>
					</dd>
				</dl>
			</div>
			<div class="rbx">
				<dl>
					<dt><span>장소</span></dt>
					<dd><p>KANS 교육장(가락시장역)</p></dd>
				</dl>
		</article>

		<article class="arti5">
			<ul class="s112_list">
				<li><span>내용</span> 
					LSC 분석이론, LSC 측정 및 분석 실습, 방사성폐기물 관리체계 및 실무 이해, 방사성폐기물 자체처분 계획서 작성 실무
				</li>
				<li><span>강사</span> 관련 전문가</li>
				<li><span>교육비</span> 200,000원</li>
			</ul>
		</article>
<br><br>
		<article class="arti8 clear">
			<h3 class="tit_h3">접수방법</h3>
			<ul class="dot_ul">
				<li>신청서 작성 후 이메일(kans1@kans.re.kr) 제출</li>
			</ul>

			<div class="link_box_ty1" ><a href="<? echo G5_THEME_URL ?>/images/sub/2022junmoon.hwp" target="blank" class="link_a" style="margin-top: 93px;">전문강좌신청서 다운로드 <span><img src="<? echo G5_THEME_URL ?>/images/sub/s1111_2.png" /></span></a></div>
      </div>
		</article>
	
	</div>
</section>

<?php include_once(G5_THEME_PATH.'/tail.php'); ?>