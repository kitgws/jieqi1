<?php 
/**
 * ��̨���ߵ����鵼������
 *
 * ��̨���ߵ����鵼������
 * 
 * ����ģ�壺��
 * 
 * @category   jieqicms
 * @package    obook
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

$jieqiAdminmenu['obook'][] = array('layer' => 0, 'caption' => '��������', 'command'=>JIEQI_URL.'/admin/configs.php?mod=obook', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['obook'][] = array('layer' => 0, 'caption' => 'Ȩ������', 'command'=>JIEQI_URL.'/admin/power.php?mod=obook', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['obook'][] = array('layer' => 0, 'caption' => '���������', 'command'=>$GLOBALS['jieqiModules']['obook']['url'].'/admin/obooklist.php', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['obook'][] = array('layer' => 0, 'caption' => '���ļ�¼', 'command'=>$GLOBALS['jieqiModules']['obook']['url'].'/admin/buylog.php', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['obook'][] = array('layer' => 0, 'caption' => '����ͳ��', 'command'=>$GLOBALS['jieqiModules']['obook']['url'].'/admin/salestat.php', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['obook'][] = array('layer' => 0, 'caption' => '�����¼', 'command'=>$GLOBALS['jieqiModules']['obook']['url'].'/admin/paidlog.php', 'target' => 0, 'publish' => 1);

?>