<?
include "../conf/connchk.inc";
include "../conf/dbconn.inc";

$key=trim($id);
$name=trim($name);
$company=trim($company);
$jumin1=trim($jumin1);
$jumin2=trim($jumin2);
	
if($mode == MD5(update)){ //��������
	
	$query = "update on_edu_member set name='".$name."',";
	$query = $query." tel='".$tel."', ";
	$query = $query." com_id='".$company."', ";
	$query = $query." part='".$part."', ";
	$query = $query." email='".$email."', ";
	$query = $query." lictype='".$lictype."', ";
	$query = $query." licnum='".$licnum."', ";
	$query = $query." licdate='".$licdate."'";
	$query = $query." where idkey='".$id."'";
	//echo $query;
	
}else if($mode == MD5(delete)){ //����
	$sql="select seq from on_edu_member where idkey='".$id."'";
	$res = mysql_query($sql);
	$row = mysql_fetch_object($res);
	//���������� ����
	$query = "delete from on_edu_member where seq='".$row->seq."'and idkey='".$id."'";
	//������û���� ����
	$query1 = "delete from on_edu_member_sch where idkey='".$id."'";
	mysql_query($query1);
	//������� ����
	$query2 = "delete from on_edu_member_rec where idkey='".$id."'";
	mysql_query($query2);
	//echo $query;
	
}else{ //�űԵ��
	$sql="select jumin1, jumin2 from on_edu_member where jumin1='".$jumin1."' and jumin2='".$jumin2."'";
	$res = mysql_query($sql);
	$row = mysql_fetch_object($res);

	if($row){
	?>
	<script language=javascript>
		alert('�̹� ��ϵ� ������Դϴ�.\n Ȯ���� �ּ���.');
		history.back();
	</script>
	<?
		exit;
	}
	
	$now=mktime();
	$now=date(Y.'.'.m.'.'.d,$now);
	
	$key=MD5($jumin1."-".$jumin2);
	
	$query = "insert into on_edu_member(idkey, com_id, name, jumin1, jumin2, tel, part, email, lictype, licnum, licdate, regdate) values(";
	$query = $query." '".$key."', ";
	$query = $query." '".$company."', ";
	$query = $query." '".$name."', ";
	$query = $query." '".$jumin1."', ";
	$query = $query." '".$jumin2."', ";
	$query = $query." '".$tel."', ";
	$query = $query." '".$part."', ";
	$query = $query." '".$email."', ";
	$query = $query." '".$lictype."', ";
	$query = $query." '".$licnum."', ";
	$query = $query." '".$licdate."', ";
	$query = $query." '".$now."') ";
	//echo $query;
}	

if(mysql_query($query)){
	echo"<script language=javascript>alert('���� ó���Ǿ����ϴ�');opener.location.href='./member_list.php';window.close();</script>";
	exit;
}else{
	echo"<script language=javascript>alert('��û�Ͻ� ó���� �����Ͽ����ϴ�. �����ڿ��� ���ǹٶ��ϴ�.');opener.location.reload();window.close();</script>";
	exit;
}


include "../conf/dbconn_close.inc";

?>