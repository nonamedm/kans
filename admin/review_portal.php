<?php
	include_once "./_common.php";
	/**
	 *	해당페이지 타이틀 및 기본 노출 설정
	 */
	$g5['title'] = "리뷰 > 인피아드 관리자모드";	//title
	$category_title = "리뷰";	//카테고리 제목
	$sub_title = "포탈리뷰";	//서브 타이틀
	$sub_explan = ""; //페이지 설명

	include_once G5_MANAGE_INCLUDE_PATH . "/admin_header.php";
?>
<h4 class="h4_label">포털리뷰 설정</h4>
<table class="vertical">
	<colgroup span="4">
		<col width="15%" />
		<col width="35%" />
		<col width="15%" />
		<col width="35%" />
	</colgroup>
	<tr>
		<th scope="row">키워드 입력</th>
		<td colspan="3" class="">
			<input type="text" id="" name="" class="w100">
		</td>
	</tr>
</table>
<div class="btn_area">
	<div class="btn_area_left"></div>
	<div class="btn_area_center"></div>
	<div class="btn_area_right">
		<button class="btn_normal">등록</button>
	</div>
</div>
<?php
include_once G5_MANAGE_INCLUDE_PATH . "/admin_footer.php";
?>