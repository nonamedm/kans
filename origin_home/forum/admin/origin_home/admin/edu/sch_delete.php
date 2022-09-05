<? 
include  "../dbconn.inc"; 
if($_head_php_excuted) return;
if(!eregi($HTTP_HOST,$HTTP_REFERER)) Error("정상적으로 접근하여 주시기 바랍니다.");
if(eregi(":\/\/",$dir)) $dir=".";

$id=trim($id);

/** 이전 파일 삭제 **/
$sql="select pds1 from edu_schedule where id=$id";
$res=mysql_query($sql);
$row=mysql_fetch_object($res);

if($row->pds1 !=''){	
	$src='../../edu/pds/'.$row->pds1;
	if(!unlink($src))	{
	}
}

/** 이전 파일 삭제 **/
$sql="select pds2 from edu_schedule where id=$id";
$res=mysql_query($sql);
$row=mysql_fetch_object($res);

if($row->pds2 !=''){	
	$src='../../edu/pds/'.$row->pds2;
	if(!unlink($src))	{
	}
}

/** 이전 파일 삭제 **/
$sql="select pds3 from edu_schedule where id=$id";
$res=mysql_query($sql);
$row=mysql_fetch_object($res);

if($row->pds3 !=''){	
	$src='../../edu/pds/'.$row->pds3;
	if(!unlink($src))	{
	}
}

/** 이전 파일 삭제 **/
$sql="select pds4 from edu_schedule where id=$id";
$res=mysql_query($sql);
$row=mysql_fetch_object($res);

if($row->pds4 !=''){	
	$src='../../edu/pds/'.$row->pds4;
	if(!unlink($src))	{
	}
}

/** 이전 파일 삭제 **/
$sql="select pds5 from edu_schedule where id=$id";
$res=mysql_query($sql);
$row=mysql_fetch_object($res);

if($row->pds5 !=''){	
	$src='../../edu/pds/'.$row->pds5;
	if(!unlink($src))	{
	}
}

/** 이전 파일 삭제 **/
$sql="select pds6 from edu_schedule where id=$id";
$res=mysql_query($sql);
$row=mysql_fetch_object($res);

if($row->pds6 !=''){	
	$src='../../edu/pds/'.$row->pds6;
	if(!unlink($src))	{
	}
}

$query = "delete from edu_schedule where id=$id";

		$sql="select id, edu_state, schedule from edu_member where schedule = $id";
		$ress=mysql_query($sql);
		$total=mysql_affected_rows();
		
		if($total>0){

				for($i=1; $i<$total+1; $i++){
	    			$rows = mysql_fetch_object($ress);
					$query1 = "update edu_member set edu_state = 1, s_point = 0, schedule = null where id =" .$rows->id; 
					$res=mysql_query($query1);
				}
			}

if(mysql_query($query)){
	echo"<script language=javascript>alert('삭제되었습니다');location.href='./sch_list.php';</script>";
	exit;
}else{
	echo"<script language=javascript>alert('삭제에 실패했습니다. 관리자에게 문의바랍니다.');location.href='./sch_list.php';</script>";
	exit;
}

?>
