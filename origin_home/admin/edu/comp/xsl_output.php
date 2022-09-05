<?
include "../conf/connchk.inc";

 
///////////////////////////////////////
//SEND HEADER INFO
//다운로드를 위한 해더정보 출력
///////////////////////////////////////
$date=date("Ymd"); // 화일명중 날짜부분
$filename=$date.".csv";


header( "Content-type: application/vnd.ms-excel;charset=KSC5601" ); 
header( "Content-Disposition: attachment; filename=$filename" ); 
header( "Content-Description: PHP4 Generated Data" ); 

include "../conf/dbconn.inc";

 echo ("소속기관명,이름,주민번호,종류,교육일자,수료여부,수료확인증번호\r\n"); 
$sql="select A.idkey, A.name, A.jumin1, A.jumin2, A.com_id, B.company, C.date, C.type, C.state, C.ccode from on_edu_member A, on_edu_repre B, on_edu_member_rec C where A.idkey like C.idkey and A.com_id like B.com_id order by A.name asc";
$res=mysql_query($sql);
$total=mysql_affected_rows();

for($i=1; $i<$total+1; $i++){
	$row = mysql_fetch_object($res);
	 if ($row->state=="good"){ 
		$state="수료";
	 }else{ 
		$state="미수료";
	 } 
    echo ("$row->company,$row->name,$row->jumin1-$row->jumin2,$row->type,$row->date,$state,$row->ccode\r\n"); 
} 

include "../conf/dbconn_close.inc";

?><?=$row->company?>