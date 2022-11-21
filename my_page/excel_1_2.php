<?php
include_once('./_common.php');

if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

//@mysql_query("SET CHARACTER SET utf8");  // 한글깨지면 주석해지

header( "Content-type: application/vnd.ms-excel" );
header( "Content-Disposition: attachment; filename = ".date('Ymd')."_교육담당자.xls" ); 
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

// $where .= " AND wr_13 = '".$member['mb_no']."' AND wr_14 = '".$member['mb_id']."' ";
$where .= " AND wr_30 = '{$member['mb_1']}' ";

// 선택한 경우
if(count($chk_wr_id)){
	$where .= " AND wr_id IN('".implode("', '", $chk_wr_id)."') ";
}

if(!empty($sste)){ $where .= " AND wr_state='".$sste."'"; }

if($syear){ $where .= " AND wr_22 LIKE '%".$syear."%' "; }
if($stype){ $where .= " AND wr_23 LIKE '".$stype."' "; }

// echo "SELECT COUNT(*) CNT FROM {$write_table} WHERE 1 ".$where.$sql_search." ";

$temp=sql_fetch_array(sql_query("SELECT COUNT(*) CNT FROM {$write_table} WHERE 1 ".$where.$sql_search." "));
$result=sql_query("SELECT * FROM {$write_table} WHERE 1 ".$where.$sql_search." ORDER BY wr_datetime DESC");

$number=$temp['CNT'];

// API 데이터 가져오기
if($syear){ $api_where .= "&EDU_YEAR={$syear}"; }

// API용 배열
$data_ = Array();

// 현 소속 회원의 개인회원들 정보
$api_sql = " SELECT mb_id, mb_hp, mb_3, mb_4 
			FROM {$g5['member_table']} 
			WHERE mb_1 = '{$member['mb_1']}' 
				AND mb_leave_date = '' /* 탈퇴회원 */
				AND mb_intercept_date = '' /* 차단회원 */
			ORDER BY mb_datetime ASC ";
$api_result = sql_query($api_sql);
for ($i=0; $row=sql_fetch_array($api_result); $i++) {
	// API 회원의 수강내역 가져오기
	$url = "https://www.kanselearning.kr/mediopia/calleduCompleteStudentInfoListKanselearningJSON?USER_ID={$row['mb_id']}{$api_where}";
	$data = preg_replace("/\n+/", "", file_get_contents_curl2($url));
	
	$temp_data_ = json_decode($data, true);
	for($j = 0; $j < count($temp_data_); $j++){
		$temp_data_[$j]["mb_hp"] = $row['mb_hp'];
		$temp_data_[$j]["mb_4"] = $row['mb_4'];
		$temp_data_[$j]["mb_id"] = $row['mb_id'];
		$data_[] = $temp_data_[$j];
	}
}

// 데이터 재정렬
if(count($data_)){
	$data_ = arr_sort($data_, 'SERVICESTART_DATE', 'desc');
	$number = $number + count($data_);
} ?>
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
		<th>이름</th>
		<th>생년월일</th>
		<th>핸드폰번호</th>
        <th>교육명</th>
		<th>교육일</th>
        <th>교육시간</th>
        <th>교육장소</th>
        <th>진행상태</th>
		<th>결제상태</th>
		<th>금액</th>
		<th>수료증 번호</th>
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

	// 수료증 번호
	if($data["wr_26"]){
		$finsh_year = "";
		// 교육일정이 같은날일 경우
		if($pro_info['wr_4'] && $pro_info['wr_3'] == $pro_info['wr_4']){ $finsh_year = date("y", strtotime($pro_info['wr_3'])); }
		else{ $finsh_year = date("Y", strtotime($pro_info['wr_4'])); }
		// 수료증 번호 추가 처리
		$add_text = "";

		// 보수교육
		if($pro_info['wr_1'] == '20'){ $add_text = "-L"; }

		// 전문교육, 기타
		if($pro_info['wr_1'] == '30' || $pro_info['wr_1'] == '40'){ $add_text = "-S"; }

		// 발급번호 처리
		$wr_26_ = "";
		for($j = 0; $j < (5-strlen($data["wr_26"])); $j++){
			$wr_26_ = "0".$wr_26_;
			
		}
		$wr_26_ .= $data["wr_26"];

		$wr_26_text = "제 KANS-{$finsh_year}{$add_text}-{$wr_26_} 호";
	}
	else{ $wr_26_text = ""; }
	?>
    <tr>
        <td><?php echo $number; ?></td><!-- 번호 -->
		<td class='txt'><?php echo $data['wr_3']; ?></td><!-- 이름 -->
		<td class='txt'><?php echo $data['wr_4']; ?></td><!-- 생년월일 -->
		<td class='txt'><?php echo $data['wr_5']; ?></td><!-- 핸드폰번호 -->
        <td class='txt'><?php echo $pro_info['wr_subject']; ?></td><!-- 교육명 -->
		<td class='txt'><?php echo implode(" ~ ", $date_arr); ?></td><!-- 교육일 -->
        <td class='txt'><?php echo implode(" ~ ", $date_arr2); ?></td><!-- 교육시간 -->
        <td class='txt'><?php echo $pro_info['wr_content']; ?></td><!-- 교육장소 -->
		<td class='txt'><?php echo ($data['wr_18'])?$data['wr_18']:"접수중"; ?></td><!-- 진행상태 -->
		<td class='txt'><?php echo ($data['wr_17'])?$data['wr_17']:"미결제";; ?></td><!-- 결제상태 -->
		<td class='txt'><?php echo number_format($pro_info['wr_8']); ?>원</td><!-- 금액 -->
		<td class='txt'><?php echo $wr_26_text; ?></td><!-- 수료증 번호 -->
		<td class='txt'><?php echo $data['wr_19']; ?></td><!-- 비고 -->
        <td class='txt'><?php echo date("y-m-d H:i", strtotime($data['wr_datetime'])); ?></td><!-- 등록일 -->
    </tr>
   <?php $number--; } ?>

	<?php if(count($data_)){
		for($i = 0; $i < count($data_); $i++) { ?>
			<?php
			$data['mb_id'] = $data_[$i]["mb_id"];	// 회원계정

			$data['wr_3'] = $data_[$i]["USER_NM"];	// 이름
			$data['wr_4'] = substr($data_[$i]["BIRTHDAY"], 2, 6)."-".$data_[$i]["mb_4"];	// 생년월일
			$data['wr_5'] = $data_[$i]["mb_hp"];	// 핸드폰번호
			$data['wr_subject'] = $data_[$i]["EDU_NM"];	// 교육명
			// $data['date1'] = date("Y.m.d", strtotime($data_[$i]["SERVICESTART_DATE"]))." ~ ".date("Y.m.d", strtotime($data_[$i]["SERVICEEND_DATE"]));
			if($data_[$i]["COMPLETE_DATE"] != "null"){ $data['date1'] = date("Y.m.d", strtotime($data_[$i]["COMPLETE_DATE"])); }
			else{ $data['date1'] = ""; }
			$data['time'] = $data_[$i]["LEARNING_TIME"]."시간";
			$data['wr_17'] = $data_[$i]["PAYMENT_STATUS"];
			$data['wr_18'] = ($data_[$i]["ENROLL_STATUS"] == "수료")?"교육수료":$data_[$i]["ENROLL_STATUS"];
			$data['EDU_CD'] = $data_[$i]["EDU_CD"];
			$data['wr_26'] = $data_[$i]["CERT_NO"];
			?>
			<tr>
				<td><?php echo $number; ?></td><!-- 번호 -->
				<td class='txt'><?php echo $data['wr_3']; ?></td><!-- 이름 -->
				<td class='txt'><?php echo $data['wr_4']; ?></td><!-- 생년월일 -->
				<td class='txt'><?php echo $data['wr_5']; ?></td><!-- 핸드폰번호 -->
				<td class='txt'><?php echo $data['wr_subject']; ?></td><!-- 교육명 -->
				<td class='txt'><?php echo $data['date1']; ?></td><!-- 교육일 -->
				<td class='txt'><?php echo $data['time']; ?></td><!-- 교육시간 -->
				<td class='txt'></td><!-- 교육장소 -->
				<td class='txt'><?php echo $data['wr_18']?></td><!-- 진행상태 -->
				<td class='txt'><?php echo ($data['wr_17'])?$data['wr_17']:"미결제";; ?></td><!-- 결제상태 -->
				<td class='txt'></td><!-- 금액 -->
				<td class='txt'><?php $data['wr_26']?></td><!-- 수료증 번호 -->
				<td class='txt'></td><!-- 비고 -->
				<td class='txt'></td><!-- 등록일 -->
			</tr>
		<?php $number--; }
	} ?>
</table>
</body>
</html>