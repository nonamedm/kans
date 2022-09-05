<?php
	include_once "./_common.php";
	/**
	 *	해당페이지 타이틀 및 기본 노출 설정
	 */
	$g5['title'] = "최근예약 > 인피아드 관리자모드";	//title
	$category_title = "최근예약";	//카테고리 제목
	$sub_title = "예약범위설정";	//서브 타이틀
	$sub_explan = ""; //페이지 설명

	include_once G5_MANAGE_INCLUDE_PATH . "/admin_header.php";

	if(!sql_query("DESCRIBE {$g5['reserve_time_table']}", false)){
		sql_query("CREATE TABLE `{$g5['reserve_time_table']}` (
		  `start_time` time NOT NULL,
		  `end_time` time NOT NULL
		) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
	}

$site_count = sql_fetch(" select count(*) as cnt from {$g5['reserve_time_table']} ");
if($site_count['cnt'] < 1)
	sql_query("insert into {$g5['reserve_time_table']} set start_time = '' ");

$write = sql_fetch("select * from {$g5['reserve_time_table']}");

$start_time = explode(":", $write['start_time']);
$end_time = explode(":", $write['end_time']);

?>
<h4 class="h4_label">예약가능 시간 설정</h4>
<form name="fwrite" method="post" onsubmit="return fwrite_submit();">
	<input type="hidden" name="token" />
	<table class="vertical">
		<colgroup span="4">
			<col width="15%" />
			<col width="35%" />
			<col width="15%" />
			<col width="35%" />
		</colgroup>
		<tr>
			<th scope="row">시작시간</th>
			<td colspan="3">
				<input type="text" id="start_hour" name="start_hour" value="<?php echo $start_time[0]?>" size="10" maxlength="2" placeholder="00">
				<label for="">시</label>
				<input type="text" id="start_min" name="start_min" value="<?php echo $start_time[1]?>" size="10" maxlength="2" placeholder="00">
				<label for="">분</label>
			</td>
		</tr>
		<tr>
			<th scope="row">종료시간</th>
			<td colspan="3">
				<input type="text" id="end_hour" name="end_hour" value="<?php echo $end_time[0]?>" size="10" maxlength="2" placeholder="00">
				<label for="">시</label>
				<input type="text" id="end_min" name="end_min" size="10" value="<?php echo $end_time[1]?>" maxlength="2" placeholder="00">
				<label for="">분</label>
			</td>
		</tr>
	</table>
	<div class="btn_area">
		<div class="btn_area_left"></div>
		<div class="btn_area_center"></div>
		<div class="btn_area_right">
			<button type="submit" class="btn_normal">정보변경</button>
		</div>
	</div>
</form>

<script>
	function fwrite_submit() {
		$("input[name='token']").val(get_ajax_token());
		$("form[name='fwrite']").prop("action", "./reservation_setup_update.php");
	}
</script>

<?php
include_once G5_MANAGE_INCLUDE_PATH . "/admin_footer.php";
?>