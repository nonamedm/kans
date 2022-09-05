<?
include "../conf/connchk.inc";
include "../conf/dbconn.inc";

if ($id!=''){
	$sql="SELECT * FROM on_edu_data where datacode = '".$id."'";
	$ress=mysql_query($sql);
	$row = mysql_fetch_object($ress);
}
$now=mktime();
$now=date(Y.'.'.m.'.'.d,$now);
$y=date(Y);
$m=date(m);
$d=date(d);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title>:::: Secure ::::</title>
<link rel="stylesheet" href="../css/style.css" type="text/css">
<script language="javascript">
function downData(id){
	var str = confirm("문서를 다운받으시겠습니까?");
	if (str)	document.location.href="http://www.kans.re.kr/edu/pds/pdf/"+id;
}
</script>

<style type="text/css">
<!--
.style2 {color: #FFFFFF}
.style4 {color: #FFFFFF; font-weight: bold; }
-->
</style>
</head>

<body>
<table width="482" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#E8E8E8" >
  <tr>
    <td height="30" colspan="4" align="center" bgcolor="#6699CC"><span class="style4">▒ 교육 자료 미리보기 </span></td>
  </tr>
  <tr>
    <td width="95" height="25" align="center" bgcolor="#6699CC"><span class="style2"> 제목</span></td>
    <td colspan="3" bgcolor="#FFFFFF">&nbsp; <?=$row->title?></td>
  </tr>
  <tr>
    <td height="25" align="center" bgcolor="#6699CC"><span class="style2">용도 </span></td>
    <td width="170" bgcolor="#FFFFFF">&nbsp; <?=$row->type?></td>
    <td width="90" bgcolor="#6699CC"><div align="center"><span class="style2">형태 </span></div></td>
    <td width="114" bgcolor="#FFFFFF">&nbsp; <?=$row->comm?></td>
  </tr>
  <tr>
    <td height="25" align="center" bgcolor="#6699CC"><span class="style2">설명</span></td>
    <td colspan="3" bgcolor="#FFFFFF"><textarea name="etc" cols="50" rows="4" wrap="virtual" readonly="readonly"><?=$row->etc?>
    </textarea></td>
  </tr>
  <? if ($row->comm=='문서'){ ?>
  <tr>
    <td height="25" align="center" bgcolor="#6699CC"><span class="style2">자료보기</span></td>
    <td colspan="3" bgcolor="#FFFFFF">&nbsp; 
      <input name="down" type='button' onclick="javascript:downData('<?=$row->url?>');" value=' 다운로드 ' />
    </td>
  </tr>
  <? } else if($row->comm=='음성'){ ?>
   <tr>
    <td height="25" align="center" bgcolor="#6699CC"><span class="style2">자료보기</span></td>
    <td colspan="3" bgcolor="#FFFFFF">&nbsp; 
	<object width=300 height=50 id="MnetPlayer" name="MnetPlayer" classid="clsid:22D6f312-B0F6-11D0-94AB-0080C74C7E95"codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=5,,52,701" standby="Loading Microsoft Windows Media Player components..." type="application/x-oleobject" VIEWASTEXT>
	 <param NAME="FILENAME" VALUE="mms://kans2.cafe24.com/kans2/audio/<?=$row->url?>">    <!-- URL 주소 -->
	 <param NAME="AutoRestart" VALUE="false">               <!--자동 시작 프로퍼티-->
	 <param NAME="ShowAudioControls" VALUE="true">  <!-- 오디오 볼륨 컨트롤러 보여주는 프로퍼티 -->
	 <param NAME="ShowControls" VALUE="true">           <!-- 컨트롤 보여주는 프로퍼티 -->
	 <PARAM NAME="ShowPositionControls" VALUE="0">
	 <param name="ShowGotoBar" VALUE="false">
	 <param name="ShowDisplay" VALUE="false">
	 <param name="ShowStatusBar" value="true">
	 <param NAME="PlayCount" VALUE="1">                     <!-- 반복재생 여부 프로퍼티-->
	 <param NAME="EnableContextMenu" Value=false>      <!-- 동영상에 오른쪽 마우스 클릭시 메뉴 보이는지 여부 프로퍼티 -->
	 <param NAME="Volume" VALUE="-360">                     <!-- 기본 볼륨 프로퍼티 -->
	 <param NAME="AnimationAtStart" VALUE=true>          <!-- 버퍼링시 MS 로고 보여주는 프로퍼티 -->
	</object>
	</td>
  </tr>
  <? } else { ?>
   <tr>
    <td height="25" align="center" bgcolor="#6699CC"><span class="style2">자료보기</span></td>
    <td colspan="3" bgcolor="#FFFFFF">&nbsp; 오류</td>
  </tr>
  <? } ?>
</table>

<br />
<table width="367" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><div align="center">
  <input name="button" type='button' onclick="javascript:window.close();" value=' 닫 기 ' />
  &nbsp; </div></td>
  </tr>
</table>
</body>
</html>
<?
include "../conf/dbconn_close.inc";
?>