<?
if(!$cid){
	echo"<script language=javascript>window.close();</script>";
	exit;
}
$now=mktime();
$now=date(Y.'.'.m.'.'.d,$now);
$y=date(Y);
$m=date(m);
$d=date(d);
?>
<html>
<head>
<title>:::: 납부일 추가 ::::</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link rel="stylesheet" href="../style.css" type="text/css">
<script language=javascript>
function check(){

var form=document.form;
var str = confirm("납부일을 추가 하시겠습니까?");
if (str)	form.submit();
}

</script>

<style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
</style>
</head>

<body leftmargin='0' topmargin='0'  onLoad='startUp();'>

<form name='form' action='pay_day_add.php' method='post'>
<input type=hidden name='id' value='<?=$id?>'>
<input type=hidden name='ju' value='<?=$ju?>'>

<table width=500 border=0 align=center cellpadding=1 cellspacing=1 bgcolor="#6699CC" >
          <td width="100" height="25" align="center" bgcolor="#6699CC"><span class="style1">납부일 추가</span></td>
          <td width="393" height="25" bgcolor="#FFFFFF">&nbsp;
		  <select name="pay_year" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
			<option value="2002" <? if ($y==2002){ ?>selected<? }else{ ?> <? } ?>>2002</option>
			<option value="2003" <? if ($y==2003){ ?>selected<? }else{ ?> <? } ?>>2003</option>
			<option value="2004" <? if ($y==2004){ ?>selected<? }else{ ?> <? } ?>>2004</option>
			<option value="2005" <? if ($y==2005){ ?>selected<? }else{ ?> <? } ?>>2005</option>
			<option value="2006" <? if ($y==2006){ ?>selected<? }else{ ?> <? } ?>>2006</option>
            <option value="2007" <? if ($y==2007){ ?>selected<? }else{ ?> <? } ?>>2007</option>
            <option value="2008" <? if ($y==2008){ ?>selected<? }else{ ?> <? } ?>>2008</option>
            <option value="2009" <? if ($y==2009){ ?>selected<? }else{ ?> <? } ?>>2009</option>
            <option value="2010" <? if ($y==2010){ ?>selected<? }else{ ?> <? } ?>>2010</option>
          </select>년도
          <select name="pay_month" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
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
          <select name="pay_day" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
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
          <input type="button" name="pay_day_a" value="  추가  " onClick="check();">
	  </td>
</table>
<br>
<br>
<div align="center">
    <input type=button onClick="javascript:window.close();" value=' 닫기 ' style="background-color:#FFF0F5;border-width:1; border-style:solid;">
&nbsp;
</div>
</form>
</body>
</html>