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
	alert('��й�ȣ�� ��Ȯ���� �ʽ��ϴ�.\nȮ���Ͻð� �ٽ� �Է��Ͻñ� �ٶ��ϴ�!');
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
	alert('ȯ���մϴ�~ �ش� �������� �̵��մϴ�!');
	parent.location.href="./edu_on_list.html";
</script>
<?
}else{?>
<script language=javascript>
	alert('�̹� �α��� �ϼ̽��ϴ�.');
	history.back();
</script>
<? 
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />