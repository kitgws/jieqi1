<?php 
//提供给第三方的接口的入口文件
require_once('../global.php');
include_once(JIEQI_ROOT_PATH.'/api/class/api.class.php');
$api = new api();
$api->run();


?>
