<?php

include_once "../common.php";
include_once G5_MANAGE_INCLUDE_PATH . "/admin.head.sub.php";	//html 기본정보

// $url = $_GET['url'];
$url = "https://www.kans.re.kr/origin_home/safety";

// url 체크
check_url_host($url);

// 이미 로그인 중이라면
if ($is_member) {
	if ($url)
		goto_url($url);
	else
		goto_url(G5_URL);
}

$login_url        = login_url($url);
$login_action_url = G5_HTTPS_BBS_URL."/login_check.php";

?>

<div id="wrap">
	<form method="post" name="flogin" action="<?php echo $login_action_url ?>" onsubmit="return flogin_submit(this);">
		<input type="hidden" name="url" value="<?php echo $login_url ?>" />

		<div class="login_box">
			<input type="hidden" name="url" value="<?php echo $login_url ?>" />
			<div class="login_cnt">
				<strong>RASA 로그인</strong>
				<!-- <a href="http://inpiad.com" target="_blank" class="link">계정정보를 잊으셨다면 인피아드 고객센터로 연락 바랍니다.</a> -->
				<ul class="login_obj">
					<li>
						<span class="head">아이디</span>
						<input type="text" id="mb_id" name="mb_id" value="" placeholder="User ID" />
						<input type="hidden" id="mb_10" name="mb_10" value="" placeholder="Push ID" />
					</li>
					<li>
						<span class="head">패스워드</span>
						<input type="password" id="mb_password" name="mb_password" value="" placeholder="Password" />
					</li>
				</ul>
				<input type="image" src="./share/images/btn_login.gif"  class="btn_login" />
			</div>
			<p class="copy"><img src="./share/images/copy.gif" alt="" /></p>
		</div>
	</form>
</div>


<script type="text/javascript" >

	$(function(){
		setTimeout(function(){
			webkit.messageHandlers.cordova_iab.postMessage(JSON.stringify({"action": "getpushid","callback": "get_pushid"}));
		},500);

		$("#login_auto_login").click(function(){
			if (this.checked) {
				this.checked = confirm("자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.\n\n공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?");
			}
		});

		$("#mb_id").focus();
	});

	function flogin_submit(f)
	{
		return true;
	}

	function get_pushid(pushid) {
		console.log(pushid);  //푸시아이디 확인(테스트용)
		$("#mb_10").val(pushid);
	}
</script>

<?php

include_once G5_MANAGE_INCLUDE_PATH . "/admin.tail.sub.php";

?>