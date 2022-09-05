<?
	include_once('./_common.php');

	//화면의 성격
	$user_division = "user";	$screen_div = "sub"; //main, sub	$frame_div = "two";  //one, two

	//카테고리/페이지/상세페이지 명칭 & 카테고리 번호
	$cate_num = "1";		$page_num = "1";		$spage_num = "1";	$sspage_num = "4";  

	//현재 활성화 상태
	$gn_btn = "gn_btn".$cate_num;			$$gn_btn = "current";
	$ln_btn = "ln_btn".$page_num;				$$ln_btn = "current";
	$sln_btn = "sln_btn".$spage_num;			$$sln_btn = "current";
	$ssln_btn = "ssln_btn".$sspage_num;		$$ssln_btn = "current";

	include_once(G5_THEME_PATH.'/head.php');
?>

<section class="s01 s1111 s<?=$cate_num;?>0<?=$page_num;?> s<?=$cate_num;?><?=$page_num;?><?=$spage_num;?><?=$sspage_num;?> clear ct1">
	<!-- <h2 class="tit_bg">방사선작업종사자 직장교육</h2> -->
	<div class="cnt_box">
		<article class="arti1 clear">
			<h3 class="tit_h3">관련법령</h3>
			<ul class="fiex_box col3">
				<li>
					<h4 class="bg_blue">법률</h4>
					<div class="tbx">
						<p style="line-height: 26px;">원자력시설 등의 방호 및 <br>방사능 방재대책법 제36조</p>
						<a href="https://www.law.go.kr/LSW/lsSideInfoP.do?joBrNo=00&docCls=jo&lsiSeq=199993&urlMode=lsScJoRltInfoR&joNo=0036" target="blank" class="bg_blue"><img src="<? echo G5_THEME_URL ?>/images/sub/s1111_1.png" /></a>
					</div>
				</li>
				<li>
					<h4 class="bg_sky">시행령</h4>
					<div class="tbx">
						<p style="line-height: 26px;">원자력시설 등의 방호 및 <br>방사능 방재대책법 시행령 제33조</p>
						<a href="https://www.law.go.kr/LSW/lsSideInfoP.do?lsiSeq=195851&joBrNo=00&docCls=jo&urlMode=lsScJoRltInfoR&joNo=0033" target="blank" class="bg_sky"><img src="<? echo G5_THEME_URL ?>/images/sub/s1111_1.png" /></a>
					</div>
				</li>
				<li>
					<h4 class="bg_green">시행규칙</h4>
					<div class="tbx">
						<p style="line-height: 26px;">원자력시설 등의 방호 및 <br>방사능 방재대책법 시행규칙 제19조</p>
						<a href="https://www.law.go.kr/LSW/lsSideInfoP.do?lsiSeq=203957&joBrNo=00&docCls=jo&urlMode=lsScJoRltInfoR&joNo=0019" target="blank" class="bg_green"><img src="<? echo G5_THEME_URL ?>/images/sub/s1111_1.png" /></a>
					</div>
				</li>
			</ul>
		</article>
		
		<article class="arti2 clear">
			<h3 class="tit_h3">교육시간</h3>
			<table class="table_nomal">
				<colgroup>
					<col width="20%">
					<col width="20%">
					<col width="*">
				</colgroup>
				<thead>
				<tr>
					<th colspan="2">교육대상</th>
					<th>교육내용</th>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td rowspan="2">원자력사업자의 종업원</td>
					<td>방사능 방재업무를<br> 담당하는 종업원</td>
					<td>
						<span style="margin-right:5px">1.</span> 방사능 방재에 관한 법령 <br>
						<span style="margin-right:5px">2.</span> 방사능 방재에 관한 일반사항<br>
						<span style="margin-right:5px">3.</span> 방사선사고 확대방지를 위한 응급조치에 관한 사항<br>
						<span style="margin-right:5px">4.</span> 사고분석 및 평가에 관한 사항 <br>
						<span style="margin-right:5px">5.</span> 방사선측정 및 방사능 감시에 관한 사항 <br>
						<span style="margin-right:5px">6.</span> 방사선방호조치에 관한 사항 <br>
						<span style="margin-right:5px">7.</span> 화재진압에 관한 사항 <br>
						<span style="margin-right:5px">8.</span> 긴급구조에 관한 사항</td>
				</tr>
				<tr>
					<td>방사능 방재업무를 <br>담당하지 아니하는 종업원</td>
					<td>
						<span style="margin-right:5px">1.</span> 방사능 방재에 관한 법령 <br>
						<span style="margin-right:5px">2.</span> 방사능 방재에 관한 일반사항
					</td>
				</tr>
				<tr>
					<td colspan="2">방사선비상계획구역의 전부 또는 일부를 관할 구역으로 하는 <br>
					시 &middot;도지사 및 시장 &middot;군수 &middot;구청장이 지정한 방사능 방재요원</td>
					<td>
						<span style="margin-right:5px">1.</span> 방사능 방재에 관한 법령<br>
						<span style="margin-right:5px">2.</span> 방사능 방재에 관한 일반사항<br>
						<span style="margin-right:5px">3.</span> 방사능 재난관리에 관한 사항<br>
						<span style="margin-right:5px">4.</span> 방사선측정 및 방사능 감시에 관한 사항<br>
						<span style="margin-right:5px">5.</span> 방사선방호조치에 관한 사항<br>
						<span style="margin-right:5px">6.</span> 주민보호에 관한 사항</td>
				</tr>
				<tr>
					<td colspan="2">법 제39조제2항에 따른 1차 및 2차 <br>방사선비상진료기관의 장이 지정한 방사선비상진료요원</td>
					<td>
						<span style="margin-right:5px">1.</span> 방사능 방재에 관한 법령<br>
						<span style="margin-right:5px">2.</span> 방사능 방재에 관한 일반사항<br>
						<span style="margin-right:5px">3.</span> 방사선방호조치에 관한 사항<br>
						<span style="margin-right:5px">4.</span> 방사선비상진료에 관한 사항
					</td>
				</tr>
				<tr>
					<td rowspan="2">원자력안전위원회가 정하여 고시하는 단체 또는 기관의 직원</td>
					<td>방사능 방재업무를 담당하는 직원</td>
					<td>
						<span style="margin-right:5px">1.</span> 방사능 방재에 관한 법령<br>
						<span style="margin-right:5px">2.</span> 방사능 방재에 관한 일반사항<br>
						<span style="margin-right:5px">3.</span> 방사능 재난관리에 관한 사항<br>
						<span style="margin-right:5px">4.</span> 방사선방호조치에 관한 사항<br>
						<span style="margin-right:5px">5.</span> 주민보호에 관한 사항
					</td>
				</tr>
				<tr>
					<td>방사능 방재업무를 <br>담당하지 아니하는 직원</td>
					<td>
						<span style="margin-right:5px">1.</span> 방사능 방재에 관한 법령<br>
						<span style="margin-right:5px">2.</span> 방사능 방재에 관한 일반사항
					</td>
				</tr>
			</tbody>
			</table>

			<h3 class="tit_h3">교육내용</h3>
			<table class="table_nomal">
				<colgroup>
					<col width="20%">
					<col width="20%">
					<col width="*">
				</colgroup>

				<thead>
				<tr>
					<th colspan="2" rowspan="2">교육대상</th>
					<th colspan="2">교육시간</th>
				</tr>
				<tr class="bg2">
					<th>신규교육</th>
					<th>보수교육</th>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td rowspan="2">원자력사업자의 종업원</td>
					<td>방사능 방재업무를 <br>담당하는 종업원</td>
					<td class="ta_l">방사능 방재업무를 담당하는 종업원으로 임용된 날로부터 6개월 이내에 18시간 이상</td>
					<td class="ta_l">매년 8시간 이상(3회 이상 보수교육을 이수한 경우에는 매년 2시간 이상)</td>
				</tr>
				<tr>
					<td>방사능 방재업무를 <br>담당하지 아니하는 종업원</td>
					<td class="ta_l">종업원으로 임용된 날로부터 6개월 이내에 4시간 이상</td>
					<td class="ta_l">3년마다 2시간 이상</td>
				</tr>
				<tr>
					<td colspan="2">방사선비상계획구역의 전부 또는 일부를 관할 구역으로 하는 <br>시 &middot;도지사 및 시장 &middot;군수 &middot;구청장이 지정한 방사능 방재요원</td>
					<td class="ta_l">방사능 방재요원으로 지정된 날로부터 6개월 이내에 18시간 이상</td>
					<td class="ta_l">매년 8시간 이상</td>
				</tr>
				<tr>
					<td colspan="2">법 제39조제2항에 따른 1차 및 2차 방사선비상진료기관의 장이	지정한<br> 방사선비상진료요원</td>
					<td class="ta_l">방사선비상진료요원으로 지정된 날로부터 6개월 이내에 18시간 이상</td>
					<td class="ta_l">매년 8시간 이상</td>
				</tr>
				<tr>
					<td rowspan="2">원자력안전위원회가 정하여 고시하는 단체 또는 기관의 직원</td>
					<td class="ta_l">방사능 방재업무를 담당하는 직원</td>
					<td class="ta_l">방사능 방재업무를 담당하는 직원으로 임용된 날부터 6개월 이내에 8시간 이상</td>
					<td class="ta_l">매년 4시간 이상(3회 이상 보수교육을 이수한 경우에는 매년 2시간 이상)</td>
				</tr>
				<tr>
					<td>방사능 방재업무를 <br>담당하지 아니하는 직원</td>
					<td class="ta_l">직원으로 임용된 날부터 6개월 이내에 2시간 이상</td>
					<td class="ta_l">3년마다 2시간 이상</td>
				</tr>
			</tbody>
			</table>
		</article>
	</div>
</section>

<?php include_once(G5_THEME_PATH.'/tail.php'); ?>