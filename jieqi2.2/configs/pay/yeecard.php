<?php
//易宝点卡支付相关参数

$jieqiPayset['yeecard']['payid'] = '123456';  //合作伙伴ID（请输入实际申请的值）

$jieqiPayset['yeecard']['paykey'] = '000000';  //通讯密钥值（请输入实际申请的值）

$jieqiPayset['yeecard']['payurl'] = 'https://www.yeepay.com/app-merchant-proxy/command.action';  //提交到对方的网址

$jieqiPayset['yeecard']['payreturn'] = JIEQI_LOCAL_URL.'/modules/pay/yeecardreturn.php';  //接收返回的地址 (www.domain.com 是指你的网址)

if(in_array($_REQUEST['cardtype'], array('SZX', 'UNICOM', 'TELECOM'))){
	$jieqiPayset['yeecard']['payrate'] = 85; //默认1元钱兑换虚拟币的值
}else{
	$jieqiPayset['yeecard']['payrate'] = 75; //默认1元钱兑换虚拟币的值
}
$jieqiPayset['yeecard']['paycustom'] = 1; //是否允许自定义购买金额，0-不允许，1-允许
$jieqiPayset['yeecard']['paylimit'] = array(); //允许选择的 虚拟币=>金额 选项，如 '1000'=>'10' 是指购买 1000虚拟币需要10元

$jieqiPayset['yeecard']['moneytype'] = '0';  //现金类型：0-人民币 1-美元
$jieqiPayset['yeecard']['paysilver'] = '0';  //虚拟币类型:0-金币 1-银币(目前无银币功能，请默认设置成0)

//以下私有参数
$jieqiPayset['yeecard']['messageType'] = 'ChargeCardDirect';  //业务类型

$jieqiPayset['yeecard']['verifyAmt'] = 'true';  //是否较验订单金额 值：true校验金额;  false不校验金额，

$jieqiPayset['yeecard']['productId'] = JIEQI_EGOLD_NAME;  //商品名

$jieqiPayset['yeecard']['productDesc'] = JIEQI_EGOLD_NAME;  //商品描述

$jieqiPayset['yeecard']['productCat'] = '';  //商品种类

$jieqiPayset['yeecard']['sMctProperties'] = '';  //附加参数

$jieqiPayset['yeecard']['frpId'] = '';  //支付渠道编码

$jieqiPayset['yeecard']['needResponse'] = '1';  //是否需要应答机制，默认或"0"为不需要,"1"为需要

$jieqiPayset['yeecard']['pz_userId'] = '';  //用户在商户处的唯一ID

$jieqiPayset['yeecard']['pz1_userRegTime'] = '';  //用户注册时间

$jieqiPayset['yeecard']['addvars'] = array();  //附加参数

?>