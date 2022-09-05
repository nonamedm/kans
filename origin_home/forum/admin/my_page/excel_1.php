<?php
include_once('./_common.php');

if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

//@mysql_query("SET CHARACTER SET utf8");  // 한글깨지면 주석해지

header( "Content-type: application/vnd.ms-excel" );
header( "Content-Disposition: attachment; filename = ".date('Ymd')."_교육생.xls" ); 
header( "Content-Description: PHP4 Generated Data" );

$where = "";
$stx = trim($stx);

if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        default :
            $sql_search .= " ($sfl like '%$stx%') ";
            break;
    }
    $sql_search .= " ) ";
}

if ($sca) {
	$where .= " AND ca_name = '".$sca."' ";
}

$where .= " AND mb_id = '".$member['mb_id']."' ";

// 선택한 경우
if(count($chk_wr_id)){
	$where .= " AND wr_id IN('".implode("', '", $chk_wr_id)."') ";
}

if(!empty($sste)){ $where .= " AND wr_state='".$sste."'"; }

$temp=sql_fetch_array(sql_query("SELECT COUNT(*) CNT FROM {$write_table} WHERE 1 ".$where.$sql_search." "));
$result=sql_query("SELECT * FROM {$write_table} WHERE 1 ".$where.$sql_search." ORDER BY wr_datetime DESC");

$number=$temp['CNT'];

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
.txt {mso-number-format:'\@'}
</style>
</head>

<body>
<table>
    <tr>
        <th>번호</th>
        <th>교육명</th>
		<th>교육일</th>
        <th>교육시간</th>
        <th>교육장소</th>
        <th>진행상태</th>
		<th>결제상태</th>
		<th>금액</th>
		<th>비고</th>
		<th>등록일</th>
    </tr>

<?php
while($data=sql_fetch_array($result)) { ?>
	<?php
	// 교육정보
	$prd_write_table = $g5['write_prefix'] . substr($bo_table, 0, -2);
	$pro_info = sql_fetch(" SELECT * FROM ".$prd_write_table." WHERE wr_id = '".$data['wr_1']."' ");

	$date_arr = Array();
	if($pro_info['wr_3']){ $date_arr[] = date("Y.m.d", strtotime($pro_info['wr_3'])); }
	if($pro_info['wr_4'] && $pro_info['wr_3'] != $pro_info['wr_4']){ $date_arr[] = date("Y.m.d", strtotime($pro_info['wr_4'])); }

	$date_arr2 = Array();
	if($pro_info['wr_9']){ $date_arr2[] = $pro_info['wr_9']; }
	if($pro_info['wr_10'] && $pro_info['wr_9'] != $pro_info['wr_10']){ $date_arr2[] = $pro_info['wr_10']; }
	?>
    <tr>
        <td><?php echo $number; ?></td><!-- 번호 -->
        <td class='txt'><?php echo $pro_info['wr_subject']; ?></td><!-- 교육명 -->
		<td class='txt'><?php echo implode(" ~ ", $date_arr); ?></td><!-- 교육일 -->
        <td class='txt'><?php echo implode(" ~ ", $date_arr2); ?></td><!-- 교육시간 -->
        <td class='txt'><?php echo $pro_info['wr_content']; ?></td><!-- 교육장소 -->
		<td class='txt'><?php echo ($data['wr_18'])?$data['wr_18']:"접수중"; ?></td><!-- 진행상태 -->
		<td class='txt'><?php echo ($data['wr_17'])?$data['wr_17']:"미결제";; ?></td><!-- 결제상태 -->
		<td class='txt'><?php echo number_format($pro_info['wr_8']); ?>원</td><!-- 금액 -->
		<td class='txt'><?php echo $data['wr_19']; ?></td><!-- 비고 -->
        <td class='txt'><?php echo date("y-m-d H:i", strtotime($data['wr_datetime'])); ?></td><!-- 등록일 -->
    </tr>
   <?php $number--; } ?>
</table>
</body>
</html>