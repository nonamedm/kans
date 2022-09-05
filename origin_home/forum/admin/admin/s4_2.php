<?php
	include_once "./_common.php";
	$category_title = "공간신청관리";	//카테고리 제목
	$sub_title = "공간신청관리";	//서브 타이틀
	$sub_explan = ""; //페이지 설명
	include_once G5_MANAGE_INCLUDE_PATH . "/admin_header.php";

	$row=sql_fetch("select * from schedule_submit2 where idx='$id'");
	if(!$row[idx]) alert("잘못된접근");
?>
<table class="horizen">
	<colgroup>
		<col width="15%">
		<col width="35%">
		<col width="15%">
		<col width="35%">
	</colgroup>
		<tr>
			<th scope="col">예약일시</th>
			<td class="left" colspan="3"><?=$row[day]?></td>
		</tr>
		
		<tr>
			<th scope="col">이름</th>
			<td class="left" class="left" colspan=""><?=$row[wr_3]?></td>
			<th scope="col">생년월일</th>
			<td class="left" colspan=""><?=$row[wr_4]?></td>
		</tr>
		<tr>
			<th scope="col">이메일</th>
			<td class="left" colspan=""><?=$row[wr_5]?></td>
			<th scope="col">전화번호</th>
			<td class="left" colspan=""><?=$row[wr_6]?></td>
		</tr>
		
		<tr>
			<th scope="col">예약공간</th>
			<td class="left" colspan="3"><?=$row[wr_subject]?></td>
		</tr>
		
		<tr>
			<th scope="col">소속</th>
			<td class="left" colspan=""><?=$row[wr_1]?></td>
			<th scope="col">참석인원</th>
			<td class="left" colspan=""><?=number_format($row[wr_2])?>명</td>
		</tr>
		<tr>
			<th scope="col">사용목적</th>
			<td class="left" colspan=""><?=$row[wr_7]?><?=$row[wr_8]?"<br>$row[wr_8]":""?></td>
			<th scope="col">첨부파일</th>
			<td class="left" colspan=""><?if($row[fileroot]){?><a href="./filedown.php?id=<?=$row[idx]?>"><img src="/skin/admin_board/basic/img/icon_file.gif"> <?=$row[filename]?></a><?php }?></td>
		</tr>
		
		<tr>
			<th scope="col">처리상태</th>
			<td class="left" colspan="3">
				<select id="select_<?=$row[idx]?>" onchange="list_change('schedule_submit2','wr_10',this.value,'<?=$row[idx]?>','<?=$row[wr_10]?>');">
					<option value="승인대기">승인대기</option>
					<option value="승인">승인</option>
					<option value="대여완료">대여완료</option>
				</select>
				<script type="text/javascript">
				$("#select_<?=$row[idx]?> option[value='<?=$row[wr_10]?>']").prop("selected", "true");
				</script>
				</td>
		</tr>
</table>
    <div class="btn_area mt20">
		<div class="btn_area_right">
			<a href="./s4.php" class="btn_normal">목록</a>
		</div>
    </div>
<form>

<script type="text/javascript">
		function list_change(table,fild,val,idx,cancel_val){
			if(val=="승인"){
				if(confirm("승인시 메일이 발송됩니다.\n\n상태변경을 진행하시겠습니까?")){
				}else{
					$("#select_"+idx).val(cancel_val);
					 return false;
				}
			}
			$.post("<? echo G5_URL ?>/admin/change_ajax.php", {table:table,fild:fild,val:val,idx:idx}, function(rst){ 
				});

		}
</script>

<?php
include_once G5_MANAGE_INCLUDE_PATH . "/admin_footer.php";
?>