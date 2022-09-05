<? 
include  "../dbconn.inc"; 


///////////////////////////////// 답변        ///////////////

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
}

$writer=trim($writer);
$title=trim($title);
$content=trim($content);
$fid = $fid;
$thread = $thread;

/****** 답변 정보 셋팅 *********/
$sql="select thread,right(thread,1) from board where bbs_id=3 and fid=$fid";
$sql=$sql." and length(thread)=length('$thread')+1 and locate('$thread',thread)=1 ";
$sql=$sql." order by thread desc limit 1";

$result=mysql_query($sql);
$rs=mysql_num_rows($result);
if($rs){
	$rows=mysql_fetch_row($result);
	$thread_head=substr($rows[0],0,-1);
	$thread_foot= ++$rows[1];
	$new_thread=$thread_head.$thread_foot;
}else{
	$new_thread=$thread.'A';
}


$now=mktime();
$now=date(Y.'.'.m.'.'.d,$now);

$query = "insert into board(bbs_id, writer, title, content, filename, visit, reg_date, fid, thread) values(";
$query = $query." 3, ";
$query = $query." '".$writer."', ";
$query = $query." '".$title."', ";
$query = $query." '".$content."', ";
$query = $query." '".$boardfile_name."', ";
$query = $query." 0, ";
$query = $query." '".$now."', ";
$query = $query.$fid.", ";
$query = $query." '".$new_thread."' )";

if(mysql_query($query)){
	echo"<script language=javascript>alert('답변이 등록되었습니다');opener.location.href='./list.php';window.close();</script>";
	exit;
}else{
	echo"<script language=javascript>alert('등록에 실패했습니다. 관리자에게 문의바랍니다.');opener.location.href='./list.php';window.close();</script>";
	exit;
}
?>