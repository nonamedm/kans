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
<title>�۾���</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<style TYPE="text/css">
<!--
td {font-family:����; font-size:9pt; text-decoration:none}
table {font-family:����; font-size:10pt; text-decoration:none}
A:link { font-size:10pt; font-face:"����"; text-decoration:none;}
A:visited { font-size:10pt; font-face:"����"; text-decoration:none;}
A:hover  { font-size:10pt; text-decoration:underline;}
//-->
</style>
<script language=javascript>
function sec_del(page){
	var str = confirm("�����ڵ带 ���� �Ͻðڽ��ϱ�?");
	if (str)	document.location.href="./sec_del.php?page="+page;
}

function check(){

var form=document.form;

	if(form.sec_code.value==''){
		alert('�����ڵ带 �Է��ϼ���!');
		form.sec_code.focus();
		return;
	}

	if(form.sec_memo.value=='')	{
		alert('������ �Է��ϼ���!');
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
	<td bgcolor='#6699CC' height='30'>&nbsp;&nbsp; ��缱 �̾߱� > �۾���</td></tr>
</table>
-->

<table border=0 cellpadding=1 cellspacing=1 align=center width=520 >
  <tr>
    <td width='39' height="30" align=center bgcolor=#6699CC><div align="center">��ȣ</div></td>
    <td width="89" height="30" bgcolor="#6699CC"><div align="center">�����ڵ�</div></td>
    <td width="245" height="30" bgcolor="#6699CC"><div align="center">����</div></td>
    <td width="86" height="30" bgcolor="#6699CC"><div align="center">�����</div></td>
    <td width="55" height="30" bgcolor="#6699CC"><div align="center">����</div></td>
  </tr>
  <?
if($total<1)
{
	echo"<tr align=center><td height='30' align='center' colspan='5'>��ϵ� �Խù��� �����ϴ�.</td></tr>";
}
/***** ������ ī��Ʈ ���� �⺻�� ���� **********************************************/

// �� �������� ����Ʈ ��ų ���ڵ� ��

if($list == ''){
	$list=10;		
}
//���� ������ �� ����
if(!$page)	$page = 1;   

// ��ü ������ �� ���
if(($total%$list)== 0)	$totalpage =  intval($total / $list);
else	$totalpage = intval($total / $list) + 1;

// ������ �׷� �� ����(������ ī���͸� �� ������ ����� ������ ����)

if(($page%10) == 0)	$pagelist = intval($page / 10);
else	$pagelist = intval($page / 10) + 1;

$start = ($page-1)* $list;												// ���� ���������� ���� ���ڵ� �� ����
$end = ($page) * $list;													// ���� ���������� ������ ���ڵ� �� ����

if($end > $total) 	$end = $total;

// ���� ���������� ����Ʈ�� ���ڵ� ���� ���ڵ�� �̵�

if ($page > 1) mysql_data_seek($res, $start);

/***** ������ ī��Ʈ ���� �⺻�� ���� �� *******************************************/
$cpage=$page - 1;
$n = $total - $cpage*$list ;

/***** ����Ʈ ���  // ���� �������� �ش� �ϴ� ����Ʈ�� ���**********************************************/
for($i=$start; $i<$end; $i++){
	$row = mysql_fetch_object($res);			//�� ���� ��ü���÷� �����´�

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
    <td width="55" bgcolor="#FFFFFF"><div align="center"><input name="button" type='button'style="background-color:#FFF0F5;border-width:1; border-style:solid;" onclick='sec_del(<?=$row->uid?>)' value='�� ��'></div></td>
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
		/****************************** ������ ī���� ��� ***********************************/
		if($pagelist > 1)																										// ������ �׷������ ������ �̵�
		{
		$p_page = (($pagelist -1)*10-1);
		echo "<a href=sec_form.php?page=$p_page&search=$search&keyword=$keyword>[���� 10��]</a>";
		} 

		$startpage = ($pagelist-1)*10+1;
		$endpage = $pagelist*10;
		if ($totalpage < $pagelist*10) $endpage = $totalpage;
		for ($i=$startpage; $i<=$endpage; $i++) {																				// ���� ������
			if ($i==$page) { 
			echo " [$i] ";
			}else{
			echo " <a href=sec_form.php?page=$i&search=$search&keyword=$keyword>[$i]</a> ";
			} 
		}
		if ($pagelist*10 < $totalpage) {																						// ������ �׷������ �ڷ� �̵�
			$n_page = ($pagelist*10+1);
		echo "<a href=sec_form.php?page=$n_page&search=$search&keyword=$keyword>[����  10��]</a>";
		}
		/****************************** ������ ī���� ���  ��***********************************/
		?>				
	</td>
	</tr>
</table>
<form name=form action='sec_write.php' method='post'>
<table border=0 cellpadding=1 cellspacing=1 align=center width=520 >
<tr>
	<td bgcolor=#6699CC align=center width='100'>�����ڵ�</td>
	<td>
		<input type=text size='22' name='sec_code' maxlength='20' style="border-width:1;border-color:#6d6d6d; border-style:solid;"></td></tr>
<tr>
	<td bgcolor=#6699CC align=center width='100'>�� ��</td>
	<td>
		<input type=text size='42' name='sec_memo' maxlength='100' style="ime-mode:active;border-width:1;border-color:#6d6d6d; border-style:solid;"></td></tr>
</table>
<br>

<div align='right'>
<? if($uid != ''){ ?>

	<input type=button onclick='rewrite()' value='�� ��'style="background-color:#EEE0E5;border-width:1; border-style:solid;">&nbsp;
	<input type=button onclick='check()' value='�� ��'style="background-color:#EEE0E5;border-width:1; border-style:solid;">&nbsp;
	<input type=button onclick='remove()' value='�� ��'style="background-color:#EEE0E5 ;border-width:1; border-style:solid;">&nbsp;

<?}else{?>

	<input type='button' onclick='check()' value=' �� �� 'style="background-color:#FFF0F5;border-width:1; border-style:solid;">&nbsp;
	
<?}?>

<input type=button onClick="javascript:window.close();" value='close' style="background-color:#FFF0F5;border-width:1; border-style:solid;">
&nbsp;
</div>
</form>
</body>
</html>