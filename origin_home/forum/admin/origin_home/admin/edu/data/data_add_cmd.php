<?
include "../conf/connchk.inc";
include "../conf/dbconn.inc";

$id=trim($id);
$pw=trim($pw);
$title=trim($title);
$url=trim($url);
	
if($mode == MD5(update)){ //정보수정
	
	$query = "update on_edu_data set title='".$title."',";
	$query = $query." type='".$type."', ";
	$query = $query." comm='".$comm."', ";
	$query = $query." url='".$url."', ";
	$query = $query." filename='".MD5($url)."', ";
	$query = $query." etc='".$etc."'";
	$query = $query." where datacode='".$id."'";
	
}else if($mode == MD5(delete)){ //삭제
	$sql="select seq from on_edu_data where datacode='".$id."'";
	$res = mysql_query($sql);
	$row = mysql_fetch_object($res);
	
	$query = "delete from on_edu_data where seq='".$row->seq."'and datacode='".$id."' ";
	//echo $query;
	
}else{ //신규등록
	$id= MD5($url.$type.$comm.$url);
	
	$sql="select datacode from on_edu_data where datacode='".$id."'";
	$res = mysql_query($sql);
	$row = mysql_fetch_object($res);
	if($row){
	?>
	<script language=javascript>
		alert('이미 등록된 자료입니다.\n 확인해 주세요.');
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
	echo"<script language=javascript>alert('정상 처리되었습니다');opener.location.href='./data_list.php';window.close();</script>";
	exit;
}else{
	echo"<script language=javascript>alert('요청하신 처리에 실패하였습니다. 관리자에게 문의바랍니다.');opener.location.reload();window.close();</script>";
	exit;
}

include "../conf/dbconn_close.inc";

?>