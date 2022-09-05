<?
	include_once('./_common.php');

	//화면의 성격
	$user_division = "user";	$screen_div = "sub"; //main, sub	$frame_div = "two";  //one, two

	//카테고리/페이지/상세페이지 명칭 & 카테고리 번호
	$cate_num = "1";		$page_num = "3";		$spage_num = "3";	$sspage_num = "1";  

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
			<h3 class="tit_h3">부산은행 범내골지점 2층 (기본교육장 도보 5분 거리)</h3>
			<div id="daumRoughmapContainer1613448131952" class="root_daum_roughmap root_daum_roughmap_landing"></div>
			<script charset="UTF-8" class="daum_roughmap_loader_script" src="https://ssl.daumcdn.net/dmaps/map_js_init/roughmapLoader.js"></script>
			<script charset="UTF-8">
				new daum.roughmap.Lander({
					"timestamp" : "1613448131952",
					"key" : "24fqe",
				}).render();
			</script>
		</article>
		<article class="arti2 clear">
			<dl class="lbx clear">
				<dt class="robo">LOCATION</dt>
				<dd>부산시 부산지구 중앙대로 618 2층(1층 부산은행)</dd>
			</dl>
			<ul class="rbx clear">
				<li><a href="http://kko.to/ERcn9AdD0" target="_blank"><img src="<? echo G5_THEME_URL ?>/images/template/print_1.png" /></a></li>
				<li><a href="#n" onclick="window.open('./s1331_popup.php', 'window', 'top=100,left=100, width=1400,height=590')"><img src="<? echo G5_THEME_URL ?>/images/template/print_2.png" /></a></li>
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
									<p>지하철 1호선 범내골역 8번 출구</p>
								</dd>
							</dl>
						</li>
						<li>
							<figure><img src="<? echo G5_THEME_URL ?>/images/sub/s13002.jpg" /></figure>
							<dl class="tbx">
								<dt>기차</dt>
								<dd>
									<ol class="" style="letter-spacing: -0.05em;">
										<li>- 부산역(KTX/SRT) : 1호선 부산역 승차(노포 행) <span class="gguck"><img src="<? echo G5_THEME_URL ?>/images/sub/gguck.jpg" /></span>  범내골역 하차 <br>
										(약 17분) 부산역 버스 17,66,67,88,81 승차 <span class="gguck"><img src="<? echo G5_THEME_URL ?>/images/sub/gguck.jpg" /></span>  범내골역 하차(약20분)</li>
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
										<li>- 인근 공영주차장 이용(주차비 본인 부담)</li>
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
										<li>- 교육장 인근 정류장 : 범내골역</li>
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
										<li>- 부산종합버스터미널 : 1호선 노포역 승차(다대포 행) <span class="gguck"><img src="<? echo G5_THEME_URL ?>/images/sub/gguck.jpg" /></span> 범내골역 하차(37분)</li>
										<li>- 부산서부시외터미널 : 2호선 사상역(장산방면) <span class="gguck"><img src="<? echo G5_THEME_URL ?>/images/sub/gguck.jpg" /></span> 1호선 서면역 환승(다대포 방면) <span class="gguck"><img src="<? echo G5_THEME_URL ?>/images/sub/gguck.jpg" /></span> 범내골역 하차(약 28분)</li>
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