<?php 
/**
 * ���а���ҳ
 * 
 * ����ģ�壺/modules/article/templates/rank.html
 * 
 * @category   jieqicms
 * @package    article
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: rank.php 339 2009-06-23 03:03:24Z juny $
 */

define('JIEQI_MODULE_NAME', 'article');  //���屾ҳ������ģ��
require_once('../../global.php');  //���������ļ�

include_once(JIEQI_ROOT_PATH.'/header.php'); //����ҳͷ
$jieqiTpl->setCaching(0);
$jieqiTset['jieqi_contents_template'] = $jieqiModules['article']['path'].'/templates/rank.html';;  //����λ�ò���ֵ��ȫ��������
include_once(JIEQI_ROOT_PATH.'/footer.php'); //����ҳβ
?>