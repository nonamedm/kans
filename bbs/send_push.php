<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Max-Age: 86400');
    header('Access-Control-Allow-Headers: x-requested-with');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    include_once('./_common.php');

    $title = '포럼 D-day 알림';
    $body = '신청하신 포럼 일정을 확인하세요!';

    $pushType = $_POST['type'];
    if ($pushType == 'forum') {
        $title = '신규 포럼일정 등록';
        $body = '사이트를 확인하세요!';

        $headings = array("en" => $title);
        $content = array("en" => $body);
        $data = array("custom_url" => '');
        $ios_attachments = array("id1" => '');
        $include_player_ids = array();


        $fields = array(
            'app_id' => 'b215f7a3-e6fc-43a0-9b60-0bab7c7bad07',
            'included_segments' => 'All', //전체사용자 -> 비어있음
            'include_player_ids' => $include_player_ids, //개별사용자 -> 비어있음
            'headings' => $headings, //푸시 타이틀
            'contents' => $content, //푸시 내용
            'data' => $data,
            'small_icon' => 'icon_48', //상태바 표시 icon
            'big_picture' => '', //안드로이드 푸시 이미지
            'ios_attachments'=> $ios_attachments, //iOS 푸시 이미지
            'ios_badgeType' => 'Increase', //ios badge counter
            'ios_badgeCount' => 1, //ios badge counter by 1
        );
        $fields = json_encode($fields);
    
    
        //$postdata = http_build_query($fields);
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, 'https://onesignal.com/api/v1/notifications');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8','Authorization: Basic N2EzY2M4NzMtZDlhZi00YTQ3LTgzMDgtMmYwNDA1ZGEyMmJj'));
    
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    
    
        $result = curl_exec($ch);
        curl_close($ch);
        echo $result;
    } else if ($pushType == 'news') {
        $title = '신규 포럼정보 등록';
        $body = '사이트를 확인하세요!';

        $headings = array("en" => $title);
        $content = array("en" => $body);
        $data = array("custom_url" => '');
        $ios_attachments = array("id1" => '');
        $include_player_ids = array();


        $fields = array(
            'app_id' => 'b215f7a3-e6fc-43a0-9b60-0bab7c7bad07',
            'included_segments' => 'All', //전체사용자 -> All
            'include_player_ids' => $include_player_ids, //개별사용자 -> 비어있음
            'headings' => $headings, //푸시 타이틀
            'contents' => $content, //푸시 내용
            'data' => $data,
            'small_icon' => 'icon_48', //상태바 표시 icon
            'big_picture' => '', //안드로이드 푸시 이미지
            'ios_attachments'=> $ios_attachments, //iOS 푸시 이미지
            'ios_badgeType' => 'Increase', //ios badge counter
            'ios_badgeCount' => 1, //ios badge counter by 1
        );
        $fields = json_encode($fields);
    
    
        //$postdata = http_build_query($fields);
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, 'https://onesignal.com/api/v1/notifications');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8','Authorization: Basic N2EzY2M4NzMtZDlhZi00YTQ3LTgzMDgtMmYwNDA1ZGEyMmJj'));
    
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    
    
        $result = curl_exec($ch);
        curl_close($ch);
        echo $result;
    } else {
        $toDay = date('Y-m-d'); //오늘
        $sql = 'SELECT mb.mb_10 FROM g5_member mb, g5_write_forum_req fr WHERE mb.mb_id = fr.mb_id AND fr.wr_id = (SELECT wr_id FROM g5_write_forum_info WHERE wr_1 = "'.$toDay.'" LIMIT 1)';
        
        // echo '<script>';
        // echo 'console.log('."$sql".')';
        // echo '</script>';
        $count = sql_query($sql);
    
        $headings = array("en" => $title);
        $content = array("en" => $body);
        $data = array("custom_url" => '');
        $ios_attachments = array("id1" => '');
        $include_player_ids = array();
        for($i=0; $countValue = sql_fetch_array($count); $i++){
            if($countValue['mb_10']!=''){
                array_push($include_player_ids, $countValue['mb_10']);
            }
    
        }
        // echo "<pre>\n";
        // print_r($include_player_ids);
        // echo "</pre>\n";
        if (count($include_player_ids) > 0) {
            $fields = array(
                'app_id' => 'b215f7a3-e6fc-43a0-9b60-0bab7c7bad07',
                'included_segments' => '', //전체사용자 -> 비어있음
                'include_player_ids' => $include_player_ids,
                'headings' => $headings, //푸시 타이틀
                'contents' => $content, //푸시 내용
                'data' => $data,
                'small_icon' => 'icon_48', //상태바 표시 icon
                'big_picture' => '', //안드로이드 푸시 이미지
                'ios_attachments'=> $ios_attachments, //iOS 푸시 이미지
                'ios_badgeType' => 'Increase', //ios badge counter
                'ios_badgeCount' => 1, //ios badge counter by 1
            );
            $fields = json_encode($fields);
        
        
            //$postdata = http_build_query($fields);
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL, 'https://onesignal.com/api/v1/notifications');
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8','Authorization: Basic N2EzY2M4NzMtZDlhZi00YTQ3LTgzMDgtMmYwNDA1ZGEyMmJj'));
        
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    
        
            $result = curl_exec($ch);
            curl_close($ch);
            echo $result;
        }
    }
    

    echo '<br>success';


    
?>