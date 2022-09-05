<?
include "../conf/connchk.inc";
include "../conf/dbconn.inc";

$sql="SELECT * FROM on_edu_repre order by name desc";
$res=mysql_query($sql);
$total=mysql_affected_rows();

if ($id!=''){
	$id=str_replace("@amp;", "&" ,$id);
	$sql="SELECT * FROM on_edu_repre where id = '".$id."'";
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
	
	if(form.id.value==''){
		alert('아이디를 입력하세요!');
		form.id.focus();
		return;
	}
	if(form.pw.value==''){
		alert('비밀번호를 입력하세요!');
		form.pw.focus();
		return;
	}
	if(form.company.value==''){
		alert('소속기관명을 입력하세요!');
		form.company.focus();
		return;
	}
	if(form.name.value==''){
		alert('이름을 입력하세요!');
		form.name.focus();
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
	
	if(form.pw.value==''){
		alert('비밀번호를 입력하세요!');
		form.pw.focus();
		return;
	}
	if(form.company.value==''){
		alert('소속기관명을 입력하세요!');
		form.company.focus();
		return;
	}
	if(form.name.value==''){
		alert('이름을 입력하세요!');
		form.name.focus();
		return;
	}

	var str = confirm("기관정보를 수정 하시겠습니까?");
	if (str)	form.submit()
}
function deleteData(){
	var str = confirm("기관정보를 삭제 하시겠습니까?");
	if (str)	document.location.href="./repre_add_cmd.php?id=<?=$id=str_replace("&", "@amp;" ,$id);?>&mode=<?=MD5(delete)?>";
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
<form name='form' action='repre_add_cmd.php' method='post'>
<input type='hidden' name='id' value='<?=$id?>'>
<input type='hidden' name='mode' value='<?=$mode?>'>
<table width="482" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#E8E8E8" >
  <tr>
    <td height="30" colspan="3" align="center" bgcolor="#6699CC"><span class="style4">▒ 기관 정보 (# 필수정보) </span></td>
  </tr>
  <tr>
    <td height="25" colspan="2" align="center" bgcolor="#6699CC"><span class="style2"> # ID</span></td>
    <td width="359" bgcolor="#FFFFFF">
	<?
	if ($id!=''){
	?>
		<?=$row->id?>
	<? }else{ ?>
		<input type="text" size='30' name='id' maxlength='40' value='<?=$row->id?>' />
	<? } ?>
	</td>
  </tr>
  <tr>
    <td height="25" colspan="2" align="center" bgcolor="#6699CC"><span class="style2"># PW</span></td>
    <td bgcolor="#FFFFFF"><input type="password" size='22' name='pw' maxlength='20'  value='<?=$row->pw?>' /></td>
  </tr>
  <tr>
    <td height="25" colspan="2" align="center" bgcolor="#6699CC"><span class="style2"># 소속기관명</span></td>
    <td bgcolor="#FFFFFF"><input type="text" size='60' name='company' maxlength='100'  value='<?=$row->company?>' /></td>
  </tr>
  <tr>
    <td height="25" colspan="2" align="center" bgcolor="#6699CC"><span class="style2">종목</span></td>
    <td bgcolor="#FFFFFF"><input type="text" size='50' name='item' maxlength='100' value='<?=$row->item?>' /></td>
  </tr>
  <tr>
    <td height="25" colspan="2" align="center" bgcolor="#6699CC"><span class="style2">업태 </span></td>
    <td bgcolor="#FFFFFF"><input type="text" size='50' name='condition' maxlength='100'  value='<?=$row->condition?>' /></td>
  </tr>
  <tr>
    <td height="25" colspan="2" align="center" bgcolor="#6699CC"><span class="style2">주 소</span></td>
    <td bgcolor="#FFFFFF"><input type="text" size='60' name='addr' maxlength='200'  value='<?=$row->addr?>' /></td>
  </tr>
  <tr>
    <td width='52' rowspan="4" align="center" bgcolor="#6699CC"><span class="style2">      관<br />
      리<br />
      자</span></td>
    <td width='61' height="25" align="center" bgcolor="#6699CC"><span class="style2"># 이름</span></td>
    <td bgcolor="#FFFFFF"><input type="text" size='22' name='name' maxlength='16'  value='<?=$row->name?>' /></td>
  </tr>
  <tr>
    <td width="61" align="center" bgcolor="#6699CC"><span class="style2">부서</span></td>
    <td bgcolor="#FFFFFF"><input type="text" size='22' name='part' maxlength='20'  value='<?=$row->part?>' /></td>
  </tr>
  
  <tr>
    <td width="61" height="25" align="center" bgcolor="#6699CC"><span class="style2">E-mail</span></td>
    <td bgcolor="#FFFFFF"><input type="text" size='50' name='email' maxlength='150' value='<?=$row->email?>' /></td>
  </tr>
  <tr>
    <td width="61" align="center" bgcolor="#6699CC"><span class="style2">연락처</span></td>
    <td bgcolor="#FFFFFF"><input type="text" size='20' name='tel' maxlength='20'  value='<?=$row->tel?>' />
      예) 012-3456-7890</td>
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