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

$colspan = 5;

$max = 0;
$sum_count = 0;
$sql = " select * from {$g5['visit_table']}
          where vi_date between '$fr_date' and '$to_date' ";
$result = sql_query($sql);
while ($row=sql_fetch_array($result)) {
    $s = $row['vi_os'];
    if(!$s)
        $s = get_os($row['vi_agent']);

    $arr[$s]++;

    if ($arr[$s] > $max) $max = $arr[$s];

    $sum_count++;
}
?>

    <table class="horizen">
        <thead>
        <tr>
            <th scope="col">순위</th>
            <th scope="col">OS</th>
            <th scope="col">그래프</th>
            <th scope="col">접속자수</th>
            <th scope="col">비율(%)</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <td colspan="3">합계</td>
            <td><strong><?php echo $sum_count ?></strong></td>
            <td>100%</td>
        </tr>
        </tfoot>
        <tbody>
        <?php
        $i = 0;
        $k = 0;
        $save_count = -1;
        $tot_count = 0;
        if (count($arr)) {
            arsort($arr);
            foreach ($arr as $key=>$value) {
                $count = $arr[$key];
                if ($save_count != $count) {
                    $i++;
                    $no = $i;
                    $save_count = $count;
                } else {
                    $no = '';
                }

                if (!$key) {
                    $key = 'Unknown';
                }

                $rate = ($count / $sum_count * 100);
                $s_rate = number_format($rate, 1);

                $bg = 'bg'.($i%2);
                ?>

                <tr class="<?php echo $bg; ?>">
                    <td class="td_num"><?php echo $no ?></td>
                    <td class="td_category"><?php echo $key ?></td>
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

<?php
include_once G5_MANAGE_INCLUDE_PATH . "/admin_footer.php";
?>