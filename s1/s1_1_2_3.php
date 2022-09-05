<?
	include_once('./_common.php');

	//화면의 성격
	$user_division = "user";	$screen_div = "sub"; //main, sub	$frame_div = "two";  //one, two

	//카테고리/페이지/상세페이지 명칭 & 카테고리 번호
	$cate_num = "1";		$page_num = "1";		$spage_num = "2";	$sspage_num = "3";  

	//현재 활성화 상태
	$gn_btn = "gn_btn".$cate_num;			$$gn_btn = "current";
	$ln_btn = "ln_btn".$page_num;				$$ln_btn = "current";
	$sln_btn = "sln_btn".$spage_num;			$$sln_btn = "current";
	$ssln_btn = "ssln_btn".$sspage_num;		$$ssln_btn = "current";

	include_once(G5_THEME_PATH.'/head.php');
?>

<section class="s01 s1111  s<?=$cate_num;?>0<?=$page_num;?> s<?=$cate_num;?><?=$page_num;?><?=$spage_num;?><?=$sspage_num;?> clear ct1">
	<div class="cnt_box">
		<article class="arti1 clear">
			<h3 class="tit_h3">관련법령</h3>
			<ul class="fiex_box col3">
				<li>
					<h4 class="bg_blue">법률</h4>
					<div class="tbx">
						<p>원자력안전법 제84조제2항</p>
						<a href="https://www.law.go.kr/LSW//lsLawLinkInfo.do?lsJoLnkSeq=1009279615&chrClsCd=010202&ancYnChk=0" target="blank" class="bg_blue"><img src="<? echo G5_THEME_URL ?>/images/sub/s1111_1.png" /></a>
					</div>
				</li>
				<li>
					<h4 class="bg_sky">시행령</h4>
					<div class="tbx">
						<p>원자력안전법 시행령 제118조제2항</p>
						<a href="https://www.law.go.kr/LSW//lsLinkProc.do?lsNm=%EC%9B%90%EC%9E%90%EB%A0%A5%EC%95%88%EC%A0%84%EB%B2%95%EC%8B%9C%ED%96%89%EB%A0%B9&lsId=20716&chrClsCd=010201&joNo=011800003&mode=10&gubun=admRul&datClsCd=010102" target="blank" class="bg_sky"><img src="<? echo G5_THEME_URL ?>/images/sub/s1111_1.png" /></a>
					</div>
				</li>
				<li>
					<h4 class="bg_green">시행규칙</h4>
					<div class="tbx">
						<p>원자력안전위윈회 고시 - 제2019-13호 제4조</p>
						<a href="https://www.law.go.kr/LSW//conAdmrulByLsPop.do?&lsiSeq=228965&joNo=0118&joBrNo=00&datClsCd=010102&dguBun=DEG&lnkText=%25EC%259C%2584%25EC%259B%2590%25ED%259A%258C%25EA%25B0%2580%2520%25EC%25A0%2595%25ED%2595%2598%25EC%2597%25AC%2520%25EA%25B3%25A0%25EC%258B%259C%25ED%2595%259C%25EB%258B%25A4&admRulPttninfSeq=152#AJAX" target="blank" class="bg_green"><img src="<? echo G5_THEME_URL ?>/images/sub/s1111_1.png" /></a>
					</div>
				</li>
			</ul>
		</article>

		<article class="arti2 clear">
			<h3 class="tit_h3 mt100">방사성동위원소취급자 일반면허  응시자격</h3>
			<div class="line_box">
				<h5>원자력안전법 시행령 ★★★★★</h5>
				<p>가. 이공계 전문대학 2년 이상 수료자 또는 이와 동등 이상의 학력이 있다고 교육부장관이 인정하는 사람이나 「국가기술자격법」에 따른 산업기사 이상의 자격을<br>
					가진 사람으로서 방사성동위원소등의 취급에 관한 실무에 1년 이상 종사한 사람<br>
					나. 고등학교 졸업자 또는 이와 동등 이상의 학력이 있다고 교육부장관이 인정하는 사람이나  「국가기술자격법」에 따른 기능사 이상의 자격을 가진 사람으로서<br>
					방사성동위원소등의 취급에 관한 실무에 2년 이상 종사한 사람<br>
					다. 외국에서 방사성동위원소취급자일반면허를 받았거나 이에 준하는 자격을 가진 사람으로서 위원회가 인정하는 사람
				</p>
			</div>
		</article>

		<article class="arti3 clear">
			<h3 class="tit_h3 mt100">방사선장해방어의 기초에 관한 통신교육훈련</h3>

			<table class="table_nomal">
				<colgroup>
					<col width="150">
					<col width="*">
				</colgroup>

				<thead>
				<tr>
					<th>구분</th>
					<th>일반</th>
				</tr>
				</thead>
				<tr class="bg2">
					<th>목적</th>

					<td>
						- 방사선전문지식 함양 및 방사선 안전 취급, 관리 능력 향상 도모 <br>
						- 직장인 등 본업이 있는 경우에도 학업 병행 가능
					</td>
				</tr>
				<tr class="bg2">
					<th>특전</th>
					<td>방사선장해방어의 기초에 관한 통신 교육 훈련(9개월 이상) 이수시  <br>방사성동위원소취급자일반면허 응시에 필요한 실무경력 중 1년 인정</td>
				</tr>
			</table>
		</article>

		<article class="arti4 clear">
			<h3 class="tit_h3">대상</h3>
			<ul class="dot_ul">
				<li><b>방사성동위원소취급자일반면허 시험 응시 희망자 및 방사선관련 전문교육 수강 희망자</b></li>
			</ul>
		</article>

		<article class="arti5 clear">
			<h3 class="tit_h3">모집기간</h3>
			<ul class="dot_ul">
				<li>매년 2월 20일까지(선착순 100명)</li>
			</ul>
		</article>

		<article class="arti6 clear">
			<h3 class="tit_h3">교육기간</h3>
			<ul class="dot_ul">
				<li>매년 3월~11월( 9개월) / 수료 12월 중순</li>
			</ul>
		</article>

		<article class="arti7 clear">
			<h3 class="tit_h3">교육과목</h3>
			<ul class="dot_ul">
				<li>원자력기초이론</li>
				<li>방사성동위원소 및 방사선 취급기술에 관한 기초 지식</li>
				<li>방사선장해방어에 관한 기초 지식</li>
				<li>원자력관계법령</li>
			</ul>
		</article>

		<article class="arti8 clear">
			<h3 class="tit_h3">교육방법</h3>
			<ul class="dot_ul">
				<li>과목별 학습서 및 참고자료 기본 제공</li>
				<li><font color=blue>주1회(2시간) 실시간 온라인 강의제공(총 72시간)</font></li>
				<li>과제물 제출 : 3월 ~11월 매월 1회씩 총 9회</li>
				<li>교육기간 중 집합교육 실시(3회 이상)</li>
				<li>교육종료시 아카데미가 지정하는 장소에서 수료시험 실시</li>
			</ul>
		</article>

		<article class="arti8 clear">
			<h3 class="tit_h3">수강료</h3>
			<ul class="dot_ul">
				<li>400,000원</li>
			</ul>
		</article>

		<article class="arti8 clear">
			<h3 class="tit_h3">접수방법</h3>
			<ul class="dot_ul">
				<li>신청서 작성 후 이메일(kans0@kans.re.kr) 제출</li>
			</ul>

			<div class="link_box_ty1" ><a href="<? echo G5_THEME_URL ?>/images/sub/tongsin.hwp" target="blank" class="link_a" style="margin-top: 93px;">통신교육 신청서 다운로드 <span><img src="<? echo G5_THEME_URL ?>/images/sub/s1111_2.png" /></span></a></div>

		</article>



	</div>
</section>

<?php include_once(G5_THEME_PATH.'/tail.php'); ?>