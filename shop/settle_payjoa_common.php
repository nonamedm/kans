<?php
include_once('./_common.php');

// 공통
$PAYMETHOD = $_REQUEST[ "PAYMETHOD" ];					// 결제수단
$CPID = $_REQUEST[ "CPID" ];							// 가맹점ID
$DAOUTRX = $_REQUEST[ "DAOUTRX" ];						// 다우거래번호
$ORDERNO = $_REQUEST[ "ORDERNO" ];						// 주문번호
$AMOUNT = $_REQUEST[ "AMOUNT" ];						// 결제금액
$SETTDATE = $_REQUEST[ "SETTDATE" ];					// 결제일자(YYYYMMDDhh24miss)
$EMAIL = $_REQUEST[ "EMAIL" ];							// 고객 E-MAIL(고객이 입력한 경우) KAKAOPAY 통보제외
$USERID = iconv("EUC-KR", "UTF-8", $_REQUEST[ "USERID" ]);						// 고객 ID
$USERNAME = addslashes(iconv("EUC-KR", "UTF-8", $_REQUEST[ "USERNAME" ]));		// 구매자명
$PRODUCTCODE = $_REQUEST[ "PRODUCTCODE" ];				// 상품코드
$PRODUCTNAME = addslashes(iconv("EUC-KR", "UTF-8", $_REQUEST[ "PRODUCTNAME" ]));	// 상품명
$RESERVEDINDEX1 = iconv("EUC-KR", "UTF-8", $_REQUEST[ "RESERVEDINDEX1" ]);		// 예약항목1 KT-BATCT, MOBILE-BATCH 통보제외
$RESERVEDINDEX2 = iconv("EUC-KR", "UTF-8", $_REQUEST[ "RESERVEDINDEX2" ]);		// 예약항목2 KT-BATCT, MOBILE-BATCH 통보제외
$RESERVEDSTRING = iconv("EUC-KR", "UTF-8", $_REQUEST[ "RESERVEDSTRING" ]);		// 예약항목3

// 신용카드
$AUTHNO = $_REQUEST[ "AUTHNO" ];						// 카드승인번호
$CARDCODE = $_REQUEST[ "CARDCODE" ];					// 카드사코드
$CARDNAME = iconv("EUC-KR", "UTF-8", $_REQUEST[ "CARDNAME" ]);					// 카드사명
$QUOTAOPT = $_REQUEST[ "QUOTAOPT" ];					// 최대 할부 개월 수 (일시불~12개월 예: 12)
$CARDNO = $_REQUEST[ "CARDNO" ];						// 카드번호(1234560000001234)
$CARDTYPE = $_REQUEST[ "CARDTYPE" ];					// ?? 메뉴얼에 없음

// 가상계좌
$od_bank_account = "";									// 입금계좌
$od_deposit_name = "";									// 입금자

// 계좌이체
$od_cash = ""; // 현금영수증
$BANKNAME = iconv("EUC-KR", "UTF-8", $_REQUEST[ "BANKNAME" ]);					// 은행 명
$CASHRECAUTHNO = $_REQUEST[ "CASHRECAUTHNO" ];			// 현금영수증 승인번호(미발급 BANK : 0, VACCOUNT : 빈 값)
$od_cash = ($CASHRECAUTHNO)?1:0;

// $PAY_METHOD[$PAYMETHOD];


$od_id = $ORDERNO;
$od_tno = $DAOUTRX;
$od_receipt_price = ($AMOUNT)?$AMOUNT:0;
$od_receipt_time = ($SETTDATE)?date("Y-m-d H:i:s", strtotime($SETTDATE)):"";
$od_app_no = $AUTHNO;

$od_memo = "PAYMETHOD: ".$PAY_METHOD[$PAYMETHOD];
$od_memo .= ", CPID: ".$CPID;
$od_memo .= ", EMAIL: ".$EMAIL;
$od_memo .= ", USERID: ".$USERID;
$od_memo .= ", USERNAME: ".$USERNAME;
$od_memo .= ", PRODUCTCODE: ".$PRODUCTCODE;
$od_memo .= ", PRODUCTNAME: ".$PRODUCTNAME;
$od_memo .= ", RESERVEDINDEX1: ".$RESERVEDINDEX1;
$od_memo .= ", RESERVEDINDEX2: ".$RESERVEDINDEX2;
$od_memo .= ", CARDCODE: ".$CARDCODE;
$od_memo .= ", CARDNAME: ".$CARDNAME;
$od_memo .= ", QUOTAOPT: ".$QUOTAOPT;
$od_memo .= ", CARDNO: ".$CARDNO;

$od_memo = addslashes($od_memo);
?>
