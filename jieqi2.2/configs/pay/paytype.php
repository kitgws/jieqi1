<?php
//在线支付的类型设定

$jieqiPaytype['manual'] = array('name' => '人工操作', 'shortname' => '人工', 'description'=>'', 'url' => '', 'link'=>'buyegold.php?t=manual', 'publish' => 1);

$jieqiPaytype['bank'] = array('name' => '银行汇款', 'shortname' => '银行', 'description'=>'', 'url' => '', 'link'=>'buyegold.php?t=remitpay', 'publish' => 1);

$jieqiPaytype['post'] = array('name' => '邮局汇款', 'shortname' => '邮局', 'description'=>'', 'url' => '', 'link'=>'buyegold.php?t=remitpay', 'publish' => 1);

$jieqiPaytype['alipay'] = array('name' => '支付宝支付', 'shortname' => '支付宝', 'description'=>'', 'url' => 'http://www.alipay.com', 'link'=>'buyegold.php?t=alipaypay', 'publish' => 1);

$jieqiPaytype['yeepay'] = array('name' => '易宝网银支付', 'shortname' => '易宝网银', 'description'=>'', 'url' => 'http://www.yeepay.com', 'link'=>'buyegold.php?t=yeepaypay', 'publish' => 1);

$jieqiPaytype['yeecard'] = array('name' => '易宝点卡支付', 'shortname' => '易宝点卡', 'description'=>'', 'url' => 'http://www.yeepay.com', 'link'=>'buyegold.php?t=yeecardpay', 'publish' => 1);

$jieqiPaytype['paypal'] = array('name' => 'PayPal支付', 'shortname' => 'PayPal', 'description'=>'', 'url' => 'http://www.paypal.com', 'link'=>'buyegold.php?t=paypalpay', 'publish' => 1);

$jieqiPaytype['99bill'] = array('name' => '快钱在线支付', 'shortname' => '快钱在线', 'description'=>'', 'url' => 'http://www.99bill.com', 'link'=>'buyegold.php?t=99billpay', 'publish' => 1);

$jieqiPaytype['99card'] = array('name' => '快钱神州行卡支付', 'shortname' => '快钱神州行', 'description'=>'', 'url' => 'https://www.99bill.com', 'link'=>'buyegold.php?t=99cardpay', 'publish' => 1);

$jieqiPaytype['chinabank'] = array('name' => '网银支付', 'shortname' => '网银', 'description'=>'', 'url' => 'http://www.chinabank.com.cn', 'link'=>'buyegold.php?t=chinabankpay', 'publish' => 1);

$jieqiPaytype['ips'] = array('name' => 'ips支付', 'shortname' => 'ips', 'description'=>'', 'url' => 'http://www.ips.com.cn', 'link'=>'buyegold.php?t=ipspay', 'publish' => 1);

$jieqiPaytype['paycard'] = array('name' => '点卡支付', 'shortname' => '点卡', 'description'=>'', 'url' => '', 'link'=>'paycardpay.php', 'publish' => 1);

$jieqiPaytype['sndacard'] = array('name' => '盛大卡支付', 'shortname' => '盛大卡', 'description'=>'', 'url' => 'http://www.snda.com.cn', 'link'=>'buyegold.php?t=sndacardpay', 'publish' => 1);

$jieqiPaytype['tenpay'] = array('name' => '腾讯财付通支付', 'shortname' => '财付通', 'description'=>'', 'url' => 'https://www.tenpay.com', 'link'=>'buyegold.php?t=tenpaypay', 'publish' => 1);


?>