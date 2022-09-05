<?
//if(!$cid){
//	echo"<meta http-equiv=\"Refresh\" content=\"0 ; URL='../index.php'\">";
//	exit;
//}

if($_head_php_excuted) return;
if(eregi(":\/\/",$dir)) $dir=".";

if($mid == ''){
?>
<script language=javascript>
	alert('로그인해주세요.');
	document.location.href="./edu04.html";
</script>
<?
	exit;
}

?>
