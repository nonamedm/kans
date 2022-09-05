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

	$where = " where ";
	$sql_search = "";
	if ($stx != "") {
		if ($sfl != "") {
			$sql_search .= " $where $sfl like '%$stx%' ";
			$where = " and ";
		}
		if ($save_stx != $stx)
			$page = 1;
	}

	$sql_common = " from $g5[board_category_table] ";
	if ($is_admin != 'super')
		$sql_common .= " $where ca_mb_id = '$member[mb_id]' ";
	$sql_common .= $sql_search;


	// 테이블의 전체 레코드수만 얻음
	$sql = " select count(*) as cnt " . $sql_common;
	$row = sql_fetch($sql);
	$total_count = $row[cnt];

	$rows = $config[cf_page_rows];
	$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
	if ($page == "") { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
	$from_record = ($page - 1) * $rows; // 시작 열을 구함

	if (!$sst)
	{
		$sst  = "ca_id";
		$sod = "asc";
	}
	$sql_order = "order by $sst $sod";

	// 출력할 레코드를 얻음
	$sql  = " select *
			   $sql_common
			   $sql_order
			   limit $from_record, $rows ";
	$result = sql_query($sql);

	//$qstr = "page=$page&sort1=$sort1&sort2=$sort2";	
	$qstr = "page=$page";

	if(!$boa_table){
		alert("게시판을 지정해주십시오");
	}
?>
<form name="fcategorylist" method='post' action='./product_category_make_update.php' autocomplete='off'>
	<input type="hidden" name="page"  value='<? echo $page ?>' />
	<input type="hidden" name="sort1" value='<? echo $sort1 ?>' />
	<input type="hidden" name="sort2" value='<? echo $sort2 ?>' />
	<input type="hidden" name="boa_table" value="<?=$boa_table?>" />
	<input type="hidden" name="w" value="lu" />
	<input type="hidden" name="token" value="" />

	<table class="horizen">
		<colgroup span="4">
			<col width="5%">
			<col width="*">
			<col width="10%">
			<col width="20%">
		</colgroup>
		<thead>
			<tr>
				<th scope="col">번호</th>
				<th scope="col">카테고리명</th>
				<th scope="col">노출순서</th>
				<th scope="col">관리</th>
			</tr>
		</thead>
		<tbody>
			<?
				for ($i=0; $row=sql_fetch_array($result); $i++){
					$num = $total_count - ($page - 1) * $rows - $i;
					$s_add = "";
					$s_level = "";
					$s_del = "";
					$s_mod = "";
					$level = strlen($row[ca_id]) / 2 - 1;
					if ($level > 0){// 2단계 이상
						$s_level = "&nbsp;&nbsp;<img src='./img/icon_catlevel.gif' border=0 width=17 height=15 align=absmiddle alt='".($level+1)."단계 분류'>";
						for ($k=1; $k<$level; $k++)
							$s_level = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $s_level;
						$style = " ";
					}else{// 1단계
						//$style = " style='border:1 solid; border-color:#0071BD;' ";
						//$s_add = "<input type=\"button\" class=\"btn_small2\" value=\"생성\" onclick=\"location.href='./products1_step1.php?ca_id=$row[ca_id]&boa_table={$boa_table}&$qstr';\" />";
					}
					//icon("추가", "./category1_write.php?ca_id=$row[ca_id]&$qstr");
					//$s_upd = icon("수정", "./category1_write.php?w=u&ca_id=$row[ca_id]&$qstr");
					//$s_vie = icon("보기", "$g4[shop_path]/list.php?ca_id=$row[ca_id]");

					$s_mod = "<input type=\"button\" class=\"btn_small2\" value=\"수정\" onclick=\"mod('./product_category_make.php?w=u&boa_table={$boa_table}&ca_id=$row[ca_id]&$qstr');\" />";
					$s_del = "<input type=\"button\" class=\"btn_small2\" value=\"삭제\" onclick=\"del_form('{$row[ca_id]}');\" />";

					//$s_del = icon("삭제", "javascript:del('./categoryformupdate.php?w=d&ca_id=$row[ca_id]&$qstr');");
					$list = $i%2;
					echo "
						<input type=hidden name='ca_id[$i]' value='$row[ca_id]'>
						<tr>
						<td class='center'>$num</td>
						<td class=left>$s_level <input type=text name='ca_name[$i]' value='".get_text($row[ca_name])."' title='$row[ca_id]' class='w100'></td>
					";
					$row1 = sql_fetch(" select count(*) as cnt from g4_write_{$boa_table} where wr_1 = '$row[ca_id]' ");
					$c1 = get_cate_info(1, $boa_table, $row[ca_id]);
					$c2 = get_cate_info(2, $boa_table, $row[ca_id]);
					echo "
						<td class='center'>
								<input type=text name='ca_order[$i]' value='".get_text($row[ca_order])."' title='$row[ca_id]' class='num' size=10 $style>
						</td>
						<td class='center'>$s_add $s_mod $s_del</td>
						</tr>
					";
				}
				if ($i == 0) {
					echo "<tr><td colspan=4 height=100 bgcolor='#ffffff' align=center><span class=point>자료가 한건도 없습니다.</span></td></tr>\n";
				}
			?>
				<!--<tr>
					<td class="">10</td>
					<td class="">
						<input type="text" id="" name="" placeholder="메뉴명을 입력하세요." class="w100">
					</td>
					<td class="">
						<input type="text" id="" name="">
					</td>
					<td class="">
						<button id="" name="" class="btn_small2">수정</button>
						<button id="" name="" class="btn_small2">삭제</button>
					</td>
				</tr>-->

		</tbody>
	</table>
	<div class="btn_area">
		<div class="btn_area_left">
			<button type="button" id="" name="" onclick="update_all();" class="btn_normal">일괄수정</button>
		</div>
		<div class="btn_area_right">
			<button id="" name="" type="button" class="btn_normal" onclick="self.location='./product_category_make.php?boa_table=<?php echo $boa_table;?>'">신규생성</button>
		</div>
	</div>
</form>

<form name="fhiddenform" method="post" action="./product_category_make_update.php">
	<input type="hidden" name="page"  value='<? echo $page ?>' />
	<input type="hidden" name="sort1" value='<? echo $sort1 ?>' />
	<input type="hidden" name="sort2" value='<? echo $sort2 ?>' />
	<input type="hidden" name="boa_table" value="<?php echo $boa_table?>" />
	<input type="hidden" name="del_ca_id" value="" />
	<input type="hidden" name="w" value="d" />
	<input type="hidden" name="token" value="" />
</form>

<script type="text/javascript">
<!--

	//삭제기능
	function del_form(ca_id)
	{
		$("form[name='fhiddenform']").find("input[name='del_ca_id']").val(ca_id);
		$("form[name='fhiddenform']").find("input[name='token']").val(get_ajax_token());
		$("form[name='fhiddenform']").submit();
	}

	//일괄수정
	function update_all(){
		$("form[name='fcategorylist']").find("input[name='token']").val(get_ajax_token());
		$("form[name='fcategorylist']").submit();
	}

	//수정
	function mod(url){
		location.href = url;
	}
//-->
</script>

<?php
include_once G5_MANAGE_INCLUDE_PATH . "/admin_footer.php";
?>