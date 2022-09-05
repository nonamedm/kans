<?php
// 담당자이거나 본인이 신청한 신청서일 경우
if($write['mb_id'] == $member['mb_id'] || $write['wr_14'] == $member['mb_id']){ set_session('ss_view_'.$bo_table.'_'.$wr_id, true); }
?>