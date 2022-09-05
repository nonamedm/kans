	<div align="center">
			<h2>
			<a href="#n" onclick="datechange('+1')"> ◀</a>
			<font class='date_year'><?=date("Y")?></font>. <span class='date_mon'><?=date("m")?></span>
			<a href="#n" onclick="datechange('-1')"> ▶ </a>
			</h2>
	</div>
		<div class="table_outline load_cal">
				<table class="horizen load_cal2">
				<colgroup>
					<col width="25%">
					<col width="*">
				</colgroup>
				<tbody>
				</tbody>
		</table>
		</div>

			<?$datetime = strtotime(date('Ym') . '01');?>
			<script type="text/javascript">
				var datenow="<?=$datetime?>"
				var datenow_Ym="<?=date("Y-m")?>"
				var cnt=0;
				function datechange(val,val2){
					cnt=0;
					var cases=1
					$.ajax({
						type: 'POST',
						url: './cal_ajax.php',
						data: {datenow:datenow,val:val,val2:val2,cases:cases},
						cache: false,
						async: false,
						success: function(result) {
							$(".load_cal2").html($(result).find("table").html());
							$(".date_year").html($(result).find("#date_year").html());
							$(".date_mon").html($(result).find("#date_mon").html());
							datenow=$(result).find("#datenow").text();
							datenow_Ym=$(result).find("#date_year").html()+$(result).find("#date_mon").html();
							$(".pg_current").removeClass("pg_current");
							$("*[data-id="+datenow_Ym+"]").addClass("pg_current");
						}
					});
				}
				$(function(){
					datechange(0,'');
							$(".pg_page").click(function(){
							$(".pg_current").removeClass("pg_current");
							$(this).addClass("pg_current");
							datechange(0,$(this).data("id"));
						});
				});
			</script>

	<nav class="pg_wrap">
			<span class="pg">
			<a href='#n' class="pg_page2"><?=date("Y")?></a>
				<?for($i=date("m")+1; $i>=1; $i--){ ?>
				<a href='#n' class="pg_page" data-id="<?=date("Y")?><?=sprintf("%02d",$i)?>"><?=$i?></a>
				<?}?>
			</span>
			<br>

			<span class="pg" ">
			<a href='#n' class="pg_page2"><?=date("Y")-1?></a>
				<?for($i=12; $i>=1; $i--){?>
				<a href='#n' class="pg_page" data-id="<?=date("Y")-1?><?=sprintf("%02d",$i)?>"><?=$i?></a>
				<?}?>
			</span>
		</nav>