<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

$ca = get_ca_menu(1, $bo_table, '');
?>



<form name="fsearch" method="get">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sop" value="and">

	<div class="status_area">
		<div class="status_area_left">
			<select id="ca" name="caid" title="" onchange='$("form[name=\"fsearch\"]").submit()'>
				<option value="">전체</option>
				<?php

				//분류목록
				foreach($ca as $ca_info){

					$selected = "";

					if($caid == $ca_info->get_ca_id())
						$selected = "selected";

					echo "<option value='{$ca_info->get_ca_id()}' $selected >{$ca_info->get_ca_name()}</option>";
				}

				?>
			</select>
		</div>
		<div class="status_area_right">
			<select id="sfl" name="sfl" title="">
				<option value="wr_subject">메뉴명</option>
				<option value="wr_2">가격</option>
				<option value="wr_content">내용</option>
			</select>
			<input type="text" id="stx" name="stx" value="<?php echo stripslashes($stx)?>" />
			<button type="submit" class="btn_small2">검색</button>
		</div>
	</div>
</form>


<!-- 게시판 목록 시작 { -->

<form name="fboardlist"  id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">

	<div id="gall_allchk">
        <label for="chkall" class="sound_only">현재 페이지 게시물 전체</label>
        <input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);">
    </div>


	<div class="gallery_area">

		<?php for ($i=0; $i<count($list); $i++) {
            if($i>0 && ($i % $bo_gallery_cols == 0))
                $style = 'clear:both;';
            else
                $style = '';
            if ($i == 0) $k = 0;
            $k += 1;
            if ($k % $bo_gallery_cols == 0) $style .= "margin:0 !important;";

			$thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height']);

			if($thumb['src']) {
				$img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" width="'.$board['bo_gallery_width'].'" height="'.$board['bo_gallery_height'].'">';
			} else {
				$img_content = '<span style="width:'.$board['bo_gallery_width'].'px;height:'.$board['bo_gallery_height'].'px">no image</span>';
			}

         ?>


		<div class="gallery_box">
			<span class="check_box">
				<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">

				<label for="" class="hide">선택</label>
			</span>
			<div class="photo_box">
				<div class="photo">
					<a href="./write.php?bo_table=<?php echo $bo_table?>&w=u&wr_id=<?php echo $list[$i]['wr_id'] .'&' . $qstr?>"><img src='<?php echo $thumb['src'] ?>' /></a>
				</div>
			</div>
			<div class="txt_box">
				<p class="subject"><?php echo $list[$i]['subject']?></p>
				<div class="txt_box_left">
					<?php if($list[$i]['wr_3'] != "1"){?>
						가격 : <?php echo number_format($list[$i]['wr_2']);?>원
					<?php } else {?>
						&nbsp;
					<?php }?>
				</div>
				<div class="txt_box_right">
					추천수 : <?php echo $list[$i]['wr_good']?>
				</div>
			</div>
		</div>

		<?php } ?>

		<?php if (count($list) == 0) { echo "<div class=\"empty_list center\">게시물이 없습니다.</div>"; } ?>

	</div>

	<div class="btn_area">
		<div class="btn_area_left">
			<button type="submit" name="btn_submit" class="btn_normal" value="선택삭제" onclick="document.pressed=this.value" >선택삭제</button>
		</div>
		<div class="btn_area_right">
			<button type="button" id="" name="" class="btn_normal" onclick="location.href='<?php echo $write_href ?>'">메뉴등록</button>
		</div>
	</div>
</form>



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
<!-- } 게시판 목록 끝 -->
