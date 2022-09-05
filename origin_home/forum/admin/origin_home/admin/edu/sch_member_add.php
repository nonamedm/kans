<?
include "../dbconn.inc";

if($_head_php_excuted) return;
if(!eregi($HTTP_HOST,$HTTP_REFERER)) Error("정상적으로 접근하여 주시기 바랍니다.");
if(eregi(":\/\/",$dir)) $dir=".";

$sql="select schedule from edu_member where id ='".$m_id."'";
$res = mysql_query($sql);
$row = mysql_fetch_object($res);
if($row->schedule != ''){
?>
<script language=javascript>
	alert('본 교육대상자는 이미 등록된 교육일자가 있습니다.');
	history.back();
</script>
<?
	exit;
}

$query = "update edu_member set edu_state = 2, schedule='".$id."'" ;
$query = $query." where id=".$m_id;
	
if(mysql_query($query)){
	echo"<script language=javascript>alert('등록되었습니다.');location.href='./sch_member.php?id=$id';</script>";
	exit;
}else{
	echo"<script language=javascript>alert('등록에 실패했습니다. 관리자에게 문의바랍니다.');location.href='./sch_member.php?id=$id';</script>";
	exit;
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<title>무제 문서</title>
</head>

<body>

</body>
</html>
