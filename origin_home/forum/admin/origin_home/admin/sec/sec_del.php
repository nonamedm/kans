<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>
<? 
if(!$cid){
	echo"<script language=javascript>window.close();</script>";
	exit;
}
include  "../dbconn.inc"; 

$page=trim($page);

$query = "delete from sec_code where uid='".$page."'";

if(mysql_query($query)){
	echo"<script language=javascript>alert('삭제되었습니다');opener.location.href='./list.php';window.close();</script>";
	exit;
}else{
	echo"<script language=javascript>alert('삭제에 실패했습니다. 관리자에게 문의바랍니다.');history.back();</script>";
	exit;
}

?>