<? 
include  "../conf/dbconn.inc"; 


///////////////////////////////// 등록        ///////////////

$savedir='../direct_files';

$photofile1_name = "";
if($photofile1 != ''){

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
}

$photofile2_name = "";
if($photofile2 != ''){

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
}

$photofile3_name = "";
if($photofile3 != ''){

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
}

$writer=trim($writer);
$pass_1=trim($pass_1);
$title=trim($title);
$content=trim($content);

$sql = "select max(fid)+1 as fid from board where bbs_id=21"; 
$result=mysql_query($sql);
$row= mysql_fetch_object($result);
$fid = $row->fid;
if(!$fid) $fid = 1;

$now=mktime();
$now=date(Y.'.'.m.'.'.d,$now);

$query = "insert into board(bbs_id, writer, passwd, title, content, filename, filename2, filename3, visit, reg_date, fid, thread) values(";
$query = $query." 21, ";
$query = $query." '".$writer."', ";
$query = $query." '".$pass_1."', ";
$query = $query." '".$title."', ";
$query = $query." '".$content."', ";
$query = $query." '".$photofile1_name."', ";
$query = $query." '".$photofile2_name."', ";
$query = $query." '".$photofile3_name."', ";
$query = $query." 0, ";
$query = $query." '".$now."', ";
$query = $query.$fid.", ";
$query = $query." 'A' )";

if(mysql_query($query)){
	echo"<script language=javascript>alert('등록되었습니다');location.href='./data08.html';</script>";
	exit;
}else{
	echo"<script language=javascript>alert('등록에 실패했습니다. 관리자에게 문의바랍니다.');history.back();</script>";
	exit;
}
?>