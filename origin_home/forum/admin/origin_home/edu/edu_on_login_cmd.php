<? 
if(!$sec){

ob_start();

include  "../admin/dbconn.inc"; 

$sec_code=trim($sec_code);

$sql="select * from sec_board where sec_code='".$sec_code."'";
$res = mysql_query($sql);
$row = mysql_fetch_object($res);

if($sec_code != $row->sec_code){
?>
<script language=javascript>
	alert('비밀번호가 정확하지 않습니다.\n확인하시고 다시 입력하시기 바랍니다!');
	parent.code_login.sec_code.value='';
	parent.code_login.sec_code.select();
</script>
<?
	exit;
}else{

	setcookie("sec", $row->sec, time()+1500,"/");
}

?>
<script language=javascript>
	alert('환영합니다~ 해당 페이지로 이동합니다!');
	parent.location.href="./edu_on_list.html";
</script>
<?
}else{?>
<script language=javascript>
	alert('이미 로그인 하셨습니다.');
	history.back();
</script>
<? 
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />