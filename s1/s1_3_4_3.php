<?
	include_once('./_common.php');

	//화면의 성격
	$user_division = "user";	$screen_div = "sub"; //main, sub	$frame_div = "two";  //one, two

	//카테고리/페이지/상세페이지 명칭 & 카테고리 번호
	$cate_num = "1";		$page_num = "3";		$spage_num = "4";	$sspage_num = "3";  

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
			<h3 class="tit_h3">전남대학교</h3>
			<div id="daumRoughmapContainer1613449975403" class="root_daum_roughmap root_daum_roughmap_landing"></div>
			<script charset="UTF-8" class="daum_roughmap_loader_script" src="https://ssl.daumcdn.net/dmaps/map_js_init/roughmapLoader.js"></script>
			<script charset="UTF-8">
				new daum.roughmap.Lander({
					"timestamp" : "1613449975403",
					"key" : "24frj",
				}).render();
			</script>
		</article>
		<article class="arti2 clear">
			<dl class="lbx clear">
				<dt class="robo">LOCATION</dt>
				<dd>광주시 광구 용봉동 산 64-1</dd>
			</dl>
			<ul class="rbx clear">
				<li><a href="http://kko.to/ToKpZAKD0" target="_blank"><img src="<? echo G5_THEME_URL ?>/images/template/print_1.png" /></a></li>
				<li><a href="#n" onclick="window.open('./s1343_popup.php', 'window', 'top=100,left=100, width=1400,height=590')"><img src="<? echo G5_THEME_URL ?>/images/template/print_2.png" /></a></li>
			</ul>
		</article>

		<article class="arti3 map_list mt100 clear">
			<h3 class="tit_h3">대중교통</h3>
			<div class="wrap clear">
				<div class="lbx">
					<ul class="clear">
						<!-- <li>
							<figure><img src="<? echo G5_THEME_URL ?>/images/sub/s13001.jpg" /></figure>
							<dl class="tbx">
								<dt>지하철</dt>
								<dd>
									<p>지하철 1호선 부산역 8,10번출구</p>
								</dd>
							</dl>
						</li> -->
						<li>
							<figure><img src="<? echo G5_THEME_URL ?>/images/sub/s13002.jpg" /></figure>
							<dl class="tbx">
								<dt>기차</dt>
								<dd>
									<ol class="" style="letter-spacing: -0.05em;">
										<li>- 광주송정역(KTX/SRT) : 송정 19, 광역 160(1시간)</li>
										<li>- 광주역 : 진월 07버스(14분)</li>

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
										<li>- 교내 주차 가능(주차할인권 구입 가능)</li>
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
										<li>- 교육장 인근 정류장 : 전남대 동문, 전남대 후문, 전남대 공과대학,<br> 전남대스포츠센터</li>
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
										<li>- 광주종합버스터미널 : 일곡 38버스(40분)</li>
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