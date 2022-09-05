<?php

include_once "./_common.php";

//관리자 토큰검사
check_admin_token();

$cp_name = clean_xss_tags(trim($cp_name));  //상호명
$cp_code = clean_xss_tags(trim($cp_code1)) . "-" . clean_xss_tags(trim($cp_code2)) . "-" . clean_xss_tags(trim($cp_code3)); //사업자번호
$cp_boss = clean_xss_tags(trim($cp_boss));  //대표성함
$cp_tel = clean_xss_tags(trim($cp_tel1)) . "-" . clean_xss_tags(trim($cp_tel2)) . "-" . clean_xss_tags(trim($cp_tel3));    //전화번호
$cp_hp = clean_xss_tags(trim($cp_hp1)) . "-" . clean_xss_tags(trim($cp_hp2)) . "-" . clean_xss_tags(trim($cp_hp3)); //핸드폰 번호
$cp_email = get_email_address(trim($cp_email1) . "@" . trim($cp_email2));
$cp_starttime = clean_xss_tags($cp_starttime);
$cp_endtime = clean_xss_tags($cp_endtime);
$cp_vacation = clean_xss_tags($cp_vacation);
$cp_zip = clean_xss_tags(trim($cp_zip));
$cp_addr1 = clean_xss_tags(trim($cp_addr1));
$cp_addr2 = clean_xss_tags(trim($cp_addr2));
$cp_addr3 = clean_xss_tags(trim($cp_addr3));
$cp_content = clean_xss_tags(trim($cp_content));

$cp_subway = clean_xss_tags(trim($cp_subway));
$cp_bus = clean_xss_tags(trim($cp_bus));
$cp_car = clean_xss_tags(trim($cp_car));


sql_query(" update {$g5['site_table']} set 
          cp_name = '$cp_name',
          cp_code = '$cp_code',
          cp_boss = '$cp_boss',
          cp_tel = '$cp_tel',
          cp_hp = '$cp_hp',
          cp_email = '$cp_email',
          cp_starttime = '$cp_starttime',
          cp_endtime = '$cp_endtime',
          cp_vacation = '$cp_vacation',
          cp_parking = '$cp_parking',
          cp_zip = '$cp_zip',
          cp_addr1 = '$cp_addr1',
          cp_addr2 = '$cp_addr2',
          cp_addr3 = '$cp_addr3',
          cp_content = '$cp_content',
		  cp_subway = '$cp_subway',
		  cp_bus = '$cp_bus',
		  cp_car = '$cp_car' ");

alert("기본정보 입력이 완료되었습니다", G5_MANAGE_URL . "/setup_default.php");