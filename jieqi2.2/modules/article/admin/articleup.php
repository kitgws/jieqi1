<?php

define('JIEQI_MODULE_NAME', 'article');
require_once '../../../global.php';
jieqi_getconfigs(JIEQI_MODULE_NAME, 'power');
jieqi_checkpower($jieqiPower['article']['manageallarticle'], $jieqiUsersStatus, $jieqiUsersGroup, false, true);
jieqi_loadlang('manage', JIEQI_MODULE_NAME);
jieqi_loadlang('list', JIEQI_MODULE_NAME);
jieqi_getconfigs(JIEQI_MODULE_NAME, 'configs');
$article_static_url = (empty($jieqiConfigs['article']['staticurl']) ? $jieqiModules['article']['url'] : $jieqiConfigs['article']['staticurl']);
$article_dynamic_url = (empty($jieqiConfigs['article']['dynamicurl']) ? $jieqiModules['article']['url'] : $jieqiConfigs['article']['dynamicurl']);
include_once $jieqiModules['article']['path'] . '/class/article.php';
$article_handler = &JieqiArticleHandler::getInstance('JieqiArticleHandler');
include_once JIEQI_ROOT_PATH . '/modules/obook/class/obook.php';
$obook_handler = &JieqiObookHandler::getInstance('JieqiObookHandler');
if (isset($_REQUEST['action']) && !empty($_REQUEST['id'])) {
	include_once $jieqiModules['article']['path'] . '/include/actarticle.php';
	$_REQUEST['id'] = intval($_REQUEST['id']);
	$criteria = new CriteriaCompo(new Criteria('articleid', $_REQUEST['id']));

	switch ($_REQUEST['action']) {
	case 'show':
		$article_handler->updatefields(array('display' => 0), $criteria);
		jieqi_article_updateinfo($_REQUEST['id'], 'articleshow');
		break;

	case 'hide':
		$article_handler->updatefields(array('display' => 2), $criteria);
		jieqi_article_updateinfo($_REQUEST['id'], 'articlehide');
		break;

	case 'ready':
		$article_handler->updatefields(array('display' => 1), $criteria);
		jieqi_article_updateinfo($_REQUEST['id'], 'articlehide');
		break;

	case 'toptime':
		$article_handler->updatefields(array('toptime' => JIEQI_NOW_TIME), $criteria);
		break;
	
	case 'qianyue':
		$article_handler->updatefields(array('isvip' => 1), $criteria);
		$article_handler->updatefields(array('issign' => 10), $criteria);
		$article_handler->updatefields(array('signtime' => JIEQI_NOW_TIME), $criteria);
		break;
    
    case 'quxiao':
		$article_handler->updatefields(array('isvip' => 0), $criteria);
		$article_handler->updatefields(array('issign' => 0), $criteria);
		$article_handler->updatefields(array('signtime' => JIEQI_NOW_TIME), $criteria);
		break;	

	case 'untoptime':
		$article_handler->updatefields(array('toptime' => 0), $criteria);
		break;

	case 'del':
		$canedit = jieqi_checkpower($jieqiPower['article']['delallarticle'], $jieqiUsersStatus, $jieqiUsersGroup, true, true);

		if ($canedit) {
			$article = $article_handler->get($_REQUEST['id']);

			if (is_object($article)) {
				jieqi_article_delete($_REQUEST['id']);
			}
		}

		break;
	}

	unset($criteria);
}

$jieqiTset['jieqi_contents_template'] = $jieqiModules['article']['path'] . '/templates/admin/articlelistup.html';
include_once JIEQI_ROOT_PATH . '/admin/header.php';
$jieqiPset = jieqi_get_pageset();
$jieqiTpl->assign('article_static_url', $article_static_url);
$jieqiTpl->assign('article_dynamic_url', $article_dynamic_url);
jieqi_getconfigs('article', 'sort');

if (empty($_REQUEST['sortid'])) {
	$_REQUEST['sortid'] = 0;
}

$jieqiTpl->assign('sortrows', jieqi_funtoarray('jieqi_htmlstr', $jieqiSort['article']));
$criteria = new CriteriaCompo();

if (isset($_REQUEST['keyword'])) {
	$_REQUEST['keyword'] = trim($_REQUEST['keyword']);
}

if (!empty($_REQUEST['keyword'])) {
	switch ($_REQUEST['keytype']) {
	case 1:
		$keyfield = 'author';
		break;

	case 2:
		$keyfield = 'poster';
		break;

	default:
		$keyfield = 'articlename';
		break;
	}

	$_REQUEST['keyword'] = trim($_REQUEST['keyword']);
	$tmpary = explode(' ', $_REQUEST['keyword']);

	if (1 < $tmpary) {
		foreach ($tmpary as $k => $v) {
			$tmpary[$k] = '\'' . jieqi_dbslashes($v) . '\'';
		}

		$criteria->add(new Criteria($keyfield, '(' . implode(',', $tmpary) . ')', 'IN'));
	}
	else {
		$criteria->add(new Criteria($keyfield, $_REQUEST['keyword'], '='));
	}
}

if (!empty($_REQUEST['sortid'])) {
	$criteria->add(new Criteria('sortid', $_REQUEST['sortid'], '='));
}

if (!empty($_REQUEST['typeid'])) {
	$criteria->add(new Criteria('typeid', $_REQUEST['typeid'], '='));
}

if (!empty($_REQUEST['display'])) {
	switch ($_REQUEST['display']) {
	case 'unshow':
		$criteria->add(new Criteria('display', 0, '>'));
		break;

	case 'ready':
		$criteria->add(new Criteria('display', 1, '='));
		break;

	case 'hide':
		$criteria->add(new Criteria('display', 2, '='));
		break;

	case 'show':
		$criteria->add(new Criteria('display', 0, '='));
		break;

	case 'empty':
		$criteria->add(new Criteria('size', 0, '='));
		break;

	case 'agent':
		$criteria->add(new Criteria('siteid', 0, '>'));
		break;
	}
}
include_once $jieqiModules['article']['path'] . '/include/funarticle.php';
$jieqiTpl->assign('articletitle', $articletitle);
$jieqiTpl->assign('display', urlencode($_REQUEST['display']));
$jieqiTpl->assign('url_article', $jieqiModules['article']['url'] . '/admin/article.php');
$jieqiTpl->assign('url_batchaction', $article_static_url . '/admin/batchaction.php');
$jieqiTpl->assign('url_jump', jieqi_addurlvars(array()));
$orderary = array('articleid', 'articlename', 'postdate', 'lastupdaye', 'toptime', 'goodnum', 'hotnum', 'ratenum', 'size', 'monthsize', 'weeksize', 'daysize', 'presize', 'allvisit', 'monthvisit', 'weekvisit', 'dayvisit', 'allvote', 'monthvote', 'weekvote', 'dayvote', 'allvipvote', 'monthvipvote', 'weekvipvote', 'dayvipvote', 'previpvote', 'allflower', 'monthflower', 'weekflower', 'dayflower', 'preflower', 'allegg', 'monthegg', 'weekegg', 'dayegg', 'preegg');
if (!empty($_REQUEST['order']) && in_array($_REQUEST['order'], $orderary)) {
	$c_sort = $_REQUEST['order'];
}
else {
	$c_sort = 'lastupdate';
}

if (!empty($_REQUEST['asc'])) {
	$c_order = 'ASC';
}
else {
	$c_order = 'DESC';
}

$jieqiTpl->assign('sort', urlencode($c_sort));
$jieqiTpl->assign('order', urlencode($c_order));
$criteria->setSort($c_sort);
$criteria->setOrder($c_order);
$criteria->setLimit($jieqiPset['rows']);
$criteria->setStart($jieqiPset['start']);
$article_handler->queryObjects($criteria);
$articlerows = array();
$k = 0;

while ($v = $article_handler->getObject()) {
	$articlerows[$k] = jieqi_article_vars($v);
	$k++;
}

$jieqiTpl->assign_by_ref('articlerows', $articlerows);


	include_once $jieqiModules['article']['path'] . '/class/autool.php';
    $monthly_handler = &JieqiMonthlybuyHandler::getInstance('JieqiMonthlybuyHandler');
	$criteria = new CriteriaCompo();
	$criteria->setLimit($jieqiPset['rows']);
	$monthly_handler->queryObjects($criteria);
	$k = 0;

	while ($v = $monthly_handler->getObject()) {
		$monthlyrows[$k]['id'] = $v->getVar('id');
		$monthlyrows[$k]['bookid'] = $v->getVar('bookid');
		$monthlyrows[$k]['bookname'] = $v->getVar('bookname');
		$monthlyrows[$k]['text'] = $v->getVar('text');
		$monthlyrows[$k]['texts'] = $v->getVar('texts');
		$monthlyrows[$k]['date'] = $v->getVar('date');
		$monthlyrows[$k]['typeid'] = $v->getVar('typeid');
		$monthlyrows[$k]['type'] = $v->getVar('type');
		$monthlyrows[$k]['types'] = $v->getVar('type');
		$k++;
	}

	$jieqiTpl->assign_by_ref('monthlyrows', $monthlyrows);
	
$jieqiTpl->assign('_request', jieqi_funtoarray('jieqi_htmlstr', $_REQUEST));
include_once JIEQI_ROOT_PATH . '/lib/html/page.php';
$jieqiPset['count'] = $monthly_handler->getCount($criteria);
$jumppage = new JieqiPage($jieqiPset);
$jieqiTpl->assign('url_jumppage', $jumppage->whole_bar());
$jieqiTpl->setCaching(0);
include_once JIEQI_ROOT_PATH . '/admin/footer.php';

?>
