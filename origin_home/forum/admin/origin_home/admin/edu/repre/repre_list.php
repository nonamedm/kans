<?
include "../conf/connchk.inc";
include "../conf/dbconn.inc";

if($keyword != ''){
	if($search=='name')
		$sql="select * from on_edu_repre where name like '%".$keyword."%' order by name asc";
	else
		$sql="select * from on_edu_repre where company like '%".$keyword."%' order by company asc";
}else{
	$sql="SELECT * FROM on_edu_repre order by company asc";
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
	id = id.replace("&", "@amp;");
	var theURL='./repre_add.php?id='+id +'&mode='+mode;
	var features='left=280,top=250,width=510,height=400,toolbars=no,menubar=no,scrollbars=no,status=no,resizable=no';
	window.open(theURL,"",features);
}

function insertData(){
	var theURL='./repre_add.php';
	var features='left=280,top=250,width=510,height=400,toolbars=no,menubar=no,scrollbars=no,status=no,resizable=no';
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
		  <td><table width="730" border="0" align="center">
            <tr>
              <td width="535" height="30">�� <strong>�Ҽӱ�� �� ������ ����</strong> || ��:
                <?=$total?> ��</td>
              <td><div align="right">
                <input name="addRepreBtn" type="button" onclick="javascript:insertData();" value="�űԵ��" />
              </a></div>                <div align="right"><a href='xsl_output.php'></a></div></td>
            </tr>
			<tr>
			  <td colspan='2'><hr></td>
		    <tr>
              <td colspan="2"><table border="0" width="100%" cellpadding="0" cellspacing="0">
                <tr bgcolor="#F0F0F0">
                  <td height="30" align="center" width="25">no.</td>
                  <td width="323" height="30" align="center">�Ҽӱ����</td>
                  <td width="181" height="30" align="center">������ �̸� (ID) </td>
                  <td width="166" height="30" align="center">����ó</td>
                  <?
					if($total<1)
					{
						echo"<tr align=center><td height='30' align='center' colspan='7'>��ϵ� �Ҽӱ�� �� ��ǥ�ڰ� �����ϴ�.</td></tr>";
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
                  <td height="25"><div align="center"><a href="javascript:updateData('<?=$row->id?>','<?=MD5(update)?>')"><?=$row->company?></a></div></td>
                  <td height="25"><div align="center"><?=$row->name?> (<?=$row->id?>)</div></td>
                  <td height="25"><div align="center"><?=$row->tel?></div></td>
                </tr>
                <tr height="1">
                  <td colspan="4" background="../image/BwDotH2.gif"></td>
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
						  echo "<a href=repre_list.php?page=$p_page&search=$search&keyword=$keyword>[���� 10��]</a>";
						} 
						
						$startpage = ($pagelist-1)*10+1;
						$endpage = $pagelist*10;
						if ($totalpage < $pagelist*10) $endpage = $totalpage;
						for ($i=$startpage; $i<=$endpage; $i++) {  // ���� ������
							if ($i==$page) { 
							echo " [$i] ";
							}else{
							echo " <a href=repre_list.php?page=$i&search=$search&keyword=$keyword>[$i]</a> ";
							} 
						}
						if ($pagelist*10 < $totalpage) {  // ������ �׷������ �ڷ� �̵�
							$n_page = ($pagelist*10+1);
						   echo "<a href=repre_list.php?page=$n_page&search=$search&keyword=$keyword>[����  10��]</a>";
						}
						/****************************** ������ ī���� ���  ��***********************************/
					?>					</td>
                  <tr>
                    <td height="30" align="center"><div align="center">
					<form name='frm' method='post' action='./repre_list.php'>
                      <table width="240" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="60"><select name="search">
						 	  <option value='company'>�Ҽӱ����</option>
                              <option value='name'>�������̸�</option>
                            </select>                          </td>
                          <td width="105"><input name="keyword" type="text" size="15"></td>
                          <td><div align="center">
                              <input name="image" type='image' src="../image/btt_search.gif" width="54" height="18" border="0">
                          </div></td>
                        </tr>
                      </table>
					  </form>
                    </div>                    </td>
                </table></td>
            </tr>
          </table>
		  <br></td>
	  </tr>
	</table>
</body>
</html>
<?
include "../conf/dbconn_close.inc";
?>