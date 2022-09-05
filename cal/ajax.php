<?php	
include_once "./_common.php";
include_once(G5_LIB_PATH.'/json.lib.php');

$mode = $_REQUEST['mode'];

// 분류의 하위 카테고리 가져오기
if($mode == 'get_category_option'){
		
	// 결과 반환용
	$data = Array();
	
	// 가져오려는 카테고리
	$bo_table = $_REQUEST['bo_table'];

	// 가져오려는 카테고리 번호
	$ca_id = $_REQUEST['ca_id'];
	
	// 가져오려는 하위 카테고리 길이
	$ca_len = strlen($ca_id) + 2;
	
	// 카테고리 정보
	$category_query = " SELECT * 
						FROM ".$g5['category']." 
						WHERE bo_table = '".$bo_table."' 
							AND LENGTH(ca_id) = ".$ca_len." 
							AND ca_id LIKE '".$ca_id."%'
						ORDER BY turn ASC, ca_id ASC ";
	$category_result = sql_query($category_query);
	for($i = 0; $row = sql_fetch_array($category_result); $i++){
		$data['ca_id'][] = $row['ca_id'];
		$data['ca_name'][] = $row['ca_name'];
	}
	
	// 총 카테고리 개수
	$data['CNT'] = $i;

	echo json_encode($data);

}
?>