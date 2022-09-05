<?
	include_once('./_common.php');

	//화면의 성격
	$user_division = "user";	$screen_div = "sub"; //main, sub	$frame_div = "two";  //one, two

	//카테고리/페이지/상세페이지 명칭 & 카테고리 번호
	$cate_num = "1";		$page_num = "3";		$spage_num = "2";	$sspage_num = "1";  

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
			<h3 class="tit_h3">예람인재교육센터(기본교육장 동일 건물) </h3>
			<div id="daumRoughmapContainer1613443585655" class="root_daum_roughmap root_daum_roughmap_landing"></div>
			<script charset="UTF-8" class="daum_roughmap_loader_script" src="https://ssl.daumcdn.net/dmaps/map_js_init/roughmapLoader.js"></script>
			<script charset="UTF-8">
				new daum.roughmap.Lander({
					"timestamp" : "1613443585655",
					"key" : "24fp4",
				}).render();
			</script>
		</article>
		<article class="arti2 clear">
			<dl class="lbx clear">
				<dt class="robo">LOCATION</dt>
				<dd>대전시 중구 동서대로 1304번길 33 예람빌딩(1층 조마루 감자탕 빌딩)</dd>
			</dl>
			<ul class="rbx clear">
				<li><a href="http://kko.to/20qCjedDM" target="_blank"><img src="<? echo G5_THEME_URL ?>/images/template/print_1.png" /></a></li>
				<li><a href="#n" onclick="window.open('./s1321_popup.php', 'window', 'top=100,left=100, width=1400,height=590')"><img src="<? echo G5_THEME_URL ?>/images/template/print_2.png" /></a></li>
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
									<p>지하철 1호선 오룡역 1번 출구 도보 3분</p>
								</dd>
							</dl>
						</li>
						<li>
							<figure><img src="<? echo G5_THEME_URL ?>/images/sub/s13002.jpg" /></figure>
							<dl class="tbx">
								<dt>기차</dt>
								<dd>
									<ol class="" style="letter-spacing: -0.05em;">
										<li>- 대전역(KTX/SRT) : 1호선 대전역 승차(반석 행) <span class="gguck"><img src="<? echo G5_THEME_URL ?>/images/sub/gguck.jpg" /></span> 오룡역 하차 <br>(약 12분 소요)</li>
										<li>- 서대전역(KTX) : 도보 약 15분 소요</li>
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
										<li>- 인근 공영주차장 이용(주차비 본인 부담) </li>
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
										<li>- 교육장 인근 정류장 : 중도일보, 오룡역</li>
									</ol>
								</dd>
							</dl>
						</li>
						<li>
							<figure><img src="<? echo G5_THEME_URL ?>/images/sub/s13005.jpg" /></figure>
							<dl class="tbx">
								<dt>고속·시외버스</dt>
								<dd>
									<ol>
										<li>- 대전복합버스터미널 : 버스 601번 (약 40분 소요)</li>
										<li>- 유성고속버스터미널 : 1호선 구암역 또는 유성온천역 승차(판암행)  <span class="gguck"><img src="<? echo G5_THEME_URL ?>/images/sub/gguck.jpg" /></span>  오룡역 하차(약 35분 소요)</li>
										<li>- 유성시외터미널 : 1호선 유성온천역 승차(판암행)  <span class="gguck"><img src="<? echo G5_THEME_URL ?>/images/sub/gguck.jpg" /></span>  오룡역 하차 <br>(약 30분 소요)</li>
										<li>- 정부청사시외버스둔산정류소 : 1호선 정부청사역 승차(판암행) <span class="gguck"><img src="<? echo G5_THEME_URL ?>/images/sub/gguck.jpg" /></span>  <br>오룡역 하차(약 20분 소요)</li>
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