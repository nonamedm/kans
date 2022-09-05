<?php
   if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

   if(G5_COMMUNITY_USE === false) {
      include_once(G5_THEME_MSHOP_PATH.'/index.php');
      return;
   }
   include_once(G5_THEME_MOBILE_PATH.'/head.php');
?>
<!-- 컨텐츠 : 시작 -->
<section id="wrap" class="main_wrap ct1 clear">
	<article class="mv_sec">
		<div class="owl-carousel owl-theme mv_owl">
			<div class="item mv01">
				<div class="img"></div>
				<div class="mv_slog">
					<h2 class="t1 robo">KOREA ACADEMY<br>OF NUCLEAR SAFETY</h2>
					<p class="t2"> 
						한국원자력안전아카데미는<br>
						원자력안전에 관한 국민 이해 증진을 도모하고<br>
						안전문화확산에 기여하고자 <br>
						노력하고 있습니다.
					</p>
				</div>
			</div>
			<div class="item mv02">
				<div class="img"></div>
				<div class="mv_slog">
					<h2 class="t1 robo">KOREA ACADEMY<br>OF NUCLEAR SAFETY</h2>
					<p class="t2"> 
						한국원자력안전아카데미는<br>
						원자력안전에 관한 국민 이해 증진을 도모하고<br>
						안전문화확산에 기여하고자 <br>
						노력하고 있습니다.
					</p>
				</div>
			</div>
			<div class="item mv03">
				<div class="img"></div>
				<div class="mv_slog">
					<h2 class="t1 robo">KOREA ACADEMY<br>OF NUCLEAR SAFETY</h2>
					<p class="t2"> 
						한국원자력안전아카데미는<br>
						원자력안전에 관한 국민 이해 증진을 도모하고<br>
						안전문화확산에 기여하고자 <br>
						노력하고 있습니다.
					</p>
				</div>
			</div>
		</div>
	</article>

	<article class="mv_right">
		<ul class="clear">
			<li>
				<a href="<?=$s1_1_1_1_url;?>">
					<figure>
						<img src="<? echo G5_THEME_URL ?>/images/main/mcnt1_1.png" />
						<img src="<? echo G5_THEME_URL ?>/images/main/mcnt1_1_h.png" />
					</figure>
					<h4>방사선작업<br>종사자 직장교육</h4>
				</a>
			</li>
			<li>
				<a href="<?=$s1_1_1_2_url;?>">
					<figure>
						<img src="<? echo G5_THEME_URL ?>/images/main/mcnt1_2.png" />
						<img src="<? echo G5_THEME_URL ?>/images/main/mcnt1_2_h.png" />
					</figure>
					<h4><?=$s1_1_1_2_name;?></h4>
				</a>
			</li>
			<li>
				<a href="<?=$s1_1_2_3_url;?>">
					<figure>
						<img src="<? echo G5_THEME_URL ?>/images/main/mcnt1_3.png" />
						<img src="<? echo G5_THEME_URL ?>/images/main/mcnt1_3_h.png" />
					</figure>
					<h4><?=$s1_1_2_3_name;?></h4>
				</a>
			</li>


			<li>
				<?php if($is_member){ ?>
				<script type="text/javascript">

					/*
					 스크립트 양식은 변경하시면 안됩니다.
					 굳이 변경이 필요하시면 넘겨주는 변수를
					 encodeURIComponent() 함수에 변수를 넣어서
					 넘겨주시기 바랍니다.

					*/
					function ssoFormSubmit(){
						var f = document.ssoForm;

						var userid = encodeURIComponent(f.puserId.value);
						var passwd = encodeURIComponent(f.puserPw.value);
						var ssoCd = encodeURIComponent(f.pssoCode.value);

						// base64 d
						passwd = btoa(passwd);

						f.userId.value = userid;
						f.passwd.value = passwd;
						f.ssoCd.value = ssoCd;
						f.action = "https://www.kanselearning.kr/mediopia/ssoAutoLogin";
						f.submit();
					}
				</script>
				<a href="javascript:ssoFormSubmit();">
				<form name="ssoForm" method="post">
					<input type="hidden" name="puserId" value="<?php echo $member["mb_id"]; ?>"><!-- 회원 ID --><!-- 필수입력 -->
					<input type="hidden" name="puserPw" value="<?php echo $member["mb_password"]; ?>"><!-- 회원 비밀번호 --><!-- 필수입력 -->
					<input type="hidden" name="pssoCode" value="OAG33AOUYCQVAMGBZWEL3GZIUGI434W8AXQ"><!-- 회원  SSO코드 --><!-- 필수입력 -->
					
					<!-- 아래 파라미터 명은 변경이 되면 안됩니다. -->
					<input type="hidden" name="userId">
					<input type="hidden" name="passwd">
					<input type="hidden" name="ssoCd">

					<input type="hidden" name="userNm" value="<?php echo $member["mb_name"]; ?>"><!-- 이름 --><!-- 필수입력 -->
					<?php
						$birthday1 = substr($member["mb_3"], 0, 2);
						$birthday2 = substr($member["mb_3"], 2, 2);
						$birthday3 = substr($member["mb_3"], 4, 2);
						$birthday1 = ($member["mb_4"] < 3)?"19".$birthday1:"20".$birthday1;

						$birthday = $birthday1."-".$birthday2."-".$birthday3;
					?>
					<input type="hidden" name="birthday" value="<?php echo $birthday; ?>"><!-- 생년월일 --><!-- 필수입력(YYYY-MM-DD) -->
					<input type="hidden" name="email" value="<?php echo $member["mb_email"]; ?>"><!-- 이메일 --><!-- 필수입력(아이디@메일서버이름) -->
					<input type="hidden" name="phoneMobile" value="<?php echo $member["mb_hp"]; ?>"><!-- 휴대전화 --><!-- 필수입력(xxx-xxxx-xxxx) -->
					<input type="hidden" name="recvSms" value="Y"><!-- SMS 수신 여부 --><!-- Y : SMS 수신, N : 수신안함. 미입력시 수신 안함. -->
					<input type="hidden" name="sexType" value="<?php echo ($member["mb_4"]%2 == 1)?1:2; ?>"><!-- 성별 --><!-- 필수입력 1 : 납자 , 2 : 여자.  미 입력시 남자로 입력. -->
					<input type="hidden" name="compType" value="<?php echo $member["mb_2"]; ?>"><!-- 소속기관 --><!-- 필수입력 -->
					<input type="hidden" name="addItem1" value="<?php echo $member["mb_5"]; ?>"><!-- 방사선사 면허번호 --><!-- 선택입력 -->
				</form>
				<?php } else { ?>
				<!-- 211231 링크수정 -->
				<a href="https://www.kanselearning.kr/userMain/goUserMain?lang=ko" target="_blank">
				<?php } ?>
				<!-- <a href="<?=$s1_1_1_2_new_url;?>"> -->
					<figure>
						<img src="<? echo G5_THEME_URL ?>/images/main/mcnt1_5.png" />
						<img src="<? echo G5_THEME_URL ?>/images/main/mcnt1_5_h.png" />
					</figure>
					<h4>온라인교육</h4>
				</a>
			</li>
			<li>
				<a href="http://kans.re.kr/s1/s1_1_2_1.php">
				<!-- <a href="<?=$s1_1_2_1_url;?>"> -->
					<figure>
						<img src="<? echo G5_THEME_URL ?>/images/main/mcnt1_4.png" />
						<img src="<? echo G5_THEME_URL ?>/images/main/mcnt1_4_h.png" />
					</figure>
					<h4>전문교육</h4>
				</a>
			</li>
			
			<li>
				<a href="<?=$s1_1_1_4_url;?>">
					<figure>
						<img src="<? echo G5_THEME_URL ?>/images/main/mcnt1_6.png" />
						<img src="<? echo G5_THEME_URL ?>/images/main/mcnt1_6_h.png" />
					</figure>
					<h4>방재교육</h4>
				</a>
			</li>
		</ul>
		<ol>
			<li onclick="javascript:alert('준비중인 페이지입니다.')"><a href="#n"><h4><?=$s1_2_1_1_name;?></h4></a></li>
		<!-- 	<li><a href="http://kans3.cafe24.com/admin/auth/login" target="blank"><h4><?=$s1_2_1_3_name;?></h4></a></li> -->
			<li><a href=" http://kans3.cafe24.com/auth/login " target="blank"><h4><?=$s1_2_1_3_name;?></h4></a></li>
			<li onclick="javascript:alert('준비중인 페이지입니다.')"><a href="#n"><h4><?=$s1_2_1_6_name;?><!-- 전자계산서<br>발급 --></h4></a></li>
		</ol>
	</article>
</section>

<div class="mcnt_box ct1 clear">
	<div class="mcnt1">
		<ul class="mc1_tab">
			<li class="on">교육공지
				<a href="<?=$s2_1_url;?>"></a>
			</li>
			<li>일반공지
				<a href="<?=$s2_2_url;?>"></a>
			</li>
			<li>채용정보
				<a href="<?=$s2_4_url;?>"></a>
			</li>
			<li>자료실
				<a href="<?=$s2_3_url;?>"></a>
			</li>
		</ul>

		<div class="tab_con_box">
			<ul class="cnt cnt1 on">
				<?php echo latest('theme/main_basic', 's2_1', 3, 30); ?>
			</ul>
			<ul class="cnt cnt2">
				<?php echo latest('theme/main_basic', 's2_2', 3, 30); ?>
			</ul>
			<ul class="cnt cnt3">
				<?php echo latest('theme/main_basic', 's2_4', 3, 30); ?>
			</ul>
			<ul class="cnt cnt4">
				<?php echo latest('theme/main_basic', 's2_3', 3, 30); ?>
			</ul>
		</div>
	</div>

	<div class="mcnt2_new_i clear">
		<div class="lbx">
			<h3>연락처</h3>
			<div class="gr_b">
				<ul>
					<li>
						 <span style="letter-spacing: 0.35em;">교육비</span>
						<p class="robo">02.554.7331</p>
					</li>
					<li>
					<span>직장교육</span> 
						<p class="robo">070.4821.3925</p>
					</li>
					<li>
						<span>보수교육</span> 
						<p class="robo">02.554.7330</p>
					</li>
					<li>
						<span>통신교육</span>
						<p class="robo">02.554.7331</p>
					</li>
					<li>
						 <span>전문교육</span>
						<p class="robo">070.4821.3926</p>
					</li>
				<!-- 	<li>
						<span>회원관리</span>
						<p class="robo">02.554.7330</p>
					</li>
					<li>
						<span>대관문의</span>
						<p class="robo">070.4821.3926</p>
					</li> -->
				</ul>
				<a href="<?=$s2_5_url;?>" class="faq_link">자주묻는 질문<span class="robo">FAQ</span></a>
			</div>
		</div>
		<div class="rbx">
			<h3>무료 콘텐츠</h3>
			<div class="gr_b">
				<ul>
					<li>
						<a href="<?=$s3_1_1_url;?>">
							<figure><img src="<? echo G5_THEME_URL ?>/images/main/bg_type_n11.png" /></figure>
							<figcaption>일반인</figcaption>
						</a>
					</li>
					<li>
						<a href="<?=$s3_2_1_url;?>">
							<figure><img src="<? echo G5_THEME_URL ?>/images/main/bg_type_n22.png" /></figure>
							<figcaption>원자력전문인력양성</figcaption>
						</a>
					</li>
					<li>
						<a href="http://kans.re.kr/origin_home/safety/index.html ">
							<figure><img src="<? echo G5_THEME_URL ?>/images/main/bg_type_n33.png" /></figure>
							<figcaption>안전관리자 포럼</figcaption>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>	
	<!-- <div class="mcnt2 clear">
		<div class="lbx">
			<ul>
				<li class="robo">
					<span>교육비</span>
					<h4>02.554.7331</h4>
				</li>
				<li class="robo">
					<span>직장교육</span>
					<h4>070.4821.3925</h4>
				</li>
				<li class="robo">
					<span>보수교육 <br>회원관리</span>
					<h4>02.554.7330</h4>
				</li>
				<li class="robo">
					<span>통신교육</span>
					<h4>02.554.7331</h4>
				</li>
				<li class="robo">
					<span>전문 / 단기 / 대관</span>
					<h4>070.4821.3926</h4>
				</li>
			</ul>
			<dl>
				<dd>
					<a href="<?=$s2_5_url;?>" class="faq_link">자주묻는 질문<span class="robo">FAQ</span></a>
				</dd>
			</dl>
		</div>
		<div class="rbx">
			<h3>무료 콘텐츠</h3>
			<ul>
				<li>
					<a href="<?=$s3_1_1_url;?>">
						<figure><img src="<? echo G5_THEME_URL ?>/images/main/bg_type_n11.png" /></figure>
						<figcaption>일반인</figcaption>
					</a>
				</li>
				<li>
					<a href="<?=$s3_2_1_url;?>">
						<figure><img src="<? echo G5_THEME_URL ?>/images/main/bg_type_n22.png" /></figure>
						<figcaption>전문가</figcaption>
					</a>
				</li>
				<li>
					<a href="http://kans.re.kr/origin_home/safety/index.html ">
						<figure><img src="<? echo G5_THEME_URL ?>/images/main/bg_type_n33.png" /></figure>
						<figcaption>안전관리자 포럼</figcaption>
					</a>
				</li>
			</ul>
		</div>
	</div> -->	
</div>
<div class="mcnt3_wrap">
	<div class="mcnt3 ct1">
		<div id="slick_slider" >
			<?php
			unset($options);
			$options['thumb_width'] = 200;
			$options['thumb_height'] = 50;
			echo latest('theme/main_bottom_banner', 'bottom_banner', 10, 2, 1, $options); ?>
		</div>
	</div>
</div>

<script>
	$(function(){
		// Main Visual
		var Mv_owl = $(".mv_owl").owlCarousel({
			animateIn : 'fadeIn',
			animateOut : 'fadeOut',
			items : 1,
			loop : false,
			margin : 0,
			autoplay : false,
			autoplayTimeout : 8000,
			//autoplayHoverPause : true,
			dots : false,
			nav : false,
			mouseDrag:false
		});	
	});

	$(function(){
		$('#slick_slider').slick({
			infinite: true,
			slidesToShow: 5,
			autoplay: true,
			slidesToScroll: 1,
			cssEase: 'linear',
			speed: 4000,
			autoplaySpeed:0,
			prevArrow : "<button type='button' class='slick-prev'></button>",		// 이전 화살표 모양 설정
			nextArrow : "<button type='button' class='slick-next'></button>"	// 다음 화살표 모양 설정
		});
	});

	
</script>


<!-- 컨텐츠 : 종료 -->
<?php include_once(G5_THEME_MOBILE_PATH.'/tail.php'); ?>