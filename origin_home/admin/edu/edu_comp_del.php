<? 
if(!$cid){
	echo"<script language=javascript>window.close();</script>";
	exit;
}
include  "../dbconn.inc"; 
if($_head_php_excuted) return;
if(!eregi($HTTP_HOST,$HTTP_REFERER)) Error("정상적으로 접근하여 주시기 바랍니다.");
if(eregi(":\/\/",$dir)) $dir=".";

$id=trim($id);
$mem_id=trim($mid);
$search=$search;
$keyword=$keyword;

$query = "delete from edu_member_comp_day where id='".$id."'";

if(mysql_query($query)){
	echo"<script language=javascript>alert('삭제되었습니다');location.href='./view.php?id=".$mem_id."&page=".$page."&search=".$search."&keyword=".$keyword."'</script>";
	exit;
}else{
	echo"<script language=javascript>alert('삭제에 실패했습니다. 관리자에게 문의바랍니다.');history.back();</script>";
	exit;
}

?>
