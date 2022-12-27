<?php
	// 이 파일은 새로운 파일 생성시 반드시 포함되어야 함
	if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

	$begin_time = get_microtime();

	if (!isset($g5['title'])) {
		$g5['title'] = $config['cf_title'];
		$g5_head_title = $g5['title'];
	}
	else {
		$g5_head_title = $g5['title']; // 상태바에 표시될 제목
		$g5_head_title .= " | ".$config['cf_title'];
	}

	// 현재 접속자
	// 게시판 제목에 ' 포함되면 오류 발생
	$g5['lo_location'] = addslashes($g5['title']);
	if (!$g5['lo_location'])
		$g5['lo_location'] = addslashes(clean_xss_tags($_SERVER['REQUEST_URI']));
	$g5['lo_url'] = addslashes(clean_xss_tags($_SERVER['REQUEST_URI']));
	if (strstr($g5['lo_url'], '/'.G5_ADMIN_DIR.'/') || $is_admin == 'super') $g5['lo_url'] = '';

	/*
	// 만료된 페이지로 사용하시는 경우
	header("Cache-Control: no-cache"); // HTTP/1.1
	header("Expires: 0"); // rfc2616 - Section 14.21
	header("Pragma: no-cache"); // HTTP/1.0
	*/
?>
<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<?php
if (G5_IS_MOBILE) {
	if($bo_table == "forum" || $bo_table == "forum_info" || $bo_table == "forum_info2" || $bo_table == "newsletter" || $bo_table == "community"){
		echo '<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=0,maximum-scale=10,user-scalable=yes">'.PHP_EOL;
	} else {
		echo '<meta name="viewport" content="width=1400">'.PHP_EOL;
	}
    echo '<meta name="HandheldFriendly" content="true">'.PHP_EOL;
    echo '<meta name="format-detection" content="telephone=no">'.PHP_EOL;
     echo '<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">'.PHP_EOL;
} else {
//	echo '<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=0,maximum-scale=10,user-scalable=yes">'.PHP_EOL;
	echo '<meta name="viewport" content="width=1400">'.PHP_EOL;
    echo '<meta http-equiv="imagetoolbar" content="no">'.PHP_EOL;
    echo '<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">'.PHP_EOL;
}

if($config['cf_add_meta'])
    echo $config['cf_add_meta'].PHP_EOL;
?>
<?
	$table_name = "site_config";
	$site_config = "select * from $table_name where sc_no = 1";
	$site_result = sql_query($site_config);
	$site_row = sql_fetch_array($site_result);
?>
<title><?php if($site_row['sc_title']){ echo $site_row['sc_title']; }else{ echo $g5_head_title; } ?></title>
<link rel="stylesheet" href="https://cdn.rawgit.com/theeluwin/NotoSansKR-Hestia/master/stylesheets/NotoSansKR-Hestia.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/notosanskr.css"> 
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.rawgit.com/moonspam/NanumSquare/master/nanumsquare.css"> -->
<link rel="preconnect" href="https://fonts.gstatic.com">
<!-- <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet"> -->
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

<link rel="stylesheet" href="<?php echo G5_CSS_URL ?>/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo G5_CSS_URL ?>/jquery-ui.css">
<link rel="stylesheet" href="<?php echo G5_CSS_URL ?>/jquery.bxslider.css">
<link rel="stylesheet" href="<?php echo G5_THEME_CSS_URL ?>/mobile/owl.carousel.min.css">
<link rel="stylesheet" href="<?php echo G5_THEME_CSS_URL ?>/mobile/owl.theme.default.min.css">
<link rel="stylesheet" href="<?php echo G5_THEME_CSS_URL ?>/mobile/swiper/swiper.css">
<link rel="stylesheet" href="<?php echo G5_THEME_CSS_URL ?>/mobile/wow/animate.css">

<link rel="stylesheet" href="<?php echo G5_THEME_CSS_URL ?>/mobile/slick/slick.css">
<link rel="stylesheet" href="<?php echo G5_THEME_CSS_URL ?>/mobile/slick/slick-theme.css">

<?php
	$shop_css = '';
	if (defined('_SHOP_')) $shop_css = '_shop';
	//echo '<link rel="stylesheet" href="'.G5_THEME_CSS_URL.'/'.(G5_IS_MOBILE?'mobile':'default').$shop_css.'.css">'.PHP_EOL;
	if($bo_table == "forum" || $bo_table == "forum_info" || $bo_table == "forum_info2" || $bo_table == "newsletter" || $bo_table == "community"){
		echo '<link rel="stylesheet" href="https://www.kans.re.kr/origin_home/safety/theme/kans/css/mobile/common.css">'.PHP_EOL;
		echo '<link rel="stylesheet" href="https://www.kans.re.kr/origin_home/safety/theme/kans/css/mobile/layout.css">'.PHP_EOL;
		echo '<link rel="stylesheet" href="https://www.kans.re.kr/origin_home/safety/theme/kans/css/mobile/carousel.css">'.PHP_EOL;
		echo '<link rel="stylesheet" href="https://www.kans.re.kr/origin_home/safety/theme/kans/css/mobile/main.css">'.PHP_EOL;
		echo '<link rel="stylesheet" href="https://www.kans.re.kr/origin_home/safety/theme/kans/css/mobile/sub.css">'.PHP_EOL;
		echo '<link rel="stylesheet" href="https://www.kans.re.kr/origin_home/safety/theme/kans/css/mobile/template.css">'.PHP_EOL;
	} else {
		echo '<link rel="stylesheet" href="'.G5_THEME_CSS_URL.'/'.(G5_IS_MOBILE?'mobile':'default').'/common'.$shop_css.'.css">'.PHP_EOL;
		echo '<link rel="stylesheet" href="'.G5_THEME_CSS_URL.'/'.(G5_IS_MOBILE?'mobile':'default').'/layout'.$shop_css.'.css">'.PHP_EOL;
		echo '<link rel="stylesheet" href="https://www.kans.re.kr/origin_home/safety/theme/kans/css/mobile/carousel.css">'.PHP_EOL;
		echo '<link rel="stylesheet" href="'.G5_THEME_CSS_URL.'/'.(G5_IS_MOBILE?'mobile':'default').'/main'.$shop_css.'.css">'.PHP_EOL;
		echo '<link rel="stylesheet" href="'.G5_THEME_CSS_URL.'/'.(G5_IS_MOBILE?'mobile':'default').'/sub'.$shop_css.'.css">'.PHP_EOL;
		echo '<link rel="stylesheet" href="'.G5_THEME_CSS_URL.'/'.(G5_IS_MOBILE?'mobile':'default').'/template'.$shop_css.'.css">'.PHP_EOL;
	}

?>
<link rel="stylesheet" href="<?php echo G5_THEME_URL ?>/css/mobile/media.css">

<!-- 오버효과  -->
<link rel="stylesheet" href="<?php echo G5_THEME_URL ?>/css/mobile/hover.css">

<!-- 네이버 메타태그 -->
<meta name="naver-site-verification" content="<?php echo $site_row[sc_author]; ?>"/>

<!-- 일반 메타태그 -->
<meta name="keywords" content="<?php echo $site_row[sc_keyword]; ?>" />
<meta name="description" content="<?php echo $site_row[sc_description]; ?>" />
<link rel="canonical" href="<?php echo $site_row[sc_copyright]; ?>" />

<!-- SNS관련 메타태그 -->
<meta property="og:type" content="website" />
<meta property="og:title" content="<?php if($site_row['sc_title']){ echo $site_row['sc_title']; }else{ echo $g5_head_title; } ?>" />
<meta property="og:description" content="<?php echo $site_row[sc_description]; ?>" />
<meta property="og:image" content="" />
<meta property="og:url" content="<?php echo $site_row[sc_copyright]; ?>" />

<!--<link rel="stylesheet" href="<?php echo G5_CSS_URL ?>/etc.css">-->

<!--[if lte IE 8]>
	<script src="<?php echo G5_JS_URL ?>/html5.js"></script>
<![endif]-->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<script>
// 자바스크립트에서 사용하는 전역변수 선언
var g5_url       = "<?php echo G5_URL ?>";
var g5_bbs_url   = "<?php echo G5_BBS_URL ?>";
var g5_is_member = "<?php echo isset($is_member)?$is_member:''; ?>";
var g5_is_admin  = "<?php echo isset($is_admin)?$is_admin:''; ?>";
var g5_is_mobile = "<?php echo G5_IS_MOBILE ?>";
var g5_bo_table  = "<?php echo isset($bo_table)?$bo_table:''; ?>";
var g5_sca       = "<?php echo isset($sca)?$sca:''; ?>";
var g5_editor    = "<?php echo ($config['cf_editor'] && $board['bo_use_dhtml_editor'])?$config['cf_editor']:''; ?>";
var g5_cookie_domain = "<?php echo G5_COOKIE_DOMAIN ?>";
var g5_shop_url = "<?php echo G5_SHOP_URL; ?>";
var g5_theme_shop_url = "<?php echo G5_THEME_SHOP_URL; ?>";
</script>

<script src="<?php echo G5_JS_URL ?>/jquery-1.11.1.js"></script>
<script src="<?php echo G5_JS_URL ?>/jquery-ui.js"></script>
<script src="<?php echo G5_JS_URL ?>/jquery.bxslider.js"></script>
<script src="<?php echo G5_JS_URL ?>/jquery.easing.1.3.js"></script>
<script src="<?php echo G5_JS_URL ?>/printThis.js"></script>
<script src="<?php echo G5_THEME_JS_URL ?>/owl.carousel.min.js"></script>
<script src="<?php echo G5_THEME_JS_URL ?>/swiper/swiper.min.js"></script>
<script src="<?php echo G5_THEME_JS_URL ?>/wow/wow.min.js"></script>
<!-- <script src="<?php echo G5_THEME_JS_URL ?>/ui_test.js"></script> -->
<script src="<?php echo G5_THEME_JS_URL ?>/slick/slick.min.js"></script>


<script> new WOW().init(); </script>

<?php
if (defined('_SHOP_')) {
    if(!G5_IS_MOBILE) {
?>
<script src="<?php echo G5_JS_URL ?>/jquery.shop.menu.js"></script>
<?php
    }
} else {
?>
<script src="<?php echo G5_JS_URL ?>/jquery.menu.js"></script>
<?php } ?>
<script src="<?php echo G5_JS_URL ?>/common.js"></script>
<script src="<?php echo G5_JS_URL ?>/wrest.js"></script>
<script src="<?php echo G5_THEME_JS_URL ?>/index.js"></script>
<?php
if(G5_IS_MOBILE) {
    echo '<script src="'.G5_JS_URL.'/modernizr.custom.70111.js"></script>'.PHP_EOL; // overflow scroll 감지
}
if(!defined('G5_IS_ADMIN'))
    echo $config['cf_add_script'];
?>
<script type="text/javascript">
	function member_leave(){//회원 탈퇴
		if (confirm("회원에서 탈퇴 하시겠습니까?")){
			location.href = '<?php echo G5_BBS_URL ?>/member_confirm.php?url=member_leave.php';
		}
	}
</script>
</head>
<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?>>
<?php
if ($is_member) { // 회원이라면 로그인 중이라는 메세지를 출력해준다.
    $sr_admin_msg = '';
    if ($is_admin == 'super') $sr_admin_msg = "최고관리자 ";
    else if ($is_admin == 'group') $sr_admin_msg = "그룹관리자 ";
    else if ($is_admin == 'board') $sr_admin_msg = "게시판관리자 ";

    echo '<div id="hd_login_msg">'.$sr_admin_msg.get_text($member['mb_nick']).'님 로그인 중 ';
    echo '<a href="'.G5_BBS_URL.'/logout.php">로그아웃</a></div>';
}
?>