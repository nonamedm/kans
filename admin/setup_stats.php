<?php
	include_once "./_common.php";
	/**
	 *	해당페이지 타이틀 및 기본 노출 설정
	 */
	$g5['title'] = "환경설정 > 인피아드 관리자모드";	//title
	$category_title = "환경설정";	//카테고리 제목
	$sub_title = "접속통계";	//서브 타이틀
	$sub_explan = ""; //페이지 설명

	include_once G5_MANAGE_INCLUDE_PATH . "/admin_header.php";
?>
<h4 class="h4_label">접속자</h4>
<div class="status_area">
	<div class="status_area_left">
		기간
		<input type="text" id="" name="" placeholder="YYYY-MM-DD">
		~
		<input type="text" id="" name="" placeholder="YYYY-MM-DD">
	</div>
	<div class="status_area_right">
		<button id="" name="" class="btn_small2">접속자</button>
		<button id="" name="" class="btn_small2">도메인</button>
		<button id="" name="" class="btn_small2">브라우저</button>
		<button id="" name="" class="btn_small2">OS</button>
		<button id="" name="" class="btn_small2">시간</button>
		<button id="" name="" class="btn_small2">요일</button>
		<button id="" name="" class="btn_small2">일</button>
		<button id="" name="" class="btn_small2">월</button>
		<button id="" name="" class="btn_small2">년</button>
	</div>
</div>
<table class="horizen">
	<colgroup span="5">
		<col width="20%">
		<col width="*">
		<col width="10%">
		<col width="10%">
		<col width="20%">
	</colgroup>
	<thead>
		<tr>
			<th scope="col">IP</th>
			<th scope="col">접속경로</th>
			<th scope="col">브라우저</th>
			<th scope="col">OS</th>
			<th scope="col">일시</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td class="">119.207.108.187</td>
			<td class="left">
				http://www.naver.com/asldfk/asdfadfas/
			</td>
			<td class="">Chrome</td>
			<td class="">Window10</td>
			<td class="">2015-05-30 05:00:00</td>
		</tr>
	</tbody>
</table>
<div class="btn_area">
	<div class="btn_area_left"></div>
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