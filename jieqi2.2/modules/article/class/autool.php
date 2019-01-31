<?php 


jieqi_includedb();
//用户类
class JieqiMonthlybuy extends JieqiObjectData
{
	//构建函数
	public function JieqiMonthlybuy()
	{
		$this->JieqiObjectData();
		$this->initVar('id', JIEQI_TYPE_INT, 0, '序号', false, 11);
		$this->initVar('userid', JIEQI_TYPE_INT, 0, '用户序号', true, 11);
		$this->initVar('username', JIEQI_TYPE_TXTBOX, 0, '用户名', true, 250);
		$this->initVar('bookid', JIEQI_TYPE_INT, '', '文章序号', false, 250);
		$this->initVar('bookname', JIEQI_TYPE_TXTAREA, '', '文章序号', false, 250);
		$this->initVar('text', JIEQI_TYPE_TXTAREA, '', '作者申请内容', false, 11);
		$this->initVar('texts', JIEQI_TYPE_TXTAREA, '', '催更用户序号', false, 11);
		$this->initVar('date', JIEQI_TYPE_INT, 0, '申请时间', false, 11);
		$this->initVar('typeid', JIEQI_TYPE_INT, 0, '状态', false, 11);
		$this->initVar('type', JIEQI_TYPE_INT, 0, '类型', false, 11);
		$this->initVar('pc', JIEQI_TYPE_TXTBOX, 0, 'pc', true, 250);
	}
}

//------------------------------------------------------------------------
//------------------------------------------------------------------------

//内容句柄
class JieqiMonthlybuyHandler extends JieqiObjectHandler
{
	function JieqiMonthlybuyHandler($db='')
	{
	    $this->JieqiObjectHandler($db);
	    $this->basename='monthlybuy';
	    $this->autoid='id';	
	    $this->dbname='article_mouthlybuy';
	}
}

?>