<?include("_common.php");
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
				$query=sql_query("select * from g5_write_s5_1 where wr_1='$dateymd' order by wr_id desc ");
				while($row2=sql_fetch_array($query)){
					$row2[wr_subject] = str_replace("\"", "&#34;", $row2[wr_subject]);
					//$load_subject.="<div class='icon_cal'><a href='#n' class='updatefalse' id='$row2[idx]'>[$row2[wr_3]] $row2[wr_subject]</a></div>";

// 타입두개 클래스 넣어두었습니다. 
					$load_subject.="<div><a class='c_ty1' href='".G5_BBS_URL."/board.php?bo_table=s5_1&wr_id=".$row2[wr_id]."'><strong class='cate_s'>[분류]</strong> $row2[wr_subject]</a></div>";  
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
