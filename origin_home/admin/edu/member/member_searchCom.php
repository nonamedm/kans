<?
include "../conf/connchk.inc";
include "../conf/dbconn.inc";

if($keyword){
	if($search=='company')
			$sql="select com_id, company, name from on_edu_repre where company like '%".$keyword."%' order by company desc";
	else
			$sql="select com_id, company, name from on_edu_repre where name like '%".$keyword."%' order by name desc";

}else{
	$sql="select com_id, company, name from on_edu_repre order by company desc";
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
function setData(id, name){
	opener.form.company.value = id;
	opener.form.com_name.value = name;
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
<form name='frm' method='post' action='./member_searchCom.php'>
<table width="480" border="0" align="center">

<tr>
	<td width='100%'>
		<select name='search'>
			<option value='company'>소속기관명</option>
			<option value='name'>담당자</option>
		</select>
		<input type='text' name='keyword' size='25'>
		<input type='button' value='검색' onclick='javascript:frm.submit();'>
</td>
</tr>
</table>

<table width=450 border=0 align=center cellpadding=1 cellspacing=1 bgcolor="#E8E8E8" >
<tr height='30'>
	<td width='330' height="30" align=center bgcolor=#6699CC><span class="style1">소속기관명</span></td>
	<td bgcolor=#6699CC align=center width='120'><span class="style1">관리자</span></td>
</tr>

<?
if($total<1){
	echo"<tr align=center><td height='25' colspan='2' align=center bgcolor=#FFFFFF>등록된 소속기관이 없습니다.</td></tr>";
}
					
for($i=0; $i<$total; $i++){
	$row = mysql_fetch_object($res);			//한 열씩 객체형택로 가져온다
?>
<tr align='center' height='25'>
	<td width='330' align=center bgcolor=#FFFFFF><a href="javascript:setData('<?=$row->com_id?>','<?=$row->company?>');"><?=$row->company?></a></td>
	<td bgcolor=#FFFFFF align=center width='120'><?=$row->name?></td>
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