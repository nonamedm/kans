<?
	include_once('./_common.php');

	//화면의 성격
	$user_division = "user";	$screen_div = "sub"; //main, sub	$frame_div = "two";  //one, two

	//카테고리/페이지/상세페이지 명칭 & 카테고리 번호
	$cate_num = "1";		$page_num = "3";		$spage_num = "1";	$sspage_num = "1";  

	//현재 활성화 상태
	$gn_btn = "gn_btn".$cate_num;			$$gn_btn = "current";
	$ln_btn = "ln_btn".$page_num;				$$ln_btn = "current";
	$sln_btn = "sln_btn".$spage_num;			$$sln_btn = "current";
	$ssln_btn = "ssln_btn".$sspage_num;		$$ssln_btn = "current";

	include_once(G5_THEME_PATH.'/head.php');
?>

<section class="s01 s<?=$cate_num;?>0<?=$page_num;?> s<?=$cate_num;?><?=$page_num;?><?=$spage_num;?><?=$sspage_num;?> clear ct1">
	<div class="cnt_box">
		<article class="arti1 clear">
			<h3 class="tit_h3">KANS 서울 교육장(기본 교육장과 도보 3분 이내)  </h3>
			<div id="daumRoughmapContainer1613443507168" class="root_daum_roughmap root_daum_roughmap_landing"></div>
			<script charset="UTF-8" class="daum_roughmap_loader_script" src="https://ssl.daumcdn.net/dmaps/map_js_init/roughmapLoader.js"></script>
			<script charset="UTF-8">
				new daum.roughmap.Lander({
					"timestamp" : "1613443507168",
					"key" : "24fp3",
				}).render();
			</script>
		</article>
		<article class="arti2 clear">
			<dl class="lbx clear">
				<dt class="robo">LOCATION</dt>
				<dd>서울시 송파구 송파대로 260, 제일오피스텔 619호(KB저축은행 건물 6층)</dd>
			</dl>
			<ul class="rbx clear">
				<li><a href="http://kko.to/bf8o0XdYH" target="_blank"><img src="<? echo G5_THEME_URL ?>/images/template/print_1.png" /></a></li>
				<li><a href="#n" onclick="window.open('./s1311_popup.php', 'window', 'top=100,left=100, width=1400,height=590')"><img src="<? echo G5_THEME_URL ?>/images/template/print_2.png" /></a></li>
			</ul>
		</article>

		<article class="arti3 map_list mt100 clear">
			<h3 class="tit_h3">대중교통</h3>
			<div class="wrap clear">
				<div class="lbx">
					<ul class="clear">
						<li>
							<figure><img src="<? echo G5_THEME_URL ?>/images/sub/s13001.jpg" /></figure>
							<dl class="tbx">
								<dt>지하철</dt>
								<dd>
									<p>지하철 3호선 또는 8호선 가락시장역 3번 출구 우측 건물 <br>(KB저축은행 건물)</p>
								</dd>
							</dl>
						</li>
						<li>
							<figure><img src="<? echo G5_THEME_URL ?>/images/sub/s13002.jpg" /></figure>
							<dl class="tbx">
								<dt>기차</dt>
								<dd>
									<ol class="" style="letter-spacing: -0.05em;">
										<li>- 서울역(KTX) : 4호선 서울역 승차(당고개 행) <span class="gguck"><img src="<? echo G5_THEME_URL ?>/images/sub/gguck.jpg" /></span>3호선 충무로역<br>환승 (오금 행) <span class="gguck"><img src="<? echo G5_THEME_URL ?>/images/sub/gguck.jpg" /></span>가락시장역 하차(약56분 소요)</li>
										<li>- 수서역(SRT) : 3호선 수서역 승차(오금 행) <span class="gguck"><img src="<? echo G5_THEME_URL ?>/images/sub/gguck.jpg" /></span> 가락시장역<br> 하차(약 10분)</li>
									</ol>
								</dd>
							</dl>
						</li>
						<li>
							<figure><img src="<? echo G5_THEME_URL ?>/images/sub/s13003.jpg" /></figure>
							<dl class="tbx">
								<dt>주차 안내</dt>
								<dd>
									<ol>
										<li>- 가급적 대중교통을 이용해주시기 바랍니다. </li>
										<li>- 건물내 주차가능(주차비 본인 부담) </li>
									</ol>
								</dd>
							</dl>
						</li>
					</ul>
				</div>
				<div class="rbx">
					<ul class="clear">
						<li>
							<figure><img src="<? echo G5_THEME_URL ?>/images/sub/s13004.jpg" /></figure>
							<dl class="tbx">
								<dt>버스</dt>
								<dd>
									<ol class="clear ">
										<li>- 교육장 인근 정류장 : 가락시장, 가락시장몰, <br>가락시장역, 제일오피스텔</li>

									</ol>
								<!-- 	<ol class="clear col2">
										<li>- 교육장 인근 정류장 : 가락시장, 가락시장몰, 가락시장역, 제일오피스텔</li>
										 <li>- 가락시장, 가락몰</li>
										<li>- 가락시장, 가락시장역</li>
										<li>- 제일오피스텔 </li>
									</ol> -->
								</dd>
							</dl>
						</li>
						<li>
							<figure><img src="<? echo G5_THEME_URL ?>/images/sub/s13005.jpg" /></figure>
							<dl class="tbx">
								<dt>고속·시외버스</dt>
								<dd>
									<ol>
										<li>- 동서울버스터미널 : 2호선 강변역 승차(잠실 행) <span class="gguck"><img src="<? echo G5_THEME_URL ?>/images/sub/gguck.jpg" /></span>  8호선 잠실역<br> (모란 행) 환승 <span class="gguck"><img src="<? echo G5_THEME_URL ?>/images/sub/gguck.jpg" /></span> 가락시장역 하차(약 20분 소요)</li>
										<li>- 강남고속버스터미널 : 3호선 고속버스터미널역 승차(오금 행) <span class="gguck"><img src="<? echo G5_THEME_URL ?>/images/sub/gguck.jpg" /></span> <br>가락시장역 하차(약 25분)</li>
										<li>- 남부시외터미널 : 3호선 남부터미널역 승차(오금 행) <span class="gguck"><img src="<? echo G5_THEME_URL ?>/images/sub/gguck.jpg" /></span> 가락시장역 <br>하차(약 25분)</li>
									</ol>
								</dd>
							</dl>
						</li>
					</ul>
				</div>
			</div>
		</article>
		
	</div>
</section>

<?php include_once(G5_THEME_PATH.'/tail.php'); ?>