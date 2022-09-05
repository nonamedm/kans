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
$filename=$date."_통신교육신청리스트.csv";
header( "Content-type: application/vnd.ms-excel;charset=KSC5601" ); 
header("Content-Disposition: attachment; filename=$filename");
header( "Content-Description: PHP4 Generated Data" );


//DATABASE CONNECTION
include('../dbconn.inc');

if($keyword){
	if($search=='jumin') 	
		$sql="select * from edu_comunicate where jumin like '%".$keyword."%' order by uid desc";
}else{
	$sql="select * from edu_comunicate order by uid desc";
}

//타이틀 프리트

echo "성명,주민등록번호,이메일,우편수령지,주소(자택),전화(자택),	핸드폰, 근무처,	주소(근무처),전화(근무처)\n";

$result = mysql_query($sql);

//내용 프린트
while($worker=mysql_fetch_array($result)) {

	if($worker[post_flag]=='1') $post_flag = "자택";
	else $post_flag = "직장";

	echo $worker[name];
	echo (',');
	echo $worker[jumin];
	echo (',');
	echo $worker[email];
	echo (',');
	echo $post_flag;
	echo (',');
	echo $worker[address];
	echo (',');

	echo $worker[phone];
	echo (',');
	echo $worker[mobile];
	echo (',');
	echo $worker[job];
	echo (',');
	echo $worker[job_address];
	echo (',');
	echo $worker[job_phone];
	echo (',');
	echo ("\n");
}

?> 
