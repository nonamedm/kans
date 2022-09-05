<?php
$forum_list_vr = 'forum';
include_once('./_common.php');

$sql_common = " from g5_write_forum_req ";

//$sql_search = " where (1) ";

$sql_subject = $_GET['wr_id'];
if($sql_subject=='') {
    $sql_subject = "(select wr_id from g5_write_forum_info order by wr_id desc limit 1)";
}

$sql_order = " order by req_id desc "; // 포인트 순위로 정렬

$sql = " select count(*) as cnt {$sql_common} {$sql_search} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = 20; // 목록수
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$g5['title'] = '포럼 신청목록';
include_once('/kans1/www/origin_home/forum/admin/theme/kans/mobile/head.php');
add_stylesheet('<link rel="stylesheet" href="http://www.kans.re.kr/theme/kans/mobile/skin/board/wt_comment/style.css">', 0);
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
</style>

<div class="head_color" style="background: #9AD6FF;">
    <h1 class="head_text"><?php echo "포럼 신청 관리" ?></h1>
	<img class="head_img" src="http://www.kans.re.kr/img/포럼안내.png" title="search">
</div>

<div id="member_list" class="respon_l" style="max-width: 1200px; margin: auto;">
    
    <div class="member_total" style="display: flex; flex-direction: row; justify-content: flex-start;">
        <div style="width: 110px; padding-left: 70px;">포럼명 </div>
        <div style="width: 500px;">
            <!-- <div id="forum_subject" class="ui fluid search selection dropdown">
                <input type="hidden" name="country">
                <i class="dropdown icon"></i>
                <div class="default text">Select Country</div>
                <div class="menu">
                    <div class="item" data-value="af"><i class="af flag"></i>Afghanistan</div>
                </div>
            </div> -->
            <select id="forum_subject" onchange="changeForumSubject(this)">
            <?php
            $sql = "select * from g5_write_forum_info order by wr_id desc";
            $result = sql_query($sql);
            for ($i=0; $row=sql_fetch_array($result); $i++) {
                //$mb_nick = get_sideview($row['mb_id'], get_text($row['mb_nick']), $row['mb_email'], $row['mb_homepage']);
            ?>
            <?php 
            if($_GET['wr_id']==$row['wr_id']) {
                echo '<option value="'?><?php echo $row['wr_id']; ?><?php echo '" selected>' ;
            } else {
                echo '<option value="'?><?php echo $row['wr_id']; ?><?php echo '">' ;
            }
            ?>
            <?php echo 
                $row['wr_subject'];
            ?>
            <?php echo '</option>' ?>
            <?php } ?>
            </select>
        </div>
    </div>
    <div class="tbl_head01 tbl_wrap">
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
            <th>출석 여부</th>
            <th style="display:none;">포럼id</th>
        </tr>
        </thead>
       <tbody>
        <?php
        $sql = " select * {$sql_common} where wr_id={$sql_subject} limit {$from_record}, {$rows} ";
        $result = sql_query($sql);
        for ($i=0; $row=sql_fetch_array($result); $i++) {
            //$mb_nick = get_sideview($row['mb_id'], get_text($row['mb_nick']), $row['mb_email'], $row['mb_homepage']);
        ?>
        <tr>
            <td class="td_1"><?php echo $row['mb_id']; ?></td>
            <td class="td_1"><?php echo $row['mb_2']; ?></td>
            <td class="td_1"><?php echo $row['wr_name']; ?></td>
            <td class="td_2"><?php echo $row['mb_level']; ?></td>
            <td class="td_2"><?php echo $row['mb_hp']; ?></td>
            <td class="td_2"><?php echo $row['wr_email']; ?></td>
            <!-- <td><?php echo $mb_nick; ?></td> -->
            <td class="td_2"><?php 
			if($row['attendant_yn']=='n'){
				echo '<select id="forum_att_ch" onchange="changeForumAttendant(this)">
                <option value="n" selected>n</option>
                <option value="y" >y</option>
                </select>';
			}else{
				echo '<select id="forum_att_ch" onchange="changeForumAttendant(this)">
                <option value="n" >n</option>
                <option value="y" selected>y</option>
                </select>';
			} ; 
			?></td>
            <td style="display:none;"><?php echo $row['wr_id']; ?></td>
            <!-- <td class="td_1"><?php echo substr($row['mb_datetime'],2,8); ?></td> -->
        </tr>
        <?php } ?>
        </tbody>
        </table>
    </div>
</div>

<script>
	function changeForumAttendant(e) {
        var attend_yn = e.value;
        var gd_id = e.parentNode.parentNode.children[0].innerText;
        var wr_id = e.parentNode.parentNode.children[7].innerText;
        var data = {
            attend_yn : attend_yn,
            gd_id : gd_id,
            wr_id : wr_id
        // 		subject : "<?php echo $view['wr_subject'] ?>",
        // 		content : "<?php echo $view['wr_content'] ?>",
        // 		id  : "<?php echo $member['mb_id'] ?>",
        // 		hp  : "<?php echo $member['mb_hp'] ?>",
        // 		name : "<?php echo $member['mb_name'] ?>",
        // 		email : "<?php echo $member['mb_email'] ?>",
        // 		level : <?php echo $member['mb_level'] ?>,
        // 		group : "<?php echo $member['mb_2'] ?>"
        };
        
        var proposal = confirm('참석 여부를 변경하시겠습니까?');
        
        if(proposal == true){
            $.ajax({
                url: "http://www.kans.re.kr/origin_home/forum/admin/bbs/forum_attendance_change.php",
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
	function changeForumSubject(e) {
        var wr_id = e.value;
        var data = {
            wr_id : wr_id
        }
        location.href = "http://www.kans.re.kr/origin_home/forum/admin/bbs/forum_list.php?wr_id="+wr_id;
        // $.ajax({
        //         url: "http://www.kans.re.kr/origin_home/forum/admin/bbs/forum_list.php",
        //         type: "GET",
        //         //dataType: "json",
        //         data: data,
        //         success: function(result){
        //             if(result=='fail'){
        //                 alert('오류');
        //             } else{
        //                 console.dir(result);
        //                 //alert('변경 되었습니다.');
        //             }
        //         },
        //         error: function(xhr, status, error){
        //             alert(error);
        //         }
        // });
    }
</script>


<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

<?php
include_once(G5_PATH.'/tail.php');
?>