<? include_once('/kans1/www/origin_home/forum/admin/theme/kans/mobile/head_intro.php'); ?>

<style>
.header .gnb > ul > li:hover  {
	border-bottom: 5px solid #4195d7;
}
.active  {
    border-bottom: 5px solid #4195d7;
}
</style>


<!-- 컨텐츠 : 시작 -->
<header class="header">
	
	<div class="hd_nav clear">
		<div class="hd_bottom ct2 clear">
			<h1 class="logo" style="float: left; width: 227px;">
                <!-- <a href="http://www.kans.re.kr/origin_home/forum/admin/">방사선안전관리자포럼</a></h1> -->
                <a href="http://www.kans.re.kr/origin_home/forum/admin/" style="display: list-item;list-style: none;text-align: center;">
					<img src="http://www.kans.re.kr/img/forum_logo.png" style="vertical-align: middle;"/>
				</a>
			</h1>
			<nav class="gnb" style="margin-left: 0px;">
				<ul class="clear">
					<li style="position: relative; float: left; width: 100px; text-align: center;" class=" headerList" data-active = 'forum_info2'> 
						<a href="http://www.kans.re.kr/bbs/board.php?bo_table=forum_info2">일정</a>
					</li>
					<li style="position: relative; float: left; width: 100px; text-align: center;" class=" headerList" data-active = 'forum_info'> 
						<a href="http://www.kans.re.kr/bbs/board.php?bo_table=forum_info">신청</a>
					</li>
					<li style="position: relative; float: left; width: 100px; text-align: center;" class=" headerList" data-active = 'forum'>
						<a href="http://www.kans.re.kr/bbs/board.php?bo_table=forum"><?=$s2_name?></a>
					</li>
					<li style="position: relative; float: left; width: 100px; text-align: center;" class=" headerList" data-active = 'community'>
						<a href="http://www.kans.re.kr/bbs/board.php?bo_table=community"><?=$s3_name?></a>
					</li>
					<li style="position: relative; float: left; width: 100px; text-align: center;" class=" headerList" data-active = 'newsletter'>
						<a href="http://www.kans.re.kr/bbs/board.php?bo_table=newsletter"><?=$s4_name?></a>
					</li>
					<?php
                	if($is_member){?>
					<li style="position: relative; float: left; width: 100px; text-align: center;" class=" headerList" data-active = 'my_page'>
						<a href="http://www.kans.re.kr/origin_home/forum/admin/my_page/my_page.php"><?=$s5_name?></a>
					</li>
					<?php
                	}
					?>
					<?php
                	if($member['mb_level']>4){?>
					<li style="position: relative; float: left; width: 100px; text-align: center;" class=" headerList" data-active = 'forum_list'>
						<a href="http://www.kans.re.kr/origin_home/forum/admin/bbs/forum_list.php">포럼관리</a>
					</li>
					<li style="position: relative; float: left; width: 100px; text-align: center;" class=" headerList" data-active = 'member_list'>
						<a href="http://www.kans.re.kr/origin_home/forum/admin/bbs/member_list.php">회원관리</a>
					</li>
					<?php
                	}
					?>
				</ul>
			</nav>
			
			<div class="hd_right">
                <?php
                if(!$is_member){?>
                <ul>
                    <li><a href="http://www.kans.re.kr/admin/login.php">로그인</a></li>
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
					<figure><img src="<? echo G5_THEME_URL ?>/images/layout/hd_sch.png" /></figure>
					<div class="cnt"><? include_once('hd_sch.php'); ?></div>
				</div>-->
				<a href="" class="site_map btn_sitemap" style="top: 0px;right: 30px;"><img src="<? echo G5_THEME_URL ?>/images/layout/hd_site.png" /></a>
			</div>
		</div>
	</div>

</header>

<script>
$(document).ready(function(){
	$('.headerList').on('click', function() {
		if(!$(this).hasClass('active')){
			$('.headerList').removeClass('active');
			$(this).addClass('active');
		}
	});
	
	//var _where = window.location.search;
	var where1 = window.location.pathname;
	var where2 = window.location.search;
	var where3 = '';
	if (where1 == '/bbs/board.php') {
		where3 = where2.substr(10);
		document.querySelector('[data-active = "'+where3+'"]').classList.add('active');
	} else if(where1.indexOf('.php')!=-1) {
		var splitStr = where1.split('/');
		where3 = splitStr[5].replace('.php','');
		document.querySelector('[data-active = "'+where3+'"]').classList.add('active');
	}
})
</script>

<!--<?if($screen_div=="sub"){?>
 	<div id="wrap" class="sub_wrap">
		<div class="sv_wrap" >
			<div class="sv_sec sv0<?=$cate_num;?> sv0<?=$cate_num;?>">
				<div class="tit_box ct1">
					<span class="robo">KANS</span>
					<h4 class="nq"><?=$cate_name;?></h4>
				</div>
			</div>
		</div>
	</div>
<?}?>-->

