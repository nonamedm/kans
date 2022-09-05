<?
	include_once('./_common.php');
	include_once(G5_THEME_PATH.'/head.sub.php');
	
	if (!isset($wr_id) || !$wr_id){ alert_close("올바른 접근이 아닙니다."); exit; }
	
	// 신청자 정보
	$bo_table = $applicant_table;
	$write_table = $g5['write_prefix'] . $bo_table;
	$view = sql_fetch(" SELECT * FROM ".$write_table." WHERE wr_id = '".$wr_id."' AND wr_17 = '결제완료' ");

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
	// 교육일정이 같은날일 경우
	if($program_info['wr_4'] && $program_info['wr_3'] == $program_info['wr_4']){
		$pro_day = date("Y년 m월 d일", strtotime($program_info['wr_3']));
		$finsh_day = date("Y년 m월 d일", strtotime($program_info['wr_3']));
	}
	else{
		$pro_day = date("Y년 m월 d일", strtotime($program_info['wr_3']))." ~ ".date("Y년 m월 d일", strtotime($program_info['wr_4']));
		$finsh_day = date("Y년 m월 d일", strtotime($program_info['wr_4']));
	}

	// 결제정보
	/* $order_sql = " SELECT b.od_receipt_time
				FROM ".$g5['g5_shop_cart_table']." a
				INNER JOIN ".$g5['g5_shop_order_table']." b
					ON a.od_id = b.od_id
				WHERE a.ct_id = '".$view['wr_25']."' AND a.ct_1 = '".$wr_id."'";
	$order_info = sql_fetch($order_sql); */
?>

<div class="my_print_wrap">
	<div class="my_print">
		<div class="my_print_hd">
			<p class="print_num"></p>
			<h2 class="my_print_tit">교육비&nbsp;&nbsp;납부&nbsp;&nbsp;확인서</h2>
		</div>
		<div class="my_print_cnt">
			<ul>
				<li>
					<h6><span>교육과정</span> :</h6>
					<p><?php echo $program_info['wr_subject']; ?></p>
				</li>
				<li>
					<h6><span>교 육 일</span> :</h6>
					<div class="day_box">
						<p><?php echo $pro_day; ?> </p>
						<b><?php echo $pro_time; ?></b>
					</div>
				</li>
				<li>
					<h6><span>기 관 명</span> :</h6>
					<p><?php echo $view['wr_2']; ?></p>
				</li>
				<li>
					<h6><span>교 육 생</span> :</h6>
					<p><?php echo $view['wr_3']; ?></p>
				</li>
				<li>
					<h6><span>납 부 액</span> :</h6>
					<p><?php echo number_format($view['wr_15']); ?> 원</p>
				</li>
				<li>
					<h6><span>납 부 일</span> :</h6>
					<p><?php echo $view['wr_27']; ?></p>
				</li>
			</ul>
			
			<div class="text_area">
				<p>위와 같이 납부하였음을 확인함.</p>
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

	.my_print_wrap{max-width:730px; box-sizing: border-box; padding: 30px; margin: 0 auto;}
	.my_print{height: 970px; border: 1px solid #000; background: url(./img/print_bg.png) center no-repeat; box-sizing: border-box; padding: 55px 50px 0; }
	.my_print .my_print_hd .print_num{font-size: 18px; line-height: 1; color: #454545; letter-spacing: -0.03em;}
	.my_print .my_print_hd .my_print_tit{font-family: 'GyeonggiBatang'; font-size: 50px; line-height: 1; font-weight: 700; color: #111; text-align: center; margin-top: 87px;  margin-bottom: 83px; letter-spacing: 0;}
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
	.my_print  .sign{text-align: right; padding-right: 23px;}
	body{min-width:0px !important; }

.my_print .sign{text-align: right; padding-right: 23px; }
	.my_print .sign img{width: auto; max-width:90%;}

</style>

