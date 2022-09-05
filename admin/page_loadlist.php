<?php
include_once("./_common.php");
$list = sql_query("SELECT * FROM page WHERE 1 and cate='$cate' order by turn1 desc,sub asc,turn2 desc");
//$cnt=$list->num_rows;

while($row=sql_fetch_array($list)){ $k++;
if(!$row[sub]) $sub=sql_fetch("select count(idx) as cnt from page where sub_idx='$row[idx]' and sub=1");
else $sub=false;

if($row[program]) $style="background-color: #FFF4FF;";
else if(!$row[sub]) $style="background-color: #F4FFFF;";
else $style=false;
?>
<input type='hidden' name='idx[]' value='<?=$row[idx]?>'>
<tr id='s2_<?=$row[idx]?>' style="<?=$style?>">
	
	<?if($row[program]){ ?>
	<td class='center'>
		<?=$row[title1]?>
		<input type='hidden'  name='title1[<?=$row[idx]?>]' value="<?=$row[title1]?>"> 
	</td>
	<?}else{ ?>
	<td class=''>
	<?if($row[sub]){ ?><img src='/admin/share/images/icon_catlevel.gif'><?} ?>
	<input type='text'  name='title1[<?=$row[idx]?>]' value="<?=$row[title1]?>" class='w20' placeholder="메뉴명"> 
	<?if($row[sub] || !$sub[cnt]){ ?><a href='#n' onclick="layer('','./page_content.php?idx=<?=$row[idx]?>&cate=<?=$row[cate]?>&type=1');" class='btn_small2'>내용</a><?} ?>
	</td>
	<?} ?>
	<!--td class='center'>
		<a href='#n' onclick="turn('<?=$row[idx]?>',1);" class='btn_small2'>▲</a> 
		<a href='#n' onclick="turn('<?=$row[idx]?>',2);" class='btn_small2'>▼</a>
	</td-->
	<td class='center'>
		<?if($row[sub] || !$sub[cnt]){ ?><a href='#n' onclick="layer('','./page_content.php?idx=<?=$row[idx]?>&cate=<?=$row[cate]?>&type=1');" class='btn_small2'>수정</a><?} ?> 
		<? if ($member['mb_level']==10){ ?>
			<?if($row[sub] || !$sub[cnt]){ ?><a href='#n' onclick="delete_(<?=$row[idx]?>);" class='btn_small2'>삭제</a><?} ?> 
			<a href="#n" onclick="insert('<?=$row[idx]?>');" class='btn_small2'>추가</a>
		<? } ?>
	</td-->
</tr>		
<?php $cnt--;}?>
<?php if(!$k){?>
<tr>
	<td class="center" colspan='4'>데이터가 없습니다.</td>
</tr>		
<?php }?>