<? 
include  "../dbconn.inc"; 

$rsdate=trim($rsdate);
$redate=trim($redate);
$max_user=trim($max_user);
$content=trim($content);

$now=mktime();
$now=date(Y.'.'.m.'.'.d,$now);

$sql="select * from edu_rev where uid=".$uid;
$res=mysql_query($sql);
$total=mysql_affected_rows();

if($total > 0){
	$query = "update edu_rev set rsdate='".$rsdate."', redate='".$redate."', max_user='".$max_user."', content='".$content."'";
    $query = $query." where uid=".$uid;
} else {
    $query = "insert into edu_rev(uid, rsdate, redate, max_user, content, reg_date) values(";
    $query = $query." '".$uid."', ";
    $query = $query." '".$rsdate."', ";
    $query = $query." '".$redate."', ";
    $query = $query." '".$max_user."', ";
    $query = $query." '".$content."', ";
    $query = $query." '".$now."' ) ";
}
//echo($query);
mysql_query($query);
echo"<script language=javascript>alert('저장되었습니다');opener.location.reload();window.close();</script>";
exit;

?>