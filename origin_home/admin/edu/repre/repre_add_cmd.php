<?
include "../conf/connchk.inc";
include "../conf/dbconn.inc";

$id=trim($id);
$id=str_replace("@amp;", "&" ,$id);

$pw=trim($pw);
$name=trim($name);
$company=trim($company);
	
if($mode == MD5(update)){ //정보수정
	
	$query = "update on_edu_repre set pw='".$pw."',";
	$query = $query." name='".$name."', ";
	$query = $query." company='".$company."', ";
	$query = $query." item='".$item."', ";
	$query = $query." condition='".$condition."', ";
	$query = $query." addr='".$addr."', ";
	$query = $query." part='".$part."', ";
	$query = $query." email='".$email."', ";
	$query = $query." tel='".$tel."'";
	$query = $query." where id='".$id."'";
	
}else if($mode == MD5(delete)){ //삭제
	$sql="select seq, com_id from on_edu_repre where id='".$id."'";
	$res = mysql_query($sql);
	$row = mysql_fetch_object($res);
	
	// 관련 회원삭제
	$querys = "delete from on_edu_member where com_id='".$com_id."' ";
	echo $querys;
	
	$query = "delete from on_edu_repre where seq='".$row->seq."'and id='".$id."' ";
	//echo $query;
	
}else{ //신규등록
	$sql="select id from on_edu_repre where id='".$id."'";
	$res = mysql_query($sql);
	$row = mysql_fetch_object($res);
	if($row){
	?>
	<script language=javascript>
		alert('이미 등록된 아이디입니다.\n 확인해 주세요.');
		history.back();
	</script>
	<?
		exit;
	}
	
	$now=mktime();
	$now=date(Y.'.'.m.'.'.d,$now);
	
	$query = "insert into on_edu_repre(id, com_id, pw, name, company, item, condition, addr, part, email, tel, regdate) values(";
	$query = $query." '".$id."', ";
	$query = $query." '".MD5($id)."', ";
	$query = $query." '".$pw."', ";
	$query = $query." '".$name."', ";
	$query = $query." '".$company."', ";
	$query = $query." '".$item."', ";
	$query = $query." '".$condition."', ";
	$query = $query." '".$addr."', ";
	$query = $query." '".$part."', ";
	$query = $query." '".$email."', ";
	$query = $query." '".$tel."', ";
	$query = $query." '".$now."') ";
}	

if(mysql_query($query)){
	echo"<script language=javascript>alert('정상 처리되었습니다');opener.location.href='./repre_list.php';window.close();</script>";
	exit;
}else{
	echo"<script language=javascript>alert('요청하신 처리에 실패하였습니다. 관리자에게 문의바랍니다.');opener.location.reload();window.close();</script>";
	exit;
}

include "../conf/dbconn_close.inc";

?>