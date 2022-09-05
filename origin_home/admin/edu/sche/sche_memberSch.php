<?
include "../conf/connchk.inc";
include "../conf/dbconn.inc";

if($keyword){
	if($search=='company')
		$sql="select A.idkey, A.name, A.jumin1, A.jumin2, A.com_id, B.company from on_edu_member A, on_edu_repre B where A.com_id like B.com_id and B.company like '%".$keyword."%' order by B.company desc";
	else
		$sql="select A.idkey, A.name, A.jumin1, A.jumin2, A.com_id, B.company from on_edu_member A, on_edu_repre B where A.com_id like B.com_id and A.name like '%".$keyword."%' order by A.name desc";
}else{
	$sql="select A.idkey, A.name, A.jumin1, A.jumin2, A.com_id, B.company from on_edu_member A, on_edu_repre B where A.com_id like B.com_id order by B.company desc ";
}
$res=mysql_query($sql);
$total=mysql_affected_rows();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<link rel="stylesheet" href="../css/style.css" type="text/css">
<title>:::: Secure ::::</title>
<script language=javascript>
function setData(id, com, name, ju){
	opener.form.k.value = id;
	opener.form.company.value = com;
	opener.form.name.value = name;
	opener.form.jumin.value = ju;
	self.close();
}
</script>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>
</head>

<body>
<form name='frm' method='post' action='./sche_memberSch.php'>
<table width="480" border="0" align="center">

<tr>
	<td width='100%'>
		<select name='search'>
			<option value='name'>이름</option>
			<option value='company'>소속기관명</option>
		</select>
		<input type='text' name='keyword' size='25'>
		<input type='button' value='검색' onclick='javascript:frm.submit();'>
</td>
</tr>
</table>

<table width=450 border=0 align=center cellpadding=1 cellspacing=1 bgcolor="#E8E8E8" >
<tr height='30'>
	<td width='253' height="30" align=center bgcolor=#6699CC><span class="style1">소속기관명</span></td>
	<td bgcolor=#6699CC align=center width='67'><span class="style1">이름</span></td>
    <td bgcolor=#6699CC align=center width='120'><span class="style1">주민등록번호</span></td>
</tr>

<?
if($total<1){
	echo"<tr align=center><td height='25' colspan='3' align=center bgcolor=#FFFFFF>등록된 소속기관이 없습니다.</td></tr>";
}
					
for($i=0; $i<$total; $i++){
	$row = mysql_fetch_object($res);			//한 열씩 객체형택로 가져온다
?>
<tr align='center' height='25'>
	<td width='253' align=center bgcolor=#FFFFFF><a href="javascript:setData('<?=$row->idkey?>','<?=$row->company?>','<?=$row->name?>','<?=$row->jumin1?>-<?=$row->jumin2?>');"><?=$row->company?></a></td>
	<td width='67' align=center bgcolor=#FFFFFF><?=$row->name?></td>
    <td width='120' align=center bgcolor=#FFFFFF><?=$row->jumin1?>-<?=$row->jumin2?></td>
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
if($search=='') $search = 'company';
?>
frm.keyword.value = '<?=$keyword?>';
frm.search.value = '<?=$search?>';
</script>
<?
include "../conf/dbconn_close.inc";
?>