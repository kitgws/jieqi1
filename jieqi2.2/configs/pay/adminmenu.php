<?php 
/**
 * ��̨��ֵ����������
 *
 * ��̨��ֵ����������
 * 
 * ����ģ�壺��
 * 
 * @category   jieqicms
 * @package    pay
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

$jieqiAdminmenu['pay'][] = array('layer' => 0, 'caption' => 'ȫ����ֵ��¼', 'command'=>$GLOBALS['jieqiModules']['pay']['url'].'/admin/paylog.php', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['pay'][] = array('layer' => 0, 'caption' => '�ѳɹ���ֵ', 'command'=>$GLOBALS['jieqiModules']['pay']['url'].'/admin/paylog.php?payflag=success', 'target' => 0, 'publish' => 1);

$jieqiAdminmenu['pay'][] = array('layer' => 0, 'caption' => 'δ�ɹ���ֵ', 'command'=>$GLOBALS['jieqiModules']['pay']['url'].'/admin/paylog.php?payflag=failure', 'target' => 0, 'publish' => 1);
?>