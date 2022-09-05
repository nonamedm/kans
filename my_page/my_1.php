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
	
	// 관리자이면서 교육생회원(개인)이 아닐 경우
	if(!$is_admin && $member['mb_level'] > 2){ goto_url("./my_1_2.php"); }

	$colspan = 14;

	include_once("script.php");

	// 수료증 공문서 변수
	$is_offi_doc = false;
?>

<section class="s<?=$cate_num;?> s<?=$cate_num;?>0<?=$page_num;?> my_page_new clear ct2">
	<article class="arti1">
		<ul class="smb_my_act">
			<li><a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=register_form.php" class="btn02">회원정보수정</a></li>
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
	
	<?php if(strstr($_SERVER['REMOTE_ADDR'], "211.170.81") || strstr($_SERVER['REMOTE_ADDR'], "192.168.45.13") || strstr($_SERVER['REMOTE_ADDR'], "58.124.26.184")){ ?>
	<article class="arti2">
		<p>※ 무통장 결제시 담당자 확인 후 결제변경이 진행됩니다</p>
		<?php
			
			// API 회원의 수강내역 가져오기
			$url = "https://www.kanselearning.kr/mediopia/calleduCompleteStudentInfoListKanselearningJSON?USER_ID={$member['mb_id']}";
			$data = preg_replace("/\n+/", "", file_get_contents_curl2($url));
			
			$data_ = json_decode($data, true);
			
			// echo "<pre>"; print_r($data_); echo "</pre>";

			// 마이페이지 리턴용
			$back_url = "&amp;back_url=".$PHP_SELF;

			$bo_table = "s1_2_2_1";
			$board = sql_fetch(" select * from {$g5['board_table']} where bo_table = '$bo_table' ");

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
			
			// $page_rows = 8;

			$tmp_write_table = $g5['write_prefix'] . $bo_table;

			$where = " AND mb_id = '".$member['mb_id']."'";
			
			unset($temp_array);
			$temp_sql = "SELECT DISTINCT wr_num FROM {$tmp_write_table} WHERE wr_is_comment = 0 AND wr_reply = '' ".$where;
			$temp_result = sql_query($temp_sql);
			for ($i = 0; $temp_row = sql_fetch_array($temp_result); $i++) { $temp_array[] = $temp_row['wr_num']; }
			$temp_where = implode(", ", $temp_array);
		
			$where = "AND wr_num IN(".$temp_where.")";
			
			$total_sql = "SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$tmp_write_table} WHERE wr_is_comment = 0 ".$where;
			$total_info = sql_fetch($total_sql);
			$total_count = $total_info['cnt'];

			$temp_total = $total_count;

			// api 개수 플러스처리
			if(count($data_)){ $total_count = $total_count + count($data_); }
			
			$total_page  = ceil($total_count / $page_rows);  // 전체 페이지 계산
			$from_record = ($page - 1) * $page_rows; // 시작 열을 구함

			$write_pages = get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, './my_1.php?back_url='.$PHP_SELF.$qstr.'&amp;page=');
			
			$list = array();

			$sql = "SELECT * FROM {$tmp_write_table} WHERE wr_is_comment = 0 ".$where." ORDER BY wr_num, wr_reply LIMIT {$from_record}, $page_rows ";
			// echo $sql;
			$result = sql_query($sql);

			for ($i = 0; $row = sql_fetch_array($result); $i++) {
				$list[$i] = get_list($row, $board, $board_skin_url, G5_IS_MOBILE ? $board['bo_mobile_subject_len'] : $board['bo_subject_len']);
				$list_num = $total_count - ($page - 1) * $list_page_rows;
				$list[$i]['num'] = $list_num - $i;
				
				// 해당 게시글 댓글 수
				// $common_cnt = 0;
				// $common_cnt = sql_fetch("SELECT COUNT(wr_id) CNT FROM {$tmp_write_table} WHERE wr_is_comment = 1 AND wr_parent = '".$row['wr_id']."'");

				// $mb_nick = get_member($list['mb_id'], "mb_nick");
				// $nick_name = $mb_nick['mb_nick'];

				$list[$i]['href'] .= $back_url;
				$list[$i]['api_check'] = false;
			}

			// api 개수 플러스처리
			
			if(count($data_)){
				// 데이터 재정렬
				$data_ = arr_sort($data_, 'SERVICESTART_DATE', 'desc');
				$data_i = count($list);
			}

			// 참가자 리스트의 마지막 페이지에서 개수
			$board_list_cnt = ($temp_total%$list_page_rows);

			for ($i = 0; $i < count($data_); $i++) {

				if(($page - 1) * $list_page_rows > ($i + $board_list_cnt)){ continue; }
				if($list_page_rows <= $data_i){ break; }

				$list_num = ($total_count) - ($page - 1) * $list_page_rows;
				$list[$data_i]['num'] = $list_num - $data_i;
				$list[$data_i]['api_check'] = true;

				$list[$data_i]['mb_id'] = $member["mb_id"];	// 회원계정

				$list[$data_i]['wr_subject'] = $data_[$i]["EDU_NM"];
				// $list[$data_i]['date1'] = date("Y.m.d", strtotime($data_[$i]["SERVICESTART_DATE"]))." ~ ".date("Y.m.d", strtotime($data_[$i]["SERVICEEND_DATE"]));
				if($data_[$i]["COMPLETE_DATE"] != "null"){ $list[$data_i]['date1'] = date("Y.m.d", strtotime($data_[$i]["COMPLETE_DATE"])); }
				else{ $list[$data_i]['date1'] = ""; }
				$list[$data_i]['time'] = $data_[$i]["LEARNING_TIME"]."시간";
				$list[$data_i]['amt'] = $data_[$i]["AMT"];
				$list[$data_i]['wr_17'] = $data_[$i]["PAYMENT_STATUS"];
				$list[$data_i]['wr_18'] = ($data_[$i]["ENROLL_STATUS"] == "수료")?"교육수료":$data_[$i]["ENROLL_STATUS"];
				$list[$data_i]['EDU_CD'] = $data_[$i]["EDU_CD"];
				$list[$data_i]['wr_26'] = $data_[$i]["CERT_NO"];
				$data_i++;
			}

			
			// sort($list);
			// echo "<pre>"; print_r($list); echo "</pre>";
		?>

		<form name="fmylist" id="fmylist" method="post">
			<input type="hidden" name="bo_table" value="<?php echo $bo_table; ?>" />
			<input type="hidden" name="backurl" value="<?php echo G5_SHOP_URL; ?>/payjoa/result.php" /><!-- 결제 후 복귀할 url -->
		
			<div class="table_wrap">
				<table class="table_nomal" style="width: max-content;">
					<colgroup>
						<col width="50px">
						<col width="50px">
						<col width="200px">
						<col width="150px">
						<col width="150px">
						<col width="150px">
						<col width="100px">
						<col width="100px">
						<col width="100px">
						<col width="100px">
						<col width="180px">
						<col width="100px">
						<col width="100px">
						<col width="100px">
						<col width="100px">
						<col width="100px">
					</colgroup>
					<tr>
						<th><input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);" ></th>
						<th>번호</th>
						<th>교육명</th>
						<th>교육일</th>
						<th>교육시간</th>
						<th>교육장소</th>
						<th>진행상태</th>
						<th>결제상태</th>
						<th>접수상태</th>
						<th>금액</th>
						<th>수료증 번호</th>
						<th>수료증 발급</th>
						<th>납부 확인서</th>
						<th>영수증</th>
						<th>무통장 영수증</th>
						<th>비고</th>
					</tr>
					<?php
					for ($i=0; $i<count($list); $i++) {	
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
						
						// 수료번호 처리
						if($list[$i]['api_check']){ $wr_26_text = $list[$i]["wr_26"]; }
						else{
							if($list[$i]["wr_26"]){
								$finsh_year = "";
								// 교육일정이 같은날일 경우
								if($pro_info['wr_4'] && $pro_info['wr_3'] == $pro_info['wr_4']){ $finsh_year = date("y", strtotime($pro_info['wr_3'])); }
								else{ $finsh_year = date("y", strtotime($pro_info['wr_4'])); }
								// 수료증 번호 추가 처리
								$add_text = "";

								// 보수교육
								if($pro_info['wr_1'] == '20'){ $add_text = "-L"; }

								// 전문교육, 기타
								if($pro_info['wr_1'] == '30' || $pro_info['wr_1'] == '40'){ $add_text = "-S"; }

								// 발급번호 처리
								$wr_26_ = "";
								for($j = 0; $j < (5-strlen($list[$i]["wr_26"])); $j++){
									$wr_26_ = "0".$wr_26_;
									
								}
								$wr_26_ .= $list[$i]["wr_26"];

								$wr_26_text = "제 KANS-{$finsh_year}{$add_text}-{$wr_26_} 호";
							}
							else{ $wr_26_text = ""; }
						}
					?>
					<tr>
						<td>
							<?php if(!$list[$i]['api_check']){ ?><input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>"><?php } ?>
							<input type="hidden" name="chk_wr_17[]" value="<?php echo ($list[$i]['wr_17'])?$list[$i]['wr_17']:"미결제"; ?>" id="chk_wr_17_<?php echo $i ?>">
						</td>
						<td><?php echo $list[$i]['num']; ?></td>
						<td><?php echo ($list[$i]['api_check'])?$list[$i]['wr_subject']:$pro_info['wr_subject']; ?></td>
						<td><?php echo ($list[$i]['api_check'])?$list[$i]['date1']:implode(" ~ ", $date_arr); ?></td>
						<td><?php echo ($list[$i]['api_check'])?$list[$i]['time']:implode(" ~ ", $date_arr2); ?></td>
						<td><?php echo ($list[$i]['api_check'])?"온라인":$pro_info['wr_content']; ?></td>
						<td><?php echo ($list[$i]['wr_18'])?$list[$i]['wr_18']:"접수중"; ?></td>
						<td>
						<!-- 임시 계좌확인 -->
							
							<?php
							if($list[$i]['api_check']){ echo $list[$i]['wr_17']; }
							else{
								// 접수중에 미접수이면서, 아직 교육일이 전일 경우
								if(!$list[$i]['wr_17'] && !$list[$i]['wr_18'] && strtotime(date('Y-m-d')) < strtotime($pro_info['wr_3'])){
									// 가상계좌이면서 아직 결제금액이 남았을 경우
									if($list[$i]['wr_20'] == "가상계좌(발급)" && ($list[$i]['wr_16'] - $list[$i]['wr_15']) > 0){
										echo "<a href=\"#n\" class=\"pay_check_bt\">계좌확인</a>";
									}
									else{ echo "<a href=\"#n\" class=\"pay_a\">결제하기</a>"; }
									
								}
								else{ echo ($list[$i]['wr_17'])?$list[$i]['wr_17']:"미결제"; }
								// echo ($list[$i]['wr_17'])?$list[$i]['wr_17']:"미결제";
							}
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

						<td>
							<?php if($list[$i]['api_check']){ if($list[$i]['wr_17'] == "결제완료"){ echo number_format($list[$i]['amt'])."원"; } } 
							else{ echo number_format($pro_info['wr_8'])."원"; } ?>
						</td>
						<td><?php echo $wr_26_text; ?></td>
						<td><?php if($list[$i]['wr_18'] == '교육수료'){ ?>
								<?php if($list[$i]['api_check']){ ?>
								<a href="#n" class="bt layer_mypage_bt" onclick="window.open('./my_pop_api.php?EDU_CD=<?php echo $list[$i]['EDU_CD']."&amp;mb_id={$list[$i]['mb_id']}"; ?>', 'window', 'top=100,left=100, width=730,height=1090')">발급받기 <span><img src="<? echo G5_THEME_URL ?>/images/sub/down_white.jpg" alt=""/>
								<?php } else { ?>
								<a href="#n" class="bt layer_mypage_bt" onclick="window.open('./my_pop.php?wr_id=<?php echo $list[$i]['wr_id']; ?>', 'window', 'top=100,left=100, width=730,height=1090')">발급받기 <span><img src="<? echo G5_THEME_URL ?>/images/sub/down_white.jpg" alt=""/>
								<?php } ?>
							<?php } ?>
						</td>
						<td>
							<?php if($list[$i]['api_check']){ ?>
								<?php if($list[$i]['wr_17'] == '결제완료'){ ?>
								<a href="#n" class="bt layer_mypage_bt" onclick="window.open('./my_pop_2_api.php?EDU_CD=<?php echo $list[$i]['EDU_CD']."&amp;mb_id={$list[$i]['mb_id']}"; ?>', 'window2', 'top=100,left=100, width=730,height=1090')">발급받기 <span><img src="<? echo G5_THEME_URL ?>/images/sub/down_white.jpg" alt=""/>
								<?php }  ?>
							<?php } else {?>
								<?php if($list[$i]['wr_17'] == '결제완료' && $list[$i]['wr_18'] != '취소'){ ?><a href="#n" class="bt layer_mypage_bt" onclick="window.open('./my_pop_2.php?wr_id=<?php echo $list[$i]['wr_id']; ?>', 'window2', 'top=100,left=100, width=730,height=1090')">발급받기 <span><img src="<? echo G5_THEME_URL ?>/images/sub/down_white.jpg" alt=""/><?php } ?>
							<?php } ?>
						</td>
						<td>
							<?php if(!$list[$i]['api_check']){ ?>
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
									} ?>
									<?php if($payinfo_url){ ?>
									<a href="<?php echo $payinfo_url; ?>" onclick='window.open(this.href, "payJoaTradePrint", "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=500,width=490,height=800"); return false;'>영수증</a>
									<?php } ?>
								<?php } ?>
							<?php } ?>
						</td>
						<td>
							<?php if(!$list[$i]['api_check']){ ?>
								<?php if($list[$i]['wr_17'] == '결제완료' && $list[$i]['wr_20'] == '무통장' && $down_href){ ?><a href="<?php echo $down_href; ?>">영수증</a><?php } ?>
							<?php } ?>
						</td>
						<td><?php echo $list[$i]['wr_19']; ?></td>
					</tr>
					<?php } ?>
					<?php if (count($list) == 0) { echo '<tr><td colspan="'.$colspan.'" class="empty_table">게시물이 없습니다.</td></tr>'; } ?>
				</table>
			</div>

			<?php echo $write_pages ; ?>

			<div class="bt_box">
				<span><a href="#" onclick="return open_offi_doc();" >수료 공문서 출력</a></span>
				<!-- <span><a href="#n" onclick="open_payjoa();">결제하기</a></span> -->
				<span><a href="#" onclick="print_excel('./excel_1.php');">엑셀다운로드</a></span>
			</div>
		</form>
	</article>
	<?php } ?>

</section>

<!-- 수료증 공문서 변수 -->
<input type="hidden" name="is_offi_doc" id="is_offi_doc" value="<?php echo $is_offi_doc; ?>" />

<?php include_once(G5_THEME_PATH.'/tail.php'); ?>