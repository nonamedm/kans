<?
include "../conf/connchk.inc";
include "../conf/dbconn.inc";

	$query = "update on_edu_member_rec set regdate='".$regdate."'";
	$query = $query." where idkey='".$id."' and seq ='".$seq ."'";
	//echo $query;

if(mysql_query($query)){
	echo"<script language=javascript>alert('정상 처리되었습니다');opener.location.reload();window.close();</script>";
	exit;
}else{
	echo"<script language=javascript>alert('요청하신 처리에 실패하였습니다. 관리자에게 문의바랍니다.');opener.location.reload();window.close();</script>";
	exit;
}


include "../conf/dbconn_close.inc";

?>