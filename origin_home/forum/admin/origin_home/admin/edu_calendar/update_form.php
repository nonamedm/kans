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
<title>�۾���</title>
<style TYPE="text/css">
<!--
td {font-family:����; font-size:9pt; text-decoration:none}
table {font-family:����; font-size:10pt; text-decoration:none}
A:link { font-size:10pt; font-face:"����"; text-decoration:none;}
A:visited { font-size:10pt; font-face:"����"; text-decoration:none;}
A:hover  { font-size:10pt; text-decoration:underline;}
//-->
</style>
<script language=javascript>
function updateData(){

var form=document.form;

	if(form.writer.value==''){
		alert('�ۼ��ڸ��� �Է��ϼ���!');
		form.writer.focus();
		return;
	}
	if(form.sdate.value==''){
		alert('�������� �Է��ϼ���!');
		form.sdate.focus();
		return;
	}
	if(form.edate.value==''){
		alert('�������� �Է��ϼ���!');
		form.edate.focus();
		return;
	}
	if(form.sdate.value>form.edate.value){
		alert('�������� �����Ϻ��� Ů�ϴ�!');
		form.sdate.focus();
		return;
	}
	if(form.title.value=='')	{
		alert('������ �Է��ϼ���!');
		form.title.focus();
		return;
	}
	if(form.content.value==''){
		alert('������ �Է��ϼ���!');
		form.content.focus();
		return;
	}
	form.action = './update.php';
	form.submit()
}

function deleteData(){
	var str = confirm("����Ÿ�� ���� �Ͻõ˴ϴ�.?\n\n��� �Ͻðڽ��ϱ�?");
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
	<td bgcolor='#6699CC' height='30'>&nbsp;&nbsp; ��缱 �̾߱� > �۾���</td></tr>
</table>
-->

<table border=0 cellpadding=1 cellspacing=1 align=center width=530 >
<tr>
	<td bgcolor=#6699CC align=center width='100'>�ۼ���</td>
	<td>
		<input type=text size='22' name='writer' maxlength='20' style="border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->writer?>'></td></tr>
<tr>
	<td bgcolor=#6699CC align=center width='100'>�����з�</td>
	<td>
		<select name="group_id">
<?
	for($i=0; $i<$total; $i++){
		$row2 = mysql_fetch_object($res2);			//�� ���� ��ü���÷� �����´�
?>
			<option value="<?=$row2->group_id?>" <? if ($group_id==$row2->group_id){ ?>selected<? }?>><?=$row2->group_name?></option>

<?
	}
?>
		</select>
	</td></tr>
<tr>
	<td bgcolor=#6699CC align=center width='100'>����</td>
	<td>
		<select name="area_id">
<?
	for($i=0; $i<$total3; $i++){
		$row3 = mysql_fetch_object($res3);			//�� ���� ��ü���÷� �����´�
?>
			<option value="<?=$row3->area_id?>" <? if ($area_id==$row3->area_id){ ?>selected<? }?>><?=$row3->area_name?></option>
<?
	}
?>
		</select>
	</td></tr>	
<tr>
	<td bgcolor=#6699CC align=center width='100'>ǥ����ġ</td>
	<td>
		<select name="view_loc">
<?
	for($i=1; $i<=6; $i++){
?>
			<option value="<?=$i?>" <? if ($i==$row->view_loc){ ?>selected<? }?>><?=$i?></option>

<?
	}
?>
		</select>&nbsp;������Ͻ� ��ġ�� �ʰ� ����
	</td></tr>
<tr>
	<td bgcolor=#6699CC align=center width='100'>������</td>
	<td>
		<input type=text size='12' name='sdate' maxlength='8' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->sdate?>'>&nbsp;��) 20140408</td></tr>
<tr>
	<td bgcolor=#6699CC align=center width='100'>������</td>
	<td>
		<input type=text size='12' name='edate' maxlength='8' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->edate?>'>&nbsp;��) 20140408</td></tr>
<tr>
	<td bgcolor=#6699CC align=center width='100'>�� ��</td>
	<td>
		<input type=text size='42' name='title' maxlength='50' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->title?>'></td></tr>
<tr>
	<td bgcolor=#6699CC align=center>�� ��</td>
	<td><textarea name=content rows='8' cols='49' style="border-width:1; border-color:#6d6d6d;border-style:solid;"><?=$row->content?></textarea></td></tr>
</table>
<div align='right'>
<? if($uid != ''){ ?>
<!--
	<input type=button onclick='replyData()' value='�� ��'style="background-color:#FFF0F5;border-width:1; border-style:solid;">&nbsp;
-->
	<input type=button onclick='updateData()' value='�� ��'style="background-color:#FFF0F5;border-width:1; border-style:solid;">&nbsp;
	<input type=button onclick='deleteData()' value='�� ��'style="background-color:#FFF0F5 ;border-width:1; border-style:solid;">&nbsp;

<?}else{?>

	<input type='button' onclick='check()' value=' �� �� 'style="background-color:#FFF0F5;border-width:1; border-style:solid;">&nbsp;
	
<?}?>

<input type=button onclick="javascript:window.close();" value='close' style="background-color:#FFF0F5;border-width:1; border-style:solid;">
&nbsp;
</div>
</form>
</body>
</html>