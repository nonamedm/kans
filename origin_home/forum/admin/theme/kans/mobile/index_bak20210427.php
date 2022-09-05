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
					<h2 class="t1 robo">KOREA ACADEMY<br>OF NUCLEAR SATETY</h2>
					<p class="t2"> 
						한국원자력안전아카데미는<br>
						원자력 및 방사선 안전에 관한 이해의 폭을<br>
						넓히기 위하여 노력하고 있습니다. 
					</p>
				</div>
			</div>
			<div class="item mv02">
				<div class="img"></div>
				<div class="mv_slog">
					<h2 class="t1 robo">KOREA ACADEMY<br>OF NUCLEAR SATETY</h2>
					<p class="t2">
						한국원자력안전아카데미는<br>
						원자력 및 방사선 안전에 관한 이해의 폭을<br>
						넓히기 위하여 노력하고 있습니다. 
					</p>
				</div>
			</div>
			<div class="item mv03">
				<div class="img"></div>
				<div class="mv_slog">
					<h2 class="t1 robo">KOREA ACADEMY<br>OF NUCLEAR SATETY</h2>
					<p class="t2">
						한국원자력안전아카데미는<br>
						원자력 및 방사선 안전에 관한 이해의 폭을<br>
						넓히기 위하여 노력하고 있습니다. 
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
				<a href="<?=$s1_1_1_4_url;?>">
					<figure>
						<img src="<? echo G5_THEME_URL ?>/images/main/mcnt1_4.png" />
						<img src="<? echo G5_THEME_URL ?>/images/main/mcnt1_4_h.png" />
					</figure>
					<h4><?=$s1_1_1_4_name;?></h4>
				</a>
			</li>
			<li>
				<a href="<?=$s1_1_2_2_url;?>">
					<figure>
						<img src="<? echo G5_THEME_URL ?>/images/main/mcnt1_5.png" />
						<img src="<? echo G5_THEME_URL ?>/images/main/mcnt1_5_h.png" />
					</figure>
					<h4>전문/단기<br>강좌</h4>
				</a>
			</li>
			<li>
				<a href="<?=$s1_1_1_3_url;?>">
					<figure>
						<img src="<? echo G5_THEME_URL ?>/images/main/mcnt1_6.png" />
						<img src="<? echo G5_THEME_URL ?>/images/main/mcnt1_6_h.png" />
					</figure>
					<h4><?=$s1_1_1_3_name;?></h4>
				</a>
			</li>
		</ul>
		<ol>
			<li onclick="javascript:alert('준비중인 페이지입니다.')"><a href="#n"><h4><?=$s1_2_1_1_name;?></h4></a></li>
			<li onclick="javascript:alert('준비중인 페이지입니다.')"><a href="#n"><h4><?=$s1_2_1_3_name;?><!-- 수료증<br>발급 --></h4></a></li>
			<li onclick="javascript:alert('준비중인 페이지입니다.')"><a href="#n"><h4><?=$s1_2_1_6_name;?><!-- 전자계산서<br>발급 --></h4></a></li>
		</ol>
	</article>
</section>

<div class="mcnt_box ct1 clear">
	<div class="mcnt1">
		<ul class="mc1_tab">
			<li class="on">교육공지</li>
			<li>일반공지</li>
			<li>채용정보</li>
			<li>자료실</li>
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

	<div class="mcnt2 clear">
		<div class="lbx">
			<ul>
				<li class="robo">
					<span>TEL</span>
					<h4>02.554.7330</h4>
				</li>
				<li class="robo">
					<span>FAX</span>
					<h4>02.508.7941</h4>
				</li>
			</ul>
			<ol>
				<li>
					<h5>업무시간</h5>
					<p>09:00 ~18:00</p>
				</li>
				<li>
					<h5>점심시간</h5>
					<p>12:00 ~13:00</p>
				</li>
			</ol>
			<dl>
				<dt>주말&middot;공휴일 휴무</dt>
				<dd>
					<a href="<?=$s2_5_url;?>" class="faq_link">자주묻는 질문<span class="robo">FAQ</span></a>
				</dd>
			</dl>
		</div>
		<div class="rbx">
			<h3>무료제공<br>교육콘텐츠</h3>
			<ul>
				<li>
					<a href="<?=$s3_1_1_url;?>">
						<figure><img src="<? echo G5_THEME_URL ?>/images/main/mcnt2_5.png" /></figure>
						<figcaption>일반인</figcaption>
					</a>
				</li>
				<li>
					<a href="<?=$s3_2_1_url;?>">
						<figure><img src="<? echo G5_THEME_URL ?>/images/main/mcnt2_6.png" /></figure>
						<figcaption>전문가</figcaption>
					</a>
				</li>
			</ul>
		</div>
	</div>	
</div>
<div class="mcnt3_wrap">
	<div class="mcnt3 ct1">
		<div id="slick_slider" >
			<div class="item_box item_box1"><a href=""><img src="<? echo G5_THEME_URL ?>/images/main/mcnt3_1.jpg" /></a></div>
			<div class="item_box item_box2"><a href=""><img src="<? echo G5_THEME_URL ?>/images/main/mcnt3_2.jpg" /></a></div>
			<div class="item_box item_box3"><a href=""><img src="<? echo G5_THEME_URL ?>/images/main/mcnt3_3.jpg" /></a></div>
			<div class="item_box item_box4"><a href=""><img src="<? echo G5_THEME_URL ?>/images/main/mcnt3_4.jpg" /></a></div>
			<div class="item_box item_box5"><a href=""><img src="<? echo G5_THEME_URL ?>/images/main/mcnt3_5.jpg" /></a></div>
			<div class="item_box item_box1"><a href=""><img src="<? echo G5_THEME_URL ?>/images/main/mcnt3_1.jpg" /></a></div>
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