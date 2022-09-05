<?
include "../conf/connchk.inc";
include "../conf/dbconn.inc";

if ($id!=''){
	$sql="SELECT * FROM on_edu_data where datacode = '".$id."'";
	$ress=mysql_query($sql);
	$row = mysql_fetch_object($ress);
}
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
	
	if(form.title.value==''){
		alert('제목을 입력하세요!');
		form.title.focus();
		return;
	}
	if(form.type.value==''){
		alert('용도를 선택하세요!');
		form.type.focus();
		return;
	}
	if(form.comm.value==''){
		alert('파일형태를 선택하세요!');
		form.comm.focus();
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
	
	if(form.title.value==''){
		alert('제목을 입력하세요!');
		form.title.focus();
		return;
	}
	if(form.type.value==''){
		alert('용도를 선택하세요!');
		form.type.focus();
		return;
	}
	if(form.comm.value==''){
		alert('파일형태를 선택하세요!');
		form.comm.focus();
		return;
	}

	var str = confirm("교육자료를 수정 하시겠습니까?");
	if (str)	form.submit()
}
function deleteData(){
	var str = confirm("교육자료를 삭제 하시겠습니까?");
	if (str)	document.location.href="./data_add_cmd.php?id=<?=$id?>&mode=<?=MD5(delete)?>";
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
<form name='form' action='data_add_cmd.php' method='post'>
<input type='hidden' name='id' value='<?=$id?>'>
<input type='hidden' name='mode' value='<?=$mode?>'>
<table width="482" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#E8E8E8" >
  <tr>
    <td height="30" colspan="2" align="center" bgcolor="#6699CC"><span class="style4">▒ 교육 자료 (# 필수정보) </span></td>
  </tr>
  <tr>
    <td width="85" height="25" align="center" bgcolor="#6699CC"><span class="style2"> # 제목</span></td>
    <td width="390" bgcolor="#FFFFFF">
	  <input type="text" size='30' name='title' maxlength='40' value='<?=$row->title?>' />	</td>
  </tr>
  <tr>
    <td height="25" align="center" bgcolor="#6699CC"><span class="style2"># 용도 </span></td>
    <td bgcolor="#FFFFFF"><select name="type">
      <option value="" <? if ($row->type==''){ ?>selected<? }else{ ?> <? } ?>></option>
      <option value="일반 종사자교육" <? if ($row->type=='일반 종사자교육'){ ?>selected<? }else{ ?> <? } ?>>일반 종사자교육</option>
      <option value="신규 종사자교육" <? if ($row->type=='신규 종사자교육'){ ?>selected<? }else{ ?> <? } ?>>신규 종사자교육</option>
      <option value="면허자 보수교육" <? if ($row->type=='면허자 보수교육'){ ?>selected<? }else{ ?> <? } ?>>면허자 보수교육</option>
    </select></td>
  </tr>
  <tr>
    <td height="25" align="center" bgcolor="#6699CC"><span class="style2"># 형태 </span></td>
    <td bgcolor="#FFFFFF"><select name="comm">
      <option value="" <? if ($row->comm==''){ ?>selected<? }else{ ?> <? } ?>></option>
      <option value="문서" <? if ($row->comm=='문서'){ ?>selected<? }else{ ?> <? } ?>>문서</option>
      <option value="음성" <? if ($row->comm=='음성'){ ?>selected<? }else{ ?> <? } ?>>음성</option>
    </select></td>
  </tr>
  <tr>
    <td height="25" align="center" bgcolor="#6699CC"><span class="style2">파일명</span></td>
    <td bgcolor="#FFFFFF"><input type="text" size='30' name='url' maxlength='200' value='<?=$row->url?>' /> 
	<br />	
	- 예) test.mp3, test.ppt (대소문자구분 및 띄어쓰기주의) <br />
	- 업로드 위치) 문서:/www/edu/pds/pdf, 음악(스트리밍서버: kans2):/audio</td>
  </tr>
  <tr>
    <td height="25" align="center" bgcolor="#6699CC"><span class="style2">설명</span></td>
    <td bgcolor="#FFFFFF">
      <label>
      <textarea name="etc" cols="50" rows="4"><?=$row->etc?></textarea>
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