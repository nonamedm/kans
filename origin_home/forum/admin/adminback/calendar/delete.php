<? 
include  "../dbconn.inc"; 

$uid=trim($uid);

/** ���� ���� ���� **/
$query = "delete from edu_calendar where uid=$uid";


mysql_query($query);
echo"<script language=javascript>opener.location.reload();window.close();</script>";
exit;

?>
