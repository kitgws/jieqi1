<?php
//支付宝充值相关参数

$jieqiPayset['alipay']['payid'] = '2088121633642457';  //合作伙伴ID（请输入实际申请的值）

$jieqiPayset['alipay']['paykey'] = 'p7fffdl7czi7jkgfr1wl4tb6jxvjm4pv';  //通讯密钥值（请输入实际申请的值）

$jieqiPayset['alipay']['payurl'] = 'https://mapi.alipay.com/gateway.do';  //提交到支付网站的网址

$jieqiPayset['alipay']['payreturn'] = JIEQI_LOCAL_URL.'/modules/pay/alipayreturn.php';  //本站接收返回的网址

$jieqiPayset['alipay']['payrate'] = 100; //默认充值1元钱兑换虚拟币的值
$jieqiPayset['alipay']['paycustom'] = 0; //是否允许自定义购买金额，0-不允许，1-允许
$jieqiPayset['alipay']['paylimit'] = array('1000'=>'10', '2000'=>'20', '5000'=>'50', '10000'=>'100', '20000'=>'200', '50000'=>'500'); //允许选择的 虚拟币=>金额 选项，如 '1000'=>'10' 是指购买 1000虚拟币需要10元

$jieqiPayset['alipay']['moneytype'] = '0';  //金额类型：0-人民币 1-美元
$jieqiPayset['alipay']['paysilver'] = '0';  //虚拟币类型:0-金币 1-银币(目前无银币功能，请默认设置成0)

//以下私有参数
$jieqiPayset['alipay']['service'] = 'create_direct_pay_by_user';  //交易类型
$jieqiPayset['alipay']['agent'] = '';  //代理商id
$jieqiPayset['alipay']['_input_charset'] = 'GBK';  //字符集
$jieqiPayset['alipay']['subject'] = JIEQI_EGOLD_NAME;  //商品描述
$jieqiPayset['alipay']['payment_type'] = '1';  // 商品支付类型 1＝商品购买 2＝服务购买 3＝网络拍卖 4＝捐赠 5＝邮费补偿 6＝奖金
$jieqiPayset['alipay']['show_url'] = JIEQI_LOCAL_URL;  //商品相关网站公司
$jieqiPayset['alipay']['seller_email'] = '15156188688@163.com';  //卖家邮箱，必须填写
$jieqiPayset['alipay']['sign_type'] = 'MD5';  //签名方式

$jieqiPayset['alipay']['notify_url'] = JIEQI_LOCAL_URL.'/modules/pay/alipayreturn.php'; //本站接收异步返回的网址
$jieqiPayset['alipay']['notifycheck'] = 'http://notify.alipay.com/trade/notify_query.do';  //支付宝通知验证网址

$jieqiPayset['alipay']['addvars'] = array();  //附加参数
?>












