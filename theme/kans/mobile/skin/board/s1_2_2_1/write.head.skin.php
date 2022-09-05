<?php
	if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

	// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
	add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

	// if($ca_nm){ $ca_name = $ca_nm; }
	// if(empty($wr_1) || empty($ca_name)){ alert("올바른 접근이 아닙니다.", "/cal/cal_list.php"); exit; }
	if(empty($wr_1)){ alert("올바른 접근이 아닙니다.", "/cal/cal_list.php"); exit; }

	// 교육일정 정보
	$tmp_write_table = $g5['write_prefix'] . substr($bo_table, 0, -2);
	$program_info = sql_fetch(" SELECT * FROM ".$tmp_write_table." WHERE wr_id = '".$wr_1."' ");

	// 회원 등급에 따른 중복신청 방지
	if($member["mb_level"] < 3){
		// 현재 교육의 신청내역이 있는지 확인
		$overlap_check = sql_fetch(" SELECT COUNT(wr_id) CNT FROM {$write_table} WHERE wr_1 = '{$wr_1}' AND mb_id = '{$member['mb_id']}' ");
		if($overlap_check["CNT"]){ alert("이미 신청하신 교육입니다.", "/cal/cal_list.php"); exit; }
	}
	
	// 회원일 경우 정보 연동
	if($is_member && $w == ""){

		$write['wr_2'] = $member["mb_2"]; // 기관명
		$write['wr_3'] = $member["mb_name"]; // 이름
		$write['wr_4'] = $member['mb_3']."-".$member['mb_4']; // 생년월일
		$write['wr_5'] = $member["mb_hp"]; // 핸드폰 번호
		$write['wr_6'] = $member["mb_email"]; // 이메일
		$write['wr_7'] = $member["mb_5"]; // 방사선면허번호
		
		$write['wr_11'] = $member["mb_2"]; // 소속
	}
?>