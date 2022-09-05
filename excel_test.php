<?php
include_once "./_common.php";
include_once(G5_EDITOR_LIB);

include_once G5_MANAGE_INCLUDE_PATH . "/admin.head.sub.php";

if($w){
	
	ini_set('memory_limit','-1');

	$file = $_FILES['excelfile']['tmp_name'];

	include_once(G5_LIB_PATH.'/Excel/reader.php');
	
	$data = new Spreadsheet_Excel_Reader();
	$data->setOutputEncoding('UTF-8');
	$data->read($file);

	error_reporting(E_ALL ^ E_NOTICE);

	// $write_table = "g5_write_".$bo_table;

	// 초기화
	/* $truncate_query = " TRUNCATE {$write_table} ";
	sql_query($truncate_query);

	// 게시판 원 글 수, 코멘트 수
	$CNT_INFO = sql_fetch("SELECT COUNT(wr_id) CNT FROM ".$write_table." WHERE wr_is_comment = '0'");
	$CNT_COM_INFO = sql_fetch("SELECT COUNT(wr_id) CNT FROM ".$write_table." WHERE wr_is_comment = '1'");

	// 업테이트
	$UPDATE_QUERY = "UPDATE g5_board SET bo_count_write = '".$CNT_INFO['CNT']."', bo_count_comment = '".$CNT_COM_INFO['CNT']."' WHERE bo_table = '".$bo_table."'";
	sql_query($UPDATE_QUERY); */

	// 회원일 경우
	if($bo_table == "member"){

		$query = " DELETE FROM {$g5['member_table']} WHERE mb_id NOT IN('admin', 'inpiad', 'kans') ";
		sql_query($query);

		$query = "ALTER TABLE `kans1`.`g5_member` 
					AUTO_INCREMENT = 1 ;";
		sql_query($query);
	}

	for ($i = 3; $i <= $data->sheets[0]['numRows']; $i++) {
	// for ($i = $data->sheets[0]['numRows']; $i >= 3 ; $i--) {
		
		// 소속 관리
		if($bo_table == "mem_group"){
			$j = 1;
			
			$wr_1_val			= addslashes($data->sheets[0]['cells'][$i][$j++]); // 번호
			$wr_2_val			= addslashes($data->sheets[0]['cells'][$i][$j++]); // 소속기관

			if(empty($wr_2_val)){ continue; }

			// 없는 변수 초기값
			$wr_is_comment = 0;
			$wr_comment = 0;
			$wr_comment_reply = "";

			$wr_option = "";

			$wr_link1 = "";
			$wr_link2 = "";

			$wr_link1_hit = "";
			$wr_link2_hit = "";

			$wr_good = 0;
			$wr_nogood = 0;

			$wr_email = "";

			$wr_homepage = "";

			$wr_facebook_user = "";
			$wr_twitter_user = "";

			$wr_1 = $wr_2 = $wr_3 = $wr_4 = $wr_5 = $wr_6 = $wr_7 = $wr_8 = $wr_9 = $wr_10 =  "";

			// 중복 체크
			$check_info = sql_fetch(" SELECT * FROM {$write_table} WHERE wr_subject = '{$wr_2_val}' ");
			if($check_info["wr_id"]){ continue; }


			$wr_num = get_next_num($write_table);
			$wr_reply = '';

			$ca_name = "";
			
			$wr_subject = $wr_2_val; // 회사명
			$wr_content = $wr_subject;

			$wr_hit = 0;

			$adm = get_member("admin");

			$mb_id = "admin";

			// $wr_password = get_encrypt_string("123456"); // 패스워드 초기화
			$wr_password = $adm["mb_password"];

			$wr_name = $adm['mb_name'];
			$wr_email = $adm['mb_email'];

			$wr_datetime = $wr_last = G5_TIME_YMDHIS;

			// 파일 수
			$wr_file = 0;

			$wr_ip = $_SERVER['REMOTE_ADDR'];

			$INSERT_QUERY = "INSERT INTO ".$write_table." SET
									wr_num = '".$wr_num."',
									wr_reply = '".$wr_reply."',
									wr_is_comment = '".$wr_is_comment."',
									wr_comment = '".$wr_comment."',
									wr_comment_reply = '".$wr_comment_reply."',
									ca_name = '".$ca_name."',
									wr_option = '".$wr_option."',
									wr_subject = '".$wr_subject."',
									wr_content = '".$wr_content."',
									wr_link1 = '".$wr_link1."',
									wr_link2 = '".$wr_link2."',
									wr_link1_hit = '".$wr_link1_hit."',
									wr_link2_hit = '".$wr_link2_hit."',
									wr_hit = '".$wr_hit."',
									wr_good = '".$wr_good."',
									wr_nogood = '".$wr_nogood."',
									mb_id = '".$mb_id."',
									wr_password = '".$wr_password."',
									wr_name = '".$wr_name."',
									wr_email = '".$wr_email."',
									wr_homepage = '".$wr_homepage."',
									wr_datetime = '".$wr_datetime."',
									wr_file = '".$wr_file."',
									wr_last = '".$wr_last."',
									wr_ip = '".$wr_ip."',
									wr_facebook_user = '".$wr_facebook_user."',
									wr_twitter_user = '".$wr_twitter_user."',
									wr_1 = '".$wr_1."',
									wr_2 = '".$wr_2."',
									wr_3 = '".$wr_3."',
									wr_4 = '".$wr_4."',
									wr_5 = '".$wr_5."',
									wr_6 = '".$wr_6."',
									wr_7 = '".$wr_7."',
									wr_8 = '".$wr_8."',
									wr_9 = '".$wr_9."',
									wr_10 = '".$wr_10."'";

			// echo "<br>".$INSERT_QUERY;

			sql_query($INSERT_QUERY);

			$wr_id = sql_insert_id();

			// 부모 아이디에 UPDATE
			sql_query("UPDATE $write_table SET wr_parent = '$wr_id' WHERE wr_id = '$wr_id'");

			// 새글 INSERT
			sql_query("INSERT INTO {$g5['board_new_table']} ( bo_table, wr_id, wr_parent, bn_datetime, mb_id ) VALUES ( '{$bo_table}', '{$wr_id}', '{$wr_id}', '".G5_TIME_YMDHIS."', '".$mb_id."' ) ");

			// 게시글 1 증가
			sql_query("UPDATE {$g5['board_table']} SET bo_count_write = bo_count_write + 1 WHERE bo_table = '{$bo_table}'");
			// echo "<br>".$wr_subject;
		}

		// 회원 관리
		else if($bo_table == "member"){

			$j = 1;
			
			$wr_1_val			= addslashes($data->sheets[0]['cells'][$i][$j++]); // ID
			$wr_2_val			= addslashes($data->sheets[0]['cells'][$i][$j++]); // PW
			$wr_3_val			= addslashes($data->sheets[0]['cells'][$i][$j++]); // 이름
			$wr_4_val			= addslashes($data->sheets[0]['cells'][$i][$j++]); // 생년월일
			$wr_5_val			= addslashes($data->sheets[0]['cells'][$i][$j++]); // 휴대폰번호
			$wr_6_val			= addslashes($data->sheets[0]['cells'][$i][$j++]); // 이메일
			$wr_7_val			= addslashes($data->sheets[0]['cells'][$i][$j++]); // 소속기관
			$wr_8_val			= addslashes($data->sheets[0]['cells'][$i][$j++]); // 등급
			$wr_9_val			= addslashes($data->sheets[0]['cells'][$i][$j++]); // 방사선사 면허번호
			
			// 빈 값 체크
			if(empty($wr_1_val) &&empty($wr_2_val) && empty($wr_3_val) && empty($wr_4_val) && empty($wr_5_val) && empty($wr_6_val) && empty($wr_7_val) && empty($wr_8_val) && empty($wr_9_val)){ continue; }

			// ================= 변수 초기화
			// $mb_no = 0;
			$mb_id = "";
			$mb_password = "";
			$mb_name = "";
			$mb_nick = "";
			$mb_nick_date = "0000-00-00";
			$mb_email = "";
			$mb_homepage = "";
			$mb_level = 0;
			$mb_sex = "";
			$mb_birth = "";
			$mb_tel = "";
			$mb_hp = "";
			$mb_certify = "";
			$mb_adult = 0;
			$mb_dupinfo = "";
			$mb_zip1 = "";
			$mb_zip2 = "";
			$mb_addr1 = "";
			$mb_addr2 = "";
			$mb_addr3 = "";
			$mb_addr_jibeon = "";
			$mb_signature = "";
			$mb_recommend = "";
			$mb_point = 0;
			$mb_today_login = "0000-00-00 00:00:00";
			$mb_login_ip = "";
			$mb_datetime = "0000-00-00 00:00:00";
			$mb_ip = "";
			$mb_leave_date = "";
			$mb_intercept_date = "";
			$mb_email_certify = "0000-00-00 00:00:00";
			$mb_email_certify2 = "";
			$mb_memo = "";
			$mb_lost_certify = "";
			$mb_mailling = 0;
			$mb_sms = 0;
			$mb_open = 0;
			$mb_open_date = "0000-00-00";
			$mb_profile = "";
			$mb_memo_call = "";
			$mb_1 = "";
			$mb_2 = "";
			$mb_3 = "";
			$mb_4 = "";
			$mb_5 = "";
			$mb_6 = "";
			$mb_7 = "";
			$mb_8 = "";
			$mb_9 = "";
			$mb_10 = "";
			
			// ================= 변수 세팅
			$mb_id = $wr_1_val;								// ID
			$mb_password = get_encrypt_string($wr_2_val);	// PW
			$mb_name = $mb_nick = $wr_3_val;				// 이름
			
			$mb_birth_ = explode("-", $wr_4_val);			// 생년월일
			$mb_birth = $mb_birth_[0];
			$mb_3 = $mb_birth_[0];
			$mb_4 = $mb_birth_[1];
			// if($mb_birth_[1] <= 2){ $mb_birth = "19".$wr_4_val; }
			// else{ $mb_birth = "20".$wr_4_val; }
			
			$mb_hp = $wr_5_val;				// 휴대폰번호
			$mb_email = $wr_6_val;			// 이메일
			// $wr_8_val					// 소속기관
			
			$write_table = "g5_write_mem_group";
			
			// 소속 찾기
			$check_info = sql_fetch(" SELECT * FROM {$write_table} WHERE wr_subject = '{$wr_7_val}' ");
			
			// 있을 경우
			if($check_info["wr_id"]){ $mb_1 = $check_info["wr_id"]; $mb_2 = $check_info["wr_subject"]; }
			else{ $mb_1 = $mb_2 = ""; }

			$mb_level = ($wr_8_val == "개인" || $wr_8_val == "교육생")?2:3;			// 등급
			// $wr_10_val			// 방사선사 면허번호

			$mb_datetime = G5_TIME_YMDHIS;

			$INSERT_QUERY = " INSERT INTO {$g5['member_table']} SET
									/* mb_no = '{$mb_no}', */
									mb_id = '{$mb_id}',
									mb_password = '{$mb_password}',
									mb_name = '{$mb_name}',
									mb_nick = '{$mb_nick}',
									mb_nick_date = '{$mb_nick_date}',
									mb_email = '{$mb_email}',
									mb_homepage = '{$mb_homepage}',
									mb_level = '{$mb_level}',
									mb_sex = '{$mb_sex}',
									mb_birth = '{$mb_birth}',
									mb_tel = '{$mb_tel}',
									mb_hp = '{$mb_hp}',
									mb_certify = '{$mb_certify}',
									mb_adult = '{$mb_adult}',
									mb_dupinfo = '{$mb_dupinfo}',
									mb_zip1 = '{$mb_zip1}',
									mb_zip2 = '{$mb_zip2}',
									mb_addr1 = '{$mb_addr1}',
									mb_addr2 = '{$mb_addr2}',
									mb_addr3 = '{$mb_addr3}',
									mb_addr_jibeon = '{$mb_addr_jibeon}',
									mb_signature = '{$mb_signature}',
									mb_recommend = '{$mb_recommend}',
									mb_point = '{$mb_point}',
									mb_today_login = '{$mb_today_login}',
									mb_login_ip = '{$mb_login_ip}',
									mb_datetime = '{$mb_datetime}',
									mb_ip = '{$mb_ip}',
									mb_leave_date = '{$mb_leave_date}',
									mb_intercept_date = '{$mb_intercept_date}',
									mb_email_certify = '{$mb_email_certify}',
									mb_email_certify2 = '{$mb_email_certify2}',
									mb_memo = '{$mb_memo}',
									mb_lost_certify = '{$mb_lost_certify}',
									mb_mailling = '{$mb_mailling}',
									mb_sms = '{$mb_sms}',
									mb_open = '{$mb_open}',
									mb_open_date = '{$mb_open_date}',
									mb_profile = '{$mb_profile}',
									mb_memo_call = '{$mb_memo_call}',
									mb_1 = '{$mb_1}',
									mb_2 = '{$mb_2}',
									mb_3 = '{$mb_3}',
									mb_4 = '{$mb_4}',
									mb_5 = '{$mb_5}',
									mb_6 = '{$mb_6}',
									mb_7 = '{$mb_7}',
									mb_8 = '{$mb_8}',
									mb_9 = '{$mb_9}',
									mb_10 = '{$mb_10}' ";
			
			// echo "<br>".$INSERT_QUERY;
			sql_query($INSERT_QUERY);
		}

    }

	alert("저장하였습니다.", "./excel_test.php?bo_table=$bo_table");
	exit;
}
?>
<div class="local_desc01 local_desc" style="min-width: 600px;">
      <p>
		엑셀파일을 이용하여 일괄등록할 수 있습니다.<br>
		형식은 <strong>일괄등록용 엑셀파일</strong>을 다운로드하여 입력하시면 됩니다.<br>
		수정 완료 후 엑셀파일을 업로드하시면 게시글이 일괄등록됩니다.<br>
		엑셀파일을 저장하실 때는 <strong>Excel 97 - 2003 통합문서 (*.xls)</strong> 로 저장하셔야 합니다.
	</p>
</div>

<form name="fwrite" id="fwrite" method="post" enctype="multipart/form-data" autocomplete="off">
	<input type="hidden" name="w" value="u" />
	<input type="hidde" name="bo_table" value="<?=$bo_table ?>">mem_group member
	<table class="vertical">
		<colgroup>				
		<col width="15%" />
		<col width="*" />
	</colgroup>
	<thead>
		<tr>					
			<td scope="col">
				<input type="file" name="excelfile" class="frm_input">
			</td>
		</tr>
	</thead>
	</table>

	<div class="btn_area mt10">
		<div class="btn_area_right">
			<input type="submit" class="btn_normal" value="확인">
		</div>
	</div>
</form>