<?php

include_once "./_common.php";
/**
 *	해당페이지 타이틀 및 기본 노출 설정
 */
$g5['title'] = "환경설정 > 인피아드 관리자모드";	//title
$category_title = "환경설정";	//카테고리 제목
$sub_title = "메뉴 관리";	//서브 타이틀
$sub_explan = "홈페이지에 사용되는 메뉴명 및 노출여부를 설정할 수 있습니다."; //페이지 설명

include_once G5_MANAGE_INCLUDE_PATH . "/admin_header.php";

if ($is_admin != 'super')
	alert('최고관리자만 접근 가능합니다.');

?>
<form method="post" name="flist">
	<input type="hidden" name="token" value="" />
	<h4 class="h4_label">메뉴관리</h4>
	<table class="horizen mb20">
		<colgroup width=100 class='col2 pad2'>
		<colgroup width=300 class='col2 pad2'>
		<colgroup width=100 class='col2 pad2'>
		<colgroup width='700' class='col2 pad2'>
		<colgroup width='' class='col2 pad2'>
			<tr class='ht' bgcolor=#f5f5f5>
				<td scope="col"><b>순서</b></td>
				<td scope="col"><b>메인 메뉴</b></td>
				<td scope="col"><b>길이</b></td>
				<td scope="col"><b>링크</b></td>
				<td scope="col"><b>서브 메뉴</b></td>
			</tr>
			<?php for ($i = 0; $i < $config2w['cf_max_menu']; $i++) { ?>
			<tr class='ht'>
				<td valign=middle><input type=text class="frm_input" size='10' name='cf_menu_sort[<?php echo $i?>]' value='<?php echo $i?>'> <?php ///echo help("메뉴 정렬 순서를 입력하십시요.")?></td>
				<td valign=middle><input type=text class="frm_input" style='width:300px' name='cf_menu_name[<?php echo $i?>]' value='<?php echo $config2w['cf_menu_name_'.$i]?>'> <?php ///echo help("메뉴 이름을 입력하십시요.")?></td>
				<td valign=middle><input type=text class="frm_input" size='10' name='cf_menu_leng[<?php echo $i?>]' value='<?php echo $config2w['cf_menu_name_'.$i]?$config2w['cf_menu_leng_'.$i]:''?>'> <?php ///echo help("화면 상의 메뉴 폭을 입력하십시요.")?></td>
				<td valign=middle><input type=text class="frm_input" style='width:700px' name='cf_menu_link[<?php echo $i?>]' value='<?php echo $config2w['cf_menu_link_'.$i]?>'> <?php ///echo help("메뉴와 연결시킬 링크를 입력하십시요.")?></td>
				<td valign=middle><a href="submenu_config_form.php?i=<?php echo $i?>">서브 메뉴</a></td>
			</tr>
			<?php } ?>
	</table>

</form>

<div class="btn_area">
	<div class="btn_area_left"></div>
	<div class="btn_area_center"></div>
	<div class="btn_area_right">
		<button class="btn_normal" type="button" onclick="submit_form();">정보변경</button>
	</div>
</div>

<script type="text/javascript"><!--
	//메뉴정보 업데이트
	function update_menu_info(id){

		var token = get_ajax_token();	//관리자토큰

		$.post("<?php echo G5_MANAGE_URL;?>/share/include/menu_update_ajax.php", {
			token : token,
			me_id : $("#me_id" + id).val(),
			me_name : $("#me_name" + id).val(),
			menu_show : ($("#menu_show" + id).is(":checked"))? "1" : ""
		}, function (rst) {
			var data = eval( "(" + rst + ")" );
			if(data.rst_code == "0" )
				alert("수정이 완료되었습니다");
			else
				alert("수정 실패");
		});
	}

	//메인화면 노출관리
	function update_main_info(id){
		var token = get_ajax_token();	//관리자토큰

		$.post("<?php echo G5_MANAGE_URL;?>/share/include/main_update_ajax.php", {
			token : token,
			ma_id : $("#ma_id" + id).val(),
			menu_show : ($("#ma_show" + id).is(":checked"))? "1" : ""
		}, function (rst) {
			var data = eval("(" + rst + ")" );
			if(data.rst_code == "0" )
				alert("수정이 완료되었습니다");
			else
				alert("수정 실패");
		});
	}

	//폼 서브밋
	function submit_form(){

		var $form = $("form[name='flist']");

		$form.find("input[name='token']").val(get_ajax_token());
		$form.prop("action", "./menu_info_update.php").submit();

		return true;
	}
//--></script>

<?php
include_once G5_MANAGE_INCLUDE_PATH . "/admin_footer.php";
?>