<? 
include  "../dbconn.inc"; 

$writer=trim($writer);
$sdate=trim($sdate);
$edate=trim($edate);
$group_id=trim($group_id);
$area_id=trim($area_id);
$view_loc=trim($view_loc);
$title=trim($title);
$content=trim($content);

$query = "update edu_calendar set writer='".$writer."', sdate='".$sdate."', edate='".$edate."', group_id='".$group_id."', area_id='".$area_id."', view_loc='".$view_loc."', title='".$title."', content='".$content."'";
$query = $query." where uid=".$uid;


mysql_query($query);
echo"<script language=javascript>alert('수정되었습니다');opener.location.reload();window.close();</script>";
exit;

?>