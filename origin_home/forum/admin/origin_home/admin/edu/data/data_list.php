<?
include "../conf/connchk.inc";
include "../conf/dbconn.inc";

if($keyword != ''){
	if($search=='title')
		$sql="select * from on_edu_data where title like '%".$keyword."%'order by title asc";
	else
		$sql="select * from on_edu_data where type like '%".$keyword."%'order by type asc";
}else{
	$sql="select * from on_edu_data order by title asc";
}

$res=mysql_query($sql);
$total=mysql_affected_rows();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<link rel="stylesheet" href="../css/style.css" type="text/css">
<title>:::: Secure ::::</title>
<script language="javascript">
function updateData(id, mode){
	var theURL='./data_add.php?id='+id +'&mode='+mode;
	var features='left=280,top=250,width=530,height=550,toolbars=no,menubar=no,scrollbars=yes,status=no,resizable=no';
	window.open(theURL,"",features);
}

function insertData(){
	var theURL='./data_add.php';
	var features='left=280,top=250,width=530,height=550,toolbars=no,menubar=no,scrollbars=yes,status=no,resizable=no';
	window.open(theURL,"",features);
}

function reviewData(id){
	var theURL='./data_review.php?id='+id;
	var features='left=280,top=250,width=530,height=300,toolbars=no,menubar=no,scrollbars=yes,status=no,resizable=no';
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
		    <? include("../conf/menu.php");?>
		    <!-- �޴����� -->
	        </div></td>
		</tr>
		<tr>
		  <td>
		  <form name='frm' method='post' action='./member_list.php'>
		  <table width="730" border="0" align="center">
            <tr>
              <td width="535" height="30">�� <strong> �����ڷ� ����</strong> || ��:
                <?=$total?> ��</td>
              <td><div align="right">
                <input name="addMemBtn" type="button" onclick="javascript:insertData();" value="�űԵ��" />
              </a></div></td>
            </tr>
			<tr>
			  <td colspan='2'><hr></td>
		    <tr>
              <td colspan="2"><table border="0" width="100%" cellpadding="0" cellspacing="0">
                <tr bgcolor="#F0F0F0">
                  <td height="30" align="center" width="24">no.</td>
                  <td width="253" height="30" align="center">����</td>
                  <td width="173" height="30" align="center">�뵵</td>
                  <td width="138" height="30" align="center">����</td>
                  <td width="100" height="30" align="center">�̸�����</td>
                  <?
					if($total<1)
					{
						echo"<tr align=center><td height='30' align='center' colspan='7' bgcolor='#FFFFFF'>��ϵ� �����ڷᰡ �����ϴ�.</td></tr>";
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
                  <td height="25" align="center"><?=$n?></td>
                  <td height="25"><div align="center"><a href="javascript:updateData('<?=$row->datacode?>','<?=MD5(update)?>')"><?=$row->title?></a></div></td>
                  <td height="25"><div align="center"><?=$row->type?></div></td>
                  <td height="25"><div align="center"><?=$row->comm?></div></td>
                  <td height="25"> 
				    <div align="center">
				      <input name="reviewBtn" type="button" onclick="javascript:reviewData('<?=$row->datacode?>');" value="�̸�����" />
		          </div></td>
                </tr>
                <tr height="1">
                  <td colspan="5" background="../image/BwDotH2.gif"></td>
                </tr>
                <?
					$n = $n-1;
				}
				?>
              </table>
              <br>
                <table width="100%" height="76" border="0" align="center">
                  <tr>
                    <td height="25" align="center">
					<?
						/****************************** ������ ī���� ��� ***********************************/
						if($pagelist > 1)  // ������ �׷������ ������ �̵�
						{
						   $p_page = (($pagelist -1)*10-1);
						  echo "<a href=data_list.php?page=$p_page&search=$search&keyword=$keyword>[���� 10��]</a>";
						} 
						
						$startpage = ($pagelist-1)*10+1;
						$endpage = $pagelist*10;
						if ($totalpage < $pagelist*10) $endpage = $totalpage;
						for ($i=$startpage; $i<=$endpage; $i++) {  // ���� ������
							if ($i==$page) { 
							echo " [$i] ";
							}else{
							echo " <a href=data_list.php?page=$i&search=$search&keyword=$keyword>[$i]</a> ";
							} 
						}
						if ($pagelist*10 < $totalpage) {  // ������ �׷������ �ڷ� �̵�
							$n_page = ($pagelist*10+1);
						   echo "<a href=data_list.php?page=$n_page&search=$search&keyword=$keyword>[����  10��]</a>";
						}
						/****************************** ������ ī���� ���  ��***********************************/
					?>					</td>
                  <tr>
                    <td height="30" align="center"><div align="center">
                      <table width="240" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="60"><select name="search">
                              <option value='title'>����</option>
                              <option value='type'>�뵵</option>
                            </select>                          </td>
                          <td width="105"><input name="keyword" type="text" size="15"></td>
                          <td><div align="center">
                              <input name="image" type='image' src="../image/btt_search.gif" width="54" height="18" border="0">
                          </div></td>
                        </tr>
                      </table>
					  
                    </div>                    </td>
                </table></td>
            </tr>
          </table>
		  </form>
		  <br></td>
	  </tr>
	</table>
</body>
</html>
<?
include "../conf/dbconn_close.inc";
?>