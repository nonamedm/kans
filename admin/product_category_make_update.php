<?php

include_once("./_common.php");

check_admin_token();

if(!$boa_table)
		alert("테이블값이 지정되지 않았습니다.");	

	if($w=="u"){
		sql_query("update $g5[board_category_table] set ca_name = '$ca_name', ca_order = '$ca_order' where ca_id = '$ca_id' and bo_table = '$boa_table' ");

		alert("수정되었습니다.","./product_category.php?boa_table=$boa_table");
	}elseif($w=="d"){

		sql_query("delete from $g5[board_category_table] where bo_table = '$boa_table' and ca_id = '$del_ca_id'");

		alert("삭제되었습니다.","./product_category.php?boa_table=$boa_table");
	}elseif($w=="lu"){

		for ($i=0; $i<count($_POST[ca_id]); $i++)
		{
			$sql = " update $g5[board_category_table]
						set ca_name       = '{$_POST[ca_name][$i]}',
							ca_order      = '{$_POST[ca_order][$i]}'
					  where ca_id = '{$_POST[ca_id][$i]}' and bo_table = '$boa_table' ";
			sql_query($sql);

		}

		alert("수정되었습니다.","product_category.php?boa_table=$boa_table");

	}else{
		sql_query("insert into $g5[board_category_table] set ca_id = '$ca_id', ca_name = '$ca_name', ca_order = '$ca_order', bo_table = '$boa_table' ");

		alert("등록되었습니다.","./product_category.php?boa_table=$boa_table");
	}
?>