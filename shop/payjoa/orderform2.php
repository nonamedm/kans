<?php
// echo "<pre>"; print_r($_REQUEST); echo "</pre>";
// echo iconv("UTF-8", "EUC-KR", $PRODUCTNAME);

// 언어셋 전체 변경
foreach($_REQUEST as $key=>$value){
	${$key} = iconv("UTF-8", "EUC-KR", $value);
}


?>
<!DOCTYPE html>
<html>
<head>
<title>결제페이지(통합결제창_LINK)</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate"/> 
<meta http-equiv="Expires" content="-1"/> 
<meta http-equiv="Pragma" content="no-cache"/>
<script type="text/javascript" src="/js/jquery-1.11.1.min.js"></script>
<style type="text/css">
</style>
	<script  type="text/javascript"  language="javascript">
		var pf;

		/* function init() {
			//alert(navigator.userAgent);
			pf = document.payForm;
			pf.ORDERNO.value= getTimeStamp();
		} */
		
		function pay() {
			pf = document.payForm;
			// var fileName = "https://apitest.payjoa.co.kr/pay/link";
			var fileName = pf.stdpay_js_url.value;
			// var PAYJOA = window.open("", "PAYJOA", "width=468,height=750");
			
			// pf.target = "PAYJOA";
			pf.action = fileName;
			pf.method = "post";
			pf.submit();

		}
		
		/* function getTimeStamp() {
			var d = new Date();
			var month = d.getMonth() + 1
			var date = d.getDate()
			var hour = d.getHours()
			var minute = d.getMinutes()
			var second = d.getSeconds()

			month = (month < 10 ? "0" : "") + month;
			date = (date < 10 ? "0" : "") + date;
			hour = (hour < 10 ? "0" : "") + hour;
			minute = (minute < 10 ? "0" : "") + minute;
			second = (second < 10 ? "0" : "") + second;

			var s =
			d.getFullYear() + month + date + hour + minute + second

			return s;
		} */
	</script>


</HEAD>

<BODY onload="pay();">
<form name="payForm">
<!-- <input type="button" value="결제하기" onClick="pay()" width="63" height="25"> -->

<?php $hidden = "hidden"; ?>
<!-- ----------공통항목(필수) -->
<input type="<?php echo $hidden; ?>" name="TYPE" value="<?php echo $TYPE; ?>" />				<!-- TYPE 결제방식(P:PC/M:모바일/W:웹뷰) -->
<input type="<?php echo $hidden; ?>" name="PAYMETHOD" value="<?php echo $PAYMETHOD; ?>" />		<!-- PAYMETHOD 결제수단 (매뉴얼에 있는 결제수단별 PAYMETHOD확인) -->
<input type="<?php echo $hidden; ?>" name="CPID" value="<?php echo $CPID; ?>" />				<!-- CPID 상점아이디 (페이조아에서 발급받은 테스트ID입력) -->
<input type="<?php echo $hidden; ?>" name="ORDERNO" value="<?php echo $ORDERNO; ?>" />			<!-- ORDERNO 주문번호 -->
<input type="<?php echo $hidden; ?>" name="PRODUCTTYPE" value="<?php echo $PRODUCTTYPE; ?>" />	<!-- PRODUCTTYPE 상품구분(1: 디지털, 2: 실물) -->
<input type="<?php echo $hidden; ?>" name="AMOUNT" value="<?php echo $AMOUNT; ?>" />			<!-- AMOUNT 결제금액 -->
<input type="<?php echo $hidden; ?>" name="PRODUCTNAME" value="<?php echo $PRODUCTNAME; ?>" />	<!-- PRODUCTNAME 상품명 -->
<input type="<?php echo $hidden; ?>" name="PRODUCTCODE" value="<?php echo $PRODUCTCODE; ?>" />	<!-- PRODUCTCODE 상품코드 -->
<input type="<?php echo $hidden; ?>" name="USERID" value="<?php echo $USERID; ?>" />			<!-- USERID 고객 ID -->

<!-- ----------공통항목(선택) -->
<input type="<?php echo $hidden; ?>" name="EMAIL" value="<?php echo $EMAIL; ?>" />						<!-- EMAIL 고객 이메일 -->
<input type="<?php echo $hidden; ?>" name="USERNAME" value="<?php echo $USERNAME; ?>" />				<!-- USERNAME 고객명 -->
<input type="<?php echo $hidden; ?>" name="RESERVEDINDEX1" value="<?php echo $RESERVEDINDEX1; ?>" />	<!-- RESERVEDINDEX1 예약항목 -->
<input type="<?php echo $hidden; ?>" name="RESERVEDINDEX2" value="<?php echo $RESERVEDINDEX2; ?>" />	<!-- RESERVEDINDEX2 예약항목 -->
<input type="<?php echo $hidden; ?>" name="RESERVEDSTRING" value="<?php echo $RESERVEDSTRING; ?>" />	<!-- RESERVEDSTRING 예약스트링 -->
<input type="<?php echo $hidden; ?>" name="RETURNURL" value="<?php echo $RETURNURL; ?>" />				<!-- RETURNURL 결제 성공 후, 이동할 URL(새 창) -->
<input type="<?php echo $hidden; ?>" name="HOMEURL" value="<?php echo $HOMEURL; ?>" />					<!-- HOMEURL 결제 성공 후, 이동할 URL(결제 창에서 이동) -->
<input type="<?php echo $hidden; ?>" name="DIRECTRESULTFLAG" value="<?php echo $DIRECTRESULTFLAG; ?>" /><!-- DIRECTRESULTFLAG 키움페이 결제 완료 창 없이 HOMEURL로 바로 이동(Y/N) -->
<input type="<?php echo $hidden; ?>" name="SET_LOGO" value="<?php echo $SET_LOGO; ?>" />				<!-- SET_LOGO 결제 창 하단 상점로고 URL -->

<!-- ----------웹뷰결제창(필수) -->
<!-- HOMEURL 결제 성공 후, 이동할 URL(결제 창에서 이동) -->
<input type="<?php echo $hidden; ?>" name="CLOSEURL" value="<?php echo $CLOSEURL; ?>" />	<!-- CLOSEURL 결제 창에서 취소 누를 시 이동할 URL -->
<input type="<?php echo $hidden; ?>" name="FAILURL" value="<?php echo $FAILURL; ?>" />		<!-- FAILURL 결제실패 후, 확인버튼 입력 시 이동할 URL -->
<input type="<?php echo $hidden; ?>" name="APPURL" value="<?php echo $APPURL; ?>" />		<!-- APPURL 인증완료 후 돌아갈 앱의 URL(CARD, CARDK, BANK 필수) -->

<!-- ----------신용카드(필수) -->
<input type="<?php echo $hidden; ?>" name="TAXFREECD" value="<?php echo $TAXFREECD; ?>" />	<!-- TAXFREECD 과세/비과세여부(00: 과세, 01: 비과세, 02: 복합과세) -->
<input type="<?php echo $hidden; ?>" name="TELNO2" value="<?php echo $TELNO2; ?>" />		<!-- TELNO2 비과세 대상금액(TAXFREECD가 02인 경우에만 필수전송) -->
<input type="<?php echo $hidden; ?>" name="CERTTYPE" value="<?php echo $CERTTYPE; ?>" />	<!-- CERTTYPE CARD-SUGI, CARDK-SUGI인 경우 필수(00:카드번호/유효기간)(11:카드번호/유효기간/생년월일/비밀번호앞2자리) -->

<!-- ----------신용카드(선택) -->
<input type="<?php echo $hidden; ?>" name="CPQUOTA" value="<?php echo $CPQUOTA; ?>" />				<!-- CPQUOTA CARD, CARD-SUGI인 경우 최대 할부 개월 수(구분자 “ : “) (일시불~12개월 예: 00:02:03:04~~~:12) -->
<input type="<?php echo $hidden; ?>" name="QUOTAOPT" value="<?php echo $QUOTAOPT; ?>" />			<!-- QUOTAOPT CARDK, CARDK-SUGI인 경우 최대 할부 개월 수 (일시불~12개월 예: 12) -->
<input type="<?php echo $hidden; ?>" name="CARDLIST" value="<?php echo $CARDLIST; ?>" />			<!-- CARDLIST CARD, CARDK인 경우 결제 창 카드사 노출 값(구분자 “ : “)(카드사코드는 매뉴얼 하단참고) -->
<input type="<?php echo $hidden; ?>" name="HIDECARDLIST" value="<?php echo $HIDECARDLIST; ?>" />	<!-- HIDECARDLIST CARD, CARDK인 경우 결제 창 카드사 숨김 값(구분자 “ : “)(카드사코드는 매뉴얼 하단참고) -->
<input type="<?php echo $hidden; ?>" name="AUTOINFOFLAG" value="<?php echo $AUTOINFOFLAG; ?>" />	<!-- AUTOINFOFLAG CARD-BATCH, CARDK-BATCH인 경우 AUTOKEY 전송방식(A~D타입 메뉴얼참고) -->

<!-- ----------휴대폰(선택) -->
<input type="<?php echo $hidden; ?>" name="MOBILECOMPANYLIST" value="<?php echo $MOBILECOMPANYLIST; ?>" />	<!-- MOBILECOMPANYLIST MOBILE,MOBILE-BATCH 결제 창 통신사만 노출 값(구분자 “ , “)통신사 코드: SKT/KTF/LGT/CJH/KCT -->

<!-- ----------계좌이체(선택) -->
<input type="<?php echo $hidden; ?>" name="USERSSN" value="<?php echo $USERSSN; ?>" />					<!-- USERSSN 생년월일(YYMMDD) -->
<input type="<?php echo $hidden; ?>" name="CHECKSSNYN" value="<?php echo $CHECKSSNYN; ?>" />			<!-- CHECKSSNYN USERSSN사용여부(Y/N)(계좌이체 결제자와 명의자(USERSSN)가 동일한 경우만 결제가능) -->

<!-- ----------가상계좌(선택) -->
<input type="<?php echo $hidden; ?>" name="DEPOSITENDDATE" value="<?php echo $DEPOSITENDDATE; ?>" />	<!-- DEPOSITENDDATE 입금만료일(YYYYMMDD24MISS)(미지정 기본값 7일) -->
<input type="<?php echo $hidden; ?>" name="RECEIVERNAME" value="<?php echo $RECEIVERNAME; ?>" />		<!-- RECEIVERNAME 수취인명(지정하지 않으면 업체명) -->

<!-- ---------- 커스텀 항목 -->
<input type="<?php echo $hidden; ?>" name="stdpay_js_url" id="stdpay_js_url" value="<?php echo $stdpay_js_url; ?>" />	<!-- 페이조아 수신 url -->

</form>
</BODY>
</HTML>