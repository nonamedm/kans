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

	// if(empty($wr_1)){ alert("올바른 접근이 아닙니다.", "/cal/cal_list.php"); exit; }

	include_once(G5_THEME_PATH.'/head.php');
?>

<!-- 직장교육 항목 -->
<section class="cal_group_application2">
	<article class="arti1">
		<p class="right_p">(*)표시는 필수입력사항 입니다.</p>

		<div class="top_box">
			<div class="lbx">
				<b>교육생 추가</b>
				<span><a href="">+</a></span>
				<span><a href="">-</a></span>
			</div>
			<div class="rbx">
				<b>단체 엑셀업로드</b>
				<input type="file" value="파일첨부">
			</div>
		</div>
		<table class="table_nomal">
			<colgroup>
				<col width="10%">
				<col width="*">
			</colgroup>
			<tr>
				<th>교육생1</th>
				<td>
					<ol>
						<li>
							<label for="">ID</label>
							<input type="text" name="">
						</li>
						<li>
							<label for="">교육구분</label>
							<select name="">
								<option value="일반신규" selected>일반신규</option>
								<option value="일반정기">일반정기</option>
								<option value="비파괴신규">비파괴신규</option>
								<option value="비파괴정기">비파괴정기</option>
							</select>
						</li>
						<li>
							<label for="">이름(*)</label>
							<input type="text" name="">
						</li>
						<li>
							<label for="">주민등록번호(*)</label>
							<ul class="r_num">
								<li><input type="text" name="" maxlength ="6" size="10"> - </li>
								<li><input type="text" name="" maxlength ="1" size="2" ></li>
							</ul>
						</li>
						<li>
							<label for="">핸드폰번호(*)</label>
							<ul class="cel_p">
								<li><input type="text" name="" size="8"> - </li>
								<li><input type="text" name="" size="8"> - </li>
								<li><input type="text" name="" size="8"></li>
							</ul>
						</li>
						<li>
							<label for="">이메일</label>
							<ul class="email_ul">
								<li><input type="text" size="10"> @ </li>
								<li><input type="text" name="" size="10"> </li>
								
							</ul>
						</li>
						<li>
							<label for="">방사선사면허번호</label>
							<input type="text" name="">
						</li>
					</ol>

				</td>
			</tr>
			
		</table>
		<a href="#n" class="bt_write" >작성완료</a>
		<!-- <input type="button" value="다음" onclick="" class="bt_write"> -->
	</article>
</section>





<?php include_once(G5_THEME_PATH.'/tail.php'); ?>