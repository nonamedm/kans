<?php
	if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

	$admin = get_admin("super");

	// 사용자 화면 우측과 하단을 담당하는 페이지입니다.
	// 우측, 하단 화면을 꾸미려면 이 파일을 수정합니다.
?>
<!-- 컨텐츠 : 시작 -->
<?php if($screen_div=="sub"){?>
		</section>
	</section>
<?php }else{?>
<?php }?>
<footer id="footer">
	<div class="footer_inner">
		<p class="">
			<span>상호 : (주)대성아이앤지</span>
			<span>대표 : 김창준</span>
			<span>사업자등록번호 : 143-81-20976</span>
		</p>
		<p class="">
			<span>주소 : [186-23] 경기 화성시 향남읍 발안공단로 3길 39(구문천리)</span>
			<span>TEL : 031-352-8316</span>
			<span>FAX : 031-352-8318</span>
		</p>
		<p class="">
			<span>Copyright &copy; (주)대성아이앤지. All rights reserved.</span>
			<span>Hosting by (주)인피아드 <a href="http://inpiad.net" target="_blank" class="btn_ims">IMS</a></span>
		</p>
		<ul class="foot_btn">
			<li><a href="#n">개인정보처리방침</a></li>
			<li><a href="#n">이메일주소무단수집거부</a></li>
		</ul>
	</div>
</footer>
<?include_once(G5_THEME_PATH.'/tail.sub.php');?>