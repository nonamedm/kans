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
$filename=$date."_��ű�����û����Ʈ.csv";
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

//Ÿ��Ʋ ����Ʈ

echo "����,�ֹε�Ϲ�ȣ,�̸���,���������,�ּ�(����),��ȭ(����),	�ڵ���, �ٹ�ó,	�ּ�(�ٹ�ó),��ȭ(�ٹ�ó)\n";

$result = mysql_query($sql);

//���� ����Ʈ
while($worker=mysql_fetch_array($result)) {

	if($worker[post_flag]=='1') $post_flag = "����";
	else $post_flag = "����";

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
