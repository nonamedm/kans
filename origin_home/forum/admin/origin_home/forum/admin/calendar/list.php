<?
if(!$cid){
	echo"<meta http-equiv=\"Refresh\" content=\"0 ; URL='../index.php'\">";
	exit;
}
include "../dbconn.inc";

$sql="select * from board_config A, edu_calendar B where A.bbs_id=B.bbs_id and A.bbs_id=20 order by  B.uid desc";
$res=mysql_query($sql);
$total=mysql_affected_rows();

$today = getdate(); 

if(!$sYear) { $sYear = $today['year']; }
if(!$sMonth) { $sMonth = $today['mon']; }
if(!$sDay) { $sDay = $today['mday']; }

?>

<html>
<head>
	<title>:::: Secure ::::</title>
<link rel="stylesheet" href="../style.css" type="text/css">
<script language="javascript">

function updateData(uid){
	var theURL='./update_form.php?uid='+uid;
	var features='left=280,top=250,width=470,height=320,toolbars=no,menubar=no,scrollbars=no,status=no,resizable=no';
	window.open(theURL,"",features);
}

function insertData(){
	var theURL='./write_form.php';
	var features='left=280,top=250,width=470,height=320,toolbars=no,menubar=no,scrollbars=no,status=no,resizable=no';
	window.open(theURL,"",features);
}

function updateRev(uid){
	var theURL='./rev_update_form.php?uid='+uid;
	var features='left=280,top=250,width=510,height=400,toolbars=no,menubar=no,scrollbars=yes,status=no,resizable=no';
	window.open(theURL,"",features); 
}

function listRev(uid){
	var theURL='./rev_list.php?uid='+uid;
	var features='left=280,top=250,width=650,height=400,toolbars=no,menubar=no,scrollbars=yes,status=no,resizable=no';
	window.open(theURL,"",features); 
}

function exdelDown(){
	var f = document.frm;
	var str = confirm("���������� ��Ȳ�� excel �ٿ�ε� �Ͻðڽ��ϱ�?");
	
	if (str)	f.submit();
}

</script>
</head>
<body topmargin=0 leftmargin=0>
<center>
<br>
	<table width="750" border="0" cellpadding="2" cellspacing="2" vspace="2" hspace="2">
		<tr>
			<td>	�������� ����Ʈ // �� ���� : <?=$total?> </td>
			<td align='right'>	<a href='javascript:insertData();'>�۾���</a> </td>
		</tr>
		<tr>
			<td>	</td>
			<td align='right'>	 
			<form action='rev_all_excel.php' method='post' name='frm' id="frm">
			�� ������������Ȳ: 	
				<select name="year">
                   <option value="2020" <? if ($sYear == '2020') echo "selected"; ?>>2020</option>
                   <option value="2021" <? if ($sYear == '2021') echo "selected"; ?>>2021</option>
                   <option value="2022" <? if ($sYear == '2022') echo "selected"; ?>>2022</option>
				</select>��
				<select name="month">                   
                   <option value="01" <? if ($sMonth == '01') echo "selected"; ?>>01</option>
                   <option value="02" <? if ($sMonth == '02') echo "selected"; ?>>02</option>
				   <option value="03" <? if ($sMonth == '03') echo "selected"; ?>>03</option>
				   <option value="04" <? if ($sMonth == '04') echo "selected"; ?>>04</option>
				   <option value="05" <? if ($sMonth == '05') echo "selected"; ?>>05</option>
				   <option value="06" <? if ($sMonth == '06') echo "selected"; ?>>06</option>
				   <option value="07" <? if ($sMonth == '07') echo "selected"; ?>>07</option>
				   <option value="08" <? if ($sMonth == '08') echo "selected"; ?>>08</option>
				   <option value="09" <? if ($sMonth == '09') echo "selected"; ?>>09</option>
				   <option value="10" <? if ($sMonth == '10') echo "selected"; ?>>10</option>
				   <option value="11" <? if ($sMonth == '11') echo "selected"; ?>>11</option>
				   <option value="12" <? if ($sMonth == '12') echo "selected"; ?>>12</option>
				</select>��
				<input name="exlDownButton" type=button onclick="javascript:exdelDown();" value='�����ٿ�ε�' />
			</form>
			</td>
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
				<td align="center" width="200">����</td>
				<td align="center" width="60">ǥ��<br>��ġ</td>
				<td align="center" width="80">������</td>
				<td align="center" width="80">������</td>
				<td align="center" width="80">�ۼ���</td>
				<td align="center" width="80">�ۼ���</td>
                <td align="center" width="40">����</td>
                <td align="center" width="60">����<br>�ڼ�</td>
<?
if($total<1)
{
	echo"<tr align=center><td height='30' align='center' colspan='9'>��ϵ� �Խù��� �����ϴ�.</td></tr>";
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

	if($row->filename) $down="<a href='../../board_files/".$row->filename."' target='_blank'>".$row->filename."</a>";
    else $down = '-';
    
    $rsql="SELECT max_user FROM edu_rev where uid = '".$row->uid."'";
    $r_res=mysql_query($rsql);
    $r_total=mysql_affected_rows();
    $r_row = mysql_fetch_object($r_res);
    if($r_total<1){
        $max_user = '�̼���';
    }else{
        
        
        $rmsql="SELECT * FROM edu_rev_member where uid = '".$row->uid."'";
        $rm_res=mysql_query($rmsql);
        $rm_total=mysql_affected_rows();

        $max_user = $rm_total."/".$r_row->max_user;
    }

?>
				<tr>
				<td height="20" align="center"><?=$n?></td>
				<td>
					<table border=0 cellpadding=0 cellspacing=0 width=200>
					<tr>
						<td width='<?=$length?>'>&nbsp;</td>
						<td><?=$re?>
						<a href="javascript:updateData('<?=$row->uid?>')"><?=$row->title?></a></td><tr>
					</table>

				</td>
				<td  align="center"><?=$row->view_loc?></td>
				<td  align="center"><?=$row->sdate?></td>
				<td  align="center"><?=$row->edate?></td>
				<td  align="center"><?=$row->writer?></td>
				<td  align="center"><?=$row->reg_date?></td>
                <td  align="center"><input name="revSetBtn" type="button" onclick="javascript:updateRev('<?=$row->uid?>');" value="����" /></td>
				<td  align='center'>
					<? if($max_user == '�̼���') {
						echo "�̼���";
					}else{
						echo "<input name='revListBtn' type='button' onclick='javascript:listRev($row->uid);' value='$max_user' />";
					}
					?>
				</td>
			</tr>
            <tr height="1"><td height="1" colspan="9" background="../img/BwDotH2.gif"></td></tr>		
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
?>
				</td>
			</table>
		</td>
	</table>
</body>
</html>
