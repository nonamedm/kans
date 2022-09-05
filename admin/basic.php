<?php

include_once "./_common.php";

/**
 *	해당페이지 타이틀 및 기본 노출 설정
 */
$g5['title'] = "Sample";	//title
$category_title = "기본페이지";	//카테고리 제목
$sub_title = "샘플페이지";	//서브 타이틀
$sub_explan = "기본 코딩시 사용되는 페이지 입니다."; //페이지 설명

include_once G5_MANAGE_INCLUDE_PATH . "/admin_header.php";

?>

			<h4 class="h4_label">서브 타이틀</h4>
			<table class="table">
				<colgroup span="4">
					<col width="150px" />
					<col width="*" />
					<col width="150px" />
					<col width="*" />
				</colgroup>
				<tr>
					<th scope="row">내용</th>
					<td>
						<textarea rows="" cols=""></textarea>
					</td>
				</tr>
			</table>
			<div class="btn_area">
				<div class="btn_area_left"></div>
				<div class="btn_area_right">
					<button class="btn_normal">완료</button>
				</div>
			</div>
<?php
include_once G5_MANAGE_INCLUDE_PATH . "/admin_footer.php";
?>
	
