<?
include "../dbconn.inc";

if($_head_php_excuted) return;
if(!eregi($HTTP_HOST,$HTTP_REFERER)) Error("���������� �����Ͽ� �ֽñ� �ٶ��ϴ�.");
if(eregi(":\/\/",$dir)) $dir=".";

$sql="select schedule from edu_member where id ='".$m_id."'";
$res = mysql_query($sql);
$row = mysql_fetch_object($res);
if($row->schedule != ''){
?>
<script language=javascript>
	alert('�� ��������ڴ� �̹� ��ϵ� �������ڰ� �ֽ��ϴ�.');
	history.back();
</script>
<?
	exit;
}

$query = "update edu_member set edu_state = 2, schedule='".$id."'" ;
$query = $query." where id=".$m_id;
	
if(mysql_query($query)){
	echo"<script language=javascript>alert('��ϵǾ����ϴ�.');location.href='./sch_member.php?id=$id';</script>";
	exit;
}else{
	echo"<script language=javascript>alert('��Ͽ� �����߽��ϴ�. �����ڿ��� ���ǹٶ��ϴ�.');location.href='./sch_member.php?id=$id';</script>";
	exit;
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<title>���� ����</title>
</head>

<body>

</body>
</html>
