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
	die("DB서버 연결에 실패하였습니다");
}

###################### 작업 데이터베이스를 선택한다 ######################
$status = mysql_select_db($db_select,$dbconn);
if ( !$status ) {
	$errNO = mysql_errno($dbconn);
	$errMSG = mysql_error($dbconn);

	echo("서버의 $db_select 데이터베이스연결에 실패하였습니다!<br>");
	echo("에러코드 $errNO : $errMSG<br>");
	exit;
}
//////
?>
<!-- 리포트2.0 로그분석코드 시작 -->
<script type="text/javascript">
var JsHost = (("https:" == document.location.protocol) ? "https://" : "http://");
var uname = escape("원자력안전아카데미");
document.write(unescape("%3Cscript id='log_script' src='" + JsHost + "kans1.weblog.cafe24.com/weblog.js?uid=kans1&uname="+uname+"' type='text/javascript'%3E%3C/script%3E"));
</script>
<!-- 리포트2.0  로그분석코드 완료 -->


