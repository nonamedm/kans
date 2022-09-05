<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
// 회원 등급에 따른 중복신청 방지
if($member["mb_level"] < 3){
	// 현재 교육의 신청내역이 있는지 확인
	$overlap_check = sql_fetch(" SELECT COUNT(wr_id) CNT FROM {$write_table} WHERE wr_1 = '{$wr_1}' AND mb_id = '{$member['mb_id']}' ");
	if($overlap_check["CNT"]){ alert("이미 신청하신 교육입니다.", "/cal/cal_list.php"); exit; }
}

?>