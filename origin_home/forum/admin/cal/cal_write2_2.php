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

	include("cal_write_common.php"); // 신청 공통부분

	// 저장처리
	$action_url = "./cal_write2.update.php";
?>

<!-- 직장교육 항목 -->
<section class="cal_group_application2">
	<article class="arti1">
		<p class="right_p">(*)표시는 필수입력사항 입니다.</p>

		<div class="top_box">
			<div class="lbx">
				<b>교육생 추가</b>
				<span><a href="#n" onclick="add_col();">+</a></span>
				<span><a href="#n" onclick="del_col();">-</a></span>
			</div>
			<div class="rbx">
				<!-- <b>단체 엑셀업로드</b>
				<input type="file" value="파일첨부"> -->
				<button type="button" onclick="layer_board('엑셀업로드','./cal_excel_upload.php?type=s2_2');">단체 엑셀업로드</button>
			</div>
		</div>
		<form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
			<input type="hidden" name="w" value="<?php echo $w ?>">
			<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>" />		<!-- 신청 테이블 정보 -->
			<input type="hidden" name="wr_1" id="wr_1" value="<?php echo $wr_1; ?>" />	<!-- 신청 교육 정보 -->
			<input type="hidden" name="wr_2" id="wr_2" value="<?php echo $wr_2; ?>" />	<!-- 기관명 정보 -->
			<!-- <input type="hidden" name="wr_3" id="wr_3" value="<?php echo $wr_3; ?>" /> -->	<!-- 이름 정보 -->
			<!-- <input type="hidden" name="wr_5" id="wr_5" value="<?php echo $wr_5; ?>" /> -->	<!-- 핸드폰번호 정보 -->
			<!-- <input type="hidden" name="wr_6" id="wr_6" value="<?php echo $wr_6; ?>" /> -->	<!-- 이메일 정보 -->
			
			<!-- 현재 신청하는 소속 회원정보 -->
			<input type="hidden" name="wr_13" id="wr_13" value="<?php echo $member['mb_no']; ?>" />	<!-- 회원 no -->
			<input type="hidden" name="wr_14" id="wr_14" value="<?php echo $member['mb_id']; ?>" />	<!-- 회원 id -->
			
			<input type="hidden" name="wr_15" id="wr_15" value="0" />	<!-- 결제된 금액 -->
			<input type="hidden" name="wr_16" id="wr_16" value="<?php echo $pro_info['wr_8']; ?>" />	<!-- 결제할 금액 -->

			<input type="hidden" name="wr_22" id="wr_22" value="<?php echo substr($pro_info['wr_3'], 0, 4); ?>|<?php echo substr($pro_info['wr_4'], 0, 4); ?>" />	<!-- 교육년도 -->
			<input type="hidden" name="wr_23" id="wr_23" value="<?php echo $pro_info['wr_1']; ?>" />	<!-- 교육명 -->

		<table class="table_nomal" id="request_table">
			<colgroup>
				<col width="10%">
				<col width="*">
			</colgroup>
			<tbody>
				<tr>
					<th>교육생1</th>
					<td>
						<ol>
							<li>
								<label for="">ID</label>
								<input type="text" name="mb_id[]">
							</li>
							<li>
								<label for="">이름(*)</label>
								<input type="text" name="wr_3[]">
							</li>
							<li>
								<label for="">주민등록번호(*)</label>
								<ul class="r_num">
									<li><input type="text" name="wr_4_1[]" maxlength ="6" size="10"> - </li>
									<li><input type="text" name="wr_4_2[]" maxlength ="1" size="2" ></li>
								</ul>
							</li>
							<li>
								<label for="">핸드폰번호(*)</label>
								<ul class="cel_p">
									<li><input type="text" name="wr_5_1[]" size="8"> - </li>
									<li><input type="text" name="wr_5_2[]" size="8"> - </li>
									<li><input type="text" name="wr_5_3[]" size="8"></li>
								</ul>
							</li>
							<li>
								<label for="">이메일</label>
								<ul class="email_ul">
									<li><input type="text" name="wr_6_1[]" size="10"> @ </li>
									<li><input type="text" name="wr_6_2[]" size="10"> </li>
									
								</ul>
							</li>
							<li>
								<label for="">방사선사면허번호</label>
								<input type="text" name="wr_7[]">
							</li>
						</ol>

					</td>
				</tr>
			</tbody>
		</table>
		<!-- <a href="#n" class="bt_write" >작성완료</a> -->
		<!-- <input type="button" value="다음" onclick="" class="bt_write"> -->
		<input type="submit" value="작성완료" onclick="" class="bt_write">
		</form>
	</article>
</section>

<script type="text/javascript">
	function get_excel(f_arr){
		
		// console.log( f_arr );

		$( '#request_layer' ).dialog( 'close' );
		
		// 신청정보
		var table = $("#request_table");

		var tr_length = $("#request_table").find("tbody").find("tr").length; // 열의 갯수
		
		// 인설트 되는 html 정보
		var html = "";

		// 변수 세팅
		var mb_id = "";		// 아이디
		var wr_3 = "";		// 이름
		var wr_4 = "";		// 주민등록번호
			var wr_4_1 = "";	// 주민등록번호 앞자리
			var wr_4_2 = "";	// 주민등록번호 뒷자리
		var wr_5 = "";		// 핸드폰번호
			var wr_5_1 = "";		// 핸드폰번호1
			var wr_5_2 = "";		// 핸드폰번호2
			var wr_5_2 = "";		// 핸드폰번호3
		var wr_6 = "";		// 이메일
			var wr_6_1 = "";		// 이메일1
			var wr_6_2 = "";		// 이메일2
		var wr_7 = "";		// 방사선사면허번호

		for(var i = 0; i < f_arr[0].length; i++){
			
			mb_id = f_arr[0][i];		// 아이디
			
			wr_3 = f_arr[1][i];		// 이름
			wr_4 = f_arr[2][i];		// 주민등록번호
				wr_4_1 = "";
				wr_4_2 = "";

				var wr_4_arr = wr_4.split("-");
				wr_4_1 = wr_4_arr[0];
				wr_4_2 = wr_4_arr[1];

			wr_5 = f_arr[3][i];		// 핸드폰번호
				wr_5_1 = "";
				wr_5_2 = "";
				wr_5_3 = "";

				var wr_5_arr = wr_5.split("-");
				wr_5_1 = wr_5_arr[0];
				wr_5_2 = wr_5_arr[1];
				wr_5_3 = wr_5_arr[2];

			wr_6 = f_arr[4][i];		// 이메일
				wr_6_1 = "";
				wr_6_2 = "";

				var wr_6_arr = wr_6.split("@");
				wr_6_1 = wr_6_arr[0];
				wr_6_2 = wr_6_arr[1];

			wr_7 = f_arr[5][i];		// 방사선사면허번호
			
			html += "<tr>";
			html += "	<th>교육생" + (tr_length + 1) + "</th>";
			html += "	<td>";
			html += "		<ol>";
				
			html += "<li><label for=\"\">ID</label><input type=\"text\" name=\"mb_id[]\" value=\"" + mb_id + "\"></li>";

			html += "<li><label for=\"\">이름(*)</label><input type=\"text\" name=\"wr_3[]\" value=\"" + wr_3 + "\"></li>";
			
			html += "<li><label for=\"\">주민등록번호(*)</label>";
			html += "	<ul class=\"r_num\">";
			html += "		<li><input type=\"text\" name=\"wr_4_1[]\" maxlength =\"6\" size=\"10\" value=\"" + wr_4_1 + "\"> - </li>";
			html += "		<li><input type=\"text\" name=\"wr_4_2[]\" maxlength =\"1\" size=\"2\"  value=\"" + wr_4_2 + "\"></li>";
			html += "	</ul>";
			html += "</li>";

			html += "<li><label for=\"\">핸드폰번호(*)</label>";
			html += "	<ul class=\"cel_p\">";
			html += "		<li><input type=\"text\" name=\"wr_5_1[]\" size=\"8\" value=\"" + wr_5_1 + "\"> - </li>";
			html += "		<li><input type=\"text\" name=\"wr_5_2[]\" size=\"8\" value=\"" + wr_5_2 + "\"> - </li>";
			html += "		<li><input type=\"text\" name=\"wr_5_3[]\" size=\"8\" value=\"" + wr_5_3 + "\"></li>";
			html += "	</ul>";
			html += "</li>";

			html += "<li><label for=\"\">이메일</label>";
			html += "	<ul class=\"email_ul\">";
			html += "		<li><input type=\"text\" name=\"wr_6_1[]\" size=\"10\" value=\"" + wr_6_1 + "\"> @ </li>";
			html += "		<li><input type=\"text\" name=\"wr_6_2[]\" size=\"10\" value=\"" + wr_6_2 + "\"></li>";
			html += "	</ul>";
			html += "</li>";

			html += "<li><label for=\"\">방사선사면허번호</label><input type=\"text\" name=\"wr_7[]\" value=\"" + wr_7 + "\"></li>";

			html += "		</ol>";
			html += "	</td>";
			html += "</tr>";

			tr_length++;
		}

		table.find("tbody").append(html);

		// console.log( f_arr[0] );
	}

	// 칸 추가하기
	function add_col(){
		
		// 신청정보
		var table = $("#request_table");

		var tr_length = $("#request_table").find("tbody").find("tr").length; // 열의 갯수

		// 추가될 새로운 칸
		var html = "";

		html += "<tr>";
		html += "	<th>교육생" + (tr_length + 1) + "</th>";
		html += "	<td>";
		html += "		<ol>";
			
		html += "<li><label for=\"\">ID</label><input type=\"text\" name=\"mb_id[]\"></li>";
		
		html += "<li><label for=\"\">이름(*)</label><input type=\"text\" name=\"wr_3[]\"></li>";
		
		html += "<li><label for=\"\">주민등록번호(*)</label>";
		html += "	<ul class=\"r_num\">";
		html += "		<li><input type=\"text\" name=\"wr_4_1[]\" maxlength =\"6\" size=\"10\"> - </li>";
		html += "		<li><input type=\"text\" name=\"wr_4_2[]\" maxlength =\"1\" size=\"2\" ></li>";
		html += "	</ul>";
		html += "</li>";

		html += "<li><label for=\"\">핸드폰번호(*)</label>";
		html += "	<ul class=\"cel_p\">";
		html += "		<li><input type=\"text\" name=\"wr_5_1[]\" size=\"8\"> - </li>";
		html += "		<li><input type=\"text\" name=\"wr_5_2[]\" size=\"8\"> - </li>";
		html += "		<li><input type=\"text\" name=\"wr_5_3[]\" size=\"8\"></li>";
		html += "	</ul>";
		html += "</li>";

		html += "<li><label for=\"\">이메일</label>";
		html += "	<ul class=\"email_ul\">";
		html += "		<li><input type=\"text\" name=\"wr_6_1[]\" size=\"10\"> @ </li>";
		html += "		<li><input type=\"text\" name=\"wr_6_2[]\" size=\"10\" ></li>";
		html += "	</ul>";
		html += "</li>";

		html += "<li><label for=\"\">방사선사면허번호</label><input type=\"text\" name=\"wr_7[]\"></li>";

		html += "		</ol>";
		html += "	</td>";
		html += "</tr>";

		table.find("tbody").append(html);
	}

	function del_col(){
		
		// 신청정보
		var table = $("#request_table");

		var length = table.find("tbody").find("tr").length; // 현재 열의 갯수
		length--; // 열 하나는 남기기 위해서 -1 처리
		if(length){	document.getElementById("request_table").deleteRow(-1); }
	}
</script>

<?php include_once(G5_THEME_PATH.'/tail.php'); ?>