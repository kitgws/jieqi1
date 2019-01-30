<?php
//zhifuka支付相关参数

$jieqiPayset['zhifuka']['payid']='123456';  //商户编号

$jieqiPayset['zhifuka']['paykey']='******';  //密钥值

$jieqiPayset['zhifuka']['payurl']='http://202.75.218.94/gateway/zfgateway.asp';  //提交到对方的网址

$jieqiPayset['zhifuka']['payreturn']='http://www.domain.com/modules/pay/zhifukareturn.php';  //接收返回的地址 (www.domain.com 是指你的网址)


//设置不同类型的卡，支付金额对应多少虚拟币，默认至少设置一个1元钱对应多少虚拟币，1元以上的金额可以不设置，自动按照1元的比例换算
//如设置 'zfk'=>array(1=>100)，表示51支付卡默认每元充值100点虚拟币，如果是5元则500点，10元则1000点
//如设置 'zfk'=>array(1=>100, 10=>1200)，表示51支付卡每元充值100点虚拟币，如果是5元则500点，10元则1200点(注意：5元是因为没有具体的对应设置，所以按1元多少比例换算，而10元是单独设定了对应多少虚拟币，则以设定为准)
$jieqiPayset['zhifuka']['cardegold'] = array(
//zfk-51支付卡 
'zfk'=>array(1=>100),
//szx-神州行
'szx'=>array(1=>100),
//qqb-Q币卡
'qqb'=>array(1=>100),
//sdk-盛大卡
'sdk'=>array(1=>100),
//ztk-征途卡
'ztk'=>array(1=>100),
//shk-搜狐卡
'shk'=>array(1=>100),
//517-5173卡支付
'517'=>array(1=>100),
//jyk-久游卡
'jyk'=>array(1=>100),
//jwk-骏网卡
'jwk'=>array(1=>100),
//rxk-热血传奇卡支付
'rxk'=>array(1=>100),
//msk-魔兽世界卡支付
'msk'=>array(1=>100),
//wmk-完美卡支付
'wmk'=>array(1=>100),
//ltk-联通卡支付
'ltk'=>array(1=>100)
);

//支付增加积分
//$jieqiPayset['zhifuka']['payscore']=array('1000'=>'100', '2000'=>'200', '3000'=>'300', '5000'=>'500', '10000'=>'1000');

$jieqiPayset['zhifuka']['moneytype']='0';  //0 人民币 1表示美元

$jieqiPayset['zhifuka']['paysilver']='0';  //0 表示充值成金币 1表示银币

$jieqiPayset['zhifuka']['addvars']=array();  //附加参数
?>