<?
if(!$cid){
	echo"<meta http-equiv=\"Refresh\" content=\"0 ; URL='../index.php'\">";
	exit;
}

if($_head_php_excuted) return;
if(!eregi($HTTP_HOST,$HTTP_REFERER)) Error("���������� �����Ͽ� �ֽñ� �ٶ��ϴ�.");
if(eregi(":\/\/",$dir)) $dir=".";
 
///////////////////////////////////////
//SEND HEADER INFO
//�ٿ�ε带 ���� �ش����� ���
///////////////////////////////////////
$date=date("Ymd"); // ȭ�ϸ��� ��¥�κ�
$filename=$date.".csv";


header( "Content-type: application/vnd.ms-excel;charset=KSC5601" ); 
header( "Content-Disposition: attachment; filename=$filename" ); 
header( "Content-Description: PHP4 Generated Data" ); 

include "../dbconn.inc";
 echo ("ȸ����ȣ,��������,�������,��������,�����,�ҼӺμ�,�̸�,�ֹε�Ϲ�ȣ,�̸���,����ó,��ǥ��,����ڵ�Ϲ�ȣ,����,����,�ּ� \r\n"); 
$sql = "SELECT * FROM edu_member order by name asc"; 
$ress=mysql_query($sql);
$m_total=mysql_affected_rows();

for($i=1; $i<$m_total+1; $i++){
	$row = mysql_fetch_object($ress);
    echo ("$row->m_id,$row->edu_state,$row->edu_type,$row->type,$row->company1,$row->position,$row->name,$row->jumin1-$row->jumin2,$row->email,$row->tel1-$row->tel2-$row->tel3,$row->ceo,$row->com_num,$row->item,'$row->condition',$row->addr\r\n"); 
} 

mysql_close($dbconn); 

?>