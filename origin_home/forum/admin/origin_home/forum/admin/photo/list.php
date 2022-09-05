<?
if(!$cid){
	echo"<meta http-equiv=\"Refresh\" content=\"0 ; URL='../index.php'\">";
	exit;
}
include "../dbconn.inc";


$sql="select * from board_config A, board B where A.bbs_id=B.bbs_id and A.bbs_id=16 order by  B.fid desc, B.thread asc";
$res=mysql_query($sql);
$total=mysql_affected_rows();

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
		<td>	사진 게시판 리스트 // 총 갯수 : <?=$total?> </td>
		<td align='right'>	<a href='javascript:insertData();'>글쓰기</a> </td>
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
				<td align="center" width="*">제목</td>
				<td align="center" width="150">파일</td>
				<td align="center" width="80">작성자</td>
				<td align="center" width="80">작성일</td>
				<td align="center" width="50">조회</td>
<?
if($total<1)
{
	echo"<tr align=center><td height='30' align='center' colspan='7'>등록된 게시물이 없습니다.</td></tr>";
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

	$length=strlen($row->thread);
	if($length>1)	$re="<img src='../img/aline.gif' border=0>";
	else	$re='';
	$length=$length.'0';

	if($row->filename) $down="<a href='/photo_files/".$row->filename."' target='_blank'>".$row->filename."</a>";
	else $down = '-';
?>
				<tr>
				<td height="20" align="center"><?=$n?></td>
				<td>
					<table border=0 cellpadding=0 cellspacing=0 width=310>
					<tr>
						<td width='<?=$length?>'>&nbsp;</td>
						<td><?=$re?>
						<a href="javascript:updateData('<?=$row->uid?>')"><?=$row->title?></a></td><tr>
					</table>

				</td>
				<td  align="center"><?=$down?></td>
				<td  align="center"><?=$row->writer?></td>
				<td  align="center"><?=$row->reg_date?></td>
				<td  align="center"><?=$row->visit?></td>
			</tr>
			<tr height="1"><td colspan="6" background="../img/BwDotH2.gif"></td></tr>			
<?
	$n = $n-1;
}
?>
			</table>
			<br>
			<table width="100%" border="0" align="center">
				<tr>
				<td align="center">
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
				</td>
			</table>
		</td>
	</table>
</body>
</html>
