<?
include "../conf/connchk.inc";
include "../conf/dbconn.inc";

$sql="select A.idkey, A.name, A.jumin1, A.jumin2, A.com_id, B.state, C.company from on_edu_member A, on_edu_member_sch B, on_edu_repre C  where A.idkey like B.idkey and A.com_id like C.com_id and B.code = '".$id."'";
$res=mysql_query($sql);
$total=mysql_affected_rows();

if ($id!=''){
	$sql="SELECT * FROM on_edu_schedule where code = '".$id."'";
	$ress=mysql_query($sql);
	$rows = mysql_fetch_object($ress);
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<link rel="stylesheet" href="../css/style.css" type="text/css">
<title>:::: Secure ::::</title>
<script language="javascript">
function check(){
	var form=document.form;
	if(form.company.value=='' || form.name.value=='' || form.jumin.value==''){
		alert('������ã�⸦ ���� ������ ������ �Է����ּ���.');
		searchMember();
		return;
	}

	var str = confirm("�ش� �����ڸ� ���� �Ͻðڽ��ϱ�?");
	if (str)	form.submit()
}

function delMember(code, id){
	var str = confirm("�����Ͻ� �����ڸ� ���� �Ͻðڽ��ϱ�?");
	if (str)	document.location.href="./sche_add_member_cmd.php?id="+code+"&k="+id+"&mode=<?=MD5(delete)?>";
}

function searchMember(){
	var theURL='./sche_memberSch.php';
	var features='left=280,top=250,width=510,height=280,toolbars=no,menubar=no,scrollbars=yes,status=no,resizable=no';
	window.open(theURL,"",features);
}
</script>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style4 {color: #FFFFFF; font-weight: bold; }
-->
</style>
</head>

<body>
<form name='form' method='post' action='./sche_add_member_cmd.php'>
<input type='hidden' name='id' value='<?=$id?>'>
<input type='hidden' name='k' value='<?=$k?>'>
<table width="450" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#E8E8E8" >
  <tr height='30'>
    <td height="30" colspan="4" align="center" bgcolor="#6699CC"><span class="style4">�� �������� </span></td>
  </tr>
  <tr height='30'>
    <td width='95' height="25" align="center" bgcolor="#6699CC"><span class="style1">��������</span></td>
    <td width='213' height="25" align="center" bgcolor="#FFFFFF"><div align="left"><?=$rows->sdate?> ~ <?=$rows->edate?></div></td>
    <td width='55' align="center" bgcolor="#6699CC"><span class="style1">�����⵵</span></td>
    <td width='74' align="center" bgcolor="#FFFFFF"><div align="center"><?=$rows->year?>��</div></td>
  </tr>
  <tr align='center' height='25'>
    <td height="25" align="center" bgcolor="#6699CC"><span class="style1">��������</a></span></td>
    <td align="center" bgcolor="#FFFFFF">
      <div align="left">
        <?=$rows->type?>
      </div></td>
    <td align="center" bgcolor="#6699CC"><span class="style1">�����ð�</span></td>
    <td align="center" bgcolor="#FFFFFF"><?=$rows->ttime?>
      �ð�</td>
  </tr>
</table>
<br />
<table width=450 border=0 align=center cellpadding=1 cellspacing=1 bgcolor="#E8E8E8" >
<tr height='30'>
	<td height="25" colspan="4" align=center bgcolor=#6699CC><span class="style1"><span class="style4">�� �ű� ������ ���� </span></td>
	</tr>
<tr height='30'>
  <td height="30" colspan="4" align=center bgcolor=#FFFFFF><input type="text" size='20' name='company' maxlength='100' readonly="readonly" />&nbsp;<input type="text" size='10' name='name' maxlength='100' readonly="readonly"/>&nbsp;<input type="text" size='14' name='jumin' maxlength='15' readonly="readonly"/>&nbsp;<input type="button" name="memFind" value="������ã��" onclick="searchMember();" /><input type="button" name="memAdd" value=" ���� " onclick="check();" /></td>
</tr>
</table><br />
<table width=450 border=0 align=center cellpadding=1 cellspacing=1 bgcolor="#E8E8E8" >
<tr height='30'>
	<td height="25" colspan="4" align=center bgcolor=#6699CC><span class="style1"><span class="style4">�� ������ ������ ��� (�� <?=$total?>��) </span></td>
	</tr>
<tr height='30'>
  <td width="235" height="25" align=center bgcolor=#6699CC><span class="style1">�Ҽӱ����</span></td>
  <td width='60' height="25" align=center bgcolor=#6699CC><span class="style1">�̸�</span></td>
  <td width='95' height="25" align=center bgcolor=#6699CC><span class="style1">�ֹε�Ϲ�ȣ</span></td>
  <td width='47' height="25" align=center bgcolor=#6699CC><span class="style1">����</span></td>
</tr>

<?
if($total<1){
	echo"<tr align=center><td height='25' colspan='5' align=center bgcolor=#FFFFFF>��ϵ� �����ڰ� �����ϴ�.</td></tr>";
}
					
for($i=0; $i<$total; $i++){
	$row = mysql_fetch_object($res);			//�� ���� ��ü���÷� �����´�
?>
<tr align='center' height='25'>
	<td align=center bgcolor=#FFFFFF><?=$row->company?></td>
	<td align=center bgcolor=#FFFFFF><?=$row->name?></td>
	<td align=center bgcolor=#FFFFFF><?=$row->jumin1?>-<?=$row->jumin2?></td>
    <td align=center bgcolor=#FFFFFF>
	<? if ($row->state=="ready"){ ?>
	<input type="button" name="memDel" value="����" onclick="delMember('<?=$id?>','<?=$row->idkey?>');" />
	<? }else if ($row->state=="complete"){ ?>
	�Ϸ�
	<? }else{ ?>
	�Ұ�
	<? } ?>
	</td>
</tr>
<?
}
?>
</table>
<br>
<table width="480" border="0" align="center">
  <tr>
    <td width='100%'><div align="right">
      <input name="button" type=button onclick="javascript:window.close();" value='close' />
    </div></td>
  </tr>
</table>

</form>
</body>
</html>
<script>

<?
include "../conf/dbconn_close.inc";
?>