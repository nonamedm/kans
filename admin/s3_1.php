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

$editor_html = editor_html('wr_content', $row[wr_content], 0);
$editor_js = '';
$editor_js .= get_editor_js('wr_content', 0);
$editor_js .= chk_editor_js('wr_content', 0);

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
					<h3 class="h3_label22">일정등록</h2>

    <form name="fwrite" id="fwrite" action="./s3_1_update.php" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
	<input type='hidden' name='w' value='<?=$w?>' />
	<input type='hidden' name='idx' value='<?=$idx?>' />
	<input type='hidden' name='checkday'  id='checkday' value='1' />
	
<table class="horizen">
	<colgroup>
		<col width="20%">
		<col width="*">
	</colgroup>
	<tbody >
		<!--
		<tr>
			<th>제목</th>
			<td class="left"><input type='text'  name='wr_subject' value="<?=$row[wr_subject]?>" class="w70"/></td>
		</tr>
		<tr>
			<th>연예인명</th>
			<td class="left"><input type='text' name='wr_3' value="<?=$row[wr_3]?>" class="w70"/></td>
		</tr>
		-->
		<tr>
			<th>일정</th>
			<td class="left"><input type='text'  readonly class='date_pic' name='wr_1' value="<?=$row[wr_1]?>" /> ~ <input type='text'  readonly class='date_pic' name='wr_2' value="<?=$row[wr_2]?>" /></td>
		</tr>
		<!--
		<tr>
			<th>출력색상</th>
			<td class="left"><input type='color' name='wr_5' value="<?=$row[wr_5]?>" /></td>
		</tr>-->
		<tr>
			<th>내용</th>
			<td class="left"><?=$editor_html?></textarea>
			</td>
		</tr>
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

		if(f.wr_content.value==""){
			alert("내용을 입력하여 주십시오.");
			f.wr_content.focus();
			return false;
		}
		if(f.wr_1.value==""){
			alert("일정을 입력하여 주십시오.");
			f.wr_1.focus();
			return false;
		}
		if(f.wr_2.value==""){
			alert("일정을 입력하여 주십시오.");
			f.wr_2.focus();
			return false;
		}
		if(f.wr_1.value>f.wr_2.value){
			alert("일정을 다시 확인해주세요.");
			f.wr_2.focus();
			return false;
		}
		/*
		var idx=f.idx.value;
		var wr_1=f.wr_1.value;
		var wr_2=f.wr_2.value;

		$.ajax({
		type: 'POST',
		url: '<?=G5_URL ?>/admin/s3_1_check_ajax.php',
		data: {idx: idx,wr_1:wr_1, wr_2:wr_2},
		cache: false,
		async: false,
		success: function(result) { 
				$("#checkday").val(result);
			}
		});
	if(f.checkday.value){
	alert("선택한 날짜엔 다른일정이 존재합니다.");
	return false;
	}
*/
        <?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>
        return true;
	}
  </script>




<?include_once G5_MANAGE_INCLUDE_PATH . "/admin.tail.sub.php";?>