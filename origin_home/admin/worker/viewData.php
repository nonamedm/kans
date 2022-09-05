<?
if(!$cid){
	echo"<meta http-equiv=\"Refresh\" content=\"0 ; URL='../index.php'\">";
	exit;
}
include "../dbconn.inc";

$sql="select * from edu_worker where uid=".$uid;
$res=mysql_query($sql);
$rs=mysql_fetch_object($res);

$sql="select * from edu_worders where worker_id=".$uid;
$res=mysql_query($sql);
$total=mysql_affected_rows();

?>

<html>
<head>
	<title>:::: 종사자교육 신청자들 ::::</title>
<link rel="stylesheet" href="../style.css" type="text/css">
<script language="javascript">

function viewData(uid){
	var theURL='./viewData.php?uid='+uid;
	var features='left=280,top=250,width=470,height=280,toolbars=no,menubar=no,scrollbars=yes,status=no,resizable=yes';
	window.open(theURL,"viewData",features);
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
	<table width="590" border="0" cellpadding="2" cellspacing="2" vspace="2" hspace="2">
		<tr>
		<td align="left" colspan='2'>
		 * 기관명 : <?=$rs->organ_name?> <br>
		 * 주소 : <?=$rs->address?> (<?=$rs->zipcode?>) <br>
		 * 연락처 : <?=$rs->phone?> <br>
		</td></tr>
		<tr>
		<td align="center" colspan='2'>
			<table border="0" width="100%" cellpadding="3" cellspacing="1">
				<tr bgcolor="#F0F0F0">
				<td height="20" align="center" width="40">no.</td>
				<td align="center" width="100">성명</td>
				<td align="center" width="120">주민등록번호</td>
				<td align="center" width="150">소속부서</td>
				<td align="center" width="80">교육구분</td>
				<td align="center" width="100">희망교육일</td>

<?
$n=$total;
for($i=0; $i<$total; $i++){
	$row = mysql_fetch_object($res);			//한 열씩 객체형택로 가져온다

	if($row->edu_flag=="1") $edu = "신규";
	else $edu = "기존";
?>
				<tr>
				<td height="20" align="center"><?=$n?></td>
				<td  align="center"><?=$row->name?></td>
				<td  align="center"><?=$row->jumin?></td>
				<td  align="center"><?=$row->dept?></td>
				<td  align="center"><?=$edu?></td>
				<td  align="center"><?=$row->hope_day?></td>
			</tr>
			<tr height="1"><td colspan="8" background="../img/BwDotH2.gif"></td></tr>			
<?
	$n = $n-1;
}
?>
			</table>

		</td></tr>
		<tr>
		<td align="center" colspan='2'>
		<br>
		<input type=button onclick='javascript:window.close()' value='close'style="background-color:#EEE0E5;border-width:1; border-style:solid;">
		</td></tr>


	</table>
</body>
</html>
