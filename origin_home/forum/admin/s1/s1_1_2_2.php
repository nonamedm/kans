<?
	include_once('./_common.php');

	//화면의 성격
	$user_division = "user";	$screen_div = "sub"; //main, sub	$frame_div = "two";  //one, two

	//카테고리/페이지/상세페이지 명칭 & 카테고리 번호
	$cate_num = "1";		$page_num = "1";		$spage_num = "2";	$sspage_num = "2";  

	//현재 활성화 상태
	$gn_btn = "gn_btn".$cate_num;			$$gn_btn = "current";
	$ln_btn = "ln_btn".$page_num;				$$ln_btn = "current";
	$sln_btn = "sln_btn".$spage_num;			$$sln_btn = "current";
	$ssln_btn = "ssln_btn".$sspage_num;		$$ssln_btn = "current";

	include_once(G5_THEME_PATH.'/head.php');
?>

<section class="s01 s1121 s<?=$cate_num;?>0<?=$page_num;?> s<?=$cate_num;?><?=$page_num;?><?=$spage_num;?><?=$sspage_num;?> clear ct1">
	<!-- <h2 class="tit_bg">방사선작업종사자 직장교육</h2> -->
	<div class="cnt_box">
		<article class="arti1 clear">
			<p>저희 아카데미에서는 방사선 전문인력 양성에 기여하고자 원자력안전법 제84조(면허 등)제2항제5호의 방사성동위원소취급자 일반면허 및<br>
			제7호의 방사선취급감독자면허 관련 단기강좌를 아래와 같이 실시하오니 많은 참여바랍니다.</p>		
		</article>

		<h3 class="tit_h3"> 일반면허(RI) 시험대비 단기강좌(4일 과정)</h3>
		<article class="arti2 s112_col2 clear">
			<div class="lbx">
				<dl>
					<dt><span>일정</span></dt>
					<dd>
						<ul>
							<li>- 2/12(토) 10:00~17:00</li>
							<li>- 2/13(일) 10:00~17:00</li>
							<li>- 2/19(토) 10:00~17:00</li>
							<li>- 2/20(일) 10:00~17:00</li>
						</ul>
					</dd>
				</dl>
			</div>
			<div class="rbx">
				<dl>
					<dt><span>장소</span></dt>
					<dd><p>실시간 온라인 <br>(비대면 프로그램 이용)</p></dd>
				</dl>
			</div>
		</article>
		
		<article class="arti3">
			<ul class="s112_list">
			  <li><span>대상</span> 방사성동위원소 일반면허 시험 응시 희망자</li>
				<li><span>시험일정</span> 2022년 4월 3일(일)</li>
				<li><span>원서접수</span> 2022년 2월 14일(월)~18일(금)</li>
				<li><span>내용</span> 시험 4과목(원자력이론, 방사선취급기술, 방사선장해방어, 원자력관계법령)</li>
				<li><span>방법</span> 과목별 전문 강사의 핵심이론 강의 및 예상 문제 풀이</li>
				<li><span>교육비</span> 300,000원(4일 과정)</li>
				<li><span>준비물</span> 공학용계산기, 필기구 등(교재 당일 지급)</li>
			</ul>
		</article>
		
		<h3 class="tit_h3 mt100">감독자면허(SRI) 시험대비 단기강좌(4일 과정)</h3>
		<article class="arti4 s112_col2 clear">
			<div class="lbx">
				<dl>
					<dt><span>일정</span></dt>
					<dd>
						<ul>
							<li>- 6/18(토) 10:00~17:00</li>
							<li>- 6/19(일) 10:00~17:00</li>
							<li>- 6/25(토) 10:00~17:00</li>
							<li>- 6/26(일) 10:00~17:00</li>
						</ul>
					</dd>
				</dl>
			</div>
			<div class="rbx">
				<dl>
					<dt><span>장소</span></dt>
					<dd><p>실시간 온라인 <br>(비대면 프로그램 이용)</p></dd>
				</dl>
			</div>
		</article>

		<article class="arti5">
			<ul class="s112_list">
				<li><span>대상</span>방사선취급감독자 시험 응시 희망자</li>
				<li><span>시험일정</span> 2022년 8월 21일(일)</li>
				<li><span>원서접수</span> 2022년 7월 11일(월)~15일(금)</li>
				<li><span>내용</span> 시험 4과목(원자력이론, 방사선취급기술, 방사선장해방어, 원자력관계법령)</li>
				<li><span>방법</span> 과목별 전문 강사의 핵심이론 강의 및 예상 문제 풀이</li>
				<li><span>교육비</span> 300,000원(4일 과정)</li>
				<li><span>준비물</span> 공학용계산기, 필기구 등(교재 당일 지급)</li>
			</ul>	
		</article>
	</div>
</section>

<?php include_once(G5_THEME_PATH.'/tail.php'); ?>