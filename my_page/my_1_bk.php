<?
	include_once('./_common.php');

	//화면의 성격
	$user_division = "user";	$screen_div = "sub"; //main, sub	$frame_div = "two";  //one, two

	//카테고리/페이지/상세페이지 명칭 & 카테고리 번호
	$cate_num = "9";	$page_num = "1"; 

	//현재 활성화 상태
	$gn_btn = "gn_btn".$cate_num;		$$gn_btn = "current";
	$ln_btn = "ln_btn".$page_num;		$$ln_btn = "current";
	$sln_btn = "sln_btn".$spage_num;		$$sln_btn = "current";

	include_once(G5_THEME_PATH.'/head.php');
?>

<section class="s<?=$cate_num;?> s<?=$cate_num;?>0<?=$page_num;?> my_page clear ct2">
	<article class="arti1 clear">
		<table>
            <colgroup>
                <col>
                <col>
                <col>
                <col>
                <col>
            </colgroup>

            <thead>
                <tr>
                    <th>교육명</th>
                    <th>교육일</th>
                    <th>교육시간</th>
                    <th>교육장소</th>
                    <th>상태</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>신청하신 교육 교육명</td>
                    <td>2021.04.05 ~ 2021.04.21</td>
                    <td>09:00 ~ 17:00</td>
                    <td>신청하신 교육 장소</td>
                    <td>접수중</td>
                </tr>

                <tr>
                    <td>신청하신 교육 교육명</td>
                    <td>2021.04.05 ~ 2021.04.21</td>
                    <td>09:00 ~ 17:00</td>
                    <td>신청하신 교육 장소</td>
                    <td>접수완료</td>
                </tr>

                <tr>
                    <td>신청하신 교육 교육명</td>
                    <td>2021.04.05 ~ 2021.04.21</td>
                    <td>2021.04.05 ~ 2021.04.21</td>          
                    <td>신청하신 교육 장소</td>
                    <td>취소</td>
                </tr>

                <tr>
                    <td>신청하신 교육 교육명</td>
                    <td>2021.04.05 ~ 2021.04.21</td>
                    <td>09:00 ~ 17:00</td>
                    <td>신청하신 교육 장소</td>
                    <td>변경중</td>
                </tr>
            </tbody>
        </table>
	</article>
</section>

<?php include_once(G5_THEME_PATH.'/tail.php'); ?>