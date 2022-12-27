<?php
	if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

	if(G5_COMMUNITY_USE === false) {
		include_once(G5_THEME_MSHOP_PATH.'/shop.tail.php');
		return;
	}
?>

<?if($screen_div=="sub"){?>
			<?if($bo_table){?>
				</section><!--// bd_sec -->
			<?}?>
	</div><!--// sub_layout -->
</div><!--// sub_wrap -->
<?}?>

<!-- 컨텐츠 : 시작 -->
<div class="footer"> 
	<div class="footer_in ct1 clear">
		<div class="ft_left">
			<ul>
				<li>
					<span> (사)한국원자력안전아카데미</span>
					<!-- <span>이사장 : 이헌규</span> -->
					<span>05719 서울특별시 송파구 송파대로 260 (가락동, 제일오피스텔) 617호 </span>
					<a href="<?=$s1_3_1_1_url;?>">오시는길</a>
				</li>
				<li>
					<span>TEL : 02-554-7330</span>
					<span>FAX : 02-508-7941</span>
					<span>E-mail : kans@kans.re.kr</span>
					<span>업무시간 : 09:00~18:00, 점심시간 12:00~13:00, 주말 공휴일 휴무 </span>
				</li>
			</ul>
			<p class="copy robo">COPYRIGHT &copy; 2021 KANS  ALL RIGHT RESERVED.</p>
		</div>
		<div class="ft_right">
			<ul class="ft_link clear">
				<li><a href="#n" class="btn_privacy">개인정보처리방침</a></li> 
				<li><a href="#n" class="btn_no_mail">이메일무단수집거부</a></li>
			</ul>
		</div>	
		<div class="top_bt"><img src="<? echo G5_THEME_URL ?>/images/layout/top_bt.png" /></div>
	</div>
</div>


<script>
	
</script>		


<div class="pop_bg"></div>
<?
if($bo_table == "forum" || $bo_table == "forum_info" || $bo_table == "forum_info2" || $bo_table == "newsletter" || $bo_table == "community"){
	include_once('/kans1/www/origin_home/safety/theme/kans/mobile/common_layer.php');
} else {
	include_once('common_layer.php');
}
?>





<!--
<?php if(G5_DEVICE_BUTTON_DISPLAY && G5_IS_MOBILE) { ?>
	<a href="<?php echo get_device_change_url(); ?>" id="device_change">PC 버전으로 보기</a>
<?php } ?>
-->
<?php
	if ($config['cf_analytics']) {
		echo $config['cf_analytics'];
	}
?>

<script>
	$('.lnb_dep1> a').click(function(){
		$(this).toggleClass('on');
		$(this).closest('div').find('div').slideToggle();
	});

	$('.lnb_dep2> a').click(function(){
		$(this).toggleClass('on');
		$(this).closest('div').find('.siteul_').slideToggle();
	});

</script>




<?php include_once(G5_THEME_PATH."/tail.sub.php"); ?>