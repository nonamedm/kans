<?php
	include_once "./_common.php";
	include_once G5_PATH . "/lib/latest.lib.php";
	/**
	 *	해당페이지 타이틀 및 기본 노출 설정
	 */
	$g5['title'] = "초기화면 > 인피아드 관리자모드";	//title
	$category_title = "초기화면";	//카테고리 제목
	$sub_title = "관리자모드";	//서브 타이틀
	//$sub_explan = "해당 사이트의 인사말이 등록됩니다"; //페이지 설명

	include_once G5_MANAGE_INCLUDE_PATH . "/admin_header.php";

	$weekday = array ('월', '화', '수', '목', '금', '토', '일');

						for($i=0; $i<7; $i++){
						$week_query[$i] = sql_fetch(" select SUM(vs_count) as cnt from {$g5['visit_sum_table']} where WEEKDAY(vs_date) ='{$i}' ");
						if(!$week_query[$i][cnt]) $week_query[$i][cnt]="0";
					}


	$latestcolor=array('gray','#76A7FA','','#C5A5CF','#BC5679');
	for($ii=1; $ii<=5; $ii++){
	$jj=$ii-1;
	$latest[]=sql_fetch("select * from  {$g5['visit_sum_table']} where vs_date>DATE_ADD(NOW(), INTERVAL -{$ii} DAY) and vs_date<DATE_ADD(NOW(), INTERVAL -{$jj} DAY)");
	}
?>

<div class="base_box mb50">
	<div class="base_box_left">
		<h4 class="h4_label">요일별 접속통계</h4>
		<div class="box_type1 mb20" id="piechart">
			요일별 접속통계 그래프
		</div>
		<div class="txt_group1">
			<span class="txt_left"><strong><?=date('Y-m-d');?></strong> 기준</span>
			<span class="txt_right">단위:명</span>
		</div>
		<table class="horizen">
			<colgroup span="">
				<col width="14.2857%">
				<col width="14.2857%">
				<col width="14.2857%">
				<col width="14.2857%">
				<col width="14.2857%">
				<col width="14.2857%">
				<col width="14.2857%">
			</colgroup>
			<thead>
				<tr>

					<th scope="col">월</th>
					<th scope="col">화</th>
					<th scope="col">수</th>
					<th scope="col">목</th>
					<th scope="col">금</th>
					<th scope="col">토</th>
					<th scope="col">일</th>
				</tr>
			</thead>
			<tfoot>
			</tfoot>
			<tbody>
				<tr>
					<?
					
					for($i=0; $i<=6; $i++){
					echo "<td class='center'>{$week_query[$i][cnt]}</td>";
					}
					?>
				</tr>
			</tbody>
		</table>
		<a href="visit_week.php" class="btn_more"><span>more</span></a>
	</div>
	<div class="base_box_right">
		<h4 class="h4_label">최근 5일간 접속자 수 통계</h4>
		<div class="box_type1 mb20" id="barchart_values">
			최근 5일간 접속자 수 통계 그래프
		</div>
		<div class="txt_group1">
			<span class="txt_left"><strong><?=date("Y-m-d")?></strong> 기준</span>
			<span class="txt_right">단위:명</span>
		</div>
		<table class="horizen">
			<colgroup span="">
				<col width="14.2857%">
				<col width="14.2857%">
				<col width="14.2857%">
				<col width="14.2857%">
				<col width="14.2857%">
				<col width="14.2857%">
				<col width="14.2857%">
			</colgroup>
			<thead>
				<tr>
				<?for($i=4; $i>=0; $i--){
					$day="-$i day";?>
					<th scope="col"><?=date("Y-m-d",strtotime($day))?></th>
					<?}?>
				</tr>
			</thead>
			<tfoot>
			</tfoot>
			<tbody>
				<tr>
				<?for($i=count($latest)-1; $i>=0; $i--){?>
					<td class="center"><?if(!$latest[$i][vs_count]) $latest[$i][vs_count]=0; echo $latest[$i][vs_count];?></td>
					<?}?>
				</tr>
			</tbody>
		</table>
		<a href="visit_list.php" class="btn_more"><span>more</span></a>
	</div>
</div>
<!--<div class="base_box mb50">
	<div class="base_box_center">
		<h4 class="h4_label">SMS 충전현황</h4>
		<table class="vertical">
			<colgroup span="">
				<col width="15%">
				<col width="35%">
				<col width="15%">
				<col width="35%">
			</colgroup>
			<tbody>
				<tr>
					<th scope="row">발송금액(1건)</th>
					<td class="left">0원</td>
					<th scope="row">사용금액(발송건수)</th>
					<td class="left">0원</td>
				</tr>
				<tr>
					<th scope="row">남은 충전금액</th>
					<td class="left">0원</td>
					<th scope="row">발송가능 건수</th>
					<td class="left">0건</td>
				</tr>
			</tbody>
		</table>
		<a href="#n" class="btn_more"><span>more</span></a>
	</div>
</div>-->

<!--<div class="base_box mb50">
	<div class="base_box_center">
		<h4 class="h4_label">SMS 최근 발송내역</h4>
		<table class="horizen">
			<colgroup span="">
				<col width="10%">
				<col width="10%">
				<col width="10%">
				<col width="*">
				<col width="10%">
			</colgroup>
			<thead>
				<tr>
					<th scope="col">발송일</th>
					<th scope="col">수신일</th>
					<th scope="col">수신자</th>
					<th scope="col">내용</th>
					<th scope="col">성공여부</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="center">0</td>
					<td class="center">0</td>
					<td class="center">0</td>
					<td class="left">0</td>
					<td class="center">0</td>
				</tr>
			</tbody>
		</table>
		<a href="#n" class="btn_more"><span>more</span></a>
	</div>
</div>-->

<script type="text/javascript" src="../js/chart.js"></script>
    <script type="text/javascript">
     google.charts.load('current', {'packages':['corechart']});
     google.charts.setOnLoadCallback(drawChart4);
	   function drawChart4() {

        var data = google.visualization.arrayToDataTable([
           ['week', 'count'],
			<?php $i=0;
				for($i=0; $i<7; $i++){
				echo "['{$weekday[$i]}',{$week_query[$i][cnt]}], ";
			}?>
        ]);

        var options = {
          title: '요일별 접속통계',
		  is3D: true,
			   slices: {
                0: { color: '#e6e6e6'},
				1: { color: '#e4eefe' },
				2: { color: '#d7e1f5' },
                3: { color: '#f4edf6' },
		     	4: { color: '#C5A5CF' },
			    5: { color: '#f2dee5' },
				6: { color: '#FFD8D8' },
          },

			chartArea:{left:20,top:0,width:'100%',height:'100%'},
			pieSliceTextStyle: {
            color: 'black',
          }
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }


	google.charts.setOnLoadCallback(drawChart);
	function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Year', '접속자 수', { role: 'style' } ],

	  <?php
		for($i=0; $i<count($latest); $i++){
		  $day="-$i day"; if(!$latest[$i][vs_count]) $latest[$i][vs_count]=0;
		  $day=date('Y-m-d', strtotime($day));
		  echo "['$day',{$latest[$i][vs_count]}, 'opacity: 0.2; color: {$latestcolor[$i]}'], ";
		  }
	?>
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "",
       // width: 600,
		 // height: 300,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },

      };
      var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
      chart.draw(view, options);
  }
  </script>

<?php
include_once G5_MANAGE_INCLUDE_PATH . "/admin_footer.php";
?>