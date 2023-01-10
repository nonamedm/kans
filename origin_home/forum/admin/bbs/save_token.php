<?php
    include_once('./_common.php');

    $token = $_GET['token'];
    if ($token == '') {
        echo "fail : 토큰값이 전달되지 않았습니다.";
    } else {
        $sql = "SELECT * FROM savetoken WHERE token='$token'";
        $count = sql_query($sql);
        
        $countRow = sql_num_rows($count);
        
        if ($countRow == 0) {
            $sql = "INSERT INTO savetoken set token='$token'";
            sql_query($sql);
            echo 'success';
        } else {
            echo 'fail : 토큰값 중복';
        }
    }
    // echo $token;
?>