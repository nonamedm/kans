<?php
    include_once('./_common.php');
    $attend_yn = $_POST['attend_yn'];
    
    $gd_id = $_POST['gd_id'];
    $wr_id = $_POST['wr_id'];
    $level = $_POST['level'];
    // $wr_id = $_POST['wr_id'];
    // $subject = $_POST['subject'];
    // $content = $_POST['content'];
    // $id = $_POST['id'];
    // $hp = $_POST['hp'];
    // $pw = $_POST['pw'];
    // $name = $_POST['name'];
    // $email = $_POST['email'];
    // $group = $_POST['group'];

    $sql_select=sql_query("SELECT * FROM g5_write_forum_req WHERE mb_id = '$gd_id' AND wr_id = '$wr_id' ");
    $count=sql_num_rows($sql_select);
    if(!$count){
        echo 'fail';
        return false;
    }
    if ($level > 4) {
        $sql="UPDATE g5_write_forum_req SET attendant_yn='$attend_yn' WHERE mb_id = '$gd_id' AND wr_id = '$wr_id' ";
        echo $sql;
        sql_query($sql);
    } else {
        echo 'fail';
    }    
    echo 'success';
?>