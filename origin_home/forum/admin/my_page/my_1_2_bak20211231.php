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
?>

<section class="s<?=$cate_num;?> s<?=$cate_num;?>0<?=$page_num;?> my_page_new clear ct2">
	<article class="arti1">
		<ul class="smb_my_act">
			<li><a href="http://www.kans.re.kr/cal/cal_write1.php" class="btn02" style="background: #0094dc; border: 1px solid #0094dc;">단체신청</a></li>
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
				<td><?php echo ($member['mb_tel'] ? $member['mb_tel'] : '미등록'); ?></td>	
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
		<div class="top_bx">
			<p>※ 신청내용 수정은 신청자가 직접 로그인 후 가능합니다</p>
			<ul>
				<li>
					<label for="">교육년도</label>
					<select name="">
						<option value="전체" selected>전체</option>
						<option value="">1</option>
					</select>
				</li>
				<li>
					<label for="">교육명</label>
					<select name="">
						<option value="전체" selected>전체</option>
						<option value="">일반정기</option>
						<option value="">비파괴 정기</option>
						<option value="">일반 신규</option>
						<option value="">비파괴 신규</option>
						<option value="">보수교육</option>
						<option value="">전문교육</option>
						<option value="">기타</option>
					</select>
				</li>
				<li>
					<select name="">
						<option value="50개씩 보기" selected>50개씩 보기</option>
						<option value="100개씩 보기">100개씩 보기</option>
					</select>
				</li>
			</ul>
		</div>
		
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
					<th><input type="checkbox" name=""></th>
					<th>번호</th>
					<th>이름</th>
					<th>생년월일</th>
					<th>핸드폰번호</th>
					<th>교육명</th>
					<th>교육일</th>
					<th>교육시간</th>
					<th>진행상태</th>
					<th>결제상태</th>
					<th>금액</th>
					<th>	수료증 발급</th>
					<th>납부 확인서</th>
					<th>영수증</th>
					<th>무통장 영수증</th>
					<th>비고</th>
				</tr>
				<tr>
					<td><input type="checkbox" name=""></td>
					<td>1</td>
					<td>김이름</td>
					<td>999999-1</td>
					<td>010-9999-9999</td>
					<td>수도권 방사선 안전 관리자 포럼</td>
					<td>2021.09.17</td>
					<td>14:00 ~ 17:00</td>
					<td>교육수료</td>
					<td>결제완료</td>
					<td>30,000원</td>
					<td><a href="">발급받기</a></td>
					<td><a href="">발급받기</a></td>
					<td><a href="">영수증</a></td>
					<td><a href="">영수증</a></td>
					<td></td>
				</tr>
			</table>
		</div>

		<div class="bt_box">
			<span><a href="">수료 공문서 출력</a></span>
			<span><a href="">엑셀 다운로드</a></span>
		</div>
	</article>
</section>

<?php include_once(G5_THEME_PATH.'/tail.php'); ?>