<?php
	include_once "./_common.php";
	include_once(G5_EDITOR_LIB);
	/**
	 *	해당페이지 타이틀 및 기본 노출 설정
	 */
	$g5['title'] = "소개 > 인피아드 관리자모드";	//title
	$category_title = "소개";	//카테고리 제목
	$sub_title = "소개";	//서브 타이틀
	$sub_explan = ""; //페이지 설명

	include_once G5_MANAGE_INCLUDE_PATH . "/admin_header.php";

	if(!sql_query(" DESCRIBE {$g5['introduce_table']} ", false)){
		sql_query("CREATE TABLE `g5_introduce` (
		  `in_file_so` varchar(255) NOT NULL DEFAULT '',
		  `in_file` varchar(255) NOT NULL DEFAULT '',
		  `in_content` text NOT NULL,
		  `in_youtube` varchar(512) NOT NULL DEFAULT '',
		  `in_use_video` tinyint(1) NOT NULL
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
	}

$result = sql_query(" select * from {$g5['introduct_table']} limit 1 ");
if(sql_num_rows($result) < 1)
	sql_query(" insert into {$g5['introduct_table']} SET in_use_video = '' ");

$write = sql_fetch(" select * from {$g5['introduct_table']} limit 1 ");

?>
<form name="fwrite" method="post" enctype="multipart/form-data" onsubmit="return fwrite_submit();" >
	<input type="hidden" name="token" />

	<table class="vertical">
		<colgroup span="4">
			<col width="15%">
			<col width="35%">
			<col width="15%">
			<col width="35%">
		</colgroup>
		<tr>
			<th scope="row">대표이미지</th>
			<td colspan="3" class="">
				<?php if($write['in_file']){?>
					<?php

					echo get_text($write['in_file_so']) . " 삭제하려면 체크하십시오";
					echo "<input type='checkbox' name='chk_del_file' value='1' /> <br />"

					?>
				<?php }?>
				<input type="file" id="file_0" name="so_file[]" />
			</td>
		</tr>
		<tr>
			<th scope="row">소개</th>
			<td colspan="3" class="">				
				<?php echo editor_html('in_content', get_text($write['in_content'], 0)); ?>
			</td>
		</tr>
		<tr>
			<th scope="row" rowspan="2">동영상관리</th>
			<td colspan="3" class="">
				<input type="text" id="in_youtube" name="in_youtube" value="<?php echo $write['in_youtube']?>" placeholder="Youtube의 주소를 입력하세요" class="w100">
			</td>
		</tr>
		<tr>
			<td colspan="3" class="">
			<span class="mr20">
				<input type="radio" id="in_use_video_y" name="in_use_video" <?php if($write['in_use_video'] == "1") echo "checked";?> value="1" />
				<label for="in_use_video_y">사용함</label>
			</span>
			<span class="">
				<input type="radio" id="in_use_video_n" name="in_use_video" <?php if($write['in_use_video'] == "0") echo "checked";?> value="0" />
				<label for="in_use_video_n">사용안함</label>
			</span>
			</td>
		</tr>
	</table>

	<div class="btn_area">
		<div class="btn_area_right">
			<button type="submit" id="btn_submit" name="btn_submit" class="btn_normal">작성완료</button>
		</div>
	</div>

</form>

<script>
	function fwrite_submit() {

		<?php echo get_editor_js('in_content'); ?>
	    <?php echo chk_editor_js('in_content'); ?>

		$("input[name='token']").val(get_ajax_token());
		$("form[name='fwrite']").prop("action", "./introduction_update.php");

		return true;
	};
</script>

<?php
include_once G5_MANAGE_INCLUDE_PATH . "/admin_footer.php";
?>