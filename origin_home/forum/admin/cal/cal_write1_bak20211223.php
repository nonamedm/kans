<?
	include_once('./_common.php');

	//화면의 성격
	$user_division = "user";
	$screen_div = "sub"; //main, sub
	$frame_div = "one";  //one, two

	//카테고리/페이지/상세페이지 명칭 & 카테고리 번호
	$cate_num = "1";
	$page_num = "2";
	$spage_num = "2";

	//현재 활성화 상태
	$gn_btn = "gn_btn".$cate_num;
	$$gn_btn = "current";

	$ln_btn = "ln_btn".$page_num;
	$$ln_btn = "current";

	$sln_btn = "sln_btn".$spage_num;
	$$sln_btn = "current";

	include_once(G5_THEME_PATH.'/head.php');
?>

<section class="cal_group_application">
	<article class="arti1">
		<h3>교육담당자 단체 신청</h3>
		
		<table class="table_nomal">
			<colgroup>
				<col width="25%">
				<col width="*">
			</colgroup>
			<tr>
				<th>기관명 (*)</th>
				<td><input type="text" name=""></td>
			</tr>
			<tr>
				<th>이름 (*)</th>
				<td><input type="text" name=""></td>
			</tr>
			<tr>
				<th>핸드폰번호 (*)</th>
				<td><input type="text" name=""></td>
			</tr>
			<tr>
				<th>이메일 (*)</th>
				<td><input type="text" name=""></td>
			</tr>
		</table>
		<a href="http://www.kans.re.kr/cal/cal_write2.php" class="bt_write" >다음</a>
		<!-- <input type="button" value="다음" onclick="" class="bt_write"> -->
	</article>
</section>





<?php include_once(G5_THEME_PATH.'/tail.php'); ?>