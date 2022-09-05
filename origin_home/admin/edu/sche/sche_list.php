<?
include "../conf/connchk.inc";
include "../conf/dbconn.inc";

if($year !=''){
	$sql="select * from on_edu_schedule where year like '%".$year."%' order by sdate desc";
}else{
	if($keyword != ''){
		if($search=='sdate'){
			$sql="select * from on_edu_scheduleB where sdate like '%".$keyword."%'order by sdate desc";
		}else if($search=='edate'){
			$sql="select * from on_edu_scheduleB where edate like '%".$keyword."%'order by sdate desc";
		}else{
			$sql="select * from on_edu_schedule where type like '%".$keyword."%'order by sdate desc";
		}
	}else{
		$sql="select * from on_edu_schedule order by sdate desc";
	}
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
function updateDate(id, mode){
	var theURL='./sche_add.php?id='+id +'&mode='+mode;
	var features='left=280,top=250,width=510,height=400,toolbars=no,menubar=no,scrollbars=no,status=no,resizable=no';
	window.open(theURL,"",features);
}

function insertData(){
	var theURL='./sche_add.php';
	var features='left=280,top=250,width=510,height=400,toolbars=no,menubar=no,scrollbars=no,status=no,resizable=no';
	window.open(theURL,"",features);
}

function viewMember(id, mode){
	var theURL='./sche_member.php?id='+id +'&mode='+mode;
	var features='left=280,top=250,width=510,height=400,toolbars=no,menubar=no,scrollbars=yes,status=no,resizable=no';
	window.open(theURL,"",features);
}

function viewData(id, mode){
	var theURL='./sche_data.php?id='+id +'&mode='+mode;
	var features='left=280,top=250,width=510,height=400,toolbars=no,menubar=no,scrollbars=yes,status=no,resizable=no';
	window.open(theURL,"",features);
}

function updateMember(id, mode){
	var theURL='./sche_add_member.php?id='+id +'&mode='+mode;
	var features='left=280,top=250,width=510,height=400,toolbars=no,menubar=no,scrollbars=yes,status=no,resizable=no';
	window.open(theURL,"",features);
}

function updateData(id, mode){
	var theURL='./sche_add_data.php?id='+id +'&mode='+mode;
	var features='left=280,top=250,width=510,height=400,toolbars=no,menubar=no,scrollbars=yes,status=no,resizable=no';
	window.open(theURL,"",features);
}

function updateMemCom(id, mode){
	var theURL='./sche_member_comp.php?id='+id +'&mode='+mode;
	var features='left=280,top=250,width=510,height=400,toolbars=no,menubar=no,scrollbars=yes,status=no,resizable=no';
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
		  
		  <form name='frm' method='post' action='./sche_list.php'>
		  <table width="730" border="0" align="center">
            <tr>
              <td width="353" height="30">▒ 
                 <select name="year" onchange="javascript:submit();">
                   <option value="" <? if ($year == '') echo "selected"; ?>>전체</option>
                   <option value="2007" <? if ($year == '2007') echo "selected"; ?>>2007</option>
                   <option value="2008" <? if ($year == '2008') echo "selected"; ?>>2008</option>
                   <option value="2009" <? if ($year == '2009') echo "selected"; ?>>2009</option>
                   <option value="2010" <? if ($year == '2010') echo "selected"; ?>>2010</option>
				   <option value="2011" <? if ($year == '2011') echo "selected"; ?>>2011</option>
                   <option value="2012" <? if ($year == '2012') echo "selected"; ?>>2012</option>
                   <option value="2013" <? if ($year == '2013') echo "selected"; ?>>2013</option>
                 </select>
년도 || <strong>교육일정 
                관리</strong> || 총:
                <?=$total?>개</td>
              <td width="276"><div align="right"><a href="../online.doc" target="_blank">메뉴얼 다운로드</a></div></td>
              <td width="87"><div align="right">
                <input name="addScheBtn" type="button" onclick="javascript:insertData();" value="신규등록" />
                </a></div></td>
            </tr>
			<tr>
			  <td colspan='3'><hr></td>
		    <tr>
              <td colspan="3"><table border="0" width="100%" cellpadding="0" cellspacing="0">
                <tr bgcolor="#F0F0F0">
                  <td height="30" align="center" width="19"><div align="center">no.</div></td>
                  <td width="150" height="30" align="center"><div align="center">교육기간</div></td>
                  <td width="161" height="30" align="center"> <div align="center">교육종류 </div></td>
                  <td width="60" height="30" align="center"><div align="center">시간</div></td>
                  <td width="60" height="30" align="center"><div align="center">접수(명)</div></td>
                  <td width="60" height="30" align="center"><div align="center">자료(수)</div></td>
                  <td width="50" height="30" align="center"><div align="center">종사자</div></td>
                  <td width="50" height="30" align="center"><div align="center">자료</div></td>
                  <td width="50" height="30" align="center"><div align="center">수료</div></td>
                  <?
					if($total<1)
					{
						echo"<tr align=center><td height='30' align='center' colspan='9'>등록된 교육일이 없습니다.</td></tr>";
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
						
						$msql="SELECT * FROM on_edu_member_sch where code = '".$row->code."'";
						$m_res=mysql_query($msql);
						$m_total=mysql_affected_rows();
						
						$dsql="SELECT * FROM on_edu_sch_data where code = '".$row->code."'";
						$d_res=mysql_query($dsql);
						$d_total=mysql_affected_rows();
					?>
                <tr>
                  <td height="30" align="center"><?=$n?></td>
                  <td height="30"><div align="center"><a href="javascript:updateDate('<?=$row->code?>','<?=MD5(update)?>')"><?=$row->sdate?> ~ <?=$row->edate?></a></div></td>
                  <td height="30"><div align="center"><?=$row->type?></div></td>
                  <td height="30"><div align="center">
                    <?=$row->ttime?>
                  </div></td>
                  <td width="60" height="30"><div align="center"><input name="dataBtn3" type="button" onclick="javascript:viewMember('<?=$row->code?>','<?=MD5(view)?>');" value="<?=$m_total?>" /></div></td>
                  <td width="60" height="30"><div align="center"><input name="dataBtn2" type="button" onclick="javascript:viewData('<?=$row->code?>','<?=MD5(view)?>');" value="<?=$d_total?>" /></div></td>
                  <td height="30"><div align="center">
                    <input name="memberBtn" type="button" onclick="javascript:updateMember('<?=$row->code?>','<?=MD5(member)?>');" value="관리" />
                  </div></td>
                  <td height="30"><div align="center">
                    <input name="dataBtn" type="button" onclick="javascript:updateData('<?=$row->code?>','<?=MD5(data)?>');" value="관리" />
                  </div></td>
                  <td height="30"><div align="center">
                    <input name="memComBtn" type="button" onclick="javascript:updateMemCom('<?=$row->code?>','<?=MD5(memberCom)?>');" value="관리" />
                  </div></td>
                </tr>
                <tr height="1">
                  <td height="1" colspan="9" background="../image/BwDotH2.gif"></td>
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
						  echo "<a href=sche_list.php?page=$p_page&search=$search&keyword=$keyword&year=$year>[이전 10개]</a>";
						} 
						
						$startpage = ($pagelist-1)*10+1;
						$endpage = $pagelist*10;
						if ($totalpage < $pagelist*10) $endpage = $totalpage;
						for ($i=$startpage; $i<=$endpage; $i++) {  // 현재 페이지
							if ($i==$page) { 
							echo " [$i] ";
							}else{
							echo " <a href=sche_list.php?page=$i&search=$search&keyword=$keyword&year=$year>[$i]</a> ";
							} 
						}
						if ($pagelist*10 < $totalpage) {  // 페이지 그룹단위로 뒤로 이동
							$n_page = ($pagelist*10+1);
						   echo "<a href=sche_list.php?page=$n_page&search=$search&keyword=$keyword&year=$year>[다음  10개]</a>";
						}
						/****************************** 페이지 카운터 출력  끝***********************************/
					?>					</td>
                  <tr>
                    <td height="30" align="center"><div align="center">
					
                      <table width="240" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                          <td width="60"><select name="search">
                              <option value='sdate'>시작일</option>
							  <option value='edate'>종료일</option>
                              <option value='type'>교육종류</option>
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