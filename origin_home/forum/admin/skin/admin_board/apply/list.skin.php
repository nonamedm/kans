<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 6;

if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<h4 class="h4_label">예약자 목록</h4>

<!-- 게시판 목록 시작 { -->
<div id="bo_list" style="width:<?php echo $width; ?>">

    <!-- 게시판 카테고리 시작 { -->
    <?php if ($is_category) { ?>
    <nav id="bo_cate">
        <h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
        <ul id="bo_cate_ul">
            <?php echo $category_option ?>
        </ul>
    </nav>
    <?php } ?>
    <!-- } 게시판 카테고리 끝 -->

    <!-- 게시판 페이지 정보 및 버튼 시작 { -->
    <div class="bo_fx">
        <div id="bo_list_total">
            <span>Total <?php echo number_format($total_count) ?>건</span>
            <?php echo $page ?> 페이지
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

	<table class="horizen">
		<colgroup span="6">
			<col width="5%" />
			<col width="15%" />
			<col width="15%" />
			<col width="*" />
			<col width="10%" />
			<col width="10%" />
			<col width="10%" />
		</colgroup>
		<thead>
			<tr>
				<th scope="col">
					<input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">
				</th>
				<th scope="col">예약자</th>
				<th scope="col">핸드폰번호</th>
				<th scope="col">예약일시</th>
				<th scope="col">예약인원</th>
				<th scope="col">작성일자</th>
				<th scope="col">예약상태</th>
			</tr>
		</thead>
		<tbody>
			<?php
			for ($i=0; $i<count($list); $i++) {
				$list[$i]['href'] = G5_MANAGE_URL . "/board.php?bo_table=$bo_table&wr_id=" . $list[$i]['wr_id'] . $qstr;
			 ?>
			<tr>
				<td class="">
					<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>" />
				</td>
				<td class=""><a href="<?php echo $list[$i]['href']?>"><?php echo $list[$i]['name']?></a></td>
				<td class=""><?php echo get_text($list[$i]['wr_6'])?></td>
				<td class=""><?php echo get_text($list[$i]['wr_2'])?> <?php echo $list[$i]['wr_3'] ?></td>
				<td class=""><?php echo $list[$i]['wr_4']?></td>
				<td class=""><?php echo $list[$i]['datetime']?></td>
				<td class="">
					<select id="wr_10_<?php echo $i?>" name="wr_10[<?php echo $list[$i]['wr_id']?>]" title="">
						<option value="j" <?php echo ($list[$i]['wr_10'] == "j" || $list[$i]['wr_10'] == "")? "selected" : ""?>>접수</option>
						<option value="f" <?php echo ($list[$i]['wr_10'] == "f")? "selected" : ""?> >확정</option>
						<option value="c" <?php echo ($list[$i]['wr_10'] == "c")? "selected" : ""?>>취소</option>
					</select>
				</td>
			</tr>
			<?php } ?>
			<?php if (count($list) == 0) { echo '<tr><td colspan="'.$colspan.'" class="empty_table">게시물이 없습니다.</td></tr>'; } ?>
		</tbody>
	</table>
	<div class="btn_area">
		<div class="btn_area_left">
			<button type="submit" class="btn_normal" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value">선택삭제</button>
		</div>
		<div class="btn_area_center">
			<div class="paging">
				<?php 
				$write_pages = str_replace("처음", "&lt;&lt;", $write_pages);
				$write_pages = str_replace("이전", "&lt;", $write_pages);
				$write_pages = str_replace("다음", "&gt;", $write_pages);
				$write_pages = str_replace("맨끝", "&gt;&gt;", $write_pages);
				//$write_pages = preg_replace("/<span>([0-9]*)<\/span>/", "$1", $write_pages);
				$write_pages = preg_replace("/<b>([0-9]*)<\/b>/", "<strong class='current'>$1</strong>", $write_pages);
				?>
				<?php echo $write_pages;  ?>
			</div>
		</div>
		<div class="btn_area_right">
			<button type="button" class="btn_normal" name="btn_submit" onclick="location.href='<?php echo $write_href;?>'">글쓰기</button>
		</div>
	</div>
    
    </form>
</div>

<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>



<!-- 게시판 검색 시작 { -->

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

	if(document.pressed == "선택변경") {
		f.removeAttribute("target");
        f.action = "./reserve_change_status.php";

        return;
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
