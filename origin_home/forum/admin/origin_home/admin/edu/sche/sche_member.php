<?
include "../conf/connchk.inc";
include "../conf/dbconn.inc";

//$sql="SELECT * FROM on_edu_member_sch where code = '".$id."' ";
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

<style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style4 {color: #FFFFFF; font-weight: bold; }
-->
</style>
</head>

<body>
<form name='form' method='post' action='./sche_add_member.php'>
<input type='hidden' name='id' value='<?=$id?>'>
<table width="450" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#E8E8E8" >
  <tr height='30'>
    <td height="30" colspan="4" align="center" bgcolor="#6699CC"><span class="style4">?? ???????? </span></td>
  </tr>
  <tr height='30'>
    <td width='95' height="25" align="center" bgcolor="#6699CC"><span class="style1">????????</span></td>
    <td width='213' height="25" align="center" bgcolor="#FFFFFF"><div align="left"><?=$rows->sdate?> ~ <?=$rows->edate?></div></td>
    <td width='55' align="center" bgcolor="#6699CC"><span class="style1">?????⵵</span></td>
    <td width='74' align="center" bgcolor="#FFFFFF"><div align="center"><?=$rows->year?>??</div></td>
  </tr>
  <tr align='center' height='25'>
    <td height="25" align="center" bgcolor="#6699CC"><span class="style1">????????</a></span></td>
    <td align="center" bgcolor="#FFFFFF">
      <div align="left">
        <?=$rows->type?>
      </div></td>
    <td align="center" bgcolor="#6699CC"><span class="style1">?????ð?</span></td>
    <td align="center" bgcolor="#FFFFFF"><?=$rows->ttime?>
      ?ð?</td>
  </tr>
</table>
<table width=450 border=0 align=center cellpadding=1 cellspacing=1 bgcolor="#E8E8E8" >
<tr height='30'>
	<td height="30" colspan="4" align=center bgcolor=#6699CC><span class="style4">?? ?????? ?????? ???? (??
        <?=$total?>
      ??) </span></td>
	</tr>
<tr height='30'>
  <td width='233' height="25" align=center bgcolor=#6699CC><span class="style1">?Ҽӱ?????</span></td>
  <td width='50' height="25" align=center bgcolor=#6699CC><span class="style1">?̸?</span></td>
  <td width='100' height="25" align=center bgcolor=#6699CC><span class="style1">?ֹε??Ϲ?ȣ</span></td>
  <td width='54' align=center bgcolor=#6699CC><span class="style1">????</span></td>
</tr>

<?
if($total<1){
	echo"<tr align=center><td height='25' colspan='5' align=center bgcolor=#FFFFFF>???ϵ? ?????ڰ? ?????ϴ?.</td></tr>";
}
					
for($i=0; $i<$total; $i++){
	$row = mysql_fetch_object($res);			//?? ???? ??ü???÷? ?????´?
?>
<tr align='center' height='25'>
	<td align=center bgcolor=#FFFFFF><?=$row->company?></td>
	<td align=center bgcolor=#FFFFFF><?=$row->name?></td>
	<td align=center bgcolor=#FFFFFF><?=$row->jumin1?>
	  -
      <?=$row->jumin2?></td>
    <td align=center bgcolor=#FFFFFF>
	<? if ($row->state=="ready"){ ?>
		??????
	<? }else{ ?>
		?Ϸ?
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