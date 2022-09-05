<?
include "../conf/connchk.inc";
include "../conf/dbconn.inc";

$key=trim($id);
$name=trim($name);
$company=trim($company);
$jumin1=trim($jumin1);
$jumin2=trim($jumin2);
	
if($mode == MD5(update)){ //정보수정
	
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
	
}else if($mode == MD5(delete)){ //삭제
	$sql="select seq from on_edu_member where idkey='".$id."'";
	$res = mysql_query($sql);
	$row = mysql_fetch_object($res);
	//종사자정보 삭제
	$query = "delete from on_edu_member where seq='".$row->seq."'and idkey='".$id."'";
	//교육신청정보 삭제
	$query1 = "delete from on_edu_member_sch where idkey='".$id."'";
	mysql_query($query1);
	//교육기록 삭제
	$query2 = "delete from on_edu_member_rec where idkey='".$id."'";
	mysql_query($query2);
	//echo $query;
	
}else{ //신규등록
	$sql="select jumin1, jumin2 from on_edu_member where jumin1='".$jumin1."' and jumin2='".$jumin2."'";
	$res = mysql_query($sql);
	$row = mysql_fetch_object($res);

	if($row){
	?>
	<script language=javascript>
		alert('이미 등록된 대상자입니다.\n 확인해 주세요.');
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
	echo"<script language=javascript>alert('정상 처리되었습니다');opener.location.href='./member_list.php';window.close();</script>";
	exit;
}else{
	echo"<script language=javascript>alert('요청하신 처리에 실패하였습니다. 관리자에게 문의바랍니다.');opener.location.reload();window.close();</script>";
	exit;
}


include "../conf/dbconn_close.inc";

?>