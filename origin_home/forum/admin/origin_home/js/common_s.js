/* slide photo START */
function slide(Id, interval, to)
	{
		var obj = document.getElementById(Id);
		var H, step = 5;
	
		if (obj == null) return;
		if (to == undefined) { // user clicking
		if (obj._slideStart == true) return;
		if (obj._expand == true) {
			to = 0;
			obj.style.overflow = "hidden";
		} else {
			slide.addId(Id);
			for(var i=0; i < slide.objects.length; i++) {
				if (slide.objects[i].id != Id && slide.objects[i]._expand == true) {
					slide(slide.objects[i].id);
					}
				}
				obj.style.height = "";
				obj.style.overflow = "";
				obj.style.display = "block";
				to = obj.offsetHeight;
				obj.style.overflow = "hidden";
				obj.style.height = "1px";
			}
			obj._slideStart = true;
		}
	
		step = ((to > 0) ? 1:-1) * step;
		interval = ((interval==undefined)?1:interval);
		obj.style.height = (H=((H=(isNaN(H=parseInt(obj.style.height))?0:H))+step<0)?0:H+step)+"px";
	
		if (H <= 0) {
			obj.style.display = "none";
			obj.style.overflow = "hidden";
			obj._expand = false;
			obj._slideStart = false;
		} else if (to > 0 && H >= to) {
			obj.style.display = "block";
			obj.style.overflow = "visible";
			obj.style.height = H + "px";
			obj._expand = true;
			obj._slideStart = false;
		} else {
			setTimeout("slide('"+Id+"' , "+interval+", "+to+");", interval);
			}
		}
		slide.objects = new Array();
		slide.addId = function(Id)
		{
		for (var i=0; i < slide.objects.length; i++) {
			if (slide.objects[i].id == Id) return true;
		}
			slide.objects[slide.objects.length] = document.getElementById(Id);
	}
<!-- slide photo END -->

<!-- tab START  -->
TabbedPane = function(className,tabbedDivArray) {
	this.IE = document.all ? 1 : 0;
	this.NN = document.layer ? 1 : 0;
	this.N6 = document.getElementById ? 1 : 0;
	this.className = className;
	this.tabbedDivArray = tabbedDivArray;
}
TabbedPane.prototype.show = function(tab_id) {

var sbTab1_img = document.getElementById('sbTab1_img');
var sbTab2_img = document.getElementById('sbTab2_img');
var sbTab3_img = document.getElementById('sbTab3_img');
var sbTab4_img = document.getElementById('sbTab4_img');

sbTab1_img.src = 'image_s/tab0'+(tab_id=='tab_01'?'_on':'')+'.gif';
sbTab2_img.src = 'image_s/tab1'+(tab_id=='tab_02'?'_on':'')+'.gif';
sbTab3_img.src = 'image_s/tab2'+(tab_id=='tab_03'?'_on':'')+'.gif';
sbTab4_img.src = 'image_s/tab4'+(tab_id=='tab_04'?'_on':'')+'.gif';

	var obj;
	if(this.IE) obj = document.all(tab_id);
	else if(this.NN) obj = document.layer[tab_id];
	else if(this.N6) obj = document.getElementById(tab_id);
	else return;

	for(i = 0; i < this.tabbedDivArray.length; i++)
	{
		var div = document.getElementById(this.tabbedDivArray[i]);
		if(div && this.tabbedDivArray[i] == tab_id)
			div.style.display = '';
		else
			div.style.display = 'none';
	}
	if(!obj) return ;
	obj.style.display = '';
}
TabbedPane.prototype.hidden = function(tab_id) {
}

var tabObj = new TabbedPane("tabObj",Array("tab_01","tab_02","tab_03","tab_04"));
<!-- tab END  -->


<!-- menu START  -->
var preloaded = [];
function init() {
        mtDropDown.initialize();
}

function swapImage(imgName, sFilename) {
    document.images[imgName].src = sFilename;
}
<!-- menu END  -->

<!-- scroll START  -->
self.onError=null;
currentX = currentY = 0;  
whichIt = null;           
lastScrollX = 0; lastScrollY = 0;
NS = (document.layers) ? 1 : 0;
IE = (document.all) ? 1: 0;
<!-- STALKER CODE -->
function heartBeat() {
	if(IE) { 
		  diffY = document.body.scrollTop; 
		  diffX = 0; 
		   }
	if(NS) { diffY = self.pageYOffset; diffX = self.pageXOffset; }
	if(diffY != lastScrollY) {
				percent = .1 * (diffY - lastScrollY);
				if(percent > 0) percent = Math.ceil(percent);
				else percent = Math.floor(percent);
		if(IE) document.all.floater.style.pixelTop += percent;
		if(NS) document.floater.top += percent; 
				lastScrollY = lastScrollY + percent;
	}
	if(diffX != lastScrollX) {
		percent = .1 * (diffX - lastScrollX);
		if(percent > 0) percent = Math.ceil(percent);
		else percent = Math.floor(percent);
		if(IE) document.all.floater.style.pixelLeft += percent;
		if(NS) document.floater.top += percent;
		lastScrollY = lastScrollY + percent;
	}	
}	
if(NS || IE) action = window.setInterval("heartBeat()",1);