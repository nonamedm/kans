<?
	include_once('./_common.php');

	//화면의 성격
	$user_division = "user";	$screen_div = "sub"; //main, sub	$frame_div = "two";  //one, two

	//카테고리/페이지/상세페이지 명칭 & 카테고리 번호
	$cate_num = "3";	$page_num = "1"; $spage_num = "1"; 

	//현재 활성화 상태
	$gn_btn = "gn_btn".$cate_num;		$$gn_btn = "current";
	$ln_btn = "ln_btn".$page_num;		$$ln_btn = "current";
	$sln_btn = "sln_btn".$spage_num;		$$sln_btn = "current";

	include_once(G5_THEME_PATH.'/head.php');
?>

<section class="s03 s<?=$cate_num;?>0<?=$page_num;?> s<?=$cate_num;?><?=$page_num;?><?=$spage_num;?><?=$sspage_num;?> clear ct1">
	<div class="cnt_box">
		<article class="arti1">
			<ul class="s3_col3">
				<li><a href="http://kans.re.kr/origin_home/safety/index.html" target="blank"><p>안전관리자 포럼<span></span></p></a></li>
				<li><a href="http://kans.re.kr/origin_home/safety/index.html" target="blank"><p>방사선안전이해<span></span></p></a></li>
				<li><a href="http://kans.re.kr/origin_home/kans_edu/html/kr/kans_edu_guide.html" target="blank"><p>방사선과 안전규제와의 만남<span></span></p></a></li>

				<!-- <li><a href="http://kans.re.kr/safety/index.html" target="blank"><p>방사선안전이해<span></span></p></a></li>
				<li><a href="http://kans.re.kr/kans_edu/html/kr/kans_edu_guide.html" target="blank"><p>방사선과 안전규제<span></span></p></a></li> -->
			</ul>
		</article>
		<article class="arti2">
			<h3 class="tit_h3">방사선규제이해 영상</h3>
			<div class="wrap s3_col2">
				<div class="lbx">
					<h4>초급</h4>
					<ul>
						<li><span class="robo">01</span>방사선이 뭔가요? <a href="https://www.youtube.com/watch?v=XDslJB01OcY&feature=youtu.be" target="blank"></a></li>
						<li><span class="robo">02</span>내 물건에서 방사선이 얼마나 나올까요? <a href="https://www.youtube.com/watch?v=BJVNyj5Jdxo&feature=youtu.be" target="blank"></a></li>
						<li><span class="robo">03</span>방사선은 어떻게 막을 수 있을까요? <a href="https://youtu.be/VyJX3hsTLf0" target="blank"></a></li>
						<li><span class="robo">04</span>방사선은 어떻게 안전하게 관리하고 있나요? <a href="https://youtu.be/GImOsVdwgZE" target="blank"></a></li>
						<li><span class="robo">05</span>방사선 사고는 어떻게 대응해야 하나요? <a href="https://youtu.be/25BJTOv7CNA" target="blank"></a></li>
						<li><span class="robo">06</span>의료방사선은 무엇인가요? <a href="https://youtu.be/YyBGNSymzSU" target="blank"></a></li>
					</ul>
				</div>
				<div class="rbx">
					<h4>고급</h4>
					<ul>
						<li><span class="robo">01</span>방사선이란 무엇인가요?<a href="https://youtu.be/EWL1y-zqpVY" target="blank"></a></li>
						<li><span class="robo">02</span>우리의 생활 환경에서는 방사선이 얼마나 나올까요? <a href="https://youtu.be/RSWWP3h6apE" target="blank"></a></li>
						<li><span class="robo">03</span>방사선은 차폐가 가능한가요? <a href="https://youtu.be/JmT3SNYOWlQ" target="blank"></a></li>
						<li><span class="robo">04</span>우리나라 방사선은 어떻게 안전하게 관리되나요? <a href="https://youtu.be/Uxv7HsZPPEY" target="blank"></a></li>
						<li><span class="robo">05</span>방사선은 인체에 어떤 영향을 미치나요?<a href="https://youtu.be/78FWD8Tyr6M" target="blank"></a></li>
						<li><span class="robo">06</span>의료방사선에 대해 알아봅시다.<a href="https://youtu.be/WNy3GCaxWDY" target="blank"></a></li>
					</ul>
				</div>
			</div>
		</article>

		<!-- <article class="arti3">
			<h3 class="tit_h3">방사선정보(핵종정보, 양과 단위, 용어정리)</h3>
		</article> -->
	</div>
</section>

<?php include_once(G5_THEME_PATH.'/tail.php'); ?>