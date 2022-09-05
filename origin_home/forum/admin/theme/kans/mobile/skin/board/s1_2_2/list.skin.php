<?php
	if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

	// 선택옵션으로 인해 셀합치기가 가변적으로 변함
	$colspan = 8;

	$is_checkbox = $write_href = false;

	if ($is_checkbox) $colspan++;

	// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
	add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

	// $write_href = false;
?>

<!-- 게시판 목록 시작 -->
<div id="bo_list<?php if ($is_admin) echo "_admin"; ?>" class="respon_l cal_wrap">
	<?php if ($is_category) { ?>
		<nav id="bo_cate">
			<h2><?php echo ($board['bo_mobile_subject'] ? $board['bo_mobile_subject'] : $board['bo_subject']) ?> 카테고리</h2>
			<ul id="bo_cate_ul" class="bd_cate">
				<?php echo $category_option ?>
			</ul>
		</nav>
	<?php } ?>
	
	<!-- <form name="fsearch" method="get"> -->
	<form name="fboardlist2" id="fboardlist2" action="<?php echo $_PHPSELF; ?>" onsubmit="return fboardlist_submit2(this);" method="post">
		<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
		<input type="hidden" name="sca" value="<?php echo $sca ?>">
		<input type="hidden" name="sop" value="and">

		<input type="hidden" name="sfl" id="sfl" value="wr_subject||wr_content">
		<input type="hidden" name="stx" value="<?php echo stripslashes($stx) ?>" id="stx" />
	
	<div class="fillter_cal">
		<table>
			<tr>
				<th>보기방식</th>
				<td>
					<div class="box">
						<ul>
							<li><a href="<?=$s1_2_2_url;?>"><input type="radio" name="" ><label for="">달력 형</label></a></li>
							<li><a href="<?=$s1_2_2_2_url;?>"><input type="radio" name="" checked="checked"><label for="">리스트 형</label></a></li>
						</ul>
					</div>
				</td>
			</tr>
			<tr>
				<th>교육종류</th>
				<td>
					<div class="box">
						<ul>
							<li>
								<select name="swr_1" id="wr_1"  onchange="cateload(1, this.value);">
									<option value="" selected>전체</option>
									<?php $cateq = sql_query(" SELECT * FROM {$g5['category']} WHERE bo_table='{$bo_table}' AND LENGTH(ca_id)=2 ORDER BY turn ASC, ca_id ASC ");
									while($row = sql_fetch_array($cateq)){ ?>
									<option value="<?php echo $row['ca_id']; ?>"><?php echo $row['ca_name']; ?></option>
									<?php } ?>
								</select>
							</li>
							<li>
								<select name="swr_2" id="wr_2" >
									<option value="" selected>전체</option>
								</select>
							</li>
						</ul>
					</div>
				</td>
			</tr>
			<tr>
				<th>지역선택 <br> <input type="checkbox" name="swr_6_all" id="swr_6_all" value='1' <?php if($swr_6_all){ echo "checked"; } ?>><label for="swr_6_all">전체</label></th>
				<td>
					<div class="box">
						<input type="hidden" name="swr_6" id="swr_6" value="<?php echo $swr_6; ?>" />
						<ul>
							<?php
							$swr_6_arr = explode("|", $swr_6);
									
							for($i = 0; $i < count($location_info); $i++){ // $location_info(=지역정보)는 /extend/user.config.php 파일에서 정의 ?>
							<li><input type="checkbox" name="swr_6_[]" id="swr_6_<?php echo $i; ?>" value="<?php echo $location_info[$i]; ?>" <?php if(in_array($location_info[$i], $swr_6_arr)){ echo "checked"; }?>/><label for="swr_6_<?php echo $i; ?>"><?php echo $location_info[$i]; ?></label></li>
							<?php } ?>
						</ul>
					</div>
				</td>
			</tr>
			<tr>
				<th>교육방식</th>
				<td>
					<div class="box">
						<input type="hidden" name="swr_7" id="swr_7" value="<?php echo $swr_7; ?>" />
						<ul>
							<?php $swr_7_arr = explode("|", $swr_7); ?>
							<li><input type="checkbox" name="swr_7_[]" id="swr_7_1" value="방문" <?php if(in_array("방문", $swr_7_arr)){ echo "checked"; }?>><label for="swr_7_1">방문</label></li>
							<li><input type="checkbox" name="swr_7_[]" id="swr_7_2" value="상설" <?php if(in_array("상설", $swr_7_arr)){ echo "checked"; }?>><label for="swr_7_2">상설</label></li>
						</ul>
					</div>
				</td>
			</tr>
		</table>
		<input type="submit" value="검색">
	</div>
	</form>
	
	<div class="left_down">
		<a href="">일정 다운로드</a>
	</div>

	<form name="fboardlist" id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
		<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
		<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
		<input type="hidden" name="stx" value="<?php echo $stx ?>">
		<input type="hidden" name="spt" value="<?php echo $spt ?>">
		<input type="hidden" name="sst" value="<?php echo $sst ?>">
		<input type="hidden" name="sod" value="<?php echo $sod ?>">
		<input type="hidden" name="page" value="<?php echo $page ?>">
		<input type="hidden" name="sw" value="">

	<table class="table_nomal cal_board_list ct1">		
		<colgroup>
			<col width="80px"></col>
			<col width="*"></col>
			<col width="110px"></col>
			<col width="130px"></col>
			<col width="90px"></col>
			<col width="110px"></col>
			<col width="110px"></col>
			<col width="110px"></col>
		</colgroup>
		<thead>
			<tr>
				<th>번호</th>
				<th>교육명</th>
				<th>교육일자</th>
				<th>교육시간</th>
				<th>교육장소</th>
				<th>신청인원</th>
				<th>금액</th>
				<th>교육신청</th>
			</tr>
		</thead>	
		<tbody class="load_cal_board">
			<?php for ($i=0; $i<count($list); $i++) {?>
			<?php // $list[$i]['href'] ?>
			<tr>
				<td>
					<?php
						if ($list[$i]['is_notice']) // 공지사항
							echo '<strong>공지</strong>';
						else if ($wr_id == $list[$i]['wr_id'])
							echo "<span class=\"bo_current\">열람중</span>";
						else
							echo $list[$i]['num'];
					?>
				</td>
				<td><?php echo $list[$i]['subject']; ?></td>
				<td>
					<?php echo date("Y.m.d", strtotime($list[$i]['wr_3'])); ?>
					<?php if($list[$i]['wr_4']){ echo "<br>".date("Y.m.d", strtotime($list[$i]['wr_4'])); }?>
				</td>
				<td><?php echo $list[$i]['wr_9']; ?><?php if($list[$i]['wr_10']){ echo " ~ ".$list[$i]['wr_10']; } ?></td>
				<td><?php echo $list[$i]['wr_6']; ?></td>
				<td><?php echo number_format($list[$i]['wr_5']); ?></td>
				<td><?php echo number_format($list[$i]['wr_8']); ?>원</td>
				<td>
					<?php
						
						$a_href = G5_BBS_URL."/write.php?bo_table=".$bo_table."_1&amp;wr_1=".$list[$i]['wr_id'];

						// 단체 회원일 경우 처리
						if($member['mb_level'] == 3){
							$a_href = G5_URL."/cal/cal_write1.php?wr_1=".$list[$i]['wr_id'];
						}

						$result_info = get_status($bo_table, $list[$i]['wr_id']);
						if($result_info['status'] == '마감'){ echo "종료"; }
						else{ echo "<a class='btn_request btn_ty2' data-val='".$list[$i]['wr_id']."'>신청하기</a>"; /* echo "<a href=\"".$a_href."\" class=\"btn_ty2\">신청하기</a>"; */ }
					?>
				</td>
			</tr>
			<?php } ?>
			<?php
				if (count($list) == 0) {
					echo "<tr><td colspan='".$colspan."'>게시물이 없습니다.</td></tr>";
				}
			?>
		</tbody>
	</table>

		<?php if ($list_href || $is_checkbox || $write_href) { ?>
			<div class="bo_fx">
				<ul class="btn_bo_adm">
					<?php if ($list_href) { ?>
						<li><a href="<?php echo $list_href ?>" class="btn_b01"> 목록</a></li>
					<?php } ?>
				</ul>

				<ul class="btn_bo_user2">
					<li><?php if ($write_href) { ?><a href="<?php echo $write_href ?>" class="btn_b02">글쓰기</a><?php } ?></li>
				</ul> 
			</div>
		<?php } ?>
	</form>

	<div class="bo_fx" style="display: none;">
		<div id="bo_list_total">
			<span>Total <?php echo number_format($total_count) ?>건</span>
			<?php echo $page ?> 페이지
		</div>

		<?php if ($rss_href || $write_href) { ?>
			<ul class="btn_bo_user">
				<?php if ($rss_href) { ?><li><a href="<?php echo $rss_href ?>" class="btn_b01">RSS</a></li><?php } ?>
				<?php if ($admin_href) { ?><li><a href="<?php echo $admin_href ?>" class="btn_admin">관리자</a></li><?php } ?>
				<?php if ($write_href) { ?><!-- <li><a href="<?php echo $write_href ?>" class="btn_b02">글쓰기</a></li> --><?php } ?>
			</ul>
		<?php } ?>
	</div>
</div>

<?php if($is_checkbox) { ?>
	<noscript>
		<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
	</noscript>
<?php } ?>

<!-- 페이지 -->
<?php echo $write_pages; ?>

<?php /*
<div class="bd_search ct1">
	<fieldset id="bo_sch">
		<legend>게시물 검색</legend>

		<form name="fsearch" method="get">
			<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
			<input type="hidden" name="sca" value="<?php echo $sca ?>">
			<input type="hidden" name="sop" value="and">

			<label for="sfl" class="sound_only">검색대상</label>
			<select name="sfl" id="sfl" class="select_ty">
				<option value="wr_subject"<?php echo get_selected($sfl, "wr_subject", true); ?>>제목</option>
				<option value="wr_content"<?php echo get_selected($sfl, "wr_content"); ?>>내용</option>
				<option value="wr_subject||wr_content"<?php echo get_selected($sfl, "wr_subject||wr_content"); ?>>제목+내용</option>
			</select>
			<input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" placeholder="검색어"  id="stx" class="input_ty" size="12" maxlength="20">
			<input type="submit" value="검색" class="btn_search">
		</form>
	</fieldset>
</div> */?>

<?php
$request_href = G5_BBS_URL."/write.php?bo_table=".$bo_table."_1";
// 단체 회원일 경우 처리
if($member['mb_level'] == 3){ $request_href = G5_URL."/cal/cal_write1.php"; } ?>
<!-- 신청하기용 -->
<form name="frequset" id="frequset" action="<?php echo $request_href; ?>" method="post">
	<!-- <input type="hidden" name="bo_table" id="bo_table" value="<?php echo $bo_table; ?>_1" /> -->
	<input type="hidden" name="wr_1" id="wr_1" value="" />
</form>

<?php if ($is_checkbox) { ?>
	<script>
		function all_checked(sw) {
			var f = document.fboardlist;

			for (var i=0; i<f.length; i++) {
				if (f.elements[i].name == "chk_wr_id[]")
					f.elements[i].checked = sw;
			}
		}

		function fboardlist_submit(f) {
			var chk_count = 0;

			for (var i=0; i<f.length; i++) {
				if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
					chk_count++;
			}

			if (!chk_count) {
				alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
				return false;
			}

			if(document.pressed == "선택복사") {
				select_copy("copy");
				return;
			}

			if(document.pressed == "선택이동") {
				select_copy("move");
				return;
			}

			if(document.pressed == "선택삭제") {
				if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
					return false;

				f.removeAttribute("target");
				f.action = "./board_list_update.php";
			}

			return true;
		}

		// 선택한 게시물 복사 및 이동
		function select_copy(sw) {
			var f = document.fboardlist;

			if (sw == 'copy')
				str = "복사";
			else
				str = "이동";

			var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

			f.sw.value = sw;
			f.target = "move";
			f.action = "./move.php";
			f.submit();
		}
	</script>
<?php } ?>

<script type="text/javascript">
	
	<?php if($swr_1){ ?>cateload(1,'<?php echo $swr_1; ?>');<?php } ?>

	$("#wr_1 option[value='<?php echo $swr_1; ?>']").prop("selected", "true");
	$("#wr_2 option[value='<?php echo $swr_2; ?>']").prop("selected", "true");

	// 분류(=교육종료) 체인지 이벤트
	function cateload(su, val){
		// if(su==1) $("#wr_3").html("<option value=''>상위분류 선택.</option>");
		var su2 = su+1;

		$.ajax({
			type: 'POST',
			url: '<?php echo G5_BBS_URL; ?>/cateload.php?bo_table=<?php echo $bo_table; ?>',
			data: {su: su,val:val},
			cache: false,
			async: false,
			success: function(result) { 
				$("#wr_" + su2).html(result);

				if(su == 1 && val == ""){ // 첫번째 카테고리가 첫번째일 경우 특별 처리
					$("#wr_" + su2).html("<option value=\"\">전체</option>");
				}
			}
		});
	}

	function fboardlist_submit2(f) {
		f.swr_6.value = get_chk_val('swr_6_'); // 함수화
		f.swr_7.value = get_chk_val('swr_7_'); // 함수화
	}

	// 체크박스 값들 가져오기
	function get_chk_val(name){
		
		var result = ""; // 결과 변수
		var temp_arr = new Array(); // 배열 담을 변수
		
		$("input[name^='" + name + "']").each(function(){ // 해당 이름(ex: name%)의 체크박스달 둘러보기
			if(this.checked){ // checked 처리된 항목의 값
				temp_arr.push(this.value); // 배열의 추가
			}
		});

		result = temp_arr.join('|'); // 배열을 한 문장으로 만들기(=php implode)
		return result;
	}
	
	$( document ).ready(function() {
		// 지역선택 전체를 눌렀을 경우
		$( "#swr_6_all" ).on( "click", function() {
			$("input[name^='swr_6_']").prop("checked", $( this ).is(":checked"));
		});

		// 지역선택 항목들을 클릭했을 경우
		$("input[name^='swr_6_'][name!='swr_6_all']").on( "click", function() { // 해당 이름(ex: name%)의 체크박스 둘러보기
			var total_cnt = 0; // 항목의 총 수
			var check_cnt = 0; // 체크된 수

			total_cnt = $("input[name^='swr_6_'][name!='swr_6_all']").length;
			check_cnt = $("input[name^='swr_6_'][name!='swr_6_all']:checked").length;

			if(total_cnt > check_cnt){ $( "#swr_6_all" ).prop("checked", false); }
			if(total_cnt == check_cnt){ $( "#swr_6_all" ).prop("checked", true);  }
			// console.log( total_cnt + "|" + check_cnt);
		});
	});

	// 신정하기 동적이벤트 처리
	$(document).on('click','.btn_request',function(){
		
		// 신청하기 폼 정보
		var f = document.frequset;
		
		// 현재 신청하려는 교육일정
		var wr_id = $( this ).data('val');
		
		// 교육일정 값이 있을 경우
		if(wr_id){
			f.wr_1.value = wr_id;
			f.submit();
		}
		
	});
</script>
<!-- 게시판 목록 끝 -->
