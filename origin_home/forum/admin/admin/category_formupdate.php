<?php
include_once('./_common.php');
if ($w == "u" || $w == "d") check_demo();
auth_check($auth[$sub_menu], "d");
check_admin_token();

if ($w == 'd' && $is_admin != 'super')
    alert2("최고관리자만 분류를 삭제할 수 있습니다.");

if($w==""){
	$sql = " select ca_name from {$g5['category']} where bo_table = '".$bo_table."' AND ca_id = '{$ca_id}' ";
	$row = sql_fetch($sql);
	if ($row['ca_name']) {
		$ca_name = addslashes($row['ca_name']);
		die("{\"error\":\"이미 등록된 분류코드 입니다.\\n\\n분류명 : {$ca_name}\"}");
	}
}
$sql_common = " content	= '$content',
				content2  = '$content2',
				turn = '".$turn."',
				datetime = '".G5_TIME_YMDHIS."' ";
if ($w == ""){
    if (!trim($ca_id))
        alert2("분류 코드가 없으므로 분류를 추가하실 수 없습니다.");
    $ca_id = strtolower($ca_id);
    $sql = " insert {$g5['category']}
                set bo_table = '$bo_table',
					ca_id   = '$ca_id',
                    ca_name = '$ca_name',
					ca_name2 = '$ca_name2',
					ca_name3 = '$ca_name3',
					ca_name4 = '$ca_name4',
                    $sql_common ";
    sql_query($sql);
	$idx = sql_insert_id();
}else if ($w == "u"){
	if($ca_id && $bo_table){
		$sql = " update {$g5['category']}
					set ca_name = '$ca_name',
					ca_name2 = '$ca_name2',
					ca_name3 = '$ca_name3',
					ca_name4 = '$ca_name4',
					$sql_common
				  where ca_id = '$ca_id' AND bo_table = '$bo_table' ";
		sql_query($sql);
	
		if ($sub_category) {
			$len = strlen($ca_id);
			$sql = " update {$g5['category']}
						set $sql_common
					  where SUBSTRING(ca_id,1,$len) = '$ca_id' AND bo_table = '$bo_table' ";
			if ($is_admin != 'super')
				$sql .= " and ca_mb_id = '{$member['mb_id']}' ";
			sql_query($sql);
		}
	}
}else if ($w == "d"){
    $len = strlen($ca_id);
    $sql = " select COUNT(*) as cnt from {$g5['category']}
              where SUBSTRING(ca_id,1,$len) = '$ca_id'
                and ca_id <> '$ca_id'
				AND bo_table = '$bo_table'";
    $row = sql_fetch($sql);
    if ($row['cnt'] > 0)
        alert("이 분류에 속한 하위 분류가 있으므로 삭제 할 수 없습니다.\\n\\n하위분류를 우선 삭제하여 주십시오.");

    /* sql_query("delete from {$g5['category']} where ca_id = '$ca_id' ");

	$file=sql_fetch("select bf_file  from g5_board_file where bo_table='category' and wr_id='$ca_id'");
	  @unlink(G5_DATA_PATH.'/file/category/'.$file['bf_file']);
        // 썸네일삭제
        if(preg_match("/\.({$config['cf_image_extension']})$/i", $file['bf_file'])) {
            delete_board_thumbnail("category", $file['bf_file']);
		}
	sql_query("delete from g5_board_file where bo_table='category' and wr_id='$ca_id'"); */

	// 삭제를 위한 처리
	$ca_info = sql_fetch("SELECT idx from {$g5['category']} WHERE ca_id = '$ca_id' AND bo_table = '$bo_table'");

	$file=sql_fetch("select bf_file  from g5_board_file where bo_table='category' and wr_id='".$ca_info['idx']."'");
	  @unlink(G5_DATA_PATH.'/file/category/'.$file['bf_file']);
        // 썸네일삭제
        if(preg_match("/\.({$config['cf_image_extension']})$/i", $file['bf_file'])) {
            delete_board_thumbnail("category", $file['bf_file']);
		}
	sql_query("delete from g5_board_file where bo_table='category' and wr_id='".$ca_info['idx']."'");

	sql_query("delete from {$g5['category']} where ca_id = '$ca_id' AND bo_table = '$bo_table' ");
}

function alert2($msg){?>
<script>
var msg="<?=$msg?>";
alert(msg);
parent.$('.layer_popup').dialog('close');
</script>
<?exit;}

if ($w == "" || $w == "u"){
// 디렉토리가 없다면 생성합니다. (퍼미션도 변경하구요.)
$bo_table="category";
$wr_id=$idx;
@mkdir(G5_DATA_PATH.'/file/'.$bo_table, G5_DIR_PERMISSION);
@chmod(G5_DATA_PATH.'/file/'.$bo_table, G5_DIR_PERMISSION);

$chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));

// 가변 파일 업로드
$file_upload_msg = '';
$upload = array();
for ($i=0; $i<count($_FILES['bf_file']['name']); $i++) {
    $upload[$i]['file']     = '';
    $upload[$i]['source']   = '';
    $upload[$i]['filesize'] = 0;
    $upload[$i]['image']    = array();
    $upload[$i]['image'][0] = '';
    $upload[$i]['image'][1] = '';
    $upload[$i]['image'][2] = '';

    // 삭제에 체크가 되어있다면 파일을 삭제합니다.
    if (isset($_POST['bf_file_del'][$i]) && $_POST['bf_file_del'][$i]) {
        $upload[$i]['del_check'] = true;
		if($_POST['bf_file_del2'][$i]) // -로 없앤것
			$upload[$i]['del_check2'] = true;

        $row = sql_fetch(" select bf_file from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$wr_id}' and bf_no = '{$i}' ");
        @unlink(G5_DATA_PATH.'/file/'.$bo_table.'/'.$row['bf_file']);
        // 썸네일삭제
        if(preg_match("/\.({$config['cf_image_extension']})$/i", $row['bf_file'])) {
            delete_board_thumbnail($bo_table, $row['bf_file']);
        }
    }
    else
        $upload[$i]['del_check'] = false;

    $tmp_file  = $_FILES['bf_file']['tmp_name'][$i];
    $filesize  = $_FILES['bf_file']['size'][$i];
    $filename  = $_FILES['bf_file']['name'][$i];
    $filename  = get_safe_filename($filename);

    // 서버에 설정된 값보다 큰파일을 업로드 한다면
    if ($filename) {
        if ($_FILES['bf_file']['error'][$i] == 1) {
            $file_upload_msg .= '\"'.$filename.'\" 파일의 용량이 서버에 설정('.$upload_max_filesize.')된 값보다 크므로 업로드 할 수 없습니다.\\n';
            continue;
        }
        else if ($_FILES['bf_file']['error'][$i] != 0) {
            $file_upload_msg .= '\"'.$filename.'\" 파일이 정상적으로 업로드 되지 않았습니다.\\n';
            continue;
        }
    }

    if (is_uploaded_file($tmp_file)) {
        // 관리자가 아니면서 설정한 업로드 사이즈보다 크다면 건너뜀
        if (!$is_admin && $filesize > $board['bo_upload_size']) {
            $file_upload_msg .= '\"'.$filename.'\" 파일의 용량('.number_format($filesize).' 바이트)이 게시판에 설정('.number_format($board['bo_upload_size']).' 바이트)된 값보다 크므로 업로드 하지 않습니다.\\n';
            continue;
        }

        //=================================================================\
        // 090714
        // 이미지나 플래시 파일에 악성코드를 심어 업로드 하는 경우를 방지
        // 에러메세지는 출력하지 않는다.
        //-----------------------------------------------------------------
        $timg = @getimagesize($tmp_file);
        // image type
        if ( preg_match("/\.({$config['cf_image_extension']})$/i", $filename) ||
             preg_match("/\.({$config['cf_flash_extension']})$/i", $filename) ) {
            if ($timg['2'] < 1 || $timg['2'] > 16)
                continue;
        }
        //=================================================================

        $upload[$i]['image'] = $timg;

        // 4.00.11 - 글답변에서 파일 업로드시 원글의 파일이 삭제되는 오류를 수정
        if ($w == 'u') {
            // 존재하는 파일이 있다면 삭제합니다.
            $row = sql_fetch(" select bf_file from {$g5['board_file_table']} where bo_table = '$bo_table' and wr_id = '$wr_id' and bf_no = '$i' ");
            @unlink(G5_DATA_PATH.'/file/'.$bo_table.'/'.$row['bf_file']);
            // 이미지파일이면 썸네일삭제
            if(preg_match("/\.({$config['cf_image_extension']})$/i", $row['bf_file'])) {
                delete_board_thumbnail($bo_table, $row['bf_file']);
            }
        }

        // 프로그램 원래 파일명
        $upload[$i]['source'] = $filename;
        $upload[$i]['filesize'] = $filesize;

        // 아래의 문자열이 들어간 파일은 -x 를 붙여서 웹경로를 알더라도 실행을 하지 못하도록 함
        $filename = preg_replace("/\.(php|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $filename);

        shuffle($chars_array);
        $shuffle = implode('', $chars_array);

        // 첨부파일 첨부시 첨부파일명에 공백이 포함되어 있으면 일부 PC에서 보이지 않거나 다운로드 되지 않는 현상이 있습니다. (길상여의 님 090925)
        $upload[$i]['file'] = abs(ip2long($_SERVER['REMOTE_ADDR'])).'_'.substr($shuffle,0,8).'_'.replace_filename($filename);

        $dest_file = G5_DATA_PATH.'/file/'.$bo_table.'/'.$upload[$i]['file'];

        // 업로드가 안된다면 에러메세지 출력하고 죽어버립니다.
        $error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES['bf_file']['error'][$i]);

        // 올라간 파일의 퍼미션을 변경합니다.
        chmod($dest_file, G5_FILE_PERMISSION);
    }
}

// 나중에 테이블에 저장하는 이유는 $wr_id 값을 저장해야 하기 때문입니다.
for ($i=0; $i<count($upload); $i++)
{
    if (!get_magic_quotes_gpc()) {
        $upload[$i]['source'] = addslashes($upload[$i]['source']);
    }

    $row = sql_fetch(" select count(*) as cnt from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$wr_id}' and bf_no = '{$i}' ");
    if ($row['cnt'])
    {
        // 삭제에 체크가 있거나 파일이 있다면 업데이트를 합니다.
        // 그렇지 않다면 내용만 업데이트 합니다.
        if ($upload[$i]['del_check'] || $upload[$i]['file'])
        { 
            $sql = " update {$g5['board_file_table']}
                        set bf_source = '{$upload[$i]['source']}',
                             bf_file = '{$upload[$i]['file']}',
                             bf_content = '{$bf_content[$i]}',
                             bf_filesize = '{$upload[$i]['filesize']}',
                             bf_width = '{$upload[$i]['image']['0']}',
                             bf_height = '{$upload[$i]['image']['1']}',
                             bf_type = '{$upload[$i]['image']['2']}',
                             bf_datetime = '".G5_TIME_YMDHIS."'
                      where bo_table = '{$bo_table}'
                                and wr_id = '{$wr_id}'
                                and bf_no = '{$i}' ";
            sql_query($sql);
			echo $sql;
        }
        else
        {
            $sql = " update {$g5['board_file_table']}
                        set bf_content = '{$bf_content[$i]}'
                        where bo_table = '{$bo_table}'
                                  and wr_id = '{$wr_id}'
                                  and bf_no = '{$i}' ";
            sql_query($sql);
        }
    }
    else
    {
        $sql = " insert into {$g5['board_file_table']}
                    set bo_table = '{$bo_table}',
                         wr_id = '{$wr_id}',
                         bf_no = '{$i}',
                         bf_source = '{$upload[$i]['source']}',
                         bf_file = '{$upload[$i]['file']}',
                         bf_content = '{$bf_content[$i]}',
                         bf_download = 0,
                         bf_filesize = '{$upload[$i]['filesize']}',
                         bf_width = '{$upload[$i]['image']['0']}',
                         bf_height = '{$upload[$i]['image']['1']}',
                         bf_type = '{$upload[$i]['image']['2']}',
                         bf_datetime = '".G5_TIME_YMDHIS."' ";
        sql_query($sql);
    }
}

// 업로드된 파일 내용에서 가장 큰 번호를 얻어 거꾸로 확인해 가면서
// 파일 정보가 없다면 테이블의 내용을 삭제합니다.
$row = sql_fetch(" select max(bf_no) as max_bf_no from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$wr_id}' ");
for ($i=(int)$row['max_bf_no']; $i>=0; $i--)
{
    $row2 = sql_fetch(" select bf_file from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$wr_id}' and bf_no = '{$i}' ");
    // 정보가 있다면 빠집니다.
    if ($row2['bf_file']) break;
    // 그렇지 않다면 정보를 삭제합니다.
    sql_query(" delete from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$wr_id}' and bf_no = '{$i}' ");
}


	
}
if($w=="d")    goto_url("./category.php?bo_table={$bo_table}$qstr");
?>
<script>
parent.$('.layer_popup').dialog('close');
</script>