<?php
/**
 * ��̨�������ӵ�������
 *
 * ��̨�������ӵ�������
 * 
 * ����ģ�壺��
 * 
 * @category   jieqicms
 * @package    link
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: adminmenu.php 187 2008-11-24 09:30:03Z juny $
 */

/**
'layer'     - �˵���ȣ�Ĭ�� 0
'caption'   - �˵�����
'command'   - ���ӵ���ַ
'target'    - ��������Ƿ���´���(0-���¿���1-�¿�)
'publish'   - �Ƿ���ʾ��0-����ʾ��1-��ʾ��
*/

$jieqiAdminmenu['link'][] = array('layer' => 0, 'caption' => '�������ӹ���', 'command'=>$GLOBALS['jieqiModules']['link']['url'].'/admin/link.php', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['link'][] = array('layer' => 0, 'caption' => '�������', 'command'=>$GLOBALS['jieqiModules']['link']['url'].'/admin/addlink.php', 'target' => 0, 'publish' => 1);


?>