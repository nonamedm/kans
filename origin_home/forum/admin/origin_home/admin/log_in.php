<? 
ob_start();

include  "./dbconn.inc"; 

$userid=trim($id);
$passwd=trim($pwd);


if($userid != "kans" || $passwd != "?5547330?"){
?>
<script language=javascript>
	alert('���̵�/��й�ȣ�� ��Ȯ���� �ʽ��ϴ�.\n�ٽ� �α����Ͻñ� �ٶ��ϴ�!');
	history.back();
</script>
<?
	exit;
}

setcookie("cid", $userid, time()+3000,"/");  
?>

<script language=javascript>document.location.href='./frame.php';</script>
