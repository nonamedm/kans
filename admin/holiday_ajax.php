<?include("_common.php");

$bo_table ="s5_1";
$write_table = $g5['write_prefix'] . $bo_table;

if($step=="load_cal"){
	$cal_ym = $Y.$M;
	$cal_ym2 = strtotime($cal_ym . '01');
	$cal_week = date('w', $cal_ym2);
	$cal_day_cnt = date('t', $cal_ym2) + $cal_week + 1;
	$load_cal="<tr>";
		for($i = $row = 1; $i < $cal_day_cnt; $i++, $row++){
			$date = $i - $cal_week;
			$cal_ymd= $cal_ym . sprintf('%02d', $date);
			$cal_ymd=substr($cal_ymd,0,4)."-".substr($cal_ymd,4,2)."-".substr($cal_ymd,6,2);
			if($date<1){
				$load_cal.="<td class='notd'></td>";
				continue;
			}
			$hol_query=sql_query("select * from {$write_table} where wr_1='$cal_ymd' order by wr_id desc");
			
			//$holi=sql_fetch("select idx,title from holiday where holidate='$cal_ymd' ");
			
			$view=false;
			for($j=0; $hol=sql_fetch_array($hol_query); $j++){
				$view[]=$hol;
			}
			
			if($i%7==0 || $i%7==1) {//주말
				$load_cal.="<td class='caltd'><a href='#n' onclick=\"layer('휴일설정','700','300', './holiday_form.php?day={$cal_ymd}');\"><font color='red'>{$date}</font></a>";
			}else{
				$load_cal.="<td class='caltd'><a href='#n' onclick=\"layer('휴일설정','700','300', './holiday_form.php?day={$cal_ymd}');\">{$date}</a>";
			}
			
			
			if($j){//공휴일
				$load_cal.="<div  align='left'>";
				for($j=0; $j<count($view); $j++){
					//$time1=time_print($view[$j][wr_subject]);
					//$time2=time_print($view[$j][time2]);
					if($j) $load_cal.="<br>";
					$load_cal.="<a href='".G5_MANAGE_URL."/board.php?bo_table={$bo_table}&wr_id={$view[$j][wr_id]}' class='' onclick=\"layer('휴일설정','700','300', './holiday_form.php?idx={$view[$j][idx]}');\">{$view[$j][wr_subject]}</a> ";
				}
			$load_cal.="</div>";
			}
			$load_cal.="</td>";
			if($row > 0 && $row % 7 == 0 && $row < $cal_day_cnt) $load_cal.= "</tr><tr>";
		}
	$count = 7 - (($row - 1) % 7);
	if($count != 7)
	{
		for($i = 1; $i <= $count; $i++) $load_cal.= "<td class='notd'></td>";
	}
$load_cal.="</tr>";
echo $load_cal;
}
?>

