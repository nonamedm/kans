<? include_once(G5_THEME_MOBILE_PATH.'/head_intro.php'); ?>

<!-- 컨텐츠 : 시작 -->
<header class="header <?if($screen_div=="sub"){?>subb<?}?>">
	
	<div class="hd_nav clear">
		
		 <div class="hd_top">
			<ul class="clear ct1">
			<?php if ($is_member) { ?>
				 <li class="hd_logout"><a  href="<?php echo G5_BBS_URL; ?>/logout.php">로그아웃</a></li>
				<li class="hd_my"><a href="<?=$s9_1_url;?>">마이페이지</a></li> 
			<?}else{?>
				<li class="hd_login"><a href="<?php echo G5_BBS_URL; ?>/login.php">로그인</a></li>
				<li class="hd_register"><a href="<?php echo G5_BBS_URL; ?>/register.php">교육 회원가입</a></li>
			<?}?>
			</ul>
		</div> 
	

		<? /*<div class="hd_top">
			<ul class="clear ct1">
			<?php if ($is_member) { ?>
				<li class="hd_logout"><a  href="<?php echo G5_BBS_URL; ?>/logout.php">로그아웃</a></li>
				<li class="hd_my"><a href="<?=$s9_1_url;?>">마이페이지</a></li>
			<?}else{?>
				 <li class="hd_login"><a href="<?php echo G5_BBS_URL; ?>/login.php">로그인</a></li>
				<li class="hd_register"><a href="<?php echo G5_BBS_URL; ?>/register.php">교육 회원가입</a></li> 

				<!-- <li class="hd_login"><a href="javascript:alert('준비중입니다.')">로그인</a></li>
				<li class="hd_register"><a href="javascript:alert('준비중입니다.')">교육 회원가입</a></li> -->

			<?}?>
			</ul>
		</div> */ ?>
		<div class="hd_bottom ct1 clear">
			<h1 class="logo"><a href="<?php echo G5_URL ?>"></a></h1>
			<nav class="gnb">
				<ul class="clear">
					<li> 
						<a href="<?=$s1_1_1_1_url;?>"><?=$s1_name?></a>
						<div id="subm1" class="dep2 clear">
							<ul class="af">
								<li class="<?=$ln_btn1;?>"><a href="<?=$s1_1_1_1_url;?>"><span><?=$s1_1_name;?></span></a>
									<ul class="dep3">
										<li class="<?=$sln_btn1;?>"><a href="<?=$s1_1_1_1_url;?>"><span><?=$s1_1_1_name;?></span></a></li>
										<li class="<?=$sln_btn2;?>"><a href="<?=$s1_1_2_1_url;?>"><span><?=$s1_1_2_name;?></span></a></li>
									</ul>
								</li>

							
								<li class="<?=$ln_btn4;?>"><a href="<?=$s1_4_1_1_url;?>"><span><?=$s1_4_name;?></span></a>
									<ul class="dep3">
										<li class="<?=$sln_btn1;?>"><a href="<?=$s1_4_1_1_url;?>"><span><?=$s1_4_1_name;?></span></a></li>
										<li class="<?=$sln_btn2;?>"><a href="<?=$s1_4_2_1_url;?>"><span><?=$s1_4_2_name;?></span></a></li>
									</ul>
								</li>


								<li class="<?=$ln_btn2;?>"><a href="<?=$s1_2_2_url;?>"><span><?=$s1_2_name;?></span></a>
								<!-- <li class="<?=$ln_btn2;?>"><a href="<?=$s1_2_1_url;?>"><span><?=$s1_2_name;?></span></a> -->

									<ul class="dep3">
										<li class="<?=$sln_btn1;?>"><a href="javascript:alert('페이지 준비중입니다.')"><span><?=$s1_2_1_name;?></span></a></li>
										<!-- <li class="<?=$sln_btn1;?>"><a href="<?=$s1_2_1_url;?>"><span><?=$s1_2_1_name;?></span></a></li> -->
										<li class="<?=$sln_btn2;?>"><a href="<?=$s1_2_2_url;?>"><span><?=$s1_2_2_name;?></span></a></li>
									</ul>
								</li>
								<li class="<?=$ln_btn3;?>"><a href="<?=$s1_3_1_1_url;?>"><span><?=$s1_3_name;?></span></a>
									<ul class="dep3">
										<li class="<?=$sln_btn1;?>"><a href="<?=$s1_3_1_1_url;?>"><span><?=$s1_3_1_name;?></span></a></li>
										<li class="<?=$sln_btn2;?>"><a href="<?=$s1_3_2_1_url;?>"><span><?=$s1_3_2_name;?></span></a></li>
										<li class="<?=$sln_btn3;?>"><a href="<?=$s1_3_3_1_url;?>"><span><?=$s1_3_3_name;?></span></a></li>
										<li class="<?=$sln_btn4;?>"><a href="<?=$s1_3_4_1_url;?>"><span><?=$s1_3_4_name;?></span></a></li>
										<li class="<?=$sln_btn5;?>"><a href="<?=$s1_3_5_1_url;?>"><span><?=$s1_3_5_name;?></span></a></li>
										<li class="<?=$sln_btn6;?>"><a href="<?=$s1_3_6_1_url;?>"><span><?=$s1_3_6_name;?></span></a></li>
									</ul>
								</li>
							</ul>
						</div>
					</li>
					<li>
						<a href="<?=$s2_1_url;?>"><?=$s2_name?></a>
						<div id="subm2" class="dep2 clear">
							<ul>
								<li class="<?=$ln_btn1;?>"><a href="<?=$s2_1_url;?>"><span><?=$s2_1_name;?></span></a></li>
								<li class="<?=$ln_btn2;?>"><a href="<?=$s2_2_url;?>"><span><?=$s2_2_name;?></span></a></li>
								<li class="<?=$ln_btn3;?>"><a href="<?=$s2_3_url;?>"><span><?=$s2_3_name;?></span></a></li>
								<li class="<?=$ln_btn4;?>"><a href="<?=$s2_4_url;?>"><span><?=$s2_4_name;?></span></a></li>
								<li class="<?=$ln_btn5;?>"><a href="<?=$s2_5_url;?>"><span><?=$s2_5_name;?></span></a></li>
								<!-- <li class="<?=$ln_btn6;?>"><a href="<?=$s2_6_url;?>"><span><?=$s2_6_name;?></span></a></li> -->
							</ul>
						</div>
					</li>
					<li>
						<a href="<?=$s3_1_1_url;?>"><?=$s3_name?></a>
						<div id="subm3" class="dep2 clear">
							<ul>
								<li class="<?=$ln_btn1;?>"><a href="<?=$s3_1_1_url;?>"><span><?=$s3_1_name;?></span></a></li>
								<li class="<?=$ln_btn2;?>"><a href="<?=$s3_2_1_url;?>"><span><?=$s3_2_name;?></span></a></li>
								<li class="<?=$ln_btn3;?>"><a href="<?=$s3_3_1_url;?>"><span><?=$s3_3_name;?></span></a></li>
							</ul>
						</div>
					</li>
					<li>
						<a href="<?=$s4_1_url;?>"><?=$s4_name?></a>
						<div id="subm4" class="dep2 clear">
							<ul>
								<li class="<?=$ln_btn1;?>"><a href="<?=$s4_1_url;?>"><span><?=$s4_1_name;?></span></a></li>
								<li class="<?=$ln_btn2;?>"><a href="<?=$s4_2_url;?>"><span><?=$s4_2_name;?></span></a></li>
							</ul>
						</div>
					</li>
					<li>
						<a href="<?=$s5_1_url;?>"><?=$s5_name?></a>
						<div id="subm5" class="dep2 clear">
							<ul>
								<li class="<?=$ln_btn1;?>"><a href="<?=$s5_1_url;?>"><span><?=$s5_1_name;?></span></a></li>
								<li class="<?=$ln_btn2;?>"><a href="<?=$s5_2_url;?>"><span><?=$s5_2_name;?></span></a></li>
								<li class="<?=$ln_btn3;?>"><a href="<?=$s5_3_url;?>"><span><?=$s5_3_name;?></span></a></li>
								<li class="<?=$ln_btn4;?>"><a href="<?=$s5_4_url;?>"><span><?=$s5_4_name;?></span></a></li>
								<li class="<?=$ln_btn4;?>"><a href="<?=$s5_5_url;?>"><span><?=$s5_5_name;?></span></a></li>
							</ul>
						</div>
					</li>

					<li>
						<a href="<?=$s9_1_url;?>"><?=$s9_name?></a>
						<div id="subm9" class="dep2 clear">
							<ul>
								<li class="<?=$ln_btn1;?>"><a href="<?=$s9_1_url;?>"><span><?=$s9_1_name;?></span></a></li>
								<!-- <li class="<?=$ln_btn2;?>"><a href="<?=$s9_2_url;?>"><span><?=$s9_2_name;?></span></a></li> -->
								<li class="<?=$ln_btn3;?>"><a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=register_form.php"><span><?=$s9_3_name;?></span></a></li>
							</ul>
						</div>
					</li>
				</ul>	
			</nav>
			<div class="hd_right">
				<div class="hd_sch">
					<figure><img src="<? echo G5_THEME_URL ?>/images/layout/hd_sch.png" /></figure>
					<div class="cnt"><? include_once('hd_sch.php'); ?></div>
				</div>
				<a href="" class="site_map btn_sitemap"><img src="<? echo G5_THEME_URL ?>/images/layout/hd_site.png" /></a>
			</div>
		</div>
	</div>
	<div class="hd_2dep_bg"></div>	
</header>

<?if($screen_div=="sub"){?>
 	<div id="wrap" class="sub_wrap">
		<div class="sv_wrap" >
			<div class="sv_sec sv0<?=$cate_num;?> sv0<?=$cate_num;?>">
				<div class="tit_box ct1">
					<span class="robo">KANS</span>
					<h4 class="nq"><?=$cate_name;?></h4>
				</div>
			</div>
		</div>
		<div class="lnb_wrap clear s<?=$cate_num;?>0<?=$page_num;?>">
			<div class="lnb_box ct1 clear">
				<div class="home"><a href=""></a></div>
				<div class="lnb_dep1">
					<a href="#n"><?=$cate_name?></a>
					<div>
						<ul>
							<li><a href="<?=$s1_1_url;?>"><?=$s1_name?></a></li>
							<li><a href="<?=$s2_1_url;?>"><?=$s2_name?></a></li>
							<li><a href="<?=$s3_1_url;?>"><?=$s3_name?></a></li>
							<li><a href="<?=$s4_1_url;?>"><?=$s4_name?></a></li>
							<li><a href="<?=$s5_1_url;?>"><?=$s5_name?></a></li>
						</ul>
					</div>	
				</div>
				<div class="lnb_dep2">
					<a href="#n"><?=$page_name?></a>
					<div class="siteul_ siteul_<?=$cate_num?>"></div>
				</div>
				<?if($spage_num==null){?>
				<?}else{?>
					<div class="lnb_dep2 lnb_dep3">
						<a href="#n"><?=$spage_name?></a>
						<div class="siteul_ siteul_<?=$cate_num?>"></div>
					</div>
				<?}?>
			</div>
		</div>
		
		<?if($cate_num==1 && $page_num==1 && $spage_num==1){?>
		<div class="dep_4_wrap">
			<ul class="dep_4 ct1">
				<li class="<?=$ssln_btn1;?>"><a href="<?=$s1_1_1_1_url;?>"><span><?=$s1_1_1_1_name;?></span></a></li>
				<li class="<?=$ssln_btn5;?>"><a href="<?=$s1_1_1_2_new_url;?>"><span><?=$s1_1_1_2_new_name;?></span></a></li>
				<li class="<?=$ssln_btn2;?>"><a href="<?=$s1_1_1_2_url;?>"><span><?=$s1_1_1_2_name;?></span></a></li>
				<li class="<?=$ssln_btn4;?>"><a href="<?=$s1_1_1_4_url;?>"><span><?=$s1_1_1_4_name;?></span></a></li>
				<li class="<?=$ssln_btn3;?>"><a href="<?=$s1_1_1_3_url;?>"><span><?=$s1_1_1_3_name;?></span></a></li>
			</ul>
		</div>
		<?}else if($cate_num==1 && $page_num==1  && $spage_num==2) {?>
		<div class="dep_4_wrap">
			<ul class="dep_4 ct1">
				<li class="<?=$ssln_btn1;?>"><a href="<?=$s1_1_2_1_url;?>"><span><?=$s1_1_2_1_name;?></span></a></li>
				<li class="<?=$ssln_btn2;?>"><a href="<?=$s1_1_2_2_url;?>"><span><?=$s1_1_2_2_name;?></span></a></li>
				<li class="<?=$ssln_btn3;?>"><a href="<?=$s1_1_2_3_url;?>"><span><?=$s1_1_2_3_name;?></span></a></li>
			</ul>
		</div>
		<?}else if($cate_num==1 && $page_num==3 && $spage_num==2 ) {?>
			<div class="dep_4_wrap">
			<ul class="dep_4 ct1">
				<li class="<?=$ssln_btn1;?>"><a href="<?=$s1_3_2_1_url;?>"><span><?=$s1_3_2_1_name;?></span></a></li>
				<li class="<?=$ssln_btn2;?>"><a href="<?=$s1_3_2_2_url;?>"><span><?=$s1_3_2_2_name;?></span></a></li>
			</ul>
		</div>
		<?}else if($cate_num==1 && $page_num==3 && $spage_num==3 ) {?>
			<div class="dep_4_wrap">
			<ul class="dep_4 ct1">
				<li class="<?=$ssln_btn1;?>"><a href="<?=$s1_3_3_1_url;?>"><span><?=$s1_3_3_1_name;?></span></a></li>
				<li class="<?=$ssln_btn2;?>"><a href="<?=$s1_3_3_2_url;?>"><span><?=$s1_3_3_2_name;?></span></a></li>
			</ul>
		</div>
		<?}else if($cate_num==1 && $page_num==3 && $spage_num==4 ) {?>
		<div class="dep_4_wrap">
			<ul class="dep_4 ct1">
				<li class="<?=$ssln_btn1;?>"><a href="<?=$s1_3_4_1_url;?>"><span><?=$s1_3_4_1_name;?></span></a></li>
				<li class="<?=$ssln_btn2;?>"><a href="<?=$s1_3_4_2_url;?>"><span><?=$s1_3_4_2_name;?></span></a></li>
				<li class="<?=$ssln_btn3;?>"><a href="<?=$s1_3_4_3_url;?>"><span><?=$s1_3_4_3_name;?></span></a></li>
			</ul>
		</div>
		<?}else if($cate_num==1 && $page_num==3 && $spage_num==5 ) {?>
		<div class="dep_4_wrap">
			<ul class="dep_4 ct1">
				<li class="<?=$ssln_btn1;?>"><a href="<?=$s1_3_5_1_url;?>"><span><?=$s1_3_5_1_name;?></span></a></li>
				<li class="<?=$ssln_btn2;?>"><a href="<?=$s1_3_5_2_url;?>"><span><?=$s1_3_5_2_name;?></span></a></li>
			</ul>
		</div>
		<?}else if($cate_num==1 && $page_num==4 && $spage_num==1 ) {?>
		<div class="dep_4_wrap">
			<ul class="dep_4 ct1">
				<li class="<?=$ssln_btn1;?>"><a href="<?=$s1_4_1_1_url;?>"><span><?=$s1_4_1_1_name;?></span></a></li>
				<li class="<?=$ssln_btn2;?>"><a href="<?=$s1_4_1_2_url;?>"><span><?=$s1_4_1_2_name;?></span></a></li>
			</ul>
		</div>
		<?}else if($cate_num==1 && $page_num==4 && $spage_num==2 ) {?>
		<div class="dep_4_wrap">
			<ul class="dep_4 ct1">
				<li class="<?=$ssln_btn1;?>"><a href="<?=$s1_4_2_1_url;?>"><span><?=$s1_4_2_1_name;?></span></a></li>
				<li class="<?=$ssln_btn2;?>"><a href="<?=$s1_4_2_2_url;?>"><span><?=$s1_4_2_2_name;?></span></a></li>
			</ul>
		</div>
		<?}else{?>
		<?}?>
		<div class="sub_layout sub_layout<?=$cate_num;?> clear ct1">	
			<?if($page_num==null){?>
				<h2 class="tit_bg"><?= $cate_name?></h2>
			<?}else if($spage_num==null){?>
				<h2 class="tit_bg"><?= $page_name?></h2>
			<?}else if($sspage_num==null){?>
				<h2 class="tit_bg"><?= $spage_name?></h2>
			<?}else{?>
				<h2 class="tit_bg"><?= $sspage_name?></h2>
			<?}?>
		<?if($bo_table){?>
			<section class="bd_sec ct1">
		<?}?>
<?}?>



