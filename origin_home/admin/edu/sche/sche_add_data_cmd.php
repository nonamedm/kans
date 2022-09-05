<?
include "../conf/connchk.inc";
include "../conf/dbconn.inc";

$id=trim($id);
$key=trim($k);
$now=mktime();
$now=date(Y.'.'.m.'.'.d,$now);
		
if($mode == MD5(delete)){ //삭제
	//교육상태가 ready 일때만 삭제가 가능하다.
	$sql="select seq from on_edu_sch_data where code='".$id."' and datacode='".$key."'";
	$res = mysql_query($sql);
	$row = mysql_fetch_object($res);
	
	$query = "delete from on_edu_sch_data where seq='".$row->seq."' and datacode='".$key."' and code='".$id."'";
	//echo $query;
	
	$mode = MD5(data);
	$file = "sche_add_data.php";
	
/*	
}else if($mode == MD5(change)){ //공개여부 - 미구현
	//일반변경
	$state = trim($state);
	$query = "update on_edu_member_sch set state='".$state."'";
	$query = $query." where idkey='".$key."' and code='".$id."'";
	
	//echo $query;
	$mode = MD5(complete);
	$file = "sche_member_comp.php";
*/
	
}else{ //신규등록
	//해당 교육 정보 불러내기
	$sqls="select code, datacode from on_edu_sch_data where code='".$id."' and datacode='".$key."'";
	$ress = mysql_query($sqls);
	$rows = mysql_fetch_object($ress);
	
	if($rows){
	?>
	<script language=javascript>
		alert('이미 등록된 자료입니다.\n 확인해 주세요.');
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
	echo"<script language=javascript>alert('정상 처리되었습니다');opener.location.reload();location.href='./".$file."?id=".$id."&mode=".$mode."';</script>";
	exit;
}else{
	echo"<script language=javascript>alert('요청하신 처리에 실패하였습니다. 관리자에게 문의바랍니다.');opener.location.reload();history.back();</script>";
	exit;
}


include "../conf/dbconn_close.inc";

?>