<?
	include_once('./_common.php');

	//화면의 성격
	$user_division = "user";
	$screen_div = "sub"; //main, sub
	$frame_div = "two";  //one, two

	$info=sql_fetch("select idx,sub_idx,sub,cate, content1 as content, title1, cate_num, page_num from page where idx='$cidx'");
	$content=$info[content];
	$sp_discription=$info[sub_title];

	switch($info['cate']){
		case 1: $pname= "센터소개";break;
		default: alert("지정되지 않은 페이지 입니다.");
	}

	//카테고리/페이지/상세페이지 명칭 & 카테고리 번호
	// $cate_num = $info['cate'];
	$cate_num = $info['cate_num'];

	$page_name = $info['title1'];
	// $page_num = $info['sub']+1;
	$page_num = $info['page_num'];

	//현재 활성화 상태
	$gn_btn = "gn_btn".$cate_num;
	$$gn_btn = "current";

	$ln_btn = "ln_btn".$page_num;
	$$ln_btn = "current";

	include_once(G5_THEME_PATH.'/head.php');

	echo $content;

	include_once(G5_THEME_PATH.'/tail.php');
?>