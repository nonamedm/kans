<?
include "../conf/connchk.inc";
include "../conf/dbconn.inc";

$sql="SELECT * FROM on_edu_member_rec where idkey = '".$id."' order by date asc";
$res=mysql_query($sql);
$total=mysql_affected_rows();

if ($id!=''){
	$sql="select A.idkey, A.name, A.jumin1, A.jumin2, A.com_id, A.part, A.tel, A.email, A.lictype, A.licnum, A.licdate, B.company from on_edu_member A, on_edu_repre B where A.com_id like B.com_id and A.idkey = '".$id."'";
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
	
	if(form.name.value==''){
		alert('�̸��� �Է��ϼ���!');
		form.name.focus();
		return;
	}
	if(form.jumin1.value==''){
		alert('�ֹε�Ϲ�ȣ�� �Է��ϼ���!');
		form.jumin1.focus();
		return;
	}
	if(form.jumin2.value==''){
		alert('�ֹε�Ϲ�ȣ�� �Է��ϼ���!');
		form.jumin2.focus();
		return;
	}
	if(form.com_name.value==''){
		alert('�Ҽӱ������ �Է��ϼ���!');
		form.com_name.focus();
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
	
	if(form.name.value==''){
		alert('�̸��� �Է��ϼ���!');
		form.name.focus();
		return;
	}
	if(form.com_name.value==''){
		alert('�Ҽӱ������ �Է��ϼ���!');
		form.com_name.focus();
		return;
	}

	var str = confirm("��������� ������ ���� �Ͻðڽ��ϱ�?");
	if (str)	form.submit()
}
function deleteData(){
	var str = confirm("��������� ������ ���� �Ͻðڽ��ϱ�?");
	if (str)	document.location.href="./member_add_cmd.php?id=<?=$id?>&mode=<?=MD5(delete)?>";
}
function searchCompany(){
	var theURL='./member_searchCom.php';
	var features='left=280,top=250,width=510,height=280,toolbars=no,menubar=no,scrollbars=yes,status=no,resizable=no';
	window.open(theURL,"",features);
}
function compModify(seq){
	var str = confirm("��������(������)�� �����Ͻðڽ��ϱ�?");
	var theURL='./member_comp_modify.php?id=<?=$id?>&seq='+seq;
	var features='left=280,top=250,width=350,height=180,toolbars=no,menubar=no,scrollbars=yes,status=no,resizable=no';
	window.open(theURL,"",features);
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
<form name='form' action='member_add_cmd.php' method='post'>
<input type='hidden' name='id' value='<?=$id?>'>
<input type='hidden' name='mode' value='<?=$mode?>'>
<input type='hidden' name='company' value='<?=$com?>'>

<table width="482" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#E8E8E8" >
  <tr>
    <td height="30" colspan="3" align="center" bgcolor="#6699CC"><span class="style4">�� ������ ���� (# �ʼ�����) </span></td>
  </tr>
  <tr>
    <td height="25" colspan="2" align="center" bgcolor="#6699CC"><span class="style2"> # �� �� </span></td>
    <td width="359" bgcolor="#FFFFFF">
		<input type="text" size='30' name='name' maxlength='40' value='<?=$row->name?>' />	</td>
  </tr>
  <tr>
    <td height="25" colspan="2" align="center" bgcolor="#6699CC"><span class="style2"># �ֹε�Ϲ�ȣ </span></td>
    <td bgcolor="#FFFFFF">
	<?
	if ($id!=''){
	?>
		<?=$row->jumin1?> - <?=$row->jumin2?>
	<? }else{ ?>
		<input type="text" size='6' name='jumin1' maxlength='6'  value='<?=$row->jumin1?>' /> - <input type="text" size='7' name='jumin2' maxlength='7'  value='<?=$row->jumin2?>' />
	<? } ?>	  </td>
  </tr>
  <tr>
    <td height="25" colspan="2" align="center" bgcolor="#6699CC"><span class="style2"># �Ҽӱ����</span></td>
    <td bgcolor="#FFFFFF"><input type="text" size='40' name='com_name' maxlength='100'  value='<?=$row->company?>' readonly/><input type="button" name="com_find" value="���ã��" onClick="searchCompany();"></td>
  </tr>
  <tr>
    <td height="25" colspan="2" align="center" bgcolor="#6699CC"><span class="style2">�� ��</span></td>
    <td bgcolor="#FFFFFF"><input type="text" size='30' name='part' maxlength='60' value='<?=$row->part?>' /></td>
  </tr>
  <tr>
    <td height="25" colspan="2" align="center" bgcolor="#6699CC"><span class="style2">����ó</span></td>
    <td bgcolor="#FFFFFF"><input type="text" size='20' name='tel' maxlength='20'  value='<?=$row->tel?>' />
      ��) 012-3456-7890 </td>
  </tr>
  
  <tr>
    <td height="25" colspan="2" align="center" bgcolor="#6699CC"><span class="style2">E-mail</span>  </td>
    <td bgcolor="#FFFFFF"><input type="text" size='60' name='email' maxlength='150'  value='<?=$row->email?>' /></td>
  </tr>
  <tr>
    <td width='52' rowspan="3" align="center" bgcolor="#6699CC"><span class="style4">      ��<br />
      ��<br />
      ��<br />��</span></td>
    <td width='61' height="25" align="center" bgcolor="#6699CC"><span class="style2">��������</span></td>
    <td height="25" bgcolor="#FFFFFF"><input type="text" size='50' name='lictype' maxlength='100'  value='<?=$row->lictype?>' /></td>
  </tr>
  <tr>
    <td width="61" height="25" align="center" bgcolor="#6699CC"><span class="style2">�����ȣ</span></td>
    <td height="25" bgcolor="#FFFFFF"><input type="text" size='22' name='licnum' maxlength='20'  value='<?=$row->licnum?>' /></td>
  </tr>
  
  <tr>
    <td width="61" height="25" align="center" bgcolor="#6699CC"><span class="style2">���������</span></td>
    <td height="25" bgcolor="#FFFFFF"><input type="text" size='20' name='licdate' maxlength='20' value='<?=$row->licdate?>' /> ��) 2010.01.01</td>
  </tr>
</table>
<br />
<table width="482" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#E8E8E8" >
  <tr>
    <td height="25" colspan="3" align="center" bgcolor="#6699CC"><div align="center"><span class="style4">�� ���� ����</span></div></td>
  </tr>
  <tr>
    <td width="144" height="25" align="center" bgcolor="#6699CC"><div align="center"><span class="style2"> �������� </span></div></td>
    <td width="192" bgcolor="#6699CC"><div align="center"><span class="style2"> �������� </span></div></td>
    <td width="136" bgcolor="#6699CC"><div align="center"><span class="style2"> �����ȣ </span></div>      <div align="center"></div></td>
    </tr>
<?
	if ($id!=''){ //�űԵ�Ͻ� ��� �� �� ����
		if($total<1){
			echo" <tr><td height='25' colspan='4' align='center' bgcolor='#FFFFFF'>��ϵ� ���������� �����ϴ�.</td></tr>";
		}
								
		for($i=0; $i<$total; $i++){
			$row = mysql_fetch_object($res);			//�� ���� ��ü���÷� �����´�
?>
	  <tr>
		<td height="25" align="center" bgcolor="#FFFFFF">
	    <?=$row->regdate?>
	    <input name="comp_modifybtn" type="button" onclick="compModify('<?=$row->seq?>');" value="�� ��" /></td>
		<td height="25" align="center" bgcolor="#FFFFFF"><?=$row->type?></td>
		<td height="25" align="center" bgcolor="#FFFFFF"><?=$row->ccode?></td>
	  </tr>
<? 
		}
	}else{	//���������� ��� �� �� ����
  
		
?>
	  
	  <tr>
        <td height="25" colspan="3" align="center" bgcolor="#FFFFFF">�������� ����� ���� ������ ���� ��� �Ͻ� �� �ֽ��ϴ�. </td>
      </tr>
<?
  		
   } 
?>
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