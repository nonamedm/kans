<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<? 
if(!$cid){
	echo"<meta http-equiv=\"Refresh\" content=\"0 ; URL='../index.php'\">";
	exit;
}
include  "../dbconn.inc"; 


///////////////////////////////// ���        ///////////////


$sec_code=trim($sec_code);
$sec_memo=trim($sec_memo);

$now=mktime();
$now=date(Y.'.'.m.'.'.d,$now);

$sql = "select sec_code from sec_code where sec_code = '".$sec_code."'"; 
$res = mysql_query($sql);
$row = mysql_fetch_object($res);

if($row){
?>
<script language=javascript>
	alert('�̹� ��ϵ� ������ �����ڵ尡 �ֽ��ϴ�.\n\n�ٽ� Ȯ���� �ּ���.');
	history.back();
</script>
<?
	exit;
}

	$query2 = "insert into sec_code(sec_code, sec_memo, regdate) values(";
	$query2 = $query2." '".$sec_code."', ";
	$query2 = $query2." '".$sec_memo."', ";
	$query2 = $query2." '".$now."') ";
		
if(mysql_query($query2)){
	echo"<script language=javascript>alert('��ϵǾ����ϴ�');opener.location.href='./list.php';window.close();</script>";
	exit;
}else{
	echo"<script language=javascript>alert('��Ͽ� �����߽��ϴ�. �����ڿ��� ���ǹٶ��ϴ�.');opener.location.reload();window.close();</script>";
	exit;
}
?>