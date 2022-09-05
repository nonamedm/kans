<?php
	if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

	$admin = get_admin("super");

	// 사용자 화면 우측과 하단을 담당하는 페이지입니다.
	// 우측, 하단 화면을 꾸미려면 이 파일을 수정합니다.
?>
<?/*
</div><!-- container End -->

<div id="ft">
    <div class="ft_wr">
        <div class="ft_policy">
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=company">회사소개</a> <span class="st_bg"></span>
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=privacy">개인정보취급방침</a> <span class="st_bg"></span>
            <a href="<?php echo G5_BBS_URL; ?>/content.php?co_id=provision">서비스이용약관</a>
        </div>
        <div class="ft_st">
            <h2>INFO</h2>
            <p>
                <span>회사명 : <?php echo $default['de_admin_company_name']; ?></span><span>대표 : <?php echo $default['de_admin_company_owner']; ?></span><br>
                <span>주소 :  <?php echo $default['de_admin_company_addr']; ?></span><br>
                <span>사업자 등록번호  : <?php echo $default['de_admin_company_saupja_no']; ?></span><br>
                <span>전화 :  <?php echo $default['de_admin_company_tel']; ?></span>
                <span>팩스 :  <?php echo $default['de_admin_company_fax']; ?></span><br>
                <!-- <span>운영자 <?php echo $admin['mb_name']; ?></span><br> -->
                <span>통신판매업신고번호 :  <?php echo $default['de_admin_tongsin_no']; ?></span><br>
                <span>개인정보관리책임자 :  <?php echo $default['de_admin_info_name']; ?></span><br>

                <?php if ($default['de_admin_buga_no']) echo '<span>부가통신사업신고번호 :  '.$default['de_admin_buga_no'].'</span>'; ?><br>
            </p>
        </div>
        <div class="ft_st ft_cs">
            <h2>CS CENTER</h2>
            <a href="tel:02-123-1234"><i class="fa fa-phone" aria-hidden="true"></i> 02-123-1234</a>
            <a href="mailto:abc@abc.com" class="mail"><i class="fa fa-envelope" aria-hidden="true"></i> abc@abc.com</a>
            <p>월-금 am 11:00 - pm 05:00<br>점심시간 : am 12:00 - pm 01:00</p>
        </div>
        <div class="ft_st ft_bank">
            <h2>BANK INFO</h2>
            <p>국민은행 : 123456-00-123456<br>예금주: 헝길덩</p>
        </div>
        <div class="ft_st ft_nt">
            <?php
            // 이 함수가 바로 최신글을 추출하는 역할을 합니다.
            // 사용방법 : latest(스킨, 게시판아이디, 출력라인, 글자수);
            // 테마의 스킨을 사용하려면 theme/basic 과 같이 지정
            echo latest("theme/basic", notice, 5, 35);
            ?>
        </div>
        <p class="ft_copy">Copyright &copy; 20016 <?php echo $default['de_admin_company_name']; ?>. All Rights Reserved.</p>

    </div>
     <button type="button" class="scroll-top"><img src="<?php echo G5_THEME_IMG_URL; ?>/top_btn.png" alt="맨위로"></button>
</div>

<script>
$(".scroll-top").click(function(){
     $("body,html").animate({scrollTop:0},400);
})
</script>

<?php
$sec = get_microtime() - $begin_time;
$file = $_SERVER['SCRIPT_NAME'];

if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>

<script src="<?php echo G5_JS_URL; ?>/sns.js"></script>
*/?>

<?include_once(G5_THEME_PATH.'/tail.sub.php');?>