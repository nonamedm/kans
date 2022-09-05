<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<? 
if(!$cid){
	echo"<meta http-equiv=\"Refresh\" content=\"0 ; URL='../index.php'\">";
	exit;
}
include  "../dbconn.inc"; 


///////////////////////////////// 등록        ///////////////


$sec_code=trim($sec_code);
$sec_memo=trim($sec_memo);

$now=mktime();
$now=date(Y.'.'.m.'.'.d,$now);

$sql = "select sec_code from sec_code where sec_code = '".$sec_code."'"; 
$res = mysql_query($sql);
$row = mysql_fetch_object($res);

if($row){
?>
<script language=javascript>
	alert('이미 등록된 동일한 보안코드가 있습니다.\n\n다시 확인해 주세요.');
	history.back();
</script>
<?
	exit;
}

	$query2 = "insert into sec_code(sec_code, sec_memo, regdate) values(";
	$query2 = $query2." '".$sec_code."', ";
	$query2 = $query2." '".$sec_memo."', ";
	$query2 = $query2." '".$now."') ";
		
if(mysql_query($query2)){
	echo"<script language=javascript>alert('등록되었습니다');opener.location.href='./list.php';window.close();</script>";
	exit;
}else{
	echo"<script language=javascript>alert('등록에 실패했습니다. 관리자에게 문의바랍니다.');opener.location.reload();window.close();</script>";
	exit;
}
?>