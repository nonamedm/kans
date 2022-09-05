$(document).ready(function() {
	$(".header .nav .gnb > ul > li > a").bind('mouseover', function() {
		$(".header .nav .gnb > ul > li").find("ul").hide();
		$(this).next().show();
	});
	
	$(".header .nav .gnb > ul").bind("mouseleave", function() {
		$(".header .nav .gnb > ul > li").find("ul").hide();
	});
	
	// banner
	(function(){
		if ($('.visual').length > 0) {
			var bannerHtml = '';
			bannerHtml += '<div style="position:relative; margin:0 auto; width:1024px; height:0;">';
			bannerHtml += '	<a href="javascript:;" style="position:absolute; left:-84px; top:-13px; width:72px; height:140px; z-index:999999;" onclick="window.open(\'/kans_edu/html/kr/kans_edu_guide.html\', \'KANS\', \'width=1024,height=768\');"><img src="/image/ebook.png" alt="" width="72" height="140"></a>';
			bannerHtml += '</div>';
		
			$(bannerHtml).insertAfter('.visual');
		}
		
		if ($('.sub_visual').length > 0) {
			var bannerHtml = '';
			bannerHtml += '<div style="position:relative; margin:0 auto; width:1024px; height:0;">';
			bannerHtml += '	<a href="javascript:;" style="position:absolute; left:-84px; top:10px; width:72px; height:140px; z-index:999999;" onclick="window.open(\'/kans_edu/html/kr/kans_edu_guide.html\', \'KANS\', \'width=1024,height=768\');"><img src="/image/ebook.png" alt="" width="72" height="140"></a>';
			bannerHtml += '</div>';
			
			$(bannerHtml).insertAfter('.sub_visual');
		}
	})();
});