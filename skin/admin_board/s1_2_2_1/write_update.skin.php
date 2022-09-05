<?

/* 동일한 처리 필요
/cal/cal_write2.update.php
/theme/kans/mobile/skin/board/s1_2_2_1/write_update.skin.php */
for($i = 11; $i <= 30; $i++){
	$check_query = "
	SELECT 1 FROM Information_schema.columns
	WHERE table_schema = '".G5_MYSQL_DB."' 
	AND table_name = '".$write_table."' 
	AND column_name = 'wr_".$i."'";

	if(sql_query($check_query, false)) {

		switch($i){
			case 13 : $col = "INT(11)"; break;	// 소속회원의 no
			case 15 : $col = "INT(11)"; break;	// 결제된 금액
			case 16 : $col = "INT(11)"; break;	// 결제할 금액
			case 25 : $col = "INT(11)"; break;	// 장바구니 PK
			case 26 : $col = "INT(11)"; break;	// 수료증 번호
			case 30 : $col = "INT(11)"; break;	// 소속 PK
			default : $col = "VARCHAR(255)"; 
		}

		$alter_query = "ALTER TABLE ".$write_table." ADD COLUMN wr_".$i." ".$col." NOT NULL";

		$check_query2 = "
			SELECT 1 FROM Information_schema.columns
			WHERE table_schema = '".G5_MYSQL_DB."' 
			AND table_name = '".$write_table."' 
			AND column_name = 'wr_".($i-1)."'";

		$check_result2 = sql_query($check_query2);
		$check_info2 = sql_fetch_array($check_result2);

		if($check_info2['1']) { $alter_query .= " AFTER wr_".($i-1); }

		// $alter_query = "ALTER TABLE ".$write_table." ADD COLUMN wr_".$i." VARCHAR(255) NOT NULL AFTER wr_".($i-1);

		sql_query($alter_query);
	}
}

$sql = "UPDATE ".$write_table." SET ";
for($i = 11; $i < 30; $i++){
	$sql .= " wr_".$i." = '".${"wr_".$i}."', ";
}
$sql .= " wr_".$i." = '".${"wr_".$i}."' ";

$sql .= " WHERE wr_id = '".$wr_id."' ";
sql_query($sql);

// 수료증 발급
// 교육 수료이면서 수료증 번호가 없을 경우
if($wr_18 == "교육수료" && !$wr_26 && strstr($_SERVER['REMOTE_ADDR'], "211.170.81")){
	
	$where = "";

	// 교육일정 정보
	$tmp_write_table = $g5['write_prefix'] . substr($bo_table, 0, -2);
	$program_info = sql_fetch(" SELECT * FROM {$tmp_write_table} WHERE wr_id = '{$wr_1}' ");

	// 교육 종류
	switch($program_info["wr_1"]){
		case "30": $where .= " AND b.wr_1 IN ('{$program_info["wr_1"]}', '40') "; break; // 전문교육
		case "40": $where .= " AND b.wr_1 IN ('30', '{$program_info["wr_1"]}') "; break; // 기타
		default: $where .= " AND b.wr_1 = '{$program_info["wr_1"]}' ";
	}

	// 교육 연도
	$wr_22_ = explode("|", $wr_22);
	$wr_22_ = $wr_22_[1];

	// 발급번호 부여
	$temp_26_ = 0;
	
	// 맥스번호 알아내기
	$max_sql = " SELECT MAX(wr_26) max_26 
					FROM {$write_table} AS a
					INNER JOIN {$tmp_write_table} AS b
					ON a.wr_1 = b.wr_id
					WHERE a.wr_22 LIKE '%{$wr_22_}'
						/* AND a.wr_18 = '교육수료' */
						{$where} ";

	// 종료일 기준 해당 연도의 가장 큰 발급번호
	$max_info = sql_fetch($max_sql);
	
	// 가장 큰 발급번호가 없을 경우(=최초 발급일 경우)
	if(!$max_info['max_26']){ $temp_26_++; }
	else{ $temp_26_ = $max_info['max_26'] + 1; }
	
	// 발급번호 업데이트 처리
	$update_query = " UPDATE ".$write_table." SET
							wr_26 = '".$temp_26_."' 
						WHERE wr_id = '".$wr_id."' ";
	sql_query($update_query);
}

if ($file_upload_msg)
    alert($file_upload_msg, G5_MANAGE_URL.'/board.php?bo_table='.$bo_table.'&amp;wr_id='.$wr_id.'&amp;swr_1='.$wr_1.'&amp;page='.$page.$qstr);
else
    goto_url(G5_MANAGE_URL.'/board.php?bo_table='.$bo_table.'&amp;swr_1='.$wr_1.$qstr);

exit;
?>
