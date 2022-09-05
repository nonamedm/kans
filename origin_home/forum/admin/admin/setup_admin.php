<?php
	include_once "./_common.php";
	/**
	 *	해당페이지 타이틀 및 기본 노출 설정
	 */
	$g5['title'] = "환경설정 > 인피아드 관리자모드";	//title
	$category_title = "환경설정";	//카테고리 제목
	$sub_title = "관리자정보";	//서브 타이틀
	$sub_explan = "최초 등록된 아이디는 변경이 불가능 합니다."; //페이지 설명

	include_once G5_MANAGE_INCLUDE_PATH . "/admin_header.php";
	add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
?>
<h4 class="h4_label">비밀번호 변경</h4>

<form method="post" name="fwrite" action="./setup_admin_update.php" onsubmit="">
	<input type="hidden" name="token" value="" />
	<table class="vertical">
		<colgroup span="4">
			<col width="15%" />
			<col width="35%" />
			<col width="15%" />
			<col width="35%" />
		</colgroup>
		<tr>
			<th scope="row">관리자 아이디</th>
			<td colspan="3">
				<input type="text" id="mb_id" name="mb_id" size="20" maxlength="40" value="<?php echo get_text($member['mb_id']);?>" readonly="readonly" class="disable" />
				※ 아이디는 변경이 불가능 합니다.
			</td>
		</tr>
		<tr>
			<th scope="row">관리자 비밀번호</th>
			<td colspan="3">
				<input type="password" id="mb_password" name="mb_password" size="20" maxlength="40">
			</td>
		</tr>
				<tr>
			<th scope="row">관리자 이름</th>
			<td colspan="3">
				<input type="text" id="" name="mb_name" size="20" value="<?=$member[mb_name]?>">
			</td>
		</tr>
				<tr>
			<th scope="row">관리자 핸드폰</th>
			<td colspan="3">
				<input type="text" id="" name="mb_hp" size="20" value="<?=$member[mb_hp]?>">
			</td>
		</tr>
				<tr>
			<th scope="row">관리자 전화번호</th>
			<td colspan="3">
				<input type="text" id="" name="mb_tel" size="20" value="<?=$member[mb_tel]?>">
			</td>
		</tr>
		<tr>
			<th scope="row">관리자 이메일</th>
			<td colspan="3">
				<input type="text" id="" name="mb_email" size="30" value="<?=$member[mb_email]?>">
			</td>
		</tr>

		<tr>
		<th scope="row">관리자 주소</th>
		  <td colspan="3" class="">
            <label for="mb_zip" class="sound_only">우편번호</label>
            <input type="text" name="mb_zip" value="<?php echo $member['mb_zip1'].$member['mb_zip2']; ?>" id="mb_zip" class=" frm_input" readonly size="6" maxlength="6">
            <button type="button" class="btn_frmline" onclick="win_zip('fwrite', 'mb_zip', 'mb_addr1', 'mb_addr2', 'mb_addr3', 'mb_addr_jibeon');">주소 검색</button><br>
            <input type="text" name="mb_addr1" value="<?php echo $member['mb_addr1'] ?>" id="mb_addr1" class=" frm_input" readonly size="60">
            <label for="mb_addr1">기본주소</label><br>
            <input type="text" name="mb_addr2" value="<?php echo $member['mb_addr2'] ?>" id="mb_addr2" class="" size="60">
            <label for="mb_addr2">상세주소</label>
            <br>
            <input type="text" name="mb_addr3" value="<?php echo $member['mb_addr3'] ?>" id="mb_addr3" class="frm_input" readonly size="60">
            <label for="mb_addr3">참고항목</label>
            <input type="hidden" name="mb_addr_jibeon" value="<?php echo $member['mb_addr_jibeon']; ?>"><br>
        </td>
		<tr>
	</table>
</form>

<div class="btn_area">
	<div class="btn_area_left"></div>
	<div class="btn_area_center"></div>
	<div class="btn_area_right">
		<button class="btn_normal" onclick="submit_form()">정보변경</button>
	</div>
</div>

<script>
	function submit_check(f) {
		if($("#mb_password").val() === '') {
			alert("비밀번호를 입력해주세요");
			$("#mb_password").focus();
			return false;
		}

		return true;
	}

	function submit_form() {
		//토큰발급
		$("form[name='fwrite']").find("input[name='token']").val(get_ajax_token());
		$("form[name='fwrite']").submit();

		return true;
	}
</script>

<?php
include_once G5_MANAGE_INCLUDE_PATH . "/admin_footer.php";
?>