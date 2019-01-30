<?php
/**
 * ���ݱ���(jieqi_system_vips - �û����)
 *
 * ���ݱ���(jieqi_system_vips - �û����)
 * 
 * ����ģ�壺��
 * 
 * @category   jieqicms
 * @package    system
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: groups.php 312 2008-12-29 05:30:54Z juny $
 */

jieqi_includedb();
//�û���
class JieqiVips extends JieqiObjectData
{
    function JieqiVips()
    {
        $this->JieqiObject();
        $this->initVar('vipid', JIEQI_TYPE_INT, 0, '���', false, 5);
        $this->initVar('caption', JIEQI_TYPE_TXTBOX, '', '�û�������',true, 255);
        $this->initVar('minegold', JIEQI_TYPE_INT, 0, '����', false, 11);
		$this->initVar('maxgold', JIEQI_TYPE_INT, 0, '����', false, 11);
		$this->initVar('extraegold', JIEQI_TYPE_INT, 0, '����', false, 11);
		$this->initVar('extradiv', JIEQI_TYPE_INT, 0, '����', false, 11);
        $this->initVar('viptype', JIEQI_TYPE_INT, 0, '����', false, 11);
    }
}

//�û�����
class JieqiVipsHandler extends JieqiObjectHandler
{
	function JieqiVipsHandler($db='')
	{
	    $this->JieqiObjectHandler($db);
	    $this->basename='vips';
	    $this->autoid='vipid';	
	    $this->dbname='system_vips';
	}
}

?>