<?php
include_once('./_common.php');

// 교육일정 테이블
$program_table = $g5['write_prefix'] . substr($bo_table, 0, -2);
$program_info = sql_fetch(" SELECT * FROM ".$program_table." WHERE wr_id = '".$wr_1."' ");

// 교육의 2차 분류가 있을 경우
$ca_id = ($program_info['wr_2'])?$program_info['wr_2']:$program_info['wr_1'];

// 카운트용
$temp_cnt = 0;

// 신청 개수만큼 반복
for($i = 0; $i < count($mb_id); $i++){

	// 필수값 체크( 아이디, 이름, 주민번호, 핸드폰 번호)
	if(empty($mb_id[$i]) || empty($wr_3[$i]) || empty($wr_4_1[$i]) || empty($wr_4_2[$i]) || empty($wr_5_1[$i]) || empty($wr_5_2[$i]) || empty($wr_5_3[$i])){ continue; }
	
	// 회원정보 확인
	$mb_info = get_member($mb_id[$i]);
	if(!$mb_info['mb_id']){ $temp_cnt++; continue; } // 없는 회원일 경우 스킵

	$ca_info = get_category_info(substr($bo_table, 0, -2), $ca_id);

	// 점검
	$wr_subject_ = $wr_3[$i]."님의 ".$ca_info['ca_name']." 신청";
	$wr_subject = "";
	$wr_subject = substr(trim($wr_subject_),0,255);
	$wr_subject = preg_replace("#[\\\]+$#", "", $wr_subject);
	
	$wr_content_ = $wr_subject_;
	$wr_content = '';
	$wr_content = substr(trim($wr_content_),0,65536);
	$wr_content = preg_replace("#[\\\]+$#", "", $wr_content);

	// 090710
	if (substr_count($wr_content, '&#') > 50) {
		alert('내용에 올바르지 않은 코드가 다수 포함되어 있습니다.');
		exit;
	}

	if ($w == 'u' || $w == 'r') {
		$wr = get_write($write_table, $wr_id);
		if (!$wr['wr_id']) {
			alert("글이 존재하지 않습니다.\\n글이 삭제되었거나 이동하였을 수 있습니다.");
		}
	}

	// 외부에서 글을 등록할 수 있는 버그가 존재하므로 비밀글 무조건 사용일때는 관리자를 제외(공지)하고 무조건 비밀글로 등록
	if (!$is_admin && $board['bo_use_secret'] == 2) {
		$secret = 'secret';
	}

	if ($w == '' || $w == 'u') {

		// 김선용 1.00 : 글쓰기 권한과 수정은 별도로 처리되어야 함
		if($w =='u' && $member['mb_id'] && $wr['mb_id'] == $member['mb_id']) {
			;
		} else if ($member['mb_level'] < $board['bo_write_level']) {
			alert('글을 쓸 권한이 없습니다.');
		}

		// 외부에서 글을 등록할 수 있는 버그가 존재하므로 공지는 관리자만 등록이 가능해야 함
		if (!$is_admin && $notice) {
			alert('관리자만 공지할 수 있습니다.');
		}

	} else if ($w == 'r') {

		if (in_array((int)$wr_id, $notice_array)) {
			alert('공지에는 답변 할 수 없습니다.');
		}

		if ($member['mb_level'] < $board['bo_reply_level']) {
			alert('글을 답변할 권한이 없습니다.');
		}

		// 게시글 배열 참조
		$reply_array = &$wr;

		// 최대 답변은 테이블에 잡아놓은 wr_reply 사이즈만큼만 가능합니다.
		if (strlen($reply_array['wr_reply']) == 10) {
			alert("더 이상 답변하실 수 없습니다.\\n답변은 10단계 까지만 가능합니다.");
		}

		$reply_len = strlen($reply_array['wr_reply']) + 1;
		if ($board['bo_reply_order']) {
			$begin_reply_char = 'A';
			$end_reply_char = 'Z';
			$reply_number = +1;
			$sql = " select MAX(SUBSTRING(wr_reply, $reply_len, 1)) as reply from {$write_table} where wr_num = '{$reply_array['wr_num']}' and SUBSTRING(wr_reply, {$reply_len}, 1) <> '' ";
		} else {
			$begin_reply_char = 'Z';
			$end_reply_char = 'A';
			$reply_number = -1;
			$sql = " select MIN(SUBSTRING(wr_reply, {$reply_len}, 1)) as reply from {$write_table} where wr_num = '{$reply_array['wr_num']}' and SUBSTRING(wr_reply, {$reply_len}, 1) <> '' ";
		}
		if ($reply_array['wr_reply']) $sql .= " and wr_reply like '{$reply_array['wr_reply']}%' ";
		$row = sql_fetch($sql);

		if (!$row['reply']) {
			$reply_char = $begin_reply_char;
		} else if ($row['reply'] == $end_reply_char) { // A~Z은 26 입니다.
			alert("더 이상 답변하실 수 없습니다.\\n답변은 26개 까지만 가능합니다.");
		} else {
			$reply_char = chr(ord($row['reply']) + $reply_number);
		}

		$reply = $reply_array['wr_reply'] . $reply_char;

	} else {
		alert('w 값이 제대로 넘어오지 않았습니다.');
	}

	for($j = 1; $j <= 30; $j++){
		if($j == 1 || $j == 2 || $j == 13 || $j == 14 || $j == 15 || $j == 16 || $j == 22 || $j == 23 || $j == 24 || $j == 25 || $j == 26 || $j == 27 || $j == 28 || $j == 29 || $j == 30){ ${"wr_".$j."_val"} = ${"wr_".$j}; }
		else{ ${"wr_".$j."_val"} = ${"wr_".$j}[$i]; }

		$mb_id_val = $mb_id[$i];
		
		// 주민등록번호
		if($j == 4){ ${"wr_".$j."_val"} = ${"wr_".$j."_1"}[$i]."-".${"wr_".$j."_2"}[$i]; }

		// 핸드폰번호
		if($j == 5){ ${"wr_".$j."_val"} = ${"wr_".$j."_1"}[$i]."-".${"wr_".$j."_2"}[$i]."-".${"wr_".$j."_3"}[$i]; }

		// 이메일
		if($j == 6){ ${"wr_".$j."_val"} = ${"wr_".$j."_1"}[$i]."@".${"wr_".$j."_2"}[$i]; }
	}

	$wr_num = get_next_num($write_table);

	$sql = "INSERT INTO {$write_table} SET 
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
				mb_id = '{$mb_id_val}',
				wr_password = '$wr_password',
				wr_name = '$wr_name',
				wr_email = '$wr_email',
				wr_datetime = '".G5_TIME_YMDHIS."',
				wr_last = '".G5_TIME_YMDHIS."',
				wr_ip = '{$_SERVER['REMOTE_ADDR']}',
				wr_1 = '{$wr_1_val}',
				wr_2 = '{$wr_2_val}',
				wr_3 = '{$wr_3_val}',
				wr_4 = '{$wr_4_val}',
				wr_5 = '{$wr_5_val}',
				wr_6 = '{$wr_6_val}',
				wr_7 = '{$wr_7_val}',
				wr_8 = '{$wr_8_val}',
				wr_9 = '{$wr_9_val}',
				wr_10 = '{$wr_10_val}'";

	sql_query($sql);
	$wr_id = sql_insert_id();

	// 부모 아이디에 UPDATE
	sql_query(" update ".$write_table." set wr_parent = '$wr_id' where wr_id = '$wr_id' ");

	// 새글 INSERT
	sql_query(" insert into {$g5['board_new_table']} ( bo_table, wr_id, wr_parent, bn_datetime, mb_id ) values ( '{$bo_table}', '{$wr_id}', '{$wr_id}', '".G5_TIME_YMDHIS."', '{$member['mb_id']}' ) ");

	// 게시글 1 증가
	sql_query("update {$g5['board_table']} set bo_count_write = bo_count_write + 1 where bo_table = '{$bo_table}'");

	// DB 컬럼처리
	/* 동일한 처리 필요
	/skin/admin_board/s1_2_2_1/write_update.skin.php
	/theme/kans/mobile/skin/board/s1_2_2_1/write_update.skin.php */

	for($j = 11; $j <= 30; $j++){
		$check_query = "
		SELECT 1 FROM Information_schema.columns
		WHERE table_schema = '".G5_MYSQL_DB."' 
		AND table_name = '".$write_table."' 
		AND column_name = 'wr_".$j."'";

		if(sql_query($check_query, false)) {

			switch($j){
				case 13 : $col = "INT(11)"; break;	// 소속회원의 no
				case 15 : $col = "INT(11)"; break;	// 결제된 금액
				case 16 : $col = "INT(11)"; break;	// 결제할 금액
				case 25 : $col = "INT(11)"; break;	// 장바구니 PK
				case 26 : $col = "INT(11)"; break;	// 수료증 번호
				case 30 : $col = "INT(11)"; break;	// 소속 PK
				default : $col = "VARCHAR(255)"; 
			}

			$alter_query = "ALTER TABLE ".$write_table." ADD COLUMN wr_".$j." ".$col." NOT NULL";

			$check_query2 = "
				SELECT 1 FROM Information_schema.columns
				WHERE table_schema = '".G5_MYSQL_DB."' 
				AND table_name = '".$write_table."' 
				AND column_name = 'wr_".($j-1)."'";

			$check_result2 = sql_query($check_query2);
			$check_info2 = sql_fetch_array($check_result2);

			if($check_info2['1']) { $alter_query .= " AFTER wr_".($j-1); }

			sql_query($alter_query);
		}
	}

	$sql = "UPDATE ".$write_table." SET ";
	for($j = 11; $j < 30; $j++){
		$sql .= " wr_".$j." = '".${"wr_".$j."_val"}."', ";
	}
	$sql .= " wr_".$j." = '".${"wr_".$j."_val"}."' ";

	$sql .= " WHERE wr_id = '".$wr_id."' ";
	sql_query($sql);
	
}

delete_cache_latest($bo_table);

$msg = $board['bo_subject']." 등록 완료하였습니다.\\n\\n감사합니다.";
// 회원아이디 잘못된게 있을 경우
if($temp_cnt){ $msg .= "\\n(없는 회원계정: ".number_format($temp_cnt)." 개)"; }
alert($msg, "/cal/cal_list.php");
exit;


?>