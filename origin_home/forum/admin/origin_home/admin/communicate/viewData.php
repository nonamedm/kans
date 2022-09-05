<?
if(!$cid){
	echo"<meta http-equiv=\"Refresh\" content=\"0 ; URL='../index.php'\">";
	exit;
}
include "../dbconn.inc";

$sql="select * from edu_comunicate where uid=".$uid;
$res=mysql_query($sql);
$rs=mysql_fetch_object($res);

$sql="select * from edu_worders where worker_id=".$uid;
$res=mysql_query($sql);
$total=mysql_affected_rows();

?>

<html>
<head>
	<title>:::: 통신교육 신청자 ::::</title>
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
	<table width="100%" border="0" cellpadding="2" cellspacing="2" vspace="2" hspace="2">
		<tr>
		<td align="left" colspan='2'>
<?
	if($rs->post_flag=='1') $post_flag = "자택";
	else $post_flag = "직장";
?>
		 * 성명 : <?=$rs->name?> <br>
		 * 주민등록번호 : <?=$rs->jumin?>  <br>
		 * 이메일 : <?=$rs->email?> <br>
		 * 우편물 도착지 : <?=$post_flag?> <br>
		 * 주소 : <?=$rs->address?> <br>
		 * 연락처 : <?=$rs->phone?> <br>
		 * 핸드폰 : <?=$rs->mobile?> <br>
		 * 근무처 : <?=$rs->job?>) <br>
		 * 부서 : <?=$rs->dept?> <br>
		 * 주소(근무처) : <?=$rs->job_address?> <br>
		 * 전화(근무처) : <?=$rs->job_phone?> <br>
		 * 신청자 : <?=$rs->applier?> <br>
		 * 신청일 : <?=$rs->reg_date?> <br>
		</td></tr>
		<tr>
		<td align="center" colspan='2'>
		<br>
		<input type=button onclick='javascript:window.close()' value='close'style="background-color:#EEE0E5;border-width:1; border-style:solid;">
		</td></tr>


	</table>
</body>
</html>
