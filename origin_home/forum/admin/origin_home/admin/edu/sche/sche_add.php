<?
include "../conf/connchk.inc";
include "../conf/dbconn.inc";

$sql="SELECT * FROM on_edu_schedule order by sdate asc";
$res=mysql_query($sql);
$total=mysql_affected_rows();

if ($id!=''){
	$sql="SELECT * FROM on_edu_schedule where code = '".$id."'";
	$ress=mysql_query($sql);
	$row = mysql_fetch_object($ress);
}

$sdate = substr($row->sdate,0,4).substr($row->sdate,5,2).substr($row->sdate,8,2);
$edate = substr($row->edate,0,4).substr($row->edate,5,2).substr($row->edate,8,2);

$now=mktime();
$now=date(Y.'.'.m.'.'.d,$now);
$y=date(Y);
$m=date(m);
$d=date(d);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title>:::: Secure ::::</title>
<link rel="stylesheet" href="../css/style.css" type="text/css">
<script language=javascript>
function check(){

	var form=document.form;
	
	if(form.type.value==''){
		alert('교육종류를 선택하세요!');
		form.type.focus();
		return;
	}
	if(form.sdate.value==''){
		alert('시작일을 입력하세요!');
		form.sdate.focus();
		return;
	}
	if(form.edate.value==''){
		alert('종료일을 입력하세요!');
		form.edate.focus();
		return;
	}
	if(form.ttime.value==''){
		alert('교육시간을 입력하세요!');
		form.ttime.focus();
		return;
	}
	
	form.submit()
}

function startUp(){
	document.form.name.focus();
}
</script>
<script language="javascript">
function update(){
	var form=document.form;
	
	if(form.type.value==''){
		alert('교육종류를 선택하세요!');
		form.type.focus();
		return;
	}
	if(form.sdate.value==''){
		alert('시작일을 입력하세요!');
		form.sdate.focus();
		return;
	}
	if(form.edate.value==''){
		alert('종료일을 입력하세요!');
		form.edate.focus();
		return;
	}
	if(form.ttime.value==''){
		alert('교육시간을 입력하세요!');
		form.ttime.focus();
		return;
	}

	var str = confirm("교육일정 정보를 수정 하시겠습니까?");
	if (str)	form.submit()
}
function deleteData(){
	var str = confirm("교육일정 정보를 삭제 하시겠습니까?");
	if (str)	document.location.href="./sche_add_cmd.php?id=<?=$id?>&mode=<?=MD5(delete)?>";
}

</script>

<style type="text/css">
<!--
.style2 {color: #FFFFFF}
.style4 {color: #FFFFFF; font-weight: bold; }
-->
</style>
</head>

<body>
<form name='form' action='sche_add_cmd.php' method='post'>
<input type='hidden' name='id' value='<?=$id?>'>
<input type='hidden' name='mode' value='<?=$mode?>'>

<table width="482" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#E8E8E8" >
  <tr>
    <td height="30" colspan="2" align="center" bgcolor="#6699CC"><span class="style4">▒ 교육일정  (# 필수정보) </span></td>
  </tr>
  <tr>
    <td width="81" height="25" align="center" bgcolor="#6699CC"><span class="style2"> # 교육종류 </span></td>
    <td width="394" bgcolor="#FFFFFF"><select name="type">
	  <option value="" <? if ($row->type==''){ ?>selected<? }else{ ?> <? } ?>></option>
      <option value="일반 종사자교육" <? if ($row->type=='일반 종사자교육'){ ?>selected<? }else{ ?> <? } ?>>일반 종사자교육</option>
      <option value="신규 종사자교육" <? if ($row->type=='신규 종사자교육'){ ?>selected<? }else{ ?> <? } ?>>신규 종사자교육</option>
	  <option value="면허자 보수교육" <? if ($row->type=='면허자 보수교육'){ ?>selected<? }else{ ?> <? } ?>>면허자 보수교육</option>
    </select></td>
  </tr>
  <tr>
    <td height="25" align="center" bgcolor="#6699CC"><span class="style2"># 교육일자 </span></td>
    <td bgcolor="#FFFFFF"><input type="text" size='10' name='sdate' maxlength='8'  value='<?=$sdate?>' /> 
		~ 
		<input type="text" size='10' name='edate' maxlength='8'  value='<?=$edate?>' />
		예) 20100102 ~ 20100105 </td>
  </tr>
  <tr>
    <td height="25" align="center" bgcolor="#6699CC"><span class="style2"># 교육시간 </span></td>
    <td bgcolor="#FFFFFF"><input type="text" size='2' name='ttime' maxlength='2'  value='<?=$row->ttime?>' />
시간</td>
  </tr>
  <tr>
    <td height="25" align="center" bgcolor="#6699CC"><span class="style2">담당자</span></td>
    <td bgcolor="#FFFFFF"><input type="text" size='15' name='admin' maxlength='15' value='<?=$row->admin?>' /></td>
  </tr>
  <tr>
    <td height="25" align="center" bgcolor="#6699CC"><span class="style2">교육내용</span></td>
    <td bgcolor="#FFFFFF"><label>
      <textarea name="comment" cols="70" rows="5"><?=$row->comment?></textarea>
    </label></td>
  </tr>
</table>
<br />
<table width="367" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><div align="center">
      <? if($id != ''){ ?>
		  <input name="button" type="button" onclick='update()' value='수 정' />
		  &nbsp;
		  <input name="button" type="button" onclick='deleteData()' value='삭 제' />
		  &nbsp;
		  <?}else{?>
		  <input name="button" type='button' onclick='check()' value=' 등 록 ' />
		  &nbsp;
	  <?}?>
  <input name="button" type='button' onclick="javascript:window.close();" value=' 취 소 ' />
  &nbsp; </div></td>
  </tr>
</table>
</form>
</body>
</html>
<?
include "../conf/dbconn_close.inc";
?>