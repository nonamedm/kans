<?
include "../conf/connchk.inc";
include "../conf/dbconn.inc";

if($keyword != ''){
	if($search=='name'){
		$sql="select A.idkey, A.name, A.jumin1, A.jumin2, A.com_id, B.company from on_edu_member A, on_edu_repre B where A.com_id like B.com_id and A.name like '%".$keyword."%'order by A.name asc";
	}else if($search=='jumin'){
		$sql="select A.idkey, A.name, A.jumin1, A.jumin2, A.com_id, B.company from on_edu_member A, on_edu_repre B where A.com_id like B.com_id and A.jumin1 like '%".$keyword."%'order by A.name asc";
	}else{
		$sql="select A.idkey, A.name, A.jumin1, A.jumin2, A.com_id, B.company from on_edu_member A, on_edu_repre B where A.com_id like B.com_id and B.company like '%".$keyword."%'order by A.name asc";
	}
}else{
	$sql="select A.idkey, A.name, A.jumin1, A.jumin2, A.com_id, B.company from on_edu_member A, on_edu_repre B where A.com_id like B.com_id order by A.name asc";
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
function updateData(id, mode, com){
	var theURL='./member_add.php?id='+id +'&mode='+mode+'&com='+com;
	var features='left=280,top=250,width=530,height=550,toolbars=no,menubar=no,scrollbars=yes,status=no,resizable=no';
	window.open(theURL,"",features);
}

function insertData(){
	var theURL='./member_add.php';
	var features='left=280,top=250,width=530,height=550,toolbars=no,menubar=no,scrollbars=yes,status=no,resizable=no';
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
		    <!-- 메뉴시작 -->
		    <? include("../conf/menu.php");?>
		    <!-- 메뉴시작 -->
	        </div></td>
		</tr>
		<tr>
		  <td>
		  <form name='frm' method='post' action='./member_list.php'>
		  <table width="730" border="0" align="center">
            <tr>
              <td width="535" height="30">▒ <strong>
                </strong><strong>교육종사자 관리</strong> || 총:
                <?=$total?> 명</td>
              <td><div align="right">
                <input name="addMemBtn" type="button" onclick="javascript:insertData();" value="신규등록" />
              </a></div></td>
            </tr>
			<tr>
			  <td colspan='2'><hr></td>
		    <tr>
              <td colspan="2"><table border="0" width="100%" cellpadding="0" cellspacing="0">
                <tr bgcolor="#F0F0F0">
                  <td height="30" align="center" width="24">no.</td>
                  <td width="253" height="30" align="center">소속기관명</td>
                  <td width="90" height="30" align="center"> 이름 </td>
                  <td width="150" height="30" align="center">주민번호</td>
                  <td width="171" height="30" align="center">최종 교육일자</td>
                  <?
					if($total<1)
					{
						echo"<tr align=center><td height='30' align='center' colspan='7'>등록된 교육 대상자가 없습니다.</td></tr>";
					}
					/***** 페이지 카운트 관련 기본값 설정 **********************************************/
					
					// 한 페이지에 리스트 시킬 레코드 수
					
					if($list == ''){
						$list=20;		
					}
					//현재 페이지 값 설정
					if(!$page)	$page = 1;   
					
					// 전체 페이지 값 얻기
					if(($total%$list)== 0)	$totalpage =  intval($total / $list);
					else	$totalpage = intval($total / $list) + 1;
					
					// 페이지 그룹 값 설정(페이지 카운터를 몇 개까지 출력할 것인지 설정)
					
					if(($page%10) == 0)	$pagelist = intval($page / 10);
					else	$pagelist = intval($page / 10) + 1;
					
					$start = ($page-1)* $list;												// 현재 페이지에서 시작 레코드 값 설정
					$end = ($page) * $list;													// 현재 페이지에서 마지막 레코드 값 설정
					
					if($end > $total) 	$end = $total;
					
					// 현재 페이지에서 리스트의 레코드 시작 레코드로 이동
					
					if ($page > 1) mysql_data_seek($res, $start);
					
					/***** 페이지 카운트 관련 기본값 설정 끝 *******************************************/
					$cpage=$page - 1;
					$n = $total - $cpage*$list ;
					
					/***** 리스트 출력  // 현재 페이지에 해당 하는 리스트만 출력**********************************************/
					for($i=$start; $i<$end; $i++){
						$row = mysql_fetch_object($res);			//한 열씩 객체형택로 가져온다
					?>
                <tr>
                  <td height="25" align="center"><?=$n?></td>
                  <td height="25"><div align="center"><?=$row->company?></div></td>
                  <td height="25"><div align="center"><a href="javascript:updateData('<?=$row->idkey?>','<?=MD5(update)?>','<?=$row->com_id?>')"><?=$row->name?></a></div></td>
                  <td height="25"><div align="center"><?=$row->jumin1?>-<?=$row->jumin2?></div></td>
                  <td height="25"> 
				    <div align="center">
				    <?
					$msql="SELECT date FROM on_edu_member_rec where idkey = '".$row->idkey."' order by date desc";
					$m_res=mysql_query($msql);
	 				$rows = mysql_fetch_object($m_res);
				    ?>
				      <?=$rows->date?>
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
						/****************************** 페이지 카운터 출력 ***********************************/
						if($pagelist > 1)  // 페이지 그룹단위로 앞으로 이동
						{
						   $p_page = (($pagelist -1)*10-1);
						  echo "<a href=member_list.php?page=$p_page&search=$search&keyword=$keyword>[이전 10개]</a>";
						} 
						
						$startpage = ($pagelist-1)*10+1;
						$endpage = $pagelist*10;
						if ($totalpage < $pagelist*10) $endpage = $totalpage;
						for ($i=$startpage; $i<=$endpage; $i++) {  // 현재 페이지
							if ($i==$page) { 
							echo " [$i] ";
							}else{
							echo " <a href=member_list.php?page=$i&search=$search&keyword=$keyword>[$i]</a> ";
							} 
						}
						if ($pagelist*10 < $totalpage) {  // 페이지 그룹단위로 뒤로 이동
							$n_page = ($pagelist*10+1);
						   echo "<a href=member_list.php?page=$n_page&search=$search&keyword=$keyword>[다음  10개]</a>";
						}
						/****************************** 페이지 카운터 출력  끝***********************************/
					?>					</td>
                  <tr>
                    <td height="30" align="center"><div align="center">
                      <table width="240" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="60"><select name="search">
                              <option value='company'>소속기관명</option>
                              <option value='name'>이름</option>
							  <option value='jumin'>주민번호앞자리</option>
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