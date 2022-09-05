<?php
	include_once "./_common.php";
	/**
	 *	해당페이지 타이틀 및 기본 노출 설정
	 */
	$g5['title'] = "환경설정 > 인피아드 관리자모드";	//title
	$category_title = "환경설정";	//카테고리 제목
	$sub_title = "약관설정";	//서브 타이틀
	//$sub_explan = "홈페이지에 사용되는 메뉴명 및 노출여부를 설정할 수 있습니다."; //페이지 설명

	include_once G5_MANAGE_INCLUDE_PATH . "/admin_header.php";

	if( !isset($g5['new_win_table']) ){
		die('<meta charset="utf-8">/data/dbconfig.php 파일에 <strong>$g5[\'new_win_table\'] = G5_TABLE_PREFIX.\'new_win\';</strong> 를 추가해 주세요.');
	}

	$table_name = "g5_config";

	$site_config = "select * from $table_name";
	$site_result = sql_query($site_config);
	$site_row = sql_fetch_array($site_result);

?>
<form name="admin_info" method="post" action=<?=$PHP_SELF?> enctype="multipart/form-data">
	<input type="hidden" name="mode" value="update" />

	<div class="table_outline">
		<table class="vertical">
			<col width="200" />
			<col width="" />
			<tbody>
				<?php if($config['cf_9']){ ?>
				<tr>
					<th scope="row" class="left">회원가입약관</th>
					<td class="left">
						<textarea name="cf_stipulation" id="cf_stipulation" rows="10"><?php echo $config['cf_stipulation'] ?></textarea>
					</td>
				</tr>
				<?php } ?>
				<tr>
					<th scope="row" class="left">개인정보처리방침</th>
					<td class="left">
						<textarea name="cf_privacy" id="cf_privacy" rows="10"><?php echo $config['cf_privacy'] ?></textarea>
					</td>
				</tr>
			</tbody>
		</table>
	</div>

	<div class="btn_area">
		<div class="btn_area_right">
			<input type="submit" value="확인" class="btn_normal" />
		</div>
	</div>
	<div class="layer_popup"><iframe src="" name="iframe_area"></iframe></div>
</form>

<?
	if($mode){
		sql_query("update $table_name set cf_stipulation = '{$_POST['cf_stipulation']}', cf_privacy = '{$_POST['cf_privacy']}'");
		alert("약관설정이 변경되었습니다.","$PHP_SELF");
	}
?>
<?php include_once G5_MANAGE_INCLUDE_PATH . "/admin_footer.php";?>