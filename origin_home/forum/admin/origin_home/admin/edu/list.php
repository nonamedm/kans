<?
if(!$cid){
	echo"<meta http-equiv=\"Refresh\" content=\"0 ; URL='../index.php'\">";
	exit;
}
include "../dbconn.inc";

if($_head_php_excuted) return;
if(eregi(":\/\/",$dir)) $dir=".";


if($keyword != ''){
	if($search=='name')
		$sql="select * from edu_member where name like '%".$keyword."%' order by name asc";
	elseif($search=='jumin2')
		$sql="select * from edu_member where jumin2 like '%".$keyword."%' order by name asc";
	else
		$sql="select * from edu_member where company1 like '%".$keyword."%' order by name asc";
}else{
	$sql="SELECT * FROM edu_member order by name asc";
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
		  <td><table width="730" border="0" align="center">
            <tr>
              <td width="535">�� ���������  ��� // ��:
                <?=$total?> ��</td>
              <td width="92"><div align="right"><a href='reg.php'>�űԵ��</a></div></td>
              <td width="89"><div align="right"><a href='xsl_output.php'>�����������</a></div></td>
            </tr>
			<tr>
			  <td colspan='3'><hr></td>
		    <tr>
            <tr>
              <td colspan="3"><table border="0" width="100%" cellpadding="3" cellspacing="1">
                <tr bgcolor="#F0F0F0">
                  <td height="20" align="center" width="25">no.</td>
                  <td align="center" width="60">�̸�</td>
                  <td align="center" width="109">�ֹε�Ϲ�ȣ</td>
                  <td align="center" width="151">�����</td>
                  <td align="center" width="82">��������</td>
                  <td align="center" width="100">���� Ȯ���� </td>
                  <td align="center" width="70">���� �����</td>
                  <td align="center" width="70">������</td>
                  <?
if($total<1)
{
	echo"<tr align=center><td height='30' align='center' colspan='7'>��ϵ� ��������ڰ� �����ϴ�.</td></tr>";
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
                <tr>
                  <td height="20" align="center"><?=$n?></td>
                  <td>                    <div align="center"><a href="view.php?id=<?=$row->mem_id?>&page=<?=$page?>&search=<?=$search?>&keyword=<?=$keyword?>">
                    <?=$row->name?>
                  </a></div></td>
                  <td  align="center"><?=$row->jumin1?> - <?=$row->jumin2?></td>
                  <td  align="center"><?=$row->company1?></td>
                  <td  align="center">
				  <? 
				  	if ($row->edu_state=='1'){ ?>�̽�û<? }
				elseif ($row->edu_state=='2'){ ?>��û<? }
				elseif ($row->edu_state=='3'){ ?>�̰���<? }
				elseif ($row->edu_state=='4'){ ?>����Ϸ�<? }
				elseif ($row->edu_state=='5'){ ?>�̼���<? }
				elseif ($row->edu_state=='6'){ ?>���Ό��<? }
				elseif ($row->edu_state=='7'){ ?>����<? }
				else { ?>�̽�û<? }
				 ?>
				  </td>
                  <td  align="center"><? if($row->schedule == ''){ ?>����<? }else{ ?>
				  <?
					$msql="SELECT * FROM edu_schedule where id = '".$row->schedule."'";
					$m_res=mysql_query($msql);
					$m_row = mysql_fetch_object($m_res);
					$m_total=mysql_affected_rows();
					?>
				  <?=$m_row->year?>�� <?=$m_row->month?>�� <?=$m_row->day?>��<? } ?></td>
                  <td  align="center">
				  <?
					$nsql="SELECT * FROM edu_member_comp_day where mem_id = '".$row->mem_id."' order by comp_year desc";
					$n_res=mysql_query($nsql);
					$n_row = mysql_fetch_object($n_res);
					$n_total=mysql_affected_rows();
					?><? if($n_row->comp_year == ''){ ?>����<? }else{ ?>
				  <?=$n_row->comp_year?>�⵵<? }?></td>
                  <td  align="center">
				  <?
					$osql="SELECT * FROM edu_member_pay_day where mem_id = '".$row->mem_id."' order by pay_year desc";
					$o_res=mysql_query($osql);
					$o_row = mysql_fetch_object($o_res);
					$o_total=mysql_affected_rows();
					?><? if($o_row->pay_year == ''){ ?>����<? }else{ ?>
				  <?=$o_row->pay_year?>�⵵<? }?></td>
                </tr>
                <tr height="1">
                  <td colspan="8" background="../img/BwDotH2.gif"></td>
                </tr>
                <?
	$n = $n-1;
}
?>
              </table>
              <br>
                <table width="100%" height="76" border="0" align="center">
                  <tr>
                    <td height="25" align="center"><?
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
?>                    </td>
                  <tr>
                    <td height="30" align="center"><div align="center">
					<form name='frm' method='post' action='./list.php'>
                      <table width="240" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="60"><select name="search">
                              <option value='name'>�̸�</option>
							  <option value='jumin2'>�ֹι�ȣ���ڸ�</option>
                              <option value='company1'>�����</option>
                            </select>
                          </td>
                          <td width="105"><input name="keyword" type="text" size="15"></td>
                          <td><div align="center">
                              <input name="image" type='image' src="../img/btt_search.gif" width="54" height="18" border="0">
                          </div></td>
                        </tr>
                      </table>
					  </form>
                    </div>
                    </td>
                </table></td>
            </tr>
          </table><br></td>
	  </tr>
	</table>
</body>
</html>
