<? 
include  "../dbconn.inc"; 

$uid=trim($uid);

/** ���� ���� ���� **/
$sql="select filename from board where uid=$uid";
$res=mysql_query($sql);
$row=mysql_fetch_object($res);

if($row->filename !=''){	
	$src='../../photo_files/'.$row->filename;
	if(!unlink($src))	{
		//echo"<script language=javascript>alert('���� ������ �����Ҽ��� �����ϴ�!');history.back();</script>";
		//exit;
	}
}

$query = "delete from board where uid=$uid";


mysql_query($query);
echo"<script language=javascript>opener.location.reload();window.close();</script>";
exit;

?>
