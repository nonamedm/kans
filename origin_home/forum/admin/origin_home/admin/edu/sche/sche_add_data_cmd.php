<?
include "../conf/connchk.inc";
include "../conf/dbconn.inc";

$id=trim($id);
$key=trim($k);
$now=mktime();
$now=date(Y.'.'.m.'.'.d,$now);
		
if($mode == MD5(delete)){ //����
	//�������°� ready �϶��� ������ �����ϴ�.
	$sql="select seq from on_edu_sch_data where code='".$id."' and datacode='".$key."'";
	$res = mysql_query($sql);
	$row = mysql_fetch_object($res);
	
	$query = "delete from on_edu_sch_data where seq='".$row->seq."' and datacode='".$key."' and code='".$id."'";
	//echo $query;
	
	$mode = MD5(data);
	$file = "sche_add_data.php";
	
/*	
}else if($mode == MD5(change)){ //�������� - �̱���
	//�Ϲݺ���
	$state = trim($state);
	$query = "update on_edu_member_sch set state='".$state."'";
	$query = $query." where idkey='".$key."' and code='".$id."'";
	
	//echo $query;
	$mode = MD5(complete);
	$file = "sche_member_comp.php";
*/
	
}else{ //�űԵ��
	//�ش� ���� ���� �ҷ�����
	$sqls="select code, datacode from on_edu_sch_data where code='".$id."' and datacode='".$key."'";
	$ress = mysql_query($sqls);
	$rows = mysql_fetch_object($ress);
	
	if($rows){
	?>
	<script language=javascript>
		alert('�̹� ��ϵ� �ڷ��Դϴ�.\n Ȯ���� �ּ���.');
		history.back();
	</script>
	<?
		exit;
	}
	
	$query = "insert into on_edu_sch_data(datacode, code, open, regdate) values(";
	$query = $query." '".$key."', ";
	$query = $query." '".$id."', ";
	$query = $query." '".$open."', ";
	$query = $query." '".$now."') ";
	//echo $query;
	
	$mode = MD5(data);
	$file = "sche_add_data.php";
}	

if(mysql_query($query)){
	echo"<script language=javascript>alert('���� ó���Ǿ����ϴ�');opener.location.reload();location.href='./".$file."?id=".$id."&mode=".$mode."';</script>";
	exit;
}else{
	echo"<script language=javascript>alert('��û�Ͻ� ó���� �����Ͽ����ϴ�. �����ڿ��� ���ǹٶ��ϴ�.');opener.location.reload();history.back();</script>";
	exit;
}


include "../conf/dbconn_close.inc";

?>