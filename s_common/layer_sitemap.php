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
		<h1 class="">사이트맵</h1>
	</header>
	<article class="layer_cnt">
		<dl class="sitemap sitemap_1st">
			<dt>회사소개</dt>
			<dd>
				<ul class="s_depth_menu">
					<li><a href="#n" onclick="javascript:parent.location.href='<? echo G5_URL ?>/s1/s1_1.php'">인사말</a></li>
					<li><a href="#n" onclick="javascript:parent.location.href='<? echo G5_URL ?>/s1/s1_2.php'">오시는길</a></li>
					<li><a href="#n" onclick="javascript:parent.location.href='<? echo G5_URL ?>/s1/s1_3.php'">조직구성</a></li>
				</ul>
			</dd>
		</dl>
		<dl class="sitemap sitemap_1st">
			<dt>제품소개</dt>
			<dd>
				<ul class="s_depth_menu">
					<li><a href="#n" onclick="javascript:parent.location.href='<? echo G5_BBS_URL ?>/board.php?bo_table=s2_1&sca=로봇핸드'">로봇핸드</a></li>
					<li><a href="#n" onclick="javascript:parent.location.href='<? echo G5_BBS_URL ?>/board.php?bo_table=s2_1&sca=POROUS CHUCK'">POROUS CHUCK</a></li>
					<li><a href="#n" onclick="javascript:parent.location.href='<? echo G5_BBS_URL ?>/board.php?bo_table=s2_1&sca=각종 지그류'">각종 지그류</a></li>
					<li><a href="#n" onclick="javascript:parent.location.href='<? echo G5_BBS_URL ?>/board.php?bo_table=s2_1&sca=반도체 부품'">반도체 부품</a></li>
					<li><a href="#n" onclick="javascript:parent.location.href='<? echo G5_BBS_URL ?>/board.php?bo_table=s2_1&sca=SIC'">SIC</a></li>
				</ul>
			</dd>
		</dl>
		<dl class="sitemap sitemap_1st">
			<dt>설비현황</dt>
			<dd>
				<ul class="s_depth_menu">
					<li><a href="#n" onclick="javascript:parent.location.href='<? echo G5_BBS_URL ?>/board.php?bo_table=s3_1'">가공설비</a></li>
					<li><a href="#n" onclick="javascript:parent.location.href='<? echo G5_BBS_URL ?>/board.php?bo_table=s3_2'">측정설비</a></li>
				</ul>
			</dd>
		</dl>
		<dl class="sitemap sitemap_1st">
			<dt>공지사항</dt>
			<dd>
				<ul class="s_depth_menu">
					<li><a href="#n" onclick="javascript:parent.location.href='<? echo G5_BBS_URL ?>/board.php?bo_table=s4_1'">공지사항</a></li>
				</ul>
			</dd>
		</dl>
		<dl class="sitemap sitemap_1st">
			<dt>온라인문의</dt>
			<dd>
				<ul class="s_depth_menu">
					<li><a href="#n" onclick="javascript:parent.location.href='<? echo G5_BBS_URL ?>/write.php?bo_table=s5_1'">온라인문의</a></li>
				</ul>
			</dd>
		</dl>
	</article>
</section>
<?php include_once(G5_THEME_PATH.'/tail.php'); ?>