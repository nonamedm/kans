<?php
	if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
	include_once(G5_LIB_PATH.'/thumbnail.lib.php');

	// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
	add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<div id="bo_v_table">
	<?php echo ($board['bo_mobile_subject'] ? $board['bo_mobile_subject'] : $board['bo_subject']); ?>
</div>

<article id="bo_v" style="width:<?php echo $width; ?>" class="respon_v">
	<section class="custom pc_table">
		<table>
			<tr>
				<td colspan="4"><strong><?php echo get_text($view['wr_subject']); ?></strong></td>
			</tr>
			<!--tr>
				<td colspan="4"><strong>프로그램 카테고리 이름입니다.</strong></td>
			</tr-->
			<tr>
				<th>연락처</th>
				<td><?php echo $view['wr_2']; ?></td>
				<th>사용인원</th>
				<td><?php echo $view['wr_3']; ?></td>
			</tr>
			<tr>
				<th>일시</th>
				<td colspan="3">
				<?php echo date("Y년 m월 d일", strtotime($view['wr_4'])) ?> <?php echo $view['wr_5']; ?>시 <?php echo $view['wr_6']; ?>분 ~ <?php echo date("Y년 m월 d일", strtotime($view['wr_7'])) ?> <?php echo $view['wr_8']; ?>시 <?php echo $view['wr_9']; ?>분</td>
			</tr>
			<tr>
				<th>사전교육신청</th>
				<td><?php echo $view['wr_10']; ?></td>
				<th>신청일</th>
				<td><?php echo date("Y-m-d", strtotime($view['wr_datetime'])) ?></td>
			</tr>
			
		</table>
	</section>
	<section class="custom mobile_table">
		<table>
			<tr>
				<td colspan="4"><strong>[<?php echo $view['ca_name']; ?>] [<?php echo $view['wr_10']; ?>-<?php echo $view['wr_11']; ?>] <?php echo get_text($view['wr_subject']); ?></strong></td>
			</tr>
			<!--tr>
				<td colspan="4"><strong>프로그램 카테고리 이름입니다.</strong></td>
			</tr-->
			<tr>
				<td colspan="4"><strong>작성일자 : <?php echo date("Y-m-d", strtotime($view['wr_datetime'])) ?></strong></td>
			</tr>
			<tr>
				<th>접수상태</th>
				<td colspan="3"><?php echo $view['wr_1']; ?></td>

			</tr>
			<tr>
				<th>대상</th>
				<td colspan="3"><?php echo $view['wr_2']; ?></td>
			</tr>
			<tr>
				<th>일시</th>
				<td colspan="3"><?php echo date("Y년 m월 d일", strtotime($view['wr_3'])) ?> <?php echo $view['wr_6']; ?>시 <?php echo $view['wr_7']; ?>분 ~ <?php echo $view['wr_8']; ?>시 <?php echo $view['wr_9']; ?>분</td>
			</tr>
			<tr>
				<th>장소</th>
				<td colspan="3"><?php echo $view['wr_4']; ?></td>
			</tr>
			<tr>
				<th>정원</th>
				<td colspan="3"><?php echo $view['wr_5']; ?>명</td>
			</tr>
		</table>
	</section>
	<section id="bo_v_atc">
		<h2 id="bo_v_atc_title">본문</h2>
		<?php
			// 파일 출력
			$v_img_count = count($view['file']);
			if($v_img_count) {
				echo "<div id=\"bo_v_img\">\n";
				for ($i=0; $i<=count($view['file']); $i++) {
					if ($view['file'][$i]['view']) {
						//echo $view['file'][$i]['view'];
						echo get_view_thumbnail($view['file'][$i]['view']);
					}
				}
				echo "</div>\n";
			}
		?>
		<div id="bo_v_con">
			<iframe id="wr_content" marginwidth="0" marginheight="0" width="100%"  scrolling="no" frameborder="0" src="<?=G5_URL?>/IPRAME_content.php?bo_table=<?=$bo_table?>&wr_id=<?=$wr_id?>">
				</iframe>
				<script> 
			$('iframe').load(function() {
		  this.style.height =
		  this.contentWindow.document.body.offsetHeight + 'px';
		});
		</script>
		</div>


	</section>
	<div id="bo_v_top" class="btm_btns clear">
		<?php if ($prev_href || $next_href) { ?>
			<!--div class="sort_l">
				<?php if ($prev_href) { ?><a href="<?php echo $prev_href ?>" class="btn_ty btn_ty02">이전글</a><?php } ?>
				<?php if ($next_href) { ?><a href="<?php echo $next_href ?>" class="btn_ty btn_ty02">다음글</a><?php } ?>
			</div-->
		<?php } ?>
		<div class="sort_r">
		<?php if ($search_href) { ?><a href="<?php echo $search_href?>" class="btn_ty">검색목록</a><?php } ?>
		<a href="<?php G5_URL ?>/studio/s5_2.php" class="btn_ty">목록</a>
		</div>
		<?php $link_buttons = ob_get_contents(); ?>
	</div>
</article>
<script type="text/javascript">
<!--
	function fwrite_submit_tail(f){
		if(f.wr_2.value === ''){
			alert("소속 대학을 입력해주세요");
			fwrite_view.wr_2.focus();
			return false;
		}

		if(f.wr_3.value === ''){
			alert("소속 학부를 입력해주세요");
			f.wr_3.focus();
			return false;
		}

		if(f.wr_4.value === ''){
			alert("연락처를 입력해주세요");
			f.wr_4.focus();
			return false;
		}

		if(f.wr_email.value === ''){
			alert("이메일을 입력해주세요");
			f.wr_email.focus();
			return false;
		}

		if(f.wr_5.value === ''){
			alert("직급 정보를 선택해주세요");
			f.wr_5.focus();
			return false;
		}

		if(f.wr_6.value === ''){
			alert("직급 정보를 선택해주세요");
			f.wr_6.focus();
			return false;
		}

		fwrite_view.submit();
	}
//-->
</script>
<!-- 게시글 보기 끝 -->
<script>
	<?php if ($board['bo_download_point'] < 0) { ?>
		$(function() {
			$("a.view_file_download").click(function() {
				if(!g5_is_member) {
					alert("다운로드 권한이 없습니다.\n회원이시라면 로그인 후 이용해 보십시오.");
					return false;
				}

				var msg = "파일을 다운로드 하시면 포인트가 차감(<?php echo number_format($board['bo_download_point']) ?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?";

				if(confirm(msg)) {
					var href = $(this).attr("href")+"&js=on";
					$(this).attr("href", href);

					return true;
				} else {
					return false;
				}
			});
		});
	<?php } ?>
	function board_move(href){
		window.open(href, "boardmove", "left=50, top=50, width=500, height=550, scrollbars=1");
	}
</script>

<script>
	$(function() {
		$("a.view_image").click(function() {
			window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
			return false;
		});

		// 추천, 비추천
		$("#good_button, #nogood_button").click(function() {
			var $tx;
			if(this.id == "good_button")
				$tx = $("#bo_v_act_good");
			else
				$tx = $("#bo_v_act_nogood");

			excute_good(this.href, $(this), $tx);
			return false;
		});

		// 이미지 리사이즈
		$("#bo_v_atc").viewimageresize();
	});
	function excute_good(href, $el, $tx){
		$.post(
			href,
			{ js: "on" },
			function(data) {
				if(data.error) {
					alert(data.error);
					return false;
				}

				if(data.count) {
					$el.find("strong").text(number_format(String(data.count)));
					if($tx.attr("id").search("nogood") > -1) {
						$tx.text("이 글을 비추천하셨습니다.");
						$tx.fadeIn(200).delay(2500).fadeOut(200);
					} else {
						$tx.text("이 글을 추천하셨습니다.");
						$tx.fadeIn(200).delay(2500).fadeOut(200);
					}
				}
			}, "json"
		);
	}
</script>