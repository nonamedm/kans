<?
	include_once("./_common.php");
header( "Content-type: application/vnd.ms-excel" );   
header( "Content-type: application/vnd.ms-excel; charset=utf-8");  
header( "Content-Disposition: attachment; filename = excellist.xls" );   
header( "Content-Description: PHP4 Generated Data" );   
  
if($stx){
	$sql_search.=" and $sfl like '%{$stx}%' ";
}

$result = sql_query("select * from $table where 1 $sql_search order by idx desc");  
echo "<meta content=\"application/vnd.ms-excel; charset=UTF-8\" name=\"Content-type\"> ";  
?>  

<?php if($table=="schedule_submit"){?>
<table class="horizen">
	<colgroup>
		<col width="3%">
		<col width="8%">
		<col width="8%">
		<col width="8%">
		<col width="8%">
		<col width="8%">
		<col width="8%">
		<col width="8%">
		<col width="6%">
	</colgroup>
	<thead>
		<tr>
			<th scope="col">순번</th>
			<th scope="col">교육명</th>
			<th scope="col">이름</th>
			<th scope="col">생년월일</th>
			<th scope="col">이메일</th>
			<th scope="col">전화번호</th>
			<th scope="col">기수강과목</th>
			<th scope="col">교육정보 취득경로</th>
			<th scope="col">처리상태</th>

		</tr>
	</thead>
	<tbody>
		<?for ($i=0; $row=sql_fetch_array($result); $i++) {// 접근가능한 그룹수?>
		<tr>
			<td><?=$i+1?></td>
			<td><?=$row[wr_subject]?></td>
			<td><?=$row[wr_3]?></td>
			<td><?=$row[wr_4]?></td>
			<td><?=$row[wr_5]?></td>
			<td><?=$row[wr_6]?></td>
			<td><?=$row[wr_1]?></td>
			<td><?=$row[wr_2]?></td>
			<td><?=$row[wr_10]?></td>
		</tr>
		<?$cur_num--;}if($i==0) echo "<tr><td colspan=10>데이터가 없습니다.</td></tr>";?>				
	</tbody>
</table>
<?}else if($table=="schedule_submit2"){?>
	
<table class="horizen">
	<colgroup>
		<col width="3%">
		<col width="6%">
		<col width="6%">
		<col width="8%">
		<col width="8%">
		<col width="8%">
		<col width="12%">
		<col width="8%">
		<col width="5%">
		<col width="6%">
	</colgroup>
	<thead>
		<tr>
			<th scope="col">순번</th>
			<th scope="col">예약일시</th>
			<th scope="col">이름</th>
			<th scope="col">생년월일</th>
			<th scope="col">이메일</th>
			<th scope="col">전화번호</th>
			<th scope="col">예약공간</th>
			<th scope="col">사용목적</th>
			<th scope="col">인원</th>
			<th scope="col">처리상태</th>
		</tr>
	</thead>
	<tbody>
		<?for ($i=0; $row=sql_fetch_array($result); $i++) {// 접근가능한 그룹수?>
		<tr>
			<td><?=$i+1?></td>
			<td><?=substr($row[wr_datetime],0,10)?></td>
			<td><?=$row[wr_3]?></td>
			<td><?=$row[wr_4]?></td>
			<td><?=$row[wr_5]?></td>
			<td><?=$row[wr_6]?></td>
			<td><?=$row[wr_subject]?></td>
			<td><?=$row[wr_7]?><?=$row[wr_8]?"<br>$row[wr_8]":""?></td>
			<td><?=$row[wr_2]?></td>
			<td>
				<select id="select_<?=$row[idx]?>" onchange="list_change('schedule_submit2','wr_10',this.value,'<?=$row[idx]?>','<?=$row[wr_10]?>');">
					<option value="승인대기">승인대기</option>
					<option value="승인">승인</option>
				</select>
				<script type="text/javascript">
				$("#select_<?=$row[idx]?> option[value='<?=$row[wr_10]?>']").prop("selected", "true");
				</script>
			</td>
			
			
		</tr>
		<?$cur_num--;}if($i==0) echo "<tr><td colspan=11>데이터가 없습니다.</td></tr>";?>				
	</tbody>
</table>
<?php }?>