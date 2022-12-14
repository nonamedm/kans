<?php
$sub_menu = '500100';
include_once('./_common.php');
include_once(G5_EDITOR_LIB);

auth_check($auth[$sub_menu], "r");

$g5['title'] = '상품판매순위';
include_once G5_MANAGE_INCLUDE_PATH . "/admin_header.php";
include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');

$sql_common = " from {$g5['g5_shop_event_table']} ";

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$sql = "select * $sql_common order by ev_id desc ";
$result = sql_query($sql);
?>

<div class="local_ov01 local_ov">
    전체 이벤트 <?php echo $total_count ?>건
</div>


<div class="btn_add01 btn_add">
    <a href="./itemeventform.php">이벤트 추가</a>
</div>

<div class="tbl_head01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col">이벤트번호</th>
        <th scope="col">제목</th>
        <th scope="col">연결상품</th>
        <th scope="col">사용</th>
        <th scope="col">관리</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {

        $href = "";
        $sql = " select count(ev_id) as cnt from {$g5['g5_shop_event_item_table']} where ev_id = '{$row['ev_id']}' ";
        $ev = sql_fetch($sql);
        if ($ev['cnt']) {
            $href = '<a href="javascript:;" onclick="itemeventwin('.$row['ev_id'].');">';
            $href_close = '</a>';
        }
        if ($row['ev_subject_strong']) $subject = '<strong>'.$row['ev_subject'].'</strong>';
        else $subject = $row['ev_subject'];
    ?>

    <tr>
        <td class="td_num"><?php echo $row['ev_id']; ?></td>
        <td><?php echo $subject; ?></td>
        <td class="td_num"><?php echo $href; ?><?php echo $ev['cnt']; ?><?php echo $href_close; ?></td>
        <td class="td_boolean"><?php echo $row['ev_use'] ? '<span class="txt_true">예</span>' : '<span class="txt_false">아니오</span>'; ?></td>
        <td class="td_mng">
            <a href="./itemeventform.php?w=u&amp;ev_id=<?php echo $row['ev_id']; ?>">수정</a>
            <a href="<?php echo G5_SHOP_URL; ?>/event.php?ev_id=<?php echo $row['ev_id']; ?>">보기</a>
            <a href="./itemeventformupdate.php?w=d&amp;ev_id=<?php echo $row['ev_id']; ?>" onclick="return delete_confirm(this);">삭제</a>
        </td>
    </tr>

    <?php
    }

    if ($i == 0) {
        echo '<tr><td colspan="5" class="empty_table">자료가 없습니다.</td></tr>';
    }
    ?>
    </tbody>
    </table>
</div>

<script>
function itemeventwin(ev_id)
{
    window.open("./itemeventwin.php?ev_id="+ev_id, "itemeventwin", "left=10,top=10,width=500,height=600,scrollbars=1");
}
</script>

<?php
include_once (G5_MANAGE_INCLUDE_PATH.'/admin_footer.php');
?>
