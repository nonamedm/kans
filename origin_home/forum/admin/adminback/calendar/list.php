<?
if(!$cid){
	echo"<meta http-equiv=\"Refresh\" content=\"0 ; URL='../index.php'\">";
	exit;
}
include "../dbconn.inc";

$sql="select * from board_config A, edu_calendar B where A.bbs_id=B.bbs_id and A.bbs_id=20 order by  B.uid desc";
$res=mysql_query($sql);
$total=mysql_affected_rows();

$today = getdate(); 

if(!$sYear) { $sYear = $today['year']; }
if(!$sMonth) { $sMonth = $today['mon']; }
if(!$sDay) { $sDay = $today['mday']; }

?>

<html>
<head>
	<title>:::: Secure ::::</title>
<link rel="stylesheet" href="../style.css" type="text/css">
<script language="javascript">

function updateData(uid){
	var theURL='./update_form.php?uid='+uid;
	var features='left=280,top=250,width=470,height=320,toolbars=no,menubar=no,scrollbars=no,status=no,resizable=no';
	window.open(theURL,"",features);
}

function insertData(){
	var theURL='./write_form.php';
	var features='left=280,top=250,width=470,height=320,toolbars=no,menubar=no,scrollbars=no,status=no,resizable=no';
	window.open(theURL,"",features);
}

function updateRev(uid){
	var theURL='./rev_update_form.php?uid='+uid;
	var features='left=280,top=250,width=510,height=400,toolbars=no,menubar=no,scrollbars=yes,status=no,resizable=no';
	window.open(theURL,"",features); 
}

function listRev(uid){
	var theURL='./rev_list.php?uid='+uid;
	var features='left=280,top=250,width=650,height=400,toolbars=no,menubar=no,scrollbars=yes,status=no,resizable=no';
	window.open(theURL,"",features); 
}

function exdelDown(){
	var f = document.frm;
	var str = confirm("예약접수자 현황을 excel 다운로드 하시겠습니까?");
	
	if (str)	f.submit();
}

</script>
</head>
<body topmargin=0 leftmargin=0>
<center>
<br>
	<table width="750" border="0" cellpadding="2" cellspacing="2" vspace="2" hspace="2">
		<tr>
			<td>	교육일정 리스트 // 총 갯수 : <?=$total?> </td>
			<td align='right'>	<a href='javascript:insertData();'>글쓰기</a> </td>
		</tr>
		<tr>
			<td>	</td>
			<td align='right'>	 
			<form action='rev_all_excel.php' method='post' name='frm' id="frm">
			▒ 예약접수자현황: 	
				<select name="year">
                   <option value="2020" <? if ($sYear == '2020') echo "selected"; ?>>2020</option>
                   <option value="2021" <? if ($sYear == '2021') echo "selected"; ?>>2021</option>
                   <option value="2022" <? if ($sYear == '2022') echo "selected"; ?>>2022</option>
				</select>년
				<select name="month">                   
                   <option value="01" <? if ($sMonth == '01') echo "selected"; ?>>01</option>
                   <option value="02" <? if ($sMonth == '02') echo "selected"; ?>>02</option>
				   <option value="03" <? if ($sMonth == '03') echo "selected"; ?>>03</option>
				   <option value="04" <? if ($sMonth == '04') echo "selected"; ?>>04</option>
				   <option value="05" <? if ($sMonth == '05') echo "selected"; ?>>05</option>
				   <option value="06" <? if ($sMonth == '06') echo "selected"; ?>>06</option>
				   <option value="07" <? if ($sMonth == '07') echo "selected"; ?>>07</option>
				   <option value="08" <? if ($sMonth == '08') echo "selected"; ?>>08</option>
				   <option value="09" <? if ($sMonth == '09') echo "selected"; ?>>09</option>
				   <option value="10" <? if ($sMonth == '10') echo "selected"; ?>>10</option>
				   <option value="11" <? if ($sMonth == '11') echo "selected"; ?>>11</option>
				   <option value="12" <? if ($sMonth == '12') echo "selected"; ?>>12</option>
				</select>월
				<input name="exlDownButton" type=button onclick="javascript:exdelDown();" value='엑셀다운로드' />
			</form>
			</td>
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
				<td align="center" width="200">제목</td>
				<td align="center" width="60">표시<br>위치</td>
				<td align="center" width="80">시작일</td>
				<td align="center" width="80">종료일</td>
				<td align="center" width="80">작성자</td>
				<td align="center" width="80">작성일</td>
                <td align="center" width="40">예약</td>
                <td align="center" width="60">예약<br>자수</td>
<?
if($total<1)
{
	echo"<tr align=center><td height='30' align='center' colspan='9'>등록된 게시물이 없습니다.</td></tr>";
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

	if($row->filename) $down="<a href='../../board_files/".$row->filename."' target='_blank'>".$row->filename."</a>";
    else $down = '-';
    
    $rsql="SELECT max_user FROM edu_rev where uid = '".$row->uid."'";
    $r_res=mysql_query($rsql);
    $r_total=mysql_affected_rows();
    $r_row = mysql_fetch_object($r_res);
    if($r_total<1){
        $max_user = '미설정';
    }else{
        
        
        $rmsql="SELECT * FROM edu_rev_member where uid = '".$row->uid."'";
        $rm_res=mysql_query($rmsql);
        $rm_total=mysql_affected_rows();

        $max_user = $rm_total."/".$r_row->max_user;
    }

?>
				<tr>
				<td height="20" align="center"><?=$n?></td>
				<td>
					<table border=0 cellpadding=0 cellspacing=0 width=200>
					<tr>
						<td width='<?=$length?>'>&nbsp;</td>
						<td><?=$re?>
						<a href="javascript:updateData('<?=$row->uid?>')"><?=$row->title?></a></td><tr>
					</table>

				</td>
				<td  align="center"><?=$row->view_loc?></td>
				<td  align="center"><?=$row->sdate?></td>
				<td  align="center"><?=$row->edate?></td>
				<td  align="center"><?=$row->writer?></td>
				<td  align="center"><?=$row->reg_date?></td>
                <td  align="center"><input name="revSetBtn" type="button" onclick="javascript:updateRev('<?=$row->uid?>');" value="설정" /></td>
				<td  align='center'>
					<? if($max_user == '미설정') {
						echo "미설정";
					}else{
						echo "<input name='revListBtn' type='button' onclick='javascript:listRev($row->uid);' value='$max_user' />";
					}
					?>
				</td>
			</tr>
            <tr height="1"><td height="1" colspan="9" background="../img/BwDotH2.gif"></td></tr>		
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
