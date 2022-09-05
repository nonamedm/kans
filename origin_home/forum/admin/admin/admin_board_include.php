<?php

if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if($bo_table == "product"){
	$g5['title'] = "상품소개 > 인피아드 관리자모드";	//title
	$category_title = "상품소개";	//카테고리 제목
	$sub_title = "상품소개관리";	//서브 타이틀
	$sub_explan = ""; //페이지 설명
}else if($bo_table == "reservation"){
	$g5['title'] = "최근예약 > 인피아드 관리자모드";	//title
	$category_title = "최근예약";	//카테고리 제목
	$sub_title = "예약관리";	//서브 타이틀
	$sub_explan = ""; //페이지 설명
}else if($bo_table == "review"){
	$g5['title'] = "리뷰 > 인피아드 관리자모드";	//title
	$category_title = "리뷰";	//카테고리 제목
	$sub_title = "리뷰관리";	//서브 타이틀
	$sub_explan = ""; //페이지 설명
}else if($bo_table == "potal_review"){
	$g5['title'] = "리뷰 > 인피아드 관리자모드";	//title
	$category_title = "리뷰";	//카테고리 제목
	$sub_title = "포탈리뷰";	//서브 타이틀
	$sub_explan = ""; //페이지 설명
}

?>