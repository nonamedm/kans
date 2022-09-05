<?php
$sub_menu = '400100';
include_once('./_common.php');
include_once(G5_EDITOR_LIB);

auth_check($auth[$sub_menu], "r");

if (!$config['cf_icode_server_ip'])   $config['cf_icode_server_ip'] = '211.172.232.124';
if (!$config['cf_icode_server_port']) $config['cf_icode_server_port'] = '7295';

if ($config['cf_sms_use'] && $config['cf_icode_id'] && $config['cf_icode_pw']) {
    $userinfo = get_icode_userinfo($config['cf_icode_id'], $config['cf_icode_pw']);
}

$g5['title'] = '쇼핑몰설정';
include_once G5_MANAGE_INCLUDE_PATH . "/admin_header.php";

$pg_anchor = '<ul class="anchor">
<li><a href="#anc_scf_info">사업자정보</a></li>
<li><a href="#anc_scf_delivery">배송설정</a></li>
<li><a href="#anc_scf_etc">기타설정</a></li>
</ul>';

$frm_submit = '<div class="btn_confirm01 btn_confirm">
    <input type="submit" value="확인" class="btn_submit" accesskey="s">
    <a href="'.G5_SHOP_URL.'">쇼핑몰</a>
</div>';

///shop table
/*$sql = " SHOW COLUMNS FROM `{$g5['g5_shop_order_table']}` LIKE 'od_status_detail' ";
$row = sql_fetch($sql);
if(!isset($row['Field'])) {
    $sql = " ALTER TABLE `{$g5['g5_shop_order_table']}` ADD `od_status_detail` VARCHAR(255) NOT NULL DEFAULT '' ";
    sql_query($sql, true);
}

$sql = " SHOW COLUMNS FROM `{$g5['g5_shop_cart_table']}` LIKE 'ct_status_detail' ";
$row = sql_fetch($sql);
if(!isset($row['Field'])) {
    $sql = " ALTER TABLE `{$g5['g5_shop_cart_table']}` ADD `ct_status_detail` VARCHAR(255) NOT NULL DEFAULT '' ";
    sql_query($sql, true);
}*/
///--goodbuilder--
?>

<form name="fconfig" action="./configformupdate.php" onsubmit="return fconfig_check(this)" method="post" enctype="MULTIPART/FORM-DATA">
<input type="hidden" name="token" value="">
<section id="anc_scf_info">
    <h2 class="h2_frm">사업자정보</h2>
    <?php echo $pg_anchor; ?>
    <div class="local_desc02 local_desc">
    </div>

    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption>사업자정보 입력</caption>
        <colgroup>
            <col class="grid_4">
            <col>
            <col class="grid_4">
            <col>
        </colgroup>
        <tbody>
        <tr>
            <th scope="row"><label for="de_admin_company_name">회사명</label></th>
            <td>
                <input type="text" name="de_admin_company_name" value="<?php echo $default['de_admin_company_name']; ?>" id="de_admin_company_name" class="frm_input" size="30">
            </td>
            <th scope="row"><label for="de_admin_company_saupja_no">사업자등록번호</label></th>
            <td>
                <input type="text" name="de_admin_company_saupja_no"  value="<?php echo $default['de_admin_company_saupja_no']; ?>" id="de_admin_company_saupja_no" class="frm_input" size="30">
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="de_admin_company_owner">대표자명</label></th>
            <td colspan="3">
                <input type="text" name="de_admin_company_owner" value="<?php echo $default['de_admin_company_owner']; ?>" id="de_admin_company_owner" class="frm_input" size="30">
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="de_admin_company_tel">대표전화번호</label></th>
            <td>
                <input type="text" name="de_admin_company_tel" value="<?php echo $default['de_admin_company_tel']; ?>" id="de_admin_company_tel" class="frm_input" size="30">
            </td>
            <th scope="row"><label for="de_admin_company_fax">팩스번호</label></th>
            <td>
                <input type="text" name="de_admin_company_fax" value="<?php echo $default['de_admin_company_fax']; ?>" id="de_admin_company_fax" class="frm_input" size="30">
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="de_admin_tongsin_no">통신판매업 신고번호</label></th>
            <td>
                <input type="text" name="de_admin_tongsin_no" value="<?php echo $default['de_admin_tongsin_no']; ?>" id="de_admin_tongsin_no" class="frm_input" size="30">
            </td>
            <th scope="row"><label for="de_admin_buga_no">부가통신 사업자번호</label></th>
            <td>
                <input type="text" name="de_admin_buga_no" value="<?php echo $default['de_admin_buga_no']; ?>" id="de_admin_buga_no" class="frm_input" size="30">
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="de_admin_company_zip">사업장우편번호</label></th>
            <td>
                <input type="text" name="de_admin_company_zip" value="<?php echo $default['de_admin_company_zip']; ?>" id="de_admin_company_zip" class="frm_input" size="10">
            </td>
            <th scope="row"><label for="de_admin_company_addr">사업장주소</label></th>
            <td>
                <input type="text" name="de_admin_company_addr" value="<?php echo $default['de_admin_company_addr']; ?>" id="de_admin_company_addr" class="frm_input" size="30">
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="de_admin_info_name">정보관리책임자명</label></th>
            <td>
                <input type="text" name="de_admin_info_name" value="<?php echo $default['de_admin_info_name']; ?>" id="de_admin_info_name" class="frm_input" size="30">
            </td>
            <th scope="row"><label for="de_admin_info_email">정보책임자 e-mail</label></th>
            <td>
                <input type="text" name="de_admin_info_email" value="<?php echo $default['de_admin_info_email']; ?>" id="de_admin_info_email" class="frm_input" size="30">
            </td>
        </tr>
        </tbody>
        </table>
    </div>
</section>

<?php echo $frm_submit; ?>

<section id="anc_scf_delivery">
    <h2 >배송설정</h2>
     <?php echo $pg_anchor; ?>

    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption>배송설정 입력</caption>
        <colgroup>
            <col class="grid_4">
            <col>
        </colgroup>
        <tbody>
        <tr>
            <th scope="row"><label for="de_delivery_company">배송업체</label></th>
            <td>
                <?php echo help("이용 중이거나 이용하실 배송업체를 선택하세요."); ?>
                <select name="de_delivery_company" id="de_delivery_company">
                    <?php echo get_delivery_company($default['de_delivery_company']); ?>
                </select>
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="de_send_cost_case">배송비유형</label></th>
            <td>
                <?php echo help("<strong>금액별차등</strong>으로 설정한 경우, 주문총액이 배송비상한가 미만일 경우 배송비를 받습니다.\n<strong>무료배송</strong>으로 설정한 경우, 배송비상한가 및 배송비를 무시하며 착불의 경우도 무료배송으로 설정합니다.\n<strong>상품별로 배송비 설정을 한 경우 상품별 배송비 설정이 우선</strong> 적용됩니다.\n예를 들어 무료배송으로 설정했을 때 특정 상품에 배송비가 설정되어 있으면 주문시 배송비가 부과됩니다."); ?>
                <select name="de_send_cost_case" id="de_send_cost_case">
                    <option value="차등" <?php echo get_selected($default['de_send_cost_case'], "차등"); ?>>금액별차등</option>
                    <option value="무료" <?php echo get_selected($default['de_send_cost_case'], "무료"); ?>>무료배송</option>
                </select>
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="de_send_cost_limit">배송비상한가</label></th>
            <td>
                <?php echo help("배송비유형이 '금액별차등'일 경우에만 해당되며 배송비상한가를 여러개 두고자 하는 경우는 <b>;</b> 로 구분합니다.\n\n예를 들어 20000원 미만일 경우 4000원, 30000원 미만일 경우 3000원 으로 사용할 경우에는 배송비상한가를 20000;30000 으로 입력하고 배송비를 4000;3000 으로 입력합니다."); ?>
                <input type="text" name="de_send_cost_limit" value="<?php echo $default['de_send_cost_limit']; ?>" size="40" class="frm_input" id="de_send_cost_limit"> 원
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="de_send_cost_list">배송비</label></th>
            <td>
                <input type="text" name="de_send_cost_list" value="<?php echo $default['de_send_cost_list']; ?>" size="40" class="frm_input" id="de_send_cost_list"> 원
            </td>
        </tr>
        <!--tr>
            <th scope="row"><label for="de_hope_date_use">희망배송일사용</label></th>
            <td>
                <?php echo help("'예'로 설정한 경우 주문서에서 희망배송일을 입력 받습니다."); ?>
                <select name="de_hope_date_use" id="de_hope_date_use">
                    <option value="0" <?php echo get_selected($default['de_hope_date_use'], 0); ?>>사용안함</option>
                    <option value="1" <?php echo get_selected($default['de_hope_date_use'], 1); ?>>사용</option>
                </select>
            </td>
        </tr>
        <tr>
             <th scope="row"><label for="de_hope_date_after">희망배송일지정</label></th>
            <td>
                <?php echo help("오늘을 포함하여 설정한 날 이후부터 일주일 동안을 달력 형식으로 노출하여 선택할수 있도록 합니다."); ?>
                <input type="text" name="de_hope_date_after" value="<?php echo $default['de_hope_date_after']; ?>" id="de_hope_date_after" class="frm_input" size="5"> 일
            </td>
        </tr-->
        <tr>
            <th scope="row">배송정보</th>
            <td><?php echo editor_html('de_baesong_content', get_text($default['de_baesong_content'], 0)); ?></td>
        </tr>
        <tr>
            <th scope="row">교환/반품</th>
            <td><?php echo editor_html('de_change_content', get_text($default['de_change_content'], 0)); ?></td>
        </tr>
        </tbody>
        </table>
    </div>
</section>

<?php echo $frm_submit; ?>

<section id="anc_scf_etc">
    <h2 class="h2_frm">기타 설정</h2>
    <?php echo $pg_anchor; ?>

    <div class="tbl_frm01 tbl_wrap">
        <table>
        <caption>기타 설정</caption>
        <colgroup>
            <col class="grid_4">
            <col>
        </colgroup>
        <tbody>
        <tr>
            <th scope="row"><label for="de_item_use_write">사용후기 작성</label></th>
            <td>
                 <?php echo help("주문상태에 따른 사용후기 작성여부를 설정합니다.", 50); ?>
                <select name="de_item_use_write" id="de_item_use_write">
                    <option value="0" <?php echo get_selected($default['de_item_use_write'], 0); ?>>주문상태와 무관하게 작성가능</option>
                    <option value="1" <?php echo get_selected($default['de_item_use_write'], 1); ?>>주문상태가 완료인 경우에만 작성가능</option>
                </select>
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="de_item_use_use">사용후기</label></th>
            <td>
                 <?php echo help("사용후기가 올라오면, 즉시 출력 혹은 관리자 승인 후 출력 여부를 설정합니다.", 50); ?>
                <select name="de_item_use_use" id="de_item_use_use">
                    <option value="0" <?php echo get_selected($default['de_item_use_use'], 0); ?>>즉시 출력</option>
                    <option value="1" <?php echo get_selected($default['de_item_use_use'], 1); ?>>관리자 승인 후 출력</option>
                </select>
            </td>
        </tr>
        <!--tr>
            <th scope="row"><label for="de_code_dup_use">코드 중복검사</label></th>
            <td>
                 <?php echo help("분류, 상품 등을 추가할 때 자동으로 코드 중복검사를 하려면 체크하십시오."); ?>
                <input type="checkbox" name="de_code_dup_use" value="1" id="de_code_dup_use"<?php echo $default['de_code_dup_use']?' checked':''; ?>> 사용
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="de_cart_keep_term">장바구니 보관기간</label></th>
            <td>
                 <?php echo help("장바구니 상품의 보관 기간을 설정하십시오."); ?>
                <input type="text" name="de_cart_keep_term" value="<?php echo $default['de_cart_keep_term']; ?>" id="de_cart_keep_term" class="frm_input" size="5"> 일
            </td>
        </tr>
        <tr>
            <th scope="row">신규회원 쿠폰발행</th>
            <td>
                 <?php echo help("신규회원에게 주문금액 할인 쿠폰을 발행하시려면 아래를 설정하십시오."); ?>
                <label for="de_member_reg_coupon_use">쿠폰발행</label>
                <input type="checkbox" name="de_member_reg_coupon_use" value="1" id="de_member_reg_coupon_use"<?php echo $default['de_member_reg_coupon_use']?' checked':''; ?>>
                <label for="de_member_reg_coupon_price">쿠폰할인금액</label>
                <input type="text" name="de_member_reg_coupon_price" value="<?php echo $default['de_member_reg_coupon_price']; ?>" id="de_member_reg_coupon_price" class="frm_input" size="10"> 원
                <label for="de_member_reg_coupon_minimum">주문최소금액</label>
                <input type="text" name="de_member_reg_coupon_minimum" value="<?php echo $default['de_member_reg_coupon_minimum']; ?>" id="de_member_reg_coupon_minimum" class="frm_input" size="10"> 원이상
                <label for="de_member_reg_coupon_term">쿠폰유효기간</label>
                <input type="text" name="de_member_reg_coupon_term" value="<?php echo $default['de_member_reg_coupon_term']; ?>" id="de_member_reg_coupon_term" class="frm_input" size="5"> 일
            </td>
        </tr-->
        <tr>
            <th scope="row">비회원에 대한<br/>개인정보수집 내용</th>
            <td><?php echo editor_html('de_guest_privacy', get_text($default['de_guest_privacy'], 0)); ?></td>
        </tr>
        </tbody>
        </table>
    </div>
</section>

<?php echo $frm_submit; ?>

<?php if (file_exists($logo_img) || file_exists($logo_img2) || file_exists($mobile_logo_img) || file_exists($mobile_logo_img2)) { ?>
<script>
$(".banner_or_img").addClass("scf_img");
$(function() {
    $(".scf_img_view").bind("click", function() {
        var sit_wimg_id = $(this).attr("id").split("_");
        var $img_display = $("#"+sit_wimg_id[1]);

        $img_display.toggle();

        if($img_display.is(":visible")) {
            $(this).text($(this).text().replace("확인", "닫기"));
        } else {
            $(this).text($(this).text().replace("닫기", "확인"));
        }

        if(sit_wimg_id[1].search("mainimg") > -1) {
            var $img = $("#"+sit_wimg_id[1]).children("img");
            var width = $img.width();
            var height = $img.height();
            if(width > 700) {
                var img_width = 700;
                var img_height = Math.round((img_width * height) / width);

                $img.width(img_width).height(img_height);
            }
        }
    });
    $(".sit_wimg_close").bind("click", function() {
        var $img_display = $(this).parents(".banner_or_img");
        var id = $img_display.attr("id");
        $img_display.toggle();
        var $button = $("#cf_"+id+"_view");
        $button.text($button.text().replace("닫기", "확인"));
    });
});
</script>
<?php } ?>

<script>
function byte_check(el_cont, el_byte)
{
    var cont = document.getElementById(el_cont);
    var bytes = document.getElementById(el_byte);
    var i = 0;
    var cnt = 0;
    var exceed = 0;
    var ch = '';

    for (i=0; i<cont.value.length; i++) {
        ch = cont.value.charAt(i);
        if (escape(ch).length > 4) {
            cnt += 2;
        } else {
            cnt += 1;
        }
    }

    //byte.value = cnt + ' / 80 bytes';
    bytes.innerHTML = cnt + ' / 80 bytes';

    if (cnt > 80) {
        exceed = cnt - 80;
        alert('메시지 내용은 80바이트를 넘을수 없습니다.\r\n작성하신 메세지 내용은 '+ exceed +'byte가 초과되었습니다.\r\n초과된 부분은 자동으로 삭제됩니다.');
        var tcnt = 0;
        var xcnt = 0;
        var tmp = cont.value;
        for (i=0; i<tmp.length; i++) {
            ch = tmp.charAt(i);
            if (escape(ch).length > 4) {
                tcnt += 2;
            } else {
                tcnt += 1;
            }

            if (tcnt > 80) {
                tmp = tmp.substring(0,i);
                break;
            } else {
                xcnt = tcnt;
            }
        }
        cont.value = tmp;
        //byte.value = xcnt + ' / 80 bytes';
        bytes.innerHTML = xcnt + ' / 80 bytes';
        return;
    }
}
</script>

</form>

<script>
function fconfig_check(f)
{
    <?php echo get_editor_js('de_baesong_content'); ?>
    <?php echo get_editor_js('de_change_content'); ?>
    <?php echo get_editor_js('de_guest_privacy'); ?>

    return true;
}

$(function() {
    $(".pg_info_fld").hide();
    $(".pg_vbank_url").hide();
    <?php if($default['de_pg_service']) { ?>
    $(".<?php echo $default['de_pg_service']; ?>_info_fld").show();
    $("#<?php echo $default['de_pg_service']; ?>_vbank_url").show();
    <?php } else { ?>
    $(".kcp_info_fld").show();
    $("#kcp_vbank_url").show();
    <?php } ?>
    $("#de_pg_service").on("change", function() {
        var pg = $(this).val();
        $(".pg_info_fld:visible").hide();
        $(".pg_vbank_url:visible").hide();
        $("."+pg+"_info_fld").show();
        $("#"+pg+"_vbank_url").show();
        $(".scf_cardtest").addClass("scf_cardtest_hide");
        $("."+pg+"_cardtest").removeClass("scf_cardtest_hide");
        $(".scf_cardtest_tip_adm").addClass("scf_cardtest_tip_adm_hide");
        $("#"+pg+"_cardtest_tip").removeClass("scf_cardtest_tip_adm_hide");
    });

    $(".scf_cardtest_btn").bind("click", function() {
        var $cf_cardtest_tip = $("#scf_cardtest_tip");
        var $cf_cardtest_btn = $(".scf_cardtest_btn");

        $cf_cardtest_tip.toggle();

        if($cf_cardtest_tip.is(":visible")) {
            $cf_cardtest_btn.text("테스트결제 팁 닫기");
        } else {
            $cf_cardtest_btn.text("테스트결제 팁 더보기");
        }
    });

    $(".get_shop_skin").on("click", function() {
        if(!confirm("현재 테마의 쇼핑몰 스킨 설정을 적용하시겠습니까?"))
            return false;

        $.ajax({
            type: "POST",
            url: "../theme_config_load.php",
            cache: false,
            async: false,
            data: { type: "shop_skin" },
            dataType: "json",
            success: function(data) {
                if(data.error) {
                    alert(data.error);
                    return false;
                }

                var field = Array('de_shop_skin', 'de_shop_mobile_skin');
                var count = field.length;
                var key;

                for(i=0; i<count; i++) {
                    key = field[i];

                    if(data[key] != undefined && data[key] != "")
                        $("select[name="+key+"]").val(data[key]);
                }
            }
        });
    });

    $(".shop_pc_index, .shop_mobile_index, .shop_etc").on("click", function() {
        if(!confirm("현재 테마의 스킨, 이미지 사이즈 등의 설정을 적용하시겠습니까?"))
            return false;

        var type = $(this).attr("class");
        var $el;

        $.ajax({
            type: "POST",
            url: "../theme_config_load.php",
            cache: false,
            async: false,
            data: { type: type },
            dataType: "json",
            success: function(data) {
                if(data.error) {
                    alert(data.error);
                    return false;
                }

                $.each(data, function(key, val) {
                    if(key == "error")
                        return true;

                    $el = $("#"+key);

                    if($el[0].type == "checkbox") {
                        $el.attr("checked", parseInt(val) ? true : false);
                        return true;
                    }
                    $el.val(val);
                });
            }
        });
    });
});
</script>

<?php
// 결제모듈 실행권한 체크
//if($default['de_iche_use'] || $default['de_vbank_use'] || $default['de_hp_use'] || $default['de_card_use']) {
//    // kcp의 경우 pp_cli 체크
//    if($default['de_pg_service'] == 'kcp') {
//        if(!extension_loaded('openssl')) {
//            echo '<script>'.PHP_EOL;
//            echo 'alert("PHP openssl 확장모듈이 설치되어 있지 않습니다.\n모바일 쇼핑몰 결제 때 사용되오니 openssl 확장 모듈을 설치하여 주십시오.");'.PHP_EOL;
//            echo '</script>'.PHP_EOL;
//        }
//
//        if(!extension_loaded('soap') || !class_exists('SOAPClient')) {
//            echo '<script>'.PHP_EOL;
//            echo 'alert("PHP SOAP 확장모듈이 설치되어 있지 않습니다.\n모바일 쇼핑몰 결제 때 사용되오니 SOAP 확장 모듈을 설치하여 주십시오.");'.PHP_EOL;
//            echo '</script>'.PHP_EOL;
//        }
//
//        $is_linux = true;
//        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
//            $is_linux = false;
//
//        $exe = '/kcp/bin/';
//        if($is_linux) {
//            if(PHP_INT_MAX == 2147483647) // 32-bit
//                $exe .= 'pp_cli';
//            else
//                $exe .= 'pp_cli_x64';
//        } else {
//            $exe .= 'pp_cli_exe.exe';
//        }
//
//        echo module_exec_check(G5_SHOP_PATH.$exe, 'pp_cli');
//
//        // shop/kcp/log 디렉토리 체크 후 있으면 경고
//        if(is_dir(G5_SHOP_PATH.'/kcp/log') && is_writable(G5_SHOP_PATH.'/kcp/log')) {
//            echo '<script>'.PHP_EOL;
//            echo 'alert("웹접근 가능 경로에 log 디렉토리가 있습니다.\nlog 디렉토리를 웹에서 접근 불가능한 경로로 변경해 주십시오.\n\nlog 디렉토리 경로 변경은 SIR FAQ를 참고해 주세요.")'.PHP_EOL;
//            echo '</script>'.PHP_EOL;
//        }
//    }
//
//    // LG의 경우 log 디렉토리 체크
//    if($default['de_pg_service'] == 'lg') {
//        $log_path = G5_LGXPAY_PATH.'/lgdacom/log';
//
//        if(!is_dir($log_path)) {
//            echo '<script>'.PHP_EOL;
//            echo 'alert("'.str_replace(G5_PATH.'/', '', G5_LGXPAY_PATH).'/lgdacom 폴더 안에 log 폴더를 생성하신 후 쓰기권한을 부여해 주십시오.\n> mkdir log\n> chmod 707 log");'.PHP_EOL;
//            echo '</script>'.PHP_EOL;
//        } else {
//            if(!is_writable($log_path)) {
//                echo '<script>'.PHP_EOL;
//                echo 'alert("'.str_replace(G5_PATH.'/', '',$log_path).' 폴더에 쓰기권한을 부여해 주십시오.\n> chmod 707 log");'.PHP_EOL;
//                echo '</script>'.PHP_EOL;
//            }
//        }
//    }
//
//    // 이니시스의 경우 log 디렉토리 체크
//    if($default['de_pg_service'] == 'inicis') {
//        if (!function_exists('xml_set_element_handler')) {
//            echo '<script>'.PHP_EOL;
//            echo 'alert("XML 관련 함수를 사용할 수 없습니다.\n서버 관리자에게 문의해 주십시오.");'.PHP_EOL;
//            echo '</script>'.PHP_EOL;
//        }
//
//        if (!function_exists('openssl_get_publickey')) {
//            echo '<script>'.PHP_EOL;
//            echo 'alert("OPENSSL 관련 함수를 사용할 수 없습니다.\n서버 관리자에게 문의해 주십시오.");'.PHP_EOL;
//            echo '</script>'.PHP_EOL;
//        }
//
//        if (!function_exists('socket_create')) {
//            echo '<script>'.PHP_EOL;
//            echo 'alert("SOCKET 관련 함수를 사용할 수 없습니다.\n서버 관리자에게 문의해 주십시오.");'.PHP_EOL;
//            echo '</script>'.PHP_EOL;
//        }
//
//        if (!function_exists('mcrypt_module_open')) {
//            echo '<script>'.PHP_EOL;
//            echo 'alert("MCRYPT 관련 함수를 사용할 수 없습니다.\n서버 관리자에게 문의해 주십시오.");'.PHP_EOL;
//            echo '</script>'.PHP_EOL;
//        }
//
//        $log_path = G5_SHOP_PATH.'/inicis/log';
//
//        if(!is_dir($log_path)) {
//            echo '<script>'.PHP_EOL;
//            echo 'alert("'.str_replace(G5_PATH.'/', '', G5_SHOP_PATH).'/inicis 폴더 안에 log 폴더를 생성하신 후 쓰기권한을 부여해 주십시오.\n> mkdir log\n> chmod 707 log");'.PHP_EOL;
//            echo '</script>'.PHP_EOL;
//        } else {
//            if(!is_writable($log_path)) {
//                echo '<script>'.PHP_EOL;
//                echo 'alert("'.str_replace(G5_PATH.'/', '',$log_path).' 폴더에 쓰기권한을 부여해 주십시오.\n> chmod 707 log");'.PHP_EOL;
//                echo '</script>'.PHP_EOL;
//            }
//        }
//    }
//
//    // 카카오페이의 경우 log 디렉토리 체크
//    if($default['de_kakaopay_mid'] && $default['de_kakaopay_key'] && $default['de_kakaopay_enckey'] && $default['de_kakaopay_hashkey'] && $default['de_kakaopay_cancelpwd']) {
//        $log_path = G5_SHOP_PATH.'/kakaopay/log';
//
//        if(!is_dir($log_path)) {
//            echo '<script>'.PHP_EOL;
//            echo 'alert("'.str_replace(G5_PATH.'/', '', G5_SHOP_PATH).'/kakaopay 폴더 안에 log 폴더를 생성하신 후 쓰기권한을 부여해 주십시오.\n> mkdir log\n> chmod 707 log");'.PHP_EOL;
//            echo '</script>'.PHP_EOL;
//        } else {
//            if(!is_writable($log_path)) {
//                echo '<script>'.PHP_EOL;
//                echo 'alert("'.str_replace(G5_PATH.'/', '',$log_path).' 폴더에 쓰기권한을 부여해 주십시오.\n> chmod 707 log");'.PHP_EOL;
//                echo '</script>'.PHP_EOL;
//            }
//        }
//    }
//}

include_once G5_MANAGE_INCLUDE_PATH . "/admin_footer.php";
?>
