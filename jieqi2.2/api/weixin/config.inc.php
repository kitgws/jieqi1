<?php

$apiOrder = 1;
$apiName = 'weixin';
$apiTitle = '微信';
$apiConfigs[$apiName] = array();
$apiConfigs[$apiName]['appid'] = 'wx31076e2b4a87f286';
$apiConfigs[$apiName]['appkey'] = '886da27300a7b084c23cd8b745d60617';
$apiConfigs[$apiName]['callback'] = JIEQI_LOCAL_URL . '/api/' . $apiName . '/loginback.php';
$apiConfigs[$apiName]['scope'] = 'snsapi_userinfo';

?>
