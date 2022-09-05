<?php
include_once('./_common.php');

$write_table="schedule";
if ($w == 'u' || $w == 'd') {
    $wr = sql_fetch("select * from schedule where idx='$idx'");
    if (!$wr['idx']) {
        alert_close("존재하지 않는 일정입니다.");
    }
}

if($w==""||$w=="u"){
	if (empty($_POST)) {
		alert_close("파일 또는 글내용의 크기가 서버에서 설정한 값을 넘어 오류가 발생하였습니다.\\npost_max_size=".ini_get('post_max_size')." , upload_max_filesize=".$upload_max_filesize."\\n게시판관리자 또는 서버관리자에게 문의 바랍니다.");
	}

	if (!isset($_POST['wr_subject']) || !trim($_POST['wr_subject']))
		alert('제목을 입력하여 주십시오.');
}

if ($w == '' || $w == 'r') {

$allready=sql_fetch("select idx from $write_table where 1 and ((wr_1 between '$wr_1' and '$wr_2' ) or (wr_2 between '$wr_1' and '$wr_2'))  ");
	if($allready[idx]){
	//alert("선택한 날짜엔다른일정이 존재합니다.");
	}
    $sql = " insert into $write_table
                set   cate = '$cate',
                     wr_subject = '$wr_subject',
                     wr_content = '$wr_content',
                     mb_id = '{$member['mb_id']}',
                     wr_datetime = '".G5_TIME_YMDHIS."',
                     wr_last = '".G5_TIME_YMDHIS."',
                     wr_1 = '$wr_1',
                     wr_2 = '$wr_2',
                     wr_3 = '$wr_3',
                     wr_4 = '$wr_4',
                     wr_5 = '$wr_5',
                     wr_6 = '$wr_6',
                     wr_7 = '$wr_7',
                     wr_8 = '$wr_8',
                     wr_9 = '$wr_9',
                     wr_10 = '$wr_10' ";
    sql_query($sql);
    $idx = sql_insert_id();
}  else if ($w == 'u') {
$allready=sql_fetch("select idx from $write_table where 1 and ((wr_1 between '$wr_1' and '$wr_2' ) or (wr_2 between '$wr_1' and '$wr_2')) and idx<>'$idx' ");
	if($allready[idx]){
	//alert("선택한 날짜엔 다른일정이 존재합니다.");
	}

    $sql = " update {$write_table}
                set cate = '{$cate}',
                     wr_subject = '{$wr_subject}',
                     wr_content = '{$wr_content}',
                     mb_id = '{$mb_id}',
                     wr_name = '{$wr_name}',
                     wr_1 = '{$wr_1}',
                     wr_2 = '{$wr_2}',
                     wr_3 = '{$wr_3}',
                     wr_4 = '{$wr_4}',
                     wr_5 = '{$wr_5}',
                     wr_6 = '{$wr_6}',
                     wr_7 = '{$wr_7}',
                     wr_8 = '{$wr_8}',
                     wr_9 = '{$wr_9}',
                     wr_10= '{$wr_10}'
              where idx = '{$wr['idx']}' ";
    sql_query($sql);
}  else if ($w == 'd') {
    $sql = " delete from {$write_table} where idx = '{$wr['idx']}' ";
    sql_query($sql);
}
?>
<script>
opener.datechange(0);
window.close();
</script>