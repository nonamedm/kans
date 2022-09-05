<?include("_common.php");
if($cases==1){//load cal
	$schedule_ym=date('Ym', strtotime("{$val} month", $datenow));
	$date_year=date('Y', strtotime("{$val} month", $datenow));
	$date_mon=date('m', strtotime("{$val} month", $datenow));

	if($val2){
	$schedule_ym=$val2;
	$date_year=substr($val2,0,4);
	$date_mon=substr($val2,4,2);
	}

	if(preg_match('/^[0-9]{6}$/', $schedule_ym) == true && checkdate(substr($schedule_ym, 4, 2), 1, substr($schedule_ym, 0, 4)) == true) $VAR['select'] = $schedule_ym;
	$VAR['timestamp'] = strtotime($VAR['select'] . '01');

$load_cal=="";
			$dateymd = $VAR['select'];
			$dateymd=substr($dateymd,0,4)."-".substr($dateymd,4,2);

	$query=sql_query("select idx,wr_1,wr_2,wr_content from schedule where (substr(wr_1,1,7)<='$dateymd' and substr(wr_2,1,7)>='$dateymd' ) order by wr_1 asc,wr_2 asc, idx desc");

				while($row=sql_fetch_array($query)){
					$wr_content=get_text($row[wr_content],2);
					$load_cal.="<tr>";
					$load_cal.="<td><a href='#n' onclick=\"window.open('./s3_1.php?idx={$row[idx]}', 'popname', 'top=20, left=300, width=880,height=880')\">{$row[wr_1]} ~ {$row[wr_2]}</td>";
					$load_cal.="<td class='left'>{$wr_content}</td>";
					$load_cal.="</tr>";
				}
				if(!$load_cal){
					$load_cal.="<tr class=''>";
					$load_cal.="<td colspan='2' class='empty_table'>일정이 없습니다.</td>";
					$load_cal.="</tr>";
				}
				?>

<div id="result">
		<table class="horizen load_cal">
				<colgroup>
					<col width="25%">
					<col width="*">
				</colgroup>
				<tbody>
					<?=$load_cal?>
				</tbody>
		</table>
</div>
<div id ="result2">
	<div id="date_year"><?=$date_year?></div>
	<div id="date_mon"><?=$date_mon?></div>
	<div id="datenow"><?=$VAR[timestamp]?></div>
</div>
<?}?>
