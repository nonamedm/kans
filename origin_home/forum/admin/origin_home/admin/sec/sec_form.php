<?
if(!$cid){
	echo"<meta http-equiv=\"Refresh\" content=\"0 ; URL='../index.php'\">";
	exit;
}
include "../dbconn.inc";


$sql="select * from sec_code order by sec_code desc";
$res=mysql_query($sql);
$total=mysql_affected_rows();

?>
<html>
<head>
<title>글쓰기</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<style TYPE="text/css">
<!--
td {font-family:굴림; font-size:9pt; text-decoration:none}
table {font-family:굴림; font-size:10pt; text-decoration:none}
A:link { font-size:10pt; font-face:"굴림"; text-decoration:none;}
A:visited { font-size:10pt; font-face:"굴림"; text-decoration:none;}
A:hover  { font-size:10pt; text-decoration:underline;}
//-->
</style>
<script language=javascript>
function sec_del(page){
	var str = confirm("보안코드를 삭제 하시겠습니까?");
	if (str)	document.location.href="./sec_del.php?page="+page;
}

function check(){

var form=document.form;

	if(form.sec_code.value==''){
		alert('보안코드를 입력하세요!');
		form.sec_code.focus();
		return;
	}

	if(form.sec_memo.value=='')	{
		alert('설명을 입력하세요!');
		form.sec_memo.focus();
		return;
	}
	form.submit()
}

function startUp(){
	document.form.sec_code.focus();
}
</script>

</head>

<body leftmargin='0' topmargin='0'  onLoad='startUp();'>


<!--
<table border=0 cellpadding=1 cellspacing=1 align=center width=530 >
<tr>
	<td bgcolor='#6699CC' height='30'>&nbsp;&nbsp; 방사선 이야기 > 글쓰기</td></tr>
</table>
-->

<table border=0 cellpadding=1 cellspacing=1 align=center width=520 >
  <tr>
    <td width='39' height="30" align=center bgcolor=#6699CC><div align="center">번호</div></td>
    <td width="89" height="30" bgcolor="#6699CC"><div align="center">보안코드</div></td>
    <td width="245" height="30" bgcolor="#6699CC"><div align="center">설명</div></td>
    <td width="86" height="30" bgcolor="#6699CC"><div align="center">등록일</div></td>
    <td width="55" height="30" bgcolor="#6699CC"><div align="center">삭제</div></td>
  </tr>
  <?
if($total<1)
{
	echo"<tr align=center><td height='30' align='center' colspan='5'>등록된 게시물이 없습니다.</td></tr>";
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

?>
  <tr>
    <td height="25" align=center bgcolor=#FFFFFF><?=$n?></td>
    <td width="89" height="25" bgcolor="#FFFFFF"><div align="center">
      <?=$row->sec_code?>
    </div></td>
    <td width="245" height="25" bgcolor="#FFFFFF"><div align="center"><?=$row->sec_memo?></div></td>
    <td width="86" height="25" bgcolor="#FFFFFF"><div align="center"><?=$row->regdate?></div></td>
    <td width="55" bgcolor="#FFFFFF"><div align="center"><input name="button" type='button'style="background-color:#FFF0F5;border-width:1; border-style:solid;" onclick='sec_del(<?=$row->uid?>)' value='삭 제'></div></td>
  </tr>
  <tr height="1"><td colspan="5" background="../img/BwDotH2.gif"></td></tr>
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
		echo "<a href=sec_form.php?page=$p_page&search=$search&keyword=$keyword>[이전 10개]</a>";
		} 

		$startpage = ($pagelist-1)*10+1;
		$endpage = $pagelist*10;
		if ($totalpage < $pagelist*10) $endpage = $totalpage;
		for ($i=$startpage; $i<=$endpage; $i++) {																				// 현재 페이지
			if ($i==$page) { 
			echo " [$i] ";
			}else{
			echo " <a href=sec_form.php?page=$i&search=$search&keyword=$keyword>[$i]</a> ";
			} 
		}
		if ($pagelist*10 < $totalpage) {																						// 페이지 그룹단위로 뒤로 이동
			$n_page = ($pagelist*10+1);
		echo "<a href=sec_form.php?page=$n_page&search=$search&keyword=$keyword>[다음  10개]</a>";
		}
		/****************************** 페이지 카운터 출력  끝***********************************/
		?>				
	</td>
	</tr>
</table>
<form name=form action='sec_write.php' method='post'>
<table border=0 cellpadding=1 cellspacing=1 align=center width=520 >
<tr>
	<td bgcolor=#6699CC align=center width='100'>보안코드</td>
	<td>
		<input type=text size='22' name='sec_code' maxlength='20' style="border-width:1;border-color:#6d6d6d; border-style:solid;"></td></tr>
<tr>
	<td bgcolor=#6699CC align=center width='100'>설 명</td>
	<td>
		<input type=text size='42' name='sec_memo' maxlength='100' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;"></td></tr>
</table>
<br>

<div align='right'>
<? if($uid != ''){ ?>

	<input type=button onclick='rewrite()' value='답 변'style="background-color:#EEE0E5;border-width:1; border-style:solid;">&nbsp;
	<input type=button onclick='check()' value='수 정'style="background-color:#EEE0E5;border-width:1; border-style:solid;">&nbsp;
	<input type=button onclick='remove()' value='삭 제'style="background-color:#EEE0E5 ;border-width:1; border-style:solid;">&nbsp;

<?}else{?>

	<input type='button' onclick='check()' value=' 등 록 'style="background-color:#FFF0F5;border-width:1; border-style:solid;">&nbsp;
	
<?}?>

<input type=button onClick="javascript:window.close();" value='close' style="background-color:#FFF0F5;border-width:1; border-style:solid;">
&nbsp;
</div>
</form>
</body>
</html>