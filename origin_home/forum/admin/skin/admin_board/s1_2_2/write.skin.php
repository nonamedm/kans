<?php
	if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
	// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
	add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
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
								<select name="ca_name" id="ca_name" required class="required" >
									<option value="">선택하세요</option>
									<?php echo $category_option ?>
								</select>
							</td>
						</tr>
					<?php } ?>
					
					<?php // 해당 게시판의 1번 카테고리 갯수 체크
					$cate_cnt = sql_fetch("SELECT COUNT(*) CNT FROM {$g5['category']} WHERE bo_table='{$bo_table}' AND LENGTH(ca_id)=2");
					if($cate_cnt['CNT']){ ?>
					<tr>
						<th scope="row"><label for="ca_name">교육종류<strong class="sound_only">필수</strong></label></th>
						<td>
							<select name="wr_1" id="wr_1" class="frm_input" onchange="cateload(1, this.value);" required>
								<option value="">선택하세요.</option>
								<?php $cateq = sql_query(" SELECT * FROM {$g5['category']} WHERE bo_table='{$bo_table}' AND LENGTH(ca_id)=2 ORDER BY turn ASC, ca_id ASC ");
								while($row = sql_fetch_array($cateq)){?>
								<option value="<?php echo $row['ca_id']; ?>"><?php echo $row['ca_name']; ?></option>
								<?}?>
							</select>
							<select name="wr_2" id="wr_2" class="frm_input" onchange="cateload(2, this.value);">
								<option value="">상위분류 선택.</option>
							</select>

							<!-- <select name="wr_3" id="wr_3" class="frm_input">
								<option value="">상위분류 선택.</option>
							</select> -->
						</td>
					</tr>
					<?php } ?>

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
					<tr>
						<th scope="row"><label for="wr_subject">교육명<strong class="sound_only">필수</strong></label></th>
						<td>
							<input type="text" id="wr_subject" name="wr_subject" value="<?php echo $subject ?>" required size="50" maxlength="255" class="w100 frm_input required">
							<?php if ($is_member) { // 임시 저장된 글 기능 ?>
								<script src="<?php echo G5_JS_URL; ?>/autosave.js"></script>
								<?php if($editor_content_js) echo $editor_content_js; ?>
							<?php } ?>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="">교육기간</label></th>
						<td>
							<input type="text" id="wr_3" name="wr_3" value="<?php echo $write['wr_3'] ?>" required class="frm_input date_pic required" autocomplete='off'> ~ 
							<input type="text" id="wr_4" name="wr_4" value="<?php echo $write['wr_4'] ?>" class="frm_input date_pic" autocomplete='off'>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="">교육시간</label></th>
						<td>
							<input type="hidden" id="wr_9" name="wr_9" value="<?php echo $write['wr_9'] ?>" />
							<?php $wr_9_ = explode(":", $write['wr_9']); ?>
							<select name="wr_9_h" id="wr_9_h" class="frm_input">
							<?php for($i = 0; $i < 24; $i++){
							    $temp_i = ($i < 10)?"0".$i:$i; ?>
								<option value="<?php echo $temp_i; ?>"><?php echo $temp_i; ?></option>
							<?php } ?>
							</select>:
							<select name="wr_9_m" id="wr_9_m" class="frm_input">
							<?php for($i = 0; $i < 60; $i++){
							    $temp_i = ($i < 10)?"0".$i:$i; ?>
								<option value="<?php echo $temp_i; ?>"><?php echo $temp_i; ?></option>
							<?php } ?>
							</select>
							~
							<?php $wr_10_ = explode(":", $write['wr_10']); ?>
							<input type="hidden" id="wr_10" name="wr_10" value="<?php echo $write['wr_10'] ?>" />
							<select name="wr_10_h" id="wr_10_h" class="frm_input">
							<?php for($i = 0; $i < 24; $i++){
							    $temp_i = ($i < 10)?"0".$i:$i; ?>
								<option value="<?php echo $temp_i; ?>"><?php echo $temp_i; ?></option>
							<?php } ?>
							</select>:
							<select name="wr_10_m" id="wr_10_m" class="frm_input">
							<?php for($i = 0; $i < 60; $i++){
							    $temp_i = ($i < 10)?"0".$i:$i; ?>
								<option value="<?php echo $temp_i; ?>"><?php echo $temp_i; ?></option>
							<?php } ?>
							</select>
							
							<script type="text/javascript">
							$( document ).ready(function() {
								$("#wr_9_h > option[value='<?php echo $wr_9_[0]; ?>']").prop("selected", true);
								$("#wr_9_m > option[value='<?php echo $wr_9_[1]; ?>']").prop("selected", true);

								$("#wr_10_h > option[value='<?php echo $wr_10_[0]; ?>']").prop("selected", true);
								$("#wr_10_m > option[value='<?php echo $wr_10_[1]; ?>']").prop("selected", true);
							});
							</script>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="">교육장소</label></th>
						<td><input type="text" id="wr_content" name="wr_content" value="<?php echo $write['wr_content'] ?>" required class="frm_input required"></td>
					</tr>
					<tr>
						<th scope="row"><label for="">신청인원</label></th>
						<td><input type="number" id="wr_5" name="wr_5" value="<?php echo ($write['wr_5'])?$write['wr_5']:0; ?>" required class="frm_input required"></td>
					</tr>
					<tr>
						<th scope="row"><label for="">지역</label></th>
						<td>
							<?php for($i = 0; $i < count($location_info); $i++){ // $location_info(=지역정보)는 /extend/user.config.php 파일에서 정의 ?>
							<input type="radio" name="wr_6" id="wr_6_<?php echo $i; ?>" value="<?php echo $location_info[$i]; ?>" /><label for="wr_6_<?php echo $i; ?>"> <?php echo $location_info[$i]; ?></label>
							<?php } ?>
							
							<script type="text/javascript">
							$( document ).ready(function() {
								$( "input[type='radio'][name='wr_6'][value='<?php echo $write['wr_6']; ?>']" ).prop( "checked", true);
							});
							</script>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="">교육방식</label></th>
						<td>
							<input type="radio" name="wr_7" id="wr_7_1" value="방문"><label for="wr_7_1"> 방문</label>
							<input type="radio" name="wr_7" id="wr_7_2" value="상설"><label for="wr_7_2"> 상설</label>
							<script type="text/javascript">
							$( document ).ready(function() {
								$( "input[type='radio'][name='wr_7'][value='<?php echo $write['wr_7']; ?>']" ).prop( "checked", true);
							});
							</script>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="">교육비</label></th>
						<td><input type="number" id="wr_8" name="wr_8" value="<?php echo ($write['wr_8'])?$write['wr_8']:0; ?>" required class="frm_input required"></td>
					</tr>
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
							<th scope="row">파일 #<?php echo $i+1 ?></th>
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
				<a href="./board.php?bo_table=<?php echo $bo_table ?>" class="btn_normal">목록</a>
			</div>
		</div>
    </form>

    <script>

	<?if($w=="u"){?>
	$(function(){
		cateload(1, "<?php echo $write['wr_1']; ?>");
		$("#wr_1 option[value='<?php echo $write['wr_1']; ?>']").prop("selected", "true");
		$("#wr_2 option[value='<?php echo $write['wr_2']; ?>']").prop("selected", "true");
	});

	<?}else{?>
	$(function(){
		cateload(1,'<?php echo $cat1; ?>');
		$("#wr_1 option[value='<?php echo $cat1; ?>']").prop("selected", "true");
		$("#wr_2 option[value='<?php echo $cat2; ?>']").prop("selected", "true");
	});	
	<?}?>

	function cateload(su,val){
		// if(su==1) $("#wr_3").html("<option value=''>상위분류 선택.</option>");
		var su2=su+1;

		$.ajax({
			type: 'POST',
			url: '<?php echo G5_URL; ?>/admin/cateload.php?bo_table=<?php echo $bo_table; ?>',
			data: {su: su,val:val},
			cache: false,
			async: false,
			success: function(result) { 
				$("#wr_"+su2).html(result);
			}
		});
	}

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

		f.wr_9.value = f.wr_9_h.value + ":" + f.wr_9_m.value;
		f.wr_10.value = f.wr_10_h.value + ":" + f.wr_10_m.value;

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