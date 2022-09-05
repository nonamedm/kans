<?php
$sub_menu = '400200';
include_once('./_common.php');

if ($file = $_POST['ca_include_head']) {
    if (!preg_match("/\.(php|htm[l]?)$/i", $file)) {
        alert("상단 파일 경로가 php, html 파일이 아닙니다.");
    }
}

if ($file = $_POST['ca_include_tail']) {
    if (!preg_match("/\.(php|htm[l]?)$/i", $file)) {
        alert("하단 파일 경로가 php, html 파일이 아닙니다.");
    }
}

if ($w == "u" || $w == "d")
    check_demo();

auth_check($auth[$sub_menu], "d");

check_admin_token();

if ($w == 'd' && $is_admin != 'super')
    alert("최고관리자만 분류를 삭제할 수 있습니다.");

if ($w == "" || $w == "u")
{
    if ($ca_mb_id)
    {
        $sql = " select mb_id from {$g5['member_table']} where mb_id = '$ca_mb_id' ";
        $row = sql_fetch($sql);
        if (!$row['mb_id'])
            alert("\'$ca_mb_id\' 은(는) 존재하는 회원아이디가 아닙니다.");
    }
}

$sql_common = " ca_order                = '$ca_order',               
                ca_sell_email           = '$ca_sell_email',
                ca_use                  = '$ca_use',
                ca_stock_qty            = '$ca_stock_qty',
                ca_explan_html          = '$ca_explan_html',
                ca_head_html            = '$ca_head_html',
                ca_tail_html            = '$ca_tail_html',
                ca_mobile_head_html     = '$ca_mobile_head_html',
                ca_mobile_tail_html     = '$ca_mobile_tail_html',
                ca_nocoupon             = '$ca_nocoupon'";


if ($w == "")
{
    if (!trim($ca_id))
        alert("분류 코드가 없으므로 분류를 추가하실 수 없습니다.");

    // 소문자로 변환
    $ca_id = strtolower($ca_id);

    $sql = " insert {$g5['g5_shop_category_table']}
                set ca_id   = '$ca_id',
                    ca_name = '$ca_name',
                    $sql_common ";
    sql_query($sql);
}
else if ($w == "u")
{
    $sql = " update {$g5['g5_shop_category_table']}
                set ca_name = '$ca_name',
                    $sql_common
              where ca_id = '$ca_id' ";
    sql_query($sql);

    // 하위분류를 똑같은 설정으로 반영
    if ($sub_category) {
        $len = strlen($ca_id);
        $sql = " update {$g5['g5_shop_category_table']}
                    set $sql_common
                  where SUBSTRING(ca_id,1,$len) = '$ca_id' ";
        if ($is_admin != 'super')
            $sql .= " and ca_mb_id = '{$member['mb_id']}' ";
        sql_query($sql);
    }

	$sql = " select ca_10 from {$g5['g5_shop_category_table']} where ca_id = '$ca_id' ";
    $ca = sql_fetch($sql);
}
else if ($w == "d")
{
    // 분류의 길이
    $len = strlen($ca_id);

    $sql = " select COUNT(*) as cnt from {$g5['g5_shop_category_table']}
              where SUBSTRING(ca_id,1,$len) = '$ca_id'
                and ca_id <> '$ca_id' ";
    $row = sql_fetch($sql);
    if ($row['cnt'] > 0)
        alert("이 분류에 속한 하위 분류가 있으므로 삭제 할 수 없습니다.\\n\\n하위분류를 우선 삭제하여 주십시오.");

    $str = $comma = "";
    $sql = " select it_id from {$g5['g5_shop_item_table']} where ca_id = '$ca_id' ";
    $result = sql_query($sql);
    $i=0;
    while ($row = sql_fetch_array($result))
    {
        $i++;
        if ($i % 10 == 0) $str .= "\\n";
        $str .= "$comma{$row['it_id']}";
        $comma = " , ";
    }

    if ($str)
        alert("이 분류와 관련된 상품이 총 {$i} 건 존재하므로 상품을 삭제한 후 분류를 삭제하여 주십시오.\\n\\n$str");

    // 분류 삭제
    $sql = " delete from {$g5['g5_shop_category_table']} where ca_id = '$ca_id' ";
    sql_query($sql);
}

// 첨부파일 경로
$ca_dir = G5_DATA_PATH.'/cate/';

// 파일 삭제 체크시
$filename2 = $ca['ca_10'];
if (isset($_POST['del_ca_10'])) {
    @unlink($ca_dir.'/'.iconv("UTF-8","EUC-KR",$filename2));
	$sql = " update {$g5['g5_shop_category_table']} set ca_10 ='' where ca_id='$ca_id'" ;
	sql_query($sql);
}

// 파일 업로드
$msg = "";
$ca_10 = '';

if (isset($_FILES['ca_10']) && is_uploaded_file($_FILES['ca_10']['tmp_name'])) {
    if (preg_match("/(\.gif|jpg|png|jpeg)$/i", $_FILES['ca_10']['name'])) {
        // 파일 용량이 설정값보다 이하만 업로드 가능
        if ($_FILES['ca_10']['size'] <= 5000000) {
            @mkdir($ca_dir, G5_DIR_PERMISSION);
            @chmod($ca_dir, G5_DIR_PERMISSION);
			$dest_path = $ca_dir.'/'.$_FILES['ca_10']['name'];
			
			// 수정시 기존파일 삭제
			$filename2 = $ca['ca_10'];
			@unlink($ca_dir.'/'.iconv("UTF-8","EUC-KR",$filename2));
			$sql = " update {$g5['g5_shop_category_table']} set ca_10 ='' where ca_id='$ca_id'" ;
			sql_query($sql);
			
			// 파일업로드
            move_uploaded_file($_FILES['ca_10']['tmp_name'], iconv("UTF-8","EUC-KR",$dest_path));
			chmod(iconv("UTF-8","EUC-KR",$dest_path), G5_FILE_PERMISSION);
            
			// 파일명 여분필드에 업데이트
			$filename = $_FILES['ca_10']['name'];
			$sql = " update {$g5['g5_shop_category_table']} set ca_10 ='$filename' where ca_id='$ca_id'" ;
			sql_query($sql);

			
        } else {
            $msg .= '첨부이미지를 5M 이하로 업로드 해주십시오.';
        }

    } else {
        $msg .= $_FILES['ca_10']['name'].'은(는) 이미지파일이 아닙니다.';
    }
}

if ($w == "" || $w == "u")
{
    goto_url("./categoryform.php?w=u&amp;ca_id=$ca_id&amp;$qstr");
} else {
    goto_url("./categorylist.php?$qstr");
}
?>
