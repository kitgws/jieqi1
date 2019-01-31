<?php 
/**
 * 排行榜首页
 * 
 * 调用模板：/modules/article/templates/rank.html
 * 
 * @category   jieqicms
 * @package    article
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: rank.php 339 2009-06-23 03:03:24Z juny $
 */

define('JIEQI_MODULE_NAME', 'article');  //定义本页面所属模块
require_once('../../global.php');  //包含公共文件

include_once(JIEQI_ROOT_PATH.'/header.php'); //包含页头
$jieqiTpl->setCaching(0);
$jieqiTset['jieqi_contents_template'] = $jieqiModules['article']['path'].'/templates/rank.html';;  //内容位置不赋值，全部用区块
include_once(JIEQI_ROOT_PATH.'/footer.php'); //包含页尾
?>