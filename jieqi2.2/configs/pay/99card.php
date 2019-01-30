<?php
//快钱充值卡支付相关参数

$jieqiPayset['99card']['payid'] = '123456';  //商户编号

$jieqiPayset['99card']['paykey'] = '000000';  //密钥值

$jieqiPayset['99card']['payurl'] = 'https://www.99bill.com/szxgateway/recvMerchantInfoAction.htm';  //提交到对方的网址

$jieqiPayset['99card']['payreturn'] = JIEQI_LOCAL_URL.'/modules/pay/99cardreturn.php';  //本站接收返回的网址

$jieqiPayset['99card']['payrate'] = 100; //默认1元钱兑换虚拟币的值
$jieqiPayset['99card']['paycustom'] = 0; //是否允许自定义购买金额，0-不允许，1-允许
$jieqiPayset['99card']['paylimit'] = array('1000'=>'10', '1500'=>'15', '2000'=>'20', '3000'=>'30', '5000'=>'50', '10000'=>'100', '30000'=>'300', '50000'=>'500'); //允许选择的 虚拟币=>金额 选项，如 '1000'=>'10' 是指购买 1000虚拟币需要10元

$jieqiPayset['99card']['moneytype'] = '0';  //现金类型：0-人民币 1-美元
$jieqiPayset['99card']['paysilver'] = '0';  //虚拟币类型:0-金币 1-银币(目前无银币功能，请默认设置成0)

//以下私有参数
$jieqiPayset['99card']['inputCharset'] = '2'; //字符集,可为空。1代表UTF-8; 2代表GBK; 3代表gb2312 默认值为1

$jieqiPayset['99card']['version'] = 'v2.0';  //本代码版本号固定为v2.0

$jieqiPayset['99card']['language'] = '1';  //1代表中文；2代表英文 默认值为1

$jieqiPayset['99card']['signType'] = '1'; //1代表MD5签名 当前版本固定为1

$jieqiPayset['99card']['payType'] = '42';  //41-快钱账户 42-默认，卡密和快钱账户 51-卡密支付

$jieqiPayset['99card']['fullAmountFlag'] = '0';  //0代表卡面额小于订单金额时返回支付结果为失败；1代表卡面额小于订单金额是返回支付结果为成功，同时订单金额和实际支付金额都为神州行卡的面额.如果商户定制神州行卡密直连时，本参数固定值为1

$jieqiPayset['99card']['ext1'] = '';  //扩展字段1

$jieqiPayset['99card']['ext2'] = '';  //扩展字段2

$jieqiPayset['99card']['bossType'] = '9';  //卡类型: 0-神州行 1-联通 3-电信 4-骏网一卡通 9-任意卡类型

$jieqiPayset['99card']['addvars'] = array();  //附加参数
?>