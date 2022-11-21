<?include("_common.php");

$bo_table = $_POST["bo_table"];
if(empty($bo_table)){ $bo_table = "s1_2_2"; }
$write_table = $g5['write_prefix'] . $bo_table;

// 검색 조건
$swr_1 = $_POST["swr_1"]; // 교육종류 1차
$swr_2 = $_POST["swr_2"]; // 교육종류 2차
$swr_6 = $_POST["swr_6"]; // 지역
$swr_7 = $_POST["swr_7"]; // 교육방식

$where = "";
if($swr_1){ $where .= " AND wr_1 = '".$swr_1."' "; }
if($swr_2){ $where .= " AND wr_2 = '".$swr_2."' "; }
if($swr_6){ $where .= " AND INSTR('".$swr_6."', wr_6) > 0 "; }
if($swr_7){ $where .= " AND INSTR('".$swr_7."', wr_7) > 0 "; }

if($cases==1){//load cal
	$schedule_ym=date('Ym', strtotime("{$val} month", $datenow));
	$date_year=date('Y', strtotime("{$val} month", $datenow));
	$date_mon=date('m', strtotime("{$val} month", $datenow));
	if(preg_match('/^[0-9]{6}$/', $schedule_ym) == true && checkdate(substr($schedule_ym, 4, 2), 1, substr($schedule_ym, 0, 4)) == true) $VAR['select'] = $schedule_ym;
	$VAR['timestamp'] = strtotime($VAR['select'] . '01');
	$VAR['weekday'] = date('w', $VAR['timestamp']);
	$VAR['count'] = date('t', $VAR['timestamp']) + $VAR['weekday'] + 1;

	$load_cal="<tr height=100>";

		for($i = $row = 1; $i < $VAR['count']; $i++, $row++)
		{
			$date = $i - $VAR['weekday'];
			if($date<1){
			$load_cal.="<td  class='default'></td>";
			continue;
			}
			$dateymd = $VAR['select'] . sprintf('%02d', $date);
			$dateymd=substr($dateymd,0,4)."-".substr($dateymd,4,2)."-".substr($dateymd,6,2);

			$load_subject="";
			$color="";
			$idx="";
				// 캘린더(=bo_table) 가져오기
				$sql = "SELECT * 
						FROM ".$write_table."
						WHERE (wr_3 = '".$dateymd."' OR wr_4 = '".$dateymd."'
							OR ('".$dateymd."' BETWEEN wr_3 AND wr_4))
							".$where."
						ORDER BY wr_3, wr_id DESC ";
				$query=sql_query($sql);
				while($row2=sql_fetch_array($query)){
					$row2[wr_subject] = str_replace("\"", "&#34;", $row2[wr_subject]);
					//$load_subject.="<div class='icon_cal'><a href='#n' class='updatefalse' id='$row2[idx]'>[$row2[wr_3]] $row2[wr_subject]</a></div>";
					
					$btn_href = "#n";
					// c_ty1: 녹색, c_ty2: 노란색, c_ty3: 빨강색
					/* if($row2['ca_name'] == '일반 정기'){ $class_name = "c_ty2"; $ca_name = "직장교육"; }
					else if($row2['ca_name'] == '비파괴 정기'){ $class_name = "c_ty3"; $ca_name = "직장교육"; }
					else if($row2['ca_name'] == '일반 신규'){ $class_name = "c_ty4"; $ca_name = "직장교육"; }
					else if($row2['ca_name'] == '비파괴 신규'){ $class_name = "c_ty5"; $ca_name = "직장교육"; }
					else if($row2['ca_name'] == '보수교육'){ $class_name = "c_ty6"; $ca_name = "보수교육"; }
					else if($row2['ca_name'] == '전문교육'){ $class_name = "c_ty7"; $ca_name = "전문교육"; }
					
					//기타추가
					else if($row2['ca_name'] == '기타'){ $class_name = "c_ty8"; $ca_name = "기타"; }
					*/
					
					if($row2['wr_2'] == '1020'){ $class_name = "c_ty2"; $ca_name = "직장교육"; }
					else if($row2['wr_2'] == '1040'){ $class_name = "c_ty3"; $ca_name = "직장교육"; }
					else if($row2['wr_2'] == '1010'){ $class_name = "c_ty4"; $ca_name = "직장교육"; }
					else if($row2['wr_2'] == '1030'){ $class_name = "c_ty5"; $ca_name = "직장교육"; }
					else if($row2['wr_1'] == '20'){ $class_name = "c_ty6"; $ca_name = "보수교육"; }
					else if($row2['wr_1'] == '30'){ $class_name = "c_ty7"; $ca_name = "전문교육"; }
//기타추가
					else if($row2['wr_1'] == '40'){ $class_name = "c_ty8"; $ca_name = "기타"; }

					$ca_name = "";
					// 직장교육일 경우 2차 카테고리명
					if($row2['wr_1'] == '10'){
						$ca_info = get_category_info($bo_table, $row2['wr_2']);
						$ca_name = $ca_info['ca_name'];
					}
					// 그외는 1차 카테고리명
					else{
						$ca_info = get_category_info($bo_table, $row2['wr_1']);
						$ca_name = $ca_info['ca_name'];
					}

					// $btn_href = G5_BBS_URL."/write.php?bo_table=".$bo_table."_1&amp;ca_nm=".urlencode($ca_name)."&amp;wr_3=".$row2['wr_id'];
					$btn_href = G5_BBS_URL."/write.php?bo_table=".$bo_table."_1&amp;wr_1=".$row2['wr_id'];
					
					$time_ = "";
				    $time_arr = Array();
				    if($row2['wr_9']){ $time_arr[] = $row2['wr_9']; }
				    if($row2['wr_10']){ $time_arr[] = $row2['wr_10']; }
				    $time_ = implode(" ~ ", $time_arr);
					
					// 타입두개 클래스 넣어두었습니다.
					// $load_subject .= "<div><a class='".$class_name."' href='".G5_BBS_URL."/board.php?bo_table=".$bo_table."&wr_id=".$row2[wr_id]."'>";
					$load_subject .= "<div><a class='".$class_name."' href='#n'>";
					$load_subject .= "<strong class='cate_s'>".$ca_name."</strong> ".$row2['wr_subject'];
					$load_subject .= "<div class='view_pop'>";
					$load_subject .= "<b class='c_ty0 ".$class_name."'>".$ca_name."</b>";
					$load_subject .= "<ul>";
					$load_subject .= "<li><h5>교육명</h5><p>".$row2['wr_subject']."</p></li>";
					$load_subject .= "<li><h5>교육시간</h5><p>".$time_."</p></li>";
					$load_subject .= "<li><h5>교육장소</h5><p>".$row2['wr_content']."</p></li>";
					$load_subject .= "<li><h5>신청인원</h5><p>".$row2['wr_5']."</p></li>";
// 스토리보드 금액추가
					$load_subject .= "<li><h5>금액</h5><p><b>".number_format($row2['wr_8'])."</b></p></li>";
					$load_subject .= "<ul>";
					
					// 단체 회원일 경우 처리
					if($member['mb_level'] == 3){
						$btn_href = G5_URL."/cal/cal_write1.php?wr_1=".$row2['wr_id'];
					}
					// 신청가능상태 확인
					$result_info = get_status($bo_table, $row2['wr_id']);
					if($result_info['status'] == '마감'){}
					else{
						if($is_member){ $load_subject .= "<input type='button' value='신청하기' class='btn_request' data-val='".$row2['wr_id']."'> "; }
						else{ $load_subject .= "<input type='button' value='신청하기' class='' onclick='goToLogin();' > "; }
					}

//                    $load_subject .= "<input type='button' value='신청하기' class='btn_request' data-val='".$row2['wr_id']."'> ";
				//	$load_subject .= "<input type='button' value='신청하기' onclick=document.location.href='".$btn_href."';>";
					$load_subject .= "</div>";
					$load_subject .= "</a></div>";

					//$color=$row2[wr_5];
				}

			$load_cal.="<td  class='default left update' style='background-color:$color; cursor:pointer;'>";
			$load_cal.="<div class='date'>$date</div>"; //일수
			$load_cal.=$load_subject;
			$load_cal.="</td>";
			if($row > 0 && $row % 7 == 0 && $row < $VAR['count']) $load_cal.= "</tr><tr height=100>";
		}
		$count = 7 - (($row - 1) % 7);
		if($count != 7)
		{
			for($i = 1; $i <= $count; $i++) $load_cal.= "<td class='default'></td>";
		}

		echo "{load_cal : \"$load_cal\",
				date_year : '$date_year',
				date_mon : '$date_mon',
				datenow : '$VAR[timestamp]'
				}";
}
