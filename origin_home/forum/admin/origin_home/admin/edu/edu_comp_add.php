<?
if(!$cid){
	echo"<meta http-equiv=\"Refresh\" content=\"0 ; URL='../index.php'\">";
	exit;
}
include "../dbconn.inc";

if($_head_php_excuted) return;
if(!eregi($HTTP_HOST,$HTTP_REFERER)) Error("정상적으로 접근하여 주시기 바랍니다.");
if(eregi(":\/\/",$dir)) $dir=".";

$sql="select mem_id, jumin2, comp_year from  edu_member_comp_day where mem_id='".$id."' and jumin2='".$ju."' and comp_year='".$comp_year."'";
$res = mysql_query($sql);
$row = mysql_fetch_object($res);

if($row){
?>
<script language=javascript>
	alert('이미 해당년도 교육을 수료한 기록이 있습니다.\n\n다시 확인해 주세요.');
	history.back();
</script>
<?
	exit;
}

	$sql="SELECT * FROM edu_member where mem_id = '".$id."'";
	$res0=mysql_query($sql);
	$row0=mysql_fetch_object($res0);

	$query2 = "insert into edu_member_comp_day(mem_id, name, jumin2, comp_year, comp_month, comp_day, regdate) values(";
	$query2 = $query2." '".$id."', ";
	$query2 = $query2." '".$row0->name."', ";
	$query2 = $query2." '".$row0->jumin2."', ";
	$query2 = $query2." '".$comp_year."', ";
	$query2 = $query2." '".$comp_month."', ";
	$query2 = $query2." '".$comp_day."', ";
	$query2 = $query2." '".$now."') ";
	
	$result2 = mysql_query($query2);
	
	
if($result2){
	echo"<script language=javascript>alert('등록되었습니다');opener.location.reload();history.back();</script>";
	exit;
}else{
	echo"<script language=javascript>alert('등록에 실패했습니다. 관리자에게 문의바랍니다.');history.back();</script>";
	exit;
}
?>
