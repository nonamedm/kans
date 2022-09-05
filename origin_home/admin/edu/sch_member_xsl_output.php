<?
if(!$cid){
	echo"<meta http-equiv=\"Refresh\" content=\"0 ; URL='../index.php'\">";
	exit;
}

if($_head_php_excuted) return;
if(!eregi($HTTP_HOST,$HTTP_REFERER)) Error("정상적으로 접근하여 주시기 바랍니다.");
if(eregi(":\/\/",$dir)) $dir=".";
 
///////////////////////////////////////
//SEND HEADER INFO
//다운로드를 위한 해더정보 출력
///////////////////////////////////////
$date=date("Ymd"); // 화일명중 날짜부분
$filename=$date."_smember.csv";


header( "Content-type: application/vnd.ms-excel;charset=KSC5601" ); 
header( "Content-Disposition: attachment; filename=$filename" ); 
header( "Content-Description: PHP4 Generated Data" ); 

include "../dbconn.inc";
 echo ("기관명,소속부서,수료자성명,주민등록번호,수료일자,교육구분,자료확인,수료상태\r\n"); 

$sql="SELECT * FROM edu_schedule where id = '".$sid."'";
	$ress=mysql_query($sql);
	$row = mysql_fetch_object($ress);
	
	$msql="SELECT * FROM edu_member where schedule = '".$sid."' order by name asc";
	$m_res=mysql_query($msql);
	$m_total=mysql_affected_rows();
	
for($i=1; $i<$m_total+1; $i++){
	$m_row = mysql_fetch_object($m_res);
	if ($m_row->edu_state=='1'){ $edu_s ="미신청"; }
	elseif ($m_row->edu_state=='2'){$edu_s = "신청";}
	elseif ($m_row->edu_state=='3'){$edu_s = "미결재"; }
	elseif ($m_row->edu_state=='4'){$edu_s = "결재완료";}
	elseif ($m_row->edu_state=='5'){$edu_s = "미수료";}
	elseif ($m_row->edu_state=='6'){$edu_s = "수료예정";}
	elseif ($m_row->edu_state=='7'){$edu_s = "수료";}
	else { $edu_s = "알수없음";}
	
	if ($row->edu_type=='신규'){ $edu_t ="종사전"; }
	elseif ($row->edu_type=='기존'){$edu_t = "정기";}
	else { $edu_t = "알수없음";}
	
	if($m_row->s_point > $row->s_point-1){ $s_p = "확인"; } 
    else{ $s_p = "미확인";} 
	
    echo ("$m_row->company1,$m_row->position,$m_row->name,$m_row->jumin1 - $m_row->jumin2,$row->month/$row->day,$edu_t,$s_p,$edu_s\r\n"); 
} 
{
	$n = $n-1;
}

mysql_close($dbconn); 

?>


