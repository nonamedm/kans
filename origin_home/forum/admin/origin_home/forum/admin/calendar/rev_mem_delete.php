<? 
include  "../dbconn.inc"; 

$uid=trim($c);
$birth=$k;
$name=$n;
$mode=$m;

$file = "rev_list.php";

if($mode==MD5(delete)){
    $query = "delete from edu_rev_member where uid=$uid and name='$name' and birth='$birth'";
    mysql_query($query);
    echo"<script language=javascript>alert('�����Ǿ����ϴ�.');opener.location.reload();location.href='./".$file."?uid=".$uid."';</script>";
    exit;
}else{
    echo"<script language=javascript>alert('�������߻��߽��ϴ�.');opener.location.reload();history.back();</script>";
    exit;
}
?>
