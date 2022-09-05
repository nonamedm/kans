<? 
ob_start();

include  "../conf/dbconn.inc"; 

if ($filenum == 1) {
	$sql="select filename from board where uid=$uid";
	$res=mysql_query($sql);
	$row=mysql_fetch_object($res);

	if($row->filename !=''){	
		$src='../direct_files/'.$row->filename;
		if(!unlink($src))	{
		}
	}

	$query = "update board set filename='' where uid=".$uid;
	mysql_query($query);

} elseif ($filenum == 2) {
	$sql="select filename2 from board where uid=$uid";
	$res=mysql_query($sql);
	$row=mysql_fetch_object($res);

	if($row->filename2 !=''){	
		$src='../direct_files/'.$row->filename2;
		if(!unlink($src))	{
		}
	}

	$query = "update board set filename2='' where uid=".$uid;
	mysql_query($query);
} elseif ($filenum == 3) {
	$sql="select filename3 from board where uid=$uid";
	$res=mysql_query($sql);
	$row=mysql_fetch_object($res);

	if($row->filename3 !=''){	
		$src='../direct_files/'.$row->filename3;
		if(!unlink($src))	{
		}
	}

	$query = "update board set filename3='' where uid=".$uid;
	mysql_query($query);
}

echo"<script language=javascript>alert('삭제되었습니다.');parent.window.location.reload(true);</script>";

include "../conf/dbconn_close.inc";
?>
