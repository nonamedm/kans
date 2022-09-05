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
$filename=$date.".csv";


header( "Content-type: application/vnd.ms-excel;charset=KSC5601" ); 
header( "Content-Disposition: attachment; filename=$filename" ); 
header( "Content-Description: PHP4 Generated Data" ); 

include "../dbconn.inc";
 echo ("회원번호,교육상태,교육방식,교육구분,기관명,소속부서,이름,주민등록번호,이메일,연락처,대표자,사업자등록번호,종목,업태,주소 \r\n"); 
$sql = "SELECT * FROM edu_member order by name asc"; 
$ress=mysql_query($sql);
$m_total=mysql_affected_rows();

for($i=1; $i<$m_total+1; $i++){
	$row = mysql_fetch_object($ress);
    echo ("$row->m_id,$row->edu_state,$row->edu_type,$row->type,$row->company1,$row->position,$row->name,$row->jumin1-$row->jumin2,$row->email,$row->tel1-$row->tel2-$row->tel3,$row->ceo,$row->com_num,$row->item,'$row->condition',$row->addr\r\n"); 
} 

mysql_close($dbconn); 

?>