<?php

/**
 * 관리자 메인화면 노출여부
 * 반환값
 * 0 : 성공
 * f : 실패
 */

        include_once ("../../../common.php");
    include_once (G5_MANAGE_PATH . "/admin.lib.php");

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

$ma_use = "";
if($menu_show)
    $ma_use = "1";
else
    $ma_use = "0";

sql_query(" update {$g5['main_content_table']} set
           ma_use = '$ma_use'
          WHERE ma_id = '$ma_id' ");

//성공 반환
return_ajax(true);