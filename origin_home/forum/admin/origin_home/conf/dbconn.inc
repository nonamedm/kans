<?
$db_host	  = "localhost";
$db_user	  = "kans1";
$db_passwd    = "kans7330";
$db_select    = "kans1";

/* 
kans1
kans7330
*/

if ( !($dbconn = mysql_connect($db_host,$db_user,$db_passwd)) ){
	die("DB���� ���ῡ �����Ͽ����ϴ�");
}

###################### �۾� �����ͺ��̽��� �����Ѵ� ######################
$status = mysql_select_db($db_select,$dbconn);
if ( !$status ) {
	$errNO = mysql_errno($dbconn);
	$errMSG = mysql_error($dbconn);

	echo("������ $db_select �����ͺ��̽����ῡ �����Ͽ����ϴ�!<br>");
	echo("�����ڵ� $errNO : $errMSG<br>");
	exit;
}
//////
?>
<!-- ����Ʈ2.0 �α׺м��ڵ� ���� -->
<script type="text/javascript">
var JsHost = (("https:" == document.location.protocol) ? "https://" : "http://");
var uname = escape("���ڷ¾�����ī����");
document.write(unescape("%3Cscript id='log_script' src='" + JsHost + "kans1.weblog.cafe24.com/weblog.js?uid=kans1&uname="+uname+"' type='text/javascript'%3E%3C/script%3E"));
</script>
<!-- ����Ʈ2.0  �α׺м��ڵ� �Ϸ� -->

