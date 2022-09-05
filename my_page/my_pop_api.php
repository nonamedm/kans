<?
	include_once('./_common.php');
	include_once(G5_THEME_PATH.'/head.sub.php');

	$info = Array();

	// api에서 정보가져오기
	// API 회원의 수강내역 가져오기
	$url = "https://www.kanselearning.kr/mediopia/calleduCompleteStudentInfoListKanselearningJSON?USER_ID={$mb_id}";
	$data = preg_replace("/\n+/", "", file_get_contents_curl2($url));
	
	$data_ = json_decode($data, true);

	for ($i = 0; $i < count($data_); $i++) {
		if($data_[$i]['EDU_CD'] == $EDU_CD){ $info = $data_[$i]; break; }
	}

	// echo "<pre>"; print_r($info); echo "</pre>";
	
	// 관리자가 아니면서, 본인 신청서 또는 교육담당생이 아닐 경우
	// if(!$is_admin && $view['mb_id'] != $member['mb_id'] && $info['USER_NM'] != $member['mb_id']){ alert_close("올바른 접근이 아닙니다."); exit; }
	
	// 조회하려는 회원분 정보
	$temp_mb = get_member($mb_id);

	// 관리자가 아니면서, 본인 신청서가 아닐 경우
	if(!$is_admin && $info['PROF_ID'] != $mb_id){
		
		// 단체회원이 아니면서 소속도 다를 경우
		if($member["mb_level"] < 3 && $member["mb_1"] != $temp_mb['mb_1']){ alert_close("올바른 접근이 아닙니다."); exit; }
	}

	// 교육일 표기
	$pro_day = "";
	$finsh_day = "";
	$finsh_year = "";
	// 교육일정이 같은날일 경우
	if($info['SERVICEEND_DATE'] && $info['SERVICESTART_DATE'] == $info['SERVICEEND_DATE']){
		$pro_day = date("Y년 m월 d일", strtotime($info['SERVICESTART_DATE']));
		$finsh_day = date("Y년 m월 d일", strtotime($info['SERVICESTART_DATE']));
		$finsh_year = date("y", strtotime($info['SERVICESTART_DATE']));
	}
	else{
		$pro_day = date("Y년 m월 d일", strtotime($info['SERVICESTART_DATE']))." ~ ".date("Y년 m월 d일", strtotime($info['SERVICEEND_DATE']));
		$finsh_day = date("Y년 m월 d일", strtotime($info['SERVICEEND_DATE']));
		$finsh_year = date("y", strtotime($info['SERVICEEND_DATE']));
	}

	$pro_day = substr($info['COMPLETE_DATE'], 0, 4).".".substr($info['COMPLETE_DATE'], 4, 2).".".substr($info['COMPLETE_DATE'], 6, 2);

	// 수료증 번호 추가 처리
	$add_text = "";

	$pro_time = "(".$info['LEARNING_TIME']."시간)";
	

	// 보수교육
	/* if($program_info['wr_1'] == '20'){
		$add_text = "-L";
	} */
?>

<div class="my_print_wrap">
	<div class="center_logo"><img src="<? echo G5_URL ?>/my_page/img/print_bg.png" alt=""></div>
	<div class="my_print">
		<div class="my_print_hd">
			<!-- <p class="print_num">제 KANS-<?php echo $finsh_year; ?><?php echo $add_text; ?>-<?php echo $wr_26_; ?> 호</p> -->
			<p class="print_num"><?php echo $info['CERT_NO']; ?></p>
			<h2 class="my_print_tit">수&nbsp;&nbsp;&nbsp;료&nbsp;&nbsp;&nbsp;증</h2>
		</div>
		<div class="my_print_cnt">
			<ul>
				<li>
					<h6><span>소 속</span> :</h6>
					<p><?php echo $temp_mb['mb_2']; ?></p>
				</li>
				<li>
					<h6><span>성 명</span> :</h6>
					<p><?php echo $temp_mb['mb_name']; ?></p>
				</li>
				<li>
					<h6><span>생년월일</span> :</h6>
					<p><?php echo $temp_mb['mb_3']."-".$temp_mb['mb_4']; ?></p>
				</li>
				<li>
					<h6><span>교 육 명</span> :</h6>
					<p><?php echo $info['CATE2']; ?> <?php echo $info['CATE3']; ?></p>
				</li>
				<li>
					<h6><span>교 육 일</span> :</h6>
					<div class="day_box">
						<p><?php echo $pro_day; ?> </p>
						<b><?php echo $pro_time; ?></b>
					</div>
				</li>
<!-- 이부분은 면허소지자 보수교육에 추가됩니다. -->
				<?php if($program_info['wr_1'] == '20' || $program_info['wr_1'] == '40'){ // 보수교육, 기타 ?>
					<?php if($view['wr_8'] && $view['wr_9']){ // 면허종류, 면허번호가 있을 경우 ?>
				<!-- <li>
					<h6><span>면허종류</span> :</h6>
					<p><?php echo $view['wr_8']; ?></p>
				</li>
				
				<li>
					<h6><span>면허번호</span> :</h6>
					<p><?php echo $view['wr_9']; ?></p>
				</li> -->
					<?php } ?>
				<?php } ?>
			</ul>
			
			<div class="text_area">
				<p>위 사람은 상기 교육을 수료하였으므로 이 증서를 수여합니다.</p>
				<h4><?php echo $finsh_day; ?></h4>
			</div>

			<div class="sign">
				<img src="<? echo G5_URL ?>/my_page/img/print_sign.png" alt="">
			</div>
		</div>
	</div>
</div>

<!-- <script>
	setTimeout(function(){ 
		window.print();
	},2000);
</script> -->

<style>
	@font-face {
    font-family: 'GyeonggiBatang';
    src: url('https://cdn.jsdelivr.net/gh/projectnoonnu/noonfonts_one@1.0/GyeonggiBatang.woff') format('woff');
    font-weight: normal;
    font-style: normal;
	}
	.center_logo{position: absolute; left: 50%; top: 50%; transform:translate(-50%, -50%); z-index: -1;}
	.my_print_wrap{max-width:730px; box-sizing: border-box; padding: 30px; margin: 0 auto;}
	.my_print{height: 970px; border: 1px solid #000; /* background: url(./img/print_bg.png) center no-repeat;  */box-sizing: border-box; padding: 55px 50px 0; }
	.my_print .my_print_hd .print_num{font-size: 18px; line-height: 1; color: #454545; letter-spacing: -0.03em;}
	.my_print .my_print_hd .my_print_tit{font-family: 'GyeonggiBatang'; font-size: 50px; line-height: 1; font-weight: 700; color: #111; text-align: center; margin-top: 87px; margin-bottom: 83px; letter-spacing: 0;}
	.my_print .my_print_cnt ul > li{display: flex; line-height: 22px; align-items: flex-start;}
	.my_print .my_print_cnt ul > li h6{width: 80px; display: inline-block; font-size: 16px; color: #111; font-weight: 500; }
	.my_print .my_print_cnt ul > li h6 span{display: inline-table; font-size: 16px; color: #111; font-weight: 500; text-align: justify; width: 57px; letter-spacing: -0.03em; line-height: 1; margin-right: 10px;}
	.my_print .my_print_cnt ul > li h6 span:after{content: ''; display: inline-block;	width: 100%;}
	.my_print .my_print_cnt ul > li p{font-size: 16px; color: #666; padding-left: 10px;}
	.my_print .my_print_cnt ul > li > .day_box{width: calc(100% - 73px); display: flex; }
	.my_print .my_print_cnt ul > li > .day_box b{font-size: 16px; font-weight: 500; color: #014693;}
	.my_print .text_area {text-align: center;}
	.my_print .text_area p{font-size: 16px; line-height: 32px; letter-spacing: -0.03em; color: #111; margin: 94px 0 111px;}
	.my_print .text_area h4{font-size: 18px; line-height: 1; color: #111; letter-spacing: -0.03em; font-weight: 400; margin-bottom: 51px;}
	.my_print .sign{text-align: right; padding-right: 23px; }
	.my_print .sign img{width: auto; max-width:90%;}

	body{min-width:0px !important; }
</style>

