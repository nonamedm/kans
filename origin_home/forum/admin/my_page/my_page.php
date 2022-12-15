<?
	include_once('./_common.php');
	add_stylesheet('<link rel="stylesheet" href="https://www.kans.re.kr/theme/kans/mobile/skin/board/wt_comment/style.css">', 0);

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

	$colspan = 17;

	include_once("script.php");

?>

<div class="head_color" style="background: #014594;">
    <h1 class="head_text"><?php echo "마이페이지" ?></h1>
	<img class="head_img" src="http://www.kans.re.kr/img/마이페이지.png" title="search">
</div>

<section class="s<?=$cate_num;?> s<?=$cate_num;?>0<?=$page_num;?> my_page_new clear ct2" style="height:700px;">
	<article class="arti1">
		

		<table class="my_info" >
			<tr>
				<th>이름</th>
				<td><?php echo ($member['mb_name'] ? $member['mb_name'] : '미등록'); ?></td>	
			</tr>
			<tr>
				<th>회원등급</th>
				<td><?php echo ($member['mb_level'] ? $member['mb_level'] : '미등록'); ?></td>
			</tr>
			<tr>
				<th>QR코드</th>
				<td><div id="qrImg"></div></td>	
				<!-- <td><?php echo $member['mb_today_login']; ?></td>	 -->
				
			</tr>
			
		</table>
	</article>

</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.qrcode/1.0/jquery.qrcode.min.js" integrity="sha512-NFUcDlm4V+a2sjPX7gREIXgCSFja9cHtKPOL1zj6QhnE0vcY695MODehqkaGYTLyL2wxe/wtr4Z49SvqXq12UQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
	<?php
    if ($_SESSION['ss_mb_id']) { // 로그인중이라면
    	$member = get_member($_SESSION['ss_mb_id']);
    }
	
	?>
	
	var user_id = "<?php echo ($member['mb_id'] ? $member['mb_id'] : '미등록'); ?>";
	var user_name = "<?php echo ($member['mb_name'] ? $member['mb_name'] : '미등록'); ?>";
	 $("#qrImg").qrcode({
		render:"canvas",
		width:100,
		height:100,
		text:"https://www.kans.re.kr/origin_home/forum/admin/admin/my_page_qr.php?userId="+user_id+"&userName="+user_name // qr코드 찍었을때 이동하는 페이지 url
	});
</script>

<?php include_once(G5_THEME_PATH.'/tail.php'); ?>