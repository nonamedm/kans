<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Max-Age: 86400');
    header('Access-Control-Allow-Headers: x-requested-with');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    include_once('./_common.php');

    $pushType = $_POST['type'];
    $title = '';
    $body = '';
    if ($pushType == 'forum') {
        $title = '신규 포럼일정 등록';
        $body = '사이트를 확인하세요!';
    } else if ($pushType == 'news') {
        $title = '신규 포럼정보 등록';
        $body = '사이트를 확인하세요!';
    }

    $sql = "SELECT * FROM savetoken";
    $count = sql_query($sql);
    

    for($i=0; $countValue = sql_fetch_array($count); $i++){
        echo $countValue['token'];
        //하나씩 curl 날리기
        $fields = array(
            'to' => $countValue['token'],
            'title' => $title,
            'body' => $body
        );
        $postdata = http_build_query($fields);
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, 'https://api.expo.dev/v2/push/send');
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        echo $result;
    }
    
    
    // async function sendPush(tokenValue) {

        
    //     await fetch('https://api.expo.dev/v2/push/send', {
    //         method: 'POST',
    //         cache: 'no-cache',
    //         headers: {
    //             'Content-Type': 'application/json'
    //         },
    //         body: JSON.stringify({
    //             to: tokenValue,
    //             title: '무야호',
    //             body: '그만큼 신나시는거지'
    //         })
    //     }).then((response) => response.json()).then((data) => {
    //         console.log(data);
    //     });

    // }

    echo 'success';
    
    
    
    
    // echo $token;
?>