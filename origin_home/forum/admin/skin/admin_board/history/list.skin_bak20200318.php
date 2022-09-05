<?php
	if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
	include_once(G5_LIB_PATH.'/thumbnail.lib.php');

	// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
	add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

	$g5['title'] = "환경설정 > 인피아드 관리자모드";	//title
	$category_title = "제품소개";	//카테고리 제목
	$sub_title = "제품관리";	//서브 타이틀
?>

<!-- 게시판 목록 시작 { -->
<div id="bo_gall" style="width:<?php echo $width; ?>">
	<!-- 분류 -->
	<?php if ($is_category) { ?>
		<nav id="bo_cate">
			<h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
			<ul id="bo_cate_ul">
				<?php echo $category_option ?>
			</ul>
		</nav>
	<?php } ?>

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
			<a href="#n" class="cate_btn btn_normal" onclick="layer_board('<?=$board[bo_subject]?> 분류수정','./board_cate.php?bo_table=<?=$bo_table?>');">분류수정</a>
		</div>
	</div>
	<!-- } 게시판 페이지 정보 및 버튼 끝 -->
	
	<form name="fboardlist"  id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
		<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
		<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
		<input type="hidden" name="stx" value="<?php echo $stx ?>">
		<input type="hidden" name="spt" value="<?php echo $spt ?>">
		<input type="hidden" name="sst" value="<?php echo $sst ?>">
		<input type="hidden" name="sod" value="<?php echo $sod ?>">
		<input type="hidden" name="page" value="<?php echo $page ?>">
		<input type="hidden" name="sw" value="">

		<?php if ($is_checkbox) { ?>
			<div id="gall_allchk">
				<input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">
				<label for="chkall" class="">현재 페이지 게시물 전체</label>
			</div>
		<?php } ?>

		<ul id="" class="gallery_area">
			<?php for ($i=0; $i<count($list); $i++) {
				if($i>0 && ($i % $bo_gallery_cols == 0))
					$style = 'clear:both;';
				else
					$style = '';
				if ($i == 0) $k = 0;
				$k += 1;
				if ($k % $bo_gallery_cols == 0) $style .= "margin:0 !important;";
			?>
				<li class="">
					<?php if ($is_checkbox) { ?>
						<label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?></label>
						<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
					<?php } ?>
					<span class="sound_only">
						<?php
							if ($wr_id == $list[$i]['wr_id'])
								echo "<span class=\"bo_current\">열람중</span>";
							else
								echo $list[$i]['num'];
						?>
					</span>
					<ul class="gallery_cnt">
						<li class="">
							<a href="<?php echo $list[$i]['href'] ?>">
								<div class="photo_box">
									<?if($bo_table=="s3_2"){
										if(preg_match("/^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]{11}).*/", $list[$i]['wr_1'], $tmp) && $tmp[2]){
										echo "<img src='http://img.youtube.com/vi/{$tmp[2]}/mqdefault.jpg'  />";
										}
									
									}else{?>
									<?php if ($list[$i]['is_notice']) { // 공지사항 ?>
										<strong style="width:<?php echo $board['bo_gallery_width'] ?>px;height:<?php echo $board['bo_gallery_height'] ?>px">공지</strong>
									<?php } else {
										$thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $board['bo_gallery_width'], '');
										if($thumb['src']) {
											$img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" width="'.$board['bo_gallery_width'].'" height="">';
										} else {
											$img_content = '<span style="width:'.$board['bo_gallery_width'].'px;height:'.$board['bo_gallery_height'].'px"><img src="/img/noimage.gif" alt="" /></span>';
										}
										echo $img_content;
										}
									?>
									<?}?>
								</div>
							</a>
						</li>
						<li class="">
							<a href="<?php echo $list[$i]['href'] ?>">
							<?php echo $list[$i]['subject'] ?>
							<?php if ($list[$i]['comment_cnt']) { ?><span class="sound_only">댓글</span><?php echo $list[$i]['comment_cnt']; ?><span class="sound_only">개</span><?php } ?>
							</a>
							<?php
							?>
						</li>
						<li><span class="gall_subject">순서 </span><input type="text" class="frm_input" value="<?php echo $list[$i]['wr_10'] ?>" onkeyup="chenge_order('<?=$bo_table?>','<?=$list[$i][wr_id]?>','wr_10',this.value);"></li>
					</ul>
				</li>
			<?php } ?>
			<?php if (count($list) == 0) { echo "<li class=\"empty_list\">게시물이 없습니다.</li>"; } ?>
		</ul>

		<?php if ($list_href || $is_checkbox || $write_href) { ?>
			<div class="btn_area">
				<?php if ($is_checkbox) { ?>
					<div class="btn_area_left">
						<input type="submit" name="btn_submit" value="선택삭제" class="btn_normal" onclick="document.pressed=this.value">
					</div>
				<?php } ?>
				<?php if ($list_href || $write_href) { ?>
					<div class="btn_area_right">
						<?php if ($list_href) { ?><a href="<?php echo $list_href.'&sca='.$sca ?>" class="btn_normal">목록</a><?php } ?>
						<?php if ($write_href) { ?><a href="<?php echo $write_href.'&sca='.$sca ?>" class="btn_normal">등록</a><?php } ?>
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
					<option value="wr_subject"<?php echo get_selected($sfl, 'wr_subject', true); ?>>연도<!-- 제목 --></option>
					<option value="wr_content"<?php echo get_selected($sfl, 'wr_content'); ?>>내용</option>
					<option value="wr_subject||wr_content"<?php echo get_selected($sfl, 'wr_subject||wr_content'); ?>>연도<!-- 제목 -->+내용</option>
				</select>
				<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
				<input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="">
				<input type="submit" value="검색" class="">
			</form>
		</fieldset>
	</div>
<!-- } 게시판 검색 끝 -->

<script>
function chenge_order(bo,id,fild,val){
$.post("<? echo G5_URL ?>/admin/change_ajax.php", {bo:bo,id:id,fild:fild,val:val}, function(rst){
	console.log(rst);
		});
}
</script>
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

<script>
function layer_board(names,src){
	document.getElementById("layer").innerHTML="<iframe src="+src+"  id='layer_frame' onLoad='iframe_resize(this)'  frameborder=0 scrolling=yes></iframe>";
		var w=600;
		var h=100;
	$(".layer_popup").dialog({
		resizable : false,
		width : 700,
		height : 180,
		dialogClass : false,
		modal : false,
		title : names,
		position : {
		my : "center center",
		at : "center center",
			of : window
		},
		open: function(event,ui){
			
		},
		close: function(event,ui){
			document.getElementById("layer").innerHTML="";
			location.reload();
		 }
	});
}
</script>
<!-- } 게시판 목록 끝 -->