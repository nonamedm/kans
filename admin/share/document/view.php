<?php
	include_once "./_common.php";
	/**
	 *	해당페이지 타이틀 및 기본 노출 설정
	 */
	$g5['title'] = "페이지소스 > 인피아드 관리자모드";	//title
	$category_title = "페이지소스";	//카테고리 제목
	$sub_title = "글보기 페이지";	//서브 타이틀
	$sub_explan = "BBS의 글보기를 만들 수 있는 기초 페이지 이다."; //페이지 설명

	include_once G5_MANAGE_INCLUDE_PATH . "/admin_header.php";
?>
<h4 class="h4_label">일반 BBS 글보기</h4>
<table class="vertical">
	<col width="10%" />
	<col width="40%" />
	<col width="10%" />
	<col width="40%" />
	<tbody>
		<tr>
			<th scope="row">작성자</th>
			<td colspan="" class="">
				홍길동
			</td>
			<th scope="row">작성일</th>
			<td colspan="" class="">
				2017-02-20
			</td>
		</tr>
		<tr>
			<th scope="row">제목</th>
			<td colspan="3" class="">
				글의 제목이 나타납니다.
			</td>
		</tr>
		<tr>
			<th scope="row">내용</th>
			<td colspan="3" class="">
				내용이 들어간다.
			</td>
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