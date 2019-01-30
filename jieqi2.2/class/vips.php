<?php
/**
 * 数据表类(jieqi_system_vips - 用户组表)
 *
 * 数据表类(jieqi_system_vips - 用户组表)
 * 
 * 调用模板：无
 * 
 * @category   jieqicms
 * @package    system
 * @copyright  Copyright (c) Hangzhou Jieqi Network Technology Co.,Ltd. (http://www.jieqi.com)
 * @author     $Author: juny $
 * @version    $Id: groups.php 312 2008-12-29 05:30:54Z juny $
 */

jieqi_includedb();
//用户组
class JieqiVips extends JieqiObjectData
{
    function JieqiVips()
    {
        $this->JieqiObject();
        $this->initVar('vipid', JIEQI_TYPE_INT, 0, '序号', false, 5);
        $this->initVar('caption', JIEQI_TYPE_TXTBOX, '', '用户组名称',true, 255);
        $this->initVar('minegold', JIEQI_TYPE_INT, 0, '描述', false, 11);
		$this->initVar('maxgold', JIEQI_TYPE_INT, 0, '描述', false, 11);
		$this->initVar('extraegold', JIEQI_TYPE_INT, 0, '描述', false, 11);
		$this->initVar('extradiv', JIEQI_TYPE_INT, 0, '描述', false, 11);
        $this->initVar('viptype', JIEQI_TYPE_INT, 0, '类型', false, 11);
    }
}

//用户组句柄
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