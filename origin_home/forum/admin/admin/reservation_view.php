<?php
	include_once "./_common.php";
	/**
	 *	해당페이지 타이틀 및 기본 노출 설정
	 */
	$g5['title'] = "최근예약 > 인피아드 관리자모드";	//title
	$category_title = "최근예약";	//카테고리 제목
	$sub_title = "예약관리";	//서브 타이틀
	$sub_explan = ""; //페이지 설명

	include_once G5_MANAGE_INCLUDE_PATH . "/admin_header.php";
?>
<h4 class="h4_label">예약자 내용보기</h4>
<table class="vertical">
	<colgroup span="4">
		<col width="15%" />
		<col width="35%" />
		<col width="15%" />
		<col width="35%" />
	</colgroup>
	<tr>
		<th scope="row">예약자</th>
		<td class="">

		</td>
		<th scope="row">휴대폰번호</th>
		<td class="">

		</td>
	</tr>
	<tr>
		<th scope="row">예약일시</th>
		<td class="">

		</td>
		<th scope="row">예약인원</th>
		<td class="">

		</td>
	</tr>
	<tr>
		<th scope="row">예약상태</th>
		<td colspan="3" class="">
			<select id="" name="" title="">
				<option value="">접수</option>
				<option value="">확정</option>
				<option value="">취소</option>
			</select>
		</td>
	</tr>
	<tr>
		<th scope="row">요청사항</th>
		<td colspan="3" class="left">

		</td>
	</tr>
</table>
<div class="btn_area">
	<div class="btn_area_left">
		<button class="btn_normal" onclick="location.href='./reservation_write.php'">수정</button>
		<button class="btn_normal">삭제</button>
	</div>
	<div class="btn_area_center"></div>
	<div class="btn_area_right">
		<button class="btn_normal" onclick="location.href='./reservation_management.php'">목록</button>
	</div>
</div>
<?php
include_once G5_MANAGE_INCLUDE_PATH . "/admin_footer.php";
?>