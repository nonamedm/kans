<?
if(!$cid){
	echo"<meta http-equiv=\"Refresh\" content=\"0 ; URL='../index.php'\">";
	exit;
}
include "../dbconn.inc";


$sql="select * from sec_board_config A, sec_board B where A.bbs_id=B.bbs_id and A.bbs_id=1 order by  B.fid desc, B.thread asc";
$res=mysql_query($sql);
$total=mysql_affected_rows();

?>

<html>
<head>
	<title>:::: Secure ::::</title>
	<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link rel="stylesheet" href="../style.css" type="text/css">
<script language="javascript">

function updateData(uid){
	var theURL='./update_form.php?uid='+uid;
	var features='left=280,top=250,width=470,height=360,toolbars=no,menubar=no,scrollbars=no,status=no,resizable=no';
	window.open(theURL,"",features);
}

function insertData(){
	var theURL='./write_form.php';
	var features='left=280,top=250,width=470,height=360,toolbars=no,menubar=no,scrollbars=no,status=no,resizable=no';
	window.open(theURL,"",features);
}

function insertSec(){
	var theURL='./sec_form.php';
	var features='left=280,top=250,width=540,height=280,toolbars=no,menubar=no,scrollbars=yes,status=no,resizable=no';
	window.open(theURL,"",features);
}
</script>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<center>
<br>
	<table width="750" border="0" cellpadding="2" cellspacing="2" vspace="2" hspace="2">
		<tr>
		<td height="30" colspan="2">	<div align="center"><A href="list.php">�� �¶��α���(����) �ڷ�� ���</a> &nbsp;&nbsp;|&nbsp;&nbsp; </A> <a href='javascript:insertSec();'>�� ���� �ڵ� ��� </a> </div></td>
		</tr>
		<tr>
		<td height="30" colspan="2">	<div align="center">* �¶��� ���� : http://www.kans.re.kr/edu/edu_sub_06.html</div></td>
		</tr>
		<tr>
		<td>	�� �¶��α���(����) �ڷ�� ����Ʈ // �� ���� :		  <?=$total?> </td>
		<td align='right'>	<a href='javascript:insertData();'>�۾���</a> </td>
		</tr>
		<tr>
		<td colspan='2'>
			<hr>		</td>
		<tr>
		<td align="center" colspan='2'>
			<table border="0" width="100%" cellpadding="3" cellspacing="1">
				<tr bgcolor="#F0F0F0">
				<td height="20" align="center" width="26">no.</td>
				<td align="center" width="58">���ȹ�ȣ</td>
				<td align="center" width="262">����</td>
				<td align="center" width="93">����</td>
				<td align="center" width="43">����</td>
				<td align="center" width="73">�ۼ���</td>
				<td align="center" width="73">�ۼ���</td>
				<td align="center" width="57">��ȸ</td>
<?
if($total<1)
{
	echo"<tr align=center><td height='30' align='center' colspan='7'>��ϵ� �Խù��� �����ϴ�.</td></tr>";
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

	if($row->filename) $down="<a href='/board_files/".$row->filename."' target='_blank'>".$row->filename."</a>";
	else $down = '-';
?>
				<tr>
				<td height="20" align="center"><?=$n?></td>
				<td><div align="center">
				  <?=$row->sec_code?>
				</div></td>
				<td><table border=0 cellpadding=0 cellspacing=0 width=262>
                  <tr>
                    <td width='15'>&nbsp;</td>
                    <td width="243"><?=$re?>
                        <a href="javascript:updateData('<?=$row->uid?>')">
                          <?=$row->title?>
                        </a></td>
                  <tr>
                  </table></td>
				<td  align="center"><?=$down?></td>
				<td  align="center"><?if($row->sec_chk=='0'){?>�����<?}elseif($row->sec_chk=='1'){?>����<?}else{?>����<?}?></td>
				<td  align="center"><?=$row->writer?></td>
				<td  align="center"><?=$row->reg_date?></td>
				<td  align="center"><?=$row->visit?></td>
			</tr>
			<tr height="1"><td colspan="8" background="../img/BwDotH2.gif"></td></tr>			
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
?>				</td>
			</table>		</td>
	</table>
</body>
</html>
