<?php
	include_once "./_common.php";
	/**
	 *	해당페이지 타이틀 및 기본 노출 설정
	 */
	$g5['title'] = "리뷰 > 인피아드 관리자모드";	//title
	$category_title = "리뷰";	//카테고리 제목
	$sub_title = "리뷰관리";	//서브 타이틀
	$sub_explan = ""; //페이지 설명

	include_once G5_MANAGE_INCLUDE_PATH . "/admin_header.php";
?>
<h4 class="h4_label">리뷰목록</h4>
<table class="horizen">
	<colgroup span="4">
		<col width="5%">
		<col width="15%">
		<col width="*">
		<col width="10%">
	</colgroup>
	<thead>
		<tr>
			<th scope="col"><input type="checkbox" id="" name=""></th>
			<th scope="col">별점</th>
			<th scope="col">내용</th>
			<th scope="col">작성일자</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td class="">
				<input type="checkbox" id="" name="">
			</td>
			<td class="">
				★★★★★
			</td>
			<td class="left">
				<a href="#n">우와..승부욕 대단한 선수다..전날 현수가 때려대니 새내기에게 질수없다는 듯한 폭발..홈런하나만 포함됐으면하는 아쉬움 ㅋ</a>
			</td>
			<td class="">
				2016-05-15
			</td>
		</tr>
	</tbody>
</table>
<div class="btn_area">
	<div class="btn_area_left">
		<button class="btn_normal">선택삭제</button>
	</div>
	<div class="btn_area_center"></div>
	<div class="btn_area_right"></div>
</div>
<?php
include_once G5_MANAGE_INCLUDE_PATH . "/admin_footer.php";
?>