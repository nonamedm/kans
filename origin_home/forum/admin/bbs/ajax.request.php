<?php
include_once('./_common.php');

$bo_table = trim($_REQUEST['bo_table']);
$wr_id = trim($_REQUEST['wr_id']);

$text = "";

if(empty($bo_table) || empty($wr_id)){ $text .= "입력값이 "; }

if(!empty($text)){ $text .= "입력되지 않았습니다."; }

if ($bo_table && $wr_id) {

	$tmp_write_table = $g5['write_prefix'] . $bo_table; // 게시판 테이블 전체이름
	$sql = "SELECT COUNT(*) AS CNT FROM {$tmp_write_table} WHERE wr_id = '".$wr_id."' AND wr_6 != '' "; // 중복 검사용(PK값, 영수증 신청 상태)
	$row = sql_fetch($sql);
    if (!$row['CNT']) {
		$sql = "UPDATE {$tmp_write_table} SET 
						wr_6 = '신청완료'
				WHERE wr_id = '".$wr_id."'";
		sql_fetch($sql);

		$text = "신청완료 되었습니다.\n영수증은 관리자가 입금내역을 확인한 후 발급됩니다.";

	}
	else{ $text = "이미 신청하셨습니다.\n영수증은 관리자가 입금내역을 확인한 후 발급됩니다."; }
}

echo $text;
?>