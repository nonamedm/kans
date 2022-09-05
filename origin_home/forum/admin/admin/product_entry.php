<?php
	include_once "./_common.php";
	/**
	 *	해당페이지 타이틀 및 기본 노출 설정
	 */
	$g5['title'] = "상품소개 > 인피아드 관리자모드";	//title
	$category_title = "상품소개";	//카테고리 제목
	$sub_title = "상품소개관리";	//서브 타이틀
	$sub_explan = ""; //페이지 설명

	include_once G5_MANAGE_INCLUDE_PATH . "/admin_header.php";
?>
<h4 class="h4_label">신규상품 등록</h4>
<table class="vertical">
	<colgroup span="4">
		<col width="15%" />
		<col width="35%" />
		<col width="15%" />
		<col width="35%" />
	</colgroup>
	<tr>
		<th scope="row">분류</th>
		<td colspan="3" class="">
			<select id="" name="" title="">
				<option value="">분류명</option>
			</select>
		</td>
	</tr>
	<tr>
		<th scope="row">메뉴명</th>
		<td colspan="3" class="">
			<input type="text" id="" name="" class="w100">
		</td>
	</tr>
	<tr>
		<th scope="row">이미지</th>
		<td colspan="3" class="">
			<input type="file" id="" name="">
		</td>
	</tr>
	<tr>
		<th scope="row">가격</th>
		<td colspan="3" class="">
			<input type="text" id="" name="">
			원
			<input type="checkbox" id="" name=""> 가격 미노출
		</td>
	</tr>
	<tr>
		<th scope="row">설명</th>
		<td colspan="3" class="">
			<textarea rows="" cols=""></textarea>
		</td>
	</tr>
	<tr>
		<th scope="row">추천수</th>
		<td colspan="3" class="">
			<input type="text" id="" name="">
		</td>
	</tr>
	<tr>
		<th scope="row">노출순서</th>
		<td colspan="3" class="">
			<input type="text" id="" name="">
		</td>
	</tr>
</table>
<div class="btn_area">
	<div class="btn_area_left"></div>
	<div class="btn_area_center"></div>
	<div class="btn_area_right">
		<button class="btn_normal">작성완료</button>
		<button class="btn_normal">목록</button>
	</div>
</div>
<?php
include_once G5_MANAGE_INCLUDE_PATH . "/admin_footer.php";
?>