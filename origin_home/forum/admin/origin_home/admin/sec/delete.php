<? 
include  "../dbconn.inc"; 

$uid=trim($uid);

/** ���� ���� ���� **/
$sql="select filename from sec_board where uid=$uid";
$res=mysql_query($sql);
$row=mysql_fetch_object($res);

if($row->filename !=''){	
	$src='../../board_files/'.$row->filename;
	if(!unlink($src))	{
		//echo"<script language=javascript>alert('���� ������ �����Ҽ��� �����ϴ�!');history.back();</script>";
		//exit;
	}
}

$query = "delete from sec_board where uid=$uid";


mysql_query($query);
echo"<script language=javascript>opener.location.reload();window.close();</script>";
exit;

?>
