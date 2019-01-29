<?php

function jieqi_apiuser_bind($isregister = 0)
{
	global $query;
	global $apiName;
	global $apiOrder;
	global $apiConfigs;
	$apiField = jieqi_dbslashes($apiName) . 'id';
	$apiOrder = intval($apiOrder);

	if (!is_a($query, 'JieqiQueryHandler')) {
		jieqi_includedb();
		$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');
	}

	$sql = 'SELECT * FROM ' . jieqi_dbprefix('system_userapi') . ' WHERE uid = ' . intval($_SESSION['jieqiUserId']) . ' LIMIT 0, 1';
	$query->execute($sql);
	$row = $query->getRow();
	$apiflag = pow(2, $apiOrder - 1);

	if (is_array($row)) {
		$apiflag = $row['apiflag'] | $apiflag;
		$apidata = jieqi_unserialize($row['apidata']);
		$apidata[$apiName] = array('expire_in' => $_SESSION['jieqiUserApi'][$apiName]['expire_in'], 'access_token' => $_SESSION['jieqiUserApi'][$apiName]['access_token'], 'openid' => $_SESSION['jieqiUserApi'][$apiName]['openid'], 'openkey' => $_SESSION['jieqiUserApi'][$apiName]['openkey']);
		$apiset = jieqi_unserialize($row['apiset']);
		$apiset[$apiName] = array('isregister' => $isregister);
		$sql = 'UPDATE ' . jieqi_dbprefix('system_userapi') . ' SET apiflag = ' . $apiflag . ', apidata = \'' . jieqi_dbslashes(serialize($apidata)) . '\', apiset = \'' . jieqi_dbslashes(serialize($apiset)) . '\', ' . $apiField . ' = \'' . jieqi_dbslashes($_SESSION['jieqiUserApi'][$apiName]['openid']) . '\' WHERE uid = ' . intval($_SESSION['jieqiUserId']);
	}
	else {
		$apidata = array();
		$apidata[$apiName] = array('expire_in' => $_SESSION['jieqiUserApi'][$apiName]['expire_in'], 'access_token' => $_SESSION['jieqiUserApi'][$apiName]['access_token'], 'openid' => $_SESSION['jieqiUserApi'][$apiName]['openid'], 'openkey' => $_SESSION['jieqiUserApi'][$apiName]['openkey']);
		$apiset = array();
		$apiset[$apiName] = array('isregister' => $isregister);
		$sql = 'INSERT INTO ' . jieqi_dbprefix('system_userapi') . ' (`uid` ,`apiflag`, `apidata` ,`apiset` ,`' . $apiField . '`) VALUES (\'' . intval($_SESSION['jieqiUserId']) . '\', \'' . intval($apiflag) . '\', \'' . jieqi_dbslashes(serialize($apidata)) . '\', \'' . jieqi_dbslashes(serialize($apiset)) . '\', \'' . jieqi_dbslashes($_SESSION['jieqiUserApi'][$apiName]['openid']) . '\');';
	}

	$ret = $query->execute($sql);
	$sql = 'UPDATE ' . jieqi_dbprefix('system_users') . ' SET conisbind = 1 WHERE uid = ' . intval($_SESSION['jieqiUserId']);
	$ret = $query->execute($sql);
	return true;
}

define('JIEQI_MODULE_NAME', 'system');
define('JIEQI_NEED_SESSION', 1);
require_once '../../global.php';
include_once './config.inc.php';
include_once './lang_api.php';
set_include_path(JIEQI_ROOT_PATH . '/lib/');
include_once JIEQI_ROOT_PATH . '/lib/OpenSDK/Tencent/SNS2.php';

if (empty($_SESSION['jieqiUserApi'][$apiName])) {
	jieqi_printfail($jieqiLang['system'][$apiName . '_bind_need_login']);
}

OpenSDK_Tencent_SNS2::init($apiConfigs[$apiName]['appid'], $apiConfigs[$apiName]['appkey']);
if (!isset($_REQUEST['act']) && isset($_REQUEST['action'])) {
	$_REQUEST['act'] = $_REQUEST['action'];
}

if (!isset($_REQUEST['act'])) {
	$_REQUEST['act'] = 'show';
}

switch ($_REQUEST['act']) {
case 'bindnew':
	jieqi_loadlang('users', JIEQI_MODULE_NAME);
	if (defined('JIEQI_USER_INTERFACE') && preg_match('/^\\w+$/is', JIEQI_USER_INTERFACE)) {
		include_once JIEQI_ROOT_PATH . '/include/funuser_' . JIEQI_USER_INTERFACE . '.php';
	}
	else {
		include_once JIEQI_ROOT_PATH . '/include/funuser.php';
	}

	include_once JIEQI_ROOT_PATH . '/include/userlocal.php';

	if (!isset($jieqiConfigs['system'])) {
		jieqi_getconfigs('system', 'configs');
	}

	jieqi_includedb();
	$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');
	$params = &$_REQUEST;
	if (empty($params['uip']) || !is_numeric(str_replace('.', '', $params['uip']))) {
		$params['uip'] = jieqi_userip();
	}

	$params['username'] = trim($params['username']);
	$fromstr = $params['username'];
	$strlen = strlen($fromstr);
	$tmpstr = '';
	$i = 0;

	for (; $i < $strlen; $i++) {
		if (128 < ord($fromstr[$i])) {
			$tmpstr .= $fromstr[$i] . $fromstr[$i + 1];
			$i++;
		}
		else {
			$tmpstr .= strtolower($fromstr[$i]);
		}
	}

	$params['username'] = $tmpstr;
	$params['email'] = trim($params['email']);
	$params['password'] = trim($params['password']);
	$params['repassword'] = trim($params['repassword']);
	$params['mobile'] = isset($params['mobile']) ? trim($params['mobile']) : '';

	if (empty($params['checkcode'])) {
		$params['checkcode'] = '';
	}
	else {
		$params['checkcode'] = trim($params['checkcode']);
	}

	$params['error'] = '';
	include_once JIEQI_ROOT_PATH . '/class/users.php';
	$users_handler = &JieqiUsersHandler::getInstance('JieqiUsersHandler');

	if (strlen($params['username']) == 0) {
		$params .= 'error';
	}
	else if (preg_match('/\\s+|^c:\\con\\con|[%,\\*"\\s\\<\\>\\&]|　||^Guest|^游客|笴/is', $params['username'])) {
		$params .= 'error';
	}
	else {
		if (($jieqiConfigs['system']['usernamelimit'] == 1) && !preg_match('/^[A-Za-z0-9]+$/', $params['username'])) {
			$params .= 'error';
		}
	}

	if (isset($params['nickname'])) {
		if (strlen($params['nickname']) == 0) {
			$params .= 'error';
		}
		else if (preg_match('/\\s+|^c:\\con\\con|[%,\\*"\\s\\<\\>\\&]|　||^Guest|^游客|笴/is', $params['nickname'])) {
			$params .= 'error';
		}
	}
	else {
		$params['nickname'] = $params['username'];
	}

	if (strlen($params['email']) == 0) {
		$params .= 'error';
	}
	else if (!preg_match('/^[_a-z0-9-]+(\\.[_a-z0-9-]+)*@[a-z0-9-]+([\\.][a-z0-9-]+)+$/i', $params['email'])) {
		$params .= 'error';
	}

	if (strlen(0 < $params['mobile']) && !preg_match('/^(1[358][0-9]{9})$/', $params['mobile'])) {
		$params .= 'error';
	}

	if (strlen($params['password']) == 0) {
		$params['password'] = '';
	}
	else if ($params['password'] != $params['repassword']) {
		$params .= 'error';
	}

	if ($users_handler->getByname($params['username'], 3) != false) {
		$params .= 'error';
	}

	if (($params['nickname'] != $params['username']) && ($users_handler->getByname($params['nickname'], 3) != false)) {
		$params .= 'error';
	}

	if (0 < $users_handler->getCount(new Criteria('email', $params['email'], '='))) {
		$params .= 'error';
	}

	if (!empty($params['error'])) {
		jieqi_printfail($params['error']);
	}

	jieqi_uregister_iprepare($params);
	jieqi_uregister_lprocess($params);
	jieqi_apiuser_bind(1, 1);
	jieqi_uregister_iprocess($params);
	break;

case 'bindold':
	jieqi_loadlang('users', JIEQI_MODULE_NAME);
	include_once JIEQI_ROOT_PATH . '/include/useraction.php';
	$params = &$_REQUEST;
	$jieqiConfigs['system']['checkcodelogin'] = 0;
	jieqi_ulogin_lprepare($params);
	jieqi_ulogin_iprepare($params);
	jieqi_ulogin_lprocess($params);
	jieqi_apiuser_bind(1, 0);
	jieqi_ulogin_iprocess($params);
	break;

default:
	/*include_once JIEQI_ROOT_PATH . '/header.php';
	$uinfo = OpenSDK_Tencent_SNS2::call('user/get_user_info', array(), 'GET');

	if (JIEQI_SYSTEM_CHARSET == 'gbk') {
		include_once JIEQI_ROOT_PATH . '/include/changecode.php';
		$uinfo = jieqi_funtoarray('jieqi_utf82gb', $uinfo);
	}*/





	// print_r($uinfo);die;
	// 
	jieqi_loadlang('users', JIEQI_MODULE_NAME);
	if (defined('JIEQI_USER_INTERFACE') && preg_match('/^\\w+$/is', JIEQI_USER_INTERFACE)) {
		include_once JIEQI_ROOT_PATH . '/include/funuser_' . JIEQI_USER_INTERFACE . '.php';
	}
	else {
		include_once JIEQI_ROOT_PATH . '/include/funuser.php';
	}

	include_once JIEQI_ROOT_PATH . '/include/userlocal.php';

	if (!isset($jieqiConfigs['system'])) {
		jieqi_getconfigs('system', 'configs');
	}

	jieqi_includedb();
	$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');
	$params = &$_REQUEST;
	if (empty($params['uip']) || !is_numeric(str_replace('.', '', $params['uip']))) {
		$params['uip'] = jieqi_userip();
	}

	$params['username'] = trim($params['username']);
	$fromstr = $params['username'];
	$strlen = strlen($fromstr);
	$tmpstr = '';
	$i = 0;

	for (; $i < $strlen; $i++) {
		if (128 < ord($fromstr[$i])) {
			$tmpstr .= $fromstr[$i] . $fromstr[$i + 1];
			$i++;
		}
		else {
			$tmpstr .= strtolower($fromstr[$i]);
		}
	}

	function createNonceStr($length = 16) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $str = "";
    for ($i = 0; $i < $length; $i++) {
      $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
    }
    return $str;
	}

	$params['username'] = createNonceStr();
	$params['email'] = createNonceStr()."@qq.com";
	$params['password'] = trim($params['password']);
	$params['repassword'] = trim($params['repassword']);
	$params['mobile'] = isset($params['mobile']) ? trim($params['mobile']) : '';

	if (empty($params['checkcode'])) {
		$params['checkcode'] = '';
	}
	else {
		$params['checkcode'] = trim($params['checkcode']);
	}

	$params['error'] = '';
	include_once JIEQI_ROOT_PATH . '/class/users.php';
	$users_handler = &JieqiUsersHandler::getInstance('JieqiUsersHandler');

	if (strlen($params['username']) == 0) {
		$params .= 'error';
	}
	else if (preg_match('/\\s+|^c:\\con\\con|[%,\\*"\\s\\<\\>\\&]|　||^Guest|^游客|笴/is', $params['username'])) {
		$params .= 'error';
	}
	else {
		if (($jieqiConfigs['system']['usernamelimit'] == 1) && !preg_match('/^[A-Za-z0-9]+$/', $params['username'])) {
			$params .= 'error';
		}
	}

	if (isset($params['nickname'])) {
		if (strlen($params['nickname']) == 0) {
			$params .= 'error';
		}
		else if (preg_match('/\\s+|^c:\\con\\con|[%,\\*"\\s\\<\\>\\&]|　||^Guest|^游客|笴/is', $params['nickname'])) {
			$params .= 'error';
		}
	}
	else {
		$params['nickname'] = $params['username'];
	}

	if (strlen($params['email']) == 0) {
		$params .= 'error';
	}
	else if (!preg_match('/^[_a-z0-9-]+(\\.[_a-z0-9-]+)*@[a-z0-9-]+([\\.][a-z0-9-]+)+$/i', $params['email'])) {
		$params .= 'error';
	}

	if (strlen(0 < $params['mobile']) && !preg_match('/^(1[358][0-9]{9})$/', $params['mobile'])) {
		$params .= 'error';
	}

	if (strlen($params['password']) == 0) {
		$params['password'] = '';
	}
	else if ($params['password'] != $params['repassword']) {
		$params .= 'error';
	}

	if ($users_handler->getByname($params['username'], 3) != false) {
		$params .= 'error';
	}

	if (($params['nickname'] != $params['username']) && ($users_handler->getByname($params['nickname'], 3) != false)) {
		$params .= 'error';
	}

	if (0 < $users_handler->getCount(new Criteria('email', $params['email'], '='))) {
		$params .= 'error';
	}

	if (!empty($params['error'])) {
		jieqi_printfail($params['error']);
	}

	jieqi_uregister_iprepare($params);
	jieqi_uregister_lprocess($params);
	jieqi_apiuser_bind(1, 1);
	jieqi_uregister_iprocess($params);
	die;
	// 





	$jieqiTpl->assign_by_ref('qq_user_info', $uinfo);
	$jieqiTpl->assign_by_ref('api_nickname', $uinfo['nickname']);
	$jieqiTpl->assign('apiname', $apiName);
	$jieqiTpl->assign('apititle', $apiTitle);
	$jieqiTpl->assign('check_url', JIEQI_USER_URL . '/regcheck.php');
	$jieqiTpl->setCaching(0);
	$jieqiTset['jieqi_contents_template'] = JIEQI_ROOT_PATH . '/api/' . $apiName . '/templates/bind.html';
	include_once JIEQI_ROOT_PATH . '/footer.php';
	break;
}

?>
