<?
if(!$cid){
	echo"<meta http-equiv=\"Refresh\" content=\"0 ; URL='../index.php'\">";
	exit;
} 
include  "../dbconn.inc"; 
if($_head_php_excuted) return;
if(!eregi($HTTP_HOST,$HTTP_REFERER)) Error("���������� �����Ͽ� �ֽñ� �ٶ��ϴ�.");
if(eregi(":\/\/",$dir)) $dir=".";

$query = "update edu_member set schedule = null , s_point = 0" ;
$query = $query." where id=".$member;

if(mysql_query($query)){
	echo"<script language=javascript>alert('�����Ǿ����ϴ�');location.href='./sch_member.php?id=$page';</script>";
	exit;
}else{
	echo"<script language=javascript>alert('������ �����߽��ϴ�. �����ڿ��� ���ǹٶ��ϴ�.');location.href='./sch_member.php?id=$page';</script>";
	exit;
}

?>
