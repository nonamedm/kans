$(function(){
    // 전역변수 선언
    var oEditors = [];
    nhn.husky.EZCreator.createInIFrame({
        oAppRef: oEditors,
        elPlaceHolder: "ir1",
        // 스킨 경로명에 맞게 수정
        sSkinURI: "../plugin/editor/SmartEditor2Skin.html",
        htParams : {
            // 툴바 사용 여부 (true:사용/ false:사용하지 않음)
            bUseToolbar : true,
            // 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
            bUseVerticalResizer : true,
            // 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
            bUseModeChanger : true,
            fOnBeforeUnload : function(){
                //alert("");
            }
        }, //boolean
        fOnAppLoad : function(){
            // 기존 저장된 내용의 text 내용을 에디터상에 뿌려주고자 할때 사용
        },
        fCreator: "createSEditor2"
    });

    function pasteHTML(str) { // 에디터에 내용 삽입
        sHTML = str;
        oEditors.getById["ir1"].exec("PASTE_HTML", [sHTML]);
    }

    function editerResetHTML() { // 에디터 내용 초기화
       oEditors.getById["ir1"].exec("SET_CONTENTS", [""]);  // 내용초기화
    }

    function setDefaultFont() {
        var sDefaultFont = '돋움';
        var nFontSize = 11;
        oEditors.getById["ir1"].setDefaultFont(sDefaultFont, nFontSize);
    }

    $("#savebtn").click(function(){
        // 에디터의 내용을 에디터 생성시에 사용했던 textarea에 넣어준다.
        if($("input[name='title']").val() ==""){
            alert('제목을 입력하세요');
            $("input[name='title']").focus();
            return false;
        }

        // 이부분에 에디터 validation 검증
        var ir1_data = oEditors.getById['ir1'].getIR();
        var checkarr = ['<p>&nbsp;</p>','&nbsp;','<p><br></p>','<p></p>','<br>'];
        if(jQuery.inArray(ir1_data.toLowerCase(), checkarr) != -1){
            alert("내용을 입력해 주십시오.");
            oEditors.getById["ir1"].exec('FOCUS');
            return false;
        }

        // id가 ir1인 에디터의 내용이 textarea에 적용됨
        oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);

        //폼 submit
        $("#writeForm").submit();
    });
}); 
