<?
include "../conf/connchk.inc";
include "../conf/dbconn.inc";


$sql="select * from on_edu_member_rec  where idkey='".$id."' and seq ='".$seq ."'";
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
function compModify(){
	var str = confirm("교육일자(수료일)를 수정하시겠습니까?");
	//document.frm.seq.value = seq;
	if (str)	frm.submit()
}
</script>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>
</head>

<body>
<form name='frm' method='post' action='./member_comp_cmd.php'>
<input type='hidden' name='id' value='<?=$id?>'>
<input type='hidden' name='seq' value='<?=$seq?>'>
  <table width=334 border=0 align=center cellpadding=1 cellspacing=1 bgcolor="#E8E8E8" >
<tr height='30'>
	<td width='258' height="30" align=center bgcolor=#6699CC><span class="style1">교육일자 (수료증에 표시되는 날짜입니다) </span></td>
	<td bgcolor=#6699CC align=center width='111'><span class="style1">확인</span></td>
</tr>

<?
if($total<1){
	echo"<tr align=center><td height='25' colspan='2' align=center bgcolor=#FFFFFF>등록된 소속기관이 없습니다.</td></tr>";
}
					
for($i=0; $i<$total; $i++){
	$row = mysql_fetch_object($res);			//한 열씩 객체형택로 가져온다
?>
<tr align='center' height='25'>
	<td width='258' align=center bgcolor=#FFFFFF>
	  <input type="text" size='20' name='regdate' maxlength='20' value='<?=$row->regdate?>' />
	</td>
	<td bgcolor=#FFFFFF align=center width='111'><input name="comp_modifybtn" type="button" onclick="compModify();" value="수 정" /></td>
</tr>
<?
}
?>
</table>
<br>
<table width="324" border="0" align="center">
  <tr>
    <td width='100%'><div align="right">
      <input name="button" type=button onclick="javascript:window.close();" value='close' />
    </div></td>
  </tr>
</table>

</form>
</body>
</html>

<?
include "../conf/dbconn_close.inc";
?>