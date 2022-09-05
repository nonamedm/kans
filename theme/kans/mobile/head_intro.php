<?php
   if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
   
   if($bo_table){   $user_division = "user";   $screen_div = "sub"; //main, sub $frame_div = "two";  //one, two
	
    if($bo_table == "s1_1_1_2"){$cate_name = $s1_name;	$cate_num = "1";	$page_name = "<?=$s1_1_name?>";	$page_num = "1"; $spage_num = "1";	$sspage_num = "5"; }

	if($bo_table == "s1_2_2"){ $cate_num = "1"; $page_num = "2"; $spage_num = "2"; }

	if($bo_table == "s1_2_2_1"){
		$cate_name = $s6_name;	$cate_num = "6";
		if($ca_nm == '직장교육'){ $page_name = "<?=$s6_1_name?>";	$page_num = "1"; }
		else if($ca_nm == '보수교육'){ $page_name = "<?=$s6_2_name?>";	$page_num = "2"; }
		else if($ca_nm == '전문교육'){ $page_name = "<?=$s6_3_name?>";	$page_num = "3"; }
	}
	if($bo_table == "s2_1"){$cate_name = $s2_name;	$cate_num = "2";	$page_name = "<?=$s2_1_name?>";	$page_num = "1"; }
	if($bo_table == "s2_2"){$cate_name = $s2_name;	$cate_num = "2";	$page_name = "<?=$s2_2_name?>";	$page_num = "2";}
	if($bo_table == "s2_3"){$cate_name = $s2_name;	$cate_num = "2";	$page_name = "<?=$s2_3_name?>";	$page_num = "3";}
	if($bo_table == "s2_4"){$cate_name = $s2_name;	$cate_num = "2";	$page_name = "<?=$s2_4_name?>";	$page_num = "4";}
	if($bo_table == "s2_6"){$cate_name = $s2_name;	$cate_num = "2";	$page_name = "<?=$s2_6_name?>";	$page_num = "6";}

	if($bo_table == "s6_1"){$cate_name = $s6_name;	$cate_num = "6";	$page_name = "<?=$s6_1_name?>";	$page_num = "1";}
	if($bo_table == "s6_2"){$cate_name = $s6_name;	$cate_num = "6";	$page_name = "<?=$s6_2_name?>";	$page_num = "2";}
    if($bo_table == "s6_3"){$cate_name = $s6_name;	$cate_num = "6";	$page_name = "<?=$s6_3_name?>";	$page_num = "3";}


	$gn_btn = "gn_btn".$cate_num;			$$gn_btn = "current";
	$ln_btn = "ln_btn".$page_num;				$$ln_btn = "current";
	$sln_btn = "sln_btn".$spage_num;			$$sln_btn = "current"; 
	$ssln_btn = "ssln_btn".$sspage_num;		$$ssln_btn = "current"; }

//네임연동
$s1_name = "교육안내";    
	$s1_1_name = "교육소개";									
		$s1_1_1_name = "법정교육";										
			$s1_1_1_1_name = "방사선작업종사자 직장교육";			$s1_1_1_1_url = "/s1/s1_1_1_1.php";
			$s1_1_1_2_new_name = "온라인교육안내";					$s1_1_1_2_new_url = "/s1/s1_1_1_2_new.php";
			$s1_1_1_2_name = "면허소지자 보수교육";					$s1_1_1_2_url = "/s1/s1_1_1_2.php";
			$s1_1_1_3_name = "방사선사 보수교육";						$s1_1_1_3_url = "/s1/s1_1_1_3.php";
			$s1_1_1_4_name = "방사능 방재교육";									$s1_1_1_4_url = "/s1/s1_1_1_4.php";

		$s1_1_2_name = "전문교육";								
			$s1_1_2_1_name = "전문강좌";									$s1_1_2_1_url = "/s1/s1_1_2_1.php";
			$s1_1_2_2_name = "단기강좌";									$s1_1_2_2_url = "/s1/s1_1_2_2.php";
			$s1_1_2_3_name = "통신교육";									$s1_1_2_3_url = "/s1/s1_1_2_3.php";

	$s1_2_name = "교육일정";										
		$s1_2_1_name = "교육신청절차";		
			$s1_2_1_1_name = "교육 신청 절차";							$s1_2_1_1_url = "/s1/s1_2_1_1.php";
			$s1_2_1_2_name = "교육비 신용카드 결제 방법";		//	$s1_2_1_2_url = "/s1/s1_2_1_1.php";
			$s1_2_1_3_name = "수료증 발급";							//	$s1_2_1_3_url = "/s1/s1_2_1_1.php";
			$s1_2_1_4_name = "납부확인증 발급";					//	$s1_2_1_4_url = "/s1/s1_2_1_1.php";
			$s1_2_1_5_name = "공문 발급";								//	$s1_2_1_5_url = "/s1/s1_2_1_1.php";
			$s1_2_1_6_name = "전자계산서 발급";					//	$s1_2_1_6_url = "/s1/s1_2_1_1.php";
			$s1_2_1_7_name = "환불 규정 안내";						//	$s1_2_1_7_url = "/s1/s1_2_1_1.php";

		$s1_2_2_name = "교육일정 및 신청";							
			$s1_2_2_1_name = "전체";										$s1_2_2_url = "/cal/cal_list.php";
			$s1_2_2_2_name = "일반 정기";								//	$s1_2_2_2_url = "/s1/s1_2_2_2.php";
			$s1_2_2_3_name = "비파괴 정기";							//	$s1_2_2_3_url = "/s1/s1_2_2_3.php";
			$s1_2_2_4_name = "일반 신규";								//	$s1_2_2_4_url = "/s1/s1_2_2_4.php";
			$s1_2_2_5_name = "비파괴 신규";							//	$s1_2_2_5_url = "/s1/s1_2_2_5.php";
			$s1_2_2_6_name = "보수교육";								//	$s1_2_2_6_url = "/s1/s1_2_2_6.php";
			$s1_2_2_7_name = "기타교육";								//	$s1_2_2_7_url = "/s1/s1_2_2_7.php";
			
																		$s1_2_2_2_url = "/bbs/board.php?bo_table=s1_2_2"; // $s1_2_2_2_url = "/cal/cal_list_board.php";



	$s1_3_name = "교육장 안내";									
		$s1_3_1_name = "서울";					
			$s1_3_1_1_name = "KANS 교육장";							$s1_3_1_1_url = "/s1/s1_3_1_1.php";

		$s1_3_2_name = "대전";	
			$s1_3_2_1_name = "대전예람인재교육센터";					$s1_3_2_1_url = "/s1/s1_3_2_1.php";
			$s1_3_2_2_name = "충남대학교";								$s1_3_2_2_url = "/s1/s1_3_2_2.php";

		$s1_3_3_name = "부산";	
			$s1_3_3_1_name = "부산은행 범내골지점 2층";				$s1_3_3_1_url = "/s1/s1_3_3_1.php";
			$s1_3_3_2_name = "부산유라시아플랫폼";					$s1_3_3_2_url = "/s1/s1_3_3_2.php";

		$s1_3_4_name = "광주";	
			$s1_3_4_1_name = "한국경영원";								$s1_3_4_1_url = "/s1/s1_3_4_1.php";
			$s1_3_4_2_name = "광주인력개발원";							$s1_3_4_2_url = "/s1/s1_3_4_2.php";
			$s1_3_4_3_name = "전남대학교";								$s1_3_4_3_url = "/s1/s1_3_4_3.php";

		$s1_3_5_name = "대구";	
			$s1_3_5_1_name = "대구경북디자인센터";					$s1_3_5_1_url = "/s1/s1_3_5_1.php";
			$s1_3_5_2_name = "경북대학교";								$s1_3_5_2_url = "/s1/s1_3_5_2.php";

		$s1_3_6_name = "울산";	
			$s1_3_6_1_name = "울산대학교";								$s1_3_6_1_url = "/s1/s1_3_6_1.php";
   
$s2_name = "정보광장";			
	$s2_1_name = "교육공지사항";											$s2_1_url = "/bbs/board.php?bo_table=s2_1";
	$s2_2_name = "일반공지사항";											$s2_2_url = "/bbs/board.php?bo_table=s2_2";
	$s2_3_name = "자료실";													$s2_3_url = "/bbs/board.php?bo_table=s2_3";
	$s2_4_name = "채용정보";												$s2_4_url = "/bbs/board.php?bo_table=s2_4";
	$s2_5_name = "자주묻는질문";											$s2_5_url = "/bbs/faq.php";
	$s2_6_name = "온라인문의";											$s2_6_url = "/bbs/board.php?bo_table=s2_6";
	
    							
$s3_name = "콘텐츠"; 
	$s3_1_name = "일반인";					
		$s3_1_1_name = "학생/교사/직장인";					$s3_1_1_url = "/s3/s3_1_1.php";

	$s3_2_name = "원자력전문인력양성";										
		$s3_2_1_name = "원자력/방사선";						$s3_2_1_url = "/s3/s3_2_1.php";

	$s3_3_name = "방사선정보";								
		$s3_3_1_name = "핵종정보";							$s3_3_1_url = "/s3/s3_3_1.php";
	//	$s3_3_2_name = "양과단위";							$s3_3_2_url = "/s3/s3_3_2.php";
	//	$s3_3_3_name = "용어정리";							$s3_3_3_url = "/s3/s3_3_3.php";
     
$s4_name = "정회원"; 
	$s4_1_name = "정회원 가입 안내 및 혜택";					$s4_1_url = "/s4/s4_1.php";
	$s4_2_name = "정회원 현황";									$s4_2_url = "/s4/s4_2.php";

$s5_name = "아카데미 소개";					
	$s5_1_name = "인사말";										$s5_1_url = "/s5/s5_1.php";
	$s5_2_name = "단체 개요";									$s5_2_url = "/s5/s5_2.php";
	$s5_3_name = "연혁 및 조직";								$s5_3_url = "/s5/s5_3.php";
	$s5_4_name = "연구과제실적";								$s5_4_url = "/s5/s5_4.php";
	$s5_5_name = "대관사업";									$s5_5_url = "/s5/s5_5.php";
     
$s6_name = "신청하기 페이지";	
	$s6_1_name = "직장교육";									$s6_1_url = "/bbs/write.php?bo_table=s6_1";
	$s6_2_name = "보수교육";									$s6_2_url = "/bbs/write.php?bo_table=s6_2";
    $s6_3_name = "전문교육";									$s6_3_url = "/bbs/write.php?bo_table=s6_3";

$s7_name = "로그인"; 
	$s7_1_name = "로그인";								
	$s7_2_name = "마이페이지";				
//	$s703_name = "회원가입약관";								
//	$s704_name = "회원비밀번호 확인";		

$s8_name = "회원정보";
	$s8_1_name = "정보수정";								
	$s8_2_name = "비밀번호 수정";

$s9_name = "마이페이지";  
//	$s9_1_name = "신청현황";									$s9_1_url = "/my_page/my_1.php";
	$s9_1_name = "나의강의실";								$s9_1_url = "/my_page/my_1.php";

	$s9_2_name = "과거신청수료현황";						$s9_2_url = "/my_page/my_2.php";
	$s9_3_name = "정보수정";									$s9_3_url = "/my_page/my_1.php";

if($cate_num == "1") {$cate_name = $s1_name;}
if($cate_num == "2") {$cate_name = $s2_name;}
if($cate_num == "3") {$cate_name = $s3_name;}
if($cate_num == "4") {$cate_name = $s4_name;}
if($cate_num == "5") {$cate_name = $s5_name;}
if($cate_num == "6") {$cate_name = $s6_name;}
if($cate_num == "7") {$cate_name = $s7_name;}
if($cate_num == "8") {$cate_name = $s8_name;}
if($cate_num == "9") {$cate_name = $s9_name;}

if($cate_num == "1") {   
	if($page_num == "1"){   $page_name = $s1_1_name;}
		if($page_num == "1" && $spage_num == "1"  ){$spage_name = $s1_1_1_name;}
			if($page_num == "1" && $spage_num == "1" && $sspage_num == "1"  ){$sspage_name = $s1_1_1_1_name;}
			if($page_num == "1" && $spage_num == "1" && $sspage_num == "5"  ){$sspage_name = $s1_1_1_2_new_name;}
			if($page_num == "1" && $spage_num == "1" && $sspage_num == "2"  ){$sspage_name = $s1_1_1_2_name;}
			if($page_num == "1" && $spage_num == "1" && $sspage_num == "3"  ){$sspage_name = $s1_1_1_3_name;}
			if($page_num == "1" && $spage_num == "1" && $sspage_num == "4"  ){$sspage_name = $s1_1_1_4_name;}
			
		if($page_num == "1" && $spage_num == "2"  ){$spage_name = $s1_1_2_name;}
			if($page_num == "1" && $spage_num == "2" && $sspage_num == "1"  ){$sspage_name = $s1_1_2_1_name;}
			if($page_num == "1" && $spage_num == "2" && $sspage_num == "2"  ){$sspage_name = $s1_1_2_2_name;}
			if($page_num == "1" && $spage_num == "2" && $sspage_num == "3"  ){$sspage_name = $s1_1_2_3_name;}

	if($page_num == "2"){   $page_name = $s1_2_name;}
		if($page_num == "2" && $spage_num == "1"  ){$spage_name = $s1_2_1_name;}
			if($page_num == "2" && $spage_num == "1" && $sspage_num == "1"  ){$sspage_name = $s1_2_1_1_name;}
			if($page_num == "2" && $spage_num == "1" && $sspage_num == "2"  ){$sspage_name = $s1_2_1_2_name;}
			if($page_num == "2" && $spage_num == "1" && $sspage_num == "3"  ){$sspage_name = $s1_2_1_3_name;}
			if($page_num == "2" && $spage_num == "1" && $sspage_num == "4"  ){$sspage_name = $s1_2_1_4_name;}
			if($page_num == "2" && $spage_num == "1" && $sspage_num == "5"  ){$sspage_name = $s1_2_1_5_name;}
			if($page_num == "2" && $spage_num == "1" && $sspage_num == "6"  ){$sspage_name = $s1_2_1_6_name;}
			if($page_num == "2" && $spage_num == "1" && $sspage_num == "7"  ){$sspage_name = $s1_2_1_7_name;}

		if($page_num == "2" && $spage_num == "2"  ){$spage_name = $s1_2_2_name;}
			if($page_num == "2" && $spage_num == "2" && $sspage_num == "1"  ){$sspage_name = $s1_2_2_1_name;}
			if($page_num == "2" && $spage_num == "2" && $sspage_num == "2"  ){$sspage_name = $s1_2_2_2_name;}
			if($page_num == "2" && $spage_num == "2" && $sspage_num == "3"  ){$sspage_name = $s1_2_2_3_name;}
			if($page_num == "2" && $spage_num == "2" && $sspage_num == "4"  ){$sspage_name = $s1_2_2_4_name;}
			if($page_num == "2" && $spage_num == "2" && $sspage_num == "5"  ){$sspage_name = $s1_2_2_5_name;}
			if($page_num == "2" && $spage_num == "2" && $sspage_num == "6"  ){$sspage_name = $s1_2_2_6_name;}
			if($page_num == "2" && $spage_num == "2" && $sspage_num == "7"  ){$sspage_name = $s1_2_2_7_name;}

	if($page_num == "3"){   $page_name = $s1_3_name;}
		if($page_num == "3" && $spage_num == "1"  ){$spage_name = $s1_3_1_name;}
			if($page_num == "3" && $spage_num == "1" && $sspage_num == "1"  ){$sspage_name = $s1_3_1_1_name;}

		if($page_num == "3" && $spage_num == "2"  ){$spage_name = $s1_3_2_name;}
			if($page_num == "3" && $spage_num == "2" && $sspage_num == "1"  ){$sspage_name = $s1_3_2_1_name;}
			if($page_num == "3" && $spage_num == "2" && $sspage_num == "2"  ){$sspage_name = $s1_3_2_2_name;}
		
		if($page_num == "3" && $spage_num == "3"  ){$spage_name = $s1_3_3_name;}
			if($page_num == "3" && $spage_num == "3" && $sspage_num == "1"  ){$sspage_name = $s1_3_3_1_name;}
			if($page_num == "3" && $spage_num == "3" && $sspage_num == "2"  ){$sspage_name = $s1_3_3_2_name;}
		
		if($page_num == "3" && $spage_num == "4"  ){$spage_name = $s1_3_4_name;}
			if($page_num == "3" && $spage_num == "4" && $sspage_num == "1"  ){$sspage_name = $s1_3_4_1_name;}
			if($page_num == "3" && $spage_num == "4" && $sspage_num == "2"  ){$sspage_name = $s1_3_4_2_name;}
			if($page_num == "3" && $spage_num == "4" && $sspage_num == "3"  ){$sspage_name = $s1_3_4_3_name;}

		if($page_num == "3" && $spage_num == "5"  ){$spage_name = $s1_3_5_name;}
			if($page_num == "3" && $spage_num == "5" && $sspage_num == "1"  ){$sspage_name = $s1_3_5_1_name;}
			if($page_num == "3" && $spage_num == "5" && $sspage_num == "2"  ){$sspage_name = $s1_3_5_2_name;}

		if($page_num == "3" && $spage_num == "6"  ){$spage_name = $s1_3_6_name;}
			if($page_num == "3" && $spage_num == "6" && $sspage_num == "1"  ){$sspage_name = $s1_3_6_1_name;}
			if($page_num == "3" && $spage_num == "6" && $sspage_num == "2"  ){$sspage_name = $s1_3_6_2_name;}

		if($page_num == "3" && $spage_num == "7"  ){$spage_name = $s1_3_7_name;}
			if($page_num == "3" && $spage_num == "7" && $sspage_num == "1"  ){$sspage_name = $s1_3_7_1_name;}

}else if($cate_num == "2"){
	if($page_num == "1"){   $page_name = $s2_1_name;}
	if($page_num == "2"){   $page_name = $s2_2_name;}
	if($page_num == "3"){   $page_name = $s2_3_name;}
	if($page_num == "4"){   $page_name = $s2_4_name;}
	if($page_num == "5"){   $page_name = $s2_5_name;}
	if($page_num == "6"){   $page_name = $s2_6_name;}

}else if($cate_num == "3"){
	if($page_num == "1"){   $page_name = $s3_1_name;}
		if($page_num == "1" && $spage_num == "1"  ){$spage_name = $s3_1_1_name;}
		
	if($page_num == "2"){   $page_name = $s3_2_name;}
		if($page_num == "2" && $spage_num == "1"  ){$spage_name = $s3_2_1_name;}

	if($page_num == "3"){   $page_name = $s3_3_name;}
		if($page_num == "3" && $spage_num == "1"  ){$spage_name = $s3_3_1_name;}
		if($page_num == "3" && $spage_num == "2"  ){$spage_name = $s3_3_2_name;}
		if($page_num == "3" && $spage_num == "3"  ){$spage_name = $s3_3_3_name;}

}else if($cate_num == "4"){
	if($page_num == "1"){   $page_name = $s4_1_name;}
	if($page_num == "2"){   $page_name = $s4_2_name;}

}else if($cate_num == "5"){
	if($page_num == "1"){   $page_name = $s5_1_name;}
	if($page_num == "2"){   $page_name = $s5_2_name;}
	if($page_num == "3"){   $page_name = $s5_3_name;}
	if($page_num == "4"){   $page_name = $s5_4_name;}
	if($page_num == "5"){   $page_name = $s5_5_name;}

}else if($cate_num == "6"){
	if($page_num == "1"){   $page_name = $s6_1_name;}
	if($page_num == "2"){   $page_name = $s6_2_name;}
    if($page_num == "3"){   $page_name = $s6_3_name;}

}else if($cate_num == "7"){
	if($page_num == "1"){   $page_name = $s7_1_name;}
		if($page_num == "1" && $spage_num == "1"  ){$spage_name = $s7_1_1_name;}
		if($page_num == "1" && $spage_num == "2"  ){$spage_name = $s7_1_2_name;}

	if($page_num == "2"){   $page_name = $s7_2_name;}

}else if($cate_num == "8"){
	if($page_num == "1"){   $page_name = $s8_1_name;}
	if($page_num == "2"){   $page_name = $s8_2_name;}

}else if($cate_num == "9"){
	if($page_num == "1"){   $page_name = $s9_1_name;}
	if($page_num == "2"){   $page_name = $s9_2_name;}
	if($page_num == "3"){   $page_name = $s9_4_name;}
}

   if($g5['title']){
      $user_division = "user";
      $screen_div = "sub"; //main, sub
      $frame_div = "two";  //one, two

//      if($g5['title']=="FAQ"){$cate_name = "서비스안내";   $cate_num = "2";$page_name = "자주하는 질문";   $page_num = "7";}
      if($g5['title']=="로그인"){$cate_name = "로그인";   $cate_num = "7";   $page_name = "로그인";      $page_num = "1";   }
      if($g5['title']=="회원 가입"){$cate_name = "교육 회원가입";   $cate_num = "7";   $page_name = "교육 회원가입";   $page_num = "2";   }
      if($g5['title']=="회원가입약관"){$cate_name = "교육 회원가입약관 ";   $cate_num = "7";   $page_name = "교육 회원가입약관";   $page_num = "3";   }
      if($g5['title']=="회원 비밀번호 확인"){$cate_name = "교육 회원 비밀번호 확인";   $cate_num = "7";   $page_name = "교육 회원 비밀번호 확인";   $page_num = "4";   }
	  if($g5['title']=="회원정보 찾기"){$cate_name = "교육 회원 비밀번호 확인";   $cate_num = "7";   $page_name = "교육 회원정보 찾기";   $page_num = "5";   }
      if($g5['title']=="마이페이지"){$cate_name = "마이페이지";   $cate_num = "7";   $page_name = "마이페이지";   $page_num = "2";   }
	  if($g5['title']=="전체검색 결과"){$cate_name = "전체검색 결과";   $cate_num = "7";   $page_name = "전체검색 결과";   $page_num = "2";   }

	 if($g5['title']=="자주묻는질문"){$cate_name = $s2_name;   $cate_num = "2";   $page_name = $s2_5_name;   $page_num = "5";   }

      $gn_btn = "gn_btn".$cate_num;
      $$gn_btn = "current";
      $ln_btn = "ln_btn".$page_num;
      $$ln_btn = "current";
      $sln_btn = "sln_btn".$spage_num;
      $$sln_btn = "current";

	  $ssln_btn = "ssln_btn".$sspage_num;
      $$ssln_btn = "current";

   }

   if(G5_COMMUNITY_USE === false) {
      include_once(G5_THEME_MSHOP_PATH.'/shop.head.php');
      return;
   }

   include_once(G5_THEME_PATH.'/head.sub.php');
   include_once(G5_LIB_PATH.'/latest.lib.php');
   include_once(G5_LIB_PATH.'/outlogin.lib.php');
   include_once(G5_LIB_PATH.'/poll.lib.php');
   include_once(G5_LIB_PATH.'/visit.lib.php');
   include_once(G5_LIB_PATH.'/connect.lib.php');
   include_once(G5_LIB_PATH.'/popular.lib.php');
?>

<?php
if(defined('_INDEX_')) { // index에서만 실행
   include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
}
?>