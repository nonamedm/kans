
if (mtDropDown.isSupported()) {
	var ms = new mtDropDownSet(mtDropDown.direction.down, 0, 0, mtDropDown.reference.bottomLeft);
	var menu1 = ms.addMenu(document.getElementById("menu1"));
		menu1.addItem("�λ縻", "http://www.kans.re.kr/intro/intro01.html"); 
		menu1.addItem("�Ұ�", "http://www.kans.re.kr/intro/intro02.html"); 
		menu1.addItem("���", "http://www.kans.re.kr/intro/intro03.html"); 
		menu1.addItem("ȸ�����Ծȳ�", "http://www.kans.re.kr/intro/intro05.html"); 
		menu1.addItem("���ô±�", "http://www.kans.re.kr/intro/intro04.html"); 

	var menu2 = ms.addMenu(document.getElementById("menu2"));
		menu2.addItem("��缱�����ڱ���", "http://www.kans.re.kr/edu/edu01.html"); 
		menu2.addItem("��������ڱ���", "http://www.kans.re.kr/edu/edu01.html"); 
		menu2.addItem("��ű���", "http://www.kans.re.kr/edu/edu02.html"); 
		menu2.addItem("���米��", "http://www.kans.re.kr/edu/edu03.html"); 
		menu2.addItem("�ܱⱳ��", "http://www.kans.re.kr/edu/edu05.html");
		menu2.addItem("�¶��α���", "http://www.kans.re.kr/edu/edu04.html"); 
		menu2.addItem("�������߱�", "http://www.kans.re.kr/edu/edu07_cert.html"); 


	var menu3 = ms.addMenu(document.getElementById("menu3"));
		menu3.addItem("����", "http://www.kans.re.kr/info/info01.html"); 
		menu3.addItem("����", "http://www.kans.re.kr/info/info02.html"); 
		menu3.addItem("��Ÿ", "http://www.kans.re.kr/info/info03.html"); 


	var menu4 = ms.addMenu(document.getElementById("menu4"));
		menu4.addItem("��������", "http://www.kans.re.kr/data/data01.html"); 
		menu4.addItem("��������", "http://www.kans.re.kr/data/data02.html"); 
		menu4.addItem("�����Խ���", "http://www.kans.re.kr/data/data03.html"); 
		menu4.addItem("�����ڷ��", "http://www.kans.re.kr/data/data04.html"); 
		menu4.addItem("��缱����", "http://www.kans.re.kr/data/data05.html"); 
		menu4.addItem("��ũ�ڷ��", "http://www.kans.re.kr/data/data06.html"); 
		menu4.addItem("ä������", "http://www.kans.re.kr/data/data07.html"); 

	mtDropDown.renderAll();
}

