<?php

include_once "./_common.php";

check_admin_token();

$startime=  $start_hour . ":" . $start_min;
$endtime =  $end_hour . ":" . $end_min;

sql_query(" update {$g5['reserve_time_table']} set start_time = '$startime', end_time = '$endtime' ");

alert("예약범위설정이 완료되었습니다", "./reservation_setup.php");