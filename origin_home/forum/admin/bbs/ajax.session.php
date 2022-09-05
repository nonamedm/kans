<?php
include_once('./_common.php');
// include_once(G5_LIB_PATH.'/json.lib.php');

$mode = trim($_REQUEST['mode']);

//json_encode($data);
if($mode == 'set_none_member'){ // 비회원 세션처리
	
	$bo_table = trim($_REQUEST['bo_table']);
	$wr_name = trim($_REQUEST['wr_name']);
	$wr_password = trim($_REQUEST['wr_password']);
	$wr_email = trim($_REQUEST['wr_email']);
	
	// 세션 처리
	set_session($_SERVER['SERVER_ADDR']."_name", $wr_name);
	set_session($_SERVER['SERVER_ADDR']."_email", $wr_email);
	set_session($_SERVER['SERVER_ADDR']."_password", get_encrypt_string($wr_password));
	set_session($_SERVER['SERVER_ADDR']."_check_val", 1);

	echo true;
}
?>