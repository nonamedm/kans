<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
include_once(G5_THEME_LIB_PATH.'/thumbnail2.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);

$thumb_width  = isset($options['thumb_width']) ? $options['thumb_width'] : $board['bo_gallery_width'];
$thumb_height = isset($options['thumb_height']) ? $options['thumb_height'] : $board['bo_gallery_height'];
$content_length = isset($options['content_length']) ? $options['content_length'] : 30;

$thumb_width = "306";
$thumb_height = "430";
?>

<!-- <?php echo $bo_subject; ?> 최신글 시작 { -->
<ul class="af">
    <?php
    for ($i=0; $i<count($list); $i++) {
        $thumb = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $thumb_width, $thumb_height);

        if($thumb['src']) {
            $img_content = '<img src="'.$thumb['src'].'" alt="'.$thumb['alt'].'" width="'.$thumb_width.'" height="'.$thumb_height.'">';
        } else {
            $img = 'http://placehold.it/'.$thumb_width.'x'.$thumb_height.'?text=No_Image';
			$img_content = '<img src="'.$img.'" width="'.$thumb_width.'" height="'.$thumb_height.'" alt="이미지없음">';
        }

		$second = 0.3 + ($i * 0.3); 
    ?>
		<li class="wow fadeInUp"  data-wow-duration="1.2s" data-wow-delay="<?php echo $second; ?>s">
			<a href="<?php echo $list[$i]['href']; ?>">
				<figure><?php echo $img_content; ?>
					<figcaption><?php echo $list[$i]['subject']; ?></figcaption>
				</figure>
			</a>
		</li>
    <?php }  ?>

    <?php if ($i == 0) { //게시물이 없을 때  ?>
	<?php 
		$img = 'http://placehold.it/'.$thumb_width.'x'.$thumb_height.'?text=No_Image';
		$img_content = '<img src="'.$img.'" width="'.$thumb_width.'" height="'.$thumb_height.'" alt="이미지없음">'; ?>
		<li class="wow fadeInDown"  data-wow-duration="1.2s" data-wow-delay="1.2s">
		<a href="#n">
			<figure><?php echo $img_content; ?>
				<figcaption>게시물이 없습니다.</figcaption>
			</figure>
		</a>
	</li>
    <?php }  ?>
</ul>
<!-- } <?php echo $bo_subject; ?> 최신글 끝 -->