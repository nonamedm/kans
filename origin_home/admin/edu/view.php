<?
if(!$cid){
	echo"<meta http-equiv=\"Refresh\" content=\"0 ; URL='../index.php'\">";
	exit;
}

include "../dbconn.inc";
if($_head_php_excuted) return;
if(eregi(":\/\/",$dir)) $dir=".";

$sql="SELECT * FROM edu_member order by name desc";
$res=mysql_query($sql);
$total=mysql_affected_rows();

if ($id!=''){
	$sql="SELECT * FROM edu_member where mem_id = '".$id."'";
	$ress=mysql_query($sql);
	$row = mysql_fetch_object($ress);
	
	$sql="SELECT * FROM edu_member_comp_day where mem_id = '".$id."' order by comp_year asc";
	$resss=mysql_query($sql);
	$total=mysql_affected_rows();
	
	$sql="SELECT * FROM edu_schedule where id = '".$row->schedule ."'";
	$res0=mysql_query($sql);
	$row0=mysql_fetch_object($res0);
	
	$sql="SELECT * FROM edu_member_pay_day where mem_id = '".$id."' order by pay_year asc";
	$res1=mysql_query($sql);
	$total1=mysql_affected_rows();
	
	$sql="SELECT * FROM edu_member_rec_num where mem_id = '".$id."' order by rec_year asc";
	$res2=mysql_query($sql);
	$total2=mysql_affected_rows();
}

$now=mktime();
$now=date(Y.'.'.m.'.'.d,$now);
$y=date(Y);
$m=date(m);
$d=date(d);

?>
<html>
<head>
<title>:::: Secure ::::</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link rel="stylesheet" href="../style.css" type="text/css">
<script language="javascript">
function update(){
	var str = confirm("교육대상자를 수정 하시겠습니까?");
	if (str)	document.location.href="./update.php?id=<?=$id?>";
}
function deleteData(){
	var str = confirm("교육대상자를 삭제 하시겠습니까?");
	if (str)	document.location.href="./delete.php?id=<?=$id?>";
}
</script>
<script language=javascript>
function check(){

var form=document.form;

	if(form.company1.value==''){
		alert('기관명을 입력하세요!');
		form.company1.focus();
		return;
	}
	if(form.name.value==''){
		alert('이름을 입력하세요!');
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

function edu_comp_add(){
	var theURL='./edu_comp_add_form.php?id=<?=$row->mem_id?>&ju=<?=$row->jumin2?>';
	var features='left=280,top=250,width=470,height=100,toolbars=no,menubar=no,scrollbars=no,status=no,resizable=no';
	window.open(theURL,"",features);
}

function pay_day_add(){
	var theURL='./pay_day_add_form.php?id=<?=$row->mem_id?>&ju=<?=$row->jumin2?>';
	var features='left=280,top=250,width=470,height=100,toolbars=no,menubar=no,scrollbars=no,status=no,resizable=no';
	window.open(theURL,"",features);
}

function rec_num_add(){
	var theURL='./rec_num_add_form.php?id=<?=$row->mem_id?>&ju=<?=$row->jumin2?>';
	var features='left=280,top=250,width=470,height=100,toolbars=no,menubar=no,scrollbars=no,status=no,resizable=no';
	window.open(theURL,"",features);
}

function edu_comp_del(id){
	var str = confirm("수료한 정보를 삭제 합니다.\n\n계속 하시겠습니까?");
	if (str)	document.location.href="./edu_comp_del.php?id="+id+"&mid=<?=$row->mem_id?>&page=<?=$page?>&search=<?=$search?>&keyword=<?=$keyword?>";
}

function pay_day_del(id){
	var str = confirm("납부일 정보를 삭제 합니다.\n\n계속 하시겠습니까?");
	if (str)	document.location.href="./pay_day_del.php?id="+id+"&mid=<?=$row->mem_id?>&page=<?=$page?>&search=<?=$search?>&keyword=<?=$keyword?>";
}

function rec_num_del(id){
	var str = confirm("계산서번호 정보를 삭제 합니다.\n\n계속 하시겠습니까?");
	if (str)	document.location.href="./rec_num_del.php?id="+id+"&mid=<?=$row->mem_id?>&page=<?=$page?>&search=<?=$search?>&keyword=<?=$keyword?>";
}

function edu_comp_ok(){
	var str = confirm("정말 수료하였습니까? 해당 정보를 기록합니다.\n\n계속 하시겠습니까?");
	if (str)	document.location.href="./edu_comp_ok.php?id=<?=$row->mem_id?>&ju=<?=$row->jumin2?>&cy=<?=$row0->year?>&page=<?=$page?>&search=<?=$search?>&keyword=<?=$keyword?>";
}

</script>
<style type="text/css">
<!--
.style2 {color: #FFFFFF}
.style3 {	color: #0033CC;
	font-weight: bold;
}
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
		  <form name='form' action='update.php' method='post'>
			<input type='hidden' name='id' value='<?=$row->id?>'>
			<input type='hidden' name='mem_id' value='<?=$row->mem_id?>'>
			<input type='hidden' name='page' value='<?=$page?>'>
			<input type='hidden' name='search' value='<?=$search?>'>
			<input type='hidden' name='keyword' value='<?=$keyword?>'>
<table width="730" border="0" align="center">
  <tr>
    <td width="278">▒ 교육대상자 <? if($id != ''){ ?>수정<? }else{ ?>신규등록 <? }?>  // 총:
      1명</td>
    <td width="420"><div align="right"><a href='reg.php?uid='></a></div></td>
  </tr>
  <tr>
    <td colspan='2'><hr></td>
  <tr>
  <tr>
    <td colspan="2"><table width=530 border=0 align=center cellpadding=1 cellspacing=1 bgcolor="#E8E8E8" >
      <tr>
        <td height="25" colspan="2" align=center bgcolor=#6699CC><span class="style2">▒ 개인 정보</span></td>
      </tr>
	  <tr>
        <td width='100' height="25" align=center bgcolor=#6699CC><span class="style2">교육상태 </span></td>
        <td bgcolor="#FFFFFF"><select name="edu_state" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
          <option value="" <? if ($row->edu_state==''){ ?>selected<? }else{ ?> <? } ?>></option>
          <option value="1" <? if ($row->edu_state=='1'){ ?>selected<? }else{ ?> <? } ?>>미신청</option>
		  <option value="2" <? if ($row->edu_state=='2'){ ?>selected<? }else{ ?> <? } ?>>신청</option>
		  <option value="3" <? if ($row->edu_state=='3'){ ?>selected<? }else{ ?> <? } ?>>미결재</option>
		  <option value="4" <? if ($row->edu_state=='4'){ ?>selected<? }else{ ?> <? } ?>>결재완료</option>
		  <option value="5" <? if ($row->edu_state=='5'){ ?>selected<? }else{ ?> <? } ?>>미수료</option>
          <option value="6" <? if ($row->edu_state=='6'){ ?>selected<? }else{ ?> <? } ?>>수료예정</option>
		  <option value="7" <? if ($row->edu_state=='7'){ ?>selected<? }else{ ?> <? } ?>>수료</option>
		</select></td>
      </tr>
	  <tr>
        <td width='100' height="25" align=center bgcolor=#6699CC><span class="style2">교육방식 </span></td>
        <td bgcolor="#FFFFFF"><select name="edu_type" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
          <option value="" <? if ($row->edu_type==''){ ?>selected<? }else{ ?> <? } ?>></option>
		  <option value="신규" <? if ($row->edu_type=='신규'){ ?>selected<? }else{ ?> <? } ?>>신규</option>
		  <option value="기존" <? if ($row->edu_type=='기존'){ ?>selected<? }else{ ?> <? } ?>>기존</option>
        </select></td>
      </tr>
		<tr>
        <td width='100' height="25" align=center bgcolor=#6699CC><span class="style2">교육구분 </span></td>
        <td bgcolor="#FFFFFF"><select name="type" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
          <option value="" <? if ($row->type==''){ ?>selected<? }else{ ?> <? } ?>></option>
		  <option value="정기" <? if ($row->type=='정기'){ ?>selected<? }else{ ?> <? } ?>>정기</option>
		  <option value="신규" <? if ($row->type=='신규'){ ?>selected<? }else{ ?> <? } ?>>신규</option>
		  <option value="면허" <? if ($row->type=='면허'){ ?>selected<? }else{ ?> <? } ?>>면허</option>
        </select></td>
      </tr>
      <tr>
        <td width='100' height="25" align=center bgcolor=#6699CC><span class="style2"> 기관명 </span></td>
        <td bgcolor="#FFFFFF">&nbsp;<input type=text size='50' name='company1' maxlength='50' style="border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->company1?>'></td>
      </tr>
      <tr>
        <td width='100' height="25" align=center bgcolor=#6699CC><span class="style2">소속부서</span></td>
        <td bgcolor="#FFFFFF">&nbsp;<input type=text size='22' name='position' maxlength='16' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->position?>'></td>
      </tr>
      <tr>
        <td width='100' height="25" align=center bgcolor=#6699CC><span class="style2"> 이 름 </span></td>
        <td bgcolor="#FFFFFF">&nbsp;<input type=text size='22' name='name' maxlength='16' style="border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->name?>'></td>
      </tr>
      <tr>
        <td width='100' height="25" align=center bgcolor=#6699CC><span class="style2">주민등록번호</span></td>
        <td bgcolor="#FFFFFF">&nbsp;<input type=text size='6' name='jumin1' maxlength='6' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->jumin1?>'>
          -
          <input type=text size='6' name='jumin2' maxlength='7' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->jumin2?>'></td>
      </tr>
      <tr>
        <td width='100' height="25" align=center bgcolor=#6699CC><span class="style2">이메일</span></td>
        <td bgcolor="#FFFFFF">&nbsp;<input type=text size='50' name='email' maxlength='50' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->email?>'></td>
      </tr>
      <tr>
        <td width='100' height="25" align=center bgcolor=#6699CC><span class="style2"> 연락처</span></td>
        <td bgcolor="#FFFFFF">&nbsp;<input type=text size='4' name='tel1' maxlength='4' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->tel1?>'>
          -
          <input type=text size='4' name='tel2' maxlength='4' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->tel2?>'>
          -
          <input type=text size='4' name='tel3' maxlength='4' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->tel3?>'></td>
      </tr>
      
    </table>
      <table width=530 border=0 align=center cellpadding=1 cellspacing=1 bgcolor="#E8E8E8" >
        <tr>
          <td height="25" colspan="3" align=center bgcolor=#6699CC><span class="style2">▒ 기관 정보</span></td>
        </tr>
        <tr>
          <td width='100' height="25" colspan="2" align=center bgcolor=#6699CC><span class="style2">기관명</span></td>
          <td bgcolor="#FFFFFF">&nbsp;<input type=text size='50' name='company2' maxlength='50' style="border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->company2?>' readonly>
          &nbsp;(위 정보와 동일하게 저장) </td>
        </tr>
        <tr>
          <td width='100' height="25" colspan="2" align=center bgcolor=#6699CC><span class="style2">대표자</span></td>
          <td bgcolor="#FFFFFF">&nbsp;<input type=text size='22' name='ceo' maxlength='20' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->ceo?>'></td>
        </tr>
        <tr>
          <td width='100' height="25" colspan="2" align=center bgcolor=#6699CC><span class="style2">사업자 등록번호 </span></td>
          <td bgcolor="#FFFFFF">&nbsp;<input type=text size='22' name='com_num' maxlength='11' style="border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->com_num?>'></td>
        </tr>
		<tr>
          <td width='100' height="25" colspan="2" align=center bgcolor=#6699CC><span class="style2">종목</span></td>
          <td bgcolor="#FFFFFF">&nbsp;<input type=text size='60' name='item' maxlength='100' style="border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->item?>'></td>
        </tr>
		<tr>
          <td width='100' height="25" colspan="2" align=center bgcolor=#6699CC><span class="style2">업태 </span></td>
          <td bgcolor="#FFFFFF">&nbsp;<input type=text size='60' name='condition' maxlength='100' style="border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->condition?>'></td>
        </tr>
        <tr>
          <td width='100' height="25" colspan="2" align=center bgcolor=#6699CC><span class="style2">주 소</span></td>
          <td bgcolor="#FFFFFF">&nbsp;<input type=text size='70' name='addr' maxlength='70' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->addr?>'></td>
        </tr>
        <tr>
          <td width='49' rowspan="8" align=center bgcolor=#6699CC><span class="style2">방<br>
            사<br>
            선<br>
            안<br>
            전<br>
            관<br>
            리<br>
            자</span></td>
          <td width='50' height="25" align=center bgcolor=#6699CC><span class="style2">이름</span></td>
          <td height="25" bgcolor="#FFFFFF">&nbsp;<input type=text size='22' name='a_name' maxlength='10' style="border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->a_name?>'></td>
        </tr>
        <tr>
          <td height="25" align=center bgcolor=#6699CC><span class="style2">소속부서</span></td>
          <td height="25" bgcolor="#FFFFFF">&nbsp;<input type=text size='22' name='a_position' maxlength='20' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->a_position?>'></td>
        </tr>
        <tr>
          <td height="25" align=center bgcolor=#6699CC><span class="style2">우편번호</span></td>
          <td height="25" bgcolor="#FFFFFF">&nbsp;<input type=text size='4' name='a_post1' maxlength='3' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->a_post1?>'>
-
  <input type=text size='4' name='a_post2' maxlength='3' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->a_post2?>'></td>
        </tr>
        <tr>
          <td height="25" align=center bgcolor=#6699CC><span class="style2">주소</span></td>
          <td height="25" bgcolor="#FFFFFF">&nbsp;<input type=text size='70' name='a_addr' maxlength='70' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->a_addr?>'></td>
        </tr>
        <tr>
          <td height="25" align=center bgcolor=#6699CC><span class="style2">이메일</span></td>
          <td bgcolor="#FFFFFF">&nbsp;<input type=text size='50' name='a_email' maxlength='50' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->a_email?>'></td>
        </tr>
        <tr>
          <td height="25" align=center bgcolor=#6699CC><span class="style2">전화</span></td>
          <td bgcolor="#FFFFFF">&nbsp;<input type=text size='4' name='a_tel1' maxlength='4' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->a_tel1?>'>
            -
              <input type=text size='4' name='a_tel2' maxlength='4' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->a_tel2?>'>
            
            -
            <input type=text size='8' name='a_tel3' maxlength='8' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->a_tel3?>'></td>
        </tr>
        <tr>
          <td height="25" align=center bgcolor=#6699CC><span class="style2">핸드폰</span></td>
          <td bgcolor="#FFFFFF">&nbsp;<input type=text size='4' name='a_hp1' maxlength='4' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->a_hp1?>'>
            -
            <input type=text size='4' name='a_hp2' maxlength='4' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->a_hp2?>'>
            -
            <input type=text size='4' name='a_hp3' maxlength='4' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->a_hp3?>'></td>
        </tr>
        <tr>
          <td height="25" align=center bgcolor=#6699CC><span class="style2">FAX </span></td>
          <td bgcolor="#FFFFFF">&nbsp;<input type=text size='4' name='a_fax1' maxlength='4' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->a_fax1?>'>
            -
            <input type=text size='4' name='a_fax2' maxlength='4' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->a_fax2?>'>
            -
            <input type=text size='8' name='a_fax3' maxlength='8' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->a_fax3?>'></td>
        </tr>
      </table>
      <table width=530 border=0 align=center cellpadding=1 cellspacing=1 bgcolor="#E8E8E8" >
        <tr>
          <td height="30" colspan="3" align=center bgcolor=#6699CC><span class="style2">▒ 추가 정보</span></td>
        </tr>
        <tr>
          <td width='100' height="25" align=center bgcolor=#6699CC><span class="style2">교육생번호 </span></td>
          <td colspan="2" bgcolor="#FFFFFF">&nbsp;<input type=text size='22' name='note_num' maxlength='8' style="border-width:1;border-color:#6d6d6d; border-style:solid;" value='<?=$row->note_num?>'></td>
        </tr>
		<tr>
        <td  width='100' height="25" rowspan="2" align=center bgcolor=#6699CC><span class="style2">교육 희망일 </span></td>
        <td height="25" colspan="2" bgcolor="#FFFFFF">&nbsp;<? $dd = $row->hope_year ?><select name="hope_year" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
          <option value="" <? if ($dd == "") echo "selected"; ?>>-</option>
          <option value="2006" <? if ($dd == '2006') echo "selected"; ?>>2006</option>
		  <option value="2007" <? if ($dd == '2007') echo "selected"; ?>>2007</option>
		  <option value="2008" <? if ($dd == '2008') echo "selected"; ?>>2008</option>
		  <option value="2009" <? if ($dd == '2009') echo "selected"; ?>>2009</option>
		  <option value="2010" <? if ($dd == '2010') echo "selected"; ?>>2010</option>
        </select>
년도
<? $dd = $row->hope_month ?>
<select name="hope_month" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
            <option value="" <? if ($dd == "") echo "selected"; ?>>-</option>
            <option value="01" <? if ($dd == '01') echo "selected"; ?>>01</option>
            <option value="02" <? if ($dd == '02') echo "selected"; ?>>02</option>
            <option value="03" <? if ($dd == '03') echo "selected"; ?>>03</option>
            <option value="04" <? if ($dd == '04') echo "selected"; ?>>04</option>
            <option value="05" <? if ($dd == '05') echo "selected"; ?>>05</option>
            <option value="06" <? if ($dd == '06') echo "selected"; ?>>06</option>
            <option value="07" <? if ($dd == '07') echo "selected"; ?>>07</option>
            <option value="08" <? if ($dd == '08') echo "selected"; ?>>08</option>
            <option value="09" <? if ($dd == '09') echo "selected"; ?>>09</option>
            <option value="10" <? if ($dd == '10') echo "selected"; ?>>10</option>
            <option value="11" <? if ($dd == '11') echo "selected"; ?>>11</option>
            <option value="12" <? if ($dd == '12') echo "selected"; ?>>12</option>
          </select>
월
<? $dd = $row->hope_day ?>
		  <select name="hope_day" style="border-width:1;border-color:#6d6d6d; border-style:solid;">
            <option value="" <? if ($dd == "") echo "selected"; ?>>-</option>
            <option value="01" <? if ($dd == '01') echo "selected"; ?>>01</option>
            <option value="02" <? if ($dd == '02') echo "selected"; ?>>02</option>
            <option value="03" <? if ($dd == '03') echo "selected"; ?>>03</option>
            <option value="04" <? if ($dd == '04') echo "selected"; ?>>04</option>
            <option value="05" <? if ($dd == '05') echo "selected"; ?>>05</option>
            <option value="06" <? if ($dd == '06') echo "selected"; ?>>06</option>
            <option value="07" <? if ($dd == '07') echo "selected"; ?>>07</option>
            <option value="08" <? if ($dd == '08') echo "selected"; ?>>08</option>
            <option value="09" <? if ($dd == '09') echo "selected"; ?>>09</option>
            <option value="10" <? if ($dd == '10') echo "selected"; ?>>10</option>
            <option value="11" <? if ($dd == '11') echo "selected"; ?>>11</option>
            <option value="12" <? if ($dd == '12') echo "selected"; ?>>12</option>
            <option value="13" <? if ($dd == '13') echo "selected"; ?>>13</option>
            <option value="14" <? if ($dd == '14') echo "selected"; ?>>14</option>
            <option value="15" <? if ($dd == '15') echo "selected"; ?>>15</option>
            <option value="16" <? if ($dd == '16') echo "selected"; ?>>16</option>
            <option value="17" <? if ($dd ==' 17') echo "selected"; ?>>17</option>
			<option value="18" <? if ($dd == '18') echo "selected"; ?>>18</option>
            <option value="19" <? if ($dd == '19') echo "selected"; ?>>19</option>
            <option value="20" <? if ($dd == '20') echo "selected"; ?>>20</option>
            <option value="21" <? if ($dd == '21') echo "selected"; ?>>21</option>
            <option value="22" <? if ($dd == '22') echo "selected"; ?>>22</option>
            <option value="23" <? if ($dd == '23') echo "selected"; ?>>23</option>
            <option value="24" <? if ($dd == '24') echo "selected"; ?>>24</option>
            <option value="25" <? if ($dd == '25') echo "selected"; ?>>25</option>
            <option value="26" <? if ($dd == '26') echo "selected"; ?>>26</option>
            <option value="27" <? if ($dd ==' 27') echo "selected"; ?>>27</option>
			<option value="28" <? if ($dd == '28') echo "selected"; ?>>28</option>
            <option value="29" <? if ($dd == '29') echo "selected"; ?>>29</option>
            <option value="30" <? if ($dd == '30') echo "selected"; ?>>30</option>
            <option value="31" <? if ($dd == '31') echo "selected"; ?>>31</option>
          </select>
일 (참고용) </td>
      </tr>
		<tr>
		  <td height="25" colspan="2" bgcolor="#FFFFFF">&nbsp;확정 교육일: <span class="style3">
		  <? if($row0){ ?>
		    <?=$row0->year?>년&nbsp; <?=$row0->month?>월&nbsp; <?=$row0->day?>일</span> 
				<? if($row->edu_state == '7'){?>
				<input type="button" name="edu_comp" value="수료완료" onClick="edu_comp_ok();">
				<? } ?>
			<? } else { ?>
			미정
			<? } ?>			</td>
		  </tr>
        <tr>
          <td width='100' rowspan="3" align=center bgcolor=#6699CC><span class="style2"> 교육 수료일 </span></td>
          <td height="25" colspan="2" align="center" bgcolor="#6699CC"><span class="style2"> 과거 수료일 </span></td>
          </tr>

        <tr>
          <td height="25" colspan="2" bgcolor="#FFFFFF">
		  <table width="421" border="0" cellpadding="1" cellspacing="1" bgcolor="#E8E8E8">
              <?
			  for($i=1; $i<=$total; $i++){ 
			  	$rows=mysql_fetch_object($resss);
			  ?>
			  <tr>
                <td width="100" height="25" bgcolor="#FFFFFF"><div align="center">
                  <?=$rows->comp_year?>
                  년도</div></td>
                <td width="241" height="25" bgcolor="#FFFFFF"><div align="center">
                  <?=$rows->comp_month?>월 <?=$rows->comp_day?>일
                </div></td>
                <td width="70" bgcolor="#FFFFFF"><div align="center"><input type="button" name="edu_comp_de" value="삭제" onClick="edu_comp_del('<?=$rows->id?>');"></div></td>
                </tr>	
			  <?
				$n = $n-1;
				}
			  ?>
          </table></td>
        </tr>
		        <tr>
          <td width="100" height="25" align="center" bgcolor="#6699CC"><span class="style2">수료일 추가 </span></td>
          <td width="320" height="25" bgcolor="#FFFFFF">
            <div align="right">
              <input type="button" name="edu_comp_a" value="수료일 추가" onClick="edu_comp_add();">		  
            </div></td>
        </tr>
        <tr>
          <td width='100' height="25" rowspan="3" align=center bgcolor=#6699CC><span class="style2">납부일</span></td>
          <td height="25" colspan="2" bgcolor="#6699CC"><div align="center"><span class="style2"> 과거 납부일 </span></div></td>
        </tr>
        <tr>
          <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="421" border="0" cellpadding="1" cellspacing="1" bgcolor="#E8E8E8">
            <?
			  for($i=1; $i<=$total1; $i++){ 
			  	$row1=mysql_fetch_object($res1);
			  ?>
            <tr>
              <td width="100" height="25" bgcolor="#FFFFFF"><div align="center">
                  <?=$row1->pay_year?>
                년도</div></td>
              <td width="241" height="25" bgcolor="#FFFFFF"><div align="center">
                  <?=$row1->pay_month?>
                월
                <?=$row1->pay_day?>
                일 </div></td>
              <td width="70" bgcolor="#FFFFFF"><div align="center">
                <input type="button" name="pay_day_de" value="삭제" onClick="pay_day_del('<?=$row1->id?>');">
              </div></td>
            </tr>
            <?
				$n = $n-1;
				}
			  ?>
          </table></td>
        </tr>
        <tr>
          <td height="25" bgcolor="#6699CC"><div align="center"><span class="style2">납부일 추가 </span></div></td>
          <td height="25" bgcolor="#FFFFFF">
            <div align="right">
              <input type="button" name="pay_day_a" value="납부일 추가" onClick="pay_day_add();">
            </div></td>
        </tr>
        <tr>
          <td width='100' height="25" rowspan="3" align=center bgcolor=#6699CC><span class="style2">계산서번호</span></td>
          <td height="25" colspan="2" bgcolor="#6699CC"><div align="center"><span class="style2"> 과거 계산서번호 </span></div></td>
        </tr>
        <tr>
          <td height="25" colspan="2" bgcolor="#FFFFFF"><table width="421" border="0" cellpadding="1" cellspacing="1" bgcolor="#E8E8E8">
            <?
			  for($i=1; $i<=$total2; $i++){ 
			  	$row2=mysql_fetch_object($res2);
			  ?>
            <tr>
              <td width="102" height="25" bgcolor="#FFFFFF"><div align="center">
                  <?=$row2->rec_year?>
                년도</div></td>
              <td width="102" height="25" bgcolor="#FFFFFF"><div align="center">
                  <?=$row2->rec_month?>
                월
                <?=$row2->rec_day?>
                일 </div></td>
              <td width="134" bgcolor="#FFFFFF"><div align="center">
                <?=$row2->rec_num?>
              </div></td>
              <td width="70" bgcolor="#FFFFFF"><div align="center">
                <input type="button" name="rec_num_de" value="삭제" onClick="rec_num_del('<?=$row2->id?>');">
              </div></td>
            </tr>
            <?
				$n = $n-1;
				}
			  ?>
          </table></td>
        </tr>
        <tr>
          <td height="25" bgcolor="#6699CC"><div align="center"><span class="style2">계산서번호 추가 </span></div></td>
          <td height="25" bgcolor="#FFFFFF">
            <div align="right">
              <input type="button" name="rec_num_a" value="계산서번호 추가" onClick="rec_num_add();">
            </div></td>
        </tr>
        <tr>
          <td bgcolor=#6699CC align=center><span class="style2">메 모</span></td>
          <td colspan="2" bgcolor="#FFFFFF">&nbsp;<textarea name='memo' rows='5' cols='49' style="border-width:1; border-color:#6d6d6d;border-style:solid;"><?=$row->memo?>
      </textarea></td>
        </tr>
      </table>
      <br>
<br>

<div align="center">
  <? if($id != ''){ ?>
  <input type=button onclick='check()' value='수 정'style="background-color:#EEE0E5;border-width:1; border-style:solid;">
  &nbsp;
  <input type=button onclick='deleteData()' value='삭 제'style="background-color:#EEE0E5 ;border-width:1; border-style:solid;">
  &nbsp;
  
      <?}else{?>
  
  <input type='button' onclick='check()' value=' 등 록 'style="background-color:#FFF0F5;border-width:1; border-style:solid;">
  &nbsp;
  
      <?}?>
  
      <input type='button' onClick="javascript:history.back();" value='목 록' style="background-color:#FFF0F5;border-width:1; border-style:solid;">
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
