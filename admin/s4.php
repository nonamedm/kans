<?php
include_once "./_common.php";
$category_title = "공간신청관리";	//카테고리 제목
$sub_title = "공간신청관리";	//서브 타이틀
$sub_explan = ""; //페이지 설명
include_once G5_MANAGE_INCLUDE_PATH . "/admin_header.php";

$sql_common = " from schedule_submit2";
$sql_search = " where (1) ";

if (!$sst) {
	$sst = "idx";
	$sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";


if($s1){
	$sql_search.=" and mb_3 >='$s1' ";
	$qstr.="&s1=$s1";
}

if($s2){
	$sql_search.=" and mb_3 <='$s2' ";
	$qstr.="&s2=$s2";
}

if($s3){
	$sql_search.=" and mb_2 like '%{$s3}%' ";
	$qstr.="&s3=$s3";
}

if($stx){
	$sql_search.=" and $sfl like '%{$stx}%' ";
	$qstr.="&stx=$stx";
	$qstr.="&sfl=$sfl";
}

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함
$cur_num=$total_count - $rows*($page-1);

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';


include_once G5_MANAGE_INCLUDE_PATH . "/admin_header.php";

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$colspan = 6;
?>
<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/themes/base/jquery-ui.css" rel="stylesheet" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>

<script type="text/javascript">
	jQuery(function($){
		$.datepicker.regional['ko'] = {
			closeText: '닫기',
			prevText: '이전달',
			nextText: '다음달',
			currentText: '오늘',
			monthNames: ['1월(JAN)','2월(FEB)','3월(MAR)','4월(APR)','5월(MAY)','6월(JUN)',
			'7월(JUL)','8월(AUG)','9월(SEP)','10월(OCT)','11월(NOV)','12월(DEC)'],
			monthNamesShort: ['1월','2월','3월','4월','5월','6월',
			'7월','8월','9월','10월','11월','12월'],
			dayNames: ['일','월','화','수','목','금','토'],
			dayNamesShort: ['일','월','화','수','목','금','토'],
			dayNamesMin: ['일','월','화','수','목','금','토'],
			weekHeader: 'Wk',
			dateFormat: 'yymmdd',
			firstDay: 0,
			isRTL: false,
			showMonthAfterYear: true,
			yearSuffix: ''};
		$.datepicker.setDefaults($.datepicker.regional['ko']);

	
		$('.date_pic').datepicker({
			buttonImageOnly: true,
			buttonText: "달력",
			changeMonth: true,
				dateFormat: 'yy-mm-dd',
			changeYear: true,
			showButtonPanel: true,
			yearRange: 'c-30:c+30',
			maxDate: '+10y'
		});
	});
</script>

<form class="" method="get">
<div class="status_area mb10">
		<div class="">
				<select name="sfl" id="sfl">
					<option value="wr_subject">예약공간</option>
					<option value="day">예약일시</option>
					<option value="wr_3">이름</option>
					<option value="wr_4">생년월일</option>
					<option value="wr_5">이메일</option>
				</select>
			<input type="text" class="" name="stx" value="<?=$stx?>" /> 
			<input type="submit" class="btn_small2" value="검색" /> 
		</div>
</div>
</form>
<script>
$("#sfl option[value='<?=$sfl?>']").prop("selected", "true");
</script>
	
	
	<form name="fboardlist2" method="post" action="">
	<input type='hidden' name='page' value='<?=$page?>' />
	<input type='hidden' name='qtr' value='<?=$qstr?>' />
	<input type='hidden' name='r_page'  value='<?=$PHP_SELF?>'/>
	<input type='hidden' name='write_table'  value="schedule_submit2"/>
	<input type='hidden' name='sfl'  value="<?=$sfl?>"/>
	<input type='hidden' name='stx'  value="<?=$stx?>"/>
	
<table class="horizen">
	<colgroup>
		<col width="3%">
		<col width="3%">
		<col width="6%">
		<col width="6%">
		<col width="8%">
		<col width="8%">
		<col width="8%">
		<col width="12%">
		<col width="8%">
		<col width="5%">
		<col width="6%">
		<col width="5%">
	</colgroup>
	<thead>
		<tr>
			<th scope="col"><input type="checkbox" value="" onclick="if (this.checked) all_checked(true); else all_checked(false);"  /></th>
			<th scope="col">순번</th>
			<th scope="col">예약일시</th>
			<th scope="col">이름</th>
			<th scope="col">생년월일</th>
			<th scope="col">이메일</th>
			<th scope="col">전화번호</th>
			<th scope="col">예약공간</th>
			<th scope="col">사용목적</th>
			<th scope="col">인원</th>
			<th scope="col">처리상태</th>
			<th scope="col">관리</th>
		</tr>
	</thead>
	<tbody>
		<?for ($i=0; $row=sql_fetch_array($result); $i++) {// 접근가능한 그룹수?>
		<tr>
			<td><input type='checkbox' name='chk_wr_id[]' value="<?=$row[idx]?>" /></td>
			<td><?=$cur_num?></td>
			<td><?=substr($row[day],0,10)?></td>
			<td><?=$row[wr_3]?></td>
			<td><?=$row[wr_4]?></td>
			<td><?=$row[wr_5]?></td>
			<td><?=$row[wr_6]?></td>
			<td><?=$row[wr_subject]?></td>
			<td><?=$row[wr_7]?><?=$row[wr_8]?"<br>$row[wr_8]":""?></td>
			<td><?=$row[wr_2]?></td>
			<td>
				<select id="select_<?=$row[idx]?>" onchange="list_change('schedule_submit2','wr_10',this.value,'<?=$row[idx]?>','<?=$row[wr_10]?>');">
					<option value="승인대기">승인대기</option>
					<option value="승인">승인</option>
					<option value="대여완료">대여완료</option>
				</select>
				<script type="text/javascript">
				$("#select_<?=$row[idx]?> option[value='<?=$row[wr_10]?>']").prop("selected", "true");
				</script>
			</td>
			
			<td><a href="./s4_2.php?id=<?=$row[idx]?>" class="btn_small2">보기</a></td>
			
		</tr>
		<?$cur_num--;}if($i==0) echo "<tr><td colspan=11>데이터가 없습니다.</td></tr>";?>				
	</tbody>
</table>
    <div class="btn_area mt20">
		<div class="btn_area_left">
					<a href="javascript:select_delete();" class="btn_normal">선택삭제</a>
					<a href="./excel.php?table=schedule_submit2&sfl=<?=$sfl?>&stx=<?=$stx?>" class="btn_normal">엑셀저장</a>
		</div>
    </div>
<form>

<script type="text/javascript">
		function list_change(table,fild,val,idx,cancel_val){
			if(val=="승인"){
				if(confirm("승인시 메일이 발송됩니다.\n\n상태변경을 진행하시겠습니까?")){
				}else{
					$("#select_"+idx).val(cancel_val);
					 return false;
				}
			}
			$.post("<? echo G5_URL ?>/admin/change_ajax.php", {table:table,fild:fild,val:val,idx:idx}, function(rst){ 
				});

		}
		function all_checked(sw) {
			var f = document.fboardlist2;
			for (var i=0; i<f.length; i++) {
				if (f.elements[i].name == "chk_wr_id[]")
					f.elements[i].checked = sw;
			}
		}

		function check_confirm(str) {
			var f = document.fboardlist2;
			var chk_count = 0;

			for (var i=0; i<f.length; i++) {
				if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
					chk_count++;
			}

			if (!chk_count) {
				alert(str + "할 게시물을 하나 이상 선택하세요.");
				return false;
			}
			return true;
		}

		// 선택한 게시물 삭제
		function select_delete() {
			var f = document.fboardlist2;

			str = "삭제";
			if (!check_confirm(str))
				return;

			if (!confirm("선택한 게시물을 정말 "+str+" 하시겠습니까?\n\n한번 "+str+"한 자료는 복구할 수 없습니다"))
				return;

			f.action = "./s_delete.php";
			f.submit();
		}
</script> 			

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

<?php
include_once G5_MANAGE_INCLUDE_PATH . "/admin_footer.php";
?>