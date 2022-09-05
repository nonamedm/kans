<?php
	if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

	if($bo_table){
		$user_division = "user";
		$screen_div = "sub"; //main, sub
		$frame_div = "one";  //one, two

		if($bo_table == "s6_1"){
			$cate_name = "고객센터";
			$cate_num = "6";

			$page_name = "공지사항";
			$page_num = "1";
		}
		if($bo_table == "s6_3"){
			$cate_name = "고객센터";
			$cate_num = "6";

			$page_name = "온라인 문의";
			$page_num = "3";
		}
		if($bo_table == "s7_3"){
			$cate_name = "인재채용";
			$cate_num = "7";

			$page_name = "온라인 입사지원";
			$page_num = "3";
		}
		$gn_btn = "gn_btn".$cate_num;
		$$gn_btn = "current";

		$ln_btn = "ln_btn".$page_num;
		$$ln_btn = "current";
	}

	include_once(G5_THEME_PATH.'/head.sub.php');
	include_once(G5_LIB_PATH.'/outlogin.lib.php');
	include_once(G5_LIB_PATH.'/visit.lib.php');
	include_once(G5_LIB_PATH.'/connect.lib.php');
	include_once(G5_LIB_PATH.'/popular.lib.php');
	include_once(G5_LIB_PATH.'/latest.lib.php');
?>a
<!-- 컨텐츠 : 시작 -->
<header id="header">
	<h1><a href="#n"><span>대성아이앤지</span></a></h1>
</header>
<nav id="gn_area">
	<ul class="gn">
		<li><a href="<?php echo G5_URL ?>/s1/s1_1.php"><span>회사소개</span></a>
			<div class="sn sn1">
				<ul>
					<li><a href="<?php echo G5_URL ?>/s1/s1_1.php">CEO 인사말</a></li>
					<li><a href="<?php echo G5_URL ?>/s1/s1_2.php">경영이념</a></li>
					<li><a href="<?php echo G5_URL ?>/s1/s1_3.php">회사연혁</a></li>
					<li><a href="<?php echo G5_URL ?>/s1/s1_4.php">조직도</a></li>
					<li><a href="<?php echo G5_URL ?>/s1/s1_5.php">오시는 길</a></li>
				</ul>
			</div>
		</li>
		<li><a href="<?php echo G5_URL ?>/s2/s2_1.php"><span>사업소개</span></a>
			<div class="sn sn2">
				<ul>
					<li><a href="<?php echo G5_URL ?>/s2/s2_1.php">사업분야소개</a></li>
					<li><a href="<?php echo G5_URL ?>/s2/s2_2.php">고객현황</a></li>
				</ul>
			</div>
		</li>
		<li><a href="<?php echo G5_URL ?>/s3/s3_1.php"><span>제품소개</span></a>
			<div class="sn sn3">
				<ul>
					<li><a href="<?php echo G5_URL ?>/s3/s3_1.php">Outer Race 1종</a></li>
					<li><a href="<?php echo G5_URL ?>/s3/s3_2.php">Outer Sleeve 2종</a></li>
					<li><a href="<?php echo G5_URL ?>/s3/s3_3.php">Double Cone 5종</a></li>
					<li><a href="<?php echo G5_URL ?>/s3/s3_4.php">6LVS_Piston</a></li>
				</ul>
			</div>
		</li>
		<li><a href="<?php echo G5_URL ?>/s4/s4_1.php"><span>설비현황</span></a>
			<div class="sn sn4">
				<ul>
					<li><a href="<?php echo G5_URL ?>/s4/s4_1.php">생산설비현황</a></li>
				</ul>
			</div>
		</li>
		<li><a href="<?php echo G5_URL ?>/s5/s5_1.php"><span>품질보증</span></a>
			<div class="sn sn5">
				<ul>
					<li><a href="<?php echo G5_URL ?>/s5/s5_1.php">인증서 현황</a></li>
					<li><a href="<?php echo G5_URL ?>/s5/s5_2.php">측정설비 현황</a></li>
				</ul>
			</div>
		</li>
		<li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=s6_1"><span>고객센터</span></a>
			<div class="sn sn6">
				<ul>
					<li><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=s6_1">공지사항</a></li>
					<li><a href="<?php echo G5_URL ?>/s6/s6_2.php">부서담당자</a></li>
					<li><a href="<?php echo G5_BBS_URL ?>/write.php?bo_table=s6_3">온라인 문의</a></li>
				</ul>
			</div>
		</li>
		<li><a href="<?php echo G5_URL ?>/s7/s7_1.php"><span>인재채용</span></a>
			<div class="sn sn7">
				<ul>
					<li><a href="<?php echo G5_URL ?>/s7/s7_1.php">인재상</a></li>
					<li><a href="<?php echo G5_URL ?>/s7/s7_2.php">복리후생</a></li>
					<li><a href="<?php echo G5_BBS_URL ?>/write.php?bo_table=s7_3">온라인 입사지원</a></li>
				</ul>
			</div>
		</li>
	</ul>
</nav>
<!-- 컨텐츠 : 종료 -->

<?php if($screen_div=="sub"){?>
	<section id="sub_visual"></section>
	<section id="sub">
		<nav id="ln_area">
			<h2 class="h2_label"><span><?=$cate_name;?></span></h2>
			<ul class="ln">
				<?if($cate_num == 1){//회사소개?>
					<li class="<?=$ln_btn1;?>"><a href="<?php echo G5_URL ?>/s1/s1_1.php">CEO 인사말</a></li>
					<li class="<?=$ln_btn2;?>"><a href="<?php echo G5_URL ?>/s1/s1_2.php">경영이념</a></li>
					<li class="<?=$ln_btn3;?>"><a href="<?php echo G5_URL ?>/s1/s1_3.php">회사연혁</a></li>
					<li class="<?=$ln_btn4;?>"><a href="<?php echo G5_URL ?>/s1/s1_4.php">조직도</a></li>
					<li class="<?=$ln_btn5;?>"><a href="<?php echo G5_URL ?>/s1/s1_5.php">오시는 길</a></li>
				<?}else if($cate_num == 2){//사업소개?>
					<li class="<?=$ln_btn1;?>"><a href="<?php echo G5_URL ?>/s2/s2_1.php">사업분야소개</a></li>
					<li class="<?=$ln_btn2;?>"><a href="<?php echo G5_URL ?>/s2/s2_2.php">고객현황</a></li>
				<?}else if($cate_num == 3){//제품소개?>
					<li class="<?=$ln_btn1;?>"><a href="<?php echo G5_URL ?>/s3/s3_1.php">Outer Race 1종</a></li>
					<li class="<?=$ln_btn2;?>"><a href="<?php echo G5_URL ?>/s3/s3_2.php">Outer Sleeve 2종</a></li>
					<li class="<?=$ln_btn3;?>"><a href="<?php echo G5_URL ?>/s3/s3_3.php">Double Cone 5종</a></li>
					<li class="<?=$ln_btn4;?>"><a href="<?php echo G5_URL ?>/s3/s3_4.php">6LVS_Piston</a></li>
				<?}else if($cate_num == 4){//설비현황?>
					<li class="<?=$ln_btn1;?>"><a href="<?php echo G5_URL ?>/s4/s4_1.php">생산설비현황</a></li>
				<?}else if($cate_num == 5){//품질보증?>
					<li class="<?=$ln_btn1;?>"><a href="<?php echo G5_URL ?>/s5/s5_1.php">인증서 현황</a></li>
					<li class="<?=$ln_btn2;?>"><a href="<?php echo G5_URL ?>/s5/s5_2.php">측정설비 현황</a></li>
				<?}else if($cate_num == 6){//고객센터?>
					<li class="<?=$ln_btn1;?>"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=s6_1">공지사항</a></li>
					<li class="<?=$ln_btn2;?>"><a href="<?php echo G5_URL ?>/s6/s6_2.php">부서담당자</a></li>
					<li class="<?=$ln_btn3;?>"><a href="<?php echo G5_BBS_URL ?>/write.php?bo_table=s6_3">온라인 문의</a></li>
				<?}else if($cate_num == 7){//인재채용?>
					<li class="<?=$ln_btn1;?>"><a href="<?php echo G5_URL ?>/s7/s7_1.php">인재상</a></li>
					<li class="<?=$ln_btn2;?>"><a href="<?php echo G5_URL ?>/s7/s7_2.php">복리후생</a></li>
					<li class="<?=$ln_btn3;?>"><a href="<?php echo G5_BBS_URL ?>/write.php?bo_table=s7_3">온라인 입사지원</a></li>
				<?}else{?>
				<?}?>
			</ul>
		</nav>
		<section id="sub_cnt">
			<section class="feedback">
				<h3><?=$page_name;?></h3>
				<div class="process">
					<span class="home">HOME</span>
					<span class="arrow"></span>
					<span class="path"><?=$cate_name;?></span>
					<span class="arrow"></span>
					<span class="last"><?=$page_name;?></span>
				</div>
			</section>
<?php }else{?>
<?php }?>