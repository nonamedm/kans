<?php
define('G5_IS_ADMIN', true);
include_once ('../../common.php');

if (!defined('G5_USE_SHOP') || !G5_USE_SHOP)
    ///* goodbuilder 수정 * die('<p>쇼핑몰 설치 후 이용해 주십시오.</p>');
    alert('현재 쇼핑몰 서비스는 제공하지 않습니다.');

include_once(G5_MANAGE_PATH.'/admin.lib.php');
?>
