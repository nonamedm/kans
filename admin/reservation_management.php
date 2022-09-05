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
<h4 class="h4_label">예약자 목록</h4>
<table class="horizen">
	<colgroup span="6">
		<col width="5%" />
		<col width="15%" />
		<col width="15%" />
		<col width="*" />
		<col width="10%" />
		<col width="10%" />
		<col width="10%" />
	</colgroup>
	<thead>
		<tr>
			<th scope="col"><input type="checkbox" id="" name="" /></th>
			<th scope="col">예약자</th>
			<th scope="col">핸드폰번호</th>
			<th scope="col">예약일시</th>
			<th scope="col">예약인원</th>
			<th scope="col">작성일자</th>
			<th scope="col">예약상태</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td class=""><input type="checkbox" id="" name=""></td>
			<td class=""><a href="./reservation_view.php">홍길동</a></td>
			<td class="">010-1234-4567</td>
			<td class="">201605-30 10:00</td>
			<td class="">2</td>
			<td class="">2016-05-15</td>
			<td class="">
				<select id="" name="" title="">
					<option value="">접수</option>
					<option value="">확정</option>
					<option value="">취소</option>
				</select>
			</td>
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
	<div class="btn_area_right">
		<button class="btn_normal" onclick="location.href='./reservation_view.php'">정보변경</button>
	</div>
</div>
<?php
include_once G5_MANAGE_INCLUDE_PATH . "/admin_footer.php";
?>