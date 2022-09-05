<?php
	if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
	include_once(G5_LIB_PATH.'/thumbnail.lib.php');
	include_once(G5_THEME_LIB_PATH.'/thumbnail2.lib.php');
	// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
	add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);


?>


<!-- 게시판 목록 시작 -->
<div class="bo_wrap_1 ct1">
<div id="bo_gall" class="">
	<!-- <?php if ($is_category) { ?>
		<nav id="bo_cate">
			<h2><?php echo ($board['bo_mobile_subject'] ? $board['bo_mobile_subject'] : $board['bo_subject']) ?> 카테고리</h2>
			<ul id="bo_cate_ul">
				<?php echo $category_option ?>
			</ul>
		</nav>
	<?php } ?> -->
	<form name="fboardlist"  id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
		<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
		<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
		<input type="hidden" name="stx" value="<?php echo $stx ?>">
		<input type="hidden" name="spt" value="<?php echo $spt ?>">
		<input type="hidden" name="sst" value="<?php echo $sst ?>">
		<input type="hidden" name="sod" value="<?php echo $sod ?>">
		<input type="hidden" name="page" value="<?php echo $page ?>">
		<input type="hidden" name="sw" value="">

		<h2>이미지 목록</h2>

		<ul id="gall_ul">
			<?php for ($i=0; $i<count($list); $i++) {?>
				<li class="gall_li <?php if ($wr_id == $list[$i]['wr_id']) { ?>gall_now<?php } ?>">
				<!-- 	<?php if ($is_checkbox) { ?>
						<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
						<label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?></label>
					<?php } ?> -->
					<span class="sound_only">
						<?php
							if ($wr_id == $list[$i]['wr_id'])
								echo "<span class=\"bo_current\">열람중</span>";
							else
								echo $list[$i]['num'];
						?>
					</span>
					<div class="gall_con">
						<div class="gall_href">
							<a href="<?php echo $list[$i]['href'] ?>">
								<?php if ($list[$i]['is_notice']) { // 공지사항 ?>
									<strong style="width:<?php echo $board['bo_mobile_gallery_width'] ?>px;height:<?php echo $board['bo_mobile_gallery_height'] ?>px">공지</strong>
								<?php } else {
									$thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $board['bo_mobile_gallery_width'], $board['bo_mobile_gallery_height']);
									if($thumb['src']) {
										$img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" width="'.$board['bo_mobile_gallery_width'].'" height="'.$board['bo_mobile_gallery_height'].'" class="bd_img">';
									} else {
										$noimg = $board_skin_path.'/img/no_img.gif';
										$img_content = '<span>'.get_noimage_thumbnail($bo_table, $noimg, $board['bo_mobile_gallery_width'], $board['bo_mobile_gallery_height']).'</span>';
									}
									echo $img_content;
								}?>
						</div>
						<div class="gall_text_href">
							<h5 class="subject"><?php echo $list[$i]['subject'] ?></h5>	
							<!-- <p class="data"><?php echo $list[$i]['datetime'] ?></p> -->
							<!-- <p class="cate"><?php echo $list[$i]['ca_name'] ?></p> -->
						</div>
					</div>
					</a>
				</li>
			<?php } ?>
			<?php if (count($list) == 0) { echo "<li class=\"empty_list\">게시물이 없습니다.</li>"; } ?>
		</ul>

		<?php if ($list_href || $is_checkbox || $write_href) { ?>
			<div class="bo_fx">
				<!-- <ul class="btn_bo_adm">
					<?php if ($list_href) { ?>
						<li><a href="<?php echo $list_href ?>" class="btn_b01"> 목록</a></li>
					<?php } ?>
				</ul> -->
				<ul class="btn_bo_user">
					<li><?php if ($write_href) { ?><a href="<?php echo $write_href ?>" class="btn_blue">글쓰기</a><?php } ?></li>
				</ul>
			</div>
		<?php } ?>
	</form>
</div>

<!-- 레이어 팝업 -->
<div class="view_gallery_box"></div>

<?php if($is_checkbox) { ?>
	<noscript>
		<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
	</noscript>
<?php } ?>

<!-- 페이지 -->
<?php echo $write_pages; ?>

<!-- <div class="bd_search">
	<fieldset id="bo_sch">
		<legend>게시물 검색</legend>

		<form name="fsearch" method="get">
			<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
			<input type="hidden" name="sca" value="<?php echo $sca ?>">
			<input type="hidden" name="sop" value="and">

			<label for="sfl" class="sound_only">검색대상</label>
			<select name="sfl" id="sfl" class="select_ty">
				<option value="wr_subject"<?php echo get_selected($sfl, "wr_subject", true); ?>>제목</option>
				<option value="wr_content"<?php echo get_selected($sfl, "wr_content"); ?>>내용</option>
				<option value="wr_subject||wr_content"<?php echo get_selected($sfl, "wr_subject||wr_content"); ?>>제목+내용</option>
			</select>
			<input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" placeholder="검색어"  id="stx" class="input_ty" size="12" maxlength="20">
			<input type="submit" value="검색" class="btn_search">
		</form>
	</fieldset>
</div> -->

<script>
	$(window).on("load", function() {
		$("#gall_ul").fancyList(".gall_li", "gall_clear");
	});
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
	$(document).ready(function(){
		$(".view_gallery111").bind("click",function(){
			$(".view_gallery_box").dialog({
				title : "레이어 팝업",
				draggable : false,
				maxWidth : 600,
				maxHeight : 600,
				minWidth : 300,
				minHeight : 300,
				modal : true
			});
		});
	});

	function view_gallery(val1,val2) {
		$(".view_gallery_box").empty().append("<img src='"+val2+"' Width=500 alt=''>");
		$(".view_gallery_box").dialog({
			title : val1,
			draggable : false,
			maxWidth : 600,
			maxHeight : 600,
			minWidth : 600,
			minHeight : 600,
			modal : true
		});
	}
</script>
<!-- 게시판 목록 끝 -->
</div>


