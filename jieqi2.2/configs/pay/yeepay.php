<?php
//易宝网银支付相关参数

$jieqiPayset['yeepay']['payid'] = '10012408238';  //合作伙伴ID（请输入实际申请的值）

$jieqiPayset['yeepay']['paykey'] = '54928G080r86S64B77a5Z45DA4U6IT61hd2189x040o758QA8L0rypj96K09';  //通讯密钥值（请输入实际申请的值）

$jieqiPayset['yeepay']['payurl'] = 'https://www.yeepay.com/app-merchant-proxy/node';  //提交到支付网站的网址

$jieqiPayset['yeepay']['payreturn'] = JIEQI_LOCAL_URL.'/modules/pay/yeepayreturn.php';  //本站接收返回的网址

$jieqiPayset['yeepay']['payrate'] = 100; //默认1元钱兑换虚拟币的值
$jieqiPayset['yeepay']['paycustom'] = 0; //是否允许自定义购买金额，0-不允许，1-允许
$jieqiPayset['yeepay']['paylimit'] = array('1000'=>'10', '2000'=>'20', '5000'=>'50', '10000'=>'100', '20000'=>'200', '50000'=>'500'); //允许选择的 虚拟币=>金额 选项，如 '1000'=>'10' 是指购买 1000虚拟币需要10元

$jieqiPayset['yeepay']['moneytype'] = '0';  //现金类型：0-人民币 1-美元
$jieqiPayset['yeepay']['paysilver'] = '0';  //虚拟币类型:0-金币 1-银币(目前无银币功能，请默认设置成0)

//以下私有参数
$jieqiPayset['yeepay']['addressFlag'] = '0';  //需要填写送货信息 0：不需要  1:需要

$jieqiPayset['yeepay']['messageType'] = 'Buy';  //业务类型

$jieqiPayset['yeepay']['cur'] = 'CNY';  //货币单位

$jieqiPayset['yeepay']['productId'] = JIEQI_EGOLD_NAME;  //商品名

$jieqiPayset['yeepay']['productDesc'] = JIEQI_EGOLD_NAME;  //商品描述

$jieqiPayset['yeepay']['productCat'] = '';  //商品种类

$jieqiPayset['yeepay']['sMctProperties'] = '';  //附加参数

$jieqiPayset['yeepay']['frpId'] = '';  //附加参数

$jieqiPayset['yeepay']['needResponse'] = '0';  //是否需要应答机制，默认或"0"为不需要,"1"为需要

$jieqiPayset['yeepay']['addvars'] = array();  //附加参数

?>