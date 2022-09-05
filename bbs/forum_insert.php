<?php
    include_once('./_common.php');

    $wr_id = $_POST['wr_id'];
    $subject = $_POST['subject'];
    $content = $_POST['content'];
    $id = $_POST['id'];
    $hp = $_POST['hp'];
    $pw = $_POST['pw'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $level = $_POST['level'];
    $group = $_POST['group'];

    $sql_select=sql_query("SELECT * FROM g5_write_forum_req WHERE wr_id = '$wr_id' AND mb_id = '$id'");
    $count=sql_num_rows($sql_select);
    if($count){
        echo 'fail';
        return false;
    }
    
    $sql="INSERT INTO g5_write_forum_req(wr_id, wr_subject, wr_content, mb_id, mb_hp, wr_password, wr_name, wr_email, mb_level, mb_2, attendant_yn) 
    values('$wr_id', '$subject', '$content', '$id', '$hp', '$pw', '$name', '$email', '$level', '$group', 'n')";
    sql_query($sql);

    echo 'success';
?>