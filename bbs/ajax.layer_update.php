<?php
include_once('./_common.php');

$bo_table = trim($_REQUEST['bo_table']);
$wr_name = trim($_REQUEST['wr_name']);
$wr_password = trim($_REQUEST['wr_password']);

$wr_1 = trim($_REQUEST['wr_1']);
$wr_2 = trim($_REQUEST['wr_2']);
$wr_3 = trim($_REQUEST['wr_3']);

$wr_email = trim($_REQUEST['wr_email']);

$mb_check = trim($_REQUEST['mb_check']);

$text = "";

$temp_wr_3 = explode("-", $wr_3);
$temp_wr_email = explode("@", $wr_email);

if(empty($bo_table)){ $text .= "입력값이 "; }
if(empty($wr_name)){ $text .= "[이름] "; }
if(empty($wr_password)){ $text .= "[패스워드] "; }
if(empty($wr_1)){ $text .= "[프로그램 정보] "; }
if(empty($wr_2)){ $text .= "[회사명] "; }
if(empty($temp_wr_3[0]) || empty($temp_wr_3[1]) || empty($temp_wr_3[2])){ $text .= "[연락처] "; }
if(empty($temp_wr_email[0]) || empty($temp_wr_email[1])){ $text .= "[이메일] "; }

if(!empty($text)){ $text .= "입력되지 않았습니다."; }

if ($bo_table && $wr_name && $wr_password && $wr_1 && $wr_2 && $wr_3 && $wr_email) {

	if($mb_check){ // 회원일 경우 처리
		$mb_id = $member['mb_id'];
		$wr_password = $member['mb_password'];
		$wr_name = $member['mb_name'];
		$wr_email = $member['mb_email'];
		$wr_2 = $member['mb_3'];
		$wr_3 = $member['mb_hp'];
	}
	else{ $mb_id = ""; $wr_password = get_encrypt_string($wr_password); }
	
	$tmp_write_table = $g5['write_prefix'] . $bo_table; // 게시판 테이블 전체이름
	$sql = "SELECT COUNT(*) AS CNT FROM {$tmp_write_table} WHERE wr_name = '{$wr_name}' AND wr_1 = '{$wr_1}' AND wr_3 = '{$wr_3}'"; // 중복 검사용(이름, 연락처, 프로그램 정보)
	$row = sql_fetch($sql);
    if (!$row['CNT']) {

		// 프로그램 정보
		$tmp_program_table = $g5['write_prefix'] . substr($bo_table, 0, -2);
		$program_info = sql_fetch("SELECT * FROM {$tmp_program_table} WHERE wr_id = '{$wr_1}'");

		$wr_num = get_next_num($tmp_write_table);
        $wr_reply = '';

		$wr_subject = $wr_name."님 참가신청";
		$wr_content = $program_info['wr_subject'];
		$wr_4 = $program_info['wr_1'];
		$wr_5 = $program_info['wr_5'];

		$ca_name = "신청완료";

		$sql = "INSERT INTO {$tmp_write_table} SET 
					wr_num = '$wr_num',
					ca_name = '$ca_name',
					wr_reply = '$wr_reply',
					wr_subject = '{$wr_subject}',
					wr_content = '{$wr_content}',
					wr_comment = 0,
					wr_link1_hit = 0,
					wr_link2_hit = 0,
					wr_hit = 0,
					wr_good = 0,
					wr_nogood = 0,
					mb_id = '$mb_id',
					wr_password = '$wr_password',
					wr_name = '$wr_name',
					wr_email = '$wr_email',
					wr_datetime = '".G5_TIME_YMDHIS."',
					wr_last = '".G5_TIME_YMDHIS."',
					wr_ip = '{$_SERVER['REMOTE_ADDR']}',
					wr_1 = '{$wr_1}',
					wr_2 = '{$wr_2}',
					wr_3 = '{$wr_3}',
					wr_4 = '{$wr_4}',
					wr_5 = '{$wr_5}'";
		sql_fetch($sql);

		$wr_id = sql_insert_id();

		// 부모 아이디에 UPDATE
		sql_query(" update $tmp_write_table set wr_parent = '$wr_id' where wr_id = '$wr_id' ");

		// 새글 INSERT
		sql_query(" insert into {$g5['board_new_table']} ( bo_table, wr_id, wr_parent, bn_datetime, mb_id ) values ( '{$bo_table}', '{$wr_id}', '{$wr_id}', '".G5_TIME_YMDHIS."', '{$member['mb_id']}' ) ");

		// 게시글 1 증가
		sql_query("update {$g5['board_table']} set bo_count_write = bo_count_write + 1 where bo_table = '{$bo_table}'");

		$text = "참가 신청이\n성공적으로 신청되셨습니다.";
	}
	else{ $text = "이미 신청하셨습니다"; }
}

echo $text;
?>