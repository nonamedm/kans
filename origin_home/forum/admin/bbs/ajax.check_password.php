<?php
include_once('./_common.php');
include_once(G5_LIB_PATH.'/json.lib.php');

$password = $_REQUEST['password'];

$data['result'] = true;
$data['text'] = "비밀번호가 일치합니다.\n게시판으로 이동합니다.";

$bo_table = 'password';
$board = sql_fetch(" select * from {$g5['board_table']} where bo_table = '$bo_table' ");
$write_table = $g5['write_prefix'] . $bo_table; // 게시판 테이블 전체이름

// 현재 날짜의 비밀번호가 있는지 확인
$query = "SELECT COUNT(wr_id) CNT FROM ".$write_table." WHERE wr_content = '".number_format(date('d'))."'";
$cnt_info = sql_fetch($query);

// 해당 날짜의 비밀번호가 있을 경우
if($cnt_info['CNT']){

	if (!$sst) {
		if ($board['bo_sort_field']) {
			$sst = $board['bo_sort_field'];
		} else {
			$sst  = "wr_num, wr_reply";
			$sod = "";
		}
	} else {
		// 게시물 리스트의 정렬 대상 필드가 아니라면 공백으로 (nasca 님 09.06.16)
		// 리스트에서 다른 필드로 정렬을 하려면 아래의 코드에 해당 필드를 추가하세요.
		// $sst = preg_match("/^(wr_subject|wr_datetime|wr_hit|wr_good|wr_nogood)$/i", $sst) ? $sst : "";
		$sst = preg_match("/^(wr_datetime|wr_hit|wr_good|wr_nogood)$/i", $sst) ? $sst : "";
	}

	if(!$sst)
		$sst  = "wr_num, wr_reply";

	if ($sst) {
		$sql_order = " order by {$sst} {$sod} ";
	}

	// 현재 날짜의 비밀번호 가져오기
	$query = "SELECT wr_subject FROM ".$write_table." WHERE wr_content = '".number_format(date('d'))."' ".$sql_order." LIMIT 1";
	$board_info = sql_fetch($query);
	
	// 비밀번호 체크
	if($board_info['wr_subject'] != $password){
		$data['result'] = false;
		$data['text'] = "입력하신 비밀번호가 틀렸습니다.";
	}else{ set_session($_SERVER['SERVER_ADDR']."_check_val", 1); }
}else{
	$data['result'] = false;
	$data['text'] = "입력하신 비밀번호가 틀렸습니다.";
}

echo json_encode($data);
?>