<?
	include_once('./_common.php');

	//화면의 성격
	$user_division = "user";	$screen_div = "sub"; //main, sub	$frame_div = "two";  //one, two

	//카테고리/페이지/상세페이지 명칭 & 카테고리 번호
	$cate_num = "5";	$page_num = "1"; //$spage_num = "1"; 

	//현재 활성화 상태
	$gn_btn = "gn_btn".$cate_num;		$$gn_btn = "current";
	$ln_btn = "ln_btn".$page_num;		$$ln_btn = "current";
	$sln_btn = "sln_btn".$spage_num;		$$sln_btn = "current";

	include_once(G5_THEME_PATH.'/head.php');
?>

<section class="s05 s<?=$cate_num;?>0<?=$page_num;?> s<?=$cate_num;?><?=$page_num;?><?=$spage_num;?><?=$sspage_num;?> clear ct1">
	<article class="arti1">
		<div class="tbx">
			<span class="robo">GREETINGS</span>
			<h4>반갑습니다. <br>한국원자력안전아카데미 입니다.</h4>
			<!-- <h4>안녕하십니까? <br>한국원자력안전아카데미 이사장 이헌규입니다.</h4> -->
		</div>
	</article>
	<article class="arti2">
		<p>원자력안전아카데미를 아끼고 성원하시는 회원님들과 회원사, 그리고 이 홈페이지를 방문하시는 모든 분들께 감사 인사를 드립니다. </p>

		<p>원자력이 우리 사회에 큰 유익을 주고 있고, 일상생활에서 방사선 이용 영역이 점차 확대되는 만큼 안전문제는 아무리 강조해도 지나치지 않습니다. 이에 저희 아카데미는 원자력안전에 대한 국민 이해를 증진하고 안전 문화를 확산하기 위하여 교육 훈련과 연구 활동 및 방사선안전관리자  포럼, 안전 캠페인 등을 추진하고 있습니다. </p>

		<p>4차 산업혁명과 초 연결사회, 그리고 비 대면이 일상이 되는 최근의 트렌드는 원자력안전 분야 사업이나 교육훈련 수요의 질적인 변화를 요청하고 있습니다. 저희 아카데미도 이러한 추세에 발맞추어 적극적으로 대응해나가고 있습니다. </p>

		<p>최근 신종 감염병 창궐에 의한 급격한 언택트 사회로의 전환 현실을 맞아 일반분야 방사선작업종사자 직장교육 온라인 수강체계를 구현하였고, 방사선투과검사분야에서는 최초로 온라인 교육을 시행함으로써 방사선관리구역에 출입하는 방사선작업종사자들과 수시출입자들이 안전하게 교육의무를 이행할 수 있도록 앞장 선 바 있습니다. </p>

		<p>더불어 온라인 신규 콘텐츠의 개발과 유능한 강사진 확보, 교육과 연구의 질 개선 등 역할에 주력하면서 원자력관계사업자와 관련 종사자 등의 안전의식 확산을 통한 현장 방사선안전문화 정착을 위하여 최선의 노력을 경주해나갈 것입니다. </p>

		<p>앞으로 원자력안전아카데미가 원자력과 방사선 이해관계자 뿐 아니라 일반 대중에게 잘 알려진 선도적인 교육연구 전문단체로 더욱 발돋움하도록 변함없는 관심과 지원을 부탁드립니다. </p>
			
		<!-- <b class="sign">이 사 장 <span class="jeju">이 헌 규</span></b> -->
	</article>
</section>

<style>
	.tit_bg{display: none;}
</style>

<?php include_once(G5_THEME_PATH.'/tail.php'); ?>