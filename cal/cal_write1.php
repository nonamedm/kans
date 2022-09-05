<?
	include_once('./_common.php');

	//화면의 성격
	$user_division = "user";
	$screen_div = "sub"; //main, sub
	$frame_div = "one";  //one, two

	//카테고리/페이지/상세페이지 명칭 & 카테고리 번호
	$cate_num = "1";
	$page_num = "2";
	$spage_num = "2";

	//현재 활성화 상태
	$gn_btn = "gn_btn".$cate_num;
	$$gn_btn = "current";

	$ln_btn = "ln_btn".$page_num;
	$$ln_btn = "current";

	$sln_btn = "sln_btn".$spage_num;
	$$sln_btn = "current";

	if(empty($wr_1)){ alert("올바른 접근이 아닙니다.", "/cal/cal_list.php"); exit; }

	include_once(G5_THEME_PATH.'/head.php');

	/*
	보수교육, 기타 : ./cal_write2.php
	직장교육 : ./cal_write2_2.php
	전문교육 : ./cal_write2_3.php
	*/

	$bo_table = "s1_2_2_1";
	
	$program_table = $g5['write_prefix'] . substr($bo_table, 0, -2);
	$program_info = sql_fetch(" SELECT * FROM ".$program_table." WHERE wr_id = '".$wr_1."' ");
	
	// 직장교육
	if($program_info['wr_1'] == '10'){ $action_url = "./cal_write2_2.php"; }
	// 보수교육, 기타
	else if($program_info['wr_1'] == '20' || $program_info['wr_1'] == '40'){ $action_url = "./cal_write2.php"; }
	// 전문교육
	else if($program_info['wr_1'] == '30'){ $action_url = "./cal_write2_3.php"; }
?>

<section class="cal_group_application">
	<article class="arti1">
		<h3>교육담당자 단체 신청</h3>
		
		<form name="fwrite" id="fwrite" action="<?php echo $action_url; ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
			<!-- <input type="hidden" name="bo_table" id="bo_table" value="<?php echo $bo_table; ?>"> -->
			<input type="hidden" name="wr_1" id="wr_1" value="<?php echo $wr_1; ?>">

			<table class="table_nomal">
				<colgroup>
					<col width="25%">
					<col width="*">
				</colgroup>
				<tr>
					<th>기관명 (*)</th>
					<td><input type="text" name="wr_2" value="<?php echo $member['mb_2']; ?>" required ></td>
				</tr>
				<tr>
					<th>이름 (*)</th>
					<td><input type="text" name="wr_3" value="<?php echo $member['mb_name']; ?>" required ></td>
				</tr>
				<tr>
					<th>핸드폰번호 (*)</th>
					<td><input type="text" name="wr_5" value="<?php echo $member['mb_hp']; ?>" required ></td>
				</tr>
				<tr>
					<th>이메일 (*)</th>
					<td><input type="text" name="wr_6" value="<?php echo $member['mb_email']; ?>" required ></td>
				</tr>
			</table>
			<!-- <a href="http://www.kans.re.kr/cal/cal_write2.php" class="bt_write" >다음</a> -->
			<!-- <input type="button" value="다음" onclick="" class="bt_write"> -->
			<input type="submit" value="다음" onclick="" class="bt_write">
		</form>
	</article>
</section>

<script type="text/javascript">
	
	function fwrite_submit(f) {
		if(f.wr_1.value == ""){
			alert("올바른 방법으로 이용해주세요.");
			document.location.href = "./cal_list.php";
			return false;
		}
	}
</script>

<?php include_once(G5_THEME_PATH.'/tail.php'); ?>