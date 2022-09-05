<?php
	include_once "./_common.php";
	/**
	 *	해당페이지 타이틀 및 기본 노출 설정
	 */
	$g5['title'] = "페이지소스 > 인피아드 관리자모드";	//title
	$category_title = "페이지소스";	//카테고리 제목
	$sub_title = "글목록 페이지";	//서브 타이틀
	$sub_explan = "BBS의 글목록을 만들 수 있는 기초 페이지 이다."; //페이지 설명

	include_once G5_MANAGE_INCLUDE_PATH . "/admin_header.php";
?>
<h4 class="h4_label">일반 BBS 글목록</h4>
<div class="status_area">
	<div class="status_area_left">
		총 10개
	</div>
	<div class="status_area_right">
		<select id="" name="">
			<option value="">선택하세요</option>
		</select>
		<input type="text" id="" name="" placeholder="키워드 입력" />
		<input type="submit" id="" name="" value="검색" />
	</div>
</div>
<table class="horizen">
	<col width="50" />
	<col width="50" />
	<col width="*" />
	<col width="100" />
	<col width="100" />
	<col width="50" />
	<thead>
		<tr>
			<th scope="col"><label for=""></label><input type="checkbox" id="" name="" /></th>
			<th scope="col">번호</th>
			<th scope="col">제목</th>
			<th scope="col">작성자</th>
			<th scope="col">작성일</th>
			<th scope="col">조회</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td class=""><label for=""></label><input type="checkbox" id="" name="" /></td>
			<td class="">10</td>
			<td class="left">
				<a href="#n">글의 제목이 노출 됩니다.</a>
			</td>
			<td class="">홍길동</td>
			<td class="">2017-02-20</td>
			<td class="">1000</td>
		</tr>
		<tr>
			<td class=""><label for=""></label><input type="checkbox" id="" name="" /></td>
			<td class="">9</td>
			<td class="left">
				<a href="#n">글의 제목이 노출 됩니다.</a>
			</td>
			<td class="">홍길동</td>
			<td class="">2017-02-20</td>
			<td class="">1000</td>
		</tr>
		<tr>
			<td class=""><label for=""></label><input type="checkbox" id="" name="" /></td>
			<td class="">8</td>
			<td class="left">
				<a href="#n">글의 제목이 노출 됩니다.</a>
			</td>
			<td class="">홍길동</td>
			<td class="">2017-02-20</td>
			<td class="">1000</td>
		</tr>
		<tr>
			<td class=""><label for=""></label><input type="checkbox" id="" name="" /></td>
			<td class="">7</td>
			<td class="left">
				<a href="#n">글의 제목이 노출 됩니다.</a>
			</td>
			<td class="">홍길동</td>
			<td class="">2017-02-20</td>
			<td class="">1000</td>
		</tr>
		<tr>
			<td class=""><label for=""></label><input type="checkbox" id="" name="" /></td>
			<td class="">6</td>
			<td class="left">
				<a href="#n">글의 제목이 노출 됩니다.</a>
			</td>
			<td class="">홍길동</td>
			<td class="">2017-02-20</td>
			<td class="">1000</td>
		</tr>
	</tbody>
</table>

<div class="btn_area">
	<div class="btn_area_left">
		<div class="paging">
			<a href="#n">&lt;&lt;</a>
			<a href="#n">&lt;</a>
			<strong>1</strong>
			<a href="#n">2</a>
			<a href="#n">&gt;</a>
			<a href="#n">&gt;&gt;</a>
		</div>
	</div>
	<div class="btn_area_right">
		<a href="#n" class="btn_normal">선택삭제</a>
		<a href="#n" class="btn_normal">글등록</a>
	</div>
</div>
<?php
	include_once G5_MANAGE_INCLUDE_PATH . "/admin_footer.php";
?>