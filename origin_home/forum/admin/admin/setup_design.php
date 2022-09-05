<?php
	include_once "./_common.php";
	include_once G5_PATH . "/lib/Thumbnail.class.php";

	/**
	 *	해당페이지 타이틀 및 기본 노출 설정
	 */
	$g5['title'] = "환경설정 > 인피아드 관리자모드";	//title
	$category_title = "환경설정";	//카테고리 제목
	$sub_title = "디자인 관리";	//서브 타이틀
	$sub_explan = "홈페이지의 디자인 영역에 대한 수정이 가능합니다."; //페이지 설명

	include_once G5_MANAGE_INCLUDE_PATH . "/admin_header.php";

?>

<form enctype="multipart/form-data" name="fwrite" method="post" onsubmit="return fwrite_submit(this);">
	<input type="hidden" name="token" value="" />
	<h4 class="h4_label">상단 디자인 변경</h4>
	<table class="vertical mb20">
		<colgroup span="4">
			<col width="15%" />
			<col width="35%" />
			<col width="15%" />
			<col width="35%" />
		</colgroup>
		<tr>
			<th scope="row">상단색상</th>
			<td colspan="3" class="">
				<div class="fields">
					<div>
						<!--
						<input type="text" name="top_color" id="top_color" value="<?php echo $write['ds_color']?>" />
						-->
						<style type="text/css">
							.colorpicker { position:absolute; left:0; margin-top:7px; background:#fff; border:1px solid #ddd; box-shadow:3px 3px 4px rgba(0,0,0,0.5); }
						</style>
						<div id="cp2" class="input-group colorpicker-component">
							<input type="text" name="top_color"  value="<?php echo $write['ds_color']?>" class="form-control" />
							<span class="input-group-addon"><i></i></span>
						</div>
						<script>
							$(function() {
								$('#cp2').colorpicker();
							});
						</script>
					</div>
				</div>
			</td>
		</tr>
		<tr>
			<th scope="row">로고</th>
			<td colspan="3" class="">
				<div class="mb5">
					<?php if($write['file'][0]['ds_file']){?>
						<?php

						echo get_text($write['file'][0]['ds_so']);
						echo "<input type='checkbox' name='chk_file_del[0]' value='1' /> ";
						echo "&nbsp; 좌측 체크박스를 체크하시면 파일이 삭제됩니다 <br /><br />";

						?>
					<?php }?>
					<input type="file" id="logo" name="ds_file[0]" />
					※ 권장사이즈 : 00px × 00px
				</div>
				<div class="">

				</div>
			</td>
		</tr>
	</table>

	<h4 class="h4_label">이미지 변경</h4>
	<table class="vertical">
		<colgroup span="4">
			<col width="15%" />
			<col width="35%" />
			<col width="15%" />
			<col width="35%" />
		</colgroup>
		<tr>
			<th scope="row" rowspan="5">메인이미지</th>
			<td colspan="3" class="">
				<div class="mb5">
					<?php
					$i = 1;
					if($write['file'][$i]['ds_file']){

					?>
						<?php

						echo get_text($write['file'][$i]['ds_so']) . "&nbsp;";
						echo "<input type='checkbox' name='chk_file_del[1]' value='1' /> ";
						echo "&nbsp; 좌측 체크박스를 체크하시면 파일이 삭제됩니다 <br /><br />";

						?>
					<?php }?>
					<input type="file" id="main_image_1" name="ds_file[1]" />
					※ 권장사이즈 : 00px × 00px
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="3" class="">
				<div class="mb5">
					<?php
					$i = 2;
					if($write['file'][$i]['ds_file']){

						?>
						<?php

						echo get_text($write['file'][$i]['ds_so']) . "&nbsp;";
						echo "<input type='checkbox' name='chk_file_del[2]' value='1' /> ";
						echo "&nbsp; 좌측 체크박스를 체크하시면 파일이 삭제됩니다 <br /><br />";

						?>
					<?php }?>
					<input type="file" id="main_image_2" name="ds_file[2]" />
					※ 권장사이즈 : 00px × 00px
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="3" class="">
				<div class="mb5">
					<?php
					$i = 3;
					if($write['file'][$i]['ds_file']){

						?>
						<?php

						echo get_text($write['file'][$i]['ds_so']) . "&nbsp;";
						echo "<input type='checkbox' name='chk_file_del[3]' value='1' /> ";
						echo "&nbsp; 좌측 체크박스를 체크하시면 파일이 삭제됩니다 <br /><br />";

						?>
					<?php }?>
					<input type="file" id="main_image_3" name="ds_file[3]" />
					※ 권장사이즈 : 00px × 00px
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="3" class="">
				<?php
				$i = 4;
				if($write['file'][$i]['ds_file']){

					?>
					<?php

					echo get_text($write['file'][$i]['ds_so']) . "&nbsp;";
					echo "<input type='checkbox' name='chk_file_del[4]' value='1' /> ";
					echo "&nbsp; 좌측 체크박스를 체크하시면 파일이 삭제됩니다 <br /><br />";

					?>
				<?php }?>
				<div class="mb5">
					<input type="file" id="main_image_4" name="ds_file[4]" />
					※ 권장사이즈 : 00px × 00px
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="3" class="">
				<div class="mb5">
					<?php
					$i = 5;
					if($write['file'][$i]['ds_file']){

						?>
						<?php

						echo get_text($write['file'][$i]['ds_so']) . "&nbsp;";
						echo "<input type='checkbox' name='chk_file_del[5]' value='1' /> ";
						echo "&nbsp; 좌측 체크박스를 체크하시면 파일이 삭제됩니다 <br /><br />";

						?>
					<?php }?>
					<input type="file" id="main_image_5" name="ds_file[5]" />
					※ 권장사이즈 : 00px × 00px
				</div>
			</td>
		</tr>
	</table>

	<div class="btn_area">
		<div class="btn_area_left"></div>
		<div class="btn_area_center"></div>
		<div class="btn_area_right">
			<button type="submit" class="btn_normal" onclick="submit_form();">정보변경</button>
		</div>
	</div>
</form>

<script>
	function submit_form() {
		$("form[name='fwrite']").find("input[name='token']").val(get_ajax_token());
		return true;
	}

	function fwrite_submit(f) {

		$("form[name='fwrite']").prop("action", "<?php echo G5_MANAGE_URL?>" + "/setup_design_update.php");

		return true;
	}
</script>

<?php
include_once G5_MANAGE_INCLUDE_PATH . "/admin_footer.php";
?>