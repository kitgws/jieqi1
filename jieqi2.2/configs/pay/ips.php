<?php
//ips支付相关参数

$jieqiPayset['ips']['payid'] = '123456';  //商户编号

$jieqiPayset['ips']['paykey'] = '123456';  //密钥值

$jieqiPayset['ips']['payurl'] = 'http://pay.ips.com.cn/ipayment.aspx';  //提交到支付网站的网址

$jieqiPayset['ips']['payreturn'] = JIEQI_LOCAL_URL.'/modules/pay/ipsreturn.php';  //本站接收返回的网址

$jieqiPayset['ips']['payrate'] = 100; //默认1元钱兑换虚拟币的值
$jieqiPayset['ips']['paycustom'] = 0; //是否允许自定义购买金额，0-不允许，1-允许
$jieqiPayset['ips']['paylimit'] = array('1000'=>'10', '2000'=>'20', '5000'=>'50', '10000'=>'100', '20000'=>'200', '50000'=>'500'); //允许选择的 虚拟币=>金额 选项，如 '1000'=>'10' 是指购买 1000虚拟币需要10元

$jieqiPayset['ips']['moneytype'] = '0';  //现金类型：0-人民币 1-美元
$jieqiPayset['ips']['paysilver'] = '0';  //虚拟币类型:0-金币 1-银币(目前无银币功能，请默认设置成0)

//以下私有参数

$jieqiPayset['ips']['Currency_Type'] = 'RMB';  //币种 RMB-人民币

$jieqiPayset['ips']['Gateway_Type'] = '01'; //支付卡种 01-人民币 128-信用卡 04-IPS帐户 16-电话 32-手机 1024-手机语音

$jieqiPayset['ips']['Lang'] = 'GB';  //GB 中文 EN 英文

$jieqiPayset['ips']['FailUrl'] = ''; //失败返回URL

$jieqiPayset['ips']['RetEncodeType'] = '17';  //返回验证方式 17-MD5

$jieqiPayset['ips']['OrderEncodeType'] = '5';  //提交验证方式 0-无加密  5-MD5

$jieqiPayset['ips']['Rettype'] = '0';  //返回方式 0-browser 1－server to server

$jieqiPayset['ips']['Attach'] = '';  //附加字符串

$jieqiPayset['ips']['addvars'] = array();  //附加参数
?>