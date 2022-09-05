<?php
	$bo_table = "s2_1";
	
	include_once "./_common.php";
	$category_title = "파일관리";	//카테고리 제목
	$sub_title = "브로셔 & 영상 등록";	//서브 타이틀
	include_once G5_MANAGE_INCLUDE_PATH . "/admin_header.php";

	if(!sql_query(" DESCRIBE {$g5['design_file_table']} ", false)) {
		sql_query("CREATE TABLE `{$g5['design_file_table']}` (
				`ds_so` varchar(255) NOT NULL DEFAULT '',
				`ds_file` VARCHAR(255) NOT NULL DEFAULT '',
				`ds_no` INT DEFAULT 0
			) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
	}

	$result = sql_query(" select * from {$g5['design_table']} limit 1 ");
	if(sql_num_rows($result) < 1)
		sql_query("insert into {$g5['design_table']} SET ds_url1 = '' ");

	$write = sql_fetch(" select * from $g5[design_table] limit 1");

	//첨부파일들
	$file_result = sql_query(" select * from $g5[design_file_table] ORDER BY ds_no ASC ");
	for($i = 0; $file = sql_fetch_array($file_result); $i++){
		$write['file'][$file['ds_no']] = $file;
	}
	
	$file_path = G5_URL . "/data/file/prod_file";
	$directory_path = "../data/file/prod_file";
?>
<div class="local_ov01 local_ov">
    국문
</div>
<form enctype="multipart/form-data" name="fwrite" method="post" onsubmit="return fwrite_submit(this);">
<div class="table_outline">
	<table class="horizen vertical">
		<col width="150" />
		<col width="150" />
		<col width="*" />
		<tbody>
			<tr>
				<th rowspan="3">플랜트설비</th>
				<th>브로셔</th>
				<td>
				<input type="file" name="ds_file[1]" id="main_image_1" class="frm_file frm_input">
				<?php
					if($write['file'][1]['ds_file']){
						echo get_text($write['file'][1]['ds_so']) . "&nbsp;";
						echo "<input type='checkbox' name='chk_file_del[1]' value='1' /> ";
						echo "&nbsp; 체크박스를 체크하시면 파일이 삭제됩니다.";
					}
				?>
				</td>
			</tr>
			<tr>
				<th>유튜브영상1</th>
				<td><input type="text" name="ds_url1" id="ds_url1" value="<?php echo $write['ds_url1'] ?>" size="100" class="frm_file frm_input"></td>
			</tr>
			<tr>
				<th>유튜브영상2</th>
				<td><input type="text" name="ds_url2" id="ds_url2" value="<?php echo $write['ds_url2'] ?>" size="100" class="frm_file frm_input"></td>
			</tr>

			<tr class="line">
				<th>정부사업제안</th>
				<th>브로셔</th>
				<td>
				<input type="file" name="ds_file[2]" id="main_image_2" class="frm_file frm_input">
				<?php
					if($write['file'][2]['ds_file']){
						echo get_text($write['file'][2]['ds_so']) . "&nbsp;";
						echo "<input type='checkbox' name='chk_file_del[2]' value='2' /> ";
						echo "&nbsp; 체크박스를 체크하시면 파일이 삭제됩니다.";
					}
				?>
				</td>
			</tr>
			<tr class="line">
				<th rowspan="2">성적서</th>
				<th>영상1</th>
				<td><input type="text" name="ds_url3" id="ds_url3" value="<?php echo $write['ds_url3'] ?>" size="100" class="frm_file frm_input"></td>
			</tr>
			<tr>
				<th>영상2</th>
				<td><input type="text" name="ds_url4" id="ds_url4" value="<?php echo $write['ds_url4'] ?>" size="100" class="frm_file frm_input"></td>
			</tr>
		</tbody>
	</table>
</div>
<div class="local_ov01 local_ov">
    영문
</div>
<div class="table_outline">
	<table class="horizen vertical">
		<col width="150" />
		<col width="150" />
		<col width="*" />
		<tbody>
			<tr>
				<th rowspan="3">플랜트설비</th>
				<th>브로셔</th>
				<td>
				<input type="file" name="ds_file[3]" id="main_image_3" class="frm_file frm_input">
				<?php
					if($write['file'][3]['ds_file']){
						echo get_text($write['file'][3]['ds_so']) . "&nbsp;";
						echo "<input type='checkbox' name='chk_file_del[3]' value='3' /> ";
						echo "&nbsp; 체크박스를 체크하시면 파일이 삭제됩니다.";
					}
				?>
				</td>
			</tr>
			<tr>
				<th>유튜브영상1</th>
				<td><input type="text" name="ds_url5" id="ds_url5" value="<?php echo $write['ds_url5'] ?>" size="100" class="frm_file frm_input"></td>
			</tr>
			<tr>
				<th>유튜브영상2</th>
				<td><input type="text" name="ds_url6" id="ds_url6" value="<?php echo $write['ds_url6'] ?>" size="100" class="frm_file frm_input"></td>
			</tr>

			<tr class="line">
				<th>정부사업제안</th>
				<th>브로셔</th>
				<td>
				<input type="file" name="ds_file[4]" id="main_image_4" class="frm_file frm_input">
				<?php
					if($write['file'][4]['ds_file']){
						echo get_text($write['file'][4]['ds_so']) . "&nbsp;";
						echo "<input type='checkbox' name='chk_file_del[4]' value='4' /> ";
						echo "&nbsp; 체크박스를 체크하시면 파일이 삭제됩니다.";
					}
				?>
				</td>
			</tr>
			<tr class="line">
				<th rowspan="2">성적서</th>
				<th>영상1</th>
				<td><input type="text" name="ds_url7" id="ds_url7" value="<?php echo $write['ds_url7'] ?>" size="100" class="frm_file frm_input"></td>
			</tr>
			<tr>
				<th>영상2</th>
				<td><input type="text" name="ds_url8" id="ds_url8" value="<?php echo $write['ds_url8'] ?>" size="100" class="frm_file frm_input"></td>
			</tr>
		</tbody>
	</table>
</div>

<div class="btn_area">
	<div class="btn_area_right">
		<button type="submit" class="btn_normal" onclick="submit_form();">저장</button>
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