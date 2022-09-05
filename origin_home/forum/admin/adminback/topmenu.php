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
<link rel="stylesheet" href="css/style.css" type="text/css">
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
					<td id="lecture" style="padding-left:10" style="border:1 solid #EFEFEF" onmouseover="mouseOnTD(this);" onmouseout="javascript:defaultStatus();" onClick="ClickOnTD(this,'./calendar/list.php');">
				 	<img src="img/sams_bullet_01.gif" align="absmiddle" width="5" height="5">&nbsp;행사일정</td></tr>
				<tr height="22"> 
					<td id="lecture" style="padding-left:10" style="border:1 solid #EFEFEF" onmouseover="mouseOnTD(this);" onmouseout="javascript:defaultStatus();" onClick="ClickOnTD(this,'./forum/list.php');">
				 	<img src="img/sams_bullet_01.gif" align="absmiddle" width="5" height="5">&nbsp;포럼실적</td></tr>
				<!--
				<tr height="22"> 
					<td id="lecture" style="padding-left:10" style="border:1 solid #EFEFEF" onmouseover="mouseOnTD(this);" onmouseout="javascript:defaultStatus();" onClick="ClickOnTD(this,'./photo/list.php');">
				 	<img src="img/sams_bullet_01.gif" align="absmiddle" width="5" height="5">&nbsp;갤러리</td></tr>
				-->
			</table>
		</td>
		</tr>	
	</table>
</BODY>
</HTML>
