<? 
include  "../dbconn.inc"; 


///////////////////////////////// 등록        ///////////////


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
	echo"<script language=javascript>alert('등록되었습니다');opener.location.href='./list.php';window.close();</script>";
	exit;
}else{
	echo"<script language=javascript>alert('등록에 실패했습니다. 관리자에게 문의바랍니다.');opener.location.reload();window.close();</script>";
	exit;
}
?>