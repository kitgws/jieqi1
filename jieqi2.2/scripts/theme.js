//�����˵� menu-�˵�����id��box-���������id������3-right���Ҷ��룬Ĭ�Ͽ��󣬲���4-top��ʾ���Ϸ���Ĭ���·�
function menubox(menu, box) {
	menu = $_(menu);
	box = $_(box);
	if (box.style.display == 'none') {
		box.style.display = 'block';
		box.style.position = 'absolute';
	} else {
		box.style.display = 'none';
		return;
	}
	var pos = menu.getPosition();
	if (arguments.length > 2 && arguments[2] == 'right') box.style.left = (pos.x + menu.offsetWidth - box.offsetWidth) + 'px';
	else box.style.left = pos.x + 'px';
	if (arguments.length > 3 && arguments[3] == 'top') box.style.top = (pos.y - box.offsetHeight + 1) + 'px';
	else box.style.top = (pos.y + menu.offsetHeight - 1) + 'px';
	return;
}

//tabЧ��
function selecttab(obj) {
	var i = 0;
	var n = 0;
	var tabs = obj.parentNode.parentNode.getElementsByTagName('li');
	for (i = 0; i < tabs.length; i++) {
		tmp = tabs[i].getElementsByTagName('a')[0];
		if (tmp == obj) {
			tmp.className = 'selected';
			n = i;
		} else {
			tmp.className = '';
		}
	}
	var tavdiv = obj.parentNode.parentNode.parentNode;
	var tabchilds = obj.parentNode.parentNode.parentNode.parentNode.childNodes;
	var tabcontent;
	for (i = tabchilds.length - 1; i >= 0; i--) {
		if (typeof tabchilds[i].tagName != 'undefined' && tabchilds[i].tagName.toLowerCase() == 'div' && tabchilds[i] != tavdiv) {
			tabcontent = tabchilds[i];
			break;
		}
	}
	var contents = tabcontent.childNodes;
	var k = 0;
	for (i = 0; i < contents.length; i++) {
		if (typeof contents[i].tagName != 'undefined' && contents[i].tagName.toLowerCase() == 'div') {
			contents[i].style.display = k == n ? 'block': 'none';
			k++;
		}
	}
}

//�л���һ��tab
function nexttab(obj) {
	var i = 0;
	var n = 0;
	if (typeof obj == 'string') obj = document.getElementById(obj);
	var tabs = obj.getElementsByTagName('li');
	for (i = 0; i < tabs.length; i++) {
		tmp = tabs[i].getElementsByTagName('a')[0];
		if (tmp.className == 'selected') {
			n = i + 1;
			if (n >= tabs.length) n = 0;
			break;
		}
	}
	tmp = tabs[n].getElementsByTagName('a')[0];
	selecttab(tmp);
}

//tab �ֻ�
function slidetab(obj) {
	var i = 0;
	var n = 0;
	var time = 5000;
	if (arguments[1]) time = arguments[1];
	if (time == 0) return;
	if (typeof obj == 'string') obj = document.getElementById(obj);
	var tabs = obj.getElementsByTagName('li');
	for (i = 0; i < tabs.length; i++) {
		tmp = tabs[i].getElementsByTagName('a')[0];
		if (tmp.className == 'selected') {
			n = i + 1;
			if (n >= tabs.length) n = 0;
			break;
		}
	}
	tmp = tabs[n].getElementsByTagName('a')[0];
	selecttab(tmp);
	setTimeout(function() {
		slidetab(obj, time);
	},
	time);
}

//ѡ���ǩ���ı���
function selecttag(txt, tag){
	txt = $_(txt);
	tag = $_(tag);
	var ts = tag.innerHTML.trim();
	var re = new RegExp('(^| )' + ts + '($| )', 'g');
	if(tag.className != 'taguse'){
		tag.className = 'taguse';
		if(!re.test(txt.value)){
		  if(txt.value != '') txt.value += ' ';
		  txt.value += ts;
		}
	}else{
		tag.className = '';
		txt.value = txt.value.replace(re, ' ');
	}
	txt.value = txt.value.replace(/\s{2,}/g, ' ').replace(/^\s+/g, '');
}

//��˫���л�
function sheetrow(){
	var sheets = getByClass('sheet', document, 'table');
	for(var i = 0; i < sheets.length; i++){
		var trs = sheets[i].getElementsByTagName('tr'); 
		for(var j = 0; j < trs.length; j++){
			trs[j].className = (j % 2 == 1) ? 'even' : 'odd';
		}
	}
}
addEvent(window, 'load', sheetrow);