<?
include "../dbconn.inc";

if($uid !=''){
$sql="select C.* from edu_calendar A, edu_rev B, edu_rev_member C  where A.uid like B.uid and A.uid like C.uid and A.uid = '".$uid."'";
$res=mysql_query($sql);
$total=mysql_affected_rows();
}

$sql2="select * from edu_calendar where uid = '".$uid."'";
$res2=mysql_query($sql2);
$row2 = mysql_fetch_object($res2);
$group_id = $row2->group_id;
$area_id = $row2->area_id;

$sql3="select * from edu_calendar_group where group_id = $group_id";
$res3=mysql_query($sql3);
$row3 = mysql_fetch_object($res3);

$sql4="select * from edu_calendar_area where area_id = $area_id";
$res4=mysql_query($sql4);
$row4 = mysql_fetch_object($res4);

$sql5="select * from edu_rev where uid=$uid";
$res5=mysql_query($sql5);
$row5=mysql_fetch_object($res5);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<link rel="stylesheet" href="../css/style.css" type="text/css">
<title>���༳��</title>
<style TYPE="text/css">
<!--
td {font-family:����; font-size:9pt; text-decoration:none}
table {font-family:����; font-size:10pt; text-decoration:none}
A:link { font-size:10pt; font-face:"����"; text-decoration:none;}
A:visited { font-size:10pt; font-face:"����"; text-decoration:none;}
A:hover  { font-size:10pt; text-decoration:underline;}
//-->
</style>
<script language="javascript">

function exdelDown(code){
	var str = confirm("������ ��Ȳ�� excel �ٿ�ε� �Ͻðڽ��ϱ�?");
	if (str)	document.location.href="./rev_excel.php?id="+code;
}

function delMember(c, k, n){
	var str = confirm("�����Ͻ� �����ڸ� ���� �Ͻðڽ��ϱ�?");
	if (str)	document.location.href="./rev_mem_delete.php?c="+c+"&k="+k+"&n="+n+"&m=<?=MD5(delete)?>";
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
<form name='form' method='post' action='./3.php'>
<input type='hidden' name='id' value='<?=$uid?>'>
<table width="600" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#E8E8E8" >
  <tr height='30'>
    <td height="30" colspan="4" align="center" bgcolor="#6699CC"><span class="style4">�� �������� </span></td>
  </tr>
  <tr height='30'>
    <td width='50' height="25" align="center" bgcolor="#6699CC"><span class="style1">������</span></td>
    <td width='150' height="25" align="center" bgcolor="#FFFFFF"><div align="left"><?=$row2->title?></div></td>
    <td width='50' align="center" bgcolor="#6699CC"><span class="style1">��������</span></td>
    <td width='150' align="center" bgcolor="#FFFFFF"><div align="center"><?=$row2->sdate?> ~ <?=$row2->edate?></div></td>
  </tr>
  <tr align='center' height='25'>
    <td height="25" align="center" bgcolor="#6699CC"><span class="style1">�����з�</a></span></td>
    <td align="center" bgcolor="#FFFFFF">
      <div align="left">
	  <?=$row3->group_name?>
      </div></td>
    <td align="center" bgcolor="#6699CC"><span class="style1">����</span></td>
    <td align="center" bgcolor="#FFFFFF"><?=$row4->area_name?></td>
  </tr>
</table>
<br />
<table width=600 border=0 align=center cellpadding=1 cellspacing=1 bgcolor="#E8E8E8" >
<tr height='30'>
	<td height="25" colspan="7" align=center bgcolor=#6699CC><span class="style1"><span class="style4">�� �����ڼ� (�� <?=$total?> / <?=$row5->max_user?>��) </span></td>
	</tr>
<tr height='30'>
  <td width='60' height="25" align=center bgcolor=#6699CC><span class="style1">�̸�</span></td>
  <td width='95' height="25" align=center bgcolor=#6699CC><span class="style1">�������</span></td>
  <td width="100" height="25" align=center bgcolor=#6699CC><span class="style1">����ó</span></td> 
  <td width="100" height="25" align=center bgcolor=#6699CC><span class="style1">�̸���</span></td>   
  <td width="100" height="25" align=center bgcolor=#6699CC><span class="style1">�����</span></td> 
  <td width="100" height="25" align=center bgcolor=#6699CC><span class="style1">�μ�</span></td> 
  <td width='47' height="25" align=center bgcolor=#6699CC><span class="style1">����</span></td>
</tr>

<?
if($total<1){
	echo"<tr align=center><td height='25' colspan='7' align=center bgcolor=#FFFFFF>��ϵ� �����ڰ� �����ϴ�.</td></tr>";
}
					
for($i=0; $i<$total; $i++){
	$row = mysql_fetch_object($res);			//�� ���� ��ü���÷� �����´�
?>
<tr align='center' height='25'>
	<td align=center bgcolor=#FFFFFF><?=$row->name?></td>
	<td align=center bgcolor=#FFFFFF><?=$row->birth?></td>
	<td align=center bgcolor=#FFFFFF><?=$row->tel?></td>
	<td align=center bgcolor=#FFFFFF><?=$row->email?></td>
	<td align=center bgcolor=#FFFFFF><?=$row->company?></td>
	<td align=center bgcolor=#FFFFFF><?=$row->part?></td>
    <td align=center bgcolor=#FFFFFF>
	<input type="button" name="memDel" value="����" onclick="javascript:delMember('<?=$uid?>','<?=$row->birth?>','<?=$row->name?>');" />
	</td>
</tr>
<?
}
?>
</table>
<br>
<table width="600" border="0" align="center">
  <tr>
   <td width='100%'><div align="left">
      <input name="button" type=button onclick="javascript:exdelDown('<?=$uid?>');" value='excel' />
    </div>
    </td>
    <td width='100%'><div align="right">
      <input name="button" type=button onclick="javascript:window.close();" value='close' />
    </div>
    </td>
  </tr>
</table>

</form>
</body>
</html>
<script>

<?
include "../conf/dbconn_close.inc";
?>
