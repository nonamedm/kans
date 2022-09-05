<?php
	if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

	// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
	add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
	add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js
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

		<input type="hidden" name="wr_subject" value="">
		<input type="hidden" name="wr_name" value="">

		<?if(!$is_member&&(!$w || $w=="r")){//비회원이고 글작성, 글답변시일때는 동의란이 나오도록 되어있습니다. ?>
			<article class="privacy_area">
				<h2>개인정보취급방침 동의</h2>
				<textarea rows="" readonly cols="" class="privacy_box"><?php echo get_text($config['cf_privacy']) ?></textarea>
				<div class="agreen_box">
					<input type="radio" id="agree_1" name="priv" value="동의" required/>
					<label for="agree_1">동의함</label>
					<input type="radio" id="agree_2" name="priv" value="동의안함" />
					<label for="agree_2">동의안함</label>
				</div>
			</article>
		<?}?>

	<ul class="dot_ul">
		<li>기타 서비스 프로그램(예-숲 생태해설, Edu-클럽 등) 이용을 원하시는 분은 전화문의를 부탁드립니다.</li>
	</ul>
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
		?>

		<article class="res_w mt10">
			<!-- <p class="ment">
				<span class="red">(*)</span>표시는 필수입력사항 입니다.
			</p> -->
			<div class="tb_outline">
				<div class="div_tb">
					<div class="div_tb_tr">
						<div class="div_th"><label for="wr_1">부모이름</label></div>
						<div class="div_td"><input type="text" name="wr_1" value="" id="wr_1" class="" style="width:140px" required/></div>
					</div>
					<div class="div_tb_tr">
						<div class="div_th"><label for="wr_2">자녀이름</label></div>
						<div class="div_td"><input type="text" name="wr_2" value="" id="wr_2" class="" style="width:140px"required/></div>
					</div>
					<div class="div_tb_tr">
						<div class="div_th"><label for="wr_3">생년월일</label></div>
						<div class="div_td">

							<input type="hidden" name="wr_3" id="wr_3" />
							<ul class="check_ty1 af">
								<li><input type="text" name="wr_3_y" value="" id="wr_3_y" class="" style="width:140px" maxlength="4" required/><span>년</span></li>
								<li><input type="text" name="wr_3_m" value="" id="wr_3_m" class="" style="width:80px" maxlength="2" required/><span>월</span></li>
								<li><input type="text" name="wr_3_d" value="" id="wr_3_d" class="" style="width:80px" maxlength="2" required/><span>일</span></li>
								<li>( 
									<b><input type="radio" name="wr_4" id="ch01" value="남" required checked> <label for="ch01">남</label></b>
									<b><input type="radio" name="wr_4" id="ch02" value="여" required> <label for="ch02">여</label></b>
									)
								</li>
								<li>(만 <input type="text" name="wr_5" value="" id="wr_5" class="" style="width:40px" required/> 세)</li>
							</ul>
						</div>
					</div>

					<?php if ($is_email) { ?>
						<div class="div_tb_tr">
							<div class="div_th">
								<label for="wr_email">이메일</label>
							</div>
							<div class="div_td">
								<ul class="layout_email">
								<input type="hidden" name="wr_email" >
								<input type="hidden" name="wr_6" >
								<?$wr_email_=explode("@",$write[wr_email]);?>
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
							
					<div class="div_tb_tr">
						<div class="div_th">
							<label for="">연락처</label>
						</div>
						<div class="div_td">
							<ul class="layout_tel">
								<input type="hidden" name="wr_7" value="<?=$write['wr_7']?>" />
								<li class="" style="width:140px">
									<?$wr_7_=explode("-",$write['wr_7']);?>
									<select id="mb_tel1" name="mb_tel1">
										<option value="02">02</option>
										<option value="031">031</option>
										<option value="032">032</option>
										<option value="033">033</option>
										<option value="041">041</option>
										<option value="042">042</option>
										<option value="043">043</option>
										<option value="051">051</option>
										<option value="052">052</option>
										<option value="053">053</option>
										<option value="054">054</option>
										<option value="055">055</option>
										<option value="061">061</option>
										<option value="062">062</option>
										<option value="063">063</option>
										<option value="064">064</option>
										<option value="070">070</option>
										<option value="010">010</option>
										<option value="011">011</option>
										<option value="016">016</option>
										<option value="017">017</option>
										<option value="018">018</option>
										<option value="019">019</option>
									</select>
									<script type="text/javascript">
									$("#mb_tel1 option[value='<?=$wr_7_[0]?>']").prop("selected", "true");
									</script>
								</li>
								<li class=""style="width:140px"><input type="text" id="mb_tel2" name="mb_tel2" class="frm_input" maxlength="4" value="<?=$wr_7_[1]?>" required /></li>
								<li class=""style="width:140px"><input type="text" id="mb_tel3" name="mb_tel3" class="frm_input" maxlength="4" value="<?=$wr_7_[2]?>" required /></li>
							</ul>
						</div>
					</div>

					<!-- <div class="div_tb_tr">
						<div class="div_th">
							<label for="">휴대폰</label>
						</div>
						<div class="div_td">
							<ul class="layout_tel">
								<input type="hidden" name="wr_2" value="<?=$write[wr_2]?>" />
								<li class="" style="width:140px">
									<?$wr_2_=explode("-",$write[wr_2]);?>
									<select id="mb_tel1" name="mb_tel1">
										<option value="010">010</option>
										<option value="016">016</option>
										<option value="017">017</option>
										<option value="018">018</option>
										<option value="019">019</option>
									</select>
									<script type="text/javascript">
									$("#mb_tel1 option[value='<?=$wr_2_[0]?>']").prop("selected", "true");
									</script>
								</li>
								<li class=""style="width:140px"><input type="text" id="mb_tel2" name="mb_tel2" class="frm_input" maxlength="4" value="<?=$wr_2_[1]?>" required /></li>
								<li class=""style="width:140px"><input type="text" id="mb_tel3" name="mb_tel3" class="frm_input" maxlength="4" value="<?=$wr_2_[2]?>" required /></li>
							</ul>
						</div>
					</div> -->
					<div class="div_tb_tr">
						<div class="div_th"><label for="">주소</label></div>
						<div class="div_td">
							<ul class="check_ty1 af">
								<li><input type="text" name="wr_zip" value="" id="wr_zip" class="" style="width:140px" readonly required/></li>
								<li><a href="#n" class="sch_add" onclick="win_zip('fwrite', 'wr_zip', 'wr_addr1', 'wr_addr2', 'wr_addr3', 'mb_addr_jibeon');">주소검색</a></li>
							</ul>
							<input type="text" name="wr_addr1" value="" id="wr_addr1" class="" style="" required/>
							<input type="text" name="wr_addr2" value="" id="wr_addr2" class="" style="" required/>
							<input type="hidden" name="wr_addr3" value="" id="wr_addr3" class="" style=""/>
							<input type="hidden" name="mb_addr_jibeon" value="" id="mb_addr_jibeon" class="" style=""/>
						</div>
					</div>
					
					<div class="div_tb_tr">
						<div class="div_th"><label for="wr_8">서비스 희망분야</label></div>
						<div class="div_td">
							<ul class="check_ty1 af">
								<?php if($bo_table=="s4_1"){?>
									<li><input type="radio" name="wr_8" id="wr_8a" value="돌봄시터(종일)" required> <label for="wr_8a">돌봄시터(종일)</label></li>
									<li><input type="radio" name="wr_8" id="wr_8b" value="돌봄시터(시간제)" required> <label for="wr_8b">돌봄시터(시간제)</label></li>
								<?php }else{?>
									<li><input type="radio" name="wr_8" id="wr_8a" value="학습매니저" required> <label for="wr_8a">학습매니저</label></li>
									<li><input type="radio" name="wr_8" id="wr_8b" value="학습+돌봄매니저(시간제)" required> <label for="wr_8b">학습+돌봄매니저(시간제)</label></li>
								<?php } ?>							
							</ul>
						</div>
					</div>

					<div class="div_tb_tr">
						<div class="div_th"><label for="wr_content">상세예약정보</label></div>
						<div class="div_td">
							<p>자녀정보, 예약내용, 기타 요구사항(돌봄시터 및 학습매니저 요구사항)들을 입력하세요.</p>
							<textarea name="wr_content" id="wr_content" rows="" cols="" required></textarea>
						</div>
					</div>

					<div class="div_tb_tr">
						<div class="div_th"><label for="wr_9">알게 된 경로 </label></div>
						<div class="div_td">
							<ul class="check_ty1 af">
								<li><input type="radio" name="wr_9" id="wr_9a" value="공공기관(강남구청 등)" required> <label for="wr_9a">공공기관(강남구청 등)</label></li>
								<li><input type="radio" name="wr_9" id="wr_9b" value="기관 홈페이지(서울강남시니어클럽)" required> <label for="wr_9b">기관 홈페이지(서울강남시니어클럽)</label></li>
								<li><input type="radio" name="wr_9" id="wr_9c" value="본 사업단 홈페이지" required> <label for="wr_9c">본 사업단 홈페이지</label></li>
								<li><input type="radio" name="wr_9" id="wr_9d" value="보육 사이트" required> <label for="wr_9d">보육 사이트</label></li>
								<li><input type="radio" name="wr_9" id="wr_9e" value="지인소개" required> <label for="wr_9e">지인소개</label></li>
								<li><input type="radio" name="wr_9" id="wr_9f" value="홍보물" required> <label for="wr_9f">홍보물</label></li>
								<li><input type="radio" name="wr_9" id="wr_9g" value="일간지 및 지역신문" required> <label for="wr_9g">일간지 및 지역신문</label></li>
<!-- 추가된 검색사이트 외 노출홍보 -->
								<li><input type="radio" name="wr_9" id="wr_9h" value="검색사이트 외 노출 홍보" required> <label for="wr_9h">검색사이트 외 노출 홍보</label></li>
								<li><input type="radio" name="wr_9" id="wr_9i" value="기타" required> <label for="wr_9i">기타</label></li>

							</ul>
						</div>
					</div>

					<?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>
						<div class="div_tb_tr fileb">
							<div class="div_th">
								파일 #<?php echo $i+1 ?>
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

		<div class="btn_confirm">
			<input type="submit" value="신청" id="btn_submit" class="" accesskey="s">
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

		f.wr_subject.value = f.wr_1.value + "님의 신청";
		f.wr_name.value = f.wr_1.value;
		
		// 생년월일 월, 일
		var temp_m = f.wr_3_m.value;
		var temp_d = f.wr_3_d.value;
		
		// 생년월일 월, 일 처리
		if(temp_m.length < 2){ temp_m.length = '0' + temp_m.length; }
		if(temp_d.length < 2){ temp_d.length = '0' + temp_d.length; }

		f.wr_3.value = f.wr_3_y.value + "-" + temp_m + "-" + temp_d;
		
		f.wr_6.value = f.wr_email1.value+"@"+f.wr_email2.value;
		f.wr_email.value = f.wr_email1.value+"@"+f.wr_email2.value;

		f.wr_7.value = f.mb_tel1.value + "-" + f.mb_tel2.value + "-" + f.mb_tel3.value;


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
		
		<?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>
		
		document.getElementById("btn_submit").disabled = "disabled";

		return true;
	}
</script>