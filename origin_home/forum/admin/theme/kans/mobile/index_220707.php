<?php header("Content-Type:text/html;charset=utf-8");
   if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

 /*  if(G5_COMMUNITY_USE === false) {
      include_once(G5_THEME_MSHOP_PATH.'/index.php');
      return;
   }*/

   include_once(G5_THEME_MOBILE_PATH.'/head.php');

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!-- 컨텐츠 : 시작 -->
<section id="wrap" class="main_wrap ct1 clear" style="width:100%;">
	<article class="mv_sec">
		<div class="owl-carousel owl-theme mv_owl">
			<div class="item mv01">
				<div class="img"></div>
				<div class="mv_slog">
					<!--<h2 class="t1 robo">KOREA ACADEMY<br>OF NUCLEAR SAFETY</h2>-->
					<p class="t2"> 
                        이곳은 <strong>"언제나, 어디서나, 간편하게"<br>
                        방사선 안전에 관하여 알아볼 수 있는 정보의 장</strong>입니다.<br>
                        자주 방문하셔서 방사선안전에 관한 궁금증을 해소하시고<br>
                        방사선안전문화 확신에 동점해주세요.<br>
                        <br>
                        <strong>원자력안전아카데미</strong>
                        
					</p>
				</div>
			</div>
			<div class="item mv02">
				<div class="img"></div>
				<div class="mv_slog">
					<h2 class="t1 robo">KOREA ACADEMY<br>OF NUCLEAR SAFETY</h2>
					<p class="t2"> 
						한국원자력안전아카데미는<br>
						원자력안전에 관한 국민 이해 증진을 도모하고<br>
						안전문화확산에 기여하고자 <br>
						노력하고 있습니다.
					</p>
				</div>
			</div>
			<div class="item mv03">
				<div class="img"></div>
				<div class="mv_slog">
					<h2 class="t1 robo">KOREA ACADEMY<br>OF NUCLEAR SAFETY</h2>
					<p class="t2"> 
						한국원자력안전아카데미는<br>
						원자력안전에 관한 국민 이해 증진을 도모하고<br>
						안전문화확산에 기여하고자 <br>
						노력하고 있습니다.
					</p>
				</div>
			</div>
		</div>
	</article>
</section>
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css"
    />
<div class="mcnt_box ct1 clear forum_box" style="margin-bottom:100px;">
	<ul>
        <li>
            <ul class="forum_titile">
                <li>포럼안내</li>
                <li>
                    <a href="http://www.kans.re.kr/bbs/board.php?bo_table=forum_info">
                        <i class="fa-solid fa-chevron-right"></i>
                    </a>
                </li>
            </ul>
            <div class="forum_con">
                <ul>
                    <?php
                    $sql="  SELECT 
                                wr_id,
                                wr_subject,
                                REPLACE(REPLACE(wr_content,'<p>',''),'</p>','') AS wr_content,
                                substring(wr_last, 1, 10) AS wr_last
                                FROM g5_write_forum_info ORDER BY wr_id desc limit 5;";
                    $datarow= sql_query($sql);

                    for ($i=0; $i<$row=sql_fetch_array($datarow); $i++){
                        ?>
                        <li>
                            <span class="fr_sp fr_tit"><?php echo $row['wr_subject'] ?></span>
                            <span class="fr_day"><?php echo $row['wr_last'] ?></span>
                            <span class="fr_sp fr_con"><?php echo $row['wr_content'] ?></span>
                            <span class="fr_sp fr_con"><a href="">신청</a><a href="">링크</a> <a href="">툴</a> <a href="">안내</a></span>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </li>
        <li>
            <ul class="forum_titile">
                <li>포럼기록</li>
                <li><a href="http://www.kans.re.kr/bbs/board.php?bo_table=forum"> > </a></li>
            </ul>
            <div class="forum_con">
                <ul>
                    <?php
                        $sql="  SELECT 
                                wr_id,
                                wr_subject,
                                REPLACE(REPLACE(wr_content,'<p>',''),'</p>','') AS wr_content,
                                substring(wr_last, 1, 10) AS wr_last
                                FROM g5_write_forum ORDER BY wr_id desc limit 5;";
                        $datarow= sql_query($sql);

                    for ($i=0; $i<$row=sql_fetch_array($datarow); $i++){
                    ?>
                        <li>
                            <span class="fr_sp fr_tit"><?php echo $row['wr_subject'] ?></span>
                            <span class="fr_day"><?php echo $row['wr_last'] ?></span>
                            <span class="fr_sp fr_con"><?php echo $row['wr_content'] ?></span>
                            <span class="fr_sp fr_con"><a href="">신청</a><a href="">링크</a> <a href="">툴</a> <a href="">안내</a></span>
                        </li>
                    <?php
                         }
                    ?>
                </ul>
            </div>
        </li>
    </ul>
</div>


<script>
	$(function(){
		// Main Visual
		var Mv_owl = $(".mv_owl").owlCarousel({
			animateIn : 'fadeIn',
			animateOut : 'fadeOut',
			items : 1,
			loop : false,
			margin : 0,
			autoplay : false,
			autoplayTimeout : 8000,
			//autoplayHoverPause : true,
			dots : false,
			nav : false,
			mouseDrag:false
		});	
	});

/*	$(function(){
		$('#slick_slider').slick({
			infinite: true,
			slidesToShow: 5,
			autoplay: true,
			slidesToScroll: 1,
			cssEase: 'linear',
			speed: 4000,
			autoplaySpeed:0,
			prevArrow : "<button type='button' class='slick-prev'></button>",		// 이전 화살표 모양 설정
			nextArrow : "<button type='button' class='slick-next'></button>"	// 다음 화살표 모양 설정
		});
	});*/

	
</script>


<!-- 컨텐츠 : 종료 -->
<?php include_once(G5_THEME_MOBILE_PATH.'/tail.php'); ?>