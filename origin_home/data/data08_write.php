<? 
include  "../conf/dbconn.inc"; 


///////////////////////////////// ���        ///////////////

$savedir='../direct_files';

$photofile1_name = "";
if($photofile1 != ''){

	$tmpname = $_FILES['photofile1']['tmp_name'];
	$fileame = $_FILES['photofile1']['name'];

	$file_ext_arr = explode('.',$fileame);
	$extension = strtolower(end($file_ext_arr));

	if(!($extension == 'gif' || $extension == 'jpg' || $extension == 'jpeg' || $extension == 'png')){
		echo"<script language=javascript>alert('[gif,jpg,png] ���ϸ� �ø��� �ֽ��ϴ�');history.back();</script>";
		exit;
	}

	$filepath = date('Ymd') .'_'. abs(ip2long($_SERVER[REMOTE_ADDR])) .'_'. substr(md5(uniqid($server_time)), 0, 8) .'_'. str_replace('%', '', urlencode($fileame)); // ���ε����ϸ�

/*
	$exist=file_exists("$savedir/$filepath");
	if($exist){
		echo"<script language=javascript>alert(\"���� �̸��� ������ �����մϴ�. �ٸ��̸����� �÷��ּ���!\");history.back();</script>";
		exit;
	}
	*/

	if(!move_uploaded_file($tmpname, $savedir."/".$filepath)) {
		echo"<script language=javascript>alert('���Ͼ��ε忡 ���������ϴ�! ��������̴� ���߿� �÷��ּ���!');history.back();</script>";
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
		echo"<script language=javascript>alert('[gif,jpg,png] ���ϸ� �ø��� �ֽ��ϴ�');history.back();</script>";
		exit;
	}

	$filepath = date('Ymd') .'_'. abs(ip2long($_SERVER[REMOTE_ADDR])) .'_'. substr(md5(uniqid($server_time)), 0, 8) .'_'. str_replace('%', '', urlencode($fileame)); // ���ε����ϸ�

	if(!move_uploaded_file($tmpname, $savedir."/".$filepath)) {
		echo"<script language=javascript>alert('���Ͼ��ε忡 ���������ϴ�! ��������̴� ���߿� �÷��ּ���!');history.back();</script>";
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
		echo"<script language=javascript>alert('[gif,jpg,png] ���ϸ� �ø��� �ֽ��ϴ�');history.back();</script>";
		exit;
	}

	$filepath = date('Ymd') .'_'. abs(ip2long($_SERVER[REMOTE_ADDR])) .'_'. substr(md5(uniqid($server_time)), 0, 8) .'_'. str_replace('%', '', urlencode($fileame)); // ���ε����ϸ�

/*
	$exist=file_exists("$savedir/$filepath");
	if($exist){
		echo"<script language=javascript>alert(\"���� �̸��� ������ �����մϴ�. �ٸ��̸����� �÷��ּ���!\");history.back();</script>";
		exit;
	}
	*/

	if(!move_uploaded_file($tmpname, $savedir."/".$filepath)) {
		echo"<script language=javascript>alert('���Ͼ��ε忡 ���������ϴ�! ��������̴� ���߿� �÷��ּ���!');history.back();</script>";
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
	echo"<script language=javascript>alert('��ϵǾ����ϴ�');location.href='./data08.html';</script>";
	exit;
}else{
	echo"<script language=javascript>alert('��Ͽ� �����߽��ϴ�. �����ڿ��� ���ǹٶ��ϴ�.');history.back();</script>";
	exit;
}
?>