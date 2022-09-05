<?php
include_once('./_common.php');
$write_table="schedule_holiday";
if ($w == 'u' || $w == 'd') {
    $wr = sql_fetch("select * from schedule_holiday where idx='$idx'");
    if (!$wr['idx']) {
        alert_close("존재하지 않는 일정입니다.");
    }
}
if($w==""||$w=="u"){
	if (empty($_POST)) {
		alert_close("파일 또는 글내용의 크기가 서버에서 설정한 값을 넘어 오류가 발생하였습니다.\\npost_max_size=".ini_get('post_max_size')." , upload_max_filesize=".$upload_max_filesize."\\n게시판관리자 또는 서버관리자에게 문의 바랍니다.");
	}

}

if ($w == '' || $w == 'r') {
	/*
	$allready=sql_fetch("select idx from $write_table where 1 and ((start_date between '$start_date' and '$end_date' ) or (end_date between '$start_date' and '$end_date'))  ");
	if($allready[idx]){
		alert("선택한 날짜엔다른 휴일이 등록되어 있습니다.");
	}
	*/
    $sql = " insert into $write_table
           	       set  title = '$title',
                    start_date = '$start_date',
                    end_date = '$end_date',
					time1='$time1',
					time2='$time2'";
    sql_query($sql);
}  else if ($w == 'u') {
	/*
	$allready=sql_fetch("select idx from $write_table where 1 and ((start_date between '$start_date' and '$end_date' ) or (end_date between '$start_date' and '$end_date')) and idx<>'$idx' ");
	if($allready[idx]){
		alert("선택한 날짜엔다른 휴일이 등록되어 있습니다.");
	}
	*/
    $sql = " update {$write_table}
                	set title = '$title',
                     start_date = '$start_date',
                     end_date = '$end_date',
					time1='$time1',
					time2='$time2'
              where idx = '{$wr['idx']}' ";
    sql_query($sql);
}  else if ($w == 'd') {
    $sql = " delete from {$write_table} where idx = '{$wr['idx']}' ";
    sql_query($sql);
}
?>
<script>
parent.$("#cal_form").submit();
parent.$('.layer_popup').dialog('close');
</script>