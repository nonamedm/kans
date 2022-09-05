<?
$db_host	  = "localhost";
$db_user	  = "kans1";
$db_passwd    = "kans7330";
$db_select    = "kans1";

if ( !($dbconn = mysql_connect($db_host,$db_user,$db_passwd)) ){
	die("DB서버 연결에 실패하였습니다");
}

###################### 작업 데이터베이스를 선택한다 ######################
$status = mysql_select_db($db_select,$dbconn);
if ( !$status ) {
	$errNO = mysql_errno($dbconn);
	$errMSG = mysql_error($dbconn);

	echo("서버의 $db_select 베이터베이스연결에 실패하였습니다!<br>");
	echo("에러코드 $errNO : $errMSG<br>");
	exit;
}
//////
?>

