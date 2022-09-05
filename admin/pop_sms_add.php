<?php
	include_once "./_common.php";
	/**
	 *	해당페이지 타이틀 및 기본 노출 설정
	 */
	$g5['title'] = "환경설정 > 인피아드 관리자모드";	//title
	$category_title = "환경설정";	//카테고리 제목
	$sub_title = "SMS충전관리";	//서브 타이틀
	$sub_explan = "홈페이지에 사용되는 메뉴명 및 노출여부를 설정할 수 있습니다."; //페이지 설명

	include_once G5_MANAGE_INCLUDE_PATH . "/admin.head.sub.php";
?>
<style type="text/css">
html { min-width:100%; overflow:hidden; }
</style>
<div id="pop_head">
	<h1>SMS충전하기</h1>
</div>
<div id="pop_body">
	<div class="center">

	</div>
	<p class="mb10 right">
		(*)가 표시된 항목은 필수 입력사항 입니다.
	</p>
	<table class="vertical">
		<colgroup span="4">
			<col width="20%">
			<col width="30%">
			<col width="20%">
			<col width="30%">
		</colgroup>
		<tr>
			<th scope="row">결제방법(*)</th>
			<td colspan="3" class="">
				<input type="radio" id="" name="">
				<label for="">카드결제</label>
			</td>
		</tr>
		<tr>
			<th scope="row">결제금액(*)</th>
			<td colspan="3" class="">
				<input type="text" id="" name="" placeholder="결제금액을 입력하세요.">
				<label for="">원</label>
			</td>
		</tr>
		<tr>
			<th scope="row">이름(*)</th>
			<td colspan="3" class="">
				<input type="text" id="" name="" placeholder="이름을 입력하세요.">
			</td>
		</tr>
		<tr>
			<th scope="row">연락처(*)</th>
			<td colspan="3" class="">
				<input type="text" id="" name="" placeholder="연락처를 입력하세요.">
			</td>
		</tr>
		<tr>
			<th scope="row">Email(*)</th>
			<td colspan="3" class="">
				<input type="text" id="" name="" placeholder="Email을 입력하세요.">
			</td>
		</tr>
	</table>
	<div class="btn_area">
		<div class="btn_area_right">
			<button id="" name="" class="btn_normal">결제하기</button>
		</div>
	</div>
</div>
<div id="pop_foot">
	<button id="" name="" onclick="javascript:self.close()" class="btn_small2">닫기</button>
</div>
<?php
include_once G5_MANAGE_INCLUDE_PATH . "/admin.tail.sub.php";
?>