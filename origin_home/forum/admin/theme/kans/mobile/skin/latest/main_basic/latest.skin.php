<?php
	if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

	// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
	//add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
?>



<?php for ($i=0; $i<count($list); $i++) { ?>

	<li>
		<a href="<?php echo $list[$i]['href'];?>">
			<div class="top">
				<h4><?php echo $list[$i]['subject']; ?></h4>
				<div class="data_box">
					<span class=""><i><img src="<? echo G5_THEME_URL ?>/images/main/mcnt1_i1.png" /></i><?php echo str_replace("-", ".", $list[$i]['datetime']); ?></span>
					<span><i><img src="<? echo G5_THEME_URL ?>/images/main/mcnt1_i2.png" /></i><?php echo $list[$i]['wr_hit'] ?></span>
					<span>
						<? if($list[$i]['icon_new']) {?>New <?} else {?><?}?>
						<!-- <?php if (isset($list[$i]['icon_new'])) echo $list[$i]['icon_new'];?> -->
					</span>
					
				</div>
			</div>
			<div class="bottom">
				<p><?php echo utf8_strcut(str_replace("&nbsp;", " ", strip_tags($list[$i]['wr_content'])), 40); ?></p>
			</div>
		</a>
	</li>
<?php } if (count($list) == 0) { ?>
	<li class="none_li">
		<a href="<?php echo $list[$i]['href'];?>">
			<p>게시글이 없습니다.</p>
		</a>
	</li>
<?php } ?>


