<? 
include  "../conf/dbconn.inc"; 

if ( !($data08_uid==$uid && $data08_pw==$pw && $data08_ok=="Ok" && $type=="mo") ) {
	echo "<script language=javascript>alert(\"정상적인 이용 방법이 아닙니다.!\");location.href='data08.html';</script>";
}

///////////////////////////////// 등록        ///////////////

$savedir='../direct_files';

$photofile1_name = "";
if($photofile1 != ''){

	// 이전화일 삭제
	$sql="select filename from board where uid=$uid";
	$res=mysql_query($sql);
	$row=mysql_fetch_object($res);

	if($row->filename !=''){	
		$src='../direct_files/'.$row->filename;
		if(!unlink($src))	{
		}
	}

	$tmpname = $_FILES['photofile1']['tmp_name'];
	$fileame = $_FILES['photofile1']['name'];

	$file_ext_arr = explode('.',$fileame);
	$extension = strtolower(end($file_ext_arr));

	if(!($extension == 'gif' || $extension == 'jpg' || $extension == 'jpeg' || $extension == 'png')){
		echo"<script language=javascript>alert('[gif,jpg,png] 파일만 올릴수 있습니다');history.back();</script>";
		exit;
	}

	$filepath = date('Ymd') .'_'. abs(ip2long($_SERVER[REMOTE_ADDR])) .'_'. substr(md5(uniqid($server_time)), 0, 8) .'_'. str_replace('%', '', urlencode($fileame)); // 업로드파일명

/*
	$exist=file_exists("$savedir/$filepath");
	if($exist){
		echo"<script language=javascript>alert(\"같은 이름의 파일이 존재합니다. 다른이름으로 올려주세요!\");history.back();</script>";
		exit;
	}
	*/

	if(!move_uploaded_file($tmpname, $savedir."/".$filepath)) {
		echo"<script language=javascript>alert('파일업로드에 실패했읍니다! 서버장애이니 나중에 올려주세요!');history.back();</script>";
		exit;
	}
	
	$photofile1_name = $filepath;

	$query = "update board set filename='".$photofile1_name."' where uid=".$uid;
	mysql_query($query);
}

$photofile2_name = "";
if($photofile2 != ''){

	// 이전화일 삭제
	$sql="select filename2 from board where uid=$uid";
	$res=mysql_query($sql);
	$row=mysql_fetch_object($res);

	if($row->filename2 !=''){	
		$src='../direct_files/'.$row->filename2;
		if(!unlink($src))	{
		}
	}

	$tmpname = $_FILES['photofile2']['tmp_name'];
	$fileame = $_FILES['photofile2']['name'];

	$file_ext_arr = explode('.',$fileame);
	$extension = strtolower(end($file_ext_arr));

	if(!($extension == 'gif' || $extension == 'jpg' || $extension == 'jpeg' || $extension == 'png')){
		echo"<script language=javascript>alert('[gif,jpg,png] 파일만 올릴수 있습니다');history.back();</script>";
		exit;
	}

	$filepath = date('Ymd') .'_'. abs(ip2long($_SERVER[REMOTE_ADDR])) .'_'. substr(md5(uniqid($server_time)), 0, 8) .'_'. str_replace('%', '', urlencode($fileame)); // 업로드파일명

	if(!move_uploaded_file($tmpname, $savedir."/".$filepath)) {
		echo"<script language=javascript>alert('파일업로드에 실패했읍니다! 서버장애이니 나중에 올려주세요!');history.back();</script>";
		exit;
	}
	
	$photofile2_name = $filepath;

	$query = "update board set filename2='".$photofile2_name."' where uid=".$uid;
	mysql_query($query);
}

$photofile3_name = "";
if($photofile3 != ''){

	// 이전화일 삭제
	$sql="select filename3 from board where uid=$uid";
	$res=mysql_query($sql);
	$row=mysql_fetch_object($res);

	if($row->filename3 !=''){	
		$src='../direct_files/'.$row->filename3;
		if(!unlink($src))	{
		}
	}

	$tmpname = $_FILES['photofile3']['tmp_name'];
	$fileame = $_FILES['photofile3']['name'];

	$file_ext_arr = explode('.',$fileame);
	$extension = strtolower(end($file_ext_arr));

	if(!($extension == 'gif' || $extension == 'jpg' || $extension == 'jpeg' || $extension == 'png')){
		echo"<script language=javascript>alert('[gif,jpg,png] 파일만 올릴수 있습니다');history.back();</script>";
		exit;
	}

	$filepath = date('Ymd') .'_'. abs(ip2long($_SERVER[REMOTE_ADDR])) .'_'. substr(md5(uniqid($server_time)), 0, 8) .'_'. str_replace('%', '', urlencode($fileame)); // 업로드파일명

/*
	$exist=file_exists("$savedir/$filepath");
	if($exist){
		echo"<script language=javascript>alert(\"같은 이름의 파일이 존재합니다. 다른이름으로 올려주세요!\");history.back();</script>";
		exit;
	}
	*/

	if(!move_uploaded_file($tmpname, $savedir."/".$filepath)) {
		echo"<script language=javascript>alert('파일업로드에 실패했읍니다! 서버장애이니 나중에 올려주세요!');history.back();</script>";
		exit;
	}
	
	$photofile3_name = $filepath;

	$query = "update board set filename3='".$photofile3_name."' where uid=".$uid;
	mysql_query($query);
}

$writer=trim($writer);
$title=trim($title);
$content=trim($content);

$query = "update board set writer='".$writer."', title='".$title."', content='".$content."' where uid=".$uid;

if(mysql_query($query)){
	echo"<script language=javascript>alert('등록되었습니다');location.href='./data08.html';</script>";
}else{
	echo"<script language=javascript>alert('등록에 실패했습니다. 관리자에게 문의바랍니다.');history.back();</script>";
}

include "../conf/dbconn_close.inc";
?>