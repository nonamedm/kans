<?
include "../dbconn.inc";

if($_head_php_excuted) return;
if(!eregi($HTTP_HOST,$HTTP_REFERER)) Error("���������� �����Ͽ� �ֽñ� �ٶ��ϴ�.");
if(eregi(":\/\/",$dir)) $dir=".";

$sql="select year, month, day from  edu_schedule where year ='".$year."' and month ='".$month."' and day ='".$day."'";

$res = mysql_query($sql);
$row = mysql_fetch_object($res);
if($row){
?>
<script language=javascript>
	alert('�̹� ��ϵ� ������ �������� �����մϴ�.\n Ȯ���� �ּ���.');
	history.back();
</script>
<?
	exit;
}

if($pds1 != ''){

	$savedir='../../edu/pds/';
	if(strcmp($pds1,'none'))	{

		$full_filename=explode('.',$pds1_name);
		$extension=$full_filename[sizeof($full_filename)-1];

		if(!($extension == 'hwp' || $extension == 'zip' || $extension == 'doc' || $extension == 'gif' || $extension == 'jpg' || $extension == 'ppt' || $extension == 'pdf' || $extension == 'mp3' || $extension == 'wmv')){
			echo"<script language=javascript>alert('[hwp,ppt,pdf,doc,gif,jpg,txt,mp3,wmv] ���ϸ� �ø��� �ֽ��ϴ�');history.back();</script>";
			exit;
		}

		$exist=file_exists("$savedir/$pds1_name");
		if($exist){
			echo"<script language=javascript>alert(\"�ڷ�1�� ������ ���� ������ �����մϴ�. �ٸ��̸����� �÷��ּ���!\");history.back();</script>";
			exit;
		}
		if(!copy($pds1,"$savedir/$pds1_name")){
			echo"<script language=javascript>alert('���Ͼ��ε忡 �����߽��ϴ�! ��������̴� ���߿� �÷��ּ���!');history.back();</script>";
			exit;
		}
	}
}
if($pds2 != ''){

	$savedir='../../edu/pds/';
	if(strcmp($pds2,'none'))	{

		$full_filename=explode('.',$pds2_name);
		$extension=$full_filename[sizeof($full_filename)-1];

		if(!($extension == 'hwp' || $extension == 'zip' || $extension == 'doc' || $extension == 'gif' || $extension == 'jpg' || $extension == 'ppt' || $extension == 'pdf' || $extension == 'mp3' || $extension == 'wmv')){
			echo"<script language=javascript>alert('[hwp,ppt,pdf,doc,gif,jpg,txt,mp3,wmv] ���ϸ� �ø��� �ֽ��ϴ�');history.back();</script>";
			exit;
		}

		$exist=file_exists("$savedir/$pds2_name");
		if($exist){
			echo"<script language=javascript>alert(\"�ڷ�2�� ������ ���� ������ �����մϴ�. �ٸ��̸����� �÷��ּ���!\");history.back();</script>";
			exit;
		}
		if(!copy($pds2,"$savedir/$pds2_name")){
			echo"<script language=javascript>alert('���Ͼ��ε忡 �����߽��ϴ�! ��������̴� ���߿� �÷��ּ���!');history.back();</script>";
			exit;
		}
	}
}
if($pds3 != ''){

	$savedir='../../edu/pds/';
	if(strcmp($pds3,'none'))	{

		$full_filename=explode('.',$pds3_name);
		$extension=$full_filename[sizeof($full_filename)-1];

		if(!($extension == 'hwp' || $extension == 'zip' || $extension == 'doc' || $extension == 'gif' || $extension == 'jpg' || $extension == 'ppt' || $extension == 'pdf' || $extension == 'mp3' || $extension == 'wmv')){
			echo"<script language=javascript>alert('[hwp,ppt,pdf,doc,gif,jpg,txt,mp3,wmv] ���ϸ� �ø��� �ֽ��ϴ�');history.back();</script>";
			exit;
		}

		$exist=file_exists("$savedir/$pds3_name");
		if($exist){
			echo"<script language=javascript>alert(\"�ڷ�3�� ������ ���� ������ �����մϴ�. �ٸ��̸����� �÷��ּ���!\");history.back();</script>";
			exit;
		}
		if(!copy($pds3,"$savedir/$pds3_name")){
			echo"<script language=javascript>alert('���Ͼ��ε忡 �����߽��ϴ�! ��������̴� ���߿� �÷��ּ���!');history.back();</script>";
			exit;
		}
	}
}
if($pds4 != ''){

	$savedir='../../edu/pds/';
	if(strcmp($pds4,'none'))	{

		$full_filename=explode('.',$pds4_name);
		$extension=$full_filename[sizeof($full_filename)-1];

		if(!($extension == 'hwp' || $extension == 'zip' || $extension == 'doc' || $extension == 'gif' || $extension == 'jpg' || $extension == 'ppt' || $extension == 'pdf' || $extension == 'mp3' || $extension == 'wmv')){
			echo"<script language=javascript>alert('[hwp,ppt,pdf,doc,gif,jpg,txt,mp3,wmv] ���ϸ� �ø��� �ֽ��ϴ�');history.back();</script>";
			exit;
		}

		$exist=file_exists("$savedir/$pds4_name");
		if($exist){
			echo"<script language=javascript>alert(\"�ڷ�4�� ������ ���� ������ �����մϴ�. �ٸ��̸����� �÷��ּ���!\");history.back();</script>";
			exit;
		}
		if(!copy($pds4,"$savedir/$pds4_name")){
			echo"<script language=javascript>alert('���Ͼ��ε忡 �����߽��ϴ�! ��������̴� ���߿� �÷��ּ���!');history.back();</script>";
			exit;
		}
	}
}
if($pds5 != ''){

	$savedir='../../edu/pds/';
	if(strcmp($pds5,'none'))	{

		$full_filename=explode('.',$pds5_name);
		$extension=$full_filename[sizeof($full_filename)-1];

		if(!($extension == 'hwp' || $extension == 'zip' || $extension == 'doc' || $extension == 'gif' || $extension == 'jpg' || $extension == 'ppt' || $extension == 'pdf' || $extension == 'mp3' || $extension == 'wmv')){
			echo"<script language=javascript>alert('[hwp,ppt,pdf,doc,gif,jpg,txt,mp3,wmv] ���ϸ� �ø��� �ֽ��ϴ�');history.back();</script>";
			exit;
		}

		$exist=file_exists("$savedir/$pds5_name");
		if($exist){
			echo"<script language=javascript>alert(\"�ڷ�5�� ������ ���� ������ �����մϴ�. �ٸ��̸����� �÷��ּ���!\");history.back();</script>";
			exit;
		}
		if(!copy($pds5,"$savedir/$pds5_name")){
			echo"<script language=javascript>alert('���Ͼ��ε忡 �����߽��ϴ�! ��������̴� ���߿� �÷��ּ���!');history.back();</script>";
			exit;
		}
	}
}
if($pds6 != ''){

	$savedir='../../edu/pds/';
	if(strcmp($pds6,'none'))	{

		$full_filename=explode('.',$pds6_name);
		$extension=$full_filename[sizeof($full_filename)-1];

		if(!($extension == 'hwp' || $extension == 'zip' || $extension == 'doc' || $extension == 'gif' || $extension == 'jpg' || $extension == 'ppt' || $extension == 'pdf' || $extension == 'mp3' || $extension == 'wmv')){
			echo"<script language=javascript>alert('[hwp,ppt,pdf,doc,gif,jpg,txt,mp3,wmv] ���ϸ� �ø��� �ֽ��ϴ�');history.back();</script>";
			exit;
		}

		$exist=file_exists("$savedir/$pds6_name");
		if($exist){
			echo"<script language=javascript>alert(\"�ڷ�6�� ������ ���� ������ �����մϴ�. �ٸ��̸����� �÷��ּ���!\");history.back();</script>";
			exit;
		}
		if(!copy($pds6,"$savedir/$pds6_name")){
			echo"<script language=javascript>alert('���Ͼ��ε忡 �����߽��ϴ�! ��������̴� ���߿� �÷��ּ���!');history.back();</script>";
			exit;
		}
	}
}

$title=trim($title);
$year=trim($year);
$month=trim($month);
$day=trim($day);

$now=mktime();
$now=date(Y.'.'.m.'.'.d,$now);

$query = "insert into edu_schedule(edu_type, s_point, year, month, day, day2, si, bun, title, pds1, pds_name1, d01, si1, bun1, pds2, pds_name2, d02, si2, bun2, pds3, pds_name3, d03, si3, bun3, pds4, pds_name4, d04, si4, bun4, pds5, pds_name5, d05, si5, bun5, pds6, pds_name6, d06, si6, bun6, regdate) values(";
	$query = $query." '".$edu_type."', ";
	$query = $query." '".$s_point."', ";
	$query = $query." '".$year."', ";
	$query = $query." '".$month."', ";
	$query = $query." '".$day."', ";
	$query = $query." '".$day2."', ";
	$query = $query." '".$si."', ";
	$query = $query." '".$bun."', ";
	$query = $query." '".$title."', ";
	$query = $query." '".$pds1_name."', ";
	$query = $query." '".MD5($pds1_name)."', ";
	$query = $query." '".$d01."', ";
	$query = $query." '".$si1."', ";
	$query = $query." '".$bun1."', ";
	$query = $query." '".$pds2_name."', ";
	$query = $query." '".MD5($pds2_name)."', ";
	$query = $query." '".$d02."', ";
	$query = $query." '".$si2."', ";
	$query = $query." '".$bun2."', ";
	$query = $query." '".$pds3_name."', ";
	$query = $query." '".MD5($pds3_name)."', ";
	$query = $query." '".$d03."', ";
	$query = $query." '".$si3."', ";
	$query = $query." '".$bun3."', ";
	$query = $query." '".$pds4_name."', ";
	$query = $query." '".MD5($pds4_name)."', ";
	$query = $query." '".$d04."', ";
	$query = $query." '".$si4."', ";
	$query = $query." '".$bun4."', ";
	$query = $query." '".$pds5_name."', ";
	$query = $query." '".MD5($pds5_name)."', ";
	$query = $query." '".$d05."', ";
	$query = $query." '".$si5."', ";
	$query = $query." '".$bun5."', ";
	$query = $query." '".$pds6_name."', ";
	$query = $query." '".MD5($pds6_name)."', ";
	$query = $query." '".$d06."', ";
	$query = $query." '".$si6."', ";
	$query = $query." '".$bun6."', ";
	$query = $query." '".$now."') ";

if(mysql_query($query)){
	echo"<script language=javascript>alert('��ϵǾ����ϴ�');location.href='./sch_list.php';</script>";
	exit;
}else{
	echo"<script language=javascript>alert('��Ͽ� �����߽��ϴ�. �����ڿ��� ���ǹٶ��ϴ�.');location.href='./sch_list.php';</script>";
	exit;
}
?>

