<?php
class test {
	function api(){
		echo 'api';
	}
	function db(){
	jieqi_includedb();
$db_query=JieqiQueryHandler::getInstance('JieqiQueryHandler');
$res=$db_query->execute('SELECT * FROM '.jieqi_dbprefix('system_modules'));
        while($row = $db_query->getRow($res)) $inmodules[] = $row['name'];
var_dump($inmodules);exit;
	}
}
