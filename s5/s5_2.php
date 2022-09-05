<?
	include_once('./_common.php');

	//화면의 성격
	$user_division = "user";	$screen_div = "sub"; //main, sub	$frame_div = "two";  //one, two

	//카테고리/페이지/상세페이지 명칭 & 카테고리 번호
	$cate_num = "5";	$page_num = "2"; //$spage_num = "1"; 

	//현재 활성화 상태
	$gn_btn = "gn_btn".$cate_num;		$$gn_btn = "current";
	$ln_btn = "ln_btn".$page_num;		$$ln_btn = "current";
	$sln_btn = "sln_btn".$spage_num;		$$sln_btn = "current";

	include_once(G5_THEME_PATH.'/head.php');
?>

<section class="s05 s<?=$cate_num;?>0<?=$page_num;?> s<?=$cate_num;?><?=$page_num;?><?=$spage_num;?><?=$sspage_num;?> clear ct1">
	<div class="cnt_box">
		<article class="arti1">
			<h3 class="tit_h3">설립목적</h3>
			<div class="gray_box">
				<figure><img src="<? echo G5_THEME_URL ?>/images/sub/s502_1.jpg" /></figure>
				<div class="tbx">
					<p>이 법인은 사회 일반의 이익에 공여하기 위하여 민법 제32조 및 공익법인의 설립 운영에 관한 법률의 규정에 따라  원자력안전에 대한<br>
					국민 이해 증진을 도모하고 안전문화확산에 기여함을 목적으로 한다. (정관 제1조)</p>
				</div>
			</div>
		</article>
		
		<article class="arti2 mt100">
			<h3 class="tit_h3">사업</h3>
			<h4 class="tit_h4">본 아카데미는 그 설립목적을 달성하기 위하여 다음과 같은 사업을 수행한다. (정관 제6조)</h4>

			<div class="flex_box col2">
				<div class="lbx">
					<ul class="flex_dot">
						<li>원자력관계사업자의 안전관리 역량증진 사업</li>
						<li>원자력 및 방사선안전 관련 인력양성 및 전문성 강화 사업</li>
						<li>원자력안전 공동체 구축 및 원자력과 방사선 안전문화확산 사업</li>
						<li>원자력 및 방사선안전분야에 관한 연구개발, 조사·분석 및 정책 연구</li>
						<li>원자력 및 방사선안전분야의 이해를 위한 각종 출판물의 발간</li>
						<li>원자력 및 방사선분야 안전증진을 위한 국내외 기관과의 기술협력</li>
						<li>원자력 및 방사선분야에 관한 국민 이해증진과 안전에 대한 조사, <br>계몽강습회, 세미나 및 교육</li>
					</ul>
				</div>
				<div class="rbx">
					<ul class="flex_dot">
						<li>원자력 및 방사선안전분야에 관한 정보자료의 수집 및 기술자문</li>
						<li>참여와 체험학습을 통한 원자력 및 방사선안전 이해증진 관련사업</li>
						<li>원자력과 방사선안전관련 정부, 유관단체 등으로 부터 위탁되는 수탁사업</li>
						<li>원자력 및 방사선분야 안전증진 관련 필요경비 충당을 위한 부동산 임대</li>
						<li>기타 법인의 목적 달성을 위하여 필요한 사업 및 위 각 호의 부대사업</li>
					</ul>
				</div>
			</div>	
		</article>

		<article class="arti3 mt100">
			<h3 class="tit_h3">임원</h3>
			<ul class="flex_box">
				<li><span>이사장</span><!-- 이헌규 - 전 과학기술부 원자력 국장 --></li>
				<li><span>이사</span>이상복 - (주)가온원자력 전무이사</li>
				<li><span>이사</span>강보선 - 한국연구재단 국책연구본부 원자력단장(이사장 직무대행)</li>
				<li><span>이사</span>이승숙 - 한국원자력의학원 병리과장</li>
				<li><span>이사</span>강영철 - 전 교육과학기술부 원자력국장</li>
				<li><span>이사</span>정동경 - 대구보건대학교 교수</li>
				<!-- <li><span>이사</span>강재열 - 한국원자력산업협회 상근부회장</li> -->
				<li><span>이사</span>한은옥 - 여성원자력전문인협회 부회장</li>
				<li><span>이사</span>김서융 - 대학방사선안전관리협의회장</li>
				<li><span>이사</span>허상국 - 한전KPS(주) 부사장 / 발전안전사업본부장</li>
				<li><span>이사</span>김영덕 - 새한산업(주) 사장</li>
				<!-- <li><span>이사</span>노병철 - 전 과학기술부 원자력 국장</li> -->
				<li><span>이사</span>이광석 - 한국원자력연구원 책임연구원</li>
				<!-- <li><span>이사</span>박태옥 - 전 과학기술부 원자력 국장</li> -->
				<li><span>이사</span>이규영 - (주)소야그린텍 이사</li>

				<li><span>감사</span>손명성 - 대한전기협회 KEPIC 운영처장</li>
				<li><span>감사</span>이상미 - (주)오르비텍 방사선사업본부 방사선판독팀장</li>
			</ul>
		</article>
		<article class="arti4 mt100">
			<h3 class="tit_h3">정관</h3>
			<div class="box">
				<h5>제 1 장 총 칙</h5>
				<p>제 1 조 (목적) 이 법인은 사회 일반의 이익에 공여하기 위하여 민법 제32조 및 공익법인의 설립·운영에 관 한 법률의 규정에 따라 원자력안전에 관한 국민 이해<br>
					증진을 도모하고 안전문화확산에 기여함을 목적으로 한다.<br>
					제 2 조 (명칭) 이 법인은 “사단법인 한국원자력안전아카데미” (Korea Academy of Nuclear Safety-KANS-)라 한다.<br>
					제 3 조 (사무소의 소재지) 이 법인의 사무소는 서울특별시에 둔다.<br>
					제 4 조 (지역사무소 등) 이 법인은 필요시 이사회의 심의와 총회의 의결을 거쳐 지역별 지부 및 부설기관을 둘 수 있다.</p>

				<h5>제 2 장 사 업</h5>
				<p>제 5 조(운영준칙) ① 법인은 제1조의 설립목적을 원활히 달성하기 위하여 노력한다. ② 법인은 민법, 공익법인의 설립 운영에 관한 법률, 이 정관 및 원자력안전위원회가<br>
					부과한 설립허가 조건에 따라 운영한다. ③ 법인의 사업은 출생지 출신학교 직업 근무처 기타 사회적 지위나 법인과의 특수관계 등에 의하여 수혜자의 범위를 제한하지<br>
					아니한다. 다만, 수혜자의 범위를 한정할 경우에는 미리 원자력안전위원회의 승인을 얻어야 한다. <br>
					제 6 조 (사업)  ① 이 법인은 제 1조의 목적을 달성하기 위하여 다음 각 호의 목적사업을 행한다.</p>
				<ul>
					<li>1. 원자력관계사업자의 안전관리 역량증진 사업 </li>
					<li>2. 원자력 및 방사선안전 관련 인력양성 및 전문성 강화 사업</li>
					<li>3. 원자력안전 공동체 구축 및 원자력과 방사선 안전문화확산 사업</li>
					<li>4. 원자력 및 방사선안전분야에 관한 연구개발, 조사·분석 및 정책 연구</li>
					<li>5. 원자력 및 방사선안전분야의 이해를 위한 각종 출판물의 발간</li>
					<li>6. 원자력 및 방사선분야 안전증진을 위한 국내외 기관과의 기술협력</li>
					<li>7. 원자력 및 방사선분야에 관한 국민 이해증진과 안전에 대한 조사, 계몽강습회, 세미나 및 교육</li>
					<li>8. 원자력 및 방사선안전분야에 관한 정보자료의 수집 및 기술자문</li>
					<li>9. 참여와 체험학습을 통한 원자력 및 방사선안전 이해증진 관련사업</li>
					<li>10. 원자력과 방사선안전관련 정부, 유관단체 등으로 부터 위탁되는 수탁사업</li>
					<li>11. 원자력 및 방사선분야 안전증진 관련 필요경비 충당을 위한 부동산 임대</li>
					<li>12. 기타 법인의 목적 달성을 위하여 필요한 사업 및 위 각 호의 부대사업</li>
				</ul>

				<p>② 이 법인은 제 1조의 목적 달성을 위하여 수익사업을 할 때마다 원자력안전위원회의 승인을 받아야 한다. 이를 변경하고자 하는 때에도 또한 같다. </p>
			</div>

			<div class="link_box_ty1"><a href="<? echo G5_THEME_URL ?>/images/sub/jung_file.pdf" target="blank" class="link_a" style="margin-top: 60px;">정관 다운로드 <span><img src="<? echo G5_THEME_URL ?>/images/sub/down_icon.png" /></span></a></div>
		</article>
	</div>
</section>



<?php include_once(G5_THEME_PATH.'/tail.php'); ?>