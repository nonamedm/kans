<?
	include_once('./_common.php');

	//화면의 성격
	$user_division = "user";	$screen_div = "sub"; //main, sub	$frame_div = "two";  //one, two

	//카테고리/페이지/상세페이지 명칭 & 카테고리 번호
	$cate_num = "5";	$page_num = "4"; //$spage_num = "1"; 

	//현재 활성화 상태
	$gn_btn = "gn_btn".$cate_num;		$$gn_btn = "current";
	$ln_btn = "ln_btn".$page_num;		$$ln_btn = "current";
	$sln_btn = "sln_btn".$spage_num;		$$sln_btn = "current";

	include_once(G5_THEME_PATH.'/head.php');
?>

<section class="s05 s<?=$cate_num;?>0<?=$page_num;?> s<?=$cate_num;?><?=$page_num;?><?=$spage_num;?><?=$sspage_num;?> clear ct1">
	<div class="cnt_box">
		<article class="arti1">
			<h3 class="tit_h3">연구과제 </h3>
			<ul class="s504_his" style="margin-top: 30px;">
				<li>
					<h3 class="robo">2022</h3>
					<div class="tbx">
						<ol>
							<li>- 2022년  방사선안전 이해확산 위탁사업</li>
							<li>- 현장 맟춤형 전문인력 양성 : 현장의 방사선안전관리 중심</li>
						</ol>
					</div>
				</li>
				<li>
					<h3 class="robo">2021</h3>
					<div class="tbx">
						<ol>
							<li>- 2021년  방사선안전 이해확산 위탁사업</li>
							<li>- 현장 맟춤형 전문인력 양성 : 현장의 방사선안전관리 중심</li>
						</ol>
					</div>
				</li>
				<li>
					<h3 class="robo">2020</h3>
					<div class="tbx">
						<ol>
							<li>- 2020년 방사선규제이해기반 구축사업</li>
							<li>- 현장 맞춤형 전문인력 양성 : 현장의 방사선안전관리 중심</li>
							<li>- 2020년도 원자력계 주요 현안에 대한 대응 방안 연구</li>
						</ol>
					</div>
				</li>
				<li>
					<h3 class="robo">2019</h3>
					<div class="tbx">
						<ol>
							<li>- 원자력정책 환경 변화에 따른 핵심 기술 · 인력의 수급 및 활용 최적화 방안 연구</li>
							<li>- 2019년  방사선규제이해기반  구축사업</li>
							<li>- 주요 원자력 현안과제 대한 컨센서스 도출</li>
							<li>- 원자력계 축적된 경험을 활용한 국민 감성 소통 증진 방안</li>
						</ol>
					</div>
				</li>
				<li>
					<h3 class="robo">2018</h3>
					<div class="tbx">
						<ol>
							<li>- 원자력 적정기술을 지원하는 국제개발협력사업 추진 방안 연구</li>
							<li>- 원자력에 대한 막연한 불안감 해소 등 국민 신뢰제고를 위한 이해증진 사업</li>
						</ol>
					</div>
				</li>
				<li>
					<h3 class="robo">2017</h3>
					<div class="tbx">
						<ol>
							<li>- 국가에너지패러다임 변화에 따른 새로운 원자력 정책, 에너지 지원시책 · 제도의 발전방안 연구 </li>
							<li>- 2017년  방사선규제이해기반 구축사업</li>
							<li>- 신 한 · 미 원자력협정에 따른 핵연료주기정책 발전방향에 관한 연구</li>
							<li>- 원자력에 대한 국민의 신뢰제고를 위한 이해 증진 사업</li>
						</ol>
					</div>
				</li>
				<li>
					<h3 class="robo">2016</h3>
					<div class="tbx">
						<ol>
							<li>- 원자력 수용성 분석 및 국민 소통 모델 개발</li>
							<li>- 원자력 현안 과제의 공감대 형성을 위한 원자력원로포럼 운영</li>
							<li>- 2016년  방사선규제이해기반 구축사업</li>
							<li>- 원자력 및 방사선 수출기반 확보를 위한 개도국 국제 개발 협력사업의 추진 방안연구</li>
							<li>- 핵비확산 및 핵안보 주요 이슈 분석과 발전방향에 관한 연구</li>
							<li>- 신 한미 원자력협정에 따른 한미 공동관심 분야 R&D 과제 도출에 관한 연구</li>
							<li>- 원자력 및 방사선에 관한 이해증진 사업</li>
						</ol>
					</div>
				</li>
				<li>
					<h3 class="robo">2015</h3>
					<div class="tbx">
						<ol>
							<li>- 중소형 원자로 발전방향에 대한 정책 조사 연구</li>
							<li>- 원자력이해를 위한 창의적 체험학습 시범학교 운영</li>
							<li>- 원자력원로포럼을 통한 원자력 산업 R&D 선진화 방안 연구</li>
							<li>- 한미 원자력협력협정 체결에 따른 현안과제 대응 방안 연구</li>
							<li>- 원자력 및 방사선에 관한 이해증진사업 추진</li>
						</ol>
					</div>
				</li>
				<li>
					<h3 class="robo">2014</h3>
					<div class="tbx">
						<ol>
							<li>- 여론주도층과의 소통을 위한 원자력 및 방사선 관련 인식도 조사</li>
							<li>- 초중고등학교 창의적 체험학습용 원자력과 방사선 교재 개발</li>
							<li>- 원자력원로포럼을 통한 원자력과학기술 및 산업발전방안 연구</li>
							<li>- 방사선안전문화구축사업</li>
							<li>- 원자력전문가 포럼을 통한 한미 원자력협력 체제 평가 및 발전방향 연구</li>
							<li>- 원자력정책 전문가 토론을 통한 한미 원자력협력 컨센서스 도출</li>
						</ol>
					</div>
				</li>
				<li>
					<h3 class="robo">2013</h3>
					<div class="tbx">
						<ol>
							<li>- 초중고생의 원자력기초교육을 통한 교과과정 연구 및 교재 개발</li>
							<li>- 원자력원로포럼을 통한 원자력정책현안의 연구</li>
							<li>- 원자력정책전문가 포럼을 통한 한미원자력협력 선진화 방안 연구</li>
							<li>- 방사선안전문화구축사업</li>
						</ol>
					</div>
				</li>
				<li>
					<h3 class="robo">2012</h3>
					<div class="tbx">
						<ol>
							<li>- 원자력원로포럼을 통한 원자력안전 현안의 사회적 인식 제고 방안 연구</li>
							<li>- 방사선안전문화구축사업</li>
						</ol>
					</div>
				</li>
				<li>
					<h3 class="robo">2011</h3>
					<div class="tbx">
						<ol>
							<li>- 원자력원로포럼을 통한 원자력안전성 증진 방안 연구</li>
							<li>- 방사선안전문화구축사업</li>
						</ol>
					</div>
				</li>
				<li>
					<h3 class="robo">2010</h3>
					<div class="tbx">
						<ol>
							<li>- 원자력원로포럼 개최에 따른 원자력 기술의 수출경쟁력 강화 방안 연구</li>
							<li>- 방사선안전문화구축사업</li>
						</ol>
					</div>
				</li>
				<li>
					<h3 class="robo">2009</h3>
					<div class="tbx">
						<ol>
							<li>- 원자력원로포럼을 통한 우리나라 원자력의 국내외 환경 변화 대응 전략 연구</li>
							<li>- 방사선안전문화구축사업</li>
							<li>- 방사선안전 교육 훈련제도 개선 방안 연구</li>
						</ol>
					</div>
				</li>
				<li>
					<h3 class="robo">2007</h3>
					<div class="tbx">
						<ol>
							<li>- 우리나라 원자력 이용의 선도적 역할을 위한 정책 방안 제안에 관한 연구</li>
						</ol>
					</div>
				</li>
				<li>
					<h3 class="robo">2006</h3>
					<div class="tbx">
						<ol>
							<li>- 우리나라 원자력 초창기의 전개 과정 고찰</li>
						</ol>
					</div>
				</li>
				<li>
					<h3 class="robo">2005</h3>
					<div class="tbx">
						<ol>
							<li>- 미래대비 원자력정책과제 도출 및 제안에 관한 연구</li>
							<li>- 방사선작업종사자 교육용 교재 개발</li>
						</ol>
					</div>
				</li>
				<li>
					<h3 class="robo">2004</h3>
					<div class="tbx">
						<ol>
							<li>- 원자력안전체험사업 추진 방안에 관한 연구</li>
							<li>- 방사선작업종사자 교육용 교재 개발</li>
						</ol>
					</div>
				</li>
				<li>
					<h3 class="robo">2003</h3>
					<div class="tbx">
						<ol>
							<li>- 미래대비 원자력정책과제 도출 및 제안에 관한 연구</li>
							<li>- 방사능 방재교육 실시 계획 및 시행방안에 관한 연구</li>
							<li>- 방사선작업종사자 교육용 교재 개발</li>
						</ol>
					</div>
				</li>
				<li>
					<h3 class="robo">2002</h3>
					<div class="tbx">
						<ol>
							<li>- 방사선작업종사자 교육용 교재 개발</li>
						</ol>
					</div>
				</li>
			</ul>
		</article>
	</div>
</section>



<?php include_once(G5_THEME_PATH.'/tail.php'); ?>