<?php
include_once('./_common.php');

$mode = $_REQUEST["mode"];

// 접수 취소
if($mode == "cancel_state"){

	$bo_table = $_REQUEST["bo_table"];	// 테이블
	$wr_id = $_REQUEST["wr_id"];		// PK값
	
	// 접수 취소처리
	$update_query = " UPDATE {$write_table} SET wr_18 = '취소' WHERE wr_id = '{$wr_id}' ";
	sql_query($update_query);

	echo "접수가 취소 되었습니다.";
}

// 결제 취소
if($mode == "cancel_pay"){

	// 반환용 데이터
	$data = Array();
	$data["result"] = true;

	$bo_table = $_REQUEST["bo_table"];	// 테이블
	$wr_id = $_REQUEST["wr_id"];		// PK값
	
	// 신청자 정보
	$sql = " SELECT * FROM {$write_table} WHERE wr_id = '{$wr_id}' ";
	$request_info = sql_fetch($sql);

	// 교육 관련 정보
	$prd_write_table = $g5['write_prefix'] . substr($bo_table, 0, -2);
	$pro_info = sql_fetch(" SELECT * FROM ".$prd_write_table." WHERE wr_id = '".$request_info['wr_1']."' ");
	
	// 취소 요청자 정보 확인
	if($data["msg"]){
		// 관리자가 아니면서, 신청자가 아니고, 담당자회원(=단체회원용)가 아닐 경우
		if(!$is_admin && $member["mb_id"] != $request_info["mb_id"] && $member["mb_id"] != $request_info["wr_14"]){
			$data["result"] = false;
			$data["msg"] = "본인 본인 신청 또는 담당자 회원만 취소 신청하실 수 있습니다.";
		}
	}

	// 일정 체크
	if($data["msg"]){
		// 교육일이 지났을 경우
		if(strtotime(date('Y-m-d')) >= strtotime($pro_info['wr_3'])){
			$data["result"] = false;
			$data["msg"] = "교육기간 중에는 취소하실 수 있습니다.";
		}
	}

	// 결제상태 체크
	if($data["msg"]){
		// 교육일이 지났을 경우
		if($request_info['wr_17'] != "결제완료"){
			$data["result"] = false;
			$data["msg"] = "결제된 접수가 아닙니다.";
		}
	}

	// 교육상태 체크
	if($data["msg"]){
		// 교육일이 지났을 경우
		if($request_info['wr_18'] == ""){
			$data["result"] = false;
			$data["msg"] = "접수 중인 상태가 아닙니다.";
		}
	}

	echo json_encode($data);

}

// 가상계좌 정보 가져오기
if($mode == "get_vAccount"){
	
	// 반환용 데이터
	$html = "";

	$bo_table = $_REQUEST["bo_table"];	// 테이블
	$wr_id = $_REQUEST["wr_id"];		// PK값

	// 신청자 정보
	$sql = " SELECT * FROM {$write_table} WHERE wr_id = '{$wr_id}' ";
	$request_info = sql_fetch($sql);

	// 장바구니정보 확인
	$order_info = sql_fetch(" SELECT * FROM {$g5['g5_shop_cart_table']} WHERE ct_id = '{$request_info['wr_25']}' ");

	// 주문정보 확인
	$order_info = sql_fetch(" SELECT * FROM {$g5['g5_shop_order_table']} WHERE od_tno = '{$request_info['wr_24']}' ");

	$order_date = "주문내역이 없습니다.";		// 주문일시
	$pay_type = "주문내역이 없습니다.";			// 결제방식
	$pay_misu_price = "주문내역이 없습니다.";	// 미수금액
	$pay_price = "주문내역이 없습니다.";			// 결제금액
	$od_name = "주문내역이 없습니다.";			// 입금자명
	$account = "주문내역이 없습니다.";			// 입금계좌

	// 총계 = 주문상품금액합계 + 배송비 - 상품할인 - 결제할인 - 배송비할인
	$tot_price = $order_info['od_cart_price'] + $order_info['od_send_cost'] + $order_info['od_send_cost2']
                        - $order_info['od_cart_coupon'] - $order_info['od_coupon'] - $order_info['od_send_coupon']
                        - $order_info['od_cancel_price'];

	$receipt_price  = $order_info['od_receipt_price'] + $order_info['od_receipt_point'];
	$cancel_price   = $order_info['od_cancel_price'];
	
	// 미수금액
	$misu_price = $tot_price - $receipt_price - $cancel_price;

	if($order_info["od_time"] && $order_info["od_time"] != "0000-00-00 00:00:00"){ $order_date = $order_info["od_time"]; }
	if($order_info["od_settle_case"]){ $pay_type = $order_info["od_settle_case"]; }
	if($tot_price){ $pay_misu_price = display_price($receipt_price); $pay_price = display_price($tot_price); }
	if($order_info["od_name"]){ $od_name = $order_info["od_name"]; }
	if($order_info["od_bank_account"]){ $account = $order_info["od_bank_account"]; }

	$html .= "<table>";
	$html .= "	<colgroup>";
	$html .= "		<col width=\"100px\">";
	$html .= "		<col width=\"*\">";
	$html .= "	</colgroup>";
	$html .= "	<tr>";
	$html .= "		<th>주문일시</th>";
	$html .= "		<td>{$order_date}</td>";
	$html .= "	</tr>";
	$html .= "	<tr>";
	$html .= "		<th>결제방식</th>";
	$html .= "		<td>{$pay_type}</td>";
	$html .= "	</tr>";
	$html .= "	<tr>";
	$html .= "		<th>결제금액</th>";
	$html .= "		<td>{$pay_misu_price}/{$pay_price}</td>";
	$html .= "	</tr>";
	$html .= "	<tr>";
	$html .= "		<th>입금자명</th>";
	$html .= "		<td>{$od_name}</td>";
	$html .= "	</tr>";
	$html .= "	<tr>";
	$html .= "		<th>입금계좌</th>";
	$html .= "		<td>{$account}</td>";
	$html .= "	</tr>";
	$html .= "</table>";

	$html .= "<div class=\"btn_box\">";
	$html .= "	<a href=\"#n\" class=\"pay_close\">확인</a>";
	$html .= "</div>";

	echo $html;
}
?>