<?php
	if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

	// 선택옵션으로 인해 셀합치기가 가변적으로 변함
	$colspan = 2;

	if ($is_checkbox) $colspan++;

	// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
	add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

	// $write_href = false;
?>

<?php if($bo_table == "newsletter"){ ?>
<div class="head_color" style="background: #8ED663;">
    <h1 class="head_text" style="color:#000 !important;"><?php echo $board['bo_subject'] ?></h1>
	<img class="head_img" src="<?php echo G5_URL;?>/img/소식지.png" title="search">
</div>
<?php } else {?>
<div class="head_color" style="background: #59BCFF;">
    <h1 class="head_text" ><?php echo $board['bo_subject'] ?></h1>
	<img class="head_img" src="<?php echo G5_URL;?>/img/포럼기록.png" title="search">
</div>
<?php } ?>	

<!-- 게시판 목록 시작 -->
<div id="bo_list<?php if ($is_admin) echo "_admin"; ?>" class="respon_l" style="max-width: 1200px; margin: auto;">
	<?php if ($is_category) { ?>
		<nav id="bo_cate">
			<h2><?php echo ($board['bo_mobile_subject'] ? $board['bo_mobile_subject'] : $board['bo_subject']) ?> 카테고리</h2>
			<ul id="bo_cate_ul" class="bd_cate">
				<?php echo $category_option ?>
			</ul>
		</nav>
	<?php } ?>

	<div class="bo_fx">
		<div id="bo_list_total">
			<span>Total <?php echo number_format($total_count) ?>건</span>
			<?php echo $page ?> 페이지
		</div>

		<?php if ($rss_href || $write_href) { ?>
			<ul class="btn_bo_user">
				<?php if ($rss_href) { ?><li><a href="<?php echo $rss_href ?>" class="btn_b01">RSS</a></li><?php } ?>
				<?php if ($admin_href) { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin">관리자</a></li><?php } ?>
				<?php if ($write_href) { ?><!-- <li><a href="<?php echo $write_href ?>" class="btn_b02">글쓰기</a></li> --><?php } ?>
			</ul>
		<?php } ?>
	</div>

	<form name="fboardlist" id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
		<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
		<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
		<input type="hidden" name="stx" value="<?php echo $stx ?>">
		<input type="hidden" name="spt" value="<?php echo $spt ?>">
		<input type="hidden" name="sst" value="<?php echo $sst ?>">
		<input type="hidden" name="sod" value="<?php echo $sod ?>">
		<input type="hidden" name="page" value="<?php echo $page ?>">
		<input type="hidden" name="sw" value="">

		<div class="tb_outline">
			<div class="div_tb">
				<div class="div_tb_tr">
					<div class="div_th col_num">번호</div>
					<!--<?php if ($is_checkbox) { ?>
						<div class="div_th col_check">
							<label for="chkall" class="blind">현재 페이지 게시물 전체</label>
							<input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">
						</div>
					<?php } ?>-->
					<div class="div_th col_subject">제목</div>
				<!--<div class="div_th col_writer">글쓴이</div> -->
					<div class="div_th col_date">날짜</div>
					<div class="div_th col_hit">조회</div>
				</div>
				<?php for ($i=0; $i<count($list); $i++) {?>
					<div class="div_tb_tr <?php if ($list[$i]['is_notice']) echo "bo_notice"; ?>">
						<div class="div_td col_num">
							<?php
								if ($list[$i]['is_notice']) // 공지사항
									echo '<strong>공지</strong>';
								else if ($wr_id == $list[$i]['wr_id'])
									echo "<span class=\"bo_current\">열람중</span>";
								else
									echo $list[$i]['num'];
							?>
						</div>
						<!--<?php if ($is_checkbox) { ?>
							<div class="div_td col_check">
								<label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?></label>
								<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
							</div>
						<?php } ?>-->
						<div class="div_td col_subject">
							<?php
								echo $list[$i]['icon_reply'];
								if ($is_category && $list[$i]['ca_name']) {
							?>
								<a href="<?php echo $list[$i]['ca_name_href'] ?>" class="bo_cate_link">[<?php echo $list[$i]['ca_name'] ?>] </a>
							<?php } ?>

							<a href="<?php echo $list[$i]['href'] ?>">
								<?php echo $list[$i]['subject'] ?>
								<?php if ($list[$i]['comment_cnt']) { ?><span class="sound_only">댓글</span><?php echo $list[$i]['comment_cnt']; ?><span class="sound_only">개</span><?php } ?>
								<?php
								// if ($list[$i]['link']['count']) { echo '['.$list[$i]['link']['count']}.']'; }
								// if ($list[$i]['file']['count']) { echo '<'.$list[$i]['file']['count'].'>'; }

								if (isset($list[$i]['icon_new'])) echo $list[$i]['icon_new'];
								if (isset($list[$i]['icon_hot'])) echo $list[$i]['icon_hot'];
								if (isset($list[$i]['icon_file'])) echo $list[$i]['icon_file'];
								if (isset($list[$i]['icon_link'])) echo $list[$i]['icon_link'];
								if (isset($list[$i]['icon_secret'])) echo $list[$i]['icon_secret'];
								?>
							</a>
						</div>
						<!--<div class="div_td col_writer"><?php echo $list[$i]['name'] ?></div>-->
						<div class="div_td col_date"><?php echo $list[$i]['datetime2'] ?></div>
						<div class="div_td col_hit"><?php echo $list[$i]['wr_hit'] ?></div>
					</div>
				<?php } ?>
			</div>
		</div>
		<?php
			if (count($list) == 0) {
				echo "<div class='div_nodata'>게시물이 없습니다.</div>";
			}
		?>
		<?php if ($list_href || $is_checkbox || $write_href) { ?>
			<div class="bo_fx">
				<ul class="btn_bo_adm">
					<?php if ($list_href) { ?>
						<li><a href="<?php echo $list_href ?>" class="wt_btn"> 목록</a></li>
					<?php } ?>
				</ul>

				<ul class="btn_bo_user2">
					<li><?php if ($write_href) { ?><a href="<?php echo $write_href ?>" class="wt_btn">글쓰기</a><?php } ?></li>
				</ul> 
			</div>
		<?php } ?>
	</form>
</div>

<?php if($is_checkbox) { ?>
	<noscript>
		<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
	</noscript>
<?php } ?>

<!-- 페이지 -->
<?php echo $write_pages; ?>

<div class="bd_search ct1">
	<fieldset id="bo_sch">
		<legend>게시물 검색</legend>

		<form name="fsearch" method="get">
			<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
			<input type="hidden" name="sca" value="<?php echo $sca ?>">
			<input type="hidden" name="sop" value="and">

			<label for="sfl" class="sound_only">검색대상</label>
			<!--<select name="sfl" id="sfl" class="select_ty">
				<option value="wr_subject"<?php echo get_selected($sfl, "wr_subject", true); ?>>제목</option>
				<option value="wr_content"<?php echo get_selected($sfl, "wr_content"); ?>>내용</option>
				<option value="wr_subject||wr_content"<?php echo get_selected($sfl, "wr_subject||wr_content"); ?>>제목+내용</option>
			</select>-->
			<img src="<?php echo G5_URL;?>/img/icons_search.png" title="search" style="margin: 16px;">
			<input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" placeholder="검색어를 입력해 주세요."  id="stx" class="input_ty" size="12" maxlength="20">
			<input type="submit" value="검색" class="btn_search">
		</form>
	</fieldset>
</div>

<?php if ($is_checkbox) { ?>
	<script>
		function all_checked(sw) {
			var f = document.fboardlist;

			for (var i=0; i<f.length; i++) {
				if (f.elements[i].name == "chk_wr_id[]")
					f.elements[i].checked = sw;
			}
		}

		function fboardlist_submit(f) {
			var chk_count = 0;

			for (var i=0; i<f.length; i++) {
				if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
					chk_count++;
			}

			if (!chk_count) {
				alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
				return false;
			}

			if(document.pressed == "선택복사") {
				select_copy("copy");
				return;
			}

			if(document.pressed == "선택이동") {
				select_copy("move");
				return;
			}

			if(document.pressed == "선택삭제") {
				if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
					return false;

				f.removeAttribute("target");
				f.action = "./board_list_update.php";
			}

			return true;
		}

		// 선택한 게시물 복사 및 이동
		function select_copy(sw) {
			var f = document.fboardlist;

			if (sw == 'copy')
				str = "복사";
			else
				str = "이동";

			var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

			f.sw.value = sw;
			f.target = "move";
			f.action = "./move.php";
			f.submit();
		}
	</script>
<?php } ?>
<!-- 게시판 목록 끝 -->