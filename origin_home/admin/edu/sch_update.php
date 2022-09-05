<? 
if(!$cid){
	echo"<meta http-equiv=\"Refresh\" content=\"0 ; URL='../index.php'\">";
	exit;
}
include  "../dbconn.inc"; 

if($_head_php_excuted) return;
if(!eregi($HTTP_HOST,$HTTP_REFERER)) Error("정상적으로 접근하여 주시기 바랍니다.");
if(eregi(":\/\/",$dir)) $dir=".";

if($pds1 != ''){

	$savedir='../../edu/pds/';
	if(strcmp($pds1,'none'))	{

		$full_filename=explode('.',$pds1_name);
		$extension=$full_filename[sizeof($full_filename)-1];

		if(!($extension == 'hwp' || $extension == 'doc' || $extension == 'gif' || $extension == 'jpg' || $extension == 'ppt' || $extension == 'pdf' || $extension == 'mp3' || $extension == 'wmv')){
			echo"<script language=javascript>alert('[hwp,ppt,pdf,doc,gif,jpg,txt,mp3,wmv] 파일만 올릴수 있습니다');history.back();</script>";
			exit;
		}

		$exist=file_exists("$savedir/$pds1_name");
		if($exist){
			echo"<script language=javascript>alert(\"자료1의 파일이 같은 파일이 존재합니다. 다른이름으로 올려주세요!\");history.back();</script>";
			exit;
		}
		if(!copy($pds1,"$savedir/$pds1_name")){
			echo"<script language=javascript>alert('파일업로드에 실패했습니다! 서버장애이니 나중에 올려주세요!');history.back();</script>";
			exit;
		}
	}
	/** 이전 파일 삭제 **/
	$sql="select pds1 from edu_schedule where id=$id";
	$res=mysql_query($sql);
	$row=mysql_fetch_object($res);
	if($row->pds1 !=''){	
		$src='../../edu/pds/'.$row->pds1;
		if(!unlink($src))	{
		}
	}

	$query = "update edu_schedule set pds1='".$pds1_name."', pds_name1='".MD5($pds1_name)."'" ;
	$query = $query." where id=".$id;

}elseif($pds2 != ''){
	
	$savedir='../../edu/pds/';
	if(strcmp($pds2,'none'))	{

		$full_filename=explode('.',$pds2_name);
		$extension=$full_filename[sizeof($full_filename)-1];

		if(!($extension == 'hwp' || $extension == 'doc' || $extension == 'gif' || $extension == 'jpg' || $extension == 'ppt' || $extension == 'pdf' || $extension == 'mp3' || $extension == 'wmv')){
			echo"<script language=javascript>alert('[hwp,ppt,pdf,doc,gif,jpg,txt,mp3,wmv] 파일만 올릴수 있습니다');history.back();</script>";
			exit;
		}

		$exist=file_exists("$savedir/$pds2_name");
		if($exist){
			echo"<script language=javascript>alert(\"자료2의 파일이 같은 파일이 존재합니다. 다른이름으로 올려주세요!\");history.back();</script>";
			exit;
		}
		if(!copy($pds2,"$savedir/$pds2_name")){
			echo"<script language=javascript>alert('파일업로드에 실패했습니다! 서버장애이니 나중에 올려주세요!');history.back();</script>";
			exit;
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

	$query = "update edu_schedule set pds2='".$pds2_name."', pds_name2='".MD5($pds2_name)."'" ;
	$query = $query." where id=".$id;

}elseif($pds3 != ''){

	$savedir='../../edu/pds/';
	if(strcmp($pds3,'none'))	{

		$full_filename=explode('.',$pds3_name);
		$extension=$full_filename[sizeof($full_filename)-1];

		if(!($extension == 'hwp' || $extension == 'doc' || $extension == 'gif' || $extension == 'jpg' || $extension == 'ppt' || $extension == 'pdf' || $extension == 'mp3' || $extension == 'wmv')){
			echo"<script language=javascript>alert('[hwp,ppt,pdf,doc,gif,jpg,txt,mp3,wmv] 파일만 올릴수 있습니다');history.back();</script>";
			exit;
		}

		$exist=file_exists("$savedir/$pds3_name");
		if($exist){
			echo"<script language=javascript>alert(\"자료3의 파일이 같은 파일이 존재합니다. 다른이름으로 올려주세요!\");history.back();</script>";
			exit;
		}
		if(!copy($pds3,"$savedir/$pds3_name")){
			echo"<script language=javascript>alert('파일업로드에 실패했습니다! 서버장애이니 나중에 올려주세요!');history.back();</script>";
			exit;
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

	$query = "update edu_schedule set pds3='".$pds3_name."', pds_name3='".MD5($pds3_name)."'" ;
	$query = $query." where id=".$id;

}elseif($pds4 != ''){

	$savedir='../../edu/pds/';
	if(strcmp($pds4,'none'))	{

		$full_filename=explode('.',$pds4_name);
		$extension=$full_filename[sizeof($full_filename)-1];

		if(!($extension == 'hwp' || $extension == 'doc' || $extension == 'gif' || $extension == 'jpg' || $extension == 'ppt' || $extension == 'pdf' || $extension == 'mp3' || $extension == 'wmv')){
			echo"<script language=javascript>alert('[hwp,ppt,pdf,doc,gif,jpg,txt,mp3,wmv] 파일만 올릴수 있습니다');history.back();</script>";
			exit;
		}

		$exist=file_exists("$savedir/$pds4_name");
		if($exist){
			echo"<script language=javascript>alert(\"자료4의 파일이 같은 파일이 존재합니다. 다른이름으로 올려주세요!\");history.back();</script>";
			exit;
		}
		if(!copy($pds4,"$savedir/$pds4_name")){
			echo"<script language=javascript>alert('파일업로드에 실패했습니다! 서버장애이니 나중에 올려주세요!');history.back();</script>";
			exit;
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

	$query = "update edu_schedule set pds4='".$pds4_name."', pds_name4='".MD5($pds4_name)."'" ;
	$query = $query." where id=".$id;

}elseif($pds5 != ''){

	$savedir='../../edu/pds/';
	if(strcmp($pds5,'none'))	{

		$full_filename=explode('.',$pds5_name);
		$extension=$full_filename[sizeof($full_filename)-1];

		if(!($extension == 'hwp' || $extension == 'doc' || $extension == 'gif' || $extension == 'jpg' || $extension == 'ppt' || $extension == 'pdf' || $extension == 'mp3' || $extension == 'wmv')){
			echo"<script language=javascript>alert('[hwp,ppt,pdf,doc,gif,jpg,txt,mp3,wmv] 파일만 올릴수 있습니다');history.back();</script>";
			exit;
		}

		$exist=file_exists("$savedir/$pds5_name");
		if($exist){
			echo"<script language=javascript>alert(\"자료5의 파일이 같은 파일이 존재합니다. 다른이름으로 올려주세요!\");history.back();</script>";
			exit;
		}
		if(!copy($pds5,"$savedir/$pds5_name")){
			echo"<script language=javascript>alert('파일업로드에 실패했습니다! 서버장애이니 나중에 올려주세요!');history.back();</script>";
			exit;
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

	$query = "update edu_schedule set pds5='".$pds5_name."', pds_name5='".MD5($pds5_name)."'" ;
	$query = $query." where id=".$id;


}elseif($pds6 != ''){

	$savedir='../../edu/pds/';
	if(strcmp($pds6,'none'))	{

		$full_filename=explode('.',$pds6_name);
		$extension=$full_filename[sizeof($full_filename)-1];

		if(!($extension == 'hwp' || $extension == 'doc' || $extension == 'gif' || $extension == 'jpg' || $extension == 'ppt' || $extension == 'pdf' || $extension == 'mp3' || $extension == 'wmv')){
			echo"<script language=javascript>alert('[hwp,ppt,pdf,doc,gif,jpg,txt,mp3,wmv] 파일만 올릴수 있습니다');history.back();</script>";
			exit;
		}

		$exist=file_exists("$savedir/$pds6_name");
		if($exist){
			echo"<script language=javascript>alert(\"자료6의 파일이 같은 파일이 존재합니다. 다른이름으로 올려주세요!\");history.back();</script>";
			exit;
		}
		if(!copy($pds6,"$savedir/$pds6_name")){
			echo"<script language=javascript>alert('파일업로드에 실패했습니다! 서버장애이니 나중에 올려주세요!');history.back();</script>";
			exit;
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

	$query = "update edu_schedule set pds6='".$pds6_name."', pds_name6='".MD5($pds6_name)."'" ;
	$query = $query." where id=".$id;
	

}else{

	$title=trim($title);
	$year=trim($year);
	$month=trim($month);
	$day=trim($day);
	
	
	if($edu_state == '2'){
		$sql="select id, edu_state, schedule, s_point from edu_member where schedule = $id";
		$ress=mysql_query($sql);
		$total=mysql_affected_rows();
		
		
		
		if($total>0){

				for($i=1; $i<$total+1; $i++){
	    			$rows = mysql_fetch_object($ress);
					
					$sql="select s_point from edu_schedule where id = $id";
					$resss=mysql_query($sql);
					$rowss = mysql_fetch_object($resss);

						if(($rows->s_point) > ($rowss->s_point)-1){
							$query1 = "update edu_member set edu_state = 6 where id =" .$rows->id;
							$res=mysql_query($query1); 
						}else{
							$query1 = "update edu_member set edu_state = 5 where id =" .$rows->id;
							$res=mysql_query($query1);
						}
				}
			}
	}		
	elseif($edu_state == '0' || $edu_state == '1'){
		$sql="select id, edu_state, schedule, s_point from edu_member where schedule = $id";
		$ress=mysql_query($sql);
		$total=mysql_affected_rows();
		
		if($total>0){

				for($i=1; $i<$total+1; $i++){
	    			$rows = mysql_fetch_object($ress);
					
					$sql="select s_point from edu_schedule where id = $id";
					$resss=mysql_query($sql);
					$rowss = mysql_fetch_object($resss);
			
						$query1 = "update edu_member set edu_state = 5 where id =" .$rows->id;
						if(($rows->s_point) > ($rowss->s_point)-1){
							$res=mysql_query($query1); 
						}

				}
			}
	
	}
	
	
	

	$query = "update edu_schedule set edu_state='".$edu_state."', edu_type='".$edu_type."', s_point='".$s_point."', year='".$year."', month='".$month."', day='".$day."', day2='".$day2."', si='".$si."', bun='".$bun."', title='".$title."', pds_chk1='".$pds_chk1."', d01='".$d01."', si1='".$si1."', bun1='".$bun1."', pds_chk2='".$pds_chk2."', d02='".$d02."', si2='".$si2."', bun2='".$bun2."', pds_chk3='".$pds_chk3."', d03='".$d03."', si3='".$si3."', bun3='".$bun3."', pds_chk4='".$pds_chk4."', d04='".$d04."', si4='".$si4."', bun4='".$bun4."', pds_chk5='".$pds_chk5."', d05='".$d05."', si5='".$si5."', bun5='".$bun5."', pds_chk6='".$pds_chk6."', d06='".$d06."', si6='".$si6."', bun6='".$bun6."', audio1='".$audio1."', audio2='".$audio2."', audio3='".$audio3."', audio4='".$audio4."', audio5='".$audio5."', audio6='".$audio6."'";
	$query = $query." where id=".$id;
}

if(mysql_query($query)){
	echo"<script language=javascript>alert('수정되었습니다');location.href='./sch_view.php?id=".$id."&page=".$page."&search=".$search."&keyword=".$keyword."';</script>";
	exit;
}else{
	echo"<script language=javascript>alert('수정에 실패했습니다. 관리자에게 문의바랍니다.');location.href='./sch_list.php';</script>";
	exit;
}

?>