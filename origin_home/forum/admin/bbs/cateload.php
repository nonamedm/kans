<?php include_once("./_common.php");
$leng = $su * 2;
$leng2 = $leng + 2;

$bo_table = $_REQUEST['bo_table'];
?>
<option value="">선택하세요.</option>
	<?php
	$cateq = sql_query(" SELECT * FROM ".$g5['category']." WHERE bo_table = '".$bo_table."' AND SUBSTR(ca_id, 1, ".$leng.") = '".$val."' AND LENGTH(ca_id) = '".$leng2."' ORDER BY turn ASC, ca_id ASC ");
	while($row = sql_fetch_array($cateq)){?>
	<option value="<?php echo $row['ca_id']; ?>"><?php echo $row['ca_name']; ?></option>
<?php } ?>