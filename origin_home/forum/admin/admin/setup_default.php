<?php
	include_once "./_common.php";
	/**
	 *	해당페이지 타이틀 및 기본 노출 설정
	 */
	$g5['title'] = "환경설정 > 인피아드 관리자모드";	//title
	$category_title = "환경설정";	//카테고리 제목
	$sub_title = "기본정보";	//서브 타이틀
	$sub_explan = "실제의 내용을 입력해주시기 바랍니다."; //페이지 설명

	include_once G5_MANAGE_INCLUDE_PATH . "/admin_header.php";

?>


<?php
include_once G5_MANAGE_INCLUDE_PATH . "/admin_footer.php";
?>