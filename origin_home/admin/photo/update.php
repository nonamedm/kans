<? 
include  "../dbconn.inc"; 

$writer=trim($writer);
$title=trim($title);
$content=trim($content);

if($photofile != ''){

	$savedir='../../photo_files';
	if(strcmp($photofile,'none'))	{

		$full_filename=explode('.',$photofile_name);
		$extension=$full_filename[sizeof($full_filename)-1];

		if(!($extension == 'gif' || $extension == 'jpg')){
			echo"<script language=javascript>alert('[gif,jpg] ���ϸ� �ø��� �ֽ��ϴ�');history.back();</script>";
			exit;
		}

		$exist=file_exists("$savedir/$photofile_name");
		if($exist){
			echo"<script language=javascript>alert(\"���� �̸��� ������ �����մϴ�. �ٸ��̸����� �÷��ּ���!\");history.back();</script>";
			exit;
		}
		if(!copy($photofile,"$savedir/$photofile_name")){
			echo"<script language=javascript>alert('���Ͼ��ε忡 �����߽��ϴ�! ��������̴� ���߿� �÷��ּ���!');history.back();</script>";
			exit;
		}
	}
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

	$query = "update board set writer='".$writer."', title='".$title."', content='".$content."', filename='".$photofile_name."'" ;
	$query = $query." where uid=".$uid;
}else{
	$query = "update board set writer='".$writer."', title='".$title."', content='".$content."'";
	$query = $query." where uid=".$uid;
}


mysql_query($query);
echo"<script language=javascript>alert('�����Ǿ����ϴ�');opener.location.reload();window.close();</script>";
exit;

?>