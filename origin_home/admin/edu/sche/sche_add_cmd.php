<?
include "../conf/connchk.inc";
include "../conf/dbconn.inc";

$id=trim($id);
$type=trim($type);
$sdate=trim($sdate);
$edate=trim($edate);
$year = substr($sdate,0,4);
	
if($mode == MD5(update)){ //정보수정
	//중복정보 체크
	$sql="select * from on_edu_schedule where type='".$type."' and sdate='".$sdate."' and edate='".$edate."' and ttime='".$ttime."'";
	$res = mysql_query($sql);
	$row = mysql_fetch_object($res);
	
	if($row){
	?>
	<script language=javascript>
		alert('동일한 정보의 교육일정이 있습니다.\n다시 확인해 주세요.');
		history.back();
	</script>
	<?
		exit;
	}else if($sdate > $edate){
	?>
	<script language=javascript>
		alert('시작일이 종료일보다 늦을수는 없습니다.\n다시 확인해 주세요.');
		history.back();
	</script>
	<?
		exit;
	}
	
	//정보업데이트
	$query = "update on_edu_schedule set year='".$year."',";
	$query = $query." sdate='".$sdate."', ";
	$query = $query." edate='".$edate."', ";
	$query = $query." type='".$type."', ";
	$query = $query." ttime='".$ttime."', ";
	$query = $query." admin='".$admin."', ";
	$query = $query." comment='".$comment."'";
	$query = $query." where code='".$id."'";
	//echo $query;
	
}else if($mode == MD5(delete)){ //삭제
	$sql="select seq from on_edu_schedule where code='".$id."'";
	$res = mysql_query($sql);
	$row = mysql_fetch_object($res);
	
	//교육정보 삭제
	$querys = "delete from on_edu_schedule where seq='".$row->seq."'and code='".$id."'";
	mysql_query($querys);
	
	//교육대상자정보 삭제
	$queryss = "delete from on_edu_member_sch where code='".$id."'";
	//echo $queryss;
	mysql_query($queryss);
	
	//연결된 자료정보 삭제
	$query = "delete from on_edu_sch_data where code='".$id."'";
	//echo $query;
	
}else{ //신규등록
	//중복정보 체크
	$sql="select * from on_edu_schedule where type='".$type."' and sdate='".$sdate."' and edate='".$edate."' and ttime='".$ttime."'";
	$res = mysql_query($sql);
	$row = mysql_fetch_object($res);
	
	if($row){
	?>
	<script language=javascript>
		alert('동일한 정보의 교육일정이 있습니다.\n다시 확인해 주세요.');
		history.back();
	</script>
	<?
		exit;
	}else if($sdate > $edate){
	?>
	<script language=javascript>
		alert('시작일이 종료일보다 늦을수는 없습니다.\n다시 확인해 주세요.');
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


	//key로 중복정보 체크
	$sqlx="select * from on_edu_schedule where code='".$key."'";
	$resx = mysql_query($sqlx);
	$rowx = mysql_fetch_object($resx);

	if($rowx){
	?>
	<script language=javascript>
		alert('동일한 정보의 key가 있습니다.\n다시 확인해 주세요.');
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
	echo"<script language=javascript>alert('정상 처리되었습니다');opener.location.href='./sche_list.php';window.close();</script>";
	exit;
}else{
	echo"<script language=javascript>alert('요청하신 처리에 실패하였습니다. 관리자에게 문의바랍니다.');opener.location.reload();window.close();</script>";
	exit;
}


include "../conf/dbconn_close.inc";

?>