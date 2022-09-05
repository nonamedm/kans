<?php
include_once('./_common.php');

require_once(G5_SHOP_PATH.'/settle_'.$default['de_pg_service'].'.inc.php');
require_once(G5_SHOP_PATH.'/settle_'.$default['de_pg_service'].'_common.php');

header("Content-Type:text/html;charset=utf-8");
// 언어셋 전체 변경
foreach($_REQUEST as $key=>$value){
	// ${$key} = iconv("UTF-8", "EUC-KR", $value);
}

// 빈값체크
function isEmptyString($InStr){
	if ($InStr == null || trim($InStr) == "")
		return true;
	else
		return false;
}

// 인젝션 처리
function Injection($InParam){
	$InParam = str_replace("--", "", $InParam);
	$InParam = str_replace("exec ", "e xec", $InParam);
	$InParam = str_replace("<", "&lt;", $InParam);
	$InParam = str_replace(">", "&gt;", $InParam);
	$InParam = str_replace("\'", "&#145;", $InParam);
	$InParam = str_replace("&", "&#38;", $InParam);
	$InParam = str_replace("\"", "&#34;", $InParam);
	$InParam = str_replace(" ", "&#32", $InParam);
	$InParam = str_replace("[(]", "&#40;", $InParam);
	$InParam = str_replace("[)]", "&#41;", $InParam);
	$InParam = str_replace("[?]", "&#63;", $InParam);
	$InParam = str_replace("!", "&#33;", $InParam);
	return $InParam;
}

// 널 체크
function nullCheck($InStr) {
	if (isEmptyString($InStr))
		return "";
	else
		return Injection($InStr);
}

// 오브젝트 널 체크
function checkObjNull($InStr) {

	$str = "";

	if($InStr === null){ $str = "null"; }
	if ("null" === $str)
		return "";
	else
		return $str;
}

$AUTHKEY			= nullCheck($AUTHKEY); 
$CPID				= nullCheck($CPID); 
$PAYMETHOD			= nullCheck($PAYMETHOD); 
$AMOUNT				= nullCheck($AMOUNT); 
$CANCELREQ			= nullCheck($CANCELREQ);
$TRXID				= nullCheck($TRXID);
$CANCELREASON		= nullCheck($CANCELREASON);
$TAXFREEAMT			= nullCheck($TAXFREEAMT);

/* 응답결과 */
$resultcode  		= "";
$errormessage		= "";
$daoutrx			= "";
$amount				= "";
$canceldate			= "";
$cpname				= "";
$cpurl				= "";
$cptelno			= "";

// json 데이터
$json_data = Array(
	"CPID" => $CPID,
	"PAYMETHOD" => $PAYMETHOD,
	"AMOUNT" => $AMOUNT,
	"CANCELREQ" => $CANCELREQ,
	"TRXID" => $TRXID,
	"CANCELREASON" => $CANCELREASON,
	"TAXFREEAMT" => $TAXFREEAMT
);

$json_object = json_encode($json_data);

if ($default['de_card_test']) {
	$url = "https://apitest.kiwoompay.co.kr/pay/ready";    //개발서버
} else { 
	$url = "https://api.kiwoompay.co.kr/pay/ready";    //운영서버
}
//URL goUrl = new URL(url);

// curl 접속 함수
function connectHttp($url, $post, $param, $header = null)
{
	$handle = curl_init();
	// 접속할 url
	curl_setopt($handle, CURLOPT_URL, $url);
	// 위치 해더 설절
	curl_setopt($handle, CURLOPT_FOLLOWLOCATION, TRUE);
	// 프록시가 있을 경우 설정
	//curl_setopt($handle, CURLOPT_PROXY, "프록시 IP");
	//curl_setopt($handle, CURLOPT_PROXYUSERPWD, "프록시 ID:PW");
	// Auto Redirect
	curl_setopt($handle, CURLOPT_AUTOREFERER, TRUE);
	// 요청 메소드 타입
	curl_setopt($handle, CURLOPT_POST, $post);
	// 파라미터(array 타입)
	curl_setopt($handle, CURLOPT_POSTFIELDS, $param);
	// 인증서와 관련된 파라미터인데 기본 True 설정이다.
	curl_setopt($handle, CURLOPT_VERBOSE, TRUE);
	// 인증서 유효성 검사
	curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE);
	// response 결과 여부(리턴 값으로 header값과 body값을 받을 수 있다.)
	curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
	// 리턴값으로 해더값을 요구 여부
	curl_setopt($handle, CURLOPT_HEADER, TRUE);
	if ($header !== null) {
		// 해더 설정(array타입)
		curl_setopt($handle, CURLOPT_HTTPHEADER, $header);
	}
	// 접속 실행
	$response = curl_exec($handle);

	$http_code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

	// header 사이즈
	$header_size = curl_getinfo($handle, CURLINFO_HEADER_SIZE);
	$header_map = array();
	// 결과에서 header 부분을 분리한다.
	$header = substr($response, 0, $header_size);
	// header를 개행 구분으로 배열로 나눈다.
	$temp = explode("\r\n", $header);
	array_push($header_map, $temp[0]);
	// header를 map에 넣는다.
	foreach($temp as $item){
		$temp2 = explode(":", $item);
		$header_map[$temp2[0]] = str_replace($temp2[0] . ":", "", $item);
	}
	// body를 넣는다.
	$body = substr($response, $header_size);

	curl_close($handle);

	return array(
		"header" => $header_map,
		"body" => $body,
		"http_code" => $http_code
	);

	
}

$header_data = Array("Content-Type: application/json", "Authorization : ".$AUTHKEY);
// var_dump($header_data);

// var_dump($json_object);

// 블로그를 접속해 봅니다.
$ret = connectHttp($url, "POST", $json_object, $header_data);

// 결과코드
$responseCode = $ret['http_code'];

// 토큰, url값 초기화
$token = $returnUrl = "";

// 정상 수신 했을경우 (응답코드:200)
if($responseCode == 200){
	
	// 결과값 json화
	$result_object = json_decode($ret["body"]);
	
	$token = $result_object->TOKEN;			
	$returnUrl = $result_object->RETURNURL;
}


$header_data = Array("Content-Type: application/json", "Authorization : ".$AUTHKEY, "TOKEN : ".$token);
$ret2 = connectHttp($returnUrl, "POST", $json_object, $header_data);
// 결과코드
$responseCode2 = $ret2['http_code'];

// 정상 수신 했을경우 (응답코드:200)
if($responseCode2 == 200){
	
	// 결과값 json화
	$result_object = json_decode($ret2["body"]);
	
	$resultcode = $result_object->RESULTCODE;
	$errormessage = $result_object->ERRORMESSAGE;

	if($resultcode == '0000'){
		$daoutrx		= $result_object->DAOUTRX;
		$amount			= $result_object->AMOUNT;
		$orderno		= $result_object->ORDERNO;
		$canceldate		= $result_object->CANCELDATE;
		$cpname			= $result_object->CPNAME;
		$cpurl			= $result_object->CPURL;
		$cptelno		= $result_object->CPTELNO;

		$trxid = $result_object->TRXID;

		/*
		daoutrx     = checkObjNull(jObj.get("DAOUTRX")).toString();
		amount      = checkObjNull(jObj.get("AMOUNT")).toString();
		orderno     = checkObjNull(jObj.get("ORDERNO")).toString();
		canceldate    = checkObjNull(jObj.get("CANCELDATE")).toString();
		cpname      = checkObjNull(jObj.get("CPNAME")).toString();
		cpurl       = checkObjNull(jObj.get("CPURL")).toString();
		cptelno     = checkObjNull(jObj.get("CPTELNO")).toString();
		*/
	}
}

/* 로그기록용 str */
$logPathDir = $_SERVER['DOCUMENT_ROOT']."/shop/payjoa/log";  //로그위치 지정
$log = "";
$log .= "time: ".date("Y-m-d H:i:s").",\n";
$log .= "ip: ".$_SERVER['REMOTE_ADDR'].",\n";
foreach($_REQUEST as $key=>$value){
	$log .= $key.": ".$value.",\n";		
}

$log .= "\n[ret],\n";

foreach($ret as $key=>$value){
	$log .= $key.": ".$value.",\n";		
}

$log .= "\n[ret2],\n";

foreach($ret2 as $key=>$value){
	$log .= $key.": ".$value.",\n";		
}

/* $log .= "\n[result_object],\n";
foreach($result_object as $key=>$value){
	$log .= $key.": ".$value.",\n";		
} */

$log .= "PG_IP: ".$PG_IP.",\n";
$log .= "ip_check: ".$ip_check.",\n";
$log_file = fopen($logPathDir."/log_".$CPID."_cancel_".date("Ymd").".txt", "a");
fwrite($log_file, $log."\r\n");
fclose($log_file);
/* 로그기록용 end */
//echo "<pre>"; var_dump($ret2);
//exit;

// 취소성공일 경우
if($resultcode == "0000"){
	// 주문정보 확인
	$od = sql_fetch(" SELECT * FROM {$g5['g5_shop_order_table']} WHERE od_tno = '{$trxid}' ");

	if (!$od['od_id']) {
		alert_close("존재하는 주문이 아닙니다.");
	}

	$od_id = $od["od_id"];

	// 주문상품의 상태가 주문인지 체크
	$sql = " SELECT SUM(IF(ct_status = '주문', 1, 0)) AS od_count2,
					COUNT(*) AS od_count1
				FROM {$g5['g5_shop_cart_table']}
				WHERE od_id = '{$od_id}' ";
	$ct = sql_fetch($sql);

	if($od['od_cancel_price'] > 0 || $ct['od_count1'] != $ct['od_count2']) {
		alert_close("취소할 수 있는 주문이 아닙니다.");
	}

	// 장바구니 자료 취소
	sql_query(" UPDATE {$g5['g5_shop_cart_table']} SET ct_status = '취소' WHERE od_id = '{$od_id}' ");

	// 주문 취소
	$cancel_price = $od['od_cart_price'];

	$sql = " UPDATE {$g5['g5_shop_order_table']} SET
					od_send_cost = '0',
					od_send_cost2 = '0',
					od_receipt_price = '0',
					od_receipt_point = '0',
					od_misu = '0',
					od_cancel_price = '{$cancel_price}',
					od_cart_coupon = '0',
					od_coupon = '0',
					od_send_coupon = '0',
					od_status = '취소',
					od_shop_memo = concat(od_shop_memo,\"\\n주문자 본인 직접 취소 - ".G5_TIME_YMDHIS." (취소이유 : {$cancel_memo})\")
				WHERE od_id = '{$od_id}' ";
	sql_query($sql);

	// 주문취소 회원의 포인트를 되돌려 줌
	if ($od['od_receipt_point'] > 0)
		insert_point($member['mb_id'], $od['od_receipt_point'], "주문번호 {$od_id} 본인 취소");

	// 신청자 정보 취소
	$sql = " UPDATE {$write_table} SET
					wr_18 = '취소',
					wr_28 = '{$canceldate}'
				WHERE wr_24 = '{$trxid}' ";
	sql_query($sql);

	// alert_close($errormessage);
}

?>


<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1"/>
	<meta http-equiv="Cache-Control" content="no-cache"/> 
	<meta http-equiv="Expires" content="0"/> 
	<meta http-equiv="Pragma" content="no-cache"/>
	<script type="text/javascript">
		alert("<?php echo $errormessage; ?>");
		opener.location.reload();
		self.close();
	</script>
</head>

<body>
<!-- 
<form name="orderForm">
	<div>
		<div>
			<div>
			<h1>ready단계(결제호출 URL, 토큰)와 과금 단계를 하나의 페이지로 처리하는 예제페이지</h1>
				<div>
					returnUrl	: <input type="text" id="returnUrl"		name="returnUrl"	value="<?php echo $returnUrl; ?>"/><br> 
					token		: <input type="text" id="token" 		name="token"		value="<?php echo $token; ?>"/><br> 
					<br>
					resultcode	: <input type="text" id="resultcode"	name="resultcode"	value="<?php echo $resultcode; ?>"/><br> 
					errormessage: <input type="text" id="errormessage"	name="errormessage"	value="<?php echo $errormessage; ?>"/><br> 
					daoutrx		: <input type="text" id="daoutrx"		name="daoutrx"		value="<?php echo $daoutrx; ?>"/><br> 
					amount		: <input type="text" id="amount"		name="amount"		value="<?php echo $amount; ?>"/><br> 
					orderno		: <input type="text" id="orderno"		name="orderno"		value="<?php echo $orderno; ?>"/><br> 
					canceldate	: <input type="text" id="canceldate"		name="canceldate"		value="<?php echo $canceldate; ?>"/><br> 
					cpname		: <input type="text" id="cpname"		name="cpname"		value="<?php echo $cpname; ?>"/><br> 
					cpurl		: <input type="text" id="cpurl"			name="cpurl"		value="<?php echo $cpurl; ?>"/><br> 
					cptelno		: <input type="text" id="cptelno"		name="cptelno"		value="<?php echo $cptelno; ?>"/><br> 
				</div>
				<div id="divbutton" >
					<a href="javascript:self.close();">닫기</a>
				</div>
			</div>
		</div>
		

	</div>
</form> -->
</body>
</html>