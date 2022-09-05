<?php
	if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

	// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
	//add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
?>
<div class="owl-carousel owl-theme mnoti_list">
	<?php for ($i=0; $i<count($list); $i++) { ?>
	<div class="item">
		<a href="<?php echo $list[$i]['href']; ?>"><?php echo $list[$i]['subject']; ?></a>
		<span class="date"><?=str_replace("-",".",substr($list[$i][wr_datetime],0,10))?></span>
	</div>
	<?php
		}
		if (count($list) == 0) {
	?>
	<div class="item">
		<a href="#">게시물이 없습니다.</a>
		<span class="date"></span>
	</div>
	<?php
		}
	?>
</div>
