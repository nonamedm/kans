<?
include "../dbconn.inc";


if($uid !=''){
	$sql="select * from sec_board where uid=$uid";
	$res=mysql_query($sql);
	$row=mysql_fetch_object($res);
	$fid = $row->fid;
	$thread = $row->thread;
}
?>
<html>
<head>
<title>�۾���</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<style TYPE="text/css">
<!--
td {font-family:����; font-size:9pt; text-decoration:none}
table {font-family:����; font-size:10pt; text-decoration:none}
A:link { font-size:10pt; font-face:"����"; text-decoration:none;}
A:visited { font-size:10pt; font-face:"����"; text-decoration:none;}
A:hover  { font-size:10pt; text-decoration:underline;}
//.style1 {color: #FFFFFF}
.style1 {color: #FFFFFF}
.style2 {color: #FF0000}
-->
</style>
<script language=javascript>
function updateData(){

var form=document.form;

	if(form.writer.value==''){
		alert('�ۼ��ڸ��� �Է��ϼ���!');
		form.writer.focus();
		return;
	}
/**
	if(form.pass_1.value==''){
		alert('��й�ȣ�� �Է��ϼ���!');
		form.pass_1.focus();
		return;
	}

	if(form.pass_1.value.length < 4 || form.pass_1.value.length > 12){
		alert('��й�ȣ�� 4 ~ 12�ڸ� ���̷� �Է��ϼ���!');
		form.pass_1.focus();
		return;
	}

	if(form.pass_1.value !=form.pass_2.value ){
		alert('��й�ȣ�� ���� �����ϴ�!');
		form.pass_2.focus();
		return;
	}
**/
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


function replyData(){
var form=document.form;

	if(form.writer.value==''){
		alert('�ۼ��ڸ��� �Է��ϼ���!');
		form.writer.focus();
		return;
	}
/**
	if(form.pass_1.value==''){
		alert('��й�ȣ�� �Է��ϼ���!');
		form.pass_1.focus();
		return;
	}

	if(form.pass_1.value.length < 4 || form.pass_1.value.length > 12){
		alert('��й�ȣ�� 4 ~ 12�ڸ� ���̷� �Է��ϼ���!');
		form.pass_1.focus();
		return;
	}

	if(form.pass_1.value !=form.pass_2.value ){
		alert('��й�ȣ�� ���� �����ϴ�!');
		form.pass_2.focus();
		return;
	}
**/
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
	form.action = './reply.php';
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
<input type=hidden name='fid' value='<?=$fid?>'>
<input type=hidden name='thread' value='<?=$thread?>'>
<!--
<table border=0 cellpadding=1 cellspacing=1 align=center width=530 >
<tr>
	<td bgcolor='#6699CC' height='30'>&nbsp;&nbsp; ��缱 �̾߱� > �۾���</td></tr>
</table>
-->

<table border=0 cellpadding=1 cellspacing=1 align=center width=530 >
<tr>
	<td width='100' height="25" align=center bgcolor=#6699CC><span class="style1">�ۼ���</span></td>
	<td height="25">
	  <input type=text size='22' name='writer' maxlength='20' style="border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->writer?>'></td></tr>
		<tr>
	<td width='100' height="25" align=center bgcolor=#6699CC><span class="style1">�����ڵ�</span></td>
	<td height="25"><label>
		<select name="sec_code">
		<? 
		$sqls="select * from sec_code";
		$ress=mysql_query($sqls);
		$total=mysql_affected_rows();

		for($i=0; $i<$total; $i++){
			$rows = mysql_fetch_object($ress); ?>
			<option value="<?=$rows->sec_code?>" <? if ($rows->sec_code==$row->sec_code){ ?>selected<? }else{ ?> <? } ?>><?=$rows->sec_code?>: <?=$rows->sec_memo?></option>
		  <?
	$n = $n-1;
}
?>
	    </select>
	  </label></td></tr>
<tr>
	<td width='100' height="25" align=center bgcolor=#6699CC><span class="style1">��������</span></td>
	<td height="25">
      <input name="sec_chk" type="radio" value="0" <? if ($row->sec_chk==0){ ?>checked<? }else{ ?> <? } ?>>
      ����� &nbsp;
	  <input type="radio" name="sec_chk" value="1" <? if ($row->sec_chk==1){ ?>checked<? }else{ ?> <? } ?>>
      ���� &nbsp;
	  <input type="radio" name="sec_chk" value="2" <? if ($row->sec_chk==2){ ?>checked<? }else{ ?> <? } ?>>
      ���� &nbsp;
	  </td>
</tr>
<tr>
	<td width='100' height="25" align=center bgcolor=#6699CC><span class="style1">�� ��</span></td>
	<td height="25">
	  <input type=text size='42' name='title' maxlength='50' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->title?>'></td></tr>
<tr>
	<td bgcolor=#6699CC align=center><span class="style1">�� ��</span></td>
	<td><textarea name=content rows='10' cols='49' style="border-width:1; border-color:#6d6d6d;border-style:solid;"><?=$row->content?></textarea></td></tr>
<tr>
	<td bgcolor=#6699CC align=center width='100'><span class="style1">�� ��</span></td>
	<td height="50">
		<span class="style2">���ϸ��� �ݵ�� <strong>����</strong>�� ���ֽʽÿ�. </span>
	  <input type='file' size='36' name='boardfile' maxlength='50' style="border-width:1;border-color:#6d6d6d; border-style:solid;"></td>
</tr>
</table>
<br>

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

<input type=button onClick="javascript:window.close();" value='close' style="background-color:#FFF0F5;border-width:1; border-style:solid;">
&nbsp;
</div>
</form>
</body>
</html>