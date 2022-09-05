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

include_once('./visit.sub.php');

$colspan = 4;

$max = 0;
$sum_count = 0;
$sql = " select SUBSTRING(vi_time,1,2) as vi_hour, count(vi_id) as cnt
            from {$g5['visit_table']}
            where vi_date between '{$fr_date}' and '{$to_date}'
            group by vi_hour
            order by vi_hour ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++) {
    $arr[$row['vi_hour']] = $row['cnt'];

    if ($row['cnt'] > $max) $max = $row['cnt'];

    $sum_count += $row['cnt'];
}
?>
<script src="share/js/morris.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/prettify/r224/prettify.min.js"></script>
<script src="share/js/example.js"></script>


<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/prettify/r224/prettify.min.css">
<link rel="stylesheet" href="share/css/morris.css">



<ul class="tab_btn">
	<li class="on"><a href="visit_hour.php?fr_date=<?=$fr_date?>&to_date=<?=$to_date?>">시간대별 현황</a></li>
	<li class=""><a href="visit_date.php?fr_date=<?=$fr_date?>&to_date=<?=$to_date?>">일별 현황</a></li>
	<li class=""><a href="visit_week.php?fr_date=<?=$fr_date?>&to_date=<?=$to_date?>">요일별 현황</a></li>
	<li class=""><a href="visit_month.php?fr_date=<?=$fr_date?>&to_date=<?=$to_date?>">월별 현황</a></li>
	<li class=""><a href="visit_year.php?fr_date=<?=$fr_date?>&to_date=<?=$to_date?>">연별 현황</a></li>
</ul>


<div class="table_outline">
	<table class="horizen">
		<colgroup span="4">
			<col width="20%" />
			<col width="30%" />
			<col width="20%" />
			<col width="30%" />
		</colgroup>
		<tbody>
			<tr>
				<th scope="row">총 접속자 수</th>
				<td class="">
					<strong class="count"></strong>
					<span class="">명</span>
				</td>
				<th scope="row">평균 접속자 수</th>
				<td class="">
					<strong class="count"></strong>
					<span class="">명</span>
				</td>
			</tr>
			<tr>
				<th scope="row">오늘 접속자 수</th>
				<td class="">
					<strong class="count"></strong>
					<span class="">명</span>
				</td>
				<th scope="row">어제 접속자 수</th>
				<td class="">
					<strong class="count"></strong>
					<span class="">명</span>
				</td>
			</tr>
			<tr>
				<th scope="row">이번달 접속자 수</th>
				<td class="">
					<strong class="count"></strong>
					<span class="">명</span>
				</td>
				<th scope="row">이번달 평균 접속자 수</th>
				<td class="">
					<strong class="count"></strong>
					<span class="">명</span>
				</td>
			</tr>
		</tbody>
	</table>
</div>

<div class="canvas_box">
<div id="graph"></div>
</div>

    <table class="horizen">
        <thead>
        <tr>
            <th scope="col">시간</th>
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
            for ($i=0; $i<24; $i++) {
                $hour = sprintf("%02d", $i);
                $count = (int)$arr[$hour];

                $rate = ($count / $sum_count * 100);
                $s_rate = number_format($rate, 1);

                $bg = 'bg'.($i%2);
                ?>
                <tr class="<?php echo $bg; ?>">
                    <td class="td_category"><?php echo $hour ?></td>
                    <td>
                        <div class="visit_bar">
                            <span style="width:<?php echo $s_rate ?>%"></span>
                        </div>
                    </td>
                    <td class="td_numbig"><?php echo number_format($count) ?></td>
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

<?php
include_once G5_MANAGE_INCLUDE_PATH . "/admin_footer.php";
?>