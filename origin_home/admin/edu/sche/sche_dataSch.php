<?
include "../conf/connchk.inc";
include "../conf/dbconn.inc";

if($keyword){
	if($search=='title')
		$sql="select * from on_edu_data where title like '%".$keyword."%' order by title asc";
	else
		$sql="select * from on_edu_data where url like '%".$keyword."%' order by url asc";
}else{
	$sql="select * from on_edu_data order by title desc ";
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
	opener.form.title.value = com;
	opener.form.comm.value = name;
	opener.form.url.value = ju;
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
<form name='frm' method='post' action='./sche_dataSch.php'>
<table width="480" border="0" align="center">

<tr>
	<td width='100%'>
		<select name='search'>
			<option value='title'>제목</option>
			<option value='url'>파일명</option>
		</select>
		<input type='text' name='keyword' size='25'>
		<input type='button' value='검색' onclick='javascript:frm.submit();'>
</td>
</tr>
</table>

<table width=450 border=0 align=center cellpadding=1 cellspacing=1 bgcolor="#E8E8E8" >
<tr height='30'>
	<td width='253' height="30" align=center bgcolor=#6699CC><span class="style1">제목</span></td>
	<td bgcolor=#6699CC align=center width='67'><span class="style1">형태</span></td>
    <td bgcolor=#6699CC align=center width='120'><span class="style1">파일명</span></td>
</tr>

<?
if($total<1){
	echo"<tr align=center><td height='25' colspan='3' align=center bgcolor=#FFFFFF>등록된 자료가 없습니다.</td></tr>";
}
					
for($i=0; $i<$total; $i++){
	$row = mysql_fetch_object($res);			//한 열씩 객체형택로 가져온다
?>
<tr align='center' height='25'>
	<td width='253' align=center bgcolor=#FFFFFF><a href="javascript:setData('<?=$row->datacode?>','<?=$row->title?>','<?=$row->comm?>','<?=$row->url?>');"><?=$row->title?></a></td>
	<td width='67' align=center bgcolor=#FFFFFF><?=$row->comm?></td>
    <td width='120' align=center bgcolor=#FFFFFF><?=$row->url?></td>
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
if($search=='') $search = 'title';
?>
frm.keyword.value = '<?=$keyword?>';
frm.search.value = '<?=$search?>';
</script>
<?
include "../conf/dbconn_close.inc";
?>