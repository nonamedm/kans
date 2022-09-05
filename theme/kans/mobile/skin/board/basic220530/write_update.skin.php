<?
if($bo_table == 's5_2'){
	delete_cache_latest($bo_table);
	alert($board[bo_subject]." 등록 완료하였습니다.\\n\\n감사합니다.","./write.php?bo_table='$bo_table'");
	exit;
}
?>