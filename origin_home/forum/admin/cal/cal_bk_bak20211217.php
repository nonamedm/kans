<style>

.cal_head {position: relative; margin-bottom:20px; text-align:center; box-sizing:border-box; overflow:hidden; padding-bottom: 10px;}
.cal_head > a { position:relative; display:inline-block; width:30px; height:30px; background:#484848; border-radius:5px; vertical-align:middle; }
.cal_head > a > span { position:absolute; left:-9999px; top:-9999px; }
.cal_head > a:nth-child(1):after { position:absolute; left:50%; top:50%; font-family:"FontAwesome"; color:#fff; content:"\f053"; transform:translateX(-50%) translateY(-50%); }
.cal_head > a.next_mons:after { position:absolute; left:50%; top:50%; font-family:"FontAwesome"; color:#fff; content:"\f054"; transform:translateX(-50%) translateY(-50%); }
.cal_head > h3 { display:inline-block; margin:0 50px; font-size:30px; line-height:1; text-align:center; vertical-align:middle; }

.cal_tb { width:100%; border-spacing:5px; border-collapse: separate;}
.cal_tb th, .cal_tb td { background:#fff; border:1px solid #ddd; border-radius:5px; }

.cal_tb thead th { font-size:18px; color:#fff; font-weight:300; background:#dbdbdb; color:#303030; font-weight: 400;}
.cal_tb thead tr th:first-child {  }
.cal_tb thead tr th:nth-child(1) { background:rgba(255,0,0,0.07); color:#f00; }
.cal_tb thead tr th:nth-last-child(1) { background:rgba(0,0,255,0.08); color:#00f; }

.cal_tb tbody td { height:140px; padding:7px 5px 0 5px; vertical-align:top; }
.cal_tb tbody td a{position: relative; text-align: left; font-size: 14px;  line-height: 1.6; ;padding-left: 15px; box-sizing: border-box;}

.cal_tb tbody td a .cate_s{ font-weight: 500; color: #fff; display: inline-block; font-size: 13px; vertical-align: top;}
.cal_tb tbody td a strong{display: inline-block; font-size: 11px; color: #fff; padding: 0 5px;} 
.cal_tb tbody td a.c_ty2 strong, b.c_ty2{background: #1a619f; }
.cal_tb tbody td a.c_ty3 strong, b.c_ty3 {background: #c057a9; }
.cal_tb tbody td a.c_ty4 strong, b.c_ty4 {background: #00a6e3; }
.cal_tb tbody td a.c_ty5 strong, b.c_ty5 {background: #0189ff; }
.cal_tb tbody td a.c_ty6 strong, b.c_ty6 {background: #c31a7d; }
.cal_tb tbody td a.c_ty7 strong, b.c_ty7 {background: #77a430; }

b.c_ty0{text-align: center; color: #fff; line-height: 2;}

.cal_tb tbody td a:hover .view_pop{display: block;}

.cal_tb tbody tr td:first-child {  }
.cal_tb tr td .date { font-size:15px; color:#888; text-align:right; }
.cal_tb tr td strong.white{color:#fff;}
.cal_tb tr td strong.red{color:#ff0000;}
.cal_tb tr td div{padding-bottom:5px;}
.cal_tb tr td:nth-child(7n-6) .date { color:#ff0000; }
.cal_tb tr td:nth-child(7n) .date { color:#0100ff }

.hint{text-align: right; margin: 0px 10px 20px;}
.hint_box{display: inline-block;}
.hint_box li{position: relative; display: inline-block; padding: 0 5px; font-size: 16px; text-align: center; color: #fff; margin-left: 3px; font-size: 13px;}
.hint_box li input{vertical-align: middle;}

.hint_box li label{padding: 0 5px; text-align: center;	} 
.hint_box li.bg_color_1 label{background: #e14b4b; }
.hint_box li.bg_color_2 label{background: #1a619f; }
.hint_box li.bg_color_3 label{background: #c057a9; }
.hint_box li.bg_color_4 label{background: #00a6e3; }
.hint_box li.bg_color_5 label{background: #0189ff; }
.hint_box li.bg_color_6 label{background: #c31a7d; }
.hint_box li.bg_color_7 label{background: #77a430; }
.hint_box li.bg_color_8 label{background: #ffcc00; }


.cal_wrap{margin-bottom: 160px; margin-top: 100px;}
/*
.cal_tb .icon_cal { position:relative; margin:4px 0; padding-left:15px; line-height:1; }
.cal_tb .icon_cal:before { position:absolute; left:0; top:1px; font-family:"FontAwesome"; content:"\f017"; }
*/
.cal_tb span {display: inline-block; width: 10px; height: 10px; border-radius: 50%; margin-right: 7px;}
.cal_tb span.child1 {background: #2875dd;} 
.cal_tb span.child2{background: #82bb08;} 
.cal_tb span.child3 {background: #ffc000;} 
.cal_tb span.child4 {background: #9c9cdf;} 

.view_pop{position: absolute; left: 80px; top: 0; width: 300px; height: auto; background: #fff; display: none; border: 2px solid #0094dc; z-index: 100; }

.view_pop b{display: block; background: ;}
.view_pop ul > li{display: table; width: 100%; table-layout: fixed; box-sizing: border-box; border-bottom: 1px solid #ddd;}

.view_pop ul > li > *{display: table-cell; font-size: 14px; line-height: 1.7; vertical-align: top; box-sizing: border-box;}
.view_pop ul > li > h5{width: 70px; background: #0094dc; color: #fff; text-align: center; }
.view_pop ul > li > p{padding-left: 10px; font-weight: 500; color: #333;}
.view_pop input[type='button']{width: 80px; height: 30px; line-height: 30px; text-align: center; margin: 8px auto 0; display: block; background: #0094dc; font-size: 14px; color: #fff; border: 0; outline:none; } 

.left_down{/* float: left; */}
.left_down > a{display: inline-block; background: #fd7400; color: #fff; padding: 5px 10px; border-radius: 10px; transition:.3s;}
.left_down > a:hover{background: #000;}

.cal_sch_new{position: absolute; right: 0; top: 0;}
.cal_sch_new > *{float: left;}
.cal_sch_new > select{border: 1px solid #ddd; height: 35px;}
.cal_sch_new > a{width: 50px; background: #0075c1; color: #fff; text-align: center; line-height: 35px; font-size: 14px; margin-left: 5px; margin-right: 10px;}  


.fillter_cal{text-align: center;}
.fillter_cal table tr > *{border: 1px solid #ddd; font-size: 16px; line-height: 40px; color: #666; line-height: 1.5;}
.fillter_cal table tr > th{width: 200px;  color: #333; font-weight: 500; padding: 5px 0; border-left: 0; height: 40px; background: #f4f4f4;}
.fillter_cal table tr > th input{margin-right: 5px;}
.fillter_cal table tr > th label{font-weight: 400; color: #666;}

.fillter_cal table tr > td{text-align: left; box-sizing: border-box; padding: 5px 10px; border-right: 0;}
.fillter_cal table tr > td .box ul > li{display: inline-block; margin-right: 10px;}
.fillter_cal table tr > td .box ul > li input{margin-right: 5px;}
.fillter_cal table tr > td .box ul > li select{border: 1px solid #ddd; height: 40px; min-width:200px;}
.fillter_cal > input{margin: 30px 0 50px; width: 150px; background: #0094dc; color: #fff; border: 0; height: 45px; font-size: 16px; transition:.3s;}
.fillter_cal > input:hover{background: #000;}

@media(max-width:800px){
	.cal_tb thead{display: none;}
	.cal_tb tbody td{display: none; height: auto;}
	.cal_tb{display: block;}
	.cal_tb tbody{display: block;}
	.cal_tb tbody tr{display: block; width: 100%; height: auto;}
	.cal_tb tbody td.update{display: block; width: 100% !important; margin-bottom: 2vw !important; height: auto; padding: 10px ; box-sizing: border-box;}
	.cal_tb tbody td{position: relative; text-align: left;}
	.cal_tb tbody td .date{text-align: left;}
	.cal_tb tbody td .date:after{display: inline-block; content: ''; padding-left: 5px;}
	.cal_tb tbody td:first-child .date:after{content: ' (???)';}
	.cal_tb tbody td:nth-child(2) .date:after{content: ' (???)';}
	.cal_tb tbody td:nth-child(3) .date:after{content: ' (???)';}
	.cal_tb tbody td:nth-child(4) .date:after{content: ' (???)';}
	.cal_tb tbody td:nth-child(5) .date:after{content: ' (???)';}
	.cal_tb tbody td:nth-child(6) .date:after{content: ' (???)';}
	.cal_tb tbody td:nth-child(7) .date:after{content: ' (???)';}
	.cal_tb tbody td a{position: relative;}
	.cal_tb tbody td a .cate_s{display: block; }
}
@media(max-width:440px){
	.cal_head > h3{font-size: 5.5vw;}
	.cal_tb tbody td a .cate_s{font-size: 3.2vw; line-height: 1.7;}
	.cal_tb tbody td a{font-size: 3.2vw; line-height: 1.7;}
	.hint_box li{font-size: 3.2vw; margin-left: 10px;}
	.cal_wrap{margin-bottom: 12vw;}
}
</style>
<div class="cal_wrap">
	<div class="fillter_cal">
		<table>
			<tr>
				<th>????????????</th>
				<td>
					<div class="box">
						<ul>
							<li><a href="<?=$s1_2_2_url;?>"><input type="radio" name="" checked="checked"><label for="">?????? ???</label></a></li>
							<li><a href="<?=$s1_2_2_2_url;?>"><input type="radio" name=""><label for="">????????? ???</label></a></li>
						</ul>
					</div>
				</td>
			</tr>
			<tr>
				<th>????????????</th>
				<td>
					<div class="box">
						<ul>
							<li>
								<select name="">
									<option value="??????" selected>??????</option>
									<option value="????????????">????????????</option>
									<option value="????????????">????????????</option>
									<option value="????????????">????????????</option>
									<option value="??????">??????</option>
								</select>
							</li>
							<li>
								<select name="">
									<option value="??????" selected>??????</option>
									<option value="????????????">????????????</option>
									<option value="????????????">????????????</option>
									<option value="????????? ??????">????????? ??????</option>
									<option value="????????? ??????">????????? ??????</option>
								</select>
							</li>
						</ul>
					</div>
				</td>
			</tr>
			<tr>
				<th>???????????? <br> <input type="checkbox" name=""><label for="">??????</label></th>
				<td>
					<div class="box">
						<ul>
							<li><input type="checkbox" name=""><label for="">??????</label></li>
							<li><input type="checkbox" name=""><label for="">??????</label></li>
							<li><input type="checkbox" name=""><label for="">??????</label></li>
							<li><input type="checkbox" name=""><label for="">??????</label></li>
							<li><input type="checkbox" name=""><label for="">??????</label></li>
							<li><input type="checkbox" name=""><label for="">??????</label></li>
							<li><input type="checkbox" name=""><label for="">??????</label></li>
							<li><input type="checkbox" name=""><label for="">??????</label></li>
							<li><input type="checkbox" name=""><label for="">??????</label></li>
							<li><input type="checkbox" name=""><label for="">??????</label></li>
							<li><input type="checkbox" name=""><label for="">??????</label></li>
							<li><input type="checkbox" name=""><label for="">??????</label></li>
							<li><input type="checkbox" name=""><label for="">??????</label></li>
							<li><input type="checkbox" name=""><label for="">??????</label></li>
							<li><input type="checkbox" name=""><label for="">??????</label></li>
							<li><input type="checkbox" name=""><label for="">?????????</label></li>
						</ul>
					</div>
				</td>
			</tr>
			<tr>
				<th>????????????</th>
				<td>
					<div class="box">
						<ul>
							<li><input type="checkbox" name=""><label for="">??????</label></li>
							<li><input type="checkbox" name=""><label for="">??????</label></li>
						</ul>
					</div>
				</td>
			</tr>
		</table>
		<input type="submit" value="??????">
	</div>



	<div class="cal_head">
		<a href="#n" onclick="datechange('-1')"><span>?????????</span></a>
		<h3><font class='date_year'><?=date("Y")?></font>. <span class='date_mon'><?=date("m")?></span></h3>
		<a href="#n" onclick="datechange('+1')" class="next_mons"><span>?????????</span></a>

		
	</div>
	<div class="left_down">
		<a href="">?????? ????????????</a>
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
				<th class="">???</th>
				<th>???</th>
				<th>???</th>
				<th>???</th>
				<th>???</th>
				<th>???</th>
				<th>???</th>
			</tr>
		</thead>
		<tbody class="load_cal"></tbody>
	</table>
</div>
<?php
$bo_table = "s1_2_2";
$datetime = strtotime(date('Ym') . '01');
?>
<script type="text/javascript">
	var datenow="<?=$datetime?>"
	var selected="<?=date("Ymd")?>"
	var cnt=0;
	function datechange(val){
		cnt=0;
		var cases=1
		$.ajax({
			type: 'POST',
			url: './cal_ajax_bk.php',
			data: {datenow: datenow, val: val, selected: selected, cases: cases, bo_table: "<?php echo $bo_table; ?>"},
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