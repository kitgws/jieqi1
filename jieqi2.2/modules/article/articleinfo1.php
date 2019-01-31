<?php
/**
 * 小说信息页
 *
 * 显示一篇小说信息，包括最近书评等
 * 
 * 调用模板：/modules/article/templates/articleinfo.html
 * 
 * @category   jieqicms
 * @package    article
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: articleinfo.php 339 2009-06-23 03:03:24Z juny $
 */

define('JIEQI_MODULE_NAME', 'article');
if(!defined('JIEQI_GLOBAL_INCLUDE')) include_once ('../../global.php');
if(empty($_REQUEST['id']) || !is_numeric($_REQUEST['id'])) jieqi_printfail(LANG_ERROR_PARAMETER);
$_REQUEST['id'] = intval($_REQUEST['id']);

include_once (JIEQI_ROOT_PATH . '/header.php');
jieqi_getconfigs(JIEQI_MODULE_NAME, 'configs');
$jieqiTset['jieqi_contents_template'] = $jieqiModules['article']['path'] . '/templates/articleinfo.html';
$jieqiTset['jieqi_contents_cacheid'] = $_REQUEST['id'];

$content_used_cache = false; // 是否用缓存
if(JIEQI_USE_CACHE){
	$jieqiTpl->setCaching(1);
	$jieqiTpl->setCachType(1);
	if($jieqiTpl->is_cached($jieqiTset['jieqi_contents_template'], $jieqiTset['jieqi_contents_cacheid'], NULL, NULL, NULL, false)){
		$content_used_cache = true;
	}
}else{
	$jieqiTpl->setCaching(0);
}

// 不使用缓存情况
if(!$content_used_cache){
	jieqi_loadlang('article', JIEQI_MODULE_NAME);
	include_once ($jieqiModules['article']['path'] . '/class/article.php');
	$article_handler = & JieqiArticleHandler::getInstance('JieqiArticleHandler');
	$article = $article_handler->get($_REQUEST['id']);
	if(!$article) jieqi_printfail($jieqiLang['article']['article_not_exists']);
	elseif($article->getVar('display') != 0){
		jieqi_getconfigs(JIEQI_MODULE_NAME, 'power');
		if(!jieqi_checkpower($jieqiPower['article']['manageallarticle'], $jieqiUsersStatus, $jieqiUsersGroup, true)){
			if($article->getVar('display') == 1) jieqi_printfail($jieqiLang['article']['article_not_audit']);
			else jieqi_printfail($jieqiLang['article']['article_not_exists']);
		}
	}
	
	if($article->getVar('display') != 0){
		$jieqiTpl->setCaching(0);
		$jieqiConfigs['article']['makehtml'] = 0;
	}
	// 设置$_REQUEST参数，用于区块调用同类商品
	$_REQUEST['class'] = $article->getVar('sortid');
	$_REQUEST['sortid'] = $article->getVar('sortid');
	// 基本参数赋值
	jieqi_getconfigs('article', 'sort', 'jieqiSort');
	jieqi_getconfigs('article', 'option', 'jieqiOption');
	$article_static_url = (empty($jieqiConfigs['article']['staticurl'])) ? $jieqiModules['article']['url'] : $jieqiConfigs['article']['staticurl'];
	$article_dynamic_url = (empty($jieqiConfigs['article']['dynamicurl'])) ? $jieqiModules['article']['url'] : $jieqiConfigs['article']['dynamicurl'];
	$jieqiTpl->assign('article_static_url', $article_static_url);
	$jieqiTpl->assign('article_dynamic_url', $article_dynamic_url);
	$jieqiTpl->assign('makefull', $jieqiConfigs['article']['makefull']);
	$jieqiTpl->assign('makezip', $jieqiConfigs['article']['makezip']);
	$jieqiTpl->assign('makejar', $jieqiConfigs['article']['makejar']);
	$jieqiTpl->assign('makeumd', $jieqiConfigs['article']['makeumd']);
	$jieqiTpl->assign('maketxtfull', $jieqiConfigs['article']['maketxtfull']);
	$jieqiTpl->assign('maketxt', $jieqiConfigs['article']['maketxt']);
	$jieqiTpl->assign('ratemax', intval($jieqiConfigs['article']['maxrates']));
	
	// 小说信息数组
	include_once ($jieqiModules['article']['path'] . '/include/funarticle.php');
	$articlevals = jieqi_article_vars($article, true);
	
	// 赋值小说信息
	$jieqiTpl->assign_by_ref('articlevals', $articlevals);
	foreach($articlevals as $k => $v){
		$jieqiTpl->assign($k, $articlevals[$k]);
	}
	
	// 关键字标签
	if(floatval(JIEQI_VERSION) >= 2){
		$keywords = $article->getVar('keywords', 'n');
		include_once (JIEQI_ROOT_PATH . '/include/funtag.php');
		$tags = jieqi_tag_clean($keywords);
		$tagrows = array();
		foreach($tags as $k => $v){
			$tagrows[$k]['tagname'] = jieqi_htmlstr($v);
			$tagrows[$k]['tagencode'] = empty($charset_convert_out) ? urlencode($v) : urlencode($charset_convert_out($v));
		}
		$jieqiTpl->assign_by_ref('tagrows', $tagrows);
	}
	
	$setting = unserialize($article->getVar('setting', 'n'));
	
	// 互换链接
	if($jieqiConfigs['article']['eachlinknum'] > 0){
		$eachlinkrows = array();
		$eachlinkcount = 0;
		
		if(!empty($setting['eachlink']['ids'])){
			foreach($setting['eachlink']['ids'] as $k => $v){
				$eachlinkrows[$eachlinkcount]['articleid'] = $v;
				$eachlinkrows[$eachlinkcount]['articlename'] = jieqi_htmlstr($setting['eachlink']['names'][$k]);
				$eachlinkrows[$eachlinkcount]['articlesubdir'] = jieqi_getsubdir($v);
				$eachlinkrows[$eachlinkcount]['url_articleinfo'] = jieqi_geturl('article', 'article', $v, 'info');
				$eachlinkcount++;
			}
		}
		
		$jieqiTpl->assign('eachlinknum', $jieqiConfigs['article']['eachlinknum']);
		$jieqiTpl->assign('eachlinkcount', $eachlinkcount);
		$jieqiTpl->assign_by_ref('eachlinkrows', $eachlinkrows);
	}else{
		$jieqiTpl->assign('eachlinknum', 0);
		$jieqiTpl->assign('eachlinkcount', 0);
	}
	
	// 投票部分
	$showvote = 0;
	$jieqiConfigs['article']['articlevote'] = intval($jieqiConfigs['article']['articlevote']);
	if($jieqiConfigs['article']['articlevote'] > 0 && isset($setting['avoteid']) && $setting['avoteid'] > 0){
		include_once ($jieqiModules['article']['path'] . '/class/avote.php');
		$avote_handler = & JieqiAvoteHandler::getInstance('JieqiAvoteHandler');
		$avote = $avote_handler->get($setting['avoteid']);
		if(is_object($avote)){
			$jieqiTpl->assign('voteid', $avote->getVar('voteid'));
			$jieqiTpl->assign('votetitle', $avote->getVar('title'));
			$jieqiTpl->assign('mulselect', $avote->getVar('mulselect'));
			$useitem = $avote->getVar('useitem', 'n');
			$voteitemrows = array();
			for($i = 1; $i <= $useitem; $i++){
				$voteitemrows[$i - 1]['id'] = $i;
				$voteitemrows[$i - 1]['item'] = $avote->getVar('item' . $i);
			}
			$jieqiTpl->assign_by_ref('voteitemrows', $voteitemrows);
			$showvote = 1;
		}
	}
	$jieqiTpl->assign('showvote', $showvote);
	
	// 书评是否显示验证码
	if(!isset($jieqiConfigs['system'])) jieqi_getconfigs('system', 'configs');
	$jieqiTpl->assign('postcheckcode', $jieqiConfigs['system']['postcheckcode']);
}

// 点击统计要设置cookie和访问数据库，所以放footer.php前面
if(!isset($jieqiConfigs['article']['visitstatnum']) || !empty($jieqiConfigs['article']['visitstatnum'])) include_once ($jieqiModules['article']['path'] . '/articlevisit.php');
//include_once (JIEQI_ROOT_PATH . '/footer.php');


//载入footer.php的钩子
if(function_exists('jieqi_hooks_footer')) jieqi_hooks_footer();

// 如果header.php未载入，此处载入主内容模板INC，主要是分页设置和区块配置
if(!empty($jieqiTset['jieqi_contents_template']) && !defined('JIEQI_INCLUDE_COMPILED_INC')){
	define('JIEQI_INCLUDE_COMPILED_INC', 1);
	if(!isset($jieqiTset['jieqi_contents_cacheid'])) $jieqiTset['jieqi_contents_cacheid'] = NULL;
	if(!isset($jieqiTset['jieqi_contents_compileid'])) $jieqiTset['jieqi_contents_compileid'] = NULL;
	$jieqiTpl->include_compiled_inc($jieqiTset['jieqi_contents_template'], $jieqiTset['jieqi_contents_compileid'], true);
}

//根据模板包含区块配置文件
if(!empty($jieqiTset['jieqi_blocks_config'])){
	if(!empty($jieqiTset['jieqi_blocks_module'])) jieqi_getconfigs($jieqiTset['jieqi_blocks_module'], $jieqiTset['jieqi_blocks_config'], 'jieqiBlocks');
	else jieqi_getconfigs(JIEQI_MODULE_NAME, $jieqiTset['jieqi_blocks_config'], 'jieqiBlocks');
}

//区块处理
if(!isset($jieqi_showlblock)) $jieqi_showlblock = false;
if(!isset($jieqi_showcblock)) $jieqi_showcblock = false;
if(!isset($jieqi_showrblock)) $jieqi_showrblock = false;
if(!isset($jieqi_showtblock)) $jieqi_showtblock = false;
if(!isset($jieqi_showbblock)) $jieqi_showbblock = false;

//如果包含区块显示参数则显示
if (isset($jieqiBlocks) && is_array($jieqiBlocks)){
	reset($jieqiBlocks);
	//遍历所有区块
	while(list($i) = each($jieqiBlocks)){
		$bidindex = (empty($jieqiBlocks[$i]['bid'])) ? 'bid'.$i : 'bid'.$jieqiBlocks[$i]['bid'];
		$blockindex = $i;
		
		$blockvalue = jieqi_get_block($jieqiBlocks[$i]);
		if(!empty($blockvalue)){
			$jieqi_pageblocks[$blockindex] = $blockvalue;
			$jieqi_pageblocks[$bidindex] = &$jieqi_pageblocks[$blockindex];
			${$jieqi_blockside}[] = &$jieqi_pageblocks[$blockindex];
		}
		
	}
	unset($blockindex);
	unset($bidindex);
	unset($blockvalue);
	unset($jieqiBlocks);
}

$jieqi_showblock=$jieqi_showlblock | $jieqi_showcblock | $jieqi_showrblock | $jieqi_showtblock | $jieqi_showbblock;

$jieqiTpl->assign('jieqi_showblock',intval($jieqi_showblock));
if(isset($jieqi_pageblocks)) $jieqiTpl->assign_by_ref('jieqi_pageblocks', $jieqi_pageblocks);
if($jieqi_showlblock){
	$jieqiTpl->assign('jieqi_showlblock',1);
	if(isset($jieqi_lblocks) && is_array($jieqi_lblocks)) $jieqiTpl->assign_by_ref('jieqi_lblocks', $jieqi_lblocks);
}else{
	$jieqiTpl->assign('jieqi_showlblock',0);
}
if($jieqi_showcblock){
	$jieqiTpl->assign('jieqi_showcblock',1);
	if(isset($jieqi_clblocks) && is_array($jieqi_clblocks)) $jieqiTpl->assign_by_ref('jieqi_clblocks', $jieqi_clblocks);
	if(isset($jieqi_crblocks) && is_array($jieqi_crblocks)) $jieqiTpl->assign_by_ref('jieqi_crblocks', $jieqi_crblocks);
	if(isset($jieqi_ctblocks) && is_array($jieqi_ctblocks)) $jieqiTpl->assign_by_ref('jieqi_ctblocks', $jieqi_ctblocks);
	if(isset($jieqi_cmblocks) && is_array($jieqi_cmblocks)) $jieqiTpl->assign_by_ref('jieqi_cmblocks', $jieqi_cmblocks);
	if(isset($jieqi_cbblocks) && is_array($jieqi_cbblocks)) $jieqiTpl->assign_by_ref('jieqi_cbblocks', $jieqi_cbblocks);
}else{
	$jieqiTpl->assign('jieqi_showcblock',0);
}
if($jieqi_showrblock){
	$jieqiTpl->assign('jieqi_showrblock',1);
	if(isset($jieqi_rblocks) && is_array($jieqi_rblocks)) $jieqiTpl->assign_by_ref('jieqi_rblocks', $jieqi_rblocks);
}else{
	$jieqiTpl->assign('jieqi_showrblock',0);
}
if($jieqi_showtblock){
	$jieqiTpl->assign('jieqi_showtblock',1);
	if(isset($jieqi_tblocks) && is_array($jieqi_tblocks)) $jieqiTpl->assign_by_ref('jieqi_tblocks', $jieqi_tblocks);
}else{
	$jieqiTpl->assign('jieqi_showtblock',0);
}
if($jieqi_showbblock){
	$jieqiTpl->assign('jieqi_showbblock',1);
	if(isset($jieqi_bblocks) && is_array($jieqi_bblocks)) $jieqiTpl->assign_by_ref('jieqi_bblocks', $jieqi_bblocks);
}else{
	$jieqiTpl->assign('jieqi_showbblock',0);
}

//区块处理完成
//赋值主内容模板
if(!empty($jieqiTset['jieqi_contents_template'])){
	if(!isset($jieqiTset['jieqi_contents_cacheid'])) $jieqiTset['jieqi_contents_cacheid']=NULL;
	if(!isset($jieqiTset['jieqi_contents_compileid'])) $jieqiTset['jieqi_contents_compileid']=NULL;
	$jieqiTpl->assign('jieqi_contents', $jieqiTpl->fetch($jieqiTset['jieqi_contents_template'], $jieqiTset['jieqi_contents_cacheid'], $jieqiTset['jieqi_contents_compileid']));
	// 重新载入内容模板inc，以便将模板标签赋值到theme里面的$jieqi_pagetitle等
	$jieqiTpl->include_compiled_inc($jieqiTset['jieqi_contents_template'], $jieqiTset['jieqi_contents_compileid'], true);
}

//使用ajax获取某个变量直接输出
if(!empty($_REQUEST['ajax_request']) && !empty($_REQUEST['ajax_gets'])){
	header('Content-Type:text/html; charset='.JIEQI_CHAR_SET); 
	header("Cache-Control:no-cache");
	if(is_array($_REQUEST['ajax_gets'])){
		$out_var=array();
		foreach($_REQUEST['ajax_gets'] as $v) if(isset($jieqiTpl->_tpl_vars[$v])) $out_var[$v]=&$jieqiTpl->_tpl_vars[$v];
	}else{
		if(isset($jieqiTpl->_tpl_vars[$_REQUEST['ajax_gets']])) $out_var=&$jieqiTpl->_tpl_vars[$_REQUEST['ajax_gets']];
		else $out_var='';
	}
	if(is_array($out_var)) echo serialize($out_var);
	echo $out_var;
	exit;
}

$tmpvar = explode(' ', microtime());
$jieqiTpl->assign('jieqi_exetime', round($tmpvar[1] + $tmpvar[0] - JIEQI_START_TIME, 6));

$jieqiTpl->setCaching(0);
if(empty($jieqiTset['jieqi_page_template'])){
	$jieqiTpl->display(JIEQI_ROOT_PATH.'/themes/'.JIEQI_THEME_NAME.'/theme.html');
}else{
	if($jieqiTset['jieqi_page_template'][0] != '/' && $jieqiTset['jieqi_page_template'][1] != ':'){
		if(strpos($jieqiTset['jieqi_page_template'], '/') === false) $jieqiTpl->display(JIEQI_ROOT_PATH.'/themes/'.JIEQI_THEME_NAME.'/'.$jieqiTset['jieqi_page_template']);
		else $jieqiTpl->display(JIEQI_ROOT_PATH.'/'.$jieqiTset['jieqi_page_template']);
	}else $jieqiTpl->display($jieqiTset['jieqi_page_template']);
}

//处理推广
if(!empty($_GET['fromuid']) && defined('JIEQI_PROMOTION_VISIT') && (JIEQI_PROMOTION_VISIT > 0 || JIEQI_PROMOTION_REGISTER > 0)){
	$_GET['fromuid'] = intval($_GET['fromuid']);
	jieqi_includedb();
	$query=JieqiQueryHandler::getInstance('JieqiQueryHandler');
	if(JIEQI_PROMOTION_VISIT > 0){
		$query->execute("REPLACE INTO ".jieqi_dbprefix('system_promotions')." (ip, uid, username) VALUES ('".jieqi_userip()."', '".$_GET['fromuid']."', '')");
	}
	if(JIEQI_PROMOTION_REGISTER > 0 && empty($_COOKIE['jieqiPromotion'])){
		@setcookie('jieqiPromotion', $_GET['fromuid'], 0, '/',  JIEQI_COOKIE_DOMAIN, 0);
	}
}
//推广积分
if(defined('JIEQI_PROMOTION_VISIT') && JIEQI_PROMOTION_VISIT > 0 && substr(date('is', JIEQI_NOW_TIME), -3)=='000'){
	jieqi_includedb();
	$query=JieqiQueryHandler::getInstance('JieqiQueryHandler');
	$uidarray = array();
	$query->execute("SELECT * FROM ".jieqi_dbprefix('system_promotions'));
	while($promotion = $query->getRow()) {
		if(is_numeric($promotion['uid'])) {
			$uidarray[] = intval($promotion['uid']);
		}
	}
	if($uidarray) {
		$countarray = array();
		$countvalues = array_count_values($uidarray);
		foreach($countvalues as $uid => $count) {
			$countarray[$count][] = $uid;
		}
		foreach($countarray as $count => $uids) {
			$query->execute("UPDATE ".jieqi_dbprefix('system_users')." SET credit=credit+".intval($count * JIEQI_PROMOTION_VISIT)." WHERE uid IN (".implode(',', $uids).")");
		}
		$query->execute("DELETE FROM ".jieqi_dbprefix('system_promotions'));
	}
}

//载入页面结束的钩子
if(function_exists('jieqi_hooks_end')) jieqi_hooks_end();

//结束相关连接
jieqi_freeresource();
//显示DEBUG信息
if(defined('JIEQI_DEBUG_MODE') && JIEQI_DEBUG_MODE > 0){
	$runtime = explode(' ', microtime());
	$debuginfo = 'Processed in '.round($runtime[1] + $runtime[0] - JIEQI_START_TIME, 6).' second(s), ';
	if(function_exists('memory_get_usage')) $debuginfo .= 'Memory usage '.round(memory_get_usage()/1024).'K, ';
	$sqllog = array();
	if(defined('JIEQI_DB_CONNECTED')){
		$instance =& JieqiDatabase::retInstance();
		if(!empty($instance)){
			foreach($instance as $db){
				$sqllog = array_merge($sqllog, $db->sqllog('ret'));
			}
		}
	}
	$queries = count($sqllog);
	$debuginfo .= $queries.' queries, ';
	if(defined('JIEQI_USE_GZIP') && JIEQI_USE_GZIP > 0) $debuginfo .= 'Gzip enabled.';
	else $debuginfo .= 'Gzip disabled.';
	if($queries > 0){
		foreach($sqllog as $sql) $debuginfo .= '<br />'.$sql;
	}
	echo '<div class="divbox">'.$debuginfo.'</div>';
}
exit();
?>