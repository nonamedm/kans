<?
include "../dbconn.inc";

if($uid !=''){
	$sql="select * from edu_rev where uid=$uid";
	$res=mysql_query($sql);
	$row=mysql_fetch_object($res);
	$group_id = $row->group_id;
}

?>
<html>
<head>
<title>���༳��</title>
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
	if(form.rsdate.value==''){
		alert('����������� �Է��ϼ���!');
		form.rsdate.focus();
		return;
	}
	if(form.redate.value==''){
		alert('������������ �Է��ϼ���!');
		form.redate.focus();
		return;
	}
	if(form.rsdate.value>form.redate.value){
		alert('����������� �����Ϻ��� Ů�ϴ�!');
		form.sdate.focus();
		return;
	}
	if(form.max_user.value=='')	{
		alert('�����ִ��ο��� �Է��ϼ���!');
		form.max_user.focus();
		return;
	}
	form.action = './rev_update.php';
	form.submit()
}

function deleteData(){
	var str = confirm("����Ÿ�� ���� �Ͻõ˴ϴ�.?\n\n��� �Ͻðڽ��ϱ�?");
	if (str)	document.location.href="./rev_delete.php?uid=<?=$uid?>";
}

function startUp(){
	document.form.max_user.focus();
}
</script>

</head>

<body leftmargin='0' topmargin='0'  onLoad='startUp();'>

<form name=form method='post' enctype="multipart/form-data">
<input type=hidden name='uid' value='<?=$uid?>'>
<!--
<table border=0 cellpadding=1 cellspacing=1 align=center width=530 >
<tr>
	<td bgcolor='#6699CC' height='30'>&nbsp;&nbsp; </td></tr>
</table>
-->

<table border=0 cellpadding=1 cellspacing=1 align=center width=530 >
<tr>
	<td bgcolor=#6699CC align=center width='100'>���������</td>
	<td>
		<input type=text size='12' name='rsdate' maxlength='8' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->rsdate?>'>&nbsp;��) 20200101</td></tr>
<tr>
	<td bgcolor=#6699CC align=center width='100'>����������</td>
	<td>
		<input type=text size='12' name='redate' maxlength='8' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->redate?>'>&nbsp;��) 20200130</td></tr>
<tr>
	<td bgcolor=#6699CC align=center width='100'>�����ִ��ο�</td>
	<td>
		<input type=text size='2' name='max_user' maxlength='2' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->max_user?>'> ��</td></tr>
<tr>
	<td bgcolor=#6699CC align=center>�� ��</td>
	<td><textarea name=content rows='8' cols='49' style="border-width:1; border-color:#6d6d6d;border-style:solid;"><?=$row->content?></textarea></td></tr>
</table>
<div align='right'>
<? if($uid != ''){ ?>
	<input type=button onclick='updateData()' value='�� ��'style="background-color:#FFF0F5;border-width:1; border-style:solid;">&nbsp;
<!--
	<input type=button onclick='deleteData()' value='�� ��'style="background-color:#FFF0F5 ;border-width:1; border-style:solid;">&nbsp;
-->

<?}else{?>

	<input type='button' onclick='check()' value=' �� �� 'style="background-color:#FFF0F5;border-width:1; border-style:solid;">&nbsp;
	
<?}?>

<input type=button onclick="javascript:window.close();" value='close' style="background-color:#FFF0F5;border-width:1; border-style:solid;">
&nbsp;
</div>
</form>
</body>
</html>