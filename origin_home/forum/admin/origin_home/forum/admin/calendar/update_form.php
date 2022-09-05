<?
include "../dbconn.inc";


if($uid !=''){
	$sql="select * from edu_calendar where uid=$uid";
	$res=mysql_query($sql);
	$row=mysql_fetch_object($res);
	$group_id = $row->group_id;
	$area_id = $row->area_id;
}

$sql="select * from edu_calendar_group order by  group_id asc";
$res2=mysql_query($sql);
$total=mysql_affected_rows();

$sql3="select * from edu_calendar_area order by  area_id asc";
$res3=mysql_query($sql3);
$total3=mysql_affected_rows();

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
	if(form.sdate.value>form.edate.value){
		alert('시작일이 종료일보다 큽니다!');
		form.sdate.focus();
		return;
	}
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
	<td bgcolor=#6699CC align=center width='100'>교육분류</td>
	<td>
		<select name="group_id">
<?
	for($i=0; $i<$total; $i++){
		$row2 = mysql_fetch_object($res2);			//한 열씩 객체형택로 가져온다
?>
			<option value="<?=$row2->group_id?>" <? if ($group_id==$row2->group_id){ ?>selected<? }?>><?=$row2->group_name?></option>

<?
	}
?>
		</select>
	</td></tr>
<tr>
	<td bgcolor=#6699CC align=center width='100'>지역</td>
	<td>
		<select name="area_id">
<?
	for($i=0; $i<$total3; $i++){
		$row3 = mysql_fetch_object($res3);			//한 열씩 객체형택로 가져온다
?>
			<option value="<?=$row3->area_id?>" <? if ($area_id==$row3->area_id){ ?>selected<? }?>><?=$row3->area_name?></option>
<?
	}
?>
		</select>
	</td></tr>	
<tr>
	<td bgcolor=#6699CC align=center width='100'>표시위치</td>
	<td>
		<select name="view_loc">
<?
	for($i=1; $i<=6; $i++){
?>
			<option value="<?=$i?>" <? if ($i==$row->view_loc){ ?>selected<? }?>><?=$i?></option>

<?
	}
?>
		</select>&nbsp;일정등록시 겹치지 않게 선택
	</td></tr>
<tr>
	<td bgcolor=#6699CC align=center width='100'>시작일</td>
	<td>
		<input type=text size='12' name='sdate' maxlength='8' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->sdate?>'>&nbsp;예) 20140408</td></tr>
<tr>
	<td bgcolor=#6699CC align=center width='100'>종료일</td>
	<td>
		<input type=text size='12' name='edate' maxlength='8' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->edate?>'>&nbsp;예) 20140408</td></tr>
<tr>
	<td bgcolor=#6699CC align=center width='100'>제 목</td>
	<td>
		<input type=text size='42' name='title' maxlength='50' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->title?>'></td></tr>
<tr>
	<td bgcolor=#6699CC align=center>내 용</td>
	<td><textarea name=content rows='8' cols='49' style="border-width:1; border-color:#6d6d6d;border-style:solid;"><?=$row->content?></textarea></td></tr>
</table>
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