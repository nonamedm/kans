<?
	include_once('./_common.php');
	include_once(G5_THEME_PATH.'/head.sub.php');
?>

<div class="d_map">
				<!-- * 카카오맵 - 지도퍼가기 -->
				<!-- 1. 지도 노드 -->
				<div id="daumRoughmapContainer1551165243241" class="root_daum_roughmap root_daum_roughmap_landing"></div>

				<!--
					2. 설치 스크립트
					* 지도 퍼가기 서비스를 2개 이상 넣을 경우, 설치 스크립트는 하나만 삽입합니다.
				-->
				<script charset="UTF-8" class="daum_roughmap_loader_script" src="https://ssl.daumcdn.net/dmaps/map_js_init/roughmapLoader.js"></script>

				<!-- 3. 실행 스크립트 -->
				<script charset="UTF-8">
					new daum.roughmap.Lander({
						"timestamp" : "1551165243241",
						"key" : "se3e",
						"mapWidth" : "1100",
						"mapHeight" : "442"
					}).render();
				</script>
</div>

<script>
setTimeout(function(){ 
	window.print();
},2000);
</script>