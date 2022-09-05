<?include("_common.php");
if($cases==1){//load cal
	$sca = urldecode($_POST['sca']);
	if($sca) $addqry = " and ca_name='$sca'";
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
			/*
			$s3_2_qry=sql_query("select * from g5_write_s3_2 where wr_5='$dateymd' {$addqry} order by wr_id desc");	//추천체용			
			for($j=0; $s3_2_row=sql_fetch_array($s3_2_qry); $j++){
				$_cal ="<div class='icon_cal'><a href='".G5_BBS_URL."/board.php?bo_table=s3_2&wr_id={$s3_2_row[wr_id]}' class='updatefalse'>";
				$_cal .= "<span class='child1'></span> [".$s3_2_row['ca_name']."]".get_text($s3_2_row['wr_subject']);
				$_cal .= "</a></div>";
				$load_subject .= $_cal;
			}
			
			$s3_3_qry=sql_query("select * from g5_write_s3_3 where wr_5='$dateymd' {$addqry} order by wr_id desc");	//채용공고
			for($j=0; $s3_3_row=sql_fetch_array($s3_3_qry); $j++){
				$_cal ="<div class='icon_cal'><a href='".G5_BBS_URL."/board.php?bo_table=s3_3&wr_id={$s3_3_row[wr_id]}' class='updatefalse'>";
				$_cal .= "<span class='child2'></span> [".$s3_3_row['ca_name']."]".get_text($s3_3_row['wr_subject']);
				$_cal .= "</a></div>";
				$load_subject .= $_cal;
			}

			$s3_4_1_qry=sql_query("select * from g5_write_s3_4_1 where wr_9='$dateymd' {$addqry} order by wr_id desc");	//아프바이트-교내
			for($j=0; $s3_4_1_row=sql_fetch_array($s3_4_1_qry); $j++){
				$_cal ="<div class='icon_cal'><a href='".G5_BBS_URL."/board.php?bo_table=s3_4_1&wr_id={$s3_4_1_row[wr_id]}' class='updatefalse'>";
				$_cal .= "<span class='child3'></span> [".$s3_4_1_row['ca_name']."]".get_text($s3_4_1_row['wr_subject']);
				$_cal .= "</a></div>";
				$load_subject .= $_cal;
			}
			
			$s3_4_2_qry=sql_query("select * from g5_write_s3_4_2 where wr_9='$dateymd' {$addqry} order by wr_id desc");	//아프바이트-교외
			for($j=0; $s3_4_2_row=sql_fetch_array($s3_4_2_qry); $j++){
				$_cal ="<div class='icon_cal'><a href='".G5_BBS_URL."/board.php?bo_table=s3_4_2&wr_id={$s3_4_2_row[wr_id]}' class='updatefalse'>";
				$_cal .= "<span class='child3'></span> [".$s3_4_2_row['ca_name']."]".get_text($s3_4_2_row['wr_subject']);
				$_cal .= "</a></div>";
				$load_subject .= $_cal;
			}

			$s3_5_qry=sql_query("select * from g5_write_s3_5 where wr_9='$dateymd' {$addqry} order by wr_id desc");	//각종활동
			for($j=0; $s3_5_row=sql_fetch_array($s3_5_qry); $j++){
				$_cal ="<div class='icon_cal'><a href='".G5_BBS_URL."/board.php?bo_table=s3_5&wr_id={$s3_5_row[wr_id]}' class='updatefalse'>";
				$_cal .= "<span class='child4'></span> [".$s3_5_row['ca_name']."]".get_text($s3_5_row['wr_subject']);
				$_cal .= "</a></div>";
				$load_subject .= $_cal;
			}
			*/
			$s7_5_qry=sql_query("select * from g5_write_s7_5 where wr_1='$dateymd' {$addqry} order by wr_id desc");
			for($j=0; $s7_5_row=sql_fetch_array($s7_5_qry); $j++){
				$_cal ="<div class='icon_cal'><a href='".G5_BBS_URL."/board.php?bo_table=s7_5&wr_id={$s7_5_row[wr_id]}' class='updatefalse'>";
				$_cal .= "<span class='child4'></span>".get_text($s7_5_row['wr_subject']);
				$_cal .= "</a></div>";
				$load_subject .= $_cal;
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
?>