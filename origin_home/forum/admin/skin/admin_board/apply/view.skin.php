<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<!-- 게시물 읽기 시작 { -->
<div id="bo_v_table"><?php echo $board['bo_subject']; ?></div>

<table class="vertical">
	<colgroup span="4">
		<col width="15%" />
		<col width="35%" />
		<col width="15%" />
		<col width="35%" />
	</colgroup>
	<tr>
		<th scope="row">예약자</th>
		<td class="">
			<?php echo $view['name']?>
		</td>
		<th scope="row">휴대폰번호</th>
		<td class="">
			<?php echo $view['wr_6']?>
		</td>
	</tr>
	<tr>
		<th scope="row">예약일시</th>
		<td class="">
			<?php echo $view['wr_2']?> <?php echo $view['wr_3']?>
		</td>
		<th scope="row">예약인원</th>
		<td class="">
			<?php echo $view['wr_4']?>
		</td>
	</tr>
	<tr>
		<th scope="row">예약상태</th>
		<td colspan="3" class="">
			<select id="wr_10_status" name="wr_10" title="">
				<option value="j" <?php echo ($view['wr_10'] == "j" || $view['wr_10'] == "")? "selected" : ""?> >접수</option>
				<option value="f" <?php echo ($view['wr_10'] == "f")? "selected" : ""?> >확정</option>
				<option value="c" <?php echo ($view['wr_10'] == "c")? "selected" : ""?> >취소</option>
			</select>
		</td>
	</tr>
	<tr>
		<th scope="row">요청사항</th>
		<td colspan="3" class="left">
			<?php echo $view['content']?>
		</td>
	</tr>
</table>
<div class="btn_area">
	<div class="btn_area_left">
		<?php if($update_href){?>
			<button class="btn_normal" onclick="location.href='<?php echo $update_href?>'" type="button">수정</button>
		<?php } ?>

		<?php if($delete_href){?>
			<button class="btn_normal" onclick="location.href='<?php echo $delete_href?>'" type="button">삭제</button>
		<?php } ?>
	</div>
	<div class="btn_area_center"></div>
	<div class="btn_area_right">
		<button class="btn_normal" type="button" onclick="location.href='<?php echo $list_href?>'">목록</button>
	</div>
</div>

<!-- } 게시판 읽기 끝 -->

<script>
<?php if ($board['bo_download_point'] < 0) { ?>
$(function() {
    $("a.view_file_download").click(function() {
        if(!g5_is_member) {
            alert("다운로드 권한이 없습니다.\n회원이시라면 로그인 후 이용해 보십시오.");
            return false;
        }

        var msg = "파일을 다운로드 하시면 포인트가 차감(<?php echo number_format($board['bo_download_point']) ?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?";

        if(confirm(msg)) {
            var href = $(this).attr("href")+"&js=on";
            $(this).attr("href", href);

            return true;
        } else {
            return false;
        }
    });
});
<?php } ?>

function board_move(href)
{
    window.open(href, "boardmove", "left=50, top=50, width=500, height=550, scrollbars=1");
}
</script>

<script>
$(function() {
    $("a.view_image").click(function() {
        window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
        return false;
    });

    // 추천, 비추천
    $("#good_button, #nogood_button").click(function() {
        var $tx;
        if(this.id == "good_button")
            $tx = $("#bo_v_act_good");
        else
            $tx = $("#bo_v_act_nogood");

        excute_good(this.href, $(this), $tx);
        return false;
    });

    // 이미지 리사이즈
    $("#bo_v_atc").viewimageresize();

});

$(function(){
	var currentStatus = "";
	
	//현재 상태 저장
	$("#wr_10_status").focus(function(){
		currentStatus = $(this).val();
	});

	var lookup_status = {'j' : '접수', 'f' : "확정", 'c' : "취소"}

	$("#wr_10_status").change(function(e){

		var wr_id = "<?php echo $wr_id?>";
		var tmp_status = currentStatus;
		var changeValue = $(this).val();

		
		
		if(!confirm("합격상태를 " + lookup_status[changeValue] + "상태로 변경하시겠습니까?")){
			console.log(tmp_status);
			$(this).find("option[value='" + tmp_status + "']").prop("selected", "true");
			return;
		}
		
		$.post("<?php echo G5_URL?>/include/loadData2.php", {
			gu : 'changeStatus',
			wr_id : wr_id,
			value : changeValue
		}, function(rst){

			if(rst != 'success'){

				$(this).find("option[val='" + tmp_status + "']").prop("selected", "true");
				return;

			}else{

				alert("상태값이 성공적으로 변경되었습니다");

			}

		});
	});
});

function excute_good(href, $el, $tx)
{
    $.post(
        href,
        { js: "on" },
        function(data) {
            if(data.error) {
                alert(data.error);
                return false;
            }

            if(data.count) {
                $el.find("strong").text(number_format(String(data.count)));
                if($tx.attr("id").search("nogood") > -1) {
                    $tx.text("이 글을 비추천하셨습니다.");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                } else {
                    $tx.text("이 글을 추천하셨습니다.");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                }
            }
        }, "json"
    );
}
</script>
<!-- } 게시글 읽기 끝 -->