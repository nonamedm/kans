<?php

include_once "./_common.php";

check_admin_token();

$menu_que = "";
$leng_que = "";
$link_que = "";

$submenu_que = "";
$sublink_que = "";

for ($i = 0; $i < $config2w['cf_max_menu']; $i++) {

    /// $s = $cf_menu_sort[$i]?$cf_menu_sort[$i]:$i;
    $s = $cf_menu_sort[$i];

    $menu_que .= " cf_menu_name_$s = '$cf_menu_name[$i]'";
    $leng_que .= " cf_menu_leng_$s = '$cf_menu_leng[$i]'";
    $link_que .= " cf_menu_link_$s = '$cf_menu_link[$i]'";

    if($i < $config2w['cf_max_menu'] - 1) {
        $menu_que .= ",";
        $leng_que .= ",";
        $link_que .= ",";
    }

    for ($j = 0; $j < $config2w['cf_max_submenu']; $j++) {

        $submenu_que .= " cf_submenu_name_$s"."_$j = '{$config2w['cf_submenu_name_'.$i.'_'.$j]}'";
        $sublink_que .= " cf_submenu_link_$s"."_$j = '{$config2w['cf_submenu_link_'.$i.'_'.$j]}'";

        if(($i < $config2w['cf_max_menu'] - 1) or ($j < $config2w['cf_max_submenu'] - 1)) {
            $submenu_que .= ",";
            $sublink_que .= ",";
        }

    }

}

$sql = " update $g5[config2w_table] set $menu_que, $leng_que, $link_que, $submenu_que, $sublink_que ";
$sql .= " where cf_id='$g5[tmpl]' "; /// 2012.11.24
/// echo $sql;
sql_query($sql);

//sql_query(" OPTIMIZE TABLE `$g5[config2w_table]` ");


alert("수정이 완료되었습니다.", "./setup_menu.php");
