<?
if(!$cid){
	echo"<meta http-equiv=\"Refresh\" content=\"0 ; URL='../index.php'\">";
	exit;
}
include "../dbconn.inc";

if($_head_php_excuted) return;
if(!eregi($HTTP_HOST,$HTTP_REFERER)) Error("���������� �����Ͽ� �ֽñ� �ٶ��ϴ�.");
if(eregi(":\/\/",$dir)) $dir=".";

if($keyword != ''){
	if($search=='edu_type')
		$sql="select * from edu_schedule where edu_type like '%".$keyword."%' order by year desc, month desc, day desc";
	else
		$sql="select * from edu_schedule where title like '%".$keyword."%' order by year desc, month desc, day desc";
}else{
	$sql="SELECT * FROM edu_schedule order by year desc, month desc, day desc";
}


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
	var features='left=280,top=250,width=470,height=280,toolbars=no,menubar=no,scrollbars=no,status=no,resizable=no';
	window.open(theURL,"",features);
}

function insertData(){
	var theURL='./reg.php';
	var features='left=280,top=250,width=470,height=280,toolbars=no,menubar=no,scrollbars=no,status=no,resizable=no';
	window.open(theURL,"",features);
}
</script>
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
		  <td><table width="730" border="0" align="center" cellpadding="2" cellspacing="2" hspace="2" vspace="2">
            <tr>
              <td>�� �������� ��� // �� ���� :
                <?=$total?> �� </td>
              <td align='right'><a href='sch_reg.php'>�������</a> </td>
            </tr>
            <tr>
              <td colspan='2'><hr>
              </td>
            <tr>
              <td align="center" colspan='2'><table border="0" width="100%" cellpadding="3" cellspacing="1">
                  <tr bgcolor="#F0F0F0">
                    <td height="20" align="center" width="33">no.</td>
                    <td align="center" width="105">����</td>
                    <td align="center" width="70">��������</td>
                    <td align="center" width="244">��������</td>
                    <td align="center" width="70">����� ��</td>
                    <td align="center" width="70">��������</td>
                    <td align="center" width="80">�ۼ���</td>
                    <?
if($total<1)
{
	echo"<tr align=center><td height='30' align='center' colspan='7'>��ϵ� ������ �����ϴ�.</td></tr>";
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
?>
                  <tr>
                    <td height="20" align="center"><?=$n?></td>
                    <td><center><a href="sch_view.php?id=<?=$row->id?>&page=<?=$page?>&search=<?=$search?>&keyword=<?=$keyword?>"><?=$row->year?>�� <?=$row->month?>�� <?=$row->day?>��</a></center></td>
                    <td  align="center"><?=$row->edu_type?></td>
                    <td  align="center"><a href="sch_member.php?id=<?=$row->id?>&page=<?=$page?>&search=<?=$search?>&keyword=<?=$keyword?>">
                      <?=$row->title?>
                    </a></td>
                    <td  align="center"><a href="sch_member.php?id=<?=$row->id?>&page=<?=$page?>&search=<?=$search?>&keyword=<?=$keyword?>">
					<?
					$msql="SELECT * FROM edu_member where schedule = '".$row->id."' order by name asc";
					$m_res=mysql_query($msql);
					$m_total=mysql_affected_rows();
					?>
					<?=$m_total?></a></td>
                    <td  align="center">
					<?
					if ($row->edu_state=='0'){ ?>����<? }
				elseif ($row->edu_state=='1'){ ?>����<? }
				elseif ($row->edu_state=='2'){ ?>����<? }
				else { ?>����<? }
				?>				</td>
                    <td  align="center"><?=$row->regdate?></td>
                  </tr>
                  <tr height="1">
                    <td colspan="7" background="../img/BwDotH2.gif"></td>
                  </tr>
                  <?
	$n = $n-1;
}
?>
                </table>
                  <br>
                  <table width="100%" height="63" border="0" align="center">
                    <tr>
                      <td align="center"><?
/****************************** ������ ī���� ��� ***********************************/
if($pagelist > 1)																										// ������ �׷������ ������ �̵�
{
   $p_page = (($pagelist -1)*10-1);
  echo "<a href=sch_list.php?page=$p_page&search=$search&keyword=$keyword>[���� 10��]</a>";
} 

$startpage = ($pagelist-1)*10+1;
$endpage = $pagelist*10;
if ($totalpage < $pagelist*10) $endpage = $totalpage;
for ($i=$startpage; $i<=$endpage; $i++) {																				// ���� ������
    if ($i==$page) { 
	echo " [$i] ";
    }else{
	echo " <a href=sch_list.php?page=$i&search=$search&keyword=$keyword>[$i]</a> ";
    } 
}
if ($pagelist*10 < $totalpage) {																						// ������ �׷������ �ڷ� �̵�
    $n_page = ($pagelist*10+1);
   echo "<a href=sch_list.php?page=$n_page&search=$search&keyword=$keyword>[����  10��]</a>";
}
/****************************** ������ ī���� ���  ��***********************************/
?>                      </td>
                    <tr>
                      <td align="center"><form name='frm' method='post' action='./sch_list.php'>
                      <table width="240" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="60"><select name="search">
                              <option value='edu_type'>��������</option>
                              <option value='title'>��������</option>
                            </select>
                          </td>
                          <td width="105"><input name="keyword" type="text" size="15"></td>
                          <td><div align="center">
                              <input name="image" type='image' src="../img/btt_search.gif" width="54" height="18" border="0">
                          </div></td>
                        </tr>
                      </table>
					  </form></td>
                </table></td>
          </table><br></td>
	  </tr>
	</table>
</body>
</html>
