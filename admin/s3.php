<?php
	include_once "./_common.php";
	$category_title = "ARTISTS";	//카테고리 제목
	$sub_title = "SCHEDULE";	//서브 타이틀
	include_once G5_MANAGE_INCLUDE_PATH . "/admin_header.php";
?>
<div class="btn_area">
	<div class="btn_area_right">
		<a href="#n" onclick="window.open('./s3_1.php', 'popname', 'top=20, left=300, width=880,height=880')" class="btn_normal">일정등록</a>
	</div>
</div>

<?include("./cal.php");?>

<div class="btn_area">
	<div class="btn_area_right">
		<a href="#n" onclick="window.open('./s3_1.php', 'popname', 'top=20, left=300, width=880,height=880')" class="btn_normal">일정등록</a>
	</div>
</div>

<?php
include_once G5_MANAGE_INCLUDE_PATH . "/admin_footer.php";
?>