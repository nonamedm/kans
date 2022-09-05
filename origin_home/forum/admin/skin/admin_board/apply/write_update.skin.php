<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가


//예약자 업데이트
sql_query(" update $write_table set wr_name = '$reseve_wr_name' where wr_id = '$wr_id' ");