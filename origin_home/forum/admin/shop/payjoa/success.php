<?php
include_once('./_common.php');

include_once(G5_SHOP_PATH.'/settle_payjoa.inc.php');
include_once(G5_SHOP_PATH.'/settle_payjoa_common.php');

// 페이조아 아이피 대역 체크
$TEMP_IP = getenv("REMOTE_ADDR");
$PG_IP  = substr($TEMP_IP, 0, 10);

$ip_check = false;

switch($PG_IP){
	case "27.102.213.200": $ip_check = true; break;
	case "27.102.213.201": $ip_check = true; break;
	case "27.102.213.202": $ip_check = true; break;
	case "27.102.213.203": $ip_check = true; break;
	case "27.102.213.204": $ip_check = true; break;
	case "27.102.213.205": $ip_check = true; break;
	case "27.102.213.206": $ip_check = true; break;
	case "27.102.213.207": $ip_check = true; break;
	case "27.102.213.208": $ip_check = true; break;
	case "27.102.213.209": $ip_check = true; break;
	default: $ip_check = false;
}


/* 로그기록용 str */
$logPathDir = $_SERVER['DOCUMENT_ROOT']."/shop/payjoa/log";  //로그위치 지정
$log = "";
$log .= "time: ".date("Y-m-d H:i:s").",\n";
$log .= "ip: ".$_SERVER['REMOTE_ADDR'].",\n";
foreach($_REQUEST as $key=>$value){
	$log .= $key.": ".$value.",\n";		
}
$log .= "PG_IP: ".$PG_IP.",\n";
$log .= "ip_check: ".$ip_check.",\n";
$log_file = fopen($logPathDir."/log_".$CPID."_".date("Ymd").".txt", "a");
fwrite($log_file, $log."\r\n");
fclose($log_file);
/* 로그기록용 end */

// CARDK도 CARD로 반환된단고 하셨음
if($PAYMETHOD == "CARD"){ $PAYMETHOD = "CARDK"; }

// 페이조아 아이피일 경우 처리
// if($ip_check){
if($od_id){

	$add_sql = "";

	// 미수금 정보 업데이트
	$info = get_order_info($od_id);
	$i_price = $info['od_misu']; // 미수금 금액

	// 결제수단에 따른 처리
	switch($PAYMETHOD){
		// 신용카드(일반)
		case "CARD":
			$od_status = "입금";
			break;

		// 신용카드K(일반)
		case "CARDK":
			$od_status = "입금";
			break;
		
		// 가상계좌(발급)
		case "VACCOUNTISSUE":
			// 결제해야할 금액이 없을 경우
			if(!$AMOUNT){
				$od_bank_account    = $BANK_CODE[$BANKCODE].' '.$ACCOUNTNO;	// 입금계좌
				$od_deposit_name    = $WILL_DEPOSITORNAME;					// 입금자
				$od_status = "주문";
			}
			break;
		// 계좌이체(일반)
		case "BANK":
			$od_receipt_price   = $AMOUNT;									// 결제금액
			$od_deposit_name    = $USERNAME;								// 입금자
			$od_bank_account    = $BANKNAME;								// 입금계좌
			$od_cash_no			= $CASHRECAUTHNO;							// 현금영수증 번호
			$od_misu            = $i_price - $od_receipt_price;				// 미수금액
			if($od_misu == 0)
				$od_status      = '입금';
			
			$add_sql .= ", od_cash = '".$od_cash	."' ";
			$add_sql .= ", od_cash_no = '".$od_cash_no	."' ";
			$add_sql .= ", od_misu = '".$od_misu."' ";
			break;
		default: 
	}

	// 주문서 UPDATE
	$sql = " UPDATE ".$g5['g5_shop_order_table']." SET
					od_status = '".$od_status."',
					od_tno = '".$od_tno."',
					od_app_no = '".$od_app_no."',
					od_memo = '".$od_memo."',
					od_bank_account = '".$od_bank_account."',
					od_deposit_name = '".$od_deposit_name."'
					".$add_sql."
				WHERE od_id = '".$od_id."'";
	sql_query($sql);


	$sql = " UPDATE ".$g5['g5_shop_order_table']." SET
					od_receipt_price = '".$od_receipt_price."',
					od_receipt_time = '".$od_receipt_time."'
				WHERE od_id = '".$od_id."'";
	$result = sql_query($sql, FALSE);

	/* if($result) {
		if($row['od_id']){ $od_id = $row['od_id']; }
		else{ $od_id = $ORDERNO; }

		// 주문정보 체크
		$sql = " SELECT count(od_id) AS cnt
					FROM ".$g5['g5_shop_order_table']."
					WHERE od_id = '".$od_id."'
					  AND od_status = '주문' ";
		$row = sql_fetch($sql);

		if($row['cnt'] == 1) {
			// 미수금 정보 업데이트
			$info = get_order_info($od_id);

			$sql = " UPDATE ".$g5['g5_shop_order_table']." SET
						od_misu = '".$info['od_misu']."' ";
			if($info['od_misu'] == 0)
				$sql .= " , od_status = '입금' ";
			$sql .= " WHERE od_id = '".$od_id."' ";
			sql_query($sql, FALSE);

			// 장바구니 상태변경
			if($info['od_misu'] == 0) {
				$sql = " UPDATE {$g5['g5_shop_cart_table']} SET
								ct_status = '입금'
							WHERE od_id = '".$od_id."' ";
				sql_query($sql, FALSE);
			}
		}
	} */
	
	// 게시판 PK들
	$wr_ids = explode(",", $RESERVEDSTRING);
	
	$tmp_table = $applicant_table; // 신청정보 테이블
	for($i = 0; $i < count($wr_ids); $i++){
		if($wr_ids[$i] == ''){ continue; } // 빈 값 체크
		$wr_id = $wr_ids[$i];
		$tmp_write_table = $g5['write_prefix'] . $tmp_table;
		
		// 신청글 정보
		$tmp_board_info = sql_fetch(" SELECT wr_16, wr_17, wr_25 FROM ".$tmp_write_table." WHERE wr_id = '".$wr_id."' ");
		
		// 결제완료 체크
		if($tmp_board_info['wr_17'] != '결제완료'){
			// 장바구니 정보
			$cart_info = sql_fetch(" SELECT * FROM ".$g5['g5_shop_cart_table']." WHERE ct_id = '".$tmp_board_info['wr_25']."' ");
			
			// 결제수단에 따른 처리
			switch($PAYMETHOD){
				// 신용카드(일반)
				case "CARD":
					// 결제해야할 금액이 같을 경우
					if($cart_info['ct_price'] == $AMOUNT){ $wr_15 = $AMOUNT; $wr_17 = "결제완료"; }
					else{ $wr_15 = $AMOUNT; $wr_17 = ""; }
					break;
				
				// 신용카드K(일반)
				case "CARDK":
					// 결제해야할 금액이 같을 경우
					if($cart_info['ct_price'] == $AMOUNT){ $wr_15 = $AMOUNT; $wr_17 = "결제완료"; }
					else{ $wr_15 = $AMOUNT; $wr_17 = ""; }
					break;

				// 가상계좌(발급)
				case "VACCOUNTISSUE":
					// 결제해야할 금액이 없을 경우
					if(!$AMOUNT){ $wr_15 = 0; $wr_17 = ""; }
					// 결제해야할 금액이 같을 경우
					else if($cart_info['ct_price'] == $AMOUNT){ $wr_15 = $AMOUNT; $wr_17 = "결제완료"; }
					else{ $wr_15 = $AMOUNT; $wr_17 = ""; }
					break;

				// 계좌이체(일반)
				case "BANK":
					// 결제해야할 금액이 없을 경우
					if(!$AMOUNT){ $wr_15 = 0; $wr_17 = ""; }
					// 결제해야할 금액이 같을 경우
					else if($cart_info['ct_price'] == $AMOUNT){ $wr_15 = $AMOUNT; $wr_17 = "결제완료"; }
					else{ $wr_15 = $AMOUNT; $wr_17 = ""; }
					break;
				default: 
			}
			
			// 결제수단
			$wr_20 = $PAY_METHOD[$PAYMETHOD];

			$UPDATE_QUERY = " UPDATE ".$tmp_write_table." SET 
									wr_15 = '".$wr_15."',
									wr_17 = '".$wr_17."',
									wr_20 = '".$wr_20."',
									wr_24 = '".$od_tno."',
									wr_27 = '".$od_receipt_time."',
									wr_29 = '".$od_id."'
								WHERE wr_id = '".$wr_id."' ";
			sql_query($UPDATE_QUERY);
		}
	}
}

// 현재 주문정보
$sql = " SELECT ".$g5['g5_shop_order_table']." WHERE od_id = '".$od_id."'";
$order_info = sql_fetch($sql, FALSE);

// 로그체크 후 삭제 처리
clear_shop_log();

// 다우거래번호, 카드승인번호 체크 후 할 경우 성공 결과 반환
if($order_info['od_tno'] == $od_tno && $order_info['od_app_no'] == $od_app_no){
?>
<!-- 페이조아 반환 값 -->
<html>
<body>
<RESULT>SUCCESS</RESULT>
</body>
</html>
<?php } ?>