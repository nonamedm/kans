<?php
include_once('./_common.php');

if (empty($_POST)) {
    alert("파일 또는 글내용의 크기가 서버에서 설정한 값을 넘어 오류가 발생하였습니다.\\npost_max_size=".ini_get('post_max_size')." , upload_max_filesize=".$upload_max_filesize."\\n게시판관리자 또는 서버관리자에게 문의 바랍니다.");
}

	sql_query("update g5_board set bo_category_list='{$bo_category_list}' where bo_table='$bo_table' ");
    alert("저장하였습니다.", "./board_cate.php?bo_table=$bo_table");
?>
