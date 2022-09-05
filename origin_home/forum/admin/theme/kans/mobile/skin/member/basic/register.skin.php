<?php
	if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
	// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
	add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>
<div class="mbskin">
	<ul class="step_chart">
		<li class="on">
			<span>STEP01 약관동의</span>
		</li>
		<li>
			<span>STEP02 교육 회원정보입력</span>
		</li>
		<li>
			<span>STEP03 가입완료</span>
		</li>
	</ul>

	<form name="fregister" id="fregister" action="<?php echo $register_action_url ?>" onsubmit="return fregister_submit(this);" method="POST" autocomplete="off">
		<p>교육 회원가입약관 및 개인정보처리방침안내의 내용에 동의하셔야 회원가입 하실 수 있습니다.</p>
		<section id="fregister_term">
			<h2>교육회원가입약관 </h2>
			<fieldset class="fregister_agree">
				<label for="agree11">교육 회원가입약관의 내용에 동의합니다.</label>
				<input type="checkbox" name="agree" value="1" id="agree11">
			</fieldset>
			<textarea readonly><?php echo get_text($config['cf_stipulation']) ?></textarea>
		</section>

		<section id="fregister_private">
			<h2>개인정보처리방침안내</h2>
			<fieldset class="fregister_agree">
				<label for="agree21">개인정보처리방침안내의 내용에 동의합니다.</label>
				<input type="checkbox" name="agree2" value="1" id="agree21">
			</fieldset>
			<textarea readonly><?php echo get_text($config['cf_privacy']) ?></textarea>
		</section>
		<div class="btn_confirm">
			<input type="submit" class="btn_submit" value="회원가입">
		</div>
	</form>

	<script>
		function fregister_submit(f){
			if (!f.agree.checked) {
				alert("회원가입약관의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
				f.agree.focus();
				return false;
			}
			if (!f.agree2.checked) {
				alert("개인정보처리방침안내의 내용에 동의하셔야 회원가입 하실 수 있습니다.");
				f.agree2.focus();
				return false;
			}
			return true;
		}
	</script>
</div>