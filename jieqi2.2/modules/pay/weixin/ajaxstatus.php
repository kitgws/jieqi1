<?php 
	require_once '../../../global.php';
	include_once $jieqiModules['pay']['path'] . '/class/paylog.php';
	$paylog_handler = JieqiPaylogHandler::getInstance('JieqiPaylogHandler');
	$orderid = intval($getvars['out_trade_no']);
	$orderid = $_GET['order_id'];
	$paylog = $paylog_handler->get($orderid);
	if( $paylog->getVar('payflag') != 0 ){
		echo 'true';
	}
?>