/*
���ܣ���̬���Ӹ����ϴ�ѡ���
���ӣ�
<input type="button" onclick="Attaches.addFile('fname', 'uploaddiv', false)" value="����Ӹ���" /><div id="uploaddiv"></div> 
����
<input type="file" name="fname1[]" id="fname1" onchange="Attaches.addFile('fname1', 'uploaddiv1', true);"> <input type="button" class="filebutton" onclick="if(document.all){document.getElementById('fname1').outerHTML += '';}else{document.getElementById('fname1').value = '';}" value="���" /><div id="uploaddiv1"></div>
*/
var Attaches = {
	isie : (navigator.userAgent.indexOf("MSIE") != -1),
	files : new Array(),

	newFile : function(name) {
		if(typeof this.files[name] == 'undefined') this.files[name] = new Array();
		var index = this.files[name].length;
		file = document.createElement("input");
		file.type = "file";
		file.index = index;
		file.id = name + String(index);
		file.name = name + "[]";
		file.className = "file";
		this.files[name][index] = file;
		return file;
	},

	addFile : function(name, parent, addnext) {
		if(addnext && typeof this.files[name] != 'undefined' && this.files[name].length > 0){
			var maxid = name + String(this.files[name].length - 1);
			if($_(maxid) != null && $_(maxid).value == "") return true;
		}
		file = this.newFile(name);
		if(addnext){
			if(this.isie) file.attachEvent("onchange", function(){Attaches.addFile(name, parent, true)});
			else file.setAttribute("onchange", "Attaches.addFile('" + name + "','" + parent + "', true)", 0);
		}

		div = document.createElement("div");
		div.className = "filediv";
		div.id = "div_" + name + String(file.index);
		$_(parent).appendChild(div);

		div.appendChild(file);

		button = document.createElement("input");
		button.type = "button";
		button.id = "btn_" + name + String(file.index);
		button.name = "btn_" + name + "[]";
		button.className = "filebutton";
		button.value = "ɾ��";
		var fi = file.index;
		if(this.isie) button.attachEvent("onclick", function(){Attaches.removeFile(name, fi)}); 
		else button.setAttribute("onclick", "Attaches.removeFile('" + name + "','" + file.index + "')", 0);
		div.appendChild(button);
	},

	removeFile : function(name, index) {
		$_("div_" + name + index).remove();
	}
}