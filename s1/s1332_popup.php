<?
	include_once('./_common.php');
	include_once(G5_THEME_PATH.'/head.sub.php');
?>

<div class="s103_map">
	<div id="daumRoughmapContainer1613448715375" class="root_daum_roughmap root_daum_roughmap_landing"></div>
	<script charset="UTF-8" class="daum_roughmap_loader_script" src="https://ssl.daumcdn.net/dmaps/map_js_init/roughmapLoader.js"></script>
	<script charset="UTF-8">
		new daum.roughmap.Lander({
			"timestamp" : "1613448715375",
			"key" : "24fqo",
		}).render();
	</script>
</div>
<script>
setTimeout(function(){ 
	window.print();
},2000);
</script>

<style>
	#hd_login_msg{display: none;}
	body{width: 100%; min-width:0px}
</style>

