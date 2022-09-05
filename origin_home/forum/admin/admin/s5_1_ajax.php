<?include("./_common.php");
if($idx)
$allready=sql_fetch("select idx from schedule where 1 and ((wr_1 between '$wr_1' and '$wr_2' ) or (wr_2 between '$wr_1' and '$wr_2')) and idx<>'$idx' ");
else
$allready=sql_fetch("select idx from schedule where 1 and ((wr_1 between '$wr_1' and '$wr_2' ) or (wr_2 between '$wr_1' and '$wr_2')) ");

if($allready[idx]) echo "1";
?>