<?php
// echo "<pre>"; print_r($_REQUEST); echo "</pre>";
// echo iconv("UTF-8", "EUC-KR", $PRODUCTNAME);

// ���� ��ü ����
foreach($_REQUEST as $key=>$value){
	${$key} = iconv("UTF-8", "EUC-KR", $value);
}


?>
<!DOCTYPE html>
<html>
<head>
<title>����������(���հ���â_LINK)</title>
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
<!-- <input type="button" value="�����ϱ�" onClick="pay()" width="63" height="25"> -->

<?php $hidden = "hidden"; ?>
<!-- ----------�����׸�(�ʼ�) -->
<input type="<?php echo $hidden; ?>" name="TYPE" value="<?php echo $TYPE; ?>" />				<!-- TYPE �������(P:PC/M:�����/W:����) -->
<input type="<?php echo $hidden; ?>" name="PAYMETHOD" value="<?php echo $PAYMETHOD; ?>" />		<!-- PAYMETHOD �������� (�Ŵ��� �ִ� �������ܺ� PAYMETHODȮ��) -->
<input type="<?php echo $hidden; ?>" name="CPID" value="<?php echo $CPID; ?>" />				<!-- CPID �������̵� (�������ƿ��� �߱޹��� �׽�ƮID�Է�) -->
<input type="<?php echo $hidden; ?>" name="ORDERNO" value="<?php echo $ORDERNO; ?>" />			<!-- ORDERNO �ֹ���ȣ -->
<input type="<?php echo $hidden; ?>" name="PRODUCTTYPE" value="<?php echo $PRODUCTTYPE; ?>" />	<!-- PRODUCTTYPE ��ǰ����(1: ������, 2: �ǹ�) -->
<input type="<?php echo $hidden; ?>" name="AMOUNT" value="<?php echo $AMOUNT; ?>" />			<!-- AMOUNT �����ݾ� -->
<input type="<?php echo $hidden; ?>" name="PRODUCTNAME" value="<?php echo $PRODUCTNAME; ?>" />	<!-- PRODUCTNAME ��ǰ�� -->
<input type="<?php echo $hidden; ?>" name="PRODUCTCODE" value="<?php echo $PRODUCTCODE; ?>" />	<!-- PRODUCTCODE ��ǰ�ڵ� -->
<input type="<?php echo $hidden; ?>" name="USERID" value="<?php echo $USERID; ?>" />			<!-- USERID �� ID -->

<!-- ----------�����׸�(����) -->
<input type="<?php echo $hidden; ?>" name="EMAIL" value="<?php echo $EMAIL; ?>" />						<!-- EMAIL �� �̸��� -->
<input type="<?php echo $hidden; ?>" name="USERNAME" value="<?php echo $USERNAME; ?>" />				<!-- USERNAME ���� -->
<input type="<?php echo $hidden; ?>" name="RESERVEDINDEX1" value="<?php echo $RESERVEDINDEX1; ?>" />	<!-- RESERVEDINDEX1 �����׸� -->
<input type="<?php echo $hidden; ?>" name="RESERVEDINDEX2" value="<?php echo $RESERVEDINDEX2; ?>" />	<!-- RESERVEDINDEX2 �����׸� -->
<input type="<?php echo $hidden; ?>" name="RESERVEDSTRING" value="<?php echo $RESERVEDSTRING; ?>" />	<!-- RESERVEDSTRING ���ེƮ�� -->
<input type="<?php echo $hidden; ?>" name="RETURNURL" value="<?php echo $RETURNURL; ?>" />				<!-- RETURNURL ���� ���� ��, �̵��� URL(�� â) -->
<input type="<?php echo $hidden; ?>" name="HOMEURL" value="<?php echo $HOMEURL; ?>" />					<!-- HOMEURL ���� ���� ��, �̵��� URL(���� â���� �̵�) -->
<input type="<?php echo $hidden; ?>" name="DIRECTRESULTFLAG" value="<?php echo $DIRECTRESULTFLAG; ?>" /><!-- DIRECTRESULTFLAG Ű������ ���� �Ϸ� â ���� HOMEURL�� �ٷ� �̵�(Y/N) -->
<input type="<?php echo $hidden; ?>" name="SET_LOGO" value="<?php echo $SET_LOGO; ?>" />				<!-- SET_LOGO ���� â �ϴ� �����ΰ� URL -->

<!-- ----------�������â(�ʼ�) -->
<!-- HOMEURL ���� ���� ��, �̵��� URL(���� â���� �̵�) -->
<input type="<?php echo $hidden; ?>" name="CLOSEURL" value="<?php echo $CLOSEURL; ?>" />	<!-- CLOSEURL ���� â���� ��� ���� �� �̵��� URL -->
<input type="<?php echo $hidden; ?>" name="FAILURL" value="<?php echo $FAILURL; ?>" />		<!-- FAILURL �������� ��, Ȯ�ι�ư �Է� �� �̵��� URL -->
<input type="<?php echo $hidden; ?>" name="APPURL" value="<?php echo $APPURL; ?>" />		<!-- APPURL �����Ϸ� �� ���ư� ���� URL(CARD, CARDK, BANK �ʼ�) -->

<!-- ----------�ſ�ī��(�ʼ�) -->
<input type="<?php echo $hidden; ?>" name="TAXFREECD" value="<?php echo $TAXFREECD; ?>" />	<!-- TAXFREECD ����/���������(00: ����, 01: �����, 02: ���հ���) -->
<input type="<?php echo $hidden; ?>" name="TELNO2" value="<?php echo $TELNO2; ?>" />		<!-- TELNO2 ����� ���ݾ�(TAXFREECD�� 02�� ��쿡�� �ʼ�����) -->
<input type="<?php echo $hidden; ?>" name="CERTTYPE" value="<?php echo $CERTTYPE; ?>" />	<!-- CERTTYPE CARD-SUGI, CARDK-SUGI�� ��� �ʼ�(00:ī���ȣ/��ȿ�Ⱓ)(11:ī���ȣ/��ȿ�Ⱓ/�������/��й�ȣ��2�ڸ�) -->

<!-- ----------�ſ�ī��(����) -->
<input type="<?php echo $hidden; ?>" name="CPQUOTA" value="<?php echo $CPQUOTA; ?>" />				<!-- CPQUOTA CARD, CARD-SUGI�� ��� �ִ� �Һ� ���� ��(������ �� : ��) (�Ͻú�~12���� ��: 00:02:03:04~~~:12) -->
<input type="<?php echo $hidden; ?>" name="QUOTAOPT" value="<?php echo $QUOTAOPT; ?>" />			<!-- QUOTAOPT CARDK, CARDK-SUGI�� ��� �ִ� �Һ� ���� �� (�Ͻú�~12���� ��: 12) -->
<input type="<?php echo $hidden; ?>" name="CARDLIST" value="<?php echo $CARDLIST; ?>" />			<!-- CARDLIST CARD, CARDK�� ��� ���� â ī��� ���� ��(������ �� : ��)(ī����ڵ�� �Ŵ��� �ϴ�����) -->
<input type="<?php echo $hidden; ?>" name="HIDECARDLIST" value="<?php echo $HIDECARDLIST; ?>" />	<!-- HIDECARDLIST CARD, CARDK�� ��� ���� â ī��� ���� ��(������ �� : ��)(ī����ڵ�� �Ŵ��� �ϴ�����) -->
<input type="<?php echo $hidden; ?>" name="AUTOINFOFLAG" value="<?php echo $AUTOINFOFLAG; ?>" />	<!-- AUTOINFOFLAG CARD-BATCH, CARDK-BATCH�� ��� AUTOKEY ���۹��(A~DŸ�� �޴�������) -->

<!-- ----------�޴���(����) -->
<input type="<?php echo $hidden; ?>" name="MOBILECOMPANYLIST" value="<?php echo $MOBILECOMPANYLIST; ?>" />	<!-- MOBILECOMPANYLIST MOBILE,MOBILE-BATCH ���� â ��Ż縸 ���� ��(������ �� , ��)��Ż� �ڵ�: SKT/KTF/LGT/CJH/KCT -->

<!-- ----------������ü(����) -->
<input type="<?php echo $hidden; ?>" name="USERSSN" value="<?php echo $USERSSN; ?>" />					<!-- USERSSN �������(YYMMDD) -->
<input type="<?php echo $hidden; ?>" name="CHECKSSNYN" value="<?php echo $CHECKSSNYN; ?>" />			<!-- CHECKSSNYN USERSSN��뿩��(Y/N)(������ü �����ڿ� ������(USERSSN)�� ������ ��츸 ��������) -->

<!-- ----------�������(����) -->
<input type="<?php echo $hidden; ?>" name="DEPOSITENDDATE" value="<?php echo $DEPOSITENDDATE; ?>" />	<!-- DEPOSITENDDATE �Աݸ�����(YYYYMMDD24MISS)(������ �⺻�� 7��) -->
<input type="<?php echo $hidden; ?>" name="RECEIVERNAME" value="<?php echo $RECEIVERNAME; ?>" />		<!-- RECEIVERNAME �����θ�(�������� ������ ��ü��) -->

<!-- ---------- Ŀ���� �׸� -->
<input type="<?php echo $hidden; ?>" name="stdpay_js_url" id="stdpay_js_url" value="<?php echo $stdpay_js_url; ?>" />	<!-- �������� ���� url -->

</form>
</BODY>
</HTML>