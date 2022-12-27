<?php
    include_once('./_common.php');
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    if ($_SESSION['ss_mb_id']) { // 로그인중이라면
    	$member = get_member($_SESSION['ss_mb_id']);
    }
	


    $wr_id = $_POST["wr_id"];   //wr_id 받음, parent_id로 간다.
    $comment_id = $_POST["comment_id2"];
    $wr_content = $_POST["wr_content"];

    
    if (!empty($_POST['wr_email']))
    $wr_email = get_email_address(trim($_POST['wr_email']));

    $sql = "select max(wr_comment) as wr_comment from g5_write_community where wr_parent='$wr_id'";
    $wr_comment = sql_fetch($sql); //게시글번호 받아오기
    $wr_comment_num = (int)$wr_comment['wr_comment']+1; //게시글번호 추가

    $sql = " insert into g5_write_community
        set wr_num = '-1',
            wr_reply  = '',
            wr_parent = '$wr_id',
            wr_is_comment = '1',
            wr_comment = '$wr_comment_num',
            wr_comment_reply = '',
            ca_name = '',
            wr_option = '',
            wr_subject = '',
            wr_content = '$wr_content',
            wr_link1 = '',
            wr_link2 = '',
            wr_link1_hit = '0',
            wr_link2_hit = '0',
            wr_hit = '0',
            wr_good = '0',
            wr_nogood = '0',
            mb_id = '$comment_id',
            wr_password = '',
            wr_name = '$comment_name',
            wr_email = '$wr_email',
            wr_homepage = '',
            wr_file = '0',
            wr_last = '',
            wr_ip = '{$_SERVER['REMOTE_ADDR']}',
            wr_facebook_user = '',
            wr_twitter_user = '',
            wr_1 = '',
            wr_2 = '',
            wr_3 = '',
            wr_4 = '',
            wr_5 = '',
            wr_6 = '',
            wr_7 = '',
            wr_8 = '',
            wr_9 = '',
            wr_10 = '',
            wr_datetime = '".G5_TIME_YMDHIS."'";
    sql_query($sql); //댓글 insert

    $sql = "select count(*) as cnt from g5_write_community where wr_parent = '$wr_id'";
    $matchCnt = sql_fetch($sql); //댓글개수 맞춰주기
    $matchCntVal = (int)$matchCnt['cnt']-1;


    $sql = "update g5_write_community set wr_comment = '$matchCntVal' where wr_id = '$wr_id'";
    sql_query($sql); //댓글개수 맞춰주기

    $prevPage = $_SERVER['HTTP_REFERER'];// 변수에 이전페이지 정보를 저장
    goto_url($prevPage);

    // $sql = "select wr_parent from g5_write_community where wr_id='$wr_id'";
    // $wr_parent = sql_fetch($sql); //게시글번호 받아오기
    // $wr_parent_num = $wr_parent['wr_parent']; //게시글번호 받아오기

    // $sql = "select wr_comment from g5_write_community where wr_id='$wr_parent_num'";
    // $wr_comment_num = sql_fetch($sql); //댓글개수 받아오기
    // $wr_comment_num_val = (int)$wr_comment_num['wr_comment'] - 1; //삭제한 갯수만큼 줄여주기
    
    // $sql = "update g5_write_community set wr_comment='$wr_comment_num_val' where wr_id='$wr_parent_num'";
    // sql_query($sql); //댓글갯수 맞춰주기
    
    // echo $sql;


    // $sql = "delete from g5_write_community where wr_id = '$wr_id' and wr_is_comment = '1'";
    // sql_query($sql); //댓글하나 삭제
    

    //echo 'success';
?>