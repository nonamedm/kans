<style>
.cal_head { margin-bottom:40px; text-align:center; box-sizing:border-box; overflow:hidden; }
.cal_head > a { position:relative; display:inline-block; width:30px; height:30px; background:#484848; border-radius:5px; vertical-align:middle; }
.cal_head > a > span { position:absolute; left:-9999px; top:-9999px; }
.cal_head > a:nth-child(1):after { position:absolute; left:50%; top:50%; font-family:"FontAwesome"; color:#fff; content:"\f053"; transform:translateX(-50%) translateY(-50%); }
.cal_head > a:nth-last-child(1):after { position:absolute; left:50%; top:50%; font-family:"FontAwesome"; color:#fff; content:"\f054"; transform:translateX(-50%) translateY(-50%); }
.cal_head > h3 { display:inline-block; margin:0 50px; font-size:30px; line-height:1; text-align:center; vertical-align:middle; }

.cal_tb { width:100%; border-spacing:5px; }
.cal_tb th, .cal_tb td { background:#fff; border:1px solid #ddd; border-radius:5px; }

.cal_tb thead th { font-size:18px; color:#fff; font-weight:300; background:#dbdbdb; color:#303030; }
.cal_tb thead tr th:first-child {  }
.cal_tb thead tr th:nth-child(1) { background:#ef5a25; color:#fff; }
.cal_tb thead tr th:nth-last-child(1) { background:#14a6bc; color:#fff; }

.cal_tb tbody td { height:140px; padding:7px 5px 0 5px; vertical-align:top; }
.cal_tb tbody tr td:first-child {  }
.cal_tb tr td .date { font-size:15px; color:#888; text-align:right; }
.cal_tb tr td strong.white{color:#fff;}
.cal_tb tr td strong.red{color:#ff0000;}
.cal_tb tr td div{padding-bottom:5px;}
.cal_tb tr td:nth-child(7n-6) .date { color:#ff0000; }
.cal_tb tr td:nth-child(7n) .date { color:#0100ff }
/*
.cal_tb .icon_cal { position:relative; margin:4px 0; padding-left:15px; line-height:1; }
.cal_tb .icon_cal:before { position:absolute; left:0; top:1px; font-family:"FontAwesome"; content:"\f017"; }
*/
.cal_tb span {display: inline-block; width: 10px; height: 10px; border-radius: 50%; margin-right: 7px;}
.cal_tb span.child1 {background: #2875dd;} 
.cal_tb span.child2{background: #82bb08;} 
.cal_tb span.child3 {background: #ffc000;} 
.cal_tb span.child4 {background: #9c9cdf;} 
</style>

<div class="cal_head">
	<a href="#n" onclick="datechange('-1')"><span>이전달</span></a>
	<h3><font class='date_year'><?=date("Y")?></font>. <span class='date_mon'><?=date("m")?></span></h3>
	<a href="#n" onclick="datechange('+1')"><span>다음달</span></a>
</div>

<table class="cal_tb ct1">
	<colgroup>
		<col width="14%">
		<col width="14%">
		<col width="14%">
		<col width="14%">
		<col width="14%">
		<col width="14%">
		<col width="14%">
	</colgroup>
	<thead>
		<tr height=40>
			<th class="">일</th>
			<th>월</th>
			<th>화</th>
			<th>수</th>
			<th>목</th>
			<th>금</th>
			<th>토</th>
		</tr>
	</thead>
	<tbody class="load_cal"></tbody>
</table>
<!-- <ul class="col_po clear">
	<li><span></span>추천채용</li> 
	<li><span></span>추천공고</li>
	<li><span></span>아르바이트</li> 
	<li><span></span>공모전/기타</li> 
</ul> -->
<?$datetime = strtotime(date('Ym') . '01');?>
<script type="text/javascript">
	var datenow="<?=$datetime?>"
	var selected="<?=date("Ymd")?>"
	var sca="<?=urlencode($sca)?>"
	var cnt=0;
	function datechange(val){
		cnt=0;
		var cases=1
		$.ajax({
			type: 'POST',
			url: './cal_ajax.php',
			data: {datenow:datenow,val:val,selected:selected,cases:cases,sca:sca},
			cache: false,
			async: false,
			success: function(result) {
				var data = eval("("+result+")");
				$(".load_cal").html(data.load_cal);
				$(".date_year").html(data.date_year);
				$(".date_mon").html(data.date_mon);
				datenow=data.datenow;
				$(".update").click(function(){
					var idx=this.id
					if(idx){
						window.open('./cal_view.php?idx='+idx, 'popname', 'top=100, left=300, width=880,height=380')
					}
				});
			}
		});
	}
	$(function(){
		datechange(0,selected);
	});
</script>