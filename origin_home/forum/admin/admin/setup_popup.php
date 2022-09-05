<?php
	include_once "./_common.php";
	/**
	 *	해당페이지 타이틀 및 기본 노출 설정
	 */
	$g5['title'] = "팝업관리 > 인피아드 관리자모드";	//title
	$category_title = "팝업관리";	//카테고리 제목
	$sub_title = "팝업 관리";	//서브 타이틀
	$sub_explan = "홈페이지에 사용되는 메뉴명 및 노출여부를 설정할 수 있습니다."; //페이지 설명

	include_once G5_MANAGE_INCLUDE_PATH . "/admin_header.php";

	if( !isset($g5['new_win_table']) ){
		die('<meta charset="utf-8">/data/dbconfig.php 파일에 <strong>$g5[\'new_win_table\'] = G5_TABLE_PREFIX.\'new_win\';</strong> 를 추가해 주세요.');
	}
	//내용(컨텐츠)정보 테이블이 있는지 검사한다.
	if(!sql_query(" DESCRIBE {$g5['new_win_table']} ", false)) {
		if(sql_query(" DESCRIBE {$g5['g5_shop_new_win_table']} ", false)) {
			sql_query(" ALTER TABLE {$g5['g5_shop_new_win_table']} RENAME TO `{$g5['new_win_table']}` ;", false);
		} else {
		   $query_cp = sql_query(" CREATE TABLE IF NOT EXISTS `{$g5['new_win_table']}` (
						  `nw_id` int(11) NOT NULL AUTO_INCREMENT,
						  `nw_device` varchar(10) NOT NULL DEFAULT 'both',
						  `nw_begin_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
						  `nw_end_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
						  `nw_disable_hours` int(11) NOT NULL DEFAULT '0',
						  `nw_left` int(11) NOT NULL DEFAULT '0',
						  `nw_top` int(11) NOT NULL DEFAULT '0',
						  `nw_height` int(11) NOT NULL DEFAULT '0',
						  `nw_width` int(11) NOT NULL DEFAULT '0',
						  `nw_subject` text NOT NULL,
						  `nw_content` text NOT NULL,
						  `nw_content_html` tinyint(4) NOT NULL DEFAULT '0',
						  PRIMARY KEY (`nw_id`)
						) ENGINE=MyISAM DEFAULT CHARSET=utf8 ", true);
		}
	}

	//관리자 링크 추가
	if(!sql_query(" select nw_date_time from {$g5['new_win_table']} limit 1 ", false)) {

		$sql = " ALTER TABLE `{$g5['new_win_table']}`  ADD `nw_date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' AFTER `nw_end_time` ";
		sql_query($sql, false);
	}

	$sql_common = " from {$g5['new_win_table']} ";

	// 테이블의 전체 레코드수만 얻음
	$sql = " select count(*) as cnt " . $sql_common;
	$row = sql_fetch($sql);
	$total_count = $row['cnt'];

	$sql = "select * $sql_common order by nw_id desc ";
	$result = sql_query($sql);

?>


<!--<div class="status_area">
	<div class="status_area_left">

	</div>
	<div class="status_area_right">
		<select id="" name="" title="">
			<option value="">메뉴명</option>
			<option value="">가격</option>
			<option value="">내용</option>
		</select>
		<input type="text" id="" name="">
		<button id="" name="" class="btn_small2">검색</button>
	</div>
</div>-->

<form name="flist" method="post" onsubmit="return flist_submit();">
	<input type="hidden" name="token" />
	<table class="horizen">
		<colgroup span="9">
			<col width="5%">
			<col width="*">
			<col width="10%">
			<col width="10%">
			<col width="5%">
			<col width="10%">
			<col width="18%">
		</colgroup>
		<thead>

			<tr>
				<th scope="col"><input type="checkbox" id="" name="" onclick=" $('.nw_chk').prop('checked', this.checked); "></th>
				<th scope="col">제목</th>
				<th scope="col">시작일</th>
				<th scope="col">종료일</th>
				<th scope="col">시간</th>
				<th scope="col">입력일시</th>
				<th scope="col"><button id="" name="" type="button" class="btn_small2" onclick="location.href='./setup_popup_entry.php'">신규생성</button></th>
			</tr>

		</thead>
		<tbody>
			<?php
			for ($i=0; $row=sql_fetch_array($result); $i++) {
				$bg = 'bg'.($i%2);

				switch($row['nw_device']) {
					case 'pc':
						$nw_device = 'PC';
						break;
					case 'mobile':
						$nw_device = '모바일';
						break;
					default:
						$nw_device = '모두';
						break;
				}
			?>
			<tr>
				<td class=""><input type="checkbox" id="" name="nw_chk[]" class='nw_chk' value="<?php echo $row['nw_id']?>" ></td>
				<td class="left"><?php echo $row['nw_subject']; ?></td>
				<td class=""><?php echo substr($row['nw_begin_time'],2,14); ?></td>
				<td class=""><?php echo substr($row['nw_end_time'],2,14); ?></td>
				<td class=""><?php echo $row['nw_disable_hours']; ?>시간</td>
				<td class=""><?php echo substr($row['nw_date_time'],2,14); ?></td>
				<td class="">
					<button type="button" id="" name="" onclick="location.href='./setup_popup_entry.php?w=u&amp;nw_id=<?php echo $row['nw_id']; ?>'" class="btn_small2">수정</button>
					<button type="button" id="del_<?php echo $i?>" name="" onclick=" del_nw('<?php echo $row['nw_id'];?>') " class="btn_small2">삭제</button>
					<!--<button id="" name="" class="btn_small2">보기</button>-->
				</td>
			</tr>
			<?php } ?>

			<?php if($i == 0){ ?>
				<tr><td colspan="7">팝업이 존재하지 않습니다</td></tr>
			<?php } ?>
		</tbody>
	</table>

	<div class="btn_area">
		<div class="btn_area_left">
			<button type="submit" id="" name="" class="btn_normal">선택삭제</button>
		</div>
	</div>
</form>

<form name="fhidden" method="post">
	<input type="hidden" name="token" />
	<input type="hidden" name="nw_id" />
	<input type="hidden" name="w" value="d" />
</form>

<script>

//삭제스크립트
function del_nw(idx){
	if(confirm("정말 삭제하시겠습니까?\n삭제하신 자료는 복구가 불가능합니다.")){
		$form = $("form[name='fhidden']"); //삭제 폼
		$form.find("input[name='token']").val(get_ajax_token());
		$form.find("input[name='nw_id']").val(idx);
		$form.prop("action", "./setup_popup_entry_update.php").submit();
	}

	return true;
}


//팝업관리 리스트 서브밋
function flist_submit(){

	if(!confirm("정말 삭제하시겠습니까?\n삭제하신 자료는 복구가 불가능합니다.")){
		return false;
	}

	if($(".nw_chk:checked").length < 1){
		alert("삭제하실 자료를 선택해주세요");
		return false;
	}

	$form = $("form[name='flist']");

	$form.find("input[name='token']").val(get_ajax_token());

	$form.prop("action", "./setup_popup_list_update.php");

	return true;
}

</script>

<?php
include_once G5_MANAGE_INCLUDE_PATH . "/admin_footer.php";
?>