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
	var str = confirm("������ �ٿ�����ðڽ��ϱ�?");
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
    <td height="30" colspan="4" align="center" bgcolor="#6699CC"><span class="style4">�� ���� �ڷ� �̸����� </span></td>
  </tr>
  <tr>
    <td width="95" height="25" align="center" bgcolor="#6699CC"><span class="style2"> ����</span></td>
    <td colspan="3" bgcolor="#FFFFFF">&nbsp; <?=$row->title?></td>
  </tr>
  <tr>
    <td height="25" align="center" bgcolor="#6699CC"><span class="style2">�뵵 </span></td>
    <td width="170" bgcolor="#FFFFFF">&nbsp; <?=$row->type?></td>
    <td width="90" bgcolor="#6699CC"><div align="center"><span class="style2">���� </span></div></td>
    <td width="114" bgcolor="#FFFFFF">&nbsp; <?=$row->comm?></td>
  </tr>
  <tr>
    <td height="25" align="center" bgcolor="#6699CC"><span class="style2">����</span></td>
    <td colspan="3" bgcolor="#FFFFFF"><textarea name="etc" cols="50" rows="4" wrap="virtual" readonly="readonly"><?=$row->etc?>
    </textarea></td>
  </tr>
  <? if ($row->comm=='����'){ ?>
  <tr>
    <td height="25" align="center" bgcolor="#6699CC"><span class="style2">�ڷẸ��</span></td>
    <td colspan="3" bgcolor="#FFFFFF">&nbsp; 
      <input name="down" type='button' onclick="javascript:downData('<?=$row->url?>');" value=' �ٿ�ε� ' />
    </td>
  </tr>
  <? } else if($row->comm=='����'){ ?>
   <tr>
    <td height="25" align="center" bgcolor="#6699CC"><span class="style2">�ڷẸ��</span></td>
    <td colspan="3" bgcolor="#FFFFFF">&nbsp; 
	<object width=300 height=50 id="MnetPlayer" name="MnetPlayer" classid="clsid:22D6f312-B0F6-11D0-94AB-0080C74C7E95"codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=5,,52,701" standby="Loading Microsoft Windows Media Player components..." type="application/x-oleobject" VIEWASTEXT>
	 <param NAME="FILENAME" VALUE="mms://kans2.cafe24.com/kans2/audio/<?=$row->url?>">    <!-- URL �ּ� -->
	 <param NAME="AutoRestart" VALUE="false">               <!--�ڵ� ���� ������Ƽ-->
	 <param NAME="ShowAudioControls" VALUE="true">  <!-- ����� ���� ��Ʈ�ѷ� �����ִ� ������Ƽ -->
	 <param NAME="ShowControls" VALUE="true">           <!-- ��Ʈ�� �����ִ� ������Ƽ -->
	 <PARAM NAME="ShowPositionControls" VALUE="0">
	 <param name="ShowGotoBar" VALUE="false">
	 <param name="ShowDisplay" VALUE="false">
	 <param name="ShowStatusBar" value="true">
	 <param NAME="PlayCount" VALUE="1">                     <!-- �ݺ���� ���� ������Ƽ-->
	 <param NAME="EnableContextMenu" Value=false>      <!-- ������ ������ ���콺 Ŭ���� �޴� ���̴��� ���� ������Ƽ -->
	 <param NAME="Volume" VALUE="-360">                     <!-- �⺻ ���� ������Ƽ -->
	 <param NAME="AnimationAtStart" VALUE=true>          <!-- ���۸��� MS �ΰ� �����ִ� ������Ƽ -->
	</object>
	</td>
  </tr>
  <? } else { ?>
   <tr>
    <td height="25" align="center" bgcolor="#6699CC"><span class="style2">�ڷẸ��</span></td>
    <td colspan="3" bgcolor="#FFFFFF">&nbsp; ����</td>
  </tr>
  <? } ?>
</table>

<br />
<table width="367" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><div align="center">
  <input name="button" type='button' onclick="javascript:window.close();" value=' �� �� ' />
  &nbsp; </div></td>
  </tr>
</table>
</body>
</html>
<?
include "../conf/dbconn_close.inc";
?>