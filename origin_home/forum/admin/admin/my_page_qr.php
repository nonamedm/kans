<?
	include_once('./_common.php');	
	include_once "../common.php";
	include_once G5_MANAGE_INCLUDE_PATH . "/admin.head.sub.php";	//html 기본정보
	add_stylesheet('<link rel="stylesheet" href="https://www.kans.re.kr/theme/kans/mobile/skin/board/wt_comment/style.css">', 0);

	//화면의 성격
	$user_division = "user";	$screen_div = "sub"; //main, sub	$frame_div = "two";  //one, two

	//카테고리/페이지/상세페이지 명칭 & 카테고리 번호
	$cate_num = "9";	$page_num = "1"; 

	//현재 활성화 상태
	$gn_btn = "gn_btn".$cate_num;		$$gn_btn = "current";
	$ln_btn = "ln_btn".$page_num;		$$ln_btn = "current";
	$sln_btn = "sln_btn".$spage_num;		$$sln_btn = "current";

	include_once(G5_THEME_PATH.'/head.php');


	include_once("script.php");

	if(!$is_member){ alert("로그인 후 이용해주세요.", "https://www.kans.re.kr/origin_home/forum/admin/admin/login.php"); }

    $user_id = $_GET['userId'];
    $user_name = $_GET['userName'];
	$user_name = urldecode($user_name);
	
	
	($member['mb_id'] ? $member['mb_id'] : '미등록');
	($member['mb_level'] ? $member['mb_level'] : '미등록');

	if ($member['mb_level'] > 4) {
		//출석수행
		
	} else {
		alert("권한이 없습니다.", "https://www.kans.re.kr/origin_home/forum/admin/");
	}
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>
<style>
	#wrap {
		position: relative;
		display: block;
		height: 100%;
		background: #4c525d;
		box-sizing: border-box;
		overflow: hidden;
		margin-top: 0px !important;
	}
	.attInfo {
		width: 100%;
		height: 64px;
		font-size: 18px;
		font-family: 'Nanum Gothic', 'Malgun Gothic','맑은 고딕','돋움',Dotum,'굴림',Gulim, serif, sans-serif;
		color: #727881;
		background: #e5e7e9;
		border: 1px solid #adaeb0;
		box-shadow: inset 0 1px 2px #c6c7ca;
		box-sizing: border-box;
		line-height: 3em !important;
	}
	#forum_subject, .select2 {
		width: 100%;
		height: 64px;
		font-size: 18px;
		font-family: 'Nanum Gothic', 'Malgun Gothic','맑은 고딕','돋움',Dotum,'굴림',Gulim, serif, sans-serif;
		color: #727881;
		background: #e5e7e9;
		border: 1px solid #adaeb0;
		box-shadow: inset 0 1px 2px #c6c7ca;
		box-sizing: border-box;
		line-height: 3em !important;
		text-align: center;
	}
	.select2-selection {
		border: none !important;
		background: #e5e7e9 !important;
		margin-top: 15px;
	}
	.header {
		display: none;
	}

</style>

<div id="wrap">
	<form>
		<div class="login_box">
			<input type="hidden" name="url" value="<?php echo $login_url ?>" />
			<div class="login_cnt">
				<strong>포럼 참석 확인</strong>
				<a class="link">참석 확인할 포럼을 선택하세요.</a>
				<ul class="login_obj">
					<!-- <li>
						<span class="head">참석자ID</span>
						<input type="text" value="<?php echo $user_id ?>" readonly />
					</li> -->
					<li>
						<span class="head">참석자ID</span>
						<p class="attInfo"><?php echo $user_id ?></p>
					</li>
					<li>
						<span class="head">참석자명</span>
						<p class="attInfo"><?php echo $user_name ?></p>
					</li>
					<li>
					<select id="forum_subject" class="form-control" onchange="changeForumAttendant(this)">
						<?php
						$sql = "select * from g5_write_forum_info order by wr_id desc";
						$result = sql_query($sql);
						echo '<option value="">=====선택=====</option>' ;
						for ($i=0; $row=sql_fetch_array($result); $i++) {
							//$mb_nick = get_sideview($row['mb_id'], get_text($row['mb_nick']), $row['mb_email'], $row['mb_homepage']);
						?>
						<?php 
						if($_GET['wr_id']==$row['wr_id']) {
							echo '<option value="'?><?php echo $row['wr_id']; ?><?php echo '">' ;
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
					</li>
				</ul>
			</div>
		</div>
	</form>
</div>


<script type="text/javascript" >

	$(function(){
		$('#forum_subject').select2();
	});
	
	function changeForumAttendant(e) {
        var wr_id = e.selectedOptions[0].value;
        var data = {
            attend_yn : "y",
            gd_id : "<?php echo $user_id ?>",
            wr_id : wr_id,
            level : <?php echo $member['mb_level'] ?>,
        // 		subject : "<?php echo $view['wr_subject'] ?>",
        // 		content : "<?php echo $view['wr_content'] ?>",
        // 		id  : "<?php echo $member['mb_id'] ?>",
        // 		hp  : "<?php echo $member['mb_hp'] ?>",
        // 		name : "<?php echo $member['mb_name'] ?>",
        // 		email : "<?php echo $member['mb_email'] ?>",
        // 		group : "<?php echo $member['mb_2'] ?>"
        };
        
        var proposal = confirm('참석 여부를 변경하시겠습니까?');
        
        if(proposal == true){
            $.ajax({
                url: "https://www.kans.re.kr/origin_home/forum/admin/bbs/forum_attendance_change.php",
                type: "POST",
                //dataType: "json",
                data: data,
                success: function(result){
                    if(result=='fail'){
                        alert('오류 : 참석자와 포럼정보를 확인하여 주시길 바랍니다.');
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

<?php

include_once G5_MANAGE_INCLUDE_PATH . "/admin.tail.sub.php";

?>