<?
include "../conf/connchk.inc";
include "../conf/dbconn.inc";

if ($id!=''){
	$sql="SELECT * FROM on_edu_data where datacode = '".$id."'";
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
	
	if(form.title.value==''){
		alert('������ �Է��ϼ���!');
		form.title.focus();
		return;
	}
	if(form.type.value==''){
		alert('�뵵�� �����ϼ���!');
		form.type.focus();
		return;
	}
	if(form.comm.value==''){
		alert('�������¸� �����ϼ���!');
		form.comm.focus();
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
	
	if(form.title.value==''){
		alert('������ �Է��ϼ���!');
		form.title.focus();
		return;
	}
	if(form.type.value==''){
		alert('�뵵�� �����ϼ���!');
		form.type.focus();
		return;
	}
	if(form.comm.value==''){
		alert('�������¸� �����ϼ���!');
		form.comm.focus();
		return;
	}

	var str = confirm("�����ڷḦ ���� �Ͻðڽ��ϱ�?");
	if (str)	form.submit()
}
function deleteData(){
	var str = confirm("�����ڷḦ ���� �Ͻðڽ��ϱ�?");
	if (str)	document.location.href="./data_add_cmd.php?id=<?=$id?>&mode=<?=MD5(delete)?>";
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
<form name='form' action='data_add_cmd.php' method='post'>
<input type='hidden' name='id' value='<?=$id?>'>
<input type='hidden' name='mode' value='<?=$mode?>'>
<table width="482" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#E8E8E8" >
  <tr>
    <td height="30" colspan="2" align="center" bgcolor="#6699CC"><span class="style4">�� ���� �ڷ� (# �ʼ�����) </span></td>
  </tr>
  <tr>
    <td width="85" height="25" align="center" bgcolor="#6699CC"><span class="style2"> # ����</span></td>
    <td width="390" bgcolor="#FFFFFF">
	  <input type="text" size='30' name='title' maxlength='40' value='<?=$row->title?>' />	</td>
  </tr>
  <tr>
    <td height="25" align="center" bgcolor="#6699CC"><span class="style2"># �뵵 </span></td>
    <td bgcolor="#FFFFFF"><select name="type">
      <option value="" <? if ($row->type==''){ ?>selected<? }else{ ?> <? } ?>></option>
      <option value="�Ϲ� �����ڱ���" <? if ($row->type=='�Ϲ� �����ڱ���'){ ?>selected<? }else{ ?> <? } ?>>�Ϲ� �����ڱ���</option>
      <option value="�ű� �����ڱ���" <? if ($row->type=='�ű� �����ڱ���'){ ?>selected<? }else{ ?> <? } ?>>�ű� �����ڱ���</option>
      <option value="������ ��������" <? if ($row->type=='������ ��������'){ ?>selected<? }else{ ?> <? } ?>>������ ��������</option>
    </select></td>
  </tr>
  <tr>
    <td height="25" align="center" bgcolor="#6699CC"><span class="style2"># ���� </span></td>
    <td bgcolor="#FFFFFF"><select name="comm">
      <option value="" <? if ($row->comm==''){ ?>selected<? }else{ ?> <? } ?>></option>
      <option value="����" <? if ($row->comm=='����'){ ?>selected<? }else{ ?> <? } ?>>����</option>
      <option value="����" <? if ($row->comm=='����'){ ?>selected<? }else{ ?> <? } ?>>����</option>
    </select></td>
  </tr>
  <tr>
    <td height="25" align="center" bgcolor="#6699CC"><span class="style2">���ϸ�</span></td>
    <td bgcolor="#FFFFFF"><input type="text" size='30' name='url' maxlength='200' value='<?=$row->url?>' /> 
	<br />	
	- ��) test.mp3, test.ppt (��ҹ��ڱ��� �� ��������) <br />
	- ���ε� ��ġ) ����:/www/edu/pds/pdf, ����(��Ʈ���ּ���: kans2):/audio</td>
  </tr>
  <tr>
    <td height="25" align="center" bgcolor="#6699CC"><span class="style2">����</span></td>
    <td bgcolor="#FFFFFF">
      <label>
      <textarea name="etc" cols="50" rows="4"><?=$row->etc?></textarea>
      </label></td>
  </tr>
</table>
<br />
<table width="367" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><div align="center">
      <? if($id != ''){ ?>
		  <input name="button" type="button" onclick='update()' value='�� ��' />
		  &nbsp;
		  <input name="button" type="button" onclick='deleteData()' value='�� ��' />
		  &nbsp;
		  <?}else{?>
		  <input name="button" type='button' onclick='check()' value=' �� �� ' />
		  &nbsp;
	  <?}?>
  <input name="button" type='button' onclick="javascript:window.close();" value=' �� �� ' />
  &nbsp; </div></td>
  </tr>
</table>
</form>
</body>
</html>
<?
include "../conf/dbconn_close.inc";
?>