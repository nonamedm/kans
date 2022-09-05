<?php
	include_once "./_common.php";
	include_once(G5_EDITOR_LIB);

	/**
	 *	해당페이지 타이틀 및 기본 노출 설정
	 */
	$g5['title'] = "팝업관리 > 인피아드 관리자모드";	//title
	$category_title = "팝업관리";	//카테고리 제목
	$sub_title = "팝업 관리";	//서브 타이틀
	$sub_explan = "홈페이지에 사용되는 메뉴명 및 노출여부를 설정할 수 있습니다."; //페이지 설명

	include_once G5_MANAGE_INCLUDE_PATH . "/admin_header.php";

	if ($w == "u")
	{
		$html_title .= " 수정";
		$sql = " select * from {$g5['new_win_table']} where nw_id = '$nw_id' ";
		$nw = sql_fetch($sql);
		if (!$nw['nw_id']) alert("등록된 자료가 없습니다.");
	}
	else
	{
		$html_title .= " 입력";
		$nw['nw_device'] = 'both';
		$nw['nw_disable_hours'] = 24;
		$nw['nw_left']   = 10;
		$nw['nw_top']    = 10;
		$nw['nw_width']  = 450;
		$nw['nw_height'] = 500;
		$nw['nw_content_html'] = 2;
	}

?>
<h4 class="h4_label">팝업등록/수정</h4>

<form name="frmnewwin" action="./setup_popup_entry_update.php" onsubmit="return frmnewwin_check(this);" method="post">
<input type="hidden" name="w" value="<?php echo $w; ?>">
<input type="hidden" name="nw_id" value="<?php echo $nw_id; ?>">
<input type="hidden" name="token" value="">
<input type="hidden" name="nw_device" value="both" />

	<table class="vertical">
		<colgroup span="4">
			<col width="15%">
			<col width="35%">
			<col width="15%">
			<col width="35%">
		</colgroup>
		<tr>
			<th scope="row">시간</th>
			<td class="" colspan="3">
				<span class="mr20">
				<?if(!$w) $nw[nw_disable_hours]==24?>
					<input type="radio" id="nw_disable_hours_24" name="nw_disable_hours" <?=$nw[nw_disable_hours]==24?"checked":""?> value="24" />
					<label for="">하루</label>
				</span>
				<span class="mr20">
					<input type="radio" id="nw_disable_hours_168" name="nw_disable_hours" <?=$nw[nw_disable_hours]==168?"checked":""?> value="168" />
					<label for="">일주일</label>
				</span>
				<span class="mr20">
					<input type="radio" id="nw_disable_hours_720" name="nw_disable_hours" <?=$nw[nw_disable_hours]==720?"checked":""?> value="720" />
					<label for="">한달</label>
				</span>
			</td>
		</tr>
		<tr>
			<th scope="row">시작일시</th>
			<td class="">
				<input type="text" id="nw_begin_time" name="nw_begin_time" placeholder="YY:MM:DD" value="<?php echo $nw['nw_begin_time']; ?>" />
				<input type="checkbox" name="nw_begin_chk" value="<?php echo date("Y-m-d 00:00:00", G5_SERVER_TIME); ?>" id="nw_begin_chk" onclick="if (this.checked == true) this.form.nw_begin_time.value=this.form.nw_begin_chk.value; else this.form.nw_begin_time.value = this.form.nw_begin_time.defaultValue;">
				<label for="nw_begin_chk">시작일시를 오늘로</label>

			</td>
			<th scope="row">종료일시</th>
			<td class="">
				<input type="text" id="nw_end_time" name="nw_end_time" placeholder="YY:MM:DD" value="<?php echo $nw['nw_end_time']; ?>" />
				<input type="checkbox" name="nw_end_chk" value="<?php echo date("Y-m-d 23:59:59", G5_SERVER_TIME+(60*60*24*7)); ?>" id="nw_end_chk" onclick="if (this.checked == true) this.form.nw_end_time.value=this.form.nw_end_chk.value; else this.form.nw_end_time.value = this.form.nw_end_time.defaultValue;">
            <label for="nw_end_chk">종료일시를 오늘로부터 7일 후로</label>

			</td>
		</tr>
		<!--<tr>
			<th scope="row">창위치 가로 가운데정렬</th>
			<td class="">
				<input type="text" id="" name="">
				픽셀
			</td>
			<th scope="row">창위치 세로 가운데정렬</th>
			<td class="">
				<input type="text" id="" name="">
				픽셀
			</td>
		</tr>-->
		<tr>
			<th scope="row">창위치 왼쪽</th>
			<td class="">
				<input type="text" name="nw_left" value="<?php echo $nw['nw_left']; ?>" id="nw_left" />
				픽셀
			</td>
			<th scope="row">창위치 위쪽</th>
			<td class="">
				<input type="text" name="nw_top" value="<?php echo $nw['nw_top']; ?>" id="nw_top" />
				픽셀
			</td>
		</tr>
		<tr>
			<th scope="row">창크기 가로</th>
			<td class="">
				<input type="text" name="nw_width" value="<?php echo $nw['nw_width'] ?>" id="nw_width" />
				픽셀
			</td>
			<th scope="row">창크기 세로</th>
			<td class="">
				<input type="text" name="nw_height" value="<?php echo $nw['nw_height'] ?>" id="nw_height" />
				픽셀
			</td>
		</tr>
		<tr>
			<th scope="row">제목</th>
			<td colspan="3" class="">
				<input type="text" name="nw_subject" value="<?php echo stripslashes($nw['nw_subject']) ?>" id="nw_subject" placeholder="팝업 제목을 입력하세요. 팝업 제목은 실제 팝업에 노출되지 않습니다." class="w100">
			</td>
		</tr>
		<tr>
			<th scope="row">내용</th>
			<td colspan="3" class="">
				<?php echo editor_html('nw_content', get_text($nw['nw_content'], 0)); ?>
			</td>
		</tr>
		<!--<tr>
			<th scope="row">링크</th>
			<td colspan="3" class="">
				<input type="text" id="" name="" placeholder="http://" class="w100">
				<p class="mt5">
					※ 외부링크값은 "http://"부터 입력하시기 바라며, 외부링크를 입력하시면 팝업 하단에 바로가기 버튼이 자동 노출 됩니다.
				</p>
			</td>
		</tr>-->
	</table>
	<div class="btn_area">
		<div class="btn_area_left"></div>
		<div class="btn_area_center"></div>
		<div class="btn_area_right">
			<button type="submit" class="btn_normal">작성완료</button>
			<button type="button" onclick="location.href='./setup_popup.php'" class="btn_normal">목록</button>
		</div>
	</div>
</form>

<script>
function frmnewwin_check(f)
{
    errmsg = "";
    errfld = "";

    <?php echo get_editor_js('nw_content'); ?>

    check_field(f.nw_subject, "제목을 입력하세요.");

	$("input[name='token']").val(get_ajax_token());

    if (errmsg != "") {
        alert(errmsg);
        errfld.focus();
        return false;
    }
    return true;
}
</script>

<?php
include_once G5_MANAGE_INCLUDE_PATH . "/admin_footer.php";
?>