<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 테스트 결제
if ($default['de_card_test']) {
	/*
	CTS17344	첫번째로 받은 테스트 아이디
	CTS17420	두번째로 받은 테스트 아이디
    */
	$default['de_payjoa_mid'] = "CTS17420";	// 발급받은 테스트 상점아이디(=상점마다 다를수 있음)
    $stdpay_js_url = 'https://apitest.payjoa.co.kr/pay/link';
}
else {
	// $default['de_payjoa_mid'] = "";
	$stdpay_js_url = 'https://api.payjoa.co.kr/pay/link';
}


$mid = $default['de_payjoa_mid'];

$siteDomain = G5_SHOP_URL.'/payjoa'; //가맹점 도메인 입력

// $PAYMETHOD = "CARDK"; // 신용카드일반

$HOMEURL	= ($backurl)?$backurl:$siteDomain;	// 결제 성공 후, 이동할 URL
$CLOSEURL	= ($backurl)?$backurl:$siteDomain;	// 결제 창에서 취소 누를 시 이동할 URL
$FAILURL	= ($backurl)?$backurl:$siteDomain;	// 결제실패 후, 확인버튼 입력 시 이동할 URL
$APPURL		= "";	// 인증완료 후 돌아갈 앱의 URL(CARD, CARDK, BANK 필수)

$TAXFREECD	= "01"; // 과세/비과세여부(00: 과세, 01: 비과세, 02: 복합과세)

// 결제수단
$PAY_METHOD = array(
	'KT'			=> '폰빌(일반)',
	'BANK'			=> '계좌이체(일반)',
	'KT-BATCH'		=> '폰빌(월자동)',
	'CULTURE'		=> '문화상품권(일반)',
	'MOBILE'		=> '휴대폰(일반)',
	'BOOKNLIFE'		=> '도서문화상품권(일반)',
	'MOBILE-BATCH'	=> '휴대폰(월자동)',
	'HAPPYMONEY'	=> '해피머니상품권(일반)',
	'CARDK'			=> '신용카드K(일반)',
	'MOBILEPOP'		=> '모바일팝(일반)',
	'CARDK-SUGI'	=> '신용카드K(수기)',
	'TEENCASH'		=> '틴캐시(일반)',
	'CARDK-BATCH'	=> '신용카드K(월자동)',
	'EGGMONEY'		=> '에그머니상품권(일반)',
	'CARD'			=> '신용카드(일반)',
	'GAMECARD'		=> '게임문화상품권(일반)',
	'CARD-SUGI'		=> '신용카드(수기)',
	'TMONEY'		=> '티머니(일반)',
	'CARD-BATCH'	=> '신용카드(월자동)',
	'KAKAOPAY'		=> '카카오페이(일반)',
	'VACCT'			=> '가상계좌(일반)',
	'VACCOUNTISSUE'	=> '가상계좌(발급)'
);

// 결제수단(텍스트 > 코드)
$PAY_METHOD_REV = array(
	'폰빌(일반)'			=>	'KT',
	'계좌이체(일반)'		=>	'BANK',			
	'폰빌(월자동)'			=>	'KT-BATCH',
	'문화상품권(일반)'		=>	'CULTURE',
	'휴대폰(일반)'			=>	'MOBILE',
	'도서문화상품권(일반)'	=>	'BOOKNLIFE',
	'휴대폰(월자동)'		=>	'MOBILE-BATCH',
	'해피머니상품권(일반)'	=>	'HAPPYMONEY',
	'신용카드K(일반)'		=>	'CARDK',
	'모바일팝(일반)'		=>	'MOBILEPOP',
	'신용카드K(수기)'		=>	'CARDK-SUGI',
	'틴캐시(일반)'			=>	'TEENCASH',
	'신용카드K(월자동)'		=>	'CARDK-BATCH',
	'에그머니상품권(일반)'	=>	'EGGMONEY',
	'신용카드(일반)'		=>	'CARD',
	'게임문화상품권(일반)'	=>	'GAMECARD',
	'신용카드(수기)'		=>	'CARD-SUGI',
	'티머니(일반)'			=>	'TMONEY',
	'신용카드(월자동)'		=>	'CARD-BATCH',
	'카카오페이(일반)'		=>	'KAKAOPAY',
	'가상계좌(일반)'		=>	'VACCT',
	'가상계좌(발급)'		=>	'VACCOUNTISSUE' 
);

// 카드사
$CARD_CODE = array(
    'CCLG' => '신한카드',
	'CCBC' => 'BC카드',
	'CCKM' => '국민카드',
	'CCSS' => '삼성카드',
	'CCDI' => '현대카드',
	'CCLO' => '롯데카드',
	'CCHN' => '하나SK카드',
	'CCNH' => 'NH농협카드',
	'CCCT' => '씨티카드',
	'CCPH' => '우리카드',
	'CCCJ' => '제주은행',
	'CCMG' => '새마을금고카드',
	'CCPO' => '우체국카드',
	'CCSB' => '저축은행',
	'CCKD' => '산은카드',
	'CCCU' => '신협카드',
	'CCJB' => '전북은행',
	'CCKJ' => '광주은행',
	'CCSH' => '수협은행',
	'CCKA' => '카카오뱅크'
);

// 은행사
$BANK_CODE = array(
    '03' => '기업은행',
    '04' => '국민은행',
    '05' => '외환은행',
    '08' => '농협은행',
    '09' => '우리은행',
    '10' => '우리은행',
    '11' => 'SC제일은행',
    '12' => '하나은행',
    '13' => '씨티은행',
    '15' => '부산은행',
    '31' => '우체국'
);
?>