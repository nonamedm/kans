<? 
include  "../dbconn.inc"; 


///////////////////////////////// ���        ///////////////

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
			echo"<script language=javascript>alert('���Ͼ��ε忡 ���������ϴ�! ��������̴� ���߿� �÷��ּ���!');history.back();</script>";
			exit;
		}
	}
}

$writer=trim($writer);
$title=trim($title);
$content=trim($content);

$sql = "select max(fid)+1 as fid from board where bbs_id=16"; 
$result=mysql_query($sql);
$row= mysql_fetch_object($result);
$fid = $row->fid;
if(!$fid) $fid = 1;

$now=mktime();
$now=date(Y.'.'.m.'.'.d,$now);

$query = "insert into board(bbs_id, writer, title, content, filename, visit, reg_date, fid, thread) values(";
$query = $query." 16, ";
$query = $query." '".$writer."', ";
$query = $query." '".$title."', ";
$query = $query." '".$content."', ";
$query = $query." '".$photofile_name."', ";
$query = $query." 0, ";
$query = $query." '".$now."', ";
$query = $query.$fid.", ";
$query = $query." 'A' )";

if(mysql_query($query)){
	echo"<script language=javascript>alert('��ϵǾ����ϴ�');opener.location.href='./list.php';window.close();</script>";
	exit;
}else{
	echo"<script language=javascript>alert('��Ͽ� �����߽��ϴ�. �����ڿ��� ���ǹٶ��ϴ�.');opener.location.reload();window.close();</script>";
	exit;
}
?>