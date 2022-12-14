<style type="text/css">
	.pop_bg {
		position:fixed; display:none; left:0; right:0; top:0; bottom:0; z-index:101110;
		background:rgba(0,0,0,0.4);
		filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#70000000,endColorstr=#70000000);
	}
	.layer_box {
		position:fixed; display:block; left:0; right:0; top:0; bottom:0; width:980px; max-width:980px; height:609px; max-height:609px; margin:auto auto; padding:30px; background:#fff; z-index:1001111;
		box-sizing:border-box; -moz-box-sizing:border-box; -webkit-box-sizing:border-box;
	}
	.layer_email{width: 700px; height: 500px; } 
	.layer_box > h3 { margin-bottom:40px; font-size:30px; color:#111; font-weight:700; }
	.layer_box .btn_close { position:absolute; display:block; width:60px; height:56px; right:-60px; top:0; background:url(<? echo G5_THEME_URL ?>/images/template/btn_close.jpg) no-repeat center center; overflow:hidden; font-size:0;line-height:0;}
	.layer_box.layer_sitemap .btn_close {right:0; left: auto; width:140px; height:140px;  border: 1px solid rgba(255,255,255,0.15); background: #000;}	
	.layer_box.layer_sitemap .btn_close:after{position: absolute; content:''; left: 0; top: 0; width:140px; height:140px;  background:url(<? echo G5_THEME_URL ?>/images/template/btn_close.jpg) no-repeat center center;  transform:rotate(90deg);  transition:.8s; }
	.layer_box.layer_sitemap .btn_close:hover:after{transform:rotate(360deg);}
	.layer_box .div_outline { display:block; /*height:360px; overflow-y:auto;*/ border:1px solid #ddd; box-sizing:border-box; -moz-box-sizing:border-box; -webkit-box-sizing:border-box; }
	.layer_box .div_outline:after { display:block; content:""; clear:both; }
	.layer_box .div_outline_padding { display:block; height:360px; padding:20px; border:1px solid #ddd; overflow-y:auto; box-sizing:border-box; -moz-box-sizing:border-box; -webkit-box-sizing:border-box; }
	.layer_box .div_outline_padding:after { display:block; content:""; clear:both; }

	.layer_box textarea {
		width:100%; height:450px; padding:10px; border:0; overflow-y:auto; resize:none; outline:0;
		box-sizing:border-box; -moz-box-sizing:border-box; -webkit-box-sizing:border-box;
	}

	.layer_box .email_area { display:table; width:100%; height:100%; border-collapse:collapse; border-spacing:0; margin:0; padding:0; overflow:hidden; }
	.layer_box .email_box { display:table-cell; width:100%; height:350px; padding:50px; text-align:center; vertical-align:middle; box-sizing:border-box; overflow:hidden; }
	.layer_box .email_area .email_box .big_txt { margin-bottom:20px; font-size:20px; color:#222; font-weight:700; }
	.layer_box .email_area .email_box .normal_txt { margin:0; font-size:15px; color:#555; line-height:1.5; word-break:keep-all; }

	.layer_box.layer_pat {top:auto;bottom:20px;width:600px;height:800px;max-height:800px;padding:30px 30px 0;}
	.layer_box.layer_pat .pop_name {display:table;position:relative;width:93%;height:72px;margin:-36px auto 0;background:#49494b;border-radius:10px 10px 0 0;table-layout:fixed;}
	.layer_box.layer_pat .pop_name > span {display:table-cell;padding:0 20px;font-size:17px;font-weight:400;color:#fff;line-height:27px;text-align:center;vertical-align:middle;}
	.layer_box.layer_pat .div_outline {height:734px;border:none;text-align:center;}
	.layer_box.layer_pat .div_outline img {width:auto;max-width:100%;height:100%;box-shadow:0 0 5px rgba(100,100,100,0.5);}
	.layer_box.layer_sitemap {position:fixed;width:100%;max-width:100%;height:100%;max-height:100%;;background:rgba(0,0,0,0.4); box-sizing: border-box; padding-top: 14vh;}
	.layer_box.layer_sitemap .div_outline_padding {position:absolute;top:19vh;lefT:0;right:0;bottom:0;margin:auto;width:1400px;max-width:1400px;height:700px;max-height:700px;border:0;padding:0;}
	.layer_box.layer_sitemap h3{font-size: 45px; color: #fff; text-align: center;}

	.layer_box .sitemap {border:0;height:auto;width:33.333%;margin:0;box-sizing:border-box; margin-bottom: 33px;}
	.layer_box .sitemap:last-child {border-right:0;}
	.layer_box .sitemap dt {padding:0;font-size:30px;font-weight:700;line-height:1;color:#fff;text-align:center;border-bottom:0;margin-bottom:30px;transition:0.4s;}
	.layer_box .sitemap dt span{position: relative;}
	.layer_box .sitemap dd {padding:0;}
	.layer_box .sitemap dd .dep2{width: 100%;}
	.layer_box .sitemap dd .dep2 > ul {height:250px !important;}
	.layer_box .sitemap:nth-child(4) dd .dep2 > ul,
	.layer_box .sitemap:nth-child(5) dd .dep2 > ul{height:150px;}
	.layer_box .sitemap dd .dep2 > ul > li > a {padding:0;font-size:16px;line-height:36px;font-weight:350;color:#fff;text-align:center;border-bottom:0;transition:0.4s;} 
	.layer_box .sitemap dd .dep2 > ul > li > ul li a{padding:0;font-size:16px;line-height:36px;font-weight:350;color:rgba(255,255,255,0.8);text-align:center;border-bottom:0;transition:0.4s}
	.layer_box .sitemap dd .dep2 > ul > li > ul li:hover a{color: #fff;}

	.layer_box .sitemap dt{} 
	.layer_box .sitemap dt span{position: relative; color: #fff;}
	.layer_box .sitemap dt span:before{position: absolute; content:''; width: 0%; height: 14px; background: #db2a2e ; left: 0; bottom: 0; z-index: -1; opacity: 0; transition:.3s;} 
	.layer_box .sitemap dt.current span:before,
	.layer_box .sitemap:hover dt span:before{width: 100%; opacity: 1;}
	.layer_box .sitemap:hover dd .dep2 > ul > li > a {color:#fff;}
	.layer_box .sitemap dd .dep2 > ul > li:hover > a {color:#db2a2e;}
	 
	.layer_privacy { display:none; }		 
	.layer_privacy2 { display:none; }
	.layer_email { display:none; }
	.layer_pat { display:none; }
	.layer_regis { display:none; }
	.layer_sitemap { display:none; }
	.layer_video { display:none; width:1280px;max-width:1280px;height: 720px;max-height: 720px;padding: 0;}
	
	@media(max-width:1400px){
		.layer_box.layer_sitemap .div_outline_padding {width: 100%;}	
	
	}

	@media(max-width:1024px){
		.layer_box { width:auto; max-width:90%; height:auto; padding:10px; }
		.layer_box > h3 { margin-bottom:10px; padding:10px 0; font-size:1.4em; }
		.layer_box .btn_close { position:absolute; display:block; width:35px; height:35px; right:0; top:0; overflow:hidden; }
		.layer_box .div_outline { display:block; height:auto; border:1px solid #ddd; overflow-y:auto; }
		.layer_box .div_outline:after { display:block; content:""; clear:both; }
		.layer_box .email_area .email_box { padding:30px; }
		.layer_box .email_area .email_box .big_txt { font-size:1em; }
		.layer_email { max-height:300px; }
	}

	@media(max-width:800px){
		.layer_box.layer_sitemap .div_outline_padding{box-sizing: border-box; padding: 0 20px;}
		.layer_box .sitemap{width: 49%; margin-right: 2%; overflow: hidden; overflow-y: auto;}
		.layer_box .sitemap:nth-child(2n+2){margin-right:  0;}
	}

	@media(max-width:640px){
		.layer_box .email_box {height: auto;}

		.layer_box .sitemap { width:49%; }
		.layer_box .sitemap dd > ul > li > a { font-size:0.87em; }
		
		/* ???????????? */
		.layer_box.layer_sitemap .div_outline_padding {width:100%;height:80%;max-height:80%;}
		.layer_box .sitemap:nth-child(2n+2) {border-right:0;}
		.layer_box .sitemap dt {font-size:4vw;line-height:4vw;margin-bottom:4vw;}
		.layer_box .sitemap dd .dep2 > ul > li > a{font-size: 3.2vw; line-height: 1.7;}
		.layer_box .sitemap dd > ul {height:53vw;}
		.layer_box .sitemap dd > ul > li > a {line-height:2;}
		.layer_box .sitemap{margin-bottom: 6vw;}
	}
	@media(max-width:480px){
		.layer_box > h3{font-size: 5vw !important; font-weight: 500 !important;}
		.layer_box textarea{font-size: 3.2vw; line-height: 1.7;}
		.layer_box .email_area .email_box .normal_txt{font-size: 3.2vw; text-align: center; line-height: 1.7;}
		.layer_box .sitemap dd{overflow: hidden; overflow-y: scroll !important;}
		.layer_box .sitemap dd > ul{overflow: hidden; overflow-y: scroll !important;}
		.layer_box .sitemap dd > ul > li > a{line-height: 2;}
		.layer_box .sitemap{overflow: hidden; overflow-y: scroll !important;}
		.layer_box .sitemap dd{height: 45vw; overflow-y: scroll !important;}
		.layer_box .sitemap:nth-child(3) dd,
		.layer_box .sitemap:nth-child(4) dd{height: 33vw;}
		.layer_box.layer_sitemap .btn_close {width: 45px; height: 45px;}
		.layer_box.layer_sitemap .btn_close:after {width: 45px; height: 45px; background-size: 30px;}
		.layer_box.layer_sitemap {padding-top: 3vh;}
		.layer_box.layer_sitemap{overflow: hidden; overflow-y: auto;}
		.layer_box.layer_sitemap .div_outline_padding{overflow: hidden; overflow-y: auto; top: 2vh;}
		.layer_box .sitemap dd > ul > li > ul {display: none;}
		.layer_box .sitemap dd .dep2 > ul > li > ul li a{font-size: 3.2vw; line-height: 1.7;}
		.layer_box .sitemap dd .dep2 > ul {height:150px !important;}
	}
</style>
<!-- ?????? ????????? ?????? ?????? : ?????? -->
<div class="pop_bg"></div>

<div class="layer_box layer_privacy2">
	<h3 class="pop_name">????????????</h3>
	<div class="div_outline">
		<textarea name="" id="" cols="30" rows="28" readonly>????????? ??????????????????.</textarea>
	</div>
	<a href="#n" class="btn_close">??????</a>
</div>

<div class="layer_box layer_privacy">
	<h3 class="pop_name">????????????????????????</h3>
	<div class="div_outline">
		<textarea name="" id="" cols="30" rows="28" readonly><?=get_text($config[cf_privacy])?></textarea>
	</div>
	<a href="#n" class="btn_close">??????</a>
</div>

<div class="layer_box layer_email">
	<h3 class="pop_name">???????????????????????????</h3>
	<div class="div_outline">
		<div class="email_area">
			<div class="email_box">
				<p class="big_txt">
					??????????????? ??????????????? ???????????????.
				</p>
				<p class="normal_txt">
					??? ??????????????? ????????? ????????? ????????? ???????????? ?????? ?????????????????? ??? ?????? ????????? ????????? ???????????? <strong>???????????? ???????????? ?????? ??????</strong>??????,
					?????? <strong>????????? ????????????????????? ?????? ?????? ??????</strong>?????? ??????????????? ????????????.
				</p>
			</div>
		</div>
	</div>
	<a href="#n" class="btn_close">??????</a>
</div>

<div class="layer_box layer_sitemap">
	<!-- <h3 class="pop_name">????????????</h3> -->
	<div class="div_outline_padding">
		<dl class="sitemap sitemap_1st">
			<dt class="<?=$gn_btn1;?>"><span><?=$s1_name?></span></dt>
			<dd class="s_depth_menu siteul_1" id=""></dd>
		</dl>
		<dl class="sitemap sitemap_1st">
			<dt class="<?=$gn_btn2;?>"><span><?=$s2_name?></span></dt>
			<dd class="s_depth_menu siteul_2" id=""></dd>
		</dl>
		<dl class="sitemap sitemap_1st">
			<dt class="<?=$gn_btn3;?>"><span><?=$s3_name?></span></dt>
			<dd class="s_depth_menu siteul_3" id=""></dd>
		</dl>
		<dl class="sitemap sitemap_1st">
			<dt class="<?=$gn_btn4;?>"><span><?=$s4_name?></span></dt>
			<dd class="s_depth_menu siteul_4" id=""></dd>
		</dl>
		<dl class="sitemap sitemap_1st">
			<dt class="<?=$gn_btn5;?>"><span><?=$s5_name?></span></dt>
			<dd class="s_depth_menu siteul_5" id=""></dd>
		</dl>

	</div>
	<a href="#n" class="btn_close">??????</a> 
</div>

<style>
    .layer_cont{margin-top:35px;padding-top:30px;border-top:1px solid #ddd}
	.layer_cont h3{font-size:36px;font-weight: 600;color: #000;}
	.layer_cont p{font-size:18px;line-height: 30px;color: #555555;}

	.layer_cont .layer_esti_btns{margin-top: 40px;}
	.layer_cont .layer_esti_btns span{display:inline-block;width:180px;font-size:18px;line-height: 55px;color: #fff;text-align: center;cursor: pointer;transition:0.3s}
	.layer_cont div .btn_pop_question{margin-right: 6px;background-color: #ff3000;}
	.layer_cont div .btn_pop_cancel{background-color: #191919;}

	.layer_cont div .btn_pop_question:hover{background-color: #d22700;}
	.layer_cont div .btn_pop_cancel:hover{background-color: #000;}
	/* s3_3 ??????????????? ?????? ?????? */
	.layer_box.layer_search_belong{display: none;width:613px;height:auto!important;max-height: 700px;;padding:85px 30px 95px;box-sizing:border-box;background: #fff url(../../images/template/layer_estimate_bg.jpg) no-repeat center;border-radius:30px;text-align: center;}
	.layer_search_belong .stbl_wrap table tr th{padding:10px;border: 0; text-align:center;}
	.layer_search_belong .stbl_wrap table tr td{padding:5px;  text-align:center; font-size: 15px;}
	.layer_search_belong .pop_search{margin-bottom:20px;}
	.layer_search_belong .pop_search input[type=text]{width:calc(100% - 100px)}
	.layer_search_belong .pop_search .btn_search,
	.layer_search_belong .btn_st2{width:90px;height: 35px!important;line-height: 35px!important;}

	.layer_search_belong .pg_wrap{margin-top: 20px!important;}
</style>

<!-- "???????????? > ?????? ?????? ??????-->
<div class="layer_box layer_search_belong">
	<form name="search_layer" id="search_layer" action="#n" onsubmit="return false;"  method="post" enctype="multipart/form-data" autocomplete="off">

	<h3 class="pop_name score">?????? ??????</h3>
	<div class="layer_cont">
		<div class="pop_search">
			<input type="hidden" name="sfl" value="<?php echo ($sfl)?$sfl:"wr_subject"; ?>" id="sfl">
			<input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" placeholder="?????????" id="stx" class="input_ty" size="12" maxlength="20">
			<input type="submit" value="??????" class="btn_st1 btn_search" onclick="$('#search_layer').find('input[id=page]').val(1);fwrite_search_layer();">
			<input type="hidden" name="page" value="<?php echo ($page)?$page:"0"; ?>" id="page">
		</div>
		<div class="stbl_wrap tbl_frm01 ">
			<table>
				<caption>?????? ??????</caption>
				<colgroup>
					<col width="10%">
					<col width="75%">
					<col width="15%">
				</colgroup>	
				<thead>
					<th>No</th>
					<th>??????</th>
					<th>??????</th>
				</thead>
				<tbody>
					<tr>
						<td colspan="3">?????? ????????? ????????????.</td>
					</tr>
				</tbody>
			</table>

			<nav class="pg_wrap">
				<span class="pg">
				</span>
			</nav>
		</div>
		<div class="layer_esti_btns">
			<span class="btn_pop_cancel">??????</span>
		</div>
	</div>
	</form>
</div>

<script type="text/javascript">
// ????????? ?????? ????????????
function fwrite_search_layer(){
	
	f = document.search_layer;

	if(f.stx.value == ""){
		alert("???????????? ??????????????????.");
		f.stx.focus();
		return false;
	}

	var sfl = f.sfl.value;
	var stx = f.stx.value;
	var page = f.page.value;

	$.ajax({
		type: 'POST',
		url: '<?=G5_BBS_URL ?>/ajax.layer_search.php',
		data: {"bo_table": "mem_group", "sfl": sfl, "stx": stx, "page": page},
		dataType: "html",
		cache: false,
		async: false,
		success: function(htm) {
			$(f).find("div.stbl_wrap").html(htm);
		},
		error: function(){
			alert("error");
		}
	});

}

// ????????? ?????? ???????????? ?????? ?????????
$(document).on('click','.btn_select_group',function(){
	
	var val = $(this).data("wr_id"); // ????????? ?????? PK
	$("#fregisterform").find("input[name='mb_1']").val(val); // ??? ??????

	val = $(this).data("wr_subject"); // ????????? ?????????
	$("#fregisterform").find("input[name='mb_2']").val(val); // ??? ??????
	
	$('#search_layer').find('input[id=stx]').val(''); // ?????? ??? ?????????
	$("#search_layer").find("table").find("tbody").html("<tr><td colspan=\"3\">?????? ????????? ????????????.</td></tr>"); // ?????? ?????? ?????????

	// ????????? ?????? ?????? ??????
	$("html").css("overflow","visible");
	$("body").css("overflow","visible");
	$(".pop_bg").fadeOut();
	$(".layer_privacy").fadeOut();
	$(".layer_privacy2").fadeOut();
	$(".layer_email").fadeOut();
	$(".layer_sitemap").fadeOut();
	$(".layer_s301").fadeOut();
	$(".layer_search_belong").fadeOut();
});
</script>


<!-- ?????? ????????? ?????? ?????? : ?????? -->

<script type="text/javascript">

	/* ????????? ?????? : ????????????????????????(????????????????????????), ???????????????????????????????????? ???????????? ????????? ?????? */
	$(document).ready(function(){
		$(".btn_privacy").click(function(e){//????????????????????????
			e.preventDefault();
			$("html").css("overflow","hidden");
			$("body").css("overflow","hidden");
			$(".pop_bg").fadeIn();
			$(".layer_privacy").fadeIn();

		});
		$(".btn_privacy2").click(function(e){//????????????????????????
			e.preventDefault();
			$("html").css("overflow","hidden");
			$("body").css("overflow","hidden");
			$(".pop_bg").fadeIn();
			$(".layer_privacy2").fadeIn();

		});
		$(".btn_no_mail").click(function(e){//???????????????????????????
			e.preventDefault();
			$("html").css("overflow","hidden");
			$("body").css("overflow","hidden");
			$(".pop_bg").fadeIn();
			$(".layer_email").fadeIn();
		});

		$(".btn_sitemap").click(function(e){//????????????
			e.preventDefault();
			$("html").css("overflow","hidden");
			$("body").css("overflow","hidden");
			$(".pop_bg").fadeIn();
			$(".layer_sitemap").fadeIn();
		});

        $(".open_pop").click(function(){ // ?????? ?????? ???????????? ??????????????? ?????????. // $(".btn_search").click(function(){//s3_3 write > ???????????? ????????? ??????????????? ??????
			$("html").css("overflow","hidden");
			$("body").css("overflow","hidden");
			$(".pop_bg").fadeIn();
			$(".layer_search_belong").fadeIn();
		});

		$(".btn_close, .btn_pop_cancel").click(function(e){//??????????????? ??????
			e.preventDefault();
			$("html").css("overflow","visible");
			$("body").css("overflow","visible");
			$(".pop_bg").fadeOut();
			$(".layer_privacy").fadeOut();
			$(".layer_privacy2").fadeOut();
			$(".layer_email").fadeOut();
			$(".layer_sitemap").fadeOut();
			$(".layer_s301").fadeOut();
            $(".layer_search_belong").fadeOut();
		});
	});

	$( '#subm1' ).clone().appendTo( '.siteul_1' );
	$( '#subm2' ).clone().appendTo( '.siteul_2' );
	$( '#subm3' ).clone().appendTo( '.siteul_3' );
	$( '#subm4' ).clone().appendTo( '.siteul_4' );
	$( '#subm5' ).clone().appendTo( '.siteul_5' );
	$( '#subm9' ).clone().appendTo( '.siteul_9' );


	//$( '.gnb' ).clone().appendTo( '.hd_nav_2 .rbx' );

</script>