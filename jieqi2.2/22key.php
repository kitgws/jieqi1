<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>���� 2.2 ȫ�汾��Ȩ����ϵͳ</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<style type="text/css">
body {
	background: #C3D9FF;
	color: #000000;
	font-family: ΢���źڣ�����, ��ϸ����, Verdana, Arial, sans-serif;
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
    ���� 2.2 ȫ�汾��Ȩ����ϵͳ
    </caption>
    <tr>
      <td class="odd" width="30%" align="right">˵����</td>
      <td class="even" width="70%" align="left"> 1���Ȱ�װ�ý��� 2.2<br />
        <br />
        2������������������һ���������������ɣ��磺<a href="www.sxxx.net">sxxx.net</a> <br />
        ����Ҫͬʱ��Ȩ�����������"|"�ָ�磺sxxx.net|sxxx.net<br />
        <br />
        3���ύ�����潫��ʾ������Ȩ�룬���Լ���վ��̨ϵͳ��������ġ���վ��Ȩע���롱���������Ȩ�뱣�漴������ʹ�ý���1.7ȫ������<br />
        <br />
        4��֧��Ŀǰ�ٷ�������֪ģ�� </td>
    </tr>
    <tr>
      <td class="odd" align="right">��Ȩ������</td>
      <td class="even" align="left"><input name="domain" type="text" id="domain" size="60" maxlength="100" /></td>
    </tr>
    <tr>
      <td class="odd" align="right">��Ȩ�汾��</td>
      <td class="even" align="left"><select name='val'>
          <option value="FREE">��ѡ����Ҫ��Ȩ�İ汾</option>
          <option value="FREE">��Ѱ�</option>
          <option value="POPULAR">�ռ���</option>
          <option value="Standard">��׼��</option>
          <option value="Profession">רҵ��</option>
          <option value="ENTERPRISE">��ҵ��</option>
          <option value="DELUXE">������</option>
          <option value="CUSTOM">���ư�</option>
        </select></td>
    </tr>
    <tr>
      <td class="odd" align="right">��Ȩ�룺</td>
      <td class="even" align="left"><textarea  name="key" cols="65" rows="13"><?php echo $data; ?></textarea>
      </td>
    </tr>
    <tr>
      <td class="odd" align="right">&nbsp;</td>
      <td class="even" align="left"><input type="submit" name="submit" id="submit" value="����ע����" /></td>
    </tr>
  </table>
</form>
<br />
<br />
</div>
</body>
</html>
