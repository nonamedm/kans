<? 
include  "../dbconn.inc"; 

$no=trim($no);

/** ���� ���� ���� **/
$sql="select filename from f_notice where no=$no";
$res=mysql_query($sql);
$row=mysql_fetch_object($res);

if($row->filename !=''){	
	$src='./notice_files/'.$row->filename;
	if(!unlink($src))	{
		//echo"<script language=javascript>alert('���� ������ �����Ҽ��� �����ϴ�!');history.back();</script>";
		//exit;
	}
}

$query = "delete from f_notice where no=$no";


mysql_query($query);
echo"<script language=javascript>opener.location.reload();window.close();</script>";
exit;

?>
