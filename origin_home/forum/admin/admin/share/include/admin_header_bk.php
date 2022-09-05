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
						<!--li><a href="<?php echo G5_MANAGE_URL?>/setup_default.php">기본정보</a></li-->
						<li><a href="<?php echo G5_MANAGE_URL?>/site_info.php">사이트설정</a></li>
					</ul>
				</div>
			</li>
			<?if($config[cf_9]){?>
			<li><a href="<?php echo G5_MANAGE_URL?>/member_list.php" class="label">회원관리</a>
				<div class="sn sn2">
					<ul>
						<li><a href="<?php echo G5_MANAGE_URL?>/member_list.php">회원관리</a></li>
					</ul>
				</div>
			</li>
			<?}?>

			<li><a href="<?php echo G5_MANAGE_URL?>/s3.php" class="label">교육신청관리</a>
				<div class="sn sn2">
					<ul>
						<li><a href="<?php echo G5_MANAGE_URL?>/s3.php">교육 일정</a></li>
						<li><a href="<?php echo G5_MANAGE_URL?>/s3_2.php">교육신청관리</a></li>
					</ul>
				</div>
			</li>

			<li><a href="<?php echo G5_MANAGE_URL?>/s4.php" class="label">공간신청관리</a>
				<div class="sn sn2">
					<ul>
						<li><a href="<?php echo G5_MANAGE_URL?>/s4.php">공간신청관리</a></li>
					</ul>
				</div>
			</li>


							<?$bo_gr_query=sql_query(" select gr_id,gr_subject from g5_group order by 	gr_order,gr_id asc") ;
							while($bo_gr=sql_fetch_array($bo_gr_query)){?>
							<?$board_menu_result = sql_fetch(" select bo_table from $g5[board_table] where gr_id='$bo_gr[gr_id]' order by bo_order,bo_table asc ");?>
					<li><a href="<?php echo G5_MANAGE_URL?>/board.php?bo_table=<?php echo $board_menu_result['bo_table']?>" class="label"><?=$bo_gr[gr_subject]?></a>
						<div class="sn sn4">
							<ul>
								<?php
									$board_menu_result = sql_query(" select * from $g5[board_table] where gr_id='$bo_gr[gr_id]' order by bo_order,bo_table asc ");
									while($row = sql_fetch_array($board_menu_result)){
								?>
									<li><a href="<?php echo G5_MANAGE_URL?>/board.php?bo_table=<?php echo $row['bo_table']?>"><?php echo $row['bo_subject']?></a></li>
									<?if($row[bo_table]=="gallery"){?>
									<li><a href="<?php echo G5_MANAGE_URL?>/faqmasterlist.php">자주하는 질문</a></li>
									<?}?>

								<?}?>
							</ul>
						</div>
					</li>
			<?
				}
			?>

			<?if($config[cf_10]){?>
				<li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/" class="label">쇼핑몰관리</a>
					<div class="sn sn2">
						<ul>
							<li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/orderlist.php">주문관리</a></li>
							<!--li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/categorylist.php">분류관리</a></li-->
							<li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/itemlist.php">상품관리</a></li>
							<li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/itemqalist.php">상품문의</a></li>
							<li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/itemuselist.php">사용후기</a></li>
							<li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/itemstocklist.php">상품재고관리</a></li>
							<li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/itemtypelist.php">상품유형관리</a></li>
							<!--li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/couponlist.php">쿠폰관리</a></li-->
							<li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/sendcostlist.php">추가배송비관리</a></li>
							<li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/configform.php">쇼핑몰설정</a></li>
						</ul>
					</div>
				</li>
				<? //쇼핑몰현황 추가 위치 12.23 YK (LINE 71 ~ 80)?>
				<li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/sale1.php" class="label">쇼핑몰현황</a>
					<div class="sn sn2">
						<ul>
							<li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/sale1.php">매출현황</a></li>
							<li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/itemsellrank.php">상품판매순위</a></li>
							<li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/orderprint.php">주문내역출력</a></li>
						</ul>
					</div>
				</li>
			<?}?>
			<li><a href="<?php echo G5_MANAGE_URL?>/setup_popup.php">팝업관리</a></li>
			<li><a href="<?php echo G5_MANAGE_URL?>/visit_list.php">접속통계</a></li>
			<? if($_SERVER["REMOTE_ADDR"]=="211.170.81.198"){ ?>
				<li><a href="<?php echo G5_MANAGE_URL?>/share/document/list.php" class="label">페이지소스</a>
				</li>
			<?}?>
			<li class="manage"><a href="http://inpiad.net" target="_blank">유지관리요청</a></li>
		</ul>
	</div>
</div>
<?php
	if(preg_match("/\/shop_admin\//", $PHP_SELF)){
		$category_title = "쇼핑몰관리";
		if($sub_menu=="500100" || $sub_menu=="500110"|| $sub_menu=="500120"){
			$category_title = "쇼핑몰현황";
		}
	}
		if($sub_menu == '300700') $category_title="고객센터";
?>
<div id="body">
	<div class="b_inner">
		<div class="side_bar">
			<!--카테고리 타이틀-->
			<h2 class="h2_label"><?php echo $category_title; ?></h2>
			<ul class="ln">
				<?php if($category_title=="환경설정"){?>
					<li><a href="<?php echo G5_MANAGE_URL?>/setup_admin.php">관리자정보</a></li>
					<!--<li><a href="<?php echo G5_MANAGE_URL?>/setup_default.php">기본정보</a></li>-->
					<li><a href="<?php echo G5_MANAGE_URL?>/site_info.php">사이트설정</a></li>
				<?php }else if(preg_match("/\/shop_admin\//", $PHP_SELF)){?>
				<?php if($sub_menu=="500100" || $sub_menu=="500110"||$sub_menu=="500120"){?>
					<li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/sale1.php">매출현황</a></li>
					<li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/itemsellrank.php">상품판매순위</a></li>
					<li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/orderprint.php">주문내역출력</a></li>
				<?}else{?>
				    <li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/orderlist.php">주문관리</a></li>
                    <!--li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/categorylist.php">분류관리</a></li-->
                    <li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/itemlist.php">상품관리</a></li>
                    <li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/itemqalist.php">상품문의</a></li>
                    <li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/itemuselist.php">사용후기</a></li>
                    <li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/itemstocklist.php">상품재고관리</a></li>
                    <li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/itemtypelist.php">상품유형관리</a></li>
                    <!--li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/couponlist.php">쿠폰관리</a></li-->
                    <li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/sendcostlist.php">추가배송비관리</a></li>
                    <li><a href="<?php echo G5_MANAGE_URL?>/shop_admin/configform.php">쇼핑몰설정</a></li>
				<? } ?>
				<?php }else if($category_title == "회원관리"){ ?>
					<li><a href="<?php echo G5_MANAGE_URL?>/member_list.php">회원관리</a></li>
						<?}else if($bo_table){
					$board_menu_result = sql_query(" select * from $g5[board_table] where gr_id='$group[gr_id]' order by bo_order,bo_table asc ");
					while($row = sql_fetch_array($board_menu_result)){
				?>
					<li><a href="<?php echo G5_MANAGE_URL?>/board.php?bo_table=<?php echo $row['bo_table']?>"><?php echo $row['bo_subject']?></a></li>
						<?if($row[bo_table]=="gallery"){?>
									<li><a href="<?php echo G5_MANAGE_URL?>/faqmasterlist.php">자주하는 질문</a></li>
									<?}?>
				<?
					}
				?>
				<?php }else if($sub_menu == '300700'){
						$board_menu_result = sql_query(" select * from $g5[board_table] where gr_id='board' order by bo_order,bo_table asc ");
									while($row = sql_fetch_array($board_menu_result)){
								?>
									<li><a href="<?php echo G5_MANAGE_URL?>/board.php?bo_table=<?php echo $row['bo_table']?>"><?php echo $row['bo_subject']?></a></li>
									<?if($row[bo_table]=="gallery"){?>
									<li><a href="<?php echo G5_MANAGE_URL?>/faqmasterlist.php">자주하는 질문</a></li>
									<?}}?>
				<?php }else if($category_title == "쇼핑몰현황"){?>
				    <li><a href="<?php echo G5_MANAGE_URL?>/board.php?bo_table=s2_1&sca=c_1">전문의약품</a></li>
				    <li><a href="<?php echo G5_MANAGE_URL?>/board.php?bo_table=s2_1&sca=c_2">화장품</a></li>
				    <li><a href="<?php echo G5_MANAGE_URL?>/board.php?bo_table=s2_1&sca=c_3">기타품목</a></li>
				<?php }else if($category_title == "팝업관리"){ ?>
					<li><a href="<?php echo G5_MANAGE_URL?>/setup_popup.php">팝업관리</a></li>
				<?php }else if($category_title == "접속통계"){ ?>
					<li><a href="<?php echo G5_MANAGE_URL?>/visit_list.php">접속자</a></li>
					<li><a href="<?php echo G5_MANAGE_URL?>/visit_domain.php">도메인</a></li>
					<li><a href="<?php echo G5_MANAGE_URL?>/visit_browser.php">브라우저</a></li>
					<li><a href="<?php echo G5_MANAGE_URL?>/visit_os.php">OS</a></li>
					<li><a href="http://cpc.inpiad.com/" target="_blank">시피시가드 안내</a></li>
				<?php }else if($category_title == "페이지소스"){ ?>
					<li><a href="<?php echo G5_MANAGE_URL?>/share/document/list.php">일반 BBS 글목록</a></li>
					<li><a href="<?php echo G5_MANAGE_URL?>/share/document/view.php">일반 BBS 글보기</a></li>
					<li><a href="<?php echo G5_MANAGE_URL?>/share/document/write.php">일반 BBS 글쓰기</a></li>

				<?php }else if($category_title == "교육신청관리"){ ?>
						<li><a href="<?php echo G5_MANAGE_URL?>/s3.php">교육 일정</a></li>
						<li><a href="<?php echo G5_MANAGE_URL?>/s3_2.php">교육신청관리</a></li>

				<?php }else if($category_title == "공간신청관리"){ ?>
						<li><a href="<?php echo G5_MANAGE_URL?>/s4.php">공간신청관리</a></li>
				<?php } ?>

				<!--<li>-->
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