<?php
// if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

include_once('./_common.php');

require_once(G5_SHOP_PATH.'/settle_'.$default['de_pg_service'].'.inc.php');

// echo "<pre>"; print_r($_REQUEST); echo "</pre>"; exit;

// 변수 체크
if(empty($bo_table) || count($chk_wr_id) < 1 || $chk_wr_id[0] == ""){
	alert_close("올바른 방법으로 이용해주세요."); exit;
}

// 취소하려는 신청정보
$wr_id = $chk_wr_id[0];

// 신청자 정보
$sql = " SELECT * FROM {$write_table} WHERE wr_id = '{$wr_id}' ";
$request_info = sql_fetch($sql);

// 교육 관련 정보
$prd_write_table = $g5['write_prefix'] . substr($bo_table, 0, -2);
$pro_info = sql_fetch(" SELECT * FROM ".$prd_write_table." WHERE wr_id = '".$request_info['wr_1']."' ");

// 주문정보
$order_info = sql_fetch(" SELECT * FROM {$g5['g5_shop_order_table']} WHERE od_tno = '{$request_info['wr_24']}' ");

// 카트 정보
$cart_info = sql_fetch(" SELECT * FROM {$g5['g5_shop_cart_table']} WHERE od_id = '{$order_info['od_id']}' AND ct_1 = '{$request_info['wr_id']}' " );

$od = get_order_info($order_info['od_id']);

$PAYMETHOD = $PAY_METHOD_REV[$request_info["wr_20"]];	// 결제방식
$AMOUNT = $od["od_cart_price"];		// 결제금액
$TRXID = $order_info["od_tno"];		// 페이조아 거래번호

// 인증키용 배열
$auth_arr = Array("CARDK" => "5", "CARD" => "5", "VACCOUNTISSUE" => "6", "BANK" => "7");
// 인증키
$AUTHKEY = $config["cf_".$auth_arr[$PAYMETHOD]];

?>
<html>
<head>
<title>통합 API 샘플페이지</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Cache-Control" content="no-cache">
<meta http-equiv="Expires" content="0">
<meta http-equiv="Pragma" content="no-cache">

<script type="text/javascript">
var pf;
function fnSubmit2() {
	var fileName;
	fileName = "./cancel.php";		
	pf = document.frmConfirm;
	pf.action = fileName;
	pf.method = "post";
	pf.submit();
}

</script>

</head>
<BODY onload="fnSubmit2();">

<form name="frmConfirm" enctype="multipart/form-data" method="post"> 

<?php if(false){ // 안나옴 처리?>
AUTHKEY	: <input type="text" id="AUTHKEY" name="AUTHKEY" value=""><br><!-- 상점관리자 고객지원>연동정보설정에 연동키 확인 -->
상점아이디	: <input type="text" id="CPID" name="CPID" value="CTS17420"><br><!-- 페이조아에서 발급받은 테스트ID입력 -->
PAYMETHOD : <input type="text" id="PAYMETHOD" name="PAYMETHOD" value="BANK"><br><!-- 매뉴얼에 있는 결제수단별 PAYMETHOD확인 -->
AMOUNT : <input type="text" id="AMOUNT" name="AMOUNT" value="1004" style="width:80%;"/> <br>
CANCELREQ : <input type="text" id="CANCELREQ" name="CANCELREQ" value="Y"> 취소요청을 하는 경우라면 Y값 전송<br>
TRXID : <input type="text" id="TRXID" name="TRXID" value="BTS22040410171218118"><br><!-- 페이조아 거래번호 -->
CANCELREASON : <input type="text" id="CANCELREASON" name="CANCELREASON" value="취소사유"><br>
TAXFREEAMT : <input type="text" id="TAXFREEAMT" name="TAXFREEAMT" value=""> (선택)복합과세 결제일 경우 사용, 비과세 취소금액<br>
<input name="btnSubmit" type="button" value="결제요청" onclick="fnSubmit2()" ><br>
<?php } ?>

<?php $hidden = "hidden"; ?>
<input type="<?php echo $hidden; ?>" id="AUTHKEY" name="AUTHKEY" value="<?php echo $AUTHKEY; ?>"><!-- 상점관리자 고객지원>연동정보설정에 연동키 확인 -->
<input type="<?php echo $hidden; ?>" id="CPID" name="CPID" value="<?php echo $mid; ?>"><!-- 페이조아에서 발급받은 테스트ID입력 -->
<input type="<?php echo $hidden; ?>" id="PAYMETHOD" name="PAYMETHOD" value="<?php echo $PAYMETHOD; ?>"><!-- 매뉴얼에 있는 결제수단별 PAYMETHOD확인 -->
<input type="<?php echo $hidden; ?>" id="AMOUNT" name="AMOUNT" value="<?php echo $AMOUNT; ?>" style="width:80%;"/> 
<input type="<?php echo $hidden; ?>" id="CANCELREQ" name="CANCELREQ" value="Y"> <!-- 취소요청을 하는 경우라면 Y값 전송 -->
<input type="<?php echo $hidden; ?>" id="TRXID" name="TRXID" value="<?php echo $TRXID; ?>"><!-- 페이조아 거래번호 -->
<input type="<?php echo $hidden; ?>" id="CANCELREASON" name="CANCELREASON" value="고객 취소"><!-- 취소사유 -->
<input type="<?php echo $hidden; ?>" id="TAXFREEAMT" name="TAXFREEAMT" value="">

<input type="<?php echo $hidden; ?>" id="bo_table" name="bo_table" value="<?php echo $bo_table; ?>">

</form>
</BODY>
</HTML>

