<?
include_once "./_common.php";
$category_title = "페이지관리";	//카테고리 제목
include_once G5_MANAGE_INCLUDE_PATH . "/admin_header.php";
if(!$cate) $cate=1;

switch($cate){
	case 1: $pname= "센터소개";break;

	default: alert("지정되지 않은 페이지 입니다.");
}
?>
<script type="text/javascript" src="../js/jquery.form.min.js"></script>
<style>
::-webkit-input-placeholder {
   color: #BDBDBD;
}
</style>

<h4 class="h4_label"><?=$pname?></h4>
<form id='all_update' name='all_update'  method='post'>
<input type="hidden" name="w" value="all_update">
		<table class="vertical" id="page_table">
			<caption>목록</caption>
			<colgroup>				
				<col width="*" />
				<col width="15%" />
				<col width="12%" />
				<col width="12%" />
			</colgroup>
			<thead>
				<tr>					
					<th scope="col">메뉴명</th>
					<th scope="col">
					<? if ($member['mb_level']==10){ ?>
					<a href='#n' onclick="insert('')" class='btn_small2'>생성</a>
					<? }else{ ?>
					관리
					<? } ?>
					</td></th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
		
</form>
<br>
	<div align="right">
		<a href="#n" onclick="all_update_submit();" class="btn_normal">항목저장</a>
	</div>
<script type="text/javascript">
			var cate="<?=$cate ?>"
			$(function(){
			$("#all_update").ajaxForm({
			url: "./page_ajax.php",
			success: function(rst){
				console.log(rst);
				alert("저장 하였습니다.");
				list_reload();
			}
			});
				list_reload();
			});


			function list_reload(){
				var wr_id = '<?php echo $wr_id; ?>';
				var bodylist = $("#page_table tbody");
				$.post("./page_loadlist.php", {
					cate : cate
				}, function(rst){
					bodylist.html(rst);
				});
					
			}
			
			function all_update_submit(){
					f=$("#all_update");
					f.submit();
			}

			function insert(idx){
				var w="insert";
					$.post("./page_ajax.php", {w:w, idx:idx, cate:cate}, function(rst){
						console.log(rst);
					list_reload();
				});
			}

			function delete_(idx){
			var w='d';
				if(confirm("삭제하면 복구할수 없습니다.")){
					$.post("./page_ajax.php", {w:w, idx:idx, cate:cate}, function(rst){
						if(rst) alert(rst);
					list_reload();
				});
				}
			}

			function turn(idx,type){
			var w="turn";
					$.post("./page_ajax.php", {w:w, idx:idx, type:type, cate:cate}, function(rst){
						console.log(rst);
					list_reload();
				});
			}
</script>

<?php
include_once G5_MANAGE_INCLUDE_PATH . "/admin_footer.php";
?>

<!-- 게시글 보기 끝 -->