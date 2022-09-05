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

	// // 관리자이면서 교육담당자회원(단체)이 아닐 경우
	// if(!$is_admin && $member['mb_level'] < 3){ goto_url("./my_1.php"); }

	$colspan = 17;

	include_once("script.php");

	// // 수료증 공문서 변수
	// $is_offi_doc = false;
?>

<section class="s<?=$cate_num;?> s<?=$cate_num;?>0<?=$page_num;?> my_page_new clear ct2" style="height:700px;">
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
				<th>이름</th>
				<td><?php echo ($member['mb_name'] ? $member['mb_name'] : '미등록'); ?></td>	
				<th>회원번호</th>
				<td><?php echo ($member['mb_no'] ? $member['mb_no'] : '미등록'); ?></td>
			</tr>
			<tr>
				<th>QR코드</th>
				<td><div id="qrImg"></div></td>	
				<!-- <td><?php echo $member['mb_today_login']; ?></td>	 -->
				
			</tr>
			
		</table>
	</article>

</section>
<script>
	 $("#qrImg").qrcode({
		render:"canvas",
		width:100,
		height:100,
		text:"http://kans.re.kr/origin_home/forum/admin/"
	})
</script>
<!-- 수료증 공문서 변수 -->
<!-- <input type="hidden" name="is_offi_doc" id="is_offi_doc" value="<?php echo $is_offi_doc; ?>" /> -->

<?php include_once(G5_THEME_PATH.'/tail.php'); ?>