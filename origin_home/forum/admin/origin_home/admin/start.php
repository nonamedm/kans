
<br><br>
<?
include "./dbconn.inc";
include "./cnt.php";

$date = mktime();
$time = date(Y.'-'.m.'-'.d,$date);
$yesterday  = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
$yesterday = date(Y.'-'.m.'-'.d,$yesterday);


	$sql="select * from request where reg_date like '".$time."%%'";
	mysql_query($sql);
	$today_total=mysql_affected_rows();

	$sql="select * from request where reg_date like '".$yesterday."%%'";
	mysql_query($sql);
	$yesterday_total=mysql_affected_rows();

	$sql="select * from request ";
	mysql_query($sql);
	$total=mysql_affected_rows();
?>


<html>
<head>
<title></title>
<link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body topmargin=0 leftmargin=0>
<form action="./day.asp" method="post" name="Form1">
<TABLE WIDTH="700" ALIGN="CENTER">
<TR>
<TD ALIGN="CENTER" VALIGN="TOP">
<table width=100% cellspacing=0 cellpadding=0>
<tr><td height=1 background="./image/dot.gif"></td></tr>
<tr>
	<td align=center height=20>
		Admin Main Page..
	</td>
</tr>	
<tr><td height=1 background="./image/dot.gif"></td></tr>
</table>

<br>
<table width=100% cellpadding=0 cellspacing=0 border=0>
<tr>
	<td align="left">
	</td>
	<td align="right">
	</td>
</tr>
</table>
<table width=100% cellpadding=0 cellspacing=0 border=0>
<tr bgcolor="#9EA7D1" height=2>
	<td align=center></td>
</tr>
</table>
<table width="100%" border=0 cellpadding=0 cellspacing="0" background="./img/grid.gif">
<tr height="450">
	<td align="center" valign="center">		<table border=0 cellpadding=2 cellspacing=1 align=center style="display:inline;border-left:5px solid #ffffff;border-top:10px solid #ffffff;" id="count">
      <tr >
        <td bgcolor=#EEEEEE> 전체 </td>
        <td width=110 align=right bgcolor=#F7F7F7 style="letter-spacing:3px;padding-right:5px;color:#888888"><?=number_format($cnt_total)?></td>
      </tr>
      <tr >
        <td bgcolor=#EEEEEE> 어제 </td>
        <td width=110 align=right bgcolor=#F7F7F7 style="letter-spacing:3px;padding-right:5px;color:#888888"><?=number_format($cnt_yday)?></td>
      </tr>
      <tr>
        <td bgcolor=#EEEEEE> 오늘 </td>
        <td width=110 align=right bgcolor=#F7F7F7 style="letter-spacing:3px;padding-right:5px;color:#888888"><?=number_format($cnt_today)?></td>
      </tr>
    </table></td>
</tr>
<tr align="center" bgcolor="#DFE2F0" height="15"> 
	<td colspan="3" class="tahoma7pt" align="center">made by Zoppy</td>
</tr>
</table>
<table width=100% cellpadding=0 cellspacing=0 border=0>
<tr bgcolor="#9EA7D1" height=2>
	<td align=center></td>
</tr>
</table>
</TD>
</TR>
</TABLE>
</form>
</body>
</html>