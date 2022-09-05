<?php
	if (!defined('_GNUBOARD_')) exit;

	include_once(G5_LIB_PATH.'/visit.lib.php');

	include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');

	if (empty($fr_date)) $fr_date = G5_TIME_YMD;
	if (empty($to_date)) $to_date = G5_TIME_YMD;

	$qstr = "fr_date=".$fr_date."&amp;to_date=".$to_date;
	$query_string = $qstr ? '?'.$qstr : '';
?>

<h4 class="h4_label">접속자</h4>
<div class="status_area">
	<form name="fvisit" id="fvisit" class="" method="get">
		<div class="status_area_left">
			<strong>기간별검색</strong>
			<input type="text" name="fr_date" value="<?php echo $fr_date ?>" id="fr_date" class="frm_input date_pic" size="12" maxlength="10">
			<label for="fr_date" class="sound_only">시작일</label>
			~
			<input type="text" name="to_date" value="<?php echo $to_date ?>" id="to_date" class="frm_input date_pic" size="12" maxlength="10">
			<label for="to_date" class="sound_only">종료일</label>
			<input type="submit" value="검색" class="btn_submit">
		</div>
	</form>
	<div class="status_area_right">
		<a href="./visit_list.php<?php echo $query_string ?>" class="btn_small2">접속자</a>
		<a href="./visit_domain.php<?php echo $query_string ?>" class="btn_small2">도메인</a>
		<a href="./visit_browser.php<?php echo $query_string ?>" class="btn_small2">브라우저</a>
		<a href="./visit_os.php<?php echo $query_string ?>" class="btn_small2">운영체제</a>
		<?php if(version_compare(phpversion(), '5.3.0', '>=') && defined('G5_BROWSCAP_USE') && G5_BROWSCAP_USE) { ?>
			<a href="./visit_device.php<?php echo $query_string ?>" class="btn_small2">접속기기</a>
		<?php } ?>
		<!--
		<a href="./visit_hour.php<?php echo $query_string ?>" class="btn_small2">시간</a>
		<a href="./visit_week.php<?php echo $query_string ?>" class="btn_small2">요일</a>
		<a href="./visit_date.php<?php echo $query_string ?>" class="btn_small2">일</a>
		<a href="./visit_month.php<?php echo $query_string ?>" class="btn_small2">월</a>
		<a href="./visit_year.php<?php echo $query_string ?>" class="btn_small2">년</a>
		-->
	</div>
</div>
<script>
    $(function(){
        $("#fr_date, #to_date").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, yearRange: "c-99:c+99", maxDate: "+0d" });
    });

    function fvisit_submit(act)
    {
        var f = document.fvisit;
        f.action = act;
        f.submit();
    }
</script>
<script src="share/js/morris.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/prettify/r224/prettify.min.js"></script>
<script src="share/js/example.js"></script>


<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/prettify/r224/prettify.min.css">
<link rel="stylesheet" href="share/css/morris.css">
<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/themes/base/jquery-ui.css" rel="stylesheet" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>

<script type="text/javascript">
		$('.date_pic').datepicker({
			buttonImageOnly: true,
			buttonText: "달력",
			changeMonth: true,
				dateFormat: 'yy-mm-dd',
			changeYear: true,
			showButtonPanel: true,
			yearRange: 'c-30:c+0',
			maxDate: '+0y'
		});
</script>


<ul class="tab_btn">
	<li class="<?=$current==1?"on":""?>"><a href="visit_list.php?fr_date=<?=$fr_date?>&to_date=<?=$to_date?>">시간대별 현황</a></li>
	<li class="<?=$current==2?"on":""?>"><a href="visit_date.php?fr_date=<?=$fr_date?>&to_date=<?=$to_date?>">일별 현황</a></li>
	<li class="<?=$current==3?"on":""?>"><a href="visit_week.php?fr_date=<?=$fr_date?>&to_date=<?=$to_date?>">요일별 현황</a></li>
	<li class="<?=$current==4?"on":""?>"><a href="visit_month.php?fr_date=<?=$fr_date?>&to_date=<?=$to_date?>">월별 현황</a></li>
	<li class="<?=$current==5?"on":""?>"><a href="visit_year.php?fr_date=<?=$fr_date?>&to_date=<?=$to_date?>">연별 현황</a></li>
</ul>

<?
$today = date("Y-m-d");
$yesterday=date("Y-m-d", strtotime("-1 days"));
$mon = date("Y-m");
$query_total=sql_fetch("select  sum(vs_count) as cnt from {$g5['visit_sum_table']}");
$query_avg=sql_fetch("select vs_date from {$g5['visit_sum_table']} order by vs_date");
	$time = strtotime($today) - strtotime($query_avg[vs_date]);
	$days = floor($time/86400); //전체 평균접속일

$query_today=sql_fetch("select vs_date, vs_count as cnt from {$g5['visit_sum_table']} where vs_date='$today'");
$query_yesterday=sql_fetch("select vs_date, vs_count as cnt from {$g5['visit_sum_table']} where vs_date='$yesterday'");
$query_mon=sql_fetch("select vs_date, sum(vs_count) as cnt from {$g5['visit_sum_table']} where vs_date like '{$mon}%'");

$query_mon_avg=sql_fetch("select vs_date, vs_count as cnt from {$g5['visit_sum_table']}");
	$time_mon = strtotime($today) - strtotime($mon."-01");
	$days_mon=floor($time_mon/86400); //전체 평균접속일
?>
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
					<span class=""><?=$query_total[cnt]?>명</span>
				</td>
				<th scope="row">평균 접속자 수</th>
				<td class="">
					<strong class="count"></strong>
					<span class="">최초접속일 기준 : <?=round($query_total[cnt]/$days,2)?>명</span>
				</td>
			</tr>
			<tr>
				<th scope="row">오늘 접속자 수</th>
				<td class="">
					<strong class="count"></strong>
					<span class=""><?=$query_today[cnt]?$query_today[cnt]:0?>명</span>
				</td>
				<th scope="row">어제 접속자 수</th>
				<td class="">
					<strong class="count"></strong>
					<span class=""><?=$query_yesterday[cnt]?$query_yesterday[cnt]:0?>명</span>
				</td>
			</tr>
			<tr>
				<th scope="row">이번달 접속자 수</th>
				<td class="">
					<strong class="count"></strong>
					<span class=""><?=$query_mon[cnt]?>명</span>
				</td>
				<th scope="row">이번달 평균 접속자 수</th>
				<td class="">
					<strong class="count"></strong>
					<span class=""> <?=round($query_mon[cnt]/$days_mon,2)?>명</span>
				</td>
			</tr>
		</tbody>
	</table>
</div>


<div class="canvas_box">
<div id="graph"></div>
</div>