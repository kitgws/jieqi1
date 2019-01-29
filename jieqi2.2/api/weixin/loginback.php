<?php

define('JIEQI_MODULE_NAME', 'system');
define('JIEQI_NEED_SESSION', 1);
require_once '../../global.php';
include_once './config.inc.php';
include_once './lang_api.php';
set_include_path(JIEQI_ROOT_PATH . '/lib/');
$code=$_GET["code"];
if($code==''){
	echo "您授权失败或过期请退出重新登录！";
	exit;
}
$get_token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$apiConfigs[$apiName]['appid'].'&secret='.$apiConfigs[$apiName]['appkey'].'&code='.$code.'&grant_type=authorization_code';

$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_TIMEOUT, 500);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_URL, $get_token_url);
$res = curl_exec($curl);
$json_obj=json_decode($res,true);
curl_close($curl);


$_SESSION['jieqiUserApi'][$apiName]['access_token'] = $json_obj['access_token'];
$_SESSION['jieqiUserApi'][$apiName]['refresh_token'] = $json_obj['refresh_token'];
$_SESSION['jieqiUserApi'][$apiName]['expire_in'] = $json_obj['expires_in'];
$_SESSION['jieqiUserApi'][$apiName]['openid'] = $json_obj['openid'];
$_SESSION['jieqiUserApi'][$apiName]['openkey'] = '';

if (empty($_SESSION['jieqiUserApi'][$apiName]['openid'])) {
	jieqi_printfail($jieqiLang['system']['qq_error_callback_getvar']);
}

$apiField = jieqi_dbslashes($apiName) . 'id';
$apiOrder = intval($apiOrder);
jieqi_includedb();
$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');
$sql = 'SELECT * FROM ' . jieqi_dbprefix('system_userapi')  . ' WHERE ' . $apiField . ' = \'' . jieqi_dbslashes($_SESSION['jieqiUserApi'][$apiName]['openid']) . '\' LIMIT 0, 1';
$query->execute($sql);
$row = $query->getRow();
$userbind = false;
if (is_array($row) && !empty($row['uid'])) {
	include_once JIEQI_ROOT_PATH . '/class/users.php';
	$users_handler = &JieqiUsersHandler::getInstance('JieqiUsersHandler');
	$jieqiUsers = $users_handler->get($row['uid']);

	if (!is_object($jieqiUsers)) {
		$flagnum = pow(2, $apiOrder - 1);
		$flagstr = str_repeat('1', 30);
		$flagstr[30 - $apiOrder] = '0';

		if ($row['apiflag'] == $flagnum) {
			$sql = 'DELETE FROM ' . jieqi_dbprefix('system_userapi')  . ' WHERE ' . $apiField . ' = \'' . jieqi_dbslashes($_SESSION['jieqiUserApi'][$apiName]['openid']) . '\'';
		}
		else {
			$sql = 'UPDATE ' . jieqi_dbprefix('system_userapi') . ' SET apiflag = apiflag & ' . bindec($flagstr)  . ' WHERE ' . $apiField . ' = \'' . jieqi_dbslashes($_SESSION['jieqiUserApi'][$apiName]['openid']) . '\'';
		}

		$query->execute($sql);
	}
	else {
		$apidata = jieqi_unserialize($row['apidata']);

		if (!is_array($apidata)) {
			$apidata = array();
		}

		$apidata[$apiName] = array('expire_in' => $_SESSION['jieqiUserApi'][$apiName]['expire_in'], 'access_token' => $_SESSION['jieqiUserApi'][$apiName]['access_token'], 'openid' => $_SESSION['jieqiUserApi'][$apiName]['openid'], 'openkey' => $_SESSION['jieqiUserApi'][$apiName]['openkey']);
		$sql = 'UPDATE ' . jieqi_dbprefix('system_userapi') . ' SET apidata = \'' . jieqi_dbslashes(serialize($apidata))  . '\' WHERE ' . $apiField . ' = \'' . jieqi_dbslashes($_SESSION['jieqiUserApi'][$apiName]['openid']) . '\'';
		$query->execute($sql);
		include_once JIEQI_ROOT_PATH . '/include/checklogin.php';
		jieqi_loginprocess($jieqiUsers);
		if (defined('JIEQI_USER_INTERFACE') && preg_match('/^\\w+$/is', JIEQI_USER_INTERFACE)) {
			include_once JIEQI_ROOT_PATH . '/include/funuser_' . JIEQI_USER_INTERFACE . '.php';
		}
		else {
			include_once JIEQI_ROOT_PATH . '/include/funuser.php';
		}

		$ucsyncode = '';

		if (function_exists('uc_get_user')) {
			if ($data = uc_get_user($jieqiUsers->getVar('uname', 'n'))) {
				$ucsyncode = uc_user_synlogin($uid);
			}
		}

		if (empty($_SESSION['jieqiUserApi'][$apiName]['jumpurl'])) {
			$_SESSION['jieqiUserApi'][$apiName]['jumpurl'] = JIEQI_URL . '/';
		}

		if (defined('JIEQI_WAP_PAGE')) {
			jieqi_wapgourl($_SESSION['jieqiUserApi'][$apiName]['jumpurl']);
		}
		else if ($_REQUEST['jumphide']) {
			jieqi_jumppage($_SESSION['jieqiUserApi'][$apiName]['jumpurl'], '', $ucsyncode, true);
		}
		else {
			jieqi_jumppage($_SESSION['jieqiUserApi'][$apiName]['jumpurl'], $jieqiLang['system']['login_title'], sprintf($jieqiLang['system']['api_login_success'], $jieqiUsers->getVar('name', 'n')) . $ucsyncode);
		}

		$userbind = true;
		exit();
	}
}

if (!$userbind) {
	header('Location: ' . jieqi_headstr(JIEQI_USER_URL . '/api/' . $apiName . '/bind.php'));
}

?>
