<? 
ob_start();

include  "./dbconn.inc"; 

$userid=trim($id);
$passwd=trim($pwd);


if($userid != "kans" || $passwd != "?5547330?"){
?>
<script language=javascript>
	alert('아이디/비밀번호가 정확하지 않습니다.\n다시 로그인하시기 바랍니다!');
	history.back();
</script>
<?
	exit;
}

setcookie("cid", $userid, time()+3000,"/");  
?>

<script language=javascript>document.location.href='./frame.php';</script>
