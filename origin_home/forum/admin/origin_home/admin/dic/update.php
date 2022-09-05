<? 
include  "../dbconn.inc"; 

$writer=trim($writer);
$title=trim($title);
$content=trim($content);

if($boardfile != ''){

	$savedir='../../board_files';
	if(strcmp($boardfile,'none'))	{

		$full_filename=explode('.',$boardfile_name);
		$extension=$full_filename[sizeof($full_filename)-1];

		if(!($extension == 'hwp' || $extension == 'doc' || $extension == 'gif' || $extension == 'jpg')){
			echo"<script language=javascript>alert('[hwp,doc,gif,jpg,txt] 파일만 올릴수 있습니다');history.back();</script>";
			exit;
		}

		$exist=file_exists("$savedir/$boardfile_name");
		if($exist){
			echo"<script language=javascript>alert(\"같은 이름의 파일이 존재합니다. 다른이름으로 올려주세요!\");history.back();</script>";
			exit;
		}
		if(!copy($boardfile,"$savedir/$boardfile_name")){
			echo"<script language=javascript>alert('파일업로드에 실패했읍니다! 서버장애이니 나중에 올려주세요!');history.back();</script>";
			exit;
		}
	}
	/** 이전 파일 삭제 **/
	$sql="select filename from board where uid=$uid";
	$res=mysql_query($sql);
	$row=mysql_fetch_object($res);
	if($row->filename !=''){	
		$src='../../board_files/'.$row->filename;
		if(!unlink($src))	{
			//echo"<script language=javascript>alert('전의 파일을 삭제할수가 없읍니다!');history.back();</script>";
			//exit;
		}
	}

	$query = "update board set writer='".$writer."', title='".$title."', content='".$content."', filename='".$boardfile_name."'" ;
	$query = $query." where uid=".$uid;
}else{
	$query = "update board set writer='".$writer."', title='".$title."', content='".$content."'";
	$query = $query." where uid=".$uid;
}


mysql_query($query);
echo"<script language=javascript>alert('수정되었습니다');opener.location.reload();window.close();</script>";
exit;

?>