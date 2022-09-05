<?
	include_once('./_common.php');

	//화면의 성격
	$user_division = "user";	$screen_div = "sub"; //main, sub	$frame_div = "two";  //one, two

	//카테고리/페이지/상세페이지 명칭 & 카테고리 번호
	$cate_num = "3";	$page_num = "2"; $spage_num = "1"; 

	//현재 활성화 상태
	$gn_btn = "gn_btn".$cate_num;		$$gn_btn = "current";
	$ln_btn = "ln_btn".$page_num;		$$ln_btn = "current";
	$sln_btn = "sln_btn".$spage_num;		$$sln_btn = "current";

	include_once(G5_THEME_PATH.'/head.php');
?>

<section class="s03 s<?=$cate_num;?>0<?=$page_num;?> s<?=$cate_num;?><?=$page_num;?><?=$spage_num;?><?=$sspage_num;?> clear ct1">
	<div class="cnt_box">
		<article class="arti1">
			<h3 class="tit_h3">현장 맞춤형 전문인력 관련 영상</h3>
			<div class="wrap s3_col2">
				<div class="lbx">
					<ul>
						<li><span class="robo">01</span>원자력 소통 어떻게 해야 할까?<a href="https://forms.gle/TLb6Ck7SQbPqoerEA" target="blank"></a></li>
						<li style="background: #f9f9f9"><span class="robo">03</span>방사선안전관리구역에서의 안전행위 <a href="https://forms.gle/wYfL16JDkDveWSMfA" target="blank"></a></li>
						<li style=""><span class="robo">05</span>원자력人을 위한 잘 쓰고 잘 말하는 법 <a href="https://forms.gle/Hof2q6aRH9LcsvCfA" target="blank"></a></li>
					</ul>
				</div>
				<div class="rbx">
					<ul>
						<li><span class="robo">02</span>방사선의 인체 영향 <a href="https://forms.gle/77TPhhfhi9RM1GAX6" target="blank"></a></li>
						<li style="background: #f9f9f9"><span class="robo">04</span>설계에서 규제까지! 원자력발전소 안전의 모든 것<a href="https://forms.gle/UNe7isKPJYdmpop99" target="blank"></a></li>
					</ul>
				</div>
			</div>
			<h3 class="tit_h3">현장 맞춤형 전문인력 관련 브로셔</h3>
			<div class="wrap s3_col2">
				<div class="lbx">
					<ul>
						<li><span class="robo">01</span>원자력 소통 어떻게 해야 할까?<a href="http://www.kans.re.kr/board_files/2_1_원자력소통.pdf" target="blank"></a></li>
						<li style="background: #f9f9f9"><span class="robo">03</span>방사선안전관리구역에서의 안전행위 <a href="http://www.kans.re.kr/board_files/2_3_안전행위.pdf" target="blank"></a></li>
					</ul>
				</div>
				<div class="rbx">
					<ul>
						<li><span class="robo">02</span>방사선의 인체 영향 <a href="http://www.kans.re.kr/board_files/2_2_방사선인체영향.pdf" target="blank"></a></li>
						<li style="background: #f9f9f9"><span class="robo">04</span>설계에서 규제까지! 원자력발전소 안전의 모든 것<a href="http://www.kans.re.kr/board_files/2_4_원자력안전.pdf" target="blank"></a></li>
					</ul>
				</div>
			</div>
		</article>
	</div>
</section>

<?php include_once(G5_THEME_PATH.'/tail.php'); ?>