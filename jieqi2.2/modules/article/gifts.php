<?php

define('JIEQI_MODULE_NAME', 'article');
require_once '../../global.php';

if (empty($_REQUEST['id'])) {
	jieqi_printfail(LANG_ERROR_PARAMETER);
}

jieqi_checklogin();
jieqi_loadlang('gift', JIEQI_MODULE_NAME);
include_once $jieqiModules['article']['path'] . '/class/article.php';
$article_handler = &JieqiArticleHandler::getInstance('JieqiArticleHandler');
$article = $article_handler->get($_REQUEST['id']);

if (!$article) {
	jieqi_printfail($jieqiLang['article']['article_not_exists']);
}

include_once JIEQI_ROOT_PATH . '/class/users.php';
$users_handler = &JieqiUsersHandler::getInstance('JieqiUsersHandler');
$users = $users_handler->get($_SESSION['jieqiUserId']);

if (!is_object($users)) {
	jieqi_printfail($jieqiLang['article']['user_not_exists']);
}

$userisvip = $users->getVar('isvip', 'n');
$usermoney = $users->getEmoney();

if ($usermoney['emoney'] <= 0) {
	jieqi_printfail($jieqiLang['article']['giftbuy_egold_low']);
}

$users = $users_handler->get($_SESSION['jieqiUserId']);
if(!in_array($_REQUEST['rid'],array('2','3','4','5','6','7'))){
	jieqi_printfail($jieqiLang['article']['gift_over_error']);
}
//道具价格
jieqi_getconfigs('article', 'configs', 'jieqiConfigs');
$redroseprice = intval($jieqiConfigs['article']['redrose']);
$yellowroseprice = intval($jieqiConfigs['article']['yellowrose']);
$blueroseprice = intval($jieqiConfigs['article']['bluerose']);
$whiteroseprice = intval($jieqiConfigs['article']['whiterose']);
$blackroseprice = intval($jieqiConfigs['article']['blackrose']);
$greenroseprice = intval($jieqiConfigs['article']['greenrose']);

include_once JIEQI_ROOT_PATH . '/include/funstat.php';
$addnum = intval($_REQUEST['count']);
$addtype = intval($_REQUEST['rid']);


if($_REQUEST['rid'] == '2'){
	$gift_type = 'redrose';
	if($redroseprice > 0){
	$pricenums = intval(floor($usermoney['emoney'] / $redroseprice));
	$buynums = intval(floor($_REQUEST['count'] * $redroseprice));
	}
}else if($_REQUEST['rid'] == '3'){
	$gift_type = 'yellowrose';
	if($yellowroseprice > 0){
	$pricenums = intval(floor($usermoney['emoney'] / $yellowroseprice));
	$buynums = intval(floor($_REQUEST['count'] * $yellowroseprice));
	}
}else if($_REQUEST['rid'] == '4'){
	$gift_type = 'bluerose';
	if($blueroseprice > 0){
	$pricenums = intval(floor($usermoney['emoney'] / $blueroseprice));
	$buynums = intval(floor($_REQUEST['count'] * $blueroseprice));
	}
}else if($_REQUEST['rid'] == '5'){
	$gift_type = 'whiterose';
	if($whiteroseprice > 0){
	$pricenums = intval(floor($usermoney['emoney'] / $whiteroseprice));
	$buynums = intval(floor($_REQUEST['count'] * $whiteroseprice));
	}
}else if($_REQUEST['rid'] == '6'){
	$gift_type = 'greenrose';
	if($greenroseprice > 0){
	$pricenums = intval(floor($usermoney['emoney'] / $greenroseprice));
	$buynums = intval(floor($_REQUEST['count'] * $greenroseprice));
	}
}else if($_REQUEST['rid'] == '7'){
	$gift_type = 'blackrose';
	if($blackroseprice > 0){
	$pricenums = intval(floor($usermoney['emoney'] / $blackroseprice));
	$buynums = intval(floor($_REQUEST['count'] * $blackroseprice));
	}
}
if (!is_object($users)) {
	jieqi_printfail($jieqiLang['article']['user_not_exists']);
}

jieqi_getconfigs(JIEQI_MODULE_NAME, 'configs');
$article_static_url = (empty($jieqiConfigs['article']['staticurl']) ? $jieqiModules['article']['url'] : $jieqiConfigs['article']['staticurl']);
$article_dynamic_url = (empty($jieqiConfigs['article']['dynamicurl']) ? $jieqiModules['article']['url'] : $jieqiConfigs['article']['dynamicurl']);

if (!isset($_REQUEST['act'])) {
	$_REQUEST['act'] = 'show';
}

switch ($_REQUEST['act']) {
case 'post':
	$errtext = '';
	jieqi_getconfigs('article', 'action', 'jieqiAction');
	$jieqiAction['article']['gifts']['paymin'] = intval($jieqiAction['article']['gifts']['paymin']);
	$_REQUEST['count'] = intval(trim($_REQUEST['count']));
	
	if ($_REQUEST['count'] <= 0) {
		$errtext .= $jieqiLang['article']['giftbuy_over_zero'] . '<br />';
	}
	else if ($_REQUEST['count'] < $jieqiAction['article']['gifts']['paymin']) {
		$errtext .= sprintf($jieqiLang['article']['giftbuy_over_zero'], $jieqiAction['article']['gifts']['paymin']) . '<br />';
	}
	else if ($pricenums < $_REQUEST['count']) {
		$errtext .= $jieqiLang['article']['giftbuy_egold_low'] . '<br />';
	}
if (empty($errtext)) {
	 if (in_array($_REQUEST['rid'],array('2','3','4','5','6','7'))) {
		$upfields = array();
		$fieldname = $gift_type;
		$addnum = $_REQUEST['count'];
		$upfields[$fieldname] = $article->getVar($fieldname, 'n') + $addnum;
        $upfields['giftnum'] = $article->getVar('giftnum', 'n') + $buynums;
		$upfields['giftnums'] = $article->getVar('giftnums', 'n') + $addnum;
		
		$criteria = new CriteriaCompo(new Criteria('articleid', $_REQUEST['id']));
		$article_handler->updatefields($upfields, $criteria);
		$ret = mysql_query("UPDATE jieqi_system_users SET egold = egold - ".$buynums."  WHERE uid = $_SESSION[jieqiUserId]");
		if (!$ret) {
			jieqi_printfail($jieqiLang['article']['user_payout_failure']);
		}
		$tid = (0 < $article->getVar('authorid', 'n') ? $article->getVar('authorid', 'n') : $article->getVar('posterid', 'n'));
		$tname = (0 < $article->getVar('authorid', 'n') ? $article->getVar('author', 'n') : $article->getVar('poster', 'n'));
		include_once $jieqiModules['obook']['path'] . '/include/funbuy.php';
		jieqi_obook_upincome(array('articleid' => $article->getVar('articleid', 'n'), 'egold' => $buynums, 'etype' => 0, 'intype' => 'gift', 'salenum' => 0));
		include_once $jieqiModules['article']['path'] . '/include/funaction.php';
		$actions = array('actname' => $fieldname, 'actnum' => $_REQUEST['count'], 'actegold' => $buynums, 'actbuy' => 0, 'tid' => $tid, 'tname' => $tname, 'aname' => $article->getVar('articlename', 'n'));
		jieqi_article_actiondo($actions, $article);
		
	}
        jieqi_msgwin(LANG_DO_SUCCESS, $jieqiLang['article']['gift_save_success']);
	}
	else {
		jieqi_printfail($errtext);
	}

	break;

case 'show':
default:
	include_once JIEQI_ROOT_PATH . '/header.php';
	$jieqiTpl->assign('article_static_url', $article_static_url);
	$jieqiTpl->assign('article_dynamic_url', $article_dynamic_url);
	$jieqiTpl->assign('articleid', $article->getVar('articleid'));
	$jieqiTpl->assign('articlename', $article->getVar('articlename'));
	$jieqiTpl->assign('vipid', $article->getVar('vipid'));
	$jieqiTpl->assign('postdate', date(JIEQI_DATE_FORMAT, $article->getVar('postdate')));
	$jieqiTpl->assign('lastupdate', date(JIEQI_DATE_FORMAT, $article->getVar('lastupdate')));
	$jieqiTpl->assign('authorid', $article->getVar('authorid'));
	$jieqiTpl->assign('author', $article->getVar('author'));
	$jieqiTpl->assign('gift_type', $gift_type);
	$jieqiTpl->assign('useremoney', $usermoney['emoney']);
	//$jieqiTpl->assign('flowermoney', $users->vars['flower']['value']);
	//$jieqiTpl->assign('eggmoney', $users->vars['egg']['value']);
	$jieqiTpl->assign('vipvotemoney', intval($userset['gift']['vipvote']));
	$jieqiTpl->assign('flowerprice', $flowerprice);
	$jieqiTpl->assign('eggprice', $eggprice);
	$jieqiTpl->assign('egoldnums', $egoldnums);
	$jieqiTpl->assign('gfuname', $gfuname);
	$jieqiTpl->assign('typeuname', $typeuname);
	
	$jieqiTpl->assign('redroseprice', $redroseprice);
	$jieqiTpl->assign('yellowroseprice', $yellowroseprice );
	$jieqiTpl->assign('blueroseprice', $blueroseprice);
	$jieqiTpl->assign('whiteroseprice', $whiteroseprice);
	$jieqiTpl->assign('blackroseprice', $blackroseprice);
	$jieqiTpl->assign('greenroseprice', $greenroseprice);

	if (empty($_REQUEST['ajax_request'])) {
		$jieqiTpl->assign('ajax_request', 0);
	}
	else {
		$jieqiTpl->assign('ajax_request', 1);
	}
	
	$jieqiTpl->setCaching(0);
	$jieqiTpl->assign('jieqi_contents', $jieqiTpl->fetch($jieqiModules['article']['path'] . '/templates/gifts.html'));
	//$jieqiTset['jieqi_page_template'] = $jieqiModules['article']['path'] . '/templates/gift.html';
	include_once JIEQI_ROOT_PATH . '/footer.php';
	break;
}
?>
