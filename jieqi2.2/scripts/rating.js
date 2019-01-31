var rate_image_url = '/images/rate/ratestar.gif'; //����ͼƬ��Ե�ַ
var rate_star_width = 15; //�����ǿ�ȣ�����ͼƬ���޸����
var rate_star_height = 15; //�����Ǹ߶ȣ�����ͼƬ���޸����
var rate_star_max = 10; //Ĭ����༸���ǣ�����showRating���ò�������
var rate_root_url = ''; //��վ��·��URL��Ĭ�Ͽ������գ������Զ��ж�
var rate_css_load = false; //CSS�����־���Զ��ж�
var rate_url_check = false; //���ͼƬURL��־���Զ��ж�

//��ʾ�Ǽ�����Ч��(���ֱ������)
//����1����������߼��֣��� 10��
//����2��С������ǰ���֣��� 8.5��
//����3���ַ�����������õĺ�������Ĭ�Ϻ������ǡ�rating����
//����4���ַ������������õĸ��Ӳ�����Ĭ��Ϊ�գ�
//���ӣ� showRating(10, 8.5, 'myrating', 'article');  ���10���ǵ�����Ч���������������ǣ�����ú��� myrating(5, 'article');
function showRating(){
	checkRootURl();

	var maxscore = 10;
	var nowscore = 0;
	var funname = 'rating';
	var funvars = '';
	if(arguments.length >= 1) maxscore = parseInt(arguments[0]);
	if(arguments.length >= 2) nowscore = parseFloat(arguments[1]);
	if(arguments.length >= 3) funname = arguments[2];
	if(arguments.length >= 4) funvars = arguments[3];
	if(maxscore < 1) maxscore = 1;
	if(maxscore > rate_star_max) rate_star_max = maxscore;
	if(funvars != '') funvars = ", " + funvars;
	var ratewidth = maxscore * rate_star_width;
	var spercent = nowscore * 100 / maxscore;
	
	loadRateCSS();

	var html = "<ul style=\"width: " + ratewidth + "px;\" class=\"rateunit\"><li style=\"width:" + spercent + "%;\" class=\"rpercent\"></li>";
	for(var i=1; i<=maxscore; i++){
		html += "<li><a href=\"javascript:;\" onclick=\"" + funname + "(" + i + "" + funvars + ");\" style=\"position: absolute;\" class=\"r" + i + "\" title=\" (" + i + ") \">" + i + "</a></li>";
	}
	html += "</ul>";
	document.write(html);
}

//��ʾ�Ǽ�����Ч��(���ѡ�У���ֵ��input hidden)
//����1����������߼��֣��� 10��
//����2��С����Ĭ�ϼ��֣��� 5��
//����3���ַ�������ֵ��input��
//���ӣ� showRateSelect(10, 5, 'rate');
function showRateSelect(){
	checkRootURl();

	var maxscore = 10;
	var nowscore = 0;
	if(arguments.length >= 1) maxscore = parseInt(arguments[0]);
	if(arguments.length >= 2) nowscore = parseFloat(arguments[1]);
	if(arguments.length >= 3) inputname = arguments[2];

	if(maxscore < 1) maxscore = 1;
	if(maxscore > rate_star_max) rate_star_max = maxscore;
	var ratewidth = maxscore * rate_star_width;
	var spercent = nowscore * 100 / maxscore;
	
	loadRateCSS();

	var html = "<ul style=\"width: " + ratewidth + "px;\" class=\"rateunit\"><li style=\"width:" + spercent + "%;\" class=\"rpercent\"></li>";
	for(var i=1; i<=maxscore; i++){
		html += "<li><a href=\"javascript:;\" onclick=\"rateSelectClick(this, " + i + "," + maxscore + ");\" style=\"position: absolute;\" class=\"r" + i + "\" title=\" (" + i + ") \">" + i + "</a></li>";
	}
	html += "</ul><input type=\"hidden\" name=\""+inputname+"\" value=\""+nowscore+"\" />";
	document.write(html);
}

//���溯����ֺ�ı�inputֵ
function rateSelectClick(obj, nowscore, maxscore){
	obj.parentNode.parentNode.childNodes[0].style.width = (nowscore * 100 / maxscore) + "%";
	obj.parentNode.parentNode.nextSibling.value = nowscore;
}


//��ʾ�Ǽ����ֽ��������������ɣ�������������ֵ����
//����1����������߼��֣��� 10��
//����2��С������ǰ���֣��� 8.5��
function showRateStar(){
	checkRootURl();

	var maxscore = 10;
	var nowscore = 0;
	var funname = 'rating';
	var funvars = '';
	if(arguments.length >= 1) maxscore = parseInt(arguments[0]);
	if(arguments.length >= 2) nowscore = parseFloat(arguments[1]);
	if(maxscore < 1) maxscore = 1;
	if(maxscore > rate_star_max) rate_star_max = maxscore;
	var ratewidth = maxscore * rate_star_width;
	var spercent = nowscore * 100 / maxscore;
	
	loadRateCSS();

	var html = "<ul style=\"width: " + ratewidth + "px;\" class=\"rateunit\"><li style=\"width:" + spercent + "%;\" class=\"rpercent\"></li>";
	html += "</ul>";
	document.write(html);
}

//�����վ��URL
function checkRootURl(){
	if (rate_url_check) return true;
	var scripts = document.getElementsByTagName('script');
	for (var i=0; i<scripts.length; i++) {
		if(scripts[i].src.indexOf('/scripts/rating') != -1){
			rate_root_url = scripts[i].src.substr(0, scripts[i].src.indexOf('/scripts/rating'));
			break;
		}
	}
	if(rate_root_url != '') rate_image_url = rate_root_url + rate_image_url;
	rate_url_check = true;
	return true;
}

//����CSS
function loadRateCSS(){
	if (rate_css_load) return true;
	var divheight = rate_star_height + 5;
	var fonttxt = rate_star_height - 3;
	var fontnum = rate_star_height + 1;
	var style = "";
	style +=".ratediv{font-size:" + fonttxt + "px; height:" + divheight + "px;line-height:" + divheight + "px;text-align:left;}\n";
	style +=".ratenum{font-size:" + fontnum + "px; font-weight:bold;color: #ff5a00;margin-left:5px;}\n";
	style +=".rateblock {display:block; text-align:left; float:left;}\n";
	style +=".rateunit {list-style:none; margin: 0px; padding:0px; height: " + rate_star_height + "px; position: relative; background: url('" + rate_image_url + "') top left repeat-x; font-size:0px; line-height:0px;}\n";
	style +=".rateunit li{text-indent: -4500px; padding:0px; margin:0px; float: left; height: " + rate_star_height + "px; font-size:0px; line-height:0px;}\n";
	style +=".rateunit li a {outline: none; display:block; width:" + rate_star_width + "px; height: " + rate_star_height + "px; text-decoration: none; text-indent: -4500px; z-index: 20; position: absolute; padding: 0px; font-size:0px;}\n";
	style +=".rateunit li a:hover{position:static;top:0px;left:0px;background: url('" + rate_image_url + "') left center; z-index: 10; left: 0px; height: " + rate_star_height + "px;}\n";
	var starlen = 0;
	for(var i=1; i<=rate_star_max; i++){
		style +=".rateunit a.r" + i + "{left: " + starlen + "px;}\n";
		starlen += rate_star_width;
		style +=".rateunit a.r" + i + ":hover{width:" + starlen + "px;}\n";
	}
	style +=".rateunit li.rpercent{background: url('" + rate_image_url + "') left bottom; position: absolute; height: " + rate_star_height + "px; display: block; text-indent: -4500px; z-index: 1; font-size:0px; line-height:0px;}\n";

	if (document.all){
		var oStyle=document.styleSheets[0];
		var a=style.split("\n");	
		for(var i=0;i<a.length;i++){
			if(a[i]=="")continue;
			var ad=a[i].replace(/([\s\S]*)\{([\s\S]*)\}/,"$1|$2").split("|");
			oStyle.addRule(ad[0],ad[1]);
		}
	}else{
		var styleobj = document.createElement('style');
		styleobj.type = 'text/css';
		styleobj.innerHTML=style;
		document.getElementsByTagName('HEAD').item(0).appendChild(styleobj);
	}
	rate_css_load = true;
	return true;
}