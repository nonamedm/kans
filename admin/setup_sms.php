<?php
	include_once "./_common.php";
	/**
	 *	해당페이지 타이틀 및 기본 노출 설정
	 */
	$g5['title'] = "환경설정 > 인피아드 관리자모드";	//title
	$category_title = "환경설정";	//카테고리 제목
	$sub_title = "SMS충전관리";	//서브 타이틀
	$sub_explan = "홈페이지에 사용되는 메뉴명 및 노출여부를 설정할 수 있습니다."; //페이지 설명

	include_once G5_MANAGE_INCLUDE_PATH . "/admin_header.php";
?>
<h4 class="h4_label">SMS충전 현황</h4>
<table class="vertical">
	<colgroup span="4">
		<col width="15%">
		<col width="35%">
		<col width="15%">
		<col width="35%">
	</colgroup>
	<tr>
		<th scope="row">발송금액(1건)</th>
		<td class="">
			00원
		</td>
		<th scope="row">사용금액(발송건수)</th>
		<td class="">
			197,225.6원(11,206건)
		</td>
	</tr>
	<tr>
		<th scope="row">남은 충전금액</th>
		<td class="">
			532,774원
		</td>
		<th scope="row">발송가능건수</th>
		<td class="">
			30,271 건
		</td>
	</tr>
</table>
<div class="btn_area">
	<div class="btn_area_left"></div>
	<div class="btn_area_center"></div>
	<div class="btn_area_right">
		<button class="btn_normal" onclick="javascript:window.open('pop_sms_add.php','pop','width=600,height=500,status=yes,resizable=no,scrollbars=yes')">충전하기</button>
	</div>
</div>

<h4 class="h4_label">SMS충전 목록</h4>
<table class="horizen">
	<colgroup span="3">
		<col width="5%">
		<col width="45%">
		<col width="*">
	</colgroup>
	<thead>
		<tr>
			<th scope="col">번호</th>
			<th scope="col">충전금액</th>
			<th scope="col">충전날짜</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td class="">1</td>
			<td class="">730,000원</td>
			<td class="">2015-03-17 16:30:22</td>
		</tr>
	</tbody>
</table>
<?php
include_once G5_MANAGE_INCLUDE_PATH . "/admin_footer.php";
?>