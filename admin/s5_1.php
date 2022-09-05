<?php
	include_once "./_common.php";
	$category_title = "커뮤니티";	//카테고리 제목
	$sub_title = "월별행사안내";	//서브 타이틀
	include_once G5_MANAGE_INCLUDE_PATH . "/admin_header.php";
?>

<div class="btn_area">
	<div class="btn_area_right">
		<a href="#n" onclick="window.open('./s5_1_form.php', 'popname', 'top=20, left=300, width=880,height=300')" class="btn_normal">추가</a>
	</div>
</div>

<?include("./cal.php");?>

<div class="btn_area">
	<div class="btn_area_right">
		<a href="#n" onclick="window.open('./s5_1_form.php', 'popname', 'top=20, left=300, width=880,height=300')" class="btn_normal">추가</a>
	</div>
</div>

<?php
include_once G5_MANAGE_INCLUDE_PATH . "/admin_footer.php";
?>