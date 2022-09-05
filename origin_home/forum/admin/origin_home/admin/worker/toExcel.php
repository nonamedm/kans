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
$filename=$date."_종사자교육신청리스트.csv";
header( "Content-type: application/vnd.ms-excel;charset=KSC5601" ); 
header("Content-Disposition: attachment; filename=$filename");
header( "Content-Description: PHP4 Generated Data" );


//DATABASE CONNECTION
include('../dbconn.inc');

if($keyword){
	if($search=='organ') 	
		$sql="select * from edu_worker where organ_name like '%".$keyword."%' order by uid desc";
	else if($search=='jumin')
		$sql="select a.* from edu_worker a, edu_worders b where a.uid=b.worker_id and b.jumin like '%".$keyword."%'  group by a.uid";
	else
		$sql="select a.* from edu_worker a, edu_worders b where a.uid=b.worker_id and b.hope_day like '%".$keyword."%' group by a.uid";
}else{
	$sql="select * from edu_worker order by uid desc";
}

//타이틀 프리트
echo "기관명,소속부서,성명,	주민등록번호,교육구분,희망교육일,	방사선안전관리자 성명,	소속부서,";
echo "주소,전화,핸드폰,이메일\n";

$result = mysql_query($sql);

//내용 프린트
while($worker=mysql_fetch_array($result)) {

	$sql = "select * from edu_worders where worker_id=".$worker[uid]." order by uid desc";
	$res = mysql_query($sql);

	while($workers =mysql_fetch_array($res)){

		if($workers[edu_flag]=='1') $edu = "신규";
		else $edu = "기존";

		echo $worker[organ_name];
		echo (',');
		echo $workers[dept];
		echo (',');
		echo $workers[name];
		echo (',');
		echo $workers[jumin];
		echo (',');
		echo $edu;
		echo (',');
		echo $workers[hope_day];
		echo (',');

		echo $worker[name];
		echo (',');
		echo $worker[dept];
		echo (',');
		echo $worker[address];
		echo (',');
		echo $worker[phone];
		echo (',');
		echo $worker[mobile];
		echo (',');
		echo $worker[email];
		echo (',');
		echo ("\n");
	}
}

?> 
