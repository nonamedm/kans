<?php
$sub_menu = '400100';
include_once('./_common.php');

check_demo();

auth_check($auth[$sub_menu], "w");

check_admin_token();

// 대표전화번호 유효성 체크
if(!check_vaild_callback($_POST['de_admin_company_tel']))
    alert('대표전화번호를 올바르게 입력해 주세요.');

// 로그인을 바로 이 주소로 하는 경우 쇼핑몰설정값이 사라지는 현상을 방지
if (!$_POST['de_admin_company_owner']) goto_url("./configform.php");

if ($_POST['logo_img_del'])  @unlink(G5_DATA_PATH."/common/logo_img");
if ($_POST['logo_img_del2'])  @unlink(G5_DATA_PATH."/common/logo_img2");
if ($_POST['mobile_logo_img_del'])  @unlink(G5_DATA_PATH."/common/mobile_logo_img");
if ($_POST['mobile_logo_img_del2'])  @unlink(G5_DATA_PATH."/common/mobile_logo_img2");

if ($_FILES['logo_img']['name']) upload_file($_FILES['logo_img']['tmp_name'], "logo_img", G5_DATA_PATH."/common");
if ($_FILES['logo_img2']['name']) upload_file($_FILES['logo_img2']['tmp_name'], "logo_img2", G5_DATA_PATH."/common");
if ($_FILES['mobile_logo_img']['name']) upload_file($_FILES['mobile_logo_img']['tmp_name'], "mobile_logo_img", G5_DATA_PATH."/common");
if ($_FILES['mobile_logo_img2']['name']) upload_file($_FILES['mobile_logo_img2']['tmp_name'], "mobile_logo_img2", G5_DATA_PATH."/common");

//$de_kcp_mid = substr($_POST['de_kcp_mid'],0,3);

// kcp 전자결제를 사용할 때 site key 입력체크
/*if($_POST['de_pg_service'] == 'kcp' && ($_POST['de_iche_use'] || $_POST['de_vbank_use'] || $_POST['de_hp_use'] || $_POST['de_card_use'])) {
    if(trim($_POST['de_kcp_site_key']) == '')
        alert('KCP SITE KEY를 입력해 주십시오.');
}*/

//
// 영카트 default
//
$sql = " update {$g5['g5_shop_default_table']}
            set de_admin_company_owner        = '{$_POST['de_admin_company_owner']}',
                de_admin_company_name         = '{$_POST['de_admin_company_name']}',
                de_admin_company_saupja_no    = '{$_POST['de_admin_company_saupja_no']}',
                de_admin_company_tel          = '{$_POST['de_admin_company_tel']}',
                de_admin_company_fax          = '{$_POST['de_admin_company_fax']}',
                de_admin_tongsin_no           = '{$_POST['de_admin_tongsin_no']}',
                de_admin_company_zip          = '{$_POST['de_admin_company_zip']}',
                de_admin_company_addr         = '{$_POST['de_admin_company_addr']}',
                de_admin_info_name            = '{$_POST['de_admin_info_name']}',
                de_admin_info_email           = '{$_POST['de_admin_info_email']}',
                de_delivery_company           = '{$_POST['de_delivery_company']}',
                de_send_cost_case             = '{$_POST['de_send_cost_case']}',
                de_send_cost_limit            = '{$_POST['de_send_cost_limit']}',
                de_send_cost_list             = '{$_POST['de_send_cost_list']}',
                de_hope_date_use              = '{$_POST['de_hope_date_use']}',
                de_hope_date_after            = '{$_POST['de_hope_date_after']}',
                de_baesong_content            = '{$_POST['de_baesong_content']}',
                de_change_content             = '{$_POST['de_change_content']}',
                
                de_item_use_use               = '{$_POST['de_item_use_use']}',
                de_item_use_write             = '{$_POST['de_item_use_write']}',
                de_code_dup_use               = '{$_POST['de_code_dup_use']}',
                de_cart_keep_term             = '{$_POST['de_cart_keep_term']}',              
                de_admin_buga_no              = '{$_POST['de_admin_buga_no']}',
                de_guest_privacy              = '{$_POST['de_guest_privacy']}',                
               
                de_member_reg_coupon_use      = '{$_POST['de_member_reg_coupon_use']}',
                de_member_reg_coupon_term     = '{$_POST['de_member_reg_coupon_term']}',
                de_member_reg_coupon_price    = '{$_POST['de_member_reg_coupon_price']}',
                de_member_reg_coupon_minimum  = '{$_POST['de_member_reg_coupon_minimum']}'
                ";
///goodbuilder
/*$sql .= ",
                de_paypal_use                 = '$de_paypal_use',
                de_paypal_test                = '$de_paypal_test',
                de_paypal_mid                 = '$de_paypal_mid',
                de_paypal_currency_code       = '$de_paypal_currency_code',
                de_paypal_exchange_rate       = '$de_paypal_exchange_rate',
                de_alipay_use                 = '$de_alipay_use',
                de_alipay_test                = '$de_alipay_test',
                de_alipay_service_type        = '$de_alipay_service_type',
                de_alipay_partner             = '$de_alipay_partner',
                de_alipay_key                 = '$de_alipay_key',
                de_alipay_seller_id           = '$de_alipay_seller_id',
                de_alipay_seller_email        = '$de_alipay_seller_email',
                de_alipay_currency            = '$de_alipay_currency',
                de_alipay_exchange_rate       = '$de_alipay_exchange_rate',
                de_anet_use                   = '$de_anet_use',
                de_anet_test                  = '$de_anet_test',
                de_anet_id                    = '$de_anet_id',
                de_anet_key                   = '$de_anet_key',
                de_anet_test_mode             = '$de_anet_test_mode',
                de_anet_exchange_rate         = '$de_anet_exchange_rate',
                de_eximbay_use                = '$de_eximbay_use',
                de_eximbay_test               = '$de_eximbay_test',
                de_eximbay_mid                = '$de_eximbay_mid',
                de_eximbay_key                = '$de_eximbay_key',
                de_eximbay_currency           = '$de_eximbay_currency',
                de_eximbay_exchange_rate      = '$de_eximbay_exchange_rate',
                de_eximbay_lang               = '$de_eximbay_lang'
";*/
sql_query($sql);

// 환경설정 > 포인트 사용
//sql_query(" update {$g5['config_table']} set cf_use_point = '{$_POST['cf_use_point']}' ");

// LG, 아이코드 설정
/*$sql = " update {$g5['config_table']}
            set cf_sms_use              = '{$_POST['cf_sms_use']}',
                cf_sms_type             = '{$_POST['cf_sms_type']}',
                cf_icode_id             = '{$_POST['cf_icode_id']}',
                cf_icode_pw             = '{$_POST['cf_icode_pw']}',
                cf_icode_server_ip      = '{$_POST['cf_icode_server_ip']}',
                cf_icode_server_port    = '{$_POST['cf_icode_server_port']}',
                cf_lg_mid               = '{$_POST['cf_lg_mid']}',
                cf_lg_mert_key          = '{$_POST['cf_lg_mert_key']}' ";
sql_query($sql);*/

goto_url("./configform.php");
?>
