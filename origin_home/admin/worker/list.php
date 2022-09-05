<?
if(!$cid){
	echo"<meta http-equiv=\"Refresh\" content=\"0 ; URL='../index.php'\">";
	exit;
}
include "../dbconn.inc";

if($keyword){
	if($search=='organ') 	
		$sql="select * from edu_worker where organ_name like '%".$keyword."%' order by uid desc";
	else if($search=='jumin')
		$sql="select a.* from edu_worker a, edu_worders b where a.uid=b.worker_id and b.jumin like '%".$keyword."%'  group by a.uid";
	else
		$sql="select a.* from edu_worker a, edu_worders b where a.uid=b.worker_id and b.hope_day like '%".$keyword."%' group by a.uid";
}else{
	$sql="select * from edu_worker order by uid desc";
}

$res=mysql_query($sql);
$total=mysql_affected_rows();

?>

<html>
<head>
	<title>:::: Secure ::::</title>
<link rel="stylesheet" href="../style.css" type="text/css">
<script language="javascript">

function viewData(uid){
	var theURL='./viewData.php?uid='+uid;
	var features='left=280,top=250,width=610,height=350,toolbars=no,menubar=no,scrollbars=yes,status=no,resizable=yes';
	window.open(theURL,"viewData",features);
}

function insertData(){
	var theURL='./write_form.php';
	var features='left=280,top=250,width=470,height=280,toolbars=no,menubar=no,scrollbars=no,status=no,resizable=no';
	window.open(theURL,"",features);
}

function searchData(){
	frm.action = './list.php';
	frm.submit();
}

function excelData(){
	frm.action = './toExcel.php';
	frm.submit();
}
</script>
</head>
<body topmargin=0 leftmargin=0>
<center>
<br>
	<table width="800" border="0" cellpadding="2" cellspacing="2" vspace="2" hspace="2">
		<tr>
		<td>	종사자 교육신청 리스트 // 총 갯수 : <?=$total?> </td>
		<td align='right'> <a href='javascript:excelData();'>Excel download</a></td>
		</tr>
		<tr>
		<td colspan='2'>
			<hr>
		</td>
		<tr>
		<td align="center" colspan='2'>
			<table border="0" width="100%" cellpadding="3" cellspacing="1">
				<tr bgcolor="#F0F0F0">
				<td height="20" align="center" width="40">no.</td>
				<td align="center" width="200">기관명</td>
				<td align="center" width="80">대표자</td>
				<td align="center" width="80">신청자</td>
				<td align="center" width="150">email</td>
				<td align="center" width="100">핸드폰</td>
				<td align="center" width="100">신청자수</td>
				<td align="center" width="100">신청일</td>
<?
if($total<1)
{
	echo"<tr align=center><td height='30' align='center' colspan='8'>등록된 게시물이 없습니다.</td></tr>";
}
/***** 페이지 카운트 관련 기본값 설정 **********************************************/

// 한 페이지에 리스트 시킬 레코드 수

if($list == ''){
	$list=10;		
}
//현재 페이지 값 설정
if(!$page)	$page = 1;   

// 전체 페이지 값 얻기
if(($total%$list)== 0)	$totalpage =  intval($total / $list);
else	$totalpage = intval($total / $list) + 1;

// 페이지 그룹 값 설정(페이지 카운터를 몇 개까지 출력할 것인지 설정)

if(($page%10) == 0)	$pagelist = intval($page / 10);
else	$pagelist = intval($page / 10) + 1;

$start = ($page-1)* $list;												// 현재 페이지에서 시작 레코드 값 설정
$end = ($page) * $list;													// 현재 페이지에서 마지막 레코드 값 설정

if($end > $total) 	$end = $total;

// 현재 페이지에서 리스트의 레코드 시작 레코드로 이동

if ($page > 1) mysql_data_seek($res, $start);

/***** 페이지 카운트 관련 기본값 설정 끝 *******************************************/
$cpage=$page - 1;
$n = $total - $cpage*$list ;

/***** 리스트 출력  // 현재 페이지에 해당 하는 리스트만 출력**********************************************/
for($i=$start; $i<$end; $i++){
	$row = mysql_fetch_object($res);			//한 열씩 객체형택로 가져온다

	$sql = "select count(*) from edu_worders where worker_id=".$row->uid;
	$rs = mysql_query($sql);
	$rw = mysql_fetch_row($rs);
	$count = $rw[0];
?>
				<tr>
				<td height="20" align="center"><?=$n?></td>
				<td  align="center"><a href='javascript:viewData(<?=$row->uid?>);'><?=$row->organ_name?></a></td>
				<td  align="center"><?=$row->owner?></td>
				<td  align="center"><?=$row->name?></td>
				<td  align="center"><?=$row->email?></td>
				<td  align="center"><?=$row->mobile?></td>
				<td  align="center"><?=$count?>명</td>
				<td  align="center"><?=substr($row->regdate,0,10)?></td>
			</tr>
			<tr height="1"><td colspan="8" background="../img/BwDotH2.gif"></td></tr>			
<?
	$n = $n-1;
}
?>
			</table>
			<br>
			<table width="100%" border="0" align="center">
			<form name='frm' method='post' action='./list.php'>
				<tr>
				<td width='50%'>
				<select name='search'>
				<option value='organ'>기관명</option>
				<option value='jumin'>주민번호</option>
				<option value='hope'>희망교육일</option>
				</select>
				<input type='text' name='keyword' size='12'>
				<input type=button onclick='searchData()' value='검색' style="background-color:#EEE0E5 ;border-width:1; border-style:solid;">
				</td>
				<td width='50%'>
 <?
/****************************** 페이지 카운터 출력 ***********************************/
if($pagelist > 1)																										// 페이지 그룹단위로 앞으로 이동
{
   $p_page = (($pagelist -1)*10-1);
  echo "<a href=list.php?page=$p_page&search=$search&keyword=$keyword>[이전 10개]</a>";
} 

$startpage = ($pagelist-1)*10+1;
$endpage = $pagelist*10;
if ($totalpage < $pagelist*10) $endpage = $totalpage;
for ($i=$startpage; $i<=$endpage; $i++) {																				// 현재 페이지
    if ($i==$page) { 
	echo " [$i] ";
    }else{
	echo " <a href=list.php?page=$i&search=$search&keyword=$keyword>[$i]</a> ";
    } 
}
if ($pagelist*10 < $totalpage) {																						// 페이지 그룹단위로 뒤로 이동
    $n_page = ($pagelist*10+1);
   echo "<a href=list.php?page=$n_page&search=$search&keyword=$keyword>[다음  10개]</a>";
}
/****************************** 페이지 카운터 출력  끝***********************************/
?>
				</td></tr>
				</form>

			</table>
		</td>
	</table>
</body>
</html>

<script>
<?if($search) echo "frm.search.value='".$search."';";?>
frm.keyword.value = "<?=$keyword?>";
</script>