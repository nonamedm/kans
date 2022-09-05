<?php
	include_once "./_common.php";
	/**
	 *	해당페이지 타이틀 및 기본 노출 설정
	 */
	$g5['title'] = "환경설정 > 인피아드 관리자모드";	//title
	$category_title = "교육안내";	//카테고리 제목
	$sub_title = "페이조아 관리";	//서브 타이틀
	$sub_explan = "'PAYJOA 상점관리자 > 고객지원 > 기술지원 > 연동정보설정' 결제연동키를 확인 후 입력해주세요."; //페이지 설명

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
				<tr>
					<th scope="row" class="left">인증키 - 신용카드</th>
					<td class="left">
						<input type="hidden" id="cf_5_subj" name="cf_5_subj" value="<?php echo get_text($config["cf_5_subj"]); ?>" />
						<input type="text" id="cf_5" name="cf_5" value="<?php echo get_text($config["cf_5"]); ?>" class="w100" />
					</td>
				</tr>
				<tr>
					<th scope="row" class="left">인증키 - 가상계좌</th>
					<td class="left">
						<input type="hidden" id="cf_6_subj" name="cf_6_subj" value="<?php echo get_text($config["cf_6_subj"]); ?>" />
						<input type="text" id="cf_6" name="cf_6" value="<?php echo get_text($config["cf_6"]); ?>" class="w100" />
					</td>
				</tr>
				<tr>
					<th scope="row" class="left">인증키 - 계좌이체</th>
					<td class="left">
						<input type="hidden" id="cf_7_subj" name="cf_7_subj" value="<?php echo get_text($config["cf_7_subj"]); ?>" />
						<input type="text" id="cf_7" name="cf_7" value="<?php echo get_text($config["cf_7"]); ?>" class="w100" />
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
		$sql = " UPDATE {$table_name} SET 
					cf_5_subj = '{$_POST['cf_5_subj']}',
					cf_5 = '{$_POST['cf_5']}',
					cf_6_subj = '{$_POST['cf_6_subj']}',
					cf_6 = '{$_POST['cf_6']}',
					cf_7_subj = '{$_POST['cf_7_subj']}',
					cf_7 = '{$_POST['cf_7']}'";
		sql_query($sql);
		alert("약관설정이 변경되었습니다.","$PHP_SELF");
	}
?>
<?php include_once G5_MANAGE_INCLUDE_PATH . "/admin_footer.php";?>