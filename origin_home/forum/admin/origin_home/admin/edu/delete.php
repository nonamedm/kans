<? 
if(!$cid){
	echo"<script language=javascript>window.close();</script>";
	exit;
}
include  "../dbconn.inc"; 
if($_head_php_excuted) return;
if(eregi(":\/\/",$dir)) $dir=".";

$id=trim($id);
$query = "delete from edu_member where mem_id='".$id."'";


if(mysql_query($query)){
	echo"<script language=javascript>alert('�����Ǿ����ϴ�');location.href='./list.php';</script>";
	exit;
}else{
	echo"<script language=javascript>alert('������ �����߽��ϴ�. �����ڿ��� ���ǹٶ��ϴ�.');location.href='./list.php';</script>";
	exit;
}

?>
