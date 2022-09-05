<?
if(!$cid){
	echo"<meta http-equiv=\"Refresh\" content=\"0 ; URL='../index.php'\">";
	exit;
}

include "../dbconn.inc";

if($_head_php_excuted) return;
if(!eregi($HTTP_HOST,$HTTP_REFERER)) Error("정상적으로 접근하여 주시기 바랍니다.");
if(eregi(":\/\/",$dir)) $dir=".";

$sql="SELECT * FROM edu_schedule order by name desc";
$res=mysql_query($sql);
$total=mysql_affected_rows();

if ($id!=''){
	$sql="SELECT * FROM edu_schedule where id = '".$id."'";
	$ress=mysql_query($sql);
	$row = mysql_fetch_object($ress);
	
	$msql="SELECT * FROM edu_member where schedule = '".$id."' order by name asc";
	$m_res=mysql_query($msql);
	$m_total=mysql_affected_rows();
}

?>

<html>
<head>
<title>:::: Secure ::::</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link rel="stylesheet" href="../style.css" type="text/css">
<script language=javascript>
function member_add(){
var form=document.form;

	if(form.name.value==''){
		alert('검색을 통해 대상자 이름을 입력하세요!');
		form.name.focus();
		return;
	}
	form.submit()
}

function startUp(){
	document.form.name.focus();
}
</script>
<script language="javascript">
function ok(){
	document.location.href="./sch_list.php";
}
function member_find(){
	var theURL='./sch_member_find.php';
	var features='left=280,top=250,width=470,height=280,toolbars=no,menubar=no,scrollbars=yes,status=no,resizable=no';
	window.open(theURL,"",features);
}
function member_delete(member,page){
	var str = confirm("등록되어있던 교육대상자를 삭제 하시게 됩니다.\n\n계속 하시겠습니까?");
	if (str)	document.location.href="./sch_member_delete.php?member="+member+"&page="+page;
}
</script>
<style type="text/css">
<!--
.style2 {color: #FFFFFF}
-->
</style>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<br>
	<table width="750" height="135" border="0" cellpadding="2" cellspacing="2" hspace="2" vspace="2">
		<tr>
		<td height="25">
		  <div align="center">
		    <!-- 메뉴시작 -->
		    <? include("menu.php");?>
		    <!-- 메뉴시작 -->
          </div></td>
		</tr>
		<tr>
		  <td>
		  <form name='form' action='sch_member_add.php' method='post'>
		    <input type='hidden' name='id' value='<?=$id?>'>
			<input type='hidden' name='m_id' value='<?=$m_id?>'>
<table width="730" border="0" align="center">
  <tr>
    <td width="278">▒ 교육대상자 등록 및 수정 // 총: <?=$m_total?>명</td>
    <td width="420"><div align="right"><a href='sch_member_xsl_output.php?sid=<?=$id?>'>엑셀파일출력</a></div></td>
  </tr>
  <tr>
    <td colspan='2'><hr></td>
  <tr>
  <tr>
    <td colspan="2"><table width=713 border=0 align=center cellpadding=1 cellspacing=1 bgcolor="#4B87C2" >
      <tr>
        <td width='87' height="25" align=center bgcolor=#6699CC><span class="style2">일 정 </span></td>
        <td width="619" height="25" bgcolor="#FFFFFF">&nbsp;
		  <?=$row->year?>년&nbsp;
          <?=$row->month?>월&nbsp; 
		  <?=$row->day?>일</td>
      </tr>
      <tr>
        <td width='87' height="25" align=center bgcolor=#6699CC><span class="style2">교육제목</span></td>
        <td width="619" height="25" bgcolor="#FFFFFF">&nbsp; <?=$row->title?></td>
      </tr>
	  <tr>
        <td width='87' height="25" align=center bgcolor=#6699CC><span class="style2">대상자 검색 </span></td>
        <td height="25" bgcolor="#FFFFFF">&nbsp; <input type=text size='16' name='name' maxlength='5' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" readonly>
          <input name="button" type='button'style="background-color:#FFF0F5;border-width:1; border-style:solid;" onclick='member_find()' value=' 검 색 '>
          <input name="button2" type='button'style="background-color:#FFF0F5;border-width:1; border-style:solid;" onclick='member_add()' value=' 등 록 '></td>
      </tr>
      <tr>
        <td width="87" align=center bgcolor=#6699CC><span class="style2">등록된<br>
          <br>
            교육 대상자</span></td>
        <td><table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#6699CC">
          <tr>
            <td width="102" height="33"><div align="center" class="style2">기관명</div></td>
			<td width="67" height="33"><div align="center" class="style2">소속부서</div></td>
			<td width="55" height="33"><div align="center" class="style2">이 름</div></td>
            <td width="101" height="33"><div align="center" class="style2">주민등록번호</div></td>
            <td width="66"><div align="center" class="style2">수료일자</div></td>
            <td width="52" height="33"><div align="center" class="style2">자료확인</div></td>
            <td width="68" height="33"><div align="center" class="style2">수료상태</div></td>
            <td width="51" height="33"><div align="center" class="style2">삭 제</div></td>
          </tr>
		  <?
if($m_total<1)
{
	echo"<tr align=center bgcolor=#FFFFFF><td height='30' align='center' colspan='7'>등록된 교육 대상자가 없습니다.</td></tr>";
}
/***** 페이지 카운트 관련 기본값 설정 **********************************************/

// 한 페이지에 리스트 시킬 레코드 수

if($list == ''){
	$list=1000;		
}
//현재 페이지 값 설정
if(!$page)	$page = 1;   

// 전체 페이지 값 얻기
if(($m_total%$list)== 0)	$totalpage =  intval($m_total / $list);
else	$totalpage = intval($m_total / $list) + 1;

// 페이지 그룹 값 설정(페이지 카운터를 몇 개까지 출력할 것인지 설정)

if(($page%10) == 0)	$pagelist = intval($page / 10);
else	$pagelist = intval($page / 10) + 1;

$start = ($page-1)* $list;												// 현재 페이지에서 시작 레코드 값 설정
$end = ($page) * $list;													// 현재 페이지에서 마지막 레코드 값 설정

if($end > $m_total) 	$end = $m_total;

// 현재 페이지에서 리스트의 레코드 시작 레코드로 이동

if ($page > 1) mysql_data_seek($m_res, $start);

/***** 페이지 카운트 관련 기본값 설정 끝 *******************************************/
$cpage=$page - 1;
$n = $m_total - $cpage*$list ;

/***** 리스트 출력  // 현재 페이지에 해당 하는 리스트만 출력**********************************************/
for($i=$start; $i<$end; $i++){
	$m_row = mysql_fetch_object($m_res);			//한 열씩 객체형택로 가져온다

	$length=strlen($m_row->thread);
	if($length>1)	$re="<img src='../img/aline.gif' border=0>";
	else	$re='';
	$length=$length.'0';
?>
          <tr bgcolor="#FFFFFF">
            <td><div align="center"><?=$m_row->company1?></div></td>
			<td><div align="center"><?=$m_row->position?></div></td>
			<td><div align="center"><a href="view.php?id=<?=$m_row->mem_id?>" target="_blank"><?=$m_row->name?></a></div></td>
            <td><div align="center"><?=$m_row->jumin1?> - <?=$m_row->jumin2?></div></td>
            <td><div align="center"></div></td>
            <td height="25"><div align="center">
              <? if($m_row->s_point > $row->s_point-1){?> 
              확인 
              <?}else{?> 
              미확인 
              <?}?>
            </div></td>
            <td height="25"><div align="center">
              <? if ($m_row->edu_state=='1'){ ?>미신청 
			  <? } elseif ($m_row->edu_state=='2'){?>신청
			  <? } elseif ($m_row->edu_state=='3'){?>미결재
			  <? } elseif ($m_row->edu_state=='4'){?>결재완료
			  <? } elseif ($m_row->edu_state=='5'){?>미수료
			  <? } elseif ($m_row->edu_state=='6'){?>수료예정
			  <? } elseif ($m_row->edu_state=='7'){?>수료
			  <? } else { ?>알수없음<? } ?>
            </div></td>
            <td><div align="center"><input name="button" type='button'style="background-color:#FFF0F5;border-width:1; border-style:solid;" onclick='member_delete(<?=$m_row->id?>,<?=$id?>)' value=' 삭 제 '></div></td>
          </tr>
<?
	$n = $n-1;
}
?>
        </table></td>
      </tr>

    </table>
	
	<br>
<br>

<div align="center">

  <input type=button onclick='ok()' value='확 인'style="background-color:#EEE0E5;border-width:1; border-style:solid;">
&nbsp;
      <input type='button' onClick="javascript:history.back();" value='취 소' style="background-color:#FFF0F5;border-width:1; border-style:solid;">
  &nbsp;
</div></td>
  </tr>
</table>

</form>
		  </td>
		</tr>
	</table>
</body>
</html>
