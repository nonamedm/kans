<?php
	include_once "./_common.php";
	/**
	 *	해당페이지 타이틀 및 기본 노출 설정
	 */
	$g5['title'] = "환경설정 > 인피아드 관리자모드";	//title
	$category_title = "환경설정";	//카테고리 제목
	$sub_title = "검색엔진 설정";	//서브 타이틀
	//$sub_explan = "홈페이지에 사용되는 메뉴명 및 노출여부를 설정할 수 있습니다."; //페이지 설명

	include_once G5_MANAGE_INCLUDE_PATH . "/admin_header.php";

	if( !isset($g5['new_win_table']) ){
		die('<meta charset="utf-8">/data/dbconfig.php 파일에 <strong>$g5[\'new_win_table\'] = G5_TABLE_PREFIX.\'new_win\';</strong> 를 추가해 주세요.');
	}
	//내용(컨텐츠)정보 테이블이 있는지 검사한다.
	if(!sql_query(" DESCRIBE {$g5['new_win_table']} ", false)) {
		if(sql_query(" DESCRIBE {$g5['g5_shop_new_win_table']} ", false)) {
			sql_query(" ALTER TABLE {$g5['g5_shop_new_win_table']} RENAME TO `{$g5['new_win_table']}` ;", false);
		} else {
		   $query_cp = sql_query(" CREATE TABLE IF NOT EXISTS `{$g5['new_win_table']}` (
						  `nw_id` int(11) NOT NULL AUTO_INCREMENT,
						  `nw_device` varchar(10) NOT NULL DEFAULT 'both',
						  `nw_begin_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
						  `nw_end_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
						  `nw_disable_hours` int(11) NOT NULL DEFAULT '0',
						  `nw_left` int(11) NOT NULL DEFAULT '0',
						  `nw_top` int(11) NOT NULL DEFAULT '0',
						  `nw_height` int(11) NOT NULL DEFAULT '0',
						  `nw_width` int(11) NOT NULL DEFAULT '0',
						  `nw_subject` text NOT NULL,
						  `nw_content` text NOT NULL,
						  `nw_content_html` tinyint(4) NOT NULL DEFAULT '0',
						  PRIMARY KEY (`nw_id`)
						) ENGINE=MyISAM DEFAULT CHARSET=utf8 ", true);
		}
	}

	//관리자 링크 추가
	if(!sql_query(" select nw_date_time from {$g5['new_win_table']} limit 1 ", false)) {

		$sql = " ALTER TABLE `{$g5['new_win_table']}`  ADD `nw_date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' AFTER `nw_end_time` ";
		sql_query($sql, false);
	}


		$table_name = "site_config";

	$site_config = "select * from $table_name where sc_no = 1";
	$site_result = sql_query($site_config);
	$site_row = sql_fetch_array($site_result);

?>
<form name="admin_info" method="post" action=<?=$PHP_SELF?> enctype="multipart/form-data">
	<input type="hidden" name="mode" value="update" />

	<div class="table_outline">
		<table class="vertical">
			<col width="200" />
			<col width="70" />
			<col width="" />
			<tbody>
				<tr>
					<th scope="row" class="left">사이트 제목(Title)</th>
					<td class="center"><a href="./share/tip/tip_title.php" target="iframe_area" class="btn_small2" onclick="layerpopup('사이트 제목','600','250','left top+5','left bottom','btn_small2');">TIP</a></td>
					<td class="left">
						<input type="text" id="" name="sc_title" placeholder="사이트 제목을 입력하세요" value="<?=$site_row[sc_title]?>" class="w100" />
					</td>
				</tr>
				<tr>
					<th scope="row" class="left">네이버 본인소유권 인증</th>
					<td class="center"><a href="./share/tip/tip_naver.php" target="iframe_area" class="btn_small2" onclick="layerpopup('네이버 본인소유권 인증','600','250','left top+5','left bottom','btn_small2');">TIP</a></td>
					<td class="left">
						<input type="text" name="sc_author" itemname="Author" size="30" maxlength="" placeholder="네이버 본인소유권 인증번호를 입력하세요" value="<?=$site_row[sc_author]?>" class="w100"/>
					</td>
				</tr>
				<tr>
					<th scope="row" class="left">대표 URL</th>
					<td class="center"><a href="./share/tip/tip_url.php" target="iframe_area" class="btn_small2" onclick="layerpopup('대표 URL','600','250','left top+5','left bottom','btn_small2');">TIP</a></td>
					<td class="left">
						<input type="text" name="sc_copyright" itemname="Copyright" size="30" maxlength="" placeholder="대표URL을 입력하세요" value="<?=$site_row[sc_copyright]?>" class="w100" />
					</td>
				</tr>
				<tr>
					<th scope="row" class="left">페이지 설명(Description)</th>
					<td class="center"><a href="./share/tip/tip_description.php" target="iframe_area" class="btn_small2" onclick="layerpopup('페이지 설명','600','250','left top+5','left bottom','btn_small2');">TIP</a></td>
					<td class="left">
						<input type="text" id="" name="sc_description" placeholder="최대 40자 이내로 입력하세요" value="<?=$site_row[sc_description]?>" class="w100" />
					</td>
				</tr>
				<tr>
					<th scope="row" class="left">페이지 키워드(Keyword)</th>
					<td class="center"><a href="./share/tip/tip_keyword.php" target="iframe_area" class="btn_small2" onclick="layerpopup('페이지 키워드','600','250','left top+5','left bottom','btn_small2');">TIP</a></td>
					<td class="left">
						<input type="text" id="" name="sc_keyword" placeholder="" value="<?=$site_row[sc_keyword]?>" class="w100" />
					</td>
				</tr>
			</tbody>
		</table>
	</div>

	<div class="btn_area">
		<div class="btn_area_right">
			<input type="submit" value="확인" class="btn_normal" />
		</div>
	</div>
	<div class="layer_popup"><iframe src="" name="iframe_area"></iframe></div>
</form>

<?
	if($mode){
		sql_query("update $table_name set sc_title = '$_POST[sc_title]', sc_keyword = '$_POST[sc_keyword]', sc_description = '$_POST[sc_description]', sc_author = '$_POST[sc_author]', sc_subject = '$_POST[sc_subject]', sc_copyright = '$_POST[sc_copyright]', sc_clanguage = '$_POST[sc_clanguage]' where sc_no = 1");
		alert("검색엔진 최적화 설정이 변경되었습니다.","$PHP_SELF");
	}
?>
<script>
	function layerpopup(names,width,height,align_my,align_at,target_class){
		var names = names;
		var w = width;
		var h = height;
		var target_class = target_class;
		var align_my = align_my;
		var align_at = align_at;
		$(".layer_popup").dialog({
			resizable : true,
			dialogClass : false,
			modal : false,
			width : w,
			height : h,
			title : names,
			position : {
				my : ""+align_my+"",
				at : ""+align_at+"",
				of : "."+target_class+""
			},
			open : function(event, ui){
				$(".ui-widget-header").css({
					color :"#ffffff",
					background : "#c4420f"
				});
			},
			beforeClose : function(event,ui){
				$(".ui-widget-header").css({
					color : "#333333",
					background : "#e9e9e9"
				});
			}
		});
	}
</script>
<?php include_once G5_MANAGE_INCLUDE_PATH . "/admin_footer.php";?>