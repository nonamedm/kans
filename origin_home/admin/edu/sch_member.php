<?
if(!$cid){
	echo"<meta http-equiv=\"Refresh\" content=\"0 ; URL='../index.php'\">";
	exit;
}

include "../dbconn.inc";

if($_head_php_excuted) return;
if(!eregi($HTTP_HOST,$HTTP_REFERER)) Error("���������� �����Ͽ� �ֽñ� �ٶ��ϴ�.");
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
		alert('�˻��� ���� ����� �̸��� �Է��ϼ���!');
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
	var str = confirm("��ϵǾ��ִ� ��������ڸ� ���� �Ͻð� �˴ϴ�.\n\n��� �Ͻðڽ��ϱ�?");
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
		    <!-- �޴����� -->
		    <? include("menu.php");?>
		    <!-- �޴����� -->
          </div></td>
		</tr>
		<tr>
		  <td>
		  <form name='form' action='sch_member_add.php' method='post'>
		    <input type='hidden' name='id' value='<?=$id?>'>
			<input type='hidden' name='m_id' value='<?=$m_id?>'>
<table width="730" border="0" align="center">
  <tr>
    <td width="278">�� ��������� ��� �� ���� // ��: <?=$m_total?>��</td>
    <td width="420"><div align="right"><a href='sch_member_xsl_output.php?sid=<?=$id?>'>�����������</a></div></td>
  </tr>
  <tr>
    <td colspan='2'><hr></td>
  <tr>
  <tr>
    <td colspan="2"><table width=713 border=0 align=center cellpadding=1 cellspacing=1 bgcolor="#4B87C2" >
      <tr>
        <td width='87' height="25" align=center bgcolor=#6699CC><span class="style2">�� �� </span></td>
        <td width="619" height="25" bgcolor="#FFFFFF">&nbsp;
		  <?=$row->year?>��&nbsp;
          <?=$row->month?>��&nbsp; 
		  <?=$row->day?>��</td>
      </tr>
      <tr>
        <td width='87' height="25" align=center bgcolor=#6699CC><span class="style2">��������</span></td>
        <td width="619" height="25" bgcolor="#FFFFFF">&nbsp; <?=$row->title?></td>
      </tr>
	  <tr>
        <td width='87' height="25" align=center bgcolor=#6699CC><span class="style2">����� �˻� </span></td>
        <td height="25" bgcolor="#FFFFFF">&nbsp; <input type=text size='16' name='name' maxlength='5' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;" readonly>
          <input name="button" type='button'style="background-color:#FFF0F5;border-width:1; border-style:solid;" onclick='member_find()' value=' �� �� '>
          <input name="button2" type='button'style="background-color:#FFF0F5;border-width:1; border-style:solid;" onclick='member_add()' value=' �� �� '></td>
      </tr>
      <tr>
        <td width="87" align=center bgcolor=#6699CC><span class="style2">��ϵ�<br>
          <br>
            ���� �����</span></td>
        <td><table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#6699CC">
          <tr>
            <td width="102" height="33"><div align="center" class="style2">�����</div></td>
			<td width="67" height="33"><div align="center" class="style2">�ҼӺμ�</div></td>
			<td width="55" height="33"><div align="center" class="style2">�� ��</div></td>
            <td width="101" height="33"><div align="center" class="style2">�ֹε�Ϲ�ȣ</div></td>
            <td width="66"><div align="center" class="style2">��������</div></td>
            <td width="52" height="33"><div align="center" class="style2">�ڷ�Ȯ��</div></td>
            <td width="68" height="33"><div align="center" class="style2">�������</div></td>
            <td width="51" height="33"><div align="center" class="style2">�� ��</div></td>
          </tr>
		  <?
if($m_total<1)
{
	echo"<tr align=center bgcolor=#FFFFFF><td height='30' align='center' colspan='7'>��ϵ� ���� ����ڰ� �����ϴ�.</td></tr>";
}
/***** ������ ī��Ʈ ���� �⺻�� ���� **********************************************/

// �� �������� ����Ʈ ��ų ���ڵ� ��

if($list == ''){
	$list=1000;		
}
//���� ������ �� ����
if(!$page)	$page = 1;   

// ��ü ������ �� ���
if(($m_total%$list)== 0)	$totalpage =  intval($m_total / $list);
else	$totalpage = intval($m_total / $list) + 1;

// ������ �׷� �� ����(������ ī���͸� �� ������ ����� ������ ����)

if(($page%10) == 0)	$pagelist = intval($page / 10);
else	$pagelist = intval($page / 10) + 1;

$start = ($page-1)* $list;												// ���� ���������� ���� ���ڵ� �� ����
$end = ($page) * $list;													// ���� ���������� ������ ���ڵ� �� ����

if($end > $m_total) 	$end = $m_total;

// ���� ���������� ����Ʈ�� ���ڵ� ���� ���ڵ�� �̵�

if ($page > 1) mysql_data_seek($m_res, $start);

/***** ������ ī��Ʈ ���� �⺻�� ���� �� *******************************************/
$cpage=$page - 1;
$n = $m_total - $cpage*$list ;

/***** ����Ʈ ���  // ���� �������� �ش� �ϴ� ����Ʈ�� ���**********************************************/
for($i=$start; $i<$end; $i++){
	$m_row = mysql_fetch_object($m_res);			//�� ���� ��ü���÷� �����´�

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
              Ȯ�� 
              <?}else{?> 
              ��Ȯ�� 
              <?}?>
            </div></td>
            <td height="25"><div align="center">
              <? if ($m_row->edu_state=='1'){ ?>�̽�û 
			  <? } elseif ($m_row->edu_state=='2'){?>��û
			  <? } elseif ($m_row->edu_state=='3'){?>�̰���
			  <? } elseif ($m_row->edu_state=='4'){?>����Ϸ�
			  <? } elseif ($m_row->edu_state=='5'){?>�̼���
			  <? } elseif ($m_row->edu_state=='6'){?>���Ό��
			  <? } elseif ($m_row->edu_state=='7'){?>����
			  <? } else { ?>�˼�����<? } ?>
            </div></td>
            <td><div align="center"><input name="button" type='button'style="background-color:#FFF0F5;border-width:1; border-style:solid;" onclick='member_delete(<?=$m_row->id?>,<?=$id?>)' value=' �� �� '></div></td>
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

  <input type=button onclick='ok()' value='Ȯ ��'style="background-color:#EEE0E5;border-width:1; border-style:solid;">
&nbsp;
      <input type='button' onClick="javascript:history.back();" value='�� ��' style="background-color:#FFF0F5;border-width:1; border-style:solid;">
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
