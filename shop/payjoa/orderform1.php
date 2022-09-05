<?php
// if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

include_once('./_common.php');

require_once(G5_SHOP_PATH.'/settle_'.$default['de_pg_service'].'.inc.php');

// 장바구니 테이블 컬럼 추가
for($i = 1; $i <= 1; $i++){
	$check_query = "
	SELECT 1 FROM Information_schema.columns
	WHERE table_schema = '".G5_MYSQL_DB."' 
	AND table_name = '".$g5['g5_shop_cart_table']."' 
	AND column_name = 'ct_".$i."'";

	$check_result = sql_query($check_query);
	$check_info = sql_fetch_array($check_result);

	if(!$check_info['1']) {
		
		switch($i){
			case 1: $col = " INT(11) ";
			default: $col = " VARCHAR(255) ";
		}
		$alter_query = "ALTER TABLE ".$g5['g5_shop_cart_table']." ADD COLUMN ct_".$i." ".$col." NOT NULL";
		sql_query($alter_query);
	}
}

$ORDERNO = ""; // 주문번호

$AMOUNT = 0;			// 결제금액
$PRODUCTNAME = "";		// 상품명
$PRODUCTCODE = "";		// 상품코드
$USERID = "";			// 고객 아이디

$EMAIL = "";			// 고객 이메일
$USERNAME = "";			// 고객명

/* 신용카드 거래에선 안쓰이는 변수라 다른 용도로 사용 */
$RESERVEDINDEX1 = "";	// 예약어1
$RESERVEDINDEX2 = "";	// 예약어2
$RESERVEDSTRING = "";	// 예약스트링

// 넘겨진 결제할 사항들
if(count($chk_wr_id)){

	$PRODUCTNAME = $member['mb_name']."님의";	// 상품명
	
	// 현재 신청정보의 프로그램_PK 확인
	$sql = " SELECT wr_1 FROM ".$write_table." WHERE wr_id IN ('".implode("', '", $chk_wr_id)."') AND wr_17 != '결제완료' ";
	$result = sql_query($sql);
	for ($i=0; $row = sql_fetch_array($result); $i++) {
		
		// 해당 신청의 프로그램 정보
		$program_info = sql_fetch(" SELECT wr_1, wr_2 FROM ".substr($write_table, 0, -2)." WHERE wr_id = '".$row['wr_1']."' ");
		
		// 1번 분류가 있을 경우
		if($program_info["wr_1"]){ $ca_info = get_category_info(substr($bo_table, 0, -2), $program_info["wr_1"]); }
		
		// 2번 분류가 있을 경우
		if($program_info["wr_2"]){ $ca_info = get_category_info(substr($bo_table, 0, -2), $program_info["wr_2"]); }
		
		$PRODUCTNAME .= " ".$ca_info["ca_name"];
	}

	$pay_info = sql_fetch(" SELECT SUM(wr_15) AS wr_15, SUM(wr_16) AS wr_16 FROM ".$write_table." WHERE wr_id IN ('".implode("', '", $chk_wr_id)."') AND wr_17 != '결제완료' ");
}

$ORDERNO = date('YmdHis');

$AMOUNT = $pay_info['wr_16'] - $pay_info['wr_15'];

// $PRODUCTNAME = $member['mb_name']."님의 교육비결제";	// 상품명
$PRODUCTCODE = "1112";	// 상품코드
$USERID = $member['mb_id'];	// 고객 아이디

$EMAIL = $member['mb_email'];	// 고객 이메일
$USERNAME = $member['mb_name'];	// 고객명

// 거래가 일어난 일어난 게시글 pk들
$RESERVEDSTRING = implode(",", $chk_wr_id);

?>
<html>
<head>
<title>한국원자력안전아카데미 - 교육비 결제</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Cache-Control" content="no-cache"/> 
<meta http-equiv="Expires" content="0"/> 
<meta http-equiv="Pragma" content="no-cache"/>

<script src="<?php echo G5_JS_URL ?>/jquery-1.11.1.js"></script>
<script type="text/javascript" language="javascript">
	var pf;

	function pay() {

		// Get form
		var form = $('#payForm')[0];

		// Create an FormData object 
		var data = new FormData(form);

		var url = "<?php echo G5_SHOP_URL; ?>/payjoa/ajax.php";
	 
		$.ajax({
			type: "POST",
			enctype: 'multipart/form-data',
			url: url,
			data: data,
			processData: false,
			contentType: false,
			cache: false,
			dataType: "text",
			success: function(txt){

				pf = document.payForm;
				pf.action = "<?php echo G5_SHOP_URL; ?>/payjoa/orderform2.php";
				pf.method = "post";
				pf.ORDERNO.value = txt;
				pf.submit();

			},
			error: function(xhr, status, error) {
				alert(error);
			}  
		});

		/* pf = document.payForm;
		pf.action = "<?php echo G5_SHOP_URL; ?>/payjoa/orderform2.php";
		pf.method = "post";
		pf.submit() */

	}

	$( document ).ready(function() {
		// pay();
	});

</script>
<style>
	* {padding:0; margin:0; box-sizing:border-box; font-size:14px; font-family:"맑은 고딕"; color:#333;}
	.wrap {width:400px; margin:0 auto;}
	h1 {font-size:16px; font-weight:bold; text-align:center; margin-top:20px;}
	table {width:100%; table-layout:fixed; border-collapse:collapse;margin-top:10px;}
	th {background:#ccc; font-weight:bold;}
	td, th {padding:10px; border:1px solid #ccc; text-align:left; font-size:14px; border:1px solid #333;}
	input[type=text] {max-width:100%;}
	input[type=button] {display:block; margin:0 auto; width:80px; margin-top:10px;}
</style>
<div class="wrap">
<form name="payForm" id="payForm" enctype="multipart/form-data" method="post">

	<table>
		<colgroup>
			<col width="150">
			<col width="*">
		</colgroup>
		<tbody>
			<!-- PAYMETHOD : 결제수단[공통항목(필수)] -->
			<tr>
				<th>결제수단</th>
				<td>
					<select name="PAYMETHOD">
						<option value="CARDK">신용카드</option><!-- 신용카드K(일반) -->
						<!-- <option value="CARD">신용카드</option> --><!-- 신용카드(일반) -->
						<option value="VACCT">가상계좌</option><!-- 가상계좌(일반) -->
						<option value="BANK">계좌이체</option><!-- 계좌이체(일반) -->
					</select>
				</td>
			</tr>
			<!-- PRODUCTNAME : 상품명[선택항목] -->
			<tr>
				<th>교육명</th>
				<td><?php echo $PRODUCTNAME; ?></td>
			</tr>
			<!-- AMOUNT : 결제금액[필수항목] -->
			<tr>
				<th>결제금액</th>
				<td><?php echo number_format($AMOUNT); ?>원</td>
			</tr>
			<!-- USERNAME : 고객명 [선택항목] -->
			<tr>
				<th>고객명</th>
				<td><?php echo $USERNAME; ?></td>
			</tr>
			<!-- EMAIL : 고객 E-MAIL(결제결과 통보 Default) [선택항목] -->
			<tr>
				<th>고객 E-MAIL</th>
				<td><?php echo $EMAIL; ?></td>
			</tr>
		</tbody>
	</table>

	<input type="button" value="결제하기" onClick="pay();" width="63" height="25">

<?php $hidden = "hidden"; ?>
<!-- ----------공통항목(필수) -->
<input type="<?php echo $hidden; ?>" name="TYPE" value="P" />								<!-- TYPE 결제방식(P:PC/M:모바일/W:웹뷰) -->
<!-- <input type="<?php echo $hidden; ?>" name="PAYMETHOD" value="<?php echo $PAYMETHOD; ?>" /> -->	<!-- PAYMETHOD 결제수단 (매뉴얼에 있는 결제수단별 PAYMETHOD확인) -->
<input type="<?php echo $hidden; ?>" name="CPID" value="<?php echo $mid; ?>" />				<!-- CPID 상점아이디 (페이조아에서 발급받은 테스트ID입력) -->
<input type="<?php echo $hidden; ?>" name="ORDERNO" value="<?php echo $ORDERNO; ?>" />		<!-- ORDERNO 주문번호 -->
<input type="<?php echo $hidden; ?>" name="PRODUCTTYPE" value="1" />						<!-- PRODUCTTYPE 상품구분(1: 디지털, 2: 실물) -->
<input type="<?php echo $hidden; ?>" name="AMOUNT" value="<?php echo $AMOUNT; ?>" />							<!-- AMOUNT 결제금액 -->
<input type="<?php echo $hidden; ?>" name="PRODUCTNAME" value="<?php echo $PRODUCTNAME; ?>" />					<!-- PRODUCTNAME 상품명 -->
<input type="<?php echo $hidden; ?>" name="PRODUCTCODE" value="<?php echo $PRODUCTCODE; ?>" />					<!-- PRODUCTCODE 상품코드 -->
<input type="<?php echo $hidden; ?>" name="USERID" value="<?php echo $USERID; ?>" />						<!-- USERID 고객 ID -->

<!-- ----------공통항목(선택) -->
<input type="<?php echo $hidden; ?>" name="EMAIL" value="<?php echo $EMAIL; ?>" />							<!-- EMAIL 고객 이메일 -->
<input type="<?php echo $hidden; ?>" name="USERNAME" value="<?php echo $USERNAME; ?>" />					<!-- USERNAME 고객명 -->
<input type="<?php echo $hidden; ?>" name="RESERVEDINDEX1" value="<?php echo $RESERVEDINDEX1; ?>" />		<!-- RESERVEDINDEX1 예약항목 -->
<input type="<?php echo $hidden; ?>" name="RESERVEDINDEX2" value="<?php echo $RESERVEDINDEX2; ?>" />		<!-- RESERVEDINDEX2 예약항목 -->
<input type="<?php echo $hidden; ?>" name="RESERVEDSTRING" value="<?php echo $RESERVEDSTRING; ?>" />	<!-- RESERVEDSTRING 예약스트링 -->
<input type="<?php echo $hidden; ?>" name="RETURNURL" value="" />						<!-- RETURNURL 결제 성공 후, 이동할 URL(새 창) -->
<input type="<?php echo $hidden; ?>" name="HOMEURL" value="<?php echo $HOMEURL; ?>" />	<!-- HOMEURL 결제 성공 후, 이동할 URL(결제 창에서 이동) -->
<input type="<?php echo $hidden; ?>" name="DIRECTRESULTFLAG" value="" />				<!-- DIRECTRESULTFLAG 키움페이 결제 완료 창 없이 HOMEURL로 바로 이동(Y/N) -->
<input type="<?php echo $hidden; ?>" name="SET_LOGO" value="" />						<!-- SET_LOGO 결제 창 하단 상점로고 URL -->

<!-- ----------웹뷰결제창(필수) -->
<!-- HOMEURL 결제 성공 후, 이동할 URL(결제 창에서 이동) -->
<input type="<?php echo $hidden; ?>" name="CLOSEURL" value="<?php echo $CLOSEURL; ?>" />	<!-- CLOSEURL 결제 창에서 취소 누를 시 이동할 URL -->
<input type="<?php echo $hidden; ?>" name="FAILURL" value="<?php echo $FAILURL; ?>" />		<!-- FAILURL 결제실패 후, 확인버튼 입력 시 이동할 URL -->
<input type="<?php echo $hidden; ?>" name="APPURL" value="<?php echo $APPURL; ?>" />		<!-- APPURL 인증완료 후 돌아갈 앱의 URL(CARD, CARDK, BANK 필수) -->

<!-- ----------신용카드(필수) -->
<input type="<?php echo $hidden; ?>" name="TAXFREECD" value="<?php echo $TAXFREECD; ?>" />	<!-- TAXFREECD 과세/비과세여부(00: 과세, 01: 비과세, 02: 복합과세) -->
<input type="<?php echo $hidden; ?>" name="TELNO2" value="" />								<!-- TELNO2 비과세 대상금액(TAXFREECD가 02인 경우에만 필수전송) -->
<input type="<?php echo $hidden; ?>" name="CERTTYPE" value="" />							<!-- CERTTYPE CARD-SUGI, CARDK-SUGI인 경우 필수(00:카드번호/유효기간)(11:카드번호/유효기간/생년월일/비밀번호앞2자리) -->

<!-- ----------신용카드(선택) -->
<input type="<?php echo $hidden; ?>" name="CPQUOTA" value="" />							<!-- CPQUOTA CARD, CARD-SUGI인 경우 최대 할부 개월 수(구분자 “ : “) (일시불~12개월 예: 00:02:03:04~~~:12) -->
<input type="<?php echo $hidden; ?>" name="QUOTAOPT" value="" />						<!-- QUOTAOPT CARDK, CARDK-SUGI인 경우 최대 할부 개월 수 (일시불~12개월 예: 12) -->
<input type="<?php echo $hidden; ?>" name="CARDLIST" value="" />						<!-- CARDLIST CARD, CARDK인 경우 결제 창 카드사 노출 값(구분자 “ : “)(카드사코드는 매뉴얼 하단참고) -->
<input type="<?php echo $hidden; ?>" name="HIDECARDLIST" value="" />					<!-- HIDECARDLIST CARD, CARDK인 경우 결제 창 카드사 숨김 값(구분자 “ : “)(카드사코드는 매뉴얼 하단참고) -->
<input type="<?php echo $hidden; ?>" name="AUTOINFOFLAG" value="" />					<!-- AUTOINFOFLAG CARD-BATCH, CARDK-BATCH인 경우 AUTOKEY 전송방식(A~D타입 메뉴얼참고) -->

<!-- ----------휴대폰(선택) -->
<input type="<?php echo $hidden; ?>" name="MOBILECOMPANYLIST" value="" />				<!-- MOBILECOMPANYLIST MOBILE,MOBILE-BATCH 결제 창 통신사만 노출 값(구분자 “ , “)통신사 코드: SKT/KTF/LGT/CJH/KCT -->

<!-- ----------계좌이체(선택) -->
<input type="<?php echo $hidden; ?>" name="USERSSN" value="" />							<!-- USERSSN 생년월일(YYMMDD) -->
<input type="<?php echo $hidden; ?>" name="CHECKSSNYN" value="" />						<!-- CHECKSSNYN USERSSN사용여부(Y/N)(계좌이체 결제자와 명의자(USERSSN)가 동일한 경우만 결제가능) -->

<!-- ----------가상계좌(선택) -->
<input type="<?php echo $hidden; ?>" name="DEPOSITENDDATE" value="" />					<!-- DEPOSITENDDATE 입금만료일(YYYYMMDD24MISS)(미지정 기본값 7일) -->
<input type="<?php echo $hidden; ?>" name="RECEIVERNAME" value="" />					<!-- RECEIVERNAME 수취인명(지정하지 않으면 업체명) -->

<!-- ---------- 커스텀 항목 -->
<input type="<?php echo $hidden; ?>" name="stdpay_js_url" id="stdpay_js_url" value="<?php echo $stdpay_js_url; ?>" />	<!-- 페이조아 수신 url -->

<!-- 인피아드 커스텀 항목 -->
<input type="<?php echo $hidden; ?>" name="bo_table" value="<?php echo $bo_table; ?>" />
<input type="<?php echo $hidden; ?>" name="mode" value="create_order" />

</form>
</div>
</body>
</html>