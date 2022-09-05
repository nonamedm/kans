<?PHP
/********************************************************************
        NAME
        -DOWNLOAD CSV
        -CSV포멧 화일 생성 및 다운로드

        DESCRIPTION
        -파일로 다운로드를 위한 헤더정보 송출
        -해당 데이타 레코드 출력

        PARAMETER
        1._POST[type]:장표타입(한글)
        2._POST[query]:uid(일련번호를 알애내기 위한 이전페이지의 쿼리문)

        IMPORTED CLASS
        -CLASS_DATA(/myClasses/class_data.php):화물정보와 match되는 데이타계층 Object

        CODER(작성자)
        -임병찬(http://www.chan77.pe.kr)

**********************************************************************/



///////////////////////////////////////
//SEND HEADER INFO
//다운로드를 위한 해더정보 출력
///////////////////////////////////////
$date=date("Ymd");   // 화일명중 날짜부분
$filename=$date."_보수교육신청리스트.csv";
header( "Content-type: application/vnd.ms-excel;charset=KSC5601" ); 
header("Content-Disposition: attachment; filename=$filename");
header( "Content-Description: PHP4 Generated Data" );


//DATABASE CONNECTION
include('../dbconn.inc');

if($keyword){
	if($search=='licens') $sql="select * from edu_repair where d_licens like '%".$keyword."%' order by uid desc";
	else if($search=='jumin')	$sql="select * from edu_repair where jumin like '%".$keyword."%'  order by uid desc";
	else	$sql="select * from edu_repair where hope_date like '%".$keyword."%'  order by uid desc";
}else{
	$sql="select * from edu_repair order by uid desc";
}

//타이틀 프리트
echo "면허종류,면허번호 발급일자,최종교육일자, 희망교육일, 성명, 주민등록번호,	주소(거주지),	 전화(거주지),";
echo "이메일,근무처,부서,주소(근무처),전화(근무처)\n";

$result = mysql_query($sql);

//내용 프린트
while($row=mysql_fetch_array($result)) {


	echo $row[d_licens];
	echo (',');
	echo $row[d_date];
	echo (',');
	echo $row[e_end_date];
	echo (',');
	echo $row[hope_date];
	echo (',');
	echo $row[name];
	echo (',');

	echo $row[jumin];
	echo (',');
	echo $row[address];
	echo (',');
	echo $row[phone];
	echo (',');
	echo $row[email];
	echo (',');
	echo $row[job];
	echo (',');

	echo $row[dept];
	echo (',');
	echo $row[job_address];
	echo (',');
	echo $row[job_phone];
	echo (',');
	echo ("\n");
}

?> 
