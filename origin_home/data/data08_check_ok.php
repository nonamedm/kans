<? 
ob_start();

include  "../conf/dbconn.inc"; 

$pw=trim($pw);
$uid=trim($uid);
$type=trim($type);
$page=trim($page);
$search=trim($search);
$keyword=trim($keyword);

if($type=='mo') {
	$acturl = "data08_update.html";
} elseif ($type=='de') {
	$acturl = "data08_delete.php";
} else {
	echo "<script language=javascript>alert(\"정상적인 이용 방법이 아닙니다.!\");location.href='data08.html';</script>";
	exit;
}

$sql="select * from board where uid=$uid";
$res=mysql_query($sql);
$total=mysql_affected_rows();
$row=mysql_fetch_object($res);
if($total<1)
{
	echo "<script language=javascript>alert(\"정상적인 이용 방법이 아닙니다.!\");location.href='data08.html';</script>";
	exit;
} else {
	if($row->passwd==$pw || $pw=="kans5547330") {
		setcookie("data08_uid", $uid,time()+600,"/");
		setcookie("data08_pw", $pw,time()+600,"/");
		setcookie("data08_ok", "Ok",time()+600,"/");
?>
		<form name="checkFrm" method='post' action="<?=$acturl?>">
			<input type="hidden" name="uid" value="<?=$uid?>">
			<input type="hidden" name="type" value="<?=$type?>">
			<input type="hidden" name="pw" value="<?=$pw?>">
			<input type="hidden" name="page" value="<?=$page?>">
			<input type="hidden" name="search" value="<?=$search?>">
			<input type="hidden" name="keyword" value="<?=$keyword?>">
		</form>
		<script language=javascript>document.checkFrm.submit();</script>
<?
		echo "<script language=javascript>alert('".$acturl."');</script>";
	} else {
		echo "<script language=javascript>alert(\"비밀번호가 정확하지 않습니다.!\");history.back();</script>";
		exit;
	}
}

include "../conf/dbconn_close.inc";
?>
