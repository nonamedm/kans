<?
include "../conf/connchk.inc";
include "../conf/dbconn.inc";

$id=trim($id);
$pw=trim($pw);
$title=trim($title);
$url=trim($url);
	
if($mode == MD5(update)){ //��������
	
	$query = "update on_edu_data set title='".$title."',";
	$query = $query." type='".$type."', ";
	$query = $query." comm='".$comm."', ";
	$query = $query." url='".$url."', ";
	$query = $query." filename='".MD5($url)."', ";
	$query = $query." etc='".$etc."'";
	$query = $query." where datacode='".$id."'";
	
}else if($mode == MD5(delete)){ //����
	$sql="select seq from on_edu_data where datacode='".$id."'";
	$res = mysql_query($sql);
	$row = mysql_fetch_object($res);
	
	$query = "delete from on_edu_data where seq='".$row->seq."'and datacode='".$id."' ";
	//echo $query;
	
}else{ //�űԵ��
	$id= MD5($url.$type.$comm.$url);
	
	$sql="select datacode from on_edu_data where datacode='".$id."'";
	$res = mysql_query($sql);
	$row = mysql_fetch_object($res);
	if($row){
	?>
	<script language=javascript>
		alert('�̹� ��ϵ� �ڷ��Դϴ�.\n Ȯ���� �ּ���.');
		history.back();
	</script>
	<?
		exit;
	}
	
	$now=mktime();
	$now=date(Y.'.'.m.'.'.d,$now);
	
	$query = "insert into on_edu_data(datacode, title, type, comm, url, filename, etc, regdate) values(";
	$query = $query." '".$id."', ";
	$query = $query." '".$title."', ";
	$query = $query." '".$type."', ";
	$query = $query." '".$comm."', ";
	$query = $query." '".$url."', ";
	$query = $query." '".MD5($url)."', ";
	$query = $query." '".$etc."', ";
	$query = $query." '".$now."') ";
	//echo $query;
}	

if(mysql_query($query)){
	echo"<script language=javascript>alert('���� ó���Ǿ����ϴ�');opener.location.href='./data_list.php';window.close();</script>";
	exit;
}else{
	echo"<script language=javascript>alert('��û�Ͻ� ó���� �����Ͽ����ϴ�. �����ڿ��� ���ǹٶ��ϴ�.');opener.location.reload();window.close();</script>";
	exit;
}

include "../conf/dbconn_close.inc";

?>