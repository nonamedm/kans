<?
include "../dbconn.inc";

$sql="select * from edu_calendar_group order by  group_id asc";
$res=mysql_query($sql);
$total=mysql_affected_rows();

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
function check(){

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
	form.submit()
}

function startUp(){
	document.form.sdate.focus();
}
</script>

</head>

<body leftmargin='0' topmargin='0'  onLoad='startUp();'>

<form name=form action='write.php' method='post' enctype="multipart/form-data">
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
		<input type=text size='22' name='writer' maxlength='20' style="border-width:1;border-color:#6d6d6d; border-style:solid;" value='������'></td></tr>
<tr>
	<td bgcolor=#6699CC align=center width='100'>�����з�</td>
	<td>
		<select name="group_id">
<?
	for($i=0; $i<$total; $i++){
		$row = mysql_fetch_object($res);			//�� ���� ��ü���÷� �����´�
?>
			<option value="<?=$row->group_id?>"><?=$row->group_name?></option>

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
			<option value="<?=$i?>"><?=$i?></option>

<?
	}
?>
		</select>&nbsp;������Ͻ� ��ġ�� �ʰ� ����
	</td></tr>
<tr>
	<td bgcolor=#6699CC align=center width='100'>������</td>
	<td>
		<input type=text size='12' name='sdate' maxlength='8' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value=''>&nbsp;��) 20140408</td></tr>
<tr>
	<td bgcolor=#6699CC align=center width='100'>������</td>
	<td>
		<input type=text size='12' name='edate' maxlength='8' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value=''>&nbsp;��) 20140408</td></tr>
<tr>
	<td bgcolor=#6699CC align=center width='100'>�� ��</td>
	<td>
		<input type=text size='42' name='title' maxlength='50' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value=''></td></tr>
<tr>
	<td bgcolor=#6699CC align=center>�� ��</td>
	<td><textarea name=content rows='8' cols='49' style="border-width:1; border-color:#6d6d6d;border-style:solid;"></textarea></td></tr>
</table>
<div align='right'>
	<input type='button' onclick='check()' value=' �� �� 'style="background-color:#FFF0F5;border-width:1; border-style:solid;">&nbsp;
	<input type=button onclick="javascript:window.close();" value='close' style="background-color:#FFF0F5;border-width:1; border-style:solid;">
&nbsp;
</div>
</form>
</body>
</html>