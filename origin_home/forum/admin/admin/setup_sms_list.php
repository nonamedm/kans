<?php
	include_once "./_common.php";
	/**
	 *	해당페이지 타이틀 및 기본 노출 설정
	 */
	$g5['title'] = "환경설정 > 인피아드 관리자모드";	//title
	$category_title = "환경설정";	//카테고리 제목
	$sub_title = "SMS발송내역";	//서브 타이틀
	$sub_explan = "전송결과는 30일간 보관 됩니다."; //페이지 설명

	include_once G5_MANAGE_INCLUDE_PATH . "/admin_header.php";
?>
<table class="horizen">
	<colgroup span="6">
		<col width="5%">
		<col width="15%">
		<col width="15%">
		<col width="15%">
		<col width="*">
		<col width="10%">
	</colgroup>
	<thead>
		<tr>
			<th scope="col"><input type="checkbox" id="" name=""></th>
			<th scope="col">발송일</th>
			<th scope="col">수신일</th>
			<th scope="col">수신자</th>
			<th scope="col">내용</th>
			<th scope="col">성공여부</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td class=""><input type="checkbox" id="" name=""></td>
			<td class="">2015-02-12 17:30</td>
			<td class="">2015-02-12 17:30</td>
			<td class="">01041542525</td>
			<td class="left">OO 님 3분 으로 신청 되었습니다.</td>
			<td class="">성공</td>
		</tr>
	</tbody>
</table>
<div class="btn_area">
	<div class="btn_area_left">
		<button class="btn_normal">선택삭제</button>
	</div>
	<div class="btn_area_center">
		<div class="paging">
			<a href="#n">&lt;&lt;</a>
			<a href="#n">&lt;</a>
			<strong>1</strong>
			<a href="#n">2</a>
			<a href="#n">3</a>
			<a href="#n">4</a>
			<a href="#n">5</a>
			<a href="#n">6</a>
			<a href="#n">7</a>
			<a href="#n">8</a>
			<a href="#n">9</a>
			<a href="#n">10</a>
			<a href="#n">&gt;</a>
			<a href="#n">&gt;&gt;</a>
		</div>
	</div>
	<div class="btn_area_right"></div>
</div>
<?php
include_once G5_MANAGE_INCLUDE_PATH . "/admin_footer.php";
?>