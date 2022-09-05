<? 
include "../conf/dbconn.inc";

$uid=trim($rx);

$sql1="select * from edu_rev_member where uid=$uid";
$res1=mysql_query($sql1);
$total1=mysql_affected_rows();

$sql2="select * from edu_rev where uid=$uid and date_format(sysdate(),'%Y%m%d') between rsdate and redate and (max_user-$total1) > 0";
$res2=mysql_query($sql2);
$row2=mysql_fetch_object($res2);
$total2=mysql_affected_rows();

if($total2>0){
	$birth=trim($birth);
	$name=trim($name);
	$tel=trim($tel);
	$email=trim($email);
	$company=trim($company);
	$part=trim($part);
	$license_type=trim($license_type);
	$license_num=trim($license_num);
	$license_reg=trim($license_reg);

	$now=mktime();
	$now=date(Y.'.'.m.'.'.d,$now);

	$query = "insert into edu_rev_member(uid, birth, name, tel, email, company, part, license_type, license_num, license_reg, appy_yn, reg_date) values(";
	$query = $query." '".$uid."', ";
	$query = $query." '".$birth."', ";
	$query = $query." '".$name."', ";
	$query = $query." '".$tel."', ";
	$query = $query." '".$email."', ";
	$query = $query." '".$company."', ";
	$query = $query." '".$part."', ";
	$query = $query." '".$license_type."', ";
	$query = $query." '".$license_num."', ";
	$query = $query." '".$license_reg."', ";
	$query = $query." 0, ";
	$query = $query." '".$now."' ) ";

	if(mysql_query($query)){
		echo"<script language=javascript>alert('정상 등록되었습니다.');document.location.href='./edu01.html'</script>";
		exit;
	}else{
		echo"<script language=javascript>alert('등록에 실패했습니다. 관리자에게 문의바랍니다.');document.location.reload();</script>";
		exit;
	}

}else{
	echo"<script language=javascript>alert('등록에 실패했습니다. 관리자에게 문의바랍니다.');document.location.reload();</script>";
	exit;
}

?>