<? 
include  "../dbconn.inc"; 

$writer=trim($writer);
$title=trim($title);
$content=trim($content);

if($boardfile != ''){

	$savedir='./notice_files';
	if(strcmp($boardfile,'none'))	{

		$full_filename=explode('.',$boardfile_name);
		$extension=$full_filename[sizeof($full_filename)-1];

		if(!($extension == 'hwp' || $extension == 'doc' || $extension == 'gif' || $extension == 'jpg' || $extension == 'ppt' || $extension == 'xls' || $extension == 'pdf' || $extension == 'zip')){
			echo"<script language=javascript>alert('[hwp,doc,gif,jpg,txt] ���ϸ� �ø��� �ֽ��ϴ�');history.back();</script>";
			exit;
		}

		$exist=file_exists("$savedir/$boardfile_name");
		if($exist){
			echo"<script language=javascript>alert(\"���� �̸��� ������ �����մϴ�. �ٸ��̸����� �÷��ּ���!\");history.back();</script>";
			exit;
		}
		
		if(!copy($boardfile,"$savedir/$boardfile_name")){
			alert($boardfile);
			echo"<script language=javascript>alert('���Ͼ��ε忡 �����߽��ϴ�! ��������̴� ���߿� �÷��ּ���!');history.back();</script>";
			exit;
		}
	}
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

	$query = "update f_notice set writer='".$writer."', title='".$title."', content='".$content."', filename='".$boardfile_name."'" ;
	$query = $query." where no=".$no;
}else{
	$query = "update f_notice set writer='".$writer."', title='".$title."', content='".$content."'";
	$query = $query." where no=".$no;
}


mysql_query($query);
echo"<script language=javascript>alert('�����Ǿ����ϴ�');opener.location.reload();window.close();</script>";
exit;

?>