<?php
define('JIEQI_MODULE_NAME', 'article');
require_once '../../global.php';

if (!isset($_REQUEST['action'])) {
	$_REQUEST['action'] = 'show';
}
jieqi_checklogin();
jieqi_getconfigs(JIEQI_MODULE_NAME, 'power');
//jieqi_checkpower($jieqiPower['article']['mouthlybuy'], $jieqiUsersStatus, $jieqiUsersGroup, false); //验证权限
//载入配置
jieqi_loadlang('month', JIEQI_MODULE_NAME);
jieqi_getconfigs('article', 'configs', 'jieqiConfigs');
jieqi_getconfigs("article", "option", "jieqiOption");
jieqi_getconfigs('obook', 'power');

$customprice = jieqi_checkpower($jieqiPower['obook']['customprice'], $jieqiUsersStatus, $jieqiUsersGroup, true);
$article_static_url = (empty($jieqiConfigs['article']['staticurl']) ? $jieqiModules['article']['url'] : $jieqiConfigs['article']['staticurl']);
$article_dynamic_url = (empty($jieqiConfigs['article']['dynamicurl']) ? $jieqiModules['article']['url'] : $jieqiConfigs['article']['dynamicurl']);
	if($_GET['id'] == '1'){
      $size = $jieqiConfigs['article']['issignsize'];
    }else if($_GET['id'] == '2'){
      $size = $jieqiConfigs['article']['isvipsize'];
    } 
$id = $_GET['id'];
switch ($_REQUEST['action']) {
case 'post':

          include_once JIEQI_ROOT_PATH . '/modules/article/class/article.php';
	      $article_handler = &JieqiArticleHandler::getInstance('JieqiArticleHandler');
	      $article = $article_handler->get($_POST['articleid']);
		if (!is_object($article)) {
			$errtext .= '申请的小说不存在，请仔细检查';
		}
		else {
			$articlename = $article->getVar('articlename', 'n');
		}		  

    if (empty($errtext)) {
		include_once $jieqiModules['article']['path'] . '/class/autool.php';
        $monthlys_handler = &JieqiMonthlybuyHandler::getInstance('JieqiMonthlybuyHandler');
        $monthlys = $monthlys_handler->create();
		$monthlys->setVar('bookid', $_POST['articleid']);
		$monthlys->setVar('bookname', $articlename);
		$monthlys->setVar('date', JIEQI_NOW_TIME);
		$monthlys->setVar('userid',  $_SESSION['jieqiUserId']);
		$monthlys->setVar('username', $_SESSION['jieqiUserName']);
		$monthlys->setVar('text', $_POST['text']);
		$monthlys->setVar('pc', $_POST['pc']);
		$monthlys->setVar('type', $_POST['type']);
		
//		$monthlys_handler->insert($monthlys);
//		jieqi_jumppage($article_dynamic_url . '/monthlybuy.php?id='.$_GET['id'].'', LANG_DO_SUCCESS, $jieqiLang['article']['article_not_yes']);
		if (!$monthlys_handler->insert($monthlys)) {
			jieqi_printfail($jieqiLang['article']['article_not_no']);
		}
		else {
			jieqi_jumppage($article_dynamic_url . '/tool.php?id='.$_POST['type'].'', LANG_DO_SUCCESS, $jieqiLang['article']['article_not_yes']);
		}
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
	$articlerows = array();
	include_once $jieqiModules['article']['path'] . '/class/article.php';
	$article_handler = &JieqiArticleHandler::getInstance('JieqiArticleHandler');
	$criteria = new CriteriaCompo(new Criteria('authorid', $_SESSION['jieqiUserId']));
	$criteria->add(new Criteria('size', $size, '>='));
	$criteria->setLimit(100);
	$article_handler->queryObjects($criteria);
	$k = 0;

	while ($v = $article_handler->getObject()) {
		$articlerows[$k]['articleid'] = $v->getVar('articleid');
		$articlerows[$k]['isvip'] = $v->getVar('isvip');
		$articlerows[$k]['articlename'] = $v->getVar('articlename');
		$articlerows[$k]['size'] = $v->getVar('size');
		$k++;
	}

	$jieqiTpl->assign_by_ref('articlerows', $articlerows);

	include_once $jieqiModules['article']['path'] . '/class/autool.php';
    $monthly_handler = &JieqiMonthlybuyHandler::getInstance('JieqiMonthlybuyHandler');
	$criteria = new CriteriaCompo(new Criteria('userid', $_SESSION['jieqiUserId']));
	$criteria->setLimit(5);
	$monthly_handler->queryObjects($criteria);
	$k = 0;

	while ($v = $monthly_handler->getObject()) {
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
	$jieqiTpl->assign_by_ref('_request', jieqi_funtoarray('jieqi_htmlstr', $_REQUEST));
    include_once JIEQI_ROOT_PATH . '/lib/html/page.php';
    $jieqiPset['count'] = $monthly_handler->getCount($criteria);
    $jumppage = new JieqiPage($jieqiPset);
    $jieqiTpl->assign('url_jumppage', $jumppage->whole_bar());
	$jieqiTpl->assign('sizes', $size);
	$jieqiTpl->assign('tid', $_GET['id']);
	$jieqiTpl->setCaching(0);
	$jieqiTset['jieqi_contents_template'] = $jieqiModules['article']['path'] . '/templates/tool.html';
	include_once JIEQI_ROOT_PATH . '/footer.php';
	break;
}
?>