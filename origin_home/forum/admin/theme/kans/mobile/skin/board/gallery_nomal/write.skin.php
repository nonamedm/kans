<?php
	if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

	// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
	add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<section id="bo_w" class="respon_w">
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

		<?if($w==''){?>
			<article class="privacy_area"><!-- 개인정보취급방침 동의 -->
				<h2>개인정보취급방침 동의</h2>
				<textarea rows="" cols="" class="privacy_box"><?php echo get_text($config['cf_privacy']) ?></textarea>
				<div class="agreen_box">
					<input type="radio" id="" name="prev" value="1" />
					<label for="">동의함</label>
					<input type="radio" id="" name="prev" />
					<label for="">동의안함</label>
				</div>
			</article>
		<?}?>

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

		<article class="res_w">
			<p class="ment">
				<span class="red">(*)</span>표시는 필수입력사항 입니다.
			</p>
			<div class="div_tb">
				<?php if ($is_name) { ?>
					<div class="div_tb_tr">
						<div class="div_th">
							<label for="wr_name">작성자 <strong class="sound_only">필수</strong><span class="red">(*)</span></label>
						</div>
						<div class="div_td">
							<input type="text" name="wr_name" value="<?php echo $name ?>" id="wr_name" class="" />
						</div>
					</div>
				<?php } ?>
				<? $is_password = false; ?>
				<?php if ($is_password) { ?>
					<div class="div_tb_tr">
						<div class="div_th">
							<label for="wr_password">비밀번호 <strong class="sound_only">필수</strong><span class="red">(*)</span></label>
						</div>
						<div class="div_td">
							<input type="password" name="wr_password" id="wr_password"  class="" />
						</div>
					</div>
				<?php } ?>
				<?php if ($bo_table=="s4_1") { ?>

				<div class="div_tb_tr">
					<div class="div_th">
						<label for="">연락처 <strong class="sound_only">필수</strong><span class="red">(*)</span></label>
					</div>
					<div class="div_td">
						<ul class="layout_tel">
							<input type="hidden" name="wr_2" value="<?=$write[wr_2]?>" />
							<li class="">
								<?$wr_2_=explode("-",$write[wr_2]);?>
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
								$("#mb_tel1 option[value='<?=$wr_2_[0]?>']").prop("selected", "true");
								</script>
							</li>
							<li class=""><input type="text" id="mb_tel2" name="mb_tel2" class="frm_input" maxlength="4" value="<?=$wr_2_[1]?>"/></li>
							<li class=""><input type="text" id="mb_tel3" name="mb_tel3" class="frm_input maxlength="4" value="<?=$wr_2_[2]?>" /></li>
						</ul>
					</div>
				</div>
				<? } ?>
				<?php if ($is_email) { ?>
					<div class="div_tb_tr">
						<div class="div_th">
							<label for="wr_email">이메일 <strong class="sound_only">필수</strong><span class="red">(*)</span></label>
						</div>
						<div class="div_td">
							<ul class="layout_email">
							<input type="hidden" name="wr_email" >
							<?$wr_email_=explode("@",$write[wr_email]);?>
								<li class=""><input type="text" id="wr_email1" name="wr_email1" class="" value="<?=$wr_email_[0]?>"></li>
								<li class=""><input type="text" id="wr_email2" name="wr_email2" class="" value="<?=$wr_email_[1]?>" /></li>
								<!--li class=""><input type="text" id="" name="" class="" /></li-->
								<li class="">
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
									</select>

								<script type="text/javascript">
								$("#wr_email3 option[value='<?=$wr_email_[1]?>']").prop("selected", "true");
								</script>


								</li>
							<!--
							<input type="text" name="wr_email" value="<?php echo $email ?>" id="wr_email" class="frm_input email" size="50" maxlength="100">
							-->
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
				<?php if ($is_category) { ?>
					<div class="div_tb_tr">
						<div class="div_th">
							<label for="ca_name">분류<strong class="sound_only">필수</strong></label>
						</div>
						<div class="div_td">
							<select name="ca_name" id="ca_name"  class="required" >
								<option value="">선택하세요</option>
								<?php echo $category_option ?>
							</select>
						</div>
					</div>
				<?php } ?>
				<div class="div_tb_tr">
					<div class="div_th">
						<label for="wr_subject">제목 <strong class="sound_only">필수</strong><span class="red">(*)</span></label>
					</div>
					<div class="div_td">
						<div id="autosave_wrapper">
							<input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject"  class="" size="" maxlength="" />
						</div>
					</div>
				</div>
				<div class="div_tb_tr">
					<div class="div_th">
						<label for="wr_content">내용 <strong class="sound_only">필수</strong><span class="red">(*)</span></label>
					</div>
					<div class="div_td">
						<?php if($write_min || $write_max) { ?><!-- 최소/최대 글자 수 사용 시 -->
							<p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
						<?php } ?>
						<?php echo $editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
						<?php if($write_min || $write_max) { ?><!-- 최소/최대 글자 수 사용 시 -->
							<div id="char_count_wrap"><span id="char_count"></span>글자</div>
						<?php } ?>
					</div>
				</div>
				<?php for ($i=1; $is_link && $i<=G5_LINK_COUNT; $i++) { ?>
					<div class="div_tb_tr">
						<div class="div_th">
							<label for="wr_link<?php echo $i ?>">링크 #<?php echo $i ?></label>
						</div>
						<div class="div_td">
							<input type="text" name="wr_link<?php echo $i ?>" value="<?php if($w=="u"){echo$write['wr_link'.$i];} ?>" id="wr_link<?php echo $i ?>" class="frm_input" size="50">
						</div>
					</div>
				<?php } ?>
				<?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>
					<div class="div_tb_tr">
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
		</article>

		<div class="btn_confirm">
			<input type="submit" value="작성완료" id="btn_submit" class="" accesskey="s">
			<a href="./board.php?bo_table=<?php echo $bo_table ?>" class="">취소</a>
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

		//라디오 박스 체크여부 판단하기
		<?php if($w == ''){ ?>
		var radio_leng = f.prev.length;
		var chk_value;
		for(var count = 0 ; count < radio_leng ; count ++){
			if(f.prev[count].checked == true){
				chk_value = f.prev[count].value;
			}
		}

		if(chk_value != 1){
			alert("개인정보 수집·이용 등에 대한 동의 선택해주세요.");
			return false;
		}
		<?php } ?>

		if(f.wr_name.value == ""){
			alert("작성자를 입력해 주십시오.");
			f.wr_name.focus();
			return false;
		}
		/*
		if(f.wr_password.value == ""){
			alert("비밀번호를 입력해 주십시오.");
			f.wr_password.focus();
			return false;
		}
		*/
		if(f.wr_email1.value == ""){
			alert("이메일 입력해 주십시오.");
			f.wr_email1.focus();
			return false;
		}

		if(f.wr_email2.value == ""){
			alert("이메일 입력해 주십시오.");
			f.wr_email2.focus();
			return false;
		}

		if(f.wr_subject.value == ""){
			alert("제목을 입력해 주십시오.");
			f.wr_subject.focus();
			return false;
		}

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