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
$filename=$date."_smember.csv";


header( "Content-type: application/vnd.ms-excel;charset=KSC5601" ); 
header( "Content-Disposition: attachment; filename=$filename" ); 
header( "Content-Description: PHP4 Generated Data" ); 

include "../dbconn.inc";
 echo ("�����,�ҼӺμ�,�����ڼ���,�ֹε�Ϲ�ȣ,��������,��������,�ڷ�Ȯ��,�������\r\n"); 

$sql="SELECT * FROM edu_schedule where id = '".$sid."'";
	$ress=mysql_query($sql);
	$row = mysql_fetch_object($ress);
	
	$msql="SELECT * FROM edu_member where schedule = '".$sid."' order by name asc";
	$m_res=mysql_query($msql);
	$m_total=mysql_affected_rows();
	
for($i=1; $i<$m_total+1; $i++){
	$m_row = mysql_fetch_object($m_res);
	if ($m_row->edu_state=='1'){ $edu_s ="�̽�û"; }
	elseif ($m_row->edu_state=='2'){$edu_s = "��û";}
	elseif ($m_row->edu_state=='3'){$edu_s = "�̰���"; }
	elseif ($m_row->edu_state=='4'){$edu_s = "����Ϸ�";}
	elseif ($m_row->edu_state=='5'){$edu_s = "�̼���";}
	elseif ($m_row->edu_state=='6'){$edu_s = "���Ό��";}
	elseif ($m_row->edu_state=='7'){$edu_s = "����";}
	else { $edu_s = "�˼�����";}
	
	if ($row->edu_type=='�ű�'){ $edu_t ="������"; }
	elseif ($row->edu_type=='����'){$edu_t = "����";}
	else { $edu_t = "�˼�����";}
	
	if($m_row->s_point > $row->s_point-1){ $s_p = "Ȯ��"; } 
    else{ $s_p = "��Ȯ��";} 
	
    echo ("$m_row->company1,$m_row->position,$m_row->name,$m_row->jumin1 - $m_row->jumin2,$row->month/$row->day,$edu_t,$s_p,$edu_s\r\n"); 
} 
{
	$n = $n-1;
}

mysql_close($dbconn); 

?>


