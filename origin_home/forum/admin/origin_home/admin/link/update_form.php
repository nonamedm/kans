<?
include "../dbconn.inc";


if($uid !=''){
	$sql="select * from board where uid=$uid";
	$res=mysql_query($sql);
	$row=mysql_fetch_object($res);
	$fid = $row->fid;
	$thread = $row->thread;
}
?>
<html>
<head>
<title>글쓰기</title>
<style TYPE="text/css">
<!--
td {font-family:굴림; font-size:9pt; text-decoration:none}
table {font-family:굴림; font-size:10pt; text-decoration:none}
A:link { font-size:10pt; font-face:"굴림"; text-decoration:none;}
A:visited { font-size:10pt; font-face:"굴림"; text-decoration:none;}
A:hover  { font-size:10pt; text-decoration:underline;}
//-->
</style>
<script language=javascript>
function updateData(){

var form=document.form;

	if(form.writer.value==''){
		alert('작성자명을 입력하세요!');
		form.writer.focus();
		return;
	}
/**
	if(form.pass_1.value==''){
		alert('비밀번호를 입력하세요!');
		form.pass_1.focus();
		return;
	}

	if(form.pass_1.value.length < 4 || form.pass_1.value.length > 12){
		alert('비밀번호는 4 ~ 12자리 사이로 입력하세요!');
		form.pass_1.focus();
		return;
	}

	if(form.pass_1.value !=form.pass_2.value ){
		alert('비밀번호가 맞지 않읍니다!');
		form.pass_2.focus();
		return;
	}
**/
	if(form.title.value=='')	{
		alert('제목을 입력하세요!');
		form.title.focus();
		return;
	}
	if(form.content.value==''){
		alert('내용을 입력하세요!');
		form.content.focus();
		return;
	}
	form.action = './update.php';
	form.submit()
}


function replyData(){
var form=document.form;

	if(form.writer.value==''){
		alert('작성자명을 입력하세요!');
		form.writer.focus();
		return;
	}
/**
	if(form.pass_1.value==''){
		alert('비밀번호를 입력하세요!');
		form.pass_1.focus();
		return;
	}

	if(form.pass_1.value.length < 4 || form.pass_1.value.length > 12){
		alert('비밀번호는 4 ~ 12자리 사이로 입력하세요!');
		form.pass_1.focus();
		return;
	}

	if(form.pass_1.value !=form.pass_2.value ){
		alert('비밀번호가 맞지 않읍니다!');
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
	form.action = './reply.php';
	form.submit()
}
function deleteData(){
	var str = confirm("데이타를 삭제 하시됩니다.?\n\n계속 하시겠습니까?");
	if (str)	document.location.href="./delete.php?uid=<?=$uid?>";
}

function startUp(){
	document.form.title.focus();
}
</script>

</head>

<body leftmargin='0' topmargin='0'  onLoad='startUp();'>

<form name=form method='post' enctype="multipart/form-data">
<input type=hidden name='uid' value='<?=$uid?>'>
<input type=hidden name='fid' value='<?=$fid?>'>
<input type=hidden name='thread' value='<?=$thread?>'>
<!--
<table border=0 cellpadding=1 cellspacing=1 align=center width=530 >
<tr>
	<td bgcolor='#6699CC' height='30'>&nbsp;&nbsp; 방사선 이야기 > 글쓰기</td></tr>
</table>
-->

<table border=0 cellpadding=1 cellspacing=1 align=center width=530 >
<tr>
	<td bgcolor=#6699CC align=center width='100'>작성자</td>
	<td>
		<input type=text size='22' name='writer' maxlength='20' style="border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->writer?>'></td></tr>
<tr>
	<td bgcolor=#6699CC align=center width='100'>사이트 이름 </td>
	<td>
		<input type=text size='42' name='title' maxlength='50' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->title?>'></td></tr>
<tr>
	<td bgcolor=#6699CC align=center>주 소 </td>
	<td><font color="#FF0000">* 주의: "http://" 부분은 빼고 입력해 주세요. 자동으로 처리됩니다.</font><br>
	<textarea name=content cols='49' rows='2' wrap="VIRTUAL" style="border-width:1; border-color:#6d6d6d;border-style:solid;"><?=$row->content?></textarea></td></tr>
<!--
<tr>
	<td bgcolor=#6699CC align=center width='100'>파 일</td>
	<td>
		<input type='file' size='36' name='boardfile' maxlength='50' style="border-width:1;border-color:#6d6d6d; border-style:solid;"></td></tr>
-->
</table>
<br>

<div align='right'>
<? if($uid != ''){ ?>
<!--
	<input type=button onclick='replyData()' value='답 변'style="background-color:#FFF0F5;border-width:1; border-style:solid;">&nbsp;
-->
	<input type=button onclick='updateData()' value='수 정'style="background-color:#FFF0F5;border-width:1; border-style:solid;">&nbsp;
	<input type=button onclick='deleteData()' value='삭 제'style="background-color:#FFF0F5 ;border-width:1; border-style:solid;">&nbsp;

<?}else{?>

	<input type='button' onclick='check()' value=' 등 록 'style="background-color:#FFF0F5;border-width:1; border-style:solid;">&nbsp;
	
<?}?>

<input type=button onclick="javascript:window.close();" value='close' style="background-color:#FFF0F5;border-width:1; border-style:solid;">
&nbsp;
</div>
</form>
</body>
</html>