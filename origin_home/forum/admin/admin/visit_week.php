<?php
	include_once "./_common.php";
	/**
	 *	해당페이지 타이틀 및 기본 노출 설정
	 */
	$g5['title'] = "접속통계 > 인피아드 관리자모드";	//title
	$category_title = "접속통계";	//카테고리 제목
	$sub_title = "접속통계";	//서브 타이틀
	$sub_explan = ""; //페이지 설명
	include_once G5_MANAGE_INCLUDE_PATH . "/admin_header.php";
	$current=3;
	include_once('./visit.sub.php');
$colspan = 4;
$weekday = array ('월', '화', '수', '목', '금', '토', '일');

$sum_count = 0;
$sql = " select WEEKDAY(vs_date) as weekday_date, SUM(vs_count) as cnt
            from {$g5['visit_sum_table']}
            where vs_date between '{$fr_date}' and '{$to_date}'
            group by weekday_date
            order by weekday_date ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $arr[$row['weekday_date']] = $row['cnt'];

    $sum_count += $row['cnt'];
}
?>

<div class="table_outline">
    <table class="horizen">
        <thead>
        <tr>
            <th scope="col">요일</th>
            <th scope="col">그래프</th>
            <th scope="col">접속자수</th>
            <th scope="col">비율(%)</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <td colspan="2">합계</td>
            <td><strong><?php echo $sum_count ?></strong></td>
            <td>100%</td>
        </tr>
        </tfoot>
        <tbody>
        <?php
        $k = 0;
        if ($i) {
            for ($i=0; $i<7; $i++) {
                $count = (int)$arr[$i];

                $rate = ($count / $sum_count * 100);
                $s_rate = number_format($rate, 1);

                $bg = 'bg'.($i%2);
                ?>

                <tr class="<?php echo $bg; ?>">
                    <td class="td_category"><?php echo $weekday[$i] ?></td>
                    <td>
                        <div class="visit_bar">
                            <span style="width:<?php echo $s_rate ?>%"></span>
                        </div>
                    </td>
                    <td class="td_numbig"><?php echo $count ?></td>
                    <td class="td_num"><?php echo $s_rate ?></td>
                </tr>

                <?php
            }
        } else {
            echo '<tr><td colspan="'.$colspan.'" class="empty_table">자료가 없습니다.</td></tr>';
        }
        ?>
        </tbody>
    </table>
</div>
<?
	$colspan = 6;

	$sql_common = " from {$g5['visit_table']} ";
	$sql_search = " where vi_date between '{$fr_date}' and '{$to_date}' ";
	if (isset($domain))
	$sql_search .= " and vi_referer like '%{$domain}%' ";

	$sql = " select count(*) as cnt
			{$sql_common}
			{$sql_search} ";
	$row = sql_fetch($sql);
	$total_count = $row['cnt'];

	$rows = $config['cf_page_rows'];
	$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
	if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
	$from_record = ($page - 1) * $rows; // 시작 열을 구함

	$sql = " select *
			{$sql_common}
			{$sql_search}
			order by vi_id desc
			limit {$from_record}, {$rows} ";
	$result = sql_query($sql);
	?>
<table class="horizen">
	<colgroup span="5">
		<col width="20%">
		<col width="*">
		<col width="10%">
		<col width="10%">
		<col width="20%">
	</colgroup>
	<thead>
		<tr>
			<th scope="col">IP</th>
			<th scope="col">접속경로</th>
			<th scope="col">브라우저</th>
			<th scope="col">OS</th>
			<th scope="col">일시</th>
		</tr>
	</thead>
	<tbody>
	<?php
	for ($i=0; $row=sql_fetch_array($result); $i++) {
		$brow = $row['vi_browser'];
		if(!$brow)
			$brow = get_brow($row['vi_agent']);

		$os = $row['vi_os'];
		if(!$os)
			$os = get_os($row['vi_agent']);

		$device = $row['vi_device'];

		$link = '';
		$link2 = '';
		$referer = '';
		$title = '';
		if ($row['vi_referer']) {

			$referer = get_text(cut_str($row['vi_referer'], 255, ''));
			$referer = urldecode($referer);

			if (!is_utf8($referer)) {
				$referer = iconv_utf8($referer);
			}

			$title = str_replace(array('<', '>', '&'), array("&lt;", "&gt;", "&amp;"), $referer);
			$link = '<a href="'.$row['vi_referer'].'" target="_blank">';
			$link = str_replace('&', "&amp;", $link);
			$link2 = '</a>';
		}

		if ($is_admin == 'super')
			$ip = $row['vi_ip'];
		else
			$ip = preg_replace("/([0-9]+).([0-9]+).([0-9]+).([0-9]+)/", G5_IP_DISPLAY, $row['vi_ip']);

		if ($brow == '기타') { $brow = '<span title="'.get_text($row['vi_agent']).'">'.$brow.'</span>'; }
		if ($os == '기타') { $os = '<span title="'.get_text($row['vi_agent']).'">'.$os.'</span>'; }

		$bg = 'bg'.($i%2);
		?>
		<tr>
			<td class=""><?php echo $ip ?></td>
			<td class="left">
				<?php echo $link ?><?php echo $title ?><?php echo $link2 ?>
			</td>
			<td class=""><?php echo $brow ?></td>
			<td class=""><?php echo $os ?></td>
			<td class=""><?php echo $row['vi_date'] ?> <?php echo $row['vi_time'] ?></td>
		</tr>
		<?php
		}
		if ($i == 0)
			echo '<tr><td colspan="'.$colspan.'" class="empty_table">자료가 없거나 관리자에 의해 삭제되었습니다.</td></tr>';
		?>
	</tbody>
</table>
<div class="btn_area"><!-- 버튼 영역 -->
	<div class="btn_area_left"></div>
	<div class="btn_area_center">
		<div class="paging">
			<?php
			if (isset($domain))
				$qstr .= "&amp;domain=$domain";
			$qstr .= "&amp;page=";

			$pagelist = get_paging($config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?$qstr");
			echo $pagelist;
			?>
		</div>
	</div>
	<div class="btn_area_right"></div>
</div>
<?php
include_once G5_MANAGE_INCLUDE_PATH . "/admin_footer.php";
?>