<?
include "../dbconn.inc";

if($_head_php_excuted) return;
if(!eregi($HTTP_HOST,$HTTP_REFERER)) Error("정상적으로 접근하여 주시기 바랍니다.");
if(eregi(":\/\/",$dir)) $dir=".";

$sql="select jumin1, jumin2 from  edu_member where jumin1='".$jumin1."' and jumin2='".$jumin2."'";

$res = mysql_query($sql);
$row = mysql_fetch_object($res);
if($row){
?>
<script language=javascript>
	alert('이미 등록된 교육대상자입니다.\n 확인해 주세요.');
	history.back();
</script>
<?
	exit;
}
$note_num=trim($note_num);
$name=trim($name);
$jumin1=trim($jumin1);
$jumin2=trim($jumin2);

$now=mktime();
$now=date(Y.'.'.m.'.'.d,$now);

$id = $jumin1 + $jumin2;

	$query = "insert into edu_member(mem_id, edu_type, type, company1, position, name, jumin1, jumin2, email, tel1, tel2, tel3, hope_year, hope_month, hope_day, company2, ceo, com_num, item, condition, a_post1, a_post2, a_addr, a_name, a_position, a_email, a_tel1, a_tel2, a_tel3, a_hp1, a_hp2, a_hp3, a_fax1, a_fax2, a_fax3, note_num, comp_year, comp_day, pay_year, pay_day, rec_num, memo, regdate) values(";
	$query = $query." '".MD5($id)."', ";
	$query = $query." '".$edu_type."', ";
	$query = $query." '".$type."', ";
	$query = $query." '".$company1."', ";
	$query = $query." '".$position."', ";
	$query = $query." '".$name."', ";
	$query = $query." '".$jumin1."', ";
	$query = $query." '".$jumin2."', ";
	$query = $query." '".$email."', ";
	$query = $query." '".$tel1."', ";
	$query = $query." '".$tel2."', ";
	$query = $query." '".$tel3."', ";	
	$query = $query." '".$hope_year."', ";
	$query = $query." '".$hope_month."', ";
	$query = $query." '".$hope_day."', ";	
	$query = $query." '".$company1."', ";
	$query = $query." '".$ceo."', ";
	$query = $query." '".$com_num."', ";
	$query = $query." '".$item."', ";
	$query = $query." '".$condition."', ";	
	$query = $query." '".$a_post1."', ";
	$query = $query." '".$a_post2."', ";
	$query = $query." '".$a_addr."', ";
	$query = $query." '".$a_name."', ";
	$query = $query." '".$a_position."', ";
	$query = $query." '".$a_email."', ";
	$query = $query." '".$a_tel1."', ";
	$query = $query." '".$a_tel2."', ";
	$query = $query." '".$a_tel3."', ";	
	$query = $query." '".$a_hp1."', ";
	$query = $query." '".$a_hp2."', ";
	$query = $query." '".$a_hp3."', ";
	$query = $query." '".$a_fax1."', ";
	$query = $query." '".$a_fax2."', ";
	$query = $query." '".$a_fax3."', ";		
	$query = $query." '".$note_num."', ";
	$query = $query." '".$comp_year."', ";
	$query = $query." '".$comp_day."', ";
	$query = $query." '".$pay_year."', ";
	$query = $query." '".$pay_day."', ";	
	$query = $query." '".$rec_num."', ";
	$query = $query." '".$memo."', ";
	$query = $query." '".$now."') ";
	
	$result = mysql_query($query);

if($result){
	echo"<script language=javascript>alert('등록되었습니다');location.href='./list.php';</script>";
	exit;
}else{
	echo"<script language=javascript>alert('등록에 실패했습니다. 관리자에게 문의바랍니다.');location.href='./list.php';</script>";
	exit;
}

?>