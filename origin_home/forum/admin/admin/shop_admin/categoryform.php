<?php
$sub_menu = '400200';
include_once('./_common.php');
include_once(G5_EDITOR_LIB);

auth_check($auth[$sub_menu], "w");

$g5['title'] = "환경설정 > 인피아드 관리자모드";	//title
$category_title = "환경설정";	//카테고리 제목
$sub_title = "분류관리";	//서브 타이틀
include_once G5_MANAGE_INCLUDE_PATH . "/admin_header.php";

$sql_common = " from {$g5['g5_shop_category_table']} ";
if ($is_admin != 'super')
    $sql_common .= " where ca_mb_id = '{$member['mb_id']}' ";

if ($w == "")
{
    if ($is_admin != 'super' && !$ca_id)
        alert("최고관리자만 1단계 분류를 추가할 수 있습니다.");

    $len = strlen($ca_id);
	if ($len == 10)
        alert("분류를 더 이상 추가할 수 없습니다.\\n\\n5단계 분류까지만 가능합니다.");

    $len2 = $len + 1;

    $sql = " select MAX(SUBSTRING(ca_id,$len2,2)) as max_subid from {$g5['g5_shop_category_table']}
              where SUBSTRING(ca_id,1,$len) = '$ca_id' ";
    $row = sql_fetch($sql);

    $subid = base_convert($row['max_subid'], 36, 10);
    $subid += 36;
    if ($subid >= 36 * 36)
    {
        //alert("분류를 더 이상 추가할 수 없습니다.");
        // 빈상태로
        $subid = "  ";
    }
    $subid = base_convert($subid, 10, 36);
    $subid = substr("00" . $subid, -2);
    $subid = $ca_id . $subid;

    $sublen = strlen($subid);

    if ($ca_id) // 2단계이상 분류
    {
        $sql = " select * from {$g5['g5_shop_category_table']} where ca_id = '$ca_id' ";
        $ca = sql_fetch($sql);
        $html_title = $ca['ca_name'] . " 하위분류추가";
        $ca['ca_name'] = "";
    }
    else // 1단계 분류
    {
        $html_title = "1단계분류추가";
        $ca['ca_use'] = 1;
        $ca['ca_explan_html'] = 1;
        $ca['ca_img_width']  = $default['de_simg_width'];
        $ca['ca_img_height'] = $default['de_simg_height'];
        $ca['ca_mobile_img_width']  = $default['de_simg_width'];
        $ca['ca_mobile_img_height'] = $default['de_simg_height'];
        $ca['ca_list_mod'] = 3;
        $ca['ca_list_row'] = 5;
        $ca['ca_mobile_list_mod'] = 3;
        $ca['ca_mobile_list_row'] = 5;
        $ca['ca_stock_qty'] = 99999;
    }
    $ca['ca_skin'] = "list.10.skin.php";
    $ca['ca_mobile_skin'] = "list.10.skin.php";
}
else if ($w == "u")
{
    $sql = " select * from {$g5['g5_shop_category_table']} where ca_id = '$ca_id' ";
    $ca = sql_fetch($sql);
    if (!$ca['ca_id'])
        alert("자료가 없습니다.");

    $html_title = $ca['ca_name'] . " 수정";
    $ca['ca_name'] = get_text($ca['ca_name']);
}

$g5['title'] = $html_title;
include_once G5_MANAGE_INCLUDE_PATH . "/admin_header.php";

/*
$pg_anchor ='<ul class="anchor">
<li><a href="#anc_scatefrm_basic">필수입력</a></li>
<li><a href="#anc_scatefrm_optional">선택입력</a></li>';
if ($w == 'u') $pg_anchor .= '<li><a href="#frm_etc">기타설정</a></li>';
$pg_anchor .= '</ul>';
*/

$frm_submit = '<div class="btn_confirm01 btn_confirm">
    <input type="submit" value="확인" class="btn_submit" accesskey="s">
    <a href="./categorylist.php?'.$qstr.'">목록</a>
</div>';

// 스킨 Path
if(!$ca['ca_skin_dir'])
    $g5_shop_skin_path = G5_SHOP_SKIN_PATH;
else {
    if(preg_match('#^theme/(.+)$#', $ca['ca_skin_dir'], $match))
        $g5_shop_skin_path = G5_THEME_PATH.'/'.G5_SKIN_DIR.'/shop/'.$match[1];
    else
        $g5_shop_skin_path  = G5_PATH.'/'.G5_SKIN_DIR.'/shop/'.$ca['ca_skin_dir'];
}

if(!$ca['ca_mobile_skin_dir'])
    $g5_mshop_skin_path = G5_MSHOP_SKIN_PATH;
else {
    if(preg_match('#^theme/(.+)$#', $ca['ca_mobile_skin_dir'], $match))
        $g5_mshop_skin_path = G5_THEME_MOBILE_PATH.'/'.G5_SKIN_DIR.'/shop/'.$match[1];
    else
        $g5_mshop_skin_path = G5_MOBILE_PATH.'/'.G5_SKIN_DIR.'/shop/'.$ca['ca_mobile_skin_dir'];
}

?>

<form name="fcategoryform" action="./categoryformupdate.php" onsubmit="return fcategoryformcheck(this);" method="post" enctype="multipart/form-data">

<input type="hidden" name="codedup"  value="<?php echo $default['de_code_dup_use']; ?>">
<input type="hidden" name="w" value="<?php echo $w; ?>">
<input type="hidden" name="sst" value="<?php echo $sst; ?>">
<input type="hidden" name="sod" value="<?php echo $sod; ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
<input type="hidden" name="stx" value="<?php echo $stx; ?>">
<input type="hidden" name="page" value="<?php echo $page; ?>">
<input type="hidden" name="ca_explan_html" value="<?php echo $ca['ca_explan_html']; ?>">

<section id="anc_scatefrm_basic">
    <!--h2 class="h2_frm">필수입력</h2-->
    <?php echo $pg_anchor; ?>

    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption>분류 추가 필수입력</caption>
        <colgroup>
            <col class="grid_4">
            <col>
        </colgroup>
        <tbody>
        <tr>
            <th scope="row"><label for="ca_id">분류코드</label></th>
            <td>
            <?php if ($w == "") { ?>
                <?//php echo help("자동으로 보여지는 분류코드를 사용하시길 권해드리지만 직접 입력한 값으로도 사용할 수 있습니다.\n분류코드는 나중에 수정이 되지 않으므로 신중하게 결정하여 사용하십시오.\n\n분류코드는 2자리씩 10자리를 사용하여 5단계를 표현할 수 있습니다.\n0~z까지 입력이 가능하며 한 분류당 최대 1296가지를 표현할 수 있습니다.\n그러므로 총 3656158440062976가지의 분류를 사용할 수 있습니다."); ?>
                <input type="text" name="ca_id" value="<?php echo $subid; ?>" id="ca_id" required class="required frm_input" size="<?php echo $sublen; ?>" maxlength="<?php echo $sublen; ?>">
                <!-- <?php if ($default['de_code_dup_use']) { ?><a href="javascript:;" onclick="codedupcheck(document.getElementById('ca_id').value)">코드 중복검사</a><?php } ?> -->
            <?php } else { ?>
                <input type="hidden" name="ca_id" value="<?php echo $ca['ca_id']; ?>">
                <span class="frm_ca_id"><?php echo $ca['ca_id']; ?></span>
				<?if(strlen($ca_id)==2){?>
				<a href="./categoryform.php?ca_id=<?php echo $ca_id; ?>&amp;<?php echo $qstr; ?>" class="btn_frmline">하위분류 추가</a>
            <?php 
			}
				}
			?>
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="ca_name">분류명</label></th>
            <td><input type="text" name="ca_name" value="<?php echo $ca['ca_name']; ?>" id="ca_name" size="38" required class="required frm_input"></td>
        </tr>
        <tr>
            <th scope="row"><label for="ca_order">출력순서</label></th>
            <td>
                <?php echo help("숫자가 작을 수록 상위에 출력됩니다. [<b>입력하지 않으면 자동으로 출력됩니다.</b>]"); ?>
                <input type="text" name="ca_order" value="<?php echo $ca['ca_order']; ?>" id="ca_order" class="frm_input" size="12">
            </td>
        </tr>        
        <!--tr>
            <th scope="row"><label for="ca_stock_qty">재고수량</label></th>
            <td>
                <?php echo help("상품의 기본재고 수량을 설정합니다.\n재고를 사용하지 않는다면 숫자를 크게 입력하여 주십시오. 예) 999999"); ?>
                <input type="text" name="ca_stock_qty" size="10" value="<?php echo $ca['ca_stock_qty']; ?>" id="ca_stock_qty" class="frm_input"> 개
            </td>
        </tr-->
		<?if(strlen($ca_id)==2 || strlen($subid)){?>
        <!--tr>
            <th scope="row"><label for="ca_sell_email">간략설명</label></th>
            <td>
                <input type="text" name="ca_sell_email" size="40" value="<?php echo $ca['ca_sell_email']; ?>" id="ca_sell_email" class="frm_input w100">
            </td>
        </tr-->
		<?}?>
        <tr>
            <th scope="row"><label for="ca_use">노출</label></th>
            <td>
                <?php echo help("체크 해제하시면 출력 되지 않습니다."); ?>
                <input type="checkbox" name="ca_use" <?php echo ($ca['ca_use']) ? "checked" : ""; ?> value="1" id="ca_use">
                예
            </td>
        </tr>
		<tr>
            <th scope="row"><label for="ca_use">이미지</label></th>
            <td>
                <input type="file" name="ca_10" id="reg_ca_10" class="frm_input">
				<?php
				
				// 첨부파일 경로			
				$ca_10_path = G5_DATA_PATH.'/cate/'.$ca['ca_10'];
				$ca_10_url  = G5_DATA_URL.'/cate/'.$ca['ca_10'];
				//echo file_exists($ca_10_path);

				if ($w == 'u' && $ca['ca_10']) { ?>
                <a href="<?=$ca_10_url ?>" target="_target"><font color="red"><?=$ca['ca_10']?></font></a>
                <input type="checkbox" name="del_ca_10" value="1" id="del_ca_10">
                <label for="del_ca_10">삭제</label>
                <?php }  ?>
            </td>
        </tr>
        <!--tr>
            <th scope="row"><label for="ca_nocoupon">쿠폰적용안함</label></th>
            <td>
                <?php echo help("설정에 체크하시면 쿠폰생성 때 분류 검색 결과에 노출되지 않습니다."); ?>
                <input type="checkbox" name="ca_nocoupon" <?php echo ($ca['ca_nocoupon']) ? "checked" : ""; ?> value="1" id="ca_nocoupon">
                예
            </td>
        </tr-->
        </tbody>
        </table>
    </div>
</section>

<?//php echo preg_replace('#</div>$#i', '<button type="button" class="shop_category">테마설정 가져오기</button></div>', $frm_submit); ?>

<!--section id="anc_scatefrm_optional">
    <h2 class="h2_frm">선택 입력</h2>
    <?php echo $pg_anchor; ?>

    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption>분류 추가 선택입력</caption>
        <colgroup>
            <col class="grid_4">
            <col>
        </colgroup>
        <tbody>
        <tr>
            <th scope="row">상단내용</th>
            <td>
                <?php echo help("상품리스트 페이지 상단에 출력하는 HTML 내용입니다."); ?>
                <?php echo editor_html('ca_head_html', get_text($ca['ca_head_html'], 0)); ?>
            </td>
        </tr>
        <tr>
            <th scope="row">하단내용</th>
            <td>
                <?php echo help("상품리스트 페이지 하단에 출력하는 HTML 내용입니다."); ?>
                <?php echo editor_html('ca_tail_html', get_text($ca['ca_tail_html'], 0)); ?>
            </td>
        </tr>
        <tr>
            <th scope="row">모바일 상단내용</th>
            <td>
                <?php echo help("상품리스트 페이지 상단에 출력하는 HTML 내용입니다."); ?>
                <?php echo editor_html('ca_mobile_head_html', get_text($ca['ca_mobile_head_html'], 0)); ?>
            </td>
        </tr>
        <tr>
            <th scope="row">모바일 하단내용</th>
            <td>
                <?php echo help("상품리스트 페이지 하단에 출력하는 HTML 내용입니다."); ?>
                <?php echo editor_html('ca_mobile_tail_html', get_text($ca['ca_mobile_tail_html'], 0)); ?>
            </td>
        </tr>
        </tbody>
        </table>
    </div>
</section-->

<?php echo $frm_submit; ?>

</form>

<script>
<?php if ($w == 'u') { ?>
$(".banner_or_img").addClass("sit_wimg");
$(function() {
    $(".sit_wimg_view").bind("click", function() {
        var sit_wimg_id = $(this).attr("id").split("_");
        var $img_display = $("#"+sit_wimg_id[1]);

        $img_display.toggle();

        if($img_display.is(":visible")) {
            $(this).text($(this).text().replace("확인", "닫기"));
        } else {
            $(this).text($(this).text().replace("닫기", "확인"));
        }

        var $img = $("#"+sit_wimg_id[1]).children("img");
        var width = $img.width();
        var height = $img.height();
        if(width > 700) {
            var img_width = 700;
            var img_height = Math.round((img_width * height) / width);

            $img.width(img_width).height(img_height);
        }
    });
    $(".sit_wimg_close").bind("click", function() {
        var $img_display = $(this).parents(".banner_or_img");
        var id = $img_display.attr("id");
        $img_display.toggle();
        var $button = $("#ca_"+id+"_view");
        $button.text($button.text().replace("닫기", "확인"));
    });
});
<?php } ?>

function fcategoryformcheck(f)
{
    if (f.w.value == "") {
        var error = "";
        $.ajax({
            url: "./ajax.ca_id.php",
            type: "POST",
            data: {
                "ca_id": f.ca_id.value
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function(data, textStatus) {
                error = data.error;
            }
        });

        if (error) {
            alert(error);
            return false;
        }
    }

    <?php echo get_editor_js('ca_head_html'); ?>
    <?php echo get_editor_js('ca_tail_html'); ?>
    <?php echo get_editor_js('ca_mobile_head_html'); ?>
    <?php echo get_editor_js('ca_mobile_tail_html'); ?>

    return true;
}

$(function() {
    $(".shop_category").on("click", function() {
        if(!confirm("현재 테마의 스킨, 이미지 사이즈 등의 설정을 적용하시겠습니까?"))
            return false;

        $.ajax({
            type: "POST",
            url: "../theme_config_load.php",
            cache: false,
            async: false,
            data: { type: 'shop_category' },
            dataType: "json",
            success: function(data) {
                if(data.error) {
                    alert(data.error);
                    return false;
                }

                $.each(data, function(key, val) {
                    if(key == "error")
                        return true;

                    $("#"+key).val(val);
                });
            }
        });
    });
});

/*document.fcategoryform.ca_name.focus(); 포커스 해제*/
</script>

<?php
include_once G5_MANAGE_INCLUDE_PATH . "/admin_footer.php";
?>