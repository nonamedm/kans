<?
include "../dbconn.inc"; 

if($keyword){
	if($search=='name')
			$sql="select * from edu_member where name like '%".$keyword."%' and schedule is null order by name asc";
	else
			$sql="select * from edu_member where schedule is null and position like '%".$keyword."%' order by name asc";
}else{
	$sql="select * from edu_member where schedule is null or schedule = '' order by name asc";
}
$res=mysql_query($sql);
$total=mysql_affected_rows();
?>
<html>
<head>
<title>등록된 교육 대상자 검색</title>
<style TYPE="text/css">
<!--
td {font-family:굴림; font-size:9pt; text-decoration:none}
table {font-family:굴림; font-size:10pt; text-decoration:none}
A:link { font-size:10pt; font-face:"굴림"; text-decoration:none;}
A:visited { font-size:10pt; font-face:"굴림"; text-decoration:none;}
A:hover  { font-size:10pt; text-decoration:underline;}
//.style1 {color: #FFFFFF}
.style1 {color: #FFFFFF}
.style2 {color: #000000}
-->
</style>
<script language=javascript>
function setData(id, name){
	opener.form.m_id.value = id;
	opener.form.name.value = name;
	self.close();
}


</script>

</head>

<body leftmargin='0' topmargin='0'>
<form name='frm' method='post' action='./sch_member_find.php'>
<table width="100%" border="0" align="center">

<tr>
	<td width='100%'>
		<select name='search'>
		<option value='name'>이름</option>
		<option value='position'>소속</option>
		</select>
		<input type='text' name='keyword' size='15'>
		<input type='button' value=' 검 색 ' onclick='javascript:frm.submit();'  style="background-color:#EEE0E5 ;border-width:1; border-style:solid;">
</td>
</tr>
</table>

<table width=450 border=0 align=center cellpadding=1 cellspacing=1 bgcolor="#6699CC" >
<tr height='30'>
	<td width='100' height="25" align=center bgcolor=#6699CC><span class="style1">이름</span></td>
	<td width='100' height="25" align=center bgcolor=#6699CC><span class="style1">주민등록증</span></td>
    <td width='137' height="25" align=center bgcolor=#6699CC><span class="style1">소속</span></td>
    <td width='100' align=center bgcolor=#6699CC><span class="style1">희망일</span></td>
</tr>
<?
if($total<1)
{
	echo"<tr align=center><td height='25' colspan='4' align=center bgcolor=#FFFFFF>등록된 대상자가 없습니다.</td></tr>";
}
/***** 페이지 카운트 관련 기본값 설정 **********************************************/

// 한 페이지에 리스트 시킬 레코드 수

if($list == ''){
	$list=20;		
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
?>
<tr align='center' height='25'>
	<td width='100' height="25" align=center bgcolor=#FFFFFF><a href="javascript:setData('<?=$row->id?>','<?=$row->name?>');"><?=$row->name?></a></td>
	<td width='100' height="25" align=center bgcolor=#FFFFFF>
	  <?=$row->jumin1?> - <?=$row->jumin2?>	</td>
	<td width='137' height="25" align=center bgcolor=#FFFFFF>
	  <?=$row->position?>	</td>
    <td width='100' height="25" align=center bgcolor=#FFFFFF><?=$row->hope_year?>년 <?=$row->hope_month?>월 <?=$row->hope_day?>일</td>
</tr>

<?
	$n = $n-1;
}
?>
</table><br>
<table width="450" border="0" align="center">
  <tr>
    <td>    <div align="center"><?
/****************************** 페이지 카운터 출력 ***********************************/
if($pagelist > 1)																										// 페이지 그룹단위로 앞으로 이동
{
   $p_page = (($pagelist -1)*10-1);
  echo "<a href=sch_member_find.php?page=$p_page&search=$search&keyword=$keyword>[이전 20개]</a>";
} 

$startpage = ($pagelist-1)*10+1;
$endpage = $pagelist*10;
if ($totalpage < $pagelist*10) $endpage = $totalpage;
for ($i=$startpage; $i<=$endpage; $i++) {																				// 현재 페이지
    if ($i==$page) { 
	echo " [$i] ";
    }else{
	echo " <a href=sch_member_find.php?page=$i&search=$search&keyword=$keyword>[$i]</a> ";
    } 
}
if ($pagelist*10 < $totalpage) {																						// 페이지 그룹단위로 뒤로 이동
    $n_page = ($pagelist*10+1);
   echo "<a href=sch_member_find.php?page=$n_page&search=$search&keyword=$keyword>[다음  20개]</a>";
}
/****************************** 페이지 카운터 출력  끝***********************************/
?>
  </div></td>
  </tr>
</table>
<br>

<div align='right'>


<input type=button onClick="javascript:window.close();" value='close' style="background-color:#FFF0F5;border-width:1; border-style:solid;">
&nbsp;
</div>
</form>
</body>
</html>

<script>
<?
if($search=='') $search = 'name';
?>
frm.keyword.value = '<?=$keyword?>';
frm.search.value = '<?=$search?>';
</script>