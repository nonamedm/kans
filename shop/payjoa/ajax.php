<?php
include_once('./_common.php');

$mode = $_REQUEST["mode"];

// 주문 생성하기
if($mode == 'create_order'){

	$chk_wr_id = explode(",", $RESERVEDSTRING);

	$ORDERNO = date('YmdHis');

	// 넘겨진 결제할 사항들
	if(count($chk_wr_id)){

		$od_id = $ORDERNO;						// cart 번호
		$mb_id = $member['mb_id'];				// 회원아이디
		$it_id = $PRODUCTCODE;					// 상품번호
		$it_name = "";							// 상품명
		$it_sc_type = 0;						// 배송비유형
		$it_sc_method = 0;						// 배송비결제
		$it_sc_price = 0;						// 기본배송비
		$it_sc_minimum = 0;						// 배송비 상세조건 주문금액
		$it_sc_qty = 0;							// 배송비 상세조건 수량
		$ct_status = "주문";						// 장바구니 상태
		$ct_price = 0;							// 판매가격
		$ct_point = 0;							// 포인트
		$ct_point_use = 0;						// 포인트결제 사용
		$ct_stock_use = 0;						// 재고 사용
		$ct_option = "";						// 상품명 또는 옵션명
		$ct_qty = 1;							// 수량
		$ct_notax = 0;							// 상품과세 유형
		$io_id = "";							// 선택옵션명
		$io_type = 0;							// 상품선택옵션:0 , 상품추가옵션:1
		$io_price = 0;							// 옵션금액
		$ct_time = date('Y-m-d H:i:s');			// 장바구니입력 일시
		$ct_ip = $_SERVER['REMOTE_ADDR'];		// 장바구니입력 IP
		$ct_send_cost = 0;						// 배송비
		$ct_direct = 0;							// 장바구니담기:0, 바로구매:1
		$ct_select = 0;							// 장바구니담기:0, 바로구매:1
		$ct_select_time= date('Y-m-d H:i:s');	// 주문서작성 일시

		// 결제할 사항들 만큼 cart 정보 만들어내기
		for($i = 0; $i < count($chk_wr_id); $i++){
			
			$pay_query = " SELECT a.*, b.wr_subject AS b_subject
							FROM ".$write_table." AS a
							INNER JOIN ".$g5['write_prefix'] . substr($bo_table, 0, -2)." AS b
								ON a.wr_1 = b.wr_id
							WHERE a.wr_id = '".$chk_wr_id[$i]."' ";
			$pay_info = sql_fetch($pay_query);
			
			// 결제여부 확인
			if($pay_info['wr_17'] == '결제완료'){ continue; }

			$it_name = $pay_info["b_subject"]." 교육비";
			$ct_price = $pay_info['wr_16'] - $pay_info['wr_15'];

			$cart_sql = " INSERT INTO ".$g5['g5_shop_cart_table']." SET
							od_id = '".$od_id."' ,
							mb_id = '".$mb_id."' , 
							it_id = '".$it_id."' , 
							it_name = '".$it_name."' , 
							it_sc_type = '".$it_sc_type."' , 
							it_sc_method = '".$it_sc_method."' , 
							it_sc_price = '".$it_sc_price."' , 
							it_sc_minimum = '".$it_sc_minimum."' , 
							it_sc_qty = '".$it_sc_qty."' , 
							ct_status = '".$ct_status."' , 
							ct_price = '".$ct_price."' , 
							ct_point = '".$ct_point."' , 
							ct_point_use = '".$ct_point_use."' , 
							ct_stock_use = '".$ct_stock_use."' , 
							ct_option = '".$ct_option."' , 
							ct_qty = '".$ct_qty."' , 
							ct_notax = '".$ct_notax."' , 
							io_id = '".$io_id."' , 
							io_type = '".$io_type."' , 
							io_price = '".$io_price."' , 
							ct_time = '".$ct_time."' , 
							ct_ip = '".$ct_ip."' , 
							ct_send_cost = '".$ct_send_cost."' , 
							ct_direct = '".$ct_direct."' , 
							ct_select = '".$ct_select."' , 
							ct_select_time = '".$ct_select_time."'";

			$cart_sql .= ", ct_1 = '".$chk_wr_id[$i]."' "; // 게시글 PK값 가지고 있기

			sql_query($cart_sql);
			
			// 생성된 장바구니 PK값 게시글(=신청정보)에 적용
			$ct_id = sql_insert_id();
			$UPDATE_QUERY = " UPDATE ".$write_table." SET wr_25 = '".$ct_id."' WHERE wr_id = '".$chk_wr_id[$i]."' ";
			sql_query($UPDATE_QUERY);
		}

		// 주문서 처리
		$od_id = $od_id;	// 주문서번호
		$mb_id = $mb_id;	// 회원아이디
		$od_pwd = "";	// 주문 비밀번호
		
		if ($is_member){ $od_pwd = $member['mb_password']; }
		else{ $od_pwd = get_encrypt_string($_POST['od_pwd']); }

		$od_name = $member['mb_name'];					// 주문하신 분 이름
		$od_email = $member['mb_email'];				// 주문하신 분 이메일
		$od_tel = $member['mb_name'];					// 주문하신 분 전화번호
		$od_hp = $member['mb_hp'];						// 주문하신 분 휴대폰번호
		$od_zip1 = $member['mb_zip1'];					// 주문하신 분 우편번호 앞자리
		$od_zip2 = $member['mb_zip2'];					// 주문하신 분 우편번호 뒤자리
		$od_addr1 = $member['mb_addr1'];				// 주문하신 분 우편번호 기본주소
		$od_addr2 = $member['mb_addr2'];				// 주문하신 분 우편번호 상세주소
		$od_addr3 = $member['mb_addr3'];				// 주문하신 분 우편번호 주소 참고 항목
		$od_addr_jibeon = $member['mb_addr_jibeon'];	// 주문하신 분 우편번호 지번주소
		$od_b_name = $member['mb_name'];				// 받으시는 분 이름
		$od_b_tel = $member['mb_tel'];					// 받으시는 분 전화번호
		$od_b_hp = $member['mb_hp'];					// 받으시는 분 휴대폰번호
		$od_b_zip1 = $member['mb_zip1'];				// 받으시는 분 우편번호 앞자리
		$od_b_zip2 = $member['mb_zip2'];				// 받으시는 분 우편번호 뒤자리
		$od_b_addr1 = $member['mb_addr1'];				// 받으시는 분 우편번호 기본주소
		$od_b_addr2 = $member['mb_addr2'];				// 받으시는 분 우편번호 상세주소
		$od_b_addr3 = $member['mb_addr3'];				// 받으시는 분 우편번호 주소 참고 항목
		$od_b_addr_jibeon = $member['mb_addr_jibeon'];	// 받으시는 분 우편번호 지번주소
		$od_deposit_name = "";							// 입금자
		$od_memo = "";									// 전하실말씀
		$od_cart_count = count($chk_wr_id);				// 장바구니 상품 개수
		$od_cart_price = $AMOUNT;						// 주문상품 총금액
		$od_cart_coupon = 0;							// 상품할인 쿠폰금액
		$od_send_cost = 0;								// 배송비
		$od_send_coupon = 0;							// 배송비 할인 쿠폰
		$od_send_cost2 = 0;								// 추가 배송비
		$od_coupon = 0;									// 쿠폰금액
		$od_receipt_price = 0;							// 결제금액
		$od_receipt_point = 0;							// 결제 포인트
		$od_bank_account = "";							// 입금계좌
		$od_receipt_time = "0000-00-00 00:00:00";		// 결제일시
		$od_misu = $AMOUNT;								// 미수금액
		$od_pg = "payjoa";								// 간편결제 방식
		$od_tno = "";									// 거래번호
		$od_app_no = "";								// 승인번호
		$od_escrow = 0;									// 에스크로 결제
		$od_tax_flag = 0;								// 비과세
		$od_tax_mny = 0;								// 과세공급가액
		$od_vat_mny = 0;								// 과세부가세액
		$od_free_mny = $AMOUNT;							// 비과세공급가액
		$od_status = "주문";								// 주문상태
		$od_shop_memo = "";								// 상점메모
		$od_hope_date = "";								// 희망배송일
		$od_time = G5_TIME_YMDHIS;						// 주문일자
		$od_ip = $REMOTE_ADDR;							// 주문IP
		// $od_settle_case = "신용카드";						// 결제방식
		$settle_case_arr = Array("CARD" => "신용카드", "VACCT" => "가상계좌", "BANK" => "계좌이체");
		$od_settle_case = $settle_case_arr[$PAYMETHOD];
		$od_test = $default['de_card_test'];			// 테스트결제

		$od_email         = get_email_address($od_email);
		$od_name          = clean_xss_tags($od_name);
		$od_tel           = clean_xss_tags($od_tel);
		$od_hp            = clean_xss_tags($od_hp);
		$od_addr1         = clean_xss_tags($od_addr1);
		$od_addr2         = clean_xss_tags($od_addr2);
		$od_addr3         = clean_xss_tags($od_addr3);
		$od_addr_jibeon   = preg_match("/^(N|R)$/", $od_addr_jibeon) ? $od_addr_jibeon : '';
		$od_b_name        = clean_xss_tags($od_b_name);
		$od_b_tel         = clean_xss_tags($od_b_tel);
		$od_b_hp          = clean_xss_tags($od_b_hp);
		$od_b_addr1       = clean_xss_tags($od_b_addr1);
		$od_b_addr2       = clean_xss_tags($od_b_addr2);
		$od_b_addr3       = clean_xss_tags($od_b_addr3);
		$od_b_addr_jibeon = preg_match("/^(N|R)$/", $od_b_addr_jibeon) ? $od_b_addr_jibeon : '';
		$od_memo          = clean_xss_tags($od_memo);
		$od_deposit_name  = clean_xss_tags($od_deposit_name);
		$od_tax_flag      = $default['de_tax_flag_use'];

		// 주문서에 입력
		$sql = " INSERT ".$g5['g5_shop_order_table']." SET
						od_id             = '".$od_id."',
						mb_id             = '".$mb_id."',
						od_pwd            = '".$od_pwd."',
						od_name           = '".$od_name."',
						od_email          = '".$od_email."',
						od_tel            = '".$od_tel."',
						od_hp             = '".$od_hp."',
						od_zip1           = '".$od_zip1."',
						od_zip2           = '".$od_zip2."',
						od_addr1          = '".$od_addr1."',
						od_addr2          = '".$od_addr2."',
						od_addr3          = '".$od_addr3."',
						od_addr_jibeon    = '".$od_addr_jibeon."',
						od_b_name         = '".$od_b_name."',
						od_b_tel          = '".$od_b_tel."',
						od_b_hp           = '".$od_b_hp."',
						od_b_zip1         = '".$od_b_zip1."',
						od_b_zip2         = '".$od_b_zip2."',
						od_b_addr1        = '".$od_b_addr1."',
						od_b_addr2        = '".$od_b_addr2."',
						od_b_addr3        = '".$od_b_addr3."',
						od_b_addr_jibeon  = '".$od_b_addr_jibeon."',
						od_deposit_name   = '".$od_deposit_name."',
						od_memo           = '".$od_memo."',
						od_cart_count     = '".$od_cart_count."',
						od_cart_price     = '".$od_cart_price."',
						od_cart_coupon    = '".$od_cart_coupon."',
						od_send_cost      = '".$od_send_cost."',
						od_send_coupon    = '".$od_send_coupon."',
						od_send_cost2     = '".$od_send_cost2."',
						od_coupon         = '".$od_coupon."',
						od_receipt_price  = '".$od_receipt_price."',
						od_receipt_point  = '".$od_receipt_point."',
						od_bank_account   = '".$od_bank_account."',
						od_receipt_time   = '".$od_receipt_time."',
						od_misu           = '".$od_misu."',
						od_pg             = '".$od_pg."',
						od_tno            = '".$od_tno."',
						od_app_no         = '".$od_app_no."',
						od_escrow         = '".$od_escrow."',
						od_tax_flag       = '".$od_tax_flag."',
						od_tax_mny        = '".$od_tax_mny."',
						od_vat_mny        = '".$od_vat_mny."',
						od_free_mny       = '".$od_free_mny."',
						od_status         = '".$od_status."',
						od_shop_memo      = '".$od_shop_memo."',
						od_hope_date      = '".$od_hope_date."',
						od_time           = '".$od_time."',
						od_ip             = '".$od_ip."',
						od_settle_case    = '".$od_settle_case."',
						od_test           = '".$od_test."' ";
		$result = sql_query($sql, false);
	}

	echo $ORDERNO;
}
?>