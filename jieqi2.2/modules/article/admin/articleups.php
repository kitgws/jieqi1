<?php

define('JIEQI_MODULE_NAME', 'article');
require_once '../../../global.php';
jieqi_getconfigs(JIEQI_MODULE_NAME, 'power');
jieqi_checkpower($jieqiPower['article']['manageallarticle'], $jieqiUsersStatus, $jieqiUsersGroup, false, true);
jieqi_loadlang('manage', JIEQI_MODULE_NAME);
jieqi_loadlang('list', JIEQI_MODULE_NAME);
jieqi_getconfigs(JIEQI_MODULE_NAME, 'configs');
jieqi_getconfigs("article", "option", "jieqiOption");
$article_static_url = (empty($jieqiConfigs['article']['staticurl']) ? $jieqiModules['article']['url'] : $jieqiConfigs['article']['staticurl']);
$article_dynamic_url = (empty($jieqiConfigs['article']['dynamicurl']) ? $jieqiModules['article']['url'] : $jieqiConfigs['article']['dynamicurl']);

$jieqiTset['jieqi_contents_template'] = $jieqiModules['article']['path'] . '/templates/admin/articlelistups.html';
include_once JIEQI_ROOT_PATH . '/admin/header.php';
if (empty($_REQUEST['id'])) {
	jieqi_printfail(LANG_ERROR_PARAMETER);
}
if (!isset($_REQUEST['action'])) {
	$_REQUEST['action'] = 'show';
}
include_once $jieqiModules['article']['path'] . '/class/autool.php';
$monthly_handler = &JieqiMonthlybuyHandler::getInstance('JieqiMonthlybuyHandler');
$monthly = $monthly_handler->get($_REQUEST['id']);
$query = JieqiQueryHandler::getInstance("JieqiQueryHandler");
switch ($_REQUEST['action']) {
case 'update':
    $errtext = '';
	$_POST['type'] = intval($_POST['type']);
	$type =$_POST['type'];
	$texts=$_POST['texts'];
    if (empty($errtext)) {
		$criteria = new CriteriaCompo(new Criteria('id', $_REQUEST['id']));
        $monthly_handler->updatefields(array('typeid' => $type,'texts' => $texts), $criteria);
    include_once $jieqiModules['article']['path'] . '/class/article.php';
    $article_handler = &JieqiArticleHandler::getInstance('JieqiArticleHandler');
    include_once JIEQI_ROOT_PATH . '/modules/obook/class/obook.php';
    $obook_handler = &JieqiObookHandler::getInstance('JieqiObookHandler');
	if($monthly->getVar('type') ==1){
		$criteria = new CriteriaCompo(new Criteria('articleid', $monthly->getVar('bookid')));
        $article_handler->updatefields(array('issign' => 10,'signtime' => JIEQI_NOW_TIME), $criteria);
	}else if($monthly->getVar('type') ==2) {
		$criteria = new CriteriaCompo(new Criteria('articleid', $monthly->getVar('bookid')));
        $article_handler->updatefields(array('isvip' => 1), $criteria);
		$article = $article_handler->get($monthly->getVar('bookid'));
					if (intval($article->getVar("vipid", "n")) == 0) {
						$sql = "SELECT * FROM " . jieqi_dbprefix("obook_obook") . " WHERE obookname = '" . jieqi_dbslashes($article->getVar("articlename", "n")) . "' LIMIT 0,1";
						$query->execute($sql);
						$obookrow = $query->getRow();
						if (is_array($obookrow) && !empty($obookrow["articleid"])) {
							$sql = "SELECT * FROM " . jieqi_dbprefix("article_article") . " WHERE articleid = " . intval($obookrow["articleid"]) . " LIMIT 0,1";
							$query->execute($sql);
							$articlerow = $query->getRow();
							if (!$articlerow || ($articlerow["articleid"] == $article->getVar("articleid", "n"))) {
								$article->setVar("viptime", $obookrow["lastupdate"]);
								$article->setVar("vipid", $obookrow["obookid"]);
								$article->setVar("vipchapters", $obookrow["chapters"]);
								$article->setVar("vipsize", $obookrow["size"]);
								$article->setVar("vipvolumeid", $obookrow["lastvolumeid"]);
								$article->setVar("vipvolume", $obookrow["lastvolume"]);
								$article->setVar("vipchapterid", $obookrow["lastchapterid"]);
								$article->setVar("vipchapter", $obookrow["lastchapter"]);
								$article->setVar("vipsummary", $obookrow["lastsummary"]);

								if (!$articlerow) {
									$sql = "UPDATE " . jieqi_dbprefix("obook_obook") . " SET articleid = " . intval($article->getVar("articleid", "n")) . " WHERE obookid = " . intval($obookrow["obookid"]);
									$query->execute($sql);
									$sql = "UPDATE " . jieqi_dbprefix("obook_ochapter") . " SET articleid = " . intval($article->getVar("articleid", "n")) . " WHERE obookid = " . intval($obookrow["obookid"]);
									$query->execute($sql);
									$sql = "UPDATE " . jieqi_dbprefix("obook_paidlog") . " SET articleid = " . intval($article->getVar("articleid", "n")) . " WHERE obookid = " . intval($obookrow["obookid"]);
									$query->execute($sql);
								}
							}
						}
					}
	}

	jieqi_jumppage('/modules/article/admin/articleups.php?id='.$_REQUEST['id'].'', '审核成功！', '<font color="blue">正在跳转，请稍候...</font>');exit;
	}else {
		jieqi_jumppage('/modules/article/admin/articleups.php?id='.$_REQUEST['id'].'', '审核失败！', '<font color="blue">正在跳转，请稍候...</font>');exit;
	}

	break;

case 'show':
default:
$jieqiTpl->assign('id', $monthly->getVar('id'));
$jieqiTpl->assign('username', $monthly->getVar('username'));
$jieqiTpl->assign('bookname', $monthly->getVar('bookname'));
$jieqiTpl->assign('text', $monthly->getVar('text'));
$jieqiTpl->assign('pc', $monthly->getVar('pc'));
$jieqiTpl->assign('type', $monthly->getVar('type'));
$jieqiTpl->assign('types', $monthly->getVar('type'));


$jieqiTpl->setCaching(0);
include_once JIEQI_ROOT_PATH . '/admin/footer.php';
break;
}
?>
