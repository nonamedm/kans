<? 
include  "../dbconn.inc"; 


///////////////////////////////// 등록        ///////////////

if($boardfile != ''){

	$savedir='./forum_files';
	if(strcmp($boardfile,'none'))	{

		$full_filename=explode('.',$boardfile_name);
		$extension=$full_filename[sizeof($full_filename)-1];

		if(!($extension == 'hwp' || $extension == 'doc' || $extension == 'gif' || $extension == 'jpg' || $extension == 'ppt' || $extension == 'xls' || $extension == 'pdf' || $extension == 'zip')){
			echo"<script language=javascript>alert('[hwp,doc,gif,jpg,txt] 파일만 올릴수 있습니다');history.back();</script>";
			exit;
		}

		$exist=file_exists("$savedir/$boardfile_name");
		if($exist){
			echo"<script language=javascript>alert(\"같은 이름의 파일이 존재합니다. 다른이름으로 올려주세요!\");history.back();</script>";
			exit;
		}
		if(!copy($boardfile,"$savedir/$boardfile_name")){
			echo"<script language=javascript>alert('파일업로드에 실패했습니다! 서버장애이니 나중에 올려주세요!');history.back();</script>";
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
	echo"<script language=javascript>alert('등록되었습니다');opener.location.href='./list.php';window.close();</script>";
	exit;
}else{
	echo"<script language=javascript>alert('등록에 실패했습니다. 관리자에게 문의바랍니다.');opener.location.reload();window.close();</script>";
	exit;
}
?>