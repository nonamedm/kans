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

function compMember(code, id){
	var str = confirm("선택하신 종사자의 교육을 완료(확인)하시겠습니까?");
	if (str)	document.location.href="./sche_add_member_cmd.php?id="+code+"&k="+id+"&mode=<?=MD5(complete)?>";
}

function chgState(code, id, mode, s){
	var str = confirm("선택하신 종사자의 교육상태를 변경하시겠습니까?");
	if (str)	document.location.href="./sche_add_member_cmd.php?id="+code+"&k="+id+"&mode=<?=MD5(change)?>&state="+s;
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
<input type='hidden' name='mode' value='<?=$mode?>'>
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
	<td height="25" colspan="5" align=center bgcolor=#6699CC><span class="style1"><span class="style4">▒ 종사자 목록 (총 <?=$total?>명) </span></td>
	</tr>
<tr height='30'>
  <td width="174" height="25" align=center bgcolor=#6699CC><span class="style1">소속기관명</span></td>
  <td width='60' height="25" align=center bgcolor=#6699CC><span class="style1">이름</span></td>
  <td width='85' height="25" align=center bgcolor=#6699CC><span class="style1">주민등록번호</span></td>
  <td width='67' align=center bgcolor=#6699CC><span class="style1">상태</span></td>
  <td width='48' height="25" align=center bgcolor=#6699CC><span class="style1">완료</span></td>
</tr>

<?
if($total<1){
	echo"<tr align=center><td height='25' colspan='5' align=center bgcolor=#FFFFFF>등록된 종사자가 없습니다.</td></tr>";
}
					
for($i=0; $i<$total; $i++){
	$row = mysql_fetch_object($res);			//한 열씩 객체형택로 가져온다
?>
<tr align='center' height='25'>
	<td align=center bgcolor=#FFFFFF><?=$row->company?></td>
	<td align=center bgcolor=#FFFFFF><?=$row->name?></td>
	<td align=center bgcolor=#FFFFFF><?=$row->jumin1?>-<?=$row->jumin2?></td>
	<? if ($row->state=="complete"){ ?>
		<td colspan="2" align=center bgcolor=#FFFFFF>교육완료</td>
    <? }else{ ?>
		<td align=center bgcolor=#FFFFFF>
		<select name="state" onchange="javascript:chgState('<?=$id?>','<?=$row->idkey?>','<?=MD5(change)?>',this.value);">
		  <option value="ready" <? if ($row->state=="ready"){ ?>selected<? }else{ ?> <? } ?>>교육중</option>
		  <option value="good" <? if ($row->state=="good"){ ?>selected<? }else{ ?> <? } ?>>수료</option>
		  <option value="bad" <? if ($row->state=="bad"){ ?>selected<? }else{ ?> <? } ?>>미수료</option>
		</select>	</td>
		<td align=center bgcolor=#FFFFFF>
		<? if ($row->state=="ready"){ ?>
			불가
		<? }else{ ?>
			<input type="button" name="memDel" value="확인" onclick="compMember('<?=$id?>','<?=$row->idkey?>');" />
		<? } ?>
		</td>
	<? } ?>
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