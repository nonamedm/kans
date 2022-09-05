<?php

// 오리지널 테이블 정보
$temp_table = $bo_table;
$temp_board = $board;
$temp_write_table = $write_table;
$temp_write = $write;

// 새 테이블 정보(=신청자 정보)
$bo_table = $bo_table."_1";
$board = sql_fetch(" select * from {$g5['board_table']} where bo_table = '$bo_table' ");
$write_table = $g5['write_prefix'] . $bo_table;

// 수 리셋 처리
$count_write = 0;
$count_comment = 0;

$sub_sql = " SELECT * FROM ".$write_table." WHERE wr_1 = '".$write['wr_id']."' ";
$sub_result = sql_query($sub_sql);
while ($sub_row = sql_fetch_array($sub_result))
{
	$write = sql_fetch(" select * from $write_table where wr_id = '".$sub_row['wr_id']."' ");

	$len = strlen($write['wr_reply']);
	if ($len < 0) $len = 0;
	$reply = substr($write['wr_reply'], 0, $len);

	// 원글만 구한다.
	$sql = " select count(*) as cnt from $write_table
				where wr_reply like '$reply%'
				and wr_id <> '{$write['wr_id']}'
				and wr_num = '{$write['wr_num']}'
				and wr_is_comment = 0 ";
	$row = sql_fetch($sql);
	if ($row['cnt'] && !$is_admin)
		alert('이 글과 관련된 답변글이 존재하므로 삭제 할 수 없습니다.\\n\\n우선 답변글부터 삭제하여 주십시오.');

	// 코멘트 달린 원글의 삭제 여부
	$sql = " select count(*) as cnt from $write_table
				where wr_parent = '$wr_id'
				and mb_id <> '{$member['mb_id']}'
				and wr_is_comment = 1 ";
	$row = sql_fetch($sql);
	if ($row['cnt'] >= $board['bo_count_delete'] && !$is_admin)
		alert('이 글과 관련된 코멘트가 존재하므로 삭제 할 수 없습니다.\\n\\n코멘트가 '.$board['bo_count_delete'].'건 이상 달린 원글은 삭제할 수 없습니다.');


	// 나라오름님 수정 : 원글과 코멘트수가 정상적으로 업데이트 되지 않는 오류를 잡아 주셨습니다.
	//$sql = " select wr_id, mb_id, wr_comment from $write_table where wr_parent = '$write[wr_id]' order by wr_id ";
	$sql = " select wr_id, mb_id, wr_is_comment, wr_content from $write_table where wr_parent = '{$write['wr_id']}' order by wr_id ";
	$result = sql_query($sql);
	while ($row = sql_fetch_array($result))
	{
		// 원글이라면
		if (!$row['wr_is_comment'])
		{
			// 원글 포인트 삭제
			if (!delete_point($row['mb_id'], $bo_table, $row['wr_id'], '쓰기'))
				insert_point($row['mb_id'], $board['bo_write_point'] * (-1), "{$board['bo_subject']} {$row['wr_id']} 글삭제");

			// 업로드된 파일이 있다면 파일삭제
			$sql2 = " select * from {$g5['board_file_table']} where bo_table = '$bo_table' and wr_id = '{$row['wr_id']}' ";
			$result2 = sql_query($sql2);
			while ($row2 = sql_fetch_array($result2)) {
				@unlink(G5_DATA_PATH.'/file/'.$bo_table.'/'.$row2['bf_file']);
				// 썸네일삭제
				if(preg_match("/\.({$config['cf_image_extension']})$/i", $row2['bf_file'])) {
					delete_board_thumbnail($bo_table, $row2['bf_file']);
				}
			}

			// 에디터 썸네일 삭제
			delete_editor_thumbnail($row['wr_content']);

			// 파일테이블 행 삭제
			sql_query(" delete from {$g5['board_file_table']} where bo_table = '$bo_table' and wr_id = '{$row['wr_id']}' ");

			$count_write++;
		}
		else
		{
			// 코멘트 포인트 삭제
			if (!delete_point($row['mb_id'], $bo_table, $row['wr_id'], '댓글'))
				insert_point($row['mb_id'], $board['bo_comment_point'] * (-1), "{$board['bo_subject']} {$write['wr_id']}-{$row['wr_id']} 댓글삭제");

			$count_comment++;
		}
	}

	// 게시글 삭제
	sql_query(" delete from $write_table where wr_parent = '{$write['wr_id']}' ");

	// 최근게시물 삭제
	sql_query(" delete from {$g5['board_new_table']} where bo_table = '$bo_table' and wr_parent = '{$write['wr_id']}' ");

	// 스크랩 삭제
	sql_query(" delete from {$g5['scrap_table']} where bo_table = '$bo_table' and wr_id = '{$write['wr_id']}' ");

	/*
	// 공지사항 삭제
	$notice_array = explode("\n", trim($board['bo_notice']));
	$bo_notice = "";
	for ($k=0; $k<count($notice_array); $k++)
		if ((int)$write[wr_id] != (int)$notice_array[$k])
			$bo_notice .= $notice_array[$k] . "\n";
	$bo_notice = trim($bo_notice);
	*/

	$bo_notice = board_notice($board['bo_notice'], $write['wr_id']);
	sql_query(" update {$g5['board_table']} set bo_notice = '$bo_notice' where bo_table = '$bo_table' ");

	// 글숫자 감소
	/* if ($count_write > 0 || $count_comment > 0)
		sql_query(" update {$g5['board_table']} set bo_count_write = bo_count_write - '$count_write', bo_count_comment = bo_count_comment - '$count_comment' where bo_table = '$bo_table' "); */

	// 게시판 원 글 수, 코멘트 수
	$CNT_INFO = sql_fetch("SELECT COUNT(wr_id) CNT FROM ".$write_table." WHERE wr_is_comment = '0'");
	$CNT_COM_INFO = sql_fetch("SELECT COUNT(wr_id) CNT FROM ".$write_table." WHERE wr_is_comment = '1'");

	// 업테이트
	$UPDATE_QUERY = "UPDATE ".$g5['board_table']." SET bo_count_write = '".$CNT_INFO['CNT']."', bo_count_comment = '".$CNT_COM_INFO['CNT']."' WHERE bo_table = '".$bo_table."'";
	sql_query($UPDATE_QUERY);

}

delete_cache_latest($bo_table);

// 테이블 정보 돌리기
$bo_table = $temp_table;
$board = $temp_board;
$write_table = $temp_write_table;
$write = $temp_write;

?>