<?php
include_once('./_common.php');

// clean the output buffer
ob_end_clean();

$no = (int)$no;

@include_once($board_skin_path.'/download.head.skin.php');

// 쿠키에 저장된 ID값과 넘어온 ID값을 비교하여 같지 않을 경우 오류 발생
// 다른곳에서 링크 거는것을 방지하기 위한 코드
//if (!get_session('ss_view_'.$bo_table.'_'.$wr_id) && !get_session('s1_1_1_download'))
    //alert('잘못된 접근입니다.');

$file_array = Array("sc_file1", "sc_file2");

$table_name = "site_config";
$sql = "select ".$file_array[$no]." AS bf_file, ".$file_array[$no]."_name AS bf_source from $table_name where sc_no = 1";
$file = sql_fetch($sql);
if (!$file['bf_file'])
    alert_close('파일 정보가 존재하지 않습니다.');

$filepath = G5_DATA_PATH.'/siteinfo/'.$file['bf_file'];
$filepath = addslashes($filepath);
if (!is_file($filepath) || !file_exists($filepath))
    alert('파일이 존재하지 않습니다.');

// 사용자 코드 실행
@include_once($board_skin_path.'/download.skin.php');

$g5['title'] = '다운로드 &gt; '.conv_subject("지명원", 255);

//$original = urlencode($file['bf_source']);
$original = iconv('utf-8', 'euc-kr', $file['bf_source']); // SIR 잉끼님 제안코드

@include_once($board_skin_path.'/download.tail.skin.php');

if(preg_match("/msie/i", $_SERVER['HTTP_USER_AGENT']) && preg_match("/5\.5/", $_SERVER['HTTP_USER_AGENT'])) {
    header("content-type: doesn/matter");
    header("content-length: ".filesize("$filepath"));
    header("content-disposition: attachment; filename=\"$original\"");
    header("content-transfer-encoding: binary");
} else {
    header("content-type: file/unknown");
    header("content-length: ".filesize("$filepath"));
    header("content-disposition: attachment; filename=\"$original\"");
    header("content-description: php generated data");
}
header("pragma: no-cache");
header("expires: 0");
flush();

$fp = fopen($filepath, 'rb');

// 4.00 대체
// 서버부하를 줄이려면 print 나 echo 또는 while 문을 이용한 방법보다는 이방법이...
//if (!fpassthru($fp)) {
//    fclose($fp);
//}

$download_rate = 10;

while(!feof($fp)) {
    //echo fread($fp, 100*1024);
    /*
    echo fread($fp, 100*1024);
    flush();
    */

    print fread($fp, round($download_rate * 1024));
    flush();
    usleep(1000);
}
fclose ($fp);
flush();
?>
