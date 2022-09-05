<?
	include_once('./_common.php');

	//화면의 성격
	$user_division = "user";	$screen_div = "sub"; //main, sub	$frame_div = "two";  //one, two

	//카테고리/페이지/상세페이지 명칭 & 카테고리 번호
	$cate_num = "5";	$page_num = "5"; //$spage_num = "1"; 

	//현재 활성화 상태
	$gn_btn = "gn_btn".$cate_num;		$$gn_btn = "current";
	$ln_btn = "ln_btn".$page_num;		$$ln_btn = "current";
	$sln_btn = "sln_btn".$spage_num;		$$sln_btn = "current";

	include_once(G5_THEME_PATH.'/head.php');
?>

<section class="s05 s<?=$cate_num;?>0<?=$page_num;?> s<?=$cate_num;?><?=$page_num;?><?=$spage_num;?><?=$sspage_num;?> clear ct1">
	<div class="cnt_box">
		<article class="arti1">
			<h3 class="tit_h3">대관안내</h3>
			<ul class="dot_ul">
				<li>관련 근거 : 한국원자력안전아카데미 정관 제6조8</li>
				<li>대관장소 : KANS 서울 교육장(619호)</li>
			</ul>

			<table class="table_nomal" style="margin-top: 25px;">
				<colgroup>
					<col width="190">
					<col width="*">
				</colgroup>
				<thead>
				<tr>
					<th>구분</th>
					<th>내용</th>
				</tr>
				</thead>
				<tr>
					<td>규모</td>
					<td>82.35㎡(50석)</td>
				</tr>
				<tr>
					<td>기자재</td>
					<td>컴퓨터, 빔프로젝터, 스크린, 화이트보드, 책상(25개), 의자(50개), 휴대용 마이크 1개, 냉난방기, 냉온수기</td>
				</tr>
				<tr>
					<td>대관료</td>
					<td>
						평일 ?시간당 50,000원(부가세 별도) <br>
						주말 or 야간 - 시간당 60,000원(부가세별도) <br>
						* 주말, 공휴일, 야간은 기준 금액의 20%를 가산적용
					</td>
				</tr>
				<tr>
					<td>주차료</td>
					<td>
						대관요청자 1대 무료(차량번호 제출시), 그외 주차비 본인 부담<br>
						- 시간당 6,000원(10분 1,000원) <br>
						- One day(평일 10시 이전 입차 ~16시 이후 출자 적용) 20,000원
					</td>
				</tr>
			</table>
			
			<div class="link_box_ty1">
				<a href="<? echo G5_THEME_URL ?>/images/template/kang_down_file.hwp" target="blank" class="link_a" style="width: 320px; margin-top: 43px;">교육장(회의실) 대관 신청서
					<span><img src="<? echo G5_THEME_URL ?>/images/sub/s1111_2.png" /></span>
				</a>
			</div>

		</article>
		<article class="arti2 clear mt100">
			<ul class="bg_col4 clear">
				<li>대관가능 여부<br>문의
					<h5>Tel : 070-4821-3926</h5>
				</li>
				<li>신청서<br>작성·제출
					<h5>E-mail : kans1@kans.re.kr <br>Fax : 02-508-7941</h5>
				</li>
				<li>대관 승인</li>
				<li>대관료 납부
					<h5>* 대관 3일전까지 납부</h5>
				</li>
			</ul>
				
		</article>
		<article class="arti3">
			<ul class="clear">
				<li><img src="<? echo G5_THEME_URL ?>/images/sub/s505_2.jpg" /></li>
				<li>
					<ol>
						<li>
							<figure><img src="<? echo G5_THEME_URL ?>/images/sub/s505_3.jpg" /></figure>
							<div class="tbx">
								<h4>계좌이체</h4>
								<p>씨티은행 102-53627-246  <br>(사)한국원자력안전아카데미</p>
							</div>
						</li>
						<li>
							<figure><img src="<? echo G5_THEME_URL ?>/images/sub/s505_4.jpg" /></figure>
							<div class="tbx">
								<h4>카드결제</h4>
								<p>당일 시작전 현장결제</p>
							</div>
						</li>
					</ol>
				</li>
			</ul>
			<div class="color_sky">
				<p class="">※ 대관 변경 및 취소는 대관 3일전까지  가능</p>
			</div>
		</article>	
	</div>
</section>



<?php include_once(G5_THEME_PATH.'/tail.php'); ?>