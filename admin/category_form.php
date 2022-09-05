<?php
	include_once "./_common.php";
	$category_title = $group['gr_subject'];	//카테고리 제목
	$sub_title = "카테고리 관리";	//서브 타이틀
	 //if($_SERVER["REMOTE_ADDR"]!="211.170.81.198") alert("접근 불가");
	 include_once(G5_EDITOR_LIB);
	 $editor_js= get_editor_js('content');
	  $editor_js.= get_editor_js('content2');
	// $editor_js .= chk_editor_js('eng');

	$file = array();
	$is_file = true;

if ($w == "")
{

	//if(!$ca_id) alert("1단분류는 추가할 수 없습니다.\\n\\n시스템 관리자에게 문의해주세요.");
    if ($is_admin != 'super' && !$ca_id)
        alert2("최고관리자만 1단계 분류를 추가할 수 있습니다.");

    $len = strlen($ca_id);
    if ($len == 8)
        alert2("분류를 더 이상 추가할 수 없습니다.\\n\\n4단계 분류까지만 가능합니다.");

    $len2 = $len + 1;

    $sql = " select MAX(SUBSTRING(ca_id,$len2,2)) as max_subid from {$g5['category']}
              where SUBSTRING(ca_id,1,$len) = '$ca_id' AND bo_table = '".$bo_table."'";
    $row = sql_fetch($sql);

    $subid = base_convert($row['max_subid'], 36, 10);
    $subid += 36;
    if ($subid >= 36 * 36)
    {
        //alert("분류를 더 이상 추가할 수 없습니다.");
        $subid = "  ";
    }
    $subid = base_convert($subid, 10, 36);
    $subid = substr("00" . $subid, -2);
    $subid = $ca_id . $subid;

    $sublen = strlen($subid);

    if ($ca_id) // 2단계이상 분류
    {

        $sql = " select * from {$g5['category']} where ca_id = '$ca_id' and bo_table='{$bo_table}' "; 
        $ca = sql_fetch($sql);
		$location_name="";
		for($i=2; $i<=strlen($ca[ca_id]); $i=$i+2){
		$ca_location_val=substr($ca[ca_id],0,$i);
		$ca_location=sql_fetch("select ca_name from {$g5['category']} where ca_id='$ca_location_val' and bo_table='{$bo_table}'");
		
		$location_name.=$i>2?"<br>":"";
		for($j=2; $j<$i; $j=$j+2) $location_name.="　";
			$location_name.=$i>2?"┖ ".$ca_location[ca_name]:$ca_location[ca_name];

	}
	$location_name.=" [하위분류추가]";

        $ca['ca_name'] = "";
		$ca['content'] = "";
		$ca['ca_name2'] = "";
		$ca['content2'] = "";
		$ca['ca_name3'] = "";
		$ca['content3'] = "";
    }
    else // 1단계 분류
    {
        $location_name = "1단계 분류추가";
    }
}
if ($w == "u")
{
    $sql = " select * from {$g5['category']} where ca_id = '$ca_id' and bo_table='{$bo_table}'";


    $ca = sql_fetch($sql);
    if (!$ca['ca_id'])
        alert2("자료가 없습니다.");
		$location_name="";
		$ca['ca_name'] = get_text($ca['ca_name']);
	for($i=2; $i<=strlen($ca[ca_id]); $i=$i+2){
		$ca_location_val=substr($ca[ca_id],0,$i);
		$ca_location=sql_fetch("select ca_name from {$g5['category']} where ca_id='$ca_location_val' and bo_table='{$bo_table}'");
		
		$location_name.=$i>2?"<br>":"";
		for($j=2; $j<$i; $j=$j+2) $location_name.="　";
			$location_name.=$i>2?"┖ ".$ca_location[ca_name]:$ca_location[ca_name];
	}
	$location_name.=" [분류수정]";
    
	// $file = get_file($bo_table, $ca['idx']);
	$file = get_file("category", $ca['idx']);
	
}

//include_once G5_MANAGE_INCLUDE_PATH . "/admin_header.php";
include_once G5_MANAGE_INCLUDE_PATH . "/admin.head.sub.php";

function alert2($msg){?>
<script>
var msg="<?=$msg?>";
alert(msg);
parent.$('.layer_popup').dialog('close');
</script>
<?exit;}?>
<h4 class="h4_label"><?=$location_name?></h4>
<form name="fcategoryform" action="./category_formupdate.php" onsubmit="return fcategoryformcheck(this);" method="post" enctype="multipart/form-data">
<input type="hidden" name="w" value="<?php echo $w; ?>">
<input type="hidden" name="idx" value="<?php echo $ca[idx]; ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
<input type="hidden" name="stx" value="<?php echo $stx; ?>">
<input type="hidden" name="page" value="<?php echo $page; ?>">
<input type="hidden" name="bo_table" value="<?php echo $bo_table; ?>">
<section id="anc_scatefrm_basic">
    <table class="vertical">
        <caption>분류 추가 필수입력</caption>
        <colgroup>
            <col class="grid_4">
            <col>
        </colgroup>
        <tbody>
            <?php if ($w == "") { ?>
                <input type="hidden" name="ca_id" value="<?php echo $subid; ?>" id="ca_id" required class="required frm_input" size="<?php echo $sublen; ?>" maxlength="<?php echo $sublen; ?>">
            <?php } else { ?>
                <input type="hidden" name="ca_id" value="<?php echo $ca['ca_id']; ?>">
            <?php } ?>
        <tr>
            <th scope="row"><label for="ca_name">분류명</label></th>
            <td>
				<input type="text" name="ca_name" placeholder="분류이름" value="<?php echo $ca['ca_name']; ?>" id="ca_name"  required class="w40 required frm_input"><br>
				<?/*
				<input type="text" name="ca_name2" placeholder="중문" value="<?php echo $ca['ca_name2']; ?>" id="ca_name2"   class="w40 required frm_input"><br>
				<input type="text" name="ca_name3" placeholder="스페인" value="<?php echo $ca['ca_name3']; ?>" id="ca_name3"   class="w40 required frm_input">
				*/?>
			</td>
        </tr>
		<!-- <tr>
            <th scope="row"><label for="content">내용</label></th>
            <td><textarea id="content" name="content" class="" maxlength="65536" style="width:100%;min-height:100px"><?php echo $ca['content']; ?></textarea></td>
        </tr> -->

		<!-- 순서 -->
		<tr>
            <th scope="row"><label for="turn">순서</label></th>
            <td>
			<input type="number" name="turn" placeholder="0" value="<?php echo ($ca['turn'])?$ca['turn']:0; ?>" id="turn"  required class="w40 frm_input">
			(* 0 에 가까울수록 먼저 노출)
			</td>
        </tr>

		<?php if($bo_table == 's1_4'){ ?>
		<?php for ($i=0; $is_file && $i<1; $i++) { ?>
		<tr>
            <th scope="row"><label for="bf_file">파일</label></th>
            <td>
				<input type="file" name="bf_file[]" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file frm_input">
				<?php if ($is_file_content) { ?>
					<input type="text" name="bf_content[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content'] : ''; ?>" title="파일 설명을 입력해주세요." class="frm_file frm_input" size="50">
				<?php } ?>
				<?php if($file[$i]['file']) { ?>
					<input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일 삭제</label>
				<?php } ?>
			</td>
        </tr>
		<?php } ?>

		<?php } ?>
        </tbody>
       </table>
</section>
<script>
	function readURL(input) {
		if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.onload = function (e) {
				$('.photo').attr('src', e.target.result);
			}
		  reader.readAsDataURL(input.files[0]);
		}
	}
	$("#photo_file").change(function(ev){
		var value = $(this).val();
		var extention = /\.(<?=$config[cf_image_extension]?>)$/;
		if(!value.match(extention))
		{
			alert("이미지만 업로드 하실수 있습니다");
			$(this).val("");
			ev.preventDefalut();
			return false;
		}else{
			readURL(this);
		}
	});
	</script>
	<div class="btn_area">
		<div class="btn_area_right">
			<input type="submit" value="확인" class="btn_normal" accesskey="s">
			<a href="#n" onclick="parent.$('.layer_popup').dialog('close');" class="btn_normal" >닫기</a>
		</div>
	</div>
</form>

<script>
function fcategoryformcheck(f)
{
    if (f.w.value == "") {
        var error = "";
        $.ajax({
            url: "./ajax.ca_id.php",
            type: "POST",
            data: {
                "ca_id": f.ca_id.value
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function(data, textStatus) {
                error = data.error;
            }
        });
        if (error) {
            alert(error);
            return false;
        }
    }
	    <?php echo $editor_js;  ?>
    return true;
}

</script>

<?php
//include_once G5_MANAGE_INCLUDE_PATH . "/admin_footer.php";
?>