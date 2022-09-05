<?php
    include_once('./_common.php');
    $gd_val = '1';
    if($_POST['gd_val']=="관리자") {
        $gd_val = '5';
    } else if ($_POST['gd_val']=="정회원") {
        $gd_val = '2';
    } else {
        $gd_val = '1';
    }
    $gd_id = $_POST['gd_id'];
    // $wr_id = $_POST['wr_id'];
    // $subject = $_POST['subject'];
    // $content = $_POST['content'];
    // $id = $_POST['id'];
    // $hp = $_POST['hp'];
    // $pw = $_POST['pw'];
    // $name = $_POST['name'];
    // $email = $_POST['email'];
    // $level = $_POST['level'];
    // $group = $_POST['group'];

    $sql_select=sql_query("SELECT * FROM g5_member WHERE mb_id = '$gd_id' ");
    $count=sql_num_rows($sql_select);
    if(!$count){
        echo 'fail';
        return false;
    }
    
    $sql="UPDATE g5_member SET mb_level='$gd_val' WHERE mb_id = '$gd_id' ";
    sql_query($sql);
    
    echo 'success';
?>