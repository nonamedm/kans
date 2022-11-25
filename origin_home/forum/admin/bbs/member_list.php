<?php
$member_list_vr = 'member';
include_once('./_common.php');

$sql_common = " from {$g5['member_table']} ";

$sql_search = " where (1) ";
$sql_search .= " and mb_id != '{$config['cf_admin']}' "; // 최고관리자 제외

$sql_order = " order by mb_no asc "; // 포인트 순위로 정렬

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = 20; // 목록수
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$g5['title'] = '회원 전체목록';
include_once('/kans1/www/origin_home/forum/admin/theme/kans/mobile/head.php');
add_stylesheet('<link rel="stylesheet" href="http://www.kans.re.kr/theme/kans/mobile/skin/board/wt_comment/style.css">', 0);


if ($member['mb_level'] < 5) {
    if ($member['mb_id'])
        alert('목록을 볼 권한이 없습니다.', G5_URL);
    else
        alert('목록을 볼 권한이 없습니다.\\n\\n회원이시라면 로그인 후 이용해 보십시오.', './login.php?'.$qstr.'&url='.urlencode(G5_BBS_URL.'/board.php?bo_table='.$bo_table.($qstr?'&amp;':'')));
}
?>


<style>
#member_list .member_total {margin:10px 0;padding:15px 10px;margin:10px 0;border:1px solid #ccc;background:#fff;}
#member_list .tbl_head01 thead th {padding:10px 5px;}
#member_list .tbl_head01 td {}
#member_list .td_1 {width:150px;text-align:center}
#member_list .td_2 {width:80px;text-align:center}
select {
    font-size:14px; width:80%;
    -webkit-appearance:none; /* for chrome */
    -moz-appearance:none; /*for firefox*/
    appearance:none;
}
select::-ms-expand{
    display:none;/*for IE10,11*/
}
select {
    background:url('http://www.kans.re.kr/img/down.png') no-repeat 97% 50%/15px auto;
    padding: 0% 5%;
}
.tbl_wrap table {
    border-collapse: collapse;
    border-spacing: 0;
    width: 1200px;
}
</style>

<div class="head_color" style="background: #767171;">
    <h1 class="head_text"><?php echo "회원 관리" ?></h1>
	
</div>

<div id="member_list" class="respon_l" style="max-width: 1200px; margin: auto;">
    <div class="member_total">총회원수 : <?php echo number_format($total_count) ?>명</div>
    <div class="tbl_head01 tbl_wrap" style="overflow:auto;">
        <table>
        <caption><?php echo $g5['title']; ?> 목록</caption>
        <thead>
        <tr>
            <th>아이디</th>
            <th>소속</th>
            <th>이름</th>
            <th>등급</th>
            <th>핸드폰 번호</th>
            <th>이메일</th>
            <th>회원 등급</th>
        </tr>
        </thead>
       <tbody>
        <?php
        $sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
        $result = sql_query($sql);
        for ($i=0; $row=sql_fetch_array($result); $i++) {
            $mb_nick = get_sideview($row['mb_id'], get_text($row['mb_nick']), $row['mb_email'], $row['mb_homepage']);
        ?>
        <tr>
            <td class="td_1"><?php echo $row['mb_id']; ?></td>
            <td class="td_1"><?php echo $row['mb_2']; ?></td>
            <td class="td_1"><?php echo $row['mb_name']; ?></td>
            <td class="td_2"><?php echo $row['mb_level']; ?></td>
            <td class="td_2"><?php echo $row['mb_hp']; ?></td>
            <td class="td_2"><?php echo $row['mb_email']; ?></td>
            <!-- <td><?php echo $mb_nick; ?></td> -->
            <td class="td_2"><?php 
			if($row['mb_level']>=5){
				echo '<select id="member_gd_ch" onchange="changeMemberGrade(this)">
                <option value="관리자" selected>관리자</option>
                <option value="정회원" >정회원</option>
                <option value="일반회원" >일반회원</option>
                </select>';
			}else if ($row['mb_level']==2){
				echo '<select id="member_gd_ch" onchange="changeMemberGrade(this)">
                <option value="관리자" >관리자</option>
                <option value="정회원" selected>정회원</option>
                <option value="일반회원" >일반회원</option>
                </select>';
			} else {
				echo '<select id="member_gd_ch" onchange="changeMemberGrade(this)">
                <option value="관리자" >관리자</option>
                <option value="정회원" >정회원</option>
                <option value="일반회원" selected>일반회원</option>
                </select>';
			}; 
			?></td>
            <!-- <td class="td_1"><?php echo substr($row['mb_datetime'],2,8); ?></td> -->
        </tr>
        <?php } ?>
        </tbody>
        </table>
    </div>
</div>

<script>
	function changeMemberGrade(e) {
        console.dir(e);
        var gd_val = e.value;
        var gd_id = e.parentNode.parentNode.children[0].innerText;
        var data = {
            gd_val : gd_val,
            gd_id : gd_id
        // 		wr_id : <?php echo $view['wr_id'] ?>,
        // 		subject : "<?php echo $view['wr_subject'] ?>",
        // 		content : "<?php echo $view['wr_content'] ?>",
        // 		id  : "<?php echo $member['mb_id'] ?>",
        // 		hp  : "<?php echo $member['mb_hp'] ?>",
        // 		name : "<?php echo $member['mb_name'] ?>",
        // 		email : "<?php echo $member['mb_email'] ?>",
        // 		level : <?php echo $member['mb_level'] ?>,
        // 		group : "<?php echo $member['mb_2'] ?>"
        };
        
        var proposal = confirm('회원 등급을 변경하시겠습니까?');
        
        if(proposal == true){
            $.ajax({
                url: "http://www.kans.re.kr/origin_home/forum/admin/bbs/member_gd_change.php",
                type: "POST",
                //dataType: "json",
                data: data,
                success: function(result){
                    if(result=='fail'){
                        alert('오류');
                    } else{
                        console.log(result);
                        alert('변경 되었습니다.');
                    }
                },
                error: function(xhr, status, error){
                    alert(error);
                }
            });
        } else{
            alert('취소 되었습니다.');
        }
        
    }
</script>


<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

<?php
include_once(G5_PATH.'/tail.php');
?>