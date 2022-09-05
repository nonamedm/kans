<?php

include_once("./_common.php");

check_admin_token(); //관리자 토큰검사

foreach($nw_chk as $value){
	sql_query(" delete from {$g5['new_win_table']} where nw_id = '$value' ");
}

alert("삭제가 완료되었습니다", "./setup_popup.php");