<?php

function jieqi_url_system_user($id, $type = '')
{
	global $jieqiConfigs;
	global $jieqiModules;

	if (!isset($jieqiConfigs['system'])) {
		jieqi_getconfigs('system', 'configs', 'jieqiConfigs');
	}

	switch ($type) {
	case 'info':
		if (!empty($jieqiConfigs['system']['fakeuserinfo'])) {
			$repfrom = array('<{$jieqi_url}>', '<{$id|subdirectory}>', '<{$id}>');
			$repto = array(JIEQI_URL, jieqi_getsubdir($id), $id);
			$ret = trim(str_replace($repfrom, $repto, $jieqiConfigs['system']['fakeuserinfo']));

			if (substr($ret, 0, 4) != 'http') {
				$ret = JIEQI_URL . $ret;
			}

			return $ret;
		}
		else {
			return JIEQI_USER_URL . '/userinfo.php?id=' . $id;
		}

		break;
//登陆
	case 'login':
		if (!empty($jieqiConfigs['system']['fakeuserlogin'])) {
			$repfrom = array('<{$jieqi_url}>');
			$repto = array(JIEQI_URL);
			$ret = trim(str_replace($repfrom, $repto, $jieqiConfigs['system']['fakeuserlogin']));

			if (substr($ret, 0, 4) != 'http') {
				$ret = JIEQI_URL . $ret;
			}

			return $ret;
		}
		else {
			return JIEQI_USER_URL . '/login.php';
		}

		break;		
//注册
	case 'register':
		if (!empty($jieqiConfigs['system']['fakeuserregister'])) {
			$repfrom = array('<{$jieqi_url}>');
			$repto = array(JIEQI_URL);
			$ret = trim(str_replace($repfrom, $repto, $jieqiConfigs['system']['fakeuserregister']));

			if (substr($ret, 0, 4) != 'http') {
				$ret = JIEQI_URL . $ret;
			}

			return $ret;
		}
		else {
			return JIEQI_USER_URL . '/register.php';
		}

		break;		
		
//退出
	case 'logout':
		if (!empty($jieqiConfigs['system']['fakeuserlogout'])) {
			$repfrom = array('<{$jieqi_url}>');
			$repto = array(JIEQI_URL);
			$ret = trim(str_replace($repfrom, $repto, $jieqiConfigs['system']['fakeuserlogout']));

			if (substr($ret, 0, 4) != 'http') {
				$ret = JIEQI_URL . $ret;
			}

			return $ret;
		}
		else {
			return JIEQI_USER_URL . '/logout.php';
		}

		break;
//修改资料
	case 'useredit':
		if (!empty($jieqiConfigs['system']['fakeuseruseredit'])) {
			$repfrom = array('<{$jieqi_url}>');
			$repto = array(JIEQI_URL);
			$ret = trim(str_replace($repfrom, $repto, $jieqiConfigs['system']['fakeuseruseredit']));

			if (substr($ret, 0, 4) != 'http') {
				$ret = JIEQI_URL . $ret;
			}

			return $ret;
		}
		else {
			return JIEQI_USER_URL . '/useredit.php';
		}

		break;
		
//修改头像
	case 'setavatar':
		if (!empty($jieqiConfigs['system']['fakeusersetavatar'])) {
			$repfrom = array('<{$jieqi_url}>');
			$repto = array(JIEQI_URL);
			$ret = trim(str_replace($repfrom, $repto, $jieqiConfigs['system']['fakeusersetavatar']));

			if (substr($ret, 0, 4) != 'http') {
				$ret = JIEQI_URL . $ret;
			}

			return $ret;
		}
		else {
			return JIEQI_USER_URL . '/setavatar.php';
		}

		break;

//修改密码
	case 'passedit':
		if (!empty($jieqiConfigs['system']['fakeuserpassedit'])) {
			$repfrom = array('<{$jieqi_url}>');
			$repto = array(JIEQI_URL);
			$ret = trim(str_replace($repfrom, $repto, $jieqiConfigs['system']['fakeuserpassedit']));

			if (substr($ret, 0, 4) != 'http') {
				$ret = JIEQI_URL . $ret;
			}

			return $ret;
		}
		else {
			return JIEQI_USER_URL . '/passedit.php';
		}

		break;		
		
	case 'page':
	default:
		if (!empty($jieqiConfigs['system']['fakeuserpage'])) {
			$repfrom = array('<{$jieqi_url}>', '<{$id|subdirectory}>', '<{$id}>');
			$repto = array(JIEQI_URL, jieqi_getsubdir($id), $id);
			$ret = trim(str_replace($repfrom, $repto, $jieqiConfigs['system']['fakeuserpage']));

			if (substr($ret, 0, 4) != 'http') {
				$ret = JIEQI_URL . $ret;
			}

			return $ret;
		}
		else {
			return JIEQI_USER_URL . '/userpage.php?id=' . $id;
		}

		return JIEQI_USER_URL . '/userpage.php?uid=' . $id;
		break;
	}
}

function jieqi_url_system_users( $type = '')
{
	global $jieqiConfigs;
	global $jieqiModules;

	if (!isset($jieqiConfigs['system'])) {
		jieqi_getconfigs('system', 'configs', 'jieqiConfigs');
	}
	switch ($type) {
//登陆
	case 'login':
		if (!empty($jieqiConfigs['system']['fakeuserlogin'])) {
			$repfrom = array('<{$jieqi_url}>');
			$repto = array(JIEQI_URL);
			$ret = trim(str_replace($repfrom, $repto, $jieqiConfigs['system']['fakeuserlogin']));

			if (substr($ret, 0, 4) != 'http') {
				$ret = JIEQI_URL . $ret;
			}

			return $ret;
		}
		else {
			return JIEQI_USER_URL . '/login.php';
		}

		break;		
//注册
	case 'register':
		if (!empty($jieqiConfigs['system']['fakeuserregister'])) {
			$repfrom = array('<{$jieqi_url}>');
			$repto = array(JIEQI_URL);
			$ret = trim(str_replace($repfrom, $repto, $jieqiConfigs['system']['fakeuserregister']));

			if (substr($ret, 0, 4) != 'http') {
				$ret = JIEQI_URL . $ret;
			}

			return $ret;
		}
		else {
			return JIEQI_USER_URL . '/register.php';
		}

		break;		
		
//退出
	case 'logout':
		if (!empty($jieqiConfigs['system']['fakeuserlogout'])) {
			$repfrom = array('<{$jieqi_url}>');
			$repto = array(JIEQI_URL);
			$ret = trim(str_replace($repfrom, $repto, $jieqiConfigs['system']['fakeuserlogout']));

			if (substr($ret, 0, 4) != 'http') {
				$ret = JIEQI_URL . $ret;
			}

			return $ret;
		}
		else {
			return JIEQI_USER_URL . '/logout.php';
		}

		break;
//修改资料
	case 'useredit':
		if (!empty($jieqiConfigs['system']['fakeuseruseredit'])) {
			$repfrom = array('<{$jieqi_url}>');
			$repto = array(JIEQI_URL);
			$ret = trim(str_replace($repfrom, $repto, $jieqiConfigs['system']['fakeuseruseredit']));

			if (substr($ret, 0, 4) != 'http') {
				$ret = JIEQI_URL . $ret;
			}

			return $ret;
		}
		else {
			return JIEQI_USER_URL . '/useredit.php';
		}

		break;
		
//修改头像
	case 'setavatar':
		if (!empty($jieqiConfigs['system']['fakeusersetavatar'])) {
			$repfrom = array('<{$jieqi_url}>');
			$repto = array(JIEQI_URL);
			$ret = trim(str_replace($repfrom, $repto, $jieqiConfigs['system']['fakeusersetavatar']));

			if (substr($ret, 0, 4) != 'http') {
				$ret = JIEQI_URL . $ret;
			}

			return $ret;
		}
		else {
			return JIEQI_USER_URL . '/setavatar.php';
		}

		break;

//修改密码
	case 'passedit':
		if (!empty($jieqiConfigs['system']['fakeuserpassedit'])) {
			$repfrom = array('<{$jieqi_url}>');
			$repto = array(JIEQI_URL);
			$ret = trim(str_replace($repfrom, $repto, $jieqiConfigs['system']['fakeuserpassedit']));

			if (substr($ret, 0, 4) != 'http') {
				$ret = JIEQI_URL . $ret;
			}

			return $ret;
		}
		else {
			return JIEQI_USER_URL . '/passedit.php';
		}

		break;		

	}
}

function jieqi_url_system_avatar($uid, $size = 'l', $type = -1, $retdft = true)
{
	global $jieqiConfigs;
	global $jieqi_image_type;

	if (!isset($jieqiConfigs['system'])) {
		jieqi_getconfigs('system', 'configs');
	}

	if (empty($jieqi_image_type)) {
		$jieqi_image_type = array(1 => '.gif', 2 => '.jpg', 3 => '.jpeg', 4 => '.png', 5 => '.bmp');
	}

	if (function_exists('gd_info') && $jieqiConfigs['system']['avatarcut']) {
		$avatar_cut = true;
	}
	else {
		$avatar_cut = false;
	}

	$base_avatar = '';
	if (($uid == 0) || ($type == 0) || ((0 < $type) && !isset($jieqi_image_type[$type]))) {
		if ($retdft) {
			$base_avatar = JIEQI_USER_URL . '/images';
			$type = 2;
			$uid = 'noavatar';
		}
		else {
			return false;
		}
	}
	else if ($type < 0) {
		return JIEQI_USER_URL . '/avatar.php?uid=' . $uid . '&size=' . $size;
	}

	$prefix = $jieqi_image_type[$type];

	if (empty($base_avatar)) {
		$base_avatar = jieqi_uploadurl($jieqiConfigs['system']['avatardir'], $jieqiConfigs['system']['avatarurl'], 'system') . jieqi_getsubdir($uid);
	}

	switch ($size) {
	case 'd':
		return $base_avatar;
		break;

	case 'l':
		return $base_avatar . '/' . $uid . $prefix;
		break;

	case 's':
		return $avatar_cut ? $base_avatar . '/' . $uid . 's' . $prefix : $base_avatar . '/' . $uid . $prefix;
		break;

	case 'i':
		return $avatar_cut ? $base_avatar . '/' . $uid . 'i' . $prefix : $base_avatar . '/' . $uid . $prefix;
		break;

	case 'a':
	default:
		if ($avatar_cut) {
			return array('l' => $base_avatar . '/' . $uid . $prefix, 's' => $base_avatar . '/' . $uid . 's' . $prefix, 'i' => $base_avatar . '/' . $uid . 'i' . $prefix, 'd' => $base_avatar);
		}
		else {
			return array('l' => $base_avatar . '/' . $uid . $prefix, 's' => $base_avatar . '/' . $uid . $prefix, 'i' => $base_avatar . '/' . $uid . $prefix, 'd' => $base_avatar);
		}

		break;
	}
}

function jieqi_url_system_pathinfo($url, $prefix = '')
{
	if (!in_array($prefix, array('.html', '.htm'))) {
		$prefix = '';
	}

	$pos = strpos($url, '?');

	if (0 < $pos) {
		$parmary = explode('&', substr($url, $pos + 1));
		$pstr = '';

		foreach ($parmary as $v) {
			$tmpary = explode('=', $v);

			if (isset($tmpary[1])) {
				$pstr .= '/' . $tmpary[0] . '/' . $tmpary[1];
			}
		}

		return substr($url, 0, $pos) . $pstr . $prefix;
	}
	else {
		return $url;
	}
}


?>
