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
$filename=$date."_����������û����Ʈ.csv";
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

//Ÿ��Ʋ ����Ʈ
echo "��������,�����ȣ �߱�����,������������, ���������, ����, �ֹε�Ϲ�ȣ,	�ּ�(������),	 ��ȭ(������),";
echo "�̸���,�ٹ�ó,�μ�,�ּ�(�ٹ�ó),��ȭ(�ٹ�ó)\n";

$result = mysql_query($sql);

//���� ����Ʈ
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
