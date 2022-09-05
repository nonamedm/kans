<?php
    include_once('./_common.php');
    $wr_id = $_POST['wr_id'];
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

    $sql_select=sql_query("SELECT * FROM g5_write_forum_req WHERE wr_id = '$wr_id' ");
    $count=sql_num_rows($sql_select);
    if(!$count){
        echo 'fail';
        return false;
    }
    
    $sql="SELECT * FROM g5_write_forum_req WHERE wr_id = '$wr_id', {$rows}";
    $result = sql_query($sql);
    $resultList = array();
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        array_push($result,array('mb_id'=>$row['mb_id'], 'mb_2'=>$row['mb_2'], 'wr_name'=>$row['wr_name'], 'mb_level'=>$row['mb_level'],'mb_hp'=>$row['mb_hp'],'wr_email'=>$row['wr_email'],'attandant_yn'=>$row['attandant_yn'],'wr_id'=>$row['wr_id']));
    }
    
    
    echo $resultList;
?>