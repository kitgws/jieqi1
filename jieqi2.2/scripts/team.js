// JavaScript Document
<!--
//***************************全屏变灰弹出对话框******************************
//层显示的位置 x坐标
function findPosX(obj){
var _22=0;
if(obj.offsetParent){
while(obj.offsetParent){
_22+=obj.offsetLeft;
obj=obj.offsetParent;
}
}else{
if(obj.x){
_22+=obj.x;
}
}
return _22;
}

//层的位置 y坐标
function findPosY(obj){
var _24=0;
if(obj.offsetParent){
while(obj.offsetParent){
_24+=obj.offsetTop;
obj=obj.offsetParent;
}
}else{
if(obj.y){
_24+=obj.y;
}
}
return _24;
}


function doBgDisabled()
{
   var sWidth,sHeight;
   sWidth=document.documentElement.scrollWidth;
   sHeight=screen.height;

   bgObj=document.createElement("div");
   bgObj.style.position="absolute";
   bgObj.style.top="0";
   bgObj.style.background="#CCCCCC";
   bgObj.style.filter="progid:DXImageTransform.Microsoft.Alpha(style=3,opacity=25,finishOpacity=75";
   bgObj.style.opacity="0.6";
   bgObj.style.left="0";
   bgObj.style.width=sWidth + "px";
   bgObj.style.height=sHeight + "px";
   bgObj.style.zIndex = "999";
   document.body.appendChild(bgObj);
}

function removeBgDisabled() 
{
   document.body.removeChild(bgObj);
}

//**********

var bodyclick = true;
function showpan(xDiv,yDiv,MainDiv,Height,hid,url)
{
	if (!hid)
		hid="";
	if (!url)
		url="";
	doBgDisabled();
 
	var x = findPosX(document.getElementById(xDiv));
	var y = findPosY(document.getElementById(yDiv));
	//alert(MainDiv);
	document.getElementById(MainDiv).style.left = x + 80 + "px";
	document.getElementById(MainDiv).style.top = y + Height + "px";
	document.getElementById(MainDiv).style.display = "block";
	$_('ifr').src=url+hid;
	bodyclick = true;
}
function hidepan(MainDiv,url)
{
	if (!url)
		url="";
	else
		window.location.href=url;
	document.getElementById(MainDiv).style.display = "none";
	removeBgDisabled();
}

//********************************************************************
-->