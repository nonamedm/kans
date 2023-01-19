<?php header("Content-Type:text/html;charset=utf-8");
   if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

 /*  if(G5_COMMUNITY_USE === false) {
      include_once(G5_THEME_MSHOP_PATH.'/index.php');
      return;
   }*/

   include_once(G5_THEME_MOBILE_PATH.'/head.php');

?>

<link rel="stylesheet" href="https://cdnjs.cloudf 10%;lare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css"/>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!-- 컨텐츠 : 시작 -->
    <section id="wrap" class="main_forum2_wrap" style="margin-top: 95px;">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="mv_slog" style="padding: 40px; position: absolute; z-index: 1; left: 20%; top:10%;">
                        <p class="t2 main_forum_titile">
                            KANS는<br>
                            원자력안전위원회 허가를 받아<br>
                            설립된 사단법인입니다.
                        </p>
                    </div>
                    <div style="background-color:black;width: 100%;height: 100%;position: absolute;opacity: 50%;"></div>
                    <img class="d-block w-100" src="http://www.kans.re.kr/img/main_img1.jpg" alt="..." />
                </div>
                <div class="carousel-item">
                    <div class="mv_slog" style="padding: 40px; position: absolute; z-index: 1; left: 20%; top:10%;">
                        <p class="t2 main_forum_titile">
                            KANS는<br>
                            방사선안전문화 확산에<br>
                            기여하고 있습니다.
                        </p>
                    </div>
                    <div style="background-color:black;width: 100%;height: 100%;position: absolute;opacity: 50%;"></div>
                    <img class="d-block w-100" src="http://www.kans.re.kr/img/main_img2.jpg" alt="..." />
                </div>
                <div class="carousel-item">
                    <div class="mv_slog" style="padding: 40px; position: absolute; z-index: 1; left: 20%; top:10%;">
                        <p class="t2 main_forum_titile">
                            KANS는<br>
                            최고의 방사선안전정보를<br>
                            제공합니다.
                        </p>
                    </div>
                    <div style="background-color:black;width: 100%;height: 100%;position: absolute;opacity: 50%;"></div>
                    <img class="d-block w-100" src="http://www.kans.re.kr/img/main_img3.jpg" alt="..." />
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
<div class="mcnt_box ct2 clear forum_box" style="margin-bottom:60px;">
	<ul>
        <li>
            <ul class="forum_titile">
                <li style="color:white;">News</li>
                <li>
                    <a class="slick-next" href="http://www.kans.re.kr/bbs/board.php?bo_table=forum">
                    </a>
                </li>
            </ul>
            <div class="forum_con" style="overflow:hidden;">
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
        <li style="display: flex;flex-direction: column;justify-content: space-between;">
            <div id="sqBox" style="">
                <a href="/bbs/board.php?bo_table=forum_info2" id="forum_info" style="width: 47.5%;background-color: #014594;background-image: url('http://www.kans.re.kr/img/schedule.png'); background-repeat:no-repeat; background-position:center;"></a>
                <a href="/bbs/board.php?bo_table=forum_info" id="forum" style="width: 47.5%;background-color: #014594;background-image: url('http://www.kans.re.kr/img/apply.png'); background-repeat:no-repeat; background-position:center;"></a>
            </div>            
            <div id="exp" style="">
                <h2 style="color: black;">
                    <span style="">체험관</span>
                </h2>
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
			autoplayTimeout : 3000,
			//autoplayHoverPause : true,
			dots : false,
			nav : false,
			mouseDrag:false
		});	
        
        setTimeout(function(){
            webkit.messageHandlers.cordova_iab.postMessage(JSON.stringify({"action": "getpushid","callback": "get_pushid"}));
		},500);
	});
    
    function get_pushid(pushid) {
        //푸시아이디 확인(푸시아이디 저장처리등의 로직이 들어가면 됨)
        console.log(pushid);  //푸시아이디 확인(테스트용)
    }

</script>


<!-- 컨텐츠 : 종료 -->
<?php include_once(G5_THEME_MOBILE_PATH.'/tail.php'); ?>