<? 
if(!$cid){
	echo"<script language=javascript>window.close();</script>";
	exit;
}
include  "../dbconn.inc"; 
if($_head_php_excuted) return;
if(!eregi($HTTP_HOST,$HTTP_REFERER)) Error("���������� �����Ͽ� �ֽñ� �ٶ��ϴ�.");
if(eregi(":\/\/",$dir)) $dir=".";

$id=trim($id);
$mem_id=trim($mid);
$search=$search;
$keyword=$keyword;

$query = "delete from edu_member_comp_day where id='".$id."'";

if(mysql_query($query)){
	echo"<script language=javascript>alert('�����Ǿ����ϴ�');location.href='./view.php?id=".$mem_id."&page=".$page."&search=".$search."&keyword=".$keyword."'</script>";
	exit;
}else{
	echo"<script language=javascript>alert('������ �����߽��ϴ�. �����ڿ��� ���ǹٶ��ϴ�.');history.back();</script>";
	exit;
}

?>
