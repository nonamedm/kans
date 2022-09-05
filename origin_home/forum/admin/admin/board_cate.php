<?php
include_once "./_common.php";
include_once(G5_EDITOR_LIB);

include_once G5_MANAGE_INCLUDE_PATH . "/admin.head.sub.php";
?>
<b>※' |' 를 구분자로 분류를 입력해주세요.</b><br>
<b>※이미 등록된 분류의 값은 변하지않습니다.</b><br><br>
	    <form name="fwrite" id="fwrite" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
		    <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
			<input type="hidden"  name="bo_table" value="<?=$bo_table ?>">
			<table class="vertical">
				<colgroup>				
				<col width="15%" />
				<col width="*" />
			</colgroup>
			<thead>
				<tr>					
					<td scope="col"><input type="text" name="bo_category_list" class="w100 frm_input" value="<?=$board[bo_category_list]?>" ></td>
				</tr>
			</thead>
			</table>
		
			<div class="btn_area mt10">
				<div class="btn_area_right">
					<input type="submit" class="btn_normal" value="확인">
				</div>
			</div>
		</form>

<script>
function fwrite_submit(f){
	f.action="./board_cate_update.php";
	return true;
}
</script>