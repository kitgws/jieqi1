<?php
//淘宝登录接口参数设置
//未申请淘宝登录接口账号的，请到 http://open.taobao.com/ 提交申请

$apiOrder = 5; //接口序号，请勿修改
$apiName = 'taobao'; //接口名，请勿修改
$apiTitle = '淘宝'; //接口标题，请勿修改

$apiConfigs[$apiName] = array(); //初始化参数数组，请勿修改

$apiConfigs[$apiName]['appid'] = '21363839';  //应用ID，根据实际申请的值修改

$apiConfigs[$apiName]['appkey'] = '05a9eea2c545bbb5adbeb1a9a1ebc57c';  //接口密钥，根据实际申请的值修改

$apiConfigs[$apiName]['callback'] = JIEQI_LOCAL_URL.'/api/'.$apiName.'/loginback.php';  //登录后返回的本站地址，请勿修改

$apiConfigs[$apiName]['scope'] = ''; //允许授权哪些api接口，用英文逗号分隔
?>