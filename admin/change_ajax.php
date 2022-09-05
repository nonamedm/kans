<?php include("./_common.php");

if($bo == 's1_4'){ // =============== 커스터 마이징[다올정밀] ===============
	$tmp_write_table = $g5['write_prefix'] . $bo; // 게시판 테이블 전체이름
	sql_query("UPDATE ".$tmp_write_table." SET ".$fild."='".$val."' WHERE wr_id='".$id."'");
}
sql_query("update $table set $fild='$val' where idx='$idx'");
if($val=="승인"){
	$row=sql_fetch("select * from $table where idx='$idx'");
	include_once(G5_LIB_PATH.'/mailer.lib.php');
	
	
	ob_start();
	include_once ('./mailform1.php');
	$content = ob_get_contents();
	ob_end_clean();
	$subject="[ $row[wr_subject] ] 교육 승인처리 되었습니다. ";
	$admin=get_member("admin");
	mailer($admin[mb_name], $admin[mb_email], $row[wr_5], $subject, $content, 1);
}
?>