<?
	include_once('./_common.php');

	//화면의 성격
	$user_division = "user";	$screen_div = "sub"; //main, sub	$frame_div = "two";  //one, two

	//카테고리/페이지/상세페이지 명칭 & 카테고리 번호
	$cate_num = "5";	$page_num = "3"; //$spage_num = "1"; 

	//현재 활성화 상태
	$gn_btn = "gn_btn".$cate_num;		$$gn_btn = "current";
	$ln_btn = "ln_btn".$page_num;		$$ln_btn = "current";
	$sln_btn = "sln_btn".$spage_num;		$$sln_btn = "current";

	include_once(G5_THEME_PATH.'/head.php');
?>

<section class="s05 s<?=$cate_num;?>0<?=$page_num;?> s<?=$cate_num;?><?=$page_num;?><?=$spage_num;?><?=$sspage_num;?> clear ct1">
	<div class="cnt_box">
		<article class="arti1">
			<h3 class="tit_h3">연혁</h3>
			<div class="figure">
				<div class="tbx">
					<h4 class="robo">HISTORY</h4>
					<p>한국원자력안전아카데미가 걸어온 길을 소개합니다.</p>
				</div>	
			</div>

			<div class="history_box">
				<ul>
					<!-- <li>
						<h3 class="robo">2021</h3>
						<ol>
							<li>
								<span>04.22</span>
								<p>정관변경 허가(원자력안전위원회)</p>
							</li>
						</ol>
					</li>
					
					<li>
						<h3 class="robo">2020</h3>
						<ol>
							<li>
								<span>10.16</span>
								<p>정관변경 허가(원자력안전위원회)</p>
							</li>
						</ol>
					</li>
					<li>
						<h3 class="robo">2019</h3>
						<ol>
							<li>
								<span>03.15</span>
								<p>정관변경 허가(원자력안전위원회)</p>
							</li>
						</ol>
					</li> -->
					<li>
						<h3 class="robo">2013</h3>
						<ol>
							<li>
								<span>10.16</span>
								<p>방사선작업종사자 직장교육 기관 지정</p>
							</li>
							<!-- <li>
								<span>03.13</span>
								<p>정관변경 허가(원자력안전위원회)</p>
							</li> -->
						</ol>
					</li>
					<li>
						<h3 class="robo">2012</h3>
						<ol>
							<li>
								<span>08.02</span>
								<p>소관부처 원자력안전위원회로 변경</p>
							</li>
						</ol>
					</li>
					<li>
						<h3 class="robo">2005</h3>
						<ol>
							<li>
								<span>04.01</span>
								<p>방사능방재교육기관 지정</p>
							</li>
						</ol>
					</li>
					<li>
						<h3 class="robo">2002</h3>
						<ol>
							<li>
								<span>10.11</span>
								<p>방사선장해방어의 기초에 관한 통신교육훈련 기관지정</p>
							</li>
							<li>
								<span>06.12</span>
								<p>면허소지자 보수교육 업무 수탁</p>
							</li>
							<li>
								<span>06.11</span>
								<p>방사선작업종사자 교육기관 지정</p>
							</li>
							<li>
								<span>05.07</span>
								<p>(사)한국원자력안전아카데미 설립 (과학기술부 허가 제269호)</p>
							</li>
						</ol>
					</li>
				</ul>
			</div>
		</article>
		<article class="arti2 mt100">
			<h3 class="tit_h3">조직도</h3>
			<figure><img src="<? echo G5_THEME_URL ?>/images/sub/s503_2.jpg" /></figure>
		</article>
	
	</div>
</section>



<?php include_once(G5_THEME_PATH.'/tail.php'); ?>