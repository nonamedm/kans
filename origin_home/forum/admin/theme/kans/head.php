<?php
	if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

	if (G5_IS_MOBILE) {
		if($bo_table == "forum" || $bo_table == "forum_info" || $bo_table == "forum_info2" ||$bo_table == "newsletter" || $bo_table == "community"){
			include_once('/kans1/www/origin_home/safety/theme/kans/mobile/head.php');
		}else{
			include_once(G5_THEME_MOBILE_PATH.'/head.php');
		}
		return;
		
	}

	if(G5_COMMUNITY_USE === false) {
		include_once(G5_THEME_SHOP_PATH.'/shop.head.php');
		return;
	}

	include_once(G5_THEME_PATH.'/head.sub.php');
	include_once(G5_LIB_PATH.'/latest.lib.php');
	include_once(G5_LIB_PATH.'/outlogin.lib.php');
	include_once(G5_LIB_PATH.'/poll.lib.php');
	include_once(G5_LIB_PATH.'/visit.lib.php');
	include_once(G5_LIB_PATH.'/connect.lib.php');
	include_once(G5_LIB_PATH.'/popular.lib.php');
?>