<?php

use Fuel\Upload\Upload;     //composer 이용한 라이브러리

include_once "./_common.php";

check_admin_token();

$filepath = G5_PATH . "/data/file/introduction";

@mkdir($filepath, 0707);
@chmod($filepath, 0707);

$write = sql_fetch(" select * from {$g5['introduct_table']} limit 1");

//파일업로더
$fileUploader = new Upload(array(
    'path' => $filepath,
    'randomize' => true,
    'overwrite' => true
));

if($chk_del_file == "1"){

    @unlink($filepath . "/" . $write['in_file']); //파일삭제

    sql_query(" update {$g5['introduct_table']} set in_file = '', in_file_so = '' "); //DB에서 제거
}


//파일 저장전 로직
$fileUploader->register("before_save", function($e){
    global $g5, $file_path, $write;

    $filename = $e->__get("filename");
    $filename = preg_replace("/\.(php|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $filename);

    $e->__set("filename", $filename);

    //파일이 존재하면 삭제
    if($write['in_file']){
        @unlink($file_path . "/" . $write['in_file']);
        sql_query(" update {$g5['introduct_table']} set in_file = '', in_file_so = '' "); //DB에서 제거
    }
});

$fileUploader->register("after_save", function($e){

    global $g5;	

    if($e['filename'] && $e['error'] == '0') {
        sql_query(" update {$g5['introduct_table']} set in_file = '{$e['filename']}', in_file_so = '$e[name]' ");
    }	
});

$fileUploader->processFiles();
$fileUploader->validate();
$fileUploader->save();

//나머지 정보 업데이트
sql_query(" update {$g5['introduct_table']} set in_content = '$in_content', in_youtube = '$in_youtube', in_use_video = '$in_use_video' ");

alert("소개가 수정되었습니다", "./introduction.php");