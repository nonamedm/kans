<? 
ob_start();

include  "../conf/dbconn.inc"; 

if ( $data08_uid==$uid && $data08_pw==$pw && $data08_ok=="Ok" && $type=="de" ) {

	/** ���� ���� ���� **/
	$sql="select filename, filename2, filename3 from board where uid=$uid";
	$res=mysql_query($sql);
	$row=mysql_fetch_object($res);

	if($row->filename !=''){	
		$src='../direct_files/'.$row->filename;
		if(!unlink($src))	{
		}
	}
	if($row->filename2 !=''){	
		$src='../direct_files/'.$row->filename2;
		if(!unlink($src))	{
		}
	}
	if($row->filename3 !=''){	
		$src='../direct_files/'.$row->filename3;
		if(!unlink($src))	{
		}
	}

	$query = "delete from board where uid=$uid";
	mysql_query($query);

	echo "<script language=javascript>alert(\"�����Ǿ����ϴ�.!\");location.href='data08.html';</script>";
} else {
	echo "<script language=javascript>alert(\"�������� �̿� ����� �ƴմϴ�.!\");location.href='data08.html';</script>";
}
include "../conf/dbconn_close.inc";
?>
