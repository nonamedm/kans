<?php
	if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
	if (G5_IS_MOBILE) {
		//include_once(G5_THEME_MOBILE_PATH.'/tail.php');
		return;
	}
	if(G5_COMMUNITY_USE === false) {
		include_once(G5_THEME_SHOP_PATH.'/shop.tail.php');
		return;
	}
?>
<?php if(G5_DEVICE_BUTTON_DISPLAY && !G5_IS_MOBILE) { ?>
	<a href="<?php echo get_device_change_url(); ?>" id="device_change">모바일 버전으로 보기</a>
<?php }?>
<?php if ($config['cf_analytics']) {
	echo $config['cf_analytics'];
}?>
<script>
	$(function() {
		// 폰트 리사이즈 쿠키있으면 실행
		font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
	});
</script>
<?php include_once(G5_THEME_PATH."/tail.sub.php");?>