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
		// $finsh_year = date("y", strtotime($info['SERVICESTART_DATE']));
		$finsh_year = date("Y", strtotime($info['SERVICESTART_DATE'])); // 2022.09.29 요청
	}
	else{
		$pro_day = date("Y년 m월 d일", strtotime($info['SERVICESTART_DATE']))." ~ ".date("Y년 m월 d일", strtotime($info['SERVICEEND_DATE']));
		$finsh_day = date("Y년 m월 d일", strtotime($info['SERVICEEND_DATE']));
		// $finsh_year = date("y", strtotime($info['SERVICEEND_DATE']));
		$finsh_year = date("Y", strtotime($info['SERVICEEND_DATE'])); // 2022.09.29 요청
	}

	$pro_day = substr($info['COMPLETE_DATE'], 0, 4).".".substr($info['COMPLETE_DATE'], 4, 2).".".substr($info['COMPLETE_DATE'], 6, 2);
	$pro_time = "(".$info['LEARNING_TIME']."시간)";

	$pay_date = substr($info['PAY_DATE'], 0, 4).".".substr($info['PAY_DATE'], 4, 2).".".substr($info['PAY_DATE'], 6, 2);

	// 결제정보
	/* $order_sql = " SELECT b.od_receipt_time
				FROM ".$g5['g5_shop_cart_table']." a
				INNER JOIN ".$g5['g5_shop_order_table']." b
					ON a.od_id = b.od_id
				WHERE a.ct_id = '".$view['wr_25']."' AND a.ct_1 = '".$wr_id."'";
	$order_info = sql_fetch($order_sql); */
?>

<div class="my_print_wrap">
  <div class="center_logo"><img src="<? echo G5_URL ?>/my_page/img/print_bg.png" alt=""></div>
	<div class="my_print">
		<div class="my_print_hd">
			<p class="print_num"></p>
			<h2 class="my_print_tit">교육비&nbsp;&nbsp;납부&nbsp;&nbsp;확인서</h2>
		</div>
		<div class="my_print_cnt">
			<ul>
				<li>
					<h6><span>교육과정</span> :</h6>
					<p><?php echo $info['CATE2']; ?> - <?php echo $info['CATE3']; ?></p>
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
					<p><?php echo $temp_mb['mb_2']; ?></p>
				</li>
				<li>
					<h6><span>교 육 생</span> :</h6>
					<p><?php echo $temp_mb['mb_name']; ?></p>
				</li>
				<li>
					<h6><span>납 부 액</span> :</h6>
					<p><?php echo number_format($info['AMT']); ?> 원</p>
				</li>
				<li>
					<h6><span>납 부 일</span> :</h6>
					<p><?php echo $pay_date; ?></p>
				</li>
				<li>
					<h6><span>주문번호</span> :</h6>
					<p><?php echo $info['IMP_UID']; ?></p>
				</li>
				<li>
					<h6><span>결제수단</span> :</h6>
					<p><?php echo $info['PAY_METHOD']; ?></p>
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

  .center_logo{position: absolute; left: 50%; top: 50%; transform:translate(-50%, -50%); z-index: -1;}
	.my_print_wrap{max-width:730px; box-sizing: border-box; padding: 30px; margin: 0 auto;}
	.my_print{height: 970px; border: 1px solid #000;/* background: url(./img/print_bg.png) center no-repeat;  */box-sizing: border-box; padding: 55px 50px 0; }
	.my_print .my_print_hd .my_print_tit{font-family: 'GyeonggiBatang'; font-size: 35px; line-height: 1; font-weight: 700; color: #111; text-align: center; margin-top: 87px;  margin-bottom: 83px; letter-spacing: 0;}
	.my_print .my_print_cnt ul > li{display: flex; line-height: 22px; align-items: flex-start;}
	.my_print .my_print_cnt ul > li h6{width: 80px; display: inline-block; font-size: 16px; color: #111; font-weight: 500; }
	.my_print .my_print_cnt ul > li h6 span{display: inline-table; font-size: 16px; color: #111; font-weight: 500; text-align: justify; width: 57px; letter-spacing: -0.03em; line-height: 1; margin-right: 10px;}
	.my_print .my_print_cnt ul > li h6 span:after{content: ''; display: inline-block;	width: 100%;}
	.my_print .my_print_cnt ul > li p{font-size: 16px; color: #666; padding-left: 10px;}
	.my_print .my_print_cnt ul > li > .day_box{width: calc(100% - 73px); display: flex; }
	.my_print .my_print_cnt ul > li > .day_box b{font-size: 16px; font-weight: 500; color: #014693;}
	.my_print .text_area {text-align: center;}
	.my_print .text_area p{font-size: 16px; line-height: 1px; letter-spacing: -0.03em; color: #111; margin: 94px 0 111px;}
	.my_print .text_area h4{font-size: 18px; line-height: 1; color: #111; letter-spacing: -0.03em; font-weight: 400; margin-bottom: 51px;}
	.my_print  .sign{text-align: right; padding-right: 23px;}
	body{min-width:0px !important; }

.my_print .sign{text-align: right; padding-right: 23px; }
	.my_print .sign img{width: auto; max-width:90%;}

</style>

