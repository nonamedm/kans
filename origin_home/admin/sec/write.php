<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<? 
include  "../dbconn.inc"; 


///////////////////////////////// ���        ///////////////

if($boardfile != ''){

	$savedir='../../board_files';
	if(strcmp($boardfile,'none'))	{

		$full_filename=explode('.',$boardfile_name);
		$extension=$full_filename[sizeof($full_filename)-1];

		if(!($extension == 'hwp' || $extension == 'doc' || $extension == 'gif' || $extension == 'jpg' || $extension == 'ppt' || $extension == 'pdf' || $extension == 'zip')){
			echo"<script language=javascript>alert('[hwp,ppt,pdf,doc,gif,jpg,txt] ���ϸ� �ø��� �ֽ��ϴ�');history.back();</script>";
			exit;
		}

		$exist=file_exists("$savedir/$boardfile_name");
		if($exist){
			echo"<script language=javascript>alert(\"���� �̸��� ������ �����մϴ�. �ٸ��̸����� �÷��ּ���!\");history.back();</script>";
			exit;
		}
		if(!copy($boardfile,"$savedir/$boardfile_name")){
			echo"<script language=javascript>alert('���Ͼ��ε忡 ���������ϴ�! ��������̴� ���߿� �÷��ּ���!');history.back();</script>";
			exit;
		}
	}
}

$writer=trim($writer);
$sec_code=trim($sec_code);
$sec_chk=trim($sec_chk);
$title=trim($title);
$content=trim($content);

$sql = "select max(fid)+1 as fid from sec_board where bbs_id=1"; 
$result=mysql_query($sql);
$row= mysql_fetch_object($result);
$fid = $row->fid;
if(!$fid) $fid = 1;

$now=mktime();
$now=date(Y.'.'.m.'.'.d,$now);

$query = "insert into sec_board(bbs_id, writer, sec_code, sec, sec_chk, title, content, filename, visit, reg_date, fid, thread) values(";
$query = $query." 1, ";
$query = $query." '".$writer."', ";
$query = $query." '".$sec_code."', ";
$query = $query." '".MD5($sec_code)."', ";
$query = $query." '".$sec_chk."', ";
$query = $query." '".$title."', ";
$query = $query." '".$content."', ";
$query = $query." '".$boardfile_name."', ";
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