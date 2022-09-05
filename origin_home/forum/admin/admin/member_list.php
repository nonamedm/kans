<?php
$sub_menu = "200100";
include_once('./_common.php');



$sql_common = " from {$g5['member_table']} ";

$sql_search = " where (1) ";
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'mb_point' :
            $sql_search .= " ({$sfl} >= '{$stx}') ";
            break;
        case 'mb_level' :
            $sql_search .= " ({$sfl} = '{$stx}') ";
            break;
        case 'mb_tel' :
        case 'mb_hp' :
            $sql_search .= " ({$sfl} like '%{$stx}') ";
            break;
        default :
            $sql_search .= " ({$sfl} like '{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}

// ==================================== 커스터 마이징 - 회원등급 검색[한국원자력아카데미] ====================================
if($smb_level){ $sql_search .= " AND mb_level = '".$smb_level."' "; }

if ($is_admin != 'super')
    $sql_search .= " and mb_level <= '{$member['mb_level']}' ";

if (!$sst) {
    $sst = "mb_datetime";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

$sql_search .=  " and mb_id not in('inpiad', 'admin') ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

// 탈퇴회원수
$sql = " select count(*) as cnt {$sql_common} {$sql_search} and mb_leave_date <> '' {$sql_order} ";
$row = sql_fetch($sql);
$leave_count = $row['cnt'];

// 차단회원수
$sql = " select count(*) as cnt {$sql_common} {$sql_search} and mb_intercept_date <> '' {$sql_order} ";
$row = sql_fetch($sql);
$intercept_count = $row['cnt'];

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = "환경설정 > 인피아드 관리자모드";	//title
$category_title = "회원관리";	//카테고리 제목
$sub_title = "회원관리";	//서브 타이틀
//$sub_explan = ""; //페이지 설명

include_once G5_MANAGE_INCLUDE_PATH . "/admin_header.php";

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$colspan = 16;
?>

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    총회원수 <?php echo number_format($total_count) ?>명 중,
    <a href="?sst=mb_intercept_date&amp;sod=desc&amp;sfl=<?php echo $sfl ?>&amp;stx=<?php echo $stx ?>">차단 <?php echo number_format($intercept_count) ?></a>명,
    <a href="?sst=mb_leave_date&amp;sod=desc&amp;sfl=<?php echo $sfl ?>&amp;stx=<?php echo $stx ?>">탈퇴 <?php echo number_format($leave_count) ?></a>명
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">

    <label for="sfl" class="sound_only">검색대상</label>
	<!-- ==================================== 커스터 마이징 - 회원등급 검색[한국원자력아카데미] ==================================== -->
	<select name="smb_level" id="smb_level">
		<option value="">전체</option>
		<option value="2">교육생(개인)</option>
		<option value="3">교육담당자(단체)</option>
	</select>
	<script type="text/javascript">
	$( document ).ready(function() {
		$( "#smb_level > option[value='<?php echo $smb_level; ?>']" ).prop( "selected", true);
	});
	</script>

    <select name="sfl" id="sfl">
        <option value="mb_id"<?php echo get_selected($_GET['sfl'], "mb_id"); ?>>회원아이디</option>
        <option value="mb_name"<?php echo get_selected($_GET['sfl'], "mb_name"); ?>>이름</option>
        <option value="mb_email"<?php echo get_selected($_GET['sfl'], "mb_email"); ?>>E-MAIL</option>
        <!-- <option value="mb_tel"<?php echo get_selected($_GET['sfl'], "mb_tel"); ?>>전화번호</option> -->
        <option value="mb_hp"<?php echo get_selected($_GET['sfl'], "mb_hp"); ?>>핸드폰번호</option>
		<option value="mb_datetime"<?php echo get_selected($_GET['sfl'], "mb_datetime"); ?>>가입일시</option>
        <option value="mb_ip"<?php echo get_selected($_GET['sfl'], "mb_ip"); ?>>IP</option>
    </select>
    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
    <!-- <input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input"> -->
	<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" class="frm_input">
    <input type="submit" class="btn_normal" value="검색">

</form>

<div class="local_desc01 local_desc">
    <p>
        회원자료 삭제 시 다른 회원이 기존 회원아이디를 사용하지 못하도록 회원아이디, 이름, 닉네임은 삭제하지 않고 영구 보관합니다.
    </p>
</div>

<?php if ($is_admin == 'super') { ?>
    <div class="btn_area">
        <div class="btn_area_right">
            <a href="./member_form.php" class="btn_normal" id="member_add">회원추가</a>
        </div>
    </div>
<?php } ?>

<form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="token" value="">

	<h4 class="h4_label">회원관리</h4>
	<div class="table_outline">
		<table class="horizen">
			<colgroup>
				<col width="2%">
				<col width="10%">
				<col width="*">
				<col width="8%">
				<col width="8%">
				<col width="10%">
				<col width="12%">
				<col width="12%">
				<col width="12%">
				<col width="5%">
				<col width="5%">
				<col width="5%">
			</colgroup>
			<thead>
				<tr>
					<th scope="col" rowspan="2" id="mb_list_chk"><label for="chkall" class="sound_only">회원 전체</label><input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)"></th>
					<th scope="col">아이디</th>
					<th scope="col">소속</th>
					<th scope="col">이름</th>
					<th scope="col">등급</th>
					<th scope="col"><!-- 전화번호 -->핸드폰번호</th>
					<th scope="col">이메일</th>
					<th scope="col">가입일</th>
					<th scope="col">최종접속</th>
					<th scope="col">관리</th>
					<th scope="col">차단</th>
					<th scope="col">삭제</th>
				</tr>
	
			</thead>
			<tbody>
<?php      for ($i=0; $row=sql_fetch_array($result); $i++) {

		// 접근가능한 그룹수
        $sql2 = " select count(*) as cnt from {$g5['group_member_table']} where mb_id = '{$row['mb_id']}' ";
        $row2 = sql_fetch($sql2);
        $group = '';
        if ($row2['cnt'])
            $group = '<a href="./boardgroupmember_form.php?mb_id='.$row['mb_id'].'">'.$row2['cnt'].'</a>';

        if ($is_admin == 'group') {
            $s_mod = '';
        } else {
            $s_mod = '<a href="./member_form.php?'.$qstr.'&amp;w=u&amp;mb_id='.$row['mb_id'].'" class="btn_small2">수정</a>';
        }
        $s_grp = '<a href="./boardgroupmember_form.php?mb_id='.$row['mb_id'].'">그룹</a>';

        $leave_date = $row['mb_leave_date'] ? $row['mb_leave_date'] : date('Ymd', G5_SERVER_TIME);
        $intercept_date = $row['mb_intercept_date'] ? $row['mb_intercept_date'] : date('Ymd', G5_SERVER_TIME);

        $mb_nick = get_sideview($row['mb_id'], get_text($row['mb_nick']), $row['mb_email'], $row['mb_homepage']);

		$mb_level = ($row['mb_level'] == 2)?"교육생(개인)":"교육담당자(단체)";

        $mb_id = $row['mb_id'];
        $leave_msg = '';
        $intercept_msg = '';
        $intercept_title = '';
        if ($row['mb_leave_date']) {
            $mb_id = $mb_id;
            $leave_msg = '<span class="mb_leave_msg">탈퇴함</span>';
			$mb_level = "";
        }
        else if ($row['mb_intercept_date']) {
            $mb_id = $mb_id;
            $intercept_msg = '<span class="mb_intercept_msg">차단됨</span>';
            $intercept_title = '차단해제';
        }
        if ($intercept_title == '')
            $intercept_title = '차단하기';

        $address = $row['mb_zip1'] ? print_address($row['mb_addr1'], $row['mb_addr2'], $row['mb_addr3'], $row['mb_addr_jibeon']) : '';

        $bg = 'bg'.($i%2);

        switch($row['mb_certify']) {
            case 'hp':
                $mb_certify_case = '휴대폰';
                $mb_certify_val = 'hp';
                break;
            case 'ipin':
                $mb_certify_case = '아이핀';
                $mb_certify_val = '';
                break;
            case 'admin':
                $mb_certify_case = '관리자';
                $mb_certify_val = 'admin';
                break;
            default:
                $mb_certify_case = '&nbsp;';
                $mb_certify_val = 'admin';
                break;
        }
    ?>


				<tr>
					<td headers="mb_list_chk" class="td_chk" rowspan="1">
						<input type="hidden" name="mb_id[<?php echo $i ?>]" value="<?php echo $row['mb_id'] ?>" id="mb_id_<?php echo $i ?>">
						<label for="chk_<?php echo $i; ?>" class="sound_only"><?php echo get_text($row['mb_name']); ?> <?php echo get_text($row['mb_nick']); ?>님</label>
						<input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
					</td>
					<td><?=$row[mb_id]?> <?=$leave_msg?></td>
					<td><?php echo $row['mb_2'];?></td>
					<td><?=$row[mb_name]?></td>
					<td><?php echo $mb_level; ?></td>
					<td><?php echo $row['mb_hp']; //=$row[mb_tel]?></td>
					<td><?=$row[mb_email]?></td>

					<td><?=$row[mb_datetime]?></td>
					<td><?=$row[mb_today_login]?></td>
										<td>
								<?=$s_mod?>
								</td>
					<td>
					  <?php if(empty($row['mb_leave_date'])){ ?>
                            <input type="checkbox" name="mb_intercept_date[<?php echo $i; ?>]" <?php echo $row['mb_intercept_date']?'checked':''; ?> value="<?php echo $intercept_date ?>" id="mb_intercept_date_<?php echo $i ?>" title="<?php echo $intercept_title ?>">
                            <label for="mb_intercept_date_<?php echo $i; ?>" class="">접근차단</label>
                        <?php } ?>
						</td>
					<td><?php echo $row['mb_memo']; ?></td>
				</tr>
					<?php }?>
			</tbody>
        </table>
    </div>

    <div class="btn_area">
        <div class="btn_area_right">
            <input type="submit" class="btn_normal" name="act_button" value="선택수정" onclick="document.pressed=this.value">
            <input type="submit" class="btn_normal" name="act_button" value="선택삭제" onclick="document.pressed=this.value">
        </div>
    </div>

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

<script>
    function fmemberlist_submit(f)
    {
        if (!is_checked("chk[]")) {
            alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
            return false;
        }

        if(document.pressed == "선택삭제") {
            if(!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
                return false;
            }
        }

        return true;
    }
</script>

<?php
include_once G5_MANAGE_INCLUDE_PATH . "/admin_footer.php";
?>
