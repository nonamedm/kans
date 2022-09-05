<?php

include_once("./_common.php");

if(!$is_admin)
	alert("접근권한이 없습니다");


foreach($chk_wr_id as $key => $value){
	sql_query(" update $write_table set wr_10 = '{$wr_10[$value]}' where wr_id = '$value' ");
}

alert("상태가 변경되었습니다", './board.php?bo_table='.$bo_table.'&amp;page='.$page.$qstr);