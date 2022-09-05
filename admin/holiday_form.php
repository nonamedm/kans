<?php
	include_once "./_common.php";
	include_once G5_MANAGE_PATH . "/share/include/admin.head.sub.php";
if($idx){
	$row=sql_fetch("select * from schedule_holiday where idx='$idx'");
	if($row[idx]) $w="u";
	else alert_close("존재하지않는 일정입니다.");
}else if($day){
$row[start_date]=$row[end_date]=$day;
}
?>

<style>
.h3_label22 { margin:0 0 10px; padding:10px 0 10px 22px; font-size:15px; color:#000; font-weight:700; background:url('./share/images/h3_bg.png') no-repeat left 50%;}
</style>

    <form name="fwrite" id="fwrite" action="./holiday_update.php" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
	<input type='hidden' name='w' value='<?=$w?>' />
	<input type='hidden' name='idx' value='<?=$idx?>' />
	<input type='hidden' name='checkday'  id='checkday' value='1' />
	
<table class="horizen">
	<colgroup>
		<col width="20%">
		<col width="*">
	</colgroup>
	<tbody >
		<tr>
			<th>시작일 / 종료일</th>
			<td class="left"><input type='text'  readonly class='date_pic' name='start_date' value="<?=$row[start_date]?>" /> ~ <input type='text'  readonly class='date_pic' name='end_date' value="<?=$row[end_date]?>" /></td>
		</tr>
		<!-- 
		<tr>
			<th>공휴일옵션</th>
			<td class="left">
			<input type="checkbox" id="opt" name="opt" value="1" <?=$row[opt]?"checked":"" ?>><label for="opt">공휴일 옵션(체크시 주말과 같은 기능을 합니다)</label>
			</td>
		</tr>
		 -->
		<tr>
			<th>시간</th>
			<td class="left">
				<select name="time1" id="time1">
					<?
					for($i=1; $i<=17; $i++){
						$time=time_print($i);
						echo "<option value='{$i}'>{$time}</option>";
					}
					?>
				</select>
				~
				<select name="time2"  id="time2">
					<?
					for($i=1; $i<=17; $i++){
						$time=time_print($i);
						echo "<option value='{$i}'>{$time}</option>";
					}
					?>
				</select>
				
				
				<script>
					$("#time1 option[value='<?=$row[time1]?>']").prop("selected", "true");
					$("#time2 option[value='<?=$row[time2]?>']").prop("selected", "true");
				</script>
			</td>
		</tr>
		<tr>
			<th>메모</th>
			<td class="left"><input type='text'  name='title' value="<?=$row[title]?>" class="w70"/></td>
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
		<input type="submit" value="<?=$w?"수정":"등록" ?>" class="btn_normal">
		<a href="#n" onclick="parent.$('.layer_popup').dialog('close');" class="btn_normal">닫기</a>
	</div>
</div>
</form>

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
        /*
		if(f.title.value==""){
			alert("내용을 입력하여 주십시오.");
			f.title.focus();
			return false;
		}
		*/
		if(f.start_date.value==""){
			alert("일정을 입력하여 주십시오.");
			f.start_date.focus();
			return false;
		}
		if(f.end_date.value==""){
			alert("일정을 입력하여 주십시오.");
			f.end_date.focus();
			return false;
		}
		if(f.start_date.value>f.end_date.value){
			alert("날짜범위를 다시 확인해주세요.");
			f.end_date.focus();
			return false;
		}

		if(parseInt(f.time1.value)>parseInt(f.time2.value)){
			alert("시간범위를 다시 확인해주세요.");
			f.time1.focus();
			return false;
		}
		
        return true;
	}
  </script>
<?include_once G5_MANAGE_INCLUDE_PATH . "/admin.tail.sub.php";?>