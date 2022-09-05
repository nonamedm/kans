<?
	include_once('./_common.php');

	//화면의 성격
	$user_division = "user";
	$screen_div = "sub"; //main, sub
	$frame_div = "one";  //one, two
?>
<style>
 iframe {
  width: 100%;
  height: 100%;
}
</style>
<div class="yout">
				<?
				$row=sql_fetch("select wr_1 from g5_write_s3_2 where wr_id='$wr_id'");
				if(preg_match("/^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]{11}).*/", $row['wr_1'], $tmp) && $tmp[2]){
				echo "<iframe width='' height='' src='//www.youtube.com/embed/{$tmp[2]}' frameborder='0' allowfullscreen></iframe>";
				}
				?>
</div>
<?php include_once(G5_THEME_PATH.'/tail2.php'); ?>