<?
include "../dbconn.inc";

if($_head_php_excuted) return;
if(!eregi($HTTP_HOST,$HTTP_REFERER)) Error("���������� �����Ͽ� �ֽñ� �ٶ��ϴ�.");
if(eregi(":\/\/",$dir)) $dir=".";

$sql="SELECT * FROM edu_schedule order by year desc";
$res=mysql_query($sql);
$total=mysql_affected_rows();

if ($id!=''){
	$sql="SELECT * FROM edu_schedule where id = '".$id."'";
	$ress=mysql_query($sql);
	$row = mysql_fetch_object($ress);
}

?>

<html>
<head>
<title>:::: Secure ::::</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link rel="stylesheet" href="../style.css" type="text/css">
<script language=javascript>
function check(){

var form=document.form;

	if(form.year.value==''){
		alert('���ڸ� �Է��ϼ���!');
		form.year.focus();
		return;
	}
	if(form.month.value==''){
		alert('���ڸ� �Է��ϼ���!');
		form.month.focus();
		return;
	}
	if(form.day.value==''){
		alert('���ڸ� �Է��ϼ���!');
		form.day.focus();
		return;
	}
	if(form.title.value==''){
		alert('���������� �Է��ϼ���!');
		form.title.focus();
		return;
	}
	form.submit()
}

function startUp(){
	document.form.name.focus();
}

function deleteData(){
	var str = confirm("���������� ���� �Ͻðڽ��ϱ�?\n\n ��ϵ� �������鵵 �Բ� �����˴ϴ�.");
	if (str)	document.location.href="./sch_delete.php?id=<?=$id?>&page=<?=$page?>&search=<?=$search?>&keyword=<?=$keyword?>";
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
		  <form name='form' action='sch_update.php' method='post' enctype="multipart/form-data">
			<input type='hidden' name='id' value='<?=$id?>'>
			<input type='hidden' name='page' value='<?=$page?>'>
			<input type='hidden' name='search' value='<?=$search?>'>
			<input type='hidden' name='keyword' value='<?=$keyword?>'>
<table width="730" border="0" align="center">
  <tr>
    <td width="278">�� ��������<? if($id != ''){ ?>����<? }else{ ?>�űԵ�� <? }?>  // ��:
      <?=$total?>
      ��</td>
    <td width="420"><div align="right"><a href='reg.php?uid='></a></div></td>
  </tr>
  <tr>
    <td colspan='2'><hr></td>
  <tr>
  <tr>
    <td colspan="2"><table width="665" height="56" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#999999">
      <tr>
        <td bgcolor="#F3F3F3">&nbsp;Tip1. ���ó�¥ �������� ���������� �������� �������°� '����'���� ����Ǿ �ۿ����� ������ �Ұ��� ���°� �˴ϴ�.
          <br>&nbsp;Tip2. ��ϵ� �ڷ���� ����ڷ���� �����ϰ� ���ּ���.
          <br>&nbsp;Tip3. �ڷ�(����)�̸��� Ư�����ڰ� ������ ���ּ���~  
		  <br>
		  &nbsp;Tip4. ����������� ��Ʈ���ּ����� FTP�� audio������ �����ø��ð� ���ϸ��� �̰����� �Է��� �ֽø� �˴ϴ�.
		  </td>
      </tr>
    </table><br>
    <table width=600 border=0 align=center cellpadding=1 cellspacing=1 bgcolor="#6699CC" >
      <tr>
        <td width='102' height="25" align=center bgcolor=#6699CC><span class="style2">�������� </span></td>
        <td colspan="2" bgcolor="#FFFFFF">&nbsp; 
		 <select name="edu_state" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
            <option value="0" <? if ($row->edu_state==0){ ?>selected<? }else{ ?> <? } ?>>����</option>
			<option value="1" <? if ($row->edu_state==1){ ?>selected<? }else{ ?> <? } ?>>����</option>
			<option value="2" <? if ($row->edu_state==2){ ?>selected<? }else{ ?> <? } ?>>����</option>
          </select></td>
      </tr>
	  <tr>
        <td width='102' height="25" align=center bgcolor=#6699CC><span class="style2">�������� </span></td>
        <td colspan="2" bgcolor="#FFFFFF">&nbsp; 
		 <select name="edu_type" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
            <option value="�ű�" <? if ($row->edu_type=='�ű�'){ ?>selected<? }else{ ?> <? } ?>>�ű�</option>
			<option value="����" <? if ($row->edu_type=='����'){ ?>selected<? }else{ ?> <? } ?>>����</option>
          </select></td>
      </tr>
	  <tr>
        <td width='102' height="25" align=center bgcolor=#6699CC><span class="style2">�� �� </span></td>
        <td colspan="2" bgcolor="#FFFFFF">&nbsp; 
		 <select name="year" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
            <option value="" <? if ($row->year==""){ ?>selected<? }else{ ?> <? } ?>>-</option>
			<option value="2006" <? if ($row->year=='2006'){ ?>selected<? }else{ ?> <? } ?>>2006</option>
			<option value="2007" <? if ($row->year=='2007'){ ?>selected<? }else{ ?> <? } ?>>2007</option>
			<option value="2008" <? if ($row->year=='2008'){ ?>selected<? }else{ ?> <? } ?>>2008</option>
			<option value="2009" <? if ($row->year=='2009'){ ?>selected<? }else{ ?> <? } ?>>2009</option>
			<option value="2010" <? if ($row->year=='2010'){ ?>selected<? }else{ ?> <? } ?>>2010</option>
          </select>
        ��
          <select name="month" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
            <option value="" <? if ($row->month==""){ ?>selected<? }else{ ?> <? } ?>>-</option>
			<option value="01" <? if ($row->month=='01'){ ?>selected<? }else{ ?> <? } ?>>01</option>
			<option value="02" <? if ($row->month=='02'){ ?>selected<? }else{ ?> <? } ?>>02</option>
			<option value="03" <? if ($row->month=='03'){ ?>selected<? }else{ ?> <? } ?>>03</option>
			<option value="04" <? if ($row->month=='04'){ ?>selected<? }else{ ?> <? } ?>>04</option>
			<option value="05" <? if ($row->month=='05'){ ?>selected<? }else{ ?> <? } ?>>05</option>
			<option value="06" <? if ($row->month=='06'){ ?>selected<? }else{ ?> <? } ?>>06</option>
			<option value="07" <? if ($row->month=='07'){ ?>selected<? }else{ ?> <? } ?>>07</option>
			<option value="08" <? if ($row->month=='08'){ ?>selected<? }else{ ?> <? } ?>>08</option>
			<option value="09" <? if ($row->month=='09'){ ?>selected<? }else{ ?> <? } ?>>09</option>
			<option value="10" <? if ($row->month=='10'){ ?>selected<? }else{ ?> <? } ?>>10</option>
			<option value="11" <? if ($row->month=='11'){ ?>selected<? }else{ ?> <? } ?>>11</option>
			<option value="12" <? if ($row->month=='12'){ ?>selected<? }else{ ?> <? } ?>>12</option>
          </select>
          ��
          <? $dd = $row->day ?>
		  <select name="day" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
            <option value="" <? if ($dd == "") echo "selected"; ?>>-</option>
            <option value="01" <? if ($dd == '01') echo "selected"; ?>>01</option>
            <option value="02" <? if ($dd == '02') echo "selected"; ?>>02</option>
            <option value="03" <? if ($dd == '03') echo "selected"; ?>>03</option>
            <option value="04" <? if ($dd == '04') echo "selected"; ?>>04</option>
            <option value="05" <? if ($dd == '05') echo "selected"; ?>>05</option>
            <option value="06" <? if ($dd == '06') echo "selected"; ?>>06</option>
            <option value="07" <? if ($dd == '07') echo "selected"; ?>>07</option>
            <option value="08" <? if ($dd == '08') echo "selected"; ?>>08</option>
            <option value="09" <? if ($dd == '09') echo "selected"; ?>>09</option>
            <option value="10" <? if ($dd == '10') echo "selected"; ?>>10</option>
            <option value="11" <? if ($dd == '11') echo "selected"; ?>>11</option>
            <option value="12" <? if ($dd == '12') echo "selected"; ?>>12</option>
            <option value="13" <? if ($dd == '13') echo "selected"; ?>>13</option>
            <option value="14" <? if ($dd == '14') echo "selected"; ?>>14</option>
            <option value="15" <? if ($dd == '15') echo "selected"; ?>>15</option>
            <option value="16" <? if ($dd == '16') echo "selected"; ?>>16</option>
            <option value="17" <? if ($dd ==' 17') echo "selected"; ?>>17</option>
			<option value="18" <? if ($dd == '18') echo "selected"; ?>>18</option>
            <option value="19" <? if ($dd == '19') echo "selected"; ?>>19</option>
            <option value="20" <? if ($dd == '20') echo "selected"; ?>>20</option>
            <option value="21" <? if ($dd == '21') echo "selected"; ?>>21</option>
            <option value="22" <? if ($dd == '22') echo "selected"; ?>>22</option>
            <option value="23" <? if ($dd == '23') echo "selected"; ?>>23</option>
            <option value="24" <? if ($dd == '24') echo "selected"; ?>>24</option>
            <option value="25" <? if ($dd == '25') echo "selected"; ?>>25</option>
            <option value="26" <? if ($dd == '26') echo "selected"; ?>>26</option>
            <option value="27" <? if ($dd ==' 27') echo "selected"; ?>>27</option>
			<option value="28" <? if ($dd == '28') echo "selected"; ?>>28</option>
            <option value="29" <? if ($dd == '29') echo "selected"; ?>>29</option>
            <option value="30" <? if ($dd == '30') echo "selected"; ?>>30</option>
            <option value="31" <? if ($dd == '31') echo "selected"; ?>>31</option>
          </select>
          �� ~ 
          

<? $dd = $row->day2 ?>
		  <select name="day2" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
            <option value="" <? if ($dd == "") echo "selected"; ?>>-</option>
            <option value="01" <? if ($dd == '01') echo "selected"; ?>>01</option>
            <option value="02" <? if ($dd == '02') echo "selected"; ?>>02</option>
            <option value="03" <? if ($dd == '03') echo "selected"; ?>>03</option>
            <option value="04" <? if ($dd == '04') echo "selected"; ?>>04</option>
            <option value="05" <? if ($dd == '05') echo "selected"; ?>>05</option>
            <option value="06" <? if ($dd == '06') echo "selected"; ?>>06</option>
            <option value="07" <? if ($dd == '07') echo "selected"; ?>>07</option>
            <option value="08" <? if ($dd == '08') echo "selected"; ?>>08</option>
            <option value="09" <? if ($dd == '09') echo "selected"; ?>>09</option>
            <option value="10" <? if ($dd == '10') echo "selected"; ?>>10</option>
            <option value="11" <? if ($dd == '11') echo "selected"; ?>>11</option>
            <option value="12" <? if ($dd == '12') echo "selected"; ?>>12</option>
            <option value="13" <? if ($dd == '13') echo "selected"; ?>>13</option>
            <option value="14" <? if ($dd == '14') echo "selected"; ?>>14</option>
            <option value="15" <? if ($dd == '15') echo "selected"; ?>>15</option>
            <option value="16" <? if ($dd == '16') echo "selected"; ?>>16</option>
            <option value="17" <? if ($dd ==' 17') echo "selected"; ?>>17</option>
			<option value="18" <? if ($dd == '18') echo "selected"; ?>>18</option>
            <option value="19" <? if ($dd == '19') echo "selected"; ?>>19</option>
            <option value="20" <? if ($dd == '20') echo "selected"; ?>>20</option>
            <option value="21" <? if ($dd == '21') echo "selected"; ?>>21</option>
            <option value="22" <? if ($dd == '22') echo "selected"; ?>>22</option>
            <option value="23" <? if ($dd == '23') echo "selected"; ?>>23</option>
            <option value="24" <? if ($dd == '24') echo "selected"; ?>>24</option>
            <option value="25" <? if ($dd == '25') echo "selected"; ?>>25</option>
            <option value="26" <? if ($dd == '26') echo "selected"; ?>>26</option>
            <option value="27" <? if ($dd ==' 27') echo "selected"; ?>>27</option>
			<option value="28" <? if ($dd == '28') echo "selected"; ?>>28</option>
            <option value="29" <? if ($dd == '29') echo "selected"; ?>>29</option>
            <option value="30" <? if ($dd == '30') echo "selected"; ?>>30</option>
            <option value="31" <? if ($dd == '31') echo "selected"; ?>>31</option>
          </select>
��
<? $ss = $row->si ?>
(
<select name="si" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
            <option value="" <? if ($ss == "") echo "selected"; ?>>-</option>
            <option value="01" <? if ($ss == '01') echo "selected"; ?>>01</option>
            <option value="02" <? if ($ss == '02') echo "selected"; ?>>02</option>
            <option value="03" <? if ($ss == '03') echo "selected"; ?>>03</option>
            <option value="04" <? if ($ss == '04') echo "selected"; ?>>04</option>
            <option value="05" <? if ($ss == '05') echo "selected"; ?>>05</option>
            <option value="06" <? if ($ss == '06') echo "selected"; ?>>06</option>
            <option value="07" <? if ($ss == '07') echo "selected"; ?>>07</option>
            <option value="08" <? if ($ss == '08') echo "selected"; ?>>08</option>
            <option value="09" <? if ($ss == '09') echo "selected"; ?>>09</option>
			<option value="10" <? if ($ss == '10') echo "selected"; ?>>10</option>
            <option value="11" <? if ($ss == '11') echo "selected"; ?>>11</option>
            <option value="12" <? if ($ss == '12') echo "selected"; ?>>12</option>
            <option value="13" <? if ($ss == '13') echo "selected"; ?>>13</option>
            <option value="14" <? if ($ss == '14') echo "selected"; ?>>14</option>
            <option value="15" <? if ($ss == '15') echo "selected"; ?>>15</option>
            <option value="16" <? if ($ss == '16') echo "selected"; ?>>16</option>
            <option value="17" <? if ($ss == '17') echo "selected"; ?>>17</option>
            <option value="18" <? if ($ss == '18') echo "selected"; ?>>18</option>
            <option value="19" <? if ($ss == '19') echo "selected"; ?>>19</option>
			<option value="20" <? if ($ss == '20') echo "selected"; ?>>20</option>
            <option value="21" <? if ($ss == '21') echo "selected"; ?>>21</option>
            <option value="22" <? if ($ss == '22') echo "selected"; ?>>22</option>
            <option value="23" <? if ($ss == '23') echo "selected"; ?>>23</option>
            <option value="24" <? if ($ss == '24') echo "selected"; ?>>24</option>
          </select>
��
<? $bb = $row->bun ?>
<select name="bun" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
  <option value="" <? if ($bb == "") echo "selected"; ?>>-</option>
  <option value="00" <? if ($bb == '00') echo "selected"; ?>>00</option>
  <option value="05" <? if ($bb == '05') echo "selected"; ?>>05</option>
  <option value="10" <? if ($bb == '10') echo "selected"; ?>>10</option>
  <option value="15" <? if ($bb == '15') echo "selected"; ?>>15</option>
  <option value="20" <? if ($bb == '20') echo "selected"; ?>>20</option>
  <option value="25" <? if ($bb == '25') echo "selected"; ?>>25</option>
  <option value="30" <? if ($bb == '30') echo "selected"; ?>>30</option>
  <option value="35" <? if ($bb == '35') echo "selected"; ?>>35</option>
  <option value="40" <? if ($bb == '40') echo "selected"; ?>>40</option>
  <option value="45" <? if ($bb == '45') echo "selected"; ?>>45</option>
  <option value="50" <? if ($bb == '50') echo "selected"; ?>>50</option>
  <option value="55" <? if ($bb == '55') echo "selected"; ?>>55</option>
</select>
��)</td>
      </tr>
      <tr>
        <td width='102' height="25" align=center bgcolor=#6699CC><span class="style2">��������</span></td>
        <td colspan="2" bgcolor="#FFFFFF">&nbsp; <input type=text size='50' name='title' maxlength='50' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->title?>'></td>
      </tr>
	  <tr bgcolor="#6699CC">
        <td height="25" colspan="3" align=center><span class="style2">�� ��ϵ� �ڷ� (��ϵ� �ڷ� ���� ��ϵ� �ڷ���� �����ؾ� �մϴ�.) </span></td>
        </tr>
	  <tr bgcolor="#6699CC">
	    <td height="25" align=center><span class="style2">��ϵ� �ڷ� ��</span></td>
	    <td height="25" colspan="2" align=center bgcolor="#FFFFFF"><div align="left">&nbsp;<? $bb = $row->s_point ?><select name="s_point" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
  <option value="" <? if ($bb == "") echo "selected"; ?>>-</option>
  <option value="1" <? if ($bb == '1') echo "selected"; ?>>01</option>
  <option value="2" <? if ($bb == '2') echo "selected"; ?>>02</option>
  <option value="3" <? if ($bb == '3') echo "selected"; ?>>03</option>
  <option value="4" <? if ($bb == '4') echo "selected"; ?>>04</option>
  <option value="5" <? if ($bb == '5') echo "selected"; ?>>05</option>
  <option value="6" <? if ($bb == '6') echo "selected"; ?>>06</option>
</select>
	    ��
	    </div></td>
	    </tr>
		<tr>
        <td width='102' height="25" rowspan="2" align=center bgcolor=#6699CC><span class="style2">��ϵ� �ڷ� 1</span></td>
        <td width="314" height="25" bgcolor="#FFFFFF">&nbsp; ���½ð� 1: 
<? $dd = $row->d01 ?>
		  <select name="d01" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
            <option value="" <? if ($dd == "") echo "selected"; ?>>-</option>
            <option value="01" <? if ($dd == '01') echo "selected"; ?>>01</option>
            <option value="02" <? if ($dd == '02') echo "selected"; ?>>02</option>
            <option value="03" <? if ($dd == '03') echo "selected"; ?>>03</option>
            <option value="04" <? if ($dd == '04') echo "selected"; ?>>04</option>
            <option value="05" <? if ($dd == '05') echo "selected"; ?>>05</option>
            <option value="06" <? if ($dd == '06') echo "selected"; ?>>06</option>
            <option value="07" <? if ($dd == '07') echo "selected"; ?>>07</option>
            <option value="08" <? if ($dd == '08') echo "selected"; ?>>08</option>
            <option value="09" <? if ($dd == '09') echo "selected"; ?>>09</option>
            <option value="10" <? if ($dd == '10') echo "selected"; ?>>10</option>
            <option value="11" <? if ($dd == '11') echo "selected"; ?>>11</option>
            <option value="12" <? if ($dd == '12') echo "selected"; ?>>12</option>
            <option value="13" <? if ($dd == '13') echo "selected"; ?>>13</option>
            <option value="14" <? if ($dd == '14') echo "selected"; ?>>14</option>
            <option value="15" <? if ($dd == '15') echo "selected"; ?>>15</option>
            <option value="16" <? if ($dd == '16') echo "selected"; ?>>16</option>
            <option value="17" <? if ($dd ==' 17') echo "selected"; ?>>17</option>
			<option value="18" <? if ($dd == '18') echo "selected"; ?>>18</option>
            <option value="19" <? if ($dd == '19') echo "selected"; ?>>19</option>
            <option value="20" <? if ($dd == '20') echo "selected"; ?>>20</option>
            <option value="21" <? if ($dd == '21') echo "selected"; ?>>21</option>
            <option value="22" <? if ($dd == '22') echo "selected"; ?>>22</option>
            <option value="23" <? if ($dd == '23') echo "selected"; ?>>23</option>
            <option value="24" <? if ($dd == '24') echo "selected"; ?>>24</option>
            <option value="25" <? if ($dd == '25') echo "selected"; ?>>25</option>
            <option value="26" <? if ($dd == '26') echo "selected"; ?>>26</option>
            <option value="27" <? if ($dd ==' 27') echo "selected"; ?>>27</option>
			<option value="28" <? if ($dd == '28') echo "selected"; ?>>28</option>
            <option value="29" <? if ($dd == '29') echo "selected"; ?>>29</option>
            <option value="30" <? if ($dd == '30') echo "selected"; ?>>30</option>
            <option value="31" <? if ($dd == '31') echo "selected"; ?>>31</option>
          </select>
��
<? $ss = $row->si1 ?>
<select name="si1" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
            <option value="" <? if ($ss == "") echo "selected"; ?>>-</option>
            <option value="01" <? if ($ss == '01') echo "selected"; ?>>01</option>
            <option value="02" <? if ($ss == '02') echo "selected"; ?>>02</option>
            <option value="03" <? if ($ss == '03') echo "selected"; ?>>03</option>
            <option value="04" <? if ($ss == '04') echo "selected"; ?>>04</option>
            <option value="05" <? if ($ss == '05') echo "selected"; ?>>05</option>
            <option value="06" <? if ($ss == '06') echo "selected"; ?>>06</option>
            <option value="07" <? if ($ss == '07') echo "selected"; ?>>07</option>
            <option value="08" <? if ($ss == '08') echo "selected"; ?>>08</option>
            <option value="09" <? if ($ss == '09') echo "selected"; ?>>09</option>
			<option value="10" <? if ($ss == '10') echo "selected"; ?>>10</option>
            <option value="11" <? if ($ss == '11') echo "selected"; ?>>11</option>
            <option value="12" <? if ($ss == '12') echo "selected"; ?>>12</option>
            <option value="13" <? if ($ss == '13') echo "selected"; ?>>13</option>
            <option value="14" <? if ($ss == '14') echo "selected"; ?>>14</option>
            <option value="15" <? if ($ss == '15') echo "selected"; ?>>15</option>
            <option value="16" <? if ($ss == '16') echo "selected"; ?>>16</option>
            <option value="17" <? if ($ss == '17') echo "selected"; ?>>17</option>
            <option value="18" <? if ($ss == '18') echo "selected"; ?>>18</option>
            <option value="19" <? if ($ss == '19') echo "selected"; ?>>19</option>
			<option value="20" <? if ($ss == '20') echo "selected"; ?>>20</option>
            <option value="21" <? if ($ss == '21') echo "selected"; ?>>21</option>
            <option value="22" <? if ($ss == '22') echo "selected"; ?>>22</option>
            <option value="23" <? if ($ss == '23') echo "selected"; ?>>23</option>
            <option value="24" <? if ($ss == '24') echo "selected"; ?>>24</option>
          </select>
��
<? $bb = $row->bun1 ?>
<select name="bun1" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
  <option value="" <? if ($bb == "") echo "selected"; ?>>-</option>
  <option value="00" <? if ($bb == '00') echo "selected"; ?>>00</option>
  <option value="05" <? if ($bb == '05') echo "selected"; ?>>05</option>
  <option value="10" <? if ($bb == '10') echo "selected"; ?>>10</option>
  <option value="15" <? if ($bb == '15') echo "selected"; ?>>15</option>
  <option value="20" <? if ($bb == '20') echo "selected"; ?>>20</option>
  <option value="25" <? if ($bb == '25') echo "selected"; ?>>25</option>
  <option value="30" <? if ($bb == '30') echo "selected"; ?>>30</option>
  <option value="35" <? if ($bb == '35') echo "selected"; ?>>35</option>
  <option value="40" <? if ($bb == '40') echo "selected"; ?>>40</option>
  <option value="45" <? if ($bb == '45') echo "selected"; ?>>45</option>
  <option value="50" <? if ($bb == '50') echo "selected"; ?>>50</option>
  <option value="55" <? if ($bb == '55') echo "selected"; ?>>55</option>
</select>
�� </td>
		
	    <td width="174" rowspan="2" bgcolor="#FFFFFF"><div align="center">
      <input type="radio" name="pds_chk1" value="1" <? if ($row->pds_chk1==1){ ?>checked<? }else{ ?> <? } ?>>
      ���� &nbsp;
	          <input name="pds_chk1" type="radio" value="0" <? if ($row->pds_chk1==0){ ?>checked<? }else{ ?> <? } ?>>
	          ����� &nbsp;
	          <input name="pds_chk1" type="radio" value="2" <? if ($row->pds_chk1==2){ ?>checked<? }else{ ?> <? } ?>>
	          ����</div></td>
		</tr>
		<tr>
		  <td height="25" bgcolor="#FFFFFF">&nbsp; ->
            <?=$row->pds1?></td>
		  </tr>
		<tr>
        <td width='102' height="25" rowspan="2" align=center bgcolor=#6699CC><span class="style2">��ϵ� �ڷ� 2</span></td>
        <td width="314" height="25" bgcolor="#FFFFFF">&nbsp; ���½ð� 2:
<? $dd = $row->d02 ?>
		  <select name="d02" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
            <option value="" <? if ($dd == "") echo "selected"; ?>>-</option>
            <option value="01" <? if ($dd == '01') echo "selected"; ?>>01</option>
            <option value="02" <? if ($dd == '02') echo "selected"; ?>>02</option>
            <option value="03" <? if ($dd == '03') echo "selected"; ?>>03</option>
            <option value="04" <? if ($dd == '04') echo "selected"; ?>>04</option>
            <option value="05" <? if ($dd == '05') echo "selected"; ?>>05</option>
            <option value="06" <? if ($dd == '06') echo "selected"; ?>>06</option>
            <option value="07" <? if ($dd == '07') echo "selected"; ?>>07</option>
            <option value="08" <? if ($dd == '08') echo "selected"; ?>>08</option>
            <option value="09" <? if ($dd == '09') echo "selected"; ?>>09</option>
            <option value="10" <? if ($dd == '10') echo "selected"; ?>>10</option>
            <option value="11" <? if ($dd == '11') echo "selected"; ?>>11</option>
            <option value="12" <? if ($dd == '12') echo "selected"; ?>>12</option>
            <option value="13" <? if ($dd == '13') echo "selected"; ?>>13</option>
            <option value="14" <? if ($dd == '14') echo "selected"; ?>>14</option>
            <option value="15" <? if ($dd == '15') echo "selected"; ?>>15</option>
            <option value="16" <? if ($dd == '16') echo "selected"; ?>>16</option>
            <option value="17" <? if ($dd ==' 17') echo "selected"; ?>>17</option>
			<option value="18" <? if ($dd == '18') echo "selected"; ?>>18</option>
            <option value="19" <? if ($dd == '19') echo "selected"; ?>>19</option>
            <option value="20" <? if ($dd == '20') echo "selected"; ?>>20</option>
            <option value="21" <? if ($dd == '21') echo "selected"; ?>>21</option>
            <option value="22" <? if ($dd == '22') echo "selected"; ?>>22</option>
            <option value="23" <? if ($dd == '23') echo "selected"; ?>>23</option>
            <option value="24" <? if ($dd == '24') echo "selected"; ?>>24</option>
            <option value="25" <? if ($dd == '25') echo "selected"; ?>>25</option>
            <option value="26" <? if ($dd == '26') echo "selected"; ?>>26</option>
            <option value="27" <? if ($dd ==' 27') echo "selected"; ?>>27</option>
			<option value="28" <? if ($dd == '28') echo "selected"; ?>>28</option>
            <option value="29" <? if ($dd == '29') echo "selected"; ?>>29</option>
            <option value="30" <? if ($dd == '30') echo "selected"; ?>>30</option>
            <option value="31" <? if ($dd == '31') echo "selected"; ?>>31</option>
          </select>
��
<? $ss = $row->si2 ?>
<select name="si2" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
            <option value="" <? if ($ss == "") echo "selected"; ?>>-</option>
            <option value="01" <? if ($ss == '01') echo "selected"; ?>>01</option>
            <option value="02" <? if ($ss == '02') echo "selected"; ?>>02</option>
            <option value="03" <? if ($ss == '03') echo "selected"; ?>>03</option>
            <option value="04" <? if ($ss == '04') echo "selected"; ?>>04</option>
            <option value="05" <? if ($ss == '05') echo "selected"; ?>>05</option>
            <option value="06" <? if ($ss == '06') echo "selected"; ?>>06</option>
            <option value="07" <? if ($ss == '07') echo "selected"; ?>>07</option>
            <option value="08" <? if ($ss == '08') echo "selected"; ?>>08</option>
            <option value="09" <? if ($ss == '09') echo "selected"; ?>>09</option>
			<option value="10" <? if ($ss == '10') echo "selected"; ?>>10</option>
            <option value="11" <? if ($ss == '11') echo "selected"; ?>>11</option>
            <option value="12" <? if ($ss == '12') echo "selected"; ?>>12</option>
            <option value="13" <? if ($ss == '13') echo "selected"; ?>>13</option>
            <option value="14" <? if ($ss == '14') echo "selected"; ?>>14</option>
            <option value="15" <? if ($ss == '15') echo "selected"; ?>>15</option>
            <option value="16" <? if ($ss == '16') echo "selected"; ?>>16</option>
            <option value="17" <? if ($ss == '17') echo "selected"; ?>>17</option>
            <option value="18" <? if ($ss == '18') echo "selected"; ?>>18</option>
            <option value="19" <? if ($ss == '19') echo "selected"; ?>>19</option>
			<option value="20" <? if ($ss == '20') echo "selected"; ?>>20</option>
            <option value="21" <? if ($ss == '21') echo "selected"; ?>>21</option>
            <option value="22" <? if ($ss == '22') echo "selected"; ?>>22</option>
            <option value="23" <? if ($ss == '23') echo "selected"; ?>>23</option>
            <option value="24" <? if ($ss == '24') echo "selected"; ?>>24</option>
          </select>
��
<? $bb = $row->bun2 ?>
<select name="bun2" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
  <option value="" <? if ($bb == "") echo "selected"; ?>>-</option>
  <option value="00" <? if ($bb == '00') echo "selected"; ?>>00</option>
  <option value="05" <? if ($bb == '05') echo "selected"; ?>>05</option>
  <option value="10" <? if ($bb == '10') echo "selected"; ?>>10</option>
  <option value="15" <? if ($bb == '15') echo "selected"; ?>>15</option>
  <option value="20" <? if ($bb == '20') echo "selected"; ?>>20</option>
  <option value="25" <? if ($bb == '25') echo "selected"; ?>>25</option>
  <option value="30" <? if ($bb == '30') echo "selected"; ?>>30</option>
  <option value="35" <? if ($bb == '35') echo "selected"; ?>>35</option>
  <option value="40" <? if ($bb == '40') echo "selected"; ?>>40</option>
  <option value="45" <? if ($bb == '45') echo "selected"; ?>>45</option>
  <option value="50" <? if ($bb == '50') echo "selected"; ?>>50</option>
  <option value="55" <? if ($bb == '55') echo "selected"; ?>>55</option>
</select>
�� </td>
		
	    <td width="174" rowspan="2" bgcolor="#FFFFFF"><div align="center">
      <input type="radio" name="pds_chk2" value="1" <? if ($row->pds_chk2==1){ ?>checked<? }else{ ?> <? } ?>>
      ���� &nbsp;
	          <input name="pds_chk2" type="radio" value="0" <? if ($row->pds_chk2==0){ ?>checked<? }else{ ?> <? } ?>>
	          ����� &nbsp;
	          <input name="pds_chk2" type="radio" value="2" <? if ($row->pds_chk2==2){ ?>checked<? }else{ ?> <? } ?>>
	          ����</div></td>
		</tr>
		<tr>
		  <td height="25" bgcolor="#FFFFFF">&nbsp; ->
            <?=$row->pds2?></td>
		  </tr>
		<tr>
        <td width='102' height="25" rowspan="2" align=center bgcolor=#6699CC><span class="style2">��ϵ� �ڷ� 3</span></td>
        <td width="314" height="25" bgcolor="#FFFFFF">&nbsp; ���½ð� 3:
<? $dd = $row->d03 ?>
		  <select name="d03" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
            <option value="" <? if ($dd == "") echo "selected"; ?>>-</option>
            <option value="01" <? if ($dd == '01') echo "selected"; ?>>01</option>
            <option value="02" <? if ($dd == '02') echo "selected"; ?>>02</option>
            <option value="03" <? if ($dd == '03') echo "selected"; ?>>03</option>
            <option value="04" <? if ($dd == '04') echo "selected"; ?>>04</option>
            <option value="05" <? if ($dd == '05') echo "selected"; ?>>05</option>
            <option value="06" <? if ($dd == '06') echo "selected"; ?>>06</option>
            <option value="07" <? if ($dd == '07') echo "selected"; ?>>07</option>
            <option value="08" <? if ($dd == '08') echo "selected"; ?>>08</option>
            <option value="09" <? if ($dd == '09') echo "selected"; ?>>09</option>
            <option value="10" <? if ($dd == '10') echo "selected"; ?>>10</option>
            <option value="11" <? if ($dd == '11') echo "selected"; ?>>11</option>
            <option value="12" <? if ($dd == '12') echo "selected"; ?>>12</option>
            <option value="13" <? if ($dd == '13') echo "selected"; ?>>13</option>
            <option value="14" <? if ($dd == '14') echo "selected"; ?>>14</option>
            <option value="15" <? if ($dd == '15') echo "selected"; ?>>15</option>
            <option value="16" <? if ($dd == '16') echo "selected"; ?>>16</option>
            <option value="17" <? if ($dd ==' 17') echo "selected"; ?>>17</option>
			<option value="18" <? if ($dd == '18') echo "selected"; ?>>18</option>
            <option value="19" <? if ($dd == '19') echo "selected"; ?>>19</option>
            <option value="20" <? if ($dd == '20') echo "selected"; ?>>20</option>
            <option value="21" <? if ($dd == '21') echo "selected"; ?>>21</option>
            <option value="22" <? if ($dd == '22') echo "selected"; ?>>22</option>
            <option value="23" <? if ($dd == '23') echo "selected"; ?>>23</option>
            <option value="24" <? if ($dd == '24') echo "selected"; ?>>24</option>
            <option value="25" <? if ($dd == '25') echo "selected"; ?>>25</option>
            <option value="26" <? if ($dd == '26') echo "selected"; ?>>26</option>
            <option value="27" <? if ($dd ==' 27') echo "selected"; ?>>27</option>
			<option value="28" <? if ($dd == '28') echo "selected"; ?>>28</option>
            <option value="29" <? if ($dd == '29') echo "selected"; ?>>29</option>
            <option value="30" <? if ($dd == '30') echo "selected"; ?>>30</option>
            <option value="31" <? if ($dd == '31') echo "selected"; ?>>31</option>
          </select>
��
<? $ss = $row->si3 ?>
<select name="si3" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
            <option value="" <? if ($ss == "") echo "selected"; ?>>-</option>
            <option value="01" <? if ($ss == '01') echo "selected"; ?>>01</option>
            <option value="02" <? if ($ss == '02') echo "selected"; ?>>02</option>
            <option value="03" <? if ($ss == '03') echo "selected"; ?>>03</option>
            <option value="04" <? if ($ss == '04') echo "selected"; ?>>04</option>
            <option value="05" <? if ($ss == '05') echo "selected"; ?>>05</option>
            <option value="06" <? if ($ss == '06') echo "selected"; ?>>06</option>
            <option value="07" <? if ($ss == '07') echo "selected"; ?>>07</option>
            <option value="08" <? if ($ss == '08') echo "selected"; ?>>08</option>
            <option value="09" <? if ($ss == '09') echo "selected"; ?>>09</option>
			<option value="10" <? if ($ss == '10') echo "selected"; ?>>10</option>
            <option value="11" <? if ($ss == '11') echo "selected"; ?>>11</option>
            <option value="12" <? if ($ss == '12') echo "selected"; ?>>12</option>
            <option value="13" <? if ($ss == '13') echo "selected"; ?>>13</option>
            <option value="14" <? if ($ss == '14') echo "selected"; ?>>14</option>
            <option value="15" <? if ($ss == '15') echo "selected"; ?>>15</option>
            <option value="16" <? if ($ss == '16') echo "selected"; ?>>16</option>
            <option value="17" <? if ($ss == '17') echo "selected"; ?>>17</option>
            <option value="18" <? if ($ss == '18') echo "selected"; ?>>18</option>
            <option value="19" <? if ($ss == '19') echo "selected"; ?>>19</option>
			<option value="20" <? if ($ss == '20') echo "selected"; ?>>20</option>
            <option value="21" <? if ($ss == '21') echo "selected"; ?>>21</option>
            <option value="22" <? if ($ss == '22') echo "selected"; ?>>22</option>
            <option value="23" <? if ($ss == '23') echo "selected"; ?>>23</option>
            <option value="24" <? if ($ss == '24') echo "selected"; ?>>24</option>
          </select>
��
<? $bb = $row->bun3 ?>
<select name="bun3" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
  <option value="" <? if ($bb == "") echo "selected"; ?>>-</option>
  <option value="00" <? if ($bb == '00') echo "selected"; ?>>00</option>
  <option value="05" <? if ($bb == '05') echo "selected"; ?>>05</option>
  <option value="10" <? if ($bb == '10') echo "selected"; ?>>10</option>
  <option value="15" <? if ($bb == '15') echo "selected"; ?>>15</option>
  <option value="20" <? if ($bb == '20') echo "selected"; ?>>20</option>
  <option value="25" <? if ($bb == '25') echo "selected"; ?>>25</option>
  <option value="30" <? if ($bb == '30') echo "selected"; ?>>30</option>
  <option value="35" <? if ($bb == '35') echo "selected"; ?>>35</option>
  <option value="40" <? if ($bb == '40') echo "selected"; ?>>40</option>
  <option value="45" <? if ($bb == '45') echo "selected"; ?>>45</option>
  <option value="50" <? if ($bb == '50') echo "selected"; ?>>50</option>
  <option value="55" <? if ($bb == '55') echo "selected"; ?>>55</option>
</select>
�� </td>
		
	    <td width="174" rowspan="2" bgcolor="#FFFFFF"><div align="center">
      <input type="radio" name="pds_chk3" value="1" <? if ($row->pds_chk3==1){ ?>checked<? }else{ ?> <? } ?>>
      ���� &nbsp;
	          <input name="pds_chk3" type="radio" value="0" <? if ($row->pds_chk3==0){ ?>checked<? }else{ ?> <? } ?>>
	          ����� &nbsp;
	          <input name="pds_chk3" type="radio" value="2" <? if ($row->pds_chk3==2){ ?>checked<? }else{ ?> <? } ?>>
	          ����</div></td>
		</tr>
		<tr>
		  <td height="25" bgcolor="#FFFFFF">&nbsp; ->
            <?=$row->pds3?></td>
		  </tr>
		<tr>
        <td width='102' height="25" rowspan="2" align=center bgcolor=#6699CC><span class="style2">��ϵ� �ڷ� 4</span></td>
        <td width="314" height="25" bgcolor="#FFFFFF">&nbsp; ���½ð� 4: 
<? $dd = $row->d04 ?>
		  <select name="d04" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
            <option value="" <? if ($dd == "") echo "selected"; ?>>-</option>
            <option value="01" <? if ($dd == '01') echo "selected"; ?>>01</option>
            <option value="02" <? if ($dd == '02') echo "selected"; ?>>02</option>
            <option value="03" <? if ($dd == '03') echo "selected"; ?>>03</option>
            <option value="04" <? if ($dd == '04') echo "selected"; ?>>04</option>
            <option value="05" <? if ($dd == '05') echo "selected"; ?>>05</option>
            <option value="06" <? if ($dd == '06') echo "selected"; ?>>06</option>
            <option value="07" <? if ($dd == '07') echo "selected"; ?>>07</option>
            <option value="08" <? if ($dd == '08') echo "selected"; ?>>08</option>
            <option value="09" <? if ($dd == '09') echo "selected"; ?>>09</option>
            <option value="10" <? if ($dd == '10') echo "selected"; ?>>10</option>
            <option value="11" <? if ($dd == '11') echo "selected"; ?>>11</option>
            <option value="12" <? if ($dd == '12') echo "selected"; ?>>12</option>
            <option value="13" <? if ($dd == '13') echo "selected"; ?>>13</option>
            <option value="14" <? if ($dd == '14') echo "selected"; ?>>14</option>
            <option value="15" <? if ($dd == '15') echo "selected"; ?>>15</option>
            <option value="16" <? if ($dd == '16') echo "selected"; ?>>16</option>
            <option value="17" <? if ($dd ==' 17') echo "selected"; ?>>17</option>
			<option value="18" <? if ($dd == '18') echo "selected"; ?>>18</option>
            <option value="19" <? if ($dd == '19') echo "selected"; ?>>19</option>
            <option value="20" <? if ($dd == '20') echo "selected"; ?>>20</option>
            <option value="21" <? if ($dd == '21') echo "selected"; ?>>21</option>
            <option value="22" <? if ($dd == '22') echo "selected"; ?>>22</option>
            <option value="23" <? if ($dd == '23') echo "selected"; ?>>23</option>
            <option value="24" <? if ($dd == '24') echo "selected"; ?>>24</option>
            <option value="25" <? if ($dd == '25') echo "selected"; ?>>25</option>
            <option value="26" <? if ($dd == '26') echo "selected"; ?>>26</option>
            <option value="27" <? if ($dd ==' 27') echo "selected"; ?>>27</option>
			<option value="28" <? if ($dd == '28') echo "selected"; ?>>28</option>
            <option value="29" <? if ($dd == '29') echo "selected"; ?>>29</option>
            <option value="30" <? if ($dd == '30') echo "selected"; ?>>30</option>
            <option value="31" <? if ($dd == '31') echo "selected"; ?>>31</option>
          </select>
��
<? $ss = $row->si4 ?>
<select name="si4" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
            <option value="" <? if ($ss == "") echo "selected"; ?>>-</option>
            <option value="01" <? if ($ss == '01') echo "selected"; ?>>01</option>
            <option value="02" <? if ($ss == '02') echo "selected"; ?>>02</option>
            <option value="03" <? if ($ss == '03') echo "selected"; ?>>03</option>
            <option value="04" <? if ($ss == '04') echo "selected"; ?>>04</option>
            <option value="05" <? if ($ss == '05') echo "selected"; ?>>05</option>
            <option value="06" <? if ($ss == '06') echo "selected"; ?>>06</option>
            <option value="07" <? if ($ss == '07') echo "selected"; ?>>07</option>
            <option value="08" <? if ($ss == '08') echo "selected"; ?>>08</option>
            <option value="09" <? if ($ss == '09') echo "selected"; ?>>09</option>
			<option value="10" <? if ($ss == '10') echo "selected"; ?>>10</option>
            <option value="11" <? if ($ss == '11') echo "selected"; ?>>11</option>
            <option value="12" <? if ($ss == '12') echo "selected"; ?>>12</option>
            <option value="13" <? if ($ss == '13') echo "selected"; ?>>13</option>
            <option value="14" <? if ($ss == '14') echo "selected"; ?>>14</option>
            <option value="15" <? if ($ss == '15') echo "selected"; ?>>15</option>
            <option value="16" <? if ($ss == '16') echo "selected"; ?>>16</option>
            <option value="17" <? if ($ss == '17') echo "selected"; ?>>17</option>
            <option value="18" <? if ($ss == '18') echo "selected"; ?>>18</option>
            <option value="19" <? if ($ss == '19') echo "selected"; ?>>19</option>
			<option value="20" <? if ($ss == '20') echo "selected"; ?>>20</option>
            <option value="21" <? if ($ss == '21') echo "selected"; ?>>21</option>
            <option value="22" <? if ($ss == '22') echo "selected"; ?>>22</option>
            <option value="23" <? if ($ss == '23') echo "selected"; ?>>23</option>
            <option value="24" <? if ($ss == '24') echo "selected"; ?>>24</option>
          </select>
��
<? $bb = $row->bun4 ?>
<select name="bun4" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
  <option value="" <? if ($bb == "") echo "selected"; ?>>-</option>
  <option value="00" <? if ($bb == '00') echo "selected"; ?>>00</option>
  <option value="05" <? if ($bb == '05') echo "selected"; ?>>05</option>
  <option value="10" <? if ($bb == '10') echo "selected"; ?>>10</option>
  <option value="15" <? if ($bb == '15') echo "selected"; ?>>15</option>
  <option value="20" <? if ($bb == '20') echo "selected"; ?>>20</option>
  <option value="25" <? if ($bb == '25') echo "selected"; ?>>25</option>
  <option value="30" <? if ($bb == '30') echo "selected"; ?>>30</option>
  <option value="35" <? if ($bb == '35') echo "selected"; ?>>35</option>
  <option value="40" <? if ($bb == '40') echo "selected"; ?>>40</option>
  <option value="45" <? if ($bb == '45') echo "selected"; ?>>45</option>
  <option value="50" <? if ($bb == '50') echo "selected"; ?>>50</option>
  <option value="55" <? if ($bb == '55') echo "selected"; ?>>55</option>
</select>
��</td>
		
	    <td width="174" rowspan="2" bgcolor="#FFFFFF"><div align="center">
      <input type="radio" name="pds_chk4" value="1" <? if ($row->pds_chk4==1){ ?>checked<? }else{ ?> <? } ?>>
      ���� &nbsp;
	          <input name="pds_chk4" type="radio" value="0" <? if ($row->pds_chk4==0){ ?>checked<? }else{ ?> <? } ?>>
	          ����� &nbsp;
	          <input name="pds_chk4" type="radio" value="2" <? if ($row->pds_chk4==2){ ?>checked<? }else{ ?> <? } ?>>
	          ����</div></td>
		</tr>
		<tr>
		  <td height="25" bgcolor="#FFFFFF">&nbsp; ->
            <?=$row->pds4?></td>
		  </tr>
		<tr>
        <td width='102' height="25" rowspan="2" align=center bgcolor=#6699CC><span class="style2">��ϵ� �ڷ� 5 </span></td>
        <td width="314" height="25" bgcolor="#FFFFFF">&nbsp; ���½ð� 5:
<? $dd = $row->d05 ?>
		  <select name="d05" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
            <option value="" <? if ($dd == "") echo "selected"; ?>>-</option>
            <option value="01" <? if ($dd == '01') echo "selected"; ?>>01</option>
            <option value="02" <? if ($dd == '02') echo "selected"; ?>>02</option>
            <option value="03" <? if ($dd == '03') echo "selected"; ?>>03</option>
            <option value="04" <? if ($dd == '04') echo "selected"; ?>>04</option>
            <option value="05" <? if ($dd == '05') echo "selected"; ?>>05</option>
            <option value="06" <? if ($dd == '06') echo "selected"; ?>>06</option>
            <option value="07" <? if ($dd == '07') echo "selected"; ?>>07</option>
            <option value="08" <? if ($dd == '08') echo "selected"; ?>>08</option>
            <option value="09" <? if ($dd == '09') echo "selected"; ?>>09</option>
            <option value="10" <? if ($dd == '10') echo "selected"; ?>>10</option>
            <option value="11" <? if ($dd == '11') echo "selected"; ?>>11</option>
            <option value="12" <? if ($dd == '12') echo "selected"; ?>>12</option>
            <option value="13" <? if ($dd == '13') echo "selected"; ?>>13</option>
            <option value="14" <? if ($dd == '14') echo "selected"; ?>>14</option>
            <option value="15" <? if ($dd == '15') echo "selected"; ?>>15</option>
            <option value="16" <? if ($dd == '16') echo "selected"; ?>>16</option>
            <option value="17" <? if ($dd ==' 17') echo "selected"; ?>>17</option>
			<option value="18" <? if ($dd == '18') echo "selected"; ?>>18</option>
            <option value="19" <? if ($dd == '19') echo "selected"; ?>>19</option>
            <option value="20" <? if ($dd == '20') echo "selected"; ?>>20</option>
            <option value="21" <? if ($dd == '21') echo "selected"; ?>>21</option>
            <option value="22" <? if ($dd == '22') echo "selected"; ?>>22</option>
            <option value="23" <? if ($dd == '23') echo "selected"; ?>>23</option>
            <option value="24" <? if ($dd == '24') echo "selected"; ?>>24</option>
            <option value="25" <? if ($dd == '25') echo "selected"; ?>>25</option>
            <option value="26" <? if ($dd == '26') echo "selected"; ?>>26</option>
            <option value="27" <? if ($dd ==' 27') echo "selected"; ?>>27</option>
			<option value="28" <? if ($dd == '28') echo "selected"; ?>>28</option>
            <option value="29" <? if ($dd == '29') echo "selected"; ?>>29</option>
            <option value="30" <? if ($dd == '30') echo "selected"; ?>>30</option>
            <option value="31" <? if ($dd == '31') echo "selected"; ?>>31</option>
          </select>
��
<? $ss = $row->si5 ?>
<select name="si5" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
            <option value="" <? if ($ss == "") echo "selected"; ?>>-</option>
            <option value="01" <? if ($ss == '01') echo "selected"; ?>>01</option>
            <option value="02" <? if ($ss == '02') echo "selected"; ?>>02</option>
            <option value="03" <? if ($ss == '03') echo "selected"; ?>>03</option>
            <option value="04" <? if ($ss == '04') echo "selected"; ?>>04</option>
            <option value="05" <? if ($ss == '05') echo "selected"; ?>>05</option>
            <option value="06" <? if ($ss == '06') echo "selected"; ?>>06</option>
            <option value="07" <? if ($ss == '07') echo "selected"; ?>>07</option>
            <option value="08" <? if ($ss == '08') echo "selected"; ?>>08</option>
            <option value="09" <? if ($ss == '09') echo "selected"; ?>>09</option>
			<option value="10" <? if ($ss == '10') echo "selected"; ?>>10</option>
            <option value="11" <? if ($ss == '11') echo "selected"; ?>>11</option>
            <option value="12" <? if ($ss == '12') echo "selected"; ?>>12</option>
            <option value="13" <? if ($ss == '13') echo "selected"; ?>>13</option>
            <option value="14" <? if ($ss == '14') echo "selected"; ?>>14</option>
            <option value="15" <? if ($ss == '15') echo "selected"; ?>>15</option>
            <option value="16" <? if ($ss == '16') echo "selected"; ?>>16</option>
            <option value="17" <? if ($ss == '17') echo "selected"; ?>>17</option>
            <option value="18" <? if ($ss == '18') echo "selected"; ?>>18</option>
            <option value="19" <? if ($ss == '19') echo "selected"; ?>>19</option>
			<option value="20" <? if ($ss == '20') echo "selected"; ?>>20</option>
            <option value="21" <? if ($ss == '21') echo "selected"; ?>>21</option>
            <option value="22" <? if ($ss == '22') echo "selected"; ?>>22</option>
            <option value="23" <? if ($ss == '23') echo "selected"; ?>>23</option>
            <option value="24" <? if ($ss == '24') echo "selected"; ?>>24</option>
          </select>
��
<? $bb = $row->bun5 ?>
<select name="bun5" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
  <option value="" <? if ($bb == "") echo "selected"; ?>>-</option>
  <option value="00" <? if ($bb == '00') echo "selected"; ?>>00</option>
  <option value="05" <? if ($bb == '05') echo "selected"; ?>>05</option>
  <option value="10" <? if ($bb == '10') echo "selected"; ?>>10</option>
  <option value="15" <? if ($bb == '15') echo "selected"; ?>>15</option>
  <option value="20" <? if ($bb == '20') echo "selected"; ?>>20</option>
  <option value="25" <? if ($bb == '25') echo "selected"; ?>>25</option>
  <option value="30" <? if ($bb == '30') echo "selected"; ?>>30</option>
  <option value="35" <? if ($bb == '35') echo "selected"; ?>>35</option>
  <option value="40" <? if ($bb == '40') echo "selected"; ?>>40</option>
  <option value="45" <? if ($bb == '45') echo "selected"; ?>>45</option>
  <option value="50" <? if ($bb == '50') echo "selected"; ?>>50</option>
  <option value="55" <? if ($bb == '55') echo "selected"; ?>>55</option>
</select>
��</td>
		
	    <td width="174" rowspan="2" bgcolor="#FFFFFF"><div align="center">
      <input type="radio" name="pds_chk5" value="1" <? if ($row->pds_chk5==1){ ?>checked<? }else{ ?> <? } ?>>
      ���� &nbsp;
	          <input name="pds_chk5" type="radio" value="0" <? if ($row->pds_chk5==0){ ?>checked<? }else{ ?> <? } ?>>
	          ����� &nbsp;
	          <input name="pds_chk5" type="radio" value="2" <? if ($row->pds_chk5==2){ ?>checked<? }else{ ?> <? } ?>>
	          ����</div></td>
		</tr>
		<tr>
		  <td height="25" bgcolor="#FFFFFF">&nbsp; ->
            <?=$row->pds5?></td>
		  </tr>
		<tr>
        <td width='102' height="25" rowspan="2" align=center bgcolor=#6699CC><span class="style2">��ϵ� �ڷ� 6 </span></td>
        <td width="314" height="25" bgcolor="#FFFFFF">&nbsp; ���½ð� 6:
          <? $dd = $row->d06 ?>
		  <select name="d06" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
            <option value="" <? if ($dd == "") echo "selected"; ?>>-</option>
            <option value="01" <? if ($dd == '01') echo "selected"; ?>>01</option>
            <option value="02" <? if ($dd == '02') echo "selected"; ?>>02</option>
            <option value="03" <? if ($dd == '03') echo "selected"; ?>>03</option>
            <option value="04" <? if ($dd == '04') echo "selected"; ?>>04</option>
            <option value="05" <? if ($dd == '05') echo "selected"; ?>>05</option>
            <option value="06" <? if ($dd == '06') echo "selected"; ?>>06</option>
            <option value="07" <? if ($dd == '07') echo "selected"; ?>>07</option>
            <option value="08" <? if ($dd == '08') echo "selected"; ?>>08</option>
            <option value="09" <? if ($dd == '09') echo "selected"; ?>>09</option>
            <option value="10" <? if ($dd == '10') echo "selected"; ?>>10</option>
            <option value="11" <? if ($dd == '11') echo "selected"; ?>>11</option>
            <option value="12" <? if ($dd == '12') echo "selected"; ?>>12</option>
            <option value="13" <? if ($dd == '13') echo "selected"; ?>>13</option>
            <option value="14" <? if ($dd == '14') echo "selected"; ?>>14</option>
            <option value="15" <? if ($dd == '15') echo "selected"; ?>>15</option>
            <option value="16" <? if ($dd == '16') echo "selected"; ?>>16</option>
            <option value="17" <? if ($dd ==' 17') echo "selected"; ?>>17</option>
			<option value="18" <? if ($dd == '18') echo "selected"; ?>>18</option>
            <option value="19" <? if ($dd == '19') echo "selected"; ?>>19</option>
            <option value="20" <? if ($dd == '20') echo "selected"; ?>>20</option>
            <option value="21" <? if ($dd == '21') echo "selected"; ?>>21</option>
            <option value="22" <? if ($dd == '22') echo "selected"; ?>>22</option>
            <option value="23" <? if ($dd == '23') echo "selected"; ?>>23</option>
            <option value="24" <? if ($dd == '24') echo "selected"; ?>>24</option>
            <option value="25" <? if ($dd == '25') echo "selected"; ?>>25</option>
            <option value="26" <? if ($dd == '26') echo "selected"; ?>>26</option>
            <option value="27" <? if ($dd ==' 27') echo "selected"; ?>>27</option>
			<option value="28" <? if ($dd == '28') echo "selected"; ?>>28</option>
            <option value="29" <? if ($dd == '29') echo "selected"; ?>>29</option>
            <option value="30" <? if ($dd == '30') echo "selected"; ?>>30</option>
            <option value="31" <? if ($dd == '31') echo "selected"; ?>>31</option>
          </select>
��
<? $ss = $row->si6 ?>
<select name="si6" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
            <option value="" <? if ($ss == "") echo "selected"; ?>>-</option>
            <option value="01" <? if ($ss == '01') echo "selected"; ?>>01</option>
            <option value="02" <? if ($ss == '02') echo "selected"; ?>>02</option>
            <option value="03" <? if ($ss == '03') echo "selected"; ?>>03</option>
            <option value="04" <? if ($ss == '04') echo "selected"; ?>>04</option>
            <option value="05" <? if ($ss == '05') echo "selected"; ?>>05</option>
            <option value="06" <? if ($ss == '06') echo "selected"; ?>>06</option>
            <option value="07" <? if ($ss == '07') echo "selected"; ?>>07</option>
            <option value="08" <? if ($ss == '08') echo "selected"; ?>>08</option>
            <option value="09" <? if ($ss == '09') echo "selected"; ?>>09</option>
			<option value="10" <? if ($ss == '10') echo "selected"; ?>>10</option>
            <option value="11" <? if ($ss == '11') echo "selected"; ?>>11</option>
            <option value="12" <? if ($ss == '12') echo "selected"; ?>>12</option>
            <option value="13" <? if ($ss == '13') echo "selected"; ?>>13</option>
            <option value="14" <? if ($ss == '14') echo "selected"; ?>>14</option>
            <option value="15" <? if ($ss == '15') echo "selected"; ?>>15</option>
            <option value="16" <? if ($ss == '16') echo "selected"; ?>>16</option>
            <option value="17" <? if ($ss == '17') echo "selected"; ?>>17</option>
            <option value="18" <? if ($ss == '18') echo "selected"; ?>>18</option>
            <option value="19" <? if ($ss == '19') echo "selected"; ?>>19</option>
			<option value="20" <? if ($ss == '20') echo "selected"; ?>>20</option>
            <option value="21" <? if ($ss == '21') echo "selected"; ?>>21</option>
            <option value="22" <? if ($ss == '22') echo "selected"; ?>>22</option>
            <option value="23" <? if ($ss == '23') echo "selected"; ?>>23</option>
            <option value="24" <? if ($ss == '24') echo "selected"; ?>>24</option>
          </select>
��
<? $bb = $row->bun6 ?>
<select name="bun6" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
  <option value="" <? if ($bb == "") echo "selected"; ?>>-</option>
  <option value="00" <? if ($bb == '00') echo "selected"; ?>>00</option>
  <option value="05" <? if ($bb == '05') echo "selected"; ?>>05</option>
  <option value="10" <? if ($bb == '10') echo "selected"; ?>>10</option>
  <option value="15" <? if ($bb == '15') echo "selected"; ?>>15</option>
  <option value="20" <? if ($bb == '20') echo "selected"; ?>>20</option>
  <option value="25" <? if ($bb == '25') echo "selected"; ?>>25</option>
  <option value="30" <? if ($bb == '30') echo "selected"; ?>>30</option>
  <option value="35" <? if ($bb == '35') echo "selected"; ?>>35</option>
  <option value="40" <? if ($bb == '40') echo "selected"; ?>>40</option>
  <option value="45" <? if ($bb == '45') echo "selected"; ?>>45</option>
  <option value="50" <? if ($bb == '50') echo "selected"; ?>>50</option>
  <option value="55" <? if ($bb == '55') echo "selected"; ?>>55</option>
</select>
��</td>
		
	    <td width="174" rowspan="2" bgcolor="#FFFFFF"><div align="center">
      <input type="radio" name="pds_chk6" value="1" <? if ($row->pds_chk6==1){ ?>checked<? }else{ ?> <? } ?>>
      ���� &nbsp;
	          <input name="pds_chk6" type="radio" value="0" <? if ($row->pds_chk6==0){ ?>checked<? }else{ ?> <? } ?>>
	          ����� &nbsp;
	          <input name="pds_chk6" type="radio" value="2" <? if ($row->pds_chk6==2){ ?>checked<? }else{ ?> <? } ?>>
	          ����</div></td>
		</tr>
		<tr>
		  <td height="25" bgcolor="#FFFFFF">&nbsp; ->
            <?=$row->pds6?></td>
		  </tr>
	  <tr bgcolor="#6699CC">
        <td height="25" colspan="3" align=center><span class="style2">�� ���� �ڷ� ���� (�ݵ�� ������� �Է� ���ּ���. ) </span></td>
        </tr>
	  <tr>
        <td width='102' height="25" align=center bgcolor=#6699CC><span class="style2">�� �� 1</span></td>
        <td colspan="2" bgcolor="#FFFFFF">&nbsp; <input type='file' size='36' name='pds1' maxlength='50' style="border-width:1;border-color:#6d6d6d; border-style:solid;">          </td>
	  </tr>
	  <tr>
        <td width='102' height="25" align=center bgcolor=#6699CC><span class="style2">�� �� 2 </span></td>
        <td colspan="2" bgcolor="#FFFFFF">&nbsp; <input type='file' size='36' name='pds2' maxlength='50' style="border-width:1;border-color:#6d6d6d; border-style:solid;">          </td>
	  </tr>
	  <tr>
        <td width='102' height="25" align=center bgcolor=#6699CC><span class="style2">�� �� 3</span></td>
        <td colspan="2" bgcolor="#FFFFFF">&nbsp; <input type='file' size='36' name='pds3' maxlength='50' style="border-width:1;border-color:#6d6d6d; border-style:solid;">          </td>
	  </tr>
	  <tr>
        <td width='102' height="25" align=center bgcolor=#6699CC><span class="style2">�� �� 4 </span></td>
        <td colspan="2" bgcolor="#FFFFFF">&nbsp; <input type='file' size='36' name='pds4' maxlength='50' style="border-width:1;border-color:#6d6d6d; border-style:solid;">          </td>
	  </tr>
	  <tr>
        <td width='102' height="25" align=center bgcolor=#6699CC><span class="style2">�� �� 5 </span></td>
        <td colspan="2" bgcolor="#FFFFFF">&nbsp; <input type='file' size='36' name='pds5' maxlength='50' style="border-width:1;border-color:#6d6d6d; border-style:solid;">          </td>
	  </tr>
	  <tr>
        <td width='102' height="25" align=center bgcolor=#6699CC><span class="style2">�� �� 6 </span></td>
        <td colspan="2" bgcolor="#FFFFFF">&nbsp; <input type='file' size='36' name='pds6' maxlength='50' style="border-width:1;border-color:#6d6d6d; border-style:solid;">          </td>
	  </tr>
	  <tr>
	    <td height="25" colspan="3" align=center bgcolor=#6699CC><span class="style2">�� �����(��Ʈ����) �ڷ� ���� (FTP�� �̿��ϼż� �ø��� ���ϸ��� ����� �ּ���.) </span></td>
	    </tr>
	  <tr>
	    <td width='102' height="25" rowspan="2" align=center bgcolor=#6699CC><span class="style2">����� 1</span></td>
	    <td height="25" colspan="2" bgcolor="#FFFFFF">&nbsp; ��ϵ� ����1: <?=$row->audio1?>.wma
	      &nbsp;&nbsp;&nbsp; [������ ���ϸ��� ����ð� ������ �Ͻø� �˴ϴ�.]</td>
	    </tr>
	  <tr>
	    <td height="25" colspan="2" bgcolor="#FFFFFF">&nbsp;&nbsp; 
	      <input type=text size='30' name='audio1' maxlength='30' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->audio1?>'>
	      .wma
&lt;- ���� ���ϸ� �Է� </td>
	    </tr>
	  
	  <tr>
	    <td width='102' height="25" rowspan="2" align=center bgcolor=#6699CC><span class="style2">����� 2</span></td>
	    <td height="25" colspan="2" bgcolor="#FFFFFF">&nbsp; ��ϵ� ����2: <?=$row->audio2?>.wma
		  &nbsp;&nbsp;&nbsp;</td>
	    </tr>
	  <tr>
	    <td height="25" colspan="2" bgcolor="#FFFFFF">&nbsp;
          <input type=text size='30' name='audio2' maxlength='30' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->audio2?>'>
          .wma
&lt;- ���� ���ϸ� �Է� </td>
	    </tr>
	  
	  <tr>
	    <td width='102' height="25" rowspan="2" align=center bgcolor=#6699CC><span class="style2">����� 3 </span></td>
	    <td height="25" colspan="2" bgcolor="#FFFFFF">&nbsp; ��ϵ� ����3: <?=$row->audio3?>.wma
		  &nbsp;&nbsp;&nbsp;</td>
	    </tr>
	  <tr>
	    <td height="25" colspan="2" bgcolor="#FFFFFF">&nbsp;
          <input type=text size='30' name='audio3' maxlength='30' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->audio3?>'>
          .wma
&lt;- ���� ���ϸ� �Է� </td>
	    </tr>
	  
	  <tr>
	    <td width='102' height="25" rowspan="2" align=center bgcolor=#6699CC><span class="style2">����� 4 </span></td>
	    <td height="25" colspan="2" bgcolor="#FFFFFF">&nbsp; ��ϵ� ����4: <?=$row->audio4?>.wma
		  &nbsp;&nbsp;</td>
	    </tr>
	  <tr>
	    <td height="25" colspan="2" bgcolor="#FFFFFF">&nbsp;
          <input type=text size='30' name='audio4' maxlength='30' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->audio4?>'>
.wma
&lt;- ���� ���ϸ� �Է� </td>
	    </tr>
	  
	  <tr>
	    <td width='102' height="25" rowspan="2" align=center bgcolor=#6699CC><span class="style2">����� 5</span></td>
	    <td height="25" colspan="2" bgcolor="#FFFFFF">&nbsp; ��ϵ� ����5: <?=$row->audio5?>.wma
		  &nbsp;</td>
	    </tr>
	  <tr>
	    <td height="25" colspan="2" bgcolor="#FFFFFF">&nbsp;
          <input type=text size='30' name='audio5' maxlength='30' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->audio5?>'>
.wma
&lt;- ���� ���ϸ� �Է� </td>
	    </tr>
	  <tr>
	    <td height="25" rowspan="2" align=center bgcolor=#6699CC><span class="style2">����� 6 </span></td>
	    <td height="25" colspan="2" bgcolor="#FFFFFF">&nbsp; ��ϵ� ����6: <?=$row->audio6?>.wma
		  &nbsp;&nbsp;&nbsp;</td>
	  </tr>
	  <tr>
	    <td height="25" colspan="2" bgcolor="#FFFFFF">&nbsp;
          <input type=text size='30' name='audio6' maxlength='30' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->audio6?>'>
.wma
&lt;- ���� ���ϸ� �Է� </td>
	    </tr>
    </table>
	
	<br>
<br>

<div align="center">
  <? if($id != ''){ ?>
  <input type=button onclick='check()' value='�� ��'style="background-color:#EEE0E5;border-width:1; border-style:solid;">
  &nbsp;
  <input type=button onclick='deleteData()' value='�� ��'style="background-color:#EEE0E5 ;border-width:1; border-style:solid;">
  &nbsp;
  
      <?}else{?>
  
  <input type='button' onclick='check()' value=' �� �� 'style="background-color:#FFF0F5;border-width:1; border-style:solid;">
  &nbsp;
  
      <?}?>
  
      <input type='button' onClick="javascript:history.back();" value='�� ��' style="background-color:#FFF0F5;border-width:1; border-style:solid;">
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
