<?php
require_once('../global.php');
/*
jieqi_getconfigs('system', 'configs');
include_once(JIEQI_ROOT_PATH.'/lib/database/mysql/db.php');
$db_query=new JieqiMySQLDatabase();
$host = 'localhost';
$user = '';
$pass = '';
$name = '';
$isconnect = $db_query->connect($host, $user, $pass, $name, false);
var_dump($isconnect);exit;
*/
/*
jieqi_includedb();
$db_query=JieqiQueryHandler::getInstance('JieqiQueryHandler');
$res=$db_query->execute('SELECT * FROM '.jieqi_dbprefix('system_modules'));
	while($row = $db_query->getRow($res)) $inmodules[] = $row['name'];
var_dump($inmodules);exit;
*/
echo 'ok';
