<? 
include  "../dbconn.inc"; 


///////////////////////////////// ���        ///////////////

$writer=trim($writer);
$sdate=trim($sdate);
$edate=trim($edate);
$group_id=trim($group_id);
$area_id=trim($area_id);
$view_loc=trim($view_loc);
$title=trim($title);
$content=trim($content);

$now=mktime();
$now=date(Y.'.'.m.'.'.d,$now);

$query = "insert into edu_calendar(bbs_id, writer, sdate, edate, group_id, area_id, view_loc, title, content, visit, reg_date) values(";
$query = $query." 20, ";
$query = $query." '".$writer."', ";
$query = $query." '".$sdate."', ";
$query = $query." '".$edate."', ";
$query = $query." '".$group_id."', ";
$query = $query." '".$area_id."', ";
$query = $query." '".$view_loc."', ";
$query = $query." '".$title."', ";
$query = $query." '".$content."', ";
$query = $query." 0, ";
$query = $query." '".$now."' ) ";

if(mysql_query($query)){
	echo"<script language=javascript>alert('��ϵǾ����ϴ�');opener.location.href='./list.php';window.close();</script>";
	exit;
}else{
	echo"<script language=javascript>alert('��Ͽ� �����߽��ϴ�. �����ڿ��� ���ǹٶ��ϴ�.');opener.location.reload();window.close();</script>";
	exit;
}
?>