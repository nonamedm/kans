<?php
	if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

	// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
	add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<section id="bo_w" class="respon_w ct1">
	<h2 id="container_title"><?php echo $g5['title'] ?></h2>

	<form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
		<input type="hidden" name="w" value="<?php echo $w ?>">
		<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
		<input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
		<input type="hidden" name="sca" value="<?php echo $sca ?>">
		<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
		<input type="hidden" name="stx" value="<?php echo $stx ?>">
		<input type="hidden" name="spt" value="<?php echo $spt ?>">
		<input type="hidden" name="sst" value="<?php echo $sst ?>">
		<input type="hidden" name="sod" value="<?php echo $sod ?>">
		<input type="hidden" name="page" value="<?php echo $page ?>">

		<input type="hidden" name="wr_1" id="wr_1" value="<?php echo $wr_1; ?>">
		<input type="hidden" name="ca_name" id="ca_name" value="<?php echo $ca_name; ?>">

		<input type="hidden" name="wr_subject" id="wr_subject" value="<?php echo $subject; ?>">
		<input type="hidden" name="wr_content" id="wr_content" value="<?php echo $content; ?>">

		<!-- 현재 신청하는 소속 회원정보 -->
		<?php
		// 해당 교육 담당자 정보
		/* 
		mb_leave_date = '' 탈퇴회원 제외
		mb_intercept_date = '' 차단회원 제외 */ 
		$charge_query = " SELECT * 
							FROM ".$g5['member_table']."
							WHERE mb_id not in('inpiad', 'admin') 
							AND mb_leave_date = ''
							AND mb_intercept_date = ''
							AND mb_level = 3
							AND mb_1 = '".$member['mb_1']."'";
		$charge_info = sql_fetch($charge_query);
		?>
		<input type="hidden" name="wr_13" id="wr_13" value="<?php echo $charge_info['mb_no']; ?>" />	<!-- 회원 no -->
		<input type="hidden" name="wr_14" id="wr_14" value="<?php echo $charge_info['mb_id']; ?>" />	<!-- 회원 id -->

		<input type="hidden" name="wr_15" id="wr_15" value="0" />	<!-- 결제된 금액 -->
		<input type="hidden" name="wr_16" id="wr_16" value="<?php echo $program_info['wr_8']; ?>" />	<!-- 결제할 금액 -->

		<input type="hidden" name="wr_22" id="wr_22" value="<?php echo substr($program_info['wr_3'], 0, 4); ?>|<?php echo substr($program_info['wr_4'], 0, 4); ?>" />	<!-- 교육년도 -->
		<input type="hidden" name="wr_23" id="wr_23" value="<?php echo $program_info['wr_1']; ?>" />	<!-- 교육명 -->

		<input type="hidden" name="wr_24" id="wr_24" value="<?php echo $write['wr_24']; ?>" />	<!-- PAYJOA 주문번호 -->
		<input type="hidden" name="wr_25" id="wr_25" value="<?php echo $write['wr_25']; ?>" />	<!-- 장바구니 PK -->
		<input type="hidden" name="wr_26" id="wr_26" value="<?php echo $write['wr_26']; ?>" />	<!-- 수료증 번호 -->
		<input type="hidden" name="wr_27" id="wr_27" value="<?php echo $write['wr_27']; ?>" />	<!-- 결제일자 -->
		<input type="hidden" name="wr_28" id="wr_28" value="<?php echo $write['wr_28']; ?>" />	<!-- 취소일자 -->
		<input type="hidden" name="wr_29" id="wr_29" value="<?php echo $write['wr_29']; ?>" />	<!-- 주문번호 -->

		<input type="hidden" name="wr_30" id="wr_30" value="<?php echo $member['mb_1']; ?>" />	<!-- 소속 -->

		<?php
			$option = '';
			$option_hidden = '';
			if ($is_notice || $is_html || $is_secret || $is_mail) {
				$option = '';
				if ($is_notice) {
					$option .= "\n".'<input type="checkbox" id="notice" name="notice" value="1" '.$notice_checked.'>'."\n".'<label for="notice">공지</label>';
				}

				if ($is_html) {
					if ($is_dhtml_editor) {
						$option_hidden .= '<input type="hidden" value="html1" name="html">';
					} else {
						$option .= "\n".'<input type="checkbox" id="html" name="html" onclick="html_auto_br(this);" value="'.$html_value.'" '.$html_checked.'>'."\n".'<label for="html">html</label>';
					}
				}

				if ($is_secret) {
					if ($is_admin || $is_secret==1) {
						$option .= "\n".'<input type="checkbox" id="secret" name="secret" value="secret" '.$secret_checked.'>'."\n".'<label for="secret">비밀글</label>';
					} else {
						$option_hidden .= '<input type="hidden" name="secret" value="secret">';
					}
				}

				if ($is_mail) {
					$option .= "\n".'<input type="checkbox" id="mail" name="mail" value="mail" '.$recv_email_checked.'>'."\n".'<label for="mail">답변메일받기</label>';
				}
			}

			echo $option_hidden;

			$option = false;
		?>

		<article class="res_w">
			<p class="ment">
				<span class="red">(*)</span>표시는 필수입력사항 입니다.
			</p>
			<div class="tb_outline">
				<div class="div_tb">

					
					<!-- ======================== 직장교육 신청 폼 ======================== -->
					<?php if($program_info['wr_1'] == '10'){ ?>
						<!-- <div class="div_tb_tr">
							<div class="div_th">
								<label for="wr_2">교육구분</label>
							</div>
							<div class="div_td">
								<span style="display: inline-block; margin-right: 10px;">
									<input type="radio" name="">
									<label for="">일반신규</label>
								</span>
								<span style="display: inline-block; margin-right: 10px;">
									<input type="radio" name="">
									<label for="">일반정기</label>
								</span>
								<span style="display: inline-block; margin-right: 10px;">
									<input type="radio" name="">
									<label for="">비파괴신규</label>
								</span>
								<span style="display: inline-block; margin-right: 10px;">
									<input type="radio" name="">
									<label for="">비파괴정기</label>
								</span>
							</div>
						</div> -->

						
						<div class="div_tb_tr">
							<div class="div_th">
								<label for="wr_2">기관명</label>
							</div>
							<div class="div_td">
								<input type="text" name="wr_2" value="<?php echo $write['wr_2']; ?>" id="wr_2" class=""  style="" >
							</div>
						</div>

						<div class="div_tb_tr">
							<div class="div_th">
								<label for="wr_3">이름 <strong class="sound_only">필수</strong><span class="red">(*)</span></label>
							</div>
							<div class="div_td">
								<input type="text" name="wr_3" value="<?php echo $write['wr_3']; ?>" id="wr_3" class="" / style="width:140px" required>
								<?php if ($is_name) { ?>
									<input type="hidden" name="wr_name" value="<?php echo $name ?>" id="wr_name">
								<?php } ?>
							</div>
						</div>

						<div class="div_tb_tr">
							<div class="div_th">
								<label for="">생년월일 <strong class="sound_only">필수</strong><span class="red">(*)</span></label>
							</div>
							<div class="div_td">
								<input type="hidden" name="wr_4" value="<?php echo $write['wr_4']; ?>" id="wr_4">
								<?php $wr_4_ = explode("-", $write['wr_4']); ?>
								<ul class="col2_num">
									<li><input type="text" name="wr_4_1" value="<?php echo $wr_4_[0]; ?>" id="wr_4_1" class="" / style="" required maxlength="6"></li>
									<li><input type="text" name="wr_4_2" value="<?php echo $wr_4_[1]; ?>" id="wr_4_2" class="" / style="width:30px" required maxlength="1"></li>
								</ul>
							</div>
						</div>
						<div class="div_tb_tr">
							<div class="div_th">
								<label for="">핸드폰 번호 <strong class="sound_only">필수</strong><span class="red">(*)</span></label>
							</div>
							<div class="div_td">
								<ul class="layout_tel">
									<input type="hidden" name="wr_5" value="<?php echo $write['wr_5']; ?>" />
									<li class="" style="width:150px">
										<?php $wr_5_ = explode("-", $write['wr_5']); ?>
										<select id="mb_tel1" name="mb_tel1">
											<option value="010">010</option>
											<option value="011">011</option>
											<option value="016">016</option>
											<option value="017">017</option>
											<option value="018">018</option>
											<option value="019">019</option>
										</select>
										<script type="text/javascript">
										$("#mb_tel1 option[value='<?php echo $wr_5_[0]; ?>']").prop("selected", "true");
										</script>
									</li>
									<li class=""style="width:150px"><input type="text" id="mb_tel2" name="mb_tel2" class="frm_input" maxlength="4" value="<?php echo $wr_5_[1]; ?>" required /></li>
									<li class=""style="width:150px"><input type="text" id="mb_tel3" name="mb_tel3" class="frm_input" maxlength="4" value="<?php echo $wr_5_[1]; ?>" required /></li>
								</ul>
							</div>
						</div>

						<div class="div_tb_tr">
							<div class="div_th">
								<label for="wr_email">이메일</label>
							</div>
							<div class="div_td">
								<?php if ($is_email) { ?>
								<input type="hidden" name="wr_email" >
								<?php } ?>
								<input type="hidden" name="wr_6" >
								<?php $wr_email_ = explode("@", $write['wr_6']); ?>
								<ul class="layout_email">
									<li class="" style="width:140px"><input type="text" id="wr_email1" name="wr_email1" class="" value="<?=$wr_email_[0]?>" required/></li>
									<li style="width:auto" class="godle">@</li>
									<li class="" style="width:140px"><input type="text" id="wr_email2" name="wr_email2" class="" value="<?=$wr_email_[1]?>" required /></li>
									<!--li class=""><input type="text" id="" name="" class="" /></li-->
									<li class="" style="width:140px">
										<select id="wr_email3" name="wr_email3" onchange="document.fwrite.wr_email2.value=this.value;document.fwrite.wr_email2.focus();">
											<option value="">선택하세요</option>
											<option value='naver.com'>naver.com</option>
											<option value='hanmail.net'>hanmail.net</option>
											<option value='nate.com'>nate.com</option>
											<option value='hotmail.com'>hotmail.com</option>
											<option value='hanmir.com'>hanmir.com</option>
											<option value='empal.com'>empal.com</option>
											<option value='gmail.com'>gmail.com</option>
											<option value='lycos.co.kr'>lycos.co.kr</option>
											<option value='paran.com'>paran.com</option>
											<option value='hananet.net'>hananet.net</option>
											<option value='korea.com'>korea.com</option>
											<option value='dreamwiz.com'>dreamwiz.com</option>
											<option value='hanafos.com'>hanafos.com</option>
											<option value='freechal.com'>freechal.com</option>
											<option value='chol.com'>chol.com</option>
											<option value='chollian.net'>chollian.net</option>
											<option value='hitel.net'>hitel.net</option>
											<option value='kornet.net'>kornet.net</option>
											<option value='icitiro.com'>icitiro.com</option>
											<option value='kebi.com'>kebi.com</option>
											<option value='netian.com'>netian.com</option>
											<option value='orgio.com'>orgio.com</option>
											<option value='sayclub.com'>sayclub.com</option>
											<option value='shinbiro.co.kr'>shinbiro.co.kr</option>
											<option value='unitel.co.kr'>unitel.co.kr</option>
											<option value='yahoo.co.kr'>yahoo.co.kr</option>
											<option value='yahoo.com'>yahoo.com</option>
											<option value="">직접입력</option>
										</select>

									<script type="text/javascript">
									<?php if ($wr_email_[1]==true) { ?>
										$("#wr_email3 option[value='<?=$wr_email_[1]?>']").prop("selected", "true");
									<?}?>
									</script>
									</li>
								</ul>
							</div>
						</div>

						<div class="div_tb_tr">
							<div class="div_th">
								<label for="wr_7">방사선사면허번호</label>
							</div>
							<div class="div_td">
								<input type="text" name="wr_7" value="<?php echo $write['wr_7']; ?>" id="wr_7" class="" style="width:140px" >
							</div>
						</div>
					<!-- ======================== 보수교육 신청 폼 ======================== -->
					<?php } else if($program_info['wr_1'] == '20' || $program_info['wr_1'] == '40'){ ?>
						<div class="div_tb_tr">
							<div class="div_th">
								<label for="wr_2">기관명</label>
							</div>
							<div class="div_td">
								<input type="text" name="wr_2" value="<?php echo $write['wr_2']; ?>" id="wr_2" class=""  style="" >
							</div>
						</div>

						<div class="div_tb_tr">
							<div class="div_th">
								<label for="wr_3">이름 <strong class="sound_only">필수</strong><span class="red">(*)</span></label>
							</div>
							<div class="div_td">
								<input type="text" name="wr_3" value="<?php echo $write['wr_3']; ?>" id="wr_3" class="" / style="width:140px" required>
								<?php if ($is_name) { ?>
									<input type="hidden" name="wr_name" value="<?php echo $name ?>" id="wr_name">
								<?php } ?>
							</div>
						</div>

						<div class="div_tb_tr">
							<div class="div_th">
								<label for="">생년월일 <strong class="sound_only">필수</strong><span class="red">(*)</span></label>
							</div>
							<div class="div_td">
								<input type="hidden" name="wr_4" value="<?php echo $write['wr_4']; ?>" id="wr_4">
								<?php $wr_4_ = explode("-", $write['wr_4']); ?>
								<ul class="col2_num">
									<li><input type="text" name="wr_4_1" value="<?php echo $wr_4_[0]; ?>" id="wr_4_1" class="" / style="" required maxlength="6"></li>
									<li><input type="text" name="wr_4_2" value="<?php echo $wr_4_[1]; ?>" id="wr_4_2" class="" / style="width:30px" required maxlength="1"></li>
								</ul>
							</div>
						</div>
						<div class="div_tb_tr">
							<div class="div_th">
								<label for="">핸드폰 번호 <strong class="sound_only">필수</strong><span class="red">(*)</span></label>
							</div>
							<div class="div_td">
								<ul class="layout_tel">
									<input type="hidden" name="wr_5" value="<?php echo $write['wr_5']; ?>" />
									<li class="" style="width:150px">
										<?php $wr_5_ = explode("-", $write['wr_5']); ?>
										<select id="mb_tel1" name="mb_tel1">
											<option value="010">010</option>
											<option value="011">011</option>
											<option value="016">016</option>
											<option value="017">017</option>
											<option value="018">018</option>
											<option value="019">019</option>
										</select>
										<script type="text/javascript">
										$("#mb_tel1 option[value='<?php echo $wr_5_[0]; ?>']").prop("selected", "true");
										</script>
									</li>
									<li class=""style="width:150px"><input type="text" id="mb_tel2" name="mb_tel2" class="frm_input" maxlength="4" value="<?php echo $wr_5_[1]; ?>" required /></li>
									<li class=""style="width:150px"><input type="text" id="mb_tel3" name="mb_tel3" class="frm_input" maxlength="4" value="<?php echo $wr_5_[1]; ?>" required /></li>
								</ul>
							</div>
						</div>
						
						<div class="div_tb_tr">
							<div class="div_th">
								<label for="wr_email">이메일</label>
							</div>
							<div class="div_td">
								<?php if ($is_email) { ?>
								<input type="hidden" name="wr_email" >
								<?php } ?>
								<input type="hidden" name="wr_6" >
								<?php $wr_email_ = explode("@", $write['wr_6']); ?>
								<ul class="layout_email">
									<li class="" style="width:140px"><input type="text" id="wr_email1" name="wr_email1" class="" value="<?=$wr_email_[0]?>" required/></li>
									<li style="width:auto" class="godle">@</li>
									<li class="" style="width:140px"><input type="text" id="wr_email2" name="wr_email2" class="" value="<?=$wr_email_[1]?>" required /></li>
									<!--li class=""><input type="text" id="" name="" class="" /></li-->
									<li class="" style="width:140px">
										<select id="wr_email3" name="wr_email3" onchange="document.fwrite.wr_email2.value=this.value;document.fwrite.wr_email2.focus();">
											<option value="">선택하세요</option>
											<option value='naver.com'>naver.com</option>
											<option value='hanmail.net'>hanmail.net</option>
											<option value='nate.com'>nate.com</option>
											<option value='hotmail.com'>hotmail.com</option>
											<option value='hanmir.com'>hanmir.com</option>
											<option value='empal.com'>empal.com</option>
											<option value='gmail.com'>gmail.com</option>
											<option value='lycos.co.kr'>lycos.co.kr</option>
											<option value='paran.com'>paran.com</option>
											<option value='hananet.net'>hananet.net</option>
											<option value='korea.com'>korea.com</option>
											<option value='dreamwiz.com'>dreamwiz.com</option>
											<option value='hanafos.com'>hanafos.com</option>
											<option value='freechal.com'>freechal.com</option>
											<option value='chol.com'>chol.com</option>
											<option value='chollian.net'>chollian.net</option>
											<option value='hitel.net'>hitel.net</option>
											<option value='kornet.net'>kornet.net</option>
											<option value='icitiro.com'>icitiro.com</option>
											<option value='kebi.com'>kebi.com</option>
											<option value='netian.com'>netian.com</option>
											<option value='orgio.com'>orgio.com</option>
											<option value='sayclub.com'>sayclub.com</option>
											<option value='shinbiro.co.kr'>shinbiro.co.kr</option>
											<option value='unitel.co.kr'>unitel.co.kr</option>
											<option value='yahoo.co.kr'>yahoo.co.kr</option>
											<option value='yahoo.com'>yahoo.com</option>
											<option value="">직접입력</option>
										</select>

									<script type="text/javascript">
									<?php if ($wr_email_[1]==true) { ?>
										$("#wr_email3 option[value='<?=$wr_email_[1]?>']").prop("selected", "true");
									<?}?>
									</script>
									</li>
								</ul>
							</div>
						</div>

						<div class="div_tb_tr">
							<div class="div_th">
								<label for="wr_8">면허</label>
							</div>
							<div class="div_td">
								<select name="wr_8" id="wr_8">
									<option value="">선택해주세요.</option>
									<option value="방사선취급자감독자면허">방사선취급자감독자면허</option>
									<option value="방사성동위원소취급자일반면허">방사성동위원소취급자일반면허</option>
									<option value="방사성동위원소취급자특수면허">방사성동위원소취급자특수면허</option>
								</select>

								<script type="text/javascript">
									$("#wr_8 option[value='<?php echo $write[wr_8]; ?>']").prop("selected", "true");
								</script>
							</div>
						</div>

						<div class="div_tb_tr">
							<div class="div_th">
								<label for="wr_9">면허번호</label>
							</div>
							<div class="div_td">
								<input type="text" name="wr_9" value="<?php echo $write['wr_9']; ?>" id="wr_9" class="" style="width:250px" >
							</div>
						</div>

						<div class="div_tb_tr">
							<div class="div_th">
								<label for="wr_7">방사선사면허번호</label>
							</div>
							<div class="div_td">
								<input type="text" name="wr_7" value="<?php echo $write['wr_7']; ?>" id="wr_7" class="" style="width:140px" >
							</div>
						</div>
					<!-- ======================== 전문교육 신청 폼 ======================== -->
					<?php } else if($program_info['wr_1'] == '30'){ ?>
						<div class="div_tb_tr">
							<div class="div_th">
								<label for="wr_2">기관명</label>
							</div>
							<div class="div_td">
								<input type="text" name="wr_2" value="<?php echo $write['wr_2']; ?>" id="wr_2" class=""  style="" >
							</div>
						</div>
						<div class="div_tb_tr">
							<div class="div_th">
								<label for="wr_7">교육구분</label>
							</div>
							<div class="div_td">
								<select id="wr_7" name="wr_7" style="width:150px">
									<option value="전문강좌">전문강좌</option>
									<option value="단기강좌">단기강좌</option>
								</select>

								<script type="text/javascript">
									$("#wr_7 option[value='<?php echo $write[wr_7]; ?>']").prop("selected", "true");
								</script>
							</div>
						</div>
						<!-- <div class="div_tb_tr">
							<div class="div_th">
								<label for="wr_8">교육명</label>
							</div>
							<div class="div_td">
								<input type="text" name="wr_8" value="<?php echo $write['wr_8']; ?>" id="wr_8" class="" style="width:200px"  >
							</div>
						</div> -->

						<!-- <div class="div_tb_tr">
							<div class="div_th">
								<label for="wr_classdate">교육일</label>
							</div>
							<div class="div_td">
								<input type="date" id="wr_9" name="wr_9" value="<?php echo $write['wr_9']; ?>" class="w25">  ~
								<input type="date" id="wr_10" name="wr_10" value="<?php echo $write['wr_10']; ?>" class="w25">
							</div>
						</div> -->

						<div class="div_tb_tr">
							<div class="div_th">
								<label for="wr_3">이름 <strong class="sound_only">필수</strong><span class="red">(*)</span></label>
							</div>
							<div class="div_td">
								<input type="text" name="wr_3" value="<?php echo $write['wr_3']; ?>" id="wr_3" class="" / style="width:140px" required>
								<?php if ($is_name) { ?>
									<input type="hidden" name="wr_name" value="<?php echo $name ?>" id="wr_name">
								<?php } ?>
							</div>
						</div>

						<div class="div_tb_tr">
							<div class="div_th">
								<label for="">생년월일 <strong class="sound_only">필수</strong><span class="red">(*)</span></label>
							</div>
							<div class="div_td">
								<input type="hidden" name="wr_4" value="<?php echo $write['wr_4']; ?>" id="wr_4">
								<?php $wr_4_ = explode("-", $write['wr_4']); ?>
								<ul class="col2_num">
									<li><input type="text" name="wr_4_1" value="<?php echo $wr_4_[0]; ?>" id="wr_4_1" class="" / style="" required maxlength="6"></li>
									<li><input type="text" name="wr_4_2" value="<?php echo $wr_4_[1]; ?>" id="wr_4_2" class="" / style="width:30px" required maxlength="1"></li>
								</ul>
							</div>
						</div>

						<div class="div_tb_tr">
							<div class="div_th">
								<label for="wr_11">소속</label>
							</div>
							<div class="div_td">
								<input type="text" name="wr_11" value="<?php echo $write['wr_11']; ?>" id="wr_11" class="" / style="width:200px" required>
							</div>
						</div>

						<!-- <div class="div_tb_tr">
							<div class="div_th">
								<label for="wr_12">부서명</label>
							</div>
							<div class="div_td">
								<input type="text" name="wr_12" value="<?php echo $write['wr_12']; ?>" id="wr_12" class="" / style="width:200px" >
							</div>
						</div> -->

						<div class="div_tb_tr">
							<div class="div_th">
								<label for="">핸드폰 번호 <strong class="sound_only">필수</strong><span class="red">(*)</span></label>
							</div>
							<div class="div_td">
								<ul class="layout_tel">
									<input type="hidden" name="wr_5" value="<?php echo $write['wr_5']; ?>" />
									<li class="" style="width:150px">
										<?php $wr_5_ = explode("-", $write['wr_5']); ?>
										<select id="mb_tel1" name="mb_tel1">
											<option value="010">010</option>
											<option value="011">011</option>
											<option value="016">016</option>
											<option value="017">017</option>
											<option value="018">018</option>
											<option value="019">019</option>
										</select>
										<script type="text/javascript">
										$("#mb_tel1 option[value='<?php echo $wr_5_[0]; ?>']").prop("selected", "true");
										</script>
									</li>
									<li class=""style="width:150px"><input type="text" id="mb_tel2" name="mb_tel2" class="frm_input" maxlength="4" value="<?php echo $wr_5_[1]; ?>" required /></li>
									<li class=""style="width:150px"><input type="text" id="mb_tel3" name="mb_tel3" class="frm_input" maxlength="4" value="<?php echo $wr_5_[1]; ?>" required /></li>
								</ul>
							</div>
						</div>

						<div class="div_tb_tr">
							<div class="div_th">
								<label for="wr_email">이메일</label>
							</div>
							<div class="div_td">
								<?php if ($is_email) { ?>
								<input type="hidden" name="wr_email" >
								<?php } ?>
								<input type="hidden" name="wr_6" >
								<?php $wr_email_ = explode("@", $write['wr_6']); ?>
								<ul class="layout_email">
									<li class="" style="width:140px"><input type="text" id="wr_email1" name="wr_email1" class="" value="<?=$wr_email_[0]?>" required/></li>
									<li style="width:auto" class="godle">@</li>
									<li class="" style="width:140px"><input type="text" id="wr_email2" name="wr_email2" class="" value="<?=$wr_email_[1]?>" required /></li>
									<!--li class=""><input type="text" id="" name="" class="" /></li-->
									<li class="" style="width:140px">
										<select id="wr_email3" name="wr_email3" onchange="document.fwrite.wr_email2.value=this.value;document.fwrite.wr_email2.focus();">
											<option value="">선택하세요</option>
											<option value='naver.com'>naver.com</option>
											<option value='hanmail.net'>hanmail.net</option>
											<option value='nate.com'>nate.com</option>
											<option value='hotmail.com'>hotmail.com</option>
											<option value='hanmir.com'>hanmir.com</option>
											<option value='empal.com'>empal.com</option>
											<option value='gmail.com'>gmail.com</option>
											<option value='lycos.co.kr'>lycos.co.kr</option>
											<option value='paran.com'>paran.com</option>
											<option value='hananet.net'>hananet.net</option>
											<option value='korea.com'>korea.com</option>
											<option value='dreamwiz.com'>dreamwiz.com</option>
											<option value='hanafos.com'>hanafos.com</option>
											<option value='freechal.com'>freechal.com</option>
											<option value='chol.com'>chol.com</option>
											<option value='chollian.net'>chollian.net</option>
											<option value='hitel.net'>hitel.net</option>
											<option value='kornet.net'>kornet.net</option>
											<option value='icitiro.com'>icitiro.com</option>
											<option value='kebi.com'>kebi.com</option>
											<option value='netian.com'>netian.com</option>
											<option value='orgio.com'>orgio.com</option>
											<option value='sayclub.com'>sayclub.com</option>
											<option value='shinbiro.co.kr'>shinbiro.co.kr</option>
											<option value='unitel.co.kr'>unitel.co.kr</option>
											<option value='yahoo.co.kr'>yahoo.co.kr</option>
											<option value='yahoo.com'>yahoo.com</option>
											<option value="">직접입력</option>
										</select>

									<script type="text/javascript">
									<?php if ($wr_email_[1]==true) { ?>
										$("#wr_email3 option[value='<?=$wr_email_[1]?>']").prop("selected", "true");
									<?}?>
									</script>
									</li>
								</ul>
							</div>
						</div>
					<?php } ?>
						
					<? $is_homepage = false; // 홈페이지는 사용안함 ?>
					<?php if ($is_homepage) { ?>
						<div class="div_tb_tr">
							<div class="div_th">
								<label for="wr_homepage">홈페이지</label>
							</div>
							<div class="div_td">
								<input type="text" name="wr_homepage" value="<?php echo $homepage ?>" id="wr_homepage" class="" />
							</div>
						</div>
					<?php } ?>
					<?php if ($option) { ?>
						<div class="div_tb_tr">
							<div class="div_th">옵션</div>
							<div class="div_td"><?php echo $option ?></div>
						</div>
					<?php } ?>
					
					<?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>
						<?php if(!$i){ continue; }// 1번은 무통장 입금자 영수증용 ?>
						<div class="div_tb_tr">
							<div class="div_th">
								<!-- 파일 #<?php echo $i+1 ?> -->
								파일 #<?php echo $i; ?>
							</div>
							<div class="div_td">
								<input type="file" name="bf_file[]" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file frm_input">
								<?php if ($is_file_content) { ?>
									<input type="text" name="bf_content[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content'] : ''; ?>" title="파일 설명을 입력해주세요." class="frm_file frm_input" size="50">
								<?php } ?>
								<?php if($w == 'u' && $file[$i]['file']) { ?>
									<input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일 삭제</label>
								<?php } ?>
							</div>
						</div>
					<?php } ?>
					<?php if ($is_guest) { //자동등록방지  ?>
						<div class="div_tb_tr">
							<div class="div_th">자동등록방지</div>
							<div class="div_td"><?php echo $captcha_html ?></div>
						</div>
					<?php } ?>
				</div>
			</div>
		</article>

		<?if(!$is_member&&(!$w || $w=="r")){//비회원이고 글작성, 글답변시일때는 동의란이 나오도록 되어있습니다. ?>
			<article class="privacy_area"><!-- 개인정보취급방침 동의 -->
				<h2>개인정보취급방침 동의</h2>
				<textarea rows="" cols="" class="privacy_box" readonly><?php echo get_text($config['cf_privacy']) ?></textarea>
				<div class="agreen_box">
					<input type="radio" id="agree_1" name="priv" value="동의" required/>
					<label for="agree_1">동의함</label>
					<input type="radio" id="agree_2" name="priv" value="동의안함" />
					<label for="agree_2">동의안함</label>
				</div>
			</article>
		<?}?>

		<div class="btn_confirm">
			<input type="submit" value="작성완료" id="btn_submit" class="" accesskey="s">
			<!--
			<a href="./board.php?bo_table=<?php echo $bo_table ?>" class="">취소</a>
			-->
		</div>
	</form>
</section>

<script>
	<?php if($write_min || $write_max) { ?>
		// 글자수 제한
		var char_min = parseInt(<?php echo $write_min; ?>); // 최소
		var char_max = parseInt(<?php echo $write_max; ?>); // 최대
		check_byte("wr_content", "char_count");

		$(function() {
			$("#wr_content").on("keyup", function() {
				check_byte("wr_content", "char_count");
			});
		});
	<?php } ?>

	function html_auto_br(obj){
		if (obj.checked) {
			result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
			if (result)
				obj.value = "html2";
			else
				obj.value = "html1";
		}
		else
			obj.value = "";
	}

	function fwrite_submit(f){

		<? if(!$is_member && !$w){ ?>
		//비회원 글쓰기 개인정보 수집·이용 등에 대한 동의 선택은 필수입니다. 256~274라인
		var radio_num = f.priv.length;
		var chk_i = 0;
		var chk_value;
		
		for(var i=0; i<radio_num; i++){
			if (f.priv[i].checked == true){
				chk_i++;
				chk_value = f.priv[i].value;
				break;
			}
		}
		
		if (chk_value != "동의"){
			alert("개인정보 수집·이용 등에 대한 동의 선택해주세요.");
			f.priv[0].focus();
			return false;
		}
		<?}?>
		
		// 이름
		<?php if ($is_name) { ?>
			f.wr_name.value = f.wr_3.value
		<?php }  ?>
		
		// 생년월일
		f.wr_4.value = f.wr_4_1.value + "-" + f.wr_4_2.value;

		// 연락처
		f.wr_5.value = f.mb_tel1.value+"-"+f.mb_tel2.value+"-"+f.mb_tel3.value;
		
		// 이메일
		f.wr_6.value = f.wr_email1.value + "@" + f.wr_email2.value;
		<?php if ($is_email) { ?>
			f.wr_email.value = f.wr_6.value;
		<?php } ?>

		f.wr_subject.value = f.wr_3.value + "님의 " + f.ca_name.value + " 신청";
		f.wr_content.value = f.wr_subject.value;

		<?php echo $editor_js; ?>// 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함

		var subject = "";
		var content = "";
		$.ajax({
			url: g5_bbs_url+"/ajax.filter.php",
			type: "POST",
			data: {
				"subject": f.wr_subject.value,
				"content": f.wr_content.value
			},
			dataType: "json",
			async: false,
			cache: false,
			success: function(data, textStatus) {
				subject = data.subject;
				content = data.content;
			}
		});

		if (subject) {
			alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
			f.wr_subject.focus();
			return false;
		}

		if (content) {
			alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
			if (typeof(ed_wr_content) != "undefined")
				ed_wr_content.returnFalse();
			else
				f.wr_content.focus();
			return false;
		}

		if (document.getElementById("char_count")) {
			if (char_min > 0 || char_max > 0) {
				var cnt = parseInt(check_byte("wr_content", "char_count"));
				if (char_min > 0 && char_min > cnt) {
					alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
					return false;
				}
				else if (char_max > 0 && char_max < cnt) {
					alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
					return false;
				}
			}
		}
		<?php if($bo_table!='s3_1'){?>
		<?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>
		<?php }?>

		document.getElementById("btn_submit").disabled = "disabled";

		return true;
	}
</script>