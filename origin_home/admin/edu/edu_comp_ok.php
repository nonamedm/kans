<?
if(!$cid){
	echo"<meta http-equiv=\"Refresh\" content=\"0 ; URL='../index.php'\">";
	exit;
}
include "../dbconn.inc";

if($_head_php_excuted) return;
if(!eregi($HTTP_HOST,$HTTP_REFERER)) Error("���������� �����Ͽ� �ֽñ� �ٶ��ϴ�.");
if(eregi(":\/\/",$dir)) $dir=".";

$sql="SELECT * FROM edu_member where mem_id = '".$id."'";
$res0=mysql_query($sql);
$row0=mysql_fetch_object($res0);

if($row0->edu_state < 6){
?>
<script language=javascript>
	alert('�������°� ���� ����� üũ���� �ʾҽ��ϴ�. .\n\n �ٽ� Ȯ���� �ּ���.');
	history.back();
</script>
<?
	exit;
}

$sql="select mem_id, jumin2, comp_year from  edu_member_comp_day where mem_id='".$id."' and jumin2='".$ju."' and comp_year='".$cy."'";
$res = mysql_query($sql);
$row = mysql_fetch_object($res);

if($row){
?>
<script language=javascript>
	alert('�̹� �ش�⵵ ������ ������ ����������Դϴ�.\n\n �ٽ� Ȯ���� �ּ���.');
	history.back();
</script>
<?
	exit;
}	
	$sql="SELECT * FROM edu_schedule where id = '".$row0->schedule ."'";
	$res1=mysql_query($sql);
	$row1=mysql_fetch_object($res1);

	$query2 = "insert into edu_member_comp_day(mem_id, name, jumin2, comp_year, comp_month, comp_day, regdate) values(";
	$query2 = $query2." '".$id."', ";
	$query2 = $query2." '".$row0->name."', ";
	$query2 = $query2." '".$row0->jumin2."', ";
	$query2 = $query2." '".$row1->year."', ";
	$query2 = $query2." '".$row1->month."', ";
	$query2 = $query2." '".$row1->day."', ";
	$query2 = $query2." '".$now."') ";
	
	$result2 = mysql_query($query2);
	
	
if($result2){
	echo"<script language=javascript>alert('��ϵǾ����ϴ�');location.href='./view.php?id=".$id."&page=".$page."&search=".$search."&keyword=".$keyword."'</script>";
	exit;
}else{
	echo"<script language=javascript>alert('��Ͽ� �����߽��ϴ�. �����ڿ��� ���ǹٶ��ϴ�.');history.back();</script>";
	exit;
}
?>
