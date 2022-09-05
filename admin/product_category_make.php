<?php
	include_once "./_common.php";
	/**
	 *	해당페이지 타이틀 및 기본 노출 설정
	 */
	$g5['title'] = "상품소개 > 인피아드 관리자모드";	//title
	$category_title = "상품소개";	//카테고리 제목
	$sub_title = "카테고리관리";	//서브 타이틀
	$sub_explan = ""; //페이지 설명

	include_once G5_MANAGE_INCLUDE_PATH . "/admin_header.php";

	if(!$boa_table){
		alert("게시판을 지정해주십시오");
	}

	$sql_common = " from $g5[board_category_table] where bo_table = '$boa_table' ";

	if ($w == "")
	{
		$len = strlen($ca_id);
		if ($len == 10)
			alert("분류를 더 이상 추가할 수 없습니다.\\n\\n5단계 분류까지만 가능합니다.");

		$len2 = $len + 1;

		$sql = " select MAX(SUBSTRING(ca_id,$len2,2)) as max_subid from $g5[board_category_table]
				  where SUBSTRING(ca_id,1,$len) = '$ca_id' and bo_table = '$boa_table' ";
		$row = sql_fetch($sql);

		$subid = base_convert($row[max_subid], 36, 10);
		if (!$ca_id) $subid += 36;
		else $subid += 1;
		if ($subid >= 36 * 36)
		{
			//alert("분류를 더 이상 추가할 수 없습니다.");
			// 빈상태로
			$subid = "  ";
		}
		$subid = base_convert($subid, 10, 36);
		$subid = substr("00" . $subid, -2);
		$subid = $ca_id . $subid;

		$sublen = strlen($subid);

		if ($ca_id) // 2단계이상 분류
		{
			$sql = " select * from $g5[board_category_table] where ca_id = '$ca_id' and bo_table = '$boa_table' ";
			$ca = sql_fetch($sql);			
			$ca[ca_name] = "";
		}
		else // 1단계 분류
		{
			$html_title = "1단계분류추가";
			
		}

	}
	else if ($w == "u")
	{
		$sql = " select * from $g5[board_category_table] where ca_id = '$ca_id' and bo_table = '$boa_table' ";
		$ca = sql_fetch($sql);
		if (!$ca[ca_id])
			alert("자료가 없습니다.");

		$html_title = $ca[ca_name] . " 수정";
		$ca[ca_name] = get_text($ca[ca_name]);
	}

	$qstr = "page=$page&boa_table=$boa_table";
?>

<form name=fcategoryform method=post action="" enctype="multipart/form-data" onsubmit='return fcategoryformcheck(this);' style="margin:0px;">
	<input type="hidden" name="token" />
	<input type=hidden name=w        value="<?=$w?>">
	<input type=hidden name=page     value="<?=$page?>">
	<input type="hidden" name="boa_table" value="<?php echo $boa_table?>" />
	<? if ($w == "") { ?>
		<input type=hidden class=ed id=ca_id name=ca_id itemname='분류코드' size='<?=$sublen?>' maxlength='<?=$sublen?>' minlength='<?=$sublen?>' nospace alphanumeric value='<?=$subid?>'>
	<? } else { ?>
		<input type=hidden name=ca_id value='<?=$ca[ca_id]?>'>
	<? } ?>

	<table class="vertical">
		<colgroup span="4">
			<col width="15%">
			<col width="35%">
			<col width="15%">
			<col width="35%">
		</colgroup>
		<? if(strlen($ca_id)==2){ ?>
		<?
				if($subid){
					$ccc = $subid;
				}else{
					$ccc = $ca[ca_id];
				}

				$cc = sql_fetch("select * from $g5[board_category_table] where ca_id = '".substr($ca[ca_id],0,2)."'" . " and bo_table = '$boa_table' ") ;
				
		?>
		<tr>
			<th>분류</th>
			<td class="left">
				<?=$cc[ca_name]?>
			</td>
		</tr>
		<? } ?>
		<tr>
			<th scope="row">카테고리명</th>
			<td colspan="3" class="">
				<input type="text" id="ca_name" name="ca_name" value="<?php echo $ca['ca_name']?>" placeholder="메뉴명을 입력하세요." class="w100">
			</td>
		</tr>
		<tr>
			<th scope="row">노출순서</th>
			<td colspan="3" class="">
				<input type="text" id="ca_order" name="ca_order" value="<?php echo $ca['ca_order']?>" />
			</td>
		</tr>
	</table>
	<div class="btn_area">
		<div class="btn_area_right">
			<button id="" name="" class="btn_normal">작성완료</button>
			<a href="./product_category.php?<?php echo $qstr ?>" class="btn_normal">목록</a>
		</div>
	</div>
</form>

<script>
function fcategoryformcheck(f)
{

	if (f.ca_name.value=="")
	{
		alert("분류명을 입력해주세요.");
		f.ca_name.focus();
		return false;
	}

	$("input[name='token']").val(get_ajax_token());

	f.action = "./product_category_make_update.php";

    return true;
}

document.fcategoryform.ca_name.focus();
</script>

<?php
include_once G5_MANAGE_INCLUDE_PATH . "/admin_footer.php";
?>