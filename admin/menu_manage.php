<?php

include_once "./_common.php";

$g5['title'] = "대메뉴 관리";
$category_title = "환경설정";
$sub_title = "대메뉴 관리";

include_once G5_MANAGE_INCLUDE_PATH . "/admin_header.php";

if ($is_admin != 'super')
    alert('최고관리자만 접근 가능합니다.');

// 메뉴테이블 생성
if( !isset($g5['menu_table']) ){
    die('<meta charset="utf-8">dbconfig.php 파일에 <strong>$g5[\'menu_table\'] = G5_TABLE_PREFIX.\'menu\';</strong> 를 추가해 주세요.');
}

if(!sql_query(" DESCRIBE {$g5['menu_table']} ", false)) {
    sql_query(" CREATE TABLE IF NOT EXISTS `{$g5['menu_table']}` (
                  `me_id` int(11) NOT NULL AUTO_INCREMENT,
                  `me_code` varchar(255) NOT NULL DEFAULT '',
                  `me_name` varchar(255) NOT NULL DEFAULT '',
                  `me_link` varchar(255) NOT NULL DEFAULT '',
                  `me_target` varchar(255) NOT NULL DEFAULT '0',
                  `me_order` int(11) NOT NULL DEFAULT '0',
                  `me_use` tinyint(4) NOT NULL DEFAULT '0',
                  `me_mobile_use` tinyint(4) NOT NULL DEFAULT '0',
                  PRIMARY KEY (`me_id`)
                ) ENGINE=MyISAM DEFAULT CHARSET=utf8 ", true);
}

//관리자 링크 추가
if(!sql_query(" select me_admin_link from {$g5['menu_table']} limit 1 ", false)) {

    $sql = " ALTER TABLE `{$g5['menu_table']}`  ADD `me_admin_link` VARCHAR( 255 ) NOT NULL AFTER `me_link` ";
    sql_query($sql, false);
}


$sql = " select * from {$g5['menu_table']} WHERE LENGTH(me_code) <= 2 order by me_id ";
$result = sql_query($sql);

$colspan = 7;

?>
<form name="fmenulist" id="fmenulist" method="post" action="./menu_list_update.php" onsubmit="return fmenulist_submit(this);">
    <input type="hidden" name="token" value="">

    <div class="btn_area">
        <div class="btn_area_left">
            <h4 class="h4_label">대메뉴 목록</h4>
        </div>

        <div class="btn_area_right">
            <button type="button" class="btn_normal" onclick="return add_menu();">메뉴추가</button>
        </div>
    </div>

            <div id="menulist" class="tbl_head01 tbl_wrap">

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">메뉴</th>
<!--                        <th scope="col">링크</th>-->
<!--                        <th scope="col">관리자모드링크</th>-->
<!--                        <th scope="col">새창</th>-->
<!--                        <th scope="col">순서</th>-->
                        <th scope="col">노출</th>
<!--                        <th scope="col">모바일사용</th>-->
                        <th scope="col">관리</th>
                    </tr>
                    </thead>
            <tbody>
            <?php
            for ($i=0; $row=sql_fetch_array($result); $i++)
            {
                $bg = 'bg'.($i%2);
                $sub_menu_class = '';
                if(strlen($row['me_code']) == 4) {
                    $sub_menu_class = ' sub_menu_class';
                    $sub_menu_info = '<span class="sound_only">'.$row['me_name'].'의 서브</span>';
                    $sub_menu_ico = '<span class="sub_menu_ico"></span>';
                }

                $search  = array('"', "'");
                $replace = array('&#034;', '&#039;');
                $me_name = str_replace($search, $replace, $row['me_name']);
                ?>
                <tr class="<?php echo $bg; ?> menu_list menu_group_<?php echo substr($row['me_code'], 0, 2); ?>">
                    <td class="td_category<?php echo $sub_menu_class; ?>">
                        <input type="hidden" name="code[]" value="<?php echo substr($row['me_code'], 0, 2) ?>">
<!--                        <label for="me_name_--><?php //echo $i; ?><!--" class="sound_only">--><?php //echo $sub_menu_info; ?><!-- 메뉴<strong class="sound_only"> 필수</strong></label>-->
                        <input type="text" name="me_name[]" value="<?php echo $me_name; ?>" id="me_name_<?php echo $i; ?>" required class="required frm_input full_input">
                    </td>

                    <td class="td_mng">
<!--                        <label for="me_use_--><?php //echo $i; ?><!--" class="sound_only">PC사용</label>-->
                        <input type="checkbox" name="me_use[]" id="me_use_<?php echo $i; ?>" value="1" <?php echo ($row['me_use'] == "1")? "checked" : ""?> />
                    </td>

                    <td class="td_mng">
                        <?php if(strlen($row['me_code']) == 2) { ?>
<!--                            <button type="button" class="btn_small2">추가</button>-->
                        <?php } ?>
                        <button type="button" name="btn_action btn_del_menu" class="btn_small2">삭제</button>
                    </td>
                </tr>
                <?php
            }

            if ($i==0)
                echo '<tr id="empty_menu_list"><td colspan="'.$colspan.'" class="empty_table">자료가 없습니다.</td></tr>';
            ?>
            </tbody>
        </table>
    </div>

    <div class="btn_area">
        <div class="btn_area_right">
            <input type="submit" name="act_button" value="확인" class="btn_normal">
        </div>
    </div>

</form>

<script>
    $(function() {
        $(document).on("click", ".btn_add_submenu", function() {
            var code = $(this).closest("tr").find("input[name='code[]']").val().substr(0, 2);
            add_submenu(code);
        });

        $(document).on("click", ".btn_del_menu", function() {
            if(!confirm("메뉴를 삭제하시겠습니까?"))
                return false;

            var $tr = $(this).closest("tr");
            if($tr.find("td.sub_menu_class").size() > 0) {
                $tr.remove();
            } else {
                var code = $(this).closest("tr").find("input[name='code[]']").val().substr(0, 2);
                $("tr.menu_group_"+code).remove();
            }

            if($("#menulist tr.menu_list").size() < 1) {
                var list = "<tr id=\"empty_menu_list\"><td colspan=\"<?php echo $colspan; ?>\" class=\"empty_table\">자료가 없습니다.</td></tr>\n";
                $("#menulist table tbody").append(list);
            } else {
                $("#menulist tr.menu_list").each(function(index) {
                    $(this).removeClass("bg0 bg1")
                        .addClass("bg"+(index % 2));
                });
            }
        });
    });

    function add_menu()
    {
        var max_code = base_convert(0, 10, 36);
        $("#menulist tr.menu_list").each(function() {
            var me_code = $(this).find("input[name='code[]']").val().substr(0, 2);
            if(max_code < me_code)
                max_code = me_code;
        });

        var url = "./menu_form.php?code="+max_code+"&new=new";
        window.open(url, "add_menu", "left=100,top=100,width=550,height=650,scrollbars=yes,resizable=yes");
        return false;
    }

    function add_submenu(code)
    {
        var url = "./menu_form.php?code="+code;
        window.open(url, "add_menu", "left=100,top=100,width=550,height=650,scrollbars=yes,resizable=yes");
        return false;
    }

    function base_convert(number, frombase, tobase) {
        //  discuss at: http://phpjs.org/functions/base_convert/
        // original by: Philippe Baumann
        // improved by: Rafał Kukawski (http://blog.kukawski.pl)
        //   example 1: base_convert('A37334', 16, 2);
        //   returns 1: '101000110111001100110100'

        return parseInt(number + '', frombase | 0)
            .toString(tobase | 0);
    }

    function fmenulist_submit(f)
    {
        return true;
    }
</script>

<?php
include_once G5_MANAGE_INCLUDE_PATH . "/admin_footer.php";
?>
