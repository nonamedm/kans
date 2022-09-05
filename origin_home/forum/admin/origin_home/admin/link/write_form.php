<?
include "../dbconn.inc";


if($uid !=''){
	$sql="select * from board where uid=$uid";
	$res=mysql_query($sql);
	$row=mysql_fetch_object($res);
}
?>
<html>
<head>
<title>글쓰기</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<style TYPE="text/css">
<!--
td {font-family:±¼¸²; font-size:9pt; text-decoration:none}
table {font-family:±¼¸²; font-size:10pt; text-decoration:none}
A:link { font-size:10pt; font-face:"±¼¸²"; text-decoration:none;}
A:visited { font-size:10pt; font-face:"±¼¸²"; text-decoration:none;}
A:hover  { font-size:10pt; text-decoration:underline;}
//-->
</style>
<script language=javascript>
function check(){

var form=document.form;

	if(form.writer.value==''){
		alert('작성자를 입력하세요!');
		form.writer.focus();
		return;
	}
/**
	if(form.pass_1.value==''){
		alert('ºn¹Ð¹øE￡¸| AO·ACI¼¼¿a!');
		form.pass_1.focus();
		return;
	}

	if(form.pass_1.value.length < 4 || form.pass_1.value.length > 12){
		alert('ºn¹Ð¹øE￡´A 4 ~ 12AU¸® ≫cAI·I AO·ACI¼¼¿a!');
		form.pass_1.focus();
		return;
	}

	if(form.pass_1.value !=form.pass_2.value ){
		alert('ºn¹Ð¹øE￡°¡ ¸AAo ¾EA¾´I´U!');
		form.pass_2.focus();
		return;
	}
**/
	if(form.title.value=='')	{
		alert('사이트 이름을 입력하세요!');
		form.title.focus();
		return;
	}
	if(form.content.value==''){
		alert('주소를 입력하세요!');
		form.content.focus();
		return;
	}
	form.submit()
}

function startUp(){
	document.form.title.focus();
}
</script>

</head>

<body leftmargin='0' topmargin='0'  onLoad='startUp();'>

<form name=form action='write.php' method='post' enctype="multipart/form-data">
<input type=hidden name='uid' value='<?=$uid?>'>
<!--
<table border=0 cellpadding=1 cellspacing=1 align=center width=530 >
<tr>
	<td bgcolor='#6699CC' height='30'>&nbsp;&nbsp; ¹æ≫c¼± AI¾ß±a > ±U¾²±a</td></tr>
</table>
-->

<table border=0 cellpadding=1 cellspacing=1 align=center width=530 >
<tr>
	<td bgcolor=#6699CC align=center width='100'>작성자</td>
	<td>
		<input type=text size='22' name='writer' maxlength='20' style="border-width:1;border-color:#6d6d6d; border-style:solid;" value='관리자'></td></tr>
<tr>
	<td bgcolor=#6699CC align=center width='100'>사이트 이름</td>
	<td>
		<input type=text size='42' name='title' maxlength='50' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->title?>'></td></tr>
<tr>
	<td bgcolor=#6699CC align=center>주 소</td>
	<td><font color="#FF0000">* 주의: "http://" 부분은 빼고 입력해 주세요. 자동으로 처리됩니다.</font><br>
	  <textarea name=content cols='49' rows='2' wrap="VIRTUAL" style="border-width:1; border-color:#6d6d6d;border-style:solid;"><?=$row->content?></textarea></td></tr>
<!--
<tr>
	<td bgcolor=#6699CC align=center width='100'>첨부파일</td>
	<td>
		<input type='file' size='36' name='boardfile' maxlength='50' style="border-width:1;border-color:#6d6d6d; border-style:solid;"></td></tr>
-->
</table>
<br>

<div align='right'>
<? if($uid != ''){ ?>

	<input type=button onclick='rewrite()' value='수정'style="background-color:#EEE0E5;border-width:1; border-style:solid;">&nbsp;
	<input type=button onclick='check()' value='등록'style="background-color:#EEE0E5;border-width:1; border-style:solid;">&nbsp;
	<input type=button onclick='remove()' value='삭제'style="background-color:#EEE0E5 ;border-width:1; border-style:solid;">&nbsp;

<?}else{?>

	<input type='button' onclick='check()' value='등록'style="background-color:#FFF0F5;border-width:1; border-style:solid;">&nbsp;
	
<?}?>

<input type=button onclick="javascript:window.close();" value='close' style="background-color:#FFF0F5;border-width:1; border-style:solid;">
&nbsp;
</div>
</form>
</body>
</html>