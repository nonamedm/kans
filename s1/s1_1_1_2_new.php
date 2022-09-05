<?
	include_once('./_common.php');

	//화면의 성격
	$user_division = "user";	$screen_div = "sub"; //main, sub	$frame_div = "two";  //one, two

	//카테고리/페이지/상세페이지 명칭 & 카테고리 번호
	$cate_num = "1";		$page_num = "1";		$spage_num = "1";	$sspage_num = "5";  

	//현재 활성화 상태
	$gn_btn = "gn_btn".$cate_num;			$$gn_btn = "current";
	$ln_btn = "ln_btn".$page_num;				$$ln_btn = "current";
	$sln_btn = "sln_btn".$spage_num;			$$sln_btn = "current";
	$ssln_btn = "ssln_btn".$sspage_num;		$$ssln_btn = "current";

	include_once(G5_THEME_PATH.'/head.php');
?>

<section class="s01 s1111 s<?=$cate_num;?>0<?=$page_num;?> s<?=$cate_num;?><?=$page_num;?><?=$spage_num;?><?=$sspage_num;?> clear ct1">
	<!-- <h2 class="tit_bg">방사선작업종사자 직장교육</h2> -->
	<div class="cnt_box">
		<article class="arti1 clear">
			<h3 class="tit_h3">2022년도  온라인 교육  운영 안내</h3>
			<ul class="dot_ul">
				<li>원자력 및 방사선 분야의 일반적 인식 수준은 가장 위험한 분야의 하나로서 높은 안전 의식이 요구되는 만큼 관련 종사자의 법정 안전교육은 사고 예방, 종사자 보호 및<br>
					국민 신뢰 확보를 위하여 온라인 교육을 지양하고 강도 높은 집합교육을 실시해왔습니다.  그러나, 코로나-19 감염병 예방 및 확산을 막기 위하여 외부 접촉과 활동을<br>
					자제하는 언택트 시대에 맞추어 “온라인” 안전 교육을 실시하고 있습니다. 교육생들의 편의를 위해 온라인 교육 전용 사이트를 개설하였습니다.<br>
					PC(브라우저 : 크롬 및 마이크로소프트 엣지) 및 모바일 모두 수강 가능하오니 많은 이용 부탁드립니다.
				</li>
			</ul>
			<!-- <div class="link_box_ty1">
				<a href="http://www.kanselearning.kr/" target="blank" class="link_a" style="width: 280px; margin-top: 43px;">온라인 교육장 바로가기 
					<span><img src="<? echo G5_THEME_URL ?>/images/sub/s1111_2.png" /></span>
				</a>
			</div> -->
		</article>

		<article class="arti3 new_page_arti clear">
		  <h3><b>※온라인 교육 접속 방법 : 회원가입→로그인→ 온라인 교육→ 온라인교육장 입장</h3>
			<img src="http://kans.re.kr/img/online_screen.PNG" /></p><br>
			
			<p>※ 온라인 교육 매뉴얼 숙지 후 교육 신청 부탁드립니다. </b></p>
			<ul class="flex_box">
				<li>
					<a href="http://www.kans.re.kr/board_files/online manual_2022.pdf" target="blank">
						<span class="robo">MANUAL</span>
						<h4>온라인 교육 매뉴얼<br>다운로드 </h4>
					</a>
				</li>
				<li>
					<a href="http://www.kans.re.kr/board_files/단체신청서.xlsx" target="blank">
						<span class="robo">DOCUMENT</span>
						<h4>단체신청서<br>다운로드</h4>
					</a>
				</li>
				<li>
					<a href="http://kans.re.kr/bbs/login.php/" >
						<!-- <span class="robo">CONTACT</span> -->
						<h4 style="">회원가입/로그인</h4>
						<!-- <ol>
							<li class="robo">
								<span>TEL</span>
								02.554.7330
							</li>
							<li class="robo">
								<span>FAX</span>
								02.508.7941
							</li>
						</ol> -->
					</a>
				</li>
			</ul>

			
		</article>

		<article class="arti2 clear">
			<h3 class="tit_h3" style="margin-top: 50px;">결제방법에 따른 교육 안내</h3>
			<figure style="margin-top: 40px;">
				<img src="<? echo G5_THEME_URL ?>/images/sub/21n01.jpg" />
			</figure>
		</article>

		<article class="arti3 new_page_arti clear">
			<h2 class="tit_bg" style="margin-top: 90px;">기존 온라인교육</h2>
		</article>

		<article class="arti4 new_page_arti2 clear">
			<ul class="dot_ul">
				<li>컴퓨터 사용이 어려우신 분들은 기존에 수강했던 방법도 가능합니다.</li>
				<li>교육생의 성실한 수강관리 및 타인 수강 방지 등 조치의 일환으로 교육 신청서와 과제물은 자필 작성이 원칙임을 양해부탁드립니다.</li>
			</ul>

			<table class="table_nomal">
				<colgroup>
					<col width="15%">
				</colgroup>
				<thead>
				<tr>
					<th>구분</th>
					<th>내용</th>
				</tr>
				</thead>
				<tr class="bg2">
					<th>1. 신청서 작성</th>
					<td>
						<table class="table_nomal ">
							<tr class="bg2">
								<th>'프린터'가 <b>없는</b> 경우</th>
								<th>'프린터'가 <b>있는</b> 경우</th>
							</tr>
							<tr>
								<td class="left" >
									 <span style="color:blue">"흰종이(복사용지)"</span> 준비한 후 <br>
									   아래의 9가지 필수 작성 사항을 <span style="color: red;">"자필"</span>로 또박또박 적어주세요. <br><br>

									   ① 제목(<span style="color: red;">온라인 직장교육 신청</span>)<br>
									   ② 교육구분(<span style="color: red;">일반신규, 일반정기, 수시</span>)<br>
									   ③ 교육희망일(<span style="color: red;">2022. 00. 00.</span>)<br>
									   &emsp;※주말인 경우 평일근무시간 내에 신청서가 접수되어야 수강가능<br>
									   ④ 본인소속(<span style="color: red;">000 주식회사</span>)<br>
									   ⑤ 성명(<span style="color: red;">홍길동</span>)<br>
									   ⑥ 주민번호 앞 7자리(<span style="color: red;">790322-1</span>)<br>
									   ⑦ 핸드폰번호(<span style="color: red;">010-1234-1234</span>)<br>
									   ⑧ 정보동의문구(<span style="color: red;">상기 개인정보 제공에 동의합니다</span>)<br>
									   ⑨ 작성일자(<span style="color: red;">2022. 00. 00.</span>)
								</td>
								<td class="left">
									온라인 교육장에서 신청서 출력하여 해당란을 “자필”로 또박또박 작성 <br>

									<span>
										(<img src="<? echo G5_THEME_URL ?>/images/sub/236705_1_1_s.jpg" />
										<a href="http://www.kans.re.kr/online-edu.pdf" target="_blank"><b>신청서 다운로드</b></a>)
									</span>
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr class="bg2">
					<th>2. 신청서 제출방법 <br>※ 3가지 중 택일</th>
					<td class="left">
						① 카카오톡 (작성한 신청서를 스마트폰 사진촬영<br>
							&nbsp;&nbsp;&nbsp;&nbsp;→ 카톡 ‘친구찾기’에서 ‘한국원자력안전아카데미’를 검색하여 ‘친구추가’<br>
							&nbsp;&nbsp;&nbsp;&nbsp;→ 대화창에서 첨부파일로 제출)<br>
						  ② 팩스 (02-508-7941)<br>
						  ③ 메일 (스마트폰 촬영 또는 스캔 파일을 전송 kans@kans.re.kr)
					</td>
				</tr>
				<tr class="bg2">
					<th>3. 수강료 납부방법<br>※ 2가지 중 택일</th>
					<td class="left">
					  1. 계좌이체 : 씨티은행, 102-53627-246, (사)한국원자력안전아카데미 <br>
					  2. 카드결제 : <a href="http://www.kans.re.kr/payment.html" target="_blank"><b>“카드결제 바로가기”</b></a> ← 클릭<br>
					   ※ 계산서 등 증빙자료 필요시 문의처 : 02-554-7330<br>
					   ※ 소속기관측의 별납 경우 등은 협의하여 조치<br><br>

					   ※ 교육별 수강료 내역<br>
						 - 일반분야 : 신규 3만원, 정기 2만5천원<br>
					</td>
				</tr>

				<tr class="bg2">
					<th>4. 교육장 입장 및 수강</th>
					<td class="left">
						- 컴퓨터 또는 스마트 폰 준비 <br>
						- 교육장 입장용 비밀번호 입력 (교육희망일 오전 9시에 수강생 본인의 핸드폰으로 문자 전송됨)<br>
						- 등록되어 있는 교육자료 및 과제물 문제 확인<br>
						- 1강부터 순서대로 수강 (수강가능시간은 00:00-24:00)<br>
						- 영상을 시청하면서 과제물 문제의 답안을 순서대로 작성

						<table class="table_nomal mt30">
							<tr class="bg2">
								<th>'프린터'가 <b>없는</b> 경우</th>
								<th>'프린터'가 <b>있는</b> 경우</th>
							</tr>
							<tr>
								<td class="left" >

									<span style="color:blue">“흰종이(복사용지)”</span> 준비한 후
									  수강 시작 전에 아래의 7번까지 <span style="color: red;">“자필”</span>로 또박또박 적은 후에 그 밑으로 과제물 답을 기재하시면 됩니다. <br><br>

									   ① 제목(<span style="color: red;">온라인 직장교육 과제물</span>)<br>
									   ② 교육구분(<span style="color: red;">일반신규, 일반정기, 수시</span>)<br>
									   ③ 교육 수강일(<span style="color: red;">2022. 00. 00.</span>)<br>
									   ④ 본인소속(<span style="color: red;">000 주식회사</span>)<br>
									   ⑤ 성명(<span style="color: red;">홍길동</span>)<br>
									   ⑥ 주민번호 앞 7자리(<span style="color: red;">790322-1</span>)<br>
									   ⑦ 핸드폰번호(<span style="color: red;">010-1234-1234</span>)<br>
									   ⑧ 이하 과제물 답안 작성 (문제는 안적어도 됨)
								</td>
								<td class="left">
									온라인 교육 페이지에서 “과제물문제” 파일 출력하여 <br>직접 해당란에 “자필”로 또박또박 작성
								</td>
							</tr>
						</table>

						※ 시간이 더 필요하거나 기타 애로사항 발생시 02-554-7330 연락(문의시간 : 평일 09:00~18:00)
					</td>
				</tr>
				<tr class="bg2">
					<th>5. 과제물 제출방법 <br>※ 3가지 중 택일</th>
					<td class="left">
						① 카카오톡(작성한 과제물을 스마트폰 사진촬영 <br>
						&nbsp;&nbsp;&nbsp;&nbsp;→ 카톡에서 ‘한국원자력안전아카데미’를 검색하여 대화창에서 첨부파일로 제출)<br>
						② 팩스 (02-508-7941)<br>
						③ 메일 (스마트폰 촬영 또는 스캔 파일을 전송 kans@kans.re.kr)
					</td>
				</tr>
				<tr class="bg2">
					<th>6. 수료처리 등</th>
					<td class="left">
						- 신청서 자필대조 등 작성내용 확인 후 수료처리<br>
						(요건 충족시 1일 이내 조치, 연휴 경우 다음 첫 근무일에 처리)<br>
						- 수료증 출력: <a href="http://kans3.cafe24.com/admin/auth/login" target="blank" style="color: #333; font-weight: 500;">"수료증 출력 바로가기"</a>← 클릭
					</td>
				</tr>
			</table>

			<!-- <div class="link_box_ty1">
				<a href="http://www.kans.re.kr/edu/edu_on_list.html " target="blank" class="link_a" style="width: 330px; margin-top: 43px;">기존 온라인 교육장 바로가기 
					<span><img src="<? echo G5_THEME_URL ?>/images/sub/s1111_2.png" /></span>
				</a>
			</div> -->


				<div class="form_pass">
					<b>→ 핸드폰 문자로 받으신 온라인 교육 비밀번호를 입력해 주세요.</b>
				
					<div class="cnt">
						<label for="">비밀번호 :</label>
						<!-- <input type="password" name="" placeholder="이곳에 문자로 받으신 번호를 입력하세요!"> -->
						<!-- <a href="/bbs/board.php?bo_table=s1_1_1_2" onclick="alert('비밀번호 입력 후 이동')">Login</a> -->
						<input type="password" name="password" id="password" placeholder="이곳에 문자로 받으신 번호를 입력하세요!">
						<a href="javascript:check_password();">Login</a>
					</div>
				</div>
		</article>	
		
		
	</div>
</section>

<script type="text/javascript">
function check_password(){
	var password = $("#password").val();
	if(password){
		$.ajax({
			type: 'POST',
			url: '<?=G5_BBS_URL ?>/ajax.check_password.php',
			data: {"password": password},
			dataType: "json",
			cache: false,
			async: false,
			success: function(data) {

				alert(data.text);

				if(data.result){ document.location.href = "/bbs/board.php?bo_table=s1_1_1_2"; }
				// else{ alert(data.text); }
			},
			error: function(){
				alert("error");
			}
		});
		
	}else{ alert("비밀번호를 입력해주세요.");	$("#password").focus(); }
}
</script>

<?php include_once(G5_THEME_PATH.'/tail.php'); ?>