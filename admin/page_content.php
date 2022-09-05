<?php
include_once "./_common.php";
include_once(G5_EDITOR_PATH."/cms/editor.lib.php");

include_once G5_MANAGE_INCLUDE_PATH . "/admin.head.sub.php";
$info=sql_fetch("select * from page where idx='$idx'");

switch($cate){
	case 1: $pname= "센터소개";break;
}

switch($type){
	case 1:$fild="content1"; $fild2="sub_title1"; $subject="(국문) "; $subject.=$info[title1]?"{$info[title1]}":"No title"; break;
	case 2:$fild="content2"; $fild2="sub_title2"; $subject="(영문) "; $subject.=$info[title2]?"{$info[title2]}":"No title"; break;
}

$editor_html = editor_html($fild, $info[$fild], 1);
$editor_js= get_editor_js($fild, 1);
//$editor_js .= chk_editor_js('wr_content', 1);

?>
<style>
.h3_label {
    margin: 0 0 10px;
    padding: 10px 0 10px 22px;
    font-size: 15px;
    color: #000;
    font-weight: 700;
    background: url(./share/images/h3_bg.png) no-repeat left 50%;
}
</style>
<style>
::-webkit-input-placeholder {
   color: #BDBDBD;
}
</style>

<h3 class="h3_label"><?=$pname?></h3> 
<b>※초기 작업된 HTML 소스 형태에서 벗어난다면 정상적으로 보이지 않을수 있습니다.</b><br>
<b>※변경시 가급적 우측하단 HTML탭을 이용하여 주십시오.</b><br><br>
	    <form name="fwrite" id="fwrite" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
		    <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
			<input type="hidden" id="idx" name="idx" value="<?=$idx ?>">
			<input type="hidden" name="cate" value="<?=$cate?>">
			<input type="hidden" name="fild" value="<?=$fild?>">
			<input type="hidden" name="type" value="<?=$type?>">
			<input type="hidden" name="fild2" value="<?=$fild2?>" class="w30 frm_input" placeholder="Sub Title">
			<!--input type="text" name="<?=$fild2?>" value="<?=$info[$fild2]?>" class="w30 frm_input" placeholder="Sub Title"-->
			
			<br><br>
			<?=$editor_html?>
			<div class="btn_area mt10">
				<div class="btn_area_right">
					<input type="submit" class="btn_normal" value="확인">
				</div>
			</div>
		</form>

<script>
function fwrite_submit(f){
	<?=$editor_js?>
	f.action="./page_content_update.php";
	return true;
}
</script>