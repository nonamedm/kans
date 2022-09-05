<?
	include_once('./_common.php');
	include_once(G5_THEME_PATH.'/head.sub.php');
	
	if (!isset($wr_id) || !$wr_id){ alert_close("올바른 접근이 아닙니다."); exit; }
	
	// 신청자 정보
	$bo_table = $applicant_table;
	$write_table = $g5['write_prefix'] . $bo_table;
	$view = sql_fetch(" SELECT * FROM ".$write_table." WHERE wr_id = '".$wr_id."' AND wr_18 = '교육수료' ");

	// 발급번호 부여
	$temp_26_ = 0;
	// 발급번호가 없을 경우
	if(!$view['wr_26']){
		
		// 현 교육의 교육수료 받은 사람 중 가장 큰 발급번호
		$max_info = sql_fetch(" SELECT MAX(wr_26) max_26 FROM ".$write_table." WHERE wr_1 = '".$view['wr_1']."' AND wr_18 = '교육수료' ");
		
		// 가장 큰 발급번호가 없을 경우(=최초 발급일 경우)
		if(!$max_info['max_26']){ $temp_26_++; }
		else{ $temp_26_ = $max_info['max_26'] + 1; }
		
		// 발급번호 업데이트 처리
		$update_query = " UPDATE ".$write_table." SET
								wr_26 = '".$temp_26_."' 
							WHERE wr_id = '".$wr_id."' ";
		sql_query($update_query);
	}
	// 발급번호가 있을 경우
	else{
		$temp_26_ = $view['wr_26'];
	}
	
	// 신청서 정보가 없을 경우
	if(!$view['wr_id']){ alert_close("올바른 접근이 아닙니다."); exit; }

	// 관리자가 아니면서, 본인 신청서 또는 교육담당생이 아닐 경우
	if(!$is_admin && $view['mb_id'] != $member['mb_id'] && $view['wr_14'] != $member['mb_id']){ alert_close("올바른 접근이 아닙니다."); exit; }

	// 교육일정 정보
	$tmp_write_table = $g5['write_prefix'] . substr($bo_table, 0, -2);
	$program_info = sql_fetch(" SELECT * FROM ".$tmp_write_table." WHERE wr_id = '".$view['wr_1']."' ");
	
	// 교육일 표기
	$pro_day = "";
	$finsh_day = "";
	$finsh_year = "";
	// 교육일정이 같은날일 경우
	if($program_info['wr_4'] && $program_info['wr_3'] == $program_info['wr_4']){
		$pro_day = date("Y년 m월 d일", strtotime($program_info['wr_3']));
		$finsh_day = date("Y년 m월 d일", strtotime($program_info['wr_3']));
		$finsh_year = date("y", strtotime($program_info['wr_3']));
	}
	else{
		$pro_day = date("Y년 m월 d일", strtotime($program_info['wr_3']))." ~ ".date("Y년 m월 d일", strtotime($program_info['wr_4']));
		$finsh_day = date("Y년 m월 d일", strtotime($program_info['wr_4']));
		$finsh_year = date("y", strtotime($program_info['wr_4']));
	}

	// 수료증 번호 추가 처리
	$add_text = "";

	$pro_time = "";
	// 직장교육
	if($program_info['wr_1'] == '10'){
		if($program_info['wr_2'] == '1010'){ $pro_time = "(총 4시간)"; }	// 일반신규
		if($program_info['wr_2'] == '1020'){ $pro_time = "(총 3시간)"; }	// 일반정기
		if($program_info['wr_2'] == '1030'){ $pro_time = "(총 6시간)"; }	// 비파괴신규
		if($program_info['wr_2'] == '1040'){ $pro_time = "(총 5시간)"; }	// 비파괴정기
	}

	// 보수교육
	if($program_info['wr_1'] == '20'){
		if($program_info['wr_2'] == '2010'){ $pro_time = "(총 12시간)"; }	// 면허소지자 보수교육
		
		$add_text = "-L";
	}

	// 전문교육, 기타
	if($program_info['wr_1'] == '30' || $program_info['wr_1'] == '40'){ $pro_time = ""; }
	
	// 발급번호 처리
	$wr_26_ = "";
	for($i = 0; $i < (5-strlen($temp_26_)); $i++){
		$wr_26_ = "0".$wr_26_;
		
	}
	$wr_26_ .= $temp_26_;
?>

<div class="my_print_wrap">
	<div class="center_logo"><img src="<? echo G5_URL ?>/my_page/img/print_bg.png" alt=""></div>
	<div class="my_print">
		<div class="my_print_hd">
			<p class="print_num">제 KANS-<?php echo $finsh_year; ?><?php echo $add_text; ?>-<?php echo $wr_26_; ?> 호</p>
			<h2 class="my_print_tit">수&nbsp;&nbsp;&nbsp;료&nbsp;&nbsp;&nbsp;증</h2>
		</div>
		<div class="my_print_cnt">
			<ul>
				<li>
					<h6><span>소 속</span> :</h6>
					<p><?php echo $view['wr_2']; ?></p>
				</li>
				<li>
					<h6><span>성 명</span> :</h6>
					<p><?php echo $view['wr_3']; ?></p>
				</li>
				<li>
					<h6><span>생년월일</span> :</h6>
					<p><?php echo $view['wr_4']; ?></p>
				</li>
				<li>
					<h6><span>교 육 명</span> :</h6>
					<p><?php echo $program_info['wr_subject']; ?></p>
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
				<li>
					<h6><span>면허종류</span> :</h6>
					<p><?php echo $view['wr_8']; ?></p>
				</li>
				
				<li>
					<h6><span>면허번호</span> :</h6>
					<p><?php echo $view['wr_9']; ?></p>
				</li>
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
	.my_print{height: 970px; border: 1px solid #0c3354; /* background: url(./img/print_bg.png) center no-repeat;  */box-sizing: border-box; padding: 55px 50px 0; }
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


</style>

