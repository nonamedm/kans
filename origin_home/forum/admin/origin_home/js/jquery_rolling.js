     
    jQuery(function() {
    
    var data = [
      "<a href='http://www.kanselearning.kr/'><img src='image_s/b_com_35.png' width='342' height='100'></a>",
	  "<a href='http://www.kans.re.kr/edu/edu_sub_new.html'><img src='image_s/b_com_36.png' width='342' height='100'></a>",
	  "<a href='http://www.kans.re.kr/edu/edu_sub_04.html' target='_blank'><img src='image_s/b_com_34.jpg' width='342' height='100'></a>",  
	  
	
	//�����̵��̹����� ���⿡ �߰�    
    
	];
    
   // �¿� �ڵ� �����̵� �ҽ�
    jQuery("#srolling").srolling({
      data : data,
      auto : true,
      width : 342,
      height : 100, 
	    delay : 3000,
      delay_frame : 1000,
      move : 'left',
    
    });

  });