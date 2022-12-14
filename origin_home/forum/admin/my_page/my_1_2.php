<?
	include_once('./_common.php');

	//화면의 성격
	$user_division = "user";	$screen_div = "sub"; //main, sub	$frame_div = "two";  //one, two

	//카테고리/페이지/상세페이지 명칭 & 카테고리 번호
	$cate_num = "9";	$page_num = "1"; 

	//현재 활성화 상태
	$gn_btn = "gn_btn".$cate_num;		$$gn_btn = "current";
	$ln_btn = "ln_btn".$page_num;		$$ln_btn = "current";
	$sln_btn = "sln_btn".$spage_num;		$$sln_btn = "current";

	include_once(G5_THEME_PATH.'/head.php');

	if(!$is_member){ alert("로그인 후 이용해주세요.", G5_BBS_URL."/login.php"); }

	// 관리자이면서 교육담당자회원(단체)이 아닐 경우
	if(!$is_admin && $member['mb_level'] < 3){ goto_url("./my_1.php"); }

	$colspan = 17;

	include_once("script.php");

	// 수료증 공문서 변수
	$is_offi_doc = false;
?>

<section class="s<?=$cate_num;?> s<?=$cate_num;?>0<?=$page_num;?> my_page_new clear ct2">
	<article class="arti1">
		<ul class="smb_my_act">
			<li><a href="<?php echo $s1_2_2_url; ?>" class="btn02" style="background: #0094dc; border: 1px solid #0094dc;">단체신청</a></li>
			<? if($member[mb_1]){ //회원종류를 비교하는것 이유 요양기관인경우!! ?>
				<li><a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=register_form.php?reg_type=pb" class="btn02">회원정보수정</a></li>
			<? }else{ ?>
				<li><a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=register_form.php" class="btn02">회원정보수정</a></li>
			<? } ?>
			<li><a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=member_leave.php" onclick="return member_leave();" class="btn02">회원탈퇴</a></li>
		</ul>

		<table class="my_info" >
			<tr>
				<th>연락처</th>
				<td><?php echo ($member['mb_hp'] ? $member['mb_hp'] : '미등록'); ?></td>	
				<th>E-Mail</th>
				<td><?php echo ($member['mb_email'] ? $member['mb_email'] : '미등록'); ?></td>
			</tr>
			<tr>
				<th>최종접속일시</th>
				<td><?php echo $member['mb_today_login']; ?></td>	
				<th>회원가입일시</th>
				<td><?php echo $member['mb_datetime']; ?></td>
			</tr>
			<tr>
				<th>소속</th>
				<td colspan="3">
					<?php echo $member['mb_2']; ?>
				</td>
			</tr>
		</table>
	</article>

	<article class="arti2">
		<form action="<?php echo $PHP_SELF; ?>" >
		<div class="top_bx">
			<p>※ 신청내용 수정은 신청자가 직접 로그인 후 가능합니다</p>
			<ul>
				<li>
					<label for="syear">교육년도</label>
					<select name="syear" id="syear" onchange="this.form.submit();">
						<option value="" selected>전체</option>
						<?php for($i = date('Y')+5; $i > 2020; $i--){ ?>
						<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
						<?php } ?>
					</select>
					<script type="text/javascript">
					$( document ).ready(function() {
						$( "#syear > option[value='<?php echo $syear; ?>']" ).prop( "selected", true);
					});
					</script>
				</li>
				<li>
					<label for="stype">교육명</label>
					<select name="stype" id="stype" onchange="this.form.submit();">
						<option value="" selected>전체</option>
						<?php
						$temp_category = get_table_category('s1_2_2');
						for($i = 0; $i < count($temp_category); $i++){ ?>
						<option value="<?php echo $temp_category[$i]['ca_id']; ?>"><?php echo $temp_category[$i]['ca_name']; ?></option>
						<?php } ?>
						
					</select>
					<script type="text/javascript">
					$( document ).ready(function() {
						$( "#stype > option[value='<?php echo $stype; ?>']" ).prop( "selected", true);
					});
					</script>
				</li>
				<li>
					<select name="spage" id="spage" onchange="this.form.submit();">
						<option value="50" selected>50개씩 보기</option>
						<option value="100">100개씩 보기</option>
					</select>
					<script type="text/javascript">
					$( document ).ready(function() {
						$( "#spage > option[value='<?php echo $spage; ?>']" ).prop( "selected", true);
					});
					</script>
				</li>
			</ul>
		</div>
		</form>

		<?
		// 마이페이지 리턴용
		$back_url = "&amp;back_url=".$PHP_SELF;

		$qstr .= $back_url;

		$bo_table = "s1_2_2_1";
		$board = sql_fetch(" SELECT * FROM ".$g5['board_table']." WHERE bo_table = '".$bo_table."' ");

		// 정렬 기준 값 가져오기
		if (!$sst) {
			if ($board['bo_sort_field']) {
				$sst = $board['bo_sort_field'];
			} else {
				$sst  = "wr_num, wr_reply";
				$sod = "";
			}
		} else {
			$sst = preg_match("/^(wr_datetime|wr_hit|wr_good|wr_nogood)$/i", $sst) ? $sst : "";
		}

		if(!$sst){ $sst  = "wr_num, wr_reply"; }
		if($sst){ $sql_order = " order by {$sst} {$sod} "; }

		if(G5_IS_MOBILE) {
			$page_rows = $board['bo_mobile_page_rows'];
			$list_page_rows = $board['bo_mobile_page_rows'];
		} else {
			$page_rows = $board['bo_page_rows'];
			$list_page_rows = $board['bo_page_rows'];
		}

		// 페이징 처리
		if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
		
		$list_page_rows = $page_rows = ($spage)?$spage:50;

		$total_count = 0;

		$tmp_write_table = $g5['write_prefix'] . $bo_table; // 게시판 테이블 전체이름

		$where = "";
		if($syear){ $where .= " AND wr_22 LIKE '%".$syear."%' "; }
		if($stype){ $where .= " AND wr_23 LIKE '".$stype."' "; }

		$total_sql = "SELECT COUNT(DISTINCT `wr_parent`) AS `cnt`
						FROM {$tmp_write_table}
						WHERE wr_is_comment = 0
							AND wr_13 = '".$member['mb_no']."'
							AND wr_14 = '".$member['mb_id']."'"
						.$where;

		$total_info = sql_fetch($total_sql);
		$total_count = $total_info['cnt'];

		$total_page  = ceil($total_count / $page_rows);  // 전체 페이지 계산
		$from_record = ($page - 1) * $page_rows; // 시작 열을 구함

		$write_pages = get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, './my_1_2.php?'.$qstr.'&amp;page=');
		
		$list = array();

		$QUERY = "SELECT *
					FROM {$tmp_write_table}
					WHERE wr_is_comment = 0
						AND wr_13 = '".$member['mb_no']."'
						AND wr_14 = '".$member['mb_id']."'
						".$where."
					".$sql_order."
					LIMIT {$from_record}, $page_rows";
		$RESULT = sql_query($QUERY);
		for ($i=0; $row = sql_fetch_array($RESULT); $i++) {
			$list[$i] = get_list($row, $board, $board_skin_url, G5_IS_MOBILE ? $board['bo_mobile_subject_len'] : $board['bo_subject_len']);
			$list_num = $total_count - ($page - 1) * $list_page_rows;
			$list[$i]['num'] = $list_num - $i;
		}

		?>
		
		<form name="fmylist" id="fmylist" method="post">
			<input type="hidden" name="bo_table" value="<?php echo $bo_table; ?>" />
			<input type="hidden" name="backurl" value="<?php echo G5_SHOP_URL; ?>/payjoa/result.php" /><!-- 결제 후 복귀할 url -->

		<div class="table_wrap">
			<table class="table_nomal" style="width: max-content;">
				<colgroup>
					<col width="50px">
					<col width="50px">
					<col width="100px">
					<col width="100px">
					<col width="200px">
					<col width="150px">
					<col width="100px">
					<col width="100px">
					<col width="100px">
					<col width="100px">
					<col width="100px">
					<col width="100px">
					<col width="100px">
					<col width="100px">
					<col width="100px">
					<col width="100px">
				</colgroup>
				<tr>
					<th><input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);" ></th>
					<th>번호</th>
					<th>이름</th>
					<th>생년월일</th>
					<th>핸드폰번호</th>
					<th>교육명</th>
					<th>교육일</th>
					<th>교육시간</th>
					<th>진행상태</th>
					<th>결제상태</th>
					<th>접수상태</th>
					<th>금액</th>
					<th>수료증 발급</th>
					<th>납부 확인서</th>
					<th>영수증</th>
					<th>무통장 영수증</th>
					<th>비고</th>
				</tr>
				<?php for ($i=0; $i<count($list); $i++) {

					// 교육 관련 정보
					$prd_write_table = $g5['write_prefix'] . substr($bo_table, 0, -2);
					$pro_info = sql_fetch(" SELECT * FROM ".$prd_write_table." WHERE wr_id = '".$list[$i]['wr_1']."' ");

					$date_arr = Array();
					if($pro_info['wr_3']){ $date_arr[] = date("Y.m.d", strtotime($pro_info['wr_3'])); }
					if($pro_info['wr_4'] && $pro_info['wr_3'] != $pro_info['wr_4']){ $date_arr[] = date("Y.m.d", strtotime($pro_info['wr_4'])); }

					$date_arr2 = Array();
					if($pro_info['wr_9']){ $date_arr2[] = $pro_info['wr_9']; }
					if($pro_info['wr_10'] && $pro_info['wr_9'] != $pro_info['wr_10']){ $date_arr2[] = $pro_info['wr_10']; }

					// 첨부파일 처리
					$temp_file = Array();
					$temp_file = get_file($bo_table, $list[$i]['wr_id']);
					$down_href = "";
					if(isset($temp_file[0]['source']) && $temp_file[0]['source']){ $down_href = $temp_file[0]['href']; }

					// 교육 수료 있는지 체크
					if($list[$i]['wr_17'] == '결제완료' && $list[$i]['wr_18'] == '교육수료'){ $is_offi_doc = true; }
					?>
				<tr>
					<td>
						<input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
						<input type="hidden" name="chk_wr_17[]" value="<?php echo ($list[$i]['wr_17'])?$list[$i]['wr_17']:"미결제"; ?>" id="chk_wr_17_<?php echo $i ?>">
					</td>
					<td><?php echo $list[$i]['num']; ?></td>
					<td><?php echo $list[$i]['wr_3']; ?></td>
					<td><?php echo $list[$i]['wr_4']; ?></td>
					<td><?php echo $list[$i]['wr_5']; ?></td>
					<td><?php echo $pro_info['wr_subject']; ?></td>
					<td><?php echo implode(" ~ ", $date_arr); ?></td>
					<td><?php echo implode(" ~ ", $date_arr2); ?></td>
					<td><?php echo $list[$i]['wr_18']?$list[$i]['wr_18']:"접수중"; ?></td>
					<td>
					<?php
						// 접수중에 미접수이면서, 아직 교육일이 전일 경우
						if(!$list[$i]['wr_17'] && !$list[$i]['wr_18'] && strtotime(date('Y-m-d')) < strtotime($pro_info['wr_3'])){
							// 가상계좌이면서 아직 결제금액이 남았을 경우
							if($list[$i]['wr_20'] == "가상계좌(발급)" && ($list[$i]['wr_16'] - $list[$i]['wr_15']) > 0){
								echo "<a href=\"#n\" class=\"pay_check_bt\">계좌확인</a>";
							} else { echo "<a href=\"#n\" class=\"pay_a\">결제하기</a>"; }
						}
						else{ echo ($list[$i]['wr_17'])?$list[$i]['wr_17']:"미결제"; }
						// echo ($list[$i]['wr_17'])?$list[$i]['wr_17']:"미결제";
						?>
					</td>
<!-- 220318 추가된 접수상태 -->
					<td>
						<?php
						// 아직 교육일이 전일 경우
						if(!$list[$i]['wr_18'] && strtotime(date('Y-m-d')) < strtotime($pro_info['wr_3'])){ ?>
							<?php if($list[$i]['wr_17']){ // 결제완료일 경우?>
								<?php
								if($list[$i]['wr_24']){
									$od_info = sql_fetch(" SELECT * FROM {$g5['g5_shop_order_table']} WHERE od_tno = '{$list[$i]['wr_24']}' ");
									$od_cash = $od_info["od_cash"];
								} ?>
								<?php if(!$od_cash && ($list[$i]['wr_20'] == '신용카드K(일반)' || $list[$i]['wr_20'] == '신용카드(일반)' || $list[$i]['wr_20'] == '계좌이체(일반)')){ ?>
								<a href="#n" onclick="cancel_pay('<?php echo $list[$i]['wr_id']; ?>');">결제취소</a>
								<?php } ?>
							<?php } else { // 미결제일 경우 ?>
									<?php if($list[$i]['wr_20'] == '가상계좌(발급)' && $list[$i]['wr_15'] > 0){ continue; } // 가상계좌이면서 일부 금액 입금한 경우 ?>
								<a href="#n" onclick="cancel_state('<?php echo $list[$i]['wr_id']; ?>');">접수취소</a>
							<?php } ?>
						<?php } ?>
					</td>
					<td><?php echo number_format($list[$i]['wr_16']); ?>원</td>
					<!-- 발급받기 링크 -->
					<td><?php if($list[$i]['wr_18'] == '교육수료'){ ?><a href="#n" class="bt layer_mypage_bt" onclick="window.open('./my_pop.php?wr_id=<?php echo $list[$i]['wr_id']; ?>', 'window', 'top=100,left=100, width=730,height=1090')">발급받기 <span><img src="<? echo G5_THEME_URL ?>/images/sub/down_white.jpg" alt=""/><?php } ?></td>

					<td><?php if($list[$i]['wr_17'] == '결제완료' && $list[$i]['wr_18'] != '취소'){ ?><a href="#n" class="bt layer_mypage_bt" onclick="window.open('./my_pop_2.php?wr_id=<?php echo $list[$i]['wr_id']; ?>', 'window2', 'top=100,left=100, width=730,height=1090')">발급받기 <span><img src="<? echo G5_THEME_URL ?>/images/sub/down_white.jpg" alt=""/><?php } ?></td>
					<td>
						<?php
						if($list[$i]['wr_17'] == '결제완료' && $list[$i]['wr_20'] != '무통장'){
							// 영수증 경로
							$payinfo_url = "";
							switch($list[$i]['wr_20']){
								case "신용카드K(일반)":
									$payinfo_url = $wr20_url."/common/PayInfoPrintDirectCard.jsp?DAOUTRX=".$list[$i]['wr_24']."&STATUS=A";
									break;
								case "신용카드(일반)":
									$payinfo_url = $wr20_url."/common/PayInfoPrintDirectCard.jsp?DAOUTRX=".$list[$i]['wr_24']."&STATUS=A";
									break;
								case "가상계좌(발급)":
									$payinfo_url = $wr20_url."/common/PayInfoPrintVaccount.jsp?DAOUTRX=".$list[$i]['wr_24']."&STATUS=A"; break;
								case "계좌이체(일반)":
									$payinfo_url = $wr20_url."/common/PayInfoPrintBank.jsp?DAOUTRX=".$list[$i]['wr_24']."&STATUS=A"; break;
								default: $payinfo_url = "";
							} ?><a href="<?php echo $payinfo_url; ?>" onclick='window.open(this.href, "payJoaTradePrint", "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=500,width=490,height=800"); return false;'>영수증</a>
						<?php } ?>
					</td>
					<td><?php if($list[$i]['wr_17'] == '결제완료' && $list[$i]['wr_20'] == '무통장' && $down_href){ ?><a href="<?php echo $down_href; ?>">영수증</a><?php } ?></td>
					<td><?php echo $list[$i]['wr_19']; ?></td>
				</tr>
				<?php } ?>
				<?php if (count($list) == 0) { echo '<tr><td colspan="'.$colspan.'" class="empty_table">게시물이 없습니다.</td></tr>'; } ?>
			</table>
		</div>

		</form>

		<?php echo $write_pages; ?>

		<div class="bt_box">
			<span><a href="#" onclick="return open_offi_doc();" >수료 공문서 출력</a></span>
			<!-- <span><a href="#n" onclick="open_payjoa();">결제하기</a></span> -->
			<span><a href="#" onclick="print_excel('./excel_1_2.php');">엑셀 다운로드</a></span>
		</div>
	</article>
</section>

<!-- 수료증 공문서 변수 -->
<input type="hidden" name="is_offi_doc" id="is_offi_doc" value="<?php echo $is_offi_doc; ?>" />

<?php include_once(G5_THEME_PATH.'/tail.php'); ?>