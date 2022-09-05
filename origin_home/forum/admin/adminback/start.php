
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
<link rel="stylesheet" type="text/css" href="css/style.css">
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
		방사선안전관리자 포럼 관리자페이지
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