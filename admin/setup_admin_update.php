<?php

include_once "./_common.php";

//토큰체크
check_admin_token();

if (!trim($_SESSION['ss_mb_id']))
    alert('로그인 되어 있지 않습니다.');

//회원아이디
$mb_id = isset($_SESSION['ss_mb_id']) ? trim($_SESSION['ss_mb_id']) : '';

if(!$mb_id)
    alert('회원아이디 값이 없습니다. 올바른 방법으로 이용해 주십시오.');

if (trim($_POST['mb_id']) != $mb_id)
    alert("로그인된 정보와 수정하려는 정보가 틀리므로 수정할 수 없습니다.\\n만약 올바르지 않은 방법을 사용하신다면 바로 중지하여 주십시오.");

$mb_password    = trim($_POST['mb_password']);

//if(!$mb_password)
    //alert('비밀번호가 넘어오지 않았습니다.');

$sql_password = "";

if ($mb_password)
    $sql_password = " mb_password = '".get_encrypt_string($mb_password)."' ,";

$mb_zip1 = substr($_POST['mb_zip'], 0, 3);
$mb_zip2 = substr($_POST['mb_zip'], 3);

$sql=" mb_name='$mb_name',
mb_nick='$mb_name',
			mb_hp='$mb_hp',
			mb_tel='$mb_tel',
			mb_email='$mb_email',
            mb_zip1 = '$mb_zip1',
            mb_zip2 = '$mb_zip2',
            mb_addr1 = '{$_POST['mb_addr1']}',
            mb_addr2 = '{$_POST['mb_addr2']}',
            mb_addr3 = '{$_POST['mb_addr3']}',
            mb_addr_jibeon = '{$_POST['mb_addr_jibeon']}'";

sql_query(" update {$g5['member_table']} set $sql_password $sql where mb_id = '$mb_id' ");

alert("관리자 정보가 변경되었습니다", G5_MANAGE_URL . "/setup_admin.php");

