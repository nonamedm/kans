<?
include "../conf/connchk.inc";
include "../conf/dbconn.inc";


$id=trim($id);
$key=trim($k);
$now=mktime();
$now=date(Y.'.'.m.'.'.d,$now);
		
if($mode == MD5(delete)){ //����
	//�������°� ready �϶��� ������ �����ϴ�.
	$sql="select seq, state from on_edu_member_sch where idkey='".$key."' and code='".$id."'";
	$res = mysql_query($sql);
	$row = mysql_fetch_object($res);
	
	if($row->state!="ready"){
	?>
	<script language=javascript>
		alert('������ �Ϸ�� ���¿����� �����ڸ� ���� �Ͻ� �� �����ϴ�.');
		history.back();
	</script>
	<?
		exit;
	}
	
	$query = "delete from on_edu_member_sch where seq='".$row->seq."'and idkey='".$key."' and code='".$id."' and state='ready'";
	//echo $query;
	
	$mode = MD5(member);
	$file = "sche_add_member.php";
	
}else if($mode == MD5(complete)){ //�������� Ȯ��
	//�������¸� Ȯ���Ͽ� �������̸� ���Ḧ Ȯ�� �� �� ������ �Ѵ�.
	$sqlp="select state from on_edu_member_sch where idkey='".$key."' and code='".$id."'";
	$resp = mysql_query($sqlp);
	$rowp = mysql_fetch_object($resp);

	if($rowp->state == "ready"){
	?>
	<script language=javascript>
		alert('������ ���¿����� �Ϸ� �Ͻ� �� �����ϴ�.');
		history.back();
	</script>
	<?
		exit;
	}
	
	//�������� �ҷ�����
	$sql="select A.year, A.state, B.type, B.edate from on_edu_member_sch A, on_edu_schedule B where A.code like B.code and A.code='".$id."' and idkey='".$key."'";
	$res = mysql_query($sql);
	$row = mysql_fetch_object($res);
	
	//���ſ� ���ϳ⵵�� ������ ��ʰ� �ִ��� üũ�Ͽ� �����߻�
	$sqlr="select * from on_edu_member_rec where idkey='".$key."' and year='".$row->year."'";
	$resr = mysql_query($sqlr);
	$rowr = mysql_fetch_object($resr);
	
	if($rowr){
	?>
	<script language=javascript>
		alert('���ϳ⵵�� ������ ������ �ֽ��ϴ�.');
		history.back();
	</script>
	<?
		exit;
	}
	
	//�ڵ���� (�ش�⵵ ��ü ���� üũ�ؼ� ��ȣ����)
	$sqlc="select year from on_edu_member_rec where year='".$row->year."'";
	$resc = mysql_query($sqlc);
	$total=mysql_affected_rows();
	
	//�ڵ����� (��������϶��� ����)
	if($rowp->state == "good"){
		$ccode = substr($row->year,2)."-E".sprintf("%05d" ,$total+1);
	}else{
		$ccode = "�̼���";
	}
	
	//echo($row->state);
	//echo($ccode);
	
	$querys = "insert into on_edu_member_rec(idkey, year, date, state, type, ccode, regdate) values(";
	$querys = $querys." '".$key."', ";
	$querys = $querys." '".$row->year."', ";
	$querys = $querys." '".$row->edate."', ";
	$querys = $querys." '".$row->state."', ";
	$querys = $querys." '".$row->type."', ";
	$querys = $querys." '".$ccode."', ";
	$querys = $querys." '".$now."') ";
	
	//echo($querys);
	
	$state = "complete";
	$query = "update on_edu_member_sch set state='".$state."'";
	$query = $query." where idkey='".$key."' and code='".$id."'";
	
	//echo($query);
	
	//exit;
	
	mysql_query($querys);
	
	//echo $query;
	$file = "sche_member_comp.php";
	
}else if($mode == MD5(change)){ //���º���
	//�Ϲݺ���
	$state = trim($state);
	$query = "update on_edu_member_sch set state='".$state."'";
	$query = $query." where idkey='".$key."' and code='".$id."'";
	
	//echo $query;
	$mode = MD5(complete);
	$file = "sche_member_comp.php";
	
}else{ //�űԵ��
	//���� ����߿� �ֱٳ⿡ ����� �⵵�� ã�� 
	$sqlo="select year from on_edu_member_rec where idkey='".$key."' order by year desc";
	$reso = mysql_query($sqlo);
	$rowo = mysql_fetch_object($reso);
	
	if($rowo){
		//���� �����⵵�� ���Ͽ� ���ų� Ŭ��� ��� �� �������� ó��
		$sql="select code, year from on_edu_schedule where code='".$id."' and year like ".$rowo->year."";
		$res = mysql_query($sql);
		$row = mysql_fetch_object($res);
	
		if($row){
		?>
		<script language=javascript>
			alert('�ش� �⵵�� ������ �����Ͽ����ϴ�. \n�ٽ� Ȯ���� �ּ���.');
			history.back();
		</script>
		<?
			exit;
		}
	}
	//���� �������� ���������� �ش������ڸ� ã��
	$sqln="select year from on_edu_schedule where code='".$id."' order by year desc";
	$resn = mysql_query($sqln);
	$rown = mysql_fetch_object($resn);
	
	if($rown){
		//���� �����⵵�� ���Ͽ� ������ ��� �� �������� ó��
		$sqla="select idkey, year from on_edu_member_sch where idkey='".$key."' and year like ".$rown->year."";
		$resa = mysql_query($sqla);
		$rowa = mysql_fetch_object($resa);
	
		if($rowa){
		?>
		<script language=javascript>
			alert('�ش� �⵵�� ������ �̹� ��ϵǾ��ֽ��ϴ�. \n�ٽ� Ȯ���� �ּ���.');
			history.back();
		</script>
		<?
			exit;
		}
	}
	
	//�ش� ���� ���� �ҷ�����
	$sqls="select year from on_edu_schedule where code='".$id."'";
	$ress = mysql_query($sqls);
	$rows = mysql_fetch_object($ress);
	
	$state = "ready";
	
	$query = "insert into on_edu_member_sch(idkey, code, state, year, regdate) values(";
	$query = $query." '".$key."', ";
	$query = $query." '".$id."', ";
	$query = $query." '".$state."', ";
	$query = $query." '".$rows->year."', ";
	$query = $query." '".$now."') ";
	//echo $query;
	
	$mode = MD5(member);
	$file = "sche_add_member.php";
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