/* Korean initialisation for the jQuery calendar extension. */
/* Written by DaeKwon Kang (ncrash.dk@gmail.com). */
jQuery(function($){
	$.datepicker.regional['ko'] = {         
		    closeText : '닫기',         
		    prevText : '이전달',         
		    nextText : '다음달',         
		    currentText : '오늘',         
		    monthNames : ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],         
		    monthNamesShort : ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],         
		    dayNames : ['일', '월', '화', '수', '목', '금', '토'],         
		    dayNamesShort : ['일', '월', '화', '수', '목', '금', '토'],         
		    dayNamesMin : ['일', '월', '화', '수', '목', '금', '토'],         
		    weekHeader : 'Wk',         
		    dateFormat : 'yy-mm-dd',         
		    firstDay : 0,         
		    isRTL : false,
		    yearSuffix : '',
		    //showOn: 'both',
		    //buttonImage: '/oceangrid/images/gis/popup/icon_calendar.gif',
//		    buttonImage: '/oceangrid/images/gis/sub/sub_icon02.gif',
//		    buttonImage: '/oceanmap/images/common/icon_calendar.png',
		    buttonImageOnly: true
		   }; 
	$.datepicker.setDefaults($.datepicker.regional[ "ko" ]);
});