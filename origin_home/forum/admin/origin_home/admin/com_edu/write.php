<? 
include  "../dbconn.inc"; 


///////////////////////////////// ���        ///////////////


$writer=trim($writer);
$passwd=trim($passwd);
$title=trim($title);
$content=trim($content);

$now=mktime();
$now=date(Y.'.'.m.'.'.d,$now);

$query = "insert into board(bbs_id, writer, passwd, title, content, visit, reg_date) values(";
$query = $query." 19, ";
$query = $query." '".$writer."', ";
$query = $query." '".$passwd."', ";
$query = $query." '".$title."', ";
$query = $query." '".$content."', ";
$query = $query." 0, ";
$query = $query." '".$now."' )";

if(mysql_query($query)){
	echo"<script language=javascript>alert('��ϵǾ����ϴ�');opener.location.href='./list.php';window.close();</script>";
	exit;
}else{
	echo"<script language=javascript>alert('��Ͽ� �����߽��ϴ�. �����ڿ��� ���ǹٶ��ϴ�.');opener.location.reload();window.close();</script>";
	exit;
}
?>