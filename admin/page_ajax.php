<?php
include_once("./_common.php");
$date=G5_TIME_YMDHIS;

if($_POST[w]=="insert"){ //생성
	if($idx){ //2차생성
		$min_turn2=sql_fetch("select min(turn2) as turn2 from page where sub_idx='$idx' and cate='$cate' ");
		$turn2=$min_turn2[turn2]-1;
		$pro_list = sql_query(" insert into page set sub_idx='$idx', sub='1', date_time='$date', turn2=$turn2, cate='$cate' ");
		$newidx=sql_insert_id();
		$turn1update=sql_fetch("select turn1 from page where idx='$idx' and cate='$cate' ");
		sql_query(" update page set turn1='$turn1update[turn1]' where  idx='$newidx'");
	}else{ //1차 신규생성
		$min_turn2=sql_fetch("select min(turn1) as turn1 from page where cate='$cate' ");
		$turn1=$min_turn2[turn1]-1;
		$pro_list = sql_query(" insert into page set date_time='$date', turn1=$turn1, cate='$cate' ");
		
		$idx=sql_insert_id();
		sql_query(" update page set sub_idx='$idx' where idx='$idx'");
	}
}


if($_POST[w]=="d"){ //삭제
	$sub_check = sql_fetch(" select idx from page where sub_idx='$idx' and sub='1' and cate='$cate'  "); //하위분류 유무 체크
	if($sub_check[idx]){
		echo "하위분류가 존재합니다.";exit;
	}
	sql_query(" delete from page where idx='$idx' and cate='$cate' ");
}


if($_POST[w]=="all_update"){ //일괄수정
	for($i=0; $i<count($idx); $i++){
		$idx_val=$idx[$i];
		sql_query("update page set
				title1='$title1[$idx_val]',
				title2='$title2[$idx_val]',
				title3='$title3[$idx_val]',
				use1='$use1[$idx_val]',
				use2='$use2[$idx_val]',
				use3='$use3[$idx_val]'
				 where idx='$idx_val'");
	}
}


if($_POST[w]=="turn"){ //재정렬
	
	$row = sql_fetch(" select idx,sub_idx,sub,turn1,turn2 from page where idx='$idx' and cate='$cate' ");
	
	if($row[sub]){ //2차메뉴 정렬
		$where = " and sub_idx='$row[sub_idx]' and sub=1 ";
		if($type==1)
			$rerow = sql_fetch(" select idx,turn2 from page where 1 $where and turn2 > {$row[turn2]} and cate='$cate' order by turn2 asc limit 1 "); // 위로
			else
				$rerow = sql_fetch(" select idx,turn2 from page where 1 $where and turn2 < {$row[turn2]} and cate='$cate'  order by turn2 desc limit 1 "); //아래루
				if(!$rerow[idx]) {exit;}
				sql_query(" update page set turn2 = '{$row[turn2]}' where idx = '{$rerow['idx']}' ");
				sql_query(" update page set turn2 = '{$rerow[turn2]}' where idx = '{$row['idx']}' ");
	}else{//메인메뉴 정렬
		$where = " and sub=0  ";
		if($type==1)
			$rerow = sql_fetch(" select idx,turn1 from page where 1 $where and turn1 > {$row[turn1]} and cate='$cate'  order by turn1 asc limit 1 "); // 위로
			else
				$rerow = sql_fetch(" select idx,turn1 from page where 1 $where and turn1 < {$row[turn1]} and cate='$cate'  order by turn1 desc limit 1 "); //아래루
				if(!$rerow[idx]) {exit;}
				sql_query(" update page set turn1 = '{$row[turn1]}' where sub_idx = '{$rerow['idx']}' ");
				sql_query(" update page set turn1 = '{$rerow[turn1]}' where sub_idx = '{$row['idx']}' ");
	}
}


?>