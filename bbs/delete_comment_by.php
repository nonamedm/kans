<?php
    include_once('./_common.php');
    // error_reporting(E_ALL);
    // ini_set('display_errors', '1');
    
    $wr_id = $_POST["wrId"];
    
    $sql = "select wr_parent from g5_write_community where wr_id='$wr_id'";
    $wr_parent = sql_fetch($sql); //게시글번호 받아오기
    $wr_parent_num = $wr_parent['wr_parent']; //게시글번호 받아오기

    $sql = "select wr_comment from g5_write_community where wr_id='$wr_parent_num'";
    $wr_comment_num = sql_fetch($sql); //댓글개수 받아오기
    $wr_comment_num_val = (int)$wr_comment_num['wr_comment'] - 1; //삭제한 갯수만큼 줄여주기
    
    $sql = "update g5_write_community set wr_comment='$wr_comment_num_val' where wr_id='$wr_parent_num'";
    sql_query($sql); //댓글갯수 맞춰주기
    
    echo $sql;


    $sql = "delete from g5_write_community where wr_id = '$wr_id' and wr_is_comment = '1'";
    sql_query($sql); //댓글하나 삭제
    

    //echo 'success';
?>