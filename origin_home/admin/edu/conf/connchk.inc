<?
if(!$cid){
	echo"<meta http-equiv=\"Refresh\" content=\"0 ; URL='../../index.php'\">";
	exit;
}

if($_head_php_excuted) return;
if(eregi(":\/\/",$dir)) $dir=".";

?>