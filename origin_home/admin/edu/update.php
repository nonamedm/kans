<? 
if(!$cid){
	echo"<meta http-equiv=\"Refresh\" content=\"0 ; URL='../index.php'\">";
	exit;
}
include  "../dbconn.inc"; 

if($_head_php_excuted) return;
if(!eregi($HTTP_HOST,$HTTP_REFERER)) Error("정상적으로 접근하여 주시기 바랍니다.");
if(eregi(":\/\/",$dir)) $dir=".";

$note_num=trim($note_num);
$name=trim($name);
$jumin1=trim($jumin1);
$jumin2=trim($jumin2);


	if($edu_state == '1' || $edu_state == ''){		
		$query = "update edu_member set edu_state='".$edu_state."', edu_type='".$edu_type."',company1='".$company1."', position='".$position."', name='".$name."', jumin1='".$jumin1."', jumin2='".$jumin2."', email='".$email."', tel1='".$tel1."',tel2='".$tel2."', tel3='".$tel3."', type='".$type."', hope_year='".$hope_year."', hope_month='".$hope_month."', hope_day='".$hope_day."', company2='".$company1."', ceo='".$ceo."', com_num='".$com_num."', item='".$item."', condition='".$condition."', a_post1='".$a_post1."', a_post2='".$a_post2."', a_addr='".$a_addr."', a_name='".$a_name."', a_position='".$a_position."', a_email='".$a_email."', a_tel1='".$a_tel1."', a_tel2='".$a_tel2."', a_tel3='".$a_tel3."', a_hp1='".$a_hp1."', a_hp2='".$a_hp2."', a_hp3='".$a_hp3."', a_fax1='".$a_fax1."', a_fax2='".$a_fax2."', a_fax3='".$a_fax3."', note_num='".$note_num."', rec_num='".$rec_num."', memo='".$memo."',schedule = null , s_point = 0" ;
		$query = $query." where id=".$id;
	}else{
		$query = "update edu_member set edu_state='".$edu_state."', edu_type='".$edu_type."',company1='".$company1."', position='".$position."', name='".$name."', jumin1='".$jumin1."', jumin2='".$jumin2."', email='".$email."', tel1='".$tel1."',tel2='".$tel2."', tel3='".$tel3."', type='".$type."', hope_year='".$hope_year."', hope_month='".$hope_month."', hope_day='".$hope_day."', company2='".$company1."', ceo='".$ceo."', com_num='".$com_num."', item='".$item."', condition='".$condition."', a_post1='".$a_post1."', a_post2='".$a_post2."', a_addr='".$a_addr."', a_name='".$a_name."', a_position='".$a_position."', a_email='".$a_email."', a_tel1='".$a_tel1."', a_tel2='".$a_tel2."', a_tel3='".$a_tel3."', a_hp1='".$a_hp1."', a_hp2='".$a_hp2."', a_hp3='".$a_hp3."', a_fax1='".$a_fax1."', a_fax2='".$a_fax2."', a_fax3='".$a_fax3."', note_num='".$note_num."', rec_num='".$rec_num."', memo='".$memo."'" ;
		$query = $query." where id=".$id;
	
	}
		
	$result = mysql_query($query);
		
	
if($result){
	echo"<script language=javascript>alert('수정되었습니다');location.href='./view.php?id=".$mem_id."&page=".$page."&search=".$search."&keyword=".$keyword."';</script>";
	exit;
}else{
	echo"<script language=javascript>alert('수정에 실패했습니다. 관리자에게 문의바랍니다.');location.href='./list.php?page=".$page."&search=".$search."&keyword=".$keyword."';</script>";
	exit;
}

?>