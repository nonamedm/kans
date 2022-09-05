<?
include "../conf/connchk.inc";
include "../conf/dbconn.inc";

$sql="select C.datacode, C.title, C.comm, C.url from on_edu_schedule A, on_edu_sch_data B, on_edu_data C where A.code = '".$id."' and B.code = '".$id."'  and B.datacode = C.datacode order by C.title asc";
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
	if(form.title.value=='' || form.comm.value=='' || form.url.value==''){
		alert('자료찾기를 통해 자료 정보를 입력해주세요.');
		searchData();
		return;
	}

	var str = confirm("해당 자료를 등록 하시겠습니까?");
	if (str)	form.submit()
}

function delData(code, id){
	var str = confirm("선택하신 자료를 삭제 하시겠습니까?");
	if (str)	document.location.href="./sche_add_data_cmd.php?id="+code+"&k="+id+"&mode=<?=MD5(delete)?>";
}

function searchData(){
	var theURL='./sche_dataSch.php';
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
<form name='form' method='post' action='./sche_add_data_cmd.php'>
<input type='hidden' name='id' value='<?=$id?>'>
<input type='hidden' name='k' value='<?=$k?>'>
<table width="450" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#E8E8E8" >
  <tr height='30'>
    <td height="30" colspan="4" align="center" bgcolor="#6699CC"><span class="style4">▒ 교육정보 </span></td>
  </tr>
  <tr height='30'>
    <td width='95' height="25" align="center" bgcolor="#6699CC"><span class="style1">교육일자</span></td>
    <td width='213' height="25" align="center" bgcolor="#FFFFFF"><div align="left"><?=$rows->sdate?> ~ <?=$rows->edate?></div></td>
    <td width='55' align="center" bgcolor="#6699CC"><span class="style1">교육년도</span></td>
    <td width='74' align="center" bgcolor="#FFFFFF"><div align="center"><?=$rows->year?>년</div></td>
  </tr>
  <tr align='center' height='25'>
    <td height="25" align="center" bgcolor="#6699CC"><span class="style1">교육종류</a></span></td>
    <td align="center" bgcolor="#FFFFFF">
      <div align="left">
        <?=$rows->type?>
      </div></td>
    <td align="center" bgcolor="#6699CC"><span class="style1">교육시간</span></td>
    <td align="center" bgcolor="#FFFFFF"><?=$rows->ttime?>
      시간</td>
  </tr>
</table>
<br />
<table width=450 border=0 align=center cellpadding=1 cellspacing=1 bgcolor="#E8E8E8" >
<tr height='30'>
	<td height="25" colspan="4" align=center bgcolor=#6699CC><span class="style1"><span class="style4">▒ 교육자료 등록 </span></td>
	</tr>
<tr height='30'>
  <td height="30" colspan="4" align=center bgcolor=#FFFFFF><input type="text" size='20' name='title' maxlength='100' readonly="readonly" />&nbsp;<input type="text" size='10' name='comm' maxlength='100' readonly="readonly"/>&nbsp;<input type="text" size='14' name='url' maxlength='15' readonly="readonly"/>&nbsp;<input type="button" name="dataFind" value="자료찾기" onclick="searchData();" /><input type="button" name="dataAdd" value=" 등록 " onclick="check();" /></td>
</tr>
</table><br />
<table width=450 border=0 align=center cellpadding=1 cellspacing=1 bgcolor="#E8E8E8" >
<tr height='30'>
	<td height="25" colspan="4" align=center bgcolor=#6699CC><span class="style1"><span class="style4">▒ 등록된 자료 목록 (총 <?=$total?>개) </span></td>
	</tr>
<tr height='30'>
  <td width="235" height="25" align=center bgcolor=#6699CC><span class="style1">제목</span></td>
  <td width='60' height="25" align=center bgcolor=#6699CC><span class="style1">형태</span></td>
  <td width='95' height="25" align=center bgcolor=#6699CC><span class="style1">파일명</span></td>
  <td width='47' height="25" align=center bgcolor=#6699CC><span class="style1">삭제</span></td>
</tr>

<?
if($total<1){
	echo"<tr align=center><td height='25' colspan='5' align=center bgcolor=#FFFFFF>등록된 교육자료가 없습니다.</td></tr>";
}
					
for($i=0; $i<$total; $i++){
	$row = mysql_fetch_object($res);			//한 열씩 객체형택로 가져온다
?>
<tr align='center' height='25'>
	<td align=center bgcolor=#FFFFFF><?=$row->title?></td>
	<td align=center bgcolor=#FFFFFF><?=$row->comm?></td>
	<td align=center bgcolor=#FFFFFF><?=$row->url?></td>
    <td align=center bgcolor=#FFFFFF>
		<input type="button" name="dataDel" value="삭제" onclick="delData('<?=$id?>','<?=$row->datacode?>');" />
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