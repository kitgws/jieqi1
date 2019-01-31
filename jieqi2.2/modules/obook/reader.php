<?php
/**
 * �������Ķ�
 *
 * �������Ķ�
 * 
 * ����ģ�壺/modules/obook/templates/reader.html
 * 
 * @category   jieqicms
 * @package    obook
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: reader.php 231 2008-11-27 08:46:26Z juny $
 */

$logstart = explode(' ', microtime());
define('JIEQI_MODULE_NAME', 'obook');
require_once ('../../global.php');
jieqi_checklogin();
if(empty($_REQUEST['cid'])) jieqi_printfail(LANG_ERROR_PARAMETER);
$_REQUEST['cid'] = intval($_REQUEST['cid']);
jieqi_loadlang('obook', 'obook');
jieqi_getconfigs('obook', 'configs');

$obook_static_url = (empty($jieqiConfigs['obook']['staticurl'])) ? $jieqiModules['obook']['url'] : $jieqiConfigs['obook']['staticurl'];
$obook_dynamic_url = (empty($jieqiConfigs['obook']['dynamicurl'])) ? $jieqiModules['obook']['url'] : $jieqiConfigs['obook']['dynamicurl'];

include_once ($jieqiModules['obook']['path'] . '/include/funbuy.php');

jieqi_includedb();
$query = JieqiQueryHandler::getInstance('JieqiQueryHandler');
$criteria = new CriteriaCompo(new Criteria('c.ochapterid', $_REQUEST['cid']));
$criteria->setTables(jieqi_dbprefix('obook_obook') . ' a RIGHT JOIN ' . jieqi_dbprefix('obook_ochapter') . ' c ON a.obookid=c.obookid');
$query->queryObjects($criteria);
$ochapter = $query->getObject();
if(!is_object($ochapter) || $ochapter->getVar('display', 'n') != 0){
	jieqi_printfail($jieqiLang['obook']['chapter_not_insale']);
}else{
	// �����û����Ķ�Ȩ��
	$freeread = false;
	//ֻ�б�վ����֧������Ķ�
	//if($ochapter->getVar('siteid', 'n') == 0){
		//������������Ķ�
		if(!empty($_SESSION['jieqiUserId']) && ($_SESSION['jieqiUserId'] == $ochapter->getVar('authorid') || $_SESSION['jieqiUserId'] == $ochapter->getVar('agentid') || $_SESSION['jieqiUserId'] == $ochapter->getVar('posterid'))){
			$freeread = true;
		}else{
			//����ԱȨ������Ķ�
			jieqi_getconfigs(JIEQI_MODULE_NAME, 'power');
			if(isset($jieqiPower['obook']['freeread'])) $freeread = jieqi_checkpower($jieqiPower['obook']['freeread'], $jieqiUsersStatus, $jieqiUsersGroup, true);
			//����С˵��԰����û�����Ķ�
			if(!$freeread && intval($ochapter->getVar('canbesp', 'n')) > 0 && !empty($_SESSION['jieqiUserOvertime']) && $_SESSION['jieqiUserOvertime'] > JIEQI_NOW_TIME) $freeread = true;
		}
	//}
}


// û����Ķ��������û����
if(!$freeread){
	//�����û��û�й���
	$obuyinfo = jieqi_obook_getobuyinfo($_REQUEST['cid']);
	
	if(!is_object($obuyinfo)){
		// û�ж��ģ��ǲ����Զ�����
		$autobuyed = jieqi_obook_isautobuy($ochapter->getVar('obookid'), $_SESSION['jieqiUserId']);
		if($autobuyed) $autobuyed = jieqi_obook_autobuy($ochapter, $_SESSION['jieqiUserId']);
		if(!$autobuyed){
			header('Location: ' . jieqi_headstr($obook_static_url . '/buychapter.php?cid=' . $_REQUEST['cid']));
			exit();
		}
	}
}

// ��ʾ�Ķ�����
$ocontent = jieqi_obook_getocontent($ochapter);

// ����vip�½ڵ��Ѷ��ı�־
if(isset($_SESSION['jieqiVisitedObooks'])) $arysession = unserialize($_SESSION['jieqiVisitedObooks']);
else $arysession = array();
if(!is_array($arysession)) $arysession = array();
$arysession[$_REQUEST['cid']] = 1;
$_SESSION['jieqiVisitedObooks'] = serialize($arysession);
@session_write_close();

if($ocontent === false){
	jieqi_printfail($jieqiLang['obook']['chapter_not_exists']);
}else{
	include_once (JIEQI_ROOT_PATH . '/header.php');
	$jieqiTpl->assign('obookid', $ochapter->getVar('obookid'));
	$jieqiTpl->assign('articleid', $ochapter->getVar('articleid'));
	$jieqiTpl->assign('ochapterid', $_REQUEST['cid']);
	$jieqiTpl->assign('cid', $_REQUEST['cid']);
	$jieqiTpl->assign('obookname', $ochapter->getVar('obookname'));
	$jieqiTpl->assign('articlename', $ochapter->getVar('obookname'));
	$jieqiTpl->assign('chaptername', $ochapter->getVar('chaptername'));
	$jieqiTpl->assign('chaptertitle', $ochapter->getVar('obookname') . ' - ' . $ochapter->getVar('chaptername'));
	$jieqiTpl->assign('authorid', $ochapter->getVar('authorid'));
	$jieqiTpl->assign('author', $ochapter->getVar('author'));
	$jieqiTpl->assign('chaptertime', $ochapter->getVar('lastupdate'));
	$jieqiTpl->assign('chaptersize', $ochapter->getVar('size'));
	$jieqiTpl->assign('chaptersize_c', ceil(intval($ochapter->getVar('size')) / 2));
	$sortid = $ochapter->getVar('sortid');
	jieqi_getconfigs('article', 'sort');
	if(isset($jieqiSort['article'][$sortid]['caption'])) $sort = $jieqiSort['article'][$sortid]['caption'];
	else $sort = '';
	$jieqiTpl->assign('sortid', $sortid);
	$jieqiTpl->assign('sort', $sort);
	$jieqiTpl->assign('obookbgcolor', $jieqiConfigs['obook']['obkimagecolor']);
	$jieqiTpl->assign('static_url', $obook_static_url);
	$jieqiTpl->assign('dynamic_url', $obook_dynamic_url);
	$jieqiTpl->assign('url_obookroom', $obook_dynamic_url . '/');
	$jieqiTpl->assign('url_obookinfo', $obook_dynamic_url . '/obookinfo.php?id=' . $ochapter->getVar('obookid'));
	$jieqiTpl->assign('url_index', $obook_static_url . '/obookread.php?oid=' . $ochapter->getVar('obookid') . '&aid=' . $ochapter->getVar('articleid') . '&page=index');
	$url_previous = $obook_static_url . '/obookread.php?oid=' . $ochapter->getVar('obookid') . '&aid=' . $ochapter->getVar('articleid') . '&cid=' . $_REQUEST['cid'] . '&page=previous';
	$jieqiTpl->assign('url_preview', $url_previous);
	$jieqiTpl->assign('url_previous', $url_previous);
	$jieqiTpl->assign('url_next', $obook_static_url . '/obookread.php?oid=' . $ochapter->getVar('obookid') . '&aid=' . $ochapter->getVar('articleid') . '&cid=' . $_REQUEST['cid'] . '&page=next');
	
	$jieqiTpl->assign('url_obookimage', $obook_static_url . '/obookimage.php?cid=' . $_REQUEST['cid']);
	$jieqiTpl->setCaching(0);
	//if (empty($jieqiConfigs["obook"]["obooktype"])) {
		include_once $jieqiModules['obook']['path'] . '/class/ocontent.php';
        $ocontent_handler = &JieqiOcontentHandler::getInstance('JieqiOcontentHandler');
        $ocontent = $ocontent_handler->get($_REQUEST['cid']);
		$jieqi_content = $ocontent->getVar('ocontent', 'n');
		if (!empty($jieqiConfigs["obook"]["obookreadhead"])) {
			$jieqi_content = jieqi_htmlstr($jieqiConfigs["obook"]["obookreadhead"]) . "<br />" . $jieqi_content;
		}

		if (!empty($jieqiConfigs["obook"]["obookreadfoot"])) {
			$jieqi_content .= "<br />" . jieqi_htmlstr($jieqiConfigs["obook"]["obookreadfoot"]);
		}

		$jieqi_content = str_replace(array('<br />', '&nbsp;'), array('</p><p>', ''), jieqi_htmlclickable(jieqi_htmlstr($jieqi_content)));
		$jieqiTpl->assign("jieqi_content", $jieqi_content);
		
		$jieqiTpl->display($jieqiModules['obook']['path'] . '/templates/reader.html');
	/*}else{
		$picnum = count($ocontent);
		$jieqiTpl->assign('picnum', $picnum);
		$jieqiTpl->assign_by_ref('picrows', $ocontent);
		$jieqiTpl->display($jieqiModules['obook']['path'] . '/templates/reader.html');
	}*/
}
?>