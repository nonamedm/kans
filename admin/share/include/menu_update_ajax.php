<?php

/**
 * 관리자 메뉴명 노출
 * 반환값
 * 0 : 성공
 * f : 실패
 */

include_once ("../../../common.php");
include_once ("../../admin.lib.php");

/**
 * @param $is_success bool 성공여부
 */
function return_ajax($is_success){
    $rst_code = "";

    if($is_success)
        $rst_code = "0";
    else
        $rst_code = "f";

    die("{ rst_code : '$rst_code' }");
}

if($is_admin != "super")
    return_ajax(false);

//토큰 체크
if(!check_admin_token2())
    return_ajax(false);

$me_use = "";
if($menu_show)
    $me_use = "1";
else
    $me_use = "0";

sql_query(" update {$g5['menu_table']} set
    me_name = '$me_name',
    me_use = '$me_use'
  WHERE me_id = '$me_id' ");

//성공 반환
return_ajax(true);