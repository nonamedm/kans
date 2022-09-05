<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(!$is_admin)
    alert('접근 권한이 없습니다.', G5_URL);

// 4.11

$count_write = 0;
$count_comment = 0;

$tmp_array = array();
    $tmp_array = $_POST['wr_id2'];
	$wr_10=$_POST['wr_10'];
$chk_count = count($tmp_array);

if($chk_count > (G5_IS_MOBILE ? $board['bo_mobile_page_rows'] : $board['bo_page_rows']))
    alert('올바른 방법으로 이용해 주십시오.');

//print_r($_POST);exit;
for ($i=$chk_count-1; $i>=0; $i--)
{

	sql_query("update $write_table set wr_10='0'  where  wr_10='$wr_10[$i]' ");

	sql_query("update $write_table set wr_10='$wr_10[$i]'  where wr_id = '$tmp_array[$i]' ");
	
}

alert('저장하였습니다.','./board.php?bo_table='.$bo_table.'&amp;page='.$page.$qstr);
?>
