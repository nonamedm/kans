<?
$db_host	  = "localhost";
$db_user	  = "kans1";
$db_passwd    = "5547330";
$db_select    = "kans1";

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
