<?
include "../conf/connchk.inc";
include "../conf/dbconn.inc";

$id=trim($id);
$type=trim($type);
$sdate=trim($sdate);
$edate=trim($edate);
$year = substr($sdate,0,4);
	
if($mode == MD5(update)){ //��������
	//�ߺ����� üũ
	$sql="select * from on_edu_schedule where type='".$type."' and sdate='".$sdate."' and edate='".$edate."' and ttime='".$ttime."'";
	$res = mysql_query($sql);
	$row = mysql_fetch_object($res);
	
	if($row){
	?>
	<script language=javascript>
		alert('������ ������ ���������� �ֽ��ϴ�.\n�ٽ� Ȯ���� �ּ���.');
		history.back();
	</script>
	<?
		exit;
	}else if($sdate > $edate){
	?>
	<script language=javascript>
		alert('�������� �����Ϻ��� �������� �����ϴ�.\n�ٽ� Ȯ���� �ּ���.');
		history.back();
	</script>
	<?
		exit;
	}
	
	//����������Ʈ
	$query = "update on_edu_schedule set year='".$year."',";
	$query = $query." sdate='".$sdate."', ";
	$query = $query." edate='".$edate."', ";
	$query = $query." type='".$type."', ";
	$query = $query." ttime='".$ttime."', ";
	$query = $query." admin='".$admin."', ";
	$query = $query." comment='".$comment."'";
	$query = $query." where code='".$id."'";
	//echo $query;
	
}else if($mode == MD5(delete)){ //����
	$sql="select seq from on_edu_schedule where code='".$id."'";
	$res = mysql_query($sql);
	$row = mysql_fetch_object($res);
	
	//�������� ����
	$querys = "delete from on_edu_schedule where seq='".$row->seq."'and code='".$id."'";
	mysql_query($querys);
	
	//������������� ����
	$queryss = "delete from on_edu_member_sch where code='".$id."'";
	//echo $queryss;
	mysql_query($queryss);
	
	//����� �ڷ����� ����
	$query = "delete from on_edu_sch_data where code='".$id."'";
	//echo $query;
	
}else{ //�űԵ��
	//�ߺ����� üũ
	$sql="select * from on_edu_schedule where type='".$type."' and sdate='".$sdate."' and edate='".$edate."' and ttime='".$ttime."'";
	$res = mysql_query($sql);
	$row = mysql_fetch_object($res);
	
	if($row){
	?>
	<script language=javascript>
		alert('������ ������ ���������� �ֽ��ϴ�.\n�ٽ� Ȯ���� �ּ���.');
		history.back();
	</script>
	<?
		exit;
	}else if($sdate > $edate){
	?>
	<script language=javascript>
		alert('�������� �����Ϻ��� �������� �����ϴ�.\n�ٽ� Ȯ���� �ּ���.');
		history.back();
	</script>
	<?
		exit;
	}
	
	$now=mktime();
	$now=date(Y.'.'.m.'.'.d,$now);

	$ssql="SELECT * FROM on_edu_schedule";
	$sres=mysql_query($ssql);
	$stotal=mysql_affected_rows();
	echo $stotal;

	$key=MD5($type.$sdate."~".$edate.$ttime.$stotal);


	//key�� �ߺ����� üũ
	$sqlx="select * from on_edu_schedule where code='".$key."'";
	$resx = mysql_query($sqlx);
	$rowx = mysql_fetch_object($resx);

	if($rowx){
	?>
	<script language=javascript>
		alert('������ ������ key�� �ֽ��ϴ�.\n�ٽ� Ȯ���� �ּ���.');
		history.back();
	</script>
	<?
		exit;
	}

	$query = "insert into on_edu_schedule(code, year, sdate, edate, type, ttime, admin, comment, regdate) values(";
	$query = $query." '".$key."', ";
	$query = $query." '".$year."', ";
	$query = $query." '".$sdate."', ";
	$query = $query." '".$edate."', ";
	$query = $query." '".$type."', ";
	$query = $query." '".$ttime."', ";
	$query = $query." '".$admin."', ";
	$query = $query." '".$comment."', ";
	$query = $query." '".$now."') ";
	//echo $query;
}	

if(mysql_query($query)){
	echo"<script language=javascript>alert('���� ó���Ǿ����ϴ�');opener.location.href='./sche_list.php';window.close();</script>";
	exit;
}else{
	echo"<script language=javascript>alert('��û�Ͻ� ó���� �����Ͽ����ϴ�. �����ڿ��� ���ǹٶ��ϴ�.');opener.location.reload();window.close();</script>";
	exit;
}


include "../conf/dbconn_close.inc";

?>