
if (mtDropDown.isSupported()) {
	var ms = new mtDropDownSet(mtDropDown.direction.down, 0, 0, mtDropDown.reference.bottomLeft);
	var menu1 = ms.addMenu(document.getElementById("menu1"));
		menu1.addItem("인사말", "http://www.kans.re.kr/intro/intro01.html"); 
		menu1.addItem("소개", "http://www.kans.re.kr/intro/intro02.html"); 
		menu1.addItem("사업", "http://www.kans.re.kr/intro/intro03.html"); 
		menu1.addItem("회원가입안내", "http://www.kans.re.kr/intro/intro05.html"); 
		menu1.addItem("오시는길", "http://www.kans.re.kr/intro/intro04.html"); 

	var menu2 = ms.addMenu(document.getElementById("menu2"));
		menu2.addItem("방사선종사자교육", "http://www.kans.re.kr/edu/edu01.html"); 
		menu2.addItem("면허소지자교육", "http://www.kans.re.kr/edu/edu01.html"); 
		menu2.addItem("통신교육", "http://www.kans.re.kr/edu/edu02.html"); 
		menu2.addItem("방재교육", "http://www.kans.re.kr/edu/edu03.html"); 
		menu2.addItem("단기교육", "http://www.kans.re.kr/edu/edu05.html");
		menu2.addItem("온라인교육", "http://www.kans.re.kr/edu/edu04.html"); 
		menu2.addItem("수료증발급", "http://www.kans.re.kr/edu/edu07_cert.html"); 


	var menu3 = ms.addMenu(document.getElementById("menu3"));
		menu3.addItem("교육", "http://www.kans.re.kr/info/info01.html"); 
		menu3.addItem("수납", "http://www.kans.re.kr/info/info02.html"); 
		menu3.addItem("기타", "http://www.kans.re.kr/info/info03.html"); 


	var menu4 = ms.addMenu(document.getElementById("menu4"));
		menu4.addItem("교육일정", "http://www.kans.re.kr/data/data01.html"); 
		menu4.addItem("공지사항", "http://www.kans.re.kr/data/data02.html"); 
		menu4.addItem("사진게시판", "http://www.kans.re.kr/data/data03.html"); 
		menu4.addItem("문서자료실", "http://www.kans.re.kr/data/data04.html"); 
		menu4.addItem("방사선정보", "http://www.kans.re.kr/data/data05.html"); 
		menu4.addItem("링크자료실", "http://www.kans.re.kr/data/data06.html"); 
		menu4.addItem("채용정보", "http://www.kans.re.kr/data/data07.html"); 

	mtDropDown.renderAll();
}

