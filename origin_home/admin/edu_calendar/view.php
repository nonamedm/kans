<?
if(!$cid){
	echo"<meta http-equiv=\"Refresh\" content=\"0 ; URL='../index.php'\">";
	exit;
}
include "../dbconn.inc";

$today = getdate(); 

if(!$sYear) { $sYear = $today['year']; }
if(!$sMonth) { $sMonth = $today['mon']; }
if(!$sDay) { $sDay = $today['mday']; }

$display_year = $sYear;
$display_month = $sMonth;
$display_day = 1;

if($display_month == 0) {
	$display_year = $display_year - 1;
	$display_month = 12;
}
if($display_month == 13) {
	$display_year = $display_year + 1;
	$display_month = 1;
}
?>

<html>
<head>
	<title>:::: Secure ::::</title>
<link rel="stylesheet" href="../style.css" type="text/css">
<script language="javascript">

function updateData(uid){
	var theURL='./update_form.php?uid='+uid;
	var features='left=280,top=250,width=470,height=280,toolbars=no,menubar=no,scrollbars=no,status=no,resizable=no';
	window.open(theURL,"",features);
}

function insertData(){
	var theURL='./write_form.php';
	var features='left=280,top=250,width=470,height=280,toolbars=no,menubar=no,scrollbars=no,status=no,resizable=no';
	window.open(theURL,"",features);
}
</script>
</head>
<body topmargin=0 leftmargin=0>
<center>
<br>
<table width="750" border="0" cellpadding="2" cellspacing="2" vspace="2" hspace="2">
	<tr>
		<td>교육일정(달력)</td>
	</tr>
</table>
<table cellpadding="0" cellspacing="0" width="750" border="0">
	<tr>
		<td align="center" class="tit_2">
			<a href="?sYear=<?=$display_year-1?>&sMonth=<?=$display_month?>"><img align="absmiddle" border="0" src="../images/brd_bn_first.gif"></a>
			<a href="?sYear=<?=$display_year?>&sMonth=<?=$display_month-1?>"><img align="absmiddle" border="0" hspace="4" src="../images/brd_bn_prev.gif"></a>
				&nbsp;<?=$display_year?>. <font color="#338ac1"><b><?=$display_month?></b></font>&nbsp;
			<a href="?sYear=<?=$display_year?>&sMonth=<?=$display_month+1?>"><img align="absmiddle" border="0" hspace="4" src="../images/brd_bn_next.gif"></a>
			<a href="?sYear=<?=$display_year+1?>&sMonth=<?=$display_month?>"><img align="absmiddle" border="0" src="../images/brd_bn_end.gif"></a> 
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>
			<table border="0" cellpadding="1" cellspacing="1" width="100%" bgcolor="#eff1f4">
				<tr valign="bottom">
					<td bgcolor="#ccdbe5" class="style11" height="22" style="padding-top:4px;" align="center" valign="middle" width="105">&nbsp;일요일</td>
					<td bgcolor="#ccdbe5" class="style11" height="22" style="padding-top:4px;" align="center" valign="middle" width="105">&nbsp;월요일</td>
					<td bgcolor="#ccdbe5" class="style11" height="22" style="padding-top:4px;" align="center" valign="middle" width="105">&nbsp;화요일</td>
					<td bgcolor="#ccdbe5" class="style11" height="22" style="padding-top:4px;" align="center" valign="middle" width="105">&nbsp;수요일</td>
					<td bgcolor="#ccdbe5" class="style11" height="22" style="padding-top:4px;" align="center" valign="middle" width="105">&nbsp;목요일</td>
					<td bgcolor="#ccdbe5" class="style11" height="22" style="padding-top:4px;" align="center" valign="middle" width="105">&nbsp;금요일</td>
					<td bgcolor="#ccdbe5" class="style11" height="22" style="padding-top:4px;" align="center" valign="middle" width="105">&nbsp;토요일</td>
				</tr>
				<tr bgcolor="#F3F1EC" valign="top">
<?
	$dayoftheweek = date("w", mktime (0,0,0,$display_month,1,$display_year));
	for ($i = 1 ; $i <= $dayoftheweek;  $i++) {
?>
					<td align="left" bgcolor="#ffffff" height="50" width="105">&nbsp;</td>
<? } ?>
<?
	$lastday=array(0,31,28,31,30,31,30,31,31,30,31,30,31);
	if ($display_year%4 == 0) $lastday[2] = 29;
	
	for ($i = 1 ; $i <= $lastday[$display_month];  $i++) {

		if (date("w", mktime (0,0,0,$display_month,$i,$display_year)) == 0 && $i != 1 ) { ?>
				</tr>
				<tr align="left" bgcolor="#ffffc0">
<?		} ?>
					<td bgcolor="#ffffff" height="50" valign="top" width="105">
						<table border="0" cellpadding="0" cellspacing="0" height="15" width="15">
							<tr>
								<td align="middle" bgcolor="#ccdbe5" class="TD_S">
									<a href="?syear=<?=$display_year?>&smonth=<?=$display_month?>&sday=<?=i?>&process=read"><font color="#000000"><b><?=$i?></b></font></a>
								</td>
							</tr>
						</table>
						<table bgcolor="#ffcccc" border="0" cellpadding="0" cellspacing="0" style="height:15px;margin-top:2px" width="96%">
							<tr>
								<td>&nbsp;<?=$i?></td>
							</tr>
						</table>
						<table bgcolor="#ff66ff" border="0" cellpadding="0" cellspacing="0" style="height:15px;" width="96%">
							<tr>
								<td>&nbsp;<?=$i?></td>
							</tr>
						</table>
						<table bgcolor="#ff66ff" border="0" cellpadding="0" cellspacing="0" style="height:15px;" width="96%">
							<tr>
								<td>&nbsp;<?=$i?></td>
							</tr>
						</table>
						<table bgcolor="#ff66ff" border="0" cellpadding="0" cellspacing="0" style="height:15px;" width="96%">
							<tr>
								<td>&nbsp;<?=$i?></td>
							</tr>
						</table>
						<table bgcolor="#ff66ff" border="0" cellpadding="0" cellspacing="0" style="height:15px;" width="96%">
							<tr>
								<td>&nbsp;<?=$i?></td>
							</tr>
						</table>
						<table bgcolor="#ff66ff" border="0" cellpadding="0" cellspacing="0" style="height:15px;" width="96%">
							<tr>
								<td>&nbsp;<?=$i?></td>
							</tr>
						</table>
					</td>
<? } ?>
<?
	if (date("w", mktime (0,0,0,$display_month,$i,$display_year)) != 0) {
			for ($j = 0 ; $j <= 6-date("w", mktime (0,0,0,$display_month,$i,$display_year));  $j++) { ?>
					<td align="left" bgcolor="#ffffff" height="50" width="105">&nbsp;</td>
<?
			}
	}
?>
				</tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>
