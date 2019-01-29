<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>杰奇 2.2 全版本授权生成系统</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<style type="text/css">
body {
	background: #C3D9FF;
	color: #000000;
	font-family: 微软雅黑，宋体, 新细明体, Verdana, Arial, sans-serif;
	font-size: 12px;
	text-align: center;
}
table.grid {
	border-collapse: collapse;
	border: 1px solid #b5d7ef;
	padding: 3px;
	margin: auto;
}
table.grid caption, .gridtop {
	border-top: 1px solid #b5d7ef;
	border-left: 1px solid #b5d7ef;
	border-right: 1px solid #b5d7ef;
	background: #e0edff;
	vertical-align: middle;
	text-align: center;
	color:#054e86;
	font-weight: bold;
	font-size: 14px;
	margin: auto;
	height: 28px;
	line-height: 28px;
}
table.grid td {
	border: 1px solid #b5d7ef;
	padding: 3px;
	background-color: #ffffff;
}
.odd {
	background: #FFFFFF;
	padding: 3px;
}
.even {
	background: #FFFFFF;
	padding: 3px;
}
</style>
</head>
<?php

if(isset($_POST['submit']))
{
		$domain=strtolower($_POST['domain']);
		$leibiao=strtolower($_POST['val']);
		$system="system=$leibiao|forum=$leibiao|article=$leibiao|obook=$leibiao|pay=$leibiao|wap=$leibiao|waparticle=$leibiao|wapforum=$leibiao|badge=$leibiao|group=$leibiao|space=$leibiao|info=$leibiao|cartoon=$leibiao|quiz=$leibiao|news=$leibiao|product=$leibiao|team=$leibiao|vote=$leibiao|note=$leibiao|link=$leibiao";
		$tmp1=base64_encode($domain);
		$tmp2=base64_encode($system);
		//$tmp0=base64_encode(md5($domain.$system."jnyzn090211"));
		$tmp0=base64_encode(md5($domain.$system."ycjpJ52topxydHgLP17",true));
		$key=$tmp0."=@".$tmp1."=@".$tmp2;
		$data=$key;
}
?>
<body>
<form  method="post" action="">
  <table class="grid" width="700">
    <caption>
    杰奇 2.2 全版本授权生成系统
    </caption>
    <tr>
      <td class="odd" width="30%" align="right">说明：</td>
      <td class="even" width="70%" align="left"> 1、先安装好杰奇 2.2<br />
        <br />
        2、请输入您的域名，一般输入主域名即可，如：<a href="www.sxxx.net">sxxx.net</a> <br />
        若需要同时授权多个域名，用"|"分割，如：sxxx.net|sxxx.net<br />
        <br />
        3、提交后下面将显示您的授权码，在自己网站后台系统定义里面的“网站授权注册码”这项，输入授权码保存即可正常使用杰奇1.7全部功能<br />
        <br />
        4、支持目前官方所有已知模块 </td>
    </tr>
    <tr>
      <td class="odd" align="right">授权域名：</td>
      <td class="even" align="left"><input name="domain" type="text" id="domain" size="60" maxlength="100" /></td>
    </tr>
    <tr>
      <td class="odd" align="right">授权版本：</td>
      <td class="even" align="left"><select name='val'>
          <option value="FREE">请选择需要授权的版本</option>
          <option value="FREE">免费版</option>
          <option value="POPULAR">普及版</option>
          <option value="Standard">标准版</option>
          <option value="Profession">专业版</option>
          <option value="ENTERPRISE">企业版</option>
          <option value="DELUXE">豪华版</option>
          <option value="CUSTOM">定制版</option>
        </select></td>
    </tr>
    <tr>
      <td class="odd" align="right">授权码：</td>
      <td class="even" align="left"><textarea  name="key" cols="65" rows="13"><?php echo $data; ?></textarea>
      </td>
    </tr>
    <tr>
      <td class="odd" align="right">&nbsp;</td>
      <td class="even" align="left"><input type="submit" name="submit" id="submit" value="生成注册码" /></td>
    </tr>
  </table>
</form>
<br />
<br />
</div>
</body>
</html>
