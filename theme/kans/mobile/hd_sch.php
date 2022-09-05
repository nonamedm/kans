<div class="hd_search">
	<div class="hd_sch_cnt">
		<form name="fsearchbox" action="<?php echo G5_BBS_URL ?>/search.php" onsubmit="return fsearchbox_submit(this);" method="get">
			<input type="hidden" name="sfl" value="wr_subject||wr_content||wr_1||wr_2||wr_3||wr_4||wr_6||wr_7||wr_8||wr_9||wr_10||wr_11||wr_12||wr_13||wr_14||wr_15||search_keyword">
			<input type="hidden" name="sop" value="and">
			<input type="text" name="stx" id="sch_stx" placeholder="검색어를 입력하세요." required="" size="15" class="required frm_input">
			<input type="submit" value="" class="btn_submit">
		</form>
	</div>
</div>