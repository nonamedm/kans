<?
	include_once('./_common.php');
	include_once(G5_THEME_PATH.'/head.sub.php');
	
	if(!$is_member){ alert_close("올바른 방법으로 이용해주세요."); }
	
	// 수신(=대표자)
	$representative = "";
	
	// 개인회원일 경우
	if($member["mb_level"] == "2"){
		if($member['mb_2']){ $representative = "{$member['mb_2']} 대표자"; }
		else{ $representative = "-"; }
	}
	// 단체회원일 경우
	// else if($member["mb_level"] == "3"){ $representative = "{$member['mb_2']} {$member['mb_nick']}"; }
	else if($member["mb_level"] == "3"){ $representative = "{$member['mb_2']} 대표자"; } // 20220902 메신저로 요청

	$year = date("y");
	$date = date("Y. m. d.");
	$text = "원아카 {$year}-전자공문 (시행일 {$date})";
?>

<div class="my_print_wrap">
	<div class="my_print">
		<div class="my_print_hd">
			<img src="<? echo G5_URL ?>/my_page/img/pop3_1.jpg" alt="">
			<ul>
				<li>
					<span>수 신</span>
					<p><?php echo $representative; ?></p>
				</li>
				<li>
					<span>(경 유)</span>
					<p>방사선안전관리자(교육담당자)</p>
				</li>
				<li>
					<span>제 목</span>
					<p>방사선안전교육 수료 확인</p>
				</li>
			</ul>
		</div>
		<div class="my_print_cnt">
			<ul>
				<li><span>1)</span>귀 기관의 무궁한 발전을 기원합니다.</li>
				<li><span>2)</span>우리 아카데미에서 원자력안전법 제 106조에 따라 실시한 방사선안전교육의 수료자를 붙임과 같이 확인합니다.</li>
			</ul>
			<p>붙임 : 수료증 1부. 끝.</p>
			<figure><img src="<? echo G5_URL ?>/my_page/img/pop3_2.jpg" alt=""></figure>
		</div>
		<div class="my_print_bottom">
			<div class="col2_flex">
				<ul>
					<li>
						<span>담당</span>
						<p>교육담당자</p>
					</li>
					<li>
						<span>협조자</span>
						<p></p>
					</li>
					<li>
						<span>시행</span>
						<p><?php echo $text; ?></p>
					</li>
					<li>
						<span>(우)05719</span>
						<p>서울특별시 송파구 송파대로 260, 제일오피스텔 516-2호 </p>
					</li>
				</ul>	
				<ul>
					<li>
						<span>전결</span>
						<p></p>
					</li>
					<li>
						<span>사무국장</span>
						<p>최윤석</p>
					</li>
					<li>
						<span>접수</span>
						<p>(　　　　　　　)</p>
					</li>
					<li>
						<span>홈페이지</span>
						<p>www.kans.re.kr</p>
					</li>
				</ul>
			</div>
			<ul class="last_ul_box">
				<li>
					<span>전화</span> 
					<p>(02) 554-7330</p>
				</li>
				<li>
					<span>팩스</span>
					<p>(02) 508-7941</p>
				</li>
				<li>
					<span>이메일</span>
					<p>kans@kans.re.kr</p>
				</li>
				<li>
					<span>공개</span>
					<p></p>
				</li>
			</ul>
		</div>
	</div>
</div>

<style>

	@font-face {
    font-family: 'GyeonggiBatang';
    src: url('https://cdn.jsdelivr.net/gh/projectnoonnu/noonfonts_one@1.0/GyeonggiBatang.woff') format('woff');
    font-weight: normal;
    font-style: normal;
	}
	@font-face {
    font-family: 'GyeonggiTitleM';
    src: url('https://cdn.jsdelivr.net/gh/projectnoonnu/noonfonts_one@1.0/GyeonggiTitleM.woff') format('woff');
    font-weight: normal;
    font-style: normal;
}

	.my_print_wrap img{width: auto; max-width:100%;}
	.my_print_wrap{max-width:840px; box-sizing: border-box; padding: 30px; margin: 0 auto;}
	.my_print{height: 970px; border: 1px solid #000;  box-sizing: border-box; padding: 55px 30px 0; }
	.my_print_hd img{max-width: 85%;}
	.my_print_hd ul{margin-top: 50px; padding-bottom: 33px;}
	.my_print_hd ul > li {font-size: 17px; line-height: 30px; color: #333; letter-spacing: -0.03em; display: flex; }
	.my_print_hd ul > li > span{display: block; font-weight: 500; color: #111; width: 60px; text-align: justify; height: 14px;}
	.my_print_hd ul > li > span:after {content: ''; display: inline-block; width: 100%;}
	.my_print_hd ul > li > p{padding-left: 30px; line-height: 28px;}
	.my_print_cnt img{max-width:85%; display: block; margin: 0 auto;}
	.my_print_cnt{border-top: 2px solid #060606; padding-top: 30px; padding-bottom: 30px;}
	.my_print_cnt ul > li{position: relative; font-family: 'GyeonggiBatang'; font-size: 17px; line-height: 30px; color: #666; padding-left: 30px; font-weight: 600;}
	.my_print_cnt ul > li span{position: absolute; left: 0; top: 0;}
	.my_print_cnt p{font-family: 'GyeonggiBatang'; font-size: 17px; line-height: 30px; color: #666; font-weight: 600; margin-top: 30px ; margin-bottom: 80px;}
	.my_print_bottom{position: relative; padding-top: 50px;}
	.my_print_bottom:after{position: absolute; content: ''; width: 100%; height: 10px; background: url('img/pop3_3.jpg') center left; left: 0; top: 0;background-size:cover;}
	.my_print_bottom .col2_flex{display: flex; justify-content}
	.my_print_bottom .col2_flex ul:first-of-type{width: 460px;}
	.my_print_bottom .col2_flex ul:last-of-type{width: 250px; padding-left: 10px;}
	.my_print_bottom ul > li{font-family: 'GyeonggiBatang'; font-size: 16px; line-height: 30px; color: #666; font-weight: 600; display: flex;}
	.my_print_bottom ul > li span{font-family: 'GyeonggiTitleM'; display: block; color: #505050; font-weight: 600; width: 90px;}
	.my_print_bottom ul > li p{width: calc(100% - 90px);}
	.my_print_bottom .col2_flex ul:last-of-type > li p{width: 140px;} 

	.my_print_bottom .last_ul_box {display: flex; margin-top: 20px; flex-wrap:wrap;}
	.my_print_bottom .last_ul_box > li{ position: relative; width: 25%; font-size: 14px !important;} 
/* 	.my_print_bottom .last_ul_box > li:after{position: absolute; content: '/'; right: 20px; top: 0;} */
	.my_print_bottom .last_ul_box > li > span{width: 41px; padding-right: 0px; }
	.my_print_bottom .last_ul_box > li:not(:nth-child(3)) > span{width: 28px;}
	.my_print_bottom .last_ul_box > li:not(:nth-child(3)) > p{width: calc(100% - 28px);}
	.my_print_bottom .last_ul_box > li p{width: calc(100% - 41px);}
	body{min-width:0px !important; }
	
	/* .my_print .my_print_hd .print_num{font-size: 18px; line-height: 1; color: #454545; letter-spacing: -0.03em;}
	.my_print .my_print_hd .my_print_tit{font-family: 'GyeonggiBatang'; font-size: 50px; line-height: 1; font-weight: 700; color: #111; text-align: center; margin-top: 87px; margin-bottom: 83px; letter-spacing: 0;}
	.my_print .my_print_cnt ul > li{display: flex; line-height: 22px; align-items: flex-start;}
	.my_print .my_print_cnt ul > li h6{width: 80px; display: inline-block; font-size: 16px; color: #111; font-weight: 500; }
	.my_print .my_print_cnt ul > li h6 span{display: inline-table; font-size: 16px; color: #111; font-weight: 500; text-align: justify; width: 57px; letter-spacing: -0.03em; line-height: 1; margin-right: 10px;}
	.my_print .my_print_cnt ul > li h6 span:after{content: ''; display: inline-block;	width: 100%;}
	.my_print .my_print_cnt ul > li p{font-size: 16px; color: #666; padding-left: 10px;}
	.my_print .my_print_cnt ul > li > .day_box{width: calc(100% - 73px); display: flex; }
	.my_print .my_print_cnt ul > li > .day_box b{font-size: 16px; font-weight: 500; color: #014693;}
	.my_print .text_area {text-align: center;}
	.my_print .text_area p{font-size: 16px; line-height: 32px; letter-spacing: -0.03em; color: #111; margin: 94px 0 111px;}
	.my_print .text_area h4{font-size: 18px; line-height: 1; color: #111; letter-spacing: -0.03em; font-weight: 400; margin-bottom: 51px;}
	.my_print  .sign{text-align: right; padding-right: 23px;} */

</style>

