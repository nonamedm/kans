$(function(){
    var tabIndex = $('.tabList li.current').index() + 1;
    var fixto = function(n){
        var _n = 0;
        if(n < 10){
            _n = '0' + n;
        }else{
            _n = n;
        }
        return _n;
    };

    $(document).on('click', 'button', function(){
        var $this = $(this);

		// 국문일 경우 기존의 방식..
		if(page.lanType == 'kr'){
			if($this.is('.popup')) {
				var clickIndex = $('button.popup').index($(this));
				$('.area-pop').show();
				$('.popContent li div').removeClass().addClass('popImg0' + tabIndex + fixto( parseInt(clickIndex +1) ) );
				// $('.popContent li span').html( popupData[tabIndex-1][clickIndex] );
			}else if($this.is('.btn-hide-pop')){
				$('.area-pop').hide();
			}
		}else{
		// 영문일 경우, 새로운 방식
			if($this.is('.popup')) {
				var src = $('img', $this).attr('src');
				$('.area-pop').show();
				$('.popContent li div').html('<img src="' + src + '">');
			}else if($this.is('.btn-hide-pop')){
				$('.area-pop').hide();
			}
		}
    }).on('click', '.lang-change button', function(){
		var $this = $(this);
		if($this.is('.kr')){
			if(window.page.lanType != 'kr')
			location.href = location.href.replace('html/en', 'html/kr');
		}else{
			if(window.page.lanType != 'en')
			location.href = location.href.replace('html/kr', 'html/en');
		}
	})

    $(".btn-hide-page").attr('onclick','pageHide()');

    $(document).on('click', '.area-logo a', function(){
        location.href = '/kans_edu/html/kr/kans_edu01.html';
    });
});

function pageHide(){
	window.open('about:blank','_self').close();
}

///// 황인재

function Page( el, con ){
	var self = this;
	this.lanType = (location.href.indexOf('html/kr') > 0) ? 'kr' : 'en';
	this.pages = el.children();
	this.pageLength = this.pages.length;
	this.controlBox = con;
	this.pagiAll = $('.pagiAll', con);
	this.pagicrt = $('.pagicrt', con);
	this.index = (location.href.indexOf('?page=') > 0) ? parseInt(location.href.split('?page=')[1]) : 1;
	this.tabIndex = $('.tabList li.current').index() + 1;

	this.init = function(){
		self.eventBind();
		self.slideShow(self.index);
		self.pagiAll.html( self.pageLength );
	};

	this.eventBind = function(){
		self.controlBox.on('click', 'a', function(e){
			e.preventDefault();
			self.slideShow( $(this).is('.btn-prev') ? self.index - 1 : self.index + 1);
		});
	};

	this.slideShow = function(cnt){
		if(!cnt){
			// 이전탭
			if(self.tabIndex>1)
				location.href = '/kans_edu/html/' + self.lanType + '/kans_edu0' + parseInt(self.tabIndex-1) + '.html';
			//else
			//	alert('가장 처음 탭 입니다.');
		}else if(self.pageLength < cnt){
			// 다음 탭
			if(self.tabIndex<5)
				location.href = '/kans_edu/html/' + self.lanType + '/kans_edu0' + parseInt(self.tabIndex+1) + '.html';
			//else
			//	alert('가장 마지막 탭 입니다.');
		}else{
			self.pages.eq(cnt-1).addClass('on').siblings().removeClass('on');
			self.index = cnt;
			self.pagicrt.html( cnt );
		}
	};
	this.init();
	return this;
};

function Lnb( el ){
	var self = this;
	this.el = el;
	$(document).on('click', '.wrap-navi a, .wrap-navi li, .wrap-navi button', function(e){
		e.preventDefault();
		var $t = $(this);
		switch(e.currentTarget.localName){
			case 'button':
				if($t.is('.btn-list')){
					self.el.is('.on') ? self.el.removeClass('on').animate({'left': '-254px'}) : self.el.addClass('on').animate({'left': 0});
				}else{
					self.el.removeClass('on').animate({'left': '-254px'});
				}
				break;
			case 'a':
				location.href = '/kans_edu/html/' + self.page.lanType + '/kans_edu0' + parseInt($t.closest('li').index()+1) + '.html';
				break;
			case 'li':
				if(!$t.children().length)
				location.href = '/kans_edu/html/' + self.page.lanType + '/kans_edu0' + parseInt($t.parent().closest('li').index()+1) + '.html?page=' + ($t.closest('li').index()+1);
			 	break;
		}
	});
};

function Tab( ){
	$(document).on('click', '.tabList a', function(e){
		e.preventDefault();
		var $t = $(this);
		location.href = '/kans_edu/html/' + self.page.lanType + '/kans_edu0' + parseInt($t.closest('li').index()+1) + '.html';
	});
}

function Scroll() {	
	$('.area-scroll').niceScroll({
		cursorcolor: "#92d3f4",
		cursorwidth: "8px",
	    cursorborder: "1px solid #fff",
		railpadding: { top: 0, right: -10, left: 0, bottom: 0 }
	});
}

$(function(){
	window.page = new Page( $('.area-scroll > ol'), $('.pagination') );
	Lnb( $('.wrap-navi') );
	Tab();

	$('.btn-prev,.btn-next').on('click',function(){	
		setTimeout(function(){
			$('.area-scroll').getNiceScroll().resize();
		},100);
	});
});

$(window).on('load',Scroll);