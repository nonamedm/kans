<? 
include  "../conf/dbconn.inc"; 

if ( !($data08_uid==$uid && $data08_pw==$pw && $data08_ok=="Ok" && $type=="mo") ) {
	echo "<script language=javascript>alert(\"�������� �̿� ����� �ƴմϴ�.!\");location.href='data08.html';</script>";
}

///////////////////////////////// ���        ///////////////

$savedir='../direct_files';

$photofile1_name = "";
if($photofile1 != ''){

	// ����ȭ�� ����
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

	$query = "update board set filename='".$photofile1_name."' where uid=".$uid;
	mysql_query($query);
}

$photofile2_name = "";
if($photofile2 != ''){

	// ����ȭ�� ����
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
		echo"<script language=javascript>alert('[gif,jpg,png] ���ϸ� �ø��� �ֽ��ϴ�');history.back();</script>";
		exit;
	}

	$filepath = date('Ymd') .'_'. abs(ip2long($_SERVER[REMOTE_ADDR])) .'_'. substr(md5(uniqid($server_time)), 0, 8) .'_'. str_replace('%', '', urlencode($fileame)); // ���ε����ϸ�

	if(!move_uploaded_file($tmpname, $savedir."/".$filepath)) {
		echo"<script language=javascript>alert('���Ͼ��ε忡 ���������ϴ�! ��������̴� ���߿� �÷��ּ���!');history.back();</script>";
		exit;
	}
	
	$photofile2_name = $filepath;

	$query = "update board set filename2='".$photofile2_name."' where uid=".$uid;
	mysql_query($query);
}

$photofile3_name = "";
if($photofile3 != ''){

	// ����ȭ�� ����
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

	$query = "update board set filename3='".$photofile3_name."' where uid=".$uid;
	mysql_query($query);
}

$writer=trim($writer);
$title=trim($title);
$content=trim($content);

$query = "update board set writer='".$writer."', title='".$title."', content='".$content."' where uid=".$uid;

if(mysql_query($query)){
	echo"<script language=javascript>alert('��ϵǾ����ϴ�');location.href='./data08.html';</script>";
}else{
	echo"<script language=javascript>alert('��Ͽ� �����߽��ϴ�. �����ڿ��� ���ǹٶ��ϴ�.');history.back();</script>";
}

include "../conf/dbconn_close.inc";
?>