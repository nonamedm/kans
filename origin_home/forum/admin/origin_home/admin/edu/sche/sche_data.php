<?
include "../conf/connchk.inc";
include "../conf/dbconn.inc";

$sql="select C.datacode, C.title, C.comm, C.url from on_edu_schedule A, on_edu_sch_data B, on_edu_data C where A.code = '".$id."' and B.code = '".$id."'  and B.datacode = C.datacode";
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
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style4 {color: #FFFFFF; font-weight: bold; }
-->
</style>
</head>

<body>
<form name='form' method='post' action='./sche_add_data_cmd.php'>
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
	<td height="25" colspan="3" align=center bgcolor=#6699CC><span class="style1"><span class="style4">�� ��ϵ� �ڷ� ��� (�� <?=$total?>��) </span></td>
	</tr>
<tr height='30'>
  <td width="235" height="25" align=center bgcolor=#6699CC><span class="style1">����</span></td>
  <td width='60' height="25" align=center bgcolor=#6699CC><span class="style1">����</span></td>
  <td height="25" align=center bgcolor=#6699CC><span class="style1">���ϸ�</span></td>
  </tr>

<?
if($total<1){
	echo"<tr align=center><td height='25' colspan='5' align=center bgcolor=#FFFFFF>��ϵ� �����ڷᰡ �����ϴ�.</td></tr>";
}
					
for($i=0; $i<$total; $i++){
	$row = mysql_fetch_object($res);			//�� ���� ��ü���÷� �����´�
?>
<tr align='center' height='25'>
	<td align=center bgcolor=#FFFFFF><?=$row->title?></td>
	<td align=center bgcolor=#FFFFFF><?=$row->comm?></td>
	<td align=center bgcolor=#FFFFFF><?=$row->url?></td>
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