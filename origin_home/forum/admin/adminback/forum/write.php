<? 
include  "../dbconn.inc"; 


///////////////////////////////// ���        ///////////////

if($boardfile != ''){

	$savedir='./forum_files';
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
			echo"<script language=javascript>alert('���Ͼ��ε忡 �����߽��ϴ�! ��������̴� ���߿� �÷��ּ���!');history.back();</script>";
			exit;
		}
	}
}

$writer=trim($writer);
$title=trim($title);
$content=trim($content);

$now=mktime();
$now=date(Y.'.'.m.'.'.d,$now);

$query = "insert into f_forum(writer, title, content, filename, visit, regdate) values(";
$query = $query." '".$writer."', ";
$query = $query." '".$title."', ";
$query = $query." '".$content."', ";
$query = $query." '".$boardfile_name."', ";
$query = $query." 0, sysdate()) ";


if(mysql_query($query)){
	echo"<script language=javascript>alert('��ϵǾ����ϴ�');opener.location.href='./list.php';window.close();</script>";
	exit;
}else{
	echo"<script language=javascript>alert('��Ͽ� �����߽��ϴ�. �����ڿ��� ���ǹٶ��ϴ�.');opener.location.reload();window.close();</script>";
	exit;
}
?>