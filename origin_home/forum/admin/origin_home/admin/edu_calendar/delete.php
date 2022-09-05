<? 
include  "../dbconn.inc"; 

$uid=trim($uid);

/** 이전 파일 삭제 **/
$query = "delete from edu_calendar where uid=$uid";


mysql_query($query);
echo"<script language=javascript>opener.location.reload();window.close();</script>";
exit;

?>
