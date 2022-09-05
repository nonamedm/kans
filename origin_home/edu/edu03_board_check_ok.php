<? 
ob_start();

include  "../conf/dbconn.inc"; 

$pw=trim($pw);
$uid=trim($uid);
$search=trim($search);
$keyword=trim($keyword);

$sql="select * from board where uid=$uid and passwd=$pw";
$res=mysql_query($sql);
$total=mysql_affected_rows();

if($total<1)
{
?>
<script language=javascript>
	alert('비밀번호가 정확하지 않습니다.');
//	parent.checkFrm.pw.value='';
	history.back();
</script>
<?
} else {
	setcookie("comedu_uid", $uid,time()+600,"/");
	setcookie("comedu_ok", $pw,time()+600,"/");
}

include "../conf/dbconn_close.inc";
?>

<script language=javascript>location.href="edu03_board_view.html?uid=<?=$uid?>&amp;page=<?=$page?>&amp;search=<?=$search?>&amp;keyword=<?=$keyword?>";</script>
