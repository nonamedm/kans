<?
include "../conf/connchk.inc";
include "../conf/dbconn.inc";

	$query = "update on_edu_member_rec set regdate='".$regdate."'";
	$query = $query." where idkey='".$id."' and seq ='".$seq ."'";
	//echo $query;

if(mysql_query($query)){
	echo"<script language=javascript>alert('���� ó���Ǿ����ϴ�');opener.location.reload();window.close();</script>";
	exit;
}else{
	echo"<script language=javascript>alert('��û�Ͻ� ó���� �����Ͽ����ϴ�. �����ڿ��� ���ǹٶ��ϴ�.');opener.location.reload();window.close();</script>";
	exit;
}


include "../conf/dbconn_close.inc";

?>