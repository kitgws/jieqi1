<?php
/**
 * ��վ��ҳ
 *
 * ��վ��ҳ�������û��޸�����������ģ��ʵ�ֶ���Ч��
 * 
 * ����ģ�壺��
 * 
 * @category   jieqicms
 * @package    system
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: index.php 344 2013-05-20 03:06:07Z juny $
 

 */

//���屾ҳ������ģ�飨�����޸ģ�
define("JIEQI_MODULE_NAME", "system");
require_once("global.php");

//����������������޸ĵڶ���������Ĭ�� blocks ��ʾ��������������ļ��� /configs/blocks.php
//�û��ɴ����Զ������������ļ�������� /configs/indexblocks.php�����º����ڶ��������ĳ� indexblocks ����
jieqi_getconfigs(JIEQI_MODULE_NAME, "indexblocks", "jieqiBlocks");

//����ҳͷ����
include_once(JIEQI_ROOT_PATH."/header.php");

//������ҳ��־������ģ����������ж�
$jieqiTpl->assign("jieqi_indexpage",0);  

//����ģ��ĸ�ֵ�����ַ�ʽ
//1��������ģ���������ʾĬ�ϰ������������ļ���������ʾ�������ݺ�λ��
//$jieqiTset["jieqi_contents_template"] = "";  
//2��ָ��һ����ҳ�м����ݲ���ģ�壬ҳͷ��ҳβ������ϵͳĬ�ϵ�theme���������£�
$jieqiTset["jieqi_contents_template"] = JIEQI_ROOT_PATH."/templates/qa.html";
//3��ָ����ҳģ�壬ģ�屾�����ҳͷҳβ���ִ��룬�������£�
//$jieqiTset["jieqi_page_template"] = JIEQI_ROOT_PATH."/sink/index.html";

//��ʹ����ҳģ��ʱ�����²���Ϊ 0 ��ʾ����������ģ�����ݣ�1 ��ʾ���� ��Ĭ�ϲ����棩
$jieqiTpl->setCaching(0);

//����ҳβ�����������ҳ��ʾ
include_once(JIEQI_ROOT_PATH."/footer.php");
?>