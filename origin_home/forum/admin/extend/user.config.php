<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

/**
 * console.log로 메시지 출력
 * @param $data
 */
function debug ($data) {
    echo "<script>\r\n//<![CDATA[\r\nif(!console){var console={log:function(){}}}";
    $output    =    explode("\n", print_r($data, true));
    foreach ($output as $line) {
        if (trim($line)) {
            $line    =    addslashes($line);
            echo "console.log(\"{$line}\");";
        }
    }
    echo "\r\n//]]>\r\n</script>";
}

//특정아이디에 수퍼관리자권한 부여
if(isset($config['cf_4']) && $config['cf_4'] !== '' && $config['cf_4'] === $member['mb_id']) {
    $is_admin = "super";
}

//관리자모드 폴더
define("G5_MANAGE_DIR", "admin");

//관리자모드 URL
define("G5_MANAGE_URL", G5_URL . "/" . G5_MANAGE_DIR);

//관리자모드 경로
define("G5_MANAGE_PATH", G5_PATH . "/" . G5_MANAGE_DIR);

//관리자 인클루드 경로
define("G5_MANAGE_INCLUDE_PATH", G5_MANAGE_PATH . "/share/include");

//컴포저
include_once G5_PATH . "/vendor/autoload.php";

/**
 * 인피아드 추가
 */

$movie_width = "612";
$movie_height = "360";

// 유튜브 동영상 주소에서 동영상 ID만 추출하는 함수
function get_youtubeid($url) {
    $id = str_replace("https://youtu.be/", "", $url);
    $id = str_replace("http://youtu.be/", "", $id);
    $id = str_replace("https://www.youtube.com/watch?v=", "", $id);
    $id = str_replace("http://www.youtube.com/watch?v=", "", $id);
    
    return $id;
}

// ========================== 커스터 마이징 - [한국원자력아카데미] ==========================

// 신청자 테이블
$applicant_table = "s1_2_2_1";

// 지역 
$location_info = Array("서울", "대전", "대구", "광주", "부산", "울산", "경기", "인천", "강원", "충북", "충남", "경북", "경남", "전북", "전남", "제주도");

// 신청상태 확인
function get_status($bo_table, $wr_id){
	
	global $g5;

	$result_info = Array();

	// 교육의 정보
	$edu_info = sql_fetch("SELECT wr_5 FROM ".$g5['write_prefix'].$bo_table." WHERE wr_id = '".$wr_id."'");
	
	// 교육의 참여자 수 가져오기
	$join_info = sql_fetch("SELECT COUNT(wr_id) CNT FROM ".$g5['write_prefix'].$bo_table."_1 WHERE wr_1 = '".$wr_id."' AND wr_8 != '취소'");
	
	$status = "신청";
	if($edu_info['wr_5'] <= $join_info['CNT']){ $status = "마감"; }

	$result_info['CNT'] = $join_info['CNT'];
	$result_info['status'] = $status;

	return $result_info;
}

function get_category_info($bo_table, $ca_id){ // 카테고리 코드로 카테고리 정보 가져오기
	global $config;
    global $g5;

    $sql = "SELECT * FROM {$g5['category']} WHERE bo_table = '".$bo_table."' AND ca_id = '".$ca_id."' ";
    $cat_info = sql_fetch($sql);

	return $cat_info;
}

// 게시판의 카테고리(=분류)2-3단 가져오기
function get_table_category($bo_table_name){

	global $g5;

	// 카테고리 담을 배열 변수
	$temp_categories = Array();
	
	// 해당 게시판의 카테고리 - 1단계 메뉴
	$temp_category = sql_query("SELECT * FROM {$g5['category']} WHERE bo_table='".$bo_table_name."' AND LENGTH(ca_id)=2 ORDER BY turn ASC, ca_id ASC");
	for($i = 0; $row = sql_fetch_array($temp_category); $i++){
		$temp_categories[$i] = $row;
			
		// 해당 게시판의 하위 메뉴(=2단계) 체크
		$cnt_check = sql_fetch("SELECT COUNT(idx) CNT FROM {$g5['category']} WHERE bo_table='".$bo_table_name."' AND ca_id LIKE '".$row['ca_id']."%' AND LENGTH(ca_id)=4 ORDER BY turn ASC, ca_id ASC");

		// 해당 게시판의 하위 메뉴(=2단계)가 있을 경우
		if($cnt_check['CNT']){

			// 해당 게시판의 카테고리 - 2단계 메뉴
			$temp_category2 = sql_query("SELECT * FROM {$g5['category']} WHERE bo_table='".$bo_table_name."' AND ca_id LIKE '".$row['ca_id']."%' AND LENGTH(ca_id)=4 ORDER BY turn ASC, ca_id ASC");
			for($j = 0; $row2 = sql_fetch_array($temp_category2); $j++){
				$temp_categories[$i][$row['ca_id']][$j] = $row2;

				// 해당 게시판의 하위 메뉴(=3단계) 체크
				$cnt_check = sql_fetch("SELECT COUNT(idx) CNT FROM {$g5['category']} WHERE bo_table='".$bo_table_name."' AND ca_id LIKE '".$row2['ca_id']."%' AND LENGTH(ca_id)=6 ORDER BY turn ASC, ca_id ASC");

				// 해당 게시판의 하위 메뉴(=3단계)가 있을 경우
				if($cnt_check['CNT']){

					// 해당 게시판의 카테고리 - 3단계 메뉴
					$temp_category3 = sql_query("SELECT * FROM {$g5['category']} WHERE bo_table='".$bo_table_name."' AND ca_id LIKE '".$row2['ca_id']."%' AND LENGTH(ca_id)=6 ORDER BY turn ASC, ca_id ASC");
					while($row3 = sql_fetch_array($temp_category3)){
						$temp_categories[$i][$row['ca_id']][$j][$row2['ca_id']][] = $row3;
					}
				}
			}
		}
	}

	return $temp_categories;
}

if (isset($_REQUEST['syear']))  {
    $syear = trim($_REQUEST['syear']);
    $syear = preg_replace("/[\<\>\'\"\\\'\\\"\%\=\(\)\/\^\*\s]/", "", $syear);
    if ($syear)
        $qstr .= '&amp;syear=' . urlencode($syear); // search sort (검색 정렬 필드)
} else {
    $syear = '';
}

if (isset($_REQUEST['stype']))  {
    $stype = trim($_REQUEST['stype']);
    $stype = preg_replace("/[\<\>\'\"\\\'\\\"\%\=\(\)\/\^\*\s]/", "", $stype);
    if ($stype)
        $qstr .= '&amp;stype=' . urlencode($stype); // search sort (검색 정렬 필드)
} else {
    $stype = '';
}

// 로그파일 지우기
function clear_shop_log(){

	global $default;

	// 테스트 결제
	if ($default['de_card_test']) { $default['de_payjoa_mid'] = "CTS17420"; }
	
	$mid = $default['de_payjoa_mid'];


	$pathDir = G5_SHOP_PATH.'/'.$default['de_pg_service']."/log/";



	$dir = opendir($pathDir);
	while ($itemName = readdir($dir)) {
		// 로그파일 체크
		if(!strstr($itemName, "log_".$mid."_")){ continue; }
		
		// 로그파일 숫자만 남기기(=날짜 비교를 위해서)
		$temp_itemName = str_replace("log_".$mid."_", "", $itemName);
		$temp_itemName = preg_replace("/[^0-9]*/s", "", $temp_itemName);

		// 현재일자
		$now = date('Y-m-d H:i:s', time());
		// 한달 전
		$stand_day = date('Ymd', strtotime($now." -1 month"));
		// 한달 전보다 오래된 로그파일 삭제
		if($stand_day > $temp_itemName){ unlink($pathDir.$itemName); }

		// unlink($pathDir.$itemName);
		echo "<br>".$temp_itemName."|".$stand_day;
	}
	closedir($dir);
}
?>