<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<script>
// 글자수 제한
var char_min = parseInt(<?php echo $comment_min ?>); // 최소
var char_max = parseInt(<?php echo $comment_max ?>); // 최대
</script>

<!-- 댓글 리스트 -->
<section id="bo_vc">
    <h2>댓글</h2>
    <?php
    for ($i=0; $i<count($list); $i++) {
        $comment_id = $list[$i]['wr_id'];
        $cmt_depth = ""; // 댓글단계
        $cmt_depth = strlen($list[$i]['wr_comment_reply']) * 20;
        $datetime_str = $list[i]['datetime'];

            $str = $list[$i]['content'];
            if (strstr($list[$i]['wr_option'], "secret"))
                $str = $str;
            $str = preg_replace("/\[\<a\s.*href\=\"(http|https|ftp|mms)\:\/\/([^[:space:]]+)\.(mp3|wma|wmv|asf|asx|mpg|mpeg)\".*\<\/a\>\]/i", "<script>doc_write(obj_movie('$1://$2.$3'));</script>", $str);
    ?>
    <article id="c_<?php echo $comment_id ?>" <?php if ($cmt_depth) { ?>style="margin-left:<?php echo $cmt_depth ?>px;border-top-color:#e0e0e0"<?php } ?>>
        <!--<header>
            <h1><?php echo get_text($list[$i]['wr_name']); ?>님의 댓글</h1>
            <?php echo $list[$i]['name'] ?>
            <?php if ($cmt_depth) { ?><img src="<?php echo $board_skin_url ?>/img/icon_reply.gif" alt="댓글의 댓글" class="icon_reply"><?php } ?>
            <?php if ($is_ip_view) { ?>
            아이피
            <span class="bo_vc_hdinfo"><?php echo $list[$i]['ip']; ?></span>
            <?php } ?>
            작성일
            <span class="bo_vc_hdinfo"><time datetime="<?php echo date('Y-m-d\TH:i:s+09:00', strtotime($list[$i]['datetime'])) ?>"><?php echo $list[$i]['datetime'] ?></time></span>
            <?php
            include(G5_SNS_PATH."/view_comment_list.sns.skin.php");
            ?>
        </header>-->

        <!-- 댓글 출력 -->
        <div style="display:flex;">
            <div class="comment_inline" style="width: 15%; color: grey; text-align: left; padding: 5px;"><?php echo $list[$i]['name'] ?></div>
            <!--<div><?php if (strstr($list[$i]['wr_option'], "secret")) ?></div>-->
            <div class="comment_inline" style="width: 65%; color: grey; text-align: left; padding: 5px;"><span><?php echo $str ?></span></div>
            <div class="comment_inline" style="width: 17%; color: grey; text-align: center; padding: 5px;"><span><?php echo $list[$i]['datetime'] ?></span></div>
            <div class="comment_inline" style="width: 3%; color: grey; text-align: center; padding: 5px; cursor:pointer;" onclick="comment_delete('<?php echo $list[$i]['mb_id'] ?>','<?php echo $comment_id ?>');"><span>X</span></div>
        </div>


        <span id="edit_<?php echo $comment_id ?>"></span><!-- 수정 -->
        <span id="reply_<?php echo $comment_id ?>"></span><!-- 답변 -->

        <input type="hidden" id="secret_comment_<?php echo $comment_id ?>" value="<?php echo strstr($list[$i]['wr_option'],"secret") ?>">

        <textarea id="save_comment_<?php echo $comment_id ?>" style="display:none"><?php echo get_text($list[$i]['content1'], 0) ?></textarea>

        <?php if($list[$i]['is_reply'] || $list[$i]['is_edit'] || $list[$i]['is_del']) {
            $query_string = clean_query_string($_SERVER['QUERY_STRING']);

            if($w == 'cu') {
                $sql = " select wr_id, wr_content, mb_id from $write_table where wr_id = '$c_id' and wr_is_comment = '1' order by wr_id desc";
                $cmt = sql_fetch($sql);
                if (!($is_admin || ($member['mb_id'] == $cmt['mb_id'] && $cmt['mb_id'])))
                    $cmt['wr_content'] = '';
                $c_wr_content = $cmt['wr_content'];
            }

            $c_reply_href = './board.php?'.$query_string.'&amp;c_id='.$comment_id.'&amp;w=c#bo_vc_w';
            $c_edit_href = './board.php?'.$query_string.'&amp;c_id='.$comment_id.'&amp;w=cu#bo_vc_w';
        ?>
        <footer>
            
        </footer>
        <?php } ?>
    </article>
    <?php } ?>
    <?php if ($i == 0) { //댓글이 없다면 ?><p id="bo_vc_empty">등록된 댓글이 없습니다.</p><?php } ?>

</section>

    <aside id="bo_vc_w">
        <!--<h2>댓글쓰기</h2>-->
        <form name="fviewcomment" action="./insert_comment_by.php" method="post" autocomplete="off">
        <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
        <input type="hidden" name="comment_id" value="<?php echo $member['mb_id'] ?>" id="comment_id">
        <input type="hidden" name="comment_id2" value="<?php echo $member['mb_id'] ?>" id="comment_id2">
        <input type="hidden" name="comment_name" value="<?php echo $member['mb_name'] ?>" id="comment_name">
        <input type="hidden" name="wr_email" value="<?php echo $member['mb_email'] ?>" id="wr_email">

        <div class="tbl_frm01 tbl_wrap">
            <table>
            <tbody>
                
                <?php if ($comment_min || $comment_max) { ?><strong id="char_cnt"><span id="char_count"></span>글자</strong><?php } ?>
                <textarea id="wr_content" name="wr_content" required title="댓글 내용" placeholder="댓글을 입력해 주세요."
                <?php if ($comment_min || $comment_max) { ?>onkeyup="check_byte('wr_content', 'char_count');"<?php } ?>><?php echo $c_wr_content; ?></textarea>
                <?php if ($comment_min || $comment_max) { ?><script> check_byte('wr_content', 'char_count'); </script><?php } ?>
            
            </tbody>
            </table>
        </div>

        <div class="btn_confirm" style="text-align: right !important; width: 99%;">
            <input type="submit" value="댓글등록" id="btn_submit" class="wt_btn" accesskey="s">
        </div>

        </form>
    </aside>

    <script>
    var save_before = '';
    var save_html = document.getElementById('bo_vc_w').innerHTML;

    function good_and_write()
    {
        var f = document.fviewcomment;
        if (fviewcomment_submit(f)) {
            f.is_good.value = 1;
            f.submit();
        } else {
            f.is_good.value = 0;
        }
    }

    function fviewcomment_submit(f)
    {
        var pattern = /(^\s*)|(\s*$)/g; // \s 공백 문자

        f.is_good.value = 0;

        /*
        var s;
        if (s = word_filter_check(document.getElementById('wr_content').value))
        {
            alert("내용에 금지단어('"+s+"')가 포함되어있습니다");
            document.getElementById('wr_content').focus();
            return false;
        }
        */

        var subject = "";
        var content = "";
        $.ajax({
            url: g5_bbs_url+"/ajax.filter.php",
            type: "POST",
            data: {
                "subject": "",
                "content": f.wr_content.value
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function(data, textStatus) {
                subject = data.subject;
                content = data.content;
            }
        });

        if (content) {
            alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
            f.wr_content.focus();
            return false;
        }

        // 양쪽 공백 없애기
        var pattern = /(^\s*)|(\s*$)/g; // \s 공백 문자
        document.getElementById('wr_content').value = document.getElementById('wr_content').value.replace(pattern, "");
        if (char_min > 0 || char_max > 0)
        {
            check_byte('wr_content', 'char_count');
            var cnt = parseInt(document.getElementById('char_count').innerHTML);
            if (char_min > 0 && char_min > cnt)
            {
                alert("댓글은 "+char_min+"글자 이상 쓰셔야 합니다.");
                return false;
            } else if (char_max > 0 && char_max < cnt)
            {
                alert("댓글은 "+char_max+"글자 이하로 쓰셔야 합니다.");
                return false;
            }
        }
        else if (!document.getElementById('wr_content').value)
        {
            alert("댓글을 입력하여 주십시오.");
            return false;
        }

        if (typeof(f.wr_name) != 'undefined')
        {
            f.wr_name.value = f.wr_name.value.replace(pattern, "");
            if (f.wr_name.value == '')
            {
                alert('이름이 입력되지 않았습니다.');
                f.wr_name.focus();
                return false;
            }
        }

        if (typeof(f.wr_password) != 'undefined')
        {
            f.wr_password.value = f.wr_password.value.replace(pattern, "");
            if (f.wr_password.value == '')
            {
                alert('비밀번호가 입력되지 않았습니다.');
                f.wr_password.focus();
                return false;
            }
        }

        <?php if($is_guest) echo chk_captcha_js(); ?>

        set_comment_token(f);

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }

    function comment_box(comment_id, work)
    {
        var el_id;
        // 댓글 아이디가 넘어오면 답변, 수정
        if (comment_id)
        {
            if (work == 'c')
                el_id = 'reply_' + comment_id;
            else
                el_id = 'edit_' + comment_id;
        }
        else
            el_id = 'bo_vc_w';

        if (save_before != el_id)
        {
            if (save_before)
            {
                document.getElementById(save_before).style.display = 'none';
                document.getElementById(save_before).innerHTML = '';
            }

            document.getElementById(el_id).style.display = '';
            document.getElementById(el_id).innerHTML = save_html;
            // 댓글 수정
            if (work == 'cu')
            {
                document.getElementById('wr_content').value = document.getElementById('save_comment_' + comment_id).value;
                if (typeof char_count != 'undefined')
                    check_byte('wr_content', 'char_count');
                if (document.getElementById('secret_comment_'+comment_id).value)
                    document.getElementById('wr_secret').checked = true;
                else
                    document.getElementById('wr_secret').checked = false;
            }

            document.getElementById('comment_id').value = comment_id;
            document.getElementById('w').value = work;

            if(save_before)
                $("#captcha_reload").trigger("click");

            save_before = el_id;
        }
    }

    function comment_delete(id, idx) {
        var confirmText = confirm("이 댓글을 삭제하시겠습니까?");
        var dataText = {"wrId" : idx}
        if(confirmText) {
            //debugger;
            if((<?php echo $member['mb_level'] ?> >= 5) || ("<?php echo $member['$mbId'] ?>"==id)) {
                $.ajax({
                    url: './delete_comment_by.php',
                    type: "POST",
                    data: dataText,
                    success: function(resultText) {
                        alert("삭제되었습니다");
                        document.location.reload(true);
                    },
                    error: function(xhr, status, error){
                        alert(error);
                    }
                });

            } else {
                alert("작성자 또는 관리자만 삭제할 수 있습니다");
            }
        } else {
            
        }

    }

    function report(){
        if(!confirm("해당 글을 신고하시겠습니까?")){
            alert("취소하셨습니다.")
        } else {
            $("#reportPopup").css("display","block");
            //alert("신고되었습니다.")
        }
    }
    function submitReport(){
        if(!confirm("제출하시겠습니까?")){
            alert("취소하셨습니다.");
            $("#reportPopup").css("display","none");
        } else {
            alert("신고되었습니다.") 
            $("#reportPopup").css("display","none");
        }
    }
    function cancelReport(){
        $("#reportPopup").css("display","none");
    }

    comment_box('', 'c'); // 댓글 입력폼이 보이도록 처리하기위해서 추가 (root님)

    <?php if($board['bo_use_sns'] && ($config['cf_facebook_appid'] || $config['cf_twitter_key'])) { ?>
    // sns 등록
    $(function() {
        $("#bo_vc_send_sns").load(
            "<?php echo G5_SNS_URL; ?>/view_comment_write.sns.skin.php?bo_table=<?php echo $bo_table; ?>",
            function() {
                save_html = document.getElementById('bo_vc_w').innerHTML;
            }
        );
    });
    <?php } ?>
    </script>

