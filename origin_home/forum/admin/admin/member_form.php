<?php
include_once('./_common.php');

if ($w == '')
{
    $required_mb_id = 'required';
    $required_mb_id_class = 'required alnum_';
    $required_mb_password = 'required';
    $sound_only = '<strong class="sound_only">필수</strong>';

    $mb['mb_mailling'] = 1;
    $mb['mb_open'] = 1;
    $mb['mb_level'] = $config['cf_register_level'];
    $html_title = '추가';
}
else if ($w == 'u')
{
    $mb = get_member($mb_id);
    if (!$mb['mb_id'])
        alert('존재하지 않는 회원자료입니다.');

    if ($is_admin != 'super' && $mb['mb_level'] >= $member['mb_level'])
        alert('자신보다 권한이 높거나 같은 회원은 수정할 수 없습니다.');

    $required_mb_id = 'readonly';
    $required_mb_password = '';
    $html_title = '수정';

    $mb['mb_name'] = get_text($mb['mb_name']);
    $mb['mb_nick'] = get_text($mb['mb_nick']);
    $mb['mb_email'] = get_text($mb['mb_email']);
    $mb['mb_homepage'] = get_text($mb['mb_homepage']);
    $mb['mb_birth'] = get_text($mb['mb_birth']);
    $mb['mb_tel'] = get_text($mb['mb_tel']);
    $mb['mb_hp'] = get_text($mb['mb_hp']);
    $mb['mb_addr1'] = get_text($mb['mb_addr1']);
    $mb['mb_addr2'] = get_text($mb['mb_addr2']);
    $mb['mb_addr3'] = get_text($mb['mb_addr3']);
    $mb['mb_signature'] = get_text($mb['mb_signature']);
    $mb['mb_recommend'] = get_text($mb['mb_recommend']);
    $mb['mb_profile'] = get_text($mb['mb_profile']);
    $mb['mb_1'] = get_text($mb['mb_1']);
    $mb['mb_2'] = get_text($mb['mb_2']);
    $mb['mb_3'] = get_text($mb['mb_3']);
    $mb['mb_4'] = get_text($mb['mb_4']);
    $mb['mb_5'] = get_text($mb['mb_5']);
    $mb['mb_6'] = get_text($mb['mb_6']);
    $mb['mb_7'] = get_text($mb['mb_7']);
    $mb['mb_8'] = get_text($mb['mb_8']);
    $mb['mb_9'] = get_text($mb['mb_9']);
    $mb['mb_10'] = get_text($mb['mb_10']);
}
else
    alert('제대로 된 값이 넘어오지 않았습니다.');

// 본인확인방법
switch($mb['mb_certify']) {
    case 'hp':
        $mb_certify_case = '휴대폰';
        $mb_certify_val = 'hp';
        break;
    case 'ipin':
        $mb_certify_case = '아이핀';
        $mb_certify_val = 'ipin';
        break;
    case 'admin':
        $mb_certify_case = '관리자 수정';
        $mb_certify_val = 'admin';
        break;
    default:
        $mb_certify_case = '';
        $mb_certify_val = 'admin';
        break;
}

// 본인확인
$mb_certify_yes  =  $mb['mb_certify'] ? 'checked="checked"' : '';
$mb_certify_no   = !$mb['mb_certify'] ? 'checked="checked"' : '';

// 성인인증
$mb_adult_yes       =  $mb['mb_adult']      ? 'checked="checked"' : '';
$mb_adult_no        = !$mb['mb_adult']      ? 'checked="checked"' : '';

//메일수신
$mb_mailling_yes    =  $mb['mb_mailling']   ? 'checked="checked"' : '';
$mb_mailling_no     = !$mb['mb_mailling']   ? 'checked="checked"' : '';

// SMS 수신
$mb_sms_yes         =  $mb['mb_sms']        ? 'checked="checked"' : '';
$mb_sms_no          = !$mb['mb_sms']        ? 'checked="checked"' : '';

// 정보 공개
$mb_open_yes        =  $mb['mb_open']       ? 'checked="checked"' : '';
$mb_open_no         = !$mb['mb_open']       ? 'checked="checked"' : '';

if (isset($mb['mb_certify'])) {
    // 날짜시간형이라면 drop 시킴
    if (preg_match("/-/", $mb['mb_certify'])) {
        sql_query(" ALTER TABLE `{$g5['member_table']}` DROP `mb_certify` ", false);
    }
} else {
    sql_query(" ALTER TABLE `{$g5['member_table']}` ADD `mb_certify` TINYINT(4) NOT NULL DEFAULT '0' AFTER `mb_hp` ", false);
}

if(isset($mb['mb_adult'])) {
    sql_query(" ALTER TABLE `{$g5['member_table']}` CHANGE `mb_adult` `mb_adult` TINYINT(4) NOT NULL DEFAULT '0' ", false);
} else {
    sql_query(" ALTER TABLE `{$g5['member_table']}` ADD `mb_adult` TINYINT NOT NULL DEFAULT '0' AFTER `mb_certify` ", false);
}

// 지번주소 필드추가
if(!isset($mb['mb_addr_jibeon'])) {
    sql_query(" ALTER TABLE {$g5['member_table']} ADD `mb_addr_jibeon` varchar(255) NOT NULL DEFAULT '' AFTER `mb_addr2` ", false);
}

// 건물명필드추가
if(!isset($mb['mb_addr3'])) {
    sql_query(" ALTER TABLE {$g5['member_table']} ADD `mb_addr3` varchar(255) NOT NULL DEFAULT '' AFTER `mb_addr2` ", false);
}

// 중복가입 확인필드 추가
if(!isset($mb['mb_dupinfo'])) {
    sql_query(" ALTER TABLE {$g5['member_table']} ADD `mb_dupinfo` varchar(255) NOT NULL DEFAULT '' AFTER `mb_adult` ", false);
}

// 이메일인증 체크 필드추가
if(!isset($mb['mb_email_certify2'])) {
    sql_query(" ALTER TABLE {$g5['member_table']} ADD `mb_email_certify2` varchar(255) NOT NULL DEFAULT '' AFTER `mb_email_certify` ", false);
}


/**
 *	해당페이지 타이틀 및 기본 노출 설정
 */
$g5['title'] = "환경설정 > 인피아드 관리자모드";	//title
$category_title = "회원관리";	//카테고리 제목
$sub_title = "회원추가";	//서브 타이틀

include_once G5_MANAGE_INCLUDE_PATH . "/admin_header.php";

// add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
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

	// 소속 정보 검색 팝업 열기
	function open_search_member(val1, val2){
		window.open("./pop_search.php?val1=" + val1 + "&val2=" + val2, "serachWindow", "toolbar=yes,scrollbars=yes,resizable=yes,top=200,left=500,width=400,height=600");
	}
</script>

<form name="fmember" id="fmember" action="./member_form_update.php" onsubmit="return fmember_submit(this);" method="post" enctype="multipart/form-data">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="token" value="">
	
	<input type="hidden" name="mb_nick" id="mb_nick" value="<?php echo $mb['mb_nick'];?>">

    <div class="">
        <h4 class="h4_label">회원추가</h4>
        <table class="vertical mb20">            
            <colgroup>
                <col class="grid_4">
                <col>
                <col class="grid_4">
                <col>
            </colgroup>
            <tbody>
            <tr>
                <th scope="row"><label for="mb_id">아이디<?php echo $sound_only ?></label></th>
                <td>
                    <input type="text" name="mb_id" value="<?php echo $mb['mb_id'] ?>" id="mb_id" <?php echo $required_mb_id ?> class="frm_input <?php echo $required_mb_id_class ?>" size="15" minlength="3" maxlength="20">
                    <?php if ($w=='u'){ ?><!-- <a href="./boardgroupmember_form.php?mb_id=<?php echo $mb['mb_id'] ?>">접근가능그룹보기</a> --><?php } ?>
                </td>
                <th scope="row"><label for="mb_password">비밀번호<?php echo $sound_only ?></label></th>
                <td><input type="password" name="mb_password" id="mb_password" <?php echo $required_mb_password ?> class="frm_input <?php echo $required_mb_password ?>" size="15" maxlength="20"></td>
            </tr>

			<tr>
				<th scope="row"><label for="">소속</label></th>
				<td>
					<input type="hidden" name="mb_1" id="mb_1" value="<?php echo $mb['mb_1'];?>">
					<input type="text" name="mb_2" value="<?php echo $mb['mb_2']; ?>" id="mb_2" class="frm_input" onclick="open_search_member('mb_1', 'mb_2');" readonly >
				</td>
				<th scope="row"><label for="">등급</label></th>
				<td>
					<select name="mb_level" id="mb_level">
						<option value="">선택해주세요.</option>
						<option value="2">교육생(개인)</option>
						<option value="3">교육담당자(단체)</option>
					</select>
					<script type="text/javascript">
					$( document ).ready(function() {
						$( "#mb_level > option[value='<?php echo $mb['mb_level']; ?>']" ).prop( "selected", true);
					});
					</script>
				</td>
			</tr>

            <!--
			<tr>
                <th scope="row"><label for="mb_name">이름(실명)<strong class="sound_only">필수</strong></label></th>
                <td colspan="3"><input type="text" name="mb_name" value="<?php echo $mb['mb_name'] ?>" id="mb_name" required class="required frm_input" size="15" minlength="2" maxlength="20"></td>
            </tr>
            -->
			<tr>
				<th scope="row"><label for="mb_name">이름(실명)<strong class="sound_only">필수</strong></label></th>
				<td><input type="text" name="mb_name" value="<?php echo $mb['mb_name'] ?>" id="mb_name" required class="required frm_input" size="15" minlength="2" maxlength="20"></td>
				<!-- <th scope="row"><label for="mb_birth">생년월일</label></th>
				<td><input type="text" name="mb_birth" value="<?php echo $mb['mb_birth'] ?>" id="mb_birth" class="frm_input date_pic" size="15" maxlength="10" readonly></td> -->
				<th scope="row"><label for="mb_birth">생년월일</label></th>
				<td>
					<input type="text" name="mb_3" value="<?php echo $mb['mb_3']; ?>" maxlength="6" class="frm_input input_bith">  - 
					<input type="text" name="mb_4" value="<?php echo $mb['mb_4']; ?>" size="2" maxlength="1" class="frm_input input_bith" >
					<script type="text/javascript">
					$( document ).ready(function() {
						$( ".input_bith" ).on( "keyup", function() {
							var text = $( this ).val();				// 현재 입력 값
							var regex = /[^0-9]/g;					// 숫자가 아닌 문자열을 선택하는 정규식
							var result = text.replace(regex, "");	// 숫자가 아닌 문자열 지우기
							$( this ).val(result);					// 정규식 된 값 입력
						});
					});
					</script>
				</td>
			</tr>
			<?php if($config['cf_use_hp']){ ?>
			<tr>
                <th scope="row"><label for="mb_hp">핸드폰 번호</label></th>
                 <td colspan="3"><input type="text" name="mb_hp" value="<?php echo $mb['mb_hp'] ?>" id="mb_hp" class="frm_input" size="15" maxlength="20"></td>
            </tr>
			<?php } ?>
			<tr>
                <th scope="row"><label for="mb_email">E-mail<strong class="sound_only">필수</strong></label></th>
                <td colspan="3"><input type="text" name="mb_email" value="<?php echo $mb['mb_email'] ?>" id="mb_email" maxlength="100" required class="required frm_input email" size="30"></td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_tel">전화번호</label></th>
                 <td colspan="3"><input type="text" name="mb_tel" value="<?php echo $mb['mb_tel'] ?>" id="mb_tel" class="frm_input" size="15" maxlength="20"></td>
            </tr>

			

            <!--tr>
                <th scope="row">본인확인방법</th>
                <td colspan="3">
                    <input type="radio" name="mb_certify_case" value="ipin" id="mb_certify_ipin" <?php if($mb['mb_certify'] == 'ipin') echo 'checked="checked"'; ?>>
                    <label for="mb_certify_ipin">아이핀</label>
                    <input type="radio" name="mb_certify_case" value="hp" id="mb_certify_hp" <?php if($mb['mb_certify'] == 'hp') echo 'checked="checked"'; ?>>
                    <label for="mb_certify_hp">휴대폰</label>
                </td>
            </tr>
            <tr>
                <th scope="row">본인확인</th>
                <td>
                    <input type="radio" name="mb_certify" value="1" id="mb_certify_yes" <?php echo $mb_certify_yes; ?>>
                    <label for="mb_certify_yes">예</label>
                    <input type="radio" name="mb_certify" value="" id="mb_certify_no" <?php echo $mb_certify_no; ?>>
                    <label for="mb_certify_no">아니오</label>
                </td>
                <th scope="row"><label for="mb_adult">성인인증</label></th>
                <td>
                    <input type="radio" name="mb_adult" value="1" id="mb_adult_yes" <?php echo $mb_adult_yes; ?>>
                    <label for="mb_adult_yes">예</label>
                    <input type="radio" name="mb_adult" value="0" id="mb_adult_no" <?php echo $mb_adult_no; ?>>
                    <label for="mb_adult_no">아니오</label>
                </td>
            </tr-->
            <?php if($config['cf_use_addr']){ ?>
			<tr>
                <th scope="row">주소</th>
                <td colspan="3" class="td_addr_line">
                    <label for="mb_zip" class="sound_only">우편번호</label>
                    <input type="text" name="mb_zip" value="<?php echo $mb['mb_zip1'].$mb['mb_zip2']; ?>" id="mb_zip" class="frm_input readonly" size="5" maxlength="6">
                    <button type="button" class="btn_frmline" onclick="win_zip('fmember', 'mb_zip', 'mb_addr1', 'mb_addr2', 'mb_addr3', 'mb_addr_jibeon');">주소 검색</button><br>
                    <input type="text" name="mb_addr1" value="<?php echo $mb['mb_addr1'] ?>" id="mb_addr1" class="frm_input readonly" size="60">
                    <label for="mb_addr1">기본주소</label><br>
                    <input type="text" name="mb_addr2" value="<?php echo $mb['mb_addr2'] ?>" id="mb_addr2" class="frm_input" size="60">
                    <label for="mb_addr2">상세주소</label>
                    <br>
                    <input type="text" name="mb_addr3" value="<?php echo $mb['mb_addr3'] ?>" id="mb_addr3" class="frm_input" size="60">
                    <label for="mb_addr3">참고항목</label>
                    <input type="hidden" name="mb_addr_jibeon" value="<?php echo $mb['mb_addr_jibeon']; ?>"><br>
                </td>
            </tr>
			<?php } ?>
            <!--tr>
                <th scope="row"><label for="mb_icon">회원아이콘</label></th>
                <td colspan="3">
                    <?php echo help('이미지 크기는 <strong>넓이 '.$config['cf_member_icon_width'].'픽셀 높이 '.$config['cf_member_icon_height'].'픽셀</strong>로 해주세요.') ?>
                    <input type="file" name="mb_icon" id="mb_icon">
                    <?php
                    $mb_dir = substr($mb['mb_id'],0,2);
                    $icon_file = G5_DATA_PATH.'/member/'.$mb_dir.'/'.$mb['mb_id'].'.gif';
                    if (file_exists($icon_file)) {
                        $icon_url = G5_DATA_URL.'/member/'.$mb_dir.'/'.$mb['mb_id'].'.gif';
                        echo '<img src="'.$icon_url.'" alt="">';
                        echo '<input type="checkbox" id="del_mb_icon" name="del_mb_icon" value="1">삭제';
                    }
                    ?>
                </td>
            </tr-->
<!--            <tr>-->
<!--                <th scope="row"><label for="mb_signature">서명</label></th>-->
<!--                <td colspan="3"><textarea  name="mb_signature" id="mb_signature">--><?php //echo $mb['mb_signature'] ?><!--</textarea></td>-->
<!--            </tr>-->
            <!--tr>
                <th scope="row"><label for="mb_profile">자기 소개</label></th>
                <td colspan="3"><textarea name="mb_profile" id="mb_profile"><?php echo $mb['mb_profile'] ?></textarea></td>
            </tr>
            <tr>
                <th scope="row"><label for="mb_memo">메모</label></th>
                <td colspan="3"><textarea name="mb_memo" id="mb_memo"><?php echo $mb['mb_memo'] ?></textarea></td>
            </tr-->

            <?php if ($w == 'u') { ?>
                <tr>
                    <th scope="row">회원가입일</th>
                    <td><?php echo $mb['mb_datetime'] ?></td>
                    <th scope="row">최근접속일</th>
                    <td><?php echo $mb['mb_today_login'] ?></td>
                </tr>
                <tr>
                    <th scope="row">IP</th>
                    <td colspan="3"><?php echo $mb['mb_ip'] ?></td>
                </tr>
                <?php if ($config['cf_use_email_certify']) { ?>
                    <tr>
                        <th scope="row">인증일시</th>
                        <td colspan="3">
                            <?php if ($mb['mb_email_certify'] == '0000-00-00 00:00:00') { ?>
                                <?php echo help('회원님이 메일을 수신할 수 없는 경우 등에 직접 인증처리를 하실 수 있습니다.') ?>
                                <input type="checkbox" name="passive_certify" id="passive_certify">
                                <label for="passive_certify">수동인증</label>
                            <?php } else { ?>
                                <?php echo $mb['mb_email_certify'] ?>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            <?php } ?>

            <?php if ($config['cf_use_recommend']) { // 추천인 사용 ?>
                <tr>
                    <th scope="row">추천인</th>
                    <td colspan="3"><?php echo ($mb['mb_recommend'] ? get_text($mb['mb_recommend']) : '없음'); // 081022 : CSRF 보안 결함으로 인한 코드 수정 ?></td>
                </tr>
            <?php } ?>

            <tr>
                <th scope="row"><label for="mb_leave_date">탈퇴일자</label></th>
                <td>
                    <input type="text" name="mb_leave_date" value="<?php echo $mb['mb_leave_date'] ?>" id="mb_leave_date" class="frm_input" maxlength="8">
                    <input type="checkbox" value="<?php echo date("Ymd"); ?>" id="mb_leave_date_set_today" onclick="if (this.form.mb_leave_date.value==this.form.mb_leave_date.defaultValue) {
this.form.mb_leave_date.value=this.value; } else { this.form.mb_leave_date.value=this.form.mb_leave_date.defaultValue; }">
                    <label for="mb_leave_date_set_today">탈퇴일을 오늘로 지정</label>
                </td>
                <th scope="row">접근차단일자</th>
                <td>
                    <input type="text" name="mb_intercept_date" value="<?php echo $mb['mb_intercept_date'] ?>" id="mb_intercept_date" class="frm_input" maxlength="8">
                    <input type="checkbox" value="<?php echo date("Ymd"); ?>" id="mb_intercept_date_set_today" onclick="if
(this.form.mb_intercept_date.value==this.form.mb_intercept_date.defaultValue) { this.form.mb_intercept_date.value=this.value; } else {
this.form.mb_intercept_date.value=this.form.mb_intercept_date.defaultValue; }">
                    <label for="mb_intercept_date_set_today">접근차단일을 오늘로 지정</label>
                </td>
            </tr>

            <?php /*for ($i=1; $i<=10; $i++) { ?>
                <tr>
                    <th scope="row"><label for="mb_<?php echo $i ?>">여분 필드 <?php echo $i ?></label></th>
                    <td colspan="3"><input type="text" name="mb_<?php echo $i ?>" value="<?php echo $mb['mb_'.$i] ?>" id="mb_<?php echo $i ?>" class="frm_input" size="30" maxlength="255"></td>
                </tr>
            <?php } */?>

            </tbody>
        </table>
    </div>

    <div class="btn_area">
        <div class="btn_area_right">
            <input type="submit" value="확인" class="btn_normal" accesskey='s'>
            <a href="./member_list.php?<?php echo $qstr ?>" class="btn_normal">목록</a>
        </div>
    </div>

</form>

<script>
    function fmember_submit(f)
    {
        if (!f.mb_icon.value.match(/\.gif$/i) && f.mb_icon.value) {
            alert('아이콘은 gif 파일만 가능합니다.');
            return false;
        }

        return true;
    }
</script>

<?php
include_once G5_MANAGE_INCLUDE_PATH . "/admin_footer.php";
?>
