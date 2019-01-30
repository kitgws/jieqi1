<?php
//paypal支付相关参数

$jieqiPayset['paypal']['payid'] = '123456';  //收款账号

$jieqiPayset['paypal']['paykey'] = '000000';  //密钥值

$jieqiPayset['paypal']['payurl'] = 'https://www.paypal.com/cgi-bin/webscr';  //提交到对方的网址

$jieqiPayset['paypal']['payreturn'] = JIEQI_LOCAL_URL.'/modules/pay/paypalreturn.php';  //本站接收返回的网址

$jieqiPayset['paypal']['paynotify'] = JIEQI_LOCAL_URL.'/modules/pay/paypalnotify.php';  //返回通知的网址

$jieqiPayset['paypal']['payrate'] = 600; //默认1元钱兑换虚拟币的值
$jieqiPayset['paypal']['paycustom'] = 0; //是否允许自定义购买金额，0-不允许，1-允许
$jieqiPayset['paypal']['paylimit'] = array('6000'=>'10', '12000'=>'20', '30000'=>'50', '60000'=>'100'); //允许选择的 虚拟币=>金额 选项，如 '1000'=>'10' 是指购买 1000虚拟币需要10元

$jieqiPayset['paypal']['moneytype'] = '1';  //现金类型：0-人民币 1-美元
$jieqiPayset['paypal']['paysilver'] = '0';  //虚拟币类型:0-金币 1-银币(目前无银币功能，请默认设置成0)

//以下私有参数
$jieqiPayset['paypal']['cmd'] = '_xclick';  //支付命令

$jieqiPayset['yeepay']['item_name'] = JIEQI_EGOLD_NAME;  //商品名

$jieqiPayset['paypal']['currency_code'] = 'USD';  //货币类型 USD-美元

$jieqiPayset['paypal']['rm'] = '1'; //支付成功返回时候是否返回提交过去的参数（GET方式）1-返回参数 0-不返回

$jieqiPayset['paypal']['cancel_return'] = JIEQI_LOCAL_URL.'/modules/pay/paypal.php';  //取消购买返回地址

$jieqiPayset['paypal']['no_shipping'] = '1'; //有没有收货地址,1-不需要收货地址 0-需要收货地址

$jieqiPayset['paypal']['no_note'] = '1';  //为付款加入提示。如果设为 "1"，则不会提示您的客户输入提示。该变量为可选项；如果省略或设为 "0"，将提示您的客户输入提示。

$jieqiPayset['paypal']['image_url'] = ''; //显示本站支付的图片，150*50

$jieqiPayset['paypal']['addvars'] = array();  //附加参数
?>