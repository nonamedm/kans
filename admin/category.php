<?php
	include_once "./_common.php";
	/**
	 *	해당페이지 타이틀 및 기본 노출 설정
	 */
	 //if($_SERVER["REMOTE_ADDR"]!="211.170.81.198") alert("접근 불가");
	 $category_title = $group['gr_subject'];	//카테고리 제목
	$sub_title = "카테고리 관리";	//서브 타이틀
	
	
	include_once G5_MANAGE_INCLUDE_PATH . "/admin_header.php";

	//내용(컨텐츠)정보 테이블이 있는지 검사한다.
	if(!sql_query(" DESCRIBE ".$g5['category']." ", false)) {
		$query_cp = sql_query(" CREATE TABLE `".$g5['category']."` (
								  `idx` int(11) NOT NULL AUTO_INCREMENT,
								  `bo_table` varchar(255) NOT NULL DEFAULT '''''',
								  `ca_id` varchar(12) NOT NULL DEFAULT '0',
								  `ca_name` varchar(255) NOT NULL DEFAULT '',
								  `ca_name2` varchar(255) NOT NULL,
								  `ca_name3` varchar(255) NOT NULL,
								  `ca_name4` varchar(255) NOT NULL,
								  `content` text NOT NULL,
								  `content2` text NOT NULL,
								  `content3` text NOT NULL,
								  `content4` text NOT NULL,
								  `turn` int(11) NOT NULL DEFAULT '0',
								  `datetime` datetime NOT NULL,
								  PRIMARY KEY (`idx`),
								  KEY `ca_order` (`turn`)
								) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 ", true);
	}

?>

<?


$lavel_bg = array('#b6e6f9', '#e4f6fd', '#f3fbff', '#ffffff');

$where=" and bo_table='{$bo_table}' ";
if($s1){
	$where.=" and LENGTH(ca_id) = '$s1'";
	$qstr.="&s1=$s1";
}

if($s2){
	$where.=" and (ca_name like '%{$s2}%' or ca_name2 like '%{$s2}%')";
	$qstr.="&s2=$s2";
}

$where1 = " AND length(ca_id)=2 ";
$where2 = " AND length(ca_id)=4 ";
$where3 = " AND length(ca_id)=6 ";

if(!$page) $page = 1;
// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt from {$g5['category']} where 1 $where";
$row = sql_fetch($sql);
$total_count = $row['cnt'];
$rows = 50;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함
// $result = sql_query("select * from {$g5['category']} where 1 $where order by ca_id asc limit $from_record, $rows"); 
$result = sql_query("select * from {$g5['category']} where 1 $where ".$where1." order by turn ASC, ca_id asc limit $from_record, $rows"); 
?>
<div class="btn_area">
	<div class="btn_area_right">
	    <form>
		<input type="hidden" name="bo_table" value="<?php echo $bo_table; ?>">
		<select id="s1" name="s1" class="frm_input">
			<option value="">Depth</option>
			<option value="2">1Depth</option>
			<option value="4">2Depth</option>
			<!--
			<option value="6">3단계</option>
			-->
		</select>
		<input type="text" name="s2" value="<?php echo $s2; ?>" id="stx"  class="frm_input">
		<input type="submit" value="검색" class="btn_small2">
		</form>
	</div>
</div>
<script>
$("#s1 option[value='<?=$s1?>']").prop("selected", "true");
</script>
<form name="fcategorylist" method="post" action="./category_listupdate.php" autocomplete="off">
<input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
<input type="hidden" name="stx" value="<?php echo $stx; ?>">
<input type="hidden" name="page" value="<?php echo $page; ?>">
<input type="hidden" name="bo_table" value="<?php echo $bo_table; ?>">
    <table class="vertical">
			<colgroup span="4">
			<col width="10%" />
			<col width="*" />
			<col width="20" />
			<col width="20%" />
		</colgroup>

    <thead>
    <tr>
		<th scope="col" id="sct_cate">DEPTH</th>
		<th scope="col">분류명</th>
		<th scope="col">순서</th>
        <th scope="col" > <?php if($member['mb_id'] == 'inpiad'){ ?><span onclick="layer('분류 추가','./category_form.php?bo_table=<?=$bo_table?>')"class="btn_small2">1단분류 추가</span><?php } ?> 관리</th>
    </tr>
    </thead>
    <tbody>
	
    <?php

	$temp_i = 0;

    for ($i=0; $row=sql_fetch_array($result); $i++)
    {
        $level = strlen($row['ca_id']) / 2 - 1;
        $p_ca_name = '';

        if ($level > 0) {
            $class = 'class="name_lbl"'; 
            // 상위단계의 분류명
            $p_ca_id = substr($row['ca_id'], 0, $level*2);
            $sql = " select ca_name,ca_name2 from {$g5['category']} where bo_table='{$bo_table}' and ca_id = '$p_ca_id' "; 
            $temp = sql_fetch($sql);
            $p_ca_name = $temp['ca_name'].'의하위';
        } else {
            $class = '';
        }

			//$s_add = '<a href="./category_form.php?ca_id='.$row['ca_id'].'" class="btn_small2">하위분류추가</a> '; 
		    //$s_upd = '<a href="./category_form.php?w=u&amp;ca_id='.$row['ca_id'].'&page='.$page.'" class="btn_small2">수정</a> ';
            //if($level>0) $s_del = '<a href="./category_formupdate.php?bo_table='.$bo_table.'&w=d&amp;ca_id='.$row['ca_id'].'&page='.$page.'" onclick="return delete_confirm(this);" class="btn_small2">삭제</a> ';

			if($member['mb_id'] == 'inpiad'){ $s_del = '<a href="./category_formupdate.php?bo_table='.$bo_table.'&w=d&amp;ca_id='.$row['ca_id'].'&page='.$page.'" onclick="return delete_confirm(this);" class="btn_small2">삭제</a> '; }
    ?>
    <tr style="background-color:<?=$lavel_bg[$level]?>">
          <input type="hidden" name="ca_id[<?php echo $temp_i; ?>]" value="<?php echo $row['ca_id']; ?>">

	<td class="td_mng center" rowspan="">
		<?=$level+1?> Depth
		</td>
        <td headers="sct_cate" class="sct_name sct_name<?php echo $level; ?>">
			<?
			if($level) for($c=0; $c<$level; $c++) echo "　　　"; if($level>0) echo " ┖  ";  
			?>
			<input type="text" name="ca_name[<?php echo $temp_i; ?>]" placeholder="분류 이름" value="<?php echo get_text($row['ca_name']); ?>" id="ca_name_<?php echo $i; ?>"  required class="w20">
			<?/*
			<input type="text" name="ca_name2[<?php echo $i; ?>]" placeholder="중문" value="<?php echo get_text($row['ca_name2']); ?>" id="ca_name2_<?php echo $i; ?>"  required class="w20">
			<input type="text" name="ca_name3[<?php echo $i; ?>]" placeholder="스페인" value="<?php echo get_text($row['ca_name3']); ?>" id="ca_name3_<?php echo $i; ?>"  required class="w20">
			*/?>
        </td>

		<td>
			<input type="number" name="turn[<?php echo $temp_i; ?>]" placeholder="분류 순서" value="<?php echo get_text($row['turn']); ?>" id="turn_<?php echo $temp_i; ?>" required style="width: 50px;">
		</td>
	
        <td class="td_mng center" rowspan="">
			<?if($level<1){ // if($level<2){?>
			<span class="btn_small2" onclick="layer('분류 추가','./category_form.php?bo_table=<?=$bo_table?>&ca_id=<?=$row[ca_id]?>')">하위분류추가</span>
			<?}?>
			<span class="btn_small2" onclick="layer('분류 수정','./category_form.php?bo_table=<?=$bo_table?>&w=u&ca_id=<?=$row[ca_id]?>')">수정</span>
            <?php echo $s_del; ?>
        </td>
    </tr>

	<?	
		// =========== 2단계 ===========
		$DEP_2_RESULT = sql_query("SELECT * FROM {$g5['category']} WHERE 1 $where ".$where2." AND ca_id LIKE '".$row['ca_id']."%' ORDER BY turn ASC, ca_id ASC");
		for ($j = 0; $DEP_2_INFO = sql_fetch_array($DEP_2_RESULT); $j++){

			$temp_i++;
			
			$DEP_2_cat_img = "";
			$DEP_2_get_img = get_file('category', $DEP_2_INFO['idx']); 
			for($cnt = 0; $cnt < $DEP_2_get_img['count']; $cnt++){
				$DEP_2_img_title = $cnt?'영문':'국문';
				$DEP_2_cat_img .= " [ ".$DEP_2_img_title.":".
								"<a href='".$DEP_2_get_img[$cnt]['href']."' class='view_file_download'>
								<strong>".$DEP_2_get_img[$cnt]['source']."</strong>".$DEP_2_get_img[$cnt]['content']."(".$DEP_2_get_img[$cnt]['size'].")
								</a> ]";
			}
			
			$DEP_2_level = strlen($DEP_2_INFO['ca_id']) / 2 - 1;
			?>
		<tr name="lavel_<?php echo $DEP_2_INFO['ca_id']; ?>" ca_id="<?php echo $DEP_2_INFO['ca_id']; ?>" style="background-color:<?=$lavel_bg[$DEP_2_level]?>">
			<input type="hidden" name="ca_id[<?php echo $temp_i; ?>]" value="<?php echo $DEP_2_INFO['ca_id']; ?>">
			<td class="td_mng center" rowspan="">
				<?=$DEP_2_level+1?> 단계 
				<br>
				<!--
				<input type="button" name="btn_hide" id="btn_hide_<?=$DEP_2_INFO['ca_id']?>" value="하위 접기" onClick="cate_view('hide', '<?=$DEP_2_INFO['ca_id']?>')" style="padding:2px;">
				<input type="button" name="btn_show" id="btn_show_<?=$DEP_2_INFO['ca_id']?>" value="하위 펴기" onClick="cate_view('show', '<?=$DEP_2_INFO['ca_id']?>')" style="padding:2px;display:none;">
				-->
			</td>
			<td headers="sct_cate" class="sct_name sct_name<?php echo $DEP_2_level; ?>">
				<?
				if($DEP_2_level) for($c=0; $c<$DEP_2_level; $c++) echo "　　　"; if($DEP_2_level>0) echo " ┖  ";  
				?>
				<input type="text" name="ca_name[<?php echo $temp_i; ?>]" placeholder="" value="<?php echo get_text($DEP_2_INFO['ca_name']); ?>" id="ca_name_<?php echo $temp_i; ?>"  required class="w20">
				<?=$DEP_2_cat_img?>
			</td>

			<td>
				<input type="number" name="turn[<?php echo $temp_i; ?>]" placeholder="분류 순서" value="<?php echo get_text($DEP_2_INFO['turn']); ?>" id="turn_<?php echo $temp_i; ?>" required style="width: 50px;">
			</td>
		
			<td class="td_mng center" rowspan="">
				<?php if($bo_table == 's3'){ ?>
				<span class="btn_small2" onclick="layer('분류 추가','./category_form.php?bo_table=<?=$bo_table?>&ca_id=<?=$DEP_2_INFO[ca_id]?>')">하위분류추가</span>
				<?php } ?>
				<span class="btn_small2" onclick="layer('분류 수정','./category_form.php?bo_table=<?=$bo_table?>&w=u&ca_id=<?=$DEP_2_INFO[ca_id]?>')">수정</span>
				<?php 
					echo '<a href="./category_formupdate.php?bo_table='.$bo_table.'&w=d&amp;ca_id='.$DEP_2_INFO['ca_id'].'&page='.$page.'" onclick="return delete_confirm(this);" class="btn_small2">삭제</a> ';
				?>
			</td>
		</tr>
		<?
			// =========== 3단계 ===========
				$DEP_3_RESULT = sql_query("SELECT * FROM {$g5['category']} WHERE 1 $where ".$where3." AND ca_id LIKE '".$DEP_2_INFO['ca_id']."%' ORDER BY turn ASC, ca_id ASC");
				for ($k = 0; $DEP_3_INFO = sql_fetch_array($DEP_3_RESULT); $k++){

					$temp_i++;

					$DEP_3_cat_img = "";
					$DEP_3_get_img = get_file('category', $DEP_3_INFO['idx']); 
					for($cnt = 0; $cnt < $DEP_3_get_img['count']; $cnt++){
						$DEP_3_img_title = $cnt?'영문':'국문';
						$DEP_3_cat_img .= " [ ".$DEP_3_img_title.":".
										"<a href='".$DEP_3_get_img[$cnt]['href']."' class='view_file_download'>
										<strong>".$DEP_3_get_img[$cnt]['source']."</strong>".$DEP_3_get_img[$cnt]['content']."(".$DEP_3_get_img[$cnt]['size'].")
										</a> ]";
					}
					
					$DEP_3_level = strlen($DEP_3_INFO['ca_id']) / 2 - 1;
					?>
				<tr name="lavel_<?php echo $DEP_3_INFO['ca_id']; ?>" ca_id="<?php echo $DEP_3_INFO['ca_id']; ?>" style="background-color:<?=$lavel_bg[$DEP_3_level]?>">
					<input type="hidden" name="ca_id[<?php echo $temp_i; ?>]" value="<?php echo $DEP_3_INFO['ca_id']; ?>">
					<td class="td_mng center" rowspan="">
						<?=$DEP_3_level+1?> 단계 
					</td>
					<td headers="sct_cate" class="sct_name sct_name<?php echo $DEP_3_level; ?>">
						<?
						if($DEP_3_level) for($c=0; $c<$DEP_3_level; $c++) echo "　　　"; if($DEP_3_level>0) echo " ┖  ";  
						?>
						<input type="text" name="ca_name[<?php echo $temp_i; ?>]" placeholder="" value="<?php echo get_text($DEP_3_INFO['ca_name']); ?>" id="ca_name_<?php echo $temp_i; ?>"  required class="w20">
						<?=$DEP_3_cat_img?>
					</td>

					<td>
						<input type="number" name="turn[<?php echo $temp_i; ?>]" placeholder="분류 순서" value="<?php echo get_text($DEP_3_INFO['turn']); ?>" id="turn_<?php echo $temp_i; ?>" required style="width: 50px;">
					</td>
				
					<td class="td_mng center" rowspan="">
						<span class="btn_small2" onclick="layer('분류 수정','./category_form.php?bo_table=<?=$bo_table?>&w=u&ca_id=<?=$DEP_3_INFO[ca_id]?>')">수정</span>

						<?php 
							echo '<a href="./category_formupdate.php?bo_table='.$bo_table.'&w=d&amp;ca_id='.$DEP_3_INFO['ca_id'].'&page='.$page.'" onclick="return delete_confirm(this);" class="btn_small2">삭제</a> ';
						?>
					</td>
				</tr>
			<? }// =========== 3단계 ===========?>
		<?}// =========== 2단계 ===========?>

    <?php $temp_i++; }
    if ($i == 0) echo "<tr><td colspan=\"4\" class=\"empty_table\">데이터가 없습니다.</td></tr>\n";
    ?>
    </tbody>
    </table>

<div class="btn_area">
	<div class="btn_area_left"></div>
	<div class="btn_area_center"></div>
	<div class="btn_area_right">
	    <input type="submit" class="btn_normal" value="일괄수정">
	</div>
</div>

</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?$qstr&amp;page="); ?>

<script>
$(function() {
    $("select.skin_dir").on("change", function() {
        var type = "";
        var dir = $(this).val();
        if(!dir)
            return false;

        var id = $(this).attr("id");
        var $sel = $(this).siblings("select");
        var sval = $sel.find("option:selected").val();

        if(id.search("mobile") > -1)
            type = "mobile";

        $sel.load(
            "./ajax.skinfile.php",
            { dir : dir, type : type, sval: sval }
        );
    });
});


function iframe_resize(v){
	v.height = v.contentWindow.document.body.scrollHeight;
	if(v.height==150) v.height=700;
	v.width = v.contentWindow.document.body.scrollWidth;

	$("#layer_frame").css('height', v.height);
	$("#layer_frame").parent().css('height', v.height);
}
function layer(names,src){
	document.getElementById("layer").innerHTML="<iframe src="+src+"  id='layer_frame' onLoad='iframe_resize(this)'  frameborder=0 scrolling=yes></iframe>";
	$(".layer_popup").dialog({
		resizable : true,
		width : 800,
		height : 200,
		dialogClass : false,
		modal : false,
		title : names,
		position : {
			//my : "left top",
			//at : "left top",
			my : "center center",
			at : "center center",
			of : window
		},
		open: function(event,ui){
		},
		close: function(event,ui){
			document.getElementById("layer").innerHTML="";
			location.reload();
		 }
	});
}
</script>

<?php
include_once G5_MANAGE_INCLUDE_PATH . "/admin_footer.php";
?>
