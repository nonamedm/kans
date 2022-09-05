<?
if(!$cid){
	echo"<meta http-equiv=\"Refresh\" content=\"0 ; URL='../index.php'\">";
	exit;
}
include "../dbconn.inc";

$sql="select * from edu_repair where uid=".$uid;
$res=mysql_query($sql);
$rs=mysql_fetch_object($res);

$sql="select * from edu_repairs where repair_id=".$uid;
$res=mysql_query($sql);
$total=mysql_affected_rows();

?>

<html>
<head>
	<title>:::: 보수교육 신청자들 ::::</title>
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
		 * 성명 : <?=$rs->name?> <br>
		 * 주소 : <?=$rs->address?> <br>
		 * 전화 : <?=$rs->phone?> <br><br>

		 * 근무처 : <?=$rs->job?> <br>
		 * 소재지 : <?=$rs->job_address?>  <br>
		 * 전화 : <?=$rs->job_phone?> <br><br>

		 * 면허종류 : <?=$rs->d_licens?> <br>
		 * 발행일 : <?=$rs->d_date?> <br>
		 * 최종교육수료일 : <?=$rs->e_end_date?> <br>
		 * 교육희망기관 : <?=$rs->hope_organ?> <br>
		 * 교육희망일자 : <?=$rs->hope_date?> <br>
</td></tr>
		<tr>
		<td align="center" colspan='2'>
			<table border="0" width="100%" cellpadding="3" cellspacing="1">
				<tr bgcolor="#F0F0F0">
				<td height="20" align="center" width="40">no.</td>
				<td align="center" width="100">근무처</td>
				<td align="center" width="200">담당업무내용</td>
				<td align="center" width="200">재직기간</td>
				<td align="center" width="150">최근보수교육이수일</td>

<?
$n=$total;
for($i=0; $i<$total; $i++){
	$row = mysql_fetch_object($res);			//한 열씩 객체형택로 가져온다

?>
				<tr>
				<td height="20" align="center"><?=$n?></td>
				<td  align="center"><?=$row->job?></td>
				<td  align="center"><?=$row->work?></td>
				<td  align="center"><?=$row->active_date?>~<?=$row->end_date?></td>
				<td  align="center"><?=$row->edu_recent_date?></td>
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
