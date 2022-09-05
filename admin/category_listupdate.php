<?php
include_once('./_common.php');
check_demo();
auth_check($auth[$sub_menu], "w");
check_admin_token();

for ($i=0; $i<count($_POST['ca_id']); $i++)
{
    /*if ($_POST['ca_mb_id'][$i])
    {
        $sql = " select mb_id from {$g5['member_table']} where mb_id = '{$_POST['ca_mb_id'][$i]}' ";
        $row = sql_fetch($sql);
        if (!$row['mb_id'])
            alert("\'{$_POST['ca_mb_id'][$i]}\' 은(는) 존재하는 회원아이디가 아닙니다.", "./categorylist.php?$qstr");
		

		$sql = " update {$g5['g5_shop_category_table']}
                set ca_name             = '{$_POST['ca_name'][$i]}',                    
                    ca_use              = '{$_POST['ca_use'][$i]}'
              where ca_id = '{$_POST['ca_id'][$i]}' ";
    }*/

    
	
	$sql = " update {$g5['category']} set
					ca_name = '{$_POST['ca_name'][$i]}',
					turn = '{$_POST['turn'][$i]}'
              where bo_table='{$_POST['bo_table']}' and ca_id = '{$_POST['ca_id'][$i]}' ";
    sql_query($sql);

}

goto_url("./category.php?bo_table={$bo_table}&$qstr");
?>
