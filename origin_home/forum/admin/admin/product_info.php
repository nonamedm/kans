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
<div class="status_area">
	<div class="status_area_left">
		<select id="" name="" title="">
			<option value="">전체</option>
			<option value="">메뉴명1</option>
		</select>
	</div>
	<div class="status_area_right">
		<select id="" name="" title="">
			<option value="">메뉴명</option>
			<option value="">가격</option>
			<option value="">내용</option>
		</select>
		<input type="text" id="" name="">
		<button id="" name="" class="btn_small2">검색</button>
	</div>
</div>
<div class="gallery_area">
	<div class="gallery_box">
		<span class="check_box">
			<input type="checkbox" id="" name="">
			<label for="" class="hide">선택</label>
		</span>
		<div class="photo_box">
			<div class="photo">
				<a href="#n">Images</a>
			</div>
		</div>
		<div class="txt_box">
			<p class="subject">제목이 삽입됩니다.</p>
			<div class="txt_box_left">
				가격 : 10,000원
			</div>
			<div class="txt_box_right">
				추천수 : 10
			</div>
		</div>
	</div>

	<div class="gallery_box">
		<span class="check_box">
			<input type="checkbox" id="" name="">
			<label for="" class="hide">선택</label>
		</span>
		<div class="photo_box">
			<div class="photo">
				<a href="#n">Images</a>
			</div>
		</div>
		<div class="txt_box">
			<p class="subject">제목이 삽입됩니다.</p>
			<div class="txt_box_left">
				가격 : 10,000원
			</div>
			<div class="txt_box_right">
				추천수 : 10
			</div>
		</div>
	</div>

	<div class="gallery_box">
		<span class="check_box">
			<input type="checkbox" id="" name="">
			<label for="" class="hide">선택</label>
		</span>
		<div class="photo_box">
			<div class="photo">
				<a href="#n">Images</a>
			</div>
		</div>
		<div class="txt_box">
			<p class="subject">제목이 삽입됩니다.</p>
			<div class="txt_box_left">
				가격 : 10,000원
			</div>
			<div class="txt_box_right">
				추천수 : 10
			</div>
		</div>
	</div>

	<div class="gallery_box">
		<span class="check_box">
			<input type="checkbox" id="" name="">
			<label for="" class="hide">선택</label>
		</span>
		<div class="photo_box">
			<div class="photo">
				<a href="#n">Images</a>
			</div>
		</div>
		<div class="txt_box">
			<p class="subject">제목이 삽입됩니다.</p>
			<div class="txt_box_left">
				가격 : 10,000원
			</div>
			<div class="txt_box_right">
				추천수 : 10
			</div>
		</div>
	</div>
</div>
<div class="btn_area">
	<div class="btn_area_left">
		<button id="" name="" class="btn_normal">선택삭제</button>
	</div>
	<div class="btn_area_right">
		<button id="" name="" class="btn_normal" onclick="location.href='./product_entry.php'">메뉴등록</button>
	</div>
</div>
<?php
include_once G5_MANAGE_INCLUDE_PATH . "/admin_footer.php";
?>