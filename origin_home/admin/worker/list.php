<?
if(!$cid){
	echo"<meta http-equiv=\"Refresh\" content=\"0 ; URL='../index.php'\">";
	exit;
}
include "../dbconn.inc";

if($keyword){
	if($search=='organ') 	
		$sql="select * from edu_worker where organ_name like '%".$keyword."%' order by uid desc";
	else if($search=='jumin')
		$sql="select a.* from edu_worker a, edu_worders b where a.uid=b.worker_id and b.jumin like '%".$keyword."%'  group by a.uid";
	else
		$sql="select a.* from edu_worker a, edu_worders b where a.uid=b.worker_id and b.hope_day like '%".$keyword."%' group by a.uid";
}else{
	$sql="select * from edu_worker order by uid desc";
}

$res=mysql_query($sql);
$total=mysql_affected_rows();

?>

<html>
<head>
	<title>:::: Secure ::::</title>
<link rel="stylesheet" href="../style.css" type="text/css">
<script language="javascript">

function viewData(uid){
	var theURL='./viewData.php?uid='+uid;
	var features='left=280,top=250,width=610,height=350,toolbars=no,menubar=no,scrollbars=yes,status=no,resizable=yes';
	window.open(theURL,"viewData",features);
}

function insertData(){
	var theURL='./write_form.php';
	var features='left=280,top=250,width=470,height=280,toolbars=no,menubar=no,scrollbars=no,status=no,resizable=no';
	window.open(theURL,"",features);
}

function searchData(){
	frm.action = './list.php';
	frm.submit();
}

function excelData(){
	frm.action = './toExcel.php';
	frm.submit();
}
</script>
</head>
<body topmargin=0 leftmargin=0>
<center>
<br>
	<table width="800" border="0" cellpadding="2" cellspacing="2" vspace="2" hspace="2">
		<tr>
		<td>	������ ������û ����Ʈ // �� ���� : <?=$total?> </td>
		<td align='right'> <a href='javascript:excelData();'>Excel download</a></td>
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
				<td align="center" width="200">�����</td>
				<td align="center" width="80">��ǥ��</td>
				<td align="center" width="80">��û��</td>
				<td align="center" width="150">email</td>
				<td align="center" width="100">�ڵ���</td>
				<td align="center" width="100">��û�ڼ�</td>
				<td align="center" width="100">��û��</td>
<?
if($total<1)
{
	echo"<tr align=center><td height='30' align='center' colspan='8'>��ϵ� �Խù��� �����ϴ�.</td></tr>";
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

	$sql = "select count(*) from edu_worders where worker_id=".$row->uid;
	$rs = mysql_query($sql);
	$rw = mysql_fetch_row($rs);
	$count = $rw[0];
?>
				<tr>
				<td height="20" align="center"><?=$n?></td>
				<td  align="center"><a href='javascript:viewData(<?=$row->uid?>);'><?=$row->organ_name?></a></td>
				<td  align="center"><?=$row->owner?></td>
				<td  align="center"><?=$row->name?></td>
				<td  align="center"><?=$row->email?></td>
				<td  align="center"><?=$row->mobile?></td>
				<td  align="center"><?=$count?>��</td>
				<td  align="center"><?=substr($row->regdate,0,10)?></td>
			</tr>
			<tr height="1"><td colspan="8" background="../img/BwDotH2.gif"></td></tr>			
<?
	$n = $n-1;
}
?>
			</table>
			<br>
			<table width="100%" border="0" align="center">
			<form name='frm' method='post' action='./list.php'>
				<tr>
				<td width='50%'>
				<select name='search'>
				<option value='organ'>�����</option>
				<option value='jumin'>�ֹι�ȣ</option>
				<option value='hope'>���������</option>
				</select>
				<input type='text' name='keyword' size='12'>
				<input type=button onclick='searchData()' value='�˻�' style="background-color:#EEE0E5 ;border-width:1; border-style:solid;">
				</td>
				<td width='50%'>
 <?
/****************************** ������ ī���� ��� ***********************************/
if($pagelist > 1)																										// ������ �׷������ ������ �̵�
{
   $p_page = (($pagelist -1)*10-1);
  echo "<a href=list.php?page=$p_page&search=$search&keyword=$keyword>[���� 10��]</a>";
} 

$startpage = ($pagelist-1)*10+1;
$endpage = $pagelist*10;
if ($totalpage < $pagelist*10) $endpage = $totalpage;
for ($i=$startpage; $i<=$endpage; $i++) {																				// ���� ������
    if ($i==$page) { 
	echo " [$i] ";
    }else{
	echo " <a href=list.php?page=$i&search=$search&keyword=$keyword>[$i]</a> ";
    } 
}
if ($pagelist*10 < $totalpage) {																						// ������ �׷������ �ڷ� �̵�
    $n_page = ($pagelist*10+1);
   echo "<a href=list.php?page=$n_page&search=$search&keyword=$keyword>[����  10��]</a>";
}
/****************************** ������ ī���� ���  ��***********************************/
?>
				</td></tr>
				</form>

			</table>
		</td>
	</table>
</body>
</html>

<script>
<?if($search) echo "frm.search.value='".$search."';";?>
frm.keyword.value = "<?=$keyword?>";
</script>