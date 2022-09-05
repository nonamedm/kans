<?php
include_once('./_common.php');

$g5['title'] = '마이페이지';

//include_once(G5_THEME_MSHOP_PATH.'/shop.head.php');
include_once(G5_THEME_MOBILE_PATH.'/head.php');

add_javascript('<script src="'.G5_THEME_JS_URL.'/Ublue-jQueryTabs-1.2.js"></script>', 10);
?>
<div id="smb_my" class="ct1">
	<section id="smb_my_ov" >
		<h2>회원정보 개요</h2>
		<div class="hello_name">
			<span class="name_box">
				<i class="fa fa-user" aria-hidden="true"></i>
				<?php echo $member['mb_id'] ? $member['mb_name'] : '비회원'; ?> 님</span>

			<ul class="smb_my_act">
				<? if($member[mb_1]){ //회원종류를 비교하는것 이유 요양기관인경우!! ?>
					<li><a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=register_form.php?reg_type=pb" class="btn02">회원정보수정</a></li>
				<? }else{ ?>
					<li><a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=register_form.php" class="btn02">회원정보수정</a></li>
				<? } ?>
				<li><a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=member_leave.php" onclick="return member_leave();" class="btn02">회원탈퇴</a></li>
			</ul>
		</div>

		<div class="my_info">
			<div class="my_info_wr">
				<strong>연락처</strong>
				<span><?php echo ($member['mb_tel'] ? $member['mb_tel'] : '미등록'); ?></span>
			</div>
			<div class="my_info_wr">
				<strong>E-Mail</strong>
				<span><?php echo ($member['mb_email'] ? $member['mb_email'] : '미등록'); ?></span>
			</div>
			<div class="my_info_wr">
				<strong>최종접속일시</strong>
				<span><?php echo $member['mb_today_login']; ?></span>
			 </div>
			<div class="my_info_wr">
			<strong>회원가입일시</strong>
				<span><?php echo $member['mb_datetime']; ?></span>
			</div>
			<div class="my_info_wr ov_addr">
				<strong>주소</strong>
				<span><?php echo sprintf("(%s%s)", $member['mb_zip1'], $member['mb_zip2']).' '.print_address($member['mb_addr1'], $member['mb_addr2'], $member['mb_addr3'], $member['mb_addr_jibeon']); ?></span>
			</div>
		</div>
	</section>
	<!-- <div id="smb_my_tab" >
		<ul class="tabsTit">
		</ul>
	</div> -->
</div>	


<!-- 	<script>
	$("#smb_my_tab").UblueTabs({
		eventType:"click"
	});
	</script> -->
</div>

<script>
$(function() {
    $(".win_coupon").click(function() {
        var new_win = window.open($(this).attr("href"), "win_coupon", "left=100,top=100,width=700, height=600, scrollbars=1");
        new_win.focus();
        return false;
    });
});

function member_leave()
{
    return confirm('정말 회원에서 탈퇴 하시겠습니까?')
}
</script>

<?php include_once(G5_THEME_MOBILE_PATH.'/tail.php'); ?>

<style>
#smb_my{margin-bottom: 150px !Important;}
#smb_my_ov { margin:0 0 20px; background:#fff; border:1px solid #ddd; }
#smb_my_ov h2 { position:absolute; font-size:0; text-indent:-9999em; line-height:0; overflow:hidden; }
#smb_my_ov .hello_name { position:relative; width:100%; padding:10px 10px; font-weight:normal;box-sizing: border-box;}
#smb_my_ov .hello_name i { font-size:1.2em; color:#ffcd03; }
#smb_my_ov .smb_my_act { position:absolute; right:10px; top:50%; transform:translateY(-50%); }
#smb_my_ov .smb_my_act li { display:inline-block; }
#smb_my_ov .smb_my_act li a { height:30px; line-height:30px; font-size:0.875em; padding:0 5px; border-radius:3px;background: #95cc1a; border: none; color:#fff; }
#smb_my_ov .my_po { position:relative; float:left; width:16.666%; padding:0 10px; line-height:45px; border-left:1px solid #dfdfdf; }
#smb_my_ov .my_po a { position:absolute; top:0; right:10px; font-weight:bold; color:#f50057; }
#smb_my_ov .my_info { clear:both; width:100%; border-top:1px solid #dfdfdf; padding:10px; box-sizing: border-box;}
#smb_my_ov .my_info:after { display:block; visibility:hidden; clear:both; content:''; }
#smb_my_ov .my_info_wr { position:relative; float:left; width:24%; margin-right:1%;  font-size:1em; line-height:20px; padding:3px 0px; }
#smb_my_ov .my_info_wr strong { display:block; margin-bottom:10px; color:#666; font-weight:normal; overflow:hidden; }
#smb_my_ov .my_info_wr span { display:block; padding:10px; color:#999; background:#f4f4f4; border:1px solid #ddd; border-radius:3px; overflow:hidden; }
#smb_my_ov .ov_addr { width:100%; }
#smb_my_tab { text-align:center; background:url('../mobile/shop/img/tab_bg.gif') repeat-x; }
#smb_my_tab .tabsTit li { width:120px; }
#smb_my_tab h2 { position:absolute; font-size:0; text-indent:-9999em; line-height:0; overflow:hidden; }
#smb_my_tab .more_btn { display:inline-block; width:200px; margin-top:10px; padding:10px; color:#79aaf3; border:2px solid #79aaf3; }
#smb_my_tab .more_btn:hover{ color:#fff; font-weight:bold; background:#79aaf3; }
#smb_my_wish ul:after { display:block; visibility:hidden; clear:both; content:''; }
#smb_my_wish li { float:left; width:25%; padding:10px 15px; text-align:left; }
#smb_my_wish li:nth-child(4n+1) { clear:both; }
#smb_my_wish li img { width:100%; height:auto; }
#smb_my_wish li .info_link { display:block; margin:10px 0 5px; color:#646464; text-overflow:ellipsis; white-space:nowrap; overflow:hidden; }
#smb_my_wish li .info_date { color:#646464; font-size:0.92em; }
#smb_my_wish li.empty_list { width:100% !important; text-align:center; }
.ct1 {max-width:1320px; margin:0 auto;}

@media(max-width:640px){

	#smb_my_ov .my_info_wr{width: 49%;}
	#smb_my_ov .my_info_wr.ov_addr{width: 100%;}
	#smb_my{margin-bottom: 12vw !important;}
}

</style>