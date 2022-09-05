<?
include "../dbconn.inc";


if($uid !=''){
	$sql="select * from sec_board where uid=$uid";
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
td {font-family:굴림; font-size:9pt; text-decoration:none}
table {font-family:굴림; font-size:10pt; text-decoration:none}
A:link { font-size:10pt; font-face:"굴림"; text-decoration:none;}
A:visited { font-size:10pt; font-face:"굴림"; text-decoration:none;}
A:hover  { font-size:10pt; text-decoration:underline;}
//.style1 {color: #FFFFFF}
.style1 {color: #FFFFFF}
.style2 {color: #FF0000}
-->
</style>
<script language=javascript>
function check(){

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
	<td bgcolor='#6699CC' height='30'>&nbsp;&nbsp; 방사선 이야기 > 글쓰기</td></tr>
</table>
-->

<table border=0 cellpadding=1 cellspacing=1 align=center width=530 >
<tr>
	<td width='100' height="25" align=center bgcolor=#6699CC><span class="style1">작성자</span></td>
	<td height="25">
	  <input type=text size='22' name='writer' maxlength='20' style="border-width:1;border-color:#6d6d6d; border-style:solid;" value='관리자'></td></tr>
<tr>
	<td width='100' height="25" align=center bgcolor=#6699CC><span class="style1">보안코드</span></td>
	<td height="25"><label>
		<select name="sec_code">
		<? 
		$sql="select * from sec_code";
		$res=mysql_query($sql);
		$total=mysql_affected_rows();

		for($i=0; $i<$total; $i++){
			$row = mysql_fetch_object($res); ?>
			<option value="<?=$row->sec_code?>"><?=$row->sec_code?>: <?=$row->sec_memo?></option>
		  <?
	$n = $n-1;
}
?>
	    </select>
	  </label></td></tr>
<tr>
	<td width='100' height="25" align=center bgcolor=#6699CC><span class="style1">공개여부</span></td>
	<td height="25">
      <input name="sec_chk" type="radio" value="0" checked="checked">
      비공개 &nbsp;
	  <input type="radio" name="sec_chk" value="1">
      공개 &nbsp;</td>
</tr>
<tr>
	<td width='100' height="25" align=center bgcolor=#6699CC><span class="style1">제 목</span></td>
	<td height="25">
	  <input type=text size='42' name='title' maxlength='50' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->title?>'></td></tr>		
<tr>
	<td bgcolor=#6699CC align=center><span class="style1">내 용</span></td>
	<td><textarea name=content rows='10' cols='49' style="border-width:1; border-color:#6d6d6d;border-style:solid;"><?=$row->content?></textarea></td></tr>
<tr>
	<td width='100' height="25" align=center bgcolor=#6699CC><span class="style1">파 일</span></td>
	<td height="50"><span class="style2">파일명은 반드시 <strong>영어</strong>로 해주십시요.
	  </span>
	  <input type='file' size='36' name='boardfile' maxlength='50' style="border-width:1;border-color:#6d6d6d; border-style:solid;"></td>
</tr>
</table>
<br>

<div align='right'>
<? if($uid != ''){ ?>

	<input type=button onclick='rewrite()' value='답 변'style="background-color:#EEE0E5;border-width:1; border-style:solid;">&nbsp;
	<input type=button onclick='check()' value='수 정'style="background-color:#EEE0E5;border-width:1; border-style:solid;">&nbsp;
	<input type=button onclick='remove()' value='삭 제'style="background-color:#EEE0E5 ;border-width:1; border-style:solid;">&nbsp;

<?}else{?>

	<input type='button' onclick='check()' value=' 등 록 'style="background-color:#FFF0F5;border-width:1; border-style:solid;">&nbsp;
	
<?}?>

<input type=button onClick="javascript:window.close();" value='close' style="background-color:#FFF0F5;border-width:1; border-style:solid;">
&nbsp;
</div>
</form>
</body>
</html>