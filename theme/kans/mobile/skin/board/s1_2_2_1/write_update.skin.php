<?
	if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
/* 동일한 처리 필요
/skin/admin_board/s1_2_2_1/write_update.skin.php
/cal/cal_write2.update.php */
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

delete_cache_latest($bo_table);
// alert($board[bo_subject]." 등록 완료하였습니다.\\n\\n감사합니다.","./write.php?bo_table='$bo_table'");
alert($board[bo_subject]." 등록 완료하였습니다.\\n\\n감사합니다.", "/cal/cal_list.php");
exit;
?>
