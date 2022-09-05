<?
include "../dbconn.inc";


if($no !=''){
	$sql="select * from f_notice where no=$no";
	$res=mysql_query($sql);
	$row=mysql_fetch_object($res);
}
?>
<html>
<head>
<title>글쓰기</title>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
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
<input type=hidden name='no' value='<?=$no?>'>
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
		<input type=text size='22' name='writer' maxlength='20' style="border-width:1;border-color:#6d6d6d; border-style:solid;" value='관리자'></td></tr>
<tr>
	<td bgcolor=#6699CC align=center width='100'>제 목</td>
	<td>
		<input type=text size='42' name='title' maxlength='50' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->title?>'></td></tr>
<tr>
	<td bgcolor=#6699CC align=center>내 용</td>
	<td><textarea id="summernote" name="content"></textarea>
	<script>
    $(document).ready(function() {
        //여기 아래 부분
		$('#summernote').summernote({
			height: 300,                 // 에디터 높이
			minHeight: null,             // 최소 높이
			maxHeight: null,             // 최대 높이
			focus: true,                  // 에디터 로딩후 포커스를 맞출지 여부
			lang: "ko-KR",				 // 한글 설정
			//placeholder: '최대 2048자까지 쓸 수 있습니다'	//placeholder 설정
			
		});
    });
  	</script>
	</td>
</tr>
<tr>
	<td bgcolor=#6699CC align=center width='100'>파 일</td>
	<td>
		<input type='file' size='36' name='boardfile' maxlength='50' style="border-width:1;border-color:#6d6d6d; border-style:solid;"></td></tr>
</table>
<br>

<div align='right'>
<? if($no != ''){ ?>

	<input type=button onclick='rewrite()' value='답 변'style="background-color:#EEE0E5;border-width:1; border-style:solid;">&nbsp;
	<input type=button onclick='check()' value='수 정'style="background-color:#EEE0E5;border-width:1; border-style:solid;">&nbsp;
	<input type=button onclick='remove()' value='삭 제'style="background-color:#EEE0E5 ;border-width:1; border-style:solid;">&nbsp;

<?}else{?>

	<input type='button' onclick='check()' value=' 등 록 'style="background-color:#FFF0F5;border-width:1; border-style:solid;">&nbsp;
	
<?}?>

<input type=button onclick="javascript:window.close();" value='close' style="background-color:#FFF0F5;border-width:1; border-style:solid;">
&nbsp;
</div>
</form>
</body>
</html>