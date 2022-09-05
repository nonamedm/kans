<?php
	if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

	// 선택옵션으로 인해 셀합치기가 가변적으로 변함
	$colspan = 5;

	if ($is_checkbox) $colspan++;
	if ($is_good) $colspan++;
	if ($is_nogood) $colspan++;

	// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
	add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>
<!-- 게시판 목록 시작 { -->
<div id="bo_list" style="width:<?php echo $width; ?>">
	<!-- 게시판 페이지 정보 및 버튼 시작 { -->
	<div class="state_area">
		<div class="state_area_left">
			<span>Total <?php echo number_format($total_count) ?>건</span>
			<span><?php echo $page ?> 페이지</span>
		</div>
		<div class="state_area_right">
			<?php if ($rss_href || $write_href) { ?>
				<?php if ($rss_href) { ?><a href="<?php echo $rss_href ?>" class="btns">RSS</a><?php } ?>
			<?php } ?>
		</div>
	</div>
	<!-- } 게시판 페이지 정보 및 버튼 끝 -->

	<form name="fboardlist" id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
		<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
		<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
		<input type="hidden" name="stx" value="<?php echo $stx ?>">
		<input type="hidden" name="spt" value="<?php echo $spt ?>">
		<input type="hidden" name="sca" value="<?php echo $sca ?>">
		<input type="hidden" name="sst" value="<?php echo $sst ?>">
		<input type="hidden" name="sod" value="<?php echo $sod ?>">
		<input type="hidden" name="page" value="<?php echo $page ?>">
		<input type="hidden" name="sw" value="">

		<div class="table_outline">
			<table class="horizen">
				<col width="50" />
				<?php if($is_checkbox){?><col width="50" /><?}?>
				<col width="*" />
				<col width="200" />
				<col width="200" />
				<col width="200" />
				<col width="200" />
				<caption><?php echo $board['bo_subject'] ?> 목록</caption>
				<thead>
					<tr>
						<th scope="col">번호</th>
						<?php if ($is_checkbox) { ?>
							<th scope="col">
								<label for="chkall" class="sound_only">현재 페이지 게시물 전체</label>
								<input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">
							</th>
						<?php } ?>
						<th scope="col">제목</th>
						<th scope="col">작성자</th>
						<th scope="col">이메일</th>
						<th scope="col">연락처</th>
						<th scope="col">신청일</th>
					</tr>
				</thead>
				<tbody>
					<?php for ($i=0; $i<count($list); $i++) { ?>
						<tr class="<?php if ($list[$i]['is_notice']) echo "bo_notice"; ?>">
							<td class="">
								<?php
									if ($list[$i]['is_notice']) // 공지사항
										echo '<strong>공지</strong>';
									else if ($wr_id == $list[$i]['wr_id'])
										echo "<span class=\"bo_current\">열람중</span>";
									else
										echo $list[$i]['num'];
								?>
							</td>
							<?php if ($is_checkbox) { ?>
								<td class="">
									<label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?></label>
									<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
								</td>
							<?php } ?>
							<td class="left">
								<?php
									echo $list[$i]['icon_reply'];
									if ($is_category && $list[$i]['ca_name']) {
								?>
									<a href="<?php echo $list[$i]['ca_name_href'] ?>" class="bo_cate_link"><?php echo $list[$i]['ca_name'] ?></a>
								<?php } ?>
								<a href="<?php echo $list[$i]['href'] ?>">
									<?php echo $list[$i]['subject'] ?>
									<?php if ($list[$i]['comment_cnt']) { ?><span class="sound_only">댓글</span><?php echo $list[$i]['comment_cnt']; ?><span class="sound_only">개</span><?php } ?>
								</a>

								<?php
									// if ($list[$i]['link']['count']) { echo '['.$list[$i]['link']['count']}.']'; }
									// if ($list[$i]['file']['count']) { echo '<'.$list[$i]['file']['count'].'>'; }
									if (isset($list[$i]['icon_new'])) echo $list[$i]['icon_new'];
									if (isset($list[$i]['icon_hot'])) echo $list[$i]['icon_hot'];
									if (isset($list[$i]['icon_file'])) echo $list[$i]['icon_file'];
									if (isset($list[$i]['icon_link'])) echo $list[$i]['icon_link'];
									if (isset($list[$i]['icon_secret'])) echo $list[$i]['icon_secret'];
								?>
							</td>
							<td class=""><?php echo $list[$i]['name'] ?></td>
							<td class=""><?php echo $list[$i]['wr_email'] ?></td>
							<td class=""><?php echo $list[$i]['wr_2'] ?></td>
							<td class=""><?php echo $list[$i]['datetime2'] ?></td>
							<?php if ($is_good) { ?><td class="td_num"><?php echo $list[$i]['wr_good'] ?></td><?php } ?>
							<?php if ($is_nogood) { ?><td class="td_num"><?php echo $list[$i]['wr_nogood'] ?></td><?php } ?>
						</tr>
					<?php } ?>
					<?php if (count($list) == 0) { echo '<tr><td colspan="'.$colspan.'" class="empty_table">게시물이 없습니다.</td></tr>'; } ?>
				</tbody>
			</table>
		</div>

		<?php if ($list_href || $is_checkbox || $write_href) { ?>
			<div class="btn_area">
				<?php if ($is_checkbox) { ?>
					<div class="btn_area_left">
						<input type="submit" name="btn_submit" value="선택삭제" class="btn_normal" onclick="document.pressed=this.value">
					</div>
				<?php } ?>
				<?php if ($list_href || $write_href) { ?>
					<div class="btn_area_right">
						<?php if ($list_href) { ?><a href="<?php echo $list_href ?>" class="btn_normal">목록</a><?php } ?>
						<?php if ($write_href) { ?><!--a href="<?php echo $write_href ?>" class="btn_normal">글쓰기</a--><?php } ?>
					</div>
				<?php } ?>
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
<?php echo $write_pages;  ?>

<!-- 게시판 검색 시작 { -->
	<div class="search_box">
		<fieldset id="">
			<legend>게시물 검색</legend>
			<form name="fsearch" method="get">
				<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
				<input type="hidden" name="sca" value="<?php echo $sca ?>">
				<input type="hidden" name="sop" value="and">
				<label for="sfl" class="sound_only">검색대상</label>
				<select name="sfl" id="sfl">
					<option value="wr_subject"<?php echo get_selected($sfl, 'wr_subject', true); ?>>제목</option>
					<option value="wr_content"<?php echo get_selected($sfl, 'wr_content'); ?>>내용</option>
					<option value="wr_subject||wr_content"<?php echo get_selected($sfl, 'wr_subject||wr_content'); ?>>제목+내용</option>
				</select>
				<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
				<input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="">
				<input type="submit" value="검색" class="">
			</form>
		</fieldset>
	</div>
<!-- } 게시판 검색 끝 -->

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
			if (sw == "copy")
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
<!-- } 게시판 목록 끝 -->