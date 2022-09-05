<?php
// if(empty($wr_1)){ alert("올바른 접근이 아닙니다.", "/cal/cal_list.php"); exit; }

$bo_table = "s1_2_2_1";

// 교육 관련 정보
$prd_write_table = $g5['write_prefix'] . substr($bo_table, 0, -2);
$pro_info = sql_fetch(" SELECT * FROM ".$prd_write_table." WHERE wr_id = '".$wr_1."' ");
?>
<div class="layer_popup" id="request_layer"></div>
<script>
function iframe_resize(v){
	v.height = v.contentWindow.document.body.scrollHeight + 20;

	$("#layer_frame").css('height', v.height);
	$("#layer_frame").parent().css('height', v.height);
}

function layer_board(names,src){
	document.getElementById("request_layer").innerHTML="<iframe src="+src+"  id='layer_frame' onLoad='iframe_resize(this)'  frameborder=0 scrolling=yes></iframe>";
		var w=600;
		var h=100;
	$(".layer_popup").dialog({
		resizable : false,
		width : 700,
		height : 180,
		dialogClass : false,
		modal : false,
		title : names,
		position : {
		my : "center center",
		at : "center center",
			of : window
		},
		open: function(event,ui){
			
		},
		close: function(event,ui){
			document.getElementById("request_layer").innerHTML="";
			// location.reload();
		 }
	});
}

// 2차 분류값 가져오기
// bo_table: 가져오려는 분류, ca_id: 가져오려는 분류값, cur_id: 현재 선택한 분류 값
function get_category_option(bo_table, ca_id, cur_id){
	
	// 반환값
	var html = "";
	var selected = "";

	$.ajax({
		type: "POST",
		url: "./ajax.php",
		data: {"mode": "get_category_option", "bo_table": bo_table, "ca_id": ca_id },
		dataType: "json",
		async: false,
		success: function(data){
			// console.log( data );
			for(var i = 0; i < data.CNT; i++){
				selected = "";
				if(data.ca_id[i] == cur_id){ selected = "selected"; }
				html += "<option value=\"" + data.ca_id[i] + "\" " + selected + " >" + data.ca_name[i] + "</option>";
			}
		},
		error: function(xhr, status, error) {
			alert(error);
		}  
	});

	return html;

}

// 인풋체크
function fwrite_submit(f){
	if(f.bo_table.value == ''){
		alert("올바른 방법으로 이용해주세요.");
		document.location.href = "./cal_list.php";
		return false;
	}

	if(f.wr_1.value == ""){
		alert("올바른 방법으로 이용해주세요.");
		document.location.href = "./cal_list.php";
		return false;
	}
}
</script>

<!-- 프로그램 테이블 정보 -->
<input type="hidden" name="pro_table" id="pro_table" value="<?php echo substr($bo_table, 0, -2); ?>" />