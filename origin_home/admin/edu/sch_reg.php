<?
include "../dbconn.inc";

if($_head_php_excuted) return;
if(!eregi($HTTP_HOST,$HTTP_REFERER)) Error("정상적으로 접근하여 주시기 바랍니다.");
if(eregi(":\/\/",$dir)) $dir=".";

$sql="SELECT * FROM edu_schedule order by year desc";
$res=mysql_query($sql);
$total=mysql_affected_rows();

if ($id!=''){
	$sql="SELECT * FROM edu_schedule where id = '".$id."'";
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

	if(form.year.value==''){
		alert('날자를 입력하세요!');
		form.year.focus();
		return;
	}
	if(form.month.value==''){
		alert('날자를 입력하세요!');
		form.month.focus();
		return;
	}
	if(form.day.value==''){
		alert('날자를 입력하세요!');
		form.day.focus();
		return;
	}
	if(form.title.value==''){
		alert('교육제목을 입력하세요!');
		form.title.focus();
		return;
	}
	form.submit()
}

function startUp(){
	document.form.name.focus();
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
		    <!-- 메뉴시작 -->
		    <? include("menu.php");?>
		    <!-- 메뉴시작 -->
          </div></td>
		</tr>
		<tr>
		  <td>
		  <form name='form' action='sch_reg_write.php' method='post' enctype="multipart/form-data">
			<input type='hidden' name='id' value='<?=$id?>'>
<table width="730" border="0" align="center">
  <tr>
    <td width="278">▒ 교육일정<? if($id != ''){ ?>수정<? }else{ ?>신규등록 <? }?>  // 총:
      <?=$total?>
      명</td>
    <td width="420"><div align="right"><a href='reg.php?uid='></a></div></td>
  </tr>
  <tr>
    <td colspan='2'><hr></td>
  <tr>
  <tr>
    <td colspan="2"><table width=530 border=0 align=center cellpadding=1 cellspacing=1 bgcolor="#6699CC" >
      <tr>
        <td width='100' height="25" align=center bgcolor=#6699CC><span class="style2">교육구분</span></td>
        <td bgcolor="#FFFFFF">&nbsp;
          <select name="edu_type" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
            <option value="신규" <? if ($row->edu_type=='신규'){ ?>selected<? }else{ ?> <? } ?>>신규</option>
            <option value="기존" <? if ($row->edu_type=='기존'){ ?>selected<? }else{ ?> <? } ?>>기존</option>
          </select></td>
      </tr>
	  <tr>
        <td width='100' height="25" align=center bgcolor=#6699CC><span class="style2">일 정 </span></td>
        <td bgcolor="#FFFFFF">&nbsp; <select name="year" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
          <option value="0" <? if ($y==0){ ?>selected<? }else{ ?> <? } ?>></option>
		  <option value="2006" <? if ($y==2006){ ?>selected<? }else{ ?> <? } ?>>2006</option>
          <option value="2007" <? if ($y==2007){ ?>selected<? }else{ ?> <? } ?>>2007</option>
          <option value="2008" <? if ($y==2008){ ?>selected<? }else{ ?> <? } ?>>2008</option>
          <option value="2009" <? if ($y==2009){ ?>selected<? }else{ ?> <? } ?>>2009</option>
          <option value="2010" <? if ($y==2010){ ?>selected<? }else{ ?> <? } ?>>2010</option>
        </select>
        년
          <select name="month" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
            <option value="0" <? if ($m==0){ ?>selected<? }else{ ?> <? } ?>></option>
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
          월
          <select name="day" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
            <option value="0" <? if ($d==0){ ?>selected<? }else{ ?> <? } ?>></option>
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
          일 ~ 
          <select name="day2" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
            <option value="0" <? if ($d==0){ ?>selected<? }else{ ?> <? } ?>></option>
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
일 (
<select name="si" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
  <option value="0" <? if ($row->si==0){ ?>selected<? }else{ ?> <? } ?>></option>
  <option value="01" <? if ($row->si==01){ ?>selected<? }else{ ?> <? } ?>>01</option>
  <option value="02" <? if ($row->si==02){ ?>selected<? }else{ ?> <? } ?>>02</option>
  <option value="03" <? if ($row->si==03){ ?>selected<? }else{ ?> <? } ?>>03</option>
  <option value="04" <? if ($row->si==04){ ?>selected<? }else{ ?> <? } ?>>04</option>
  <option value="05" <? if ($row->si==05){ ?>selected<? }else{ ?> <? } ?>>05</option>
  <option value="06" <? if ($row->si==06){ ?>selected<? }else{ ?> <? } ?>>06</option>
  <option value="07" <? if ($row->si==07){ ?>selected<? }else{ ?> <? } ?>>07</option>
  <option value="08" <? if ($row->si==08){ ?>selected<? }else{ ?> <? } ?>>08</option>
  <option value="09" <? if ($row->si==09){ ?>selected<? }else{ ?> <? } ?>>09</option>
  <option value="10" <? if ($row->si==10){ ?>selected<? }else{ ?> <? } ?>>10</option>
  <option value="11" <? if ($row->si==11){ ?>selected<? }else{ ?> <? } ?>>11</option>
  <option value="12" <? if ($row->si==12){ ?>selected<? }else{ ?> <? } ?>>12</option>
  <option value="13" <? if ($row->si==13){ ?>selected<? }else{ ?> <? } ?>>13</option>
  <option value="14" <? if ($row->si==14){ ?>selected<? }else{ ?> <? } ?>>14</option>
  <option value="15" <? if ($row->si==15){ ?>selected<? }else{ ?> <? } ?>>15</option>
  <option value="16" <? if ($row->si==16){ ?>selected<? }else{ ?> <? } ?>>16</option>
  <option value="17" <? if ($row->si==17){ ?>selected<? }else{ ?> <? } ?>>17</option>
  <option value="18" <? if ($row->si==18){ ?>selected<? }else{ ?> <? } ?>>18</option>
  <option value="19" <? if ($row->si==19){ ?>selected<? }else{ ?> <? } ?>>19</option>
  <option value="20" <? if ($row->si==20){ ?>selected<? }else{ ?> <? } ?>>20</option>
  <option value="21" <? if ($row->si==21){ ?>selected<? }else{ ?> <? } ?>>21</option>
  <option value="22" <? if ($row->si==22){ ?>selected<? }else{ ?> <? } ?>>22</option>
  <option value="23" <? if ($row->si==23){ ?>selected<? }else{ ?> <? } ?>>23</option>
  <option value="24" <? if ($row->si==24){ ?>selected<? }else{ ?> <? } ?>>24</option>
</select>
시
<select name="bun" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
  <option value="0" <? if ($row->bun==0){ ?>selected<? }else{ ?> <? } ?>></option>
  <option value="00" <? if ($row->bun==00){ ?>selected<? }else{ ?> <? } ?>>00</option>
  <option value="05" <? if ($row->bun==05){ ?>selected<? }else{ ?> <? } ?>>05</option>
  <option value="10" <? if ($row->bun==10){ ?>selected<? }else{ ?> <? } ?>>10</option>
  <option value="15" <? if ($row->bun==15){ ?>selected<? }else{ ?> <? } ?>>15</option>
  <option value="20" <? if ($row->bun==20){ ?>selected<? }else{ ?> <? } ?>>20</option>
  <option value="25" <? if ($row->bun==25){ ?>selected<? }else{ ?> <? } ?>>25</option>
  <option value="30" <? if ($row->bun==30){ ?>selected<? }else{ ?> <? } ?>>30</option>
  <option value="35" <? if ($row->bun==35){ ?>selected<? }else{ ?> <? } ?>>35</option>
  <option value="40" <? if ($row->bun==40){ ?>selected<? }else{ ?> <? } ?>>40</option>
  <option value="45" <? if ($row->bun==45){ ?>selected<? }else{ ?> <? } ?>>45</option>
  <option value="50" <? if ($row->bun==50){ ?>selected<? }else{ ?> <? } ?>>50</option>
  <option value="55" <? if ($row->bun==55){ ?>selected<? }else{ ?> <? } ?>>55</option>
</select>
분) </td>
      </tr>
      <tr>
        <td width='100' height="25" align=center bgcolor=#6699CC><span class="style2">교육제목</span></td>
        <td bgcolor="#FFFFFF">&nbsp; <input type=text size='50' name='title' maxlength='50' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->title?>'></td>
      </tr>
	  <tr bgcolor="#6699CC">
        <td height="25" colspan="2" align=center><span class="style2">※ 교육 자료 (반드시 순서대로 입력 해주세요. ) </span></td>
        </tr>
	  <tr bgcolor="#6699CC">
	    <td height="25" align=center><span class="style2">등록될 자료 수</span></td>
	    <td height="25" align=center bgcolor="#FFFFFF"><div align="left">
	      <? $bb = $row->s_point ?>
	      <select name="s_point" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
            <option value="" <? if ($bb == "") echo "selected"; ?>>-</option>
            <option value="1" <? if ($bb == '1') echo "selected"; ?>>01</option>
            <option value="2" <? if ($bb == '2') echo "selected"; ?>>02</option>
            <option value="3" <? if ($bb == '3') echo "selected"; ?>>03</option>
            <option value="4" <? if ($bb == '4') echo "selected"; ?>>04</option>
            <option value="5" <? if ($bb == '5') echo "selected"; ?>>05</option>
            <option value="6" <? if ($bb == '6') echo "selected"; ?>>06</option>
          </select>
개 </div></td>
	  </tr>
	  <tr>
        <td width='100' height="25" rowspan="2" align=center bgcolor=#6699CC><span class="style2">자 료 1</span></td>
        <td height="25" bgcolor="#FFFFFF">&nbsp; 오픈시간 1: 
          <select name="d01" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
            <option value="0" <? if ($d==0){ ?>selected<? }else{ ?> <? } ?>></option>
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
          일 
          <select name="si1" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
          <option value="0" <? if ($row->si1==0){ ?>selected<? }else{ ?> <? } ?>></option>
          <option value="01" <? if ($row->si1==01){ ?>selected<? }else{ ?> <? } ?>>01</option>
          <option value="02" <? if ($row->si1==02){ ?>selected<? }else{ ?> <? } ?>>02</option>
          <option value="03" <? if ($row->si1==03){ ?>selected<? }else{ ?> <? } ?>>03</option>
          <option value="04" <? if ($row->si1==04){ ?>selected<? }else{ ?> <? } ?>>04</option>
          <option value="05" <? if ($row->si1==05){ ?>selected<? }else{ ?> <? } ?>>05</option>
          <option value="06" <? if ($row->si1==06){ ?>selected<? }else{ ?> <? } ?>>06</option>
          <option value="07" <? if ($row->si1==07){ ?>selected<? }else{ ?> <? } ?>>07</option>
          <option value="08" <? if ($row->si1==08){ ?>selected<? }else{ ?> <? } ?>>08</option>
          <option value="09" <? if ($row->si1==09){ ?>selected<? }else{ ?> <? } ?>>09</option>
          <option value="10" <? if ($row->si1==10){ ?>selected<? }else{ ?> <? } ?>>10</option>
          <option value="11" <? if ($row->si1==11){ ?>selected<? }else{ ?> <? } ?>>11</option>
          <option value="12" <? if ($row->si1==12){ ?>selected<? }else{ ?> <? } ?>>12</option>
          <option value="13" <? if ($row->si1==13){ ?>selected<? }else{ ?> <? } ?>>13</option>
          <option value="14" <? if ($row->si1==14){ ?>selected<? }else{ ?> <? } ?>>14</option>
          <option value="15" <? if ($row->si1==15){ ?>selected<? }else{ ?> <? } ?>>15</option>
          <option value="16" <? if ($row->si1==16){ ?>selected<? }else{ ?> <? } ?>>16</option>
          <option value="17" <? if ($row->si1==17){ ?>selected<? }else{ ?> <? } ?>>17</option>
          <option value="18" <? if ($row->si1==18){ ?>selected<? }else{ ?> <? } ?>>18</option>
          <option value="19" <? if ($row->si1==19){ ?>selected<? }else{ ?> <? } ?>>19</option>
          <option value="20" <? if ($row->si1==20){ ?>selected<? }else{ ?> <? } ?>>20</option>
          <option value="21" <? if ($row->si1==21){ ?>selected<? }else{ ?> <? } ?>>21</option>
          <option value="22" <? if ($row->si1==22){ ?>selected<? }else{ ?> <? } ?>>22</option>
          <option value="23" <? if ($row->si1==23){ ?>selected<? }else{ ?> <? } ?>>23</option>
          <option value="24" <? if ($row->si1==24){ ?>selected<? }else{ ?> <? } ?>>24</option>
        </select>
시
<select name="bun1" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
  <option value="0" <? if ($row->bun1==0){ ?>selected<? }else{ ?> <? } ?>></option>
  <option value="00" <? if ($row->bun1==00){ ?>selected<? }else{ ?> <? } ?>>00</option>
  <option value="05" <? if ($row->bun1==05){ ?>selected<? }else{ ?> <? } ?>>05</option>
  <option value="10" <? if ($row->bun1==10){ ?>selected<? }else{ ?> <? } ?>>10</option>
  <option value="15" <? if ($row->bun1==15){ ?>selected<? }else{ ?> <? } ?>>15</option>
  <option value="20" <? if ($row->bun1==20){ ?>selected<? }else{ ?> <? } ?>>20</option>
  <option value="25" <? if ($row->bun1==25){ ?>selected<? }else{ ?> <? } ?>>25</option>
  <option value="30" <? if ($row->bun1==30){ ?>selected<? }else{ ?> <? } ?>>30</option>
  <option value="35" <? if ($row->bun1==35){ ?>selected<? }else{ ?> <? } ?>>35</option>
  <option value="40" <? if ($row->bun1==40){ ?>selected<? }else{ ?> <? } ?>>40</option>
  <option value="45" <? if ($row->bun1==45){ ?>selected<? }else{ ?> <? } ?>>45</option>
  <option value="50" <? if ($row->bun1==50){ ?>selected<? }else{ ?> <? } ?>>50</option>
  <option value="55" <? if ($row->bun1==55){ ?>selected<? }else{ ?> <? } ?>>55</option>
</select>
분 </td>
	  </tr>
	  <tr>
	    <td height="25" bgcolor="#FFFFFF">&nbsp; <input type='file' size='36' name='pds1' maxlength='50' style="border-width:1;border-color:#6d6d6d; border-style:solid;"></td>
	    </tr>
	  <tr>
        <td width='100' height="25" rowspan="2" align=center bgcolor=#6699CC><span class="style2">자 료 2 </span></td>
        <td height="25" bgcolor="#FFFFFF">&nbsp; 오픈시간 2:
          <select name="d02" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
            <option value="0" <? if ($d==0){ ?>selected<? }else{ ?> <? } ?>></option>
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
          일 
          <select name="si2" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
            <option value="0" <? if ($row->si2==0){ ?>selected<? }else{ ?> <? } ?>></option>
            <option value="01" <? if ($row->si2==01){ ?>selected<? }else{ ?> <? } ?>>01</option>
            <option value="02" <? if ($row->si2==02){ ?>selected<? }else{ ?> <? } ?>>02</option>
            <option value="03" <? if ($row->si2==03){ ?>selected<? }else{ ?> <? } ?>>03</option>
            <option value="04" <? if ($row->si2==04){ ?>selected<? }else{ ?> <? } ?>>04</option>
            <option value="05" <? if ($row->si2==05){ ?>selected<? }else{ ?> <? } ?>>05</option>
            <option value="06" <? if ($row->si2==06){ ?>selected<? }else{ ?> <? } ?>>06</option>
            <option value="07" <? if ($row->si2==07){ ?>selected<? }else{ ?> <? } ?>>07</option>
            <option value="08" <? if ($row->si2==08){ ?>selected<? }else{ ?> <? } ?>>08</option>
            <option value="09" <? if ($row->si2==09){ ?>selected<? }else{ ?> <? } ?>>09</option>
            <option value="10" <? if ($row->si2==10){ ?>selected<? }else{ ?> <? } ?>>10</option>
            <option value="11" <? if ($row->si2==11){ ?>selected<? }else{ ?> <? } ?>>11</option>
            <option value="12" <? if ($row->si2==12){ ?>selected<? }else{ ?> <? } ?>>12</option>
            <option value="13" <? if ($row->si2==13){ ?>selected<? }else{ ?> <? } ?>>13</option>
            <option value="14" <? if ($row->si2==14){ ?>selected<? }else{ ?> <? } ?>>14</option>
            <option value="15" <? if ($row->si2==15){ ?>selected<? }else{ ?> <? } ?>>15</option>
            <option value="16" <? if ($row->si2==16){ ?>selected<? }else{ ?> <? } ?>>16</option>
            <option value="17" <? if ($row->si2==17){ ?>selected<? }else{ ?> <? } ?>>17</option>
            <option value="18" <? if ($row->si2==18){ ?>selected<? }else{ ?> <? } ?>>18</option>
            <option value="19" <? if ($row->si2==19){ ?>selected<? }else{ ?> <? } ?>>19</option>
            <option value="20" <? if ($row->si2==20){ ?>selected<? }else{ ?> <? } ?>>20</option>
            <option value="21" <? if ($row->si2==21){ ?>selected<? }else{ ?> <? } ?>>21</option>
            <option value="22" <? if ($row->si2==22){ ?>selected<? }else{ ?> <? } ?>>22</option>
            <option value="23" <? if ($row->si2==23){ ?>selected<? }else{ ?> <? } ?>>23</option>
            <option value="24" <? if ($row->si2==24){ ?>selected<? }else{ ?> <? } ?>>24</option>
          </select>
시
<select name="bun2" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
  <option value="0" <? if ($row->bun2==0){ ?>selected<? }else{ ?> <? } ?>></option>
  <option value="00" <? if ($row->bun2==00){ ?>selected<? }else{ ?> <? } ?>>00</option>
  <option value="05" <? if ($row->bun2==05){ ?>selected<? }else{ ?> <? } ?>>05</option>
  <option value="10" <? if ($row->bun2==10){ ?>selected<? }else{ ?> <? } ?>>10</option>
  <option value="15" <? if ($row->bun2==15){ ?>selected<? }else{ ?> <? } ?>>15</option>
  <option value="20" <? if ($row->bun2==20){ ?>selected<? }else{ ?> <? } ?>>20</option>
  <option value="25" <? if ($row->bun2==25){ ?>selected<? }else{ ?> <? } ?>>25</option>
  <option value="30" <? if ($row->bun2==30){ ?>selected<? }else{ ?> <? } ?>>30</option>
  <option value="35" <? if ($row->bun2==35){ ?>selected<? }else{ ?> <? } ?>>35</option>
  <option value="40" <? if ($row->bun2==40){ ?>selected<? }else{ ?> <? } ?>>40</option>
  <option value="45" <? if ($row->bun2==45){ ?>selected<? }else{ ?> <? } ?>>45</option>
  <option value="50" <? if ($row->bun2==50){ ?>selected<? }else{ ?> <? } ?>>50</option>
  <option value="55" <? if ($row->bun2==55){ ?>selected<? }else{ ?> <? } ?>>55</option>
</select>
분 </td>
	  </tr>
	  <tr>
	    <td height="25" bgcolor="#FFFFFF">&nbsp; <input type='file' size='36' name='pds2' maxlength='50' style="border-width:1;border-color:#6d6d6d; border-style:solid;"></td>
	    </tr>
	  <tr>
        <td width='100' height="25" rowspan="2" align=center bgcolor=#6699CC><span class="style2">자 료 3</span></td>
        <td bgcolor="#FFFFFF">&nbsp; 오픈시간 3:
          <select name="d03" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
            <option value="0" <? if ($d==0){ ?>selected<? }else{ ?> <? } ?>></option>
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
          일 
          <select name="si3" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
            <option value="0" <? if ($row->si3==0){ ?>selected<? }else{ ?> <? } ?>></option>
            <option value="01" <? if ($row->si3==01){ ?>selected<? }else{ ?> <? } ?>>01</option>
            <option value="02" <? if ($row->si3==02){ ?>selected<? }else{ ?> <? } ?>>02</option>
            <option value="03" <? if ($row->si3==03){ ?>selected<? }else{ ?> <? } ?>>03</option>
            <option value="04" <? if ($row->si3==04){ ?>selected<? }else{ ?> <? } ?>>04</option>
            <option value="05" <? if ($row->si3==05){ ?>selected<? }else{ ?> <? } ?>>05</option>
            <option value="06" <? if ($row->si3==06){ ?>selected<? }else{ ?> <? } ?>>06</option>
            <option value="07" <? if ($row->si3==07){ ?>selected<? }else{ ?> <? } ?>>07</option>
            <option value="08" <? if ($row->si3==08){ ?>selected<? }else{ ?> <? } ?>>08</option>
            <option value="09" <? if ($row->si3==09){ ?>selected<? }else{ ?> <? } ?>>09</option>
            <option value="10" <? if ($row->si3==10){ ?>selected<? }else{ ?> <? } ?>>10</option>
            <option value="11" <? if ($row->si3==11){ ?>selected<? }else{ ?> <? } ?>>11</option>
            <option value="12" <? if ($row->si3==12){ ?>selected<? }else{ ?> <? } ?>>12</option>
            <option value="13" <? if ($row->si3==13){ ?>selected<? }else{ ?> <? } ?>>13</option>
            <option value="14" <? if ($row->si3==14){ ?>selected<? }else{ ?> <? } ?>>14</option>
            <option value="15" <? if ($row->si3==15){ ?>selected<? }else{ ?> <? } ?>>15</option>
            <option value="16" <? if ($row->si3==16){ ?>selected<? }else{ ?> <? } ?>>16</option>
            <option value="17" <? if ($row->si3==17){ ?>selected<? }else{ ?> <? } ?>>17</option>
            <option value="18" <? if ($row->si3==18){ ?>selected<? }else{ ?> <? } ?>>18</option>
            <option value="19" <? if ($row->si3==19){ ?>selected<? }else{ ?> <? } ?>>19</option>
            <option value="20" <? if ($row->si3==20){ ?>selected<? }else{ ?> <? } ?>>20</option>
            <option value="21" <? if ($row->si3==21){ ?>selected<? }else{ ?> <? } ?>>21</option>
            <option value="22" <? if ($row->si3==22){ ?>selected<? }else{ ?> <? } ?>>22</option>
            <option value="23" <? if ($row->si3==23){ ?>selected<? }else{ ?> <? } ?>>23</option>
            <option value="24" <? if ($row->si3==24){ ?>selected<? }else{ ?> <? } ?>>24</option>
          </select>
시
<select name="bun3" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
  <option value="0" <? if ($row->bun3==0){ ?>selected<? }else{ ?> <? } ?>></option>
  <option value="00" <? if ($row->bu3==00){ ?>selected<? }else{ ?> <? } ?>>00</option>
  <option value="05" <? if ($row->bun3==05){ ?>selected<? }else{ ?> <? } ?>>05</option>
  <option value="10" <? if ($row->bun3==10){ ?>selected<? }else{ ?> <? } ?>>10</option>
  <option value="15" <? if ($row->bun3==15){ ?>selected<? }else{ ?> <? } ?>>15</option>
  <option value="20" <? if ($row->bun3==20){ ?>selected<? }else{ ?> <? } ?>>20</option>
  <option value="25" <? if ($row->bun3==25){ ?>selected<? }else{ ?> <? } ?>>25</option>
  <option value="30" <? if ($row->bun3==30){ ?>selected<? }else{ ?> <? } ?>>30</option>
  <option value="35" <? if ($row->bun3==35){ ?>selected<? }else{ ?> <? } ?>>35</option>
  <option value="40" <? if ($row->bun3==40){ ?>selected<? }else{ ?> <? } ?>>40</option>
  <option value="45" <? if ($row->bun3==45){ ?>selected<? }else{ ?> <? } ?>>45</option>
  <option value="50" <? if ($row->bun3==50){ ?>selected<? }else{ ?> <? } ?>>50</option>
  <option value="55" <? if ($row->bun3==55){ ?>selected<? }else{ ?> <? } ?>>55</option>
</select>
분 </td>
	  </tr>
	  <tr>
	    <td height="25" bgcolor="#FFFFFF">&nbsp; <input type='file' size='36' name='pds3' maxlength='50' style="border-width:1;border-color:#6d6d6d; border-style:solid;"></td>
	    </tr>
	  <tr>
        <td width='100' height="25" rowspan="2" align=center bgcolor=#6699CC><span class="style2">자 료 4 </span></td>
        <td bgcolor="#FFFFFF">&nbsp; 오픈시간 4:
          <select name="d04" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
            <option value="0" <? if ($d==0){ ?>selected<? }else{ ?> <? } ?>></option>
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
          일 
          <select name="si4" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
            <option value="0" <? if ($row->si4==0){ ?>selected<? }else{ ?> <? } ?>></option>
            <option value="01" <? if ($row->si4==01){ ?>selected<? }else{ ?> <? } ?>>01</option>
            <option value="02" <? if ($row->si4==02){ ?>selected<? }else{ ?> <? } ?>>02</option>
            <option value="03" <? if ($row->si4==03){ ?>selected<? }else{ ?> <? } ?>>03</option>
            <option value="04" <? if ($row->si4==04){ ?>selected<? }else{ ?> <? } ?>>04</option>
            <option value="05" <? if ($row->si4==05){ ?>selected<? }else{ ?> <? } ?>>05</option>
            <option value="06" <? if ($row->si4==06){ ?>selected<? }else{ ?> <? } ?>>06</option>
            <option value="07" <? if ($row->si4==07){ ?>selected<? }else{ ?> <? } ?>>07</option>
            <option value="08" <? if ($row->si4==08){ ?>selected<? }else{ ?> <? } ?>>08</option>
            <option value="09" <? if ($row->si4==09){ ?>selected<? }else{ ?> <? } ?>>09</option>
            <option value="10" <? if ($row->si4==10){ ?>selected<? }else{ ?> <? } ?>>10</option>
            <option value="11" <? if ($row->si4==11){ ?>selected<? }else{ ?> <? } ?>>11</option>
            <option value="12" <? if ($row->si4==12){ ?>selected<? }else{ ?> <? } ?>>12</option>
            <option value="13" <? if ($row->si4==13){ ?>selected<? }else{ ?> <? } ?>>13</option>
            <option value="14" <? if ($row->si4==14){ ?>selected<? }else{ ?> <? } ?>>14</option>
            <option value="15" <? if ($row->si4==15){ ?>selected<? }else{ ?> <? } ?>>15</option>
            <option value="16" <? if ($row->si4==16){ ?>selected<? }else{ ?> <? } ?>>16</option>
            <option value="17" <? if ($row->si4==17){ ?>selected<? }else{ ?> <? } ?>>17</option>
            <option value="18" <? if ($row->si4==18){ ?>selected<? }else{ ?> <? } ?>>18</option>
            <option value="19" <? if ($row->si4==19){ ?>selected<? }else{ ?> <? } ?>>19</option>
            <option value="20" <? if ($row->si4==20){ ?>selected<? }else{ ?> <? } ?>>20</option>
            <option value="21" <? if ($row->si4==21){ ?>selected<? }else{ ?> <? } ?>>21</option>
            <option value="22" <? if ($row->si4==22){ ?>selected<? }else{ ?> <? } ?>>22</option>
            <option value="23" <? if ($row->si4==23){ ?>selected<? }else{ ?> <? } ?>>23</option>
            <option value="24" <? if ($row->si4==24){ ?>selected<? }else{ ?> <? } ?>>24</option>
          </select>
시
<select name="bun4" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
  <option value="0" <? if ($row->bun4==0){ ?>selected<? }else{ ?> <? } ?>></option>
  <option value="00" <? if ($row->bun4==00){ ?>selected<? }else{ ?> <? } ?>>00</option>
  <option value="05" <? if ($row->bun4==05){ ?>selected<? }else{ ?> <? } ?>>05</option>
  <option value="10" <? if ($row->bun4==10){ ?>selected<? }else{ ?> <? } ?>>10</option>
  <option value="15" <? if ($row->bun4==15){ ?>selected<? }else{ ?> <? } ?>>15</option>
  <option value="20" <? if ($row->bun4==20){ ?>selected<? }else{ ?> <? } ?>>20</option>
  <option value="25" <? if ($row->bun4==25){ ?>selected<? }else{ ?> <? } ?>>25</option>
  <option value="30" <? if ($row->bun4==30){ ?>selected<? }else{ ?> <? } ?>>30</option>
  <option value="35" <? if ($row->bun4==35){ ?>selected<? }else{ ?> <? } ?>>35</option>
  <option value="40" <? if ($row->bun4==40){ ?>selected<? }else{ ?> <? } ?>>40</option>
  <option value="45" <? if ($row->bun4==45){ ?>selected<? }else{ ?> <? } ?>>45</option>
  <option value="50" <? if ($row->bun4==50){ ?>selected<? }else{ ?> <? } ?>>50</option>
  <option value="55" <? if ($row->bun4==55){ ?>selected<? }else{ ?> <? } ?>>55</option>
</select>
분 </td>
	  </tr>
	  <tr>
	    <td height="25" bgcolor="#FFFFFF">&nbsp; <input type='file' size='36' name='pds4' maxlength='50' style="border-width:1;border-color:#6d6d6d; border-style:solid;"></td>
	    </tr>
	  <tr>
        <td width='100' height="25" rowspan="2" align=center bgcolor=#6699CC><span class="style2">자 료 5 </span></td>
        <td bgcolor="#FFFFFF">&nbsp; 오픈시간 5:
          <select name="d05" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
            <option value="0" <? if ($d==0){ ?>selected<? }else{ ?> <? } ?>></option>
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
일
<select name="si5" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
            <option value="0" <? if ($row->si5==0){ ?>selected<? }else{ ?> <? } ?>></option>
            <option value="01" <? if ($row->si5==01){ ?>selected<? }else{ ?> <? } ?>>01</option>
            <option value="02" <? if ($row->si5==02){ ?>selected<? }else{ ?> <? } ?>>02</option>
            <option value="03" <? if ($row->si5==03){ ?>selected<? }else{ ?> <? } ?>>03</option>
            <option value="04" <? if ($row->si5==04){ ?>selected<? }else{ ?> <? } ?>>04</option>
            <option value="05" <? if ($row->si5==05){ ?>selected<? }else{ ?> <? } ?>>05</option>
            <option value="06" <? if ($row->si5==06){ ?>selected<? }else{ ?> <? } ?>>06</option>
            <option value="07" <? if ($row->si5==07){ ?>selected<? }else{ ?> <? } ?>>07</option>
            <option value="08" <? if ($row->si5==08){ ?>selected<? }else{ ?> <? } ?>>08</option>
            <option value="09" <? if ($row->si5==09){ ?>selected<? }else{ ?> <? } ?>>09</option>
            <option value="10" <? if ($row->si5==10){ ?>selected<? }else{ ?> <? } ?>>10</option>
            <option value="11" <? if ($row->si5==11){ ?>selected<? }else{ ?> <? } ?>>11</option>
            <option value="12" <? if ($row->si5==12){ ?>selected<? }else{ ?> <? } ?>>12</option>
            <option value="13" <? if ($row->si5==13){ ?>selected<? }else{ ?> <? } ?>>13</option>
            <option value="14" <? if ($row->si5==14){ ?>selected<? }else{ ?> <? } ?>>14</option>
            <option value="15" <? if ($row->si5==15){ ?>selected<? }else{ ?> <? } ?>>15</option>
            <option value="16" <? if ($row->si5==16){ ?>selected<? }else{ ?> <? } ?>>16</option>
            <option value="17" <? if ($row->si5==17){ ?>selected<? }else{ ?> <? } ?>>17</option>
            <option value="18" <? if ($row->si5==18){ ?>selected<? }else{ ?> <? } ?>>18</option>
            <option value="19" <? if ($row->si5==19){ ?>selected<? }else{ ?> <? } ?>>19</option>
            <option value="20" <? if ($row->si5==20){ ?>selected<? }else{ ?> <? } ?>>20</option>
            <option value="21" <? if ($row->si5==21){ ?>selected<? }else{ ?> <? } ?>>21</option>
            <option value="22" <? if ($row->si5==22){ ?>selected<? }else{ ?> <? } ?>>22</option>
            <option value="23" <? if ($row->si5==23){ ?>selected<? }else{ ?> <? } ?>>23</option>
            <option value="24" <? if ($row->si5==24){ ?>selected<? }else{ ?> <? } ?>>24</option>
          </select>
시
<select name="bun5" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
  <option value="0" <? if ($row->bun5==0){ ?>selected<? }else{ ?> <? } ?>></option>
  <option value="00" <? if ($row->bun5==00){ ?>selected<? }else{ ?> <? } ?>>00</option>
  <option value="05" <? if ($row->bun5==05){ ?>selected<? }else{ ?> <? } ?>>05</option>
  <option value="10" <? if ($row->bun5==10){ ?>selected<? }else{ ?> <? } ?>>10</option>
  <option value="15" <? if ($row->bun5==15){ ?>selected<? }else{ ?> <? } ?>>15</option>
  <option value="20" <? if ($row->bun5==20){ ?>selected<? }else{ ?> <? } ?>>20</option>
  <option value="25" <? if ($row->bun5==25){ ?>selected<? }else{ ?> <? } ?>>25</option>
  <option value="30" <? if ($row->bun5==30){ ?>selected<? }else{ ?> <? } ?>>30</option>
  <option value="35" <? if ($row->bun5==35){ ?>selected<? }else{ ?> <? } ?>>35</option>
  <option value="40" <? if ($row->bun5==40){ ?>selected<? }else{ ?> <? } ?>>40</option>
  <option value="45" <? if ($row->bun5==45){ ?>selected<? }else{ ?> <? } ?>>45</option>
  <option value="50" <? if ($row->bun5==50){ ?>selected<? }else{ ?> <? } ?>>50</option>
  <option value="55" <? if ($row->bun5==55){ ?>selected<? }else{ ?> <? } ?>>55</option>
</select>
분 </td>
	  </tr>
	  <tr>
	    <td height="25" bgcolor="#FFFFFF">&nbsp; <input type='file' size='36' name='pds5' maxlength='50' style="border-width:1;border-color:#6d6d6d; border-style:solid;"></td>
	    </tr>
	  <tr>
        <td width='100' height="25" rowspan="2" align=center bgcolor=#6699CC><span class="style2">자 료 6 </span></td>
        <td bgcolor="#FFFFFF">&nbsp; 오픈시간 6:
          <select name="d06" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
            <option value="0" <? if ($d==0){ ?>selected<? }else{ ?> <? } ?>></option>
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
일
<select name="si6" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
            <option value="0" <? if ($row->si6==0){ ?>selected<? }else{ ?> <? } ?>></option>
            <option value="01" <? if ($row->si6==01){ ?>selected<? }else{ ?> <? } ?>>01</option>
            <option value="02" <? if ($row->si6==02){ ?>selected<? }else{ ?> <? } ?>>02</option>
            <option value="03" <? if ($row->si6==03){ ?>selected<? }else{ ?> <? } ?>>03</option>
            <option value="04" <? if ($row->si6==04){ ?>selected<? }else{ ?> <? } ?>>04</option>
            <option value="05" <? if ($row->si6==05){ ?>selected<? }else{ ?> <? } ?>>05</option>
            <option value="06" <? if ($row->si6==06){ ?>selected<? }else{ ?> <? } ?>>06</option>
            <option value="07" <? if ($row->si6==07){ ?>selected<? }else{ ?> <? } ?>>07</option>
            <option value="08" <? if ($row->si6==08){ ?>selected<? }else{ ?> <? } ?>>08</option>
            <option value="09" <? if ($row->si6==09){ ?>selected<? }else{ ?> <? } ?>>09</option>
            <option value="10" <? if ($row->si6==10){ ?>selected<? }else{ ?> <? } ?>>10</option>
            <option value="11" <? if ($row->si6==11){ ?>selected<? }else{ ?> <? } ?>>11</option>
            <option value="12" <? if ($row->si6==12){ ?>selected<? }else{ ?> <? } ?>>12</option>
            <option value="13" <? if ($row->si6==13){ ?>selected<? }else{ ?> <? } ?>>13</option>
            <option value="14" <? if ($row->si6==14){ ?>selected<? }else{ ?> <? } ?>>14</option>
            <option value="15" <? if ($row->si6==15){ ?>selected<? }else{ ?> <? } ?>>15</option>
            <option value="16" <? if ($row->si6==16){ ?>selected<? }else{ ?> <? } ?>>16</option>
            <option value="17" <? if ($row->si6==17){ ?>selected<? }else{ ?> <? } ?>>17</option>
            <option value="18" <? if ($row->si6==18){ ?>selected<? }else{ ?> <? } ?>>18</option>
            <option value="19" <? if ($row->si6==19){ ?>selected<? }else{ ?> <? } ?>>19</option>
            <option value="20" <? if ($row->si6==20){ ?>selected<? }else{ ?> <? } ?>>20</option>
            <option value="21" <? if ($row->si6==21){ ?>selected<? }else{ ?> <? } ?>>21</option>
            <option value="22" <? if ($row->si6==22){ ?>selected<? }else{ ?> <? } ?>>22</option>
            <option value="23" <? if ($row->si6==23){ ?>selected<? }else{ ?> <? } ?>>23</option>
            <option value="24" <? if ($row->si6==24){ ?>selected<? }else{ ?> <? } ?>>24</option>
          </select>
시
<select name="bun6" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
  <option value="0" <? if ($row->bun6==0){ ?>selected<? }else{ ?> <? } ?>></option>
  <option value="00" <? if ($row->bun6==00){ ?>selected<? }else{ ?> <? } ?>>00</option>
  <option value="05" <? if ($row->bun6==05){ ?>selected<? }else{ ?> <? } ?>>05</option>
  <option value="10" <? if ($row->bun6==10){ ?>selected<? }else{ ?> <? } ?>>10</option>
  <option value="15" <? if ($row->bun6==15){ ?>selected<? }else{ ?> <? } ?>>15</option>
  <option value="20" <? if ($row->bun6==20){ ?>selected<? }else{ ?> <? } ?>>20</option>
  <option value="25" <? if ($row->bun6==25){ ?>selected<? }else{ ?> <? } ?>>25</option>
  <option value="30" <? if ($row->bun6==30){ ?>selected<? }else{ ?> <? } ?>>30</option>
  <option value="35" <? if ($row->bun6==35){ ?>selected<? }else{ ?> <? } ?>>35</option>
  <option value="40" <? if ($row->bun6==40){ ?>selected<? }else{ ?> <? } ?>>40</option>
  <option value="45" <? if ($row->bun6==45){ ?>selected<? }else{ ?> <? } ?>>45</option>
  <option value="50" <? if ($row->bun6==50){ ?>selected<? }else{ ?> <? } ?>>50</option>
  <option value="55" <? if ($row->bun6==55){ ?>selected<? }else{ ?> <? } ?>>55</option>
</select>
분 </td>
	  </tr>
	  <tr>
	    <td height="25" bgcolor="#FFFFFF">&nbsp; <input type='file' size='36' name='pds6' maxlength='50' style="border-width:1;border-color:#6d6d6d; border-style:solid;"></td>
	    </tr>

    </table>
	
	<br>
<br>

<div align="center">
  <? if($id != ''){ ?>
  <input type=button onclick='update()' value='수 정'style="background-color:#EEE0E5;border-width:1; border-style:solid;">
  &nbsp;
  <input type=button onclick='deleteData()' value='삭 제'style="background-color:#EEE0E5 ;border-width:1; border-style:solid;">
  &nbsp;
  
      <?}else{?>
  
  <input type='button' onclick='check()' value=' 등 록 'style="background-color:#FFF0F5;border-width:1; border-style:solid;">
  &nbsp;
  
      <?}?>
  
      <input type='button' onClick="javascript:history.back();" value='취 소' style="background-color:#FFF0F5;border-width:1; border-style:solid;">
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
