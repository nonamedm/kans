<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

function get_mshop_category($ca_id, $len)
{
    global $g5;

    $sql = " select ca_id, ca_name from {$g5['g5_shop_category_table']}
                where ca_use = '1' ";
    if($ca_id)
        $sql .= " and ca_id like '$ca_id%' ";
    $sql .= " and length(ca_id) = '$len' order by ca_order, ca_id ";

    return $sql;
}
?>

<button type="button" id="hd_ct">분류</button>
<div id="category">
    <div class="ct_wr">
        <form name="frmsearch1" action="<?php echo G5_SHOP_URL; ?>/search.php" onsubmit="return search_submit(this);">
        <aside id="hd_sch">
            <div class="sch_inner">
                <h2>상품 검색</h2>
                <label for="sch_str" class="sound_only">상품명<strong class="sound_only"> 필수</strong></label>
                <input type="text" name="q" value="<?php echo stripslashes(get_text(get_search_string($q))); ?>" id="sch_str" required class="frm_input">
                <input type="submit" value="검색" class="btn_submit">
            </div>
        </aside>
        </form>
        <script>
            $(function (){
            var $hd_sch = $("#hd_sch");
            $("#hd_sch_open").click(function(){
                $hd_sch.css("display","block");
            });
            $("#hd_sch .pop_close").click(function(){
                $hd_sch.css("display","none");
            });
        });

        function search_submit(f) {
            if (f.q.value.length < 2) {
                alert("검색어는 두글자 이상 입력하십시오.");
                f.q.select();
                f.q.focus();
                return false;
            }

            return true;
        }
        </script>

        <div id="hd_tnb">
            <?php if ($is_member) { ?>
            <?php if ($is_admin) {  ?>
            <a href="<?php echo G5_ADMIN_URL; ?>/shop_admin/" class="tnb_admin">관리자</a>
            <?php } else { ?>
            <?php } ?>
            <a href="<?php echo G5_SHOP_URL; ?>/mypage.php" class="tnb_my">마이페이지</a>
            <a href="<?php echo G5_BBS_URL; ?>/logout.php?url=shop" class="tnb_logout">로그아웃</a>

            <?php } else { ?>
            <a href="<?php echo G5_BBS_URL; ?>/login.php?url=<?php echo $urlencode; ?>" class="tnb_login">로그인</a>
            <!--회원가입 사용시 로그인 class="tnb_my"로 변경해서 사용하세요-->
            <!--<a href="<?php echo G5_BBS_URL; ?>/register.php" class="tnb_logout">회원가입</a>-->
            <?php } ?>
        </div>

        <ul id="hd_mb">
            <li><a href="<?php echo G5_SHOP_URL; ?>/orderinquiry.php">주문조회</a></li>
            <li><a href="<?php echo G5_SHOP_URL; ?>/personalpay.php">개인결제</a></li>
            <li><a href="<?php echo G5_SHOP_URL; ?>/itemuselist.php">리뷰</a></li>
            <li><a href="<?php echo G5_SHOP_URL; ?>/itemqalist.php">QA</a></li>
            <li><a href="<?php echo G5_BBS_URL; ?>/faq.php">고객센터</a></li>
            <li><a href="<?php echo G5_BBS_URL; ?>/qalist.php">1:1문의</a></li>
            <li><a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=5">세일상품</a></li>
            <li><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=gallery">갤러리</a></li>

        </ul>

        <?php
        $mshop_ca_href = G5_SHOP_URL.'/list.php?ca_id=';
        $mshop_ca_res1 = sql_query(get_mshop_category('', 2));
        for($i=0; $mshop_ca_row1=sql_fetch_array($mshop_ca_res1); $i++) {
            if($i == 0)
                echo '<ul class="cate">'.PHP_EOL;
        ?>
            <li>
                <a href="<?php echo $mshop_ca_href.$mshop_ca_row1['ca_id']; ?>"><?php echo get_text($mshop_ca_row1['ca_name']); ?></a>
                <?php
                $mshop_ca_res2 = sql_query(get_mshop_category($mshop_ca_row1['ca_id'], 4));
                if(sql_num_rows($mshop_ca_res2))
                    echo '<button class="sub_ct_toggle ct_op">'.get_text($mshop_ca_row1['ca_name']).' 하위분류 열기</button>'.PHP_EOL;

                for($j=0; $mshop_ca_row2=sql_fetch_array($mshop_ca_res2); $j++) {
                    if($j == 0)
                        echo '<ul class="sub_cate sub_cate1">'.PHP_EOL;
                ?>
                    <li>
                        <a href="<?php echo $mshop_ca_href.$mshop_ca_row2['ca_id']; ?>">- <?php echo get_text($mshop_ca_row2['ca_name']); ?></a>
                        <?php
                        $mshop_ca_res3 = sql_query(get_mshop_category($mshop_ca_row2['ca_id'], 6));
                        if(sql_num_rows($mshop_ca_res3))
                            echo '<button type="button" class="sub_ct_toggle ct_op">'.get_text($mshop_ca_row2['ca_name']).' 하위분류 열기</button>'.PHP_EOL;

                        for($k=0; $mshop_ca_row3=sql_fetch_array($mshop_ca_res3); $k++) {
                            if($k == 0)
                                echo '<ul class="sub_cate sub_cate2">'.PHP_EOL;
                        ?>
                            <li>
                                <a href="<?php echo $mshop_ca_href.$mshop_ca_row3['ca_id']; ?>">- <?php echo get_text($mshop_ca_row3['ca_name']); ?></a>
                                <?php
                                $mshop_ca_res4 = sql_query(get_mshop_category($mshop_ca_row3['ca_id'], 8));
                                if(sql_num_rows($mshop_ca_res4))
                                    echo '<button type="button" class="sub_ct_toggle ct_op">'.get_text($mshop_ca_row3['ca_name']).' 하위분류 열기</button>'.PHP_EOL;

                                for($m=0; $mshop_ca_row4=sql_fetch_array($mshop_ca_res4); $m++) {
                                    if($m == 0)
                                        echo '<ul class="sub_cate sub_cate3">'.PHP_EOL;
                                ?>
                                    <li>
                                        <a href="<?php echo $mshop_ca_href.$mshop_ca_row4['ca_id']; ?>">- <?php echo get_text($mshop_ca_row4['ca_name']); ?></a>
                                        <?php
                                        $mshop_ca_res5 = sql_query(get_mshop_category($mshop_ca_row4['ca_id'], 10));
                                        if(sql_num_rows($mshop_ca_res5))
                                            echo '<button type="button" class="sub_ct_toggle ct_op">'.get_text($mshop_ca_row4['ca_name']).' 하위분류 열기</button>'.PHP_EOL;

                                        for($n=0; $mshop_ca_row5=sql_fetch_array($mshop_ca_res5); $n++) {
                                            if($n == 0)
                                                echo '<ul class="sub_cate sub_cate4">'.PHP_EOL;
                                        ?>
                                            <li>
                                                <a href="<?php echo $mshop_ca_href.$mshop_ca_row5['ca_id']; ?>">- <?php echo get_text($mshop_ca_row5['ca_name']); ?></a>
                                            </li>
                                        <?php
                                        }

                                        if($n > 0)
                                            echo '</ul>'.PHP_EOL;
                                        ?>
                                    </li>
                                <?php
                                }

                                if($m > 0)
                                    echo '</ul>'.PHP_EOL;
                                ?>
                            </li>
                        <?php
                        }

                        if($k > 0)
                            echo '</ul>'.PHP_EOL;
                        ?>
                    </li>
                <?php
                }

                if($j > 0)
                    echo '</ul>'.PHP_EOL;
                ?>
            </li>
        <?php
        }

        if($i > 0)
            echo '</ul>'.PHP_EOL;
        else
            echo '<p class="no-cate">등록된 분류가 없습니다.</p>'.PHP_EOL;
        ?>
        <button type="button" class="pop_close"><img src="<?php echo G5_THEME_IMG_URL; ?>/menu_close.gif" alt="닫기"></button>
    </div>
</div>

<script>
$(function (){
    var $category = $("#category");

    $("#hd_ct").on("click", function() {
        $category.css("display","block");
    });

    $("#category .pop_close").on("click", function(){
        $category.css("display","none");
    });

    $("button.sub_ct_toggle").on("click", function() {
        var $this = $(this);
        $sub_ul = $(this).closest("li").children("ul.sub_cate");

        if($sub_ul.size() > 0) {
            var txt = $this.text();

            if($sub_ul.is(":visible")) {
                txt = txt.replace(/닫기$/, "열기");
                $this
                    .removeClass("ct_cl")
                    .text(txt);
            } else {
                txt = txt.replace(/열기$/, "닫기");
                $this
                    .addClass("ct_cl")
                    .text(txt);
            }

            $sub_ul.toggle();
        }
    });
});
</script>
