<?PHP
/********************************************************************
        NAME
        -DOWNLOAD CSV
        -CSV���� ȭ�� ���� �� �ٿ�ε�

        DESCRIPTION
        -���Ϸ� �ٿ�ε带 ���� ������� ����
        -�ش� ����Ÿ ���ڵ� ���

        PARAMETER
        1._POST[type]:��ǥŸ��(�ѱ�)
        2._POST[query]:uid(�Ϸù�ȣ�� �˾ֳ��� ���� ������������ ������)

        IMPORTED CLASS
        -CLASS_DATA(/myClasses/class_data.php):ȭ�������� match�Ǵ� ����Ÿ���� Object

        CODER(�ۼ���)
        -�Ӻ���(http://www.chan77.pe.kr)

**********************************************************************/



///////////////////////////////////////
//SEND HEADER INFO
//�ٿ�ε带 ���� �ش����� ���
///////////////////////////////////////
$date=date("Ymd");   // ȭ�ϸ��� ��¥�κ�
$filename=$date."_�����ڱ�����û����Ʈ.csv";
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

//Ÿ��Ʋ ����Ʈ
echo "�����,�ҼӺμ�,����,	�ֹε�Ϲ�ȣ,��������,���������,	��缱���������� ����,	�ҼӺμ�,";
echo "�ּ�,��ȭ,�ڵ���,�̸���\n";

$result = mysql_query($sql);

//���� ����Ʈ
while($worker=mysql_fetch_array($result)) {

	$sql = "select * from edu_worders where worker_id=".$worker[uid]." order by uid desc";
	$res = mysql_query($sql);

	while($workers =mysql_fetch_array($res)){

		if($workers[edu_flag]=='1') $edu = "�ű�";
		else $edu = "����";

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
