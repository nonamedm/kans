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
<title>��ϵ� ���� ����� �˻�</title>
<style TYPE="text/css">
<!--
td {font-family:����; font-size:9pt; text-decoration:none}
table {font-family:����; font-size:10pt; text-decoration:none}
A:link { font-size:10pt; font-face:"����"; text-decoration:none;}
A:visited { font-size:10pt; font-face:"����"; text-decoration:none;}
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
		<option value='name'>�̸�</option>
		<option value='position'>�Ҽ�</option>
		</select>
		<input type='text' name='keyword' size='15'>
		<input type='button' value=' �� �� ' onclick='javascript:frm.submit();'  style="background-color:#EEE0E5 ;border-width:1; border-style:solid;">
</td>
</tr>
</table>

<table width=450 border=0 align=center cellpadding=1 cellspacing=1 bgcolor="#6699CC" >
<tr height='30'>
	<td width='100' height="25" align=center bgcolor=#6699CC><span class="style1">�̸�</span></td>
	<td width='100' height="25" align=center bgcolor=#6699CC><span class="style1">�ֹε����</span></td>
    <td width='137' height="25" align=center bgcolor=#6699CC><span class="style1">�Ҽ�</span></td>
    <td width='100' align=center bgcolor=#6699CC><span class="style1">�����</span></td>
</tr>
<?
if($total<1)
{
	echo"<tr align=center><td height='25' colspan='4' align=center bgcolor=#FFFFFF>��ϵ� ����ڰ� �����ϴ�.</td></tr>";
}
/***** ������ ī��Ʈ ���� �⺻�� ���� **********************************************/

// �� �������� ����Ʈ ��ų ���ڵ� ��

if($list == ''){
	$list=20;		
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
?>
<tr align='center' height='25'>
	<td width='100' height="25" align=center bgcolor=#FFFFFF><a href="javascript:setData('<?=$row->id?>','<?=$row->name?>');"><?=$row->name?></a></td>
	<td width='100' height="25" align=center bgcolor=#FFFFFF>
	  <?=$row->jumin1?> - <?=$row->jumin2?>	</td>
	<td width='137' height="25" align=center bgcolor=#FFFFFF>
	  <?=$row->position?>	</td>
    <td width='100' height="25" align=center bgcolor=#FFFFFF><?=$row->hope_year?>�� <?=$row->hope_month?>�� <?=$row->hope_day?>��</td>
</tr>

<?
	$n = $n-1;
}
?>
</table><br>
<table width="450" border="0" align="center">
  <tr>
    <td>    <div align="center"><?
/****************************** ������ ī���� ��� ***********************************/
if($pagelist > 1)																										// ������ �׷������ ������ �̵�
{
   $p_page = (($pagelist -1)*10-1);
  echo "<a href=sch_member_find.php?page=$p_page&search=$search&keyword=$keyword>[���� 20��]</a>";
} 

$startpage = ($pagelist-1)*10+1;
$endpage = $pagelist*10;
if ($totalpage < $pagelist*10) $endpage = $totalpage;
for ($i=$startpage; $i<=$endpage; $i++) {																				// ���� ������
    if ($i==$page) { 
	echo " [$i] ";
    }else{
	echo " <a href=sch_member_find.php?page=$i&search=$search&keyword=$keyword>[$i]</a> ";
    } 
}
if ($pagelist*10 < $totalpage) {																						// ������ �׷������ �ڷ� �̵�
    $n_page = ($pagelist*10+1);
   echo "<a href=sch_member_find.php?page=$n_page&search=$search&keyword=$keyword>[����  20��]</a>";
}
/****************************** ������ ī���� ���  ��***********************************/
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