<?php
	if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

	include_once(G5_THEME_PATH.'/head.sub.php');
	include_once(G5_LIB_PATH.'/outlogin.lib.php');
	include_once(G5_LIB_PATH.'/visit.lib.php');
	include_once(G5_LIB_PATH.'/connect.lib.php');
	include_once(G5_LIB_PATH.'/popular.lib.php');
	include_once(G5_LIB_PATH.'/latest.lib.php');
?>
<?/*
<header id="hd">
    <?php if ((!$bo_table || $w == 's' ) && defined('_INDEX_')) { ?><h1><?php echo $config['cf_title'] ?></h1><?php } ?>

    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

    <?php if(defined('_INDEX_')) { // index에서만 실행
        include G5_MOBILE_PATH.'/newwin.inc.php'; // 팝업레이어
    } ?>
    <div id="logo"><a href="<?php echo G5_SHOP_URL; ?>/"><img src="<?php echo G5_DATA_URL; ?>/common/mobile_logo_img" alt="<?php echo $config['cf_title']; ?> 메인"></a></div>

    <?php include_once(G5_MSHOP_SKIN_PATH.'/boxcategory.skin.php'); // 상품분류 ?>



    <a href="<?php echo G5_SHOP_URL; ?>/cart.php" class="hd-cart">장바구니</a>
    <?php include_once(G5_THEME_MSHOP_PATH.'/category.php'); // 분류 ?>

</header>

<?php
if(basename($_SERVER['SCRIPT_NAME']) == 'faq.php')
    $g5['title'] = '고객센터';
?>

<div id="container" class="container">
    <?php if ((!$bo_table || $w == 's' ) && !defined('_INDEX_')) { ?><h1 id="container_title"><span><?php echo $g5['title'] ?></span></h1><?php } ?>
*/?>