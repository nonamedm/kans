<?php
	if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
	// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
	add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

	// 교육일정 정보
	$tmp_write_table = $g5['write_prefix'] . substr($bo_table, 0, -2);
	$program_info = sql_fetch(" SELECT * FROM ".$tmp_write_table." WHERE wr_id = '".$write['wr_1']."' ");
?>
<script type="text/javascript">
jQuery(function($){
	$.datepicker.regional['ko'] = {
		closeText: '닫기',
		prevText: '이전달',
		nextText: '다음달',
		currentText: '오늘',
		monthNames: ['1월(JAN)','2월(FEB)','3월(MAR)','4월(APR)','5월(MAY)','6월(JUN)',
		'7월(JUL)','8월(AUG)','9월(SEP)','10월(OCT)','11월(NOV)','12월(DEC)'],
		monthNamesShort: ['1월','2월','3월','4월','5월','6월',
		'7월','8월','9월','10월','11월','12월'],
		dayNames: ['일','월','화','수','목','금','토'],
		dayNamesShort: ['일','월','화','수','목','금','토'],
		dayNamesMin: ['일','월','화','수','목','금','토'],
		weekHeader: 'Wk',
		dateFormat: 'yy-mm-dd',
		firstDay: 0,
		isRTL: false,
		showMonthAfterYear: true,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['ko']);

	$('.date_pic').datepicker({
		buttonImageOnly: true,
		buttonText: "달력",
		changeMonth: true,
			dateFormat: 'yy-mm-dd',
		changeYear: true,
		showButtonPanel: true/*,
		yearRange: 'c-100:c+0',
		maxDate: '+0y'*/
	});
});
</script>
<section id="bo_w">
	<!-- 게시물 작성/수정 시작 { -->
	<form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
		<input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
		<input type="hidden" name="w" value="<?php echo $w ?>">
		<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
		<input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
		<input type="hidden" name="sca" value="<?php echo $sca ?>">
		<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
		<input type="hidden" name="stx" value="<?php echo $stx ?>">
		<input type="hidden" name="spt" value="<?php echo $spt ?>">
		<input type="hidden" name="sst" value="<?php echo $sst ?>">
		<input type="hidden" name="sod" value="<?php echo $sod ?>">
		<input type="hidden" name="page" value="<?php echo $page ?>">

		<input type="hidden" name="wr_1" id="wr_1" value="<?php echo $wr_1; ?>">
		<input type="hidden" name="wr_subject" id="wr_subject" value="<?php echo $subject; ?>">
		<input type="hidden" name="wr_content" id="wr_content" value="<?php echo $content; ?>">

		<input type="hidden" name="wr_13" id="wr_13" value="<?php echo $write['wr_13']; ?>">	<!-- 담당자회원no -->
		<input type="hidden" name="wr_14" id="wr_14" value="<?php echo $write['wr_14']; ?>">	<!-- 담당자회원id -->

		<input type="hidden" name="wr_22" id="wr_22" value="<?php echo $write['wr_22']; ?>">	<!-- 교육의 연도 -->
		<input type="hidden" name="wr_23" id="wr_23" value="<?php echo $write['wr_23']; ?>">	<!-- 교육의 종류 -->
		<input type="hidden" name="wr_24" id="wr_24" value="<?php echo $write['wr_24']; ?>">	<!-- PAYJOA_주문번호 -->
		<input type="hidden" name="wr_25" id="wr_25" value="<?php echo $write['wr_25']; ?>">	<!-- 장바구니 PK -->
		<input type="hidden" name="wr_26" id="wr_26" value="<?php echo $write['wr_26']; ?>">	<!-- 수료증 번호 -->
		<input type="hidden" name="wr_28" id="wr_28" value="<?php echo $write['wr_28']; ?>">	<!-- 취소일자 -->
		<input type="hidden" name="wr_29" id="wr_29" value="<?php echo $write['wr_29']; ?>">	<!-- 주문번호 -->

		<?php
			$option = '';
			$option_hidden = '';
			if ($is_notice || $is_html || $is_secret || $is_mail) {
				$option = '';
				if ($is_notice) {
					$option .= "\n".'<input type="checkbox" id="notice" name="notice" value="1" '.$notice_checked.'>'."\n".'<label for="notice">공지</label>';
				}
				if ($is_html) {
					if ($is_dhtml_editor) {
						$option_hidden .= '<input type="hidden" value="html1" name="html">';
					} else {
						$option .= "\n".'<input type="checkbox" id="html" name="html" onclick="html_auto_br(this);" value="'.$html_value.'" '.$html_checked.'>'."\n".'<label for="html">html</label>';
					}
				}
				if ($is_secret) {
					if ($is_admin || $is_secret==1) {
						$option .= "\n".'<input type="checkbox" id="secret" name="secret" value="secret" '.$secret_checked.'>'."\n".'<label for="secret">비밀글</label>';
					} else {
						$option_hidden .= '<input type="hidden" name="secret" value="secret">';
					}
				}
				if ($is_mail) {
					$option .= "\n".'<input type="checkbox" id="mail" name="mail" value="mail" '.$recv_email_checked.'>'."\n".'<label for="mail">답변메일받기</label>';
				}
			}

			echo $option_hidden;
			// 이름, 비밀번호, 이메일, 홈페이지, 옵션 비활성화 처리
			$is_name = false;
			$is_password = false;
			$is_email = false;
			$is_homepage = false;
			$option = false;
		?>
		<div class="table_outline">
			<table class="horizen vertical">
				<col width="150" />
				<col width="*" />
				<tbody>
					<?php if ($option) { ?>
						<tr>
							<th scope="row">옵션</th>
							<td><?php echo $option ?></td>
						</tr>
					<?php } ?>
					<?php if ($is_category) { ?>
						<tr>
							<th scope="row"><label for="ca_name">분류<strong class="sound_only">필수</strong></label></th>
							<td>
								<input type="hidden" name="ca_name" id="ca_name" value="<?php echo $ca_name; ?>">
								<?php echo $ca_name; ?>
								<!-- <select name="ca_name" id="ca_name" required class="required" >
									<option value="">선택하세요</option>
									<?php echo $category_option ?>
								</select> -->
							</td>
						</tr>
					<?php } ?>

					<!-- ======================== 직장교육 신청 폼 ======================== -->
					<?php if($program_info['wr_1'] == '10'){ ?>
					<tr>
						<th scope="row"><label for="wr_2">기관명</label></th>
						<td><input type="text" id="wr_2" name="wr_2" value="<?php echo $write['wr_2']; ?>" class="w100 frm_input"></td>
					</tr>
					<tr>
						<th scope="row"><label for="">이름</label></th>
						<td>
							<input type="text" id="wr_3" name="wr_3" value="<?php echo $write['wr_3']; ?>" required class="w100 frm_input required">
							<?php if ($is_name) { ?>
								<input type="hidden" name="wr_name" value="<?php echo $name ?>" id="wr_name">
							<?php } ?>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="">주민등록번호</label></th>
						<td>
							<input type="hidden" name="wr_4" value="<?php echo $write['wr_4']; ?>" id="wr_4">
							<?php $wr_4_ = explode("-", $write['wr_4']); ?>
							<input type="text" name="wr_4_1" value="<?php echo $wr_4_[0]; ?>" id="wr_4_1" class="frm_input required" required maxlength="6">-
							<input type="text" name="wr_4_2" value="<?php echo $wr_4_[1]; ?>" id="wr_4_2" class="frm_input required" required maxlength="1">
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="wr_5">핸드폰 번호</label></th>
						<td><input type="text" id="wr_5" name="wr_5" value="<?php echo $write['wr_5']; ?>" class="frm_input"></td>
					</tr>
					<tr>
						<th scope="row"><label for="">이메일</label></th>
						<td>
							<input type="text" name="wr_6" value="<?php echo $write['wr_6']; ?>" id="wr_6" size="40" class="frm_input email">
							<?php if ($is_email) { ?><input type="hidden" name="wr_email" ><?php } ?>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="wr_7">방사선사면허번호</label></th>
						<td><input type="text" id="wr_7" name="wr_7" value="<?php echo $write['wr_7']; ?>" class="w100 frm_input"></td>
					</tr>
					<!-- ======================== 보수교육 신청 폼 ======================== -->
					<?php } else if($program_info['wr_1'] == '20' || $program_info['wr_1'] == '40'){ ?>
					<tr>
						<th scope="row"><label for="wr_2">기관명</label></th>
						<td><input type="text" id="wr_2" name="wr_2" value="<?php echo $write['wr_2']; ?>" class="w100 frm_input"></td>
					</tr>
					<tr>
						<th scope="row"><label for="">이름</label></th>
						<td>
							<input type="text" id="wr_3" name="wr_3" value="<?php echo $write['wr_3']; ?>" required class="w100 frm_input required">
							<?php if ($is_name) { ?>
								<input type="hidden" name="wr_name" value="<?php echo $name ?>" id="wr_name">
							<?php } ?>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="">주민등록번호</label></th>
						<td>
							<input type="hidden" name="wr_4" value="<?php echo $write['wr_4']; ?>" id="wr_4">
							<?php $wr_4_ = explode("-", $write['wr_4']); ?>
							<input type="text" name="wr_4_1" value="<?php echo $wr_4_[0]; ?>" id="wr_4_1" class="frm_input required" required maxlength="6">-
							<input type="text" name="wr_4_2" value="<?php echo $wr_4_[1]; ?>" id="wr_4_2" class="frm_input required" required maxlength="1">
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="wr_5">핸드폰 번호</label></th>
						<td><input type="text" id="wr_5" name="wr_5" value="<?php echo $write['wr_5']; ?>" class="frm_input"></td>
					</tr>
					<tr>
						<th scope="row"><label for="">이메일</label></th>
						<td>
							<input type="text" name="wr_6" value="<?php echo $write['wr_6']; ?>" id="wr_6" size="40" class="frm_input email">
							<?php if ($is_email) { ?><input type="hidden" name="wr_email" ><?php } ?>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="wr_8">면허</label></th>
						<td>
							<select name="wr_8" id="wr_8">
								<option value="">선택해주세요.</option>
								<option value="방사선취급자감독자면허">방사선취급자감독자면허</option>
								<option value="방사성동위원소취급자일반면허">방사성동위원소취급자일반면허</option>
								<option value="방사성동위원소취급자특수면허">방사성동위원소취급자특수면허</option>
							</select>

							<script type="text/javascript">
								$("#wr_8 option[value='<?php echo $write[wr_8]; ?>']").prop("selected", "true");
							</script>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="wr_9">면허번호</label></th>
						<td><input type="text" id="wr_9" name="wr_9" value="<?php echo $write['wr_9']; ?>" class="w100 frm_input"></td>
					</tr>
					<tr>
						<th scope="row"><label for="wr_7">방사선사면허번호</label></th>
						<td><input type="text" id="wr_7" name="wr_7" value="<?php echo $write['wr_7']; ?>" class="w100 frm_input"></td>
					</tr>
					<!-- ======================== 전문교육 신청 폼 ======================== -->
					<?php } else if($program_info['wr_1'] == '30'){ ?>
					<tr>
						<th scope="row"><label for="wr_2">기관명</label></th>
						<td><input type="text" id="wr_2" name="wr_2" value="<?php echo $write['wr_2']; ?>" class="w100 frm_input"></td>
					</tr>
					<tr>
						<th scope="row"><label for="wr_7">교육구분</label></th>
						<td>
							<select id="wr_7" name="wr_7" style="width:150px">
								<option value="전문강좌">전문강좌</option>
								<option value="단기강좌">단기강좌</option>
							</select>

							<script type="text/javascript">
								$("#wr_7 option[value='<?php echo $write[wr_7]; ?>']").prop("selected", "true");
							</script>
						</td>
					</tr>
					<!-- <tr>
						<th scope="row"><label for="wr_8">교육명</label></th>
						<td><input type="text" id="wr_8" name="wr_8" value="<?php echo $write['wr_8']; ?>" class="w100 frm_input"></td>
					</tr>
					<tr>
						<th scope="row"><label for="">교육일</label></th>
						<td>
							<input type="date" id="wr_9" name="wr_9" value="<?php echo $write['wr_9']; ?>" class="frm_input">
							<input type="date" id="wr_10" name="wr_10" value="<?php echo $write['wr_10']; ?>" class="frm_input">
						</td>
					</tr> -->
					<tr>
						<th scope="row"><label for="">이름</label></th>
						<td>
							<input type="text" id="wr_3" name="wr_3" value="<?php echo $write['wr_3']; ?>" required class="w100 frm_input required">
							<?php if ($is_name) { ?>
								<input type="hidden" name="wr_name" value="<?php echo $name ?>" id="wr_name">
							<?php } ?>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="">주민등록번호</label></th>
						<td>
							<input type="hidden" name="wr_4" value="<?php echo $write['wr_4']; ?>" id="wr_4">
							<?php $wr_4_ = explode("-", $write['wr_4']); ?>
							<input type="text" name="wr_4_1" value="<?php echo $wr_4_[0]; ?>" id="wr_4_1" class="frm_input required" required maxlength="6">-
							<input type="text" name="wr_4_2" value="<?php echo $wr_4_[1]; ?>" id="wr_4_2" class="frm_input required" required maxlength="1">
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="wr_11">소속</label></th>
						<td>
							<input type="text" id="wr_11" name="wr_11" value="<?php echo $write['wr_11']; ?>" class="frm_input">
						</td>
					</tr>
					<!-- <tr>
						<th scope="row"><label for="wr_12">부서명</label></th>
						<td><input type="text" id="wr_12" name="wr_12" value="<?php echo $write['wr_12']; ?>" class="frm_input"></td>
					</tr> -->
					<tr>
						<th scope="row"><label for="wr_5">핸드폰 번호</label></th>
						<td><input type="text" id="wr_5" name="wr_5" value="<?php echo $write['wr_5']; ?>" class="frm_input"></td>
					</tr>
					<tr>
						<th scope="row"><label for="">이메일</label></th>
						<td>
							<input type="text" name="wr_6" value="<?php echo $write['wr_6']; ?>" id="wr_6" size="40" class="frm_input email">
							<?php if ($is_email) { ?><input type="hidden" name="wr_email" ><?php } ?>
						</td>
					</tr>
					<?php } ?>
					
					<tr>
						<th scope="row"><label for="wr_30">소속</label></th>
						<td>
							<input type="hidden" name="wr_30" id="wr_30" value="<?php echo $write['wr_30'];?>" />
							<?php
							if($write['wr_30']){
									$group_table = "mem_group";
									$group_write_table = $g5['write_prefix'] . $group_table;
									
									$group_info = sql_fetch(" SELECT * FROM {$group_write_table} WHERE wr_id = '{$write['wr_30']}' ");
							}
							?>
							<input type="text" name="wr_30_" value="<?php echo $group_info['wr_subject']; ?>" id="wr_30_" class="frm_input" onclick="open_search_member('wr_30', 'wr_30_');" readonly size="50">
						</td>
					</tr>

					<tr>
						<th scope="row"><label for="wr_20">결제수단</label></th>
						<td>
							<!-- 결제관련용 변수 -->
							<input type="hidden" name="wr_21" value="<?php echo $write['wr_21']; ?>" id="wr_21" class="frm_input">
							<select id="wr_20" name="wr_20" style="width:150px">
								<option value="">선택해주세요.</option>
								<option value="신용카드K(일반)">신용카드</option>
								<option value="가상계좌(발급)">가상계좌</option>
								<option value="계좌이체(일반)">계좌이체</option>
								<option value="무통장">무통장</option>
							</select>

							<script type="text/javascript">
								$("#wr_20 option[value='<?php echo $write['wr_20']; ?>']").prop("selected", "true");
							</script>
						</td>
					</tr>

					<tr>
						<th scope="row"><label for="">금액</label></th>
						<td>
							결제된 금액: <input type="number" name="wr_15" value="<?php echo $write['wr_15']; ?>" id="wr_15" class="frm_input"> /
							결제할 금액: <input type="number" name="wr_16" value="<?php echo $write['wr_16']; ?>" id="wr_16" class="frm_input">
						</td>
					</tr>

					<tr>
						<th scope="row"><label for="wr_17">결제상태</label></th>
						<td>
							<select id="wr_17" name="wr_17" style="width:150px">
								<option value="">미결제</option>
								<option value="결제완료">결제완료</option>
							</select>

							<script type="text/javascript">
								$("#wr_17 option[value='<?php echo $write['wr_17']; ?>']").prop("selected", "true");
							</script>
						</td>
					</tr>

					<tr>
						<th scope="row"><label for="wr_18">진행상태</label></th>
						<td>
							<select id="wr_18" name="wr_18" style="width:150px">
								<option value="">접수중</option>
								<option value="교육수료">교육수료</option>
								<option value="미수료">미수료</option>
								<option value="취소">취소</option>
							</select>

							<script type="text/javascript">
								$("#wr_18 option[value='<?php echo $write['wr_18']; ?>']").prop("selected", "true");
							</script>
						</td>
					</tr>

					<tr>
						<th scope="row"><label for="wr_27">결제일자</label></th>
						<td><input type="text" id="wr_27" name="wr_27" value="<?php echo $write['wr_27']; ?>" class="frm_input"></td>
					</tr>

					<tr>
						<th scope="row"><label for="wr_19">비고<strong class="sound_only">필수</strong></label></th>
						<td><input type="text" id="wr_19" name="wr_19" value="<?php echo $write['wr_19']; ?>" maxlength="255" class="w100 frm_input"></td>
					</tr>

					<?php if ($is_name) { ?>
						<tr>
							<th scope="row"><label for="wr_name">이름<strong class="sound_only">필수</strong></label></th>
							<td><input type="text" name="wr_name" value="<?php echo $name ?>" id="wr_name" required class="frm_input required" size="10" maxlength="20" class="w100"></td>
						</tr>
					<?php } ?>
					<?php if ($is_password) { ?>
						<tr>
							<th scope="row"><label for="wr_password">비밀번호<strong class="sound_only">필수</strong></label></th>
							<td><input type="password" name="wr_password" id="wr_password" <?php echo $password_required ?> class="frm_input <?php echo $password_required ?>" maxlength="20" class="w100"></td>
						</tr>
					<?php } ?>
					<?php if ($is_email) { ?>
						<tr>
							<th scope="row"><label for="wr_email">이메일</label></th>
							<td><input type="text" name="wr_email" value="<?php echo $email ?>" id="wr_email" class="frm_input email" size="50" maxlength="100" class="w100"></td>
						</tr>
					<?php } ?>
					<!-- <tr>
						<th scope="row"><label for="wr_subject">교육명<strong class="sound_only">필수</strong></label></th>
						<td>
							<input type="text" id="wr_subject" name="wr_subject" value="<?php echo $subject ?>" required size="50" maxlength="255" class="w100 frm_input required">
							<?php if ($is_member) { // 임시 저장된 글 기능 ?>
								<script src="<?php echo G5_JS_URL; ?>/autosave.js"></script>
								<?php if($editor_content_js) echo $editor_content_js; ?>
							<?php } ?>
						</td>
					</tr> -->
					<?/* <tr>
						<th scope="row"><label for="wr_content">내용<strong class="sound_only">필수</strong></label></th>
						<td class="wr_content">
							<?php if($write_min || $write_max) { ?>
								<!-- 최소/최대 글자 수 사용 시 -->
								<p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
							<?php } ?>
							<?php echo $editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
							<?php if($write_min || $write_max) { ?>
								<!-- 최소/최대 글자 수 사용 시 -->
								<div id="char_count_wrap"><span id="char_count"></span>글자</div>
							<?php } ?>
						</td>
					</tr> */?>
					<?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>
						<tr>
							<!-- <th scope="row">파일 #<?php echo $i+1 ?></th> -->
							<?php if($i){ ?>
								<th scope="row">파일 #<?php echo $i; ?></th>
							<?php } else {?>
								<th scope="row">무통장 영수증</th>
							<?php } ?>
							<td>
								<input type="file" name="bf_file[]" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file frm_input">
								<?php if ($is_file_content) { ?>
									<input type="text" name="bf_content[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content'] : ''; ?>" title="파일 설명을 입력해주세요." class="frm_file frm_input" size="50">
								<?php } ?>
								<?php if($w == 'u' && $file[$i]['file']) { ?>
									<input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일 삭제</label>
								<?php } ?>
							</td>
						</tr>
					<?php } ?>
					<?php if ($is_guest) { //자동등록방지  ?>
						<tr>
							<th scope="row">자동등록방지</th>
							<td><?php echo $captcha_html ?></td>
						</tr>
					<?php } ?>
				</tbody>

			</table>
		</div>

		<div class="btn_area">
			<div class="btn_area_right">
				<input type="submit" value="확인" id="btn_submit" accesskey="s" class="btn_normal">
				<a href="./board.php?bo_table=<?php echo $bo_table ?><?php if($swr_1){ echo "&amp;swr_1=".$swr_1; } ?>" class="btn_normal">목록</a>
			</div>
		</div>
    </form>

    <script>
    <?php if($write_min || $write_max) { ?>
    // 글자수 제한
    var char_min = parseInt(<?php echo $write_min; ?>); // 최소
    var char_max = parseInt(<?php echo $write_max; ?>); // 최대
    check_byte("wr_content", "char_count");

    $(function() {
        $("#wr_content").on("keyup", function() {
            check_byte("wr_content", "char_count");
        });
    });

    <?php } ?>
    function html_auto_br(obj)
    {
        if (obj.checked) {
            result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
            if (result)
                obj.value = "html2";
            else
                obj.value = "html1";
        }
        else
            obj.value = "";
    }

    function fwrite_submit(f)
    {
		<? if(!$is_member && !$w){ ?>
			//비회원 글쓰기 개인정보 수집·이용 등에 대한 동의 선택은 필수입니다. 256~274라인
			var radio_num = f.priv.length;
			var chk_i = 0;
			var chk_value;

			for(var i=0; i<radio_num; i++){
				if (f.priv[i].checked == true){
					chk_i++;
					chk_value = f.priv[i].value;
					break;
				}
			}
			if (chk_value != "동의"){
				alert("개인정보 수집·이용 등에 대한 동의 선택해주세요.");
				f.priv[0].focus();
				return false;
			}
		<?}?>

		// 이름
		<?php if ($is_name) { ?>
			f.wr_name.value = f.wr_3.value
		<?php }  ?>
		
		// 주민등록번호
		f.wr_4.value = f.wr_4_1.value + "-" + f.wr_4_2.value;

		// 연락처
		f.wr_5.value = f.mb_tel1.value+"-"+f.mb_tel2.value+"-"+f.mb_tel3.value;
		
		// 이메일
		f.wr_6.value = f.wr_email1.value + "@" + f.wr_email2.value;
		<?php if ($is_email) { ?>
			f.wr_email.value = f.wr_6.value;
		<?php } ?>

		f.wr_subject.value = f.wr_3.value + "님의 " + f.ca_name.value + " 신청";
		f.wr_content.value = f.wr_subject.value;

        <?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

        var subject = "";
        var content = "";
        $.ajax({
            url: g5_bbs_url+"/ajax.filter.php",
            type: "POST",
            data: {
                "subject": f.wr_subject.value,
                "content": f.wr_content.value
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function(data, textStatus) {
                subject = data.subject;
                content = data.content;
            }
        });

        if (subject) {
            alert("교육명에 금지단어('"+subject+"')가 포함되어있습니다");
            f.wr_subject.focus();
            return false;
        }

        if (content) {
            alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
            if (typeof(ed_wr_content) != "undefined")
                ed_wr_content.returnFalse();
            else
                f.wr_content.focus();
            return false;
        }

        if (document.getElementById("char_count")) {
            if (char_min > 0 || char_max > 0) {
                var cnt = parseInt(check_byte("wr_content", "char_count"));
                if (char_min > 0 && char_min > cnt) {
                    alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
                    return false;
                }
                else if (char_max > 0 && char_max < cnt) {
                    alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
                    return false;
                }
            }
        }

        <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }
    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->