<HTML>
<HEAD>
<TITLE>:::: Bulletin ::::</TITLE>
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
<script language="javascript">
function defaultStatus(){
	var lec = document.all.lecture;
	for (var i=0;i<lec.length;i++){
		document.all.lecture[i].style.border = "1 solid #EFEFEF";
		document.all.lecture[i].style.backgroundColor = "";
	}
}

function mouseOnTD(obj)
{
	obj.style.border = "1 solid gray";
	obj.style.backgroundColor = "white";
	obj.style.cursor = "hand";
}

function ClickOnTD(obj, page){
	obj.style.border = "1 solid gray";
	obj.style.backgroundColor = "white";
	obj.style.cursor = "hand";
	parent.admin_main.location.href= page;
}
</script>
<link rel="stylesheet" href="./style.css" type="text/css">
</HEAD>
<BODY topmargin="0" leftmargin="0">
	<table width="160" height="100%" cellpadding="0" cellspacing="0">
		<tr>
		<td valign="top" bgcolor="#EFEFEF"> 
			<table width="95%" align="center" cellpadding="0" border="0" cellspacing="0">
				<tr height="100"> 
					<td align="center" bgcolor="#5A9CD6"> 
					<b style="font-family:tahoma;color:white;font-size:11px">관리모드</b>
					<br><br><span align="right"><a href="./logout.php">로그아웃</a></span>
					</td></tr>
				<tr height="22"> 
					<td id="lecture" style="padding-left:10" style="border:1 solid #EFEFEF" onmouseover="mouseOnTD(this);" onmouseout="javascript:defaultStatus();" onClick="ClickOnTD(this,'./notice/list.php');">
				 	<img src="img/sams_bullet_01.gif" align="absmiddle" width="5" height="5">&nbsp;공지사항</td></tr>
				<tr height="22"> 
					<td id="lecture" style="padding-left:10" style="border: 1 solid #EFEFEF" onmouseover="mouseOnTD(this);" onmouseout="javascript:defaultStatus();" onClick="ClickOnTD(this,'./edu_days/list.php');">
				 	<img src="img/sams_bullet_01.gif" align="absmiddle" width="5" height="5">&nbsp;가까운교육일정</td></tr>
					
				<tr height="22"> 
					<td id="lecture" style="padding-left:10" style="border: 1 solid #EFEFEF" onmouseover="mouseOnTD(this);" onmouseout="javascript:defaultStatus();" onClick="ClickOnTD(this,'./story/list.php');">
				 	<img src="img/sams_bullet_01.gif" align="absmiddle" width="5" height="5">&nbsp;<!--방사선 이야기-->교육</td></tr>
				<tr height="22"> 
					<td id="lecture" style="padding-left:10" style="border: 1 solid #EFEFEF" onmouseover="mouseOnTD(this);" onmouseout="javascript:defaultStatus();" onClick="ClickOnTD(this,'./edu/sche/sche_list.php');">
				 	<img src="img/sams_bullet_01.gif" align="absmiddle" width="5" height="5">&nbsp;<!--방사선 이야기-->(구)온라인 교육</td></tr>
				<tr height="22"> 
					<td id="lecture" style="padding-left:10" style="border: 1 solid #EFEFEF" onmouseover="mouseOnTD(this);" onmouseout="javascript:defaultStatus();" onClick="ClickOnTD(this,'./dic/list.php');">
				 	<img src="img/sams_bullet_01.gif" align="absmiddle" width="5" height="5">&nbsp;<!--방사선 용어사전-->수납 </td></tr>
				<tr height="22"> 
					<td id="lecture" style="padding-left:10" style="border: 1 solid #EFEFEF" onmouseover="mouseOnTD(this);" onmouseout="javascript:defaultStatus();" onClick="ClickOnTD(this,'./faq/list.php');">
				 	<img src="img/sams_bullet_01.gif" align="absmiddle" width="5" height="5">&nbsp;<!--방사선 FAQ-->기타 </td></tr>
				<tr height="22"> 
					<td id="lecture" style="padding-left:10" style="border: 1 solid #EFEFEF" onmouseover="mouseOnTD(this);" onmouseout="javascript:defaultStatus();" onClick="ClickOnTD(this,'./photo/list.php');">
				 	<img src="img/sams_bullet_01.gif" align="absmiddle" width="5" height="5">&nbsp;사진 게시판 </td></tr>
				<tr height="22"> 
					<td id="lecture" style="padding-left:10" style="border: 1 solid #EFEFEF" onmouseover="mouseOnTD(this);" onmouseout="javascript:defaultStatus();" onClick="ClickOnTD(this,'./doc/list.php');">
				 	<img src="img/sams_bullet_01.gif" align="absmiddle" width="5" height="5">&nbsp;문서 자료실 </td></tr>
				<tr height="22"> 
					<td id="lecture" style="padding-left:10" style="border: 1 solid #EFEFEF" onmouseover="mouseOnTD(this);" onmouseout="javascript:defaultStatus();" onClick="ClickOnTD(this,'./sec/list.php');">
				 	<img src="img/sams_bullet_01.gif" align="absmiddle" width="5" height="5">&nbsp;온라인교육(보안)자료실 </td></tr>	
				<tr height="22"> 
					<td id="lecture" style="padding-left:10" style="border: 1 solid #EFEFEF" onmouseover="mouseOnTD(this);" onmouseout="javascript:defaultStatus();" onClick="ClickOnTD(this,'./link/list.php');">
				 	<img src="img/sams_bullet_01.gif" align="absmiddle" width="5" height="5">&nbsp;링크 자료실 </td></tr>
				<tr height="22"> 
					<td id="lecture" style="padding-left:10" style="border: 1 solid #EFEFEF" onmouseover="mouseOnTD(this);" onmouseout="javascript:defaultStatus();" onClick="ClickOnTD(this,'./recruit/list.php');">
				 	<img src="img/sams_bullet_01.gif" align="absmiddle" width="5" height="5">&nbsp;채용 게시판 </td></tr>
				<tr height="22"> 
					<td id="lecture" style="padding-left:10" style="border:1 solid #EFEFEF" onmouseover="mouseOnTD(this);" onmouseout="javascript:defaultStatus();" onClick="ClickOnTD(this,'./com_edu/list.php');">
				 	<img src="img/sams_bullet_01.gif" align="absmiddle" width="5" height="5">&nbsp;통신교육</td></tr>
				<tr height="22"> 
					<td id="lecture" style="padding-left:10" style="border:1 solid #EFEFEF" onmouseover="mouseOnTD(this);" onmouseout="javascript:defaultStatus();" onClick="ClickOnTD(this,'./edu_calendar/list.php');">
				 	<img src="img/sams_bullet_01.gif" align="absmiddle" width="5" height="5">&nbsp;교육일정(달력)</td></tr>
				<tr height="22"> 
					<td align="center">&nbsp;</td>
				</tr>
			</table>
		</td>
		</tr>	
	</table>
</BODY>
</HTML>
