<?php
$sub_menu = '300700';
include_once('./_common.php');
include_once(G5_EDITOR_LIB);
include_once G5_MANAGE_INCLUDE_PATH . "/admin_header.php";
auth_check($auth[$sub_menu], "w");

$html_title = 'FAQ';

if ($w == "u")
{
    $html_title .= ' 수정';
    $readonly = ' readonly';

    $sql = " select * from {$g5['faq_master_table']} where fm_id = '$fm_id' ";
    $fm = sql_fetch($sql);
    if (!$fm['fm_id']) alert('등록된 자료가 없습니다.');
}
else
{
    $html_title .= ' 입력';
}

$g5['title'] = $html_title.' 관리';

// 모바일 상하단 내용 필드추가
if(!sql_query(" select fm_mobile_head_html from {$g5['faq_master_table']} limit 1 ", false)) {
    sql_query(" ALTER TABLE `{$g5['faq_master_table']}`
                    ADD `fm_mobile_head_html` text NOT NULL AFTER `fm_tail_html`,
                    ADD `fm_mobile_tail_html` text NOT NULL AFTER `fm_mobile_head_html` ", true);
}

?>

<form name="frmfaqmasterform" action="./faqmasterformupdate.php" onsubmit="return frmfaqmasterform_check(this);" method="post" enctype="MULTIPART/FORM-DATA">
<input type="hidden" name="w" value="<?php echo $w; ?>">
<input type="hidden" name="fm_id" value="<?php echo $fm_id; ?>">
<input type="hidden" name="token" value="">

<div class="tbl_frm01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?></caption>
    <colgroup>
        <col class="grid_4">
        <col>
    </colgroup>
    <tbody>
    <tr>
        <th scope="row"><label for="fm_order">출력순서</label></th>
        <td>
            <?php echo help('숫자가 작을수록 FAQ 분류에서 먼저 출력됩니다.'); ?>
            <input type="text" name="fm_order" value="<?php echo $fm['fm_order']; ?>" id="fm_order" class="frm_input" maxlength="10" size="10">
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="fm_subject">제목</label></th>
        <td>
            <input type="text" value="<?php echo get_text($fm['fm_subject']); ?>" name="fm_subject" id="fm_subject" required class="frm_input required"  size="70">
            <?php if ($w == 'u') { ?>
            <a href="<?php echo G5_BBS_URL; ?>/faq.php?fm_id=<?php echo $fm_id; ?>" class="btn_frmline">보기</a>
            <a href="./faqlist.php?fm_id=<?php echo $fm_id; ?>" class="btn_frmline">상세보기</a>
            <?php } ?>
        </td>
    </tr>
    </tbody>
    </table>
</div>

<div class="btn_confirm01 btn_confirm">
    <input type="submit" value="확인" class="btn_submit" accesskey="s">
    <a href="./faqmasterlist.php">목록</a>
</div>

</form>

<script>
function frmfaqmasterform_check(f)
{
}

// document.frmfaqmasterform.fm_subject.focus();
</script>

<?php
?>
