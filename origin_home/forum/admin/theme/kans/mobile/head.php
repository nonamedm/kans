<? include_once('/kans1/www/origin_home/safety/theme/kans/mobile/head_intro.php'); ?>

<style>
.header .gnb > ul > li:hover  {
	border-bottom: 5px solid #014594;
}
</style>


<!-- 컨텐츠 : 시작 -->
<header class="header">
	
	<div class="hd_nav clear">
		<div class="hd_bottom ct2 clear">
			<h1 class="logo" style="float: left; width: 227px;">
                <!-- <a href="http://www.kans.re.kr/origin_home/safety/">방사선안전관리자포럼</a></h1> -->
                <a href="http://www.kans.re.kr/origin_home/safety/" style="display: list-item;list-style: none;text-align: center;">
					<img src="http://www.kans.re.kr/img/forum_logo.png" style="vertical-align: middle;"/>
				</a>
			</h1>
			<nav class="gnb" style="margin-left: 0px;">
				<ul class="clear">
					<li style="position: relative; float: left; width: 100px; text-align: center;" class=" headerList"> 
						<a href="">정보광장</a>
						<div id="subm1" class="dep2 clear">
							<ul class="af">
								<li class="<?=$ln_btn1;?>"><a href="http://www.kans.re.kr/bbs/board.php?bo_table=forum_info2"><span>일정</span></a>
								</li>
								<li class="<?=$ln_btn4;?>"><a href="http://www.kans.re.kr/bbs/board.php?bo_table=forum_info"><span>신청</span></a>
								</li>
								<li class="<?=$ln_btn4;?>"><a href="http://www.kans.re.kr/bbs/board.php?bo_table=forum"><span>News</span></a>
								</li>
								<li class="<?=$ln_btn4;?>"><a href=""><span>체험관</span></a>
								</li>
							</ul>
						</div>
					
					</li>

					<li style="position: relative; float: left; width: 100px; text-align: center;" class=" headerList">
						<a href="http://www.kans.re.kr/bbs/board.php?bo_table=community"><?=$s3_name?></a>
					</li>
					
					<li style="position: relative; float: left; width: 100px; text-align: center;" class=" headerList">
						<a href="http://www.kans.re.kr/bbs/board.php?bo_table=community">회원광장</a>
						<div id="subm2" class="dep2 clear">
							<ul class="af">
								<li class="<?=$ln_btn1;?>">
									<a href="http://www.kans.re.kr/bbs/board.php?bo_table=newsletter">
										<span>고급News</span>
									</a>
								</li>
								<?php if($is_member){?>
									<li class="<?=$ln_btn1;?>">
										<a href="http://www.kans.re.kr/origin_home/safety/my_page/my_page.php">
											<span><?=$s5_name?></span>
										</a>
									</li>
									<?php
									}
								?>
							</ul>
						</div>
					</li>

					
					<?php
                	if($member['mb_level']>4){?>
					<li style="position: relative; float: left; width: 100px; text-align: center;" class=" headerList">
						<a href="http://www.kans.re.kr/origin_home/safety/bbs/forum_list.php">신청관리</a>
					</li>
					<li style="position: relative; float: left; width: 100px; text-align: center;" class=" headerList">
						<a href="http://www.kans.re.kr/origin_home/safety/bbs/member_list.php">회원관리</a>
					</li>
					<?php
                	}
					?>
				</ul>
			</nav>
			
			<div class="hd_right">
                <?php
                if(!$is_member){?>
                <ul style="margin-top:-39px;">
                    <li><a href="http://www.kans.re.kr/origin_home/safety/admin/login.php">로그인</a></li>
                    <!-- <li>/</li>
                    <li><a href="">회원가입</a></li> -->
                <?php
                }else{
                    ?>
                    <ul style="margin-top:-39px;">
                        <li><a href="http://www.kans.re.kr/origin_home/safety/bbs/logout.php">로그아웃</a></li>
						<?
                }
                ?>
					<li style="margin-left: 40px;">
						<a href="http://kans.re.kr">
							<img src="http://www.kans.re.kr/img/kans_logo.png">
						</a>
					</li>
				</ul>
				<!--<div class="hd_sch">
					<figure><img src="<? echo G5_THEME_URL ?>/images/layout/hd_sch.png" /></figure>
					<div class="cnt"><? include_once('hd_sch.php'); ?></div>
				</div>-->
				<a href="" class="site_map btn_sitemap" style="top: 0px;right: 30px;"><img src="<? echo G5_THEME_URL ?>/images/layout/hd_site.png" /></a>
			</div>
		</div>
	</div>
	<div class="hd_2dep_bg"></div>					
</header>

<script>
$(document).ready(function(){
	
});
function fileDownload(filepath,filename) {
	if(navigator.userAgent.toLowerCase().indexOf('mobileapp') != -1 || navigator.userAgent.toLowerCase().indexOf('iosapp') != -1){
      //앱으로의 호출시 가이드드린 파일다운로드 방식으로 호출 로직 적용
      
      var param = {
         action:"filedownload",
         downloadurl:filepath,
         filename:filename //다운받는 파일명 지정
      };
      webkit.messageHandlers.cordova_iab.postMessage(JSON.stringify(param));
      
   } else {	
      window.open(filepath,"_blank");
   }
}
</script>



