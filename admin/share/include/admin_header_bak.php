<?php
	if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
	include_once G5_MANAGE_PATH . "/share/include/admin.head.sub.php";
?>

<div id="header">
	<div class="h_top">
		<div class="h_top_left">
			<span class="user_name1">인피아드</span>
			<span class="user_name2">관리자모드</span>
		</div>
		<ul class="top_btn">
			<li><a href="<?php echo G5_URL?>/admin/" title="관리자홈"><span>HOME</span></a></li>
			<li><a href="<?php echo G5_URL?>" target="_blank" title="스마트홈 유지관리"><span>IMS</span></a></li>
			<li><a href="<?php echo G5_BBS_URL . "/logout.php"?>" title="로그아웃"><span>LogOut</span></a></li>
		</ul>
	</div>
	<div class="h_nav">
		<ul class="gn">
			<li><a href="<?php echo G5_MANAGE_URL?>/setup_admin.php" class="label">환경설정</a>
				<div class="sn sn1">
					<ul>
						<li><a href="<?php echo G5_MANAGE_URL?>/setup_admin.php">관리자정보</a></li>
						<li><a href="<?php echo G5_MANAGE_URL?>/setup_default.php">기본정보</a></li>											
						<li><a href="<?php echo G5_MANAGE_URL?>/setup_popup.php">팝업관리</a></li>
						<li><a href="<?php echo G5_MANAGE_URL?>/visit_list.php">접속통계</a></li>
					</ul>
				</div>
			</li>



			<li><a href="<?php echo G5_MANAGE_URL?>/member_list.php" class="label">회원관리</a>
				<div class="sn sn2">
					<ul>
						<li><a href="<?php echo G5_MANAGE_URL?>/member_list.php">회원관리</a></li>
					</ul>
				</div>
			</li>

			<li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/" class="label">쇼핑몰관리</a>
				<div class="sn sn2">
					<ul>
						<li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/orderlist.php">주문관리</a></li>
						<li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/categorylist.php">분류관리</a></li>
						<li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/itemlist.php">상품관리</a></li>
						<li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/itemqalist.php">상품문의</a></li>
						<li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/itemuselist.php">사용후기</a></li>
						<li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/itemstocklist.php">상품재고관리</a></li>
						<li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/itemtypelist.php">상품유형관리</a></li>
						<li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/couponlist.php">쿠폰관리</a></li>
						<li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/sendcostlist.php">추가배송비관리</a></li>
						<li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/configform.php">쇼핑몰설정</a></li>
					</ul>
				</div>
			</li>
		</ul>
	</div>
</div>
<?php
	if(preg_match("/\/shop_admin\//", $PHP_SELF)){
		$category_title = "쇼핑몰관리";
	}
?>
<div id="body">
	<div class="b_inner">
		<div class="side_bar">
			<!--카테고리 타이틀-->
			<h2 class="h2_label"><?php echo $category_title; ?></h2>
			<ul class="ln">
				<?php if($category_title=="환경설정"){?>
					<li><a href="<?php echo G5_MANAGE_URL?>/setup_admin.php">관리자정보</a></li>
					<li><a href="<?php echo G5_MANAGE_URL?>/setup_default.php">기본정보</a></li>

					<li><a href="<?php echo G5_MANAGE_URL?>/setup_popup.php">팝업관리</a></li>
					<li><a href="<?php echo G5_MANAGE_URL?>/visit_list.php">접속통계</a>
						<ul class="">
							<li><a href="<?php echo G5_MANAGE_URL?>/visit_list.php">접속자</a></li>
							<li><a href="<?php echo G5_MANAGE_URL?>/visit_domain.php">도메인</a></li>
							<li><a href="<?php echo G5_MANAGE_URL?>/visit_browser.php">브라우저</a></li>
							<li><a href="<?php echo G5_MANAGE_URL?>/visit_os.php">OS</a></li>
							<li><a href="<?php echo G5_MANAGE_URL?>/visit_hour.php">시간</a></li>
							<li><a href="<?php echo G5_MANAGE_URL?>/visit_week.php">요일</a></li>
							<li><a href="<?php echo G5_MANAGE_URL?>/visit_date.php">일</a></li>
							<li><a href="<?php echo G5_MANAGE_URL?>/visit_month.php">월</a></li>
							<li><a href="<?php echo G5_MANAGE_URL?>/visit_year.php">년</a></li>
						</ul>
					</li>

				<?php }else if(preg_match("/\/shop_admin\//", $PHP_SELF)){?>
				    <li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/orderlist.php">주문관리</a></li>
                    <li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/categorylist.php">분류관리</a></li>
                    <li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/itemlist.php">상품관리</a></li>
                    <li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/itemqalist.php">상품문의</a></li>
                    <li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/itemuselist.php">사용후기</a></li>
                    <li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/itemstocklist.php">상품재고관리</a></li>
                    <li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/itemtypelist.php">상품유형관리</a></li>
                    <li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/couponlist.php">쿠폰관리</a></li>
                    <li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/sendcostlist.php">추가배송비관리</a></li>
                    <li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/configform.php">쇼핑몰설정</a></li>
				<?php }else if($category_title == "회원관리"){ ?>
					<li><a href="<?php echo G5_MANAGE_URL?>/member_list.php">회원관리</a></li>				
				<?php } ?>
			</ul>
			<ul class="side_ctr">
				<li><a href="#n" class="btn_close_menu">메뉴닫기</a></li>
				<li><a href="#n" class="btn_open_menu">메뉴열기</a></li>
			</ul>
		</div>

		<div class="cnt_area">
			<?php if(isset($sub_title) && $sub_title){ ?>
				<div class="feedback">
					<!--서브 타이틀-->
					<h3 class="h3_label"><?php echo $sub_title?></h3>
					<?php if(isset($sub_explan) && $sub_explan){ ?>
						<div class="user_guide">
							<ul class="">
								<li><?php echo $sub_explan?></li>
							</ul>
						</div>
					<?php } ?>
				</div>
			<?php } ?>