<?php
	if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>
<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $g5['title']?></title>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet" />
	<link type="text/css" rel="stylesheet" href="<?php echo G5_MANAGE_URL?>/share/css/jquery-ui.css">
	<link type="text/css" rel="stylesheet" href="<?php echo G5_MANAGE_URL?>/share/css/reset.css">
    <link type="text/css" rel="stylesheet" href="<?php echo G5_MANAGE_URL?>/share/css/layout.css">
    <link type="text/css" rel="stylesheet" href="<?php echo G5_MANAGE_URL?>/share/css/bbs.css">
    <link type="text/css" rel="stylesheet" href="<?php echo G5_MANAGE_URL?>/share/css/admin.css">
	<!--
	<link type="text/css" rel="stylesheet" href="<?php echo G5_URL?>/css/default.css">
	-->
    <link type="text/css" rel="stylesheet" href="<?php echo G5_MANAGE_URL?>/share/css/etc.css">
	<link type="text/css" rel="stylesheet" href="<?php echo G5_MANAGE_URL?>/share/css/bootstrap-colorpicker.css">
	<!--<link rel="stylesheet" href="http://fonts.googleapis.com/earlyaccess/notosanskr.css" />-->
	<link rel="stylesheet" href="http://fonts.googleapis.com/earlyaccess/nanumgothic.css" />
    <script type="text/javascript" src="<?php echo G5_MANAGE_URL?>/share/js/jquery-1.12.2.min.js"></script>
    <script type="text/javascript" src="<?php echo G5_MANAGE_URL?>/share/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo G5_MANAGE_URL?>/share/js/index.js"></script>
	<script type="text/javascript" src="<?php echo G5_MANAGE_URL?>/share/js/bootstrap-colorpicker.js"></script>
    <script type="text/javascript" src="<?php echo G5_URL?>/js/common.js"></script>
    <script type="text/javascript" src="<?php echo G5_MANAGE_URL?>/share/js/admin.js"></script>
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
        <?php if(defined('G5_IS_ADMIN')) { ?>
        var g5_admin_url = "<?php echo G5_MANAGE_URL; ?>"; // 171030수정.. 밑에꺼보다 안전
	var g5_manage_url = "<?php echo G5_MANAGE_URL; ?>"; //1229 추가
        <?php } ?>
    </script>
</head>
<body>