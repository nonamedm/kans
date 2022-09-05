<?php include_once(G5_THEME_MOBILE_PATH.'/head.php');?>
<div class="record_box">
	<div class="div_table">
		<div class="div_tr">
			<div class="div_th"><span class="space">번호</span></div>
			<div class="div_th">
				<ul class="rowspan">
					<li><span class="space">발주청</span></li>
					<li><span class="space">원 도급자</span></li>
				</ul>
			</div>
			<div class="div_th"><span class="space">공사명</span></div>
			<div class="div_th"><span class="space">공종명</span></div>
			<div class="div_th"><span class="space">공사기간</span></div>
		</div>
		<?
			$no = $_GET[no];

			#where 문을 만드는 과정입니다.
			
			// 일단 어떠한 상황에서든무조건 sql_where를 돌리기위해 추가해준다
			$sql_where ="";

			$link_sca =urlencode($sca); // 이것은 페이징 작업용이다 urlencode 처리된 것 을 그대로 가지고 이동하기 위해서
			$sca = urldecode($sca); // url을 decode화처리하여 Ex에서도 정상적으로 반응하기위해서 처리

			if($sca && $search){ // 검색과 분류가 모두 존재한경우
				$sql_where .= "where ".$search_type." like '%".$search."%' and ca_name='{$sca}' ";
			}else if($sca){ // 분류값을 받고있는 경우
				$sql_where .= "where ca_name='{$sca}' ";
			}else if($search){ //검색의 경우
				$sql_where .= "where ".$search_type." like '%".$search."%' ";				
			}


			#한페이지당 보여질 갯수
			$page_size = 10;
			#리스트에 보여질 갯수
			$list_size = 5;
			#보드의 넘버가 없거나 0보다 작은경우즉없을경우 no초기
			if (!$no || $no < 0) $no =0;

			#갯수검색(10개씩끊어검색됩니다
			$tb ="g5_write_".$bo_table;//테이블명

			$query_board ="select * from $tb $sql_where order by wr_8 asc limit $no,$page_size";
			$result_board = sql_query($query_board);//이것은 row로사용

			####################
			#수를 카운팅 작업
			####################
			$count = sql_query("select count(*) from $tb $sql_where"); //총 갯수 계산
			$result_row = mysqli_fetch_row($count);
			$total_row=$result_row[0];

			//페이지계산(즉, 10개씩몇개있는지 끊기위한작업 아래도마찬가지)
			if($total_row <= 0) $total_row=0;
			$total_page = ceil($total_row/$page_size);

			//현제페이지계산
			$current_page = ceil(($no+1)/$page_size);

			// 페이지별 번호를 계산하는 공식
			if($no){
				$listnumber = $no+1;
			}else{
				$listnumber = 1;
			}//$listnumber = $total_row - $no;

			while($row=mysqli_fetch_array($result_board)){// 반복의 시작	 
		?>
		<div class="div_tr">
			<div class="div_td"><span class="space"><?=$listnumber?></span></div>
			<div class="div_td">
				<ul class="rowspan">
					<li><span class="space"><?=$row[wr_6]?></span></li>
					<li><span class="space"><?=$row[wr_7]?></span></li>
				</ul>
			</div>
			<div class="div_td"><span class="space"><?=nl2br($row[wr_subject])?></span></div>
			<div class="div_td"><span class="space"><?=nl2br($row[wr_content])?></span></div>
			<div class="div_td"><span class="space"><?=str_replace("-",".",$row[wr_8])?> ~ <?=str_replace("-",".",$row[wr_9])?></span></div>
		</div>
		<?
				$listnumber++; // 게시글의 번호를 강제로 순서에 맞게 처리하는 과정
			}
			if(!$total_row){
		?>
			<!-- 게시물이 없는경우 발생 합니다 -->
			<span class="nodata">게시물이 없습니다.</span>
		<?
			}
		?>
		<div id="admin_paging">
		<? 
			#######################
			#갯수를 구현하는 페이지
			#######################

			#시작페이지
			$start_page=floor(($current_page - 1) / $list_size) * $list_size + 1;
			#마지막 페이지
			$end_page=$start_page + $list_size - 1;
			if($total_page < $end_page) $end_page = $total_page;
				###################
				#이전구현 (이미지화)
				###################
				if($start_page >= $list_size){
					$prev_list = ($start_page-2) * $page_size;
					echo "<a href=\"$PHP_SELF?bo_table=$bo_table&no=$prev_list&sca=$link_sca&search_type=$search_type&search=$search\">";			
					?>
					이전
					<?
					echo"</a>";
					}

				###################
				#    페이지번호구현
				###################
				for ($i = $start_page; $i <= $end_page ; $i++){
					$page = ($i-1) * $page_size;
					if($no!=$page){
						echo "<a href=\"$PHP_SELF?bo_table=$bo_table&no=$page&sca=$link_sca&search_type=$search_type&search=$search\">";
					}
					?>
					<? if($no == $page){ ?>
						<strong class="current">
					<? } ?>
					<?=$i?>
					<? if($no == $page){ ?>
						</strong>
					<? } ?>
					<?
					if($no!=$page){
						echo"</a>";
					}
				}

				###################
				#다음구현 (이미지화)
				###################
				if($total_page > $end_page){
					$next_list = $end_page * $page_size;
					echo "<a href=\"$PHP_SELF?bo_table=$bo_table&no=$next_list&sca=$link_sca&search_type=$search_type&search=$search\">";
					?>
					다음
					<?
					echo"</a>";
				}
		?>
		</div>
		<div id="search_div">
			<form action="" method="get">
				<input type="hidden" name="bo_table" value="<?=$bo_table?>">
				<input type="hidden" name="sca" value="<?=$sca?>">
				<select name="search_type" style="padding:5px; background:#fff; border:1px #ddd solid; ">
					<option value="wr_6">발주청</option>
					<option value="wr_7">원 도급자</option>
					<option value="wr_subject">공사명</option>
				</select>
				<input type="text" name="search" class="search_inputbx">
				<input type="submit" style="padding:5px; background:#efefef; border:1px #ddd solid;" value="검색">
			</form>
		</div>
	</div>
</div>

<style>
	.search_inputbx{
		width:150px;
		padding:5px;
		background:#fff;
		border:1px #ddd solid;
	}
	.search_inputbx:hover, .search_inputbx:focus {
		background:#efefef;
		border:1px #333 solid;
	}
	/** 강제로 잡은 부분입니다 검색바 부분 **/
	#search_div, #admin_paging{
		width:840px;
		text-align:center;
		margin:10px 0px;
	}
	@media (max-width: 1024px){
		#search_div, #admin_paging{
			width:700px;
			text-align:center;
			margin:10px 0px;
		}
	}

	@media (max-width: 450px){
		#search_div, #admin_paging{
			width:100%;
			text-align:center;
			margin:10px 0px;
		}
	}
</style>