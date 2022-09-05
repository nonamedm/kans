<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

sql_query("update $write_table set wr_order = '$wr_order', wr_good = '$how_good' where wr_id = '$wr_id' ");

alert("등록이 완료되었습니다", G5_MANAGE_URL . "/board.php?bo_table=" . $bo_table);

?>