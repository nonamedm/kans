<? include_once('./_common.php'); ?>
<?
header( "Content-type: application/vnd.ms-excel; charset=UTF-8");
header( "Content-Disposition: attachment; filename=".$data['fileName'].date("Ymdhmis").".xls" );
header( "Content-Description: PHP4 Generated Data" );
header( "Expires: 0");
header( "Cache-Control: must-revalidate, post-check=0,pre-check=0");
header( "Pragma: public");
?>

<?
/*
주문상태 : od_status
결제수단 : od_settle_case
미수금 : od_misu
반품/품절 : od_cancel_price
환불 : od_refund_price
포인트 : od_receipt_point
쿠폰 : od_coupon
시작일 : fr_date
끝 일 : to_date
현재는 주문일자를 제외한 모든경우는 엑셀로 다운이 가능하다
*/

$sql = "select * from g5_shop_order where od_id <> ''"; // 최초실행시 모두돌리기위한 행동!!

if($od_status)
	$sql .= " and od_status = '$od_status'";
if($od_settle_case)
	$sql .= " and od_settle_case = '$od_settle_case'";
if($od_misu)
	$sql .= " and od_misu <> ''";
if($od_cancel_price)
	$sql .= " and od_cancel_price <> ''";
if($od_refund_price)
	$sql .= " and od_refund_price <> ''";
if($od_receipt_point)
	$sql .= " and od_receipt_point <> ''";
if($od_status)
	$sql .= " and od_coupon <> ''";
if($fr_date)
	$sql .= " and od_time > '$fr_date' and od_time < '$to_date'";


$result = sql_query($sql);

//$result = mysql_query($sql); // sql에 가져온 정보를 result에 담는다.

// 테이블 상단 만들기
$EXCEL_STR = "
<table border='1'>
<tr>
   <th>주문번호</th>
   <th>주문상태</th>
   <th>결제수단</th>
   <th>주문합계(선불배송비포함)</th>
   <th>입금합계</th>
   <th>주문취소</th>
   <th>쿠폰</th>
   <th>미수금</th>
</tr>
<tr>
   <th>주문자</th>
   <th>주문자전화</th>
   <th>받는분</th>
   <th>회원ID</th>
   <th>주문상품수</th>
   <th>누적주문수</th>
   <th>운송장번호</th>
   <th>배송회사</th>
   <th>배송일시</th>
</tr>";

//위에 talbe은 자신이 가져올 값들의 컬럼 명이 되겠다.

while($row = sql_fetch_array($result)) {

	$od_cnt = 0;
	if ($row['mb_id'])
	{
		$sql2 = " select count(*) as cnt from g5_shop_order where mb_id = '$row[mb_id]' ";
		$row2 = sql_fetch($sql2);
		$od_cnt = $row2['cnt'];
	}

	switch(strlen($row['od_id'])) {
		case 16:
			$disp_od_id = substr($row['od_id'],0,8).'-'.substr($row['od_id'],8);
			break;
		default:
			$disp_od_id = substr($row['od_id'],0,6).'-'.substr($row['od_id'],6);
			break;
	}

   $EXCEL_STR .= "
	<tr>
		<td>$disp_od_id</td>
		<td>$row[od_status]</td>
		<td>$row[od_settle_case]</td>
		<td>".number_format($row[od_cart_price] + $row[od_send_cost] + $row[od_send_cost2])."</td>
		<td>".number_format($row[od_receipt_price])."</td>
		<td>".number_format($row[od_cancel_price])."</td>
		<td>".number_format($row[od_coupon])."</td>
		<td>".number_format($row[od_misu])."</td>
	</tr>
	<tr>
		<td>$row[od_name]</td>
		<td>$row[od_od_tel]</td>
		<td>$row[od_b_name]</td>
		<td>$row[mb_id]</td>
		<td>$row[od_cart_count] 건</td>
		<td>$od_cnt 건</td>
		<td>$row[od_invoice]</td>
		<td>$row[od_delivery_company]</td>
		<td>".(is_null_time($row['od_invoice_time']) ? '-' : substr($row['od_invoice_time'],2,14))."</td>
	</tr>
   ";
}

$EXCEL_STR .= "</table>";
echo $EXCEL_STR;
?>