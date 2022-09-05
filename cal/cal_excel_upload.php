<?php
include_once "./_common.php";
include_once(G5_EDITOR_LIB);

// 업로드 시
if($w == 'u'){
	ini_set('memory_limit','-1');

	$file = $_FILES['excelfile']['tmp_name'];

	include_once(G5_LIB_PATH.'/Excel/reader.php');
	
	$data = new Spreadsheet_Excel_Reader();
	$data->setOutputEncoding('UTF-8');
	$data->read($file);

	error_reporting(E_ALL ^ E_NOTICE);
	
	// 결과 리턴용 배열
	$result_data = Array();
	
	// 직장교육 2차 카테고리용
	$s2_2_ca_arr = Array();
	if($type == 's2_2'){
		$ca_sql = " SELECT * FROM ".$g5['category']." WHERE LENGTH(ca_id)=4 AND ca_id LIKE '10%' ORDER BY turn ASC, ca_id ASC ";
		$ca_result = sql_query($ca_sql);
		while($row = sql_fetch_array($ca_result)){
			$s2_2_ca_arr[$row['ca_name']] = $row['ca_id'];
		}
	}

	$cnt = 0;
	
	for ($i = 3; $i <= $data->sheets[0]['numRows']; $i++) {
		$j = 2;

		// 보수교육
		if($type == 's2'){
			$val_1 = addslashes($data->sheets[0]['cells'][$i][$j++]); // ID
			$val_2 = addslashes($data->sheets[0]['cells'][$i][$j++]); // 이름
			$val_3 = addslashes($data->sheets[0]['cells'][$i][$j++]); // 주민번호
			$val_4 = addslashes($data->sheets[0]['cells'][$i][$j++]); // 핸드폰번호
			$val_5 = addslashes($data->sheets[0]['cells'][$i][$j++]); // 이메일
			$val_6 = addslashes($data->sheets[0]['cells'][$i][$j++]); // 면허
			$val_7 = addslashes($data->sheets[0]['cells'][$i][$j++]); // 면허번호
			$val_8 = addslashes($data->sheets[0]['cells'][$i][$j++]); // 방사선사면허번호

			// 필수 항목 체크
			if(empty($val_1) || empty($val_2) || empty($val_3) || empty($val_4) || empty($val_5)){ continue; }

			$result_data['mb_id'][] = $val_1;			 // ID
			$result_data['wr_3'][] = $val_2;			 // 이름
			$result_data['wr_4'][] = $val_3;			 // 주민번호
			$result_data['wr_5'][] = $val_4;			 // 핸드폰번호
			$result_data['wr_6'][] = $val_5;			 // 이메일
			$result_data['wr_8'][] = $val_6;			 // 면허
			$result_data['wr_9'][] = $val_7;			 // 면허번호
			$result_data['wr_7'][] = $val_8;			 // 방사선사면허번호
		}
		
		// 직장교육
		if($type == 's2_2'){
			$val_1 = addslashes($data->sheets[0]['cells'][$i][$j++]); // ID
			$val_2 = addslashes($data->sheets[0]['cells'][$i][$j++]); // 이름
			$val_3 = addslashes($data->sheets[0]['cells'][$i][$j++]); // 주민번호
			$val_4 = addslashes($data->sheets[0]['cells'][$i][$j++]); // 핸드폰번호
			$val_5 = addslashes($data->sheets[0]['cells'][$i][$j++]); // 이메일
			$val_6 = addslashes($data->sheets[0]['cells'][$i][$j++]); // 방사선사면허번호
			
			// 필수 항목 체크
			if(empty($val_1) || empty($val_2) || empty($val_3) || empty($val_4) || empty($val_5)){ continue; }

			$result_data['mb_id'][] = $val_1;				 // ID
			$result_data['wr_3'][] = $val_2;				 // 이름
			$result_data['wr_4'][] = $val_3;				 // 주민번호
			$result_data['wr_5'][] = $val_4;				 // 핸드폰번호
			$result_data['wr_6'][] = $val_5;				 // 이메일
			$result_data['wr_7'][] = $val_6;				 // 방사선사면허번호
		}

		// 전문교육
		if($type == 's2_3'){
			$val_1 = addslashes($data->sheets[0]['cells'][$i][$j++]); // ID
			$val_2 = addslashes($data->sheets[0]['cells'][$i][$j++]); // 교육구분
			$val_3 = addslashes($data->sheets[0]['cells'][$i][$j++]); // 이름
			$val_4 = addslashes($data->sheets[0]['cells'][$i][$j++]); // 주민번호
			$val_5 = addslashes($data->sheets[0]['cells'][$i][$j++]); // 소속
			$val_6 = addslashes($data->sheets[0]['cells'][$i][$j++]); // 핸드폰번호
			$val_7 = addslashes($data->sheets[0]['cells'][$i][$j++]); // 이메일
			
			// 필수 항목 체크
			if(empty($val_1) || empty($val_2) || empty($val_3) || empty($val_4) || empty($val_6)){ continue; }

			$result_data['mb_id'][] = $val_1;				 // ID
			$result_data['wr_7'][] = $val_2;				 // 교육구분
			$result_data['wr_3'][] = $val_3;				 // 이름
			$result_data['wr_4'][] = $val_4;				 // 주민번호
			$result_data['wr_11'][] = $val_5;				 // 소속
			$result_data['wr_5'][] = $val_6;				 // 핸드폰번호
			$result_data['wr_6'][] = $val_7;				 // 이메일
		}

		$cnt++;
	}

	?>
	<script src="<?php echo G5_JS_URL ?>/jquery-1.11.1.js"></script>
	<form name="flayer_write" id="flayer_write" method="post" enctype="multipart/form-data" autocomplete="off">
		<input type="hidden" name="type" value="<?php echo $type; ?>" />
		
		<?php for($i = 0; $i < $cnt; $i++){
			if($type == 's2'){ // 보수교육 ?>
				<input type="hidden" name="mb_id[]" value="<?php echo $result_data['mb_id'][$i]; ?>" />
				<input type="hidden" name="wr_3[]" value="<?php echo $result_data['wr_3'][$i]; ?>" />
				<input type="hidden" name="wr_4[]" value="<?php echo $result_data['wr_4'][$i]; ?>" />
				<input type="hidden" name="wr_5[]" value="<?php echo $result_data['wr_5'][$i]; ?>" />
				<input type="hidden" name="wr_6[]" value="<?php echo $result_data['wr_6'][$i]; ?>" />
				<input type="hidden" name="wr_7[]" value="<?php echo $result_data['wr_7'][$i]; ?>" />
				<input type="hidden" name="wr_8[]" value="<?php echo $result_data['wr_8'][$i]; ?>" />
				<input type="hidden" name="wr_9[]" value="<?php echo $result_data['wr_9'][$i]; ?>" />
			<?php } else if($type == 's2_2'){ // 직장교육 ?>
				<input type="hidden" name="mb_id[]" value="<?php echo $result_data['mb_id'][$i]; ?>" />
				<input type="hidden" name="wr_3[]" value="<?php echo $result_data['wr_3'][$i]; ?>" />
				<input type="hidden" name="wr_4[]" value="<?php echo $result_data['wr_4'][$i]; ?>" />
				<input type="hidden" name="wr_5[]" value="<?php echo $result_data['wr_5'][$i]; ?>" />
				<input type="hidden" name="wr_6[]" value="<?php echo $result_data['wr_6'][$i]; ?>" />
				<input type="hidden" name="wr_7[]" value="<?php echo $result_data['wr_7'][$i]; ?>" />
			<?php } else if($type == 's2_3'){ // 전문교육 ?>
				<input type="hidden" name="mb_id[]" value="<?php echo $result_data['mb_id'][$i]; ?>" />
				<input type="hidden" name="wr_3[]" value="<?php echo $result_data['wr_3'][$i]; ?>" />
				<input type="hidden" name="wr_4[]" value="<?php echo $result_data['wr_4'][$i]; ?>" />
				<input type="hidden" name="wr_5[]" value="<?php echo $result_data['wr_5'][$i]; ?>" />
				<input type="hidden" name="wr_6[]" value="<?php echo $result_data['wr_6'][$i]; ?>" />
				<input type="hidden" name="wr_7[]" value="<?php echo $result_data['wr_7'][$i]; ?>" />
				<input type="hidden" name="wr_11[]" value="<?php echo $result_data['wr_11'][$i]; ?>" />
			<?php } ?>
		<?php } ?>
		
	</form>

	<script type="text/javascript">
	$( document ).ready(function() {

		var type = document.flayer_write.type.value;

		if(type == 's2'){ // 보수 교육
			// 결과용 배열
			const result_arr = Array(8).fill(null).map(() => Array());
			
			var mb_id_ = $("input[name^='mb_id']");
			var wr_3_ = $("input[name^='wr_3']");
			var wr_4_ = $("input[name^='wr_4']");
			var wr_5_ = $("input[name^='wr_5']");
			var wr_6_ = $("input[name^='wr_6']");
			var wr_7_ = $("input[name^='wr_7']");
			var wr_8_ = $("input[name^='wr_8']");
			var wr_9_ = $("input[name^='wr_9']");

			for(var i = 0; i < mb_id_.length; i++){
				result_arr[0].push(mb_id_[i].value);
				result_arr[1].push(wr_3_[i].value);
				result_arr[2].push(wr_4_[i].value);
				result_arr[3].push(wr_5_[i].value);
				result_arr[4].push(wr_6_[i].value);
				result_arr[5].push(wr_7_[i].value);
				result_arr[6].push(wr_8_[i].value);
				result_arr[7].push(wr_9_[i].value);
			}
			
			// 로딩창 불러오기
			$('.spinner_wrap').fadeIn();
			
			// 부모창에 엑셀데이터 전달
			self.parent.get_excel(result_arr);
		
			// 로딩창 끄기
			$('.spinner_wrap').delay(500).fadeOut();
		}

		else if(type == 's2_2'){ // 직장교육
			// 결과용 배열
			// var result_arr = new Array();
			const result_arr = Array(6).fill(null).map(() => Array());
			
			var mb_id_ = $("input[name^='mb_id']");
			var wr_3_ = $("input[name^='wr_3']");
			var wr_4_ = $("input[name^='wr_4']");
			var wr_5_ = $("input[name^='wr_5']");
			var wr_6_ = $("input[name^='wr_6']");
			var wr_7_ = $("input[name^='wr_7']");

			for(var i = 0; i < mb_id_.length; i++){
				result_arr[0].push(mb_id_[i].value);
				result_arr[1].push(wr_3_[i].value);
				result_arr[2].push(wr_4_[i].value);
				result_arr[3].push(wr_5_[i].value);
				result_arr[4].push(wr_6_[i].value);
				result_arr[5].push(wr_7_[i].value);
			}
			
			// 로딩창 불러오기
			$('.spinner_wrap').fadeIn();
			
			// 부모창에 엑셀데이터 전달
			self.parent.get_excel(result_arr);
		
			// 로딩창 끄기
			$('.spinner_wrap').delay(500).fadeOut();
		}

		else if(type == 's2_3'){ // 전문교육
			// 결과용 배열
			// var result_arr = new Array();
			const result_arr = Array(7).fill(null).map(() => Array());
			
			var mb_id_ = $("input[name^='mb_id']");
			var wr_3_ = $("input[name^='wr_3']");
			var wr_4_ = $("input[name^='wr_4']");
			var wr_5_ = $("input[name^='wr_5']");
			var wr_6_ = $("input[name^='wr_6']");
			var wr_7_ = $("input[name^='wr_7']");
			var wr_11_ = $("input[name^='wr_11']");

			for(var i = 0; i < mb_id_.length; i++){
				result_arr[0].push(mb_id_[i].value);
				result_arr[1].push(wr_3_[i].value);
				result_arr[2].push(wr_4_[i].value);
				result_arr[3].push(wr_5_[i].value);
				result_arr[4].push(wr_6_[i].value);
				result_arr[5].push(wr_7_[i].value);
				result_arr[6].push(wr_11_[i].value);
			}
			
			// 로딩창 불러오기
			$('.spinner_wrap').fadeIn();
			
			// 부모창에 엑셀데이터 전달
			self.parent.get_excel(result_arr);
		
			// 로딩창 끄기
			$('.spinner_wrap').delay(500).fadeOut();
		}


		
	});
	</script>

<!-- 로딩창 관련 -->

<style>
.spinner_wrap{position: fixed; top: 0;	left: 0; width: 100%; height: 100%; z-index: 100000; background: #012b50; overflow: hidden; }
.spinner {margin:  auto; margin-top: calc(55vh - 50px); width: 40px;height: 40px; position: relative; }
.cube1, .cube2 {background-color: #fff;width: 15px;height: 15px;position: absolute;top: 0;left: 0;-webkit-animation: sk-cubemove 1.8s infinite ease-in-out;animation: sk-cubemove 1.8s infinite ease-in-out;}
.cube2 {-webkit-animation-delay: -0.9s;animation-delay: -0.9s;}

@-webkit-keyframes sk-cubemove {
  25% { -webkit-transform: translateX(42px) rotate(-90deg) scale(0.5) }
  50% { -webkit-transform: translateX(42px) translateY(42px) rotate(-180deg) }
  75% { -webkit-transform: translateX(0px) translateY(42px) rotate(-270deg) scale(0.5) }
  100% { -webkit-transform: rotate(-360deg) }
}

@keyframes sk-cubemove {
  25% { 
    transform: translateX(42px) rotate(-90deg) scale(0.5);
    -webkit-transform: translateX(42px) rotate(-90deg) scale(0.5);
  } 50% { 
    transform: translateX(42px) translateY(42px) rotate(-179deg);
    -webkit-transform: translateX(42px) translateY(42px) rotate(-179deg);
  } 50.1% { 
    transform: translateX(42px) translateY(42px) rotate(-180deg);
    -webkit-transform: translateX(42px) translateY(42px) rotate(-180deg);
  } 75% { 
    transform: translateX(0px) translateY(42px) rotate(-270deg) scale(0.5);
    -webkit-transform: translateX(0px) translateY(42px) rotate(-270deg) scale(0.5);
  } 100% { 
    transform: rotate(-360deg);
    -webkit-transform: rotate(-360deg);
  }
}
</style>

<!-- 로딩 나타나는 창 -->
<div class="spinner_wrap">
	<div class="spinner">
		<div class="cube1"></div>
		<div class="cube2"></div>
	</div>
</div>

<script>
</script>
<?php } else{ ?>
<style>
	body { font-size: 0.75em; }

	.local_desc01 {margin:0 20px 10px;padding:10px 20px 0;min-width:920px;border:1px solid #f2f2f2;background:#f9f9f9}
	.local_desc01 strong {color:#ff3061}
	.local_desc01 a {text-decoration:underline; color:#000;}

	p {margin:0;padding:0 0 10px;line-height:1.7em;word-break:break-all}

	.vertical { width:100%; border-collapse:collapse; border-spacing:0; }
	.vertical th, .vertical td { padding:8px 10px; border:1px solid #ddd; }
	.vertical th { background:#f4f4f4; border-left:0; }
	.vertical td { text-align:left; border-right:0; }
	.vertical th:nth-child(3) { border-left:1px solid #ddd; }

	.vertical input[type=text] { height:22px; text-indent:5px; border:1px solid #ddd; }
	.vertical input[type=text].disable { background:#eee; }
	.vertical input[type=password] { height:22px; text-indent:5px; border:1px solid #ddd; }
	.vertical select { height:24px; border:1px solid #ddd; }
	.vertical textarea { width:100%; height:auto; min-height:150px; padding:4px; border:1px solid #ddd; resize:none; box-sizing:border-box; }
	.vertical input[type=file] { height:auto; margin:0; padding:0; }

	.btn_normal[type=submit] {
		display:inline-block; height:32px; line-height:28px; margin:0 1px; padding-left:15px; padding-right:15px; font-size:13px; color:#666; font-weight:bold; text-align:center; vertical-align:middle; cursor:pointer;
		box-sizing:border-box; -moz-box-sizing:border-box; -webkit-box-sizing:border-box; text-decoration:none;
		border:1px solid #c4c4c4; border-radius:3px; -moz-border-radius:3px; -webkit-border-radius:3px;
		background: #fff; /* Old browsers */
		background: -moz-linear-gradient(top,  #ffffff 0%, #fdfdfd 28%, #e7e7e7 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ffffff), color-stop(28%,#fdfdfd), color-stop(100%,#e7e7e7)); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top,  #ffffff 0%,#fdfdfd 28%,#e7e7e7 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top,  #ffffff 0%,#fdfdfd 28%,#e7e7e7 100%); /* Opera 11.10+ */
		background: -ms-linear-gradient(top,  #ffffff 0%,#fdfdfd 28%,#e7e7e7 100%); /* IE10+ */
		background: linear-gradient(to bottom,  #ffffff 0%,#fdfdfd 28%,#e7e7e7 100%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#e7e7e7',GradientType=0 ); /* IE6-9 */
	}
	
	.btn_area {
		position: relative;
		display: table;
		width: 100%;
		height: 40px;
		margin: 0;
		padding: 0;
		overflow: hidden;
	}

	.btn_area .btn_area_right {
		display: table-cell;
		width: 25%;
		height: 100%;
		text-align: right;
		vertical-align: middle;
		overflow: hidden;
	}
</style>

<div class="local_desc01 local_desc" style="min-width: 600px;">
      <p>
		엑셀파일을 이용하여 일괄등록할 수 있습니다.<br>
		형식은 <strong>일괄등록용 엑셀파일</strong>을 다운로드하여 입력하시면 됩니다.<br>
		수정 완료 후 엑셀파일을 업로드하시면 게시글이 일괄등록됩니다.<br>
		엑셀파일을 저장하실 때는 <strong>Excel 97 - 2003 통합문서 (*.xls)</strong> 로 저장하셔야 합니다.
	</p>

	<p>
		<b><a href="<?php echo G5_URL; ?>/cal/<?php echo $type?>/sample.xls">[일괄등록용 엑셀파일 다운로드]</a></b>
	</p>
</div>

<form name="flayer_write" id="flayer_write" action="<?php echo $PHP_SELF; ?>" onsubmit="return flayer_write_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
	
	<input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>" />
	<input type="hidden" name="w" value="u" />
	<input type="hidden" name="type" value="<?php echo $type; ?>" />
	
	<table class="vertical">
		<colgroup>				
		<col width="15%" />
		<col width="*" />
	</colgroup>
	<thead>
		<tr>					
			<td scope="col">
				<input type="file" name="excelfile" class="frm_input" required>
			</td>
		</tr>
	</thead>
	</table>

	<div class="btn_area mt10">
		<div class="btn_area_right">
			<input type="submit" class="btn_normal" value="확인">
		</div>
	</div>
</form>
<script>
function flayer_write_submit(f){
	// f.action = "./excel_upload.php";
	return true;
}
</script>
<?php } ?>