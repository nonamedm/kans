<?php
	include_once "./_common.php";
	include_once G5_MANAGE_PATH . "/share/include/admin.head.sub.php";
	include_once(G5_EDITOR_LIB);

if($idx){
	$row=sql_fetch("select * from schedule where idx='$idx'");
	if($row[idx]) $w="u";
	else alert_close("존재하지않는 일정입니다.");
}else{
$row[wr_5]="#ffffff";
}

$editor_html = editor_html('wr_content', $row[wr_content], 1);
$editor_js = '';
$editor_js .= get_editor_js('wr_content', 1);
//$editor_js .= chk_editor_js('wr_content', 1);

?>
<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/themes/base/jquery-ui.css" rel="stylesheet" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
<script type="text/javascript">
	jQuery(function($){
		$.datepicker.regional['ko'] = {
			closeText: '닫기',
			prevText: '이전달',
			nextText: '다음달',
			currentText: '오늘',
			monthNames: ['1월(JAN)','2월(FEB)','3월(MAR)','4월(APR)','5월(MAY)','6월(JUN)',
			'7월(JUL)','8월(AUG)','9월(SEP)','10월(OCT)','11월(NOV)','12월(DEC)'],
			monthNamesShort: ['1월','2월','3월','4월','5월','6월',
			'7월','8월','9월','10월','11월','12월'],
			dayNames: ['일','월','화','수','목','금','토'],
			dayNamesShort: ['일','월','화','수','목','금','토'],
			dayNamesMin: ['일','월','화','수','목','금','토'],
			weekHeader: 'Wk',
			dateFormat: 'yymmdd',
			firstDay: 0,
			isRTL: false,
			showMonthAfterYear: true,
			yearSuffix: ''};
		$.datepicker.setDefaults($.datepicker.regional['ko']);
		$('.date_pic').datepicker({
			buttonText: "달력",
			changeMonth: true,
				dateFormat: 'yy-mm-dd',
			changeYear: true,
			showButtonPanel: true,
			yearRange: 'c-30:c+30',
			maxDate: '+10y'
		});
	});
</script>
<style>
.h3_label22 { margin:0 0 10px; padding:10px 0 10px 22px; font-size:15px; color:#000; font-weight:700; background:url('./share/images/h3_bg.png') no-repeat left 50%;}
</style>
					<h3 class="h3_label22">월별행사안내</h2>

    <form name="fwrite" id="fwrite" action="./s5_1_update.php" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
	<input type='hidden' name='w' value='<?=$w?>' />
	<input type='hidden' name='idx' value='<?=$idx?>' />
	<input type='hidden' name='checkday'  id='checkday' value='' />
	
<table class="horizen">
	<colgroup>
		<col width="20%">
		<col width="*">
	</colgroup>
	<tbody >
		<tr>
			<th>제목</th>
			<td class="left"><input type='text'  required name='wr_subject' value="<?=$row[wr_subject]?>" class="w100"/></td>
		</tr>
<!--		
		<tr>
			<th>이메일</th>
			<td class="left"><input type='text' name='wr_4' value="<?=$row[wr_4]?>" class="w20" /></td>
		</tr>

		<tr>
			<th>연락처</th>
			<td class="left"><input type='text' name='wr_4' value="<?=$row[wr_4]?>" class="w20" /></td>
		</tr>
-->
		<tr>
			<th>날짜</th>
			<td class="left"><input type='text'  readonly class='date_pic' required name='wr_1' value="<?=$row[wr_1]?>" />  <input type='hidden' class='date_pic' name='wr_2' value="<?=$row[wr_2]?>" /></td>
		</tr>
		<!--	
		<tr>
			<th>예약시간</th>
			<td class="left">
						<select id="wr_3" name="wr_3">
							<option value="">선택하세요</option>
							<option value="10:00~10:30">10:00~10:30</option>
							<option value="11:00~11:30">11:00~11:30</option>
							<option value="12:00~12:30">12:00~12:30</option>
							<option value="14:00~14:30">14:00~14:30</option>
							<option value="15:00~15:30">15:00~15:30</option>
							<option value="16:00~16:30">16:00~16:30</option>
							<option value="17:00~17:30">17:00~17:30</option>
							<option value="18:00">18:00</option>
						</select>
						<script>$("#wr_3 option[value='<?=$row[wr_3]?>']").prop("selected", "true");</script>
						</td>
		</tr>
		-->
		<tr>
			<th>색상</th>
			<td class="left"><input type='color' name='wr_5' value="<?=$row[wr_5]?>" /></td>
		</tr>
		<!--
		<tr>
			<th>특이사항</th>
			<td class="left"><?=$editor_html?></textarea>
			</td>
		</tr>
		-->
	</tbody>
</table>

<div class="btn_area">
<?if($idx){?>
	<div class="btn_area_left">
		<a href="#n" onclick="delete_form(<?=$idx?>)" class="btn_normal">삭제</a>
	</div>
<?}?>
	<div class="btn_area_right">
		<input type="submit" value="완료" class="btn_normal">
		<a href="#n" onclick="window.close()" class="btn_normal">취소</a>
	</div>
</div>
<form>


<script>

	function delete_form(idx){
		if(confirm("정말로 삭제하시겠습니까?")){
		var f=document.fwrite;
		f.w.value="d"
		f.submit();
		}
	}

    function fwrite_submit(f)
    {
		
		f.wr_2.value=f.wr_1.value

		if(f.wr_1.value>f.wr_2.value){
			alert("일정을 다시 확인해주세요.");
			f.wr_2.focus();
			return false;
		}

		var idx=f.idx.value;
		var wr_1=f.wr_1.value;
		var wr_2=f.wr_2.value;
		$.ajax({
		type: 'POST',
		url: '<?=G5_URL ?>/admin/s5_1_ajax.php',
		data: {idx: idx,wr_1:wr_1, wr_2:wr_2},
		cache: false,
		async: false,
		success: function(result) { 
				$("#checkday").val(result);
			}
		});
	if(f.checkday.value=='1'){
	alert("선택한 날짜엔 다른일정이 존재합니다.");
	return false;

	}
        <?//php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
        return true;
	}
  </script>




<?include_once G5_MANAGE_INCLUDE_PATH . "/admin.tail.sub.php";?>