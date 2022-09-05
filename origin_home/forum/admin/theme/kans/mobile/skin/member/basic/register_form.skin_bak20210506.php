<?php
	if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
	// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
	add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
	add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>


<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/themes/base/jquery-ui.css" rel="stylesheet" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
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
			dateFormat: 'yymmdd',
			firstDay: 0,
			isRTL: false,
			showMonthAfterYear: true,
			yearSuffix: ''};
		$.datepicker.setDefaults($.datepicker.regional['ko']);
		$('.date_pic').datepicker({
			buttonText: "달력",
			changeMonth: true,
				dateFormat: 'yy-mm-dd',
			changeYear: true,
			showButtonPanel: true,
			yearRange: 'c-100:c+00'
		});
	});
</script>

<div class="mbskin">
	<ul class="step_chart">
		<li>
			<span>STEP01 약관동의</span>
		</li>
		<li class="on">
			<span>STEP02 회원정보입력</span>
		</li>
		<li>
			<span>STEP03 가입완료</span>
		</li>
	</ul>
	<script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
	<?php if($config['cf_cert_use'] && ($config['cf_cert_ipin'] || $config['cf_cert_hp'])) { ?><script src="<?php echo G5_JS_URL ?>/certify.js"></script><?php } ?>
	<form name="fregisterform" id="fregisterform" action="<?php echo $register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
		<input type="hidden" name="w" value="<?php echo $w ?>">
		<input type="hidden" name="url" value="<?php echo $urlencode ?>">
		<input type="hidden" name="agree" value="<?php echo $agree ?>">
		<input type="hidden" name="agree2" value="<?php echo $agree2 ?>">
		<input type="hidden" name="cert_type" value="<?php echo $member['mb_certify']; ?>">
		<input type="hidden" name="cert_no" value="">
		<input type="hidden" name="mb_1" value="<?php echo $member['mb_1']; ?>">

		<?php if (isset($member['mb_sex'])) { ?><input type="hidden" name="mb_sex" value="<?php echo $member['mb_sex'] ?>"><?php } ?>
		<?php if (isset($member['mb_nick_date']) && $member['mb_nick_date'] > date("Y-m-d", G5_SERVER_TIME - ($config['cf_nick_modify'] * 86400))) { // 닉네임수정일이 지나지 않았다면 ?>
			<input type="hidden" name="mb_nick_default" value="<?php echo get_text($member['mb_nick']) ?>">
			<input type="hidden" name="mb_nick" value="<?php echo get_text($member['mb_nick']) ?>">
		<?php } ?>
		<div  id="register_form">
			<ul class="option_check">
				<li><input type="radio" name="members"><label for="">기관회원가입</label></li>
				<li><input type="radio" name="members"><label for="">개인회원가입</label></li>
			</ul>
			<div class="tbl_frm01 tbl_wrap">
				<table>
					<caption>사이트 이용정보 입력</caption>
					
				</table>
			</div>

			<div class="tbl_frm01 tbl_wrap">
				<table>
					<caption>개인정보 입력</caption>
                    <tr> <!--기관회원가입용-->
                        <th scope="row"><label for="wr_belong1">소속<strong class="sound_only">필수</strong></label></th>
                        <td>
                            <input type="text" name="wr_belong1" value="<?php echo $member['wr_belong1'] ?>" placeholder="소속" id="wr_belong1" class="frm_input1 open_pop <?php echo $required ?> <?php echo $readonly ?>" minlength="3" maxlength="20" <?php echo $required ?> <?php echo $readonly ?> onclick="$('#search_layer').find('input[id=stx]').val('');">
                            <a href="#n" class="btn_st1 btn_search open_pop" onclick="$('#search_layer').find('input[id=stx]').val('');">검색</a>
                        </td>
                    </tr>
					<tr>
						<th scope="row"><label for="">이름<strong class="sound_only">필수</strong></label></th>
						<td>
							<?php if ($config['cf_cert_use']) { ?>
								<span class="frm_info">아이핀 본인확인 후에는 이름이 자동 입력되고 휴대폰 본인확인 후에는 이름과 휴대폰번호가 자동 입력되어 수동으로 입력할수 없게 됩니다.</span>
							<?php } ?>
							<input type="text" id="reg_mb_name" placeholder="담당자" name="mb_name" value="<?php echo get_text($member['mb_name']) ?>" <?php echo $required ?> <?php echo $readonly; ?> class="frm_input <?php echo $required ?> <?php echo $readonly ?>">
							<?php
								if($config['cf_cert_use']) {
									if($config['cf_cert_ipin'])
										echo '<button type="button" id="win_ipin_cert" class="btn_frmline">아이핀 본인확인</button>'.PHP_EOL;
									if($config['cf_cert_hp'] && $config['cf_cert_hp'] != 'lg')
										echo '<button type="button" id="win_hp_cert" class="btn_frmline">휴대폰 본인확인</button>'.PHP_EOL;
									echo '<noscript>본인확인을 위해서는 자바스크립트 사용이 가능해야합니다.</noscript>'.PHP_EOL;
								}
							?>
							<?php
								if ($config['cf_cert_use'] && $member['mb_certify']) {
									if($member['mb_certify'] == 'ipin')
										$mb_cert = '아이핀';
									else
										$mb_cert = '휴대폰';
							?>
								<div id="msg_certify">
									<strong><?php echo $mb_cert; ?> 본인확인</strong><?php if ($member['mb_adult']) { ?> 및 <strong>성인인증</strong><?php } ?> 완료
								</div>
							<?php } ?>
						</td>
					</tr>
					
					<tr>
						<th scope="row">생년월일</th>
						<td>
							<input type="text" readonly  placeholder="생년월일" name="mb_birth" value="<?php echo isset($member['mb_birth'])?$member['mb_birth']:''; ?>" id=""  class="date_pic frm_input " size="50" maxlength="10">
						</td>
					</tr>
					
					<?php if ($config['cf_use_homepage']) { ?>
						<tr>
							<th scope="row"><label for="reg_mb_homepage">홈페이지<?php if ($config['cf_req_homepage']){ ?><strong class="sound_only">필수</strong><?php } ?></label></th>
							<td><input type="url" name="mb_homepage"  placeholder="홈페이지" value="<?php echo get_text($member['mb_homepage']) ?>" id="reg_mb_homepage" class="frm_input <?php echo $config['cf_req_homepage']?"required":""; ?>" maxlength="255" <?php echo $config['cf_req_homepage']?"required":""; ?>></td>
						</tr>
					<?php } ?>
						<tr>
							<th scope="row"><label for="reg_mb_tel">핸드폰 번호<?php if ($config['cf_req_tel']) { ?><strong class="sound_only">필수</strong><?php } ?></label></th>
							<td><input type="text" name="mb_hp" required  placeholder="연락처(핸드폰)" value="<?php echo get_text($member['mb_hp']) ?>" id="reg_mb_hp" class="required frm_input <?php echo $config['cf_req_hp']?"required":""; ?>" maxlength="20" <?php echo $config['cf_req_hp']?"required":""; ?>></td>
						</tr>

						<tr>
							<th scope="row"><label for="reg_mb_id">아이디<strong class="sound_only">필수</strong></label></th>
							<td>
								<input type="text" name="mb_id" value="<?php echo $member['mb_id'] ?>" placeholder="아이디" id="reg_mb_id" class="frm_input <?php echo $required ?> <?php echo $readonly ?>" minlength="3" maxlength="20" <?php echo $required ?> <?php echo $readonly ?>>
								<span id="msg_mb_id"></span>
								<span class="frm_info">영문자, 숫자, _ 만 입력 가능. 최소 3자이상 입력하세요.</span>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="reg_mb_password">비밀번호<strong class="sound_only">필수</strong></label></th>
							<td><input type="password" name="mb_password" id="reg_mb_password" placeholder="비밀번호" class="frm_input <?php echo $required ?>" minlength="3" maxlength="20" <?php echo $required ?>></td>
						</tr>
						<tr>
							<th scope="row"><label for="reg_mb_password_re">비밀번호 확인<strong class="sound_only">필수</strong></label></th>
							<td><input type="password" name="mb_password_re" id="reg_mb_password_re" placeholder="비밀번호 확인" class="frm_input <?php echo $required ?>" minlength="3" maxlength="20" <?php echo $required ?>></td>
						</tr>

						<tr>
						<th scope="row"><label for="reg_mb_email">E-mail<strong class="sound_only">필수</strong></label></th>
						<td>
							<input type="hidden" name="old_email" value="<?php echo $member['mb_email'] ?>">
							<input type="email" placeholder="이메일"  name="mb_email" value="<?php echo isset($member['mb_email'])?$member['mb_email']:''; ?>" id="reg_mb_email" required class="frm_input email required" size="50" maxlength="100">
							<!-- <?php if ($config['cf_use_email_certify']) {  ?>
								<span class="frm_info">
									<?php if ($w=='') { echo "E-mail 로 발송된 내용을 확인한 후 인증하셔야 회원가입이 완료됩니다."; }  ?>
									<?php if ($w=='u') { echo "E-mail 주소를 변경하시면 다시 인증하셔야 합니다."; }  ?>
								</span>
							<?php }  ?> -->
						</td>
						</tr>

						<!-- <tr>
							<th scope="row">주소<?php if ($config['cf_req_addr']) { ?><strong class="sound_only">필수</strong><?php } ?></th>
							<td>
								<label for="reg_mb_zip" class="sound_only">우편번호<?php echo $config['cf_req_addr']?'<strong class="sound_only"> 필수</strong>':''; ?></label>
								<input type="text" required  placeholder="우편번호" name="mb_zip" value="<?php echo $member['mb_zip1'].$member['mb_zip2']; ?>" id="reg_mb_zip" <?php echo $config['cf_req_addr']?"required":""; ?> class="frm_input1 required <?php echo $config['cf_req_addr']?"required":""; ?>" size="5" maxlength="6">
								<button type="button" class="btn_frmline" onclick="win_zip('fregisterform', 'mb_zip', 'mb_addr1', 'mb_addr2', 'mb_addr3', 'mb_addr_jibeon');">주소 검색</button><br>
						
								<label for="reg_mb_addr1"  class="sound_only">주소<?php echo $config['cf_req_addr']?'<strong class="sound_only"> 필수</strong>':''; ?></label>
								<input type="text" placeholder="주소" name="mb_addr1" value="<?php echo get_text($member['mb_addr1']) ?>" id="reg_mb_addr1" <?php echo $config['cf_req_addr']?"required":""; ?> class="required frm_input frm_address <?php echo $config['cf_req_addr']?"required":""; ?>" size="50"><br>
						
								<label for="reg_mb_addr2" class="sound_only">상세주소</label>
								<input type="text" placeholder="상세주소"  name="mb_addr2" value="<?php echo get_text($member['mb_addr2']) ?>" id="reg_mb_addr2" class="required frm_input frm_address" size="50"><br>
						
								<label for="reg_mb_addr3" class="sound_only">참고항목</label>
								<input type="text" placeholder="참고항목"  name="mb_addr3" value="<?php echo get_text($member['mb_addr3']) ?>" id="reg_mb_addr3" class=" frm_input frm_address" size="50" readonly="readonly">
								<input type="hidden" name="mb_addr_jibeon" value="<?php echo get_text($member['mb_addr_jibeon']); ?>">
							</td>
						</tr> -->
				</table>
			</div>

			<div class="tbl_frm05 tbl_wrap">
				<table>
					<caption>기타 개인설정</caption>
					<?php if ($config['cf_use_signature']) { ?>
						<tr>
							<th scope="row"><label for="reg_mb_signature">서명<?php if ($config['cf_req_signature']){ ?><strong class="sound_only">필수</strong><?php } ?></label></th>
							<td><textarea name="mb_signature" placeholder="서명"  id="reg_mb_signature" class="<?php echo $config['cf_req_signature']?"required":""; ?>" <?php echo $config['cf_req_signature']?"required":""; ?>><?php echo $member['mb_signature'] ?></textarea></td>
						</tr>
					<?php } ?>
					<?php if ($config['cf_use_profile']) { ?>
						<tr>
							<th scope="row"><label for="reg_mb_profile">자기소개</label></th>
							<td><textarea name="mb_profile" id="reg_mb_profile" placeholder="자기소개"  class="<?php echo $config['cf_req_profile']?"required":""; ?>" <?php echo $config['cf_req_profile']?"required":""; ?>><?php echo $member['mb_profile'] ?></textarea></td>
						</tr>
					<?php } ?>
					<?php if ($config['cf_use_member_icon'] && $member['mb_level'] >= $config['cf_icon_level']) { ?>
						<tr>
							<th scope="row"><label for="reg_mb_icon">회원아이콘</label></th>
							<td>
								<input type="file" name="mb_icon" id="reg_mb_icon" class="frm_input">
								<?php if ($w == 'u' && file_exists($mb_icon_path)) { ?>
									<img src="<?php echo $mb_icon_url ?>" alt="회원아이콘">
									<input type="checkbox" name="del_mb_icon" value="1" id="del_mb_icon">
									<label for="del_mb_icon">삭제</label>
								<?php } ?>
								<span class="frm_info">
									이미지 크기는 가로 <?php echo $config['cf_member_icon_width'] ?>픽셀, 세로 <?php echo $config['cf_member_icon_height'] ?>픽셀 이하로 해주세요.<br>
									gif만 가능하며 용량 <?php echo number_format($config['cf_member_icon_size']) ?>바이트 이하만 등록됩니다.
								</span>
							</td>
						</tr>
					<?php } ?>
					<?php if ($w == "" && $config['cf_use_recommend']) { ?>
						<tr>
							<th scope="row"><label for="reg_mb_recommend">추천인아이디</label></th>
							<td><input type="text" name="mb_recommend" id="reg_mb_recommend" class="frm_input"></td>
						</tr>
					<?php } ?>
					<tr>
						<th scope="row">자동등록방지</th>
						<td><?php echo captcha_html(); ?></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="btn_confirm">
			<input type="submit" value="<?php echo $w==''?'회원가입':'정보수정'; ?>" id="btn_submit" class="btn_submit" accesskey="s">
			<a href="<?php echo G5_URL; ?>/" class="btn_grd">취소</a>
		</div>
	</form>

	<script>
	$(function() {
		$("#reg_zip_find").css("display", "inline-block");

		<?php if($config['cf_cert_use'] && $config['cf_cert_ipin']) { ?>
		// 아이핀인증
		$("#win_ipin_cert").click(function() {
			if(!cert_confirm())
				return false;

			var url = "<?php echo G5_OKNAME_URL; ?>/ipin1.php";
			certify_win_open('kcb-ipin', url);
			return;
		});

		<?php } ?>
		<?php if($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
		// 휴대폰인증
		$("#win_hp_cert").click(function() {
			if(!cert_confirm())
				return false;

			<?php
			switch($config['cf_cert_hp']) {
				case 'kcb':
					$cert_url = G5_OKNAME_URL.'/hpcert1.php';
					$cert_type = 'kcb-hp';
					break;
				case 'kcp':
					$cert_url = G5_KCPCERT_URL.'/kcpcert_form.php';
					$cert_type = 'kcp-hp';
					break;
				default:
					echo 'alert("기본환경설정에서 휴대폰 본인확인 설정을 해주십시오");';
					echo 'return false;';
					break;
			}
			?>

			certify_win_open("<?php echo $cert_type; ?>", "<?php echo $cert_url; ?>");
			return;
		});
		<?php } ?>
	});

	// 인증체크
	function cert_confirm()
	{
		var val = document.fregisterform.cert_type.value;
		var type;

		switch(val) {
			case "ipin":
				type = "아이핀";
				break;
			case "hp":
				type = "휴대폰";
				break;
			default:
				return true;
		}

		if(confirm("이미 "+type+"으로 본인확인을 완료하셨습니다.\n\n이전 인증을 취소하고 다시 인증하시겠습니까?"))
			return true;
		else
			return false;
	}

	// submit 최종 폼체크
	function fregisterform_submit(f)
	{
		<?php if (isset($member['mb_nick_date']) && $member['mb_nick_date'] > date("Y-m-d", G5_SERVER_TIME - ($config['cf_nick_modify'] * 86400))) {?>
		f.mb_nick.value=f.mb_name.value;
		<?}?>
		// 회원아이디 검사
		if (f.w.value == "") {
			var msg = reg_mb_id_check();
			if (msg) {
				alert(msg);
				f.mb_id.select();
				return false;
			}
		}

		if (f.w.value == '') {
			if (f.mb_password.value.length < 3) {
				alert('비밀번호를 3글자 이상 입력하십시오.');
				f.mb_password.focus();
				return false;
			}
		}

		if (f.mb_password.value != f.mb_password_re.value) {
			alert('비밀번호가 같지 않습니다.');
			f.mb_password_re.focus();
			return false;
		}

		if (f.mb_password.value.length > 0) {
			if (f.mb_password_re.value.length < 3) {
				alert('비밀번호를 3글자 이상 입력하십시오.');
				f.mb_password_re.focus();
				return false;
			}
		}

		// 이름 검사
		if (f.w.value=='') {
			if (f.mb_name.value.length < 1) {
				alert('회사명을 입력하십시오.');
				f.mb_name.focus();
				return false;
			}
		}

		<?php if($w == '' && $config['cf_cert_use'] && $config['cf_cert_req']) { ?>
		// 본인확인 체크
		if(f.cert_no.value=="") {
			alert("회원가입을 위해서는 본인확인을 해주셔야 합니다.");
			return false;
		}
		<?php } ?>

		// E-mail 검사
		if ((f.w.value == "") || (f.w.value == "u" && f.mb_email.defaultValue != f.mb_email.value)) {
			var msg = reg_mb_email_check();
			if (msg) {
				alert(msg);
				f.reg_mb_email.select();
				return false;
			}
		}

		<?php if (($config['cf_use_hp'] || $config['cf_cert_hp']) && $config['cf_req_hp']) {  ?>
		// 휴대폰번호 체크
		var msg = reg_mb_hp_check();
		if (msg) {
			alert(msg);
			f.reg_mb_hp.select();
			return false;
		}
		<?php } ?>

		if (typeof f.mb_icon != 'undefined') {
			if (f.mb_icon.value) {
				if (!f.mb_icon.value.toLowerCase().match(/.(gif)$/i)) {
					alert('회원아이콘이 gif 파일이 아닙니다.');
					f.mb_icon.focus();
					return false;
				}
			}
		}

		if (typeof(f.mb_recommend) != 'undefined' && f.mb_recommend.value) {
			if (f.mb_id.value == f.mb_recommend.value) {
				alert('본인을 추천할 수 없습니다.');
				f.mb_recommend.focus();
				return false;
			}

			var msg = reg_mb_recommend_check();
			if (msg) {
				alert(msg);
				f.mb_recommend.select();
				return false;
			}
		}

		<?php echo chk_captcha_js(); ?>

		document.getElementById("btn_submit").disabled = "disabled";

		return true;
	}
	</script>
</div>