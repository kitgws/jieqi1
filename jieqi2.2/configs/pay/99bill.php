<?php
//快钱网银支付相关参数

$jieqiPayset['99bill']['payid'] = '10012408238';  //商户编号

$jieqiPayset['99bill']['paykey'] = '54928G080r86S64B77a5Z45DA4U6IT61hd2189x040o758QA8L0rypj96K09';  //密钥值

$jieqiPayset['99bill']['payurl'] = 'https://www.99bill.com/gateway/recvMerchantInfoAction.htm';  //提交到支付网站的网址

$jieqiPayset['99bill']['payreturn'] = JIEQI_LOCAL_URL.'/modules/pay/99billreturn.php';  //本站接收返回的网址

$jieqiPayset['99bill']['payrate'] = 100; //默认1元钱兑换虚拟币的值
$jieqiPayset['99bill']['paycustom'] = 0; //是否允许自定义购买金额，0-不允许，1-允许
$jieqiPayset['99bill']['paylimit'] = array('1000'=>'10', '2000'=>'20', '5000'=>'50', '10000'=>'100', '20000'=>'200', '50000'=>'500'); //允许选择的 虚拟币=>金额 选项，如 '1000'=>'10' 是指购买 1000虚拟币需要10元

$jieqiPayset['99bill']['moneytype'] = '0';  //现金类型：0-人民币 1-美元
$jieqiPayset['99bill']['paysilver'] = '0';  //虚拟币类型:0-金币 1-银币(目前无银币功能，请默认设置成0)

//以下私有参数
$jieqiPayset['99bill']['inputCharset'] = '2'; //字符集,可为空。1代表UTF-8; 2代表GBK; 3代表gb2312 默认值为1

$jieqiPayset['99bill']['version'] = 'v2.0';  //本代码版本号固定为v2.0

$jieqiPayset['99bill']['language'] = '1';  //1代表中文；2代表英文 默认值为1

$jieqiPayset['99bill']['signType'] = '1'; //1代表MD5签名 当前版本固定为1

///只能选择00、10、11、12、13、14
///00：组合支付（网关支付页面显示快钱支持的各种支付方式，推荐使用）10：银行卡支付（网关支付页面只显示银行卡支付）.11：电话银行支付（网关支付页面只显示电话支付）.12：快钱账户支付（网关支付页面只显示快钱账户支付）.13：线下支付（网关支付页面只显示线下支付方式）.14：B2B支付（网关支付页面只显示B2B支付，但需要向快钱申请开通才能使用）
$jieqiPayset['99bill']['payType'] = '00';

$jieqiPayset['99bill']['fullAmountFlag'] = '0';  //0代表卡面额小于订单金额时返回支付结果为失败；1代表卡面额小于订单金额是返回支付结果为成功，同时订单金额和实际支付金额都为神州行卡的面额.如果商户定制神州行卡密直连时，本参数固定值为1

$jieqiPayset['99bill']['ext1'] = '';  //扩展字段1

$jieqiPayset['99bill']['ext2'] = '';  //扩展字段2

$jieqiPayset['99bill']['addvars'] = array();  //附加参数
?>