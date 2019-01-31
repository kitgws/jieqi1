<?php 
	@define('JIEQI_MODULE_NAME', 'pay');
	@define('JIEQI_PAY_TYPE', 'weixin');
	require_once '../../../global.php';
	jieqi_loadlang('pay', 'pay');
	include_once $jieqiModules['pay']['path'] . '/class/paylog.php';
	class order{
		public function do_order($order_id){
			$file  = 'log.txt';//要写入文件的文件名（可以是任意文件名），如果文件不存在，将会创建一个
$content = "sssss";
file_put_contents($file, $content,FILE_APPEND);
			//支付成功，开始进行充值操作
			jieqi_loadlang('pay', JIEQI_MODULE_NAME);
			jieqi_getconfigs(JIEQI_MODULE_NAME, JIEQI_PAY_TYPE, 'jieqiPayset');
			//订单号
			$order_id = $order_id;
			$paylog_handler = JieqiPaylogHandler::getInstance('JieqiPaylogHandler');
			$orderid = intval($order_id);
			$paylog = $paylog_handler->get($orderid);

			if (is_object($paylog)) {
				$buyname = $paylog->getVar('buyname');
				$buyid = $paylog->getVar('buyid');
				$payflag = $paylog->getVar('payflag');
				$egold = $paylog->getVar('egold');
				$money = $paylog->getVar('money');
				if ($payflag == 0) {
					include_once JIEQI_ROOT_PATH . '/class/users.php';
					$users_handler =& JieqiUsersHandler::getInstance('JieqiUsersHandler');
					$paysilver = empty($jieqiPayset[JIEQI_PAY_TYPE]['paysilver']) ? 0 : intval($jieqiPayset[JIEQI_PAY_TYPE]['paysilver']);
					$payscore = empty($jieqiPayset[JIEQI_PAY_TYPE]['payrate']) ? 0 : floor($money * $jieqiPayset[JIEQI_PAY_TYPE]['payrate'] / 100);
					$ret = $users_handler->income($buyid, $egold, $paysilver, $payscore);
					if ($ret) {
						$note = sprintf($jieqiLang['pay']['add_egold_success'], $buyname, JIEQI_EGOLD_NAME, $egold);
					} else {
						$note = sprintf($jieqiLang['pay']['add_egold_failure'], $buyid, $buyname, JIEQI_EGOLD_NAME, $egold);
					}
					$paylog->setVar('rettime', JIEQI_NOW_TIME);
					$paylog->setVar('retserialno', $getvars['trade_no']);
					$paylog->setVar('retaccount', $getvars['buyer_email']);
					$paylog->setVar('retinfo', $getvars['buyer_id']);
					$paylog->setVar('note', $note);
					$paylog->setVar('payflag', 1);
					if (!$paylog_handler->insert($paylog)) {
						if ($showmode) {
							jieqi_printfail($jieqiLang['pay']['save_paylog_failure']);
						}
					} else {
						if ($showmode) {
							jieqi_msgwin(LANG_DO_SUCCESS, sprintf($jieqiLang['pay']['buy_egold_success'], $buyname, JIEQI_EGOLD_NAME, $egold));
						}
					}
				} else {
					if ($showmode) {
						jieqi_msgwin(LANG_DO_SUCCESS, sprintf($jieqiLang['pay']['buy_already_success'], $buyname, JIEQI_EGOLD_NAME, $egold));
					}
				}
			}

		}
	}
?>