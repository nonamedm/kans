<? include_once(G5_THEME_MOBILE_PATH.'/head_intro.php'); ?>

<!-- 컨텐츠 : 시작 -->
<header class="header">
	
	<div class="hd_nav clear">
		<div class="hd_bottom ct1 clear">
			<h1 class="logo"><a href="<?php echo G5_URL ?>">방사선안전관리자포럼</a></h1>
			<nav class="gnb">
				<ul class="clear">
					<li> 
						<a href="http://www.kans.re.kr/bbs/board.php?bo_table=forum_info"><?=$s1_name?></a>
					</li>
					<li>
						<a href="http://www.kans.re.kr/bbs/board.php?bo_table=forum"><?=$s2_name?></a>
					</li>
					<li>
						<a href="http://www.kans.re.kr/bbs/board.php?bo_table=community"><?=$s3_name?></a>
					</li>
					<li>
						<a href="http://www.kans.re.kr/bbs/board.php?bo_table=newsletter"><?=$s4_name?></a>
					</li>
				</ul>
			</nav>
            <div class="hd_right">
                <?php
                if(!$is_member){?>
                    <ul>
                        <li><a href="<?php echo G5_URL?>/admin/login.php?url=">로그인</a></li>
                        <li>/</li>
                        <li><a href="">회원가입</a></li>
                    </ul>
                    <?php
                }else{
                    ?>
                    <ul>
                        <li><a href="<?php echo G5_URL?>/bbs/logout.php">로그아웃</a></li>
                    </ul>
                    <?
                }
                ?>

                <!--<div class="hd_sch">
					<figure><img src="<?/* echo G5_THEME_URL */?>/images/layout/hd_sch.png" /></figure>
					<div class="cnt"><?/* include_once('hd_sch.php'); */?></div>
				</div>
				<a href="" class="site_map btn_sitemap"><img src="<?/* echo G5_THEME_URL */?>/images/layout/hd_site.png" /></a>-->
            </div>
		</div>
	</div>

</header>



