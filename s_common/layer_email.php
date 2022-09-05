<?
	include_once('./_common.php');

	//화면의 성격
	$user_division = "user";
	$screen_div = "original"; //main, sub
	$frame_div = "one";  //one, two

	include_once(G5_THEME_PATH.'/head.php');
?>
<section id="" class="layer_box">
	<header>
		<h1 class="">이메일주소무단수집거부</h1>
	</header>
	<article class="layer_cnt">
		<div class="email_area">
			<div class="email_box">
				<p class="big_txt">
					이메일주소무단수집을 거부합니다.
				</p>
				<p class="normal_txt">
					본 웹사이트에 게시된 이메일 주소가 전자우편 수집 프로그램이나 그 밖의 기술적 장치를 이용하여 <strong>무단으로 수집되는 것을 거부</strong>하며,
					이를 <strong>위반시 정보통신망법에 의해 형사 처벌</strong>됨을 유념하시기 바랍니다.
				</p>
			</div>
		</div>
	</article>
</section>
<?php include_once(G5_THEME_PATH.'/tail.php'); ?>