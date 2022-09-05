<?php
$sub_menu = '400300';
include_once('./_common.php');

auth_check($auth[$sub_menu], "r");

$g5['title'] = '소속 검색';
// include_once(G5_PATH.'/head.sub.php');
include_once G5_MANAGE_PATH . "/share/include/admin.head.sub.php";

if(!strstr($qstr, 'val1') && $val1){ $qstr .= "&val1=".$val1; }
if(!strstr($qstr, 'val2') && $val2){ $qstr .= "&val2=".$val2; }

$bo_table = 'mem_group';
$board = sql_fetch(" select * from {$g5['board_table']} where bo_table = '$bo_table' ");
$write_table = $g5['write_prefix'] . $bo_table; // 게시판 테이블 전체이름

$sfl = $_REQUEST['sfl'];
$stx = trim($_REQUEST['stx']);
$page = $_REQUEST['page'];

$sop = strtolower($sop);
if ($sop != 'and' && $sop != 'or')
    $sop = 'and';

// 분류 선택 또는 검색어가 있다면
$stx = trim($stx);
if ($sca || $stx) {
    $sql_search = get_sql_search($sca, $sfl, $stx, $sop);

    // 가장 작은 번호를 얻어서 변수에 저장 (하단의 페이징에서 사용)
    $sql = " select MIN(wr_num) as min_wr_num from {$write_table} where 1 $where";
    $row = sql_fetch($sql);
    $min_spt = (int)$row['min_wr_num'];

    if (!$spt) $spt = $min_spt;

    $sql_search .= " and (wr_num between {$spt} and ({$spt} + {$config['cf_search_part']})) ";

    // 원글만 얻는다. (코멘트의 내용도 검색하기 위함)
    // 라엘님 제안 코드로 대체 http://sir.kr/g5_bug/2922
    $sql = " SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table} WHERE {$sql_search} $where ";
    $row = sql_fetch($sql);
    $total_count = $row['cnt'];
    /*
    $sql = " select distinct wr_parent from {$write_table} where {$sql_search} ";
    $result = sql_query($sql);
    $total_count = sql_num_rows($result);
    */
} else {
    $sql_search = "";

    //$total_count = $board['bo_count_write'];
	$sql = " SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table} WHERE 1 $where ";
    $row = sql_fetch($sql);
    $total_count = $row['cnt'];
}

if(G5_IS_MOBILE) {
    $page_rows = $board['bo_mobile_page_rows'];
    $list_page_rows = $board['bo_mobile_page_rows'];
} else {
    $page_rows = $board['bo_page_rows'];
    $list_page_rows = $board['bo_page_rows'];
}

if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)

// 년도 2자리
$today2 = G5_TIME_YMD;

$list = array();
$i = 0;
$notice_count = 0;
$notice_array = array();

// 공지 처리
if (!$sca && !$stx) {
    $arr_notice = explode(',', trim($board['bo_notice']));
    $from_notice_idx = ($page - 1) * $page_rows;
    if($from_notice_idx < 0)
        $from_notice_idx = 0;
    $board_notice_count = count($arr_notice);

    for ($k=0; $k<$board_notice_count; $k++) {
        if (trim($arr_notice[$k]) == '') continue;

        $row = sql_fetch(" select * from {$write_table} where wr_id = '{$arr_notice[$k]}' $where ");

        if (!$row['wr_id']) continue;

        $notice_array[] = $row['wr_id'];

        if($k < $from_notice_idx) continue;

        $list[$i] = get_list($row, $board, $board_skin_url, G5_IS_MOBILE ? $board['bo_mobile_subject_len'] : $board['bo_subject_len']);
        $list[$i]['is_notice'] = true;

        $i++;
        $notice_count++;

        if($notice_count >= $list_page_rows)
            break;
    }
}

$total_page  = ceil($total_count / $page_rows);  // 전체 페이지 계산
$from_record = ($page - 1) * $page_rows; // 시작 열을 구함

// 공지글이 있으면 변수에 반영
if(!empty($notice_array)) {
    $from_record -= count($notice_array);

    if($from_record < 0)
        $from_record = 0;

    if($notice_count > 0)
        $page_rows -= $notice_count;

    if($page_rows < 0)
        $page_rows = $list_page_rows;
}

// 0 으로 나눌시 오류를 방지하기 위하여 값이 없으면 1 로 설정
$bo_gallery_cols = $board['bo_gallery_cols'] ? $board['bo_gallery_cols'] : 1;
$td_width = (int)(100 / $bo_gallery_cols);

// 정렬
// 인덱스 필드가 아니면 정렬에 사용하지 않음
//if (!$sst || ($sst && !(strstr($sst, 'wr_id') || strstr($sst, "wr_datetime")))) {
if (!$sst) {
    if ($board['bo_sort_field']) {
        $sst = $board['bo_sort_field'];
    } else {
        $sst  = "wr_num, wr_reply";
        $sod = "";
    }
} else {
    // 게시물 리스트의 정렬 대상 필드가 아니라면 공백으로 (nasca 님 09.06.16)
    // 리스트에서 다른 필드로 정렬을 하려면 아래의 코드에 해당 필드를 추가하세요.
    // $sst = preg_match("/^(wr_subject|wr_datetime|wr_hit|wr_good|wr_nogood)$/i", $sst) ? $sst : "";
    $sst = preg_match("/^(wr_datetime|wr_hit|wr_good|wr_nogood)$/i", $sst) ? $sst : "";
}

if(!$sst)
    $sst  = "wr_num, wr_reply";

if ($sst) {
    $sql_order = " order by {$sst} {$sod} ";
}

if ($sca || $stx) {
    $sql = " select distinct wr_parent from {$write_table} where {$sql_search}  $where {$sql_order} limit {$from_record}, $page_rows ";
} else {
    $sql = " select * from {$write_table} where wr_is_comment = 0  $where ";
    if(!empty($notice_array))
        $sql .= " and wr_id not in (".implode(', ', $notice_array).") ";
    $sql .= " {$sql_order} limit {$from_record}, $page_rows ";
}

// 페이지의 공지개수가 목록수 보다 작을 때만 실행
if($page_rows > 0) {
    $result = sql_query($sql);

    $k = 0;

    while ($row = sql_fetch_array($result))
    {
        // 검색일 경우 wr_id만 얻었으므로 다시 한행을 얻는다
        if ($sca || $stx)
            $row = sql_fetch(" select * from {$write_table} where wr_id = '{$row['wr_parent']}'  $where ");

        $list[$i] = get_list($row, $board, $board_skin_url, G5_IS_MOBILE ? $board['bo_mobile_subject_len'] : $board['bo_subject_len']);
        if (strstr($sfl, 'subject')) {
            $list[$i]['subject'] = search_font($stx, $list[$i]['subject']);
        }
        $list[$i]['is_notice'] = false;
        $list_num = $total_count - ($page - 1) * $list_page_rows - $notice_count;
        $list[$i]['num'] = $list_num - $k;

        $i++;
        $k++;
    }
}

$write_pages = get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "./pop_search.php?".$qstr.'&amp;page=');
?>


<div class="new_win">
    <h1>소속명 검색</h1>
    <form name="fsearch" method="get">
		<input type="hidden" name="sfl" value="<?php echo ($sfl)?$sfl:"wr_subject"; ?>" id="sfl">
		<input type="hidden" name="page" value="<?php echo ($page)?$page:"0"; ?>" id="page">
		<input type="hidden" name="val1" value="<?php echo $val1; ?>" id="val1">
		<input type="hidden" name="val2" value="<?php echo $val2; ?>" id="val2">


    <div id="sit_copy">
        <label for="new_it_id">소속명</label>
        <input type="text" name="stx" value="<?php echo $stx; ?>" id="stx" class="frm_input" maxlength="20" placeholder="검색어">
		<button type="submit">검색</button>
    </div>

	<table>
		<caption>소속 검색</caption>
		<colgroup>
			<col width="15%">
			<col width="60%">
			<col width="25%">
		</colgroup>	
		<thead>
			<th>No</th>
			<th>소속</th>
			<th>선택</th>
		</thead>
		<tbody>
			<?php for ($i=0; $i<count($list); $i++) {?>
			<tr>
				<td><?php echo $list[$i]['num']; ?></td>
			<td><?php echo $list[$i]['subject']; ?></td>
				<td><button class="btn_st2 btn_select_partners" data-wr_id="<?php echo $list[$i]['wr_id']; ?>" data-wr_subject="<?php echo $list[$i]['wr_subject']; ?>">선택</button></td>
			</tr>
			<?php } ?>
			<?php if($i == 0){ ?>
			<tr><td colspan="3">검색 결과가 없습니다.</td></tr>
			<?php } ?>
		</tbody>
	</table>

	<nav class="pg_wrap">
		<?php echo $write_pages; ?>
	</nav>

    <div class="btn_confirm01 btn_confirm">
        <button type="button" onclick="self.close();">창닫기</button>
    </div>

    </form>
</div>

<script src="<?php echo G5_ADMIN_URL ?>/admin.js"></script>
<script type="text/javascript">
// 소속 선택시
$(document).on('click','.btn_select_partners',function(){

	var val1 = $("#val1").val(); // 소속 PK 변수 명
	var val2 = $("#val2").val(); // 소속명 변수 명

	var val = $(this).data("wr_id"); // 선택한 소속 PK
	window.opener.document.getElementById(val1).value = val;

	val = $(this).data("wr_subject"); // 선택한 소속명
	window.opener.document.getElementById(val2).value = val;
	
	self.close(); // 창 닫기

});
</script>

<?php
// include_once(G5_PATH.'/tail.sub.php');
include_once G5_MANAGE_INCLUDE_PATH . "/admin.tail.sub.php";
?>