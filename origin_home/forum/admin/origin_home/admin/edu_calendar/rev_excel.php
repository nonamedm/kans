<? 
header( "Content-type: application/vnd.ms-excel" ); 
header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-Disposition: attachment; filename = rev_member.xls" ); 
header( "Content-Description: PHP4 Generated Data" );

include "../dbconn.inc";

$uid = $id;

if($uid !=''){
    $sql="select C.* from edu_calendar A, edu_rev B, edu_rev_member C  where A.uid like B.uid and A.uid like C.uid and A.uid = '".$uid."'";
    $res=mysql_query($sql);
    $total=mysql_affected_rows();

    $sql2="select * from edu_calendar where uid = '".$uid."'";
    $res2=mysql_query($sql2);
    $row2 = mysql_fetch_object($res2);
    $group_id = $row2->group_id;
    $area_id = $row2->area_id;
    
    $sql3="select * from edu_calendar_group where group_id = $group_id";
    $res3=mysql_query($sql3);
    $row3 = mysql_fetch_object($res3);
    
    $sql4="select * from edu_calendar_area where area_id = $area_id";
    $res4=mysql_query($sql4);
    $row4 = mysql_fetch_object($res4);

?>

<meta http-equiv='Content-Type' content='text/html; charset=euc-kr'>
<table border=0 align=center cellpadding=1 cellspacing=1 >
<tr height='30'>
  <td width='60' height="25" align=center>������</td>  
  <td width='100' height="25" align=center>�����з�</td>
  <td width='60' height="25" align=center>����</td>
  <td width='60' height="25" align=center>�̸�</td>
  <td width='95' height="25" align=center>�������</td>
  <td width="100" height="25" align=center>����ó</td> 
  <td width="100" height="25" align=center>�̸���</td>   
  <td width="100" height="25" align=center>�����</td> 
  <td width="100" height="25" align=center>�μ�</td> 
  <td width='100' height="25" align=center>��������</td>
  <td width='100' height="25" align=center>�����ȣ</td>
  <td width='100' height="25" align=center>�����������</td>
</tr>

<?
if($total<1){
	echo"<tr align=center><td height='25' colspan='9' align=center>��ϵ� �����ڰ� �����ϴ�.</td></tr>";
}
					
for($i=0; $i<$total; $i++){
    $row = mysql_fetch_object($res);			//�� ���� ��ü���÷� �����´�
    $lictype=$row->license_type;
    if($lictype=='00'){
        $lictype='����';
    }elseif($lictype=='01'){
        $lictype='�Ϲ�';
    }elseif($lictype=='02'){
        $lictype='����';
    }elseif($lictype=='03'){
        $lictype='Ư��';
    }
?>
<tr align='center' height='25'>
    <td align=center ><?=$row2->title?></td>
    <td align=center ><?=$row3->group_name?></td>
    <td align=center ><?=$row4->area_name?></td>
	<td align=center ><?=$row->name?></td>
	<td align=center ><?=$row->birth?></td>
	<td align=center ><?=$row->tel?></td>
	<td align=center ><?=$row->email?></td>
	<td align=center ><?=$row->company?></td>
    <td align=center ><?=$row->part?></td>
    <td align=center ><?=$lictype?></td>
    <td align=center ><?=$row->license_num?></td>
    <td align=center ><?=$row->license_reg?></td>
</tr>
<?
}
?>
</table>
<?
}else{
    echo"<script language=javascript>alert('����ó������ �ʾҽ��ϴ�.');opener.location.reload();window.close();</script>";
    exit;
}
?>