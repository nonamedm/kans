<?
if(!$cid){
	echo"<meta http-equiv=\"Refresh\" content=\"0 ; URL='../index.php'\">";
	exit;
} 
include  "../dbconn.inc"; 
if($_head_php_excuted) return;
if(!eregi($HTTP_HOST,$HTTP_REFERER)) Error("정상적으로 접근하여 주시기 바랍니다.");
if(eregi(":\/\/",$dir)) $dir=".";

$query = "update edu_member set schedule = null , s_point = 0" ;
$query = $query." where id=".$member;

if(mysql_query($query)){
	echo"<script language=javascript>alert('삭제되었습니다');location.href='./sch_member.php?id=$page';</script>";
	exit;
}else{
	echo"<script language=javascript>alert('삭제에 실패했습니다. 관리자에게 문의바랍니다.');location.href='./sch_member.php?id=$page';</script>";
	exit;
}

?>
