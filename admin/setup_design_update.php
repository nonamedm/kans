<?php

include_once ("./_common.php");

//check_admin_token();

use Fuel\Upload\Upload;     //composer 이용한 라이브러리

$file_path = G5_PATH . "/data/file/prod_file/";

$fileUploader = new Upload(array(
    'path' => $file_path,
    'randomize' => true,
    'overwrite' => true
));

//삭제 체크박스가 체크되어있으면
if($chk_file_del){
    foreach($chk_file_del as $key => $value){
        $file_result = sql_fetch(" select * from " . $g5['design_file_table'] . " where ds_no = '$key' ");			
        @unlink("{$file_path}$file_result[ds_file]");

        sql_query("delete from " . $g5['design_file_table'] . " where ds_no = '$key' ");
    }
}

//저장전 로직
$fileUploader->register("before_save", function($e){

    global $g5, $file_path;

    $filename = $e->__get("filename");
    $filename = preg_replace("/\.(php|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $filename);
	
    $e->__set("filename", $filename);
    $no = explode(".", $e->__get("element"));
    $no = $no[count($no) - 1];

	if($no == 2){
		$e->__set("url", $filename);
	}

    //파일이 존재하면 삭제
    $tmp_file = sql_fetch(" select * from {$g5[design_file_table]} WHERE ds_no = '$no' ");

    if($tmp_file['ds_file']){
		@unlink($file_path . $tmp_file['ds_file']);

        sql_query("delete from {$g5[design_file_table]} WHERE ds_no = '$no' ");      
    }
});

//저장후 로직
$fileUploader->register("after_save", function($e){

    global $g5;
	
    if($e['filename'] && $e['error'] == '0'){

        //파일 번호
        $no = explode(".", $e['element']);
        $no = $no[count($no) - 1];

        sql_query(" insert into " . $g5['design_file_table'] . " set
									ds_so = '$e[name]',
									ds_file = '$e[filename]',
									ds_no = '$no' ");
    }
});

@mkdir($file_path, 0707);
@chmod($file_path, 0707);

//유튜브 영상 정보 저장
sql_query(" update {$g5['design_table']} set ds_url1 = '$ds_url1', ds_url2 = '$ds_url2', ds_url3 = '$ds_url3', ds_url4 = '$ds_url4', ds_url5 = '$ds_url5', ds_url6 = '$ds_url6', ds_url7 = '$ds_url7', ds_url8 = '$ds_url8' ");

$fileUploader->processFiles();
$fileUploader->validate();

$fileUploader->save();

alert("적용 완료되었습니다", "./s2.php");