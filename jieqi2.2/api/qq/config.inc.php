<?php
//QQ登录接口参数设置
//未申请QQ登录接口账号的，请到 http://connect.opensns.qq.com/ 提交申请

$apiOrder = 1; //接口序号，请勿修改
$apiName = 'qq'; //接口名，请勿修改
$apiTitle = 'QQ'; //接口标题，请勿修改

$apiConfigs[$apiName] = array(); //初始化参数数组，请勿修改

$apiConfigs[$apiName]['appid'] = '101363181';  //应用ID，根据实际申请的值修改

$apiConfigs[$apiName]['appkey'] = '13633571c400845888d94529809a8c98';  //接口密钥，根据实际申请的值修改

$apiConfigs[$apiName]['callback'] = JIEQI_LOCAL_URL.'/api/'.$apiName.'/loginback.php';  //登录后返回的本站地址，请勿修改

$apiConfigs[$apiName]['scope'] = 'get_user_info,add_share,list_album,add_album,upload_pic,add_topic,add_one_blog,add_weibo'; //允许授权哪些api接口，用英文逗号分隔

?>