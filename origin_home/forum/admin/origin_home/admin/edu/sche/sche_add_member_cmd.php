<?
include "../conf/connchk.inc";
include "../conf/dbconn.inc";


$id=trim($id);
$key=trim($k);
$now=mktime();
$now=date(Y.'.'.m.'.'.d,$now);
		
if($mode == MD5(delete)){ //삭제
	//교육상태가 ready 일때만 삭제가 가능하다.
	$sql="select seq, state from on_edu_member_sch where idkey='".$key."' and code='".$id."'";
	$res = mysql_query($sql);
	$row = mysql_fetch_object($res);
	
	if($row->state!="ready"){
	?>
	<script language=javascript>
		alert('교육이 완료된 상태에서는 종사자를 삭제 하실 수 없습니다.');
		history.back();
	</script>
	<?
		exit;
	}
	
	$query = "delete from on_edu_member_sch where seq='".$row->seq."'and idkey='".$key."' and code='".$id."' and state='ready'";
	//echo $query;
	
	$mode = MD5(member);
	$file = "sche_add_member.php";
	
}else if($mode == MD5(complete)){ //교육수료 확정
	//교육상태를 확인하여 교육중이면 수료를 확정 할 수 없도록 한다.
	$sqlp="select state from on_edu_member_sch where idkey='".$key."' and code='".$id."'";
	$resp = mysql_query($sqlp);
	$rowp = mysql_fetch_object($resp);

	if($rowp->state == "ready"){
	?>
	<script language=javascript>
		alert('교육중 상태에서는 완료 하실 수 없습니다.');
		history.back();
	</script>
	<?
		exit;
	}
	
	//교육정보 불러오기
	$sql="select A.year, A.state, B.type, B.edate from on_edu_member_sch A, on_edu_schedule B where A.code like B.code and A.code='".$id."' and idkey='".$key."'";
	$res = mysql_query($sql);
	$row = mysql_fetch_object($res);
	
	//과거에 동일년도에 수료한 사례가 있는지 체크하여 오류발생
	$sqlr="select * from on_edu_member_rec where idkey='".$key."' and year='".$row->year."'";
	$resr = mysql_query($sqlr);
	$rowr = mysql_fetch_object($resr);
	
	if($rowr){
	?>
	<script language=javascript>
		alert('동일년도에 수료한 정보가 있습니다.');
		history.back();
	</script>
	<?
		exit;
	}
	
	//코드생성 (해당년도 전체 수를 체크해서 번호생성)
	$sqlc="select year from on_edu_member_rec where year='".$row->year."'";
	$resc = mysql_query($sqlc);
	$total=mysql_affected_rows();
	
	//코드조합 (수료상태일때만 생성)
	if($rowp->state == "good"){
		$ccode = substr($row->year,2)."-E".sprintf("%05d" ,$total+1);
	}else{
		$ccode = "미수료";
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
	
}else if($mode == MD5(change)){ //상태변경
	//일반변경
	$state = trim($state);
	$query = "update on_edu_member_sch set state='".$state."'";
	$query = $query." where idkey='".$key."' and code='".$id."'";
	
	//echo $query;
	$mode = MD5(complete);
	$file = "sche_member_comp.php";
	
}else{ //신규등록
	//과거 기록중에 최근년에 수료된 년도를 찾아 
	$sqlo="select year from on_edu_member_rec where idkey='".$key."' order by year desc";
	$reso = mysql_query($sqlo);
	$rowo = mysql_fetch_object($reso);
	
	if($rowo){
		//현재 교육년도와 비교하여 같거나 클경우 등록 할 수없도록 처리
		$sql="select code, year from on_edu_schedule where code='".$id."' and year like ".$rowo->year."";
		$res = mysql_query($sql);
		$row = mysql_fetch_object($res);
	
		if($row){
		?>
		<script language=javascript>
			alert('해당 년도의 교육을 수료하였습니다. \n다시 확인해 주세요.');
			history.back();
		</script>
		<?
			exit;
		}
	}
	//현재 접수중인 교육과정중 해당종사자를 찾아
	$sqln="select year from on_edu_schedule where code='".$id."' order by year desc";
	$resn = mysql_query($sqln);
	$rown = mysql_fetch_object($resn);
	
	if($rown){
		//현재 교육년도와 비교하여 같으면 등록 할 수없도록 처리
		$sqla="select idkey, year from on_edu_member_sch where idkey='".$key."' and year like ".$rown->year."";
		$resa = mysql_query($sqla);
		$rowa = mysql_fetch_object($resa);
	
		if($rowa){
		?>
		<script language=javascript>
			alert('해당 년도의 교육에 이미 등록되어있습니다. \n다시 확인해 주세요.');
			history.back();
		</script>
		<?
			exit;
		}
	}
	
	//해당 교육 정보 불러내기
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
	echo"<script language=javascript>alert('정상 처리되었습니다');opener.location.reload();location.href='./".$file."?id=".$id."&mode=".$mode."';</script>";
	exit;
}else{
	echo"<script language=javascript>alert('요청하신 처리에 실패하였습니다. 관리자에게 문의바랍니다.');opener.location.reload();history.back();</script>";
	exit;
}


include "../conf/dbconn_close.inc";

?>