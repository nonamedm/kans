<?php
include_once "./_common.php";
$category_title = "Reservation";	//카테고리 제목
$sub_title = "휴일설정";	//서브 타이틀
include_once G5_MANAGE_INCLUDE_PATH . "/admin_header.php";
echo '<link rel="stylesheet" href="'.G5_THEME_CSS_URL.'/'.(G5_IS_MOBILE?'mobile':'default').'/template'.$shop_css.'.css">'.PHP_EOL;
?>
<style>
	.notd{background: #f5f5f5; }
	.notd2{background: #000000;}
	.horizen td{height: 60px;}
	.caltd{vertical-align:top; text-align:right !important; }
</style>
 <script type="text/javascript" src="<?=G5_URL?>/js/jquery.form.min.js"></script>
 
<div class="btn_area">
	<div class="btn_area_left">
	<form id="cal_form">
				<input type="hidden" name="step" value="load_cal">
				<div class="calen_top_sec">
					<select name="Y" class="select_ty" onchange="$('#cal_form').submit();">
						<?for ($i=date("Y")-1; $i<=date("Y")+10; $i++){?>
						<option value="<?=$i?>" <?=$i==date("Y")?"selected":"" ?>><?=$i?></option>
						<?} ?>
					</select> 년
					<select name="M" class="select_ty"  onchange="$('#cal_form').submit();">
						<?for ($i=1; $i<=12; $i++){?>
						<option value="<?=sprintf("%02d",$i) ?>" <?=$i==date("m")?"selected":"" ?>><?=$i ?></option>
						<?}?>
					</select> 월
				</div>
			</form>
	</div>
	<div class="btn_area_right">
		<a href="<?php echo G5_MANAGE_URL?>/write.php?bo_table=<?php echo $bo_table ?>" class="btn_normal">일정등록</a>
	</div>
</div>

			
			<table class="horizen">
					<colgroup>
					<col width="14.28%" />
					<col width="14.28%" />
					<col width="14.28%" />
					<col width="14.28%" />
					<col width="14.28%" />
					<col width="14.28%" />
					<col width="14.28%" />
				</colgroup>
				<thead>
					<tr>
						<th scope="col" class="sun">일</th>
						<th scope="col">월</th>
						<th scope="col">화</th>
						<th scope="col">수</th>
						<th scope="col">목</th>
						<th scope="col">금</th>
						<th scope="col" class="sat">토</th>
					</tr>
				</thead>
				<tbody id="cal_area">
				<tr><td colspan='7' rowspan='5'><a><img src='http://ims.inpiad.com/index/img/loading.gif' width='180' height='180'></a></td><tr>
				</tbody>
			</table>
<form id="delete_day" method="post" action="./holiday_update.php">
	<input type="hidden" name="w" value="d">
	<input type="hidden" name="idx" id="idx" value="">
</form>

<script>
$(function(){
	$("#cal_form").ajaxForm({
		url: "./holiday_ajax.php",
		beforeSubmit:function(){
			//$("#cal_area").html("<tr><td colspan='7' rowspan='5'><a><img src='http://ims.inpiad.com/index/img/loading.gif' width='180' height='180'></a></td><tr>");
		},
			success: function(result){
				$("#cal_area").html(result);
			}
		});

	$("#delete_day").ajaxForm({
		url: "./holiday_update.php",
		success: function(result){
				$("#cal_form").submit();
			}
		});

	
	$("#cal_form").submit();
});
function delete_day(idx){
	if(confirm("정말로 삭제하시겠습니까?")){
		$("#idx").val(idx);
		$("#delete_day").submit();
	}
}
</script>
<?php
include_once G5_MANAGE_INCLUDE_PATH . "/admin_footer.php";
?>