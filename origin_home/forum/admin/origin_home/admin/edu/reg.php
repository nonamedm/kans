<?
if(!$cid){
	echo"<meta http-equiv=\"Refresh\" content=\"0 ; URL='../index.php'\">";
	exit;
}
include "../dbconn.inc";

if($_head_php_excuted) return;
if(!eregi($HTTP_HOST,$HTTP_REFERER)) Error("���������� �����Ͽ� �ֽñ� �ٶ��ϴ�.");
if(eregi(":\/\/",$dir)) $dir=".";

$sql="SELECT * FROM edu_member order by name desc";
$res=mysql_query($sql);
$total=mysql_affected_rows();

if ($id!=''){
	$sql="SELECT * FROM edu_member where id = '".$id."'";
	$ress=mysql_query($sql);
	$row = mysql_fetch_object($ress);
}
$now=mktime();
$now=date(Y.'.'.m.'.'.d,$now);
$y=date(Y);
$m=date(m);
$d=date(d);

?>

<html>
<head>
<title>:::: Secure ::::</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link rel="stylesheet" href="../style.css" type="text/css">
<script language=javascript>
function check(){

var form=document.form;

	if(form.company1.value==''){
		alert('������� �Է��ϼ���!');
		form.company1.focus();
		return;
	}
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
	form.submit()
}

function startUp(){
	document.form.name.focus();
}
</script>
<script language="javascript">
function update(){
	var str = confirm("��������ڸ� ���� �ϽðԵ˴ϴ�.?\n\n��� �Ͻðڽ��ϱ�?");
	if (str)	document.location.href="./update.php?id=<?=$id?>";
}
function deleteData(){
	var str = confirm("��������ڸ� ���� �ϽðԵ˴ϴ�.?\n\n��� �Ͻðڽ��ϱ�?");
	if (str)	document.location.href="./delete.php?id=<?=$id?>";
}
</script>
<style type="text/css">
<!--
.style2 {color: #FFFFFF}
-->
</style>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<br>
	<table width="750" height="135" border="0" cellpadding="2" cellspacing="2" hspace="2" vspace="2">
		<tr>
		<td height="25">
		  <div align="center">
		    <!-- �޴����� -->
		    <? include("menu.php");?>
		    <!-- �޴����� -->
	        </div></td>
		</tr>
		<tr>
		  <td>
		  <form name='form' action='reg_write.php' method='post'>
			<input type='hidden' name='id' value='<?=$id?>'>
<table width="730" border="0" align="center">
  <tr>
    <td width="278">�� ��������� <? if($id != ''){ ?>����<? }else{ ?>�űԵ�� <? }?>  // ��:
      <?=$total?>
      ��</td>
    <td width="420"><div align="right"><a href='reg.php?uid='></a></div></td>
  </tr>
  <tr>
    <td colspan='2'><hr></td>
  <tr>
  <tr>
    <td colspan="2"><table width=530 border=0 align=center cellpadding=1 cellspacing=1 bgcolor="#E8E8E8" >
      <tr>
        <td height="30" colspan="2" align=center bgcolor=#6699CC><span class="style2">�� ���� ����</span></td>
        </tr>
		<tr>
        <td width='100' height="25" align=center bgcolor=#6699CC><span class="style2">������� </span></td>
        <td bgcolor="#FFFFFF"><select name="edu_type" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
          <option value="" selected></option>
		  <option value="�ű�">�ű�</option>
          <option value="����">����</option>
        </select></td>
      </tr>
		<tr>
        <td width='100' height="25" align=center bgcolor=#6699CC><span class="style2">�������� </span></td>
        <td bgcolor="#FFFFFF"><select name="type" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
          <option value="" selected></option>
          <option value="����">����</option>
		  <option value="�ű�">�ű�</option>
          <option value="����">����</option>
        </select></td>
      </tr>
		<tr>
        <td width='100' height="25" align=center bgcolor=#6699CC><span class="style2">* ����� </span></td>
        <td bgcolor="#FFFFFF"><input type=text size='50' name='company1' maxlength='50' style="border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->company1?>'></td>
      </tr>
      <tr>
        <td width='100' height="25" align=center bgcolor=#6699CC><span class="style2">�ҼӺμ�</span></td>
        <td bgcolor="#FFFFFF"><input type=text size='22' name='position' maxlength='16' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->position?>'></td>
      </tr>
	  
	  <tr>
        <td width='100' height="25" align=center bgcolor=#6699CC><span class="style2">* �� �� </span></td>
        <td bgcolor="#FFFFFF"><input type=text size='22' name='name' maxlength='16' style="border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->name?>'></td>
      </tr>
      <tr>
        <td width='100' height="25" align=center bgcolor=#6699CC><span class="style2">* �ֹε�Ϲ�ȣ</span></td>
        <td bgcolor="#FFFFFF"><input type=text size='6' name='jumin1' maxlength='6' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->jumin1?>'>
          -
          <input type=text size='6' name='jumin2' maxlength='7' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->jumin2?>'></td>
      </tr>
      <tr>
        <td width='100' height="25" align=center bgcolor=#6699CC><span class="style2">�̸���</span></td>
        <td bgcolor="#FFFFFF"><input type=text size='50' name='email' maxlength='50' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->email?>'></td>
      </tr>
      <tr>
        <td width='100' height="25" align=center bgcolor=#6699CC><span class="style2">����ó</span></td>
        <td bgcolor="#FFFFFF"><input type=text size='4' name='tel1' maxlength='4' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->tel1?>'>
        -
          <input type=text size='4' name='tel2' maxlength='4' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->tel2?>'>
          -
          <input type=text size='4' name='tel3' maxlength='4' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->tel3?>'></td>
      </tr>
    </table>
	  <table width=530 border=0 align=center cellpadding=1 cellspacing=1 bgcolor="#E8E8E8" >
        <tr>
          <td height="30" colspan="3" align=center bgcolor=#6699CC><span class="style2">�� ��� ����</span></td>
        </tr>
        <tr>
          <td width='100' height="25" colspan="2" align=center bgcolor=#6699CC><span class="style2">�����</span></td>
          <td bgcolor="#FFFFFF"><input type=text size='50' name='company2' maxlength='50' style="border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->company2?>' readonly>
&nbsp;(�� ������ �����ϰ� ����) </td>
        </tr>
        <tr>
          <td width='100' height="25" colspan="2" align=center bgcolor=#6699CC><span class="style2">��ǥ��</span></td>
          <td bgcolor="#FFFFFF"><input type=text size='22' name='ceo' maxlength='20' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->ceo?>'></td>
        </tr>
        <tr>
          <td width='100' height="25" colspan="2" align=center bgcolor=#6699CC><span class="style2">����� ��Ϲ�ȣ </span></td>
          <td bgcolor="#FFFFFF"><input type=text size='22' name='com_num' maxlength='11' style="border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->com_num?>'></td>
        </tr>
<tr>
          <td width='100' height="25" colspan="2" align=center bgcolor=#6699CC><span class="style2">����</span></td>
          <td bgcolor="#FFFFFF"><input type=text size='60' name='item' maxlength='100' style="border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->item?>'></td>
        </tr>
		<tr>
          <td width='100' height="25" colspan="2" align=center bgcolor=#6699CC><span class="style2">���� </span></td>
          <td bgcolor="#FFFFFF"><input type=text size='60' name='condition' maxlength='100' style="border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->condition?>'></td>
        </tr>
        
		<tr>
          <td width='100' height="25" colspan="2" align=center bgcolor=#6699CC><span class="style2">�� ��</span></td>
          <td bgcolor="#FFFFFF"><input type=text size='70' name='addr' maxlength='70' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->addr?>'></td>
        </tr>
        <tr>
          <td width='40' rowspan="8" align=center bgcolor=#6699CC><span class="style2">��<br>
            ��<br>��<br>��<br>
            ��<br>��<br>��<br>��</span></td>
          <td width='55' height="25" align=center bgcolor=#6699CC><span class="style2">�̸�</span></td>
          <td bgcolor="#FFFFFF"><input type=text size='22' name='a_name' maxlength='10' style="border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->a_name?>'></td>
        </tr>
        <tr>
          <td width="55" height="25" align=center bgcolor=#6699CC><span class="style2">�ҼӺμ�</span></td>
          <td height="25" bgcolor="#FFFFFF"><input type=text size='22' name='a_position' maxlength='20' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->a_position?>'></td>
        </tr>
        <tr>
          <td width="55" height="25" align=center bgcolor=#6699CC><span class="style2">�����ȣ</span></td>
          <td height="25" bgcolor="#FFFFFF"><input type=text size='4' name='a_post12' maxlength='3' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->a_post1?>'>
-
  <input type=text size='4' name='a_post22' maxlength='3' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->a_post2?>'></td>
        </tr>
        <tr>
          <td width="55" height="25" align=center bgcolor=#6699CC><span class="style2">�ּ�</span></td>
          <td height="25" bgcolor="#FFFFFF"><input type=text size='70' name='a_addr' maxlength='70' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->a_addr?>'></td>
        </tr>
		<tr>
          <td width="55" height="25" align=center bgcolor=#6699CC><span class="style2">�̸���</span></td>
          <td bgcolor="#FFFFFF"><input type=text size='50' name='a_email' maxlength='50' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->a_email?>'></td>
        </tr>
        <tr>
          <td width="55" height="25" align=center bgcolor=#6699CC><span class="style2">��ȭ</span></td>
          <td bgcolor="#FFFFFF"><input type=text size='4' name='a_tel1' maxlength='4' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->a_tel1?>'>
-
  <input type=text size='4' name='a_tel2' maxlength='4' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->a_tel2?>'>
-
<input type=text size='8' name='a_tel3' maxlength='8' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->a_tel3?>'></td>
        </tr>
        
        <tr>
          <td width="55" height="25" align=center bgcolor=#6699CC><span class="style2">�ڵ���</span></td>
          <td bgcolor="#FFFFFF"><input type=text size='4' name='a_hp1' maxlength='4' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->a_hp1?>'>
-
  <input type=text size='4' name='a_hp2' maxlength='4' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->a_hp2?>'>
-
<input type=text size='4' name='a_hp3' maxlength='4' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->a_hp3?>'></td>
        </tr>
        <tr>
          <td width="55" height="25" align=center bgcolor=#6699CC><span class="style2">FAX </span></td>
          <td bgcolor="#FFFFFF"><input type=text size='4' name='a_fax1' maxlength='4' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->a_fax1?>'>
-
  <input type=text size='4' name='a_fax2' maxlength='4' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->a_fax2?>'>
-
<input type=text size='8' name='a_fax3' maxlength='8' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->a_fax3?>'></td>
        </tr>
      </table>
	  <table width=530 border=0 align=center cellpadding=1 cellspacing=1 bgcolor="#E8E8E8" >
        <tr>
          <td height="30" colspan="3" align=center bgcolor=#6699CC><span class="style2">�� �߰� ����</span></td>
        </tr>
		<tr>
          <td width='100' height="25" align=center bgcolor=#6699CC><span class="style2">��������ȣ </span></td>
          <td colspan="2" bgcolor="#FFFFFF"><input type=text size='22' name='note_num' maxlength='8' style="border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->note_num?>'></td>
        </tr>
		 <tr>
        <td width='100' height="25" align=center bgcolor=#6699CC><span class="style2">���� ����� </span></td>
        <td bgcolor="#FFFFFF"><select name="hope_year" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
          <option value="2006" <? if ($y==2006){ ?>selected<? }else{ ?> <? } ?>>2006</option>
          <option value="2007" <? if ($y==2007){ ?>selected<? }else{ ?> <? } ?>>2007</option>
          <option value="2008" <? if ($y==2008){ ?>selected<? }else{ ?> <? } ?>>2008</option>
          <option value="2009" <? if ($y==2009){ ?>selected<? }else{ ?> <? } ?>>2009</option>
          <option value="2010" <? if ($y==2010){ ?>selected<? }else{ ?> <? } ?>>2010</option>
        </select>
��
<select name="hope_month" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
  <option value="01" <? if ($m==01){ ?>selected<? }else{ ?> <? } ?>>01</option>
  <option value="02" <? if ($m==02){ ?>selected<? }else{ ?> <? } ?>>02</option>
  <option value="03" <? if ($m==03){ ?>selected<? }else{ ?> <? } ?>>03</option>
  <option value="04" <? if ($m==04){ ?>selected<? }else{ ?> <? } ?>>04</option>
  <option value="05" <? if ($m==05){ ?>selected<? }else{ ?> <? } ?>>05</option>
  <option value="06" <? if ($m==06){ ?>selected<? }else{ ?> <? } ?>>06</option>
  <option value="07" <? if ($m==07){ ?>selected<? }else{ ?> <? } ?>>07</option>
  <option value="08" <? if ($m==08){ ?>selected<? }else{ ?> <? } ?>>08</option>
  <option value="09" <? if ($m==09){ ?>selected<? }else{ ?> <? } ?>>09</option>
  <option value="10" <? if ($m==10){ ?>selected<? }else{ ?> <? } ?>>10</option>
  <option value="11" <? if ($m==11){ ?>selected<? }else{ ?> <? } ?>>11</option>
  <option value="12" <? if ($m==12){ ?>selected<? }else{ ?> <? } ?>>12</option>
</select>
��
<select name="hope_day" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
  <option value="01" <? if ($d==01){ ?>selected<? }else{ ?> <? } ?>>01</option>
  <option value="02" <? if ($d==02){ ?>selected<? }else{ ?> <? } ?>>02</option>
  <option value="03" <? if ($d==03){ ?>selected<? }else{ ?> <? } ?>>03</option>
  <option value="04" <? if ($d==04){ ?>selected<? }else{ ?> <? } ?>>04</option>
  <option value="05" <? if ($d==05){ ?>selected<? }else{ ?> <? } ?>>05</option>
  <option value="06" <? if ($d==06){ ?>selected<? }else{ ?> <? } ?>>06</option>
  <option value="07" <? if ($d==07){ ?>selected<? }else{ ?> <? } ?>>07</option>
  <option value="08" <? if ($d==08){ ?>selected<? }else{ ?> <? } ?>>08</option>
  <option value="09" <? if ($d==09){ ?>selected<? }else{ ?> <? } ?>>09</option>
  <option value="10" <? if ($d==10){ ?>selected<? }else{ ?> <? } ?>>10</option>
  <option value="11" <? if ($d==11){ ?>selected<? }else{ ?> <? } ?>>11</option>
  <option value="12" <? if ($d==12){ ?>selected<? }else{ ?> <? } ?>>12</option>
  <option value="13" <? if ($d==13){ ?>selected<? }else{ ?> <? } ?>>13</option>
  <option value="14" <? if ($d==14){ ?>selected<? }else{ ?> <? } ?>>14</option>
  <option value="15" <? if ($d==15){ ?>selected<? }else{ ?> <? } ?>>15</option>
  <option value="16" <? if ($d==16){ ?>selected<? }else{ ?> <? } ?>>16</option>
  <option value="17" <? if ($d==17){ ?>selected<? }else{ ?> <? } ?>>17</option>
  <option value="18" <? if ($d==18){ ?>selected<? }else{ ?> <? } ?>>18</option>
  <option value="19" <? if ($d==19){ ?>selected<? }else{ ?> <? } ?>>19</option>
  <option value="20" <? if ($d==20){ ?>selected<? }else{ ?> <? } ?>>20</option>
  <option value="21" <? if ($d==21){ ?>selected<? }else{ ?> <? } ?>>21</option>
  <option value="22" <? if ($d==22){ ?>selected<? }else{ ?> <? } ?>>22</option>
  <option value="23" <? if ($d==23){ ?>selected<? }else{ ?> <? } ?>>23</option>
  <option value="24" <? if ($d==24){ ?>selected<? }else{ ?> <? } ?>>24</option>
  <option value="25" <? if ($d==25){ ?>selected<? }else{ ?> <? } ?>>25</option>
  <option value="26" <? if ($d==26){ ?>selected<? }else{ ?> <? } ?>>26</option>
  <option value="27" <? if ($d==27){ ?>selected<? }else{ ?> <? } ?>>27</option>
  <option value="28" <? if ($d==28){ ?>selected<? }else{ ?> <? } ?>>28</option>
  <option value="29" <? if ($d==29){ ?>selected<? }else{ ?> <? } ?>>29</option>
  <option value="30" <? if ($d==30){ ?>selected<? }else{ ?> <? } ?>>30</option>
  <option value="31" <? if ($d==31){ ?>selected<? }else{ ?> <? } ?>>31</option>
</select>
��  (�����) </td>
      </tr>
		<tr>
          <td width='100' height="25"align=center bgcolor=#6699CC><span class="style2">������ </span></td>
          <td width="423" height="25" bgcolor="#FFFFFF">������������ �Է��Ͽ��ּ���. </td>
		</tr>

        <tr>
          <td width='100' height="25" align=center bgcolor=#6699CC><span class="style2">������</span></td>
          <td colspan="2" bgcolor="#FFFFFF">������������ �Է��Ͽ��ּ���. </td>
        </tr>
        <tr>
          <td width='100' height="25" align=center bgcolor=#6699CC><span class="style2">��꼭��ȣ</span></td>
          <td colspan="2" bgcolor="#FFFFFF">������������ �Է��Ͽ��ּ���.</td>
        </tr>
		<tr>
          <td bgcolor=#6699CC align=center><span class="style2">�� ��</span></td>
          <td colspan="2" bgcolor="#FFFFFF"><textarea name='memo' rows='5' cols='49' style="border-width:1; border-color:#6d6d6d;border-style:solid;"><?=$row->memo?></textarea></td>
        </tr>
      </table>
	  <br>
	  <br>
<br>

<div align="center">
  <? if($id != ''){ ?>
  <input type=button onclick='update()' value='�� ��'style="background-color:#EEE0E5;border-width:1; border-style:solid;">
  &nbsp;
  <input type=button onclick='deleteData()' value='�� ��'style="background-color:#EEE0E5 ;border-width:1; border-style:solid;">
  &nbsp;
  
      <?}else{?>
  
  <input type='button' onclick='check()' value=' �� �� 'style="background-color:#FFF0F5;border-width:1; border-style:solid;">
  &nbsp;
  
      <?}?>
  
      <input type='button' onClick="javascript:history.back();" value=' �� �� ' style="background-color:#FFF0F5;border-width:1; border-style:solid;">
  &nbsp;
</div></td>
  </tr>
</table>

</form>
		  </td>
		</tr>
	</table>
</body>
</html>
