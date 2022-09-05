<?php
include_once "./_common.php";

$tmp_array = array();
$tmp_array = $_POST['chk_wr_id'];
$chk_count = count($tmp_array);
$write_table = $_POST[write_table];
for ($i=$chk_count-1; $i>=0; $i--)
{
    
    if($write_table=="schedule_submit2"){
    	$row=sql_fetch("select * from $write_table where idx = '{$tmp_array[$i]}' ");
    	@unlink(G5_DATA_PATH."/room/".$row[fileroot]);
    	
    }
    sql_query(" delete from $write_table where idx = '{$tmp_array[$i]}' ");
}

goto_url($r_page."?page=".$page.$qstr);
?>
