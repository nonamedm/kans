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
<section id="wrap" class="main_forum2_wrap" style="margin-top: 125px;">
    <div class="main_forum2">
        <div class="img"><img src="http://www.kans.re.kr/img/main_img.png"/></div>
            <div class="mv_slog" style="padding: 40px;">
                <p class="t2 main_forum_titile">
                    이곳은 <strong>"언제나, 어디서나, 간편하게"<br>
                    방사선 안전에 관하여 알아볼 수 있는 정보의 장</strong>입니다.<br>
                    자주 방문하셔서 방사선안전에 관한 궁금증을 해소하시고<br>
                    방사선안전문화 확신에 동점해주세요.<br>
                    <br>
                    <strong>원자력안전아카데미</strong>
                </p>
            </div>
        </div>
</section>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css"/>
<div class="mcnt_box ct2 clear forum_box" style="margin-bottom:60px;">
	<ul>
        <li>
            <ul class="forum_titile">
                <li>포럼안내</li>
                <li>
                    <a class="slick-next" href="http://www.kans.re.kr/bbs/board.php?bo_table=forum_info">
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
                            <div class="fr_li_box">

                                <span class="fr_sp fr_tit">
                                    <a href="http://www.kans.re.kr/bbs/board.php?bo_table=forum_info&wr_id=<?php echo $row['wr_id'] ?>"><?php echo $row['wr_subject'] ?></a>
                                </span>
                                <span class="fr_day"><?php echo $row['wr_last'] ?></span>
                                <span class="fr_sp fr_con"><?php echo $row['wr_content'] ?></span>
                                <!--<span class="fr_sp fr_con"><a href="">신청</a><a href="">링크</a> <a href="">툴</a> <a href="">안내</a></span>-->
                            </div>
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
                <li><a class="slick-next" href="http://www.kans.re.kr/bbs/board.php?bo_table=forum"></a></li>
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

                            <div class="fr_li_box">
                                <span class="fr_sp fr_tit">
                                    <a href="http://www.kans.re.kr/bbs/board.php?bo_table=forum&wr_id=<?php echo $row['wr_id'] ?>"><?php echo $row['wr_subject'] ?></a>
                                </span>
                                <span class="fr_day"><?php echo $row['wr_last'] ?></span>
                                <span class="fr_sp fr_con"><?php echo $row['wr_content'] ?></span>
                                <!--<span class="fr_sp fr_con"><a href="">신청</a><a href="">링크</a> <a href="">툴</a> <a href="">안내</a></span>-->
                            </div>
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

</script>


<!-- 컨텐츠 : 종료 -->
<?php include_once(G5_THEME_MOBILE_PATH.'/tail.php'); ?>