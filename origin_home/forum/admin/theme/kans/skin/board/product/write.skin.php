<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

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
	
	$ca = get_ca_menu(1, $bo_table, '');

    ?>
    
	<h4 class="h4_label">신규상품 등록</h4>
	<table class="vertical">
		<colgroup span="4">
			<col width="15%" />
			<col width="35%" />
			<col width="15%" />
			<col width="35%" />
		</colgroup>
		<tr>
			<th scope="row">분류</th>
			<td colspan="3" class="">
				<select id="wr_1" name="wr_1" title="분류명">
					<option value="">분류명</option>
					<?php 
					
					//분류목록
					foreach($ca as $ca_info){

						$selected = "";

						if($write['wr_1'] == $ca_info->get_ca_id())
							$selected = "selected";

						echo "<option value='{$ca_info->get_ca_id()}' $selected >{$ca_info->get_ca_name()}</option>";
					}

					?>
				</select>
			</td>
		</tr>
		<tr>
			<th scope="row">메뉴명</th>
			<td colspan="3" class="">
				<input type="text" id="wr_subject" name="wr_subject" value="<?php echo $write['wr_subject']?>" class="w100">
			</td>
		</tr>
		<tr>
			<th scope="row">이미지</th>
			<td colspan="3" class="">
				<?php $i = 0;?>
				<input type="file" id="bf_file_0" name="bf_file[]" />
				<?php if($w == 'u' && $file[$i]['file']) { ?>
                <input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일 삭제</label>
                <?php } ?><br /><br />

				<?php $i = 1;?>
				<input type="file" id="bf_file_0" name="bf_file[]" />
				<?php if($w == 'u' && $file[$i]['file']) { ?>
                <input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일 삭제</label>
                <?php } ?>

			</td>
		</tr>
		<tr>
			<th scope="row">가격</th>
			<td colspan="3" class="">
				<input type="text" id="wr_2" name="wr_2" value="<?php echo $write['wr_2']?>" />
				원
				<input type="checkbox" id="wr_3" name="wr_3" value="1" <?php echo ($write['wr_3'] == "1")? "checked" : ""; ?> /> 가격 미노출
			</td>
		</tr>
		<tr>
			<th scope="row">설명</th>
			<td colspan="3" class="">
				<textarea name="wr_content" id="wr_content" rows="" cols=""><?php echo $write['wr_content']?></textarea>
			</td>
		</tr>
		<tr>
			<th scope="row">추천수</th>
			<td colspan="3" class="">
				<input type="text" id="wr_good" name="how_good" value="<?php echo $write['wr_good']?>" />
			</td>
		</tr>
		<tr>
			<th scope="row">노출순서</th>
			<td colspan="3" class="">
				<input type="text" id="wr_order" name="wr_order" value="<?php echo $write['wr_order']?>">
			</td>
		</tr>
	</table>

	<div class="btn_area">
		<div class="btn_area_left"></div>
		<div class="btn_area_center"></div>
		<div class="btn_area_right">
			<button type="submit" class="btn_normal">작성완료</button>
			<button type="button" onclick=" location.href='<?php echo G5_MANAGE_URL?>/board.php?bo_table=<?php echo $bo_table;?>'; " class="btn_normal">목록</button>
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
            alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
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

<!-- } 게시물 작성/수정 끝 -->